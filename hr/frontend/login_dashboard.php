<?php  
    session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="../../styles.css">
</head>
<body>
    <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="">Profile</a></li>
                <li><a href="../backend/logout_backend.php">Logout</a></li>
                <li><a href="../backend/posting/backend_get_postings.php">Job Posting</a></li>
<!--                 <li><a href="messages/message_frontend.php">Messages</a></li> -->
                <li><a href="../backend/offer-letter/offer-letter_backend.php">Offer Letter</a></li>
                <li><a href="../backend/interviews/scheduled_list.php">Interviews</a></li>
                <li><a href="../backend/applications/application_backend.php">Screening</a></li>
            </ul>
        </nav>
    </header>

    <main>
       <?php 
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        ?>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>

        
        <section class="profile-info">
            <h2>Your Profile</h2>
            <p>Name:  <?php echo htmlspecialchars($name); ?> </p>
            <p>Email: <?php echo htmlspecialchars($email); ?> </p>
            <p><a href="profile/profile_frontend.php">Edit Profile</a></p>
        </section>
        
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>