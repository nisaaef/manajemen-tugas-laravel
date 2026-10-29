# Employee Task Management (Laravel)

A web-based admin system for managing employee data and task assignment status. Built with **Laravel**, with two user access levels: **Admin** and **Employee**.

## 📋 Description

This application helps companies monitor whether each employee has been assigned to a specific job or task. Admins have full control over employee data and assignment status, while employees can view information related to their own tasks.

## ✨ Features

- **Employee Data Management** — add, view, edit, and delete employee records.
- **Assignment Status** — mark whether an employee has been assigned to a task or not.
- **Role-Based Access Control**:
  - **Admin**: full access — can view and modify all data, including making changes when assignment status is updated.
  - **Employee**: limited access — can view data and assignment status relevant to themselves.
- **User Authentication** — separate login system for Admin and Employee.

## 🛠️ Tech Stack

- **Backend**: Laravel (PHP)
- **Database**: MySQL
- **Frontend**: Blade Templating, (add Tailwind/Bootstrap if used)

## 🚀 Installation & Running Locally

```bash
# Clone the repository
git clone https://github.com/annisaaef24/manajemen-tugas-laravel.git
cd manajemen-tugas-laravel

# Install PHP dependencies
composer install

# Copy the environment file
cp .env.example .env

# Generate the application key
php artisan key:generate

# Set the database connection in .env, then run the migrations
php artisan migrate

# (Optional) seed initial data
php artisan db:seed

# Install frontend dependencies (if using Vite/NPM)
npm install
npm run dev

# Start the local server
php artisan serve
```

The application can be accessed at `http://127.0.0.1:8000`.

## 👥 User Roles

| Role     | Access                                                                                          |
|----------|--------------------------------------------------------------------------------------------------|
| Admin    | Manage all employee data and assignment status, and can modify data whenever needed              |
| Employee | View their own data and assignment status                                                        |

## 📸 Capture

<img width="1366" height="2672" alt="screencapture-manajemen-tugas-test-2026-10-29-15_30_55" src="https://github.com/user-attachments/assets/740c3ebc-c26b-4f75-af03-ea2124e8a56c" />

Admin Dashboard
<img width="1366" height="641" alt="screencapture-manajemen-tugas-test-dashboard-2026-10-29-15_31_50" src="https://github.com/user-attachments/assets/5febd9f9-3b62-4d02-8abf-1cb2fd64a969" />


Employee Dashboard
<img width="1366" height="641" alt="screencapture-manajemen-tugas-test-dashboard-2026-10-29-15_32_25" src="https://github.com/user-attachments/assets/c2e14e81-747b-4da4-9c36-3e4e232b03ee" />


## 📄 License

This project was created for learning and portfolio purposes.
