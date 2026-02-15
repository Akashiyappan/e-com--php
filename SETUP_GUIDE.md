# Premium E-Commerce Store - Setup Guide

## Project Overview
A fully functional e-commerce store built with Laravel and modern UI. Features a responsive design with shopping cart, checkout, and order confirmation functionality.

## What Was Implemented

### 1. **Database Structure**
- **Products Table**: Stores product information (name, description, price, image URL, quantity)
- **Orders Table**: Stores customer orders (name, email, phone, address, city, zip, total_amount)
- **OrderItems Table**: Stores individual items in each order (product_id, quantity, price)

### 2. **Models**
- **Product Model**: Handles product data with fillable attributes
- **Order Model**: Manages orders with relationship to OrderItems
- **OrderItem Model**: Links orders to products with quantity and pricing

### 3. **Views**
- **shop.blade.php**: Complete e-commerce interface with:
  - Product listing with grid layout
  - Shopping cart modal
  - Checkout form with customer details
  - Order confirmation screen
  - Responsive design for mobile and desktop

### 4. **Controllers**
- **ShopController**: Handles:
  - Displaying products (`index()`)
  - Processing orders (`placeOrder()`)

### 5. **Frontend Features**
- ✅ Add products to cart
- ✅ Adjust quantities (increase/decrease)
- ✅ Remove items from cart
- ✅ Calculate subtotal, tax (10%), and total
- ✅ Checkout form with customer details
- ✅ Order confirmation with details
- ✅ Responsive mobile design
- ✅ Smooth animations and transitions

### 6. **Sample Data**
Database seeded with 6 products:
1. Premium Shoes - $89.99
2. Luxury Watch - $199.99
3. Designer Bag - $149.99
4. Wireless Headphones - $129.99
5. Sunglasses - $79.99
6. Leather Belt - $49.99

## Quick Start

### Prerequisites
- PHP 8.2 or higher
- MySQL Server running locally
- Composer installed
- Node.js & NPM (optional, for frontend assets)

### 1. Prerequisites Setup

#### MySQL Database Creation
Create the database in MySQL:
```bash
mysql -u root
CREATE DATABASE php_project;
EXIT;
```

Or use MySQL Workbench/PhpMyAdmin to create database `php_project`.

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
```

Edit `.env` file and configure MySQL:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=php_project
DB_USERNAME=root
DB_PASSWORD=          # Add your MySQL password if set
```

Generate application key:
```bash
php artisan key:generate
```

### 4. Run Migrations & Seed Database
```bash
php artisan migrate:fresh --seed
```

This will:
- Create users, products, orders, and order_items tables
- Seed 6 sample products
- Create a test user (test@example.com)

### 5. Start Development Server
```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

### Quick Setup Script (Windows)
Double-click `setup.bat` to automatically run all setup steps.

## Usage

### For Customers
1. **Browse Products**: See all available products on the main page
2. **Add to Cart**: Click "Add to Cart" button on any product
3. **View Cart**: Click the cart button in header to see items
4. **Checkout**: Click "Proceed to Checkout"
5. **Fill Details**: Enter customer information
6. **Complete Order**: Confirm and receive order confirmation

### For Developers

#### Adding New Products
```php
php artisan tinker
>>> Product::create([
    'name' => 'Product Name',
    'description' => 'Description',
    'price' => 99.99,
    'image' => 'https://image-url.jpg',
    'quantity' => 50
]);
```

#### Viewing Orders
```php
php artisan tinker
>>> Order::with('items')->latest()->get();
```

## File Structure

```
resources/views/
└── shop.blade.php          # Main e-commerce page

app/Models/
├── Product.php             # Product model
├── Order.php               # Order model
└── OrderItem.php           # Order item model

app/Http/Controllers/
└── ShopController.php      # Shop logic

database/migrations/
├── ...create_products_table.php
├── ...create_orders_table.php
└── ...create_order_items_table.php

database/seeders/
└── DatabaseSeeder.php      # Seeds sample products
```

## Customization

### Change Store Name
Edit in [resources/views/shop.blade.php](resources/views/shop.blade.php) line ~685:
```html
<header>
  <h2>🛍️ Your Store Name</h2>
  ...
</header>
```

### Modify Colors
Edit CSS variables in [resources/views/shop.blade.php](resources/views/shop.blade.php):
```css
:root {
  --primary-color: #6366f1;        /* Main color */
  --secondary-color: #10b981;      /* Buttons */
  --danger-color: #ef4444;         /* Delete button */
}
```

### Change Tax Rate
Edit in [resources/views/shop.blade.php](resources/views/shop.blade.php) JavaScript section:
```javascript
const tax = subtotal * 0.1;  // Change 0.1 to your tax rate
```

## Routes

### Web Routes
| Route | Method | Purpose |
|-------|--------|----------|
| `/` | GET | Display shop with products |
| `/order` | POST | Process order submission |

### API Routes (/api)

#### Products Endpoints
| Endpoint | Method | Purpose |
|----------|--------|----------|
| `/api/products` | GET | Get all products |
| `/api/products/{id}` | GET | Get single product |
| `/api/products` | POST | Create product |
| `/api/products/{id}` | PUT | Update product |
| `/api/products/{id}` | DELETE | Delete product |

#### Orders Endpoints
| Endpoint | Method | Purpose |
|----------|--------|----------|
| `/api/orders` | GET | Get all orders |
| `/api/orders/{id}` | GET | Get single order |
| `/api/orders` | POST | Create new order |
| `/api/orders/{id}` | PUT | Update order |
| `/api/orders/{id}` | DELETE | Delete order |

## API Response Examples

### Get All Products
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Premium Shoes",
      "description": "Comfortable and stylish premium shoes",
      "price": "89.99",
      "image": "https://picsum.photos/250/200?1",
      "quantity": 50,
      "created_at": "2026-02-15T10:30:00.000000Z",
      "updated_at": "2026-02-15T10:30:00.000000Z"
    }
  ],
  "count": 6
}
```

### Create Order
```bash
curl -X POST http://localhost:8000/api/orders \
  -H "Content-Type: application/json" \
  -d '{
    "full_name": "John Doe",
    "email": "john@example.com",
    "phone": "1234567890",
    "address": "123 Main St",
    "city": "New York",
    "zip": "10001",
    "total_amount": 299.98,
    "items": [
      {"product_id": 1, "quantity": 2, "price": 89.99},
      {"product_id": 2, "quantity": 1, "price": 199.99}
    ]
  }'
```

### Post Order Response
```json
{
  "success": true,
  "order_id": 123,
  "message": "Order created successfully",
  "data": {
    "id": 123,
    "full_name": "John Doe",
    "email": "john@example.com",
    "phone": "1234567890",
    "address": "123 Main St",
    "city": "New York",
    "zip": "10001",
    "total_amount": "299.98",
    "created_at": "2026-02-15T10:30:00.000000Z",
    "updated_at": "2026-02-15T10:30:00.000000Z",
    "items": [
      {
        "id": 1,
        "order_id": 123,
        "product_id": 1,
        "quantity": 2,
        "price": "89.99"
      }
    ]
  }
}
```

## Troubleshooting

### Products Not Showing
```bash
php artisan migrate:fresh --seed
```

### Database Errors
Check your SQLite database permissions or switch to MySQL in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

### Session Issues
Clear cache:
```bash
php artisan cache:clear
php artisan view:clear
```

## Features Ready for Enhancement
- Add user authentication/accounts
- Add product search and filtering
- Add product reviews and ratings
- Add payment gateway integration (Stripe, PayPal)
- Add email notifications
- Add order tracking
- Add admin dashboard
- Add inventory management

## Support

For issues or questions, check Laravel documentation at: https://laravel.com/docs
