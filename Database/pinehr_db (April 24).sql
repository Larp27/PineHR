-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 06:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `barangay` varchar(2002) NOT NULL,
  `city` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `barangay`, `city`) VALUES
(1, 'Barangay Ipil', 'Ormoc City'),
(2, 'Barangay Cogon', 'Ormoc City'),
(3, 'Barangay Danhug', 'Ormoc City');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `att_id` int(255) NOT NULL,
  `em_id` int(11) DEFAULT NULL,
  `att_date` date NOT NULL,
  `att_s_in` time(6) NOT NULL,
  `att_s_out` time(6) NOT NULL,
  `total_hr` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`att_id`, `em_id`, `att_date`, `att_s_in`, `att_s_out`, `total_hr`) VALUES
(1, 18, '2024-04-24', '07:04:00.000000', '17:08:00.000000', 10),
(2, 19, '2024-04-24', '06:04:00.000000', '16:08:00.000000', 10),
(3, 13, '2024-04-24', '06:11:00.000000', '16:09:00.000000', 10);

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
(8, 'AB+'),
(9, 'ABCD');

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
(10, 'Office of Janitors');

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
(5, 'IT Analyst');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `edu_id` int(11) NOT NULL,
  `education` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`edu_id`, `education`) VALUES
(1, 'High School Graduate'),
(2, 'Secondary Level Graduate'),
(3, 'College Graduate');

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
  `address_id` int(11) DEFAULT NULL,
  `edu_id` int(11) DEFAULT NULL,
  `r_id` int(11) DEFAULT NULL,
  `ms_id` int(11) DEFAULT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `employee_status` enum('Active','Inactive','On Leave') NOT NULL DEFAULT 'Active',
  `em_email` varchar(64) NOT NULL,
  `em_password` varchar(514) NOT NULL,
  `em_gender` varchar(11) NOT NULL,
  `em_phone` varchar(14) NOT NULL,
  `em_birthday` varchar(128) NOT NULL,
  `em_joining_date` date NOT NULL,
  `em_contract_end` date NOT NULL,
  `em_income` int(50) DEFAULT NULL,
  `em_profile_pic` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`em_id`, `des_id`, `dep_id`, `bt_id`, `user_id`, `es_id`, `address_id`, `edu_id`, `r_id`, `ms_id`, `first_name`, `last_name`, `employee_status`, `em_email`, `em_password`, `em_gender`, `em_phone`, `em_birthday`, `em_joining_date`, `em_contract_end`, `em_income`, `em_profile_pic`) VALUES
(2, 5, 8, 4, 2, 1, 1, 2, 1, 1, 'Peter Daniel', 'Palompon', 'Inactive', 'peter@gmail.com', 'employee123', 'Male', '+639457132970', '2024-04-09', '2024-04-10', '2024-04-11', 520, '../uploads/eys.jpg'),
(9, 5, 8, 7, 2, 2, 1, 2, 1, 1, 'as', 'as', 'On Leave', 'as@gmail.com', 'as', 'Male', '+639457132970', '2001-12-12', '2024-02-12', '2025-02-12', 450, '../uploads/8_6628757bed458.jpg'),
(13, 4, 9, 8, 2, 3, 2, 1, 1, 1, 'Jessa Mae', 'Torregosa', 'On Leave', 'sample@ormochr.com', '123', 'Female', '+639457132970', '2024-04-19', '2024-04-19', '2025-04-20', NULL, '../uploads/674b3893-486e-4927-b8b0-241d5b2de936.jpg_66215df157815.jpg'),
(15, 5, 9, 8, 2, 3, 2, 1, 2, 1, '12312312', '12321312312', 'Active', '123', '123', 'Female', '+639457132970', '2024-04-19', '2024-04-19', '2025-04-20', NULL, '../uploads/harry.png_6621d438c7410.png'),
(16, 4, 5, 8, 2, 3, 3, 1, 1, 1, 'John Renmy', 'Lucanas', 'Active', '123', '123', 'Male', '+639457132970', '2024-04-19', '2024-04-19', '2025-04-20', NULL, '../uploads/J Riz_662260b5b653b.jpg'),
(17, 4, 5, 8, 2, 3, 3, 2, 2, 1, 'Mac', 'Blando', 'Inactive', '123', '123', 'Male', '+639457132970', '2024-04-19', '2024-04-19', '2024-04-20', NULL, '../uploads/john_marston_cover_by_sezaibey_dgurl0o-fullview_662262886d232.jpg'),
(18, 5, 6, 4, 1, 1, 1, 2, 1, 1, 'RJ', 'Rivera', 'Active', 'admin', 'admin', 'Male', '+639457132970', '2002-01-13', '2024-04-20', '2025-04-21', NULL, '../uploads/ey.png'),
(19, 4, 5, 8, 1, 1, 1, 2, 1, 1, 'Ralph Joseph', 'Rivera', 'Active', 'admin@admin', 'admin123', 'Male', '+639457132970', '2002-01-13', '2024-04-20', '2025-04-21', NULL, '../uploads/ey.png'),
(20, 4, 5, 8, 2, 1, 1, 1, 1, 1, 'Inka Paulette', 'Rivera', 'Active', 'inka@gmail.com', 'inka123', 'Female', '+639457132970', '2024-04-22', '2024-04-22', '2024-04-23', 0, '../uploads/A6409635_66253dbd690d1.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave_credits`
--

CREATE TABLE `employee_leave_credits` (
  `em_id` int(11) NOT NULL,
  `lt_id` int(11) NOT NULL,
  `available_credits` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_leave_credits`
--

INSERT INTO `employee_leave_credits` (`em_id`, `lt_id`, `available_credits`) VALUES
(2, 1, 24),
(9, 1, 18),
(9, 2, 10),
(13, 1, 20),
(13, 2, 10),
(13, 3, 12),
(13, 4, 15),
(13, 5, 5),
(13, 6, 10),
(13, 7, 30),
(16, 1, 20),
(16, 2, 10),
(17, 1, 20),
(17, 2, 10),
(17, 7, 30),
(18, 1, 20),
(18, 2, 10),
(18, 3, 12),
(18, 4, 15),
(18, 5, 5),
(18, 6, 10),
(18, 7, 30),
(19, 2, 10),
(19, 7, 30),
(20, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `employment_status`
--

CREATE TABLE `employment_status` (
  `es_id` int(128) NOT NULL,
  `es_name` varchar(128) NOT NULL,
  `es_income` int(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employment_status`
--

INSERT INTO `employment_status` (`es_id`, `es_name`, `es_income`) VALUES
(1, 'Regular', 520),
(2, 'Casual', 450),
(3, 'Job Order', 370);

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `la_id` int(30) NOT NULL,
  `em_id` int(30) NOT NULL,
  `lt_id` int(30) NOT NULL,
  `la_reason` text NOT NULL,
  `la_date_start` datetime NOT NULL,
  `la_date_end` datetime NOT NULL,
  `la_status` enum('Pending','Accepted','Declined','Cancelled') NOT NULL DEFAULT 'Pending',
  `la_approved_by` int(30) NOT NULL,
  `la_date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `la_date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_application`
--

INSERT INTO `leave_application` (`la_id`, `em_id`, `lt_id`, `la_reason`, `la_date_start`, `la_date_end`, `la_status`, `la_approved_by`, `la_date_created`, `la_date_updated`) VALUES
(5, 9, 1, 'sample', '2024-04-20 00:00:00', '2024-04-21 00:00:00', 'Accepted', 9, '2024-04-20 01:14:19', '2024-04-20 01:14:19'),
(6, 2, 2, 'sample', '2024-04-20 00:00:00', '2024-04-20 00:00:00', 'Accepted', 0, '2024-04-20 01:37:42', '2024-04-20 01:37:42'),
(7, 2, 1, 'sample', '2024-04-24 00:00:00', '2024-04-25 00:00:00', 'Declined', 0, '2024-04-20 15:23:57', '2024-04-20 15:23:57'),
(8, 13, 3, '123', '2024-04-20 00:00:00', '2024-04-21 00:00:00', 'Accepted', 0, '2024-04-20 15:24:31', '2024-04-20 15:24:31'),
(9, 9, 1, 'asd', '2024-04-12 00:00:00', '2024-04-27 00:00:00', 'Accepted', 9, '2024-04-20 16:47:32', '2024-04-20 16:47:32'),
(10, 2, 1, 'erty', '2024-04-22 00:00:00', '2024-04-21 00:00:00', 'Accepted', 2, '2024-04-20 16:48:57', '2024-04-20 16:48:57'),
(11, 2, 1, 'asd', '2024-04-24 00:00:00', '2024-04-25 00:00:00', 'Declined', 0, '2024-04-21 10:38:20', '2024-04-21 10:38:20'),
(12, 13, 1, 'sample', '2024-04-21 00:00:00', '2024-04-22 00:00:00', 'Pending', 0, '2024-04-21 20:50:57', '2024-04-21 20:50:57');

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
(1, 'ANNUAL', 'Annual Leave', 'Time off for rest, relaxation, and personal activities', 20, 1, '2024-04-13 08:00:00'),
(2, 'SICK', 'Sick Leave', 'Time off granted to employees when they are ill or injured', 10, 1, '2024-04-13 08:00:00'),
(3, 'M/P', 'Maternity Leave/ Paternity Leave', 'Time off granted for the birth or adoption of a child', 12, 1, '2024-04-13 08:00:00'),
(4, 'FAMILY_MEDI', 'Family/Medical Leave', 'Time off granted to care for oneself or a family member', 15, 1, '2024-04-13 08:00:00'),
(5, 'BEREAVEMENT', 'Bereavement Leave', 'Time off granted to grieve the death of a family member or loved one', 5, 1, '2024-04-13 08:00:00'),
(6, 'JURY_DUTY', 'Jury Duty Leave', 'Time off granted to employees required to serve on a jury', 10, 1, '2024-04-13 08:00:00'),
(7, 'MILITARY', 'Military Leave', 'Time off granted to employees called to active military duty', 30, 1, '2024-04-13 08:00:00'),
(8, 'UNPAID', 'Unpaid Leave', 'Time off taken by employees for personal reasons', 10, 0, '2024-04-13 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

CREATE TABLE `marital_status` (
  `ms_id` int(11) NOT NULL,
  `ms_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`ms_id`, `ms_name`) VALUES
(1, 'Single'),
(2, 'Married');

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
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_id` int(11) NOT NULL,
  `em_id` varchar(64) DEFAULT NULL,
  `payroll_start_date` date NOT NULL,
  `payroll_income` int(200) NOT NULL,
  `payroll_deduction` int(200) NOT NULL,
  `payroll_twd` int(200) NOT NULL,
  `payroll_total` int(255) NOT NULL,
  `payroll_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `em_id`, `payroll_start_date`, `payroll_income`, `payroll_deduction`, `payroll_twd`, `payroll_total`, `payroll_end_date`) VALUES
(1, '9', '2024-04-24', 450, 200, 6, 2500, '2024-04-30'),
(2, '18', '2024-04-24', 500, 200, 1, 300, '2024-04-25'),
(3, '2', '2024-04-24', 525, 300, 6, 2850, '2024-04-30'),
(4, '13', '2024-04-24', 900, 290, 6, 5110, '2024-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE `religion` (
  `r_id` int(11) NOT NULL,
  `r_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`r_id`, `r_name`) VALUES
(1, 'Roman Catholic'),
(2, 'Islam'),
(3, 'Buddhism'),
(4, 'Hinduism');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(1, 'Urgent Meeting', 'HR Office', '2024-04-16 10:21:00', '2024-04-17 10:22:00'),
(20, '123', '123', '2024-04-20 09:32:00', '2024-04-20 09:32:00');

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
(1, 'Admin'),
(2, 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `employee id foreign` (`em_id`) USING BTREE;

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
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`edu_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`em_id`),
  ADD KEY `department foreign` (`dep_id`),
  ADD KEY `designation foreign` (`des_id`),
  ADD KEY `bloodtype foreign` (`bt_id`),
  ADD KEY `usertype foreign` (`user_id`),
  ADD KEY `em_status foreign` (`es_id`),
  ADD KEY `religion foreign` (`r_id`) USING BTREE,
  ADD KEY `marital status foreign` (`ms_id`) USING BTREE;

--
-- Indexes for table `employee_leave_credits`
--
ALTER TABLE `employee_leave_credits`
  ADD PRIMARY KEY (`em_id`,`lt_id`),
  ADD KEY `lt_id` (`lt_id`);

--
-- Indexes for table `employment_status`
--
ALTER TABLE `employment_status`
  ADD PRIMARY KEY (`es_id`);

--
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`la_id`),
  ADD KEY `em_id` (`em_id`),
  ADD KEY `lt_id` (`lt_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`lt_id`);

--
-- Indexes for table `marital_status`
--
ALTER TABLE `marital_status`
  ADD PRIMARY KEY (`ms_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payroll_id`),
  ADD KEY `employee ID` (`em_id`) USING BTREE;

--
-- Indexes for table `religion`
--
ALTER TABLE `religion`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `att_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `edu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `em_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `es_id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `la_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `lt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `marital_status`
--
ALTER TABLE `marital_status`
  MODIFY `ms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `religion`
--
ALTER TABLE `religion`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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

--
-- Constraints for table `employee_leave_credits`
--
ALTER TABLE `employee_leave_credits`
  ADD CONSTRAINT `employee_leave_credits_ibfk_1` FOREIGN KEY (`em_id`) REFERENCES `employee` (`em_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_leave_credits_ibfk_2` FOREIGN KEY (`lt_id`) REFERENCES `leave_type` (`lt_id`);

--
-- Constraints for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD CONSTRAINT `leave_application_ibfk_1` FOREIGN KEY (`em_id`) REFERENCES `employee` (`em_id`),
  ADD CONSTRAINT `leave_application_ibfk_2` FOREIGN KEY (`lt_id`) REFERENCES `leave_type` (`lt_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
