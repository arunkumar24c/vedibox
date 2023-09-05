<?php
require '../include/Auto-Load.php';

$order_id = $_REQUEST['OID'];

echo $order_id;


/// Update Query

$update = mysqli_query($db, "UPDATE order_master
								SET 	
								order_status='4' 
								
								WHERE order_id='".$order_id."'");

header("location:../Order_Shipped.php");
		
?>

