<?php
    include "views/includes/header.php";
?>


    <div class="container border border-info" style="background-color:#ffffff; border-radius:5px; padding:16px;" align="center">
        <br />
        <h3 align="center">Your Orders</h3><br />
        <br /><br />
        <?php
            $id = $_SESSION['id_user'] ;
            $query ="SELECT * FROM items INNER JOIN orders ON items.item_id = orders.id_items WHERE orders.id_user = :id";
            $stmt = $connect->prepare($query);

            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach($result as $row)
            {
        ?>
            <div class="border border-info" style="height:130px;">
                </br>
                <div class="col-md-8">
                    <div style="padding:16px;" align="center">
                        <div class="col-md-2">
                            <img style="width: 115px; height: 83px;" src="images/<?php echo $row["item_image"]; ?>" class="img-responsive" /><br />
                        </div>
                        <div style="" align="left">
                            <h4 class="text"><?php echo $row["item_name"]; ?></h4>

                            <h4 class="text-danger">&#8364; <?php echo $row["item_price"]; ?></h4>

                            <h4 class="text"> Qty: <?php echo $row["orders_quantity"]; ?></h4>
                        </div>

                    </div>
                </div>
                <div class="col-md-4" style="padding:16px;" align="center">
                    <h3 style="color: darkcyan;">Total Amount</h3>
                    <b><h3>&#8364; <?php echo $row['order_total_price']; ?> </h3></b>
                </div>
                </br>
            </div>
            </br>
        <?php
            }
	    ?>
	</div>
	</body>
</html>