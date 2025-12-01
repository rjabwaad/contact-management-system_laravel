<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the user's contacts.
     */
    public function index(): JsonResponse
    {
        $contacts = Auth::user()->contacts()->latest()->get();

        return response()->json([
            'success' => true,
            'contacts' => $contacts
        ]);
    }

    /**
     * Store a newly created contact in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $contact = Auth::user()->contacts()->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Contact created successfully',
            'contact' => $contact
        ], 201);
    }

    /**
     * Display the specified contact.
     */
    public function show(string $id): JsonResponse
    {
        $contact = Auth::user()->contacts()->find($id);

        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Contact not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'contact' => $contact
        ]);
    }

    /**
     * Update the specified contact in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $contact = Auth::user()->contacts()->find($id);

        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Contact not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $contact->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Contact updated successfully',
            'contact' => $contact
        ]);
    }

    /**
     * Remove the specified contact from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $contact = Auth::user()->contacts()->find($id);

        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'Contact not found'
            ], 404);
        }

        $contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted successfully'
        ]);
    }
}
