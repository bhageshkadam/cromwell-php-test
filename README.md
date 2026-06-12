# Cromwell PHP Test Application

## Overview

This is a lightweight PHP application developed for the Cromwell Tools PHP Test.

The application provides:

* User Registration
* User Login
* User Profile Update
* Session-Based Authentication
* REST API Endpoints
* PostgreSQL Database Integration

The application is developed using Core PHP without any framework.

---

## Technology Stack

* PHP 8.x
* PostgreSQL
* Apache (XAMPP)
* Bootstrap 5
* JavaScript (Fetch API)
* HTML5
* CSS3

---

## Project Structure

```text
cromwell-php-test/

├── api/
│   ├── login.php
│   └── user.php
│
├── config/
│   └── config.php
│
├── database/
│   └── database.sql
│
├── includes/
│   ├── db.php
│   ├── functions.php
│   └── validation.php
│
├── user/
│   ├── registration.php
│   ├── login.php
│   ├── dashboard.php
│   ├── edit.php
│   └── logout.php
│
├── README.md
└── index.php
```

---

## Installation Steps

### 1. Clone Repository

```bash
git clone https://github.com/bhageshkadam/cromwell-php-test.git
```

Or download the ZIP file and place the project inside:

```text
C:\xampp\htdocs\
```

---

### 2. Create Database

Open pgAdmin and execute:

```sql
CREATE DATABASE cromwell_db;
```

---

### 3. Create Users Table

Execute:

```sql
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    forenames VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    title VARCHAR(20),
    dob DATE,
    mobile_phone VARCHAR(20),
    other_phone VARCHAR(20),
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

### 4. Configure Database

Update the file:

```text
config/config.php
```

```php
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'chromwell_db1');
define('DB_USER', 'postgres');
define('DB_PASS', 'your_password');
```

---

### 5. Enable PostgreSQL Extension

Open:

```text
xampp/php/php.ini
```

Enable:

```ini
extension=pdo_pgsql
extension=pgsql
```

Restart Apache.

---

## Application URLs

### Registration Page

```text
http://localhost/cromwell-php-test/user/registration.php
```

### Login Page

```text
http://localhost/cromwell-php-test/user/login.php
```

### Dashboard

```text
http://localhost/cromwell-php-test/user/dashboard.php
```

### Edit Profile

```text
http://localhost/cromwell-php-test/user/edit.php
```

---

## REST API Endpoints

### Register User

```http
POST /api/user.php
```

### Login User

```http
POST /api/login.php
```

### Get User Details

```http
GET /api/user.php
```

### Update User Details

```http
PUT /api/user.php
```

---

## Security Features

* Password Hashing using `password_hash()`
* Password Verification using `password_verify()`
* Prepared Statements
* Session Authentication
* Protected Dashboard Access
* Input Validation
* Duplicate Email Validation

---

## Features Implemented

### Required Features

* User Registration
* User Login
* REST API Layer
* PostgreSQL Integration
* Form Validation

### Bonus Features

* Edit User Profile
* Session-Based Authentication
* Logout Functionality
* Protected Dashboard
* AJAX-Based Forms

---

## Author

**Bhagesh Vitthal Kadam**

Software Developer
