<?php
    $connect = new PDO("mysql:host=localhost;dbname=shopping_cart_db", "root", "root");

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_GET["action"]))
    {
        if($_GET["action"] == "logout")
        {
            $id = (int)$_SESSION['id_user'];
            $query = "UPDATE cookie SET logged_In = '0' WHERE id_user = $id";
             $connect->exec($query);
             $_SESSION['logged_in'] = null;
             $_SESSION['id_user'] = null;
             $_SESSION['username'] = null;

             session_unset();
             header("location:index.php");


         }
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart</title>

        <link rel="stylesheet" href="css/CheckOut.css">
        <link rel="stylesheet" href="css/Signup.css">

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>

        <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

        <script src="http://code.jquery.com/jquery-latest.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <div class="container">
            <a class="navbar-brand" href="#">Shopping Cart</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="cart-box" id="Normal">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                              <button href="#" class="draggable dropdown-toggle btn btn-primary btn-circle btn-xl" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"></span></button>
                               <span  class="cart-items-count"><span class=" notification-counter">243</span></span>
                            </li>
                          </ul>
                    </div>
                </li>
                <?php
                    if(isset($_SESSION['id_user'])) {
                ?>
                <li class="nav-item" style="padding-top: 6px;"">
                  <font size="4"> <a class="nav-link"> <?php echo $_SESSION['username']; ?> </a> </font>
                </li>
                <?php
                    }
                ?>
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home
                    <span class="sr-only">(current)</span>
                  </a>
                </li>

                <?php
                    if(isset($_SESSION['id_user'])) {
                ?>
                 <li class="nav-item">
                  <a class="nav-link" href="?action=logout">LogOut</a>
                </li>
                <?php
                    }else {
                ?>
                <li class="nav-item">
                  <a class="nav-link" href="Login.php">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="Register.php">Register</a>
                </li>
                <?php
                    }
                ?>
                <li class="nav-item">
                  <a class="nav-link" href="order.php">Your Orders</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
		<br />
    </head>
    <body style="padding-top: 70px; background-attachment: fixed; background-position: center; " background="images/signup-images/signup-bg.jpg">