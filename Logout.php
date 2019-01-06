<?php
    include "views/includes/header.php";

// Initialize the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
    ?>


    <div class="container">
	    <h2> Logout to be done </h2>
	</div>
	</body>
</html>