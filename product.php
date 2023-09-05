<?php
require_once 'include/Auto-Load.php';
?>
<html>
<body>

</body>
</html>
<?php include 'html-head.php';?>
<?php include 'nav.php';?>

<!--Mobile Navbar-->  
<!--Products-->
<div class="container-fluid">
    <div class="row">
        <div class="w-100">
    <link rel="stylesheet" type="text/css" href="order/form.css">

    <link href="order/select2/css/select2.min.css" rel="stylesheet" />
    <link href="order/select2/css/select2-bootstrap4.min.css" rel="stylesheet">

    <link href="order/order.css" rel="stylesheet">
    <link href="order/responsive.css" rel="stylesheet">

    <script type="text/javascript" src="order/common.js"></script>
    <script type="text/javascript" src="order/list.js"></script>

                        <style>
                            #top_section table td { font-size: 15px; line-height: 15px; padding: 10px; font-weight: bold; }
                                                            #top_section { background-color: #ffcf14; z-index: 1; }
                                                                                        #top_section table td { color: #000000; }
                            
                            .pricelist_table thead tr td { text-align: center; font-weight: bold; padding: 10px; font-size: 15px; }
                                                            .pricelist_table thead tr { background-color: #0a7070 !important; }
                                                                                        .pricelist_table thead tr { color: #ffffff !important; }
                            
                            .pricelist_table tr.category_row td { text-align: center; text-transform: uppercase; font-weight: bold; padding: 10px; }
                            .grid_products h1.category_row { text-transform: uppercase; }
                                                            .pricelist_table tr.category_row { background-color: #ffcf14 !important; }
                                                                                        .pricelist_table tr.category_row { color: #000000 !important; }
                            
                                                            .pricelist_table tr.product_row td { color: #000000 !important; }
                            
                                                            .pricelist_table tr:nth-child(odd) { background-color: #f0e982; }
                                                                                        .pricelist_table tr:nth-child(even) { background-color: #f0e982; }
                            
                                                            .pricelist_table tr { border: 2px solid #000000; }
                                .pricelist_table tr td { vertical-align: middle; padding: 5px; border: 2px solid #000000; font-size: 16px; font-weight: 600; }
                            
                                                            .strike { text-decoration-color: #ff0000 !important; text-decoration-thickness: 2px !important; }
                                

                            .grid_cart { display: none; }
                        </style>

                        <button type="button" data-toggle="modal" data-target="#myModal" class="d-none cart_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Selected Products</h4>
            <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
        </div>
        
        <!-- Modal body -->
        <div class="modal-body px-2 py-2">
            <div class="table-responsive">
                <div id="top_section">
                    <table cellpadding="0" cellspacing="0" style="margin: auto;">
                        <tr>
                            <td style="width: 175px;"> Total Products : <span class="product_count"></span> </td>
                            <td style="width: 275px;"> Discount Total : <span class="discount_total"></span> </td>
                            <td style="width: 275px;"> Overall Total : <span class="overall_total"></span> </td>
                        </tr>
                    </table>
                </div>
                <table cellpadding="0" cellspacing="0" class="pricelist_table table card_products_table mb-0">
                    <thead>
                        <tr>
                            <td>Product Name</td>
                            <td style="width: 75px;">Actual Price</td>
                            <td style="width: 75px;" >Price</td>
                            <td style="width: 75px;">Quantity</td>
                            <td style="width: 125px;">Amount</td>
                            <td style="width: 50px;">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>    
                </table>
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_cart" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" onClick="Javascript:GoToSubmit();">Submit</button>
        </div>
        
        </div>
    </div>
</div>

<div id="top_section" class="table-responsive sticky-top">
    <div class="row">
    </div>
    <table cellpadding="0" cellspacing="0" style="margin: auto;">
        <tr>
            <td> Total Products : <span class="product_count"></span> </td>
            <td> Discount Total : <span class="discount_total"></span> </td>
            <td> Overall Total : <span class="overall_total"></span> </td>
            <td style="width: 50px; text-align: center;">
                <img src="order/cart.png" class="img-fluid mx-auto" style="cursor: pointer;" onClick="Javascript:ShowCart();">
            </td>
        </tr>
    </table>
</div>

<table cellpadding="0" cellspacing="0" class="pricelist_table table pricelist_products">
    <thead>
        <tr>
           
                        <td >Images</td>
                        <td class="product_name">Product Name</td>
            <td class="medium_visiable">Content</td>
            <td>Actual Price</td>
            <td  >Amount</td>
            <td>Quantity</td>
            <td>Total</td>
        </tr>
    </thead>
    <tbody>
		<?php
		$sql_crakercate = mysqli_query($db, "SELECT * FROM category_master ");
		$k = 1;
		while($fetch_creker_cat = mysqli_fetch_array($sql_crakercate))
		{
		?>
          <tr class="category_row">
               <td colspan="7"><?php echo $fetch_creker_cat['category_name']; ?></td>
          </tr>
		<?php
		$sql_craker = mysqli_query($db, "SELECT * FROM product_master WHERE category_id = '".$fetch_creker_cat['category_id']."'");
		
		while($fetch_creker = mysqli_fetch_array($sql_craker))
		{
		?>
		  <tr class="product_row">
			 
                    
			  				<td >
								<?php if($fetch_creker['product_images'] != "") { ?> <img src="Admin/<?php echo $fetch_creker['product_images']; ?>" width="70" height=""> <?php } else { ?> <img src="images/logo-removebg-preview.png" width="70" height="">  <?php } ?> 
								</td>
                            <td id="<?php echo $fetch_creker['product_code']; ?>" class="product_name text-center">
								<?php echo $fetch_creker['product_name']; ?></td>
                            <td class="product_content text-center medium_visiable">1PKT</td>
                            <td class="text-center"><span class="strike actual_price"> <?php echo $fetch_creker['product_mrp']; ?> </span>
                                                <span class="small_visible">1PKT</span>
                            </td>
                            <td class="price text-center "><?php echo $fetch_creker['product_price']; ?>  </td>
                            <td class="quantity text-center">
                                                <input type="number" onwheel="this.blur();" name="quantity" min="1" placeholder="Qty" value="" class="form-control qty_box quantity_<?php echo $fetch_creker['product_code']; ?>" onFocus="Javascript:CalProductAmount(this);" onBlur="Javascript:CalProductAmount(this);" onKeyup="Javascript:CalProductAmount(this);" onChange="Javascript:CalProductAmount(this);">
                           </td>
                           <td id="0" class="amount text-center amount_<?php echo $fetch_creker['product_code']; ?>">
                           	<input type="text" name="amount" class="form-control rate_box" disabled value="">
                           </td>
            </tr>
		<?php } ?>
		<?php $k++; } ?>
		
		
                                    </tbody>
</table>

<div class="w-100 mt-5">
    
    <form name="order_form" method="POST">
        <div class="row mx-0" style="font-size: 14px; line-height: 15px;">
            <div class="col-xl-6">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="form-label-group in-border mb-0">
                            <select name="state" class="form-control" >
                                
                                                                                <option value="Tamil Nadu"  selected  >
                                                    Tamil Nadu                                                </option>
                                                            </select>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div id="city_list" class="form-label-group in-border mb-0">
                            
							<select name="city" class="form-control">
                                <option value="">Select City</option>
                                                                                <option value="Others">
                                                    Others                                                </option>
                                                                                <option value="Ambasamudram">
                                                    Ambasamudram                                                </option>
                                                                                <option value="Anamali">
                                                    Anamali                                                </option>
                                                                                <option value="Arakandanallur">
                                                    Arakandanallur                                                </option>
                                                                                <option value="Arantangi">
                                                    Arantangi                                                </option>
                                                                                <option value="Aravakurichi">
                                                    Aravakurichi                                                </option>
                                                                                <option value="Ariyalur">
                                                    Ariyalur                                                </option>
                                                                                <option value="Arkonam">
                                                    Arkonam                                                </option>
                                                                                <option value="Arni">
                                                    Arni                                                </option>
                                                                                <option value="Aruppukottai">
                                                    Aruppukottai                                                </option>
                                                                                <option value="Attur">
                                                    Attur                                                </option>
                                                                                <option value="Avanashi">
                                                    Avanashi                                                </option>
                                                                                <option value="Batlagundu">
                                                    Batlagundu                                                </option>
                                                                                <option value="Bhavani">
                                                    Bhavani                                                </option>
                                                                                <option value="Chengalpattu">
                                                    Chengalpattu                                                </option>
                                                                                <option value="Chengam">
                                                    Chengam                                                </option>
                                                                                <option value="Chennai">
                                                    Chennai                                                </option>
                                                                                <option value="Chidambaram">
                                                    Chidambaram                                                </option>
                                                                                <option value="Chingleput">
                                                    Chingleput                                                </option>
                                                                                <option value="Coimbatore">
                                                    Coimbatore                                                </option>
                                                                                <option value="Courtallam">
                                                    Courtallam                                                </option>
                                                                                <option value="Cuddalore">
                                                    Cuddalore                                                </option>
                                                                                <option value="Cumbum">
                                                    Cumbum                                                </option>
                                                                                <option value="Denkanikoitah">
                                                    Denkanikoitah                                                </option>
                                                                                <option value="Devakottai">
                                                    Devakottai                                                </option>
                                                                                <option value="Dharampuram">
                                                    Dharampuram                                                </option>
                                                                                <option value="Dharmapuri">
                                                    Dharmapuri                                                </option>
                                                                                <option value="Dindigul">
                                                    Dindigul                                                </option>
                                                                                <option value="Erode">
                                                    Erode                                                </option>
                                                                                <option value=" Gingee ">
                                                    Gingee                                                </option>
                                                                                <option value="Gobichettipalayam">
                                                    Gobichettipalayam                                                </option>
                                                                                <option value="Gudalur">
                                                    Gudalur                                                </option>
                                                                                <option value="Gudiyatham">
                                                    Gudiyatham                                                </option>
                                                                                <option value="Harur">
                                                    Harur                                                </option>
                                                                                <option value="Hosur">
                                                    Hosur                                                </option>
                                                                                <option value="Jayamkondan">
                                                    Jayamkondan                                                </option>
                                                                                <option value="Kallkurichi">
                                                    Kallkurichi                                                </option>
                                                                                <option value="Kanchipuram">
                                                    Kanchipuram                                                </option>
                                                                                <option value="Kangayam">
                                                    Kangayam                                                </option>
                                                                                <option value="Kanyakumari">
                                                    Kanyakumari                                                </option>
                                                                                <option value="Karaikal">
                                                    Karaikal                                                </option>
                                                                                <option value="Karaikudi">
                                                    Karaikudi                                                </option>
                                                                                <option value="Karur">
                                                    Karur                                                </option>
                                                                                <option value="Keeranur">
                                                    Keeranur                                                </option>
                                                                                <option value="Kodaikanal">
                                                    Kodaikanal                                                </option>
                                                                                <option value="Kodumudi">
                                                    Kodumudi                                                </option>
                                                                                <option value="Kotagiri">
                                                    Kotagiri                                                </option>
                                                                                <option value="Kovilpatti">
                                                    Kovilpatti                                                </option>
                                                                                <option value="Krishnagiri">
                                                    Krishnagiri                                                </option>
                                                                                <option value="Kulithalai">
                                                    Kulithalai                                                </option>
                                                                                <option value="Kumbakonam">
                                                    Kumbakonam                                                </option>
                                                                                <option value="Kuzhithurai">
                                                    Kuzhithurai                                                </option>
                                                                                <option value="Madurai">
                                                    Madurai                                                </option>
                                                                                <option value="Madurantgam">
                                                    Madurantgam                                                </option>
                                                                                <option value="Manamadurai">
                                                    Manamadurai                                                </option>
                                                                                <option value="Manaparai">
                                                    Manaparai                                                </option>
                                                                                <option value="Mannargudi">
                                                    Mannargudi                                                </option>
                                                                                <option value="Mayiladuthurai">
                                                    Mayiladuthurai                                                </option>
                                                                                <option value="Mayiladutjurai">
                                                    Mayiladutjurai                                                </option>
                                                                                <option value="Mettupalayam">
                                                    Mettupalayam                                                </option>
                                                                                <option value="Metturdam">
                                                    Metturdam                                                </option>
                                                                                <option value="Mudukulathur">
                                                    Mudukulathur                                                </option>
                                                                                <option value="Mulanur">
                                                    Mulanur                                                </option>
                                                                                <option value="Musiri">
                                                    Musiri                                                </option>
                                                                                <option value="Nagapattinam">
                                                    Nagapattinam                                                </option>
                                                                                <option value="Nagarcoil">
                                                    Nagarcoil                                                </option>
                                                                                <option value="Namakkal">
                                                    Namakkal                                                </option>
                                                                                <option value="Nanguneri">
                                                    Nanguneri                                                </option>
                                                                                <option value="Natham">
                                                    Natham                                                </option>
                                                                                <option value="Neyveli">
                                                    Neyveli                                                </option>
                                                                                <option value="Nilgiris">
                                                    Nilgiris                                                </option>
                                                                                <option value="Oddanchatram">
                                                    Oddanchatram                                                </option>
                                                                                <option value="Omalpur">
                                                    Omalpur                                                </option>
                                                                                <option value="Ootacamund">
                                                    Ootacamund                                                </option>
                                                                                <option value="Ooty">
                                                    Ooty                                                </option>
                                                                                <option value="Orathanad">
                                                    Orathanad                                                </option>
                                                                                <option value="Palacode">
                                                    Palacode                                                </option>
                                                                                <option value="Palani">
                                                    Palani                                                </option>
                                                                                <option value="Palladum">
                                                    Palladum                                                </option>
                                                                                <option value="Papanasam">
                                                    Papanasam                                                </option>
                                                                                <option value="Paramakudi">
                                                    Paramakudi                                                </option>
                                                                                <option value="Pattukottai">
                                                    Pattukottai                                                </option>
                                                                                <option value="Perambalur">
                                                    Perambalur                                                </option>
                                                                                <option value="Perundurai">
                                                    Perundurai                                                </option>
                                                                                <option value="Pollachi">
                                                    Pollachi                                                </option>
                                                                                <option value="Polur">
                                                    Polur                                                </option>
                                                                                <option value="Pondicherry">
                                                    Pondicherry                                                </option>
                                                                                <option value="Ponnamaravathi">
                                                    Ponnamaravathi                                                </option>
                                                                                <option value="Ponneri">
                                                    Ponneri                                                </option>
                                                                                <option value="Pudukkottai">
                                                    Pudukkottai                                                </option>
                                                                                <option value="Rajapalayam">
                                                    Rajapalayam                                                </option>
                                                                                <option value="Ramanathapuram">
                                                    Ramanathapuram                                                </option>
                                                                                <option value="Rameshwaram">
                                                    Rameshwaram                                                </option>
                                                                                <option value="Ranipet">
                                                    Ranipet                                                </option>
                                                                                <option value="Rasipuram">
                                                    Rasipuram                                                </option>
                                                                                <option value="Salem">
                                                    Salem                                                </option>
                                                                                <option value="Sankagiri">
                                                    Sankagiri                                                </option>
                                                                                <option value="Sankaran">
                                                    Sankaran                                                </option>
                                                                                <option value="Sathiyamangalam">
                                                    Sathiyamangalam                                                </option>
                                                                                <option value="Sivaganga">
                                                    Sivaganga                                                </option>
                                                                                <option value="Sivakasi">
                                                    Sivakasi                                                </option>
                                                                                <option value="Sriperumpudur">
                                                    Sriperumpudur                                                </option>
                                                                                <option value="Srivaikundam">
                                                    Srivaikundam                                                </option>
                                                                                <option value="Tenkasi">
                                                    Tenkasi                                                </option>
                                                                                <option value="Thanjavur">
                                                    Thanjavur                                                </option>
                                                                                <option value="Theni">
                                                    Theni                                                </option>
                                                                                <option value="Thirumanglam">
                                                    Thirumanglam                                                </option>
                                                                                <option value="Thiruraipoondi">
                                                    Thiruraipoondi                                                </option>
                                                                                <option value="Thoothukudi">
                                                    Thoothukudi                                                </option>
                                                                                <option value="Thuraiyure">
                                                    Thuraiyure                                                </option>
                                                                                <option value="Tindivanam ">
                                                    Tindivanam                                                </option>
                                                                                <option value="Tiruchendur">
                                                    Tiruchendur                                                </option>
                                                                                <option value="Tiruchengode">
                                                    Tiruchengode                                                </option>
                                                                                <option value="Tiruchirappalli">
                                                    Tiruchirappalli                                                </option>
                                                                                <option value="Tirunelvelli">
                                                    Tirunelvelli                                                </option>
                                                                                <option value="Tirupathur">
                                                    Tirupathur                                                </option>
                                                                                <option value="Tirupur">
                                                    Tirupur                                                </option>
                                                                                <option value="Tiruttani">
                                                    Tiruttani                                                </option>
                                                                                <option value="Tiruvallur">
                                                    Tiruvallur                                                </option>
                                                                                <option value="Tiruvannamalai">
                                                    Tiruvannamalai                                                </option>
                                                                                <option value="Tiruvarur">
                                                    Tiruvarur                                                </option>
                                                                                <option value="Tiruvellore">
                                                    Tiruvellore                                                </option>
                                                                                <option value="Tiruvettipuram">
                                                    Tiruvettipuram                                                </option>
                                                                                <option value="Trichy">
                                                    Trichy                                                </option>
                                                                                <option value="Tuticorin">
                                                    Tuticorin                                                </option>
                                                                                <option value="Udumalpet">
                                                    Udumalpet                                                </option>
                                                                                <option value="Ulundurpet">
                                                    Ulundurpet                                                </option>
                                                                                <option value="Usiliampatti">
                                                    Usiliampatti                                                </option>
                                                                                <option value="Uthangarai">
                                                    Uthangarai                                                </option>
                                                                                <option value="Valapady">
                                                    Valapady                                                </option>
                                                                                <option value="Valliyoor">
                                                    Valliyoor                                                </option>
                                                                                <option value="Vaniyambadi">
                                                    Vaniyambadi                                                </option>
                                                                                <option value="Vedasandur">
                                                    Vedasandur                                                </option>
                                                                                <option value="Vellore">
                                                    Vellore                                                </option>
                                                                                <option value="Velur">
                                                    Velur                                                </option>
                                                                                <option value="Vilathikulam">
                                                    Vilathikulam                                                </option>
                                                                                <option value="Villupuram">
                                                    Villupuram                                                </option>
                                                                                <option value="Virudhachalam">
                                                    Virudhachalam                                                </option>
                                                                                <option value="Virudhunagar">
                                                    Virudhunagar                                                </option>
                                                                                <option value="Wandiwash">
                                                    Wandiwash                                                </option>
                                                                                <option value="Yercaud">
                                                    Yercaud                                                </option>
                                                            </select>
							
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-label-group in-border mb-0">
                            <input type="text" name="name" value="" class="form-control shadow-none" placeholder="Customer Name">
                            <label>Name (*)</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="form-label-group in-border mb-0">
                            <input type="text" name="mobile_number" value="" class="form-control shadow-none" placeholder="Mobile Number">
                            <label>Mobile Number (*)</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="form-label-group in-border mb-0">
                            <input type="text" name="email" value="" class="form-control shadow-none" placeholder="Email">
                            <label>Email</label>
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <div class="form-label-group in-border mb-0">
                            <textarea name="address" class="form-control" placeholder="Address" rows="4"></textarea>
                            <label>Address (*)</label>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery('select[name="state"]').select2();
                        jQuery('select[name="city"]').select2();
                    });    
                </script>
            </div>
            <div class="col-xl-6">
                <div class="w-100 form-group">
                    <div class="row">
                        <div class="col-8 text-right">Net Total : </div>
                        <div class="col-4 text-right"><span class="net_total pr-3"></span></div>
                    </div>
                </div>
                <div class="w-100 form-group">
                    <div class="row">
                        <div class="col-8 text-right">Discount Total : </div>
                        <div class="col-4 text-right"><span class="discount_total pr-3"></span></div>
                    </div>
                </div>
                <div class="w-100 form-group">
                    <div class="row">
                        <div class="col-8 text-right">Sub Total : </div>
                        <div class="col-4 text-right"><span class="sub_total pr-3"></span>
						<input type="hidden" value="" id="sub_total" name="subtotal_val">
						</div>
                    </div>
                </div>
                
                                <div class="w-100 form-group minimum_order_amount_cover ">
                    <div class="row">
                        <div class="col-8 text-right">Min.Order Amount : </div>
                        <div class="col-4 text-right"><span class="minimum_order_amount pr-3">Rs.2,500.00</span></div>
                    </div>
                </div>
                <div class="w-100 form-group packing_charges_cover ">
                    <div class="row">
                        <div class="col-8 text-right">Packing Charges : <span class="packing_charges">0%</span> </div>
                        <div class="col-4 text-right"><span class="packing_charges_value pr-3"></span></div>
                    </div>
                </div>
                <div class="w-100 form-group">
                    <div class="row">
                        <div class="col-8 text-right">Round OFF : </div>
                        <div class="col-4 text-right"><span class="round_off pr-3"></span></div>
                    </div>
                </div>
                <div class="w-100 form-group">
                    <div class="row">
                        <div class="col-8 text-right">Overall Total : </div>
                        <div class="col-4 text-right"><span class="overall_total pr-3"></span></div>
                    </div>
                </div>

                
                <div class="w-100 text-right">
                    <button class="btn btn-success btnwidth submit_button" type="button" onClick="Javascript:SaveOrder(event);">Submit</button>
                </div>
            </div>   
        </div>
        <script src="order/select2/js/select2.min.js"></script>
        <script src="order/select2/js/select.js"></script>

    </form>

    <a data-toggle="modal" data-target="#image_modal" class="cursor d-none image_video_popup"></a>
    <div class="modal fade" id="image_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="roboto heading4 clr"></h4>
                    <button type="button" class="close d-none" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <a href="Javascript:CloseImageVideoPopup();" style="color: #6c757d; font-size: 20px; font-weight: bold;"><span aria-hidden="true">&times;</span></a>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-center image_video" colspan="2" style="height: 350px; vertical-align: middle;"></td>
                            </tr>
                            <tr>
                                <td class="text-center image_column" style="width: 25%; height: 100px; padding: 5px; cursor: pointer;">
                                    <img src="" style="max-width: 100%; max-height: 100%;" alt="Crackers" title="Crackers" onClick="Javascript:ShowProductImage(this);">
                                </td>
                                <td class="text-center video_column" style="width: 25%; height: 100px; padding: 5px; cursor: pointer;">
                                    <img src="order/grid/images/youtubeicon.png" style="max-width: 100%; max-height: 100%;" alt="Crackers" title="Crackers" onClick="Javascript:ShowProductVideo(this);">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <button class="d-none otp_modal_button" data-toggle="modal" data-target="#otp_modal"></button>
<div class="modal fade model-forum" id="otp_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-width">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h1 class="fw-600 heading5 text-white mx-auto">OTP Verification</h1>
                <button type="button" class="close d-none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <a href="Javascript:CloseOTPModal();" style="color: #fff; font-size: 30px; line-height: 30px; font-weight: bold;"><span aria-hidden="true">&times;</span></a>
            </div>
            <div class="modal-body mb-4">

                <form name="otp_form" class="digit-group text-center" data-group-name="digits" data-autosubmit="true" autocomplete="off">
                    <div class="row">
                        <div class="col-12">
                            <div class="pfnt fw-600 pb-4 text-center">We have sent an OTP on you number <br> <span class="otp_receive_mobile_number"></span> </div>
                            <span class="otp_action d-none"></span><span class="otp_send_date d-none"></span>
                            <div class="h-blue qfnt fw-600 text-center pb-4">Enter OTP</div>  
                            <input type="number" id="digit-1" name="digit-1" data-next="digit-2" >
                            <input type="number" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                            <input type="number" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                            <input type="number" id="digit-4" name="digit-4" data-previous="digit-3" />
                            <div class="text-center pt-4">
                                <a href="Javascript:ResendOTP();" class="fw-400 h-blue text-center">Resend OTP?</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<style>
    .bg-green{background: #00BE74!important;}
    .digit-group input {
        width: 40px;
        height: 40px;
        background-color: white;
        border: 1px solid #0077D1;
        line-height: 50px;
        text-align: center;
        font-size: 24px;
        color: black;
        margin: 0 2px;
        border-radius: 5px;
    }
</style>

<script type="text/javascript">
    jQuery('.digit-group').find('input').each(function() {
        jQuery(this).attr('maxlength', 1);
        jQuery(this).on('keyup', function(e) {
            var parent = jQuery(jQuery(this).parent());
            var next = parent.find('input#' + jQuery(this).data('next'));
                
            if(next.length) {
                jQuery(next).select();
            } 
            else {
                //if(parent.data('autosubmit')) {
                    //parent.submit();
                    VerifyOTPnumber();
                //}
            }
        });
    });

    function CloseOTPModal() {
        if(jQuery('#otp_modal').find('.modal-header').find('button.close').length > 0) {
            jQuery('#otp_modal').find('.modal-header').find('button.close').trigger('click');
        }
        if(jQuery('.submit_button').length > 0) {
            jQuery('.submit_button').attr('disabled', false);
        }
    }

    function ResendOTP() {
        if(jQuery('.digit-group').length > 0) {

            if(jQuery('.digit-group').find('.alert').length > 0) {
                jQuery('.digit-group').find('.alert').remove();
            }

            jQuery('.otp_action').before('<div class="alert alert-danger mb-2"> <button type="button" class="close" data-dismiss="alert">&times;</button>Processing</div>');

            var otp_send_count = 0;
            otp_send_count = jQuery('.digit-group').attr('id');
            var numbers_regex = /^\d+$/;
            if(numbers_regex.test(otp_send_count) == true) {
                otp_send_count = parseInt(otp_send_count) + 1;
                if(parseInt(otp_send_count) <= 2) {

                    var otp_send_date = ""; var otp_receive_mobile_number = ""; var otp_number = "";

                    if(jQuery('.otp_send_date').length > 0) {
                        otp_send_date = jQuery('.otp_send_date').html();
                        otp_send_date = jQuery.trim(otp_send_date);
                        if(typeof otp_send_date != "undefined" && otp_send_date != null && otp_send_date != "") {

                            if(jQuery('.otp_receive_mobile_number').length > 0) {
                                otp_receive_mobile_number = jQuery('.otp_receive_mobile_number').html();
                                otp_receive_mobile_number = jQuery.trim(otp_receive_mobile_number);

                                if(typeof otp_receive_mobile_number != "undefined" && otp_receive_mobile_number != null && otp_receive_mobile_number != "") {
                                    otp_number = jQuery('.otp_receive_mobile_number').attr('id');
                                    otp_number = jQuery.trim(otp_number);

                                    if(typeof otp_number != "undefined" && otp_number != null && otp_number != "") {
                                        jQuery.ajax({
                                            type: 'POST',
                                            url: "otp_changes.php",
                                            data: {otp_receive_mobile_number:otp_receive_mobile_number, otp_number:otp_number, otp_send_date:otp_send_date},
                                            success: function(result){
                                                result = jQuery.trim(result);

                                                if(jQuery('.digit-group').find('.alert').length > 0) {
                                                    jQuery('.digit-group').find('.alert').remove();
                                                }

                                                if(result.indexOf('$$$') != -1) {
                                                    result = result.split('$$$');
                                                    jQuery('.digit-group').attr('id', result['0']);
                                                    jQuery('.otp_receive_mobile_number').attr('id', result['1']);
                                                    jQuery('.otp_action').before('<div class="alert alert-success mb-2"> <button type="button" class="close" data-dismiss="alert">&times;</button>OTP number is resend to register phone number</div>');
                                                }
                                                else {
                                                    jQuery('.otp_action').before('<div class="alert alert-danger mb-2"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+result+'</div>');
                                                }
                                            }
                                        });
                                    }
                                }
                            }

                        }
                    }
                    
                }
                else {
                    if(jQuery('.digit-group').find('.alert').length > 0) {
                        jQuery('.digit-group').find('.alert').remove();
                    }
                    jQuery('.otp_action').before('<div class="alert alert-danger mb-2"> <button type="button" class="close" data-dismiss="alert">&times;</button>Please try again later</div>');
                }
            }

        }
    }

    function VerifyOTPnumber() {

        if(jQuery('.digit-group').length > 0) {

            if(jQuery('.digit-group').find('.alert').length > 0) {
                jQuery('.digit-group').find('.alert').remove();
            }

            jQuery('.otp_action').before('<div class="alert alert-danger mb-2"> <button type="button" class="close" data-dismiss="alert">&times;</button>Processing</div>');

            var otp_number = ""; var otp_receive_mobile_number = "";
            if(jQuery('.otp_receive_mobile_number').length > 0) {
                otp_receive_mobile_number = jQuery('.otp_receive_mobile_number').html();
                otp_receive_mobile_number = jQuery.trim(otp_receive_mobile_number);

                if(typeof otp_receive_mobile_number != "undefined" && otp_receive_mobile_number != null && otp_receive_mobile_number != "") {
                
                    var digit_1 = "";
                    if(jQuery('input[name="digit-1"]').length > 0) {
                        digit_1 = jQuery('input[name="digit-1"]').val();
                        digit_1 = jQuery.trim(digit_1);
                        if(typeof digit_1 != "undefined" && digit_1 != null && digit_1 != "") {
                            otp_number = digit_1;
                        }
                    }
                    var digit_2 = "";
                    if(jQuery('input[name="digit-2"]').length > 0) {
                        digit_2 = jQuery('input[name="digit-2"]').val();
                        digit_2 = jQuery.trim(digit_2);
                        if(typeof digit_2 != "undefined" && digit_2 != null && digit_2 != "") {
                            otp_number = otp_number+digit_2;
                        }
                    }
                    var digit_3 = "";
                    if(jQuery('input[name="digit-3"]').length > 0) {
                        digit_3 = jQuery('input[name="digit-3"]').val();
                        digit_3 = jQuery.trim(digit_3);
                        if(typeof digit_3 != "undefined" && digit_3 != null && digit_3 != "") {
                            otp_number = otp_number+digit_3;
                        }
                    }
                    var digit_4 = "";
                    if(jQuery('input[name="digit-4"]').length > 0) {
                        digit_4 = jQuery('input[name="digit-4"]').val();
                        digit_4 = jQuery.trim(digit_4);
                        if(typeof digit_4 != "undefined" && digit_4 != null && digit_4 != "") {
                            otp_number = otp_number+digit_4;
                        }
                    }

                    if(typeof otp_number != "undefined" && otp_number != null && otp_number != "") {
                        jQuery.ajax({
                            type: 'POST',
                            url: "otp_changes.php",
                            data: {verify_otp_number:otp_number, verify_otp_receive_mobile_number:otp_receive_mobile_number},
                            success: function(result){
                                result = jQuery.trim(result);

                                if(jQuery('.digit-group').find('.alert').length > 0) {
                                    jQuery('.digit-group').find('.alert').remove();
                                }

                                if(numbers_regex.test(result) == true) {
                                    jQuery('.otp_action').before('<div class="alert alert-success mb-2"> <button type="button" class="close" data-dismiss="alert">&times;</button>Successfully OTP is verified</div>');
                                    setTimeout(function() {

                                        if(jQuery('.otp_send_date').length > 0) {
                                            jQuery('.otp_send_date').html('');
                                            jQuery('.otp_send_date').removeAttr('id');
                                        }
                                        if(jQuery('.otp_receive_mobile_number').length > 0) {
                                            jQuery('.otp_receive_mobile_number').html('');
                                            jQuery('.otp_receive_mobile_number').removeAttr('id');
                                        }
                                        if(jQuery('.otp_action').length > 0) {
                                            jQuery('.otp_action').html('');
                                        }
                                        if(jQuery('.digit-group').length > 0) {
                                            jQuery('.digit-group').removeAttr('id');
                                        }

                                        if(jQuery('#otp_modal').find('.modal-header').find('button').length > 0) {
                                            jQuery('#otp_modal').find('.modal-header').find('button').trigger("click");
                                        }

                                        if(jQuery('input[name="otp_number"]').length > 0) {
                                            jQuery('input[name="otp_number"]').val(otp_number);
                                        }

                                        var form_name = "order_form";
                                        SubmitOrder(form_name);

                                    }, 1000);
                                }
                                else {
                                    jQuery('.otp_action').before('<div class="alert alert-danger mb-2"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+result+'</div>');
                                }
                            }
                        });
                    }

                }    
            }
            
        }
    }
</script></div>    
</div>    

<script type="text/javascript" src="order/select2/js/select2.min.js"></script>
<script type="text/javascript" src="order/select2/js/select.js"></script>

    </div>
</div>
<!--Products End-->
<!--footer-->
<?php include 'footer.php';?>
<!--footer End-->  
<script type="text/javascript"> jQuery('#test').removeClass('d-none'); jQuery('#testing_img').addClass('d-none');</script>
<!-- Google Tag Manager (noscript) -->

<!-- End Google Tag Manager (noscript) -->
</body>
</html>