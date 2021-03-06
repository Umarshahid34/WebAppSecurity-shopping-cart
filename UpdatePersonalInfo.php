<?php

$connect = new PDO("mysql:host=localhost;dbname=shopping_cart_db", "root", "root");

 if (session_status() == PHP_SESSION_NONE) {
     session_start();
 }

   $name =  $_POST['name'];
   $email = $_POST['email'];
   $address = $_POST['address'];
   $id = $_SESSION['id_user'];
   $query = "UPDATE users SET user_name = :name, user_email = :email, user_address = :address WHERE user_id = :id";
   $stmt = $connect->prepare($query);

   $stmt->bindParam(":name",$name);
   $stmt->bindParam(":email",$email);
   $stmt->bindParam(":address",$address);
   $stmt->bindParam(":id",$id);

   $stmt->execute();
   $_SESSION['paymentMethod'] = $_POST['rate_value'];
?>
