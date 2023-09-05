<?php
//error_reporting(0);
require '../config/dbconfig.php';
if(isset($_POST['save']))
{
	$date_entry = date("Y-m-d h:i:s");
	$i = 0;
 
	if ($_FILES["file"]["error"] > 0)
    {
		
		header("Location:../Import_Payroll.php?Error=1");
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
				
				$total_r += 1;
				
				$sno=  preg_replace('/[^a-zA-Z0-9_ -]/s','',$data->sheets[0]["cells"][$x][1]);
				$monyear=  preg_replace('/[^a-zA-Z0-9_ -]/s','',$data->sheets[0]["cells"][$x][2]);
				$empcde = preg_replace('/[^a-zA-Z0-9_ -]/s','',$data->sheets[0]["cells"][$x][3]); // how many columns in your Excel Sheet
				$edflag = preg_replace('/[^a-zA-Z0-9_ -\s]/s','',$data->sheets[0]["cells"][$x][4]);
				$edcde = preg_replace('/[^a-zA-Z0-9_ -]/s','',$data->sheets[0]["cells"][$x][5]);
				$eddesc = trim(utf8_decode($data->sheets[0]["cells"][$x][6])," \t\n\r\0\x0B\xA0"); 
				$prcamt = preg_replace('/[^a-zA-Z0-9_ -.]/s','',$data->sheets[0]["cells"][$x][7]);
				$remarks = trim(utf8_decode($data->sheets[0]["cells"][$x][8])," \t\n\r\0\x0B\xA0");  
				$pay_type = preg_replace('/[^a-zA-Z0-9_ -]/s','',$data->sheets[0]["cells"][$x][9]);		
				$pay_type_sub = preg_replace('/[^a-zA-Z0-9_ -]/s','',$data->sheets[0]["cells"][$x][10]);


				$datasql = mysqli_query($yeshaul_con, "select * from employee_master where empcde='".$empcde."' and monyear='".$monyear."'");	
				//echo "select * from employee_master where empcde='".$empcde."' and monyear='".$monyear."'";
			 	$datanumber = mysqli_num_rows($datasql);

				if($datanumber > 0)
				{
					$datasql1 = mysqli_query($yeshaul_con, "select * from payroll where empcde='".$empcde."' and monyear='".$monyear."' and edcde='".$edcde."' ");	
			
					$data1 = mysqli_num_rows($datasql1);

					if($data1 == 0)
					{
						$total_s += 1;
						$sql_insetrt = mysqli_query($yeshaul_con,"INSERT INTO payroll
												   (
													monyear,
													empcde,
													edflag,
													edcde,
													eddesc,
													prcamt,
													remarks,
													pay_type,
													pay_type_sub,
													date,
													status										
												   )
												   VALUES
												   (
													'".$monyear."',
													'".$empcde."',
													'".$edflag."',
													'".$edcde."',
													'".str_replace("?"," ",$eddesc)."',
													'".$prcamt."',
													'".str_replace("?"," ",$remarks)."',
													'".$pay_type."',
													'".$pay_type_sub."',
													'".$date_entry."',
													1

												   )
												   "

												   );
												   $success++;
					}
					else
					{
							$total_f += 1;
					}
				}
				else
				{
					$total_f += 1;
				}

				
				
				
			}    
	 		$message = $total_r.','.$total_s.','.$total_f;
			 
	 		header("Location:../Payroll.php?Error=0&Message=".$message);

 
	  }
	  else
	  {
		header("Location:../Import_Payroll.php?Error=2");
	  }
		
		
	}
}	
?>
