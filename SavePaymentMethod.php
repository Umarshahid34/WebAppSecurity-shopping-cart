<?php

$connect = new PDO("mysql:host=localhost;dbname=shopping_cart_db", "root", "root");

 if (session_status() == PHP_SESSION_NONE) {
     session_start();
 }

   $_SESSION['paymentMethod'] = $_POST['rate_value'];



?>