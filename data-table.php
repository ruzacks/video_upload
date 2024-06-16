<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sofbox - Responsive Bootstrap 4 Admin Dashboard Template</title>
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
                              <h4 class="card-title">Uploaded Data</h4>
                           </div>
                           <span class="table-add float-right mb-3 mr-2">
                              <a type="button" class="btn iq-bg-success btn-rounded btn-sm my-0"><i class="ri-add-fill"></i>Add New</a>
                           </span>
                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              <table id="datatable" class="table table-striped table-bordered" >
                                 <thead>
                                       <tr>
                                          <th>NIK</th>
                                          <th>Nama</th>
                                          <th>Desa</th>
                                          <th>Kecamatan</th>
                                          <th>Action</th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                       <tr>
                                          <td style="text-align:center">123456789123456789</td>
                                          <td>Didin Darmawan</td>
                                          <td>Kalijati</td>
                                          <td>Prageun</td>
                                          <td style="text-align:center">
                                             <span class="table-remove">
                                                <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                             </span>
                                          </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">987654321987654321</td>
                                             <td>Siti Aminah</td>
                                             <td>Sukajadi</td>
                                             <td>Pagaden</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">123123123123123123</td>
                                             <td>Ahmad Yusuf</td>
                                             <td>Karanganyar</td>
                                             <td>Cipeundeuy</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">456456456456456456</td>
                                             <td>Lia Mulyani</td>
                                             <td>Cikaso</td>
                                             <td>Compreng</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">789789789789789789</td>
                                             <td>Budi Santoso</td>
                                             <td>Karawang</td>
                                             <td>Karawang Barat</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">321321321321321321</td>
                                             <td>Susan Permata</td>
                                             <td>Kebon</td>
                                             <td>Kutawaluya</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">654654654654654654</td>
                                             <td>Rudi Hartono</td>
                                             <td>Purwadadi</td>
                                             <td>Purwadadi</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">147147147147147147</td>
                                             <td>Wati Susanti</td>
                                             <td>Jatisari</td>
                                             <td>Jatisari</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">258258258258258258</td>
                                             <td>Endang Suherman</td>
                                             <td>Rawamerta</td>
                                             <td>Rawamerta</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">369369369369369369</td>
                                             <td>Yusuf Nugroho</td>
                                             <td>Tegalwaru</td>
                                             <td>Majalaya</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">951951951951951951</td>
                                             <td>Rahmawati</td>
                                             <td>Telukjambe</td>
                                             <td>Telukjambe Timur</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                       <tr>
                                             <td style="text-align:center">753753753753753753</td>
                                             <td>Agus Salim</td>
                                             <td>Rengasdengklok</td>
                                             <td>Rengasdengklok</td>
                                             <td style="text-align:center">
                                                <span class="table-remove">
                                                   <button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Reject</button>
                                                   <button type="button" class="btn iq-bg-info btn-rounded btn-sm my-0">Edit</button>
                                                   <button type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0">Download</button>
                                                </span>
                                             </td>
                                       </tr>
                                 </tfoot>
                              </table>
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
</body>
</html>