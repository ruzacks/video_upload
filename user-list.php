<?php include('page-protection.php') ?>
<?php include('connection.php') ?>
<?php include('lib-data.php') ?>
<?php 
if($_SESSION['role'] == 'kordes'){
   header("Location: not-found.php");
   exit();
}

?>


<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title></title>
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
            <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">User List</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                     <?php $error = isset($_GET['error']) ? $_GET['error'] : ''; ?>
                     <div class="alert alert-danger" role="alert" <?php echo empty($error) ? 'hidden' : ''; ?>>
                        <div class="iq-alert-text"><?php echo $error; ?></div>
                     </div>
                     <?php $succeed = isset($_GET['success']) ? $_GET['success'] : ''; ?>
                     <div class="alert alert-success" role="alert" <?php echo empty($succeed) ? 'hidden' : ''; ?>>
                        <div class="iq-alert-text"><?php echo $succeed; ?></div>
                     </div>
                        <div class="table-responsive">
                           <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                             <thead>
                              <tr>
                                    <th><input class="form-control" style="max-width: 150px;" type="text" id="filter-username" placeholder="Filter Username"></th>
                                    <th></th>
                                    <th>
                                    <select class="form-control" id="filter-role" name="filter-role" required <?php if ($_SESSION['role'] == 'korcam') { ?> style="pointer-events: none;" <?php } ?> >
                                       <option selected="" disabled="">Select Role</option>
                                       <?php 
                                          if($_SESSION['role'] == 'administrator'){
                                       ?>
                                          <option value="administrator" >Administrator</option>
                                          <option value="koordinator" >Koordinator</option>
                                       <?php 
                                          } 
                                       ?>
                                       <option value="korcam" >Korcam</option>
                                       <option value="kordes" <?= ($_SESSION['role'] == 'korcam') ? 'selected' : '' ?> >Kordes</option>
                                    </select>
                                    </th>
                                    <th>
                                       <select class="form-control" id="filter-kecamatan" name="filter-kecamatan" <?= ($_SESSION['role'] != 'administrator' ) ? 'style="pointer-events: none;"' : ''; ?> > 
                                          <option value="">Pilih Kecamatan</option>
                                          <?php
                                             foreach ($kecamatans as $kecamatan){
                                                ?>
                                                   <option value="<?php echo $kecamatan->id_kecamatan; ?>" <?= ($_SESSION['role'] != 'administrator'  && $_SESSION['id_kecamatan'] == $kecamatan->id_kecamatan) ? 'selected' : ''; ?> ><?php echo $kecamatan->nama_kecamatan; ?></option>

                                                <?php
                                             }
                                          ?>
                                       </select> 
                                    </th>
                                    <th>
                                       <select class="form-control" id="filter-desa" name="filter-desa" <?= ($_SESSION['role'] == 'kordes' ) ? 'style="pointer-events: none;"' : ''; ?> > 
                                          <option value="">Pilih Desa</option>
                                       </select>
                                    </th>
                                    <th>
                                       <button type="button" id="filter-button" onclick="getAllUser()" class="btn btn-primary">Filter</button>
                                       <button type="button" id="reset-button" onclick="resetFilter()" class="btn btn-secondary">Reset</button>
                                    </th>
                                 </tr>
                                 <tr>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <!-- <tr>
                                    <td>Anna Sthesia</td>
                                    <td>(760) 756 7568</td>
                                    <td>Bandung</td>
                                    <td><span class="badge iq-bg-primary">Active</span></td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr>  -->
                             </tbody>
                           </table>
                        </div>
                           <div class="row justify-content-between mt-3">
                              <div id="user-list-page-info" class="col-md-6">
                                 <!-- <span>Showing 1 to 5 of 5 entries</span> -->
                              </div>
                              <div class="col-md-6">
                                 <!-- <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end mb-0">
                                       <li class="page-item disabled">
                                          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                       </li>
                                       <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                       <li class="page-item"><a class="page-link" href="#">2</a></li>
                                       <li class="page-item"><a class="page-link" href="#">3</a></li>
                                       <li class="page-item">
                                          <a class="page-link" href="#">Next</a>
                                       </li>
                                    </ul>
                                 </nav> -->
                              </div>
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

      <!-- Modal -->
      <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="userModalLabel">User Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p id="modalNama"></p>
            <p id="modalNoWa"></p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
      </div>


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

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


      <script>
         getAllUser();
         getDesa();

         function getAllUser() {
            $.ajax({
               url: "ajax-user.php",
               type: "GET",
               data: { 
                  func: 'getAllUser',
                  username: $('#filter-username').val(),
                  role: $('#filter-role').val(),
                  kecamatan: $('#filter-kecamatan').val(),
                  desa: $('#filter-desa').val(),    
               },
               success: function(response) {
                     // Clear existing table rows
                     $('#user-list-table tbody').empty();
                     
                     // Loop through each user data and create a row
                     response.forEach(function(user) {
                        var row = createUserRow(user);
                        $('#user-list-table tbody').append(row);
                     });
               },
               error: function(xhr, status, error) {
                     console.error("Error: " + error);
               }
            });
         }

         function resetFilter(){
            $('#filter-username').val('');
            <?php 
               if($_SESSION['role'] == 'administrator'){
                  ?>
                  $('#filter-kecamatan').val('');
                  $('#filter-role').val('');
                  <?php
               }
            ?>
            <?php 
               if($_SESSION['role'] != 'kordes'){
                  ?>
                  $('#filter-desa').val('');
                  <?php
               }
            ?>

            getAllUser();
         }

         function createUserRow(userData) {
            var row = document.createElement('tr');
            
            var usernameCell = document.createElement('td');
            var usernameLink = document.createElement('a');
            usernameLink.href = '#';
            usernameLink.textContent = userData.username;
            usernameLink.setAttribute('data-toggle', 'modal');
            usernameLink.setAttribute('data-target', '#userModal');
            usernameLink.addEventListener('click', function() {
               document.getElementById('modalNama').textContent = 'Name: ' + userData.nama;
               document.getElementById('modalNoWa').textContent = 'WhatsApp: ' + userData.no_wa;
            });
            
            usernameCell.appendChild(usernameLink);
            row.appendChild(usernameCell);

            var passwordCell = document.createElement('td');
            passwordCell.textContent = userData.password;
            row.appendChild(passwordCell);
            
            var roleCell = document.createElement('td');
            roleCell.textContent = userData.role;
            row.appendChild(roleCell);

            var kecamatanCell = document.createElement('td');
            kecamatanCell.textContent = userData.kecamatan;
            row.appendChild(kecamatanCell);

            var desaCell = document.createElement('td');
            desaCell.textContent = userData.desa;
            row.appendChild(desaCell);
                        
            var actionCell = document.createElement('td');
            var actionDiv = document.createElement('div');
            actionDiv.className = 'flex align-items-center list-user-action';
            var editLink = document.createElement('a');
            editLink.setAttribute('href', 'user-edit.php?username=' + userData.username);
            editLink.setAttribute('data-toggle', 'tooltip');
            editLink.setAttribute('data-placement', 'top');
            editLink.setAttribute('title', 'Edit');
            editLink.innerHTML = '<i class="ri-pencil-line"></i>';
            var deleteLink = document.createElement('a');
            deleteLink.setAttribute('href', '#');
            deleteLink.setAttribute('data-toggle', 'tooltip');
            deleteLink.setAttribute('data-placement', 'top');
            deleteLink.setAttribute('title', 'Delete');
            deleteLink.innerHTML = '<i class="ri-delete-bin-line"></i>';
            deleteLink.onclick = function() {
               deleteUser(userData.username);
            }
            actionDiv.appendChild(editLink);
            actionDiv.appendChild(deleteLink);
            actionCell.appendChild(actionDiv);
            row.appendChild(actionCell);
            
            return row;
         }

         function handleStatusChange(username, isChecked, statusLabel) {
         var newStatus = isChecked ? 'active' : 'inactive';

         $.ajax({
            type: 'POST',
            url: 'ajax-user.php',
            data: { func:'changeUserStatus', username: username, status: newStatus },
            success: function(response) {
                  var result = JSON.parse(response);
                  if (result.status === 'success') {
                     statusLabel.textContent = newStatus === 'active' ? 'Active' : 'Inactive';
                  } else {
                     alert('Failed to update status');
                     $(`#customSwitch${username}`).prop('checked', !isChecked); // Revert the checkbox state
                  }
            },
            error: function() {
                  alert('Failed to update status');
                  $(`#customSwitch${username}`).prop('checked', !isChecked); // Revert the checkbox state
            }
         });
      }

      function deleteUser(username){
         Swal.fire({
            title: 'Are you sure?',
            text: `Do you really want to delete the user ${username}? This process cannot be undone.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
               if (result.isConfirmed) {
               $.ajax({
                  url: 'ajax-user.php',
                  method: 'POST',
                  data: { func: 'deleteUser', username: username },
                  success: function(response) {
                     Swal.fire({
                        title: response.status,
                        text: response.message,
                        icon: response.status,
                        confirmButtonText: 'OK',
                        timer: 1500,
                        timerProgressBar: true,
                        didClose: () => {
                            if (response.status === "success") {
                               getAllUser();
                            } 
                        }
                    });
                  },
                  error: function() {
                     Swal.fire({
                           title: 'Error!',
                           text: 'An error occurred while processing your request.',
                           icon: 'error',
                           confirmButtonText: 'OK'
                     });
                  }
               });
            }
         });
      }

      $('#filter-kecamatan').change(function() {
            getDesa();
         });

         function getDesa(){
            var idKecamatan = $('#filter-kecamatan').val();

            $.ajax({
               url: 'ajax.php',
               method: 'POST',
               data: {
                  func: 'getDesa',
                  username: $('#username').val(),
                  id_kecamatan: idKecamatan
               },
               success: function(response) {
                  var data = response;
                  var desaSelect = $('#filter-desa');

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

      </script>
</body>
</html>