# Laravel RESTful API - Billing System

This is a RESTful API built Billing System for VPS

## Architecture
- MVC (Model-View-Controller) — Laravel's default structure to separate business logic, presentation, and data handling.

- Service Pattern — Encapsulates business logic into dedicated service classes for better maintainability and testability.

- Request Validation (Default Directory) — Uses Laravel's App\Http\Requests for input validation to keep controllers clean and robust.

## Features & Requiement
- Login
- Logout
- Pelanggan harus memiliki saldo yang cukup untuk membuat VPS.
- Billing dari layanan VPS dimulai tepat setelah layanan VPS berhasil dibuat.
- Komponen dasar dari VPS terdiri atas CPU, RAM dan Storage.
- Dilakukan pengecekan setiap jam untuk menghitung uptime dari VPS 
- Dilakukan pengecekan rutin terhadap total biaya layanan bulan ini dan saldo yang tersisa saat ini untuk memastikan saldo masih cukup
- Apabila sisa saldo saat ini < (kurang dari) 10% total biaya layanan, pelanggan akan dikirimkan notifikasi bahwa saldo akan segera habis
- Apabila saldo minus, pelanggan akan di-suspend.


## Tech Stack

- PHP 8.x
- Laravel 9.x
- Mysql
- Composer

## ⚙️ Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/umars28/billing-system.git
   cd billing-system

2. Install dependencies
    ```bash
    composer install
3. Copy .env file
    ```bash
    cp .env.example .env
4. Configure environment variables
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=yourdatabase
    DB_USERNAME=yourmysqlusername
    DB_PASSWORD=yourmysqlpassword

    Set up email services for send notification amount of saldo

5. Generate application key
    ```bash
    php artisan key:generate
6. Run database migrations
    ```bash
    php artisan migrate
7. Run seeder
    ```bash
    php artisan db:seed
8. Serve the application
    ```bash
    php artisan serve
9. Test and Run API
    ```bash
    Run API based on route endpoint URL or can import file Maxcloud.postman_collection.json on root folder inside postman or other tools.

## ⚙️ API

### 📋 Default User Data Dummy

| id | name         | email             | email_verified_at | balance | password                                                     | remember_token | created_at          | updated_at          |
|----|--------------|-------------------|--------------------|---------|--------------------------------------------------------------|----------------|----------------------|----------------------|
| 1  | Admin User   | admin@example.com | NULL               | 0.00    | password123                                                 | NULL           | 2025-05-27 03:03:20  | 2025-05-27 03:03:20  |
| 2  | User Biasa   | user1@example.com | NULL               | 0.00    | userpass1                                                | NULL           | 2025-05-27 03:03:20  | 2025-05-27 03:03:20  |
| 3  | User Premium | user2@example.com | NULL               | 0.00    | userpass2                                                | NULL           | 2025-05-27 03:03:20  | 2025-05-27 03:03:20  |

### 📋 Default VPS Package Data Dummy
| id | name     | cpu | ram  | storage | price_per_hour | created_at          | updated_at          |
|----|----------|-----|------|---------|----------------|---------------------|---------------------|
| 1  | Basic    | 1   | 512  | 20      | 1000.00        | 2025-05-27 03:03:19 | 2025-05-27 03:03:19 |
| 2  | Standard | 4   | 2048 | 100     | 3000.00        | 2025-05-27 03:03:19 | 2025-05-27 03:03:19 |
| 3  | Premium  | 8   | 8192 | 500     | 6000.00        | 2025-05-27 03:03:19 | 2025-05-27 03:03:19 |


#### 1. Login  
**POST** `api/login`

**Description:**  
Authenticate a user and retrieve an access token to authorize future requests.

**Request Headers:**
- `Content-Type: application/json`

**Request Body Example:**
```json
{
  "email": "umar@gmail.com",
  "password": "password"
}
```

**Response Success Example:**
```json
{
    "access_token": "2|NQMVJBcL3MtjciENdEFNxQJcxvSrrmpSFUBEcuOAc37f60c0",
    "token_type": "Bearer"
}
```

#### 2. Logout
**POST** `api/logout`

**Description:**  
Logout for invalid token.

**Request Headers:**
- `Content-Type: application/json`
- `Authorization: Bearer {access_token}`

**Response Success Example:**
```json
{
    "message": "Logout berhasil"
}
```

#### 3. List VPS Package  
**GET** `api/vps-packages`

**Description:**  
Retrieve a list of VPS package

**Request Headers:**
- `Content-Type: application/json`
- `Authorization: Bearer {access_token}`

**Response Success Example:**
```json
[
    {
        "id": 1,
        "name": "Basic",
        "cpu": 1,
        "ram": 512,
        "storage": 20,
        "price_per_hour": "1000.00",
        "created_at": "2025-05-27T03:03:19.000000Z",
        "updated_at": "2025-05-27T03:03:19.000000Z"
    },
    {
        "id": 2,
        "name": "Standard",
        "cpu": 4,
        "ram": 2048,
        "storage": 100,
        "price_per_hour": "3000.00",
        "created_at": "2025-05-27T03:03:19.000000Z",
        "updated_at": "2025-05-27T03:03:19.000000Z"
    },
    {
        "id": 3,
        "name": "Premium",
        "cpu": 8,
        "ram": 8192,
        "storage": 500,
        "price_per_hour": "6000.00",
        "created_at": "2025-05-27T03:03:19.000000Z",
        "updated_at": "2025-05-27T03:03:19.000000Z"
    }
]
```

#### 4. Create VPS Instance  
**POST** `api/vps`

**Description:**  
Create VPS instance

**Request Headers:**
- `Content-Type: application/json`
- `Authorization: Bearer {access_token}`

**Request Body Example:**
```json
{
  "package_id": 2,
  "name": "Standar",
  "cpu": 4,
  "ram": 2048,
  "storage": 100 
}
```

**Response Success Example:**
```json
{
    "message": "VPS berhasil dibuat",
    "data": {
        "user_id": 1,
        "package_id": 3,
        "name": "Standar",
        "cpu": 8,
        "ram": 8192,
        "storage": 500,
        "started_at": "2025-05-27T03:12:04.384012Z",
        "updated_at": "2025-05-27T03:12:04.000000Z",
        "created_at": "2025-05-27T03:12:04.000000Z",
        "id": 2
    }
}
```

#### 5. List VPS Instance  
**GET** `api/vps`

**Description:**  
Retrieve a list of VPS Instance

**Request Headers:**
- `Content-Type: application/json`
- `Authorization: Bearer {access_token}`

**Response Success Example:**
```json
[
    {
        "id": 1,
        "user_id": 1,
        "package_id": 2,
        "name": "Standar",
        "cpu": 4,
        "ram": 2048,
        "storage": 100,
        "started_at": "2025-05-27 03:11:56",
        "suspended_at": null,
        "is_suspended": 0,
        "created_at": "2025-05-27T03:11:56.000000Z",
        "updated_at": "2025-05-27T03:11:56.000000Z",
        "usages": [
            {
                "id": 1,
                "vps_instance_id": 1,
                "billed_at": "2025-05-27 03:11:56",
                "cost": "3000.00",
                "created_at": "2025-05-27T03:11:56.000000Z",
                "updated_at": "2025-05-27T03:11:56.000000Z"
            }
        ],
        "package": {
            "id": 2,
            "name": "Standard",
            "cpu": 4,
            "ram": 2048,
            "storage": 100,
            "price_per_hour": "3000.00",
            "created_at": "2025-05-27T03:03:19.000000Z",
            "updated_at": "2025-05-27T03:03:19.000000Z"
        }
    },
    {
        "id": 2,
        "user_id": 1,
        "package_id": 3,
        "name": "Standar",
        "cpu": 8,
        "ram": 8192,
        "storage": 500,
        "started_at": "2025-05-27 03:12:04",
        "suspended_at": null,
        "is_suspended": 0,
        "created_at": "2025-05-27T03:12:04.000000Z",
        "updated_at": "2025-05-27T03:12:04.000000Z",
        "usages": [
            {
                "id": 2,
                "vps_instance_id": 2,
                "billed_at": "2025-05-27 03:12:04",
                "cost": "6000.00",
                "created_at": "2025-05-27T03:12:04.000000Z",
                "updated_at": "2025-05-27T03:12:04.000000Z"
            }
        ],
        "package": {
            "id": 3,
            "name": "Premium",
            "cpu": 8,
            "ram": 8192,
            "storage": 500,
            "price_per_hour": "6000.00",
            "created_at": "2025-05-27T03:03:19.000000Z",
            "updated_at": "2025-05-27T03:03:19.000000Z"
        }
    }
]
```

#### 6. Top Up Wallet  
**POST** `api/wallet/topup`

**Description:**  
Top up Wallet for create instance VPS

**Request Headers:**
- `Content-Type: application/json`
- `Authorization: Bearer {access_token}`

**Request Body Example:**
```json
{
  "amount": 60000,
  "description": "Top up wallet"
}
```

**Response Success Example:**
```json
{
    "message": "Topup berhasil",
    "balance": "75000.00"
}
```