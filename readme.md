# 🥗 Kiosk API & Frontend

A premium, healthy food self-service kiosk system. This project features a robust PHP-based RESTful API for managing products and orders, paired with a modern, dynamic frontend for customer interaction.

## 🚀 Features

- **RESTful API**: Manage products, categories, and orders with standard JSON responses.
- **Dynamic Menu**: A high-end frontend that fetches real-time data from the API.
- **Image Integration**: Automatic association of product images with unique identifiers.
- **Clean URLs**: Server-side routing for professional-looking API endpoints.
- **Responsive Design**: Optimized for large kiosk screens and mobile devices.

## 🛠️ Tech Stack

- **Backend**: PHP 8.x
- **Database**: MySQL / MariaDB
- **Frontend**: HTML5, CSS3 (Glassmorphism), Vanilla JavaScript
- **Server**: Apache (via XAMPP)

## 📦 Installation

### 1. Prerequisite
- Ensure you have [XAMPP](https://www.apachefriends.org/) installed.
- Clone this repository into your `htdocs` folder: `C:\xampp\htdocs\KioskAPI`.

### 2. Database Setup
1. Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Create a new database (e.g., `kiosk_db`).
3. Configure your connection in `api/config/database.php`.
4. Import the following SQL files in order:
   - `sql/databasev1.sql` (Schema and basic data)
   - `sql/insertproducts_v1.sql` (Main product catalog)
   - `sql/insert_images.sql` (Product image mappings)

### 3. Image Assets
Ensure the images are present in `assets/images/`. These images were automatically downloaded and UID-named to match the database entries.

### 4. Running the Application
- Start **Apache** and **MySQL** in the XAMPP Control Panel.
- Access the Customer Menu: `http://localhost/KioskAPI/index.html`
- Access the API Documentation: [API_DOCS.md](./API_DOCS.md)

## 📖 API Documentation

Detailed documentation for all endpoints (Products, Orders) can be found in `API_DOCS.md`.

### Quick Example Endpoints:
- `GET /api/products/list` - Fetch all available products.
- `POST /api/orders/create` - Place a new customer order.

## 🎨 Design Philosophy
The frontend uses a modern **Glassmorphism** aesthetic with vibrant food imagery to encourage interaction and provide a premium user experience.

---
*Developed as part of the Kiosk Infrastructure project.*
