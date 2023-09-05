<?php require_once 'include/Auto-Load.php'; ?>
<!DOCTYPE html>
<html lang="en">

 <?php require_once 'html_head.php'; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
   <?php include 'Slidebar.php';?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                  <?php include 'nav_bar.php';?>
                <!-- End of Topbar -->
				<?php
				$pid = $_REQUEST['PID'];
				
				
					$stmt = $db->query("SELECT * FROM `product_master`where product_id = '".$pid."'");
					$row = $stmt->fetch_assoc();
				?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Modify Product</h1>
                   
                    <!-- DataTales Example -->
                    <div class="card shadow container  mb-30">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Product Data</h6>
                        </div>
                        <div class="card-body">
							
                             <form class="user mb-10" method="post" enctype="multipart/form-data" action="DB-Connect/Connect_Product_modify.php">
								 	<div class="row">
								 		<div class="col-6">
											<div class="form-group">
											<label class="col-form-label">Category</label>
											
											<select name="category" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">  
											 <?php
                        $i = 1;
                        $sql_dep = mysqli_query( $db, "SELECT * FROM category_master" );
                        while ( $fetch_dep = mysqli_fetch_array( $sql_dep ) ) {
                          ?>
                          <option <?php if( $row['category_id'] == $fetch_dep['category_id']) { ?> selected <?php } ?> value="<?php echo $fetch_dep['category_id']; ?>"><?php echo $fetch_dep['category_name']; ?></option>
                        <?php } ?>
											</select>
											 
       
                                        		</div>
										</div>
										<div class="col-6">
											<div class="form-group">
											<label class="col-form-label">Product Name</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="productname" aria-describedby="emailHelp" name="product_name"
                                                placeholder="Product Name" value='<?php echo stripcslashes($row["product_name"]); ?>'>
												<input type="hidden" value="<?php echo $row["product_id"];  ?>" name="product_id" >
                                        		</div>
										</div>
								 	</div>
								 <div class="row">
								 		<div class="col-4">
											<div class="form-group">

											<label class="col-form-label">MRP</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="productname" aria-describedby="emailHelp"
                                                placeholder="MRP" value="<?php echo $row['product_mrp']; ?>" name="product_mrp">
                                        		</div>
										</div>
										<div class="col-4">
											<div class="form-group">
											<label class="col-form-label">Selling Price</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="productname" aria-describedby="emailHelp"
                                                placeholder="Selling Price" value="<?php echo $row['product_price']; ?>" name="product_price">
                                        		</div>
										</div>
									 <div class="col-4">
											<div class="form-group">
											<label class="col-form-label">Buying Price</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="productname" aria-describedby="emailHelp"
                                                placeholder="Buying Price" value="<?php echo $row['product_buying_price']; ?>" name="product_buying_price">
                                        		</div>
										</div>
								 	</div>
								  <div class="row">
								 		<div class="col-6">
											<div class="form-group">
											<label class="col-form-label">Product Images</label>
                                            <input type="file" class="form-control form-control-user"
                                                id="file" name="images" >
												<input type="hidden" value="<?php echo $row['product_images']; ?>" name="old_images">
                                        		</div>
										</div>
										
									     <div class="col-5">
											<div class="form-group">
											<div class="col-6">
											<div class="form-group">
											<label class="col-form-label">Product Images</label>
											<?php if($row['product_images'] != "") { ?> <img src="<?php echo $row['product_images']; ?>" width="100" height="100"> <?php } ?>
                                            
                                        		</div>
                                        		</div>
										</div>
									
								 	</div
								  
								 		<div class="row" > 
									 <div class="col-4">
											<div class="form-group" align="right">
											<label class="col-form-label"> </label>
											 <button  class="btn btn-primary btn-user btn-block" name="submit_product">
                                            Submit
                                        </button>
                                        		</div>
										</div>
								 	</div>
                                        
                                    </form>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>