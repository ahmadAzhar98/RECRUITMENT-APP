<?php
session_start();

include "../../../dbconfig.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_id = $_POST['userlist'];

$hr_id = $_POST['hrlist'];


$stmt = $conn->prepare("INSERT INTO assign (user_id, hr_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $hr_id); // "ii" means two integers

if ($stmt->execute()) {
    echo "<script>
            alert('You have successfully assigned');
            window.location.href = '../../frontend/assign/frontend_assign.php'; 
          </script>";
} else {
    echo "<script>
            alert('Error: " . $stmt->error . "');
            window.location.href = '../../frontend/assign/frontend_assign.php'; 
          </script>";
}

// Close the statement and connection
$stmt->close();
$conn->close();


?>