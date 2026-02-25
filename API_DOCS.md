# Kiosk API Documentation

This API provides endpoints to manage products and orders in the Kiosk system. All requests and responses use **JSON**.

## Base URL
`http://localhost/KioskAPI/api`

---

## 📦 Products API
*Manage the menu and product catalog.*

### 1. List All Products
- **URL:** `/products/list`
- **Method:** `GET`
- **Response:** 200 OK with `{"records": [...]}`

### 2. Get Single Product
- **URL:** `/products/read?id={id}`
- **Method:** `GET`
- **Response:** 200 OK with product details.

### 3. Create Product
- **URL:** `/products/create`
- **Method:** `POST`
- **Body:** `{"name": "...", "price": 10.00, "category_id": 1}`

### 4. Update Product
- **URL:** `/products/update`
- **Method:** `POST`
- **Body:** `{"id": 1, "name": "New Name"}`

### 5. Delete Product
- **URL:** `/products/delete`
- **Method:** `POST`
- **Body:** `{"id": 1}`

---

## 🧾 Orders API
*Handle customer orders and transactions.*

### 1. Place Order
Creates a new order and links multiple products.
- **URL:** `/orders/create`
- **Method:** `POST`
- **Body:**
```json
{
    "price_total": 13.00,
    "items": [
        {"product_id": 1, "price": 7.50},
        {"product_id": 4, "price": 5.50}
    ]
}
```
- **Response:** 201 Created with `order_id` and `pickup_number`.

### 2. List Orders
Fetch all orders with their included items.
- **URL:** `/orders/list`
- **Method:** `GET`
- **Response:** 200 OK with a list of orders.

---

## Technical Notes
- **Clean URLs:** PHP extensions are hidden (e.g., use `/api/products/list` not `/api/products/list.php`).
- **Atomicity:** Placing an order uses DB transactions to ensure items are only saved if the order is successful.
- **Headers:** Set `Content-Type: application/json` for POST requests.
