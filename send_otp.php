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

date_default_timezone_set("Asia/Kolkata");
$timestamp=date('Y-m-d H:i:s');


// Insert Order

// echo $mobile_number;


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
				send_otp($mobile_number,$db);
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
function send_otp($mobile,$db)
{


    date_default_timezone_set("Asia/Kolkata");
$timestamp=date('Y-m-d H:i:s');

$otp = rand(1231,7879);

$fields = array(
    "variables_values" => $otp,
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

   // $sql_insert = mysqli_query($db, "INSERT INTO `otp` (`mobile`, `otp`, `created_at`) VALUES ( '8098960602', '1234', '2023-07-28 10:50:50.000000')");

   $check_exist = mysqli_query($db, "SELECT * FROM otp WHERE  mobile='".$mobile."' order by id desc limit 1");
   $num_otp=mysqli_num_rows($check_exist);
   
   // echo $num_otp;
   
   if ($num_otp != 0) {
       //TODO TIME CHECK 
       $sql_update  = mysqli_query($db, "UPDATE otp SET otp = '".$otp."'  WHERE mobile = '".$mobile."'");
   }else{
    $sql_insert =  "INSERT INTO otp (mobile,otp,created_at) VALUES('".$mobile."','".$otp."','".$timestamp."')";
    $sql_insert2=   mysqli_query($db,$sql_insert);
   }

    print_r(json_encode([
        "number" => "1",
        "msg" => "Otp send Successfully!",
        "otp_receive_mobile_number" => $mobile,
        ])
    );
}
}




	//echo '[{"order_id":}$orderCode]'
	//header("Location:order1.php");
?>