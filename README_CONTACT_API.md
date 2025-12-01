# Contact Management System with JWT Authentication

A complete Laravel 12 REST API for managing contacts with user authentication using JWT (JSON Web Tokens) and Laravel Sanctum.

## Features

- ✅ User Registration & Login
- ✅ JWT Token Authentication
- ✅ Laravel Sanctum Integration
- ✅ CRUD Operations for Contacts
- ✅ User-specific Contact Management
- ✅ Token Refresh & Logout
- ✅ Comprehensive API Documentation

## Tech Stack

- **Framework:** Laravel 12
- **Authentication:** JWT (tymon/jwt-auth) + Laravel Sanctum
- **Database:** SQLite (configurable)
- **PHP Version:** 8.2+

## Installation & Setup

### 1. Install Dependencies

The required packages are already installed:
- `laravel/sanctum` - API token authentication
- `tymon/jwt-auth` - JWT authentication

### 2. Configure Environment

Make sure your `.env` file has the JWT secret (already generated):
```env
JWT_SECRET=your-generated-secret-key
```

### 3. Run Migrations

```bash
php artisan migrate
```

This will create:
- `users` table
- `contacts` table
- `personal_access_tokens` table (Sanctum)

### 4. Start the Development Server

```bash
php artisan serve
```

The API will be available at: `http://localhost:8000/api`

## Database Schema

### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - Unique email address
- `password` - Hashed password
- `timestamps`

### Contacts Table
- `id` - Primary key
- `user_id` - Foreign key to users table
- `name` - Contact name (required)
- `email` - Contact email (optional)
- `phone` - Contact phone (optional)
- `address` - Contact address (optional)
- `notes` - Additional notes (optional)
- `timestamps`

## API Endpoints

### Authentication
- `POST /api/register` - Register a new user
- `POST /api/login` - Login and get JWT token
- `GET /api/me` - Get current user (protected)
- `POST /api/logout` - Logout and invalidate token (protected)
- `POST /api/refresh` - Refresh JWT token (protected)

### Contacts (All Protected)
- `GET /api/contacts` - Get all user's contacts
- `POST /api/contacts` - Create a new contact
- `GET /api/contacts/{id}` - Get a specific contact
- `PUT/PATCH /api/contacts/{id}` - Update a contact
- `DELETE /api/contacts/{id}` - Delete a contact

## Usage Examples

### 1. Register a New User

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

### 2. Login

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

Save the token from the response!

### 3. Create a Contact

```bash
curl -X POST http://localhost:8000/api/contacts \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "name": "Jane Smith",
    "email": "jane@example.com",
    "phone": "+1234567890",
    "address": "123 Main St",
    "notes": "Important client"
  }'
```

### 4. Get All Contacts

```bash
curl -X GET http://localhost:8000/api/contacts \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### 5. Update a Contact

```bash
curl -X PUT http://localhost:8000/api/contacts/1 \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "name": "Jane Doe",
    "phone": "+0987654321"
  }'
```

### 6. Delete a Contact

```bash
curl -X DELETE http://localhost:8000/api/contacts/1 \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

## Security Features

- Passwords are hashed using bcrypt
- JWT tokens for stateless authentication
- User-specific contact isolation (users can only access their own contacts)
- Token expiration and refresh mechanism
- CSRF protection via Sanctum
- Input validation on all endpoints

## Testing with Postman

1. Import the API endpoints into Postman
2. Create an environment variable `token` for the JWT token
3. Set the Authorization header to `Bearer {{token}}`
4. Test all endpoints sequentially

## Project Structure

```
app/
├── Http/
│   └── Controllers/
│       └── Api/
│           ├── AuthController.php    # Authentication logic
│           └── ContactController.php # Contact CRUD operations
└── Models/
    ├── User.php                      # User model with JWT
    └── Contact.php                   # Contact model

routes/
└── api.php                           # API routes

database/
└── migrations/
    └── xxxx_create_contacts_table.php
```

## Additional Documentation

See `API_DOCUMENTATION.md` for detailed API documentation with all request/response examples.

## License

This project is open-sourced software licensed under the MIT license.

