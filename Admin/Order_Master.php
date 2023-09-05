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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Order Master</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
										    <th>S.no</th>
                                            <th>Order code</th>
                                            <th>Order Date</th>
                                            <th>Order Name</th>
											<th>Order Phone</th>
                                            <th>Order Total</th>
                                            <th>Total Buying</th>
                                            <th>Order State</th>
											<th>Order City</th>
											<th>Update</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>S.no</th>
                                            <th>Order code</th>
                                            <th>Order Date</th>
                                            <th>Order Name</th>
											<th>Order Phone</th>
                                            <th>Order Total</th>
                                            <th>Total Buying</th>
                                            <th>Order State</th>
											<th>Order City</th>
											<th>Update</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php 
										$stmt = $db->query("SELECT * FROM `order_master`where order_status = 1");
										while($row = $stmt->fetch_assoc())
										{
									?>
                                        <tr>
                                            <td><?php echo $row['order_id']; ?></td>
                                            <td><?php echo $row['order_code']; ?></td>
                                            <td><?php echo $row['order_date']; ?></td>
                                            <td><?php echo $row['order_name']; ?></td>
											<td><?php echo $row['order_phone']; ?></td>
                                            <td><?php echo $row['order_total']; ?></td>
											<td><?php echo $row['order_total_buing']; ?></td> 
											<td><?php echo $row['order_state']; ?></td>
											<td><?php echo $row['order_city']; ?></td>
											<td><a href="DB-Connect/Update-Order-Confirm.php?OID=<?php echo $row['order_id']; ?>">Confirm</a> // <a href="DB-Connect/Update-Order-Cancel.php?OID=<?php echo $row['order_id']; ?>">Cancel</a> // <a href="Order_View.php?OID=<?php echo $row['order_id']; ?>">Customer</a> // <a href="Order_View_Buying.php?OID=<?php echo $row['order_id']; ?>">Manufacture </a></td>
                                        </tr>
                                         <?php $i++; } ?> 
                                    </tbody>
                                </table>
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
                    <a class="btn btn-primary" href="index.php">Logout</a>
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