<?php
session_start();
include("db.php");

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

 // HANDLE FOR SUBMISSION (ORDERS)
  if ( ($_SERVER["REQUEST_METHOD"] == "POST")){




















  }

?>