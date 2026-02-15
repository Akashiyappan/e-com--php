# Laravel E-Commerce Store - MySQL Edition

A complete, production-ready Laravel e-commerce application with REST API, shopping cart, and order management system.

## ✨ Features

- ✅ **Product Catalog**: Display and manage products
- ✅ **Shopping Cart**: Add/remove items, calculate totals with tax
- ✅ **Checkout System**: Customer details + order placement
- ✅ **Order Management**: Track orders and items
- ✅ **REST API**: Full CRUD operations for products and orders
- ✅ **Database**: MySQL with proper relationships
- ✅ **Responsive Design**: Works on desktop and mobile
- ✅ **Sample Data**: Pre-configured 6 products + test user

## 🏗️ Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Database**: MySQL 5.7+
- **Frontend**: Blade Templates + Vanilla JavaScript
- **API**: RESTful API with JSON responses
- **Authentication**: Laravel Sanctum (optional)

## 📋 Quick Start

### 1. Prerequisites
- PHP 8.2 or higher
- MySQL Server
- Composer

### 2. Setup
```bash
# Install dependencies
composer install

# Configure environment
cp .env.example .env

# Edit .env - set database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=php_project
DB_USERNAME=root
DB_PASSWORD=

# Generate app key
php artisan key:generate

# Create database tables and seed data
php artisan migrate:fresh --seed
```

### 3. Run
```bash
php artisan serve
```

Visit: **http://localhost:8000**

## 📁 Project Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── ShopController.php          # Web shop logic
│       └── Api/
│           ├── ProductController.php   # Product API (CRUD)
│           └── OrderController.php     # Order API (CRUD)
├── Models/
│   ├── User.php
│   ├── Product.php
│   ├── Order.php
│   └── OrderItem.php

routes/
├── web.php                  # Web routes
└── api.php                  # API routes

database/
├── migrations/              # Table structures
└── seeders/                 # Sample data

resources/
└── views/
    └── shop.blade.php       # E-commerce UI
```

## 🔌 API Documentation

### Base URL
```
http://localhost:8000/api
```

### Products Endpoints

#### Get All Products
```
GET /products
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Premium Shoes",
      "description": "Comfortable and stylish",
      "price": "89.99",
      "image": "https://picsum.photos/250/200?1",
      "quantity": 50,
      "created_at": "2026-02-15T10:30:00Z",
      "updated_at": "2026-02-15T10:30:00Z"
    }
  ],
  "count": 6
}
```

#### Get Single Product
```
GET /products/{id}
```

#### Create Product
```
POST /products
Content-Type: application/json

{
  "name": "Product Name",
  "description": "Product description",
  "price": 99.99,
  "image": "https://image-url.jpg",
  "quantity": 50
}
```

#### Update Product
```
PUT /products/{id}
Content-Type: application/json

{
  "name": "Updated Name",
  "price": 89.99,
  "quantity": 40
}
```

#### Delete Product
```
DELETE /products/{id}
```

### Orders Endpoints

#### Get All Orders
```
GET /orders
```

#### Get Single Order
```
GET /orders/{id}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "full_name": "John Doe",
    "email": "john@example.com",
    "phone": "1234567890",
    "address": "123 Main St",
    "city": "New York",
    "zip": "10001",
    "total_amount": "299.98",
    "created_at": "2026-02-15T10:30:00Z",
    "updated_at": "2026-02-15T10:30:00Z",
    "items": [
      {
        "id": 1,
        "product_id": 1,
        "quantity": 2,
        "price": "89.99",
        "product": {
          "id": 1,
          "name": "Premium Shoes",
          "price": "89.99"
        }
      }
    ]
  }
}
```

#### Create Order
```
POST /orders
Content-Type: application/json

{
  "full_name": "John Doe",
  "email": "john@example.com",
  "phone": "1234567890",
  "address": "123 Main Street",
  "city": "New York",
  "zip": "10001",
  "total_amount": 299.98,
  "items": [
    {
      "product_id": 1,
      "quantity": 2,
      "price": 89.99
    },
    {
      "product_id": 3,
      "quantity": 1,
      "price": 149.99
    }
  ]
}
```

**Response:**
```json
{
  "success": true,
  "message": "Order created successfully",
  "data": { ... order details ... }
}
```

#### Update Order
```
PUT /orders/{id}
Content-Type: application/json

{
  "full_name": "Updated Name",
  "email": "newemail@example.com"
}
```

#### Delete Order
```
DELETE /orders/{id}
```

## 📊 Database Schema

### Users Table
```sql
CREATE TABLE users (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  email_verified_at TIMESTAMP NULL,
  remember_token VARCHAR(255),
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
```

### Products Table
```sql
CREATE TABLE products (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  description TEXT NULL,
  price DECIMAL(10,2),
  image VARCHAR(255) NULL,
  quantity INT DEFAULT 0,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
```

### Orders Table
```sql
CREATE TABLE orders (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  full_name VARCHAR(255),
  email VARCHAR(255),
  phone VARCHAR(255),
  address VARCHAR(255),
  city VARCHAR(255),
  zip VARCHAR(255),
  total_amount DECIMAL(10,2),
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
```

### Order Items Table
```sql
CREATE TABLE order_items (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  order_id BIGINT UNSIGNED,
  product_id BIGINT UNSIGNED,
  quantity INT,
  price DECIMAL(10,2),
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id)
);
```

## 🗄️ Sample Data

### Products (6 pre-configured)
1. **Premium Shoes** - $89.99 (50 qty)
2. **Luxury Watch** - $199.99 (30 qty)
3. **Designer Bag** - $149.99 (25 qty)
4. **Wireless Headphones** - $129.99 (40 qty)
5. **Sunglasses** - $79.99 (60 qty)
6. **Leather Belt** - $49.99 (80 qty)

### Test User
```
Email: test@example.com
Name: Test User
```

## 🔧 Configuration

### Environment Variables (.env)
```dotenv
# Application
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=php_project
DB_USERNAME=root
DB_PASSWORD=

# Cache
CACHE_STORE=database
CACHE_PREFIX=ecommerce_

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

### Modify Store Name
Edit `.env`:
```dotenv
APP_NAME="My Store Name"
```

### Change Database Credentials
Edit `.env`:
```dotenv
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## 🚀 Common Commands

```bash
# Start development server
php artisan serve

# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Fresh start (WARNING: deletes all data)
php artisan migrate:fresh --seed

# Interactive shell
php artisan tinker
>>> Product::all();
>>> Order::with('items')->get();

# List all routes
php artisan route:list

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## 🧪 Testing API

### Using cURL

Get products:
```bash
curl http://localhost:8000/api/products
```

Create order:
```bash
curl -X POST http://localhost:8000/api/orders \
  -H "Content-Type: application/json" \
  -d '{"full_name":"Test","email":"test@test.com",...}'
```

### Using Postman
1. Import the API endpoints
2. Set request headers: `Content-Type: application/json`
3. Test each endpoint

### Using Thunder Client (VS Code)
VS Code → Thunder Client extension → Create requests

## 📚 Documentation Files

- **QUICK_START.md** - Quick setup guide
- **ENVIRONMENT_SETUP.md** - Detailed environment setup
- **SETUP_GUIDE.md** - Original setup guide with features
- **README.md** - This file

## 🐛 Troubleshooting

### Database Connection Error
```bash
# Check MySQL is running
mysql -u root

# Verify .env credentials
# Make sure database exists
mysql -u root -e "CREATE DATABASE php_project;"
```

### Class not found error
```bash
composer dump-autoload
php artisan route:clear
```

### Port 8000 in use
```bash
php artisan serve --port=8001
```

### Reset database
```bash
php artisan migrate:fresh --seed
```

See **ENVIRONMENT_SETUP.md** for more troubleshooting.

## 🎯 Next Steps

- Add user authentication
- Implement payment gateway (Stripe, PayPal)
- Add email notifications
- Create admin dashboard
- Add product reviews and ratings
- Implement search and filtering
- Add wishlist feature
- Mobile app integration

## 📝 License

MIT License - See LICENSE file

## 👨‍💻 Author

Laravel E-Commerce Store
Created for college project

## 📞 Support

For issues or questions:
1. Check ENVIRONMENT_SETUP.md
2. Check Laravel documentation: https://laravel.com/docs
3. Check MySQL documentation: https://dev.mysql.com/doc/

---

**Status**: ✅ Ready for use  
**Database**: MySQL  
**PHP Version**: 8.2+  
**Laravel Version**: 12.0  

Happy coding! 🚀
