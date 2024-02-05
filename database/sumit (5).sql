-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 07:07 AM
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
-- Database: `sumit`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`) VALUES
(4, 'BA'),
(2, 'BBA'),
(1, 'BCA'),
(3, 'BCOM');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_time_table`
--

CREATE TABLE `deleted_time_table` (
  `time_table_id` int(11) NOT NULL,
  `value_id_name` varchar(200) DEFAULT NULL,
  `data_time` varchar(200) DEFAULT NULL,
  `Date` varchar(200) DEFAULT NULL,
  `teacher_name` varchar(200) DEFAULT NULL,
  `subject_name` varchar(200) DEFAULT NULL,
  `class_name` varchar(255) DEFAULT NULL,
  `delete_by` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_time_table`
--

INSERT INTO `deleted_time_table` (`time_table_id`, `value_id_name`, `data_time`, `Date`, `teacher_name`, `subject_name`, `class_name`, `delete_by`) VALUES
(48, 'FRIDAY_1', '09:00-10:00', '09 January, 2024', 'Michael Johnson', 'JAVA', 'BCA', 'superadmin@example.com'),
(49, 'FRIDAY_1', '09:00-10:00', '09 January, 2024', 'Michael Johnson', 'JAVA', 'BCA', 'superadmin@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_users`
--

CREATE TABLE `deleted_users` (
  `id` int(11) NOT NULL,
  `delete_by` varchar(200) NOT NULL,
  `roles_id` varchar(200) DEFAULT NULL,
  `class_id` varchar(200) DEFAULT NULL,
  `subject_id` varchar(200) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_users`
--

INSERT INTO `deleted_users` (`id`, `delete_by`, `roles_id`, `class_id`, `subject_id`, `name`, `email`, `password`) VALUES
(7, '', 'Super_Admin', 'BA', 'PHP', 'sumit', 'mourya', '123'),
(12, '', 'Staff', 'BCA', 'PHP', 'Ella Wilson', 'ella.wilson@example.com', 'hodpass'),
(23, '', 'Teacher', 'BBA', 'DBMS', 'Emily Davis', 'emily@example.com', '123'),
(25, '', 'Teacher', 'BA', 'PHP', 'Sophie Martin', 'sophie@example.com', '123'),
(27, '', 'Student', 'BA', 'SQL', 'sandeep1', 'sandeep1@gmail.com', '123'),
(28, '', 'Student', 'BBA', 'PHP', 'dfadffgf', 'adfadfafdd111@gmail.com', 'FDFDD'),
(29, '', 'Student', 'BA', 'Philosophy', 'dfadffgf1111', 'adfadfaf111111@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `Permissionsrole` varchar(255) DEFAULT NULL,
  `Permissionsname` varchar(255) DEFAULT NULL,
  `CheckboxValues` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `Permissionsrole`, `Permissionsname`, `CheckboxValues`) VALUES
(1, 'HOD', '', 'timetable_view');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL,
  `roles_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles_id`, `roles_name`) VALUES
(1, 'Admin'),
(6, 'HOD'),
(4, 'Staff'),
(3, 'Student'),
(5, 'Super_Admin'),
(2, 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(200) NOT NULL,
  `class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `class_id`) VALUES
(1, 'JAVA', 1),
(2, 'PHP', 1),
(3, 'SQL', 1),
(4, 'DBMS', 1),
(5, 'Statistics', 2),
(19, 'Business Economics', 2),
(20, 'Management Accounting', 2),
(21, 'Security Analysis.', 2),
(22, 'B.Com Accountancy', 3),
(23, 'B.Com Taxation', 3),
(24, 'Financial accounting', 3),
(25, 'Banking and Insurance', 3),
(26, 'Philosophy', 4),
(27, 'Sociology', 4),
(28, 'History', 4),
(29, 'Political Science\r\n', 4);

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

CREATE TABLE `time_table` (
  `time_table_id` int(11) NOT NULL,
  `value_id_name` varchar(200) NOT NULL,
  `data_time` varchar(200) NOT NULL,
  `Date` varchar(200) NOT NULL,
  `teacher_name` varchar(200) NOT NULL,
  `subject_name` varchar(200) NOT NULL,
  `class_name` varchar(255) DEFAULT NULL,
  `delete_by` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_table`
--

INSERT INTO `time_table` (`time_table_id`, `value_id_name`, `data_time`, `Date`, `teacher_name`, `subject_name`, `class_name`, `delete_by`) VALUES
(1, 'MONDAY_1', '09:00-10:00', '05 January, 2024', 'dfadffgf', 'JAVA', 'BA', 'mouryasumit1056@gmail.com'),
(2, 'SATURDAY_2', '10:00-11:00', '05 January, 2024', 'HOD Person', 'JAVA', 'BA', 'mouryasumit1056@gmail.com'),
(3, 'WEDNESDAY_3', '11:00-12:00', '05 January, 2024', 'HOD Person', 'JAVA', 'BA', 'mouryasumit1056@gmail.com'),
(4, 'TUESDAY_5', '1:00-2:00', '05 January, 2024', 'Michael Johnson', 'JAVA', 'BA', 'mouryasumit1056@gmail.com'),
(5, 'WEDNESDAY_2', '10:00-11:00', '05 January, 2024', 'Michael Johnson', 'JAVA', 'BBA', 'mouryasumit1056@gmail.com'),
(6, 'MONDAY_1', '09:00-10:00', '05 January, 2024', 'HOD Person', 'JAVA', 'BBA', 'mouryasumit1056@gmail.com'),
(7, 'MONDAY_3', '11:00-12:00', '05 January, 2024', 'Michael Johnson', 'PHP', 'BBA', 'mouryasumit1056@gmail.com'),
(8, 'SATURDAY_4', '12:00-1:00', '05 January, 2024', 'Michael Johnson', 'DBMS', 'BA', 'mouryasumit1056@gmail.com'),
(9, 'FRIDAY_4', '12:00-1:00', '05 January, 2024', 'Daniel Miller', 'PHP', 'BBA', 'mouryasumit1056@gmail.com'),
(10, 'THURSDAY_5', '1:00-2:00', '05 January, 2024', 'William Harris', 'JAVA', 'BBA', 'mouryasumit1056@gmail.com'),
(11, 'SATURDAY_1', '09:00-10:00', '05 January, 2024', 'William Harris', 'PHP', 'BCA', 'mouryasumit1056@gmail.com'),
(12, 'TUESDAY_4', '12:00-1:00', '05 January, 2024', 'Michael Johnson', 'JAVA', 'BCOM', 'mouryasumit1056@gmail.com'),
(13, 'FRIDAY_1', '09:00-10:00', '05 January, 2024', 'dfadffgf', 'SQL', 'BCOM', 'mouryasumit1056@gmail.com'),
(14, 'SATURDAY_5', '1:00-2:00', '05 January, 2024', 'Michael Johnson', 'JAVA', 'BCOM', 'mouryasumit1056@gmail.com'),
(15, 'FRIDAY_2', '10:00-11:00', '05 January, 2024', 'Daniel Miller', 'PHP', 'BCOM', 'mouryasumit1056@gmail.com'),
(16, 'WEDNESDAY_1', '09:00-10:00', '05 January, 2024', 'dfadffgf', 'PHP', 'BA', 'mouryasumit1056@gmail.com'),
(17, 'MONDAY_3', '11:00-12:00', '05 January, 2024', 'Michael Johnson', 'JAVA', 'BA', 'mouryasumit1056@gmail.com'),
(18, 'FRIDAY_1', '09:00-10:00', '05 January, 2024', 'Michael Johnson', 'PHP', 'BA', 'mouryasumit1056@gmail.com'),
(19, 'THURSDAY_3', '11:00-12:00', '05 January, 2024', 'HOD Person', 'DBMS', 'BCOM', 'mouryasumit1056@gmail.com'),
(20, 'MONDAY_1', '09:00-10:00', '05 January, 2024', 'Michael Johnson', 'DBMS', 'BCOM', 'mouryasumit1056@gmail.com'),
(21, 'TUESDAY_2', '10:00-11:00', '05 January, 2024', 'Michael Johnson', 'DBMS', 'BCOM', 'mouryasumit1056@gmail.com'),
(22, 'TUESDAY_5', '1:00-2:00', '05 January, 2024', 'dfadffgf', 'DBMS', 'BCOM', 'mouryasumit1056@gmail.com'),
(23, 'SATURDAY_3', '11:00-12:00', '05 January, 2024', 'dfadffgf', 'JAVA', 'BCOM', 'mouryasumit1056@gmail.com'),
(24, 'MONDAY_4', '12:00-1:00', '05 January, 2024', 'dfadffgf', 'JAVA', 'BCOM', 'mouryasumit1056@gmail.com'),
(25, 'TUESDAY_2', '10:00-11:00', '05 January, 2024', 'Michael Johnson', 'JAVA', 'BCA', 'mouryasumit1056@gmail.com'),
(26, 'FRIDAY_3', '11:00-12:00', '05 January, 2024', 'dfadffgf', 'PHP', 'BCA', 'mouryasumit1056@gmail.com'),
(27, 'WEDNESDAY_5', '1:00-2:00', '05 January, 2024', 'Michael Johnson', 'JAVA', 'BCA', 'mouryasumit1056@gmail.com'),
(28, 'THURSDAY_4', '12:00-1:00', '05 January, 2024', 'Michael Johnson', 'JAVA', 'BCA', 'mouryasumit1056@gmail.com'),
(33, 'WEDNESDAY_2', '10:00-11:00', '09 January, 2024', 'dfadffgf', 'PHP', 'BCA', 'superadmin@example.com'),
(34, 'WEDNESDAY_2', '10:00-11:00', '09 January, 2024', 'dfadffgf', 'PHP', 'BCA', 'superadmin@example.com'),
(35, 'WEDNESDAY_2', '10:00-11:00', '09 January, 2024', 'dfadffgf', 'PHP', 'BCA', 'superadmin@example.com'),
(36, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(37, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(38, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(39, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(40, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(41, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(42, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(43, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(44, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(45, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(46, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com'),
(47, 'MONDAY_1', '09:00-10:00', '09 January, 2024', 'William Harris', 'PHP', 'BCA', 'superadmin@example.com');

--
-- Triggers `time_table`
--
DELIMITER $$
CREATE TRIGGER `after_delete_time_table_trigger` AFTER DELETE ON `time_table` FOR EACH ROW BEGIN
    -- Store the deleted data in the deleted_time_table table
    INSERT INTO deleted_time_table (time_table_id, value_id_name, data_time, Date, teacher_name, subject_name, class_name, delete_by)
    VALUES (OLD.time_table_id, OLD.value_id_name, OLD.data_time, OLD.Date, OLD.teacher_name, OLD.subject_name, OLD.class_name, OLD.delete_by);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `roles_id` varchar(200) DEFAULT NULL,
  `class_id` varchar(200) DEFAULT NULL,
  `subject_id` varchar(200) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roles_id`, `class_id`, `subject_id`, `name`, `email`, `password`) VALUES
(1, 'Staff', 'BCA', 'JAVA', 'Alice Williams', 'midij79457@apdiv.com', '123'),
(2, 'Super_Admin', 'BCOM', 'JAVA', 'Super Admin', 'superadmin@example.com', '123'),
(3, 'HOD', 'BA', 'JAVA', 'HOD Person', 'hod@example.com', '123'),
(4, 'Teacher', 'BCA', 'Java', 'Michael Johnson', 'michael@example.com', '123'),
(5, 'HOD', 'BBA', 'PHP', 'dfadffgf', 'adfadfaf@gmail.com', '123'),
(6, 'Super_Admin', 'BBA', 'JAVA', 'sumit', 'moryasumit1056@gmail.com', '123'),
(8, 'Staff', 'BCA', 'PHP', 'Emma Thompson', 'emma.thompson@example.com', '123'),
(9, 'HOD', 'BBA', 'PHP', 'Daniel Miller', 'daniel.miller@example.com', 'pass456'),
(10, 'Staff', 'BBA', 'PHP', 'Sophie Davis', 'sophie.davis@example.com', '123'),
(11, 'Student', 'BCOM', 'PHP', 'Oliver Brown', 'oliver.brown@example.com', '123'),
(13, 'Staff', 'BA', 'JAVA', 'James Lee', 'james.lee@example.com', 'teacher987'),
(14, 'Admin', 'BCA', 'JAVA', 'Ava Robinson', 'ava.robinson@example.com', '123'),
(15, 'Super_Admin', 'BCA', 'PHP', 'Benjamin Turner', 'benjamin.turner@example.com', 'staffpass'),
(16, 'Super_Admin', 'BBA', 'SQL', 'Mia Wright', 'mia.wright@example.com', 'student321'),
(17, 'HOD', 'BCOM', 'DBMS', 'William Harris', 'william.harris@example.com', 'hod987'),
(18, 'Student', 'BBA', 'PHP', 'Isabella Moore', 'isabella.moore@example.com', 'pass789'),
(19, 'Staff', 'BCA', 'SQL', 'Liam Davis', 'liam.davis@example.com', 'student555'),
(20, 'Student', 'BBA', 'PHP', 'Olivia Turner', 'olivia.turner@example.com', 'olivia123'),
(21, 'Super_Admin', 'BA', 'PHP', 'Noah Robinson', 'noah.robinson@example.com', '123'),
(22, 'Teacher', 'BBA', 'JAVA', 'Sophia Harris', 'sophia.harris@example.com', 'sophia456'),
(23, 'Super_Admin', 'BBA', 'DBMS', 'Jackson Wright', 'jackson.wright@example.com', 'jacksonpass'),
(24, 'Super_Admin', 'BCA', 'PHP', 'Ava Thompson', 'ava.thompson@example.com', 'avapass'),
(25, 'Student', 'BBA', 'PHP', 'Lucas Miller', 'lucas.miller@example.com', 'lucas789'),
(26, 'Admin', 'BCA', 'JAVA', 'sumit1056', 'mouryasumit09365@gmail.com', '123');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_delete_users_trigger` AFTER DELETE ON `users` FOR EACH ROW BEGIN
    -- Store the deleted data in the deleted_users table
    INSERT INTO deleted_users (id, roles_id, class_id, subject_id, name, email, password)
    VALUES (OLD.id, OLD.roles_id, OLD.class_id, OLD.subject_id, OLD.name, OLD.email, OLD.password);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_name` (`class_name`);

--
-- Indexes for table `deleted_time_table`
--
ALTER TABLE `deleted_time_table`
  ADD PRIMARY KEY (`time_table_id`);

--
-- Indexes for table `deleted_users`
--
ALTER TABLE `deleted_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`),
  ADD KEY `roles_name` (`roles_name`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `idx_subject_name` (`subject_name`),
  ADD UNIQUE KEY `idx_subject_name_unique` (`subject_name`),
  ADD UNIQUE KEY `uc_subject_name` (`subject_name`),
  ADD KEY `fk_subject_class` (`class_id`);

--
-- Indexes for table `time_table`
--
ALTER TABLE `time_table`
  ADD PRIMARY KEY (`time_table_id`),
  ADD KEY `fk_subject_name` (`subject_name`),
  ADD KEY `fk_time_table_classes` (`class_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_roles` (`roles_id`),
  ADD KEY `fk_users_classes` (`class_id`),
  ADD KEY `fk_users_subject` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `time_table`
--
ALTER TABLE `time_table`
  MODIFY `time_table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_subject_class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Constraints for table `time_table`
--
ALTER TABLE `time_table`
  ADD CONSTRAINT `fk_subject_name` FOREIGN KEY (`subject_name`) REFERENCES `subject` (`subject_name`),
  ADD CONSTRAINT `fk_time_table_classes` FOREIGN KEY (`class_name`) REFERENCES `classes` (`class_name`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_classes` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_name`),
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`roles_name`),
  ADD CONSTRAINT `fk_users_subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
