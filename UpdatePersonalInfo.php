<?php

$connect = new PDO("mysql:host=localhost;dbname=shopping_cart_db", "root", "root");

 

   $name =  $_POST['name'];
   $email = $_POST['email'];
   $address = $_POST['address'];
   $id = 1;
   $query = "UPDATE users SET user_name = '$name', user_email = '$email', user_address = '$address' WHERE user_id = $id";
  //var_dump($New_name);
   $connect->exec($query);
?>
