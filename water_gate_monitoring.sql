-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3001
-- Generation Time: Nov 12, 2023 at 07:08 PM
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
-- Indexes for table `watergate`
--
ALTER TABLE `watergate`
  ADD PRIMARY KEY (`watergate_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
