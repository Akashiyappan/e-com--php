# ✅ SETUP VERIFICATION CHECKLIST

Use this checklist to verify everything is properly configured.

## Pre-Requisites

- [ ] PHP 8.2+ installed
  ```bash
  php -v
  ```

- [ ] MySQL Server installed and running
  ```bash
  mysql -u root -e "SELECT VERSION();"
  ```

- [ ] Composer installed
  ```bash
  composer -v
  ```

## Configuration Files

- [ ] `.env` file exists
  ```bash
  ls .env
  ```

- [ ] `.env` has MySQL configuration
  ```
  ✓ DB_CONNECTION=mysql
  ✓ DB_HOST=127.0.0.1
  ✓ DB_PORT=3306
  ✓ DB_DATABASE=php_project
  ✓ DB_USERNAME=root
  ```

- [ ] `.env.example` exists (backup)

- [ ] `app.php` configuration exists

## Vendors & Dependencies

- [ ] `vendor` folder exists
  ```bash
  ls vendor
  ```

- [ ] `composer.json` configured
  - [ ] Laravel 12 dependency
  - [ ] Laravel Tinker included
  - [ ] PHPUnit test framework included

## File Structure

### Controllers
- [ ] `app/Http/Controllers/Controller.php` exists
- [ ] `app/Http/Controllers/ShopController.php` exists
- [ ] `app/Http/Controllers/Api/ProductController.php` exists
- [ ] `app/Http/Controllers/Api/OrderController.php` exists

### Models
- [ ] `app/Models/User.php` exists with fillable attributes
- [ ] `app/Models/Product.php` exists with relationships
- [ ] `app/Models/Order.php` exists with hasMany relationship
- [ ] `app/Models/OrderItem.php` exists with belongsTo relationships

### Routes
- [ ] `routes/web.php` has:
  - [ ] `GET /` → ShopController@index
  - [ ] `POST /order` → ShopController@placeOrder

- [ ] `routes/api.php` has:
  - [ ] Products CRUD routes
  - [ ] Orders CRUD routes

### Migrations
- [ ] `database/migrations/0001_01_01_000000_create_users_table.php`
- [ ] `database/migrations/0001_01_01_000001_create_cache_table.php`
- [ ] `database/migrations/0001_01_01_000002_create_jobs_table.php`
- [ ] `database/migrations/2026_02_15_062750_create_products_table.php`
- [ ] `database/migrations/2026_02_15_062750_create_orders_table.php`
- [ ] `database/migrations/2026_02_15_062751_create_order_items_table.php`

### Seeders
- [ ] `database/seeders/DatabaseSeeder.php` contains:
  - [ ] Test user creation
  - [ ] 6 sample products

### Views
- [ ] `resources/views/shop.blade.php` exists

## Database

- [ ] MySQL database `php_project` created
  ```bash
  mysql -u root -e "SHOW DATABASES;" | grep php_project
  ```

- [ ] Database connection working
  ```bash
  php artisan migrate --dry-run
  ```

- [ ] All tables created
  ```sql
  USE php_project;
  SHOW TABLES;
  -- Should show: users, cache, jobs, products, orders, order_items
  ```

- [ ] Sample data seeded
  ```sql
  SELECT COUNT(*) FROM products;  -- Should be 6
  SELECT COUNT(*) FROM users;     -- Should be 1
  ```

## Laravel Setup

- [ ] Application key generated
  ```bash
  grep APP_KEY .env | grep -v "^#"
  ```

- [ ] Configuration cache cleared
  ```bash
  php artisan config:clear
  ```

- [ ] Routes cache cleared
  ```bash
  php artisan route:clear
  ```

- [ ] Cache cleared
  ```bash
  php artisan cache:clear
  ```

## Routes

- [ ] List all routes successfully
  ```bash
  php artisan route:list
  ```

- [ ] Web routes visible:
  - [ ] GET / → ShopController@index
  - [ ] POST /order → ShopController@placeOrder

- [ ] API routes visible:
  - [ ] GET /api/products
  - [ ] GET /api/products/{id}
  - [ ] POST /api/products
  - [ ] PUT /api/products/{id}
  - [ ] DELETE /api/products/{id}
  - [ ] GET /api/orders
  - [ ] GET /api/orders/{id}
  - [ ] POST /api/orders
  - [ ] PUT /api/orders/{id}
  - [ ] DELETE /api/orders/{id}

## Server & Connection

- [ ] Development server starts
  ```bash
  php artisan serve
  ```
  ✓ Shows "Server running on [http://127.0.0.1:8000]"

- [ ] Web interface accessible
  ```bash
  curl http://localhost:8000
  ```
  ✓ Returns HTML content

- [ ] API accessible
  ```bash
  curl http://localhost:8000/api/products
  ```
  ✓ Returns JSON response

## API Testing

### Products Endpoint
- [ ] GET /api/products returns 6 products
  ```bash
  curl http://localhost:8000/api/products | grep -o '"id"' | wc -l
  # Should show 6 or more
  ```

- [ ] GET /api/products/1 returns single product
  ```bash
  curl http://localhost:8000/api/products/1
  ```

- [ ] POST /api/products creates product (if created successfully)

- [ ] PUT /api/products/{id} updates product

- [ ] DELETE /api/products/{id} deletes product

### Orders Endpoint
- [ ] GET /api/orders returns all orders
  ```bash
  curl http://localhost:8000/api/orders
  ```

- [ ] GET /api/orders/{id} returns single order

- [ ] POST /api/orders creates new order
  ```bash
  curl -X POST http://localhost:8000/api/orders \
    -H "Content-Type: application/json" \
    -d '{"full_name":"Test","email":"test@test.com",...}'
  ```

- [ ] PUT /api/orders/{id} updates order

- [ ] DELETE /api/orders/{id} deletes order

## Sample Data Verification

- [ ] 6 Products in database
  ```bash
  mysql -u root -e "SELECT COUNT(*) FROM php_project.products;"
  # Should show 6
  ```

- [ ] Product names exist
  ```bash
  mysql -u root php_project -e "SELECT name FROM products;"
  ```
  Should show:
  - [ ] Premium Shoes
  - [ ] Luxury Watch
  - [ ] Designer Bag
  - [ ] Wireless Headphones
  - [ ] Sunglasses
  - [ ] Leather Belt

- [ ] Test user exists
  ```bash
  mysql -u root php_project -e "SELECT * FROM users WHERE email='test@example.com';"
  ```

## Documentation

- [ ] README.md (original)
- [ ] QUICK_START.md (quick reference)
- [ ] ENVIRONMENT_SETUP.md (detailed setup)
- [ ] SETUP_GUIDE.md (enhanced with features)
- [ ] README_SETUP.md (complete reference)
- [ ] NEXT_STEPS.md (getting started)
- [ ] setup.bat (Windows setup script)

## Performance & Optimization

- [ ] Migrations run successfully
  ```bash
  php artisan migrate:status
  ```
  All migrations should show "Ran"

- [ ] No errors in routes
  ```bash
  php artisan route:list 2>&1 | grep -i error
  # Should return nothing
  ```

- [ ] No configuration errors
  ```bash
  php artisan config:show 2>&1 | grep -i error
  # Should return nothing
  ```

## Troubleshooting Checklist

If something isn't working:

- [ ] MySQL is running
  ```bash
  mysql -u root
  SHOW DATABASES;
  EXIT;
  ```

- [ ] Database exists: `php_project`
  ```bash
  mysql -u root -e "CREATE DATABASE IF NOT EXISTS php_project;"
  ```

- [ ] Can connect to database from Laravel
  ```bash
  php artisan migrate:status
  ```

- [ ] All dependencies installed
  ```bash
  composer install
  composer dump-autoload
  ```

- [ ] Clear all caches
  ```bash
  php artisan cache:clear
  php artisan config:clear
  php artisan route:clear
  ```

- [ ] Fresh database
  ```bash
  php artisan migrate:fresh --seed
  ```

- [ ] Correct PHP version (8.2+)
  ```bash
  php -v
  ```

## Final Verification Command

Run this single command to verify everything:
```bash
php artisan tinker
>>> Product::count();
>>> Order::count();
>>> User::count();
>>> exit
```

Expected output:
```
= 6
= 0 (or more if orders created)
= 1
```

---

## ✅ COMPLETE SETUP VERIFICATION

If all checkboxes are checked, your project is ready!

### Status
- [ ] All files exist
- [ ] All routes working
- [ ] Database connected
- [ ] Sample data loaded
- [ ] API responding
- [ ] Web interface working

### Ready to Go? 🚀
```bash
php artisan serve
# Visit http://localhost:8000
```

---

**Checklist Created**: 2026-02-15  
**Project**: Laravel E-Commerce  
**Database**: MySQL  
**Status**: Ready for Production ✅
