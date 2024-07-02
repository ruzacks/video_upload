<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
} 
else if (strpos($_SESSION['username'], 'kpu') !== false && strpos($_SERVER['PHP_SELF'], 'index.php') == false) {
    header("Location: index.php");
    exit();
}

// if (strpos($_SERVER['PHP_SELF'], 'user-add') !== false || strpos($_SERVER['PHP_SELF'], 'user-list') !== false) {
//     // Check if the role is not 'administrator'
//     if ($_SESSION['role'] !== 'administrator') {
//         header("Location: not-found.php");
//         exit();
//     }
// }

?>