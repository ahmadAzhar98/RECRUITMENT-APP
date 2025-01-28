<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="../../styles.css">
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
                fetch('../backend/clear.php')
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
                <li><a href="">Home</a></li>
                <li><a href="../backend/applications/backend_applied.php">Applied</a></li>
                <li><a href="../backend/offer-letter/backend_offer_letter.php"> Offer Letter </a></li>
                <li><a href="../backend/logout_backend.php">Logout</a></li>
                <li><a href="profile/frontend_profile.php"> Profile </a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Welcome to Performance Pioneers HR Solutions</h1>
            <p>Your career starts here. Find your dream job today.</p>
            <?php 
                $name = htmlspecialchars($_SESSION['name']);
                $email = htmlspecialchars($_SESSION['email']);
            ?>
            <h3>Welcome, <?php echo $name; ?></h3>
        </section>

        <!-- Filter Form Section -->
        <section class="job-filter" id="filter">
            <h2>Filter Job Opportunities</h2>
            <form method="GET" action="../backend/filter_backend.php">
                <div>
                    <label for="job_title">Job Title:</label>
                    <input type="text" id="job_title" name="job_title" value="<?php echo isset($_GET['job_title']) ? htmlspecialchars($_GET['job_title']) : ''; ?>">
                </div>
                <div>
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="<?php echo isset($_GET['location']) ? htmlspecialchars($_GET['location']) : ''; ?>">
                </div>
                <div>
                    <label for="experience">Experience Required:</label>
                    <input type="text" id="experience" name="experience" value="<?php echo isset($_GET['experience']) ? htmlspecialchars($_GET['experience']) : ''; ?>">
                </div>
                <button type="submit">Filter</button>
            </form>
        </section>

        <!-- Job Opportunities Section -->
        <section class="job-opportunities" id="jobs">
            <h2>Job Opportunities</h2>
            <div class="job-list">
            <?php 
                // Display filtered job postings
                $filtered_jobpostings = isset($_SESSION['filtered_jobpostings']) ? $_SESSION['filtered_jobpostings'] : $_SESSION['jobpostings'];
                foreach ($filtered_jobpostings as $jobposting):
            ?>
                <div class="job-item">
                    <h3><?php echo htmlspecialchars($jobposting['job_title']); ?></h3>
                    <p>Location: <?php echo htmlspecialchars($jobposting['location']); ?></p>
                    <p>Experience: <?php echo htmlspecialchars($jobposting['experience_required']); ?></p>
                    <a href="applications/frontend_application.php?job_id=<?php echo $jobposting['job_id']; ?>&user_id=<?php echo $_SESSION['user_id']; ?>">Apply Now</a>
                </div>
            <?php endforeach; ?>
            </div>
        </section>

        <section class="about-us" id="about">
            <h2>About Us</h2>
            <p>At Performance Pioneers HR Solutions, we connect top talent with leading companies. Our mission is to help you find the perfect job and build a successful career. With years of experience in the industry, we are dedicated to providing exceptional service to both job seekers and employers.</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>
