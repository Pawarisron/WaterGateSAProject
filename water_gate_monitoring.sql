-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3001
-- Generation Time: Nov 05, 2023 at 07:55 PM
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
-- Table structure for table `commands_log`
--

CREATE TABLE `commands_log` (
  `command_ID` varchar(255) NOT NULL,
  `watergate_com_ID` varchar(255) NOT NULL,
  `employee_com_ID` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `open_time` timestamp NULL DEFAULT NULL,
  `close_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commands_log`
--

INSERT INTO `commands_log` (`command_ID`, `watergate_com_ID`, `employee_com_ID`, `note`, `amount`, `open_time`, `close_time`) VALUES
('ABC', 'WG11104', 'E001', 'ไม่รู้ๆ', 2, NULL, NULL),
('AWDAWD', 'WG11101', 'E001', 'HEHEHEHE', 5, '2023-11-11 14:28:00', '2023-11-18 14:28:00'),
('AWDAWD', 'WG11102', 'E001', 'HEHEHEHE\r\n', 6, '2023-11-04 14:41:00', '2023-11-04 14:41:00'),
('T', 'WG11101', 'E005', 't', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commands_log_time`
--

CREATE TABLE `commands_log_time` (
  `command_time_ID` varchar(255) NOT NULL,
  `command_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commands_log_time`
--

INSERT INTO `commands_log_time` (`command_time_ID`, `command_time`) VALUES
('ABC', '2023-11-05 13:33:59'),
('AWDAWD', '2023-10-25 16:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `daily_report`
--

CREATE TABLE `daily_report` (
  `report_ID` int(11) NOT NULL,
  `employee_report_ID` varchar(255) NOT NULL,
  `watergate_report_ID` varchar(255) NOT NULL,
  `upstream` float NOT NULL,
  `downstream` float NOT NULL,
  `flow_rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_report`
--

INSERT INTO `daily_report` (`report_ID`, `employee_report_ID`, `watergate_report_ID`, `upstream`, `downstream`, `flow_rate`) VALUES
(1, 'E099', 'WG11101', 1, 0.5, 50),
(2, 'E099', 'WG11101', 2.7, 2.1, 5),
(3, 'E099', 'WG11101', 332, 23, 123),
(4, 'E099', 'WG11102', 1.1, 2.9, 1.2),
(5, 'E099', 'WG11102', 5, 5, 5),
(6, 'E099', 'WG11101', 99, 99, 99),
(7, 'E001', 'WG11101', 2.8, 2.5, 28),
(8, 'E001', 'WG11103', 7, 7, 7),
(9, 'E001', 'WG11104', 8, 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `daily_report_time`
--

CREATE TABLE `daily_report_time` (
  `report_time_ID` int(11) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_report_time`
--

INSERT INTO `daily_report_time` (`report_time_ID`, `report_date`) VALUES
(1, '2023-10-25 16:53:48'),
(2, '2023-10-13 19:47:00'),
(3, '2023-10-12 08:18:00'),
(4, '2023-10-05 11:01:00'),
(5, '2023-10-28 11:59:00'),
(6, '2023-10-30 12:02:00'),
(7, '2023-11-03 20:20:00'),
(8, '2023-11-07 20:20:00'),
(9, '2023-11-23 01:21:00');

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
  `route_ID` varchar(255) NOT NULL,
  `to_ID_gate` varchar(255) NOT NULL,
  `from_ID_gate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_ID`, `to_ID_gate`, `from_ID_gate`) VALUES
('RT01', 'WG11101', 'WG11104'),
('RT02', 'WG11105', 'WG11104'),
('RT03', 'WG11106', 'WG11104'),
('RT04', 'WG11107', 'WG11104'),
('RT05', 'WG11108', 'WG11104'),
('RT06', 'WG11109', 'WG11104'),
('RT08', 'WG11202', 'WG11105'),
('RT09', 'WG11209', 'WG11106'),
('RT10', 'WG11210', 'WG11107'),
('RT11', 'WG11211', 'WG11108'),
('RT12', 'WG11212', 'WG11109'),
('RT13', 'WG11103', 'WG11106'),
('RT14', 'WG11103', 'WG11107'),
('RT15', 'WG11103', 'WG11108'),
('RT16', 'WG11103', 'WG11109'),
('RT17', 'WG11202', 'WG11106'),
('RT18', 'WG11202', 'WG11107'),
('RT19', 'WG11202', 'WG11108'),
('RT20', 'WG11202', 'WG11109'),
('RT21', 'WG11208', 'WG11202'),
('RT22', 'WG11205', 'WG11105'),
('RT23', 'WG11213', 'WG11103'),
('RT24', 'WG11214', 'WG11103'),
('RT25', 'WG11215', 'WG11103'),
('RT26', 'WG11216', 'WG11103'),
('RT27', 'WG11213', 'WG11205'),
('RT28', 'WG11214', 'WG11205'),
('RT29', 'WG11215', 'WG11205'),
('RT30', 'WG11216', 'WG11205'),
('RT31', 'WG11206', 'WG11205'),
('RT32', 'WG11207', 'WG11205'),
('RT33', 'WG11103', 'WG11102'),
('RT34', 'WG11203', 'WG11103'),
('RT35', 'WG11104', 'WG11105');

-- --------------------------------------------------------

--
-- Table structure for table `watergate`
--

CREATE TABLE `watergate` (
  `watergate_ID` varchar(255) NOT NULL,
  `gate_status` int(1) NOT NULL DEFAULT '0',
  `water_source_name` varchar(255) DEFAULT NULL,
  `criterion` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `watergate`
--

INSERT INTO `watergate` (`watergate_ID`, `gate_status`, `water_source_name`, `criterion`) VALUES
('WG11101', 0, 'แม่น้ำเจ้าพระยา', 3.2),
('WG11102', 1, 'คลองระพีพัฒน์แยกใต', 3.2),
('WG11103', 1, 'คลองรังสิตประยูรศักดิ์', 2.18),
('WG11104', 1, 'คลองระพีพัฒน์แยกตก', 3.2),
('WG11105', 0, 'คลอง1', 2.2),
('WG11106', 0, 'คลอง6', 2.6),
('WG11107', 0, 'คลอง8', 2.8),
('WG11108', 0, 'คลอง9', 2.8),
('WG11109', 0, 'คลอง10', 3.2),
('WG11202', 0, 'คลองรังสิตประยูรศักด', 1.3),
('WG11203', 0, 'ปตร.สน.สมบูรณ์', 1.5),
('WG11204', 0, 'คลองหกวาสายล่าง', 1.3),
('WG11205', 0, 'คลอง13', 1.3),
('WG11206', 0, 'คลองบึงฝรั่ง', 1.3),
('WG11207', 0, 'คลอง13', 1.3),
('WG11208', 0, 'คลองเปรมประชากร', 1.7),
('WG11209', 0, 'คลอง6', 1.3),
('WG11210', 0, 'คลอง8', 1.3),
('WG11211', 0, 'คลอง9', 1.3),
('WG11212', 0, 'คลอง10', 1.3),
('WG11213', 0, 'คลอง14', 1.3),
('WG11214', 0, 'คลอง15', 1.3),
('WG11215', 0, 'คลอง16', 1.3),
('WG11216', 0, 'คลอง17', 1.3);

-- --------------------------------------------------------

--
-- Table structure for table `watergate_name`
--

CREATE TABLE `watergate_name` (
  `watergate_name_ID` varchar(255) NOT NULL,
  `gate_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `watergate_name`
--

INSERT INTO `watergate_name` (`watergate_name_ID`, `gate_name`) VALUES
('WG11101', 'ปตร.เชียงรากน้อย'),
('WG11102', 'ปตร.พระธรรม (เดิม+ใหม่)'),
('WG11103', 'ไซฟ่อนพระธรรมราชา'),
('WG11104', 'ปตร.พระอินทราชา'),
('WG11105', 'ปตร.กลางคลอง 1'),
('WG11106', 'ปตร.ปลายคลอง 6'),
('WG11107', 'ปตร.ปลายคลอง 8'),
('WG11108', 'ปตร.ปลายคลอง 9'),
('WG11109', 'ปตร.ปลายคลอง 10'),
('WG11202', 'ปตร.สน.จุฬาลงกรณ์'),
('WG11203', 'ปตร.สน.เสาวภาผ่องศรี'),
('WG11204', 'ปตร.สน.สมบูรณ์'),
('WG11205', 'ปตร.หกวา'),
('WG11206', 'ปตร.บึงฝรั่ง'),
('WG11207', 'ปตร.ปลายคลอง 13'),
('WG11208', 'ปตร.เปรมใต้'),
('WG11209', 'ปตร.ปลายคลอง 6'),
('WG11210', 'ปตร.กลางคลอง 8'),
('WG11211', 'ปตร.กลางคลอง 9'),
('WG11212', 'ปตร.กลางคลอง 10'),
('WG11213', 'ปตร.ปลายคลอง 14'),
('WG11214', 'ปตร.ปลายคลอง 15'),
('WG11215', 'ปตร.ปลายคลอง 16'),
('WG11216', 'ปตร.ปลายคลอง 17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commands_log`
--
ALTER TABLE `commands_log`
  ADD PRIMARY KEY (`command_ID`,`watergate_com_ID`),
  ADD KEY `commands_log_ibfk_1` (`employee_com_ID`),
  ADD KEY `commands_log_ibfk_2` (`watergate_com_ID`);

--
-- Indexes for table `commands_log_time`
--
ALTER TABLE `commands_log_time`
  ADD PRIMARY KEY (`command_time_ID`);

--
-- Indexes for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD PRIMARY KEY (`report_ID`),
  ADD KEY `daily_report_ibfk_1` (`employee_report_ID`),
  ADD KEY `daily_report_ibfk_2` (`watergate_report_ID`);

--
-- Indexes for table `daily_report_time`
--
ALTER TABLE `daily_report_time`
  ADD PRIMARY KEY (`report_time_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_ID`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_ID`),
  ADD KEY `route_ibfk_1` (`to_ID_gate`),
  ADD KEY `from_ID_gate` (`from_ID_gate`);

--
-- Indexes for table `watergate`
--
ALTER TABLE `watergate`
  ADD PRIMARY KEY (`watergate_ID`);

--
-- Indexes for table `watergate_name`
--
ALTER TABLE `watergate_name`
  ADD PRIMARY KEY (`watergate_name_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_report`
--
ALTER TABLE `daily_report`
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commands_log`
--
ALTER TABLE `commands_log`
  ADD CONSTRAINT `commands_log_ibfk_1` FOREIGN KEY (`employee_com_ID`) REFERENCES `employee` (`employee_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `commands_log_ibfk_2` FOREIGN KEY (`watergate_com_ID`) REFERENCES `watergate` (`watergate_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `commands_log_time`
--
ALTER TABLE `commands_log_time`
  ADD CONSTRAINT `commands_log_time_ibfk_1` FOREIGN KEY (`command_time_ID`) REFERENCES `commands_log` (`command_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD CONSTRAINT `daily_report_ibfk_1` FOREIGN KEY (`employee_report_ID`) REFERENCES `employee` (`employee_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `daily_report_ibfk_2` FOREIGN KEY (`watergate_report_ID`) REFERENCES `watergate` (`watergate_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `daily_report_time`
--
ALTER TABLE `daily_report_time`
  ADD CONSTRAINT `daily_report_time_ibfk_1` FOREIGN KEY (`report_time_ID`) REFERENCES `daily_report` (`report_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`to_ID_gate`) REFERENCES `watergate` (`watergate_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`from_ID_gate`) REFERENCES `watergate` (`watergate_ID`);

--
-- Constraints for table `watergate_name`
--
ALTER TABLE `watergate_name`
  ADD CONSTRAINT `watergate_name_ibfk_1` FOREIGN KEY (`watergate_name_ID`) REFERENCES `watergate` (`watergate_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
