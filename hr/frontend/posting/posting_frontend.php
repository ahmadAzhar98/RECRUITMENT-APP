<?php  
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="../../../styles.css">
    <style>
        .job-filter {
            margin-bottom: 20px;
        }
        .job-filter form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }
        .job-filter div {
            display: flex;
            flex-direction: column;
        }
        .job-filter label {
            margin-bottom: 5px;
        }
        .job-filter input {
            padding: 5px;
            font-size: 1em;
        } 
        .job-filter button {
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            align-self: flex-end;
        }
        .job-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .job-item {
            border: 1px solid #ccc;
            padding: 20px;
            width: 30%;
        }
    </style>
        <script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('nav ul li a');

        links.forEach(link => {
            link.addEventListener('click', function () {
                // Skip clearing filter for the current tab
                if (this.href === window.location.href) return;

                // Make an AJAX request to clear the filter
                fetch('../../backend/clear.php')
                    .then(response => response.text())
                    .then(data => {
                        console.log('Session filter cleared');
                    })
                    .catch(error => console.error('Error clearing session filter:', error));
            });
        });
    });
    </script>
</head>
<body>
     <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="../login_dashboard.php">Profile</a></li>
                <li><a href="../../backend/logout_backend.php">Logout</a></li>
                <li><a href="../../backend/posting/backend_get_postings.php">Job Posting</a></li>
<!--                 <li><a href="messages/message_frontend.php">Messages</a></li> -->
                <li><a href="../../backend/offer-letter/offer-letter_backend.php">Offer Letter</a></li>
                <li><a href="../../backend/interviews/scheduled_list.php">Interviews</a></li>
                <li><a href="../../backend/applications/application_backend.php">Screening</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php 
        $username = $_SESSION['name'];
        ?>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>

            <!-- Filter Form Section -->
        <section class="job-filter" id="filter">
            <h2>Filter for Job Postings</h2>
            <form method="GET" action="../../backend/filters/posting.php">
                <div>
                    <label for="job_title">Job Title:</label>
                    <input type="text" id="job_title" name="job_title" value="">
                </div>
                <div>
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="">
                </div>
                <div>
                    <label for="experience">Experience Required:</label>
                    <input type="text" id="experience" name="experience" value="">
                </div>
                <button type="submit">Filter</button>
            </form>
        </section>
        
    <section class="job-postings">
    <h2>Job Postings</h2>
    <ul>
        <?php
            $filtered_jobpostings = isset($_SESSION['filtered_jobpostings']) ? $_SESSION['filtered_jobpostings'] : $_SESSION['jobpostings'];
     
            foreach ($filtered_jobpostings as $job) {
                echo '<li>';
                echo 'Title: ' . htmlspecialchars($job['job_title']) . '<br>';
                echo 'Location: ' . htmlspecialchars($job['location']) . '<br>';
                echo 'Experience Required: ' . htmlspecialchars($job['experience_required']) . '<br>';
                echo '<a href="../../backend/posting/get_post.php?post_id='.htmlspecialchars($job['job_id']).'">Edit</a> | <a href="../../backend/posting/backend_delete_post.php?post_id=' . htmlspecialchars($job['job_id']) . '">Delete</a>';
                echo '</li>';
            }
        ?>
    </ul>
    <a href="post_job_frontend.php">Add New Job Posting</a>
</section>
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>
