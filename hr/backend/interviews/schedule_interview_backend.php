<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Check if 'app_id' is set
    if (!isset($_GET['app_id'])) {
        throw new Exception('Application ID is not set.');
    }

    $app_id = $_GET['app_id'];

    // Prepare the SQL statement
    $user_data = [];
    $stmt = $conn->prepare("SELECT users.name, users.email, profiles.bio, profiles.phone, profiles.address 
                            FROM users 
                            JOIN profiles ON users.user_id = profiles.user_id 
                            WHERE users.user_id = ?");
    if ($stmt === false) {
        throw new Exception('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind the user_id parameter
    $stmt->bind_param("i", $app_id);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all user data into an array
    while ($row = $result->fetch_assoc()) {
        $user_data[] = $row;
    }

    // Store user data array in session
    $_SESSION['user_data'] = $user_data;
    $_SESSION['job_application'] = $_GET['job_id'];

    // Close the statement
    $stmt->close();

    // Optionally redirect or perform further processing
    // header("Location: your_redirect_page.php");
    // exit();

} catch (Exception $e) {
    // Handle the exception and display an error message
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn->close();
header("Location: ../../frontend/interviews/schedule_interview_frontend.php");
exit();
?>



     


