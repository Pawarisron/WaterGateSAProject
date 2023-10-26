-- phpMyAdmin SQL Dump
-- version 5.2.2-dev+20231025.93143c487c
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 07:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

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
CREATE DATABASE IF NOT EXISTS `water_gate_monitoring` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `water_gate_monitoring`;

-- --------------------------------------------------------

--
-- Table structure for table `closing_time_commands`
--

CREATE TABLE `closing_time_commands` (
  `close_command_ID` varchar(255) NOT NULL,
  `closing_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `closing_time_commands`
--

INSERT INTO `closing_time_commands` (`close_command_ID`, `closing_time`) VALUES
('C001', '2023-10-25 01:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `commands_log`
--

CREATE TABLE `commands_log` (
  `command_ID` varchar(255) NOT NULL,
  `employee_com_ID` varchar(255) NOT NULL,
  `watergate_com_ID` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commands_log`
--

INSERT INTO `commands_log` (`command_ID`, `employee_com_ID`, `watergate_com_ID`, `note`) VALUES
('C001', 'E001', 'A', 'เปิด watergate A เวลา 8:00 ต้องปิด 11:00');

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
) ;

--
-- Dumping data for table `daily_report`
--

INSERT INTO `daily_report` (`report_ID`, `employee_report_ID`, `watergate_report_ID`, `upstream`, `downstream`, `flow_rate`) VALUES
(1, 'E001', 'A', 1, 0.5, 50);

-- --------------------------------------------------------

--
-- Table structure for table `daily_report_time`
--

CREATE TABLE `daily_report_time` (
  `report_time_ID` int(11) NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_report_time`
--

INSERT INTO `daily_report_time` (`report_time_ID`, `report_date`) VALUES
(1, '2023-10-25 16:53:48');

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
('E001', 'ชื่อต้น A', 'นามสกุล A', 'EMPLOYEE', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `openning_time_commands`
--

CREATE TABLE `openning_time_commands` (
  `open_command_ID` varchar(255) NOT NULL,
  `openning_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `openning_time_commands`
--

INSERT INTO `openning_time_commands` (`open_command_ID`, `openning_time`) VALUES
('C001', '2023-10-25 04:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_ID` varchar(255) NOT NULL,
  `to_ID_gate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_ID`, `to_ID_gate`) VALUES
('rout_AB', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `watergate`
--

CREATE TABLE `watergate` (
  `watergate_ID` varchar(255) NOT NULL,
  `gate_status` int(1) NOT NULL DEFAULT 0,
  `water_source_name` varchar(255) DEFAULT NULL,
  `criterion` float DEFAULT NULL CHECK (`criterion` >= 0.0),
  `gate_route_ID` varchar(255) DEFAULT NULL
) ;

--
-- Dumping data for table `watergate`
--

INSERT INTO `watergate` (`watergate_ID`, `gate_status`, `water_source_name`, `criterion`, `gate_route_ID`) VALUES
('A', 0, 'แหล่งน้ำ A', 0.1, 'rout_AB'),
('B', 0, 'แหล่งน้ำ A', 0.6, NULL);

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
('A', 'ชื่อ A'),
('B', 'ชื่อ B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `closing_time_commands`
--
ALTER TABLE `closing_time_commands`
  ADD PRIMARY KEY (`close_command_ID`);

--
-- Indexes for table `commands_log`
--
ALTER TABLE `commands_log`
  ADD PRIMARY KEY (`command_ID`),
  ADD KEY `commands_log_ibfk_1` (`employee_com_ID`),
  ADD KEY `commands_log_ibfk_2` (`watergate_com_ID`);

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
-- Indexes for table `openning_time_commands`
--
ALTER TABLE `openning_time_commands`
  ADD PRIMARY KEY (`open_command_ID`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_ID`),
  ADD KEY `route_ibfk_1` (`to_ID_gate`);

--
-- Indexes for table `watergate`
--
ALTER TABLE `watergate`
  ADD PRIMARY KEY (`watergate_ID`),
  ADD KEY `watergate_ibfk_1` (`gate_route_ID`);

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
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `closing_time_commands`
--
ALTER TABLE `closing_time_commands`
  ADD CONSTRAINT `closing_time_commands_ibfk_1` FOREIGN KEY (`close_command_ID`) REFERENCES `commands_log` (`command_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `commands_log`
--
ALTER TABLE `commands_log`
  ADD CONSTRAINT `commands_log_ibfk_1` FOREIGN KEY (`employee_com_ID`) REFERENCES `employee` (`employee_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `commands_log_ibfk_2` FOREIGN KEY (`watergate_com_ID`) REFERENCES `watergate` (`watergate_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
-- Constraints for table `openning_time_commands`
--
ALTER TABLE `openning_time_commands`
  ADD CONSTRAINT `openning_time_commands_ibfk_1` FOREIGN KEY (`open_command_ID`) REFERENCES `commands_log` (`command_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`to_ID_gate`) REFERENCES `watergate` (`watergate_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `watergate`
--
ALTER TABLE `watergate`
  ADD CONSTRAINT `watergate_ibfk_1` FOREIGN KEY (`gate_route_ID`) REFERENCES `route` (`route_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `watergate_name`
--
ALTER TABLE `watergate_name`
  ADD CONSTRAINT `watergate_name_ibfk_1` FOREIGN KEY (`watergate_name_ID`) REFERENCES `watergate` (`watergate_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
