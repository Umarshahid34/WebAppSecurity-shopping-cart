<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_id, user_name, user_password FROM users WHERE user_name = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    echo"User found";
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            echo "Password found";
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["logged_in"] = true;
                            $_SESSION["id_user"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }else{
            echo "No statement can be prepared";

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}else{
echo "Username and password not validated";}}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="css/Signup.css">
		<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

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
                        <li class="nav-item active">
                          <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Contact</a>
                        </li>
                      </ul>
                    </div>
                  </div>
    </nav>
	</head>
	<body style="padding-top: 70px";>
	 <div class="container" style="max-width: 900px;">
         <div class="main">

                <section class="signup">
                    <!-- <img src="images/signup-bg.jpg" alt=""> -->
                    <div class="container">
                        <div class="signup-content">



                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="signup-form" class="signup-form">
                                <h2 class="form-title">Login Here</h2>
                                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"">
                                    <input type="text" class="form-input" name="username" id="username" placeholder="Your Email" value="<?php echo $username; ?>"/>
                                <span class="help-block"><?php echo $username_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <input type="text" class="form-input" name="password" id="password" placeholder="Password"/>
                                    <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                                </div>
                            </form>
                            <p class="loginhere">
                                Dont have an account ? Create Now <a href="Register.php?" class="loginhere-link">Sign Up here</a>
                            </p>
                        </div>
                    </div>
                </section>

            </div>
	</div>
    <script src="js/password_toggle.js"></script>
	</body>
</html>