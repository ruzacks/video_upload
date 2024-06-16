<?php include('page-protection.php') ?>
<?php include('connection.php') ?>

<?php 
$conn = getConn();
$username = $_SESSION['username'];
$isChecker = $_SESSION['role'] == 'operator';

// Uploaded count query
if ($isChecker) {
    $sqlUploaded = "SELECT COUNT(*) as count FROM ektps WHERE upload_by = '$username'";
} else {
    $sqlUploaded = "SELECT COUNT(*) as count FROM ektps";
}

$resultUploaded = $conn->query($sqlUploaded);
$countUploaded = mysqli_fetch_assoc($resultUploaded)['count'];

// Downloaded count query
if ($isChecker) {
    $sqlDownloaded = "SELECT COUNT(*) as count FROM ektps WHERE status = 'downloaded' AND upload_by = '$username'";
} else {
    $sqlDownloaded = "SELECT COUNT(*) as count FROM ektps WHERE status = 'downloaded'";
}

$resultDownloaded = $conn->query($sqlDownloaded);
$countDownloaded = mysqli_fetch_assoc($resultDownloaded)['count'];

?>

<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>OCR - Pilah Data KTP</title>
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
                           <div class="rounded-circle iq-card-icon iq-bg-primary"><i class="ri-bar-chart-grouped-line"></i></div>
                           <span class="float-right line-height-6">Uploaded</span>
                           <div class="clearfix"></div>
                           <div class="text-center">
                              <h2 class="mb-0"><span class="counter" id="uploadCounter"><?php echo $countUploaded ?></span><span></span></h2>
                           </div>
                        </div>
                        <div id="chart-1"></div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body pb-0">
                           <div class="rounded-circle iq-card-icon iq-bg-warning"><i class="ri-bar-chart-grouped-line"></i></div>
                           <span class="float-right line-height-6" >Downloaded</span>
                           <div class="clearfix"></div>
                           <div class="text-center">
                              <h2 class="mb-0"><span class="counter" id="downloadCounter"><?php echo $countDownloaded ?></span><span></span></h2>
                              <p class="mb-0 text-secondary line-height"></i><span class="text-success" id="remainingUpload"><?php echo $countUploaded - $countDownloaded ?></span> Data belum di download</p>

                           </div>
                        </div>
                        <div id="chart-2"></div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="iq-card" <?php echo $_SESSION['role'] == 'operator' ? 'hidden' : '' ?>>
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Upload Summary</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                           <input type="number" class="form-control" id="selectingItem" oninput="selectingItemFunc()" placeholder="0" style="width: 100px;">
                           <a onclick="downloadSelection()" style="cursor: pointer;"><i class="ri-file-download-fill mr-2"></i>Download Selected</a>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              <div class="table-container">
                              <table id="table-ektp" class="table mb-0 table-borderless">
                                 <thead style="position:sticky">
                                    <tr>
                                       <th><input style="max-width: 150px;" type="text" id="filter-nik" placeholder="Filter NIK"></th>
                                       <th><input style="width: 150px;" type="text" id="filter-nama" placeholder="Filter Nama"></th>
                                       <th><input style="width: 150px;" type="text" id="filter-kelurahan" placeholder="Filter Kelurahan"></th>
                                       <th><input style="width: 150px;" type="text" id="filter-kecamatan" placeholder="Filter Kecamatan"></th>
                                       <th><input style="width: 150px;" type="date" id="filter-upload-date" placeholder="Filter Upload Date"></th>
                                       <th>
                                       <select id="filter-status" style="width: 150px;">
                                          <option value="">All Statuses</option>
                                          <option value="uploaded">Uploaded</option>
                                          <option value="downloaded">Downloaded</option>
                                          <option value="rejected">Rejected</option>
                                       </select>
                                       <th>
                                          <button type="button" id="filter-button" onclick="getFilteredData()" class="btn btn-primary mb-3">Filter</button>
                                          <button type="button" id="reset-button" onclick="resetAllFilter()" class="btn btn-secondary mb-3">Reset</button>
                                       </th> <!-- No filter for the action column -->
                                    </tr>
                                    <tr>
                                       <th scope="col"><input type="checkbox" id="checkAll">NIK<span id="tickCounter"></span></th>
                                       <th scope="col">Nama</th>
                                       <th scope="col">Kelurahan</th>
                                       <th scope="col">Kecamatan</th>
                                       <th scope="col">Upload Date</th>
                                       <th scope="col">Status</th>
                                       <th scope="col">Action</th>

                                    </tr>
                                 </thead>
                                 <tbody>
                                    
                                 </tbody>
                              </table>
                              </div>
                           </div>
                           <div class="row justify-content-center">
                              <div class="col">
                              <select class="" style="margin-top: 20px;" id="itemPerPageInput" onchange="reloadNumberofPage()">
                                 <option selected="" disabled="">Select data each page</option>
                                 <option>100</option>
                                 <option>200</option>
                                 <option>300</option>
                                 <option>400</option>
                                 <option>500</option>
                              </select>
                              </div>
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

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


      <?php include("js-helper.php") ?>
      <?php include("index-table-manipulation.php") ?>

      <script>

         getAllData();
         setInterval(function() {
            getCountData(); // Call your function inside the setInterval
         }, 3000);

         let currentPage = 1;
         let itemsPerPage = 100;
         let dataCache = [];

         function getAllData() {

            $.ajax({
                url: "ajax.php",
                type: "GET",
                data: { func: 'getAllData' },
                success: function(response) {
                    dataCache = response;
                    setupPagination(dataCache.length, itemsPerPage);
                    displayPage(currentPage);
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
         }

         function getCountData(){

            $.ajax({
                url: "ajax.php",
                type: "GET",
                data: { func: 'getCountData' },
                success: function(response) {
                   $('#uploadCounter').text(response.countUploaded);
                   $('#downloadCounter').text(response.countDownloaded);
                   const remaining = response.countUploaded - response.countDownloaded;
                   $('#remainingUpload').text(remaining);

                   console.log($('#remainingUpload').text());
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
         
         }

         function getFilteredData(){
            const filters = {
               func : 'getFilteredData',
               nik: $('#filter-nik').val().toLowerCase(),
               nama: $('#filter-nama').val().toLowerCase(),
               kelurahan: $('#filter-kelurahan').val().toLowerCase(),
               kecamatan: $('#filter-kecamatan').val().toLowerCase(),
               uploadDate: $('#filter-upload-date').val().toLowerCase(),
               status: $('#filter-status').val().toLowerCase()
            };

            $.ajax({
               url: "ajax.php",
               type: "GET",
               data : filters,
               success: function(response) {
                    dataCache = response;
                    setupPagination(dataCache.length, itemsPerPage);
                    displayPage(currentPage);
                    console.log(dataCache);
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
         }



            function getNikList(){
               const table = document.getElementById('table-ektp');
               const rows = table.getElementsByTagName('tr');
               const collectedData = [];

               
               for (let i = 0; i < rows.length; i++) {
                  const row = rows[i];
                  const checkbox = row.querySelector('input[type="checkbox"]');
                  
                  if (checkbox && checkbox.checked) {
                     const rowData = {
                        nik: row.cells[0].innerText.trim(), // Adjust substring as needed to remove leading space
                     };
                     collectedData.push(rowData);
                  }
               }

               return collectedData;
               
            }

            async function selectingItemFunc() {
               // Get the number of items to select from the input field
               const numToSelect = parseInt(document.getElementById('selectingItem').value);

               // Select the item per page dropdown
               const itemPerPageInput = document.getElementById('itemPerPageInput');
               const itemPerPageOptions = Array.from(itemPerPageInput.options);
               
               // Get the current item per page value
               let currentItemPerPage = parseInt(itemPerPageInput.value) || 0;

               // If numToSelect is larger than currentItemPerPage, update itemPerPageInput
               if (numToSelect > currentItemPerPage) {
                  const newOption = itemPerPageOptions.find(option => parseInt(option.value) >= numToSelect);
                  if (newOption) {
                     itemPerPageInput.value = newOption.value;
                     await reloadNumberofPage();
                  }
               }

               // Select all checkboxes within the table
               const checkboxes = document.querySelectorAll('table tbody input[type="checkbox"]');

               // Ensure all checkboxes are unchecked first
               checkboxes.forEach(checkbox => {
                  checkbox.checked = false;
                  checkbox.dispatchEvent(new Event('change')); // Trigger change event on unchecking
               });

               // Tick the specified number of checkboxes
               for (let i = 0; i < numToSelect && i < checkboxes.length; i++) {
                  checkboxes[i].checked = true;
                  checkboxes[i].dispatchEvent(new Event('change')); // Trigger change event on checking
               }
         }


            document.getElementById('checkAll').addEventListener('change', function() {
               const checkboxes = document.querySelectorAll('#table-ektp    tbody input[type="checkbox"]');
               for (const checkbox of checkboxes) {
                  checkbox.checked = this.checked;
                  checkbox.dispatchEvent(new Event('change'));
               }
               updateCounter();
            });

            function updateCounter() {
               // Reset counter
               var tickedCounter = 0;
               // Get all checkboxes
               const checkboxes = document.querySelectorAll('#table-ektp tbody input[type="checkbox"]');
               // Count ticked checkboxes
               checkboxes.forEach(function(checkbox) {
                  if (checkbox.checked) {
                        tickedCounter++;
                  }
               });

               if(tickedCounter > 0){
                  $('#tickCounter').text('(' + tickedCounter + ')');
               } else {
                  $('#tickCounter').text('');
               }
               // Display the updated count
            }

            function resetAllFilter(){
               $('#filter-nik').val('');
               $('#filter-nama').val('');
               $('#filter-kelurahan').val('');
               $('#filter-kecamatan').val('');
               $('#filter-upload-date').val('');
               $('#filter-status').val('');
               $('#itemPerPageInput').val('');

               itemsPerPage = 10;
               getAllData();

               displayPage(1);
            }

            function deleteDownloadedData() {
               $.ajax({
                  url: 'ajax.php',
                  type: 'GET',
                  data: { func: 'deleteOldDownloadedData' },
                  success: function(response) {
                        // Parse the JSON response
                        var responseData = JSON.parse(response);

                        // Display the SweetAlert message
                        Swal.fire({
                           icon: responseData.status,
                           text: responseData.message
                        });

                        // If the response status is "success", process the collectedData array
                        if (responseData.status === "success") {
                           collectedData.forEach(function(rowData) {
                              deleteFromCache(function(obj) {
                                    return obj.nik === rowData.nik;
                              });
                           });
                        }
                  },
                  error: function(xhr, status, error) {
                        // Handle any errors that occur during the AJAX request
                        Swal.fire({
                           icon: 'error',
                           text: 'An error occurred: ' + error
                        });
                  }
               });
            }

            

          

           

      </script>
   </body>
</html>
