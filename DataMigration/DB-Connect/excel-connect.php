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
		
		$sqlquery2 = "INSERT INTO ms_country_master(country_status,country_create_date,country_lastmodified,country_id_oracle,country_name,country_iso";
			
		
	
		$sqlquery2 .= ") values(1,'".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."',"; 	
		
		for ($i = 2; $i <= $totalRows; $i++) 
		{



			$sqlquery = $sqlquery2; 		
		
			for ($j = 1; $j <$totalData ,$j<$maxTotal; $j++) 
			{
				$sqlquery.="'".addslashes(nl2br($exceldata->sheets[0]['cells'][$i][$j]))."'";
				/*$sqlquery.=')';*/
									
				if($j==$totalData || $j==$maxTotal-1)
				{
					$sqlquery.=')';
				}
				else
				{
					$sqlquery.=',';
				}
				
			}	
						
			echo $sqlquery;
			echo "<br/>";
			mysqli_query($db, $sqlquery);
			
			
		}
		
		
		
		
		unlink($dest_path);
		//require_once 'excel-insert-class.php';
		//$obj_excel=new excell_insert();
		//$obj_excel->insert_excell_data();
		
	}





?>