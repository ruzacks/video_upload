<?php include('page-protection.php') ?>
<?php include('connection.php') ?>
<?php include('lib-data.php') ?>
<?php

   if($_SESSION['role'] == 'kordes'){
      header("Location: not-found.php");
     exit();
   }

   $conn = getConn();
   $editorName = $_SESSION['username'];
   $editorSql = "SELECT username, role, id_kecamatan, id_desa FROM users where username='$editorName'";
   $result = mysqli_query($conn, $editorSql);
 
   $editor = mysqli_fetch_object($result);
?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>User - Add User</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
            <div class="loader">
               <div class="cube">
                  <div class="sides">
                     <div class="top"></div>
                     <div class="right"></div>
                     <div class="bottom"></div>
                     <div class="left"></div>
                     <div class="front"></div>
                     <div class="back"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
      <!-- Sidebar  -->
      <?php include ('sidebar.php') ?>
      <!-- TOP Nav Bar -->
      <?php include ('navbar.php') ?>
      <!-- TOP Nav Bar END -->
      <!-- Page Content  -->
   <div id="content-page" class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">New User Information</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                     <?php $error = isset($_GET['error']) ? $_GET['error'] : ''; ?>
                     <div class="alert alert-danger" role="alert" <?php echo empty($error) ? 'hidden' : ''; ?>>
                        <div class="iq-alert-text"><?php echo $error; ?></div>
                     </div>
                        <div class="new-user-info">
                        <form action="ajax-user.php" method="POST">
                           <div class="row align-items-center">
                              <div class="form-group col-sm-6">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required >
                              </div>
                              <div class="form-group col-sm-6">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required >
                              </div>
                              <div class="form-group col-sm-6">
                                    <label for="no_wa">No Whatsapp</label>
                                    <input type="tel" class="form-control" id="no_wa" name="no_wa" inputmode="numeric" pattern="[0-9]*" required >
                              </div>
                              <div class="form-group col-sm-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                              </div>

                              <div class="form-group col-sm-6" <?php echo $editor->role == 'kordes' ? 'hidden' : '' ?> <?php if ($editor->role == 'korcam') { ?> style="pointer-events: none;" <?php } ?>>
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role" name="role" required >
                                       <option selected="" disabled="">Select Role</option>
                                       <?php 
                                          if($editor->role == 'administrator'){
                                       ?>
                                          <option value="administrator">Administrator</option>
                                          <option value="koordinator">Koordinator</option>
                                          <option value="verifikator">Verifikator</option>
                                       <?php 
                                          } 
                                       ?>
                                       <option value="korcam">Korcam</option>
                                       <option value="kordes" <?= ($editor->role == 'korcam') ? 'selected' : ''?>>Kordes</option>
                                    </select>
                              </div>
                              <div class="form-group col-sm-6" id="kecamatan_input">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="form-control" id="kecamatan" name="kecamatan" required <?php if ($editor->role != 'administrator') { ?> style="pointer-events: none;" <?php } ?> > 
                                    <option value="">Pilih Kecamatan</option>
                                    <?php
                                       foreach ($kecamatans as $kecamatan){
                                          ?>
                                             <option value="<?php echo $kecamatan->id_kecamatan; ?>" <?= ($editor->id_kecamatan == $kecamatan->id_kecamatan) ? 'selected' : ''; ?>> <?php echo $kecamatan->nama_kecamatan; ?></option>

                                          <?php
                                       }
                                    ?>
                                    </select>                                     
                              </div>
                              <div class="form-group col-sm-6" id="desa_input">
                                    <label for="desa">Desa</label>
                                    <select class="form-control" id="desa" name="desa" required <?php if($editor->role == 'kordes') { ?> style="pointer-events: none;" <?php } ?> > 
                                    <option value="">Pilih Desa</option>
                                    </select>                                     
                              </div>
                           </div>
                           <input type="hidden" name="func" value="addUser">
                           <button type="submit" class="btn btn-primary mr-2">Submit</button>
                           <button type="reset" class="btn iq-bg-danger">Cancel</button>
                        </form>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   <!-- Wrapper END -->
    <!-- Footer -->
      <footer class="bg-white iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0">
                     <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                     <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                  </ul>
               </div>
               <div class="col-lg-6 text-right">
                  Copyright 2020 <a href="#">Sofbox</a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
    <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
      <script>
         
         document.getElementById('no_wa').addEventListener('input', function (e) {
            this.value = this.value.replace(/[^0-9]/g, '');
         });

         $(document).ready(function() {
            getDesa();
            setUserAttribute();
         });
         
         $('#kecamatan').change(function() {
            getDesa();
         });

         function getDesa(){
            var idKecamatan = $('#kecamatan').val();
            var idUser = $('#username').val();

            $.ajax({
               url: 'ajax.php',
               method: 'POST',
               data: {
                  func: 'getDesa',
                  id_kecamatan: idKecamatan
               },
               success: function(response) {
                  var data = response;
                  var desaSelect = $('#desa');

                  // Clear previous options
                  desaSelect.empty();
                  desaSelect.append('<option value="">Pilih Desa</option>');

                  // Populate new options
                  data.listDesa.forEach(function(desa) {
                        desaSelect.append('<option value="' + desa.id_desa + '">' + desa.nama_desa + '</option>');
                  });

                  // Set the current user's desa if it exists
                  if (data.currentUserIdDesa !== null) {
                        desaSelect.val(data.currentUserIdDesa);
                  }
               }
            });
         }

         $('#role').change(function() {
           setUserAttribute();
           getDesa();
         });

         function setUserAttribute(){
            switch ($('#role').val()) {
                  case 'administrator':
                     $('#kecamatan_input').hide();
                     $('#kecamatan').prop('required', false);
                     $('#desa_input').hide();
                     $('#desa').prop('required', false);
                     break;
                  case 'koordinator':
                     $('#kecamatan_input').show();
                     $('#kecamatan').prop('required', true);
                     $('#desa_input').hide();
                     $('#desa').prop('required', false);
                     break;
                  case 'korcam':
                     $('#kecamatan_input').show();
                     $('#kecamatan').prop('required', true);
                     $('#desa_input').hide();
                     $('#desa').prop('required', false)
                     break;
                  case 'kordes':
                     $('#kecamatan_input').show();
                     $('#kecamatan').prop('required', true);
                     $('#desa_input').show();
                     $('#desa').prop('required', true)
                     break;
                  default:
                     $('#kecamatan_input').hide();
                     $('#desa_input').hide();
                     break;
            }
         }
      </script>
</body>
</html>