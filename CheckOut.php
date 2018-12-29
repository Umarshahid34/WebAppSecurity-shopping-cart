<?php
    $connect = new PDO("mysql:host=localhost;dbname=shopping_cart_db", "root", "root");
if(isset($_POST["next"]))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $id = 1;
    $query = "UPDATE users SET user_name = '$name', user_email = '$email', user_address = '$address' WHERE user_id = $id";
    $connect->exec($query);
}

include "views/includes/header.php";
?>


	<div class="container"  style="max-width: 1100px;">
	 <div class="row">
         <div class="col-md-8" style=" padding-bottom: 33px;">
             <form id="msform" method="post">
                 <!-- progressbar -->
                 <ul id="progressbar">
                     <li class="active">Personal Details</li>
                     <li>Payment Method</li>
                     <li>Order Review</li>
                 </ul>
                 <!-- fieldsets -->
                 <fieldset>
                     <h2 class="fs-title">Billing Address</h2>
                     <h3 class="fs-subtitle">Review Your Personal Details</h3>

                     <?php
                        $query = "SELECT * FROM users";
                        $statement = $connect->prepare($query);

                        $statement->execute();
                        $result = $statement->fetchAll();
                        //var_dump($result);
                     ?>

                     <div class="row">
                         <div class="col-md-2" style="padding-top: 2.5%;">
                             <h4>Name</h4>
                         </div>
                         <div class="col-md-10">
                             <input type="text" id="name" name="name" placeholder="Name" value="<?php echo $result[0]["user_name"]; ?>"/>
                         </div>
                     </div>
                      <div class="row">
                         <div class="col-md-2" style="padding-top: 2.5%;">
                             <h4>Email</h4>
                         </div>
                         <div class="col-md-10">
                             <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $result[0]["user_email"]; ?>"/>
                         </div>
                      </div>
                      <div class="row">
                          <div class="col-md-2" style="padding-top: 2%;">
                             <h4>Address</h4>
                         </div>
                         <div class="col-md-10">
                             <input type="text" id="address" name="address" placeholder="Delivery Address" value="<?php echo $result[0]["user_address"]; ?>"/>
                         </div>
                     </div>
                     <!--<h2>City</h2>
                     <input type="text" name="city" placeholder="City" value="<?php echo $result[0]["user_email"]; ?>"/>
                     <h2>Postal Code</h2>
                     <input type="text" name="postal_code" placeholder="Postal Code" value="<?php echo $result[0]["user_name"]; ?>"/>
                     <h2>Country</h2>
                     <input type="dro" name="country" placeholder="Country" value="<?php echo $result[0]["user_name"]; ?>"/> -->
                     <input type="button" name="next" class="next action-button" onclick="SubmitPersonalInfoData();" value="Continue"/>
                 </fieldset>
                 <fieldset>
                     <h2 class="fs-title">Payment Method</h2>
                     <h3 class="fs-subtitle">Select your payment method</h3>
                     <div class="row">
                        <div class="col-md-4">
                            <span style=" border-radius:5px; padding:16px;">
                                <img src="images/visa-card-vector-logo.png" width="100" height="100">
                            </span>
                        </div>
                        <div class="col-md-4">
                            <span style=" border-radius:5px; padding:16px;">
                                <img src="images/Mastercard-Logo-PNG-Vector-Free-Download.png" width="130" height="100">
                            </span>
                        </div>
                        <div class="col-md-4">
                            <span style=" border-radius:5px; padding:16px;">
                                <img src="images/paypal_1215259.png" width="100" height="110">
                            </span>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4" style="padding-left:83px;">
                            <div class="custom-control custom-radio" >
                              <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
                              <label class="custom-control-label" for="customRadio1"> </label>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-left:92px;">
                            <div class="custom-control custom-radio" >
                              <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                              <label class="custom-control-label" for="customRadio2"></label>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-left:83px;">
                            <div class="custom-control custom-radio" >
                              <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                              <label class="custom-control-label" for="customRadio3"></label>
                            </div>
                        </div>
                     </div>
                        </br>
                     <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                     <input type="button" name="next" class="next action-button" onclick="SubmitPaymentMethodData();" value="Continue"/>
                 </fieldset>
                 <fieldset>
                     <h2 class="fs-title">Create your account</h2>
                     <h3 class="fs-subtitle">Fill in your credentials</h3>
                     <input type="text" name="email1" placeholder="Email"/>
                     <input type="password" name="pass" placeholder="Password"/>
                     <input type="password" name="cpass" placeholder="Confirm Password"/>
                     <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                     <input type="submit" name="submit" class="submit action-button" value="Submit"/>
                 </fieldset>
             </form>
         </div>
         <div class=" container col-md-4" style="background-color:#ffffff; border-radius:5px; padding:16px; height="500px"; align="center">
                 <h4> Umar </h4>
         </div>

     </div>
     </div>
     <!-- /.MultiStep Form -->
       <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
     <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
     <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

    <script  src="js/CheckOut.js"></script>

   </body>
</html>


