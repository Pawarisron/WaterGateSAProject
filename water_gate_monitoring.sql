-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3001
-- Generation Time: Nov 25, 2023 at 01:19 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `water_gate_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_time`
--

CREATE TABLE `assign_time` (
  `cmd_ID` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `manager_ID` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `cmd_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cmd_route`
--

CREATE TABLE `cmd_route` (
  `cmd_ID` varchar(255) NOT NULL,
  `cmd_order` varchar(255) NOT NULL,
  `from_ID_gate` varchar(255) NOT NULL,
  `to_ID_gate` varchar(255) NOT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `commands_log`
--

CREATE TABLE `commands_log` (
  `cmd_ID` varchar(255) NOT NULL,
  `cmd_order` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `open_time` timestamp NULL DEFAULT NULL,
  `close_time` timestamp NULL DEFAULT NULL,
  `staff_ID` varchar(255) DEFAULT NULL,
  `cmd_status` tinyint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `daily_report`
--

CREATE TABLE `daily_report` (
  `report_ID` int(11) NOT NULL,
  `employee_ID` varchar(255) NOT NULL,
  `watergate_ID` varchar(255) NOT NULL,
  `upstream` float NOT NULL,
  `downstream` float NOT NULL,
  `flow_rate` float NOT NULL,
  `report_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_report`
--

INSERT INTO `daily_report` (`report_ID`, `employee_ID`, `watergate_ID`, `upstream`, `downstream`, `flow_rate`, `report_time`) VALUES
(1, 'E099', 'WG11101', 1.5, 1.3, 1, '2023-11-01 13:11:42'),
(2, 'E099', 'WG11101', 1.45, 1.28, 1.2, '2023-11-02 13:09:42'),
(3, 'E099', 'WG11101', 1.5, 1.32, 0.02, '2023-11-03 13:12:02'),
(4, 'E099', 'WG11102', 2.46, 2.09, 16.24, '2023-11-05 13:15:36'),
(5, 'E099', 'WG11102', 2.53, 2.18, 16.42, '2023-11-06 13:08:36'),
(6, 'E099', 'WG11101', 2.4, 1.5, 1.35, '2023-11-05 13:11:22'),
(7, 'E001', 'WG11101', 1.65, 1.38, 2.1, '2023-11-06 13:08:32'),
(8, 'E001', 'WG11103', 2.46, 2.04, 5.1, '2023-11-07 23:00:09'),
(9, 'E001', 'WG11104', 2.47, 2.41, 0.1, '2023-11-05 17:28:25'),
(10, 'E001', 'WG11104', 2.45, 2.27, 0.1, '2023-11-06 13:15:29'),
(11, 'E001', 'WG11104', 2.34, 2.22, 0.1, '2023-11-07 13:15:29'),
(12, 'E001', 'WG11104', 2.28, 2.23, 0.1, '2023-11-08 17:23:03'),
(13, 'E001', 'WG11105', 2.24, 2.23, 1.2, '2023-11-08 03:11:17'),
(14, 'E001', 'WG11202', 2.11, 2.98, 12.0, '2023-11-05 17:41:52'),
(15, 'E001', 'WG11208', 6.15, 0.4, 1.4, '2023-11-05 17:41:52'),
(16, 'E002', 'WG11105', 2.24, 2.23, 1.2, '2023-11-08 08:13:24'),
(17, 'E009', 'WG11106', 2.33, 2.58, 1.2, '2023-11-06 17:41:00'),
(18, 'E003', 'WG11106', 2.15, 0.2, 3, '2023-11-07 17:41:52'),
(19, 'E002', 'WG11107', 0.58, 0.9, 0.33, '2023-11-06 17:41:52'),
(20, 'E005', 'WG11107', 1.55, 3.22, 1.54, '2023-11-07 17:41:52'),
(21, 'E008', 'WG11108', 2.68, 2.65, 2.2, '2023-11-06 17:41:52'),
(22, 'E003', 'WG11108', 2.84, 4.6, 1.236, '2023-11-07 17:41:52'),
(23, 'E002', 'WG11109', 3.145, 3.3, 1.65, '2023-11-06 17:41:52'),
(24, 'E001', 'WG11109', 3.01, 3.6, 2.2, '2023-11-07 17:41:52'),
(25, 'E009', 'WG11202', 2.10, 2.91, 11.9, '2023-11-06 17:37:00'),
(26, 'E008', 'WG11202', 2.14, 2.89, 12.0, '2023-11-07 17:41:52'),
(27, 'E010', 'WG11203', 1.60, 2.25, 15, '2023-11-06 17:32:24'),
(28, 'E010', 'WG11203', 1.62, 2.19, 18, '2023-11-07 17:41:52'),
(29, 'E008', 'WG11204', 2.05, 2.00, 0.1, '2023-11-06 17:41:52'),
(30, 'E008', 'WG11204', 2.09, 2.04, 0.1, '2023-11-07 17:41:52'),
(31, 'E009', 'WG11205', 1.62, 1.61, 9.85, '2023-11-06 17:41:52'),
(32, 'E007', 'WG11205', 1.61, 1.60, 9.85, '2023-11-07 17:41:52'),
(33, 'E005', 'WG11206', 1.57, 0.84, 2.95, '2023-11-06 17:41:52'),
(34, 'E003', 'WG11206', 1.58, 0.83, 2.99, '2023-11-07 17:41:52'),
(35, 'E004', 'WG11207', 0.545, 0.548, 1, '2023-11-06 17:41:52'),
(36, 'E004', 'WG11207', 1.60, 1.545, 0.65, '2023-11-07 17:41:52'),
(37, 'E002', 'WG11208', 1.47, 1.46, 1.26, '2023-11-06 17:41:52'),
(38, 'E001', 'WG11208', 1.48, 1.45, 1.26, '2023-11-07 17:41:52'),
(39, 'E003', 'WG11209', 1.88, 1.77, 2.0, '2023-11-06 17:41:52'),
(40, 'E005', 'WG11209', 1.90, 1.70, 2.2, '2023-11-07 17:41:52'),
(41, 'E008', 'WG11210', 1.89, 1.89, 1.26, '2023-11-06 17:41:52'),
(42, 'E009', 'WG11210', 1.91, 1.91, 1.265, '2023-11-07 17:41:52'),
(43, 'E004', 'WG11211', 1.91, 1.90, 0.02, '2023-11-06 17:41:52'),
(44, 'E008', 'WG11211', 1.94, 1.88, 0.05, '2023-11-07 17:41:52'),
(45, 'E007', 'WG11212', 2.27, 2.21, 1.2, '2023-11-06 17:41:52'),
(46, 'E006', 'WG11212', 1.18, 2.24, 1.4, '2023-11-07 17:41:52'),
(47, 'E005', 'WG11213', 1.51, 1.22, 1, '2023-11-06 17:41:52'),
(48, 'E003', 'WG11213', 1.23, 1.25, 1, '2023-11-07 17:41:52'),
(49, 'E005', 'WG11214', 1.55, 1.48, 1.265, '2023-11-06 17:41:52'),
(50, 'E009', 'WG11214', 1.57, 1.59, 0.66, '2023-11-07 17:41:52'),
(51, 'E008', 'WG11215', 1.57, 1.57, 0.5, '2023-11-06 17:41:52'),
(52, 'E001', 'WG11215', 1.62, 1.62, 1.5, '2023-11-07 17:41:52'),
(53, 'E001', 'WG11216', 1.45, 1.45, 0.2, '2023-11-06 17:41:52'),
(54, 'E001', 'WG11216', 1.51, 1.51, 0.25, '2023-11-07 17:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_ID` varchar(255) NOT NULL,
  `employee_Fname` varchar(255) NOT NULL,
  `employee_Lname` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_ID`, `employee_Fname`, `employee_Lname`, `role`, `password`) VALUES
('E001', 'Simeon', 'Harding', 'EMPLOYEE', '1234'),
('E002', 'Theo', 'Kidd', 'EMPLOYEE', 'Theo123'),
('E003', 'Maddison', 'Ibarra', 'EMPLOYEE', 'Maddison123'),
('E004', 'Theo', 'Kidd', 'EMPLOYEE', 'Theo123'),
('E005', 'Bailey', 'Paul', 'EMPLOYEE', 'Bailey123'),
('E006', 'Hermione', 'Waller', 'EMPLOYEE', 'Hermione123'),
('E007', 'Phoebe', 'White', 'EMPLOYEE', 'Phoebe123'),
('E008', 'Taylor', 'Singleton', 'EMPLOYEE', 'Taylor123'),
('E009', 'Georgina', 'Estes', 'EMPLOYEE', 'Georgina123'),
('E010', 'Deacon', 'Duran', 'EMPLOYEE', 'Deacon123'),
('E099', 'ชื่อต้น A', 'นามสกุล A', 'EMPLOYEE', '1234'),
('M001', 'Naradon', 'Duangwoa', 'MANAGER', '123456789'),
('M002', 'Pawarisron', 'Wittaya', 'MANAGER', '1212312121'),
('M003', 'Kylie', 'Gray', 'MANAGER', '4dligl5');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `to_ID_gate` varchar(255) NOT NULL,
  `from_ID_gate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`to_ID_gate`, `from_ID_gate`) VALUES
('WG11101', 'WG11104'),
('WG11103', 'WG11102'),
('WG11103', 'WG11106'),
('WG11103', 'WG11107'),
('WG11103', 'WG11108'),
('WG11103', 'WG11109'),
('WG11105', 'WG11104'),
('WG11106', 'WG11104'),
('WG11107', 'WG11104'),
('WG11108', 'WG11104'),
('WG11109', 'WG11104'),
('WG11202', 'WG11105'),
('WG11202', 'WG11106'),
('WG11202', 'WG11107'),
('WG11202', 'WG11108'),
('WG11202', 'WG11109'),
('WG11203', 'WG11103'),
('WG11205', 'WG11105'),
('WG11206', 'WG11205'),
('WG11207', 'WG11205'),
('WG11208', 'WG11202'),
('WG11209', 'WG11106'),
('WG11210', 'WG11107'),
('WG11211', 'WG11108'),
('WG11212', 'WG11109'),
('WG11213', 'WG11103'),
('WG11213', 'WG11205'),
('WG11214', 'WG11103'),
('WG11214', 'WG11205'),
('WG11215', 'WG11103'),
('WG11215', 'WG11205'),
('WG11216', 'WG11103'),
('WG11216', 'WG11205');

-- --------------------------------------------------------

--
-- Table structure for table `watergate`
--

CREATE TABLE `watergate` (
  `watergate_ID` varchar(255) NOT NULL,
  `gate_name` varchar(255) NOT NULL,
  `gate_status` int(1) NOT NULL DEFAULT '0',
  `water_source_name` varchar(255) DEFAULT NULL,
  `criterion` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `watergate`
--

INSERT INTO `watergate` (`watergate_ID`, `gate_name`, `gate_status`, `water_source_name`, `criterion`) VALUES
('WG11101', 'ปตร.เชียงรากน้อย', 0, 'แม่น้ำเจ้าพระยา', 3.2),
('WG11102', 'ปตร.พระธรรม (เดิม+ใหม่)', 1, 'คลองระพีพัฒน์แยกใต', 3.2),
('WG11103', 'ไซฟ่อนพระธรรมราชา', 1, 'คลองรังสิตประยูรศักดิ์', 2.18),
('WG11104', 'ปตร.พระอินทราชา', 0, 'คลองระพีพัฒน์แยกตก', 3.2),
('WG11105', 'ปตร.กลางคลอง 1', 1, 'คลอง1', 2.2),
('WG11106', 'ปตร.ปลายคลอง 6', 0, 'คลอง6', 2.6),
('WG11107', 'ปตร.ปลายคลอง 8', 0, 'คลอง8', 2.8),
('WG11108', 'ปตร.ปลายคลอง 9', 1, 'คลอง9', 2.8),
('WG11109', 'ปตร.ปลายคลอง 10', 0, 'คลอง10', 3.2),
('WG11202', 'ปตร.สน.จุฬาลงกรณ์', 1, 'คลองรังสิตประยูรศักด', 1.3),
('WG11203', 'ปตร.สน.เสาวภาผ่องศรี', 1, 'ปตร.สน.สมบูรณ์', 1.5),
('WG11204', 'ปตร.สน.สมบูรณ์', 1, 'คลองหกวาสายล่าง', 1.3),
('WG11205', 'ปตร.หกวา', 1, 'คลอง13', 1.3),
('WG11206', 'ปตร.บึงฝรั่ง', 0, 'คลองบึงฝรั่ง', 1.3),
('WG11207', 'ปตร.ปลายคลอง 13', 1, 'คลอง13', 1.3),
('WG11208', 'ปตร.เปรมใต้', 0, 'คลองเปรมประชากร', 1.7),
('WG11209', 'ปตร.ปลายคลอง 6', 1, 'คลอง6', 1.3),
('WG11210', 'ปตร.กลางคลอง 8', 1, 'คลอง8', 1.3),
('WG11211', 'ปตร.กลางคลอง 9', 1, 'คลอง9', 1.3),
('WG11212', 'ปตร.กลางคลอง 10', 1, 'คลอง10', 1.3),
('WG11213', 'ปตร.ปลายคลอง 14', 0, 'คลอง14', 1.3),
('WG11214', 'ปตร.ปลายคลอง 15', 1, 'คลอง15', 1.3),
('WG11215', 'ปตร.ปลายคลอง 16', 1, 'คลอง16', 1.3),
('WG11216', 'ปตร.ปลายคลอง 17', 1, 'คลอง17', 1.3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_time`
--
ALTER TABLE `assign_time`
  ADD PRIMARY KEY (`cmd_ID`),
  ADD KEY `assign_time_ibfk_2` (`manager_ID`);

--
-- Indexes for table `cmd_route`
--
ALTER TABLE `cmd_route`
  ADD PRIMARY KEY (`cmd_ID`,`cmd_order`,`from_ID_gate`),
  ADD KEY `cmd_route_fk2` (`from_ID_gate`),
  ADD KEY `cmd_route_fk3` (`to_ID_gate`);

--
-- Indexes for table `commands_log`
--
ALTER TABLE `commands_log`
  ADD PRIMARY KEY (`cmd_ID`,`cmd_order`),
  ADD KEY `commands_log_ibfk_3` (`staff_ID`);

--
-- Indexes for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD PRIMARY KEY (`report_ID`),
  ADD KEY `daily_report_ibfk_1` (`employee_ID`),
  ADD KEY `daily_report_ibfk_2` (`watergate_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_ID`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`to_ID_gate`,`from_ID_gate`),
  ADD KEY `route_ibfk_1` (`to_ID_gate`),
  ADD KEY `from_ID_gate` (`from_ID_gate`);

--
-- Indexes for table `watergate`
--
ALTER TABLE `watergate`
  ADD PRIMARY KEY (`watergate_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_report`
--
ALTER TABLE `daily_report`
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_time`
--
ALTER TABLE `assign_time`
  ADD CONSTRAINT `assign_time_ibfk_1` FOREIGN KEY (`cmd_ID`) REFERENCES `commands_log` (`cmd_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assign_time_ibfk_2` FOREIGN KEY (`manager_ID`) REFERENCES `employee` (`employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cmd_route`
--
ALTER TABLE `cmd_route`
  ADD CONSTRAINT `cmd_route_fk1` FOREIGN KEY (`cmd_ID`,`cmd_order`) REFERENCES `commands_log` (`cmd_ID`, `cmd_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cmd_route_fk2` FOREIGN KEY (`from_ID_gate`) REFERENCES `route` (`from_ID_gate`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cmd_route_fk3` FOREIGN KEY (`to_ID_gate`) REFERENCES `route` (`to_ID_gate`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commands_log`
--
ALTER TABLE `commands_log`
  ADD CONSTRAINT `commands_log_ibfk_3` FOREIGN KEY (`staff_ID`) REFERENCES `employee` (`employee_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD CONSTRAINT `daily_report_ibfk_1` FOREIGN KEY (`employee_ID`) REFERENCES `employee` (`employee_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `daily_report_ibfk_2` FOREIGN KEY (`watergate_ID`) REFERENCES `watergate` (`watergate_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`to_ID_gate`) REFERENCES `watergate` (`watergate_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`from_ID_gate`) REFERENCES `watergate` (`watergate_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
