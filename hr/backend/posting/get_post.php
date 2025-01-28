<?php

include "../../../dbconfig.php";
session_start();
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['post_id']; // Fixed the typo



        $jobpost = [];
        $jobstmt = $conn->prepare("SELECT * FROM jobpostings WHERE job_id = $id ");
        if ($jobstmt === false) {
            throw new Exception('Prepare failed for jobpostings: ' . htmlspecialchars($conn->error));
        }

        $jobstmt->execute();
        $jobresult = $jobstmt->get_result();

        // Fetch all jobpostings into an array
        while ($row = $jobresult->fetch_assoc()) {
            $jobpost[] = $row;
        }

        // Store jobpostings array in session
        $_SESSION['jobpost'] = $jobpost;

        header("Location: ../../frontend/posting/get_post_for_edit.php");
        exit();


?>
