<?php

include "../../../dbconfig.php";
session_start();
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title = $_POST['job'];
    $location = $_POST['location'];
    $exp = $_POST['exp'];
    $des = $_POST['des'];
    $id = $_SESSION['user_id'];

    $sql = "INSERT INTO jobpostings (job_title, location, experience_required, description,hr_id) VALUES (?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $job_title, $location, $exp, $des,$id);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Job posted successfully');
                    window.location.href = '../../frontend/login_dashboard.php';
                  </script>";
        } else {
            echo "Error executing insert: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
