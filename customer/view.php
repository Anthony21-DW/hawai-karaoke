
<?php
session_start(); // Memulai sesi

// Mengecek jika pengguna belum terautentikasi, arahkan ke view.php di folder login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login/view.php"); // Arahkan ke view.php di folder login
    exit;
}

include('dataTable.php');
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <title>Customer</title>
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
                   <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Customer</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Data Customer</h6>
                            <button class="btn btn-primary btn-md me-2" data-toggle="modal" data-target="#formAddCustomer"> <i class="fas fa-plus-circle"></i> Tambah Customer</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableCustomer" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
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

    <div class="modal fade" id="formAddCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-center" role="document">
        <form id="formCreate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama<sup class="text-danger">*</sup></label>
                        <input required type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="masukan nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Username<sup class="text-danger">*</sup></label>
                        <input required type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="masukan username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email<sup class="text-danger">*</sup></label>
                        <input required type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="user.new@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="pasword">Password<sup class="text-danger">*</sup></label>
                        <input required type="text" class="form-control" id="pasword" name="pasword" placeholder="******">
                    </div>
                    <div class="form-group">
                        <label for="pasword">Role<sup class="text-danger">*</sup></label>
                        <select class="form-control" name="role_id" id="role_id" required>
                            <option value="" disabled selected>-- pilih role --</option>
                            <option value="1">Administrator</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <div class="modal fade" id="formEditCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-center" role="document">
            <form id="formEdit">
                <input type="hidden" id="edit-id" name="id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama<sup class="text-danger">*</sup></label>
                            <input required type="text" class="form-control" id="edit-name" name="name" aria-describedby="emailHelp" placeholder="masukan nama">
                        </div>
                        <div class="form-group">
                            <label for="username">Username<sup class="text-danger">*</sup></label>
                            <input required type="text" class="form-control" id="edit-username" name="username" aria-describedby="emailHelp" placeholder="masukan username">
                        </div>
                        <div class="form-group">
                            <label for="email">Email<sup class="text-danger">*</sup></label>
                            <input required type="text" class="form-control" id="edit-email" name="email" aria-describedby="emailHelp" placeholder="user.new@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="pasword">Role<sup class="text-danger">*</sup></label>
                            <select class="form-control" name="role_id" id="edit-role_id" required>
                                <option value="" disabled selected>-- pilih role --</option>
                                <option value="1">Administrator</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <label for="pasword" style="margin-bottom: 0!important;">Ingin mengubah password ?</label>
                            <input type="checkbox" style="margin-left: 10px;" id="isChangePassword">
                        </div>
                        <div class="form-group" id="parent-password" style="display: none;">
                            <label for="pasword">Password<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="edit-pasword" name="pasword" placeholder="masukan password baru">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
            </div>
        </div>

    <?php include_once '../shared/js.php';?>
    <script src="./script.js"></script>
  </body>
  </html>