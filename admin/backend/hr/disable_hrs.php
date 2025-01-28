<?php

include "../../../dbconfig.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

        $disable_users = [];
        $usrstmt = $conn->prepare("SELECT * FROM users WHERE role = 'hr' AND is_enable = 0 ");
        if ($usrstmt === false) {
            throw new Exception('Prepare failed for hr: ' . htmlspecialchars($conn->error));
        }

        $usrstmt->execute();
        $usrresult = $usrstmt->get_result();

        // Fetch all jobpostings into an array
        while ($row =  $usrresult->fetch_assoc()) {
            $disable_users[] = $row;
        }

        // Store jobpostings array in session
        $_SESSION['disable_hrs'] = $disable_users;

        header("Location: ../../frontend/hr/disabled_hrs.php");
        exit();




?>
