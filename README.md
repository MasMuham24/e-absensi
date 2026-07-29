# Employee Attendance System (HRIS v1.1.0)

A modern Human Resource Information System (HRIS) built with **Laravel 12**, **Blade**, **Tailwind CSS**, and **MySQL**. This application helps companies manage employee data, attendance, leave requests, office locations, and geolocation-based attendance through a secure role-based access system.

---

## 🚀 Latest Release

**Current Version:** **v1.1.0**

### ✨ New Features

- Office Management
- Geolocation Attendance
- Office Radius Configuration
- Haversine Distance Calculation
- Attendance Radius Validation
- Google Maps Coordinate Link
- Store Latitude, Longitude, Accuracy & Distance

---

## 🚀 Features

### Authentication

- Manual Authentication (Without Laravel Breeze)
- Login & Logout
- Session Authentication
- Role-Based Access Control

### Roles

- Admin
- HR
- Employee

---

# 👨‍💼 Admin & HR Features

## Dashboard

- Dashboard Overview
- Employee Statistics
- Attendance Statistics
- Leave Statistics

## Department Management

- Create Department
- Update Department
- Delete Department
- Search Department
- Pagination

## Position Management

- Create Position
- Update Position
- Delete Position
- Search Position
- Pagination

## Employee Management

- Create Employee
- Update Employee
- Delete Employee
- Upload Avatar
- Search Employee
- Pagination

## Office Management

- Office CRUD
- Office Location Configuration
- Office Radius Configuration
- Search Office
- Pagination

## Attendance Management

- View All Attendance Records
- Search Attendance
- Filter by Date
- Filter by Department
- Filter by Status
- Attendance History
- View Employee Coordinates
- View Distance from Office
- View Attendance Location Status
- Open Location in Google Maps

## Leave Request Management

- View Leave Requests
- Approve Leave
- Reject Leave
- Manage Leave Status

## Attendance Report

- Attendance Summary
- Department Filter
- Date Filter
- Attendance Statistics

---

# 👨‍💻 Employee Features

## Dashboard

- Personal Dashboard
- Attendance Summary

## Attendance

- Check In
- Check Out
- One Check-In Validation per Day
- One Check-Out Validation per Day
- Late Attendance Detection
- Attendance History

### Geolocation Attendance

- Browser Geolocation API
- GPS Permission Request
- Automatic Latitude & Longitude Detection
- GPS Accuracy Detection
- Haversine Distance Calculation
- Office Radius Validation
- Attendance Location Recording
- Google Maps Coordinate Link

## Leave Request

- Submit Leave Request
- Submit Sick Leave
- Submit Vacation Leave
- View Request Status
- Leave History

## Profile

- Update Profile
- Change Password
- Update Avatar

---

# 🛠 Tech Stack

- Laravel 12
- PHP 8.2+
- Blade
- Tailwind CSS
- MySQL
- JavaScript Geolocation API
- Eloquent ORM

---

# 📂 Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   ├── Employee/
│   │   └── HR/
│   │
│   └── Requests/
│
├── Models/
├── Middleware/
└── Providers/

resources/
├── views/
│   ├── admin/
│   ├── employee/
│   ├── hr/
│   └── layouts/

routes/
├── web.php
└── console.php
```

---

# ⚙️ Installation

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

# 🗄 Database

Main Tables

- users
- departments
- positions
- offices
- attendances
- leave_requests

---

# 🔐 Default Roles

- Admin
- HR
- Employee

---

# 📍 Geolocation Attendance Workflow

```text
Employee Login
        │
        ▼
Check In
        │
        ▼
Browser Requests GPS Permission
        │
        ▼
Get Latitude, Longitude & Accuracy
        │
        ▼
Calculate Distance (Haversine Formula)
        │
        ▼
Validate Office Radius
        │
        ├── Inside Radius
        │        │
        │        ▼
        │   Attendance Recorded
        │
        └── Outside Radius
                 │
                 ▼
         Attendance Rejected
```

---

# 📈 Business Workflow

```text
Employee Login
        │
        ▼
Check In
        │
        ▼
Attendance Recorded
        │
        ▼
Check Out
        │
        ▼
Attendance History
        │
        ▼
Leave Request Submission
        │
        ▼
Admin/HR Approval
        │
        ▼
Attendance Report
```

---

# 🎯 Learning Objectives

This project demonstrates:

- Manual Authentication
- Role-Based Authorization
- CRUD Operations
- Form Request Validation
- Eloquent Relationships
- File Upload
- Search & Filtering
- Pagination
- Business Workflow Implementation
- Attendance Logic
- Leave Management
- Office Management
- Geolocation API Integration
- Haversine Formula Implementation
- Radius Validation
- Reporting System
- Clean MVC Architecture

---

# 📝 Changelog

## v1.1.0

### Added

- Office Management
- Geolocation Attendance
- Office Radius Configuration
- Haversine Formula
- Radius Validation
- Google Maps Coordinate Link
- GPS Accuracy Recording
- Latitude & Longitude Recording

### Improved

- Attendance Workflow
- Attendance Validation
- Database Structure

---

## v1.0.0

Initial Release

- Authentication
- Employee Management
- Attendance Management
- Leave Management
- Attendance Reporting

---

# 📄 License

This project is intended for educational purposes and portfolio demonstration.

---

# 👤 Author

**Muhammad Syafi'i**

GitHub: https://github.com/MasMuham24
