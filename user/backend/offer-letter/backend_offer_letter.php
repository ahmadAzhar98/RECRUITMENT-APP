<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql_join = "
    SELECT 
        jobpostings.job_title,  
        applications.applied_at,
        applications.application_id,
        applications.offer_letter
    FROM 
        applications
    JOIN 
        jobpostings ON applications.job_id = jobpostings.job_id
    WHERE 
        applications.user_id = ? AND applications.offer_letter_status = 2
";

$user_id = $_SESSION['user_id'];

$stmt_join = $conn->prepare($sql_join);

if ($stmt_join) {
    $stmt_join->bind_param("i", $user_id);
    $stmt_join->execute();
    $result = $stmt_join->get_result();

    $joinedData = [];  // Initialize the array

    // Fetch all rows into an array
    while ($row = $result->fetch_assoc()) {
        $joinedData[] = $row;
    }

    $stmt_join->close();
} else {
    echo "Error preparing join statement: " . $conn->error;
}

$conn->close();

// Store joined data in session
$_SESSION['joinedData'] = $joinedData;

// Redirect to home page (adjust the path as necessary)
header("Location: ../../frontend/offer-letter/frontend_offer_letter.php");
exit();

?>
