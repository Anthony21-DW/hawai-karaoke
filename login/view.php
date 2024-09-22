<?php
include('controller.php'); // Sertakan logika PHP dari login.php
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <title>Login</title>
    <?php include '../shared/css.php';?>
    <style>
        body {
          background: radial-gradient(circle, #15A9F1, #117AB8, #0D5893);
          min-height: 100vh;
          margin: 0;
          padding: 0;
          display: flex;
          align-items: center;
          justify-content: center;
          font-family: Arial, sans-serif;
        }
    </style>
  </head>
  <body>
    
   <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-item-center">

            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            
                            <div class="col-lg-12">
                                <div class="p-3">
                                     <div class="text-center">
                                        <img src="../assets/images/logo.png" alt="logo" width="180" srcset="">
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Masuk Akun</h1>
                                    </div>
                                    <form class="user" id="formLogin" method="post" style="width: 70%; margin: auto;">
                                        <div class="form-group">
                                            <input type="email" class="form-control"
                                                id="email" name="email" aria-describedby="emailHelp"
                                                placeholder="masukan email...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control"
                                                id="password" name="password" placeholder="masukan pasword...">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Login
                                        </button>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center mt-2">
                                        <p>Belum punya akun? <a href="../register/view.php">Daftar Akun</a></p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php include_once '../shared/js.php';?>
    <script src="script.js"></script>
  </body>
  </html>
