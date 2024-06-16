<?php include('page-protection.php') ?>
<?php include('connection.php') ?>
<?php

if(($_SESSION['role'] == 'koordinator' || $_SESSION['role'] == 'korcam') && (!isset($_GET['id_kec']) || !isset($_GET['id_des']))){
   $idKec = $_SESSION['id_kecamatan'];
   header("Location: index.php?id_kec=$idKec");
} else if($_SESSION['role'] =='kordes' && !isset($_GET['id_des'])){
   $idDes = $_SESSION['id_desa'];
   header("Location: index.php?id_des=$idDes");
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
                  <div class="col-md-6 col-lg-12">
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
               </div>
               <div class="row">
                  <?php 
                  if(isset($_GET['id_kec'])){
                     include("summary-desa.php");
                  } else if(isset($_GET['id_des'])){
                     
                  } else {
                     include('summary-kecamatan.php'); 
                  }
                  
                  ?>
               </div>
                  <?php 
                        if(isset($_GET['id_des'])){
                           include("tabel-data-video.php");
                        }
                     ?>
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
                  <div class="modal-body">
                     <video id="videoPlayer" width="100%" controls>
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

      <script>

         getDataDesa();

         function getDataDesa(page = 1){
            $.ajax({
               url: 'ajax.php',
               method: 'POST',
               data: {
                     func: 'getDataDesa',
                     id_desa: $('#id_desa').val(),
                     page: page
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

                        const tdVideo = document.createElement('td');
                        const playButton = document.createElement('button');
                        playButton.textContent = 'Play Video';
                        playButton.className = 'btn btn-primary';
                        playButton.onclick = function() {
                           const videoSrc = `videos/${item.video_name}.${item.extension}`;
                           document.getElementById('videoModalLabel').textContent = item.video_name;
                           document.getElementById('videoPlayer').src = videoSrc;
                           $('#videoModal').modal('show');
                        };
                        tdVideo.appendChild(playButton);
                        tr.appendChild(tdVideo);

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
               }
            });
         }
      </script>
   </body>
</html>
