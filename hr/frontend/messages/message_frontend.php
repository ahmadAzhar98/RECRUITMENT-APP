<?php  
    session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="../../../styles.css">
</head>
<body>
     <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="../login_dashboard.php">Profile</a></li>
                <li><a href="../../backend/logout_backend.php">Logout</a></li>
                <li><a href="../../backend/posting/backend_get_postings.php">Job Posting</a></li>
                <li><a href="messages/message_frontend.php">Messages</a></li>
                <li><a href="../../backend/offer-letter/offer-letter_backend.php">Offer Letter</a></li>
                <li><a href="../../backend/interviews/scheduled_list.php">Interviews</a></li>
                <li><a href="../../backend/applications/application_backend.php">Applications</a></li>
            </ul>
        </nav>
    </header>

    <div class="chat-container">
        <div class="chat-header">
            <h2> Chat </h2> 
        </div>
        <div class="chat-messages" id="chatBox"></div>
        <div class="chat-input" >
             <input type="text" id="messageInput" placeholder="Type your message here...">
             <button id="sendMessageButton">Send</button>       
        </div> 
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        function loadMessages() {
            $.get('../../backend/messages/getMessages.php', {
                sender_id: <?php echo json_encode($_SESSION['sender_id']); ?>,
                receiver_id: <?php echo json_encode($_SESSION['receiver_id']); ?>
            }, function(data) {
                var messages = JSON.parse(data);
                $('#chatBox').html('');
                messages.forEach(function(message) {
                    var senderName = message.sender_id == <?php echo json_encode($_SESSION['sender_id']); ?> ? 'You' : message.sender_name;
                    $('#chatBox').append('<p><strong>' + senderName + ':</strong> ' + message.content + '</p>');
                });
            });
        }

        // Send message
        $('#sendMessageButton').click(function() {
            var message = $('#messageInput').val();
            var send_id = <?php echo json_encode($_SESSION['sender_id']); ?>;
            var receive_id = <?php echo json_encode($_SESSION['receiver_id']); ?>;

            $.post('../../backend/messages/sendMessage.php', {
                sender_id: send_id,
                receiver_id: receive_id,
                content: message
            }, function(response) {
                console.log(response);
                $('#messageInput').val('');
                loadMessages();
            });
        });

        // Initial load
        loadMessages();

        // Poll for new messages every 5 seconds
        setInterval(loadMessages, 5000);
    });
</script>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>