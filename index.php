<?php

declare(strict_types=1);
require "DbFunctions.php";

$productData = [
    ['id' => 1, 'name' => 'Keyboard', 'price' => 8000, 'stock' => 10],
    ['id' => 2, 'name' => 'Mouse', 'price' => 2500, 'stock' => 10],
    ['id' => 3, 'name' => 'Printer', 'price' => 5500, 'stock' => 20],
    ['id' => 4, 'name' => 'Printer', 'price' => 5500, 'stock' => 20],
];

foreach($productData as $product){
    CreateProduct($product['name'], $product['price'], $product['stock']);
}


$products = Index();
$cart = [];

function addToCart(array $cart, int $productId, int $quantity): array
{
    global $products;

    foreach ($cart as $item) {
        if ($item['Id'] === $productId) {
            echo "Product already in cart." ."<br>";
            return $cart;
        }
    }

    foreach ($products as &$product) {
        if ($product['Id'] === $productId) {

            if ($quantity <= 0) {
                echo "Quantity must be more than 0"."<br>";
                return $cart;
            }

            if ($product['Stock'] < $quantity) {
                echo "Not enough stock for {$product['Name']}"."<br>";
                return $cart;
            }

            $product['quantity'] = $quantity;
            $cart[] = $product;

            echo "Added '{$product['Name']}' x{$quantity} to cart" ."<br>";
            break;
        }
    }
    return $cart;
}


function calculateTotal(array $cart): void
{
    $subtotal = 0;
    
    $discount = 0;

    echo "<br>"."CART SUMMARY" ."<br>"."<br>";
    echo "----------------------" . "<br>";

    foreach ($cart as $product) {
        $price = $product['Price'];
        $quantity = $product['quantity'];
        $lineTotal = $price * $quantity;
        $subtotal += $lineTotal;
        echo "{$product['Name']} x{$quantity} = ₦" . number_format($lineTotal) . "<br>";
    }

    if ($subtotal > 20000) {
        $discount = $subtotal * 0.10;
    }

    $finalTotal = $subtotal - $discount;

    echo "<br>"."Subtotal: ₦" . number_format($subtotal) . "<br>";
    echo "<br>"."Discount: " . ($discount > 0 ? '10%' : '0%') . "<br>";
    echo "<br>"."Final Total: ₦" . number_format($finalTotal) . "<br>";
}


function removeFromCart($cart, $productId){
   foreach($cart as $index => $product){
        if($productId === $product['Id']){
            unset($cart[$index]);
            echo "{$product['Name']} has been removed from the cart successfully.<br>";
            break;
        }
   }
   return $cart;
}

function updateCart($cart, $productId, $quantity){
    global $products;

    foreach($cart as $Index=>$Cproduct){
        foreach($products as $product)
        if($Cproduct['Id'] === $productId){
            if($quantity <= $product['Stock']){
                $cart[$Index]['quantity'] = $quantity;

                echo "{$Cproduct['Name']} Quantity Has been updated Succesfully.<br>";
            }else{
                echo "Not enough {$Cproduct['Name']} in stock.<br>"; 
            }
            break;
        }
    }

    return $cart;
}



$cart = addToCart($cart, 1, 2); // Add 2 Keyboards
$cart = addToCart($cart, 2, 1); // Add 1 Mouse
$cart = addToCart($cart, 3, 2); // Add 2 Monitors

$cart = updateCart($cart, 1, 4); // Update Keyboard to 4
$cart = removeFromCart($cart, 2); // Remove Mouse

calculateTotal($cart);
