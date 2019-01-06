<?php
// Include config file

$connect = new PDO("mysql:host=localhost;dbname=shopping_cart_db", "root", "root");
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Define variables and initialize with empty values
$name = $username = $email = $address = $password = $confirm_password = "";
$name_err =$username_err = $email_err = $address_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    // Validate username
    if (empty(trim($_POST["username"]))) {
        //var_dump($_POST);
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT user_id FROM users WHERE user_name = :username";
        $statement = $connect->prepare($sql);


        // Bind variables to the prepared statement as parameters

        $statement->bindParam(":username", $param_username);

        // Set parameters
        $param_username = trim($_POST["username"]);

        // Attempt to execute the prepared statement
        $statement->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
              // Check if username exists, if yes then verify password
        if($row['num'] > 0) {
            $username_err = "This username is already taken.";
        } else {
            $username = trim($_POST["username"]);
        }

    }

    // Close statement


    // Validate email
    if (empty(trim($_POST["useremail"]))) {
        $email_err = "Please enter an email.";
    } else {
        // Prepare a select statement
        $sql = "SELECT user_id FROM users WHERE user_email = :email";

        $statement = $connect->prepare($sql);

        // Bind variables to the prepared statement as parameters

        $statement->bindParam(":email", $param_email);
        // Set parameters
        $param_email = trim($_POST["useremail"]);

        // Attempt to execute the prepared statement
        $statement->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Check if username exists, if yes then verify password
        if($row['num'] > 0) {
            $email_err = "This email is already taken.";
        } else {
            $email = trim($_POST["useremail"]);
        }

    }



    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["re_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["re_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($email_err) && empty($address_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (user_name,user_username, user_email, user_address, user_password) VALUES (:uname,:username,:email,:address,:password)";


        $stmt = $connect->prepare($sql);

            $stmt->bindParam(":uname",$_POST['name']);
            $stmt->bindParam(":username",$param_username);
            $stmt->bindParam(":email",$param_email);
            $stmt->bindParam(":address",$param_address);
            $stmt->bindParam(":password",$param_password);



            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_address = $address;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            var_dump($stmt);
            // Attempt to execute the prepared statement


        $result = $stmt->execute();
        if ($result) {
                // Redirect to login page
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }



    // Close connection


}
include "views/includes/header.php";
?>





	 <div class="container" style="max-width: 900px;">
         <div class="main">

                <section class="signup">
                    <!-- <img src="images/signup-bg.jpg" alt=""> -->
                    <div class="container">
                        <div class="signup-content">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="signup-form" class="signup-form">
                                <h2 class="form-title">Create account</h2>
                                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                    <input type="text" class="form-input" name="name" id="name" placeholder="Your Name" value="<?php echo $name; ?>"/>
                                    <span class="help-block"><?php echo $name_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                    <input type="text" class="form-input" name="username" id="username" placeholder="Your User Name" value="<?php echo $username; ?>"/>
                                    <span class="help-block"><?php echo $username_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                    <input type="email" class="form-input" name="useremail" id="email" placeholder="Your Email" value="<?php echo $email; ?>"/>
                                    <span class="help-block"><?php echo $email_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                                    <input type="address" class="form-input" name="useraddress" id="email" placeholder="Your Address" value="<?php echo $address; ?>"/>
                                    <span class="help-block"><?php echo $address_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <input type="text" class="form-input" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>"/>
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                    <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                    <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password" value="<?php echo $confirm_password; ?>"/>
                                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                    <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                                </div>
                            </form>
                            <p class="loginhere">
                                Have already an account ? <a href="Login.php?" class="loginhere-link">Login here</a>
                            </p>
                        </div>
                    </div>
                </section>

            </div>
	</div>

    <script src="js/password_toggle.js"></script>
	</body>
</html>