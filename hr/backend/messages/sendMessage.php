<?php

include "../../../dbconfig.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$content = $_POST['content'];

// Insert message
$sql = "INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $sender_id, $receiver_id, $content);

if ($stmt->execute()) {
    echo "Message sent!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();



?>