# Quick Start Guide - Contact Management API

## 🚀 Get Started in 3 Steps

### Step 1: Start the Server
```bash
php artisan serve
```

The API will be available at: `http://localhost:8000/api`

### Step 2: Register a User
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

**Save the token from the response!**

### Step 3: Create Your First Contact
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

## 📋 Common Operations

### Login (if already registered)
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

### View All Your Contacts
```bash
curl -X GET http://localhost:8000/api/contacts \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Update a Contact
```bash
curl -X PUT http://localhost:8000/api/contacts/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "name": "Jane Doe",
    "phone": "+0987654321"
  }'
```

### Delete a Contact
```bash
curl -X DELETE http://localhost:8000/api/contacts/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

## 🧪 Run Tests
```bash
php artisan test
```

Or run specific test:
```bash
php artisan test --filter ContactApiTest
```

## 📦 Using Postman

1. Import `postman_collection.json` into Postman
2. Set the `base_url` variable to `http://localhost:8000/api`
3. Register/Login to get a token
4. Copy the token and set it in the `token` variable
5. Start testing all endpoints!

## 🔑 Authentication Flow

1. **Register** → Get token
2. **Use token** in Authorization header for all protected endpoints
3. **Refresh token** when it expires (default: 60 minutes)
4. **Logout** to invalidate token

## 📚 Full Documentation

- **API Documentation**: See `API_DOCUMENTATION.md`
- **Project README**: See `README_CONTACT_API.md`

## ⚙️ Configuration

All configuration is already done! The project includes:
- ✅ Laravel Sanctum installed
- ✅ JWT Auth configured
- ✅ Database migrations ready
- ✅ API routes configured
- ✅ Controllers implemented
- ✅ Tests written

## 🐛 Troubleshooting

### Token not working?
Make sure you include `Bearer ` before the token:
```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc...
```

### Database errors?
Run migrations:
```bash
php artisan migrate
```

### JWT Secret missing?
Generate it:
```bash
php artisan jwt:secret
```

## 🎯 Next Steps

1. Test all endpoints using Postman or cURL
2. Run the test suite to verify everything works
3. Customize the Contact model to add more fields
4. Add more features like contact groups, tags, etc.

## 📞 Support

For detailed API documentation, see `API_DOCUMENTATION.md`

