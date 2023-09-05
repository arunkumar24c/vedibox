<?php
require_once 'include/Auto-Load.php';
$state = $_POST['state'];
$city = $_POST['city'];
$name = $_POST['name'];
$mobile_number = $_POST['mobile_number'];
$email = $_POST['email'];
$address = $_POST['address'];
$product_quantity = $_POST['product_quantity'];
$dateorder = date("Y-m-d");
$order_status = 1;
$sub_total = $_POST['subtotal_val'];
// Insert Order

// print_r($product_quantity);
// exit;

function validate_mobile($mobile)
{
    return preg_match('/^[0-9]{10}+$/', $mobile);
}


if($mobile_number != "")
{	
	if(validate_mobile($mobile_number) == false)
	{
		print_r(json_encode([
				"number" => "2",
				"msg" => "Invalid Mobile number"
				])
			);
		
	}
	else
	{
		if($city == "" || $address  == "" || $state == "")
		{
			print_r(json_encode([
					"number" => "2",
					"msg" => "Invalid Address"
					])
				);

		}
	
		else
		{

			if($sub_total < 2500)
			{
				print_r(json_encode([
					"number" => "2",
					"msg" => "Minimum Order 2500"
					])
				);
			}
			else
			{

				//Check send and check otp
				//send_otp($mobile_number);


			$sql_insert = mysqli_query($db, "INSERT INTO order_master 
									(
										order_date,
										order_name,
										order_email,
										order_phone,
										order_address,
										order_state,
										order_city,
										order_status
									)
									VALUES
									(
										'".$dateorder."',
										'".$name."',
										'".$email."',
										'".$mobile_number."',
										'".$address."',
										'".$state."',
										'".$city."',
										'".$order_status."'									
										)
												");

				$order_id = mysqli_insert_id($db);

				$total_selling = 0;
				$total_buying = 0;

				//print_r($product_quantity);

				foreach($product_quantity as $val)
				{
					$data = explode("/",$val);

					// Get Product Code

					$sql_product = mysqli_query($db, "SELECT * FROM product_master WHERE product_code = '".$data[0]."'");
				//	echo "SELECT * FROM product_master WHERE product_code = '".$data[0]."'";
				//	exit();
					$fetch_product = mysqli_fetch_array($sql_product);

					$price = $fetch_product['product_price'];

					$price_buying = $fetch_product['product_buying_price'];

					$product_anme = $fetch_product['product_name'];

					$total_selling = $total_selling +  $price*$data[1];

					$total_buying = $total_buying + $price_buying*$data[1];

					$sql_insert =  "INSERT INTO order_details 
												(
													order_id,
													product_id,
													product_name,
													product_price,
													product_price_buying,
													product_qty,
													product_total,
													product_total_or,
													product_status
												)
												VALUES
												(
													'".$order_id."',
													'".$data[0]."',
													'".$product_anme."',
													'".$price."',
													'".$price_buying."',
													'".$data[1]."',
													'".$price*$data[1]."',
													'".$price_buying*$data[1]."',
													'1'
												)
												";

												$sql_insert_1 = mysqli_query($db,$sql_insert);
				}

			

					// Order Code
					// Order Update
					$orderCode = "ORD00".$order_id;
					$sql_update  = mysqli_query($db, "UPDATE order_master SET order_code = '".$orderCode."' , order_total = '".$total_selling."' , order_total_buing = '".$total_buying."' WHERE order_id = '".$order_id."'");
					print_r(json_encode([
							"number" => "1",
							"order_id" => $orderCode
							])
						);
			}

		}
	}
	
}
else
{
	print_r(json_encode([
				"number" => "2",
				"msg" => "Invalid Mobile number"
				])
			);
}


function send_otp($mobile)
{

$fields = array(
    "variables_values" => "5599",
    "route" => "otp",
    "numbers" => $mobile,
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
    "authorization: qZ5NzHrCwASP4zrM438lsVzl7rztTS7Fg81L4yZVFV1970csQkQkYXVdjIjI",
    "accept: */*",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}

	//echo '[{"order_id":}$orderCode]'
	//header("Location:order1.php");
?>