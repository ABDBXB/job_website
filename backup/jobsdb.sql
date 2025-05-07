-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 مايو 2025 الساعة 21:48
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
  `date_applied` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `applications`
--

INSERT INTO `applications` (`application_id`, `job_id`, `user_id`, `date_applied`) VALUES
(1, 1, 3, '2025-05-07'),
(2, 4, 3, '2025-05-22');

-- --------------------------------------------------------

--
-- بنية الجدول `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `salary` decimal(50,0) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `desciption` text NOT NULL,
  `date_posted` date NOT NULL,
  `company_image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `jobs`
--

INSERT INTO `jobs` (`job_id`, `company_name`, `job_title`, `location`, `salary`, `job_type`, `desciption`, `date_posted`, `company_image`) VALUES
(1, 'microsoft', ' UI/UX ', ' Damascus , Syria', 1000, ' full time', 'figma , xd adoube', '0000-00-00', ''),
(2, 'microsoft', ' UI/UX ', ' Damascus , Syria', 1000, ' full time', 'figma , xd ', '0000-00-00', ''),
(3, 'microsoft', ' UI/UX ', ' Damascus , Syria', 1000, ' full time', 'figma , xd ', '0000-00-00', ''),
(4, 'microsoft', ' UI/UX ', ' Damascus , Syria', 1000, ' full time', 'figma , xd ', '0000-00-00', ''),
(5, 'microsoft', ' UI/UX ', ' Damascus , Syria', 1000, ' full time', 'figma , xd ', '0000-00-00', ''),
(6, 'microsoft', ' UI/UX ', ' Damascus , Syria', 1000, ' full time', 'figma , xd ', '0000-00-00', ''),
(7, 'microsoft', ' UI/UX ', ' Damascus , Syria', 1000, ' full time', 'figma , xd ', '0000-00-00', ''),
(8, 'microsoft', ' UI/UX ', ' Damascus , Syria', 1000, ' full time', 'figma , xd ', '0000-00-00', ''),
(9, 'microsoft', ' UI/UX ', ' Damascus , Syria', 1000, ' full time', 'figma , xd ', '0000-00-00', '');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(225) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  `user_type` enum('user','admin') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `activated` tinyint(1) NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `user_type`, `activated`, `code`) VALUES
(3, 'sulafa kh', 'sulafakh22@gmail.com', '1234', 'user', 1, '89f4984030eb84fe4c8cadf27f4d6557'),
(4, 'admin', 'admin@gmail.com', '12345678', 'admin', 1, '');

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
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
