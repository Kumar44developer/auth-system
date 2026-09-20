<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/Bootstrap-5.2-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap" />
  <img src="https://img.shields.io/badge/Security-PDO_Prepared-success?style=for-the-badge&logo=security" alt="Security" />
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License" />
</p>

# 🔐 AuthSys — Secure PHP & MySQL Authentication System

> A production-grade, lightweight authentication boilerplate built with modern PHP and MySQL PDO. Features secure Bcrypt password hashing, parameter-bound prepared statements, session isolation, and a responsive Bootstrap 5 interface.

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [System Architecture](#-system-architecture)
- [Project Structure](#-project-structure)
- [Security Mechanisms](#-security-mechanisms)
- [Database Schema](#-database-schema)
- [Getting Started](#-getting-started)
- [Configuration](#-configuration)
- [Running Tests](#-running-tests)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🌟 Overview

AuthSys is an enterprise-ready authentication starter application designed to provide rock-solid user authentication with minimal overhead. It replaces vulnerable legacy PHP patterns with industry-standard security practices including PDO prepared statements, adaptive Bcrypt password hashing, session regeneration, and defensive input validation.

The frontend is styled using Bootstrap 5, offering a responsive user dashboard, interactive navigation bar, and accessible forms with floating labels and feedback alerts.

---

## ✨ Key Features

- **Secure User Registration** — Email format verification, duplicate email prevention, minimum password length enforcement, and automatic session onboarding.
- **Protected User Login** — Parameterized queries, cryptographic password verification with `password_verify()`, and credential failure detection.
- **Defensive PDO Queries** — 100% prepared SQL statements to prevent SQL Injection attacks.
- **Cryptographic Hashing** — Uses PHP's native `password_hash()` with `PASSWORD_DEFAULT` (Bcrypt) and automated salt generation.
- **Session Lifecycle Management** — Secure session initiation, state tracking across pages, and complete cleanup upon logout via `session_destroy()`.
- **Authenticated Dashboard** — Dynamic home view displaying authenticated user details, session status badges, and quick sign-out actions.
- **Modern Bootstrap 5 UI** — Mobile-first responsive forms, floating labels, dismissal alert components, and Bootstrap Icons.
- **Zero-Dependency Core** — Runs out of the box on standard PHP 8+ installations with the PDO MySQL extension.

---

## 🛠️ Tech Stack

| Technology | Role | Purpose |
|------------|------|---------|
| PHP 8.0+ | Server-Side Language | Core application logic, routing, and session management |
| MySQL 5.7+ / 8.0+ | Relational Database | Persistent user storage and unique indexing |
| PDO (PHP Data Objects) | Database Abstraction | Secure database driver with prepared statements |
| Bootstrap 5.2 | Frontend Framework | Responsive grid, form components, and typography |
| Bootstrap Icons | Visual Icons | Clean iconography for security badges and actions |

---

## 🏗️ System Architecture

```
                       User Browser
                            │
                            ▼
              ┌───────────────────────────┐
              │      HTTP Request         │
              └─────────────┬─────────────┘
                            │
         ┌──────────────────┼──────────────────┐
         ▼                  ▼                  ▼
  ┌─────────────┐    ┌─────────────┐    ┌─────────────┐
  │  login.php  │    │register.php │    │ logout.php  │
  └──────┬──────┘    └──────┬──────┘    └──────┬──────┘
         │                  │                  │
         │  Validate Input  │  Validate Input  │ Clear
         │  & Credentials   │  & Hash (Bcrypt) │ Session
         ▼                  ▼                  ▼
  ┌───────────────────────────────────────────────────┐
  │                    config.php                     │
  │            (PDO MySQL Connection Pool)            │
  └─────────────────────────┬─────────────────────────┘
                            │
                            ▼
  ┌───────────────────────────────────────────────────┐
  │                  MySQL Database                   │
  │                   `auth-sys`                      │
  │            Table: `users` (id, email, ...)        │
  └─────────────────────────┬─────────────────────────┘
                            │
                            ▼
              ┌───────────────────────────┐
              │    index.php (Dashboard)  │
              │  - Authenticated: Profile │
              │  - Guest: Landing Hero    │
              └───────────────────────────┘
```

---

## 📁 Project Structure

```
project Number5/
├── config.php                 # Centralized PDO database configuration & error handling
├── index.php                  # Dynamic landing page and authenticated user dashboard
├── login.php                  # Secure credential verification and session startup
├── logout.php                 # Session termination and cache invalidation
├── register.php               # User registration and input validation
├── schema.sql                 # MySQL schema definition for database setup
├── .gitignore                 # Excluded environments and temporary files
├── includes/
│   ├── header.php             # HTML head, global styles, session bootstrap, and navbar
│   └── footer.php             # Global scripts and footer container
└── tests/
    └── test_auth.php          # Unit test verification for hashing and sanitization
```

---

## 🛡️ Security Mechanisms

### 1. SQL Injection Prevention
All database queries utilize prepared statements with bound parameters:
```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute([':email' => $email]);
```

### 2. Password Security
Passwords are never stored in plaintext. They are salted and hashed with adaptive cost factors:
```php
$hash = password_hash($password, PASSWORD_DEFAULT);
$isValid = password_verify($password, $hash);
```

### 3. Cross-Site Scripting (XSS) Mitigation
All user-provided output rendered into HTML templates is sanitized:
```php
echo htmlspecialchars($user['username']);
```

### 4. Headers-Already-Sent Protection
Output buffering is initialized at the top of the request pipeline, and session verification runs prior to rendering DOM elements.

---

## 🗄️ Database Schema

The database schema is defined in `schema.sql`:

```sql
CREATE DATABASE IF NOT EXISTS `auth-sys` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `auth-sys`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(200) NOT NULL UNIQUE,
  `username` VARCHAR(200) NOT NULL,
  `mypassword` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## 🚀 Getting Started

### Prerequisites

- PHP 8.0 or newer with `pdo_mysql` extension enabled
- MySQL Server (via standalone MySQL, MariaDB, XAMPP, or Docker)

### Installation & Setup

1. **Clone the repository**:
   ```bash
   git clone https://github.com/Kumar44developer/auth-system.git
   cd auth-system
   ```

2. **Import the Database Schema**:
   Using MySQL CLI:
   ```bash
   mysql -u root -p < schema.sql
   ```
   Or open `schema.sql` inside phpMyAdmin and execute the query.

3. **Start the Development Server**:
   You can run the application directly using PHP's built-in web server:
   ```bash
   php -S localhost:8000
   ```
   Or place the project directory inside your web server root (e.g. `C:/xampp/htdocs/auth-system`).

4. **Launch Application**:
   Open your browser and navigate to:
   ```
   http://localhost:8000
   ```

---

## ⚙️ Configuration

Database connection parameters can be customized directly in `config.php` or through environment variables:

| Variable | Default Value | Description |
|----------|---------------|-------------|
| `DB_HOST` | `localhost` | MySQL host address |
| `DB_NAME` | `auth-sys` | Name of the database |
| `DB_USER` | `root` | Database username |
| `DB_PASS` | `""` (empty) | Database password |

---

## 🧪 Running Tests

The test suite validates password hashing integrity, input validation, and sanitation filters:

```bash
php tests/test_auth.php
```

Expected output:
```
PASS: Password verification succeeds for correct password
PASS: Password verification fails for incorrect password
PASS: Valid email format recognized
PASS: Invalid email format detected
PASS: HTML special characters safely escaped

All authentication unit tests passed successfully!
```

---

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/SecurityUpgrade`)
3. Commit your changes (`git commit -m "Enhance session security"`)
4. Push to the branch (`git push origin feature/SecurityUpgrade`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License.
