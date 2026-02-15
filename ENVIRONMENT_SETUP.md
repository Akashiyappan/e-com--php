# 🚀 Environment Setup & Verification Guide

## Prerequisites Checklist

Before running your Laravel project, verify you have:

```
✅ PHP 8.2+ installed
✅ MySQL Server installed and running
✅ Composer installed
✅ Git (optional)
✅ Text Editor/IDE (VS Code, PHPStorm, etc.)
```

### Verify Installation

```bash
# Check PHP version (should be 8.2 or higher)
php -v

# Check Composer version
composer -v

# Check MySQL version and test connection
mysql -u root -p -e "SELECT VERSION();"
```

## Step-by-Step Setup Process

### 1. Database Creation

Open Command Prompt/PowerShell and create the database:

```bash
mysql -u root
CREATE DATABASE php_project;
SHOW DATABASES;
EXIT;
```

**OR use MySQL Workbench:**
- Open MySQL Workbench
- Click "Administration" → "Users and Privileges"
- Create new database named `php_project`

### 2. Clone/Extract Project

Navigate to your project directory:
```bash
cd c:\Users\akash\Desktop\college_project\ecommerce
```

### 3. Install PHP Dependencies

```bash
composer install
```

This will install all Laravel packages and dependencies. This step creates the `vendor` folder (~150MB).

### 4. Setup Environment Configuration

Create and configure `.env` file:

```bash
cp .env.example .env
php artisan key:generate
```

Then verify `.env` contains:
```dotenv
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=php_project
DB_USERNAME=root
DB_PASSWORD=
```

If your MySQL has a password, add it:
```dotenv
DB_PASSWORD=your_mysql_password
```

### 5. Create Database Tables

```bash
php artisan migrate:fresh --seed
```

This command will:
- Drop all existing tables (if any)
- Create fresh tables (users, cache, jobs, products, orders, order_items)
- Seed database with test data and 6 sample products

### 6. Verify Setup

Check everything is working:

```bash
# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# List all routes
php artisan route:list
```

### 7. Start Development Server

```bash
php artisan serve
```

You should see:
```
   INFO  Server running on [http://127.0.0.1:8000]
```

### 8. Test in Browser

Visit: **http://localhost:8000**

You should see the e-commerce shop with 6 products.

## API Endpoints Verification

Test each endpoint using cURL or Postman:

### 1. Get All Products
```bash
curl http://localhost:8000/api/products
```

Expected Response:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Premium Shoes",
      "price": "89.99",
      ...
    }
  ],
  "count": 6
}
```

### 2. Get Single Product
```bash
curl http://localhost:8000/api/products/1
```

### 3. Get All Orders
```bash
curl http://localhost:8000/api/orders
```

### 4. Create Order
```bash
curl -X POST http://localhost:8000/api/orders \
  -H "Content-Type: application/json" \
  -d '{
    "full_name": "Test User",
    "email": "test@example.com",
    "phone": "1234567890",
    "address": "123 Test St",
    "city": "Test City",
    "zip": "12345",
    "total_amount": 189.98,
    "items": [
      {"product_id": 1, "quantity": 1, "price": 89.99},
      {"product_id": 2, "quantity": 1, "price": 99.99}
    ]
  }'
```

## Complete File Structure Verification

Verify these files exist:

```
✅ app/Models/
   ├── User.php
   ├── Product.php
   ├── Order.php
   └── OrderItem.php

✅ app/Http/Controllers/
   ├── Controller.php
   ├── ShopController.php
   └── Api/
       ├── ProductController.php
       └── OrderController.php

✅ routes/
   ├── web.php (web routes)
   └── api.php (API routes)

✅ database/migrations/
   ├── 0001_01_01_000000_create_users_table.php
   ├── 0001_01_01_000001_create_cache_table.php
   ├── 0001_01_01_000002_create_jobs_table.php
   ├── 2026_02_15_062750_create_products_table.php
   ├── 2026_02_15_062750_create_orders_table.php
   └── 2026_02_15_062751_create_order_items_table.php

✅ database/seeders/
   └── DatabaseSeeder.php

✅ resources/views/
   └── shop.blade.php

✅ .env (configured for MySQL)
```

## Troubleshooting

### Issue: "SQLSTATE[HY000] [2002] Connection refused"
**Solution:**
1. Check MySQL is running
2. Verify MySQL connection: `mysql -u root`
3. Verify `.env` DB credentials

### Issue: "Target class [App\Http\Controllers\Api\ProductController] does not exist"
**Solution:**
```bash
composer dump-autoload
php artisan route:clear
```

### Issue: "No such file or directory" when running migrations
**Solution:**
```bash
php artisan migrate:fresh --seed --force
```

### Issue: "Table already exists"
**Solution:**
```bash
# Drop all tables and start fresh
php artisan migrate:fresh --seed

# Or manually drop database
mysql -u root -e "DROP DATABASE php_project; CREATE DATABASE php_project;"
php artisan migrate:fresh --seed
```

### Issue: Port 8000 already in use
**Solution:**
```bash
# Use different port
php artisan serve --port=8001

# Or find what's using port 8000
netstat -ano | findstr :8000
taskkill /PID <PID> /F
```

### Issue: "Class 'PDO' not found"
**Solution:**
- Make sure PHP has PDO extension enabled
- Check php.ini has `extension=pdo_mysql`

## Database Tables Structure

### users
```sql
id (Primary Key)
name
email (unique)
password
email_verified_at
remember_token
created_at
updated_at
```

### products
```sql
id (Primary Key)
name
description
price
image
quantity
created_at
updated_at
```

### orders
```sql
id (Primary Key)
full_name
email
phone
address
city
zip
total_amount
created_at
updated_at
```

### order_items
```sql
id (Primary Key)
order_id (Foreign Key)
product_id (Foreign Key)
quantity
price
created_at
updated_at
```

## Sample Data After Seeding

### Products Seeded:
1. Premium Shoes - $89.99
2. Luxury Watch - $199.99
3. Designer Bag - $149.99
4. Wireless Headphones - $129.99
5. Sunglasses - $79.99
6. Leather Belt - $49.99

### Test User Seeded:
```
Email: test@example.com
Name: Test User
```

## Useful Commands

```bash
# Start server
php artisan serve

# View database contents
php artisan tinker
>>> Product::all();
>>> Order::with('items')->get();
>>> User::all();
>>> exit

# Refresh database (destroys all data!)
php artisan migrate:fresh --seed

# Generate migration
php artisan make:migration create_table_name

# Generate controller
php artisan make:controller Api/YourController

# Generate model with migration
php artisan make:model YourModel -m

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# View all routes
php artisan route:list

# Test specific route
php artisan route:list --name=products
```

## Environment Variables Reference

```dotenv
# App Settings
APP_NAME=Laravel              # Application name
APP_ENV=local                # Environment (local, production)
APP_DEBUG=true               # Enable debug mode
APP_URL=http://localhost     # Application URL

# Database Settings
DB_CONNECTION=mysql          # Database type
DB_HOST=127.0.0.1           # Database host
DB_PORT=3306                # MySQL port
DB_DATABASE=php_project     # Database name
DB_USERNAME=root            # Database user
DB_PASSWORD=                # Database password

# Session Settings
SESSION_DRIVER=database      # Store sessions in database
SESSION_LIFETIME=120        # 2 hours expiration
```

## Next Steps After Setup

1. **Test the web interface**: Visit http://localhost:8000
2. **Test the API**: Use Postman/cURL to test endpoints
3. **Add more products**: Use api POST to /api/products
4. **Place test orders**: Use api POST to /api/orders
5. **View orders**: GET /api/orders to see all orders
6. **Customize**: Edit SETUP_GUIDE.md for project details

## Support & Resources

- Laravel Documentation: https://laravel.com/docs
- MySQL Documentation: https://dev.mysql.com/doc/
- Eloquent ORM: https://laravel.com/docs/eloquent
- API Development: https://laravel.com/docs/routing#api-routes

---

**Setup completed!** Your Laravel e-commerce project is ready to use. 🎉
