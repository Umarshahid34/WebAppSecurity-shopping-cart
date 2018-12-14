<?php 

//index.php

$connect = new PDO("mysql:host=localhost;dbname=shopping_cart_db", "root", "");

$message = '';

$basket_id = 1;

if(isset($_POST["add_to_basket"]))
{
	if(isset($_COOKIE["shopping_cart"]))
	{
		$cookie_data = stripslashes($_COOKIE['shopping_cart']);
        //var_dump($_COOKIE['shopping_cart']);
		$cart_data = json_decode($cookie_data, true);

	}
	else
	{
		$cart_data = array();
	}

	$item_id_list = array_column($cart_data, 'item_id');

	if(in_array($_POST["hidden_id"], $item_id_list))
	{
	    echo("IF ");
		foreach($cart_data as $keys => $values)
		{
			if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
			{
				$cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
                echo("q1");
                var_dump("qauntity : " + $cart_data[$keys]["item_stock"]);
                var_dump("qantity 2 : " + $_POST["quantity"]);
                $num = $cart_data[$keys]["item_stock"] - $_POST["quantity"] ;
                $id = $_POST["hidden_id"];
				$query = "UPDATE items SET item_stock = $num WHERE item_id = $id";

				$connect->exec($query);
			}
		}


	}
	else
	{
	    echo("ELSE ");
		$item_array = array(
			'item_id'			=>	$_POST["hidden_id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_stock'		=>	$_POST["hidden_stock"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$cart_data[] = $item_array;

        var_dump($item_array["item_stock"]);
		$num = $item_array["item_stock"] - $_POST["quantity"] ;
        $id = $_POST["hidden_id"];
        $query = "UPDATE items SET item_stock = $num WHERE item_id = $id";

        $connect->exec($query);

		/*var_dump($item_array);
	    //Storing the basket data into 'basket' table
        try
        {
            //setting attributes for Exception handling
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $itemID = (int)$item_array['item_id'];
            $itemQuantity = (int)$item_array['item_quantity'];
            $item_data = (int)$item_array['item_data'];
            $query = "INSERT INTO basket (id_items , basket_quantity, id_cookie) VALUES ($itemID, $itemQuantity, $item_data)";
            $connect->exec($query);
            echo "New record created successfully";
        }
        catch(PDOException $e)
        {
            echo $query . "<br>" . $e->getMessage();
        }*/

	}

	//$basket_id++;
	$item_data = json_encode($cart_data);
	setcookie('shopping_cart', $item_data, time() + (86400 * 30));
	//header("location:index.php?success=1");
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		$cookie_data = stripslashes($_COOKIE['shopping_cart']);
		$cart_data = json_decode($cookie_data, true);
		foreach($cart_data as $keys => $values)
		{
			if($cart_data[$keys]['item_id'] == $_GET["id"])
			{
				unset($cart_data[$keys]);
				$item_data = json_encode($cart_data);
				setcookie("shopping_cart", $item_data, time() + (86400 * 30));
				header("location:index.php?remove=1");
			}
		}
	}
	if($_GET["action"] == "clear")
	{
		setcookie("shopping_cart", "", time() - 3600);
		header("location:index.php?clearall=1");
	}
	if($_GET["action"] == "checkout")
    	{
    		setcookie("shopping_cart", "", time() - 3600);
    		header("location:index.php?clearall=1");
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


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>
	<body style="padding-top: 70px; background-attachment: fixed; background-position: center; " background="images/signup-images/signup-bg.jpg">

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <div class="container">
            <a class="navbar-brand" href="#">Shopping Cart</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home
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
		<br />
		<div class="container">
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
						<input type="hidden" name="hidden_stock" value="<?php echo $row["item_stock"]; ?>" />
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
                if(isset($_COOKIE["shopping_cart"]))
                {
                    $total = 0;
                    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                    $cart_data = json_decode($cookie_data, true);
                    foreach($cart_data as $keys => $values)
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
                ?>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="right">$ <?php echo number_format($total, 2); ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5" align="center">
                            <a href="index.php?action=checkout&id=<?php echo $values["item_id"]; ?>">
                            <form method="POST" action="Register.php?action=checkout$id=<?php echo $values["item_id"]; ?>">
                                <input type="submit" name="checkOut" style="margin-top:5px;" class="btn btn-success" value="CheckOut Order" />
                            </form>
                            </a>
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