<?php  
    session_start();
   $applications_per_month = $_SESSION['applications_per_month'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard - Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="../../styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="../backend/hr/get_hr_backend.php"> HR </a></li>
   <!--              <li><a href="../backend/assign/backend_assign.php">Assign</a></li> -->
                <li><a href="../backend/user/get_user_backend.php">User</a></li>
                <li><a href="../backend/user/disable_users.php">Disabled User </a></li>
                <li><a href="../backend/hr/disable_hrs.php">Disabled HR </a></li>
                <li><a href="../backend/logout_backend.php">Logout</a></li>

            </ul>
        </nav>
    </header>

    <main>
       <?php 
     
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        ?>
        <h1>Welcome, <?php echo htmlspecialchars($name); ?> </h1>

        
        <section class="profile-info">
            <h2>Your Profile</h2>
            <p>Name:  <?php echo htmlspecialchars($name); ?> </p>
            <p>Email: <?php echo htmlspecialchars($email); ?> </p>
            <p><a href="admin_profile.php">Edit Profile</a></p>
        </section>

        <section class="profile-info">
            <div class="overview">
            <div class="card">
                <h2>Total Open Positions</h2>
                <p> <?php echo $_SESSION['total_open_positions']  ?>  </p>
            </div>
            <div class="card">
                <h2>Total Hires</h2>
                <p> <?php echo $_SESSION['total_hires']  ?>  </p>
            </div>

            <div class="card">
                <h2>Total Rejects </h2>
                <p> <?php echo $_SESSION['total_reject']  ?> </p>
            </div>

            <div class="card">
                <h2>Total Under Review </h2>
                <p> <?php echo $_SESSION['total_review']  ?> </p>
            </div>


        </div>
            
        </section>

        <section class="chart-section">
            <h2>Applications Over Time</h2>
            <canvas id="applicationsChart"></canvas>
        </section>
        
    </main>


    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('applicationsChart').getContext('2d');
            const data = {
                labels: <?php echo json_encode(array_column($applications_per_month, 'month')); ?>,
                datasets: [{
                    label: 'Applications',
                    data: <?php echo json_encode(array_column($applications_per_month, 'applications_count')); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                }]
            };
            const config = {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Applications'
                            },
                            beginAtZero: true
                        }
                    }
                }
            };
            const applicationsChart = new Chart(ctx, config);
        });
    </script>

</body>
</html>