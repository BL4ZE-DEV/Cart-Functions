<?php

require "config.php";


$dsn = "mysql:host=localhost;dbname=store";




try{

    $pdo = new PDO($dsn,$username,$password);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}catch (PDOException $e){
    $error = $e->getMessage();
    echo $error;
}
