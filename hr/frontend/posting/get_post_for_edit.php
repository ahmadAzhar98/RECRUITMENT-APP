<?php
   session_start();
   $job = $_SESSION['jobpost'][0];
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
           <!--      <li><a href="messages/message_frontend.php">Messages</a></li> -->
                <li><a href="../../backend/offer-letter/offer-letter_backend.php">Offer Letter</a></li>
                <li><a href="../../backend/interviews/scheduled_list.php">Interviews</a></li>
                <li><a href="../../backend/applications/application_backend.php">Screening</a></li>
            </ul>
        </nav>
    </header>

       <main>
        <section class="contact-us" id="contact">
            <h2> Job </h2>
            <form action="../../backend/posting/update_backend.php" method="POST">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value=" <?php echo htmlspecialchars($job['job_title']); ?> " >

                <label for="location">Location:</label>
                <input type="text" id="location" name="Location" value=" <?php echo htmlspecialchars($job['location']); ?> " >


                <label for="exp">Experience:</label>
                <input type="text" id="exp" name="exp" value=" <?php echo htmlspecialchars($job['experience_required']); ?> " >

                <label for="des">Description:</label>
                <input type="text" id="des" name="des" value=" <?php echo htmlspecialchars($job['description']); ?> " >

                <input type="hidden" name="id" value=" <?php echo htmlspecialchars($job['job_id']); ?> " >


                <button type="submit">Update</button>
            </form>
        </section>
    </main>


    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>
