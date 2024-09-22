<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <title>Register</title>
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


        .input-group-text {
            cursor: pointer;
        }
    </style>
  </head>
  <body>
    
   <div class="container">

      <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                  <div class="col-lg-5 d-none d-lg-block ">
                    <img src="../assets/images/logo.png" alt="logo">
                  </div>
                  <div class="col-lg-7">
                      <div class="p-5">
                          <div class="text-center">
                              <h1 class="h4 text-gray-900 mb-4">Daftar Akun</h1>
                          </div>
                          <form class="user" id="formRegister" method="post">
                              <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                      <input type="text" class="form-control" id="name" name="name"
                                          placeholder="*Masukan nama Anda..." required>
                                  </div>
                                  <div class="col-sm-6">
                                      <input type="text" class="form-control" id="phone" name="phone"
                                          placeholder="*Masukan Nomor Hp..."  inputmode="number" required>
                                  </div>
                              </div>
                               <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0 d-flex justify-content-between align-items-center">
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="L">
                                        <label class="form-check-label" for="gender">
                                          Pria
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="P">
                                        <label class="form-check-label" for="gender">
                                          Wanita
                                        </label>
                                      </div>
                                     
                                  </div>
                                  <div class="col-sm-6">
                                      <input type="text" class="form-control" id="birthyear" name="birthyear"
                                          placeholder="*Tahun lahir..."  inputmode="number" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <input type="text" class="form-control" id="username" name="username"
                                      placeholder="masukan username. Cth: pengguna_baru"> 
                              </div>
                              <div class="form-group">
                                  <input type="email" class="form-control" id="email" name="email"
                                      placeholder="masukan email" required>
                              </div>
                              <div class="form-group">
                                  <textarea type="text" class="form-control" id="address" name="address"
                                      placeholder="*Masukan alamat..." rows="3" required></textarea>
                              </div>
                              <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                      <input type="password" class="form-control"
                                          id="password" name="password" placeholder="*Password" required>
                                  </div>
                                  <div class="col-sm-6">
                                      <input type="password" class="form-control"
                                          id="cpassword" name="cpassword" onkeyup="confirmPassword(this,event)" placeholder="*Masukan ulang password" required>
                                        <small class="text-danger" id="cerror" style="display: none;">*Password tidak sama</small>
                                  </div>
                              </div>
                              <button type="submit" class="btn btn-primary btn-block">
                                 Buat Akun
                              </button>
                          </form>
                          <hr>
                          <div class="text-center">
                            <p>Sudah punya akun?  <a href="../login/view.php"> Login!</a></p> 
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
