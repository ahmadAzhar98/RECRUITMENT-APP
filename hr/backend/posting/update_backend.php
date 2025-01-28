<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate the inputs
    $title = sanitizeInput($_POST['title']);
    $location = sanitizeInput($_POST['Location']);
    $exp = sanitizeInput($_POST['exp']);
    $des = sanitizeInput($_POST['des']);
    $jobId = sanitizeInput($_POST['id']); 

    // Prepare the SQL query using placeholders
    $query_users = "UPDATE jobpostings SET job_title = ?, location = ?, experience_required = ?, description = ? WHERE job_id = ?";
    $stmt_users = $conn->prepare($query_users);

    if ($stmt_users) {
        // Bind the input variables to the prepared statement
        $stmt_users->bind_param("ssisi", $title, $location, $exp, $des, $jobId);

        // Execute the prepared statement
        if ($stmt_users->execute()) {
            echo "<script>alert('Profile updated successfully'); window.location.href='../../frontend/posting/posting_frontend.php';</script>";
        } else {
            echo "Error updating profile: " . $stmt_users->error;
        }

        $stmt_users->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
