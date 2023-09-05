<?php
ob_start();
require '../include/dbconfig.php';
require '../include/Common.php';
ini_set('memory_limit', '1024M');
print_r($_POST);
//error_reporting(E_ALL);

ini_set('memory_limit', '1024M');
	ini_set('post_max_size ', '64M');
	ini_set('max_execution_time', '400');
	ini_set('max_input_time', '4000');
	ini_set('max_input_vars', '4000');
	



print_r($_POST['empid']);
if(isset($_POST['save']))
{
   
	        $monyear = preg_replace('/[^a-zA-Z0-9_ -]/s','',$_POST['monyear']); 			
           $salbatid = stripslashes($_POST['salbatid']);
			header("location:../Employee_mail.php?mon=$monyear&salid=$salbatid");
}


if(isset($_POST['schedule']))
{
    echo "hai";
			$monyear = $_POST['monyear'];
            $salbatid = $_POST['salbatid'];
			$schedule_date= date("Y-m-d", strtotime($_POST['schedule_date']));
			$date=date('Y-m-d h:i:s');
			
			//echo count($_POST['empid']);
			foreach($_POST['empid'] as $val)
			{
				if($val != "")
				{
					$emp_data = explode(",",$val);
					$empid = $emp_data[0];
					$empcde = $emp_data[1];
					$cmpcode = $emp_data[2];

					$table1 ="automail";
					$field_values1=array( "monyear","salbatid","schedule_date","empid","empcde","cmpcode","date");
					$data_values1=array("$monyear","$salbatid","$schedule_date","$empid","$empcde","$cmpcode","$date");
					$h1 = new Common();
					$check1 = $h1->Insertdata_id($field_values1,$data_values1,$table1);	
				}
			}
			

	header("location:../Employee_mail.php?msg=1");
}

?>