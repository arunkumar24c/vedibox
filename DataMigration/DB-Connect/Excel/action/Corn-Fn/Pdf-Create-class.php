<?php


		$yeshaul_con = new mysqli(DBHost, DBUser, DBPassword, Databse);
	
		$datasql = mysqli_query($yeshaul_con, "select * from employee_master where empcde='".$EMP_CODE."'");
		
		$data = mysqli_fetch_array($datasql);
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
									<span>P.O.BOX 8817, Al Jadaf, Dubai, United Arab Emirates</span>
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
					<td width="80" align="right" style="text-align: right;">'.number_format($row1['prcamt'],2).'</td>
					<td class="endr">'.$row1['remarks'].'</td>
				</tr>';
				}
				$tbl= $tbl.'<tr>
					<td width="20">&nbsp;</td>
					<td width="180" align="right" style="text-align: right;"><strong>Total: </strong></td>
					<td width="80" align="right" style="text-align: right;"><strong>'.number_format($abtot,2).'</strong></td>
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
	
</table>';

		
		//echo $tbl;
		
	$dompdf->loadHtml($tbl);

	function RandomString($length) {
		$keys = array_merge(range('a', 'z'), range('A', 'Z'));
		for($i=0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}
		return $key;
	}


	$pdf_name = "PAYSLIP_".$EMP_CODE."_".$PAYROLLMONTH.".pdf";

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();
	$namepdf =  RandomString(10);
    //$dompdf->stream($namepdf);

	$output = $dompdf->output();
	file_put_contents('../../pdf/'.$pdf_name, $output);
