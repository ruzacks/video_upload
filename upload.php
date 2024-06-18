<?php
include ('connection.php');
session_start();

$conn = getConn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement for inserting data into the videos table
$stmt = $conn->prepare("INSERT INTO videos (nik, id_kecamatan, id_desa, upload_by, extension, video_name, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())");
$stmt->bind_param("siisss", $nik, $id_kecamatan, $id_desa, $upload_by, $fileExtension, $nik);

$nik = $_POST['nik'];
$id_kecamatan = $_POST['kecamatan'];
$id_desa = $_POST['desa'];
$upload_by = $_SESSION['username'];

// Check if nik exists
$checkNikStmt = $conn->prepare("SELECT COUNT(*) FROM videos WHERE nik = ?");
$checkNikStmt->bind_param("s", $nik);
$checkNikStmt->execute();
$checkNikStmt->bind_result($count);
$checkNikStmt->fetch();
$checkNikStmt->close();

$response = array(); // Initialize response array

if ($count > 0) {
    $response['status'] = "error";
    $response['message'] = "NIK sudah terdaftar";
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit; // Make sure to stop further execution
}

// Check if video file is uploaded
if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['video']['tmp_name'];
    $fileName = $_FILES['video']['name'];
    $fileSize = $_FILES['video']['size'];
    $fileType = $_FILES['video']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Sanitize file name
    $newFileName = $nik . '.' . $fileExtension;

    // Check if the file is a video
    $allowedfileExtensions = array('mp4', 'avi', 'mov', 'mkv', 'webm');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        // Directory to save the uploaded video file
        // Ensure the directory path ends with a slash or backslash
        $uploadFileDir = $myPath;
        
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // File is successfully uploaded
            $videoFilePath = 'videos/' . $newFileName;

            try {
                if ($stmt->execute()) {
                    $response['status'] = "success";
                    $response['message'] = "Data saved successfully";
                    $response['video_path'] = $videoFilePath;
                }
            } catch (mysqli_sql_exception $e) {
                $error_message = $e->getMessage();
                if (strpos($error_message, "Duplicate entry") !== false) {
                    $response['status'] = "error";
                    $response['message'] = "NIK sudah terdaftar";
                } else {
                    unlink($dest_path); // Remove the uploaded video file if there's an error
                    $response['status'] = "error";
                    $response['message'] = "Error: " . $error_message;
                }
            }
        } else {
            $response['status'] = "error";
            $response['message'] = "There was an error moving the uploaded file.";
        }
    } else {
        $response['status'] = "error";
        $response['message'] = "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions);
    }
} else {
    $response['status'] = "error";
    $response['message'] = "No video file uploaded or there was an upload error.";
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
