<?php include('page-protection.php') ?>
<?php include('connection.php') ?>
<?php include('lib-data.php') ?>

<?php

if ($_SESSION['role'] == 'koordinator' || $_SESSION['role'] == 'korcam') {
   $idKec = $_SESSION['id_kecamatan'];
   if (!isset($_GET['id_kec']) || $_GET['id_kec'] != $idKec) {
       header("Location: index.php?id_kec=$idKec");
       exit;
   }
} else if ($_SESSION['role'] == 'kordes') {
   $idDes = $_SESSION['id_desa'];
   if (!isset($_GET['id_des']) || $_GET['id_des'] != $idDes) {
       header("Location: index.php?id_des=$idDes");
       exit;
   }
}

$conn = getConn();
$sql = "SELECT COUNT(nik) AS count FROM videos";


if(isset($_GET['id_kec'])){
   $idKec = $_GET['id_kec'];
   $sql .= " WHERE id_kecamatan = '$idKec'";
}

if(isset($_GET['id_des'])){
   $idDes = $_GET['id_des'];
   $sql .= " WHERE id_desa = '$idDes'";
}
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $jumlahData = $row['count'];
} else {
    // Handle query error
    $jumlahData = 0; // or any error handling logic
}

// Don't forget to close the connection
mysqli_close($conn);

?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dashboard</title>
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
      <style>

         .red-font {
            color: red;
         }
         
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            position: -webkit-sticky; /* For Safari */
            position: sticky;
            top: 0;
            background-color: #fff; /* Add background color to prevent content overlap */
            z-index: 1; /* Ensure the header is above table content */
            border: 1px solid #ddd;
            padding: 8px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table-container {
            max-height: 600px; /* Adjust as needed */
            overflow-y: auto;
        }
    </style>
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
                  <div class="col-md-6 col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body pb-0">
                           <div class="rounded-circle iq-card-icon iq-bg-success"><i class="ri-group-line"></i></div>
                           <span class="float-right line-height-6">Total Data</span>
                           <div class="clearfix"></div>
                           <div class="text-center">
                              <h2 class="mb-0"><span class="counter"><?= $jumlahData ?></span></h2>
                              <p class="mb-0 text-secondary line-height"></p>
                           </div>
                        </div>
                        <div id="chart-3"></div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body pb-0">
                        <?php 
                           if(isset($_GET['id_kec'])){
                              include("summary-desa.php");
                           } else if(isset($_GET['id_des'])){
                              ?>
                              <div class="text-center">
                                 <h2 class="mb-0"><span class="counter"><?= $jumlahData ?></span></h2>
                              </div>
                              <?php
                           } else {
                              include('summary-kecamatan.php'); 
                           }
                           
                        ?>
                           
                        </div>
                        <div id="chart-2"></div>
                     </div>
                  </div>
               </div>
               <div class="row">
                 
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Summary Data</h4>
                              
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                 <i class="ri-more-2-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                 <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                 <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                 <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                 <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                 <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                                 </div>
                              </div>
                           </div>
                     </div>
                     <input type="hidden" id="username" value="<?= $_SESSION['role'] == 'kordes' ? $_SESSION['username'] : '' ?>">
                     <div class="iq-card-body">
                           <div class="table-responsive">
                              <table id="tableDataVideo" class="table mb-0 table-borderless">
                                 <thead>
                                 <tr>
                                       <th><input class="form-control" style="max-width: 150px;" type="text" id="filter-nik" placeholder="Filter NIK"></th>
                                       <th><input class="form-control" style="width: 150px;" type="date" id="filter-upload-date" placeholder="Filter Upload Date"></th>
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
                                       <th><input class="form-control" style="width: 150px;" type="text" id="filter-upload-by" placeholder="Upload By"></th>
                                       <th scope="col"></th>
                                       <th>
                                          <button type="button" id="filter-button" onclick="getDataDesa()" class="btn btn-primary">Filter</button>
                                          <button type="button" id="reset-button" onclick="resetFilter()" class="btn btn-secondary">Reset</button>
                                       </th>
                                 </tr>
                                 <tr>
                                       <th scope="col">NIK</th>
                                       <th scope="col">Tanggal Upload</th>
                                       <th scope="col">Nama Kecamatan</th>
                                       <th scope="col">Nama Desa</th>
                                       <th scope="col">Upload By</th>
                                       <th scope="col">Video</th>
                                       <th scope="col">Action</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 
                                 </tbody>
                              </table>
                              <div class="col">                           
                                       <nav aria-label="Page navigation example" style="margin-top: 20px;">
                                       <ul class="pagination justify-content-end" id="pagination" style="cursor:pointer">
                                       <li class="page-item disabled">
                                          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                       </li>
                                       <li class="page-item"><a class="page-link" href="#">1</a></li>
                                       <li class="page-item"><a class="page-link" href="#">2</a></li>
                                       <li class="page-item"><a class="page-link" href="#">3</a></li>
                                       <li class="page-item">
                                          <a class="page-link" href="#">Next</a>
                                       </li>
                                       </ul>
                                 </nav>
                              </div>
                              <span id="totalRecords"></span>
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
      <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="videoModalLabel">Video</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body justify-content-center" style="justify-content: center;">
                     <video id="videoPlayer" height="480px" width="765px" controls>
                           <source src="" type="video/mp4">
                           Your browser does not support the video tag.
                     </video>
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
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

      <script>
         getDesa();

         setTimeout(function() {
            getDataDesa();
         }, 1500);

         function resetFilter(){
            $('#filter-nik').val('');
            <?php 
               if($_SESSION['role'] == 'administrator'){
                  ?>
                  $('#filter-kecamatan').val('');
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
            $('#filter-upload-date').val('');
            $('#filter-upload-by').val('');

            getDataDesa();
         }

         function getDataDesa(page = 1){
            $.ajax({
               url: 'ajax.php',
               method: 'POST',
               data: {
                     func: 'getDataDesa',
                     page: page,
                     nik: $('#filter-nik').val(),
                     id_kec: $('#filter-kecamatan').val(),
                     id_des: $('#filter-desa').val(),
                     upload_date: $('#filter-upload-date').val(),
                     upload_by: $('#filter-upload-by').val(),
               },
               success: function(response) {
                     const data = JSON.parse(response);
                     const table = document.getElementById('tableDataVideo');
                     const tbody = table.getElementsByTagName('tbody')[0];
                     tbody.innerHTML = ''; // Clear existing data

                     data.results.forEach(item => {
                        const tr = document.createElement('tr');

                        const tdNik = document.createElement('td');
                        tdNik.textContent = item.nik;
                        tr.appendChild(tdNik);

                        const tdCreatedAt = document.createElement('td');
                        tdCreatedAt.textContent = item.created_at;
                        tr.appendChild(tdCreatedAt);

                        const tdKecamatan = document.createElement('td');
                        tdKecamatan.textContent = item.nama_kecamatan;
                        tr.appendChild(tdKecamatan);

                        const tdDesa = document.createElement('td');
                        tdDesa.textContent = item.nama_desa;
                        tr.appendChild(tdDesa);

                        const tdUploadBy = document.createElement('td');
                        tdUploadBy.textContent = item.upload_by;
                        tr.appendChild(tdUploadBy);

                        const tdVideo = document.createElement('td');

                        const playButton = document.createElement('button');
                        playButton.textContent = 'Play';
                        playButton.className = 'btn btn-primary';
                        playButton.onclick = function() {
                           const videoSrc = `videos/${item.video_name}.${item.extension}`;
                           document.getElementById('videoModalLabel').textContent = item.video_name;
                           document.getElementById('videoPlayer').src = videoSrc;
                           $('#videoModal').modal('show');
                        };
                        tdVideo.appendChild(playButton);

                        <?php if($_SESSION['role'] == 'administrator') { ?>
                        const downloadButton = document.createElement('button');
                        downloadButton.textContent = 'Download';
                        downloadButton.className = 'btn btn-success mx-1';
                        downloadButton.onclick = function() {
                           const videoSrc = `videos/${item.video_name}.${item.extension}`;
                           const link = document.createElement('a');
                           link.href = videoSrc;
                           link.download = `${item.video_name}.${item.extension}`;
                           document.body.appendChild(link);
                           link.click();
                           document.body.removeChild(link);
                        };
                        tdVideo.appendChild(downloadButton);
                        <?php } ?>
                        tr.appendChild(tdVideo);


                        
                        //td action
                        <?php if (strpos($_SESSION['username'],'kpu') === false) { ?>
                           
                        const tdAction = document.createElement('td');
                        const editButton = document.createElement('a');
                        editButton.textContent = 'Edit';
                        editButton.href = `edit-upload.php?id=${item.id}`;
                        editButton.className = 'btn btn-warning';
                        tdAction.appendChild(editButton);

                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Delete';
                        deleteButton.className = 'btn btn-danger mx-2';
                        deleteButton.onclick = function() {
                           Swal.fire({
                              title: 'Are you sure?',
                              text: "You won't be able to revert this!",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Yes, delete it!'
                           }).then((result) => {
                              if (result.isConfirmed) {
                                    $.ajax({
                                       url: 'ajax.php',
                                       method: 'POST',
                                       data: {
                                          func: 'deleteVideo',
                                          id: item.nik,
                                          id_video: `${item.video_name}.${item.extension}`
                                       },
                                       beforeSend: function() {
                                          Swal.fire({
                                                title: 'Deleting...',
                                                text: 'Please wait while the video is being deleted.',
                                                icon: 'info',
                                                allowOutsideClick: false,
                                                showConfirmButton: false
                                          });
                                       },
                                       success: function(response) {
                                          if (response.status == "success") {
                                                Swal.fire(
                                                   'Deleted!',
                                                   'The video has been deleted.',
                                                   'success'
                                                );
                                                tr.remove();
                                                getDataDesa();
                                          } else {
                                                Swal.fire(
                                                   'Error!',
                                                   response.message,
                                                   'error'
                                                );
                                          }
                                       }
                                    });
                              }
                           });
                        };
                        tdAction.appendChild(deleteButton);
                        tr.appendChild(tdAction);
                        <?php } ?>

                        tbody.appendChild(tr);
                     });

                     // Create pagination
                     const pagination = document.getElementById('pagination');
                     pagination.innerHTML = ''; // Clear existing pagination

                     const previousPage = document.createElement('li');
                     previousPage.className = `page-item ${page === 1 ? 'disabled' : ''}`;
                     const previousLink = document.createElement('a');
                     previousLink.className = 'page-link';
                     previousLink.href = '#';
                     previousLink.textContent = 'Previous';
                     previousLink.onclick = function() {
                        if (page > 1) {
                           getDataDesa(page - 1);
                        }
                     };
                     previousPage.appendChild(previousLink);
                     pagination.appendChild(previousPage);

                     for (let i = 1; i <= data.totalPages; i++) {
                        const pageItem = document.createElement('li');
                        pageItem.className = `page-item ${i === page ? 'active' : ''}`;
                        const pageLink = document.createElement('a');
                        pageLink.className = 'page-link';
                        pageLink.href = '#';
                        pageLink.textContent = i;
                        pageLink.onclick = function() {
                           getDataDesa(i);
                        };

                        pageItem.appendChild(pageLink);
                        pagination.appendChild(pageItem);
                     }

                     const nextPage = document.createElement('li');
                     nextPage.className = `page-item ${page === data.totalPages ? 'disabled' : ''}`;
                     const nextLink = document.createElement('a');
                     nextLink.className = 'page-link';
                     nextLink.href = '#';
                     nextLink.textContent = 'Next';
                     nextLink.onclick = function() {
                        if (page < data.totalPages) {
                           getDataDesa(page + 1);
                        }
                     };
                     nextPage.appendChild(nextLink);
                     pagination.appendChild(nextPage);

                     //dislpay total records
                     const totalRecords = document.getElementById('totalRecords');
                     totalRecords.innerHTML = '';
                     totalRecords.textContent = data.totalRecordFound + ' Data found(s)';

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
