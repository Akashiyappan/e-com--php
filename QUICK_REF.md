# 🚀 QUICK REFERENCE CARD

## 🎯 5-Minute Setup

```bash
# 1. Create database
mysql -u root -e "CREATE DATABASE php_project;"

# 2. Install dependencies
composer install

# 3. Setup Laravel
php artisan key:generate

# 4. Create tables & seed data
php artisan migrate:fresh --seed

# 5. Start server
php artisan serve

# 6. Open browser
# Visit: http://localhost:8000
```

---

## 📡 API Endpoints Quick Reference

### Products
```
GET    /api/products                Get all
GET    /api/products/1              Get one
POST   /api/products                Create
PUT    /api/products/1              Update
DELETE /api/products/1              Delete
```

### Orders
```
GET    /api/orders                  Get all
GET    /api/orders/1                Get one
POST   /api/orders                  Create
PUT    /api/orders/1                Update
DELETE /api/orders/1                Delete
```

### Test With cURL
```bash
# Get all products
curl http://localhost:8000/api/products

# Create order
curl -X POST http://localhost:8000/api/orders \
  -H "Content-Type: application/json" \
  -d '{"full_name":"John","email":"john@test.com",...}'
```

---

## 🗄️ Database Info

| Property | Value |
|----------|-------|
| Host | 127.0.0.1 |
| Port | 3306 |
| Database | php_project |
| Username | root |
| Password | (empty) |

---

## 📦 Sample Products

1. Premium Shoes - $89.99
2. Luxury Watch - $199.99
3. Designer Bag - $149.99
4. Wireless Headphones - $129.99
5. Sunglasses - $79.99
6. Leather Belt - $49.99

---

## 🔧 Essential Commands

```bash
# View database
php artisan tinker
>>> Product::all();
>>> Order::all();
>>> exit

# Fresh start
php artisan migrate:fresh --seed

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Stop server
CTRL + C
```

---

## 📂 Important Files

| File | Purpose |
|------|---------|
| .env | Configuration |
| app/Models/ | Database models |
| app/Http/Controllers/ | Logic for web/API |
| routes/web.php | Web routes |
| routes/api.php | API routes |
| database/migrations/ | Table schemas |
| database/seeders/ | Sample data |

---

## 🆘 Quick Fixes

```bash
# Connection refused
mysql -u root  # Check MySQL running

# Class not found
composer dump-autoload

# Port 8000 busy
php artisan serve --port=8001

# Clear everything
php artisan migrate:fresh --seed
```

---

## ✨ What You Can Access

| URL | What |
|-----|------|
| http://localhost:8000 | E-commerce store |
| http://localhost:8000/api/products | All products |
| http://localhost:8000/api/orders | All orders |

---

## 📚 Documentation Files

- QUICK_START.md - Quick guide
- ENVIRONMENT_SETUP.md - Detailed steps
- SETUP_GUIDE.md - Features explained
- README_SETUP.md - Full reference
- NEXT_STEPS.md - Getting started
- VERIFICATION_CHECKLIST.md - Verify setup
- SETUP_COMPLETE.md - Comprehensive summary

---

## ✅ Status

✅ MySQL Configured  
✅ All Controllers Created  
✅ All Routes Set Up  
✅ Database Models Ready  
✅ Sample Data Prepared  
✅ Documentation Complete  
✅ Ready to Run  

---

**Start Here:** Run the 5-minute setup above!
