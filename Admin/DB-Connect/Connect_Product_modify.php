<?php
require '../include/Auto-Load.php';
 ini_set("memory_limit","-100");
ini_set("max_execution_time","3000");

ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
ini_set('max_file_uploads', '500');



if(isset($_POST['submit_product']))
{

	$product_id=$_POST['product_id'];
	
	$category_id=$_POST['category'];
	$product_name=$_POST['product_name'];
	$product_mrp=$_POST['product_mrp'];
	$product_price=$_POST['product_price'];
	$product_buying_price=$_POST['product_buying_price'];
	$product_images="";
	$product_status=$_POST['product_status'];
	$old_images = $_POST['old_images'];
	
	if(!empty($_FILES['images']['name'])) 
		{
			

			
					$dest_path2 = "";
					// get details of the uploaded file
					$fileTmpPath = $_FILES['images']['tmp_name'];
					$fileName = $_FILES['images']['name'];
					$fileSize = $_FILES['images']['size'];
					$fileType = $_FILES['images']['type'];
					$fileNameCmps = explode(".", $fileName);
					$fileExtension = strtolower(end($fileNameCmps));

					// sanitize file-name
					$newFileName = $_FILES['images']['name'];

					// check if file has one of the following extensions
					$allowedfileExtensions = array('png','jpg','jpeg');

					if (in_array($fileExtension, $allowedfileExtensions))
					{

						  $uploadFileDir = '../FILES/';
						  $dest_path = $uploadFileDir . $newFileName;

						  if(move_uploaded_file($fileTmpPath, $dest_path)) 
						  {
							 
								$message ='File is successfully uploaded.';
						  }
						  else 
						  {
												
						  }
					}
					else
					{
							

					}


						if(is_file($dest_path))
						{
							
							$product_images = str_replace("../","",$dest_path);

							
						}
						else
						{



						}
		}

		else{

				$product_images = $old_images;
		}
	
	
	
	
	 $product_status = 1;


// CRUD - insert
	

if(!empty($product_name))
	
{
	

	
	
	$insert = mysqli_query($db, "UPDATE   product_master
								SET
									
									category_id = '".$category_id."',
									product_name = '".$product_name."',
									product_mrp = '".$product_mrp."',
									product_price = '".$product_price."',
									product_buying_price = '".$product_buying_price."',
									product_images = '".$product_images."'
								WHERE
									
								 product_id = '".$product_id."'
									 
									
								");
	
	
	echo  "UPDATE   product_master
								SET
									
									category_id = '".$category_id."',
									product_name = '".$product_name."',
									product_mrp = '".$product_mrp."',
									product_price = '".$product_price."',
									product_buying_price = '".$product_buying_price."',
									product_images = '".$product_images."'
								WHERE
									
								 product_id = '".$product_id."'
									 
									
								";
	

		
		header("location:../product.php");
	}
	
	 
}
 

 
?>