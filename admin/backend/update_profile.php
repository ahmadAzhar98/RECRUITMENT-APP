<?php
  
include "../../dbconfig.php";

session_start();

function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate the inputs
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $bio = sanitizeInput($_POST['bio']);
    $phone = sanitizeInput($_POST['phone']);
    $address = sanitizeInput($_POST['address']);

    // Update session variables
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['bio'] = $bio;
    $_SESSION['phone'] = $phone;
    $_SESSION['address'] = $address;

    $userId = $_SESSION['user_id']; 


    $query_users = "UPDATE users SET name = ?, email = ? WHERE user_id = ?";
    $stmt_users = $conn->prepare($query_users);
    $stmt_users->bind_param('ssi', $name, $email, $userId);


    $query_profile = "UPDATE profiles SET bio = ?, phone = ?, address = ? WHERE user_id = ?";
    $stmt_profile = $conn->prepare($query_profile);
    $stmt_profile->bind_param('sssi', $bio, $phone, $address, $userId);


    if ($stmt_users->execute() && $stmt_profile->execute()) {
        echo "<script>alert('Profile updated successfully'); window.location.href='../frontend/admin_profile.php';</script>";
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    $stmt_users->close();
    $stmt_profile->close();
    $conn->close();
} else {
    echo "Invalid request";
}



  ?>