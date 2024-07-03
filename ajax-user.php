<?php

use PhpOffice\PhpSpreadsheet\Worksheet\Validations;

include('connection.php');

session_start();

if (isset($_GET['func']) || isset($_POST['func'])) {
    // Get the value of the 'func' parameter
    if (isset($_GET['func'])) {
        $functionName = $_GET['func'];
    } else if (isset($_POST['func'])) {
        $functionName = $_POST['func'];
    }

    // Call the corresponding function based on the 'func' parameter
    if ($functionName === 'getAllUser') {
        getAllUser();
    } else if ($functionName === 'addUser') {
        addUser();
    } else if ($functionName === 'editUser') {
        editUser();
    } else if ($functionName === 'deleteUser') {
        deleteUser();
    } else if ($functionName === 'changePassword') {
        changePassword();
    } else if ($functionName === 'changeUserStatus') {
        changeUserStatus();
    } else if ($functionName === 'loginUser') {
        loginUser();
    }
}

function getAllUser(){
    $conn = getConn();

    $editorIdKecamatan = $_SESSION['id_kecamatan'];
    

    $sql = "SELECT 
            username, 
            password, 
            role,
            nama,
            no_wa, 
            kecamatan.nama_kecamatan AS kecamatan, 
            desa.nama_desa AS desa
        FROM 
            users 
        LEFT JOIN kecamatan ON users.id_kecamatan = kecamatan.id_kecamatan
        LEFT JOIN desa ON users.id_desa = desa.id_desa";

        // Apply filters if they are set
        $filters = [];
        if (!empty($_GET['username'])) {
            $username = mysqli_real_escape_string($conn, $_GET['username']);
            $filters[] = "users.username LIKE '%$username%'";
        }
        if (!empty($_GET['role'])) {
            $role = mysqli_real_escape_string($conn, $_GET['role']);
            $filters[] = "users.role = '$role'";
        }
        if (!empty($_GET['kecamatan'])) {
            $kecamatan = mysqli_real_escape_string($conn, $_GET['kecamatan']);
            $filters[] = "users.id_kecamatan LIKE '%$kecamatan%'";
        }
        if (!empty($_GET['desa'])) {
            $desa = mysqli_real_escape_string($conn, $_GET['desa']);
            $filters[] = "users.id_desa LIKE '%$desa%'";
        }

        // Append filters to the SQL query
        if (!empty($filters)) {
            $sql .= " WHERE " . implode(" AND ", $filters);
        }


    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        $error = array("status" => "error", "message" => mysqli_error($conn));
        header('Content-Type: application/json');
        echo json_encode($error);
    }

    mysqli_close($conn);
}

function addUser(){
    // Assuming you're handling POST data securely, like through validation and sanitization
    $conn = getConn();

    if(empty($_POST['username']) || empty($_POST['nama']) || empty($_POST['no_wa']) || empty($_POST['password']) || empty($_POST['role'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=Please fill in all required fields.");
        exit();
    }

    // Fetch POST data
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $kecamatan = isset($_POST['kecamatan']) ? mysqli_real_escape_string($conn, $_POST['kecamatan']) : null;
    
    $desa = isset($_POST['desa']) ? mysqli_real_escape_string($conn, $_POST['desa']) : null;

    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_wa = mysqli_real_escape_string($conn, $_POST['no_wa']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    if($role == 'administrator'){
        $kecamatan = null;
        $desa = null;
    }

    if($role == 'korcam' || $role == 'koordinator'){
        $desa = null;
    }

    // Check if the username already exists
    $check_username_sql = "SELECT COUNT(*) as count FROM users WHERE username = '$username'";
    $check_username_result = mysqli_query($conn, $check_username_sql);
    $row = mysqli_fetch_assoc($check_username_result);
    if ($row['count'] > 0) {
        // Username already exists
        $error_message = urlencode("Username is already taken. Please choose a different one.");

        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error_message");
        exit(); // Stop further execution
    }

    // Prepare the SQL query with placeholders for prepared statements
    $sql = "INSERT INTO users (username, password, id_kecamatan, id_desa, role, nama, no_wa) VALUES (?, ?, ?, ?, ?, ?, ?)";


    $stmt = $conn->prepare($sql);

    // Check if statement preparation was successful
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    // Bind parameters
    // Use `s` for string and `i` for integer
    $stmt->bind_param("sssssss", $username, $pass, $kecamatanParam, $desaParam, $role, $nama, $no_wa);

    // Set the parameters, converting empty values to NULL
    $kecamatanParam = !empty($kecamatan) ? $kecamatan : null;
    $desaParam = !empty($desa) ? $desa : null;

    // Execute the statement
    if ($stmt->execute()) {
        // User added successfully
        header("Location: user-list.php?success=User created successfully.");
        exit();
    } else {
        // Error in adding user
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

function editUser(){
    // Assuming you're handling POST data securely, like through validation and sanitization
    $conn = getConn();

    if(empty($_POST['username']) || empty($_POST['role']) || empty($_POST['nama']) || empty($_POST['no_wa']) ) {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=Please fill in all required fields.");
        exit();
    }

    if(($_POST['role'] == 'koordinator' || $_POST['role'] == 'korcam')  && empty($_POST['kecamatan'])){
        header("Location: {$_SERVER['HTTP_REFERER']}?error=Please fill in all required fields.");
        exit(); 
    } else if($_POST['role'] == 'kordes' && empty($_POST['desa'])){
        header("Location: {$_SERVER['HTTP_REFERER']}?error=Please fill in all required fields.");
        exit();
    } 

    $setValue = '';
    // Fetch POST data
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    if(!empty($_POST['kecamatan'])){
        $kecamatan = mysqli_real_escape_string($conn, $_POST['kecamatan']);
        if($_POST['role'] == 'administrator'){
            $setValue .= "id_kecamatan = NULL, ";
        } else {
            $setValue .= "id_kecamatan = '$kecamatan', ";
        }   
    } 

    if(!empty($_POST['desa'])){
        $desa = mysqli_real_escape_string($conn, $_POST['desa']);
        if($_POST['role'] != 'kordes'){
            $setValue .= "id_desa = NULL, ";
        } else {
            $setValue .= "id_desa = '$desa', ";
        }
    }

    if(!empty($_POST['nama'])){
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
        $setValue .= "nama = '$nama', ";
    }

    if(!empty($_POST['no_wa'])){
        $no_wa = mysqli_real_escape_string($conn, $_POST['no_wa']);
        $setValue .= "no_wa = '$no_wa', ";
    }

    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Insert the user into the database
    $sql = "UPDATE users SET $setValue role = '$role' WHERE username = '$username'";
    
    if (mysqli_query($conn, $sql)) {
        // User added successfully
        header("Location: user-edit.php?username=$username&success=User data updated.");
        exit();
    } else {
        // Error in adding user
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

function changeUserStatus(){
    $conn = getConn();

    $username = mysqli_escape_string($conn, $_POST['username']);
    $status = mysqli_escape_string($conn, $_POST['status']);

    $sql = "UPDATE users set status='$status' WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    $response = [];
    if ($result) {
        $response['status'] = "success";
        $response['message'] = "Status Changed";
    } else {
        $response['status'] = "error";
        $response['message'] = "Failed to change status";
    }

    echo json_encode($response);

}

function changePassword(){
    // Assuming you're handling POST data securely, like through validation and sanitization
    $conn = getConn();
    $username = $_POST['username'];
    $role = $_SESSION['role'];

    if(empty($_POST['npass']) || empty($_POST['vpass'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=Please fill in all required fields.");
        exit();
    }

    // Fetch POST data
    $currentPassword= mysqli_real_escape_string($conn, $_POST['cpass']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['npass']);
    $verifyPassword = mysqli_real_escape_string($conn, $_POST['vpass']);

    //Validate VALUE
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (($user && $currentPassword == $user['password']) || $role == 'administrator') {
        if ($newPassword == $verifyPassword){
            $sql = "UPDATE users SET password = '$newPassword'  WHERE username = '$username'";

            if (mysqli_query($conn, $sql)) {
                // User added successfully
                header("Location: user-edit.php?username=$username&success=User password updated.");
                exit();
            } else {
                // Error in adding user
                header("Location: user-edit.php?username=$username&error=User password update failed.");
                exit();
            }
        } else {
            header("Location: user-edit.php?username=$username&error=User password not macth.");
            exit();
        }
    } else {
        header("Location: user-edit.php?username=$username&error=User password not macth.");
        exit();
    }


    // Insert the user into the database

    mysqli_close($conn);
}

function deleteUser(){
    $conn = getConn();
    $username = $_POST['username'];
    $role = $_SESSION['role'];

    $response = [];

    if($role != 'administrator'){
        $response['status'] = "error";
        $response['message'] = "You don't have previlege!";
    } else {
        $sqlDelete = "DELETE from users WHERE username = '$username'";
        $result = mysqli_query($conn, $sqlDelete);
        if($result){
            $response['status'] = "success";
            $response['message'] = "user $username is deleted";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);

}

function isAdmin(){
    if($_SESSION['role'] != 'administrator'){
        return false;
    }
}

function loginUser(){
    $loginStat = $_POST['login_user'];

    $loginStat == 1 ? $response['message'] = 'Semua User dapat Login' : $response['message'] = 'Hanya Administrator dan user KPU yang dapat Login';

    $conn = getConn();

    // Prepare and execute the update query
    $query = "UPDATE lookups SET login_user = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $loginStat);

    if (mysqli_stmt_execute($stmt)) {
        $response['status'] = 'success';
        
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Query failed: ' . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // header('Content-Type: application/json');
    echo json_encode($response);

}

?>