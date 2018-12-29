<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<?php

include 'Utilities.php';
//index.php

$connect = new PDO("mysql:host=localhost;dbname=shopping_cart_db", "root", "root");

$message = '';
$shopping_cart = '';
$basket_id = 1;


if(isset($_POST["add_to_basket"]))
{
    //var_dump($_COOKIE['shopping_cart']);
    /*$cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);
    var_dump($cart_data['item_Cookie_id']);*/
	if(isset($_COOKIE['shopping_cart']))
	{
	    var_dump('1');
		$cookie_data = stripslashes($_COOKIE['shopping_cart']);
        //var_dump($_COOKIE['shopping_cart']);
		$cart_data = json_decode($cookie_data, true);

	}
	else
	{
        var_dump('2');
        $shopping_cart =  (string)md5(openssl_random_pseudo_bytes(32));
		$cart_data = array(
		    'item_Cookie_id'			=>	$shopping_cart
		);
	}

	$item_id_list = array_column($cart_data, 'item_id');

	if(in_array($_POST["hidden_id"], $item_id_list))
	{
	    var_dump('3');
		foreach($cart_data as $keys => $values)
		{
		    if($values != $cart_data['item_Cookie_id'])
            {
                if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
                {
                    //if($_POST["hidden_stock"] > $cart_data[$keys]["item_quantity"])
                    //{

                        $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];

                        // Updating the stock qauntity on Front end as well as in Database.
                        $_POST["hidden_stock"] = $_POST["hidden_stock"] - $_POST["quantity"] ;
                        $cart_data[$keys]["item_stock"] = $_POST["hidden_stock"];
                        $num = $_POST["hidden_stock"];
                        $id = $_POST["hidden_id"];
                        $query = "UPDATE items SET item_stock = $num WHERE item_id = $id";
                        $connect->exec($query);


                        // updating the basket Info
                        $query = "SELECT basket_quantity FROM basket WHERE id_items = $id";
                        $statement = $connect->prepare($query);
                        $statement->execute();
                        $result1 = $statement->fetchAll();
                        $quantity = (int)$result1[0]['basket_quantity'] + $_POST["quantity"];
                        $query = "UPDATE basket SET basket_quantity = $quantity WHERE id_items = $id";
                        $connect->exec($query);

                        //Updating the Cookie data into the 'cookie' table
                        $cookie_id = $cart_data['item_Cookie_id'];
                        $cookie_value = json_encode($cart_data);
                        $query = "UPDATE cookie SET cookie_value = '$cookie_value' WHERE cookie_id = '$cookie_id'";
                        var_dump($query);
                        $connect->exec($query);

                    //}
                    /*else
                    {
                        var_dump("javascriot");
                         echo "<script type='text/javascript'>
                                        alert('JavaScript is awesome!');
                               </script>";

                        header("location:index.php?outOfStock=1");
                    }*/
                }
            }
		}


	}
	else
	{
	   var_dump('4');

	    //var_dump($item_array);
        //var_dump($_POST["hidden_stock"]);
        $_POST["hidden_stock"] = $_POST["hidden_stock"] - $_POST["quantity"] ;
        $num = $_POST["hidden_stock"];
        $id = $_POST["hidden_id"];
        $query = "UPDATE items SET item_stock = $num WHERE item_id = $id";
        $connect->exec($query);


		$item_array = array(
			'item_id'			=>	$_POST["hidden_id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_stock'		=>	$_POST["hidden_stock"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$cart_data[] = $item_array;

	    //Storing the basket data into 'basket' table
        $itemID = (int)$item_array['item_id'];
        $itemQuantity = (int)$item_array['item_quantity'];
        $cookie_id = $cart_data['item_Cookie_id'];

        //var_dump($item_data);
        $query = "INSERT INTO basket (id_items , basket_quantity, id_cookie) VALUES ($itemID, $itemQuantity, '$cookie_id')";
        var_dump($query);
        $connect->exec($query);
        echo "New record created successfully";

        //Storing the Cookie data into the 'cookie' table
        $cookie_value = json_encode($cart_data);
        $query = "INSERT INTO `cookie`(`cookie_id`, `cookie_value`, `id_user`, `logged_In`)
                    VALUES ('$cookie_id','$cookie_value','','false')";
        var_dump($query);
        $connect->exec($query);
	}

	//$basket_id++;
	$item_data = json_encode($cart_data);
	//var_dump($cart_data['item_Cookie_id']);
	//var_dump("shopping_cart");
	$expiry = time() + (86400 * 30);
    setcookie('shopping_cart', $item_data, $expiry);
	//var_dump($_POST["hidden_Cookie_id"]);
	header("location:index.php?success=1");
}

if(isset($_POST["checkOut"]))
{
    if(isset($_COOKIE['shopping_cart']))
    {
        header("location:Login.php");
    }

}
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		$cookie_data = stripslashes($_COOKIE['shopping_cart']);
		$cart_data = json_decode($cookie_data, true);
		foreach($cart_data as $keys => $values)
		{
		     if($values != $cart_data['item_Cookie_id'])
             {
                if($cart_data[$keys]['item_id'] == $_GET["id"])
                {
                    //var_dump("Aya");
                    $cart_data[$keys]['item_stock'] = $cart_data[$keys]["item_stock"] + $cart_data[$keys]["item_quantity"] ;
                    $num = $cart_data[$keys]['item_stock'];
                    $id = $cart_data[$keys]['item_id'];
                    $query = "UPDATE items SET item_stock = $num WHERE item_id = $id";
                    $connect->exec($query);

                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    setcookie('shopping_cart', $item_data, time() + (86400 * 30));

                    // Deleting from the basket Table .
                    $query = "DELETE FROM basket WHERE id_items = $id";
                    $connect->exec($query);

                    header("location:index.php?remove=1");
                }
             }
		}
	}
	if($_GET["action"] == "clear")
	{
	    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    	$cart_data = json_decode($cookie_data, true);
	    foreach($cart_data as $keys => $values)
        {
            if($values != $cart_data['item_Cookie_id'])
            {
                var_dump($cart_data);
                var_dump($cart_data[$keys]["item_stock"]);
                var_dump($cart_data[$keys]["item_quantity"]);
                $cart_data[$keys]['item_stock'] = $cart_data[$keys]["item_stock"] + $cart_data[$keys]["item_quantity"] ;
                $num = $cart_data[$keys]['item_stock'];
                $id = $cart_data[$keys]['item_id'];
                $query = "UPDATE items SET item_stock = $num WHERE item_id = $id";
                $connect->exec($query);

                setcookie('shopping_cart', "", time() - 3600);
                header("location:index.php?clearall=1");
            }
		}
		// Deleting from the basket Table .
		$query = "DELETE FROM basket";
        $connect->exec($query);
	}

}

if(isset($_GET["success"]))
{

	$message = '
	<div class="alert alert-success alert-dismissible">
	  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	Item Added into Basket
	</div>
	';
}

if(isset($_GET["outOfStock"]))
{

	$message = '
	<div class="alert alert-warning alert-dismissible">
	  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	Please Enter With in Stock Limit
	</div>
	';
}

if(isset($_GET["remove"]))
{

	$message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Item removed from Basket
	</div>
	';
}
if(isset($_GET["clearall"]))
{
	$message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Your Shopping Basket has been clear...
	</div>
	';
}

function updateStockOnAddBasketButton(){

}

function updateStockOnRemoveButton(){

}


 include "views/includes/header.php";

?>




		<div class="container" style="background-color:#ffffff; border-radius:5px; padding:16px;" align="center">
			<br />
			<h3 align="center">Shopping Cart</h3><br />
			<br /><br />
			<?php
			$query = "SELECT * FROM items ORDER BY item_id ASC";
			$statement = $connect->prepare($query);

			$statement->execute();
			$result = $statement->fetchAll();
			//var_dump($result);
			foreach($result as $row)
			{
			?>
			<div class="col-md-3">
				<form method="post">
					<div style="background-color:#ffffff; border-radius:5px; padding:16px;" align="center">

						<img src="images/<?php echo $row["item_image"]; ?>" class="img-responsive" /><br />
                        <div style="background-color:#c6FFFF; border-radius:6px; padding:3px;">
						    <h4 class="text"><?php echo $row["item_name"]; ?></h4>
                        </div>

						    <h4 class="text-danger">&#8364; <?php echo $row["item_price"]; ?></h4>
                            <div style="color:blue">
						        <p class="">In Stock: <?php echo $row["item_stock"]; ?></p>
                            </div>

						<input type="text" name="quantity" value="1" class="form-control" />
						<input type="hidden" name="hidden_name" value="<?php echo $row["item_name"]; ?>" />
						<input type="hidden" name="hidden_price" value="<?php echo $row["item_price"]; ?>" />
						<input type="hidden" name="hidden_stock"  value="<?php echo $row["item_stock"]; ?>" class="stock" />
						<input type="hidden" name="hidden_id" value="<?php echo $row["item_id"]; ?>" />
						<input type="submit" name="add_to_basket" style="margin-top:5px;" class="btn btn-info" value="Add to Basket" />
					</div>
				</form>
			</div>
			<?php
			}
			?>
			

                <div style="clear:both"></div>
                <br />
                <h3>Order Details</h3>
                <div class="table-responsive" style="background-color:#ffffff;">
                <?php echo $message; ?>
                <div align="right" >
                    <h4><a href="index.php?action=clear"><b>Clear Basket </b></a></h4>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th width="40%">Item Name</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Price</th>
                        <th width="15%">Total</th>
                        <th width="5%">Action</th>
                    </tr>
                <?php
                if(isset($_COOKIE['shopping_cart']))
                {
                    $total = 0;
                    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                    $cart_data = json_decode($cookie_data, true);
                    foreach($cart_data as $keys => $values)
                    {
                        if($values != $cart_data['item_Cookie_id'])
                         {
                ?>
                    <tr>
                        <td><?php echo $values["item_name"]; ?></td>
                        <td><?php echo $values["item_quantity"]; ?></td>
                        <td>&#8364; <?php echo $values["item_price"]; ?></td>
                        <td>&#8364; <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                        <td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                    </tr>

                <?php
                        $total = $total + ($values["item_quantity"] * $values["item_price"]);
                        }
                    }
                ?>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="right">$ <?php echo number_format($total, 2); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center">

                            <form method="POST">
                                <input type="submit" name="checkOut" style="margin-top:5px;" class="btn btn-success" value="CheckOut Order" />
                            </form>

                        </td>
                    </tr>
                <?php
                }
                else
                {
                    echo '
                    <tr>
                        <td colspan="5" align="center">No Item in Basket</td>
                    </tr>
                    ';
                }
                ?>
                </table>
                </div>
		</div>
		<br />
	</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
    var quantity_field = $('.form-control');
    var stock_field = $('.stock');
    var stock_field = <?php echo json_encode($cart_data['']); ?>;

    //$cookie_data = stripslashes($_COOKIE['shopping_cart']);
    //$cart_data = json_decode($cookie_data, true);
    alert(stock_field);
    $(quantity_field).change(function(){
        alert( stock_field.value);
        alert(this.value);
        if(this.value > stock_field.value){
            alert("We have maximum " + stock_field.value + "items in stock");
        }
    });
});
</script>