<?php
ob_start();
require '../include/dbconfig.php';
require '../include/Common.php';

if(isset($_REQUEST['save']))
{
	$uid=$_POST['userid'];
	$n_password=$_POST['n_password'];
	$o_password=$_POST['o_password'];	
	$nc_password=$_POST['nc_password'];	
	
	if(!empty($n_password) && !empty($o_password) && !empty($nc_password))
	{
		if($nc_password == $n_password)
		{
			
			$sql_login = mysqli_query($mysqli,"SELECT * FROM admin WHERE id = '".$uid."' AND password = '".$o_password."' ");
			$count_login = mysqli_num_rows($sql_login);
			if($count_login > 0)
			{


				$upt_insert = mysqli_query($mysqli,"UPDATE  admin
								  SET						 
								   password = '".$n_password."'
								  WHERE
									id = '".$uid."'
								  ");	

								  header("location:../Change_password.php?msg=3");

			}
			else
			{
				header("location:../Change_password.php?msg=4");
			}
			
		}
		else{
			 header("location:../Change_password.php?msg=1");
		}
		
		
					
	}
	else
	{
		header("location:../Change_password.php?msg=2");
	}
}