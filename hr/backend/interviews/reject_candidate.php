
<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
    $id = $_GET['app_id'];
    $query_users = "UPDATE applications SET status = 'rejected' WHERE application_id = $id";
    $stmt_users = $conn->prepare($query_users);
  

        if ($stmt_users->execute()) {
        echo "<script>alert('Candidate Rejected'); window.location.href='../../frontend/login_dashboard.php';</script>";
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    $stmt_users->close();
    $conn->close();



?>