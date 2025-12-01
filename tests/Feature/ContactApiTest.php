<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user can register', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'success',
            'message',
            'user' => ['id', 'name', 'email'],
            'token',
            'token_type',
        ]);
});

test('user can login', function () {
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'message',
            'user',
            'token',
            'token_type',
        ]);
});

test('authenticated user can create contact', function () {
    $user = User::factory()->create();
    $token = auth()->guard('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/contacts', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1234567890',
            'address' => '123 Main St',
            'notes' => 'Test contact',
        ]);

    $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'message' => 'Contact created successfully',
        ]);

    $this->assertDatabaseHas('contacts', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'user_id' => $user->id,
    ]);
});

test('authenticated user can view their contacts', function () {
    $user = User::factory()->create();
    Contact::factory()->count(3)->create(['user_id' => $user->id]);
    
    $token = auth()->guard('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->getJson('/api/contacts');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'contacts' => [
                '*' => ['id', 'name', 'email', 'phone', 'address', 'notes'],
            ],
        ])
        ->assertJsonCount(3, 'contacts');
});

test('authenticated user can update their contact', function () {
    $user = User::factory()->create();
    $contact = Contact::factory()->create(['user_id' => $user->id]);
    
    $token = auth()->guard('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->putJson("/api/contacts/{$contact->id}", [
            'name' => 'Updated Name',
        ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Contact updated successfully',
        ]);

    $this->assertDatabaseHas('contacts', [
        'id' => $contact->id,
        'name' => 'Updated Name',
    ]);
});

test('authenticated user can delete their contact', function () {
    $user = User::factory()->create();
    $contact = Contact::factory()->create(['user_id' => $user->id]);
    
    $token = auth()->guard('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->deleteJson("/api/contacts/{$contact->id}");

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Contact deleted successfully',
        ]);

    $this->assertDatabaseMissing('contacts', [
        'id' => $contact->id,
    ]);
});

test('user cannot access another users contacts', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $contact = Contact::factory()->create(['user_id' => $user2->id]);
    
    $token = auth()->guard('api')->login($user1);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->getJson("/api/contacts/{$contact->id}");

    $response->assertStatus(404);
});

test('unauthenticated user cannot access contacts', function () {
    $response = $this->getJson('/api/contacts');

    $response->assertStatus(401);
});

