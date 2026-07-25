# Employee Attendance System

A modern Employee Attendance Management System built with **Laravel 12**, **Blade**, **Tailwind CSS**, and **MySQL**. This application helps companies manage employee attendance, leave requests, and attendance reports through a role-based access system.

---

## 📸 Preview

> Add screenshots of the application here.

* Login Page
* Admin Dashboard
* HR Dashboard
* Employee Dashboard
* Attendance Management
* Leave Request
* Attendance Report

---

## 🚀 Features

### Authentication

* Manual Authentication (Without Laravel Breeze)
* Login & Logout
* Session Authentication
* Role-based Access Control

### Roles

* Admin
* HR
* Employee

---

## 👨‍💼 Admin & HR Features

### Dashboard

* Dashboard Overview
* Employee Statistics
* Attendance Statistics
* Leave Statistics

### Department Management

* Create Department
* Update Department
* Delete Department
* Search Department
* Pagination

### Position Management

* Create Position
* Update Position
* Delete Position
* Search Position
* Pagination

### Employee Management

* Create Employee
* Update Employee
* Delete Employee
* Upload Avatar
* Search Employee
* Pagination

### Attendance Management

* View All Attendance Records
* Search Attendance
* Filter by Date
* Filter by Department
* Filter by Status
* Attendance History

### Leave Request Management

* View Leave Requests
* Approve Leave
* Reject Leave
* Manage Leave Status

### Attendance Report

* Attendance Summary
* Department Filter
* Date Filter
* Attendance Statistics

---

## 👨‍💻 Employee Features

### Dashboard

* Personal Dashboard
* Attendance Summary

### Attendance

* Check In
* Check Out
* One Check-In Validation per Day
* One Check-Out Validation per Day
* Late Attendance Detection
* Attendance History

### Leave Request

* Submit Leave Request
* Submit Sick Leave
* Submit Vacation Leave
* View Request Status
* Leave History

### Profile

* Update Profile
* Change Password
* Update Avatar

---

## 🛠 Tech Stack

* Laravel 12
* PHP 8.2+
* Blade
* Tailwind CSS
* MySQL
* Eloquent ORM

---

## 📂 Project Structure

```text
app/
├── Http/
│   └── Controllers/
│       ├── Admin/
│       └── Employee/
├── Models/
├── Middleware/
└── Providers/

resources/
├── views/
│   ├── admin/
│   ├── employee/
│   └── layouts/

routes/
├── web.php
└── console.php
```

---

## ⚙️ Installation

Clone the repository.

```bash
git clone https://github.com/MasMuham24/e-absensi.git
```

Move into the project directory.

```bash
cd e-absensi
```

Install dependencies.

```bash
composer install
```

Copy the environment file.

```bash
cp .env.example .env
```

Generate the application key.

```bash
php artisan key:generate
```

Configure your database in the `.env` file.

Run the migrations and seeders.

```bash
php artisan migrate --seed
```

Create the storage link.

```bash
php artisan storage:link
```

Start the development server.

```bash
php artisan serve
```

---

## 🗄 Database

Main Tables

* users
* departments
* positions
* attendances
* leave_requests

---

## 🔐 Default Roles

* Admin
* HR
* Employee

---

## 📈 Business Workflow

Employee Login

↓

Check In

↓

Attendance Recorded

↓

Check Out

↓

Attendance History

↓

Leave Request Submission

↓

Admin/HR Approval

↓

Attendance Report

---

## 🎯 Learning Objectives

This project demonstrates:

* Manual Authentication
* Role-Based Authorization
* CRUD Operations
* Eloquent Relationships
* File Upload
* Search & Filtering
* Pagination
* Business Workflow Implementation
* Attendance Logic
* Leave Management
* Reporting System
* Clean MVC Architecture

---

## 📄 License

This project is intended for educational purposes and portfolio demonstration.

---

## 👤 Author

**Muhammad Syafi'i**

GitHub: https://github.com/MasMuham24
