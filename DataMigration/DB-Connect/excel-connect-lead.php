<?php
ob_start();
//echo "hai";

// The MySQL credentials
$CONF['host'] = 'localhost';
$CONF['user'] = 'root';
$CONF['pass'] = '';
$CONF['name'] = 'liveerp_datamigration';

$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8mb4");
//require '../../include/Auto-Load.php';
ini_set("memory_limit","-100");
ini_set("max_execution_time","720");
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


//echo "hai2";
function splString($str)
{
	$str=preg_replace('/[^A-Z0-9]/i','',strtoupper(trim($str)));
	$str2=strtoupper($str);
	return $str;
	
}

$name=array();
$email=array();
//echo $_FILES['excelupload']['error'];
//echo "hai".UPLOAD_ERR_OK;
	    
if (isset($_FILES['exceldata'])   && $_FILES['exceldata']['error'] === UPLOAD_ERR_OK)
{
    // get details of the uploaded file
    $fileTmpPath = $_FILES['exceldata']['tmp_name'];
    $fileName = $_FILES['exceldata']['name'];
    $fileSize = $_FILES['exceldata']['size'];
    $fileType = $_FILES['exceldata']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('xls');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
    
		  $uploadFileDir = 'temp/';
		  $dest_path = $uploadFileDir . $newFileName;

		  if(move_uploaded_file($fileTmpPath, $dest_path)) 
		  {
			//$message ='File is successfully uploaded.';
		  }
		  else 
		  {
			header("Location:../country.php?failed=4");
				exit();	
		  }
	}
	else
	{
		  header("Location:../country.php?failed=5");
				exit();	
	}
}
else{
		 
			header("Location:../country.php?failed=6");
				exit();	
}


		
	
	if(is_file($dest_path))
	{
		//mysql_query("truncate table job_profile_excel");
		require_once 'Excel/reader.php';
		$exceldata = new Spreadsheet_Excel_Reader();
		
		// Set output Encoding.
		$exceldata->setOutputEncoding('CP1251');
		$exceldata->setOutputEncoding('CPa25a');
		$exceldata->read($dest_path);
		$result = $exceldata->read($dest_path);
		
		
		
		$totalRows=$exceldata->sheets[0]['numRows'];
		$totalData=$exceldata->sheets[0]['numCols'];
		
		// Get Addional Filed Count
		
		
		echo $maxTotal= $totalData+1;
		echo "<br/>";
		//$maxTotal_count = $count;
		$date=date('Y-m-d');
		
		$k = 10 + $totalRows;
		
		$run = 0;
		
		$sqlquery2 = "INSERT INTO crm_customer_lead(
		crm_lead_or_id,
		crm_lead_company,
		crm_lead_first_name,
		crm_lead_last_name,
		crm_lead_position,
		crm_lead_address1,
		crm_lead_address2,
		crm_lead_address3,
		crm_lead_country,
		crm_lead_state,
		crm_lead_Website,
		crm_lead_emailid1,
		crm_lead_officenumber,
		crm_lead_mobile,
		crm_lead_phone,
		crm_lead_fax,
		crm_lead_notes,
		crm_lead_createddate,
		crm_lead_scope,
		crm_lead_owner,
		crm_lead_status
		";
			
		
	
		$sqlquery2 .= ") values( "; 	
		
		for ($i = 2; $i <= $totalRows; $i++) 
		{



			$sqlquery = $sqlquery2; 		
			$l = 0;
			for ($j = 1; $j <$totalData ,$j<$maxTotal; $j++) 
			{
				
				
				
				if($l == 8)
				{
					$countryname = addslashes(nl2br($exceldata->sheets[0]['cells'][$i][$j]));
					
					$sqlcountr = mysqli_query($db, "SELECT country_id FROM ms_country_master WHERE country_name = '".$countryname."'");
					$fetch_country = mysqli_fetch_array($sqlcountr);
					
					$sqlquery.="'".$fetch_country['country_id']."'";
				}
				else if($l == 17)
				{
					$date = date("Y-m-d H:i:s", strtotime(addslashes(nl2br($exceldata->sheets[0]['cells'][$i][$j]))));
					
					
					$sqlquery.="'".$date."'";
				}
				else if($l == 18)
				{
					$type = 1;
					if(addslashes(nl2br($exceldata->sheets[0]['cells'][$i][$j])) == "Testing")
					{
						$type = 3;
					}
					else if(addslashes(nl2br($exceldata->sheets[0]['cells'][$i][$j])) == "Sales")
					{
						$type = 1;
					}
					else if(addslashes(nl2br($exceldata->sheets[0]['cells'][$i][$j])) == "Calibartion")
					{
						$type = 2;
					}
					else if(addslashes(nl2br($exceldata->sheets[0]['cells'][$i][$j])) == "Service")
					{
						$type = 4;
					}
					
				
					
					$sqlquery.="'".$type."'";
				}
				
				else if($l == 19)
				{
					$leaddd = addslashes(nl2br($exceldata->sheets[0]['cells'][$i][$j]));
					
					$sqlcountr = mysqli_query($db, "SELECT id FROM admin WHERE name = '".$leaddd."'");
					$fetch_country = mysqli_fetch_array($sqlcountr);
					
					$sqlquery.="'".$fetch_country['id']."'";
				}
				
				else if($l == 20)
				{
					$status = addslashes(nl2br($exceldata->sheets[0]['cells'][$i][$j]));
					$stats = 1;
					if($status == "ENQ")
					{
						$stats = 3;
					}
					else
					{
						$stats = 1;
					}
					
					$sqlquery.="'".$stats."'";
				}
				
				
				else
				{
					$sqlquery.="'".addslashes(nl2br($exceldata->sheets[0]['cells'][$i][$j]))."'";
				}
				
				
				
				/*$sqlquery.=')';*/
									
				if($j==$totalData || $j==$maxTotal-1)
				{
					
					
					$sqlquery.=')';
				}
				else
				{
					$sqlquery.=',';
				}
				$l++;
			}	
						
			echo $sqlquery;
			echo "<br/>";
			mysqli_query($db, $sqlquery);
			
			$Lead_ID = mysqli_insert_id($db);

				if(strlen($Lead_ID) == 1)
				{
					$client_numer = "00".$Lead_ID;
				}
				if(strlen($Lead_ID) == 2)
				{
					$client_numer = "0".$Lead_ID;
				}

				if(strlen($Lead_ID) > 2)
				{
					$client_numer = $Lead_ID;
				}

				$ClientCOde = "LE".$client_numer;

					// Update Supplier Code
				$UpdateCode = mysqli_query($db,"UPDATE crm_customer_lead
					SET			
					crm_lead_code		= '".$ClientCOde."'			 
					WHERE 
					crm_lead_id	= '".$Lead_ID."'
					");
			
			
		}
		
		
		
		
		unlink($dest_path);
		//require_once 'excel-insert-class.php';
		//$obj_excel=new excell_insert();
		//$obj_excel->insert_excell_data();
		
	}





?>