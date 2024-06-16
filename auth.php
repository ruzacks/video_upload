<?php

include("connection.php");

if (isset($_GET['func']) || isset($_POST['func'])) {
    // Get the value of the 'func' parameter
    if (isset($_GET['func'])) {
        $functionName = $_GET['func'];
    } else if (isset($_POST['func'])) {
        $functionName = $_POST['func'];
    }

    if ($functionName === 'login') {
        login();
    } 
}

function login(){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = getConn();
    if ($conn === false) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database connection failed'
        ]);
        return;
    }

    // Query to fetch the user with the given username
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && ($password == $user['password'])) {
        // Password is correct, create session or perform necessary actions

        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['id_kecamatan'] = $user['id_kecamatan'];
        $_SESSION['id_desa'] = $user['id_desa'];
        echo json_encode([
            'status' => 'success',
            'message' => 'Login successful'
        ]);
       
    } else {
        // Invalid credentials
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid username or password'
        ]);
    }

    $stmt->close();
    $conn->close();
}

?>