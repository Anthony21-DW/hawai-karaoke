
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
                            <button class="btn btn-primary btn-md me-2" data-toggle="modal" data-target="#formAddCustomer"> <i class="fas fa-plus-circle"></i> Tambah User</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableCustomer" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
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

    <!-- Modal untuk Tambah Customer -->
    <div class="modal fade" id="formAddCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-center" role="document">
        <form id="formCreate">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
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
                            <option value="2">Kasir</option>
                            <option value="3">Customer</option>
                        </select>
                    </div>
                    <div id="parent-for-customer" style="display: none;">
                        <div class="form-group">
                            <label for="gender">Jenis kelamin<sup class="text-danger">*</sup></label>
                            <select class="form-control" name="gender" id="gender" >
                                <option value="" disabled selected>-- pilih jenik kelamin --</option>
                                <option value="L">Pria</option>
                                <option value="P">Wanita</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">No.Hp<sup class="text-danger">*</sup></label>
                            <input  type="text" class="form-control" id="phone" name="phone" placeholder="masukan no hp" inputmode="number">
                        </div>
                        <div class="form-group">
                            <label for="username">Alamat<sup class="text-danger">*</sup></label>
                            <textarea  type="text" class="form-control" id="address" name="address" placeholder="masukan alamat customer" rows="3"></textarea>
                        </div>
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

    <!-- Modal untuk Edit Customer -->
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

    <!-- Modal untuk Detail Customer -->
    <div class="modal fade" id="modaShowDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
        <div class="modal-dialog modal-center modal-lg" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Customer</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-1">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control" id="name-d" name="name-d"
                                               readonly >
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="phone-d" name="phone-d"
                                                 inputmode="number" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0 d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender-d" id="gender-d" checked readonly>
                                                <label class="form-check-label" for="gender-d" id="label-gender">
                                                
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="text" class="form-control" id="role-d" name="role-d"
                                                 inputmode="number" readonly >
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="birthyear-d" name="birthyear-d"
                                                 inputmode="number" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="username-d" name="username-d" readonly
                                            > 
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email-d" name="email-d" readonly
                                            >
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" id="address-d" name="address-d" readonly
                                         rows="3" ></textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <?php include_once '../shared/js.php';?>
    <script src="./script.js"></script>
  </body>
  </html>