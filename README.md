# 📇 Contact Management System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/JWT-Authentication-000000?style=for-the-badge&logo=json-web-tokens&logoColor=white" alt="JWT">
  <img src="https://img.shields.io/badge/Tests-Passing-success?style=for-the-badge" alt="Tests Passing">
</p>

<p align="center">
  A modern, full-stack contact management application built with Laravel 12, featuring JWT authentication, RESTful API, and a beautiful responsive web interface.
</p>

---

## ✨ Features

### 🔐 Authentication
- ✅ User registration and login
- ✅ JWT token-based authentication
- ✅ Laravel Sanctum integration
- ✅ Secure password hashing (bcrypt)
- ✅ Token refresh mechanism
- ✅ Logout functionality

### 📇 Contact Management
- ✅ **Create** contacts with name, email, phone, address, and notes
- ✅ **Read** all contacts or individual contact details
- ✅ **Update** contact information
- ✅ **Delete** contacts with confirmation
- ✅ User-specific data isolation (users only see their own contacts)

### 🎨 Beautiful Web Interface
- ✅ Modern purple gradient design
- ✅ Fully responsive (mobile, tablet, desktop)
- ✅ Smooth animations and transitions
- ✅ Card-based contact display
- ✅ Modal popups for forms
- ✅ Real-time updates
- ✅ Empty state handling

### 🔧 Developer Features
- ✅ RESTful API with comprehensive documentation
- ✅ Automated tests (8 passing tests)
- ✅ API test page for debugging
- ✅ Postman collection included
- ✅ Factory classes for testing
- ✅ Comprehensive error handling

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL or SQLite

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/contact-management-system.git
   cd contact-management-system
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan jwt:secret
   ```

4. **Configure database**

   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

7. **Open in browser**
   ```
   http://localhost:8000
   ```

🎉 **That's it!** You can now register an account and start managing contacts!

---

## 🎯 Usage

### Web Interface

1. **Register**: Go to `http://localhost:8000` and create an account
2. **Login**: Use your credentials to log in
3. **Add Contacts**: Click "Add New Contact" and fill in the details
4. **Manage**: Edit or delete contacts using the buttons on each card
5. **Logout**: Click the logout button when done

### API Endpoints

#### Authentication
- `POST /api/register` - Register a new user
- `POST /api/login` - Login and get JWT token
- `POST /api/logout` - Logout (requires auth)
- `POST /api/refresh` - Refresh JWT token (requires auth)
- `GET /api/me` - Get current user (requires auth)

#### Contacts (All require authentication)
- `GET /api/contacts` - Get all user's contacts
- `POST /api/contacts` - Create a new contact
- `GET /api/contacts/{id}` - Get a specific contact
- `PUT /api/contacts/{id}` - Update a contact
- `DELETE /api/contacts/{id}` - Delete a contact

### API Example

```bash
# Register
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'

# Login
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'

# Create Contact (use token from login)
curl -X POST http://localhost:8000/api/contacts \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "name": "Jane Smith",
    "email": "jane@example.com",
    "phone": "+1234567890"
  }'
```

---

## 🧪 Testing

Run the automated test suite:

```bash
php artisan test
```

Or test specific features:

```bash
php artisan test --filter ContactApiTest
```

All 8 tests should pass! ✅

---

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/Api/
│   │   ├── AuthController.php      # Authentication logic
│   │   └── ContactController.php   # Contact CRUD operations
│   └── Models/
│       ├── User.php                 # User model with JWT
│       └── Contact.php              # Contact model
├── database/
│   ├── migrations/                  # Database migrations
│   └── factories/                   # Model factories
├── public/
│   ├── index.html                   # Login/Register page
│   ├── contacts.html                # Contacts management page
│   └── test-api.html                # API testing tool
├── routes/
│   ├── api.php                      # API routes
│   └── web.php                      # Web routes
└── tests/
    └── Feature/
        └── ContactApiTest.php       # API tests
```

---

## 📚 Documentation

Comprehensive documentation is included:

- **[START_HERE.md](START_HERE.md)** - Quick start guide
- **[API_DOCUMENTATION.md](API_DOCUMENTATION.md)** - Complete API reference
- **[BROWSER_TESTING_GUIDE.md](BROWSER_TESTING_GUIDE.md)** - Web interface guide
- **[TROUBLESHOOTING.md](TROUBLESHOOTING.md)** - Common issues and solutions
- **[EXAMPLE_WORKFLOW.md](EXAMPLE_WORKFLOW.md)** - Step-by-step examples
- **[postman_collection.json](postman_collection.json)** - Postman collection

---

## 🎨 Screenshots

### Login/Register Page
Beautiful purple gradient design with smooth animations.

### Contacts Management
Card-based layout with edit and delete functionality.

### Responsive Design
Works perfectly on mobile, tablet, and desktop devices.

---

## 🔐 Security Features

- ✅ JWT tokens for stateless authentication
- ✅ Password hashing with bcrypt
- ✅ Protected API routes
- ✅ User-specific data isolation
- ✅ CORS configured
- ✅ Input validation on all endpoints
- ✅ CSRF protection for web routes

---

## 🛠️ Tech Stack

- **Backend**: Laravel 12
- **Authentication**: JWT (tymon/jwt-auth) + Laravel Sanctum
- **Database**: MySQL / SQLite
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Testing**: Pest PHP
- **API**: RESTful JSON API

---

## 📊 Database Schema

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

---

## 🚀 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure production database
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Set up SSL certificate
- [ ] Configure CORS for production domain
- [ ] Set up backup strategy

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Author

Created with ❤️ using Laravel 12, JWT, and Sanctum

---

## 🙏 Acknowledgments

- Laravel Framework
- JWT Auth by tymon
- Laravel Sanctum
- All contributors and users

---

## 📞 Support

If you have any questions or issues:

1. Check the [TROUBLESHOOTING.md](TROUBLESHOOTING.md) guide
2. Review the [API_DOCUMENTATION.md](API_DOCUMENTATION.md)
3. Open an issue on GitHub
4. Check the browser console (F12) for errors

---

## ⭐ Star This Repository

If you find this project useful, please consider giving it a star! ⭐

---

**Happy Contact Managing! 🎉**
