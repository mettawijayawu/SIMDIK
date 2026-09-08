# 🎓 SIMDIK — Educational Management & Institutional Data System

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

**SIMDIK** (*Sistem Informasi Manajemen Pendidikan*) is a web-based management information system designed to centralize, streamline, and manage educational administrative and operational data efficiently.

This project was developed as an **Undergraduate Thesis / Capstone Project** utilizing the **Agile Scrum** software development methodology.

---

## 📌 Key Features

- 🔐 **Authentication & Role-Based Access Control (RBAC)**: Multi-user access tailored with specific permissions for Administrators, Staff, and Educators/Students.
- 📊 **Executive Dashboard**: Real-time visualization and statistical overview of key institutional metrics.
- 📂 **Centralized Data Management**: Comprehensive management of master data, including personnel records, institutional archives, and educational data.
- 📑 **Reporting & Data Export**: Flexible report generation and data export for operational audits and record-keeping.
- ⚙️ **System Configurations**: Dynamic settings for institutional profiles and application preferences.

---

## 🛠️ Tech Stack

- **Back-End**: PHP (Laravel Framework)
- **Front-End**: HTML5, CSS3, JavaScript, Bootstrap / Blade Templating
- **Database**: MySQL
- **Web Server**: Apache / Nginx
- **Tools & Environment**: Composer, Git, VS Code

---

## 🚀 Installation & Local Setup

Follow these steps to set up and run the project in your local development environment:

### 1. System Requirements
Ensure you have the following installed on your machine:
- PHP >= 8.x
- Composer
- MySQL Database Server (e.g., via XAMPP or Laragon)
- Git

### 2. Clone the Repository
`git clone [https://github.com/mettawijayawu/SIMDIK.git](https://github.com/mettawijayawu/SIMDIK.git)`
`cd SIMDIK`

### 3. Install PHP Dependencies
`composer install`

### 4. Configure Environment (.env)
Duplicate the `.env.example` file to create a `.env` file:
`cp .env.example .env`

Open `.env` and set up your local database configuration:
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=simdik_db
- DB_USERNAME=root
- DB_PASSWORD=

### 5. Generate Application Key
`php artisan key:generate`

### 6. Run Database Migrations & Seeders
Execute database migrations and populate seed data (if applicable):
`php artisan migrate --seed`

### 7. Start the Development Server
`php artisan serve`

Access the application in your browser at: `[http://127.0.0.1:8000](http://127.0.0.1:8000)`

---

## 👨‍💻 Author

- **Metta Wijaya Wu** - *Lead Developer* - [@mettawijayawu](https://github.com/mettawijayawu)

---

## 📜 License

This project was created for academic purposes (Undergraduate Thesis Project).