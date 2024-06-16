<?php include('page-protection.php') ?>
<?php include('connection.php') ?>
<?php include('lib-data.php') ?>
<?php 


?>

<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Data Input</title>
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

      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
      <link href="https://cdn.jsdelivr.net/gh/tapmodo/Jcrop@0.9.12/css/jquery.Jcrop.min.css" rel="stylesheet" />

      <style>
        /* Ensure no CSS is hiding video controls */
        video::-webkit-media-controls {
            display: flex !important;
        }
        video::-moz-media-controls {
            display: flex !important;
        }
        video::-ms-media-controls {
            display: flex !important;
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
                 <div class="col-sm-12 col-lg-6 order-2 order-lg-1">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Video Data</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <form id="dataForm">
                           <div class="form-group">
                              <label for="nik">NIK</label>
                              <input type="text" class="form-control" id="nik" name="nik" maxlength="16" minlength="16" pattern="\d{16}" inputmode="numeric" required>
                              <small id="nik-error" class="text-danger" style="display:none;">No matching kecamatan found</small>
                           </div>
                           <div class="form-group" id="kecamatan_input">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="form-control" id="kecamatan" name="kecamatan" required > 
                                    <option value="">Pilih Kecamatan</option>
                                    <?php
                                       foreach ($kecamatans as $kecamatan){
                                          ?>
                                             <option value="<?php echo $kecamatan->id_kecamatan; ?>"> <?php echo $kecamatan->nama_kecamatan; ?></option>

                                          <?php
                                       }
                                    ?>
                                    </select>                                     
                              </div>
                              <div class="form-group" id="desa_input">
                                    <label for="desa">Desa</label>
                                    <select class="form-control" id="desa" name="desa" required> 
                                    <option value="">Pilih Desa</option>
                                    </select>                                     
                              </div>                           
                           <button type="submit" class="btn btn-primary">Upload</button>
                           <button type="button" class="btn iq-bg-danger" id="resetButton">Reset</button>
                     </form>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-lg-6 order-1 order-lg-2 sticky-card">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Video</h4>
                        </div>
                        <span class="table-add float-right">
                        <a type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0" onclick="document.getElementById('videoInput').click();">Take A Video</a>
                        <input type="file" accept="video/*" id="videoInput" hidden >
                        </span>
                     </div>
                     <div class="iq-card-body">
                        <div class="row mt-4">
                           <div class="col-lg-12 col-md-6 text-center canvas-container">
                              <p class="iq-bg-secondary pt-5 pb-5 text-center rounded font-size-18" id="frame-template" onclick="document.getElementById('videoInput').click();" style="cursor:pointer">Take A Video</p>
                              <video id="videoPlayer" style="display: none; width: 100%; height: auto;" controls></video>
                              <small id="videoError" class="text-danger" style="display:none;">Please select a valid video.</small>
                              <progress id="progress" value="0" max="100" hidden></progress>
                              <p id="status" hidden>Waiting...</p>
                              <a type="button" class="btn iq-bg-success btn-rounded btn-sm my-0" id="scan-button" style="display: none;" onclick="uploadAndProcessImage()">Scan</a>

                              
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

      <!-- Jcrop -->
      <script src="https://cdn.jsdelivr.net/gh/tapmodo/Jcrop@0.9.12/js/jquery.Jcrop.min.js"></script>
      <!-- SweetAlert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script src="https://unpkg.com/@ffmpeg/ffmpeg@0.6.1/dist/ffmpeg.min.js"></script>
      
      <script>

let duration = 0;
let progress = 0;
let videoSize = 0;
const MAX_FILE_SIZE_MB = 100

const { createWorker } = FFmpeg;
        let worker;
         let i = 0;
        // Function to initialize FFmpeg worker
        async function initializeWorker() {
            worker = createWorker({
                logger: m => getMessage(m.message)
            });

            await worker.load();
            console.log('Worker loaded successfully');
        }

        // Function to compress the uploaded video
        async function compressVideo(inputFile) {
            try {
                // Write the input file to be processed by the worker
                await worker.write('input.mp4', inputFile);
                

                // Run FFmpeg command to process the video
                await worker.run("-i input.mp4 -c:v libx264 -preset fast -crf 25 -vf scale=854:480 -x264-params keyint=25:keyint_min=25 -an -f mp4 output.mp4");

                console.log('FFmpeg processing finished');

                // Read the processed output file
                const { data } = await worker.read('output.mp4');
                console.log('Output file read', data);

                 // Create a Blob from the processed data
                 const blob = new Blob([data.buffer], { type: 'video/mp4' });

                  // Create a File object from the Blob
                  const file = new File([blob], 'output.mp4', { type: 'video/mp4' });

                  // Programmatically set the File object as the value of a new File input element
                  const fileInput = document.createElement('input');
                  fileInput.type = 'file';
                  fileInput.id = "video_input";
                  fileInput.style = "display:none;"
                  const dataTransfer = new DataTransfer();
                  dataTransfer.items.add(file);
                  fileInput.files = dataTransfer.files;

                  console.log(videoSize,'  ->  ',file.size);

                  // Append the new File input element to the form
                  document.getElementById('dataForm').appendChild(fileInput); 

                // You can now do something with the processed video data, such as displaying it or further processing.
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // Initialize worker when the page is loaded
        window.onload = function() {
            initializeWorker().catch(error => {
                console.error('Error initializing worker:', error);
            });
        };

        

        function parseTime(timeStr) {
            const [hours, minutes, seconds] = timeStr.split(':');
            const [secs, ms] = seconds.split('.');
            return (+hours * 3600) + (+minutes * 60) + +secs + (+ms / 100);
        }

        function getMessage(message) {
            // Check for duration
            const durationMatch = message.match(/duration: (\d{2}:\d{2}:\d{2}\.\d{2})/i);
            if (durationMatch) {
                duration = parseTime(durationMatch[1]);
                document.getElementById('status').textContent = `Duration: ${durationMatch[1]}`;
            }

            // Check for progress time
            const progressMatch = message.match(/time=(\d{2}:\d{2}:\d{2}\.\d{2})/i);
            if (progressMatch && duration !== null) {
                const currentTime = parseTime(progressMatch[1]);
                progress = (currentTime / duration) * 100;

                const progressElement = document.getElementById('progress');
                progressElement.value = progress;

                const statusElement = document.getElementById('status');
                statusElement.textContent = `Progress: ${progress.toFixed(2)}% (${progressMatch[1]})`;
            }

            // Check for "muxing overhead"
            if (message.includes("muxing overhead")) {
               progress = 100;
               const progressElement = document.getElementById('progress');
               progressElement.value = progress;

               const statusElement = document.getElementById('status');
               statusElement.textContent = `Progress: 100% (completed)`;
            }
        }


                    var coorDinates = null;

            //RESET FORM
            $('#resetButton').on('click', function() {
                resetForm();
            });

            function resetForm(){
               $('#dataForm')[0].reset();
                $('#videoInput').val('');
               
                $('#frame-template').show();
                $('#scan-button').hide();
                $('#imageCanvas').hide();
                $('#videoPlayer').attr('src', '').hide();
               
            }

            // Function to get the image data from the canvas
            function getCanvasImage() {
                const canvas = document.getElementById('imageCanvas');
                return canvas.toDataURL('image/png');
            }

            function dataURItoBlob(dataURI) {
               const byteString = atob(dataURI.split(',')[1]);
               const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
               const ab = new ArrayBuffer(byteString.length);
               const ia = new Uint8Array(ab);
               for (let i = 0; i < byteString.length; i++) {
                  ia[i] = byteString.charCodeAt(i);
               }
               return new Blob([ab], { type: mimeString });
            }

            function getImageDataFromImgTag(imageTagId) {
               const imageElement = $(`#${imageTagId}`)[0];
               const dataURI = imageElement.src;
               // Convert data URI to Blob
               const blob = dataURItoBlob(dataURI);
               return blob;
            }

            //SUBMIT FORM
            // Form submission with AJAX
            $('#dataForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const formData = new FormData(this); // Use FormData to handle file uploads

                // Get image data from #imagePreview
               //  if (!document.getElementById('video_input')) {
               if (!document.getElementById('videoInput').files[0]) {

                  swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: 'Please upload a video file.',
                  });
                  return; // Exit the function if video_input is not present
               }

               // Append video file to form data
               // formData.append('video', document.getElementById('video_input').files[0]);
               formData.append('video', document.getElementById('videoInput').files[0]);

               Swal.fire({
                  title: 'Uploading...',
                  text: 'Please wait while the video is being uploaded.',
                  allowOutsideClick: false,
                  didOpen: () => {
                     Swal.showLoading();
                  }
               });
               
                $.ajax({
                    url: 'upload.php', // Endpoint to send the form data
                    type: 'POST',
                    data: formData,
                    contentType: false, // Required for FormData
                    processData: false, // Required for FormData
                    success: function(response) {
                        // Handle success response
                       Swal.fire({
                           icon: response.status,
                           title: response.message,
                           timer: 1500
                       });
                       if(response.status == "success"){
                           resetForm();
                       }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        Swal.fire({
                           icon: "error",
                           title: response.message,
                           // timer: 1000
                       });
                    }
                });
            });

            $('#videoInput').on('change', function(event) {
               
               const file = event.target.files[0];
               if (!file) {
                  $('#videoError').show().text('No file selected.');
                  return;
               }
               
               // Check if the selected file is a video
               if (file.type.indexOf('video/') !== 0) {
                  $('#videoError').show().text('Please select a valid video file.');
                  return;
               }

               videoSize =  file.size / (1024 * 1024);
               if (videoSize> MAX_FILE_SIZE_MB) {
                  $('#videoError').show().text(`File size exceeds ${MAX_FILE_SIZE_MB} MB.`);
                  return;
               }

               // compressVideo(file).catch(error => {
               //      console.error('Error compressing video:', error);
               //  });
               
               $('#videoError').hide();
               $('#frame-template').hide();

               const videoURL = URL.createObjectURL(file);
               const videoPlayer = $('#videoPlayer');

               videoPlayer.attr('src', videoURL).show();
               // videoPlayer[0].play();

               // Clean up object URL after video loads
               videoPlayer.on('loadeddata', function() {
                  URL.revokeObjectURL(videoURL);
               });
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

            $('#nik').keyup(function() {
               const nikValue = $(this).val();
               const minLength = 6;

               if (nikValue.length >= minLength) {
                  let found = false;

                  $('#kecamatan option').each(function() {
                     if ($(this).val() === nikValue.substring(0, 6)) {
                           $(this).prop('selected', true).trigger('change');
                           found = true;
                           return false; // Break the loop
                     }
                  });

                  if (!found) {
                     $('#nik').css('border', '2px solid red');
                     $('#nik-error').show();
                     $('#kecamatan').css('pointer-events', '');
                     $('#kecamatan').val('').trigger('change');
                  } else {
                     $('#nik').css('border', '');
                     $('#nik-error').hide();
                     $('#kecamatan').css('pointer-events', 'none');
                  }
               } else if (nikValue.length < minLength) {
                  $('#kecamatan').val('').trigger('change');
                  $('#desa').val('');
                  $('#nik').css('border', ''); // Clear the border style
                  $('#nik-error').hide(); // Hide the error message
               }
         });
      </script>
   </body>
</html>