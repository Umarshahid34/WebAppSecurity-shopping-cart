<?php
if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $connect = new PDO("mysql:host=localhost;dbname=shopping_cart_db", "root", "root");

    include "views/includes/header.php";


    if(isset($_POST["submit"]))
    {
        $cookie_id = $_SESSION['cookie_id'];
        $query = "SELECT item_id,item_name,item_price,item_image,basket_quantity,id_user from
                    (SELECT cookie.cookie_id, cookie.id_user , basket.id_cookie, basket.basket_quantity, items.item_id, items.item_name,items.item_price, items.item_image FROM basket
                    INNER JOIN cookie ON basket.id_cookie = cookie.cookie_id
                    LEFT OUTER JOIN items on basket.id_items=items.item_id)result
                    WHERE result.cookie_id = :cookie_id ";
        $stmt = $connect->prepare($query);

        $stmt->bindParam(":cookie_id",$cookie_id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $Total_amount = 0;
        $date = date("Y/d/m");
        //$new_date = STR_TO_DATE('$date', '%m/%d/%Y');
        //var_dump($new_date);
        foreach($result as $row)
        {
            $quantity = $row['basket_quantity'];
            $price = $row['item_price'];
            $item_id = $row['item_id'];
            $user_id = $row['id_user'];
            $total_price = $row['item_price'] * $row['basket_quantity'];

            $query = " INSERT INTO `orders`(`orders_quantity`, `orders_price`, `id_items`, `id_user`,
                        `order_total_price`) VALUES (:quantity , :price, :item_id, :user_id , :total_price ) " ;

            $stmt = $connect->prepare($query);

            $stmt->bindParam(":quantity",$quantity);
            $stmt->bindParam(":price",$price);
            $stmt->bindParam(":item_id",$item_id);
            $stmt->bindParam(":user_id",$user_id);
            $stmt->bindParam(":total_price",$total_price);

            $stmt->execute();
        }





        header("location: index.php");
    }
?>


	<div class="container"  style="max-width: 1100px;">
	 <div class="row">
         <div class="col-md-12" style=" padding-bottom: 33px;">
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
                        $id = $_SESSION['id_user'];
                        $query = "SELECT * FROM users Where user_id = :id";
                        $stmt = $connect->prepare($query);

                        $stmt->bindParam(":id",$id);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        if(!empty($result))
                        {
                            $user_name = $result['user_name'];
                            $user_email = $result['user_email'];
                            $user_address = $result['user_address'];
                        }
                     ?>

                     <div class="row">
                         <div class="col-md-2" style="padding-top: 2.5%;">
                             <h4>Name</h4>
                         </div>
                         <div class="col-md-10">
                             <input type="text" id="name" name="name" placeholder="Name" value="<?php echo $user_name; ?>"/>
                         </div>
                     </div>
                      <div class="row">
                         <div class="col-md-2" style="padding-top: 2.5%;">
                             <h4>Email</h4>
                         </div>
                         <div class="col-md-10">
                             <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $user_email; ?>"/>
                         </div>
                      </div>
                      <div class="row">
                          <div class="col-md-2" style="padding-top: 2%;">
                             <h4>Address</h4>
                         </div>
                         <div class="col-md-10">
                             <input type="text" id="address" name="address" placeholder="Delivery Address" value="<?php echo $user_address; ?>"/>
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
                        <div class="col-md-4" style="padding-left:132px;">
                            <div class="custom-control custom-radio" >
                              <input type="radio" value="customRadio1" id="customRadio1" name="customRadio" class="custom-control-input" checked>
                              <label class="custom-control-label" for="customRadio1"> </label>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-left:132px;">
                            <div class="custom-control custom-radio" >
                              <input type="radio"  value="customRadio2" id="customRadio2" name="customRadio" class="custom-control-input">
                              <label class="custom-control-label" for="customRadio2"></label>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-left:132px;">
                            <div class="custom-control custom-radio" >
                              <input type="radio" value="customRadio3" id="customRadio3" name="customRadio" class="custom-control-input">
                              <label class="custom-control-label" for="customRadio3"></label>
                            </div>
                        </div>
                     </div>
                        </br>
                     <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                     <input type="button" name="next" class="next action-button" onclick="SubmitPaymentMethodData();" value="Continue"/>
                 </fieldset>
                 <fieldset>
                     <h2 class="fs-title">Order Details</h2>
                     <h3 class="fs-subtitle">Go through your order details</h3>

                     <div class="row">
                        <div class="col-md-6" style="padding-left:0px; ">
                            <h3 style="color: darkcyan;">Delivery Address</h3>
                        </div>
                        <div class="col-md-6" style="padding-left:0px;">
                            <b><span id="username" value="">  </span> </b>
                            </br>
                            <span id="useraddress" value ="">  </span>

                        </div>
                     </div>
                     </br>
                     <hr>
                     <div class="row">
                         <div class="col-md-6" style="padding-left:0px;">
                             <h3 style="color: darkcyan;">Payment Method</h3>
                         </div>
                         <div class="col-md-6" style="padding-left:0px;">
                             <span>
                                <img id="paymentMethodImage" src="" width="100" height="100">
                             </span>
                             <b><span id ="methodname" value =""> </span></b>
                         </div>
                     </div>
                     <hr>

                     <h3 style="color: darkcyan;" >Order Items</h3>
                     <div class="row" style="padding-left:0px; border: 1px ;">
                     <?php
                        $cookie_id = $_SESSION['cookie_id'];
                        $query = "SELECT item_id,item_name,item_price,item_image,basket_quantity from
                                    (SELECT cookie.cookie_id, basket.id_cookie, basket.basket_quantity, items.item_id, items.item_name,items.item_price, items.item_image FROM basket
                                    INNER JOIN cookie ON basket.id_cookie = cookie.cookie_id
                                    LEFT OUTER JOIN items on basket.id_items=items.item_id)result
                                    WHERE result.cookie_id = :cookie_id ";
                        $stmt = $connect->prepare($query);

                        $stmt->bindParam(":cookie_id",$cookie_id);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        $Total_amount = 0;
                        foreach($result as $row)
                        {

                     ?>

                                   <div class="col-md-3">
                                        <div style="background-color:#ffffff; border-radius:5px; padding:16px;" align="center">
                                            <img style="width: 115px; height: 115px;" src="images/<?php echo $row["item_image"]; ?>" class="img-responsive" /><br />
                                               <div style="background-color:lavender; border-radius:6px; padding:3px;">
                                                <h4 class="text"><?php echo $row["item_name"]; ?></h4>
                                               </div>

                                                <h4 class="text-danger">&#8364; <?php echo $row["item_price"]; ?></h4>

                                                <div style="background-color:lavender; border-radius:6px; padding:3px;">
                                                     <h4 class="text"> Qty: <?php echo $row["basket_quantity"]; ?></h4>
                                                </div>
                                        </div>
                                    </div>

                    <?php
                            $Total_amount += $row["item_price"] * $row["basket_quantity"];
                        }
                    ?>
                    </div>
                    <hr>
                    <div class="row">
                         <div class="col-md-6" style="padding-left:0px;">
                             <h3 style="color: darkcyan;">Total Amount</h3>
                         </div>
                         <div class="col-md-6" style="padding-left:0px;">
                             <b><h3>&#8364; <?php echo $Total_amount; ?> </h3></b>
                         </div>
                     </div>
                     <hr>
                     <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                     <input type="submit" name="submit" class="submit action-button" value="Confirm"/>
                 </fieldset>
             </form>
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


