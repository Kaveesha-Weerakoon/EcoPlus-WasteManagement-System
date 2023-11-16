-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 11:15 AM
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
-- Database: `eco_plus`
--

-- --------------------------------------------------------

--
-- Table structure for table `center`
--

CREATE TABLE `center` (
  `id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `district` varchar(255) NOT NULL,
  `center_manager_id` int(11) NOT NULL,
  `center_manager_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `center`
--

INSERT INTO `center` (`id`, `region`, `address`, `district`, `center_manager_id`, `center_manager_name`) VALUES
(31, 'Mathara', 'Mathara', 'Mathara', 171, 'nimalsha'),
(32, 'Keleniya', 'Keleniya', 'Keleniya', 168, 'Dinithi'),
(33, '12', '12', '12', 170, 'kaveesha'),
(34, '121', '22', '12', 169, 'ayesh');

-- --------------------------------------------------------

--
-- Table structure for table `center_managers`
--

CREATE TABLE `center_managers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `nic` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `contact_no` int(11) NOT NULL,
  `assinged` varchar(255) NOT NULL DEFAULT 'No',
  `assigned_center_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `center_managers`
--

INSERT INTO `center_managers` (`id`, `user_id`, `image`, `nic`, `address`, `dob`, `contact_no`, `assinged`, `assigned_center_id`, `created_at`) VALUES
(58, 168, 'Dinithi@gmail.com_three.jpg', '200117600584', 'Keleniya', '2023-11-16', 771231231, 'True', 32, '2023-11-14 13:51:06'),
(59, 169, 'ayesh@gmail.com_four.jpg', '200117600555', 'Hikkaduwa', '2023-11-16', 775902645, 'True', 34, '2023-11-14 13:51:44'),
(60, 170, 'kaveesha1@gmail.com_one.jpg', '200117600432', 'Galle', '2023-11-15', 775902645, 'True', 33, '2023-11-14 13:52:27'),
(61, 171, 'nimalsha@gmail.com_two.jpg', '200117600123', 'Mathara', '2023-11-15', 771234122, 'True', 31, '2023-11-14 13:53:09'),
(62, 172, '', '200117600543', 'galle', '2023-11-15', 775902645, 'No', 0, '2023-11-14 15:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `center_workers`
--

CREATE TABLE `center_workers` (
  `id` int(11) NOT NULL,
  `center_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `contact_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `center_workers`
--

INSERT INTO `center_workers` (`id`, `center_id`, `name`, `nic`, `address`, `dob`, `contact_no`) VALUES
(39, 32, 's21', '111111111111', '1', '2023-11-10', '1212121212');

-- --------------------------------------------------------

--
-- Table structure for table `collectors`
--

CREATE TABLE `collectors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `center_name` text NOT NULL,
  `nic` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collectors`
--

INSERT INTO `collectors` (`id`, `user_id`, `center_id`, `center_name`, `nic`, `address`, `contact_no`, `dob`, `vehicle_no`, `vehicle_type`) VALUES
(24, 173, 32, 'Keleniya', '200117600432', 'Galle', '0775902645', '2023-11-15', 'GT-9862', 'CAR');

-- --------------------------------------------------------

--
-- Table structure for table `collector_assistants`
--

CREATE TABLE `collector_assistants` (
  `id` int(11) NOT NULL,
  `collector_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nic` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_no` text NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collector_assistants`
--

INSERT INTO `collector_assistants` (`id`, `collector_id`, `name`, `nic`, `address`, `contact_no`, `dob`) VALUES
(39, 173, '1', '123456789213', '1', '1111111111', '2023-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `collector_complains`
--

CREATE TABLE `collector_complains` (
  `id` int(11) NOT NULL,
  `collector_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `center_id` int(11) NOT NULL,
  `contact_no` int(10) NOT NULL,
  `region` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `complaint` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credits_per_waste`
--

CREATE TABLE `credits_per_waste` (
  `plastic` decimal(10,0) NOT NULL,
  `polythene` decimal(10,0) NOT NULL,
  `metal` decimal(10,0) NOT NULL,
  `electronic` decimal(10,0) NOT NULL,
  `paper` decimal(10,0) NOT NULL,
  `glass` decimal(10,0) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credits_per_waste`
--

INSERT INTO `credits_per_waste` (`plastic`, `polythene`, `metal`, `electronic`, `paper`, `glass`, `id`) VALUES
(6, 1, 6, 5, 412, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `mobile_number`, `address`, `city`) VALUES
(40, 135, '0775902645', 'Galle', 'Galle');

-- --------------------------------------------------------

--
-- Table structure for table `customer_complains`
--

CREATE TABLE `customer_complains` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `complaint` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `name`) VALUES
(38, 'admin@gmail.com', '$2y$10$ba8J4ssK6jWICUiKq9Y6fe7P156ze.BfokUV6GS8bA88tUUm/gSua', 'admin', 'Admin'),
(135, 'kaveesha@gmail.com', '$2y$10$ulsCaH.vQCVSC/Zts1pTN.hkTnVeocrK1i5zGcJL7vcPu3nI8J8p6', 'customer', 'kaveesha'),
(136, 'sa@gmail.com', '$2y$10$6HEEhWAysNU2dmfJCQTb3.6T9ikFadbTZFSLuG0uuGBbu3.zl9Huy', 'collector', 'sa'),
(140, 'Nishantha@gmail.com', '$2y$10$Gyfni60NP7kSz16/d0QbOu9g/pH5I5b9O6aEHpyARg0jYIQAc8dU2', 'collector', 'Nishantha'),
(141, 'Damesh@gmail.com', '$2y$10$BwliWcSdyK3JAs92VFMomOBNsj2b3YXM2kszw56AbpfbTcYVS6wWe', 'collector', 'Damesh'),
(160, 'raguram@gmail.com', '$2y$10$Lb02JUux/.vri5kfdv0IFucGJ70ML5yix7iBT2jldbPYMvOfFqBFS', 'collector', 'raguram'),
(163, '121212@gmail.com', '$2y$10$AmP6iLK5JrQ6ge32Pxw8KeufZhDrbmTeLW82SrPYar28NT9YcXTi.', 'centermanager', '12'),
(164, '12@gmail.com', '$2y$10$TMeKVPyS6K8pQ9d.xU3ONOiZlyQ30ncZEAuOvEde1ila0KQBNCvw2', 'centermanager', '1'),
(165, '111@gmail.com', '$2y$10$ZddF99FC2jeNNzfheMqk8OSqY05t.k9T1i/4Wv0AoUq5hephX2yg.', 'centermanager', '1111'),
(168, 'Dinithi@gmail.com', '$2y$10$vUZZjhbv25Uv3fCnkxlqpO0kjeC5H5I/Jvfc46n1mHj7rAGCO8wRS', 'centermanager', 'Dinithi'),
(169, 'ayesh@gmail.com', '$2y$10$zaihDfOox0WndiYgJXUTV.W9VNcu/8LNpKeBag7/k3n8AjOwFX2Ve', 'centermanager', 'ayesh'),
(170, 'kaveesha1@gmail.com', '$2y$10$My5y64J1YPjHu/wahfvSxOLPC.Xs9EmJK/AgaMcPOrgR.D4AucSQ6', 'centermanager', 'kaveesha'),
(171, 'nimalsha@gmail.com', '$2y$10$zKCGhW0.bf95vxxYFB.Xh.cLzxroZl89vpvBTnNdv2vmnhe5OdpFG', 'centermanager', 'nimalsha'),
(172, 'hello@gmail.com', '$2y$10$V6ssmokzswMxFYIFIvfQBuDlUffdUiab1/tL9Rbs8abKhDEi5yT3e', 'centermanager', 'hello'),
(173, 'janamina@gmail.com', '$2y$10$9FHi/6d7GK20SgNOu27gwuK/uXrQzwSFry9umaQTEdbXP1gX.tSvC', 'collector', 'janamina');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `center`
--
ALTER TABLE `center`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `center_manager_id` (`center_manager_id`),
  ADD UNIQUE KEY `region` (`region`);

--
-- Indexes for table `center_managers`
--
ALTER TABLE `center_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sd` (`user_id`);

--
-- Indexes for table `center_workers`
--
ALTER TABLE `center_workers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Foreign` (`center_id`);

--
-- Indexes for table `collectors`
--
ALTER TABLE `collectors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `center_id` (`center_id`);

--
-- Indexes for table `collector_assistants`
--
ALTER TABLE `collector_assistants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fa` (`collector_id`);

--
-- Indexes for table `collector_complains`
--
ALTER TABLE `collector_complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collector_constraint` (`collector_id`);

--
-- Indexes for table `credits_per_waste`
--
ALTER TABLE `credits_per_waste`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `customer_complains`
--
ALTER TABLE `customer_complains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `center`
--
ALTER TABLE `center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `center_managers`
--
ALTER TABLE `center_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `center_workers`
--
ALTER TABLE `center_workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `collectors`
--
ALTER TABLE `collectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `collector_assistants`
--
ALTER TABLE `collector_assistants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `collector_complains`
--
ALTER TABLE `collector_complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `credits_per_waste`
--
ALTER TABLE `credits_per_waste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `customer_complains`
--
ALTER TABLE `customer_complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `center_managers`
--
ALTER TABLE `center_managers`
  ADD CONSTRAINT `sd` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `center_workers`
--
ALTER TABLE `center_workers`
  ADD CONSTRAINT `Foreign` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `collectors`
--
ALTER TABLE `collectors`
  ADD CONSTRAINT `F` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `collectors_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `collector_assistants`
--
ALTER TABLE `collector_assistants`
  ADD CONSTRAINT `fa` FOREIGN KEY (`collector_id`) REFERENCES `collectors` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `collector_complains`
--
ALTER TABLE `collector_complains`
  ADD CONSTRAINT `collector_constraint` FOREIGN KEY (`collector_id`) REFERENCES `collectors` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `h` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_complains`
--
ALTER TABLE `customer_complains`
  ADD CONSTRAINT `id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
