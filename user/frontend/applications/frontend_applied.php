<?php 
  session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="../../../styles.css">
    <link rel="stylesheet" href="custom_styles.css"> <!-- Custom CSS file -->
</head>
<body>
    <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="../user_dashboard.php">Home</a></li>
                <li><a href="../../backend/applications/backend_applied.php">Applied</a></li>
                <li><a href="../../backend/offer-letter/backend_offer_letter.php"> Offer Letter </a></li>
            <!--     <li><a href="../messages/message_frontend.php"> Messages </aN></li> -->
                <li><a href="../../backend/logout_backend.php">Logout</a></li>
                <li><a href="../profile/frontend_profile.php"> Profile </a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="interviews">
            <h2>Applied</h2>
            <button class="filter-btn" onclick="filterTable('accepted')">Show Accepted</button>
            <button class="filter-btn" onclick="filterTable('')">Show All</button>
            <table id="applications-table">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['joinedData']) && !empty($_SESSION['joinedData'])): ?>
                        <?php foreach ($_SESSION['joinedData'] as $data): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($data['job_title']); ?></td>
                                <td><?php echo htmlspecialchars($data['applied_at']); ?></td>
                                <td><?php echo htmlspecialchars($data['status']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No applications found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>

    <script>
        function filterTable(status) {
            var table, rows, i, statusCell, txtValue;
            table = document.getElementById("applications-table");
            rows = table.getElementsByTagName("tr");

            for (i = 1; i < rows.length; i++) {
                statusCell = rows[i].getElementsByTagName("td")[2];
                if (statusCell) {
                    txtValue = statusCell.textContent || statusCell.innerText;
                    if (status === "" || txtValue === status) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>
