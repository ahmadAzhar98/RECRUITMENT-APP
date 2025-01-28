<?php session_start();
$user_data = $_SESSION['user_data'][0];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Pioneers HR Solutions</title>
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
            <!--     <li><a href="messages/message_frontend.php">Messages</a></li> -->
                <li><a href="../../backend/offer-letter/offer-letter_backend.php">Offer Letter</a></li>
                <li><a href="../../backend/interviews/scheduled_list.php">Interviews</a></li>
                <li><a href="../../backend/applications/application_backend.php">Screening</a></li>
            </ul>
        </nav>
    </header>

    <main>
<section class="contact-us" id="contact">
    <h2>Applicants Profile</h2>
    <form action="../../backend/interviews/scheduled.php" method="POST" >
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>">

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user_data['phone']); ?>">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user_data['address']); ?>">

        <label for="bio">Bio:</label>
        <input type="text" id="bio" name="bio" value="<?php echo htmlspecialchars($user_data['bio']); ?>">

        <label for="schedule">Schedule Date:</label>
        <input type="date" id="schedule" name="schedule" required>

        <label for="schedule_time">Schedule Time:</label>
        <input type="time" id="schedule_time" name="schedule_time" required>

        <input type="hidden" name="application" value=" <?php echo $_SESSION['job_application'] ?> " >


        <button type="submit">Schedule</button>
    </form>
</section>
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>
