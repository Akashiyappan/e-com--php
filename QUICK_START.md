# E-Commerce Project - Quick Start Guide

## ✅ What Has Been Set Up

1. **Database Configuration**: MySQL database `php_project` configured in `.env`
2. **Models**: User, Product, Order, OrderItem with relationships
3. **Migrations**: All database tables ready to create
4. **Database Seeding**: 6 sample products + test user configured
5. **Web Routes**: Product display and order placement working
6. **API Routes**: Complete REST API for products and orders
7. **Controllers**: 
   - Web: ShopController (display + checkout)
   - API: ProductController & OrderController (full CRUD)

## 🚀 How to Get Started

### Step 1: Create Database (if not auto-created)
Open Command Prompt or PowerShell and run:
```bash
mysql -u root
CREATE DATABASE php_project;
EXIT;
```

### Step 2: Run Setup Script (Windows)
Double-click the file:
```
setup.bat
```

**OR** manually run these commands:
```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed
```

### Step 3: Start Server
```bash
php artisan serve
```

Your app will be at: **http://localhost:8000**

## 📡 API Endpoints

### Get All Products
```
GET http://localhost:8000/api/products
```

### Get Single Product
```
GET http://localhost:8000/api/products/1
```

### Create New Order
```
POST http://localhost:8000/api/orders
Content-Type: application/json

{
  "full_name": "John Doe",
  "email": "john@example.com",
  "phone": "9876543210",
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
      "product_id": 2,
      "quantity": 1,
      "price": 199.99
    }
  ]
}
```

### Get All Orders
```
GET http://localhost:8000/api/orders
```

### Get Single Order
```
GET http://localhost:8000/api/orders/1
```

## 🛍️ Web Interface

Visit **http://localhost:8000** to use the e-commerce store:
1. Browse products
2. Add items to cart
3. Checkout
4. Review order confirmation

## 📝 Configuration

### Change Database Password
Edit `.env`:
```
DB_PASSWORD=your_mysql_password
```

### Change App URL
Edit `.env`:
```
APP_URL=http://your-domain.com
```

## 🔧 Common Commands

```bash
# View database
php artisan tinker
>>> Product::all();
>>> Order::with('items')->get();

# Fresh start (deletes all data!)
php artisan migrate:fresh --seed

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Create new migration
php artisan make:migration create_table_name

# Create new controller
php artisan make:controller ControllerName
```

## 📁 Project Structure

```
app/
  Http/Controllers/
    ShopController.php          (Web shop logic)
    Api/
      ProductController.php     (API products)
      OrderController.php       (API orders)
  Models/
    Product.php
    Order.php
    OrderItem.php
    User.php

routes/
  web.php                        (Web routes)
  api.php                        (API routes)

database/
  migrations/                    (Table structures)
  seeders/
    DatabaseSeeder.php          (Sample data)

resources/views/
  shop.blade.php               (E-commerce UI)
```

## ✔️ Testing the API

Use any of these tools to test:
- **cURL** (command line)
- **Postman** (GUI)
- **Insomnia** (GUI)
- **Thunder Client** (VS Code extension)

### Test Products API in Postman
1. Create GET request: `http://localhost:8000/api/products`
2. Hit send
3. You should see the 6 sample products

### Test Create Order
1. Create POST request: `http://localhost:8000/api/orders`
2. Set header: `Content-Type: application/json`
3. Copy-paste the order JSON from above section
4. Hit send
5. Should return success with order ID

## 🐛 Troubleshooting

### "Connection refused" error
- Check MySQL is running
- Verify database name is `php_project`

### "SQLSTATE[HY000]" error
- Make sure `.env` DB settings are correct
- Run: `php artisan config:clear`

### "Class not found" error  
- Run: `composer dump-autoload`

### Products not showing up
- Run: `php artisan migrate:fresh --seed`

### Port 8000 in use
- Use different port: `php artisan serve --port=8001`

## 📚 Next Steps

- Add user authentication
- Add payment gateway (Stripe/PayPal)
- Add email notifications
- Add product search/filtering
- Add admin dashboard
- Add inventory management

Enjoy your Laravel e-commerce store! 🎉
