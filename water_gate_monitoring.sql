-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3001
-- Generation Time: Nov 13, 2023 at 03:57 PM
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

--
-- Dumping data for table `assign_time`
--

INSERT INTO `assign_time` (`cmd_ID`, `manager_ID`, `cmd_time`) VALUES
('CMD00001', 'M001', '2023-11-07 18:23:12'),
('CMD00002', 'M002', '2023-11-07 18:23:37');

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

--
-- Dumping data for table `cmd_route`
--

INSERT INTO `cmd_route` (`cmd_ID`, `cmd_order`, `from_ID_gate`, `to_ID_gate`, `amount`) VALUES
('CMD00001', '1', 'WG11105', 'WG11103', 1),
('CMD00001', '2', 'WG11104', 'WG11101', 0.5),
('CMD00001', '3', 'WG11105', 'WG11108', 0.89),
('CMD00002', '1', 'WG11104', 'WG11105', 0.2),
('CMD00002', '2', 'WG11104', 'WG11106', 1);

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

--
-- Dumping data for table `commands_log`
--

INSERT INTO `commands_log` (`cmd_ID`, `cmd_order`, `note`, `open_time`, `close_time`, `staff_ID`, `cmd_status`) VALUES
('CMD00001', '1', 'ควรเปิดประตู คลอง8 ตอนเวลา ตอนเวลา 11/11/66 18:00 และปิดอีก 2 ชม. ', NULL, NULL, 'E003', 0),
('CMD00001', '2', 'ควรเปิดประตู คลองระพีพัฒน์แยกตก ตอนเวลา 11/11/66 18:00 และปิดอีก 2 ชม. ', NULL, NULL, 'E002', 0),
('CMD00001', '3', 'นี่คือประตูสุดท้ายของคำสั่ง CMD00001 ไม่ต้องกระทำการใดๆต่อ', NULL, NULL, 'E004', 0),
('CMD00002', '1', 'เปิดประตู แม่น้ำเจ้าพระยา จำนวน 1.5', '2023-11-11 14:28:00', '2023-11-18 14:28:00', 'E008', 1),
('CMD00002', '2', 'นี่คือประตูสุดท้ายของคำสั่ง CMD00002 ไม่ต้องกระทำการใดๆต่อ ', NULL, NULL, 'E009', 0);

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
(1, 'E099', 'WG11101', 1, 0.5, 3.15, '2023-08-01 16:53:48'),
(2, 'E099', 'WG11101', 2.7, 2.1, 1.2, '2023-08-01 19:47:00'),
(3, 'E099', 'WG11101', 3.5, 2.6, 2.52, '2023-08-03 08:18:00'),
(4, 'E099', 'WG11102', 1.1, 2.9, 1.2, '2023-08-04 11:01:00'),
(5, 'E099', 'WG11102', 5, 5, 1.665, '2023-08-05 11:59:00'),
(6, 'E099', 'WG11101', 2.4, 3.35, 4.25, '2023-08-06 12:02:00'),
(7, 'E001', 'WG11101', 2.8, 2.5, 2.8, '2023-11-04 17:41:52'),
(8, 'E001', 'WG11103', 4.6, 3.14, 3.7, '2023-11-07 17:41:52'),
(9, 'E001', 'WG11104', 2.23, 5.9, 3.54, '2023-11-06 17:41:52'),
(10, 'E001', 'WG11104', 3.2, 1.35, 2.15, '2023-11-07 17:41:52'),
(11, 'E001', 'WG11104', 2.65, 1.1, 3.2, '2023-11-06 17:41:52'),
(12, 'E001', 'WG11104', 2.15, 0.1, 1.1, '2023-11-07 17:41:52'),
(13, 'E001', 'WG11105', 1.25, 0.2, 1.2, '2023-11-06 17:41:52'),
(14, 'E001', 'WG11202', 5.36, 0.3, 1.3, '2023-11-07 17:41:52'),
(15, 'E001', 'WG11208', 6.15, 0.4, 1.4, '2023-11-05 17:41:52'),
(16, 'E002', 'WG11105', 3, 2, 2.3, '2023-11-07 17:41:52'),
(17, 'E009', 'WG11106', 2.33, 2.58, 1.2, '2023-11-06 17:41:00'),
(18, 'E003', 'WG11106', 2.15, 0.2, 3, '2023-11-07 17:41:52'),
(19, 'E002', 'WG11107', 0.58, 0.9, 0.33, '2023-11-06 17:41:52'),
(20, 'E005', 'WG11107', 1.55, 3.22, 1.54, '2023-11-07 17:41:52'),
(21, 'E008', 'WG11108', 2.68, 2.65, 2.2, '2023-11-06 17:41:52'),
(22, 'E003', 'WG11108', 2.84, 4.6, 1.236, '2023-11-07 17:41:52'),
(23, 'E002', 'WG11109', 3.145, 3.3, 1.65, '2023-11-06 17:41:52'),
(24, 'E001', 'WG11109', 3.01, 3.6, 2.2, '2023-11-07 17:41:52'),
(25, 'E009', 'WG11202', 2.63, 3.4, 1.03, '2023-11-07 17:41:52'),
(26, 'E008', 'WG11202', 4.25, 5.4, 2.2, '2023-11-07 17:41:52'),
(27, 'E010', 'WG11203', 3.25, 3.25, 1.36, '2023-11-07 17:41:52'),
(28, 'E010', 'WG11203', 4.145, 3.14, 1.26, '2023-11-07 17:41:52'),
(29, 'E008', 'WG11204', 3.25, 1.8, 1.26, '2023-11-07 17:41:52'),
(30, 'E008', 'WG11204', 4.52, 4.25, 2.326, '2023-11-07 17:41:52'),
(31, 'E009', 'WG11205', 5.6, 2.5, 2.26, '2023-11-06 17:41:52'),
(32, 'E007', 'WG11205', 5.25, 4.1, 0.16, '2023-11-07 17:41:52'),
(33, 'E005', 'WG11206', 6.15, 6.5, 1.66, '2023-11-06 17:41:52'),
(34, 'E003', 'WG11206', 1.268, 0.25, 2, '2023-11-07 17:41:52'),
(35, 'E004', 'WG11207', 0.545, 0.548, 1, '2023-11-06 17:41:52'),
(36, 'E004', 'WG11207', 1.66, 1.545, 0.65, '2023-11-07 17:41:52'),
(37, 'E002', 'WG11208', 1.32, 1.13, 1.26, '2023-11-06 17:41:52'),
(38, 'E001', 'WG11208', 1.99, 2.5, 1.26, '2023-11-07 17:41:52'),
(39, 'E003', 'WG11209', 0.9, 0.58, 1.65, '2023-11-06 17:41:52'),
(40, 'E005', 'WG11209', 2.65, 2.54, 2.2, '2023-11-07 17:41:52'),
(41, 'E008', 'WG11210', 3.159, 4.52, 1.26, '2023-11-06 17:41:52'),
(42, 'E009', 'WG11210', 4.554, 2.18, 1.265, '2023-11-07 17:41:52'),
(43, 'E004', 'WG11211', 3.56, 4.23, 3.221, '2023-11-06 17:41:52'),
(44, 'E008', 'WG11211', 5.36, 5.64, 1.26, '2023-11-07 17:41:52'),
(45, 'E007', 'WG11212', 1.26, 2.12, 2.26, '2023-11-06 17:41:52'),
(46, 'E006', 'WG11212', 3.264, 3, 0.64, '2023-11-07 17:41:52'),
(47, 'E005', 'WG11213', 2.56, 2, 1.26, '2023-11-06 17:41:52'),
(48, 'E003', 'WG11213', 1.25, 1, 1.15, '2023-11-07 17:41:52'),
(49, 'E005', 'WG11214', 3.5, 6, 1.265, '2023-11-06 17:41:52'),
(50, 'E009', 'WG11214', 4.25, 3.5, 0.66, '2023-11-07 17:41:52'),
(51, 'E008', 'WG11215', 3.14, 2.5, 0.5, '2023-11-06 17:41:52'),
(52, 'E001', 'WG11215', 3.14259, 5.6, 1.5, '2023-11-07 17:41:52'),
(53, 'E001', 'WG11216', 2.556, 1.6, 0.2, '2023-11-06 17:41:52'),
(54, 'E001', 'WG11216', 6, 6.2, 3, '2023-11-07 17:41:52'),
(55, 'E001', 'WG11101', 0, 0.25, -50, '2023-11-06 17:41:52'),
(56, 'E001', 'WG11101', 0, 0, 0, '2023-11-07 17:41:52');

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
('WG11106', 'ปตร.ปลายคลอง 6', 1, 'คลอง6', 2.6),
('WG11107', 'ปตร.ปลายคลอง 8', 1, 'คลอง8', 2.8),
('WG11108', 'ปตร.ปลายคลอง 9', 1, 'คลอง9', 2.8),
('WG11109', 'ปตร.ปลายคลอง 10', 0, 'คลอง10', 3.2),
('WG11202', 'ปตร.สน.จุฬาลงกรณ์', 1, 'คลองรังสิตประยูรศักด', 1.3),
('WG11203', 'ปตร.สน.เสาวภาผ่องศรี', 1, 'ปตร.สน.สมบูรณ์', 1.5),
('WG11204', 'ปตร.สน.สมบูรณ์', 1, 'คลองหกวาสายล่าง', 1.3),
('WG11205', 'ปตร.หกวา', 1, 'คลอง13', 1.3),
('WG11206', 'ปตร.บึงฝรั่ง', 0, 'คลองบึงฝรั่ง', 1.3),
('WG11207', 'ปตร.ปลายคลอง 13', 1, 'คลอง13', 1.3),
('WG11208', 'ปตร.เปรมใต้', 1, 'คลองเปรมประชากร', 1.7),
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
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
  ADD CONSTRAINT `cmd_route_fk2` FOREIGN KEY (`from_ID_gate`) REFERENCES `route` (`from_ID_gate`)ON DELETE CASCADE ON UPDATE CASCADE,
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
