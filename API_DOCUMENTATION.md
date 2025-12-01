# Contact Management API Documentation

## Overview
This is a RESTful API for managing contacts with user authentication using JWT (JSON Web Tokens) and Laravel Sanctum.

## Base URL
```
http://localhost:8000/api
```

## Authentication
All protected endpoints require a JWT token in the Authorization header:
```
Authorization: Bearer {your-jwt-token}
```

---

## Authentication Endpoints

### 1. Register a New User
**POST** `/register`

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Response (201):**
```json
{
    "success": true,
    "message": "User registered successfully",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2025-12-01T12:00:00.000000Z",
        "updated_at": "2025-12-01T12:00:00.000000Z"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "bearer"
}
```

### 2. Login
**POST** `/login`

**Request Body:**
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Response (200):**
```json
{
    "success": true,
    "message": "Login successful",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "bearer"
}
```

### 3. Get Current User
**GET** `/me`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}
```

### 4. Logout
**POST** `/logout`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "message": "Successfully logged out"
}
```

### 5. Refresh Token
**POST** `/refresh`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "bearer"
}
```

---

## Contact Management Endpoints

All contact endpoints require authentication.

### 1. Get All Contacts
**GET** `/contacts`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "contacts": [
        {
            "id": 1,
            "user_id": 1,
            "name": "Jane Smith",
            "email": "jane@example.com",
            "phone": "+1234567890",
            "address": "123 Main St, City",
            "notes": "Important client",
            "created_at": "2025-12-01T12:00:00.000000Z",
            "updated_at": "2025-12-01T12:00:00.000000Z"
        }
    ]
}
```

### 2. Create a New Contact
**POST** `/contacts`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
    "name": "Jane Smith",
    "email": "jane@example.com",
    "phone": "+1234567890",
    "address": "123 Main St, City",
    "notes": "Important client"
}
```

**Response (201):**
```json
{
    "success": true,
    "message": "Contact created successfully",
    "contact": {
        "id": 1,
        "user_id": 1,
        "name": "Jane Smith",
        "email": "jane@example.com",
        "phone": "+1234567890",
        "address": "123 Main St, City",
        "notes": "Important client",
        "created_at": "2025-12-01T12:00:00.000000Z",
        "updated_at": "2025-12-01T12:00:00.000000Z"
    }
}
```

### 3. Get a Specific Contact
**GET** `/contacts/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "contact": {
        "id": 1,
        "user_id": 1,
        "name": "Jane Smith",
        "email": "jane@example.com",
        "phone": "+1234567890",
        "address": "123 Main St, City",
        "notes": "Important client"
    }
}
```

### 4. Update a Contact
**PUT/PATCH** `/contacts/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Request Body:**
```json
{
    "name": "Jane Doe",
    "email": "jane.doe@example.com",
    "phone": "+0987654321"
}
```

**Response (200):**
```json
{
    "success": true,
    "message": "Contact updated successfully",
    "contact": {
        "id": 1,
        "user_id": 1,
        "name": "Jane Doe",
        "email": "jane.doe@example.com",
        "phone": "+0987654321",
        "address": "123 Main St, City",
        "notes": "Important client"
    }
}
```

### 5. Delete a Contact
**DELETE** `/contacts/{id}`

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
    "success": true,
    "message": "Contact deleted successfully"
}
```

---

## Error Responses

### Validation Error (422)
```json
{
    "success": false,
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password must be at least 8 characters."]
    }
}
```

### Unauthorized (401)
```json
{
    "success": false,
    "message": "Invalid credentials"
}
```

### Not Found (404)
```json
{
    "success": false,
    "message": "Contact not found"
}
```

---

## Testing the API

### Using cURL

**Register:**
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

**Login:**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

**Create Contact:**
```bash
curl -X POST http://localhost:8000/api/contacts \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "name": "Jane Smith",
    "email": "jane@example.com",
    "phone": "+1234567890"
  }'
```

**Get All Contacts:**
```bash
curl -X GET http://localhost:8000/api/contacts \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

**Update Contact:**
```bash
curl -X PUT http://localhost:8000/api/contacts/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "name": "Jane Doe Updated"
  }'
```

**Delete Contact:**
```bash
curl -X DELETE http://localhost:8000/api/contacts/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```
```

