<?php
$CONF['host'] = 'localhost';
$CONF['user'] = 'root';
$CONF['pass'] = '';
$CONF['name'] = 'liveerp_datamigration';

$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8mb4");

$sql = mysqli_query($db, "SELECT * FROM enquiry_crm");
while($sqlfetch = mysqli_fetch_array($sql))
{
	
	$sql_lead = mysqli_query($db, "SELECT * FROM crm_customer_lead WHERE crm_lead_or_id = '".$sqlfetch['COL 18']."'");
	$count  = mysqli_num_rows($sql_lead);
	$enquiry_refernce = 0;
	
	if($count  > 0 )
	{
		$fetch_lead = mysqli_fetch_array($sql_lead);
		$enquiry_from = 1;
		$enquiry_refernce  = $fetch_lead['crm_lead_id'];
	}
	else
	{
		$sql_client= mysqli_query($db, "SELECT * FROM crm_customer_master WHERE crm_client_id_or = '".$sqlfetch['COL 18']."'");
		$count2  = mysqli_num_rows($sql_client);
		if($count2  > 0 )
		{
			$enquiry_from = 2;
			$fetch_customer = mysqli_fetch_array($sql_client);
			$enquiry_refernce  = $fetch_customer['crm_client_id'];
		}
		else{
			$enquiry_from = 3;
		}
	}
	 
	
	
	
	$enquiry_date  = date("Y-m-d H:i:s",strtotime($sqlfetch['COL 4']));
	
	$enquiry_type  = 5;
	$enquiry_details  = $sqlfetch['COL 6']."<br/>".$sqlfetch['COL 8'];
	
	$enquiry_by  = 2;
	
	$enquiry_customer  = $sqlfetch['product_code'];
	$enquiry_status  = 1;
	$enquiry_or_id  = $sqlfetch['COL 3'];
	
	
	$insert = mysqli_query($db, "INSERT INTO  crm_enquiry 
									(

										enquiry_from,
										enquiry_refernce,
										enquiry_date,
										enquiry_type,
										enquiry_details,
										enquiry_by,
										enquiry_status						

									)
									values
									(										
										'".$enquiry_from."',
										'".$enquiry_refernce."',
										'".$enquiry_date."',
										'".$enquiry_type."',										
										'".addslashes($enquiry_details)."',
										'".$createby."',							
										'".$status."'									
									)");
		
		

			$ENQ_ID = mysqli_insert_id($db);

			if(strlen($ENQ_ID) == 1)
			{
				$enqu_numer = "00".$ENQ_ID;
			}
			if(strlen($ENQ_ID) == 2)
			{
				$enqu_numer = "0".$ENQ_ID;
			}

			if(strlen($ENQ_ID) > 2)
			{
				$enqu_numer = $ENQ_ID;
			}

			$ENQ_code = "ENQ".$enqu_numer;

			// Update Supplier Code
			$UpdateCode = mysqli_query($db,"UPDATE crm_enquiry
			SET			
				enquiry_code		= '".$ENQ_code."'			 
			WHERE 
				enquiry_id	= '".$ENQ_ID."'
			");
		
	
	
}
