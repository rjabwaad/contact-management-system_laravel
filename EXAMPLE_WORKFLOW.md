# Example API Workflow

This document shows a complete workflow of using the Contact Management API.

## Step 1: Register a New User

**Request:**
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Alice Johnson",
    "email": "alice@example.com",
    "password": "securepass123",
    "password_confirmation": "securepass123"
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "User registered successfully",
  "user": {
    "id": 1,
    "name": "Alice Johnson",
    "email": "alice@example.com",
    "created_at": "2025-12-01T17:30:00.000000Z",
    "updated_at": "2025-12-01T17:30:00.000000Z"
  },
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNzAxNDUwNjAwLCJleHAiOjE3MDE0NTQyMDAsIm5iZiI6MTcwMTQ1MDYwMCwianRpIjoiYWJjZGVmMTIzNDU2Iiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.example_signature",
  "token_type": "bearer"
}
```

**Save this token!** You'll need it for all subsequent requests.

---

## Step 2: Create First Contact

**Request:**
```bash
curl -X POST http://localhost:8000/api/contacts \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc..." \
  -d '{
    "name": "Bob Smith",
    "email": "bob@company.com",
    "phone": "+1-555-0123",
    "address": "123 Business Ave, Suite 100, New York, NY 10001",
    "notes": "CEO of TechCorp, met at conference 2025"
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "Contact created successfully",
  "contact": {
    "id": 1,
    "user_id": 1,
    "name": "Bob Smith",
    "email": "bob@company.com",
    "phone": "+1-555-0123",
    "address": "123 Business Ave, Suite 100, New York, NY 10001",
    "notes": "CEO of TechCorp, met at conference 2025",
    "created_at": "2025-12-01T17:31:00.000000Z",
    "updated_at": "2025-12-01T17:31:00.000000Z"
  }
}
```

---

## Step 3: Create More Contacts

**Request:**
```bash
curl -X POST http://localhost:8000/api/contacts \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc..." \
  -d '{
    "name": "Carol Davis",
    "email": "carol@startup.io",
    "phone": "+1-555-0456"
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "Contact created successfully",
  "contact": {
    "id": 2,
    "user_id": 1,
    "name": "Carol Davis",
    "email": "carol@startup.io",
    "phone": "+1-555-0456",
    "address": null,
    "notes": null,
    "created_at": "2025-12-01T17:32:00.000000Z",
    "updated_at": "2025-12-01T17:32:00.000000Z"
  }
}
```

---

## Step 4: Get All Contacts

**Request:**
```bash
curl -X GET http://localhost:8000/api/contacts \
  -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc..."
```

**Response:**
```json
{
  "success": true,
  "contacts": [
    {
      "id": 2,
      "user_id": 1,
      "name": "Carol Davis",
      "email": "carol@startup.io",
      "phone": "+1-555-0456",
      "address": null,
      "notes": null,
      "created_at": "2025-12-01T17:32:00.000000Z",
      "updated_at": "2025-12-01T17:32:00.000000Z"
    },
    {
      "id": 1,
      "user_id": 1,
      "name": "Bob Smith",
      "email": "bob@company.com",
      "phone": "+1-555-0123",
      "address": "123 Business Ave, Suite 100, New York, NY 10001",
      "notes": "CEO of TechCorp, met at conference 2025",
      "created_at": "2025-12-01T17:31:00.000000Z",
      "updated_at": "2025-12-01T17:31:00.000000Z"
    }
  ]
}
```

---

## Step 5: Get Single Contact

**Request:**
```bash
curl -X GET http://localhost:8000/api/contacts/1 \
  -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc..."
```

**Response:**
```json
{
  "success": true,
  "contact": {
    "id": 1,
    "user_id": 1,
    "name": "Bob Smith",
    "email": "bob@company.com",
    "phone": "+1-555-0123",
    "address": "123 Business Ave, Suite 100, New York, NY 10001",
    "notes": "CEO of TechCorp, met at conference 2025",
    "created_at": "2025-12-01T17:31:00.000000Z",
    "updated_at": "2025-12-01T17:31:00.000000Z"
  }
}
```

---

## Step 6: Update a Contact

**Request:**
```bash
curl -X PUT http://localhost:8000/api/contacts/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc..." \
  -d '{
    "phone": "+1-555-9999",
    "notes": "CEO of TechCorp, met at conference 2025. Follow up scheduled for next week."
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "Contact updated successfully",
  "contact": {
    "id": 1,
    "user_id": 1,
    "name": "Bob Smith",
    "email": "bob@company.com",
    "phone": "+1-555-9999",
    "address": "123 Business Ave, Suite 100, New York, NY 10001",
    "notes": "CEO of TechCorp, met at conference 2025. Follow up scheduled for next week.",
    "created_at": "2025-12-01T17:31:00.000000Z",
    "updated_at": "2025-12-01T17:35:00.000000Z"
  }
}
```

---

## Step 7: Delete a Contact

**Request:**
```bash
curl -X DELETE http://localhost:8000/api/contacts/2 \
  -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc..."
```

**Response:**
```json
{
  "success": true,
  "message": "Contact deleted successfully"
}
```

---

## Step 8: Logout

**Request:**
```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc..."
```

**Response:**
```json
{
  "success": true,
  "message": "Successfully logged out"
}
```

---

## Summary

This workflow demonstrates:
1. ✅ User registration and authentication
2. ✅ Creating multiple contacts
3. ✅ Retrieving all contacts and single contact
4. ✅ Updating contact information
5. ✅ Deleting contacts
6. ✅ Logout functionality

All contacts are isolated per user - each user can only access their own contacts!

