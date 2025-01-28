-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 28, 2025 at 10:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr_recruitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role` enum('superadmin','admin') DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `user_id`, `role`) VALUES
(1, 4, 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('under review','shortlisted','rejected','accepted') DEFAULT 'under review',
  `cv` varchar(255) DEFAULT NULL,
  `offer_letter` varchar(256) DEFAULT NULL,
  `offer_letter_status` int(128) NOT NULL DEFAULT 1,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `job_id`, `user_id`, `status`, `cv`, `offer_letter`, `offer_letter_status`, `applied_at`) VALUES
(1, 1, 1, 'shortlisted', 'uploads/Extra.pdf', NULL, 1, '2024-06-16 09:11:47'),
(2, 2, 1, 'rejected', 'uploads/Extra.pdf', NULL, 1, '2024-06-16 09:11:47'),
(3, 3, 2, 'rejected', 'uploads/Extra.pdf', NULL, 1, '2024-06-16 09:11:47'),
(4, 4, 2, 'under review', 'uploads/Extra.pdf', NULL, 1, '2024-06-16 09:11:47'),
(5, 3, 2, 'accepted', 'uploads/Extra.pdf', 'Visa Platform ahmad.pdf', 4, '2024-06-30 11:38:11'),
(6, 2, 2, 'under review', 'uploads/Extra.pdf', NULL, 1, '2024-06-30 11:41:19'),
(7, 3, 6, 'rejected', 'uploads/Extra.pdf', NULL, 1, '2024-07-05 12:11:47'),
(8, 9, 2, 'under review', 'uploads/668866bc68977_Profile.pdf', NULL, 1, '2024-07-05 20:33:48'),
(9, 3, 6, 'shortlisted', 'uploads/6688d8bb0359f_alice.pdf', NULL, 1, '2024-07-06 04:40:11'),
(10, 9, 8, 'accepted', 'uploads/668934cbc2f2a_alice.pdf', NULL, 1, '2024-07-06 11:12:59'),
(11, 4, 8, 'rejected', 'uploads/668938d8c6090_alice.pdf', NULL, 1, '2024-07-06 11:30:16'),
(12, 2, 9, 'under review', 'uploads/668bd8ef0123e_12.pdf', NULL, 1, '2024-07-08 11:17:51'),
(13, 9, 10, 'under review', 'uploads/668bda640f127_11.pdf', NULL, 1, '2024-07-08 11:24:04'),
(14, 3, 10, 'accepted', 'uploads/668bdbba68ba1_11.pdf', 'MS Dean Letter.pdf', 2, '2024-07-08 11:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE `assign` (
  `assign_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`assign_id`, `user_id`, `hr_id`) VALUES
(3, 8, 3),
(4, 2, 3),
(5, 1, 3),
(6, 9, 7),
(7, 10, 7),
(8, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `interviews`
--

CREATE TABLE `interviews` (
  `interview_id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `interview_date` date DEFAULT NULL,
  `interview_time` time DEFAULT NULL,
  `status` enum('scheduled','completed','canceled') DEFAULT 'scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interviews`
--

INSERT INTO `interviews` (`interview_id`, `application_id`, `interview_date`, `interview_time`, `status`, `created_at`) VALUES
(1, 1, '2024-06-05', '10:00:00', 'scheduled', '2024-06-16 09:12:06'),
(8, 5, '2024-07-26', '18:20:00', 'scheduled', '2024-07-01 14:15:19'),
(9, 7, '2024-07-31', '16:17:00', 'scheduled', '2024-07-05 12:12:41'),
(10, 9, '2024-07-27', '11:41:00', 'scheduled', '2024-07-06 04:41:25'),
(11, 10, '2024-07-27', '20:19:00', 'scheduled', '2024-07-06 11:19:37'),
(12, 11, '2024-07-31', '08:31:00', 'scheduled', '2024-07-06 11:31:26'),
(13, 14, '2024-07-25', '15:38:00', 'scheduled', '2024-07-08 11:32:04'),
(14, 6, '2024-07-31', '16:45:00', 'scheduled', '2024-07-30 12:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `jobpostings`
--

CREATE TABLE `jobpostings` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `experience_required` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `hr_id` int(11) DEFAULT NULL,
  `soft_delete` int(128) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobpostings`
--

INSERT INTO `jobpostings` (`job_id`, `job_title`, `location`, `experience_required`, `description`, `hr_id`, `soft_delete`, `created_at`) VALUES
(1, 'Software Developer', 'Europe', '10', 'Develop and maintain software applications.', 3, 1, '2024-06-16 09:11:41'),
(2, 'Project Manager', 'San Francisco', '5+ years', 'Manage software development projects.', 3, 0, '2024-06-16 09:11:41'),
(3, 'Data Analyst', 'Remote', '2+ years', 'Analyze data and generate reports.', 3, 0, '2024-06-16 09:11:41'),
(4, 'HR Specialist', 'Chicago', '4+ years', 'Handle HR operations and recruitment.', 3, 0, '2024-06-16 09:11:41'),
(9, 'AI Engineer ', 'remote', '10+', 'We need a developer experience in LLM, DL and ML', 3, 0, '2024-07-05 21:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `content`, `sent_at`) VALUES
(1, 3, 1, 'Your application for Software Developer is under review.', '2024-06-16 09:12:17'),
(2, 3, 2, 'Your application for Project Manager has been shortlisted.', '2024-06-16 09:12:17'),
(3, 1, 3, 'I have updated my resume for the Software Developer position.', '2024-06-16 09:12:17'),
(4, 2, 3, 'Can you provide more details about the Project Manager role?', '2024-06-16 09:12:17'),
(5, 1, 2, 'hi', '2024-07-02 15:29:34'),
(6, 1, 2, 'this is john', '2024-07-02 15:29:49'),
(12, 1, 3, 'do you have an update for me?', '2024-07-04 19:29:07'),
(14, 8, 3, 'hi, thank you for smooth on boarding', '2024-07-06 12:22:27'),
(15, 3, 8, 'no problem steve!', '2024-07-06 12:37:42'),
(16, 10, 7, 'Hi I have updated my cv', '2024-07-08 12:27:25'),
(17, 8, 3, 'Hi I have applied to the new role please see my cv', '2024-07-08 12:30:28'),
(18, 3, 8, 'ok steve!', '2024-07-08 12:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 1, 'Your application for Software Developer is under review.', 0, '2024-06-16 09:12:24'),
(2, 2, 'Your application for Project Manager has been shortlisted.', 0, '2024-06-16 09:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`profile_id`, `user_id`, `bio`, `phone`, `address`) VALUES
(1, 1, 'Experienced software developer with a passion for coding.', '123-456-7890', '123 Main St, San Francisco, SF'),
(2, 2, 'Project manager with expertise in software development.', '987-654-3210', '456 Elm St, San Francisco, CA'),
(3, 3, 'HR professional with 12+ years of experience in recruitment.', '555-555-5559', '789 Oak St, Chicago, IL'),
(4, 5, 'I am a former AI Engineer. I have successfully created my own chat gpt', '03140630123', 'Johar Town'),
(5, 6, 'I am a former AI Engineer. I have successfully created my own chatbot', '555-555-5560', 'Johar Town'),
(6, 7, 'HR at microsoft for over 10 years', ' 555-555-5598', ' 123 Main St, San Francisco, SF'),
(7, 8, 'I worked at an ice cream parlour and dvd shop', '555-555-5789', 'hawkins, USA'),
(8, 9, 'I am a fullstack developer', '03140630129', 'hawkins, USA'),
(9, 10, 'I am a former AI Engineer. I have successfully created my own chatbot  using RAG', '555-555-5598', 'Johar Town');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resource_id`, `title`, `content`, `created_at`) VALUES
(1, 'Resume Tips', 'Ensure your resume is up-to-date and highlights your key skills and experiences.', '2024-06-16 09:12:31'),
(2, 'Interview Preparation Guide', 'Research the company and prepare answers to common interview questions.', '2024-06-16 09:12:31'),
(3, 'Career Advice', 'Network with professionals in your field and continue learning new skills.', '2024-06-16 09:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` enum('user','hr','admin') DEFAULT 'user',
  `is_enable` int(128) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `name`, `role`, `is_enable`, `created_at`) VALUES
(1, 'johndoe', 'password123', 'john.doe@example.com', 'John Doe', 'user', 1, '2024-06-16 09:11:34'),
(2, 'janedoe', 'password123', 'jane.doe@example.com', 'Jane Doe', 'user', 1, '2024-06-16 09:11:34'),
(3, 'hrmanager', 'password123', 'hr.manager@example.com', 'Musa', 'hr', 1, '2024-06-16 09:11:34'),
(4, 'adminuser', 'password123', 'admin.user@example.com', 'Admin User', 'admin', 1, '2024-06-16 09:11:34'),
(5, 'soloNSteady', '12345678', 'ahmadazhar378@gmail.com', 'ahmad', 'admin', 1, '2024-06-29 21:42:06'),
(6, 'sachez_', '12345678', 'sanchez@example.com', 'Sanchez', 'user', 0, '2024-07-05 12:11:18'),
(7, 'kamal12', '123456789', 'kamal@gmail.com', 'kamal', 'hr', 1, '2024-07-06 04:46:30'),
(8, 'steven10', '12345678', 'steve10@gmail.com', 'Steve', 'user', 1, '2024-07-06 11:10:23'),
(9, 'asif10', '12345678', 'asif@gmail.com', 'Asif', 'user', 1, '2024-07-08 11:16:49'),
(10, 'musab10', '12345678', 'musab@gmail.com', 'Musab', 'user', 1, '2024-07-08 11:22:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `assign`
--
ALTER TABLE `assign`
  ADD PRIMARY KEY (`assign_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hr_id` (`hr_id`);

--
-- Indexes for table `interviews`
--
ALTER TABLE `interviews`
  ADD PRIMARY KEY (`interview_id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `jobpostings`
--
ALTER TABLE `jobpostings`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `hr_id` (`hr_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `assign`
--
ALTER TABLE `assign`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `interviews`
--
ALTER TABLE `interviews`
  MODIFY `interview_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobpostings`
--
ALTER TABLE `jobpostings`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobpostings` (`job_id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `assign`
--
ALTER TABLE `assign`
  ADD CONSTRAINT `assign_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `assign_ibfk_2` FOREIGN KEY (`hr_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `interviews`
--
ALTER TABLE `interviews`
  ADD CONSTRAINT `interviews_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `jobpostings`
--
ALTER TABLE `jobpostings`
  ADD CONSTRAINT `jobpostings_ibfk_1` FOREIGN KEY (`hr_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
