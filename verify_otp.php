<?php
require_once 'include/Auto-Load.php';
$otp = $_POST['otp'];
$mobile_number = $_POST['mobile_number'];

date_default_timezone_set("Asia/Kolkata");
$timestamp=date('Y-m-d H:i:s');

//todocheck Otp Existing or not 

$check_exist = mysqli_query($db, "SELECT * FROM otp WHERE otp = '".$otp."' AND mobile='".$mobile_number."' order by id desc limit 1");
$num_otp=mysqli_num_rows($check_exist);

// echo $num_otp;

if ($num_otp != 0) {
    //TODO TIME CHECK 

    $fetch_details = mysqli_fetch_array($check_exist);

     $otp_date = $fetch_details['created_at'];

    $minute = minutes_check($timestamp, $otp_date); //TODO CALCULATE MINUTE
//    echo  $minute;
    //exit;
    if (15 >= $minute) {
        $delete_otp = mysqli_query($db, "DELETE FROM otp WHERE  mobile='".$mobile_number."'");
   

        $a_user=array('status'=>true,'message'=>'Otp Verified!');
        echo json_encode($a_user,JSON_UNESCAPED_SLASHES); 

        //TODO REMOVE TABLE VALUE
    } else {

        $a_user=array('status'=>false,'message'=>'Otp Expired!');
        echo json_encode($a_user,JSON_UNESCAPED_SLASHES); 
         
    }
} else {
    $a_user=array('status'=>false,'message'=>'Otp Invalide!');
    echo json_encode($a_user,JSON_UNESCAPED_SLASHES); 
}


exit;

			$sql_insert = mysqli_query($db, "INSERT INTO order_master (
										mobile,
										otp,
										created_at,
						
									)
									VALUES
									(
										'".$otp."',
										'".$mobile_number."',
										'".$timestamp."',								
										)
												");

					$sql_update  = mysqli_query($db, "UPDATE order_master SET order_code = '".$orderCode."' , order_total = '".$total_selling."' , order_total_buing = '".$total_buying."' WHERE order_id = '".$order_id."'");
					print_r(json_encode([
							"number" => "1",
							"order_id" => $orderCode
                    ]));
			


                     function minutes_check($current_time, $otpdate)
					{
				
						date_default_timezone_set('Asia/Kolkata');
						$diff = strtotime($current_time) - strtotime($otpdate);
						$day    = floor($diff / (60 * 60 * 24));
						$hour   = floor(($diff - ($day * 60 * 60 * 24)) / (60 * 60));
						$minute = floor(($diff - ($day * 60 * 60 * 24) - ($hour * 60 * 60)) / 60);
				
						return $minute;
					}



?>