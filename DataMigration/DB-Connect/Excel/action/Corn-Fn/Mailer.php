<?php
require '../../include/dbconfig.php';
require '../../include/Common.php';
require '../../config/dbconfig.php';

error_reporting(0);

function moneyFormatIndia($num){
	$num_float = explode(".",$num);
    $explrestunits = "" ;
    if(strlen($num_float[0])>3){
        $lastthree = substr($num_float[0], strlen($num_float[0])-3, strlen($num_float[0]));
        $restunits = substr($num_float[0], 0, strlen($num_float[0])-2); // extracts the last three digits
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
			 $thecash = $explrestunits.$lastthree.'.00';
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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'library/composer/vendor/phpmailer/phpmailer/src/Exception.php';

/* The main PHPMailer class. */
require 'library/composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'library/composer/vendor/phpmailer/phpmailer/src/SMTP.php';



$mail = new PHPMailer;



/* include autoloader */
require_once 'dompdf/autoload.inc.php';


/* reference the Dompdf namespace */
use Dompdf\Dompdf;
use Dompdf\Options;
$options = new Options();
$options->set('enable_html5_parser', true);


$EMP_CODE = '';
$CMP_CODE = '';
$PAYROLLMONTH = '';
$MAILLISTID  = '';

// Select From Mail List
$sql_mailerlist = mysqli_query($yeshaul_con, "select * from automail where email_status = 0 LIMIT 0,10");
while($fetch_mailist = mysqli_fetch_array($sql_mailerlist))
{
	
	// Generate PDF
	
	$EMP_CODE = $fetch_mailist['empcde'];
	$CMP_CODE = $fetch_mailist['cmpcode'];
	$PAYROLLMONTH = $fetch_mailist['monyear'];
	$MAILLISTID  = $fetch_mailist['id'];
	
	//echo $EMP_CODE;
	//echo "<br/>";
	// 
	//include_once 'Pdf-Create-class.php';
	
	
	$dompdf = new Dompdf($options);
	
	
		$datasql = mysqli_query($yeshaul_con, "select * from employee_master where empcde='".$EMP_CODE."'");
		
		$data = mysqli_fetch_array($datasql);
		
		$emp_mail  = $data['mailid'];
	
	
		// Compeny Address
		
		$sql_company =  mysqli_query($yeshaul_con, "select * from company_master where CMPCDE ='".$data['cmpcode']."'");
		$fetch_company = mysqli_fetch_array($sql_company);
	
		$address2 = "";
		if($fetch_company['CMPADDRESS2'] != "") { $address2 = $fetch_company['CMPADDRESS2']; }
		
		$companyAddress = $fetch_company['CMPADDRESS1'].','.$address2.','.$fetch_company['CMPADDRESS3'].','.$fetch_company['CMPADDRESS4'];
		
	    $tbl = "";
        $tbl= $tbl.'<style>
		 @page {
            margin: 0px 0px 0px 0px !important;
            padding: 0px 0px 0px 0px !important;
        }
		
	body{ margin: 0; padding: 2; font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";}
	.heading0{ font-size: 20px; font-weight: bolder; }
	.heading1{ font-size: 16px; font-weight: bolder; }
	.heading3{ font-size: 14px; font-weight: bolder; }
	.heading4{ font-size: 12px; font-weight: 500; }
	.heading5{ font-size: 12px; font-weight: bolder; }
	.heading3 span{ font-size: 12px; font-weight: 500; color: #000000; }
	.red{ color: red;}
	
	
	.bluehead{ background: #4080df; border: 1px solid #454545;}
	.bluehead tr td { font-weight: bold; border-right: 1px solid #454545; text-align: center; font-size: 12px; height: 15px; }
	.bluehead tr td.end {  border-right: none;}
	
	
	.headiner0 tr td { font-weight: bold;  text-align: left; font-size: 12px; text-decoration: underline; }
	.headiner1 {}
	.headiner1 tr td { font-weight: 500; border-bottom: 1px solid #454545;  text-align: left; font-size: 12px; height: 15px;  }
	
	
	.grayhead tr td{ background: #ebebeb; border-bottom: 1px solid #EDEDED; text-align: left; font-size: 12px; height: 20px; }
	.bluehead tr td.endr{  border-right: none; font-size: 12px; padding-left: 5px;}
	.headiner1 tr td.endr{   border-right: none; font-size: 12px; padding-left: 5px;}
</style>

<table width="100%" cellpadding="5" cellspacing="5">
	<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0">
			
				<tr>
					<td width="120">
						<img src="../../assets/img/logo.png" width="120" height="120">
					</td>
					<td width="10">&nbsp;
						
					</td>
					
					<td valign="top" align="left">
						
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="2" class="heading0" height="40">Pay Slip</td>
							</tr>
							
							<tr>
								<td width="120" valign="top" class="heading1" height="30">Company Name</td>
								<td valign="top" class="heading3 red">'.$data['company'].'<br/>
									<span>'.$companyAddress.'</span>
								</td>
							</tr>
							
							<tr>
								<td class="heading1" height="20">Department</td>
								<td class="heading3">'.$data['dept'].'</td>
							</tr>';
							$str = $data['monyear'];
							$arr2 = str_split($str, 2);																	
							$period_date=date('M', mktime(0, 0, 0, $arr2[0], 10)) . '-' . $arr2[1]. $arr2[2];
							
							$tbl= $tbl.' <tr>
								<td class="heading1" height="20">Period</td>
								<td class="heading3">'.$period_date.'</td>
							</tr>
							
						</table>			
						
						
					</td>
				</tr>
				
			</table>
			
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100" class="heading4" height="25">Code & Name</td>
					<td width="2">:</td>
					<td class="heading5" width="300"><span style="background-color: #EDEDED; padding: 5px;">'.$data['empcde'].'</span>&nbsp;'.$data['empname'].'</td>
					<td width="100" class="heading4">Currency</td>
					<td width="2">:</td>
					<td class="heading5">'.$data['currency'].'</td>
				</tr>
				<tr>
					<td width="100" class="heading4">Desgnation</td>
					<td width="2" height="25">:</td>
					<td class="heading5">'.$data['designation'].'</td>
					<td width="100" class="heading4">Payment Mode</td>
					<td width="2">:</td>
					<td class="heading5">BANK</td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="bluehead" border="0">
				<tr>
					<td width="80">Type</td>
					<td width="120">Particulars</td>
					<td width="80">Amount</td>
					<td class="end">Remarks</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="headiner0" border="0">
				<tr>
					<td >Salary</td>					
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="headiner1" border="0">';
			    
				$saltot=0.00;	
		
				$stmt = mysqli_query($yeshaul_con,"SELECT * FROM payroll where pay_type='Salary' and empcde='".$data['empcde']."'");
				while($row = mysqli_fetch_array($stmt))
				{
					$saltot +=$row['prcamt'];  
					$tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180">'.$row['eddesc'].'</td>
					<td width="80" align="right" style="text-align: right;">'.number_format($row['prcamt'],2).'</td>
					<td class="endr">'.$row['remarks'].'</td>
				</tr>';
                }
                $tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180" align="right" style="text-align: right;"><strong>Total: </strong></td>
					<td width="80" align="right" style="text-align: right;"><strong>'.number_format($saltot,2).'</strong></td>
					<td class="endr"></td>
				</tr>
			</table>
		</td>
	</tr>
	
	
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="headiner0" border="0">
				<tr>
					<td >Absent-Deduction</td>					
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="headiner1" border="0">';	
			$abtot=0;						  
				$stmt1 = mysqli_query($yeshaul_con,"SELECT * FROM `payroll` where pay_type='Absent-Deduction' and empcde='".$data['empcde']."'");
				while($row1 = mysqli_fetch_array($stmt1))
				{
					$abtot +=$row1['prcamt'];
        $tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180">'.$row1['eddesc'].'</td>
					<td width="80" align="right" style="text-align: right;">-'.number_format($row1['prcamt'],2).'</td>
					<td class="endr">'.$row1['remarks'].'</td>
				</tr>';
				}
				$tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180" align="right" style="text-align: right;"><strong>Total: </strong></td>
					<td width="80" align="right" style="text-align: right;"><strong>-'.number_format($abtot,2).'</strong></td>
					<td class="end"></td>
				</tr>
			</table>
		</td>
	</tr>';
	$nttot=($saltot-$abtot);
	
	$tbl= $tbl.'<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="bluehead" border="0">
				<tr>
					<td width="20">&nbsp;</td>
					<td width="180" class="end" align="right" style="text-align: right;">Net Salary Paid</td>
					<td width="80" class="end" align="right" style="text-align: right;">'.number_format($nttot,2).'</td>
					<td class="end"></td>
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="headiner0" border="0">
				<tr>
					<td >Arrears</td>					
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="headiner1" border="0">';
			$arrtot=0;						  
				$stmt2 = mysqli_query($yeshaul_con,"SELECT * FROM `payroll` where pay_type='Arrear' and empcde='".$data['empcde']."'");
				while($row2 = mysqli_fetch_array($stmt2))
				{
					$arrtot +=$row2['prcamt'];
					$tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180">'.$row2['eddesc'].'</td>
					<td width="80" align="right" style="text-align: right;">'.number_format($row2['prcamt'],2).'</td>
					<td class="endr">'.$row2['remarks'].'</td>
				</tr>';
				}
           $tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180" align="right" style="text-align: right;"><strong>Total: </strong></td>
					<td width="80" align="right" style="text-align: right;"><strong>'.number_format($arrtot,2).'</strong></td>
					<td class="end"></td>
				</tr>
			</table>
		</td>
	</tr>
	
	
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="headiner0" border="0">
				<tr>
					<td>Other Deductions</td>					
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%"cellpadding="0" cellspacing="0" class="headiner1" border="0">';				
             $dectot=0;						  
				$stmt3 = mysqli_query($yeshaul_con,"SELECT * FROM `payroll` where pay_type='Deduction' and empcde='".$data['empcde']."'");
				while($row3 = mysqli_fetch_array($stmt3))
				{
					$dectot +=$row3['prcamt'];
					$tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180">'.$row3['eddesc'].'</td>
					<td width="80" align="right" style="text-align: right;">-'.number_format($row3['prcamt'],2).'</td>
					<td class="endr">'.$row3['remarks'].'</td>
				</tr>';
				}
				$tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180" align="right" style="text-align: right;"><strong>Total: </strong></td>
					<td width="80" align="right" style="text-align: right;"><strong>-'.number_format($dectot,2).'</strong></td>
					<td class="end"></td>
				</tr>
			</table>
		</td>
	</tr>
	
	
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="headiner0" border="0">
				<tr>
					<td>Other Payments</td>					
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="headiner1" border="0">';
			$othtot=0;						  
				$stmt4 = mysqli_query($yeshaul_con,"SELECT * FROM `payroll` where pay_type='Others-Payments-WPS' and empcde='".$data['empcde']."'");
				while($row4 = mysqli_fetch_array($stmt4))
				{
					$othtot +=$row4['prcamt'];
					$tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180">'.$row4['eddesc'].'</td>
					<td width="80" align="right" style="text-align: right;">'.number_format($row4['prcamt'],2).'</td>
					<td class="endr">'.$row4['remarks'].'</td>
				</tr>';
				}   
$tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180" align="right" style="text-align: right;"><strong>Total: </strong></td>
					<td width="80" align="right" style="text-align: right;"><strong>'.number_format($othtot,2).'</strong></td>
					<td class="end"></td>
				</tr>
			</table>
		</td>
	</tr>';
	$final=($nttot+$arrtot+$othtot)-($dectot);
	$word=convert_number_to_words($final);
	
	$tbl= $tbl.'<tr>
		<td>
			<table width="100%" cellpadding="0" cellspacing="0" class="bluehead" border="0">
				<tr>
					<td width="20">&nbsp;</td>
					<td width="180" class="end" style="text-align: right;">Net Amount Paid</td>
					<td width="80" class="end" style="text-align: right;">'.number_format($final,2).'</td>
					<td class="end"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" cellpadding="2" cellspacing="2" class="grayhead" border="0">
				<tr>
					
			<td style="padding-left: 20px;"><strong>In Words:'.$data['currency'].'&nbsp;'.$word.'&nbsp;only</strong></td>
					
				</tr>
			</table>
		</td>
	</tr>
	
	<tr>
		<td>
			<table width="100%" cellpadding="2" cellspacing="2" class="" border="0">
				<tr>
					
					<td style="padding-left: 20px;">This document is computer generated and does not require signature or Company’s stamp </td>
					
				</tr>
			</table>
		</td>
	</tr>
	
</table>';

		
		//echo $tbl;
		
	$dompdf->loadHtml($tbl);


	$pdf_name = "PAYSLIP_".$EMP_CODE."_".$PAYROLLMONTH.".pdf";

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();
	
    //$dompdf->stream($namepdf);

	$output = $dompdf->output();
	file_put_contents('../../pdf/'.$pdf_name, $output);
	$file_to_attach = '../../pdf/'.$pdf_name;
	$Msh = "Hi,<br/><br/>This is a system generated email .This email and any files transmitted with it are confidential and intended solely for the use of the individual to whom they are addressed. If you are not the named addressee, you should not disseminate, distribute or copy this email. Please notify IT/HR by email if you have received this email by mistake and delete this email from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing or taking any action in reliance on the contents of this information is strictly prohibited.";
	
	try {
	    
	    
	  
		
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet = 'UTF-8';
		$mail->Host = "outbound-eu1.ppe-hosted.com";
		$mail->SMTPAuth= true;
		$mail->Port = 587; // Or 587
		$mail->SMTPDebug = 4;
		$mail->Username= "admin108981@lonestar-lab.com";;
		$mail->Password= "pD5g#raHZKUJ0d#tmcRYYEpBJL3tElHZ";
		$mail->SMTPSecure = 'tls';
		$mail->From = 'HR-NoReply@lonestar-lab.com';
		$mail->FromName= 'HR-NoReply';
		$mail->isHTML(true);
		$mail->Subject = 'Pay slip  - Month '.$period_date;
		$mail->Body = $Msh;
		$mail->addAddress($emp_mail);
		$mail->AddAttachment( $file_to_attach ,  $pdf_name , 'base64', 'application/pdf' );
		if(!$mail->send()){
			$upt_failure = mysqli_query($yeshaul_con, "update automail set email_status=2,email_response_status='".$mail->ErrorInfo."' where id='".$MAILLISTID."'");
		 echo "Mailer Error: " . $mail->ErrorInfo;
		}else{
		$upt_success = mysqli_query($yeshaul_con, "update automail set email_status=1,email_response_status='SUCCESS' where id='".$MAILLISTID."'");
		 echo "E-Mail has been sent";
		}
		
	

} 
	catch (Exception $e) 
	{
		//$upt_failure = mysqli_query($yeshaul_con, "update automail set email_status=2,email_response_status='".$mail->ErrorInfo."' where id='".$MAILLISTID."'");
		//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

	
}
