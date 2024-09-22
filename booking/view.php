
<?php
session_start(); // Memulai sesi

// Mengecek jika pengguna belum terautentikasi, arahkan ke view.php di folder login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/view.php"); // Arahkan ke view.php di folder login
    exit;
}

// include('controller.php'); // Sertakan logika PHP dari login.php
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <title>Booking</title>
    <?php include '../shared/css.php';?>
  </head>
  <body>
    
      <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../shared/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../shared/navbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                 <div class="container-fluid">
                    <input type="hidden" id="role-code" value="<?php echo($_SESSION['role_id']); ?>">
                   <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Booking</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Data Booking</h6>
                            <button class="btn btn-primary btn-md me-2" data-toggle="modal" data-target="#formAddCustomer"> <i class="fas fa-plus-circle"></i> Tambah Booking </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableBooking" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Booking</th>
                                            <th>Nama</th>
                                            <th>Ruangan</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
           <?php include '../shared/footer.php' ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>  
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> 
    <?php include_once '../shared/js.php';?>
    <script src="script.js"></script>
  </body>
  <!-- </html> -->