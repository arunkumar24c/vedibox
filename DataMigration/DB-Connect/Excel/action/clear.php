<?php
//require '../include/dbconfig.php';
//require '../include/Common.php';
error_reporting(0);
require '../config/dbconfig.php';

if(isset($_POST['save']))
{
	
			$data = mysqli_query($yeshaul_con,"select * from automail where (email_status=0)");
			$count=mysqli_num_rows($data);
			if($count==0)
			{
				$emp = mysqli_query($yeshaul_con, "truncate table employee_master");
				$payroll = mysqli_query($yeshaul_con, "truncate table payroll");	
				$automail = mysqli_query($yeshaul_con, "truncate table automail");	
                header("location:../clear_data.php?s=1");				
			}
			else
			{
			    header("location:../clear_data.php?s=2");
			}
}



?>