# 🛒 Simple PHP PDO CRUD + Shopping Cart System

This project is a simple PHP script that demonstrates how to use **PDO (PHP Data Objects)** to interact with a **MySQL** database and perform **CRUD operations** on a `Products` table. It also includes a **basic shopping cart system** implemented using PHP arrays.

## 📌 Features

- ✅ Connect to MySQL using PDO  
- ✅ Create a `Products` table  
- ✅ Insert, update, delete, and fetch products  
- ✅ Add products to a simulated shopping cart  
- ✅ Update cart quantity and remove items  
- ✅ Calculate total with 10% discount if subtotal > ₦20,000  
- ✅ Prevent duplicate product entries  
- ✅ Securely handle input using **prepared statements**

## ⚙️ Technologies Used

- PHP (8.0+ recommended)
- MySQL
- PDO for database interaction

## 🗃️ Folder Structure

project-root/
│
├── database.php # Handles the PDO connection
├── DbFunctions.php # All DB-related functions (Create, Read, Update, Delete)
├── index.php # Main logic for cart and total calculations
└── README.md # You're reading it!


## 🧪 Sample Cart Flow

```php
$cart = addToCart($cart, 1, 2);   // Add 2 Keyboards
$cart = updateCart($cart, 1, 4);  // Update quantity to 4
$cart = removeFromCart($cart, 2); // Remove Mouse from cart
calculateTotal($cart);           // Show summary and apply discount if needed
```


## 🚀 Getting Started
1.Make sure you have PHP and MySQL installed

2.Create a database (e.g., ecommerce)

3.Update the DB credentials in database.php

4.Run the script in your browser or terminal
