<?php
class excell_insert
{
	function insert_excell_data()
	{
		//include_once("../config/dbconfig.php");
		$yeshaul_con = new mysqli(DBHost, DBUser, DBPassword, Databse);
		
		
		$created_date=date('Y-m-d H:i:s');
		$sql_select_data=mysqli_query($yeshaul_con, "SELECT * FROM doc_tempjournal WHERE tempjournal_status ='1'");
		$count_duplicate=0;
		$count_total=0;
		$count_inserted=0;
		
		$category = $_POST['category'];
		$date = date("Y-M-D H:I:S");
		
		$sqladdinal = "INSERT INTO doc_additionafield ( doc_journalid, ";
		$sql_add = mysqli_query($yeshaul_con, "SELECT * FROM doc_filed_creation WHERE doc_status = '1'");
		while($addional = mysqli_fetch_array($sql_add))		
		{
			$sqladdinal .= $addional['doc_filed_name'].",";
		}
		
		$sqladdinal .= " doc_status ) VALUES ( ";
		
		$elect_data = mysqli_query($yeshaul_con, "SELECT * FROM doc_tempjournal WHERE tempjournal_status ='1'");
		//echo $count_tot = mysqli_num_rows($sql_select_data);
		while($sql_result_data = mysqli_fetch_array($elect_data))
		{
			
			if($sql_result_data['tempjournal_ISSN'] != "")
			{
				$sql_check_duplicate=mysqli_query($yeshaul_con,"SELECT * FROM doc_journal WHERE  journal_ISSN =  '".$sql_result_data['tempjournal_ISSN']."' AND journal_status='1'");
				$sql_result_check=mysqli_num_rows($sql_check_duplicate);
				
				if($sql_result_check > 0)
				{
					$fetch_dublicate = mysqli_fetch_array($sql_check_duplicate);
					
					$product_id = $fetch_dublicate['journal_id'];
					
					
					$journal_short_title = $fetch_dublicate['journal_short_title'];
					$journal_alternate_title = $fetch_dublicate['journal_alternate_title'];
					$journal_country = $fetch_dublicate['journal_country']; 
					$journal_publisher = $fetch_dublicate['journal_publisher'];
					$journal_ISSN = $fetch_dublicate['journal_ISSN'];
					$journal_EISSN = $fetch_dublicate['journal_EISSN']; 
					$journal_URL = $fetch_dublicate['journal_URL'];
					$journal_language = $fetch_dublicate['journal_language'];
					
					
					// Get OLD Record
					if($fetch_dublicate['journal_short_title'] == "")
					{
						$journal_short_title = $sql_result_data['tempjournal_short_title'];
					}
					
					if($fetch_dublicate['journal_alternate_title'] == "")
					{
						$journal_alternate_title = $sql_result_data['tempjournal_alternate_title'];
					}
					
					if($fetch_dublicate['journal_country'] == "")
					{
						$journal_country = $sql_result_data['tempjournal_country'];
					}
					
					if($fetch_dublicate['journal_publisher'] == "")
					{
						$journal_publisher = $sql_result_data['tempjournal_publisher'];
					}
					
					if($fetch_dublicate['journal_ISSN'] == "")
					{
						$journal_ISSN = $sql_result_data['tempjournal_ISSN'];
					}
					
					if($fetch_dublicate['journal_EISSN'] == "")
					{
						$journal_EISSN = $sql_result_data['tempjournal_EISSN'];
					}
					
					if($fetch_dublicate['journal_URL'] == "")
					{
						$journal_URL = $sql_result_data['tempjournal_URL'];
					}
					
					if($fetch_dublicate['journal_language'] == "")
					{
						$journal_language = $sql_result_data['tempjournal_language'];
					}
					
					
					// Get Category Filed
					$sql_category = mysqli_query($yeshaul_con, "SELECT category_field FROM doc_category WHERE category_id = '".$category."'");
					$fetch_category = mysqli_fetch_array($sql_category);
					
					
					
					
				
					$filed = $fetch_category['category_field'];
					$sqlappent = $fetch_category['category_field'] ."='1'";

					
					$sqlupdate = "UPDATE  doc_journal
					SET						
						".$sqlappent.",
						journal_language = '".addslashes(nl2br($journal_language))."',
						journal_URL = '".addslashes($journal_URL)."',
						journal_EISSN = '".$journal_EISSN."',
						journal_ISSN = '".$journal_ISSN."',
						journal_publisher = '".addslashes($journal_publisher)."',
						journal_country = '".$journal_country."',
						journal_alternate_title = '".addslashes(nl2br($journal_alternate_title))."',
						journal_short_title = '".addslashes(nl2br($journal_short_title))."',
						journal_subject = '".$sql_result_data['tempjournal_subject']."'
					WHERE
						journal_id = '".$product_id."'
					
					";
					
					echo $sqlupdate;
					
					$sql_insert_tax = mysqli_query($yeshaul_con,$sqlupdate);
				}
				else
				{
					
					$sql_insert = mysqli_query($yeshaul_con,"INSERT INTO doc_journal 
					(
						journal_category,
						journal_short_title,
						journal_alternate_title,
						journal_country,
						journal_publisher,
						journal_ISSN,
						journal_EISSN,
						journal_URL,
						journal_language,
						journal_createdate,
						journal_subject,
						journal_status
					)
					VALUE
					(					
						'".$category."',
						'".addslashes($sql_result_data['tempjournal_short_title'])."',
						'".addslashes($sql_result_data['tempjournal_alternate_title'])."',
						'".$sql_result_data['tempjournal_country']."',
						'".$sql_result_data['tempjournal_publisher']."',
						'".$sql_result_data['tempjournal_ISSN']."',
						'".$sql_result_data['tempjournal_EISSN']."',
						'".addslashes(nl2br($sql_result_data['tempjournal_URL']))."',
						'".addslashes(nl2br($sql_result_data['tempjournal_language']))."',
						
						'".$created_date."',
						'".$sql_result_data['tempjournal_subject']."',
						'1'
					)
					");
					
					$product_id = mysqli_insert_id($yeshaul_con);
					$code = "JOUCODE000".$product_id;
					
					
					// Get Category Filed
					$sql_category = mysqli_query($yeshaul_con, "SELECT category_field FROM doc_category WHERE category_id = '".$category."'");
					$fetch_category = mysqli_fetch_array($sql_category);
					
					
					
					
				
					$filed = $fetch_category['category_field'];
					$sqlappent = $fetch_category['category_field'] ."='1'";

					
					
					$sqlupdate = "UPDATE  doc_journal
					SET
						journal_code = '".$code."',
						".$sqlappent."
					WHERE
						journal_id = '".$product_id."'
					
					";
					echo $sqlupdate;
					
					$sql_insert_tax = mysqli_query($yeshaul_con,$sqlupdate);
					
					$sqlquery2 = $sqladdinal;
					$sqlquery2 .= "'".$product_id."'".",";
					// Isert Addional Filed
					$sql_add = mysqli_query($yeshaul_con, "SELECT * FROM doc_filed_creation WHERE doc_status = '1'");
					while($addional = mysqli_fetch_array($sql_add))		
					{
						$filed = $addional['doc_filed_name'];
						$sqlvalu = $sql_result_data[$filed];
						$sqlquery2 .= "'".$sqlvalu."'".","; 
					}
					$sqlquery2 .= "'1')";
					//echo $sqlquery2;
					$sql_insert_tax = mysqli_query($yeshaul_con,$sqlquery2);
				}
				
				
			}
			
			else if($sql_result_data['journal_EISSN'] != "" && $sql_result_data['tempjournal_ISSN'] == "")
			{
				$sql_check_duplicate=mysqli_query($yeshaul_con,"SELECT * FROM doc_journal WHERE  journal_ISSN =  '".$sql_result_data['tempjournal_EISSN']."' AND journal_status='1'");
				$sql_result_check=mysqli_num_rows($sql_check_duplicate);
				
				if($sql_result_check > 0)
				{
					$fetch_dublicate = mysqli_fetch_array($sql_check_duplicate);
					
					$product_id = $fetch_dublicate['journal_id'];
					
					
					$journal_short_title = $fetch_dublicate['journal_short_title'];
					$journal_alternate_title = $fetch_dublicate['journal_alternate_title'];
					$journal_country = $fetch_dublicate['journal_country']; 
					$journal_publisher = $fetch_dublicate['journal_publisher'];
					$journal_ISSN = $fetch_dublicate['journal_ISSN'];
					$journal_EISSN = $fetch_dublicate['journal_EISSN']; 
					$journal_URL = $fetch_dublicate['journal_URL'];
					$journal_language = $fetch_dublicate['journal_language'];
					
					// Get OLD Record
					if($fetch_dublicate['journal_short_title'] == "")
					{
						$journal_short_title = $sql_result_data['tempjournal_short_title'];
					}
					
					if($fetch_dublicate['journal_alternate_title'] == "")
					{
						$journal_alternate_title = $sql_result_data['tempjournal_alternate_title'];
					}
					
					if($fetch_dublicate['journal_country'] == "")
					{
						$journal_country = $sql_result_data['tempjournal_country'];
					}
					
					if($fetch_dublicate['journal_publisher'] == "")
					{
						$journal_publisher = $sql_result_data['tempjournal_publisher'];
					}
					
					if($fetch_dublicate['journal_ISSN'] == "")
					{
						$journal_ISSN = $sql_result_data['tempjournal_ISSN'];
					}
					
					if($fetch_dublicate['journal_EISSN'] == "")
					{
						$journal_EISSN = $sql_result_data['tempjournal_EISSN'];
					}
					
					if($fetch_dublicate['journal_URL'] == "")
					{
						$journal_URL = $sql_result_data['tempjournal_URL'];
					}
					
					if($fetch_dublicate['journal_language'] == "")
					{
						$journal_language = $sql_result_data['tempjournal_language'];
					}
					
					
					// Get Category Filed
					$sql_category = mysqli_query($yeshaul_con, "SELECT category_field FROM doc_category WHERE category_id = '".$category."'");
					$fetch_category = mysqli_fetch_array($sql_category);
					
					
					
					
				
					$filed = $fetch_category['category_field'];
					$sqlappent = $fetch_category['category_field'] ."='1'";

					
					$sqlupdate = "UPDATE  doc_journal
					SET						
						".$sqlappent.",
						journal_language = '".addslashes($journal_language)."',
						journal_URL = '".addslashes($journal_URL)."',
						journal_EISSN = '".$journal_EISSN."',
						journal_ISSN = '".$journal_ISSN."',
						journal_publisher = '".addslashes($journal_publisher)."',
						journal_country = '".$journal_country."',
						journal_alternate_title = '".addslashes(nl2br($journal_alternate_title))."',
						journal_short_title = '".addslashes(nl2br($journal_short_title))."',
						journal_subject = '".$sql_result_data['tempjournal_subject']."'
					WHERE
						journal_id = '".$product_id."'
					
					";
					
					$sql_insert_tax = mysqli_query($yeshaul_con,$sqlupdate);
				}
				else
				{
					
					$sql_insert = mysqli_query($yeshaul_con,"INSERT INTO doc_journal 
					(
						journal_category,
						journal_short_title,
						journal_alternate_title,
						journal_country,
						journal_publisher,
						journal_ISSN,
						journal_EISSN,
						journal_URL,
						journal_language,
						journal_createdate,
						journal_subject,
						journal_status
					)
					VALUE
					(					
						'".$category."',
						'".addslashes(nl2br($sql_result_data['tempjournal_short_title']))."',
						'".addslashes(nl2br($sql_result_data['tempjournal_alternate_title']))."',
						'".$sql_result_data['tempjournal_country']."',
						'".$sql_result_data['tempjournal_publisher']."',
						'".$sql_result_data['tempjournal_ISSN']."',
						'".$sql_result_data['tempjournal_EISSN']."',
						'".addslashes(nl2br($sql_result_data['tempjournal_URL']))."',
						'".addslashes(nl2br($sql_result_data['tempjournal_language']))."',
						
						'".$created_date."',
						'".$sql_result_data['tempjournal_subject']."',
						'1'
					)
					");
					
					$product_id = mysqli_insert_id($yeshaul_con);
					$code = "JOUCODE000".$product_id;
					

					
					// Get Category Filed
					$sql_category = mysqli_query($yeshaul_con, "SELECT category_field FROM doc_category WHERE category_id = '".$category."'");
					$fetch_category = mysqli_fetch_array($sql_category);
					
					
					
					
				
					$filed = $fetch_category['category_field'];
					$sqlappent = $fetch_category['category_field'] ."='1'";

					
					
					$sqlupdate = "UPDATE  doc_journal
					SET
						journal_code = '".$code."',
						".$sqlappent."
					WHERE
						journal_id = '".$product_id."'
					
					";
					echo $sqlupdate;
					
					$sql_insert_tax = mysqli_query($yeshaul_con,$sqlupdate);
					
					$sqlquery2 = $sqladdinal;
					$sqlquery2 .= "'".$product_id."'".",";
					// Isert Addional Filed
					$sql_add = mysqli_query($yeshaul_con, "SELECT * FROM doc_filed_creation WHERE doc_status = '1'");
					while($addional = mysqli_fetch_array($sql_add))		
					{
						$filed = $addional['doc_filed_name'];
						$sqlvalu = $sql_result_data[$filed];
						$sqlquery2 .= "'".$sqlvalu."'".","; 
					}
					$sqlquery2 .= "'1')";
					//echo $sqlquery2;
					$sql_insert_tax = mysqli_query($yeshaul_con,$sqlquery2);
				}
			}
			else if($sql_result_data['tempjournal_short_title'] != "")
			{
				$sql_check_duplicate=mysqli_query($yeshaul_con,"SELECT * FROM doc_journal WHERE  journal_short_title =  '".$sql_result_data['tempjournal_short_title']."' AND journal_status='1'");
				$sql_result_check=mysqli_num_rows($sql_check_duplicate);
				
				if($sql_result_check > 0)
				{
					$fetch_dublicate = mysqli_fetch_array($sql_check_duplicate);
					
					$product_id = $fetch_dublicate['journal_id'];
					
					$journal_short_title = $fetch_dublicate['journal_short_title'];
					$journal_alternate_title = $fetch_dublicate['journal_alternate_title'];
					$journal_country = $fetch_dublicate['journal_country']; 
					$journal_publisher = $fetch_dublicate['journal_publisher'];
					$journal_ISSN = $fetch_dublicate['journal_ISSN'];
					$journal_EISSN = $fetch_dublicate['journal_EISSN']; 
					$journal_URL = $fetch_dublicate['journal_URL'];
					$journal_language = $fetch_dublicate['journal_language'];
					
					// Get OLD Record
					if($fetch_dublicate['journal_short_title'] == "")
					{
						$journal_short_title = $sql_result_data['tempjournal_short_title'];
					}
					
					if($fetch_dublicate['journal_alternate_title'] == "")
					{
						$journal_alternate_title = $sql_result_data['tempjournal_alternate_title'];
					}
					
					if($fetch_dublicate['journal_country'] == "")
					{
						$journal_country = $sql_result_data['tempjournal_country'];
					}
					
					if($fetch_dublicate['journal_publisher'] == "")
					{
						$journal_publisher = $sql_result_data['tempjournal_publisher'];
					}
					
					if($fetch_dublicate['journal_ISSN'] == "")
					{
						$journal_ISSN = $sql_result_data['tempjournal_ISSN'];
					}
					
					if($fetch_dublicate['journal_EISSN'] == "")
					{
						$journal_EISSN = $sql_result_data['tempjournal_EISSN'];
					}
					
					if($fetch_dublicate['journal_URL'] == "")
					{
						$journal_URL = $sql_result_data['tempjournal_URL'];
					}
					
					if($fetch_dublicate['journal_language'] == "")
					{
						$journal_language = $sql_result_data['tempjournal_language'];
					}
					
					
					
					// Get Category Filed
					$sql_category = mysqli_query($yeshaul_con, "SELECT category_field FROM doc_category WHERE category_id = '".$category."'");
					$fetch_category = mysqli_fetch_array($sql_category);
					
					
					
					
					
				
					$filed = $fetch_category['category_field'];
					$sqlappent = $fetch_category['category_field'] ."='1'";

					
					
					
					$sqlupdate = "UPDATE  doc_journal
					SET						
						".$sqlappent.",
						journal_language = '".addslashes(nl2br($journal_language))."',
						journal_URL = '".addslashes(nl2br($journal_URL))."',
						journal_EISSN = '".$journal_EISSN."',
						journal_ISSN = '".$journal_ISSN."',
						journal_publisher = '".addslashes($journal_publisher)."',
						journal_country = '".$journal_country."',
						journal_alternate_title = '".addslashes(nl2br($journal_alternate_title))."',
						journal_short_title = '".addslashes(nl2br($journal_short_title))."',
						journal_subject = '".$sql_result_data['tempjournal_subject']."'
					WHERE
						journal_id = '".$product_id."'
					
					";
					
					echo $sqlupdate;
					
					$sql_insert_tax = mysqli_query($yeshaul_con,$sqlupdate);
				}
				else
				{
					
					$sql_insert = mysqli_query($yeshaul_con,"INSERT INTO doc_journal 
					(
						journal_category,
						journal_short_title,
						journal_alternate_title,
						journal_country,
						journal_publisher,
						journal_ISSN,
						journal_EISSN,
						journal_URL,
						journal_language,
						journal_createdate,
						journal_subject,
						journal_status
					)
					VALUE
					(					
						'".$category."',
						'".addslashes(nl2br($sql_result_data['tempjournal_short_title']))."',
						'".addslashes(nl2br($sql_result_data['tempjournal_alternate_title']))."',
						'".$sql_result_data['tempjournal_country']."',
						'".$sql_result_data['tempjournal_publisher']."',
						'".$sql_result_data['tempjournal_ISSN']."',
						'".$sql_result_data['tempjournal_EISSN']."',
						'".addslashes(nl2br($sql_result_data['tempjournal_URL']))."',
						'".addslashes(nl2br($sql_result_data['tempjournal_language']))."',
						'".$created_date."',
						'".$sql_result_data['tempjournal_subject']."',
						'1'
					)
					");
					
					$product_id = mysqli_insert_id($yeshaul_con);
					$code = "JOUCODE000".$product_id;
					
					
					// Get Category Filed
					$sql_category = mysqli_query($yeshaul_con, "SELECT category_field FROM doc_category WHERE category_id = '".$category."'");
					$fetch_category = mysqli_fetch_array($sql_category);
					
					
					
					
				
					$filed = $fetch_category['category_field'];
					$sqlappent = $fetch_category['category_field'] ."='1'";

					
					
					$sqlupdate = "UPDATE  doc_journal
					SET
						journal_code = '".$code."',
						".$sqlappent."
					WHERE
						journal_id = '".$product_id."'
					
					";
					echo $sqlupdate;
					
					$sql_insert_tax = mysqli_query($yeshaul_con,$sqlupdate);
					
					$sqlquery2 = $sqladdinal;
					$sqlquery2 .= "'".$product_id."'".",";
					// Isert Addional Filed
					$sql_add = mysqli_query($yeshaul_con, "SELECT * FROM doc_filed_creation WHERE doc_status = '1'");
					while($addional = mysqli_fetch_array($sql_add))		
					{
						$filed = $addional['doc_filed_name'];
						$sqlvalu = $sql_result_data[$filed];
						$sqlquery2 .= "'".$sqlvalu."'".","; 
					}
					$sqlquery2 .= "'1')";
					$sqlquery2;
					
					$sql_insert_tax = mysqli_query($yeshaul_con,$sqlquery2);
					
				}
				
			}
				
			
			
			
			
			
		}
		$sql_truncate_data=mysqli_query($yeshaul_con,"truncate table doc_tempjournal");
		mysqli_close($yeshaul_con);		
		header("Location:../Excel-Upload.php?failed=1");
		
		
	}
}
