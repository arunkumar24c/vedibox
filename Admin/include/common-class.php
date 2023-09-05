<?php
function dateformatchange($datevale,$format)
{
	
	if($datevale != "")
	{
		return date($format, strtotime($datevale));
	}
	else
	{
		return "--";
	}
}

function splString($str)
{
	$str=preg_replace('/[^A-Z0-9]/i','',strtoupper(trim($str)));
	$str2=strtoupper($str);
	return $str;
	
}

function moneyFormatIndia($num){
	$num_float = explode(".",$num);
    $explrestunits = "" ;
    if(strlen($num_float[0])>3){
        $lastthree = substr($num_float[0], strlen($num_float[0])-3, strlen($num_float[0]));
        $restunits = substr($num_float[0], 0, strlen($num_float[0])-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
		if($num_float[1] != '')
		{
       		 $thecash = $explrestunits.$lastthree.'.'.$num_float[1];
		}
		else
		{
			 $thecash = $explrestunits.$lastthree;
		}
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}								  	  




function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
		1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}


function formatcurrency($floatcurr, $curr = "AED"){
      
        $currencies['AED'] = array(2,'.',',');          //  UAE Dirham
      

        function formatinr($input){
            //CUSTOM FUNCTION TO GENERATE ##,##,###.##
            $dec = "";
            $pos = strpos($input, ".");
            if ($pos === false){
                //no decimals   
            } else {
                //decimals
                $dec = substr(round(substr($input,$pos),2),1);
                $input = substr($input,0,$pos);
            }
            $num = substr($input,-3); //get the last 3 digits
            $input = substr($input,0, -3); //omit the last 3 digits already stored in $num
            while(strlen($input) > 0) //loop the process - further get digits 2 by 2
            {
                $num = substr($input,-2).",".$num;
                $input = substr($input,0,-2);
            }
            return $num . $dec;
        }


        if ($curr == "INR"){    
            return formatinr($floatcurr);
        } else {
            return number_format($floatcurr,$currencies[$curr][0],$currencies[$curr][1],$currencies[$curr][2]);
        }
		
		
		
		
    }
	
	
	function formatcurrency1($floatcurr, $curr = "AED"){
      
        $currencies['AED'] = array(2,'.',',');          //  UAE Dirham
      

        function formatinr1($input){
            //CUSTOM FUNCTION TO GENERATE ##,##,###.##
            $dec = "";
            $pos = strpos($input, ".");
            if ($pos === false){
                //no decimals   
            } else {
                //decimals
                $dec = substr(round(substr($input,$pos),2),1);
                $input = substr($input,0,$pos);
            }
            $num = substr($input,-3); //get the last 3 digits
            $input = substr($input,0, -3); //omit the last 3 digits already stored in $num
            while(strlen($input) > 0) //loop the process - further get digits 2 by 2
            {
                $num = substr($input,-2).",".$num;
                $input = substr($input,0,-2);
            }
            return $num . $dec;
        }


        if ($curr == "INR"){    
            return formatinr($floatcurr);
        } else {
            return number_format($floatcurr,$currencies[$curr][0],$currencies[$curr][1],$currencies[$curr][2]);
        }
		
		
		
		
    }

	
	function formatcurrency2($floatcurr, $curr = "AED"){
      
        $currencies['AED'] = array(2,'.',',');          //  UAE Dirham
      

        function formatinr2($input){
            //CUSTOM FUNCTION TO GENERATE ##,##,###.##
            $dec = "";
            $pos = strpos($input, ".");
            if ($pos === false){
                //no decimals   
            } else {
                //decimals
                $dec = substr(round(substr($input,$pos),2),1);
                $input = substr($input,0,$pos);
            }
            $num = substr($input,-3); //get the last 3 digits
            $input = substr($input,0, -3); //omit the last 3 digits already stored in $num
            while(strlen($input) > 0) //loop the process - further get digits 2 by 2
            {
                $num = substr($input,-2).",".$num;
                $input = substr($input,0,-2);
            }
            return $num . $dec;
        }


        if ($curr == "INR"){    
            return formatinr($floatcurr);
        } else {
            return number_format($floatcurr,$currencies[$curr][0],$currencies[$curr][1],$currencies[$curr][2]);
        }
		
		
		
		
    }



function notificationBox($type, $message, $extra = null, $url) {
	$msg = '<div class="alert alert-'.$type.' ks-solid" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true" class="la la-close"></span>
                                        </button>
                                        <strong>'.$message.'
                                    </div>';	
	header("Location:../Add_Country.php?error=".$message);
}

function Get_Quotation_Type($db,$quotation_id)
{
	$show_action = "";
	$sql_200Q = mysqli_query($db, "SELECT * FROM ps_sales_quotation_master_details  WHERE quotation_id = '".$quotation_id."' AND (quotation_details_status = '1' OR quotation_details_status = '4' ) GROUP BY quotation_type");
	
	while($fech_quotation = mysqli_fetch_array($sql_200Q))
	{
		
		if($fech_quotation['quotation_type'] == 1)
		{
			$sh = '<span class="badge badge-info">Sales</span>&nbsp;';
		}
		if($fech_quotation['quotation_type'] == 2)
		{
			$sh = '<span class="badge badge-warning">Calibration</span>&nbsp;';
		}
		if($fech_quotation['quotation_type'] == 3)
		{
			$sh = '<span class="badge badge-cranberry">Testing</span>&nbsp;';
		}
		if($fech_quotation['quotation_type'] == 4)
		{
			$sh = '<span class="badge badge-primary">Services</span>&nbsp;';
		}
		
		
		
		
		if($show_action == "")
		{
			$show_action = $sh;
		}
		else
		{
			$show_action = $show_action." ".$sh;
		}
		
	}
	
	echo $show_action;
	
}

function Get_Type($x)
{
	$show_action = "";
	$datta = explode(",",$x);
	foreach($datta as $val)
	{
		
		if($val == 1)
		{
			$sh = '<span class="badge badge-info">Sales</span>&nbsp;';
		}
		if($val == 2)
		{
			$sh = '<span class="badge badge-warning">Calibration</span>&nbsp;';
		}
		if($val == 3)
		{
			$sh = '<span class="badge badge-cranberry">Testing</span>&nbsp;';
		}
		if($val == 4)
		{
			$sh = '<span class="badge badge-primary">Services</span>&nbsp;';
		}
		
		
		
		
		if($show_action == "")
		{
			$show_action = $sh;
		}
		else
		{
			$show_action = $show_action." ".$sh;
		}
	}
	echo $show_action;
}

function add_months($months, DateTime $dateObject) 
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }

function endCycle($d1, $months)
    {
        $date = new DateTime($d1);

        // call second function to add the months
        $newDate = $date->add(add_months($months, $date));

        // goes back 1 day from date, remove if you want same day of month
        $newDate->sub(new DateInterval('P1D')); 

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('Y-m-d'); 

        return $dateReturned;
    }
function timeshow($date)
{
	
	$start_date = date('Y-m-d h:i:s', strtotime($date)); 
	$end_date = date('Y-m-d h:i:s'); 
					
					
					$date1 = new DateTime($start_date, new DateTimeZone('Asia/Kolkata'));
					$date2 = new DateTime($end_date,new DateTimeZone('Asia/Kolkata'));
					

					$interval = date_diff($date1, $date2);

					
					
					if($interval->format("%a") > 0)
					{
						return $interval->format("%a")."&nbsp; Days &nbsp;";
					}
					if($interval->format("%h") > 0)
					{
						return $interval->format("%h:%I")."&nbsp; hours ago";
					}
					else
					{
							return $interval->format("%h:%I")."&nbsp; minutes ago";
					}
}

function get_username($db, $id)
{
	$sql_200Q = mysqli_query($db, "SELECT * FROM admin  WHERE id = '".$id."'");
	$feth_ser = mysqli_fetch_array($sql_200Q);
	
	echo $feth_ser['name'];
}


function Get_lead_followup($lead)
{

		
		if($lead == 1)
		{
			$sh = '<span class="badge badge-info">Call</span>&nbsp;';
		}
		if($lead == 2)
		{
			$sh = '<span class="badge badge-warning">Email</span>&nbsp;';
		}
		if($lead == 3)
		{
			$sh = '<span class="badge badge-cranberry">Meeting</span>&nbsp;';
		}
		
		
		
		
		
		
	
	echo $sh;
	
}

function Get_User_name($db,$userid)
{
	$sql_200Q = mysqli_query($db, "SELECT * FROM admin  WHERE id = '".$userid."'");
	
	$fech_quotation = mysqli_fetch_array($sql_200Q);
	
	echo $fech_quotation['name'];	
}


// username return with enqury and lead 9-4-2022
function Get_User_name_string($db,$userid)
{
	$sql_200Q = mysqli_query($db, "SELECT * FROM admin  WHERE id = '".$userid."'");
	
	$fech_quotation = mysqli_fetch_array($sql_200Q);
	
	return $fech_quotation['name'];	
}

function Get_attion_name_string($db,$attionid,$dealtyp,$customerID,$leadid)
{
	if($dealtyp == 2)
	{
		$sql_200Q = mysqli_query($db, "SELECT crm_conatctname,crm_lastname FROM crm_customer_contacts  WHERE crm_contact_id = '".$attionid."'");
	
		$fech_quotation = mysqli_fetch_array($sql_200Q);

		return $fech_quotation['crm_conatctname'].' '.$fech_quotation['crm_lastname'];	
	}
	else
	{
		$sql_200Q = mysqli_query($db, "SELECT crm_lead_first_name,crm_lead_last_name FROM crm_customer_lead  WHERE crm_lead_id = '".$leadid."'");
	
		$fech_quotation = mysqli_fetch_array($sql_200Q);

		return $fech_quotation['crm_lead_first_name'].' '.$fech_quotation['crm_lead_last_name'];	
	}
	
}


function Get_Data($db,$userid,$table,$filed,$wher)
{
	$sql_200Q = mysqli_query($db, "SELECT ".$filed." as val FROM ".$table."  WHERE ".$wher." = '".$userid."'");
	
	$fech_quotation = mysqli_fetch_array($sql_200Q);
	
	echo $fech_quotation['val'];
	
}
function duration($startdate)
{
	
				$start_date = date('Y-m-d H:i:s', strtotime($startdate)); 
				$end_date = date('Y-m-d H:i:s'); 
					
					
					$date1 = new DateTime($start_date, new DateTimeZone('Asia/Kolkata'));
					$date2 = new DateTime($end_date,new DateTimeZone('Asia/Kolkata'));
					

					$interval = date_diff($date1, $date2);

					
					
					if($interval->format("%a") < 0)
					{
						return '<span class="badge badge-danger">'.$interval->format('%a').'&nbsp; Days &nbsp;</span>';
					}
					if($interval->format("%H") < 0)
					{
						return '<span class="badge badge-info">'.$interval->format('%H:%I').'&nbsp; hours &nbsp;</span>';
						//return $interval->format("%H:%I")."&nbsp; hours ago";
					}
					if($interval->format("%a") > 0)
					{
						return '<span class="badge badge-success">'.$interval->format('%a').'&nbsp; Days &nbsp;</span>';
					}
					if($interval->format("%H") > 0)
					{
						return '<span class="badge badge-success">'.$interval->format('%H:%I').'&nbsp; hours &nbsp;</span>';
						//return $interval->format("%H:%I")."&nbsp; hours ago";
					}
					else
					{
						return '<span class="badge badge-info">'.$interval->format('%H:%I').'&nbsp; minutes &nbsp;</span>';
						//return $interval->format("%H:%I")."&nbsp; minutes ago";
					}
	
}

function durationtwo($startdate,$enddate)
{
	
				$start_date = date('Y-m-d H:i:s', strtotime($startdate)); 
				$end_date = date('Y-m-d H:i:s', strtotime($enddate)); 
					
					
					$date1 = new DateTime($start_date, new DateTimeZone('Asia/Kolkata'));
					$date2 = new DateTime($end_date,new DateTimeZone('Asia/Kolkata'));
					

					$interval = date_diff($date1, $date2);

					
					
					if($interval->format("%a") > 0)
					{
						return '<span class="badge badge-danger">'.$interval->format('%a').'&nbsp; Days &nbsp;</span>';
					}
					if($interval->format("%H") > 0)
					{
						return '<span class="badge badge-info">'.$interval->format('%H:%I').'&nbsp; hours &nbsp;</span>';
						//return $interval->format("%H:%I")."&nbsp; hours ago";
					}
					else
					{
						return '<span class="badge badge-info">'.$interval->format('%H:%I').'&nbsp; minutes &nbsp;</span>';
						//return $interval->format("%H:%I")."&nbsp; minutes ago";
					}
	
}


// CRM
function get_customer_type($type)
{
	if($type == 1)
	{
		return '<span class="badge badge-success">Customer</span>';
	}
	if($type == 2)
	{
		return '<span class="badge badge-info">Supplier</span>';
	}
	if($type == 3)
	{
		return '<span class="badge badge-cranberry">Customer & Supplier</span>';
	}
}

function get_country($db, $countrycode)
{	
	$sql_200Q = mysqli_query($db, "SELECT country_name FROM ms_country_master  WHERE  country_id = '".$countrycode."'");
	
	$fech_country_master = mysqli_fetch_array($sql_200Q);
	
	echo $fech_country_master['country_name'];
}

function get_state($db, $statecode)
{	
	$sql_200Q = mysqli_query($db, "SELECT state_name FROM ms_state_master  WHERE  state_id = '".$statecode."'");
	
	$fech_state_master = mysqli_fetch_array($sql_200Q);
	
	echo $fech_state_master['state_name'];
}


function  get_country_re($db, $countrycode)
{	
	$sql_200Q = mysqli_query($db, "SELECT country_name FROM ms_country_master  WHERE  country_id = '".$countrycode."'");
	
	$fech_country_master = mysqli_fetch_array($sql_200Q);
	
	return $fech_country_master['country_name'];
}

function get_state_re($db, $statecode)
{	
	$sql_200Q = mysqli_query($db, "SELECT state_name FROM ms_state_master  WHERE  state_id = '".$statecode."'");
	
	$fech_state_master = mysqli_fetch_array($sql_200Q);
	
	return $fech_state_master['state_name'];
}



function Get_Customer($db, $customer)
{
	
	$sql_200Q = mysqli_query($db, "SELECT crm_organization_name FROM crm_customer_master  WHERE  crm_client_id = '".$customer."'");
	
	$fech_state_master = mysqli_fetch_array($sql_200Q);
	
	echo $fech_state_master['crm_organization_name'];
}