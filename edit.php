<?php
include('connection.php');
session_start();

$conn = getConn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idVideos = $_POST['idVideo']; // Assuming 'idVideos' is the name of the POST parameter for video ID

// Prepare SQL statement for updating data in the 'videos' table
$stmt = $conn->prepare("UPDATE videos SET nik=?, id_kecamatan=?, id_desa=?, upload_by=?, updated_at=NOW() WHERE id=?");
$stmt->bind_param("siisi", $nik, $id_kecamatan, $id_desa, $upload_by, $idVideos);

$nik = $_POST['nik'];
$id_kecamatan = $_POST['kecamatan'];
$id_desa = $_POST['desa'];
$upload_by = $_SESSION['username'];

$response = array(); // Initialize response array

try {
    if ($stmt->execute()) {
        $response['status'] = "success";
        $response['message'] = "Data updated successfully";
    } else {
        $response['status'] = "error";
        $response['message'] = "Failed to update data";
    }
} catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    if (strpos($error_message, "Duplicate entry") !== false) {
        $response['status'] = "error";
        $response['message'] = "NIK already exists";
    } else {
        $response['status'] = "error";
        $response['message'] = "Error: " . $error_message;
    }
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
