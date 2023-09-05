<?php
require '../../include/Auto-Load.php';

 if($_SERVER["REQUEST_METHOD"]=="POST")
 
 {
    $user_name = $_POST["user_name"];
	$password  = $_POST["password"];
	
	$sql = "SELECT * FROM  admin WHERE user_name='".$user_name."' AND password='".$password."'";
	
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result);
	
	if($row["name"]=="abc")
	{
	header("location:../../dashboard.php");
	}
	else 
	{
	 header("location:../../index.php");	
	}
	 
 }