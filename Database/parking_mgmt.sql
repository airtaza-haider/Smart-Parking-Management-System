-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2025 at 06:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking_mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complain_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_of_issue` date DEFAULT curdate(),
  `user_id` int(11) DEFAULT NULL,
  `slot_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complain_id`, `message`, `date_of_issue`, `user_id`, `slot_id`) VALUES
(1, 'someone parked in my slot', '2025-07-06', 3, 3),
(2, 'slot was blocked', '2025-07-06', 1, 7),
(3, 'extra payment deducted', '2025-07-06', 2, 11),
(4, 'camera was not accessible at my slot', '2025-07-06', 4, 9),
(5, 'broken glass near my slot', '2025-07-06', 6, 12),
(6, 'someone parked in my slot', '2025-07-06', 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `parking_slot`
--

CREATE TABLE `parking_slot` (
  `slot_id` int(10) NOT NULL,
  `block` varchar(4) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_slot`
--

INSERT INTO `parking_slot` (`slot_id`, `block`, `is_available`) VALUES
(3, 'A1', 0),
(7, 'D9', 0),
(9, 'A5', 1),
(11, 'C3', 1),
(12, 'B3', 0),
(15, 'C2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `is_paid` tinyint(1) DEFAULT 0,
  `res_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `amount`, `is_paid`, `res_id`) VALUES
(1, 200.70, 1, 1),
(2, 330.80, 1, 2),
(3, 120.70, 1, 3),
(4, 50.60, 1, 4),
(5, 240.20, 1, 5),
(6, 70.70, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `res_id` int(11) NOT NULL,
  `check_in_time` datetime NOT NULL,
  `check_out_time` datetime NOT NULL,
  `is_reserved` tinyint(1) DEFAULT 1,
  `user_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `slot_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`res_id`, `check_in_time`, `check_out_time`, `is_reserved`, `user_id`, `vehicle_id`, `slot_id`) VALUES
(1, '2025-07-06 09:00:00', '2025-07-06 09:10:00', 0, 3, 5, 3),
(2, '2025-07-06 12:00:00', '2025-07-06 12:30:00', 0, 1, 1, 7),
(3, '2025-07-06 09:30:00', '2025-07-06 10:10:00', 1, 2, 7, 9),
(4, '2025-07-06 14:15:00', '2025-07-06 18:10:00', 0, 5, 64, 11),
(5, '2025-07-06 12:00:00', '2025-07-06 12:18:00', 1, 6, 12, 15),
(6, '2025-07-06 07:15:00', '2025-07-06 09:45:00', 0, 4, 29, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `country_code` varchar(5) DEFAULT NULL,
  `area_code` varchar(5) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `country_code`, `area_code`, `phone_number`) VALUES
(1, 'Ali', '+92', '300', '1234567'),
(2, 'Ahmad', '+92', '321', '7654321'),
(3, 'Bilal', '+92', '333', '9876543'),
(4, 'Moiz', '+92', '301', '5556677'),
(5, 'Abdullah', '+92', '345', '4455667'),
(6, 'Haider', '+92', '308', '2244886');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(6) NOT NULL,
  `number_plate` varchar(8) NOT NULL,
  `vehicle_type` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `number_plate`, `vehicle_type`, `user_id`) VALUES
(1, 'ICT 90', 'SUV', 4),
(5, 'LEB700', 'CAR', 1),
(7, 'LEC 72', 'BIKE', 1),
(12, 'LE 90', 'BIKE', 3),
(29, 'VI 456', 'TRUCK', 6),
(64, 'LED 37', 'CAR', 5);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_color`
--

CREATE TABLE `vehicle_color` (
  `vehicle_id` int(5) NOT NULL,
  `color` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_color`
--

INSERT INTO `vehicle_color` (`vehicle_id`, `color`) VALUES
(1, 'Red'),
(5, 'Black'),
(7, 'Gray'),
(12, 'Black'),
(29, 'White'),
(64, 'Blue');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complain_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `slot_id` (`slot_id`);

--
-- Indexes for table `parking_slot`
--
ALTER TABLE `parking_slot`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `res_id` (`res_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `slot_id` (`slot_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD UNIQUE KEY `number_plate` (`number_plate`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vehicle_color`
--
ALTER TABLE `vehicle_color`
  ADD PRIMARY KEY (`vehicle_id`,`color`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `complaints_ibfk_2` FOREIGN KEY (`slot_id`) REFERENCES `parking_slot` (`slot_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `reservation` (`res_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`slot_id`) REFERENCES `parking_slot` (`slot_id`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `vehicle_color`
--
ALTER TABLE `vehicle_color`
  ADD CONSTRAINT `vehicle_color_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
