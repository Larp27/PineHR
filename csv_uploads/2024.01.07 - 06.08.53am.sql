-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 06:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinehr_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `att_id` int(255) NOT NULL,
  `em_name` varchar(50) NOT NULL,
  `att_date` varchar(50) NOT NULL,
  `att_s_in` varchar(50) NOT NULL,
  `att_s_out` varchar(50) NOT NULL,
  `att_total_hr` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`att_id`, `em_name`, `att_date`, `att_s_in`, `att_s_out`, `att_total_hr`) VALUES
(112, 'Rivera, Ralph Joseph ', '18/12/2023', '7:30AM', '5:00PM', '9:30'),
(113, 'Peter, Palompon', '18/12/2023', '7:20AM', '5:30PM', '10:10'),
(114, 'Torregosa, Jessa Mae', '18/12/2023', '7:10AM', '5:20PM', '10:10'),
(115, 'Tarre, Cheryl', '18/12/2023', '7:00AM', '5:00PM', '10:00'),
(116, 'Montesclaros, Johnalex ', '18/12/2023', '7:10AM', '5:30PM', '10:20'),
(117, 'James, Lebron', '18/12/2023', '7:00AM', '5:00PM', '10:10'),
(118, 'Rivera, Ralph Joseph ', '18/12/2023', '7:30AM', '5:00PM', '9:30'),
(119, 'Peter, Palompon', '18/12/2023', '7:20AM', '5:30PM', '10:10'),
(120, 'Torregosa, Jessa Mae', '18/12/2023', '7:10AM', '5:20PM', '10:10'),
(121, 'Tarre, Cheryl', '18/12/2023', '7:00AM', '5:00PM', '10:00'),
(122, 'Montesclaros, Johnalex ', '18/12/2023', '7:10AM', '5:30PM', '10:20'),
(123, 'James, Lebron', '18/12/2023', '7:00AM', '5:00PM', '10:10');

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `bt_id` int(11) NOT NULL,
  `bt_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`bt_id`, `bt_name`) VALUES
(1, 'O-'),
(2, 'O+'),
(3, 'A-'),
(4, 'A+'),
(5, 'B-'),
(6, 'B+'),
(7, 'AB-'),
(8, 'AB+');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int(11) NOT NULL,
  `dep_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`) VALUES
(5, 'Office of the Municipal Mayor'),
(6, 'Office of the Sangguniang Bayan'),
(7, 'Office of the Sangguniang Bayan Secretary'),
(8, 'Office of the Municipal Planning and Development Coordinator'),
(9, 'Office of the Municipal Budget Officer'),
(10, 'Office of Jessa');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `des_id` int(11) NOT NULL,
  `des_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`des_id`, `des_name`) VALUES
(1, 'Security Guard'),
(3, 'Provincial Vice Mayor'),
(4, 'Provincial Mayor'),
(5, 'IT Analyst'),
(6, 'Larp');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `em_id` int(11) NOT NULL,
  `des_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `bt_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `es_id` int(11) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `em_email` varchar(64) NOT NULL,
  `em_password` varchar(514) NOT NULL,
  `em_address` varchar(512) NOT NULL,
  `em_gender` varchar(11) NOT NULL,
  `em_phone` varchar(64) NOT NULL,
  `em_birthday` varchar(128) NOT NULL,
  `em_joining_date` date NOT NULL,
  `em_contract_end` date NOT NULL,
  `em_image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`em_id`, `des_id`, `dep_id`, `bt_id`, `user_id`, `es_id`, `first_name`, `last_name`, `em_email`, `em_password`, `em_address`, `em_gender`, `em_phone`, `em_birthday`, `em_joining_date`, `em_contract_end`, `em_image`) VALUES
(1, 4, 5, 7, 1, 1, 'Ralph Joseph', 'Rivera', 'admin@admin', 'admin123', 'Ormoc City', 'Male', '09457132970', '01-13-2002', '0000-00-00', '0000-00-00', ''),
(2, 5, 5, 2, 2, 1, 'Jessa Mae', 'Torregosa', 'employee@gmail.com', 'employee123', 'Ormoc City', 'Female', '09123456789', '01-23-2002', '0000-00-00', '0000-00-00', '123.jpg'),
(4, 3, 6, 2, 2, 1, 'Palompon', 'Peter', '', '', '', 'Male', '123', '2023-12-17', '2023-12-18', '2023-12-19', '123'),
(5, 4, 6, 6, 2, 2, 'Jejomar', 'Binay', '', '', '', 'Male', '123', '2023-12-17', '2023-12-18', '2023-12-19', '123'),
(6, 4, 5, 6, 2, 3, 'Johnalex', 'Montesclaros', '', '', '', 'Female', '123', '2023-12-16', '2023-12-17', '2023-12-18', '123'),
(7, 5, 10, 4, 2, 1, 'sample', 'sample', '', '', '', 'Male', 'sample', '2023-12-17', '2023-12-18', '2023-12-19', 'sample'),
(8, 1, 9, 4, 3, 3, 'Peter', 'Palompon', '', '', '', 'Male', '09457132870', '2001-06-23', '2023-12-17', '2023-12-18', '');

-- --------------------------------------------------------

--
-- Table structure for table `employment_status`
--

CREATE TABLE `employment_status` (
  `es_id` int(128) NOT NULL,
  `es_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employment_status`
--

INSERT INTO `employment_status` (`es_id`, `es_name`) VALUES
(1, 'Regular'),
(2, 'Casual'),
(3, 'Job Order');

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `la_id` int(30) NOT NULL,
  `em_id` int(30) NOT NULL,
  `lt_id` int(30) NOT NULL,
  `la_reason` varchar(100) NOT NULL,
  `la_date_start` datetime NOT NULL,
  `la_date_end` datetime NOT NULL,
  `la_day_type` varchar(20) NOT NULL,
  `la_status` tinyint(4) NOT NULL,
  `la_approved_by` int(30) NOT NULL,
  `la_leave_days` int(11) NOT NULL,
  `la_date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `la_date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_application`
--

INSERT INTO `leave_application` (`la_id`, `em_id`, `lt_id`, `la_reason`, `la_date_start`, `la_date_end`, `la_day_type`, `la_status`, `la_approved_by`, `la_leave_days`, `la_date_created`, `la_date_updated`) VALUES
(5, 3, 4, '123', '2023-12-19 00:00:00', '2023-12-20 00:00:00', 'Whole Day', 0, 0, 1, '2023-12-18 00:00:00', '2023-12-18 14:25:58'),
(6, 1, 2, 'active', '2023-12-18 00:00:00', '2023-12-19 00:00:00', 'Half Day', 0, 0, 1, '2023-12-18 00:00:00', '2023-12-18 14:26:41'),
(7, 1, 2, 'active', '2023-12-18 00:00:00', '2023-12-19 00:00:00', 'Half Day', 0, 0, 1, '2023-12-18 00:00:00', '2023-12-18 14:26:45'),
(8, 1, 4, '123', '2023-12-18 00:00:00', '2023-12-19 00:00:00', 'Whole Day', 1, 0, 1, '2023-12-18 00:00:00', '2023-12-18 14:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `lt_id` int(11) NOT NULL,
  `lt_code` varchar(11) NOT NULL,
  `lt_name` varchar(50) NOT NULL,
  `lt_description` text NOT NULL,
  `lt_credit` float NOT NULL,
  `lt_status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`lt_id`, `lt_code`, `lt_name`, `lt_description`, `lt_credit`, `lt_status`, `date_created`) VALUES
(1, 'VL', 'Vacation Leave', 'Vacation Leave with Pay', 10, 1, '2023-12-14 02:01:35'),
(4, 'L', 'Leave', 'Leave', 2, 0, '2023-12-18 14:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `notice_name` varchar(128) NOT NULL,
  `notice_description` varchar(500) NOT NULL,
  `date_added` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `notice_name`, `notice_description`, `date_added`) VALUES
(1, 'HR Department Meeting', 'Good Morning, for all HR Department employee\'s we have a meeting this upcoming December 25, 2023 8AM in the morning.', '12-05-2023');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_id` int(11) NOT NULL,
  `user_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_id`, `user_role`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`bt_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`des_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`em_id`),
  ADD KEY `department foreign` (`dep_id`),
  ADD KEY `designation foreign` (`des_id`),
  ADD KEY `bloodtype foreign` (`bt_id`),
  ADD KEY `usertype foreign` (`user_id`),
  ADD KEY `em_status foreign` (`es_id`);

--
-- Indexes for table `employment_status`
--
ALTER TABLE `employment_status`
  ADD PRIMARY KEY (`es_id`);

--
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`la_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`lt_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `att_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `des_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `em_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `es_id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `la_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `lt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `bloodtype foreign` FOREIGN KEY (`bt_id`) REFERENCES `blood_group` (`bt_id`),
  ADD CONSTRAINT `department foreign` FOREIGN KEY (`dep_id`) REFERENCES `department` (`dep_id`),
  ADD CONSTRAINT `designation foreign` FOREIGN KEY (`des_id`) REFERENCES `designation` (`des_id`),
  ADD CONSTRAINT `em_status foreign` FOREIGN KEY (`es_id`) REFERENCES `employment_status` (`es_id`),
  ADD CONSTRAINT `usertype foreign` FOREIGN KEY (`user_id`) REFERENCES `user_type` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
