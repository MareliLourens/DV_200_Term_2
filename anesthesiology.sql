-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 02:07 PM
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
-- Database: `anesthesiology`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `date` int(25) NOT NULL,
  `time` int(25) NOT NULL,
  `patient_id` int(25) NOT NULL,
  `doctor_id` int(25) NOT NULL,
  `receptionist_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `date`, `time`, `patient_id`, `doctor_id`, `receptionist_id`) VALUES
(1, 20230617, 1300, 1, 2, 3),
(2, 20230615, 1230, 2, 3, 1),
(3, 20230620, 1115, 3, 1, 2),
(4, 20230614, 1430, 4, 4, 4),
(121, 20230621, 1530, 115, 4, 5),
(125, 20230622, 1111, 122, 91, 3);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(25) NOT NULL,
  `profile_image` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `specialisation` varchar(30) NOT NULL,
  `room_number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `profile_image`, `name`, `surname`, `age`, `gender`, `email`, `password`, `phone_number`, `specialisation`, `room_number`) VALUES
(1, 'assets/Emily.png', 'Rachel', 'Thompson', 29, 'Female', 'rachel.t@xmp.com', '94281095', 795642385, 'anesthesia care', 102),
(2, 'assets/John.png', 'Ethan', 'Anderson', 37, 'Male', 'ethan.a@xmp.com', '00968746', 835561258, 'pain management', 209),
(3, 'assets/Sarah.png', 'Lily', 'Cooper', 41, 'Female', 'lily.c@xmp.com', '12345678', 796894112, 'anesthesia care', 312),
(4, 'assets/Juan.png', 'Jerry', 'Sanchez', 45, 'Male', 'jerry.s@xmp.com', '843901', 853669878, 'pain management', 57),
(91, 'assets/default_female.png', 'Mareli', 'Lourens', 20, 'Female', 'mareli.l@xmp.com', '', 636907590, 'anesthesia care', 0),
(105, 'assets/default_male.png', 'Leo', 'Kuyper', 24, 'Male', 'Leo@xmp.com', '', 865437865, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(25) NOT NULL,
  `profile_image` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `medical_aid_number` int(18) NOT NULL,
  `previous_appointments` int(25) NOT NULL,
  `assigned_doctor` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `profile_image`, `name`, `surname`, `age`, `gender`, `email`, `password`, `phone_number`, `medical_aid_number`, `previous_appointments`, `assigned_doctor`) VALUES
(1, 'assets/John.png', 'John', 'Smith', 32, 'Male', 'john.smith@xmp.com', '849301', 2147483647, 613112, 2, 2),
(2, 'assets/Emily.png', 'Emily', 'Davis', 28, 'Female', 'emily.davis@xmp.com', '35684965', 0, 0, 2, 2),
(3, 'assets/Sarah.png', 'Sarah', 'Stone', 42, 'Female', 'sarah.stone@xmp.com', '46582130', 0, 0, 6, 3),
(4, 'assets/Juan.png', 'Juan', 'Leroy', 19, 'male', 'juan.leroy@xmp.com', '4789234', 0, 0, 4, 4),
(115, 'assets/default_female.png', 'Karen', 'Lourens', 52, 'Female', 'karen.lourens@xmp', '', 834150268, 123321, 0, 4),
(122, 'assets/default_male.png', 'Tsungai', 'Katsuro', 32, 'Male', 'Tsungai@xmp.com', '', 657896543, 123456, 0, 104);

-- --------------------------------------------------------

--
-- Table structure for table `receptionists`
--

CREATE TABLE `receptionists` (
  `id` int(25) NOT NULL,
  `profile_image` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `phone_number` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `rank` varchar(25) NOT NULL,
  `banned` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receptionists`
--

INSERT INTO `receptionists` (`id`, `profile_image`, `name`, `surname`, `age`, `gender`, `phone_number`, `email`, `password`, `rank`, `banned`) VALUES
(1, 'assets/default_female.png', 'Samantha', 'Roberts', 31, 'Female', 795312035, 'samantha.r@xmp.com', '13548952', 'Normal', 'no'),
(2, 'assets/Juan.png', 'Benjamin', 'Wilson', 45, 'Male', 639876423, 'benjamin.w@xmp.com', '23564102', 'Normal', 'yes'),
(3, 'assets/Emily.png', 'Olivia', 'Thompson', 37, 'Female', 836597845, 'olivia.t@xmp.com', '64586743', 'Head', 'no'),
(4, 'assets/Sarah.png', 'Ashley', 'Cornell', 30, 'Female', 265874598, 'ashley.c@xmp.com', '784329', 'Normal', 'no'),
(5, 'assets/Emily.png', 'Mareli', 'Lourens', 20, 'Female', 636907590, 'mareli.l@xmp.com', 'Mareli111', 'Normal', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_ibfk_2` (`doctor_id`),
  ADD KEY `appointments_ibfk_4` (`receptionist_id`),
  ADD KEY `appointments_ibfk_5` (`patient_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receptionists`
--
ALTER TABLE `receptionists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `receptionists`
--
ALTER TABLE `receptionists`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `appointments_ibfk_4` FOREIGN KEY (`receptionist_id`) REFERENCES `receptionists` (`id`),
  ADD CONSTRAINT `appointments_ibfk_5` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
