-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3001
-- Generation Time: Oct 18, 2023 at 03:26 PM
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
-- Database: `watergatesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE `commands` (
  `command_ID` varchar(255) NOT NULL,
  `employee_ID` varchar(255) NOT NULL,
  `watergate_ID` varchar(255) NOT NULL,
  `closing_time` datetime NOT NULL,
  `real_closing_time` datetime DEFAULT NULL,
  `openning_time` datetime NOT NULL,
  `real_openning_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dailyreport`
--

CREATE TABLE `dailyreport` (
  `report_ID` int(11) NOT NULL,
  `employee_ID` varchar(255) DEFAULT NULL,
  `watergate_ID` varchar(255) DEFAULT NULL,
  `upstream` float DEFAULT NULL,
  `downstream` float DEFAULT NULL,
  `flow_rate` float DEFAULT NULL,
  `report_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_ID` varchar(255) NOT NULL,
  `to_IO_Gate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `employee_ID` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `watergate`
--

CREATE TABLE `watergate` (
  `watergate_ID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `criterion` float DEFAULT NULL,
  `gate_status` tinyint(1) NOT NULL,
  `route_ID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`command_ID`),
  ADD KEY `employee_ID` (`employee_ID`),
  ADD KEY `watergate_ID` (`watergate_ID`);

--
-- Indexes for table `dailyreport`
--
ALTER TABLE `dailyreport`
  ADD PRIMARY KEY (`report_ID`),
  ADD KEY `employee_ID` (`employee_ID`),
  ADD KEY `watergate_ID` (`watergate_ID`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_ID`),
  ADD KEY `fk_constraint_to_IO_Gate` (`to_IO_Gate`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`employee_ID`);

--
-- Indexes for table `watergate`
--
ALTER TABLE `watergate`
  ADD PRIMARY KEY (`watergate_ID`),
  ADD KEY `fk_constraint_route_ID` (`route_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dailyreport`
--
ALTER TABLE `dailyreport`
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commands`
--
ALTER TABLE `commands`
  ADD CONSTRAINT `commands_ibfk_1` FOREIGN KEY (`employee_ID`) REFERENCES `users` (`employee_ID`),
  ADD CONSTRAINT `commands_ibfk_2` FOREIGN KEY (`watergate_ID`) REFERENCES `watergate` (`watergate_ID`);

--
-- Constraints for table `dailyreport`
--
ALTER TABLE `dailyreport`
  ADD CONSTRAINT `dailyreport_ibfk_1` FOREIGN KEY (`employee_ID`) REFERENCES `users` (`employee_ID`),
  ADD CONSTRAINT `dailyreport_ibfk_2` FOREIGN KEY (`watergate_ID`) REFERENCES `watergate` (`watergate_ID`);

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `fk_constraint_to_IO_Gate` FOREIGN KEY (`to_IO_Gate`) REFERENCES `watergate` (`watergate_ID`),
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`to_IO_Gate`) REFERENCES `watergate` (`watergate_ID`);

--
-- Constraints for table `watergate`
--
ALTER TABLE `watergate`
  ADD CONSTRAINT `fk_constraint_route_ID` FOREIGN KEY (`route_ID`) REFERENCES `route` (`route_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
