<?php

require "database.php";

/**
 * This file is used to store the function that will be used by the user 
 * while working with the database you wil find funtions like create,update and delete
 * you know the basic db stuffs this is just the begining stages tho let's see how it goes
*/

function Index(){
    global $pdo;

    $Products = $pdo->prepare("SELECT * FROM PRODUCTS");
    $Products->execute();
   return  $Products->fetchAll();

}

function CreateProduct(String $name,float|int $price, Int $stock){
    global $pdo;
    try{

        $checkStmt= $pdo->prepare("SELECT COUNT(*) FROM PRODUCTS WHERE Name = :name");
        
        $checkStmt->execute([":name" => $name]);

        if($checkStmt->fetchColumn()){
            return "{$name} has been inserted into the database before would you like to update instead";
        }
        
        $stmt= $pdo->prepare("INSERT INTO PRODUCTS (Name, Price, Stock) values(:name, :price, :stock)");

        if($stmt->execute([
            ":name" => $name,
            ":price" => $price,
            ":stock" => $stock
        ])){
            return "{$name} has been successfully added into the database";
        }
    }catch(PDOException $e){
        return "Something went wrong: {$e->getMessage()}";
    }
    
}

function ShowProduct(Int $Id){
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM PRODUCTS WHERE Id = :Id");
    $stmt->execute([":Id" => $Id]);
    $Product= $stmt->fetch();

   if(!$Product){
    return "Product with Id {$Id} not found";
   }

   return $Product;
}


function UpdateProduct(Int $Id ,String $name,float|int $price, Int $stock){
    global $pdo;

    try{
        $stmt = $pdo->prepare("
            UPDATE PRODUCTS
            SET Name= :name , Price= :price, stock = :stock
            WHERE Id= :Id
        ");
        $stmt->execute([
            ":Id" => $Id,
            ":name" => $name,
            ":price" => $price,
            ":stock" => $stock
        ]);

        return "Product updated successfully";

    }catch(PDOException $e){
        return "Something went wrong: {$e->getMessage()}";
        
    }
}


function DeleteProduct(Int $Id){
    global $pdo;

    try{
        $stmt = $pdo->prepare("DELETE FROM PRODUCTS WHERE Id = :Id");
        $stmt->execute([
            ":Id" => $Id
        ]);

        return "Product deleted successfully";
    }catch(PDOException $e){
        return "Something went wrong: {$e->getMessage()}";

    }
}


function printArr($data){
    echo "<pre>";
     print_r($data);
    echo "</pre>";
}

