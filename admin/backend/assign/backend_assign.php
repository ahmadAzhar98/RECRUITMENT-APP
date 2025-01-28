<?php
session_start();

include "../../../dbconfig.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

    $hrstmt = $conn->prepare("SELECT * FROM users WHERE role = ?");
    $role = 'hr';
    $hrstmt->bind_param("s", $role); 
    $hrstmt->execute();
    $result = $hrstmt->get_result();

    $users = [];
    while ($row = $result->fetch_assoc()) {
    $users[] = $row; 
    }



    $_SESSION['hrlist'] = $users;


    $hrstmt->close();


    $userstmt = $conn->prepare("SELECT * FROM users WHERE role = ?");
    $role = 'user';
    $userstmt->bind_param("s", $role); 
    $userstmt->execute();
    $userresult = $userstmt->get_result();

    $userlist = [];
    while ($row = $userresult->fetch_assoc()) {
    $userlist[] = $row; 
    }
    $userstmt->close();
    $_SESSION['userlist'] = $userlist;
    $conn->close();

    
    header("Location: ../../frontend/assign/frontend_assign.php");
    exit();


?>