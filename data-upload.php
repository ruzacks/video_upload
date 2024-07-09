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
       /* Modal styles */
       .modal {
            display: none;  /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            overflow: hidden;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 90%;
            max-height: 90%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }
        /* Video container styles */
        #videoElement {
            width: 100%;
            height: auto;
            max-height: 60vh; /* Adjust as needed */
            margin-bottom: 10px;
        }
        /* Button styles */
        #controls {
            margin-top: auto;
            text-align: center;
        }
        #startButton, #stopButton, #switchCameraButton, .cameraButton {
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        #timer {
            font-size: 18px;
            margin-bottom: 10px;
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
                        <a type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0" onclick="document.getElementById('videoInput').click();">Add Video From Files</a>
                        <a type="button" class="btn iq-bg-success btn-rounded btn-sm my-0" onclick="openCameraSelectionModal()">Camera</a>
                        <input type="file" accept="video/*" id="videoInput" hidden >
                        </span>
                     </div>
                     <div class="iq-card-body">
                        <div class="row mt-4">
                           <div class="col-lg-12 col-md-6 text-center canvas-container">
                              <p class="iq-bg-secondary pt-5 pb-5 text-center rounded font-size-18" id="frame-template" style="cursor:pointer">Please add Video</p>
                              <video id="videoPlayer" style="display: none; width: 100%; height: auto;" controls></video>
                              <small id="videoError" class="text-danger" style="display:none;">Please select a valid video.</small>
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

      <!-- Camera Selection Modal -->
      <div id="cameraSelectionModal" class="modal">
            <div class="modal-content">
                  <span class="close" onclick="closeModal('cameraSelectionModal')">&times;</span>
                  <h3>Select Camera</h3>
                  <div class="row">
                     <div class="col-md-6 d-flex justify-content-center">
                        <button class="cameraButton btn btn-primary" onclick="openRecordingModal('user')">Front Camera</button>
                     </div>
                     <div class="col-md-6 d-flex justify-content-center">
                        <button class="cameraButton btn btn-primary" onclick="openRecordingModal('environment')">Rear Camera</button>
                     </div>
                  </div>
            </div>
         </div>

         <!-- Video Recording Modal -->
         <div id="videoModal" class="modal">
            <div class="modal-content">
                  <span class="close" id="closeModal" onclick="closeModal('videoModal')">&times;</span>
                  <video id="videoElement" autoplay></video>
                  <div id="timer">00:00</div> <!-- Timer display -->
                  <div id="controls" class="row">
                     <div class="col-sm-6 d-flex justify-content-center">
                        <button class="btn btn-primary" id="startButton" onclick="startRecording()">Start</button>
                     </div>
                     <div class="col-sm-6 d-flex justify-content-center">
                        <button class="btn btn-danger" id="stopButton" onclick="stopRecording()" disabled>Stop</button>
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

      <!-- Jcrop -->
      <script src="https://cdn.jsdelivr.net/gh/tapmodo/Jcrop@0.9.12/js/jquery.Jcrop.min.js"></script>
      <!-- SweetAlert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script src="https://unpkg.com/@ffmpeg/ffmpeg@0.6.1/dist/ffmpeg.min.js"></script>
      
      <script>

         let mediaRecorder;
         let recordedChunks = [];
         let stream;
         let constraints = {
            video: {
               facingMode: 'user',
               width: { ideal: 1280 },
               height: { ideal: 720 }
            },
            audio: true
         };

         let timerInterval;
         let seconds = 0;

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
                html: '<div id="progress-container"><progress id="progress-bar" value="0" max="100"></progress></div><div id="upload-status">0%</div>',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    $.ajax({
                        url: 'upload.php', // Endpoint to send the form data
                        type: 'POST',
                        data: formData,
                        contentType: false, // Required for FormData
                        processData: false, // Required for FormData
                        // xhr: function() {
                        //     const xhr = new window.XMLHttpRequest();
                        //     xhr.upload.addEventListener('progress', function(evt) {
                        //         if (evt.lengthComputable) {
                        //             const percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        //             document.getElementById('progress-bar').value = percentComplete;
                        //             document.getElementById('upload-status').textContent = `${percentComplete}%`;
                        //         }
                        //     }, false);
                        //     return xhr;
                        // },
                        success: function(response) {
                            Swal.close();
                            Swal.fire({
                                icon: response.status,
                                title: response.message,
                                timer: 1500
                            });
                            if(response.status === "success"){
                                resetForm();
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.close();
                            Swal.fire({
                                icon: "error",
                                title: xhr.responseJSON.message || 'Upload failed',
                                // timer: 1000
                            });
                        }
                    });
                }
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
                  $('#kecamatan').val('').trigger('change');
               } else {
                  $('#nik').css('border', '');
                  $('#nik-error').hide();
               }
            } else if (nikValue.length < minLength) {
               $('#kecamatan').val('').trigger('change');
               $('#desa').val('');
               $('#nik').css('border', ''); // Clear the border style
               $('#nik-error').hide(); // Hide the error message
            }
         });

         document.getElementById('videoInput').addEventListener('change', handleVideoFile);

         function startTimer() {
            const timerElement = document.getElementById('timer');
            timerInterval = setInterval(() => {
               seconds++;
               const minutes = Math.floor(seconds / 60);
               const remainingSeconds = seconds % 60;
               timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
            }, 1000);
         }

         function stopTimer() {
            clearInterval(timerInterval);
            seconds = 0;
            document.getElementById('timer').textContent = '00:00';
         }

         async function startRecording() {
            try {
               stream = await navigator.mediaDevices.getUserMedia(constraints);
               const videoElement = document.getElementById('videoElement');
               videoElement.srcObject = stream;
               videoElement.play();

               const options = { mimeType: 'video/webm; codecs=vp8' };
               mediaRecorder = new MediaRecorder(stream, options);
               mediaRecorder.ondataavailable = function(event) {
                     if (event.data.size > 0) {
                        recordedChunks.push(event.data);
                     }
               };

               mediaRecorder.onstop = function() {
                     const blob = new Blob(recordedChunks, { type: 'video/webm' });
                     const url = URL.createObjectURL(blob);
                     const videoPlayer = document.getElementById('videoPlayer');
                     videoPlayer.style.display = 'block';
                     videoPlayer.src = url;
                     videoPlayer.controls = true;
                     const file = new File([blob], 'recorded-video.webm', { type: 'video/webm' });
                     const dataTransfer = new DataTransfer();
                     dataTransfer.items.add(file);
                     document.getElementById('videoInput').files = dataTransfer.files;
                     stopTimer();
               };

               mediaRecorder.start();
               startTimer();
               document.getElementById('startButton').disabled = true;
               document.getElementById('stopButton').disabled = false;

            } catch (err) {
               console.error('Error accessing media devices.', err);
            }
         }

         function stopRecording() {
            mediaRecorder.stop();
            stream.getTracks().forEach(track => track.stop());
            document.getElementById('startButton').disabled = false;
            document.getElementById('stopButton').disabled = true;
            document.getElementById('videoModal').style.display = 'none';
            document.getElementById('frame-template').style.display = 'none';
         }

         async function switchCamera() {
            constraints.video.facingMode = constraints.video.facingMode === 'user' ? 'environment' : 'user';
            await startRecording();
         }

         function openCameraSelectionModal() {
            document.getElementById('cameraSelectionModal').style.display = 'flex';
         }

         function openRecordingModal(facingMode) {
            constraints.video.facingMode = facingMode;
            document.getElementById('cameraSelectionModal').style.display = 'none';
            document.getElementById('videoModal').style.display = 'flex';
            
         }

         function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            if (modalId === 'videoModal') {
               stopRecording();
            }
         }

         function handleVideoFile(event) {
            const file = event.target.files[0];
            const videoPlayer = document.getElementById('videoPlayer');
            if (file && file.type.startsWith('video/')) {
               videoPlayer.style.display = 'block';
               videoPlayer.src = URL.createObjectURL(file);
               videoPlayer.controls = true;
               document.getElementById('videoError').style.display = 'none';
               document.getElementById('frame-template').style.display = 'none';
            } else {
               videoPlayer.style.display = 'none';
               document.getElementById('videoError').style.display = 'block';
            }
         }
      </script>
   </body>
</html>