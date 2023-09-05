<?php  require_once 'include/Auto-Load.php'; ?>
<?php include 'html-head.php';?>
<body itemscope itemtype="http://schema.org/WebPage">
<!--Desktop Nav-->
<?php include 'nav.php';?>
<!--Mobile Navbar--><!--Order View-->
<div class="container">
                        <script type="text/javascript" src="js/common.js"></script>
                    <div class="table-responsive">
                        <div class="card-box mx-3 my-3 order_preview">
                            
                                                            <style> .box-border{border: 3px solid #dc3545 !important;} </style>
                            <div class="col-12 col-lg-6 mx-auto heading4 font-weight-bold text-center mb-3 py-3 box-border">
                                Thanks for Ordering                            </div>
                                                        <div class="px-2 py-2 text-center">
                                <script type="text/javascript" src="order/print_pdf/jspdf.min.js"></script>
                                <script type="text/javascript" src="order/print_pdf/html2canvas.js"></script>
                                <script type="text/javascript" src="order/print_pdf/print_pdf.js"></script>

                                <!--<script type="text/javascript" src="order/table_export_pdf/libs/jsPDF/jspdf.min.js"></script>
                                <script type="text/javascript" src="order/table_export_pdf/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
                                <script type="text/javascript" src="order/table_export_pdf/tableExport.min.js"></script>
                                <script type="text/javascript" src="order/table_export_pdf/tableExport.js"></script>-->
<?php
															$order = $_REQUEST['view_order_id'];
															$sql_order_query = mysqli_query($db, "SELECT * FROM order_master WHERE order_code = '".$order."' ");
															$sql_order = mysqli_fetch_array($sql_order_query);
															
															?>
                                            <div id="report_area" class="w-100">
                                <table cellpadding="0" cellspacing="0" class="report_table print_order" style="width: 100%;">
                    <thead>
                        <tr>
                            <th colspan="7" style="padding: 2px 5px; border: 1px solid #000; border-bottom: none; text-align: center; font-size: 15px;">
                                <div style="display: table; width: 100%;">
                                    <div style="display: table-row;">
                                        <div style="display: table-cell; text-align: left; width: 33.3%; padding-left: 10px; font-size: 12px; font-weight: normal;">
                                            Enquiry No : <?php echo $sql_order['order_code']; ?>                                        </div>
                                        <div style="display: table-cell; text-align: center; width: 33.3%; padding-left: 10px; font-size: 15px;">ESTIMATE</div>
                                        <div style="display: table-cell; text-align: right; padding-right: 10px; width: 33.3%; font-size: 12px; font-weight: normal;">
                                            Date : <?php echo date("d/m/Y", strtotime($sql_order['order_date'])); ?> 
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="7" style="padding: 2px 5px; border: 1px solid #000; text-align: center; font-size: 15px;">
                                <div style="display: table; width: 100%;">
                                    <div style="display: table-row;">
                                        <div style="display: table-cell; text-align: center;">
                                                                                        <div style="display: table;">
                                                <div style="display: table-row;">
                                                    <div style="display: table-cell; text-align: left; padding-left: 10px;">Mobile : </div>
                                                    <div style="display: table-cell; text-align: left; padding-left: 10px;">
                                                        +91 8608812581/ +91 9345122089                                                    </div>
                                                </div>
                                            </div>
                                                                                    </div>
                                        <div style="display: table-cell; text-align: right; vertical-align: top; padding-right: 10px;">
                                            E-mail : vedibox@gmail.com 
                                        </div>
                                    </div>
                                </div>

                                <div style="display: table; width: auto; margin: auto;">
                                                                        <div style="display: table-row;">
                                                                                <div style="display: table-cell; text-align: center; vertical-align: top;">
                                                                                            <div style="width: 100%;">Vedibox</div>
                                                                                                                                        <div style="width: 100%; font-weight: normal;">Door No:3-868-A,<br> 
                        S.R.Naidu nagar, Venkatachalapuram post,<br> 
                        Sattur Taluk, Sivakasi. Viruthunagar Dist.</div>
                                                
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="7" style="padding: 2px 5px; border: 1px solid #000; font-size: 13px; line-height: 15px;">
                                <div style="display: table; width: 100%;">
                                    <div style="display: table-row;">
                                        <div style="display: table-cell; width: 50%;">
                                            <div style="width: 100%; text-align: left; margin-bottom: 5px; font-weight: bold;">Customer Details</div>
                                                                                            <div style="width: 100%; padding-left: 10px;"><?php echo $sql_order['order_name']; ?><br><?php echo $sql_order['order_name']; ?><br><?php echo $sql_order['order_email']; ?></div>
                                                                                         
                                                                                                    <div style="width: 100%; padding-left: 10px;"><?php echo $sql_order['order_address']; ?><br><?php echo $sql_order['order_state']; ?>, <?php echo $sql_order['order_city']; ?></div>
                                                                                                                                    </div>
                                        <div style="display: table-cell; width: 50%;"> 
                                             
                                            <div style="width: 100%; text-align: center; margin-bottom: 5px; font-weight: bold;">Bank Details</div>
                                            <div style="display: table; width: auto; float: right;">
                                                                                                <div style="display: table-row;">
                                                    <div style="display: table-cell; text-align: right; vertical-align: top;">
                                                        A/C Name : 
                                                    </div>
                                                    <div style="display: table-cell; text-align: right; vertical-align: top; padding-left: 10px; padding-right: 10px;">
                                                       VediBox                                                 </div>
                                                </div>
                                                                                                                                                <div style="display: table-row;">
                                                    <div style="display: table-cell; text-align: right; vertical-align: top;">
                                                        A/C Number : 
                                                    </div>
                                                    <div style="display: table-cell; text-align: right; vertical-align: top; padding-left: 10px; padding-right: 10px;">
                                                        080605017313                                                    </div>
                                                </div>
                                                                                                                                                <div style="display: table-row;">
                                                    <div style="display: table-cell; text-align: right; vertical-align: top;">
                                                        A/C Type : 
                                                    </div>
                                                    <div style="display: table-cell; text-align: right; vertical-align: top; padding-left: 10px; padding-right: 10px;">
                                                        CURRENT                                                    </div>
                                                </div>
                                                                                                                                                <div style="display: table-row;">
                                                    <div style="display: table-cell; text-align: right; vertical-align: top;">
                                                        Bank Name : 
                                                    </div>
                                                    <div style="display: table-cell; text-align: right; vertical-align: top; padding-left: 10px; padding-right: 10px;">
                                                        ICICI                                                    </div>
                                                </div>
                                                                                                                                                <div style="display: table-row;">
                                                    <div style="display: table-cell; text-align: right; vertical-align: top;">
                                                        IFSC Code: 
                                                    </div>
                                                    <div style="display: table-cell; text-align: right; vertical-align: top; padding-left: 10px; padding-right: 10px;">
                                                        ICIC0000806                                                    </div>
                                                </div>
                                                                                            </div>
                                                                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th style="padding: 2px 5px; border: 1px solid #000; text-align: center; width: 10px; font-size: 12px;">S.No</th>
                           
                            <th style="padding: 2px 5px; border: 1px solid #000; border-left: none; text-align: center; font-size: 12px;">Product Name</th>
                            <th style="padding: 2px 5px; border: 1px solid #000; border-left: none; text-align: center; width: 75px; font-size: 12px;">Content</th>
                            <th style="padding: 2px 5px; border: 1px solid #000; border-left: none; text-align: center; width: 75px; font-size: 12px;">Quantity</th>
                            <th style="padding: 2px 5px; border: 1px solid #000; border-left: none; text-align: center; width: 100px; font-size: 12px;">Rate (Rs)</th>


                            <th style="padding: 2px 5px; border: 1px solid #000; border-left: none; text-align: center; width: 125px; font-size: 12px;">Amount (Rs)</th>
                        </tr>
                    </thead>
                    <tbody>
						
						<?php
						$i = 1;
						$sql_order_list = mysqli_query($db, "SELECT * FROM order_details WHERE order_id = '".$sql_order['order_id']."'");
						while($fetch_order_list = mysqli_fetch_array($sql_order_list))
						{
						?>
                                                                
                                                                                                <tr>
                                                            <td style="padding: 2px 5px; border: 1px solid #000; text-align: center; width: 10px; font-size: 12px;">
                                                                <?php echo $i; ?>                                                            </td>
                                                            
                                                            <td style="padding: 2px 10px; border: 1px solid #000; border-left: none; font-size: 12px;">
                                                                <?php echo $fetch_order_list['product_name']; ?>                                                     </td>
                                                            <td style="padding: 2px 5px; border: 1px solid #000; border-left: none; text-align: center; width: 75px; font-size: 12px;">
                                                                1PKT                                                            </td>
                                                            <td style="padding: 2px 5px; border: 1px solid #000; border-left: none; text-align: center; width: 75px; font-size: 12px;">
                                                                 <?php echo $fetch_order_list['product_qty']; ?>                                                            </td>
                                                            <td style="padding: 2px 10px; border: 1px solid #000; border-left: none; text-align: right; width: 75px; font-size: 12px;">
                                                               <?php echo $fetch_order_list['product_price']; ?>                                                           </td>
                                                            <td style="padding: 2px 10px; border: 1px solid #000; border-left: none; text-align: right; width: 125px; font-size: 12px;">
                                                                <?php echo $fetch_order_list['product_price']*$fetch_order_list['product_qty']; ?>.00                                                      </td>
                                                        </tr>
					<?php $i++; } ?>
                                                                                            <tr>
                                                        <th colspan="5" style="padding: 2px 10px; border: 1px solid #000; border-right: none; text-align: right; font-size: 12px;">
                                                            Sub Total
                                                        </th>
                                                        <th style="padding: 2px 5px; border: 1px solid #000; text-align: right; font-size: 12px; width: 125px;">
                                                            <?php echo $sql_order['order_total']; ?>.00                                                        </th>
                                                    </tr>
                                                                                              
                                                                                            <tr>
                                                        <th colspan="5" style="padding: 2px 10px; border: 1px solid #000; border-right: none; text-align: right; font-size: 12px;">
                                                            Total
                                                        </th>
                                                        <th style="padding: 2px 5px; border: 1px solid #000; text-align: right; font-size: 12px; width: 125px;">
                                                           <?php echo $sql_order['order_total']; ?>.00                                                      </th>
                                                    </tr>
                                                                                
                        
                            
                        
                                                
                        
                        
                                                <tr>
                            <th colspan="5" style="padding: 2px 10px; border: 1px solid #000; border-right: none; text-align: right; font-size: 12px;">
                                Packing Charges (0%)                            </th>
                            <th style="padding: 2px 5px; border: 1px solid #000; text-align: right; font-size: 12px; width: 125px;">
                                0.00                            </th>
                        </tr>
                                                                                       
                                                                        <tr>
                            <th colspan="2" style="padding: 2px 10px; border: 1px solid #000; border-right: none; text-align: left; font-size: 12px;">
                                Total Items : <?php echo $i-1; ?>.00                         </th>
                            <th colspan="3" style="padding: 2px 10px; border: 1px solid #000; border-right: none; text-align: right; font-size: 12px;">
                                Overall Total
                            </th>
                            <th style="padding: 2px 5px; border: 1px solid #000; text-align: right; font-size: 12px; width: 125px;">
                                <?php echo $sql_order['order_total']; ?>.00                            </th>
                        </tr>
                    </tbody>
                </table>
                <!-- Product Content -->
                                <table class="table" id="product_details">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Account Name</th>
                                            <th class="product-total">Vedibox</th>
                                            </tr>
                                        <tr>
                                            <th class="product-name">Account Number</th>
                                            <th class="product-total">080605017313</th>
                                            </tr>
                                            <tr>
                                            <th class="product-name">IFSC Code </th>
                                            <th class="product-total">ICIC0000806 </th>
                                            </tr>
                                            
                                            <tr>
                                                
                                             <th class="product-name"><img src="https://www.pngitem.com/pimgs/m/3-38170_phonepe-logo-png-phone-pe-transparent-png.png" style="max-width:50px"><span style="margin-left:20px">Phonepe</span> </th>
                                             <th class="product-total">8608212581 </th>
                                             
                                             </tr>
                                              <tr>
                                              <th class="product-name"><img src="https://pixlok.com/wp-content/uploads/2021/02/Google-Pay-Icon.jpg" style="max-width:50px"><span style="margin-left:20px">Google pay</span>  </th>
                                              <th class="product-name">8608212581</th>
                                               </tr>
                                               <tr>
                                               <th class="product-name"><img src="https://static.paytmmoney.com/android-chrome-192x192.png" style="max-width:50px"><span style="margin-left:20px">Paytm Code</span </th>
                                                 <th class="product-total">8608212581 </th>
          
                                             </tr>
                                             
                                                              <tr>
                                               <th class="product-name"><img src="https://uxwing.com/wp-content/themes/uxwing/download/brands-and-social-media/upi-icon.png" style="max-width:50px"><span style="margin-left:20px">Upi Payment</span </th>
                                                 <th class="product-total">vedibox2021@icici </th>
          
                                             </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td><img src="<?php echo base_url();?>vedibox/pricelist/images/pay1.jpeg" style="max-width:200px"></td></tr>
                                       <tr> <td><img src="<?php echo base_url();?>vedibox/pricelist/images/payment1.jpeg" style="max-width:200px"></td></tr>
                                       <tr> <td><img src="<?php echo base_url();?>vedibox/pricelist/images/pay3.jpeg" style="max-width:200px"></td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                     

                                    </tfoot>
                                </table>
                                <!-- End Product Content -->
                            </div>
   
                                <!--<script type="text/javascript">
                                    function pdf_content(){
                                        jQuery('.report_table').tableExport({type:'pdf', fileName:'order_15', jspdf: {orientation: 'p',format: 'a4'}});
                                    }
                                </script>-->

                                <script>
                                    jQuery(document).ready(function() {
                                        prepare_print_view();        
                                    });
                                </script>
                            </div>
                        </div>
                    </div>    
    </div>

<!--footer-->
<?php include 'footer.php';?>
<!--footer End-->
</body>
</html>