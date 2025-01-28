<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('User ID is not set in the session.');
    }

    $jobpostings = [];

    // Check database connection
    if ($conn->connect_error) {
        throw new Exception('Database connection failed: ' . htmlspecialchars($conn->connect_error));
    }

    // Prepare the SQL statement with placeholders to prevent SQL injection
    $jobstmt = $conn->prepare("SELECT * FROM jobpostings WHERE hr_id = ? AND soft_delete = 0");
    if ($jobstmt === false) {
        throw new Exception('Prepare failed for jobpostings: ' . htmlspecialchars($conn->error));
    }

    // Bind the session variable to the prepared statement
    $jobstmt->bind_param("i", $_SESSION['user_id']);

    // Execute the statement
    if (!$jobstmt->execute()) {
        throw new Exception('Execute failed for jobpostings: ' . htmlspecialchars($jobstmt->error));
    }

    $jobresult = $jobstmt->get_result();

    // Fetch all jobpostings into an array
    while ($row = $jobresult->fetch_assoc()) {
        $jobpostings[] = $row;
    }

    // Store jobpostings array in session
    $_SESSION['jobpostings'] = $jobpostings;

    // print_r($jobpostings);
    // die();

    // Redirect to the specified page
    header("Location: ../../frontend/posting/posting_frontend.php");
    exit();
} catch (Exception $e) {
    // Handle the exception and display an error message
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn->close();
?>
