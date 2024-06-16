<?php
   include("connection.php");

   $conn = getConn();
   $username = mysqli_escape_string($conn, $_GET['username']);

   $sql = "SELECT username, phone, address, role FROM users WHERE username='$username'";
   $result = mysqli_query($conn, $sql);

   $user = mysqli_fetch_object($result);

   if(!$user){
      header("Location: not-found.php");
      exit();
   }

   echo $user->phone;

?>