<?php require_once 'include/Auto-Load.php'; ?>
<!DOCTYPE html>
<html lang="en">

 <?php require_once 'html_head.php'; ?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
           <?php include 'Slidebar.php';?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'nav_bar.php';?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Order View</h1>
					<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
															$order = $_REQUEST['OID'];
															$sql_order_query = mysqli_query($db, "SELECT * FROM order_master WHERE order_id = '".$order."' ");
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
                                                        +91 8608812581                                                    </div>
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
                                                                                                                                   
                                                                                                                                    <div style="width: 100%; padding-left: 10px;"><?php echo $sql_order['order_phone']; ?></div>
                                                                                                                                    </div>
                                        <div style="display: table-cell; width: 50%;"> 
                                             
                                                
                                            <div style="width: 100%; text-align: center; margin-bottom: 5px; font-weight: bold;">Bank Details</div>
                                            <div style="display: table; width: auto; float: right;">
                                                                                                <div style="display: table-row;">
                                                    <div style="display: table-cell; text-align: right; vertical-align: top;">
                                                        A/C Name : 
                                                    </div>
                                                    <div style="display: table-cell; text-align: right; vertical-align: top; padding-left: 10px; padding-right: 10px;">
                                                       Vedi Box                                                 </div>
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
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>