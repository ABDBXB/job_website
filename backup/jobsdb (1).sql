-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11 مايو 2025 الساعة 16:22
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobsdb`
--

-- --------------------------------------------------------

--
-- بنية الجدول `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_applied` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Reviewed','Accepted','Rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `applications`
--

INSERT INTO `applications` (`application_id`, `job_id`, `user_id`, `date_applied`, `status`) VALUES
(1, 1, 3, '2025-05-07 00:00:00', 'Pending'),
(2, 4, 3, '2025-05-22 00:00:00', 'Pending');

-- --------------------------------------------------------

--
-- بنية الجدول `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description_company` text DEFAULT NULL,
  `location_company` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `companies`
--

INSERT INTO `companies` (`id`, `name`, `description_company`, `location_company`, `website`, `created_at`) VALUES
(1, 'TechNova Solutions', 'A leading tech company specializing in AI and web development.', 'New York, NY', 'https://technova.com', '2025-04-30 00:37:59');

-- --------------------------------------------------------

--
-- بنية الجدول `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `salary` decimal(50,0) NOT NULL,
  `job_type` enum('Full Time','Part Time') NOT NULL,
  `description` text NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `company_image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `jobs`
--

INSERT INTO `jobs` (`job_id`, `company_id`, `job_title`, `location`, `salary`, `job_type`, `description`, `date_posted`, `company_image`) VALUES
(1, 0, ' UI/UX des2', ' Damascus , Syria', 1000, 'Full Time', 'figma , xd ', '2025-05-11 07:12:17', ''),
(4, 0, ' UI/UX ', ' Damascus , Syria', 1000, 'Full Time', 'figma , xd ', '2025-05-11 07:12:22', ''),
(28, 1, 'Frontend Developer', 'Remote', 70000, 'Full Time', '\'Looking for a skilled React developer.', '2025-05-11 07:16:55', ''),
(29, 1, 'Backend Developer', 'New York, NY', 80000, 'Full Time', 'Expert in Node.js and databases.', '2025-05-11 07:16:55', ''),
(30, 1, 'UI/UX Designer', 'Remote', 70000, 'Part Time', 'Creative designer needed for mobile apps', '2025-05-11 07:19:09', ''),
(31, 1, 'Backend Developer', 'New York, NY', 90000, 'Full Time', 'AWS and Docker experience required.', '2025-05-11 07:19:09', '');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `user_type` enum('seeker','recruiter','admin') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `user_type`, `activated`, `code`) VALUES
(3, 'sulafa kh', 'sulafakh22@gmail.com', '1234', 'seeker', 1, '89f4984030eb84fe4c8cadf27f4d6557');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
