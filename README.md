# 🛫 Project Airline

This project aims to develop a web-based airline management system using Laravel 11. The system allows administrators to manage flights, airplanes, and reservations while providing users with the ability to book and cancel flights through an intuitive interface.

---
## Overview

The system provides the following functionalities:

- User Authentication & Roles: Users can register and log in with different roles (Admin, User, Guest).
- Flight Management: Admins can create, update, and delete flights with details like date, origin, destination, and assigned airplane.
- Airplane Management: Admins can add and manage airplanes, defining their capacity.
- Reservations: Users can book or cancel flights based on availability. Guests can only view flights but not make reservations.
- Flight Status: Flights are marked as "not available" if they are fully booked or if the departure date has passed.
- Dashboard Views:
  - Users: View available flights, manage their reservations.
  - Admins: See who has booked each flight.

## 🛠️🚀 Tech Stack
### **Languages**:
- HTML
- Blade (Laravel template engine)
- HTML & CSS

### **Frameworks**:
- Laravel 11

### **Server**:
- Apache (XAMPP)
- Node.js

### **Database**:
- MySQL

### **Tools & Others**:
- Composer
- Postman
- Jira
- Figma

## 🔧⚙️ Installation

Follow these steps to install and set up the project:

- Clone the repository

```
https://github.com/Mangel111111111/Project-Airline.git
```
- Install Composer dependencies

```
composer install
```
- Install Node.js dependencies

```
npm install
```
- Duplicate .env.example file and rename to .env
- In this new .env, change the variables you need, but it is very important to uncomment the database connection lines that are these:
 
In DB_CONNECTION will come mysqlite, change it to the bd you use (in this case MySQL)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=airline
DB_USERNAME=root
DB_PASSWORD=
```
 - Generate an App Key with this command 
```
php artisan key:generate 
```

- Execute migrations  
```
php artisan migrate
```

## ▶️💻 Run Locally
- Start the Laravel development server:  
```
php artisan serve
```

- Start the frontend assets in development mode:  
```
npm run dev
```

- For production, build assets:
```
npm run build
```

## 🏃‍♂️🧪 Running Tests

To run tests, update phpunit.xml:

```bash
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

Run tests with coverage report

```bash
  php artisan test --coverage-html=coverage-report
```

If everything is configured correctly, tests should pass, and the coverage report will show `100%` coverage.

#### Test Summary:
![image](https://res.cloudinary.com/del1j3jge/image/upload/v1738676547/Captura_de_pantalla_2025-02-04_143856_cqnalw.png)

#### Coverage Folder:
![image](https://res.cloudinary.com/del1j3jge/image/upload/v1738676547/Captura_de_pantalla_2025-02-04_142701_epe75h.png)

## ✍️🙍 Author
**Miguel Angel García:**  [![GitHub](https://img.shields.io/badge/GitHub-Perfil-black?style=flat-square&logo=github)](https://github.com/Mangel111111111)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Perfil-blue?style=flat-square&logo=linkedin)](www.linkedin.com/in/miguel-garcía-lópez-609136284)
[![Correo](https://img.shields.io/badge/Email-Contacto-red?style=flat-square&logo=gmail)](mailto:miguelg.lopez@outlook.com)
