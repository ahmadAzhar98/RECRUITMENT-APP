<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Pioneers HR Solutions</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">Performance Pioneers HR Solutions</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="hr/frontend/login_frontend.php">Login</a></li>
                <li><a href="register_frontend.php">Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Welcome to Performance Pioneers HR Solutions</h1>
            <p>Your career starts here. Find your dream job today.</p>
            <a href="hr/frontend/login_frontend.php" class="btn">Get Started</a>
        </section>

        <section class="job-opportunities" id="jobs">
            <h2>Job Opportunities</h2>
            <div class="job-list">
                <div class="job-item">
                    <h3>Software Developer</h3>
                    <p>Location: New York</p>
                    <p>Experience: 3+ years</p>
                    <a href="#">Apply Now</a>
                </div>
                <div class="job-item">
                    <h3>Project Manager</h3>
                    <p>Location: San Francisco</p>
                    <p>Experience: 5+ years</p>
                    <a href="#">Apply Now</a>
                </div>
                <div class="job-item">
                    <h3>Data Analyst</h3>
                    <p>Location: Remote</p>
                    <p>Experience: 2+ years</p>
                    <a href="#">Apply Now</a>
                </div>
                <div class="job-item">
                    <h3>HR Specialist</h3>
                    <p>Location: Chicago</p>
                    <p>Experience: 4+ years</p>
                    <a href="#">Apply Now</a>
                </div>
            </div>
        </section>

        <section class="about-us" id="about">
            <h2>About Us</h2>
            <p>At Performance Pioneers HR Solutions, we connect top talent with leading companies. Our mission is to help you find the perfect job and build a successful career. With years of experience in the industry, we are dedicated to providing exceptional service to both job seekers and employers.</p>
        </section>

        <section class="contact-us" id="contact">
            <h2>Contact Us</h2>
            <form>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Performance Pioneers HR Solutions. All rights reserved.</p>
    </footer>
</body>
</html>