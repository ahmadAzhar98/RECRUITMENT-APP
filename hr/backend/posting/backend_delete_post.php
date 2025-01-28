<?php

include "../../../dbconfig.php";
session_start();
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['post_id']; // Fixed the typo


$sql = "UPDATE jobpostings SET soft_delete = 1 WHERE job_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
                    alert('Job deleted successfully');
                    window.location.href = '../../frontend/login_dashboard.php';
             
              </script>";
    } else {
        echo "Error executing delete: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();

?>
