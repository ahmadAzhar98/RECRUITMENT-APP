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
              <!--   <li><a href="messages/message_frontend.php">Messages</a></li> -->
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


        <section class="job-filter" id="filter">
            <h2>Filter for Applications </h2>
            <form method="GET" action="../../backend/filters/application.php">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="">
                </div>
                <div>
                    <label for="job_title">Job Title:</label>
                    <input type="text" id="job_title" name="job_title" value="">
                </div>

                <button type="submit">Filter</button>
            </form>
        </section>    

    <section class="applications">
    <h2>Applications</h2>
    <ul>
        <?php
         $filtered_joinData = isset($_SESSION['filterjoinedData']) ? $_SESSION['filterjoinedData'] : $_SESSION['joinedData'];
                foreach ($filtered_joinData as $job) {
                echo '<li>';
                echo 'Name: ' . htmlspecialchars($job['user_name']) . '<br>';
                echo 'Job title: ' . htmlspecialchars($job['job_title']) . '<br>';
                echo ' <a href="../../backend/interviews/schedule_interview_backend.php?app_id=' . htmlspecialchars($job['user_id']) . '&job_id='. htmlspecialchars($job['application_id']).'"> View </a> | <a href="../../backend/interviews/reject_candidate.php?app_id='.htmlspecialchars($job['application_id']).'">Reject</a> | ';
                echo '<a href = "../../../user/backend/applications/'.htmlspecialchars($job['cv']).'" > CV </a>';

                // echo '<a href="../../backend/interviews/schedule_interview_backend.php?app_id='. htmlspecialchars($job['user_id']).;&job_id= echo htmlspecialchars($job['application_id']) ">View</a> 

                // | <a href="../../backend/posting/backend_delete_post.php?post_id=' . htmlspecialchars($job['job_id']) . '">Delete</a>';
                echo '</li>';
            }
        ?>
    </ul>
</section>

    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>