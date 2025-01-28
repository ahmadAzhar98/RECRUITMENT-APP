<?php
include "../../dbconfig.php";
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

$job_title_filter = isset($_GET['job_title']) ? $_GET['job_title'] : '';
$location_filter = isset($_GET['location']) ? $_GET['location'] : '';
$experience_filter = isset($_GET['experience']) ? $_GET['experience'] : '';

// Initialize the query
$query = "SELECT * FROM jobpostings WHERE 1=1"; // Always true to simplify query construction
$params = [];
$types = "";

// Append conditions to the query
if ($job_title_filter) {
    $query .= " AND job_title LIKE ?";
    $params[] = '%' . $job_title_filter . '%';
    $types .= "s";
}

if ($location_filter) {
    $query .= " AND location LIKE ?";
    $params[] = '%' . $location_filter . '%';
    $types .= "s";
}

if ($experience_filter) {
    $query .= " AND experience_required LIKE ?";
    $params[] = '%' . $experience_filter . '%';
    $types .= "s";
}

// Prepare and execute the statement
$stmt = mysqli_prepare($conn, $query);
if ($stmt) {
    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $filtered_jobpostings = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $filtered_jobpostings[] = $row;
        }
    }

    // Store filtered job postings in session
    $_SESSION['filtered_jobpostings'] = $filtered_jobpostings;

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

// Redirect back to frontend
header("Location: ../frontend/user_dashboard.php");
exit();
?>
