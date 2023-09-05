<?php
//error_reporting(0);
require '../config/dbconfig.php';
if(isset($_POST['save']))
{
	$date_entry = date("Y-m-d h:i:s");
	$i = 0;
 
	if ($_FILES["file"]["error"] > 0)
    {
		//echo "Error: " . $_FILES["file"]["error"] . "<br>";
		header("Location:../Import_Emp.php?Error=1");
    }
    else
    {
		
		 $fileName    = basename($_FILES['file']['name']);  
		 $fileExt    = substr($fileName, strrpos($fileName, '.') + 1);
		 $a=$_FILES["file"]["tmp_name"];

		 $csv_file = $a;

		 if($fileExt =='xls' || $fileExt =='xlsx')
		 {
		 
			require_once '../Excel/reader.php';

			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('CP1251');
			$data->read($a);
			
			 
			$total_r = 0;
			$total_s = 0;
			$total_f = 0;
			for ($x = 2; $x <= count($data->sheets[0]["cells"]); $x++) 
			{
		
				$email = trim(utf8_decode($data->sheets[0]["cells"][$x][1])," \t\n\r\0\x0B\xA0"); 
				
				$total_r += 1;
				
				
				
					$sql_insetrt = mysqli_query($yeshaul_con,"INSERT INTO newemail2
											   (
												email									
											   )
											   VALUES
											   (
												'".$email."'
												

											   )
											   ");

				
				
			 }    
	 		$message = $total_r.','.$total_s.','.$total_f;
			 
	 		header("Location:../upload.php?Error=0&Message=".$message);

 
	  }
	  else
	  {
		header("Location:../upload.php?Error=2");
	  }
		
		
	}
}	
?>
