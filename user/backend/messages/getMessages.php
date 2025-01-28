<?php

include "../../../dbconfig.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$sender_id = $_GET['sender_id'];
$receiver_id = $_GET['receiver_id'];

// Fetch messages
// Fetch messages with user names using JOIN
$sql = "SELECT messages.*, 
               sender.username AS sender_name, 
               receiver.username AS receiver_name 
        FROM messages
        JOIN users AS sender ON messages.sender_id = sender.user_id
        JOIN users AS receiver ON messages.receiver_id = receiver.user_id
        WHERE (messages.sender_id = ? AND messages.receiver_id = ?) 
           OR (messages.sender_id = ? AND messages.receiver_id = ?)
        ORDER BY messages.sent_at";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($messages);

?>