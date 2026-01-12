# 📡 Raw PHP API - Customers CRUD

A simple, no-framework **REST-style API** built with raw PHP and a PSR-4 autoloader.  
Provides full **CRUD** operations for managing **customers** - Create, Read, Update, Delete - backed by a **relational database** (MySQL, MariaDB, etc.).

This is perfect if you want a lightweight API example without Laravel, Symfony, or other frameworks getting in the way.

---

## ✨ Features

- 🧩 Built with **raw PHP** (no frameworks)
- 🔁 Full **CRUD** for customer resources:
  - Create a new customer
  - Get one or all customers
  - Update customer data
  - Delete a customer
- 📦 PSR-4 autoloading via Composer
- 💡 Easy to understand and extend

---

## 📀 Quick Demo

📌 This API responds with JSON and uses standard HTTP verbs (**GET, POST, PUT, DELETE**).  
You can test it with **Postman**, **curl**, or your favorite HTTP client.

---

## 🛠️ Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/DarlanSchmeller/raw-php-api.git
cd raw-php-api
```


### 2. Install dependencies
```bash
composer install
```


This sets up the PSR-4 autoloader and any packages you might add later.

### 3. Create & configure your database
- Create a database (e.g., raw_php_api)
- Create a customers table with fields like (id, name, email, …)
- Copy .env.example to .env
- Update DB settings:
    ```ini
    DB_HOST=127.0.0.1
    DB_NAME=raw_php_api
    DB_USER=root
    DB_PASS=secret
    ```

### 4. Run the API

If you’re using PHP’s built-in server:
```bash
php -S localhost:8000
```

Point your client to `http://localhost:8000/`

## 🔗 API Endpoints

| Method  | Endpoint             | Description                     |
|--------|----------------------|---------------------------------|
| GET    | `/customers`         | List all customers              |
| GET    | `/customers/{id}`    | Get a single customer by ID     |
| POST   | `/customers`         | Create a new customer           |
| PUT    | `/customers/{id}`    | Update a customer               |
| DELETE | `/customers/{id}`    | Delete a customer               |


> Typical REST conventions - use JSON bodies and headers when creating/updating.

## 🔧 Request Examples

### Create customer
```bash
curl -X POST http://localhost:8000/customers \
  -H "Content-Type: application/json" \
  -d '{"name":"Alice","email":"alice@example.com"}'
```

### Get all customers
```bash
curl http://localhost:8000/customers
```

### Update a customer
```bash
curl -X PUT http://localhost:8000/customers/5 \
  -H "Content-Type: application/json" \
  -d '{"email":"new@example.com"}'
```

### Delete a customer
```bash
curl -X DELETE http://localhost:8000/customers/5
```

## 📁 Project Structure
```text
├── app/             # Core application code
├── bootstrap.php    # Bootstraps autoloading & config
├── index.php        # Router / entry point
├── routes.php       # API route definitions
├── composer.json    # PSR-4 autoload configuration
└── .env.example     # Database & environment template
```