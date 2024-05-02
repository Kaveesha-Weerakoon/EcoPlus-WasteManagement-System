-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 04:38 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `nic` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `image`, `nic`, `address`, `dob`, `contact_no`, `created_at`) VALUES
(0, 274, 'kaveesha11@gmail.com_6.jpg', '200117600231', 'kaveesha', '2024-04-17', '0717412011', '2024-04-19 02:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `annoucement`
--

CREATE TABLE `annoucement` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `header` varchar(55) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annoucement`
--

INSERT INTO `annoucement` (`id`, `img`, `header`, `text`, `date`) VALUES
(1, 'Colombo.jpg', 'We are now at Colombo !', 'In the heart of Colombo, where the vibrant pulse of city life thrums through the streets, our mission commences: a dedicated garbage collection service to uphold cleanliness and sustainability. Amidst the hustle and bustle of daily life, our team rallies, equipped with determination and purpose. From the bustling markets to the serene residential areas, we traverse every corner, ensuring cleanliness prevails. With each bin emptied and every street cleared, we contribute to the beauty and health of our beloved city. In Colombo\'s embrace, our commitment shines bright, forging a cleaner, greener tomorrow for all who call this bustling city home.', '2024-02-17'),
(2, 'Galle.jpg', 'We are now at Galle !', 'In the picturesque coastal town of Galle, where the azure waves kiss the sandy shores and the gentle sea breeze whispers tales of ancient trade routes, our endeavor unfolds: a tireless guardianship of cleanliness and serenity amidst the tourist throngs. Nestled within the historic fort walls, our mission begins, resonating with the echoes of bygone eras and the laughter of modern explorers. From the cobblestone streets adorned with vibrant bougainvillea to the bustling harbor where ships of yore once docked, we tread with purpose. With every sweep of our brooms and every emptied trash bin, we safeguard the beauty and allure of Galle for generations to come. In this coastal haven, our commitment to cleanliness stands as a beacon, illuminating the path to a sustainable and harmonious future for locals and visitors alike', '2024-02-17'),
(3, 'rathnapura.jpg\r\n', 'Expanding Reach: Introducing Rathnapura to Our Services', 'In the heartland of Sri Lanka lies Rathnapura, a city cradled by lush greenery and flowing rivers, where our mission of cleanliness takes root. Surrounded by verdant landscapes and the gentle hum of nature, we embark on our quest to preserve the pristine beauty of this central gem. From the bustling markets where gemstones sparkle in the sunlight to the tranquil temple precincts echoing with ancient chants, our dedication knows no bounds. With each sweeping motion and meticulous collection, we honor Rathnapura\'s natural splendor and cultural heritage. In this tranquil haven, our commitment to cleanliness serves as a testament to our reverence for the land and its people, ensuring a harmonious and sustainable future for all who call Rathnapura home.', '2024-02-17'),
(5, '2024-02-18_08-36-09_kaluthara.jpg', 'New Region Unveiled in Kalutara! 🌟', 'We&#39;re thrilled to announce the grand opening of a brand new region right here in Kalutara! Prepare to embark on a journey of discovery as we unveil this exciting addition to our town.  Featuring stunning landscapes, vibrant communities, and endless opportunities, this new region promises to captivate your senses and ignite your adventurous spirit.  Join us in celebrating this momentous occasion and be among the first to explore the wonders of Kalutara&#39;s newest gem!  Get ready to write the next chapter of Kalutara&#39;s extraordinary story!', '2024-02-18'),
(9, '2024-04-27_20-08-27_street-tour-mob.jpg', 'We are now in Kandy', 'In the heart of Kandy lies a revolutionary solution to waste management, a state-of-the-art garbage disposal system meticulously designed to cater to the city&#39;s needs. Residents and visitors alike marvel at its efficiency and eco-friendliness, as it seamlessly integrates into the vibrant tapestry of Kandy&#39;s landscape', '2024-04-27'),
(10, '2024-04-27_20-09-16_Batticaloa-Lagoon.jpg', 'We are now in Batticaloa', 'In the serene coastal town of Batticaloa, nestled on the eastern shores of Sri Lanka, a transformative waste management initiative is taking root. Here, amid the palm-fringed beaches and bustling marketplaces, residents benefit from a cutting-edge garbage disposal system that sets new standards for sustainability and cleanliness', '2024-04-27'),
(11, '2024-04-27_20-13-57_evening-gampaha-railway-platform-railway-station-736631.jpg', 'Gampaha&#39;s Green Waste Solution', 'We are now at Gampaha, where our commitment to sustainable waste management is reshaping the cityscape. Through innovative solutions and community collaboration, we&#39;re turning challenges into opportunities, creating a cleaner, greener future for all residents.', '2024-04-27'),
(12, '2024-04-27_20-15-51_0f.jpg', 'Heritage to Tomorrow: Our Polonnaruwa Journey', 'Welcome to Polonnaruwa, where history and innovation converge in a timeless tapestry. As we step into this ancient city, we embrace the responsibility to preserve its rich heritage while ushering in a new era of progress and sustainability', '2024-04-27'),
(13, '2024-04-27_20-19-43_Jaffna-Fort-5.jpg', 'Unveiling Jaffna&#39;s New Center', 'Step into a realm where tradition meets innovation as we proudly unveil the latest addition to Jaffna&#39;s landscape—the Jaffna Center. Nestled amidst the vibrant cultural tapestry of our city, this state-of-the-art facility serves as a beacon of progress and opportunity', '2024-04-27');

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
  `center_manager_name` varchar(255) NOT NULL,
  `lat` decimal(11,8) NOT NULL,
  `longi` decimal(11,8) NOT NULL,
  `radius` decimal(40,14) NOT NULL DEFAULT 0.00000000000000,
  `disable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `center`
--

INSERT INTO `center` (`id`, `region`, `address`, `district`, `center_manager_id`, `center_manager_name`, `lat`, `longi`, `radius`, `disable`) VALUES
(53, 'Galle', 'Galle', 'Galle', 197, 'james', 6.05101051, 80.24971642, 13417.90758760336400, 0),
(54, 'Colombo', 'Colombo', 'Colombo', 224, 'kumara', 6.85612399, 79.92062197, 12683.33250845849800, 0),
(55, 'Kaluthara', '', 'kaluthara', 230, 'Nimal', 6.58206262, 80.06215230, 12778.79297216252000, 0),
(57, 'Rathnapura', '', 'Rathnapura', 236, 'sohyun', 6.72652894, 80.37577430, 13736.68616159370300, 0),
(64, 'Polonnaruwa', '', 'Polonnaruwa', 350, 'Yasindu Chathuranga', 8.00000000, 81.00000000, 40000.00000000000000, 0),
(65, 'Jaffna', '', 'Jaffna', 284, 'Raguram Jathtusan', 9.68506066, 80.09139880, 17997.63224823286500, 0),
(67, 'Kandy', '', 'Kandy', 321, 'Dasun Thamash', 7.29602325, 80.62516379, 15739.33978833292500, 0),
(68, 'Batticaloa', '', 'Batticaloa', 322, 'Mohomad Nasif', 7.64633214, 81.67848844, 17273.42434022117600, 0),
(69, 'Gampaha', '', 'Gampaha', 344, 'Sanoj Darshana', 7.09402816, 79.99766944, 13907.47075517025200, 0),
(70, 'Kurunagala', '', 'Kurunagala', 340, 'Orshan Viraj', 7.48908009, 80.36957186, 8733.83055055617000, 0),
(71, 'Nuwaraeliya', '', 'Nuwaraeliya', 341, 'alokaeranda', 6.95854083, 80.77351017, 12083.91954010090700, 0),
(72, 'Trincomalee', '', 'Trincomalee', 342, 'RavinduPrabash', 8.59383414, 81.13322337, 12642.52960347309500, 0),
(73, 'Vavuniya', '', 'Vavuniya', 343, 'uvindu vishmina', 8.74432326, 80.48076973, 10991.76048402523200, 0),
(74, 'Ampara', '', 'Ampara', 323, 'Yesith Bimsara', 7.30852509, 81.68938802, 12554.78810633621500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `center_complaints`
--

CREATE TABLE `center_complaints` (
  `complaint_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL,
  `center_manager_id` int(11) NOT NULL,
  `center_manager_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `complaint` text NOT NULL,
  `contact_no` varchar(25) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `center_complaints`
--

INSERT INTO `center_complaints` (`complaint_id`, `center_id`, `region`, `center_manager_id`, `center_manager_name`, `subject`, `complaint`, `contact_no`, `date_time`) VALUES
(1, 53, 'Galle', 197, 'james', 'not enough workers', 'not enough workers to work in the center', '0775902213', '2024-01-02 17:57:18'),
(2, 53, 'Galle', 197, 'john', 'More Requests are comming', 'More Requests are comming', '0775902214', '2024-04-29 17:11:50'),
(3, 54, 'Colombo', 224, 'kumara', 'not enough workers', 'not enough workers to work in the center', '0775902645', '2024-04-29 17:11:23'),
(4, 55, 'Kaluthara', 216, 'Janka', 'not enough workers', 'no garbgae no garbgae no garbgae no garbgaeno garbgaeno garbgaeno garbgaenot enough workers to work in the center', '0775902645', '2024-04-29 17:11:27'),
(5, 53, 'Galle', 197, 'james', 'not enough collectors', 'not enough collectors', '0775902213', '2024-04-29 12:29:20');

-- --------------------------------------------------------

--
-- Table structure for table `center_garbage`
--

CREATE TABLE `center_garbage` (
  `center_id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL,
  `current_plastic` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_plastic` decimal(10,2) NOT NULL DEFAULT 0.00,
  `current_polythene` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_polythene` decimal(10,2) NOT NULL DEFAULT 0.00,
  `current_metal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_metal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `current_glass` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_glass` decimal(10,2) NOT NULL DEFAULT 0.00,
  `current_paper` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_paper` decimal(10,2) NOT NULL DEFAULT 0.00,
  `current_electronic` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_electronic` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `center_garbage`
--

INSERT INTO `center_garbage` (`center_id`, `region`, `current_plastic`, `total_plastic`, `current_polythene`, `total_polythene`, `current_metal`, `total_metal`, `current_glass`, `total_glass`, `current_paper`, `total_paper`, `current_electronic`, `total_electronic`) VALUES
(53, 'Galle', 88.20, 188.20, 19.10, 67.10, 70.90, 122.90, 108.01, 394.01, 27.12, 67.12, 80.40, 190.40),
(54, 'Colombo', 20.80, 60.80, 28.00, 48.00, 21.80, 21.80, 27.52, 27.52, 6.39, 26.39, 3.00, 17.00),
(55, 'kaluthara', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(57, 'rathnapura', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(65, 'Jaffna', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(67, 'Kandy', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(68, 'Batticaloa', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(69, 'Ragama', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(70, 'Kurunagala', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(71, 'Nuwaraeliya', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(72, 'Trincomalee', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(73, 'Vavuniya', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00),
(74, 'Ampara', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00);

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
  `contact_no` varchar(254) NOT NULL,
  `assinged` varchar(255) NOT NULL DEFAULT 'No',
  `assigned_center_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `center_managers`
--

INSERT INTO `center_managers` (`id`, `user_id`, `image`, `nic`, `address`, `dob`, `contact_no`, `assinged`, `assigned_center_id`, `created_at`) VALUES
(73, 197, 'james@gmail.com_d.jpg', '200117600584', 'Galle fort', '2023-11-16', '0775902213', 'True', 53, '2023-11-17 21:52:43'),
(74, 216, 'janaka@gmail.com_6.jpg', '200117600583', 'Mathara', '2023-11-09', '0775902645', 'No', 0, '2023-11-21 22:27:48'),
(75, 224, 'kumara@gmail.com_5.jpg', '200117600542', 'Galle', '2023-11-29', '0775902645', 'True', 54, '2023-11-28 15:00:27'),
(76, 230, 'sameera@gmail.com_7.jpg', '200117600581', 'Anuradhapura', '2023-12-07', '0714315212', 'True', 55, '2023-12-03 22:15:36'),
(77, 236, 'hyun@gmail.com_24667afad6dba08a2cb29bad0ca52970.jpg', '241111111111', 'rathnee', '2023-12-20', '5555555555', 'True', 57, '2023-12-29 19:24:06'),
(79, 284, 'RaguramJathtusan@gmail.com_a.jpg', '922821011v', 'Jaffna Srilanka', '1996-10-07', '0764739124', 'True', 65, '2024-04-25 10:47:50'),
(91, 321, 'Profile.png', '200018573193', 'Kandy Srilanka', '2000-04-25', '0728571232', 'True', 67, '2024-04-27 19:56:35'),
(92, 322, 'Profile.png', '870432461V', 'Batticalo Srilanka', '1999-04-27', '0789638117', 'True', 68, '2024-04-27 19:59:14'),
(93, 323, 'YesithBimsara@gmail.com_9.jpg', '922810121V', 'Hambanthota Srilanka', '1997-04-27', '0775912645', 'True', 74, '2024-04-27 20:02:11'),
(94, 340, 'Profile.png', '972821011v', 'Hambanthota Aluth para 342/21', '1997-03-20', '0783713912', 'True', 70, '2024-04-28 07:29:19'),
(95, 341, 'Profile.png', '977131231v', 'Nuwaraeliya', '2001-10-13', '0762731821', 'True', 71, '2024-04-28 07:31:36'),
(96, 342, 'Profile.png', '957123131v', 'Nuwaraeliya', '1995-04-18', '0742841341', 'True', 72, '2024-04-28 07:32:39'),
(97, 343, 'Profile.png', '200121212121', 'Trincomalee bathuta Road 3211/122', '2001-03-28', '0717538231', 'True', 73, '2024-04-28 07:51:10'),
(103, 350, 'profile.png', '200121124624', 'Polonnaruwa Srilanka', '2002-03-01', '0775902641', 'True', 64, '2024-04-28 16:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `center_notification`
--

CREATE TABLE `center_notification` (
  `id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL,
  `notification` text NOT NULL,
  `mark_as_read` enum('True','False') NOT NULL DEFAULT 'False',
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `center_notification`
--

INSERT INTO `center_notification` (`id`, `center_id`, `region`, `notification`, `mark_as_read`, `date_time`) VALUES
(26, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-29 09:07:14'),
(27, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-26 10:59:22'),
(28, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-26 10:59:22'),
(29, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(30, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(31, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(32, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(33, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(34, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(35, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(36, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(37, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(38, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(39, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(40, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(41, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(42, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(43, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(44, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(45, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(46, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(47, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(48, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(49, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(50, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(51, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(52, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(53, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(54, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(55, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(56, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(57, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(58, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(59, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(60, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(61, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(62, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(63, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(64, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(65, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(66, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(67, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(68, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(69, 53, 'Galle', 'Req ID 178 has been completed', 'True', '2024-01-28 11:30:29'),
(70, 53, 'Galle', 'Req ID 171 has been completed', 'True', '2024-01-28 11:30:29'),
(71, 53, 'Galle', 'Req ID 181 has been completed', 'True', '2024-01-28 11:30:29'),
(72, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(73, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(74, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(75, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(76, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(77, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(78, 53, 'Galle', 'Req ID 193 has been completed', 'True', '2024-01-28 11:30:29'),
(79, 53, 'Galle', 'Req ID 194 has been completed', 'True', '2024-01-28 11:30:29'),
(80, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(81, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(82, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(83, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(84, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(85, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(86, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(87, 53, 'Galle', 'Req ID 199 has been completed', 'True', '2024-01-28 11:30:29'),
(88, 53, 'Galle', 'Req ID 198 has been completed', 'True', '2024-01-28 11:30:29'),
(89, 53, 'Galle', 'Req ID 195 has been completed', 'True', '2024-01-28 11:30:29'),
(90, 53, 'Galle', 'Req ID 197 has been completed', 'True', '2024-01-28 11:30:29'),
(91, 53, 'Galle', 'Req ID 200 has been completed', 'True', '2024-01-28 11:30:29'),
(92, 53, 'Galle', 'Req ID 201 has been completed', 'True', '2024-01-28 11:30:29'),
(93, 53, 'Galle', 'Req ID 202 has been completed', 'True', '2024-01-28 11:30:29'),
(94, 53, 'Galle', 'Req ID 203 has been completed', 'True', '2024-01-28 11:30:29'),
(95, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(96, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(97, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(98, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(99, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(100, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(101, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(102, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(103, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(104, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-28 11:30:29'),
(105, 53, 'Galle', 'Req ID 204 has been completed', 'True', '2024-01-28 11:30:29'),
(106, 53, 'Galle', 'Req ID 205 has been completed', 'True', '2024-01-28 11:30:29'),
(107, 53, 'Galle', 'Req ID 207 has been completed', 'True', '2024-01-29 16:29:36'),
(108, 53, 'Galle', 'Req ID 209 has been completed', 'True', '2024-01-29 16:29:36'),
(109, 53, 'Galle', 'Req ID 210 has been completed', 'True', '2024-01-29 16:29:36'),
(110, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(111, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(112, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(113, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(114, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(115, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(116, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(117, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(118, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(119, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(120, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(121, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(122, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(123, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(124, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(125, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(126, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(127, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(128, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(129, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(130, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(131, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(132, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(133, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(134, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(135, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-01-29 16:29:36'),
(136, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(137, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(138, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(139, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(140, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(141, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(142, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(143, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(144, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(145, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(146, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(147, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(148, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(149, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(150, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(151, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(152, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(153, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(154, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(155, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(156, 53, 'Galle', 'Req ID 256 has been completed', 'True', '2024-02-10 06:05:36'),
(157, 53, 'Galle', 'Req ID 259 has been completed', 'True', '2024-02-10 06:05:36'),
(158, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(159, 53, 'Galle', 'Req ID 260 has been completed', 'True', '2024-02-10 06:05:36'),
(160, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(161, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(162, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(163, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(164, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(165, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(166, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(167, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(168, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(169, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-10 06:05:36'),
(170, 53, 'Galle', 'Req ID 261 has been completed', 'True', '2024-02-10 08:48:11'),
(171, 53, 'Galle', 'Req ID 262 has been completed', 'True', '2024-02-19 12:31:31'),
(172, 54, 'Colombo', 'Req ID 132 has been completed', 'True', '2024-04-24 16:51:38'),
(173, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-19 12:31:31'),
(174, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-19 12:31:31'),
(175, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-19 12:31:31'),
(176, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-19 12:31:31'),
(177, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-19 12:31:31'),
(178, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-19 12:31:31'),
(179, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-19 12:31:31'),
(180, 53, 'Galle', 'Req ID 263 has been completed', 'True', '2024-02-19 12:31:31'),
(181, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-02-19 12:31:31'),
(182, 53, 'Galle', 'Customer C247 has been requested', 'True', '2024-02-19 12:31:31'),
(183, 53, 'Galle', 'Customer C247 has been requested', 'True', '2024-02-19 12:31:31'),
(184, 53, 'Galle', 'Customer C247 has been requested', 'True', '2024-02-19 12:31:31'),
(185, 53, 'Galle', 'Customer C247 has been requested', 'True', '2024-02-19 12:31:31'),
(186, 53, 'Galle', 'Req ID 280 has been completed', 'True', '2024-02-19 12:31:31'),
(187, 53, 'Galle', 'Customer C255 has been requested', 'True', '2024-02-19 12:31:31'),
(188, 53, 'Galle', 'Customer C255 has been requested', 'True', '2024-02-19 12:31:31'),
(189, 53, 'Galle', 'Req ID 284 has been completed', 'True', '2024-04-24 11:02:04'),
(190, 53, 'Galle', 'Customer C256 has been requested', 'True', '2024-04-24 11:02:04'),
(191, 53, 'Galle', 'Req ID 285 has been completed', 'True', '2024-04-24 11:02:04'),
(192, 53, 'Galle', 'Customer C256 has been requested', 'True', '2024-04-24 11:02:04'),
(193, 53, 'Galle', 'Customer C222 has been requested', 'True', '2024-04-24 11:02:04'),
(194, 53, 'Galle', 'Req ID 287 has been completed', 'True', '2024-04-24 11:02:04'),
(195, 53, 'Galle', 'Req ID 269 has been completed', 'True', '2024-04-24 11:02:04'),
(196, 53, 'Galle', 'Req ID 268 has been completed', 'True', '2024-04-24 11:02:04'),
(197, 53, 'Galle', 'Req ID 271 has been completed', 'True', '2024-04-24 11:02:04'),
(198, 53, 'Galle', 'Req ID 282 has been completed', 'True', '2024-04-24 11:02:04'),
(199, 53, 'Galle', 'Req ID 283 has been completed', 'True', '2024-04-24 11:02:04'),
(200, 53, 'Galle', 'Req ID 275 has been completed', 'True', '2024-04-24 11:02:04'),
(201, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-24 11:02:04'),
(202, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-24 11:02:04'),
(203, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-24 11:02:04'),
(204, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-24 11:02:04'),
(205, 53, 'Galle', 'Customer C222 has been requested', 'True', '2024-04-24 11:02:04'),
(206, 53, 'Galle', 'Req ID 277 has been completed', 'True', '2024-04-24 11:02:04'),
(207, 53, 'Galle', 'Req ID 288 has been completed', 'True', '2024-04-24 11:02:04'),
(208, 53, 'Galle', 'Req ID 289 has been completed', 'True', '2024-04-24 11:02:04'),
(209, 53, 'Galle', 'Req ID 290 has been completed', 'True', '2024-04-24 11:02:04'),
(210, 53, 'Galle', 'Customer C222 has been requested', 'True', '2024-04-24 11:02:04'),
(211, 53, 'Galle', 'Customer C222 has been requested', 'True', '2024-04-24 11:02:04'),
(212, 53, 'Galle', 'Req ID 293 has been completed', 'True', '2024-04-24 11:02:04'),
(213, 55, 'kaluthara', 'Req ID 84 has been completed', 'True', '2024-04-28 05:41:51'),
(214, 54, 'Colombo', 'Customer C272 has been requested', 'True', '2024-04-24 17:28:07'),
(215, 54, 'Colombo', 'Customer C272 has been requested', 'True', '2024-04-24 17:28:07'),
(216, 54, 'Colombo', 'Customer C279 has been requested', 'True', '2024-04-24 17:28:07'),
(217, 54, 'Colombo', 'Customer C279 has been requested', 'True', '2024-04-24 17:28:07'),
(218, 54, 'Colombo', 'Customer C278 has been requested', 'True', '2024-04-24 17:28:07'),
(219, 54, 'Colombo', 'Customer C278 has been requested', 'True', '2024-04-24 17:28:07'),
(220, 54, 'Colombo', 'Customer C222 has been requested', 'True', '2024-04-24 17:28:07'),
(221, 54, 'Colombo', 'Customer C277 has been requested', 'True', '2024-04-24 17:28:07'),
(222, 54, 'Colombo', 'Customer C277 has been requested', 'True', '2024-04-24 17:28:07'),
(223, 54, 'Colombo', 'Customer C276 has been requested', 'True', '2024-04-24 17:28:07'),
(224, 54, 'Colombo', 'Customer C276 has been requested', 'True', '2024-04-24 17:28:07'),
(225, 54, 'Colombo', 'Customer C270 has been requested', 'True', '2024-04-24 17:28:07'),
(226, 54, 'Colombo', 'Customer C270 has been requested', 'True', '2024-04-24 17:28:07'),
(227, 54, 'Colombo', 'Customer C283 has been requested', 'True', '2024-04-26 07:37:38'),
(228, 54, 'Colombo', 'Customer C283 has been requested', 'True', '2024-04-26 07:37:38'),
(229, 54, 'Colombo', 'Req ID 295 has been completed', 'True', '2024-04-26 07:37:38'),
(230, 54, 'Colombo', 'Req ID 308 has been completed', 'True', '2024-04-26 07:37:38'),
(231, 54, 'Colombo', 'Customer C287 has been requested', 'True', '2024-04-26 07:37:38'),
(232, 54, 'Colombo', 'Req ID 310 has been completed', 'True', '2024-04-26 07:37:38'),
(233, 65, 'Jaffna', 'Customer C288 has been requested', 'False', '2024-04-25 15:57:48'),
(234, 65, 'Jaffna', 'Customer C288 has been requested', 'False', '2024-04-25 15:58:42'),
(235, 53, 'Galle', 'Customer C289 has been requested', 'True', '2024-04-26 03:49:26'),
(236, 53, 'Galle', 'Customer C289 has been requested', 'True', '2024-04-26 03:49:26'),
(237, 65, 'Jaffna', 'Customer C290 has been requested', 'False', '2024-04-25 16:08:35'),
(238, 65, 'Jaffna', 'Customer C290 has been requested', 'False', '2024-04-25 16:09:17'),
(239, 65, 'Jaffna', 'Customer C291 has been requested', 'False', '2024-04-25 16:13:48'),
(240, 65, 'Jaffna', 'Customer C291 has been requested', 'False', '2024-04-25 16:14:28'),
(241, 64, 'Polonnaruwa', 'Customer C292 has been requested', 'True', '2024-04-28 12:26:53'),
(242, 64, 'Polonnaruwa', 'Customer C292 has been requested', 'True', '2024-04-28 12:26:53'),
(243, 55, 'Kaluthara', 'Customer C293 has been requested', 'True', '2024-04-28 05:41:51'),
(244, 55, 'Kaluthara', 'Customer C293 has been requested', 'True', '2024-04-28 05:41:51'),
(245, 54, 'Colombo', 'Customer C294 has been requested', 'True', '2024-04-26 07:37:38'),
(246, 54, 'Colombo', 'Customer C294 has been requested', 'True', '2024-04-26 07:37:38'),
(247, 54, 'Colombo', 'Customer C295 has been requested', 'True', '2024-04-26 07:37:38'),
(248, 54, 'Colombo', 'Customer C295 has been requested', 'True', '2024-04-26 07:37:38'),
(249, 57, 'Rathnapura', 'Customer C296 has been requested', 'False', '2024-04-25 16:38:22'),
(250, 57, 'Rathnapura', 'Customer C296 has been requested', 'False', '2024-04-25 16:38:49'),
(251, 57, 'Rathnapura', 'Customer C297 has been requested', 'False', '2024-04-25 16:41:15'),
(252, 57, 'Rathnapura', 'Customer C297 has been requested', 'False', '2024-04-25 16:41:45'),
(253, 54, 'Colombo', 'Req ID 297 has been completed', 'True', '2024-04-26 07:37:38'),
(254, 54, 'Colombo', 'Req ID 299 has been completed', 'True', '2024-04-26 07:37:38'),
(255, 54, 'Colombo', 'Req ID 304 has been completed', 'True', '2024-04-26 07:37:38'),
(256, 54, 'Colombo', 'Req ID 309 has been completed', 'True', '2024-04-26 07:37:38'),
(257, 54, 'Colombo', 'Req ID 296 has been completed', 'True', '2024-04-26 07:37:38'),
(258, 54, 'Colombo', 'Req ID 298 has been completed', 'True', '2024-04-26 07:37:38'),
(259, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-26 03:49:26'),
(260, 54, 'Colombo', 'Customer C278 has been requested', 'True', '2024-04-29 13:28:46'),
(261, 54, 'Colombo', 'Customer C278 has been requested', 'True', '2024-04-29 13:28:46'),
(262, 54, 'Colombo', 'Customer C278 has been requested', 'True', '2024-04-29 13:28:46'),
(265, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-28 04:44:10'),
(266, 54, 'Colombo', 'Customer C307 has been requested', 'True', '2024-04-29 13:28:46'),
(267, 54, 'Colombo', 'Customer C308 has been requested', 'True', '2024-04-29 13:28:46'),
(268, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-28 04:44:10'),
(269, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-28 04:44:10'),
(270, 53, 'Galle', 'Req ID 340 has been completed', 'True', '2024-04-28 04:44:10'),
(271, 53, 'Galle', 'Customer C222 has been requested', 'True', '2024-04-28 04:44:10'),
(272, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-28 04:44:10'),
(273, 53, 'Galle', 'Req ID 342 has been completed', 'True', '2024-04-28 04:44:10'),
(274, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-28 11:35:27'),
(275, 53, 'Galle', 'Customer C258 has been requested', 'True', '2024-04-29 06:33:10'),
(276, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-29 13:28:14'),
(277, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-29 13:28:14'),
(278, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-29 13:28:14'),
(279, 53, 'Galle', 'Req ID 343 has been completed', 'True', '2024-04-29 13:28:14'),
(280, 53, 'Galle', 'Customer C235 has been requested', 'True', '2024-04-29 13:28:14'),
(281, 53, 'Galle', 'Req ID 348 has been completed', 'True', '2024-04-29 13:28:14'),
(282, 53, 'Galle', 'Customer C289 has been requested', 'True', '2024-04-29 13:28:14'),
(283, 54, 'Colombo', 'Customer C375 has been requested', 'True', '2024-04-29 17:14:52'),
(284, 54, 'Colombo', 'Customer C374 has been requested', 'True', '2024-04-29 17:14:52'),
(285, 54, 'Colombo', 'Customer C363 has been requested', 'True', '2024-04-29 17:14:52'),
(286, 54, 'Colombo', 'Customer C360 has been requested', 'True', '2024-04-29 17:14:52'),
(287, 54, 'Colombo', 'Customer C358 has been requested', 'True', '2024-04-29 17:14:52'),
(288, 54, 'Colombo', 'Customer C357 has been requested', 'True', '2024-04-29 17:14:52'),
(289, 54, 'Colombo', 'Customer C310 has been requested', 'True', '2024-04-29 17:14:52'),
(290, 54, 'Colombo', 'Customer C309 has been requested', 'True', '2024-04-29 17:14:52'),
(291, 54, 'Colombo', 'Customer C307 has been requested', 'True', '2024-04-29 17:14:52'),
(292, 54, 'Colombo', 'Customer C295 has been requested', 'True', '2024-04-29 17:14:52'),
(293, 54, 'Colombo', 'Customer C294 has been requested', 'True', '2024-04-29 17:14:52'),
(294, 54, 'Colombo', 'Customer C275 has been requested', 'True', '2024-04-29 17:14:52'),
(295, 54, 'Colombo', 'Customer C272 has been requested', 'True', '2024-04-29 17:14:52'),
(296, 54, 'Colombo', 'Customer C270 has been requested', 'True', '2024-04-29 17:14:52'),
(297, 54, 'Colombo', 'Customer C259 has been requested', 'True', '2024-04-29 17:14:52'),
(298, 54, 'Colombo', 'Customer C234 has been requested', 'True', '2024-04-29 17:14:52'),
(299, 53, 'Galle', 'Customer C235 has been requested', 'True', '2024-04-29 16:59:53'),
(300, 53, 'Galle', 'Customer C255 has been requested', 'True', '2024-04-29 16:59:53'),
(301, 53, 'Galle', 'Customer C258 has been requested', 'True', '2024-04-29 16:59:53'),
(302, 53, 'Galle', 'Customer C289 has been requested', 'True', '2024-04-29 16:59:53'),
(303, 53, 'Galle', 'Customer C289 has been requested', 'True', '2024-04-29 16:59:53'),
(304, 53, 'Galle', 'Customer C221 has been requested', 'True', '2024-04-30 00:52:32'),
(305, 53, 'Galle', 'Req ID 371 has been completed', 'False', '2024-04-30 00:54:32'),
(306, 53, 'Galle', 'Customer C221 has been requested', 'False', '2024-04-30 02:24:43');

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
  `contact_no` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `center_workers`
--

INSERT INTO `center_workers` (`id`, `center_id`, `name`, `nic`, `address`, `dob`, `contact_no`, `created_at`) VALUES
(41, 55, 'dfdg', '122222222222', 'jahajkhn', '2023-12-29', '4444444444', '2024-04-19'),
(42, 53, 'Savindu', '200117600584', 'Galle', '1997-12-22', '0771237419', '2024-04-19'),
(43, 54, 'Damith Sahan', '200029318412', 'Maharagama Srilanka', '2000-04-25', '0775902645', '2024-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `cm_admin`
--

CREATE TABLE `cm_admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `nic` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `selector` text NOT NULL,
  `hashedToken` text NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cm_admin`
--

INSERT INTO `cm_admin` (`id`, `email`, `name`, `address`, `contact_no`, `dob`, `nic`, `password`, `selector`, `hashedToken`, `expires`) VALUES
(13, 'RasinduJayan@gmail.com', 'Rasindu Jayan', 'Galle Srilanka', '0775902645', '1996-09-30', '200117600942', '$2y$10$ZnzwNrFGp/pyzy440a12aOlptEHtksuIJT.0lgDNmn4AVWVy2Eldm', '472bd82f37eea8c5', '$2y$10$5r1Bn16iJQus4euJcD8hUuxCNXLABR5BZzNlDlqM0czfaQ45FjS2G', 1714410647);

-- --------------------------------------------------------

--
-- Table structure for table `collectors`
--

CREATE TABLE `collectors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `center_id` int(11) NOT NULL,
  `center_name` text NOT NULL,
  `nic` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `disable` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collectors`
--

INSERT INTO `collectors` (`id`, `user_id`, `image`, `center_id`, `center_name`, `nic`, `address`, `contact_no`, `dob`, `vehicle_no`, `vehicle_type`, `created_at`, `disable`) VALUES
(42, 226, 'sisira@gmail.com_7.jpg', 53, 'Galle', '200117600555', 'Galle', '0775902645', '2023-11-23', 'FD-1231', 'Car', '2024-04-19', 0),
(43, 227, 'david@gmail.com_b.jpg', 54, 'Colombo', '200117600432', 'Galle', '0775902645', '2023-11-30', 'DR-1241', 'Car', '2024-04-19', 0),
(44, 229, 'Ravindu@gmail.com_5.jpg', 53, 'Galle', '200117600584', 'Galle', '0775902645', '2023-12-03', 'JG-1231', 'Truck', '2024-02-19', 0),
(45, 231, 'nimacollec@gmail.com_7.jpg', 53, 'Galle', '200179203055', 'galle', '0715773463', '2023-12-08', 'AAA-1237', 'Car', '2024-04-19', 0),
(46, 232, 'collector@gmail.com_instagram-profile-picture.jpg', 55, 'kaluthara', '201111111111', 'bkjhbakba', '2222222222', '2023-12-13', 'QW-6781', 'fvadw', '2024-04-19', 0),
(47, 233, 'yoo@gmail.com_unnamed.jpg', 55, 'kaluthara', '122222222222', 'dfwfds', '1111111111', '2023-12-28', 'ER-0981', 'bjkhila', '2024-04-19', 0),
(48, 280, 'kavindupasan@gmail.com_a.jpg', 54, 'Colombo', '200116374211', 'Kaduwela Srilanka', '0721856421', '2001-05-02', 'AB-5234', 'Truck', '2024-04-24', 0),
(49, 281, 'Chanukasirisena@gmail.com_d.jpg', 54, 'Colombo', '199932132132', 'Kotte Srilanka', '0783742121', '1999-03-17', 'GR-2853', 'Lorry', '2024-04-24', 0),
(50, 282, 'LakinduEranga@gmail.com_10.jpg', 54, 'Colombo', '200085231312', 'Rajagiriya Srilanka', '0714453526', '2000-07-03', 'GF-2141', 'Car', '2024-04-24', 0),
(53, 303, 'profile.png', 54, 'Colombo', '200117600512', 'Galle', '0775902645', '2001-04-13', 'KJ-1231', 'Car', '2024-04-26', 0),
(56, 352, 'profile.png', 53, 'Galle', 'Galle', 'Galle', '0775902656', '1998-04-08', 'HG-1231', 'Car', '2024-04-28', 0);

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
  `dob` date NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collector_assistants`
--

INSERT INTO `collector_assistants` (`id`, `collector_id`, `name`, `nic`, `address`, `contact_no`, `dob`, `created_at`) VALUES
(51, 227, 'm', '200179203086', 'k', '0715771508', '2023-11-26', '2024-04-19'),
(52, 229, 'Pasindu', '200179203081', 'Galle', '0715773463', '2023-12-08', '2024-04-19');

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

--
-- Dumping data for table `collector_complains`
--

INSERT INTO `collector_complains` (`id`, `collector_id`, `name`, `center_id`, `contact_no`, `region`, `subject`, `complaint`, `date`) VALUES
(15, 226, 'Sisira', 53, 1212121212, 'Galle', 'Customer Not at home', 'Customer Not at home', '2024-04-29 17:07:12'),
(16, 229, 'Ravindu', 53, 775902645, 'Galle', ' No response', 'Request 349 Customer No response', '2024-04-29 17:09:42'),
(17, 229, 'Ravindu', 53, 775902645, 'Galle', 'Assign', 'assigning is not greate ', '2024-04-29 17:10:46');

-- --------------------------------------------------------

--
-- Table structure for table `collector_temp`
--

CREATE TABLE `collector_temp` (
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `center_id` int(11) NOT NULL,
  `center_name` text NOT NULL,
  `nic` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedToken` varchar(255) NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credits_transfer`
--

CREATE TABLE `credits_transfer` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `transfer_amount` decimal(10,2) NOT NULL,
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credits_transfer`
--

INSERT INTO `credits_transfer` (`id`, `sender_id`, `receiver_id`, `date`, `transfer_amount`, `time`) VALUES
(4, 221, 222, '2023-11-28 18:30:00', 10.00, '13:58:55'),
(5, 228, 221, '2023-11-28 18:30:00', 12.00, '13:58:55'),
(6, 221, 222, '2023-12-01 18:30:00', 11.00, '13:58:55'),
(7, 222, 228, '2023-12-06 18:30:00', 12.57, '13:58:55'),
(8, 234, 235, '2023-12-25 18:30:00', 50.00, '13:58:55'),
(9, 221, 222, '2024-01-06 18:30:00', 1000.00, '13:58:55'),
(10, 221, 228, '2024-01-29 18:30:00', 1.00, '13:58:55'),
(11, 221, 228, '2024-01-29 18:30:00', 1.00, '13:58:55'),
(12, 221, 240, '2024-02-10 18:30:00', 10.00, '13:58:55'),
(13, 247, 221, '2024-02-15 18:30:00', 1.00, '13:58:55'),
(14, 221, 247, '2024-02-15 18:30:00', 100.00, '13:58:55'),
(15, 221, 222, '2024-02-20 18:30:00', 50.00, '13:58:55'),
(16, 255, 221, '2024-02-21 18:30:00', 10.40, '13:58:55'),
(17, 221, 255, '2024-02-21 18:30:00', 120.10, '13:58:55'),
(18, 255, 222, '2024-02-21 18:30:00', 5.00, '13:58:55'),
(19, 256, 221, '2024-02-21 18:30:00', 5.00, '13:58:55'),
(20, 221, 256, '2024-02-21 18:30:00', 50.00, '13:58:55'),
(21, 256, 222, '2024-02-21 18:30:00', 10.00, '13:58:55'),
(22, 248, 241, '2024-04-18 18:30:00', 10.00, '13:58:55'),
(23, 248, 221, '2024-04-18 18:30:00', 10.00, '13:58:55'),
(24, 234, 221, '2024-04-19 18:30:00', 1000.00, '13:58:55'),
(34, 222, 221, '2024-04-21 11:30:00', 10.00, '10:46:21'),
(36, 221, 222, '2024-04-21 14:07:41', 10.00, '19:37:41'),
(37, 221, 222, '2024-04-21 15:06:06', 5.00, '20:36:06'),
(38, 221, 264, '2024-04-27 05:40:45', 10.00, '11:10:45'),
(39, 221, 264, '2024-04-27 05:44:15', 20.00, '11:14:15'),
(40, 221, 298, '2024-04-27 07:45:22', 25.00, '13:15:22'),
(41, 264, 221, '2024-04-27 07:53:52', 10.00, '13:23:52'),
(42, 221, 222, '2024-04-27 08:00:49', 10.00, '13:30:49'),
(43, 222, 221, '2024-04-27 12:38:45', 40.00, '18:08:45'),
(44, 228, 221, '2024-04-27 12:45:15', 2.00, '18:15:15'),
(45, 221, 312, '2024-04-27 12:56:25', 10.00, '18:26:25'),
(46, 221, 222, '2024-04-29 12:03:33', 40.00, '17:33:33'),
(47, 283, 221, '2024-04-29 13:42:58', 30.00, '19:12:58'),
(48, 234, 222, '2024-04-29 13:46:08', 663.00, '19:16:08'),
(49, 221, 222, '2024-04-30 02:20:11', 20.00, '07:50:11');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL DEFAULT 'profile.png',
  `mobile_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `blocked` varchar(25) DEFAULT '0',
  `joined_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `image`, `mobile_number`, `address`, `city`, `blocked`, `joined_date`) VALUES
(61, 221, 'kaveesha@gmail.com_8.jpg', '0775902645', 'Galle', 'Galle', '0', '2024-01-17 13:44:42'),
(62, 222, 'nimal@gmail.com_2.jpg', '0775902645', 'Galle', 'Colombo', '0', '2024-02-17 13:44:42'),
(64, 234, 'wook@gmail.com_3.jpg', '0771273182', 'jioajijma', 'Colombo', '0', '2024-04-17 13:44:42'),
(65, 235, 'kang@gmail.com_2ce023c27b083a8ae9a8945beda96763.jpg', '0717362821', 'Galle Srilanka', 'Galle', '0', '2024-04-17 13:44:42'),
(79, 255, 'Profile.png', '0752512313', 'Galle Srilanka', 'Galle', '0', '2024-04-17 13:44:42'),
(82, 258, 'Profile.png', '0775902645', 'Kaluthara', 'Galle', '0', '2024-01-17 13:44:42'),
(83, 259, 'Profile.png', '0715202245', '132/12/Colombo Srilanka', 'Colombo', '0', '2024-03-17 13:44:42'),
(94, 270, 'SavinduKaveesha@gmail.com_d.jpg', '0775902645', 'Kaluthara', 'Colombo', '0', '2024-01-17 13:44:42'),
(95, 271, 'Profile.png', '0775902645', 'Galle', 'Kaluthara', '0', '2024-01-17 13:44:42'),
(96, 272, 'RavinduYasas@gmail.com_3.jpg', '0758324192', 'Colombo 7 Malwaththa road 13', 'Colombo', '0', '2024-04-17 13:44:42'),
(97, 275, 'Profile.png', '0775902645', 'Colombo Srilanka', 'Colombo', '0', '2024-04-21 05:01:59'),
(98, 276, 'Profile.png', '0111233211', 'Colombo Srilanka', 'Colombo', '0', '2024-04-24 08:27:42'),
(99, 277, 'JanakaSilva10@gmail.com_7.jpg', '0718231331', 'Colombo Srilanka', 'Colombo', '0', '2024-01-24 08:32:03'),
(100, 278, 'AyeshPramuditha11@gmail.com_1.jpg', '0726347446', 'Colombo Homagama Srilanka', 'Jaffna', '0', '2024-01-19 04:38:40'),
(101, 279, 'SanathNishantha@gmail.com_10.jpg', '0771572512', 'Colombo', 'Colombo', '0', '2024-04-24 09:33:15'),
(102, 283, 'Profile.png', '0728812032', 'Maradhana Colombo', 'Colombo', '0', '2024-04-25 03:40:24'),
(103, 285, 'Profile.png', '0779283183', 'Jafna Srilakassssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 'Jaffna', '0', '2024-04-25 07:58:48'),
(104, 286, 'Profile.png', '0773419942', 'Jafna Srilanka', 'Jaffna', '0', '2024-04-25 08:00:17'),
(105, 287, 'Profile.png', '0775902645', 'Colombo', 'Colombo', '0', '2024-04-25 10:10:18'),
(106, 288, 'binuri123@gmail.com_1000_F_607848231_w5iFN4tMmtI2woJjMh7Q8mGvgARnzHgQ.jpg', '0715771501', 'jaffna,sri lanka', 'Jaffna', '0', '2024-04-25 15:56:12'),
(107, 289, 'kasuniamanda@gmail.com_close-up-portrait-businesswoman-against-white-background_1048944-5549240.jpg', '0715773463', 'galle,yakkalamulla', 'Galle', '0', '2024-04-25 16:02:00'),
(108, 290, 'sithumini@gmail.com_portrait-pretty-smiling-woman-posing-white-background.jpg', '0772476456', 'jaffana,puthukkudiyirippu', 'Jaffna', '0', '2024-04-25 16:07:48'),
(109, 291, 'sanduni@gmail.com_front-view-serious-woman.jpg', '0715771508', 'jaffana,kokuvil', 'Jaffna', '0', '2024-04-25 16:12:54'),
(110, 292, 'dinu@gmail.com_close-up-young-person-barbeque.jpg', '0772476456', 'girithale,polonnaruwa', 'Polonnaruwa', '0', '2024-04-25 16:16:22'),
(111, 293, 'nimna@gmail.com_beautiful-caucasian-businesswoman-glasses.jpg', '0715771502', 'kaluthara', 'Kaluthara', '0', '2024-04-25 16:22:26'),
(112, 294, 'Tharushi@gmail.com_portrait-business-woman-office.jpg', '0715773463', 'nugegoda,colombo 7', 'Colombo', '0', '2024-04-25 16:30:25'),
(113, 295, 'nethmini@gmail.com_portrait-smiling-blonde-businesswoman-formal-dressed-isolated-dark-textured-background.jpg', '0715773462', 'nugegoda,colombo 9', 'Colombo', '0', '2024-04-25 16:33:49'),
(114, 296, 'samantha@gmail.com_brunette-woman-with-shirt-posing.jpg', '0715773463', 'rathnapura', 'Rathnapura', '0', '2024-04-25 16:37:38'),
(115, 297, 'nadee@gmail.com_front-view-professional-business-woman-suit.jpg', '0715773462', 'rathnapura', 'Rathnapura', '0', '2024-04-25 16:40:22'),
(117, 307, 'Profile.png', '0775341293', 'Colombo Srilanka', 'Colombo', '0', '2024-04-27 08:28:41'),
(118, 308, 'Profile.png', '0775902645', 'Colombo Srilanka', 'Colombo', '0', '2024-04-27 08:40:54'),
(119, 309, 'Profile.png', '0775902645', 'Colombo Srilanka', 'Colombo', '0', '2024-04-27 08:54:47'),
(120, 310, 'Profile.png', '0775902645', 'Colombo Srilanka', 'Colombo', '0', '2024-04-27 09:33:33'),
(122, 313, 'Profile.png', '0775901943', 'Galle', 'Rathnapura', '0', '2024-04-27 13:49:57'),
(137, 339, 'profile.png', '1111111111', 'malithmilanga123@gmail.com', 'Batticaloa', '0', '2024-04-27 20:44:51'),
(138, 348, 'profile.png', '775902645', 'Kaveesha11111@gmail.com', 'Kurunagala', '0', '2024-04-28 09:20:28'),
(139, 357, 'profile.png', '0714526718', '23/A, ganemulla road, kelaniya', 'Colombo', '0', '2024-04-28 17:12:37'),
(140, 358, 'amanda@gmail.com_happy-chinese-woman-cool_1149-1851.jpg', '0771236517', 'N0:12, Viharamahadevi road, Kelaniya', 'Colombo', '0', '2024-04-28 17:14:35'),
(141, 359, 'oshada@gmail.com_handsome-smiling-man-looking-with-disbelief_176420-19591.jpg', '0772218911', '23/B, flower road, kelaniya', 'Gampaha', '0', '2024-04-28 18:17:10'),
(142, 360, 'profile.png', '0768234327', '75, Malwana, dekatana', 'Colombo', '0', '2024-04-28 18:18:06'),
(143, 361, 'asindu@gmail.com_portrait-teenage-boy_23-2148105585.jpg', '0722536114', 'No:123, waragoda road, Kelaniya', 'Gampaha', '0', '2024-04-28 18:22:20'),
(144, 362, 'kavishka@gmail.com_smiling-young-brunette-caucasian-man-isolated-pink-wall-with-copy-space_141793-116910.jpg', '0786115622', 'N0:12, horana road, Kaluthara', 'Kaluthara', '0', '2024-04-28 18:24:02'),
(145, 363, 'anuhas@gmail.com_young-guy-with-curly-hair-dresses-casual-maroon-t-hirt-white-concrete-wall-people-youth-clothing-advertisement-concept_176532-8993.jpg', '0712236574', '20, manik road, rathnapura', 'Colombo', '0', '2024-04-28 18:25:58'),
(146, 364, 'chamya@gmail.com_4.jpg', '0725671234', '25, polonnaru road, polonnaruwa', 'Polonnaruwa', '0', '2024-04-28 18:29:10'),
(147, 365, 'vijay@gmail.com_medium-shot-man-sticking-out-tongue_23-2150171206.jpg', '0762254463', '78, velu road, jaffna', 'Jaffna', '0', '2024-04-28 18:30:28'),
(148, 366, 'jeewaka@gmail.com_handsome-smiling-man-looking-with-disbelief_176420-19591.jpg', '0781225648', '90, kandy road, kandy', 'Kandy', '0', '2024-04-28 18:30:52'),
(149, 367, 'supun@gmail.com_smiling-young-brunette-caucasian-man-isolated-pink-wall-with-copy-space_141793-116910.jpg', '0715674530', '45, flower road, batticaloa', 'Batticaloa', '0', '2024-04-28 18:31:49'),
(150, 368, 'danith@gmail.com_portrait-smiley-man-outdoor_23-2148514954.jpg', '0752637819', '89, kuragala road, kurunagala', 'Kurunagala', '0', '2024-04-28 18:33:56'),
(151, 369, 'sithara@gmail.com_picture-serious-calm-female-with-pleasant-appearance_176532-7182.jpg', '0757826773', '67, haggala road, nuwaraeliya', 'Colombo', '0', '2024-04-28 18:34:21'),
(152, 370, 'abdulla@gmail.com_close-up-portrait-handsome-smiling-young-man-white-t-shirt-looking-away-blurry-outdoor-nature_176420-6304.jpg', '0764562781', '67, chaya blue road, trincomalee', 'Trincomalee', '0', '2024-04-28 18:35:05'),
(153, 371, 'manimekala@gmail.com_close-up-shot-hopeful-optimistic-happy-young-redhead-20s-girl-with-freckles-long-hair-smiling-joyfully-with-faith-eyes-prominent-look-posing-against-purple-background_1258-81590.jpg', '0762534516', '56, eppodum road, vavuniya', 'Vavuniya', '0', '2024-04-28 18:36:08'),
(154, 372, 'kadiresa@gmail.com_handsome-man-with-glasses_144627-18650.jpg', '0768901133', '12, kovil road, vauniya', 'Vavuniya', '0', '2024-04-28 18:36:33'),
(155, 373, 'fathima@gmail.com_portrait-woman-dark-green-tshirt_176420-28784.jpg', '0768123255', '67, muththaiya road, ampara', 'Ampara', '0', '2024-04-28 18:37:20'),
(156, 374, 'profile.png', '0775902645', 'colombo srilanka', 'Colombo', '0', '2024-04-29 11:54:31'),
(157, 375, 'profile.png', '0775902645', 'Colombo Srilanka', 'Colombo', '0', '2024-04-29 12:21:27'),
(158, 376, 'profile.png', '0775902554', 'Polonnaruwa Srilanka', 'Polonnaruwa', '0', '2024-04-30 02:19:32');

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

--
-- Dumping data for table `customer_complains`
--

INSERT INTO `customer_complains` (`id`, `customer_id`, `name`, `contact_no`, `region`, `subject`, `complaint`, `date`) VALUES
(74, 221, 'Kaveesha', '0775902645', 'Galle', 'App is slow', 'App is slow', '2023-12-10 14:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `customer_credits`
--

CREATE TABLE `customer_credits` (
  `user_id` int(11) NOT NULL,
  `credit_amount` decimal(15,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_credits`
--

INSERT INTO `customer_credits` (`user_id`, `credit_amount`, `created_at`) VALUES
(221, 3426.51, '2023-11-26 00:41:05'),
(222, 1671.43, '2023-11-26 00:42:05'),
(234, 0.00, '2023-12-19 21:34:58'),
(235, 405.50, '2023-12-20 22:41:46'),
(255, 276.00, '2024-02-19 13:51:16'),
(258, -50.00, '2024-02-22 20:51:51'),
(259, 0.00, '2024-02-22 20:53:06'),
(270, 0.00, '2024-02-22 21:13:29'),
(271, 0.00, '2024-02-22 21:17:22'),
(272, 1167.60, '2024-02-23 09:22:37'),
(275, 0.00, '2024-04-21 10:31:59'),
(276, 1507.00, '2024-04-24 13:57:42'),
(277, 0.00, '2024-04-24 14:02:03'),
(278, 1137.40, '2024-04-24 14:08:40'),
(279, 1038.40, '2024-04-24 15:03:15'),
(283, 60.00, '2024-04-25 09:10:24'),
(285, 0.00, '2024-04-25 13:28:48'),
(286, 0.00, '2024-04-25 13:30:17'),
(287, 350.00, '2024-04-25 15:40:18'),
(288, 0.00, '2024-04-25 21:26:12'),
(289, 0.00, '2024-04-25 21:32:00'),
(290, 0.00, '2024-04-25 21:37:48'),
(291, 0.00, '2024-04-25 21:42:54'),
(292, 0.00, '2024-04-25 21:46:22'),
(293, 0.00, '2024-04-25 21:52:26'),
(294, 0.00, '2024-04-25 22:00:25'),
(295, 0.00, '2024-04-25 22:03:49'),
(296, 0.00, '2024-04-25 22:07:38'),
(297, 0.00, '2024-04-25 22:10:22'),
(307, 0.00, '2024-04-27 13:58:41'),
(308, 0.00, '2024-04-27 14:10:54'),
(309, 0.00, '2024-04-27 14:24:47'),
(310, 0.00, '2024-04-27 15:03:33'),
(313, 0.00, '2024-04-27 19:19:57'),
(339, 0.00, '2024-04-28 02:14:51'),
(348, 0.00, '2024-04-28 14:50:28'),
(357, 0.00, '2024-04-28 22:42:37'),
(358, 0.00, '2024-04-28 22:44:35'),
(359, 0.00, '2024-04-28 23:47:10'),
(360, 0.00, '2024-04-28 23:48:06'),
(361, 0.00, '2024-04-28 23:52:20'),
(362, 0.00, '2024-04-28 23:54:02'),
(363, 0.00, '2024-04-28 23:55:58'),
(364, 0.00, '2024-04-28 23:59:10'),
(365, 0.00, '2024-04-29 00:00:28'),
(366, 0.00, '2024-04-29 00:00:52'),
(367, 0.00, '2024-04-29 00:01:49'),
(368, 0.00, '2024-04-29 00:03:56'),
(369, 0.00, '2024-04-29 00:04:21'),
(370, 0.00, '2024-04-29 00:05:05'),
(371, 0.00, '2024-04-29 00:06:08'),
(372, 0.00, '2024-04-29 00:06:33'),
(373, 0.00, '2024-04-29 00:07:20'),
(374, 0.00, '2024-04-29 17:24:31'),
(375, 0.00, '2024-04-29 17:51:27'),
(376, 0.00, '2024-04-30 07:49:32');

-- --------------------------------------------------------

--
-- Table structure for table `discountagent_credit`
--

CREATE TABLE `discountagent_credit` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `credited_date` date NOT NULL DEFAULT current_timestamp(),
  `credited_amount` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discountagent_credit`
--

INSERT INTO `discountagent_credit` (`id`, `agent_id`, `credited_date`, `credited_amount`) VALUES
(1, 251, '2024-04-18', 1500.00),
(2, 250, '2024-04-18', 1500.00),
(7, 250, '2024-04-18', 100.00),
(8, 251, '2024-04-18', 500.00),
(9, 250, '2024-04-19', 10.00),
(10, 250, '2024-04-19', 10.00),
(11, 250, '2024-04-19', 10.00),
(12, 250, '2024-04-19', 10.00),
(13, 251, '2024-04-22', 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `center` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`discount_id`, `agent_id`, `customer_id`, `customer_name`, `discount_amount`, `center`, `created_at`) VALUES
(44, 251, 221, 'Kaveesha', 10.00, 'Thibirigasyaya', '2024-04-27 05:42:19'),
(45, 251, 221, 'Kaveesha', 10.00, 'Thibirigasyaya', '2024-04-27 05:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `discount_agents`
--

CREATE TABLE `discount_agents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `credits` decimal(20,3) NOT NULL,
  `disable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount_agents`
--

INSERT INTO `discount_agents` (`id`, `user_id`, `image`, `contact_no`, `address`, `credits`, `disable`) VALUES
(2, 250, 'Keels@gmail.com_channels4_profile.jpg', '0775902645', 'Colombo 7 Srilankan', 1640.000, 0),
(3, 251, 'cargeels@gmail.com_Untitled.png', '0775902645', 'Colombo', 1590.000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fines`
--

CREATE TABLE `fines` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `fine_amount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fines`
--

INSERT INTO `fines` (`id`, `type`, `fine_amount`) VALUES
(1, 'minimum_collect', 100.00),
(2, 'no_response', 150.00),
(3, 'cancelling_assigned', 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `garbage_confirmed`
--

CREATE TABLE `garbage_confirmed` (
  `req_id` int(11) NOT NULL,
  `collector_id` int(11) NOT NULL,
  `plastic` decimal(10,2) NOT NULL DEFAULT 0.00,
  `polythene` decimal(10,2) NOT NULL DEFAULT 0.00,
  `metals` decimal(10,2) NOT NULL DEFAULT 0.00,
  `glass` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paper_waste` decimal(10,2) NOT NULL DEFAULT 0.00,
  `electronic_waste` decimal(10,2) NOT NULL DEFAULT 0.00,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garbage_confirmed`
--

INSERT INTO `garbage_confirmed` (`req_id`, `collector_id`, `plastic`, `polythene`, `metals`, `glass`, `paper_waste`, `electronic_waste`, `note`) VALUES
(86, 229, 3.00, 1.00, 6.00, 5.00, 2.00, 4.00, 'Polythene Plasics Glass Paper_Waste Electronic_Waste Metals'),
(88, 229, 0.00, 9.00, 0.00, 0.00, 0.00, 0.00, 'Polythene Bags'),
(90, 229, 1.00, 2.00, 8.90, 1.90, 2.02, 3.40, 'all'),
(91, 229, 0.00, 0.00, 0.00, 1.00, 0.00, 0.00, 'Glass'),
(92, 229, 1.00, 0.00, 0.00, 1.00, 0.00, 0.00, 'Plastic Glass'),
(93, 229, 0.00, 0.00, 0.00, 1.00, 0.00, 0.00, 'Glass'),
(94, 229, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Plastic'),
(95, 229, 0.00, 0.00, 0.00, 1.21, 0.00, 0.00, 'glass'),
(109, 229, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Plastic'),
(113, 229, 1.00, 0.00, 0.00, 1.20, 0.00, 0.00, 'Glass Plastic'),
(130, 229, 33.00, 11.00, 66.00, 55.00, 22.00, 44.00, 'Glass Electronics Metals Papers'),
(181, 229, 1.00, 0.00, 0.00, 1.00, 0.00, 0.00, 'Plastic Glass'),
(198, 229, 0.00, 0.00, 0.00, 11.00, 0.00, 0.00, 'Glass'),
(199, 229, 0.00, 0.00, 0.00, 111.00, 0.00, 0.00, 'Glass'),
(204, 229, 11.00, 11.00, 11.00, 11.00, 11.00, 11.00, 'Glass Platistcs'),
(205, 229, 111.00, 11.00, 11.00, 11.00, 11.00, 11.00, 'Plastics'),
(207, 229, 11.00, 11.00, 11.00, 11.00, 11.00, 11.00, 'Same as the collect'),
(271, 229, 0.00, 0.00, 0.00, 0.00, 0.00, 99.00, 'Electronics'),
(284, 229, 1.20, 11.10, 9.00, 4.10, 6.10, 7.00, 'All the things'),
(288, 229, 0.00, 0.00, 0.00, 1.60, 2.00, 0.00, 'Glass'),
(295, 227, 0.00, 0.00, 0.00, 5.94, 0.00, 0.00, 'Correct Details'),
(296, 227, 12.00, 34.00, 0.00, 0.00, 0.00, 0.00, 'Confiremed'),
(297, 227, 10.00, 0.00, 0.00, 0.00, 9.00, 0.00, 'Confirm'),
(298, 227, 0.00, 0.00, 12.40, 0.00, 0.00, 0.00, 'Confirm'),
(299, 227, 8.00, 8.00, 9.40, 5.80, 6.00, 0.00, 'Confirm'),
(304, 227, 20.80, 6.00, 0.00, 4.78, 6.89, 6.00, 'Confirmed'),
(308, 281, 0.00, 0.00, 0.00, 0.00, 4.50, 0.00, 'Correct details'),
(310, 227, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Confirm'),
(342, 229, 0.00, 0.00, 0.00, 10.00, 0.00, 0.00, 'Glass Bottles'),
(343, 229, 12.00, 0.00, 0.00, 31.00, 0.00, 0.00, 'Plastic Glass');

-- --------------------------------------------------------

--
-- Table structure for table `garbage_types`
--

CREATE TABLE `garbage_types` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `credits_per_waste_quantity` int(11) NOT NULL,
  `approximate_amount` decimal(10,1) NOT NULL,
  `minimum_amount` decimal(10,1) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garbage_types`
--

INSERT INTO `garbage_types` (`ID`, `name`, `credits_per_waste_quantity`, `approximate_amount`, `minimum_amount`, `selling_price`, `icon`) VALUES
(1, 'plastic', 20, 5.0, 3.5, 60.00, 'icon fas fa-trash'),
(2, 'polythene', 15, 4.0, 2.0, 44.00, 'icon fas fa-box'),
(3, 'glass', 10, 6.0, 4.0, 20.00, 'icon fas fa-glass-whiskey'),
(4, 'paper', 21, 5.0, 4.0, 48.00, 'icon fas fa-file-alt'),
(5, 'electronic', 13, 3.0, 1.5, 30.00, 'icon fas fa-laptop'),
(6, 'metals', 30, 10.0, 7.0, 105.00, 'icon fas fa-box');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `center_id`, `region`, `date`) VALUES
(71, 53, 'Galle', '2024-01-04'),
(72, 53, 'Galle', '2024-01-16'),
(73, 53, 'Galle', '2024-01-17'),
(74, 53, 'Galle', '2024-01-11'),
(76, 53, 'Galle', '2024-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `mail_subscriptions`
--

CREATE TABLE `mail_subscriptions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mail_subscriptions`
--

INSERT INTO `mail_subscriptions` (`id`, `name`, `email`, `date_time`) VALUES
(1, 'dinithi', 'dinu@gmail.com', '2024-04-13 19:49:23'),
(2, 'Mohomad Nasif', 'MohomadNasif@gmail.com', '2024-04-25 02:54:07'),
(11, 'Hanafi Mira', 'Hanafimira@gmail.com', '2024-04-25 02:53:45'),
(12, 'nimalsha herath', 'nimalshaherath@gmail.com', '2024-04-25 02:44:56'),
(14, 'Gayani Chanchala', 'GayaniChanchala@gmail.com', '2024-04-25 02:53:24'),
(15, 'denuwanperera', 'denuwanperera@gmail.com', '2024-04-25 02:44:34'),
(16, 'Kavindu Yasas', 'KavinduYasas@gmail.com', '2024-04-25 02:44:02'),
(17, 'tharindudhanjaya', 'tharindudhanjaya@gmail.ocm', '2024-04-25 02:43:37'),
(18, 'Savindu kaveesha', 'Savindukaveesha@gmail.com', '2024-04-25 02:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(7, 'ravindu@gmail.com', 'a7725f38fbf564de', '$2y$10$AOrMZlg8uvheNePXqQAP.uXrjRA/Ig/QkwpUnrlLlZohoriMSPkmq', '1714244494'),
(22, 'ayeshpramuditha@gmail.com', '34beb49a7a333d72', '$2y$10$c6FprCtcbyQ2aDzmzYIDt.CigPyRB2eUt5WT7t5AtghWp/0pYLUOe', '1714318976'),
(25, 'kaveesha@gmail.com', '99488a76075932c5', '$2y$10$jaRsurXcszctr28h9r87nOQnpyk5FNmhUJRevOgdDNrd20ILGt9Bq', '1714410759');

-- --------------------------------------------------------

--
-- Table structure for table `released_stocks`
--

CREATE TABLE `released_stocks` (
  `release_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `plastic` decimal(10,2) NOT NULL DEFAULT 0.00,
  `polythene` decimal(10,2) NOT NULL DEFAULT 0.00,
  `metals` decimal(10,2) NOT NULL DEFAULT 0.00,
  `glass` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paper_waste` decimal(10,2) NOT NULL DEFAULT 0.00,
  `electronic_waste` decimal(10,2) NOT NULL DEFAULT 0.00,
  `released_person` varchar(255) NOT NULL,
  `release_note` text NOT NULL,
  `released_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `income` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `released_stocks`
--

INSERT INTO `released_stocks` (`release_id`, `center_id`, `plastic`, `polythene`, `metals`, `glass`, `paper_waste`, `electronic_waste`, `released_person`, `release_note`, `released_date_time`, `income`) VALUES
(6, 53, 1.00, 0.00, 0.00, 1.00, 0.00, 0.00, 'Recycle Lanka', 'Plastics Glass', '2024-04-25 03:06:17', 500.00),
(7, 53, 1.00, 0.00, 0.00, 1.00, 0.00, 0.00, 'Recycle Lanka', 'Glass ', '2024-04-25 03:06:17', 500.00),
(8, 53, 0.00, 1.00, 0.00, 0.00, 0.00, 0.00, 'Recycle Lanka', 'Polythene', '2024-04-25 03:06:17', 200.00),
(9, 53, 0.00, 1.00, 0.00, 0.00, 0.00, 0.00, 'Recycle Lanka', 'Polythene', '2024-04-25 03:06:17', 200.00),
(10, 53, 0.00, 1.00, 0.00, 0.00, 0.00, 0.00, 'Recycle Lanka', 'Polythene', '2024-04-25 03:06:17', 200.00),
(11, 53, 0.00, 1.00, 0.00, 0.00, 0.00, 0.00, 'Recycle Lanka', 'Polythene', '2024-04-25 03:06:17', 200.00),
(12, 53, 1.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Recycle Lanka', 'Plastics', '2024-04-25 03:06:17', 100.00),
(13, 53, 0.00, 0.00, 0.00, 1.00, 0.00, 0.00, 'Recycle Lanka', 'Glass', '2024-04-25 03:06:17', 400.00),
(14, 53, 0.00, 0.00, 1.00, 0.00, 0.00, 0.00, 'Recycle Lanka', 'Metals', '2024-04-25 03:06:17', 500.00),
(16, 53, 0.00, 0.00, 2.00, 12.00, 0.00, 0.00, 'Recycle', 'confirmed', '2024-04-29 12:30:19', 450.00),
(17, 53, 100.00, 50.00, 0.00, 50.00, 40.00, 10.00, 'Recycle Lanka', 'Plastic Paper Electronic Glass Polythene', '2024-04-29 13:26:17', 11420.00),
(18, 53, 0.00, 0.00, 100.00, 0.00, 0.00, 0.00, 'Recycle Lanka', 'Metals', '2024-04-29 13:26:40', 10500.00),
(19, 53, 0.00, 0.00, 0.00, 100.00, 0.00, 100.00, 'Recycle Lanka', 'Plastic Electronic', '2024-04-29 13:27:28', 5000.00),
(20, 53, 0.00, 0.00, 50.00, 0.00, 0.00, 0.00, 'Sustatinable.lk', 'Metals', '2024-04-29 13:27:58', 5250.00),
(21, 54, 0.00, 0.00, 0.00, 0.00, 20.00, 0.00, 'Sustatinable.lk', 'Paper 40KG', '2024-04-29 13:30:10', 960.00),
(22, 54, 40.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Hello', 'Polythene', '2024-04-29 13:30:24', 2400.00),
(23, 54, 0.00, 0.00, 0.00, 0.00, 0.00, 14.00, 'Sustatinable.lk', 'Electronics', '2024-04-29 13:30:38', 420.00),
(24, 54, 0.00, 20.00, 0.00, 0.00, 0.00, 0.00, 'Sustatinable.lk', 'Polythene', '2024-04-29 13:30:59', 880.00);

-- --------------------------------------------------------

--
-- Table structure for table `request_assigned`
--

CREATE TABLE `request_assigned` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `collector_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'assinged',
  `code` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_assigned`
--

INSERT INTO `request_assigned` (`id`, `req_id`, `collector_id`, `status`, `code`) VALUES
(62, 80, 226, 'assinged', 0),
(66, 86, 229, 'assinged', 0),
(68, 87, 229, 'assinged', 0),
(69, 90, 229, 'assinged', 0),
(70, 88, 229, 'assinged', 0),
(72, 91, 229, 'assinged', 0),
(73, 92, 229, 'assinged', 0),
(74, 93, 229, 'assinged', 0),
(75, 94, 229, 'assinged', 0),
(76, 95, 229, 'assinged', 0),
(91, 109, 229, 'assinged', 0),
(101, 113, 229, 'assinged', 0),
(116, 84, 233, 'ontheway', 403479),
(121, 127, 229, 'ontheway', 0),
(123, 130, 229, 'assinged', 0),
(163, 178, 229, 'ontheway', 0),
(166, 181, 229, 'ontheway', 0),
(179, 194, 229, 'ontheway', 0),
(180, 195, 229, 'ontheway', 0),
(182, 198, 229, 'ontheway', 0),
(183, 199, 229, 'ontheway', 0),
(184, 200, 229, 'ontheway', 0),
(188, 204, 229, 'ontheway', 0),
(189, 205, 229, 'ontheway', 0),
(190, 206, 229, 'ontheway', 0),
(191, 207, 229, 'ontheway', 0),
(222, 239, 229, 'ontheway', 0),
(223, 240, 229, 'assinged', 0),
(229, 246, 229, 'assinged', 0),
(235, 252, 229, 'assinged', 0),
(237, 259, 229, 'ontheway', 0),
(238, 260, 229, 'ontheway', 0),
(239, 261, 229, 'ontheway', 0),
(240, 262, 229, 'ontheway', 0),
(241, 263, 229, 'ontheway', 0),
(247, 269, 229, 'ontheway', 0),
(249, 132, 227, 'ontheway', 0),
(250, 271, 229, 'ontheway', 743387),
(257, 284, 229, 'ontheway', 0),
(262, 276, 226, 'assinged', 0),
(264, 278, 229, 'ontheway', 0),
(266, 292, 229, 'assinged', 0),
(267, 288, 229, 'ontheway', 251309),
(268, 289, 229, 'ontheway', 364941),
(269, 290, 229, 'ontheway', 744463),
(272, 295, 227, 'ontheway', 986090),
(273, 297, 227, 'ontheway', 528405),
(274, 299, 227, 'ontheway', 736194),
(275, 302, 280, 'assinged', 0),
(277, 306, 280, 'assinged', 0),
(278, 308, 281, 'ontheway', 46681),
(279, 304, 227, 'ontheway', 307802),
(280, 310, 227, 'ontheway', 663008),
(282, 296, 227, 'ontheway', 141000),
(283, 298, 227, 'ontheway', 755825),
(284, 314, 229, 'assinged', 0),
(285, 331, 229, 'assinged', 0),
(286, 324, 280, 'assinged', 0),
(287, 325, 280, 'assinged', 0),
(288, 323, 227, 'assinged', 0),
(289, 333, 280, 'ontheway', 0),
(291, 340, 229, 'ontheway', 393173),
(292, 341, 229, 'ontheway', 0),
(293, 342, 229, 'ontheway', 526400),
(294, 343, 229, 'ontheway', 71791),
(295, 344, 226, 'assinged', 0),
(299, 348, 229, 'ontheway', 137709),
(300, 349, 229, 'ontheway', 0),
(301, 350, 280, 'assinged', 0),
(302, 351, 280, 'assinged', 0),
(303, 352, 280, 'assinged', 0),
(304, 353, 280, 'assinged', 0),
(305, 355, 227, 'assinged', 0),
(306, 354, 281, 'assinged', 0),
(307, 366, 229, 'assinged', 0),
(308, 367, 229, 'assinged', 0),
(309, 369, 229, 'assinged', 0);

-- --------------------------------------------------------

--
-- Table structure for table `request_cancelled`
--

CREATE TABLE `request_cancelled` (
  `req_id` int(11) NOT NULL,
  `cancelled_by` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `assinged` varchar(255) NOT NULL DEFAULT 'No',
  `collector_id` int(11) NOT NULL,
  `fine` int(11) NOT NULL DEFAULT 0,
  `fine_type` varchar(255) NOT NULL DEFAULT 'none',
  `cancelled_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_cancelled`
--

INSERT INTO `request_cancelled` (`req_id`, `cancelled_by`, `reason`, `assinged`, `collector_id`, `fine`, `fine_type`, `cancelled_time`) VALUES
(80, 'Center', 'None', 'No', 0, 0, 'None', '2023-12-29 01:25:34'),
(87, 'Collector', 'cant find place', 'Yes', 229, 0, 'None', '2024-01-27 01:24:51'),
(120, 'Customer', '', 'No', 0, 0, 'None', '2024-01-29 21:43:28'),
(127, 'Collector', 'Sorry Couldn\'t reach at the time', 'Yes', 229, 0, 'None', '2024-01-23 01:24:51'),
(128, 'Center', 'Sorry We are not capable to full fill the request', 'No', 0, 0, 'None', '2024-01-22 01:24:51'),
(129, 'Center', 'Sorry We are not capable to full fill the request', 'No', 0, 0, 'None', '2024-01-22 01:24:51'),
(131, 'Center', 'Sorry We are not capable to full fill the request', 'No', 0, 0, 'None', '2024-01-23 01:24:51'),
(133, 'Center', 'Sorry We are not capable to full fill the request', 'No', 0, 0, 'None', '2024-01-16 01:24:51'),
(206, 'Collector', 'Sorry Vehicle Error Occurred', 'Yes', 229, 0, 'None', '2024-01-25 00:00:00'),
(239, 'Collector', 'Sorry Vehicle Error Occurred', 'Yes', 229, 0, 'None', '2024-01-30 11:27:37'),
(240, 'Customer', 'none', 'Yes', 229, 0, 'None', '2024-01-15 00:00:00'),
(246, 'Customer', 'none', 'Yes', 229, 100, 'Cancelled Assigned Req', '2024-02-02 19:55:45'),
(252, 'Customer', 'none', 'Yes', 229, 0, 'None', '2024-02-18 00:00:00'),
(258, 'Center', 'Sorry We are not capable to full fill the request', 'No', 0, 0, 'None', '2024-02-20 00:00:00'),
(273, 'Center', 'Sorry We are not capable to full fill the request', 'No', 0, 0, 'None', '2024-02-04 00:00:00'),
(276, 'Customer', 'none', 'Yes', 226, 0, 'None', '2024-02-18 00:00:00'),
(278, 'Customer', 'none', 'Yes', 229, 0, 'None', '2024-04-21 14:12:05'),
(291, 'Customer', 'none', 'No', 0, 0, 'None', '2024-04-21 13:23:49'),
(292, 'Customer', 'none', 'Yes', 229, 50, 'Cancelled Assigned Req', '2024-04-21 20:15:09'),
(305, 'Center', 'Sorry We are not capable to full fill the request', 'No', 0, 0, 'None', '2024-04-24 23:04:00'),
(306, 'System', 'None', 'assinged', 280, 0, 'None', '2024-04-26 15:22:33'),
(311, 'System', 'None', '', 0, 0, 'None', '2024-04-27 00:20:20'),
(312, 'System', 'None', '', 0, 0, 'None', '2024-04-28 02:05:08'),
(313, 'System', 'None', '', 0, 0, 'None', '2024-04-27 00:20:20'),
(314, 'System', 'None', 'assinged', 229, 0, 'None', '2024-04-26 15:24:33'),
(315, 'System', 'None', '', 0, 0, 'None', '2024-04-27 00:20:20'),
(316, 'System', 'None', '', 0, 0, 'None', '2024-04-28 02:05:08'),
(317, 'System', 'None', '', 0, 0, 'None', '2024-04-27 00:20:20'),
(318, 'System', 'None', '', 0, 0, 'None', '2024-04-28 02:05:08'),
(319, 'System', 'None', '', 0, 0, 'None', '2024-04-27 00:20:20'),
(320, 'System', 'None', '', 0, 0, 'None', '2024-04-28 02:05:08'),
(321, 'System', 'None', '', 0, 0, 'None', '2024-04-27 00:20:20'),
(322, 'System', 'None', '', 0, 0, 'None', '2024-04-28 02:05:08'),
(323, 'System', 'None', 'assinged', 227, 0, 'None', '2024-04-28 02:05:08'),
(324, 'System', 'None', 'assinged', 280, 0, 'None', '2024-04-26 16:34:18'),
(325, 'System', 'None', 'assinged', 280, 0, 'None', '2024-04-26 16:36:34'),
(326, 'System', 'None', '', 0, 0, 'None', '2024-04-28 02:05:08'),
(327, 'System', 'None', '', 0, 0, 'None', '2024-04-27 00:20:20'),
(328, 'System', 'None', '', 0, 0, 'None', '2024-04-28 02:05:08'),
(329, 'System', 'None', '', 0, 0, 'None', '2024-04-27 00:20:20'),
(330, 'System', 'None', '', 0, 0, 'None', '2024-04-28 02:05:08'),
(331, 'System', 'None', 'assinged', 229, 0, 'None', '2024-04-25 15:24:33'),
(333, 'System', 'None', 'ontheway', 280, 0, 'None', '2024-04-26 17:07:24'),
(334, 'System', 'None', '', 0, 0, 'None', '2024-04-26 16:57:34'),
(337, 'System', 'None', '', 0, 0, 'None', '2024-04-29 12:27:47'),
(338, 'System', 'None', '', 0, 0, 'None', '2024-04-29 12:27:47'),
(341, 'Customer', 'none', 'Yes', 229, 50, 'Cancelled Assigned Req', '2024-04-27 18:27:36'),
(344, 'Customer', 'none', 'Yes', 226, 50, 'Cancelled Assigned Req', '2024-04-28 21:00:39'),
(349, 'Collector', 'no respponse', 'Yes', 229, 0, 'None', '2024-04-29 18:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `request_completed`
--

CREATE TABLE `request_completed` (
  `req_id` int(11) NOT NULL,
  `Polythene` decimal(10,2) DEFAULT NULL,
  `Plastic` decimal(10,2) DEFAULT NULL,
  `Glass` decimal(10,2) DEFAULT NULL,
  `Paper_Waste` decimal(10,2) DEFAULT NULL,
  `Electronic_Waste` decimal(10,2) DEFAULT NULL,
  `Metals` decimal(10,2) DEFAULT NULL,
  `credit_amount` decimal(10,2) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `added` enum('yes','no') DEFAULT 'no',
  `rating` float DEFAULT NULL,
  `feedback` text NOT NULL,
  `completed_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_completed`
--

INSERT INTO `request_completed` (`req_id`, `Polythene`, `Plastic`, `Glass`, `Paper_Waste`, `Electronic_Waste`, `Metals`, `credit_amount`, `note`, `added`, `rating`, `feedback`, `completed_datetime`) VALUES
(84, 0.00, 0.00, 0.00, 3.00, 0.00, 0.00, 12.00, 'Books', 'no', NULL, '', '2024-03-09 18:30:00'),
(86, 1.00, 3.00, 5.00, 2.00, 4.00, 6.00, 132.00, 'Polythene Plasics Glass Paper_Waste Electronic_Waste Metals ', 'yes', 0, '', '2023-12-28 03:32:38'),
(88, 9.00, 0.00, 0.00, 0.00, 0.00, 0.00, 9.00, 'Polythene Bags', 'yes', 0, '', '2023-12-30 07:32:38'),
(90, 2.00, 1.00, 1.90, 2.02, 3.40, 8.90, 128.00, 'Polythene Bags,Plastic Bottles,Glass Bottles,Books,Electronic Waste,Metal Bar', 'yes', 0, '', '2023-01-05 03:32:38'),
(91, 0.00, 0.00, 1.00, 0.00, 0.00, 0.00, 1.00, '2 Glass Bottles  ', 'yes', 0, '', '2024-01-05 04:08:22'),
(92, 0.00, 1.00, 1.00, 0.00, 0.00, 0.00, 7.00, 'Plastic plates Glass Bottles ', 'yes', 0, '', '2024-01-02 02:51:58'),
(93, 0.00, 0.00, 1.00, 0.00, 0.00, 0.00, 1.00, 'Glass Bottles', 'yes', 0, '', '2024-01-02 18:30:00'),
(94, 0.00, 1.00, 0.00, 0.00, 0.00, 0.00, 6.00, 'Plastic Bottles', 'yes', 0, '', '2024-01-01 18:15:28'),
(95, 0.00, 0.00, 1.21, 0.00, 0.00, 0.00, 1.21, 'Glass Plates', 'yes', 0, '', '2024-01-03 03:15:34'),
(109, 0.00, 1.00, 0.00, 0.00, 0.00, 0.00, 6.00, '1', 'yes', 0, '', '2024-01-01 18:19:07'),
(113, 0.00, 1.00, 1.20, 0.00, 0.00, 0.00, 7.20, '1', 'yes', 0, '', '2024-01-01 18:20:13'),
(130, 11.00, 33.00, 55.00, 22.00, 44.00, 66.00, 1452.00, 'nksjja', 'yes', 0, '', '2024-01-07 08:22:55'),
(181, 0.00, 1.00, 1.00, 0.00, 0.00, 0.00, 7.00, '1', 'yes', 0, '', '2024-01-28 03:16:21'),
(198, 0.00, 0.00, 11.00, 0.00, 0.00, 0.00, 11.00, '11', 'yes', 0, '', '2024-01-28 08:27:10'),
(199, 0.00, 0.00, 111.00, 0.00, 0.00, 0.00, 111.00, '111', 'yes', 0, '', '2024-01-14 18:30:00'),
(204, 11.00, 11.00, 11.00, 11.00, 11.00, 11.00, 77.00, '11', 'yes', 0, '', '2024-01-28 11:25:18'),
(205, 11.00, 111.00, 11.00, 11.00, 11.00, 11.00, 77.00, '11', 'yes', 0, '', '2024-01-16 18:30:00'),
(207, 11.00, 11.00, 11.00, 11.00, 11.00, 11.00, 77.00, '1', 'yes', 0, '', '2024-01-17 18:30:00'),
(261, 0.00, 0.00, 11.00, 0.00, 11.00, 0.00, 88.00, '1', 'no', 0, '', '2024-02-12 06:16:28'),
(262, 0.00, 10.00, 0.00, 0.00, 0.00, 0.00, 120.00, 'Plastic Bag', 'no', 0, '', '2024-02-10 09:38:15'),
(263, 0.00, 10.00, 0.00, 0.00, 0.00, 0.00, 120.00, '1', 'no', 0, '', '2024-02-11 13:01:37'),
(269, 0.00, 0.00, 0.00, 0.00, 11.00, 0.00, 55.00, '', 'no', NULL, '', '2024-02-12 17:39:13'),
(271, 0.00, 0.00, 0.00, 0.00, 99.00, 0.00, 495.00, 'wachine machine parts Fridge parts,Vehicle IC parts\r\n', 'yes', NULL, '', '2024-02-01 18:30:00'),
(284, 11.10, 1.20, 4.10, 6.10, 7.00, 9.00, 171.30, 'Sample Items', 'yes', 0, '', '2024-02-19 18:30:00'),
(288, 0.00, 0.00, 1.60, 2.00, 0.00, 0.00, 12.80, 'Glass bottles,News papers', 'yes', NULL, '', '2024-04-22 15:10:05'),
(289, 3.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6.00, 'Polythene bags', 'no', NULL, '', '2024-04-22 18:22:23'),
(290, 0.00, 0.00, 0.00, 0.00, 0.00, 3.00, 9.00, 'Metal bars', 'no', NULL, '', '2024-04-22 18:25:38'),
(295, 0.00, 0.00, 5.94, 0.00, 0.00, 0.00, 237.60, 'Glass Bottles,Glass Jar', 'yes', NULL, '', '2024-04-25 04:59:24'),
(296, 34.00, 12.00, 0.00, 0.00, 0.00, 0.00, 930.00, 'plastic and polythene only', 'yes', NULL, '', '2024-04-26 17:49:47'),
(297, 0.00, 10.00, 0.00, 9.00, 0.00, 0.00, 530.00, 'plastic,paper', 'yes', NULL, '', '2024-04-25 17:34:33'),
(298, 0.00, 0.00, 0.00, 0.00, 0.00, 12.40, 508.40, 'metal only', 'yes', NULL, '', '2024-04-25 17:51:20'),
(299, 8.00, 8.00, 5.80, 6.00, 0.00, 9.40, 1137.40, 'plastic,polythene.glass.paper.metals', 'yes', NULL, '', '2024-04-25 17:38:34'),
(304, 6.00, 20.80, 4.78, 6.89, 6.00, 0.00, 1507.00, 'complete request by david', 'yes', NULL, '', '2024-04-26 17:43:32'),
(308, 0.00, 0.00, 0.00, 4.50, 0.00, 0.00, 90.00, 'Papers,Books', 'yes', NULL, '', '2024-04-25 05:02:33'),
(310, 0.00, 10.00, 0.00, 0.00, 0.00, 0.00, 350.00, 'Plastics', 'yes', NULL, '', '2024-04-25 10:18:47'),
(340, 0.00, 45.00, 10.00, 0.00, 0.00, 0.00, 1975.00, 'Glass and plastics', 'no', NULL, '', '2024-04-27 09:44:41'),
(342, 0.00, 0.00, 10.00, 0.00, 0.00, 0.00, 100.00, '10 Kg of glass', 'yes', NULL, '', '2024-02-15 04:44:00'),
(343, 0.00, 12.00, 31.00, 0.00, 0.00, 0.00, 550.00, 'n', 'yes', NULL, '', '2024-04-14 18:30:00'),
(348, 0.00, 12.00, 9.45, 0.00, 0.00, 0.00, 334.50, 'mm', 'no', NULL, '', '2024-04-29 12:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `request_main`
--

CREATE TABLE `request_main` (
  `req_id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `instructions` varchar(255) NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `longi` decimal(11,8) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'incoming'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_main`
--

INSERT INTO `request_main` (`req_id`, `region`, `customer_id`, `name`, `contact_no`, `date`, `time`, `instructions`, `lat`, `longi`, `type`) VALUES
(80, 'Galle', 234, 'ChamindaWijeserkara', '0771273182', '2023-12-20', '10 am - 12 noon', 'Pick up near the gate garbage from 6 types', 6.65839201, 80.87018860, 'cancelled'),
(84, 'kaluthara', 235, 'Sahan Devinda', '0717362821', '2023-12-22', '12 noon -2 pm', 'ghjagsjbhb', 6.58353095, 79.96519741, 'completed'),
(86, 'Galle', 234, 'ChamindaWijeserkara', '0771273182', '2023-12-28', '8 am - 10 am', 'Contact me at the gate', 6.22103042, 80.47262085, 'completed'),
(87, 'Galle', 234, 'ChamindaWijeserkara', '0771273182', '2024-01-05', '8 am - 10 am', 'iahalojoilajijakjm', 6.29525813, 80.55879486, 'cancelled'),
(88, 'Galle', 235, 'Sahan Devinda', '0717362821', '2023-12-30', '12 noon -2 pm', 'Polythenes', 6.21027933, 80.24190796, 'completed'),
(90, 'Galle', 234, 'ChamindaWijeserkara', '0771273182', '2024-01-05', '8 am - 10 am', 'Call me at the location', 6.20225853, 80.18319977, 'completed'),
(91, 'Galle', 234, 'ChamindaWijeserkara', '0771273182', '2024-01-05', '8 am - 10 am', 'Contact me at the location', 6.09883055, 80.22079361, 'completed'),
(92, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-02', '8 am - 10 am', 'Plastic Plates', 6.09473398, 79.96106995, 'completed'),
(93, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-03', '8 am - 10 am', 'pp', 6.09473398, 79.96106995, 'completed'),
(94, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-01', '8 am - 10 am', 'Plastic Bottles', 6.09473398, 79.96106995, 'completed'),
(95, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-03', '8 am - 10 am', 'Glass Plates', 6.09473398, 79.96106995, 'completed'),
(109, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-20', '8 am - 10 am', '1', 6.09473398, 79.96106995, 'completed'),
(113, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-13', '10 am - 12 noon', '111', 6.09473398, 79.96106995, 'completed'),
(120, 'Colombo', 221, 'Kaveesha', '0775902645', '2024-01-12', '10 am - 12 noon', '12', 6.94611641, 79.89038086, 'cancelled'),
(127, 'Galle', 234, 'ChamindaWijeserkara', '0771273182', '2024-01-24', '8 am - 10 am', 'njhjiolko', 6.10548741, 80.14303101, 'cancelled'),
(128, 'Galle', 235, 'Sahan Devinda', '0717362821', '2024-01-23', '8 am - 10 am', 'uhajbahai', 6.20584231, 80.12706650, 'cancelled'),
(129, 'Galle', 234, 'ChamindaWijeserkara', '0771273182', '2024-01-23', '8 am - 10 am', 'njajaji', 6.10821841, 80.18577469, 'cancelled'),
(130, 'Galle', 234, 'ChamindaWijeserkara', '0771273182', '2024-01-31', '8 am - 10 am', 'jknaijaika', 6.11146145, 80.38335694, 'completed'),
(131, 'Galle', 234, 'ChamindaWijeserkara', '0771273182', '2024-01-24', '8 am - 10 am', 'hduiahikah', 6.23946036, 80.10749710, 'cancelled'),
(133, 'Galle', 234, 'ChamindaWijeserkara', '0771273182', '2024-01-17', '8 am - 10 am', 'haihauhia', 6.02357987, 80.26055306, 'cancelled'),
(181, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-28', '8 am - 10 am', '1', 6.05351900, 80.22097800, 'completed'),
(198, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-29', '8 am - 10 am', '111', 6.05351900, 80.22097800, 'completed'),
(199, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-15', '8 am - 10 am', '111', 6.05351900, 80.22097800, 'completed'),
(204, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-30', '10 am - 12 noon', '121', 6.05351900, 80.22097800, 'completed'),
(205, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-17', '10 am - 12 noon', '121', 6.05351900, 80.22097800, 'completed'),
(206, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-25', '10 am - 12 noon', '121', 6.05351900, 80.22097800, 'cancelled'),
(207, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-18', '10 am - 12 noon', '121', 6.05351900, 80.22097800, 'completed'),
(239, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-31', '8 am - 10 am', '1111', 6.05351900, 80.22097800, 'cancelled'),
(240, 'Galle', 221, 'Kaveesha', '0775902645', '2024-01-20', '8 am - 10 am', 'aaaaaaa', 6.05351900, 80.22097800, 'cancelled'),
(246, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-01', '8 am - 10 am', '111111111', 6.05207037, 80.29211599, 'cancelled'),
(252, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-10', '8 am - 10 am', '`212', 6.06703090, 80.20843284, 'cancelled'),
(258, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-20', '8 am - 10 am', '`212', 6.06703090, 80.20843284, 'cancelled'),
(261, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-12', '8 am - 10 am', '1', 6.06703090, 80.20843284, 'completed'),
(262, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-11', '8 am - 10 am', '1', 6.06703090, 80.20843284, 'completed'),
(263, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-09', '8 am - 10 am', '1', 6.06703090, 80.20843284, 'completed'),
(269, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-13', '8 am - 10 am', '1', 6.06703090, 80.20843284, 'completed'),
(271, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-02', '8 am - 10 am', '12', 6.06703090, 80.20843284, 'completed'),
(273, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-04', '8 am - 10 am', '12', 6.06703090, 80.20843284, 'cancelled'),
(276, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-18', '8 am - 10 am', '12', 6.06703090, 80.20843284, 'cancelled'),
(278, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-17', '8 am - 10 am', '12', 6.06703090, 80.20843284, 'cancelled'),
(284, 'Galle', 255, 'Rashmika', '0752512313', '2024-02-20', '8 am - 10 am', 'Plastics Metals', 6.03152727, 80.35948612, 'completed'),
(288, 'Galle', 221, 'Kaveesha', '0775902645', '2024-04-21', '10 am - 12 noon', 'glass and metals', 6.23907178, 80.15349247, 'completed'),
(289, 'Galle', 221, 'Kaveesha', '0775902645', '2024-04-22', '12 noon -2 pm', 'Pick Up at the gate please', 6.08068983, 80.21666386, 'completed'),
(290, 'Galle', 221, 'Kaveesha', '0775902645', '2024-04-25', '8 am - 10 am', 'Books', 6.29640524, 80.23588993, 'completed'),
(291, 'Galle', 221, 'Kaveesha', '0775902645', '2024-04-26', '8 am - 10 am', 'Books', 6.03699000, 80.37047245, 'cancelled'),
(292, 'Galle', 222, 'nimal', '0775902645', '2024-04-22', '10 am - 12 noon', 'Pick Up at the gate please', 6.00967581, 80.33751347, 'cancelled'),
(295, 'Colombo', 272, 'Ravindu Yasas', '0758324192', '2024-04-25', '10 am - 12 noon', 'Pick up at the gate', 6.86703163, 79.94568453, 'completed'),
(296, 'Colombo', 272, 'Ravindu Yasas', '0758324192', '2024-04-26', '12 noon - 2 pm', 'Call me at the location', 6.80055933, 79.92130862, 'completed'),
(297, 'Colombo', 279, 'Sanath Nishantha', '0771572512', '2024-04-25', '12 noon - 2 pm', '2kg of glass', 6.83430796, 79.89864931, 'completed'),
(298, 'Colombo', 279, 'Sanath Nishantha', '0771572512', '2024-04-26', '12 noon - 2 pm', 'Call at the location', 6.81521812, 79.91787539, 'completed'),
(299, 'Colombo', 278, 'Ayesh Pramuditha', '0726347446', '2024-04-25', '12 noon - 2 pm', '11 kg of metal', 6.79885479, 79.95632754, 'completed'),
(304, 'Colombo', 276, 'Sadun Chinthaka', '0111233211', '2024-04-26', '2 pm - 4 pm', 'None', 6.82612669, 79.84371767, 'completed'),
(305, 'Colombo', 276, 'Sadun Chinthaka', '0111233211', '2024-04-25', '10 am - 12 noon', '5Kg of electronics', 6.85067008, 79.83273135, 'cancelled'),
(306, 'Colombo', 270, 'Savindu Kaveesha', '0775902645', '2024-04-25', '8 am - 10 am', 'None', 6.85612399, 79.89864931, 'cancelled'),
(308, 'Colombo', 283, 'sandunu chanchala', '0728812032', '2024-04-25', '10 am - 12 noon', 'About 10 kg of plastics', 6.87793902, 79.96456728, 'completed'),
(310, 'Colombo', 287, 'Testing', '0775902645', '2024-04-26', '10 am - 12 noon', 'Sample textx', 6.78249091, 79.91787539, 'completed'),
(311, 'Jaffna', 288, 'binuri mindula', '0715771501', '2024-04-26', '2 pm - 4 pm', 'Plastic Plates', 9.65798521, 80.16280993, 'cancelled'),
(312, 'Jaffna', 288, 'binuri mindula', '0715771501', '2024-04-27', '8 am - 10 am', 'Contact me at the gate', 9.72566974, 80.15731677, 'cancelled'),
(313, 'Galle', 289, 'kasuni amanda', '0715773463', '2024-04-26', '12 noon - 2 pm', 'plastic,polythene,glass,paper', 6.07329091, 80.28052692, 'cancelled'),
(314, 'Galle', 289, 'kasuni amanda', '0715773463', '2024-04-27', '10 am - 12 noon', 'peper', 6.25078719, 80.28602009, 'cancelled'),
(315, 'Jaffna', 290, 'sithumini ashcharya', '0772476456', '2024-04-26', '12 noon - 2 pm', 'Plastic Plates', 9.74191199, 80.00900134, 'cancelled'),
(316, 'Jaffna', 290, 'sithumini ashcharya', '0772476456', '2024-04-27', '2 pm - 4 pm', 'glass only', 9.77168740, 80.03646716, 'cancelled'),
(317, 'Jaffna', 291, 'sanduni dilhara', '0715771508', '2024-04-26', '2 pm - 4 pm', 'electronic only', 9.73108391, 80.04470691, 'cancelled'),
(318, 'Jaffna', 291, 'sanduni dilhara', '0715771508', '2024-04-27', '10 am - 12 noon', 'metals and plastic', 9.71213393, 80.05294665, 'cancelled'),
(319, 'Polonnaruwa', 292, 'dinithi dinushika', '0772476456', '2024-04-26', '2 pm - 4 pm', 'plastic,polythene,glass,paper', 8.05439341, 80.94506836, 'cancelled'),
(320, 'Polonnaruwa', 292, 'dinithi dinushika', '0772476456', '2024-04-27', '12 noon - 2 pm', 'Plastic Plates', 8.00000000, 81.00000000, 'cancelled'),
(321, 'Kaluthara', 293, 'nimna nethmini', '0715771502', '2024-04-26', '2 pm - 4 pm', 'polythene only', 6.54158992, 80.03248065, 'cancelled'),
(322, 'Kaluthara', 293, 'nimna nethmini', '0715771502', '2024-04-27', '8 am - 10 am', 'glass,plastic', 6.54977595, 80.01325458, 'cancelled'),
(323, 'Colombo', 294, 'Tharushi lakshika', '0715773463', '2024-04-27', '12 noon - 2 pm', 'electronic 10kg', 6.77703615, 79.91787539, 'cancelled'),
(324, 'Colombo', 294, 'Tharushi lakshika', '0715773463', '2024-04-25', '10 am - 12 noon', 'metals 20kg and plastic 5 kg', 6.79340022, 79.93160830, 'cancelled'),
(325, 'Colombo', 295, 'kaveesha nethmini', '0715773462', '2024-04-25', '2 pm - 4 pm', 'Plastic Plates', 6.81521812, 79.89590273, 'cancelled'),
(326, 'Colombo', 295, 'kaveesha nethmini', '0715773462', '2024-04-27', '8 am - 10 am', 'paper', 6.77430875, 79.94259463, 'cancelled'),
(327, 'Rathnapura', 296, 'samantha jayamini', '0715773463', '2024-04-26', '12 noon - 2 pm', 'metals 20kg and plastic 10kg', 6.67742830, 80.39500037, 'cancelled'),
(328, 'Rathnapura', 296, 'samantha jayamini', '0715773463', '2024-04-27', '10 am - 12 noon', 'paper', 6.72925661, 80.39225379, 'cancelled'),
(329, 'Rathnapura', 297, 'Nadee gamage', '0715773462', '2024-04-26', '10 am - 12 noon', 'metals 15kg electronic 13kg paper 10kg', 6.65833227, 80.38676063, 'cancelled'),
(330, 'Rathnapura', 297, 'Nadee gamage', '0715773462', '2024-04-27', '8 am - 10 am', 'metals and plastic', 6.64469180, 80.39774696, 'cancelled'),
(331, 'Galle', 221, 'Kaveesha', '0775902645', '2024-04-27', '10 am - 12 noon', 'None', 6.14156573, 80.22284870, 'cancelled'),
(333, 'Colombo', 278, 'Ayesh Pramuditha', '0726347446', '2024-04-25', '10 am - 12 noon', 'Glass', 6.83430796, 79.95083437, 'cancelled'),
(334, 'Colombo', 278, 'Ayesh Pramuditha', '0726347446', '2024-04-25', '12 noon - 2 pm', 'Glass', 6.78521826, 79.94534121, 'cancelled'),
(337, 'Colombo', 307, 'Ravindu Perera', '0775341293', '2024-04-28', '10 am - 12 noon', '6 kg of glass', 6.83976206, 79.88491640, 'cancelled'),
(338, 'Colombo', 308, 'Savindu kavisha', '0775902645', '2024-04-28', '10 am - 12 noon', 'Metals', 6.84964746, 79.92474184, 'cancelled'),
(340, 'Galle', 221, 'Kaveesha', '0775902645', '2024-04-28', '12 noon - 2 pm', 'Metals', 6.03667110, 80.24284996, 'completed'),
(341, 'Galle', 222, 'nimal', '0775902645', '2024-04-28', '8 am - 10 am', 'None', 6.05101051, 80.24971642, 'cancelled'),
(342, 'Galle', 221, 'Kaveesha', '0775902645', '2024-02-15', '10 am - 12 noon', 'None', 6.08173653, 80.25932946, 'completed'),
(343, 'Galle', 221, 'Kaveesha', '0775902645', '2024-04-15', '10 am - 12 noon', 'None', 6.07149472, 80.26894249, 'completed'),
(344, 'Galle', 258, 'Janaka Kumara', '0775902645', '2024-04-29', '10 am - 12 noon', '6 Kg of papers', 6.08822291, 80.25194802, 'cancelled'),
(348, 'Galle', 235, 'Sahan Devinda', '0717362821', '2024-04-29', '10 am - 12 noon', 'Metals', 6.00457677, 80.27443566, 'completed'),
(349, 'Galle', 289, 'Kasuni amanda', '0715773463', '2024-04-29', '8 am - 10 am', 'Plastics', 6.07012913, 80.18105187, 'cancelled'),
(350, 'Colombo', 375, 'Ruvin  chamod', '0775902645', '2024-04-30', '10 am - 12 noon', 'Plastics', 6.84248909, 79.87942324, 'assigned'),
(351, 'Colombo', 374, 'ruvindu ardithya', '0775902645', '2024-04-30', '10 am - 12 noon', 'Pick up near the gate', 6.83976206, 79.88216982, 'assigned'),
(352, 'Colombo', 363, 'isuru Anuhas', '0712236574', '2024-04-30', '12 noon - 2 pm', 'None', 6.81794528, 79.90963564, 'assigned'),
(353, 'Colombo', 360, 'Kasun Kalhara', '0768234327', '2024-04-30', '12 noon - 2 pm', 'Pick up at the gate', 6.83430796, 79.96731386, 'assigned'),
(354, 'Colombo', 358, 'Amanda Samadini', '0771236517', '2024-04-30', '12 noon - 2 pm', 'Pick up at the gate', 6.88339262, 79.95358095, 'assigned'),
(355, 'Colombo', 357, 'Sachini Sandeepani', '0714526718', '2024-04-30', '2 pm - 4 pm', 'None', 6.91338631, 79.91512881, 'assigned'),
(356, 'Colombo', 310, 'Damith', '0775902645', '2024-04-30', '2 pm - 4 pm', '4Kg of garbage', 6.92701917, 79.96456728, 'incoming'),
(357, 'Colombo', 309, 'kaveesha savindu', '0775902645', '2024-04-30', '2 pm - 4 pm', '4KG', 6.85067008, 79.96182070, 'incoming'),
(358, 'Colombo', 307, 'Ravindu Perera', '0775341293', '2024-04-30', '2 pm - 4 pm', 'Sample Text', 6.85339704, 79.97280703, 'incoming'),
(359, 'Colombo', 295, 'kaveesha nethmini', '0715773462', '2024-04-30', '2 pm - 4 pm', 'None', 6.87793902, 79.94534121, 'incoming'),
(360, 'Colombo', 294, 'Tharushi lakshika', '0715773463', '2024-04-30', '12 noon - 2 pm', 'Pick up at the end', 6.82067244, 79.98104677, 'incoming'),
(361, 'Colombo', 275, 'Tiran Sasanka', '0775902645', '2024-04-30', '12 noon - 2 pm', 'Sample Text', 6.82339957, 79.96731386, 'incoming'),
(362, 'Colombo', 272, 'Ravindu Yasas', '0758324192', '2024-04-30', '12 noon - 2 pm', '2kg', 6.79340022, 79.99477968, 'incoming'),
(363, 'Colombo', 270, 'Savindu Kaveesha', '0775902645', '2024-04-30', '12 noon - 2 pm', 'Sample Text', 6.78794560, 79.99203310, 'incoming'),
(364, 'Colombo', 259, 'Yenuka Menuka', '0715202245', '2024-04-30', '2 pm - 4 pm', 'Sample Text', 6.82067244, 79.96182070, 'incoming'),
(365, 'Colombo', 234, 'Chaminda Wijeserkara', '0771273182', '2024-04-30', '10 am - 12 noon', 'Sample Text', 6.77158134, 79.99203310, 'incoming'),
(366, 'Galle', 235, 'Sahan Devinda', '0717362821', '2024-04-30', '8 am - 10 am', '10 Kg of metal', 6.04827922, 80.22362389, 'assigned'),
(367, 'Galle', 255, 'Rashmika Nilmantha 2', '0752512313', '2024-04-30', '8 am - 10 am', 'Pick up at the gate', 6.06466673, 80.21401085, 'assigned'),
(368, 'Galle', 258, 'Janaka Kumara', '0775902645', '2024-04-30', '8 am - 10 am', 'Metals Bottles', 6.06876353, 80.22499718, 'incoming'),
(369, 'Galle', 289, 'Kasuni amanda', '0715773463', '2024-04-30', '2 pm - 4 pm', 'Metals Bottles', 6.02915983, 80.29366173, 'assigned'),
(370, 'Galle', 289, 'Kasuni amanda', '0715773463', '2024-05-01', '2 pm - 4 pm', 'Glass Bottles', 6.06193552, 80.21126427, 'incoming'),
(372, 'Galle', 221, 'Kaveesha', '0775902645', '2024-04-30', '12 noon - 2 pm', 'Metals and plastics', 6.04008528, 80.20302453, 'incoming');

-- --------------------------------------------------------

--
-- Table structure for table `temp_user`
--

CREATE TABLE `temp_user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `expires` decimal(30,12) NOT NULL,
  `hashedToken` varchar(255) NOT NULL,
  `selector` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_user`
--

INSERT INTO `temp_user` (`id`, `email`, `name`, `password`, `mobile_number`, `address`, `city`, `expires`, `hashedToken`, `selector`) VALUES
(26, 'malithmilanga@gmail.com', 'ma', '$2y$10$uiweagFd03C9JjfDotpBD.MLgmAYj38wnAWSjDEQ19XeUcj.bsfJ6', '1111111111', 'malithmilanga@gmail.com', 'Jaffna', 1714250896.000000000000, '$2y$10$9WvWwRSkhO6TrsA/oteKXeuoCKImHFgmFRWorzjYKgpbQaQiEnCSe', '29214512f80ac651'),
(62, 'Rasindujayan@gmail.com', 'Rasindu Jayan', '$2y$10$gJEifLS2mA6enYgn0MtP2e/wtT7LLgeOJz2Ngf6Me8N1yieMFKOTy', '0775902645', 'Galle', 'Galle', 1714419158.000000000000, '$2y$10$hrU6RV/0mH0xbJSyzAjmpeAwTXjyqWDg3XLEJ5yD2cDhvBdOTU6TW', '11449e194b61a288');

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
(38, 'admin@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'superadmin', 'Admin'),
(197, 'james@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'centermanager', 'james'),
(216, 'janaka@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'centermanager', 'Janka'),
(221, 'kaveesha@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Kaveesha'),
(222, 'nimal@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'nimal'),
(224, 'kumara@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'centermanager', 'kumara'),
(226, 'sisira@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'collector', 'Sisira'),
(227, 'david@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'collector', 'David'),
(229, 'Ravindu@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'collector', 'Ravindu'),
(230, 'sameera@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'centermanager', 'Nimal'),
(231, 'gamini@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'collector', 'Gamini'),
(232, 'collector@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'collector', 'collector'),
(233, 'RavinduHarasara@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'collector', 'Ravindu Harasara'),
(234, 'ChamindaWijeserkara@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Chaminda Wijeserkara'),
(235, 'SahanDevinda@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Sahan Devinda'),
(236, 'Pasinduanjana@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'centermanager', 'Pasindu'),
(250, 'Keels@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'discountagent', 'Keels'),
(251, 'Cargills@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'discountagent', 'Cargills'),
(255, 'Rashmikanilmantha@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Rashmika Nilmantha 2'),
(258, 'JanakaKumara@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Janaka Kumara'),
(259, 'Yenukamenuka@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Yenuka Menuka'),
(270, 'SavinduKaveesha@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Savindu Kaveesha'),
(271, 'JanakaRuvinda@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Janaka Ruvinda'),
(272, 'RavinduYasas@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Ravindu Yasas'),
(274, 'kaveesha11@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'admin', 'kaveesha'),
(275, 'TiranSasanka@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Tiran Sasanka'),
(276, 'SadunChinthaka@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Sadun Chinthaka'),
(277, 'JanakaSilva@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Janka Silva'),
(278, 'AyeshPramuditha@gmail.com', '$2y$10$naSy376elqPw2/m71SuV1.W8K.9z33Hqlzw1RT49Zs0L5obU2WYa2', 'customer', 'Ayesh Pramuditha'),
(279, 'SanathNishantha@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Sanath Nishantha'),
(280, 'kavindupasan@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'collector', 'kavindu pasan'),
(281, 'Chanukasirisena@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'collector', 'Chanuka Sirisena'),
(282, 'LakinduEranga@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'collector', 'Lakindu Eranga'),
(283, 'sandunichanchala@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'sandunu chanchala'),
(284, 'RaguramJathtusan@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'centermanager', 'Raguram Jathtusan'),
(285, 'Thushikaran@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'P Thushikaran'),
(286, 'Samaralagan@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Samaralagan'),
(287, 'RavinduArdithya@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Testing'),
(288, 'binuri123@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Binuri mindula'),
(289, 'kasuniamanda@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Kasuni amanda'),
(290, 'sithumini@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Sithumini ashcharya'),
(291, 'sanduni@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Sanduni dilhara'),
(292, 'dinu@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Dinithi dinushika'),
(293, 'nimna@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Nimna nethmini'),
(294, 'Tharushi@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Tharushi lakshika'),
(295, 'nethmini@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'kaveesha nethmini'),
(296, 'samantha@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Samantha jayamini'),
(297, 'nadee@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Nadee gamage'),
(303, 'Nimal12@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'collector', 'Nima12@gmail.com'),
(307, 'RavinduPerera@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Ravindu Perera'),
(308, 'savindukavisha@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Savindu kavisha'),
(309, 'kaveeshasavindu@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'kaveesha savindu'),
(310, 'Damith@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'Damith'),
(313, 'testing@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'customer', 'testing'),
(321, 'DasunThamash@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'centermanager', 'Dasun Thamash'),
(322, 'MohomadNasif@gmail.com', '$2y$10$NldQ0yO1CgfBginfDpKHku1y4baBdgCJQaqkIE0WbkFk4Lwj27tRi', 'centermanager', 'Mohomad Nasif'),
(323, 'YesithBimsara@gmail.com', '$2y$10$OrZJqW2MtBl9S9EoruIg6ugvCe.15DqCeVNxzZWs8mF0zyxnqLZp.', 'centermanager', 'Yesith Bimsara'),
(339, 'malithmilanga123@gmail.com', '$2y$10$MfHAfiWAhBAZ75GoVdetfesFTfQHCY0zq2D28EDDuKQqYCukb84Gm', 'customer', 'malithmilanga123@gmail.com'),
(340, 'Orshanviraj@gmail.com', '$2y$10$M6NaiAbgginD6.JQ9lcDDuwf4Kudp6Tecap8vuaeiCMdSJnwiEeRW', 'centermanager', 'Orshan Viraj'),
(341, 'alokaeranda@gmail.com', '$2y$10$5NyGtaMkXUFab7VpLihamOhSokJSNN/b9tlTzEErCozXVHgQiTPjm', 'centermanager', 'alokaeranda'),
(342, 'RavinduPrabash@gmail.com', '$2y$10$f5dnwrM2ee2rtz6t4yX4XuAQ3ApxnhWCiTPUWqKlby1etO36fEL6O', 'centermanager', 'RavinduPrabash'),
(343, 'uvinduvishmina@gmail.com', '$2y$10$Ugl/k0Qg0GNbovwZUxGB5uyfvo8jEEDZ/.VhlBIiBYX4MI/F4dvp.', 'centermanager', 'uvindu vishmina'),
(348, 'Kaveesha11111@gmail.com', '$2y$10$5fPqvmEvN7ALKNKRrDByiOhnujIO0cPiYMsDfvteYJrGilu4EVycS', 'customer', 'Kaveesha11111@gmail.com'),
(350, 'Yasinduchathuranga@gmail.com', '$2y$10$0sKKEzuecE/NmWykD8zaPeMHHJridBUDttBlVZr1ISyc6TiCmOjB.', 'centermanager', 'Yasindu Chathuranga'),
(352, 'Vidura@gmail.com', '$2y$10$9v9n35FFjDVRf6gxOJ5eZuKzlYxjzkYw6lRDfLu0.YnTmNNEVTLJu', 'collector', 'Vidura'),
(357, 'sachini@gmail.com', '$2y$10$kfVDFDr07e.kppjrRau3T.qm1/Rq0RJ9DKmVp2wgr648DOpTRLBT2', 'customer', 'Sachini Sandeepani'),
(358, 'amanda@gmail.com', '$2y$10$tGZUXSbABIsGMpFr/K746.BXalouQm7W/Bgc.u.QPDsJwfraEmPEi', 'customer', 'Amanda Samadini'),
(359, 'oshada@gmail.com', '$2y$10$7mSyGa1g8vXHfEsqJhEAi.LBZS8L34oflay2zyKO3MT8BDS.HunVu', 'customer', 'Oshada Silva'),
(360, 'kasun@gmail.com', '$2y$10$26TeZ1aqmhbPq0CW3Ts4Q.1TYWrrXUlxO53kb4BTyQFFevOT2W8/G', 'customer', 'Kasun Kalhara'),
(361, 'asindu@gmail.com', '$2y$10$dUDJKpcDC4d6FpeepGSY8e35LlgOsbhGckQhxAX6RqI/vL1vEAgLu', 'customer', 'Asindu Gunathilaka'),
(362, 'kavishka@gmail.com', '$2y$10$UQb6G0m9yUv7MdcoJP.Ny.285MBB/Ii98BkVgxZTB6VEBYI1Os1B.', 'customer', 'Kavishka weerawardhana'),
(363, 'anuhas@gmail.com', '$2y$10$e0F7gI0UbsR75eeQUBd36.KuGJAurSKkEZfmGOP2LAjjCD4qZP7Vy', 'customer', 'isuru Anuhas'),
(364, 'chamya@gmail.com', '$2y$10$agnEABRXOke5gLmdGeft/uWXyvg.hPtqtwQihd4mZNS2rL2am1rai', 'customer', 'Dinithi Chamya'),
(365, 'vijay@gmail.com', '$2y$10$JyQeNqJNmg50z95tCVPi3.5IMxsnOX.KOYYgJtORmqyRZ.mVbxD2i', 'customer', 'Vijay Velayudam'),
(366, 'jeewaka@gmail.com', '$2y$10$2UqqALarlDsbaeLLbo.DU./uPySfdYpYBmZbG8cXyGZaZfJ7mg16O', 'customer', 'Jeewaka Ranathunga'),
(367, 'supun@gmail.com', '$2y$10$v4a0siChggqGmqlzmbYZ5.LBT1fGtR9Ske4o459uH/VDfwk0ruvhK', 'customer', 'Supun Perera'),
(368, 'danith@gmail.com', '$2y$10$DKqoVSVu0Zxrcu6sDu3/B.4mQ3TAZMmiPjClpAHo22p6pOcsmB/G.', 'customer', 'Danith Madushan'),
(369, 'sithara@gmail.com', '$2y$10$bVDku3gz4ZEs8RrNUcLJReZ8fuEzxZNLnlnzKPnoHfwPSqJw0Sptq', 'customer', 'Sithara Gagulali'),
(370, 'abdulla@gmail.com', '$2y$10$brQV6aNHzWAnHDHsqdokde5cgbrrIbor19eMumJ1.TRlMnZrQSmSK', 'customer', 'Mohommad Abdulla'),
(371, 'manimekala@gmail.com', '$2y$10$BoZLiqugdTCsqtC7oHxiKuTkpAPBh1kRxFu.RmPkNA9u4G5Qa27cC', 'customer', 'Manimekala Sivanadan'),
(372, 'kadiresa@gmail.com', '$2y$10$oHHnF7.lIEBO6No6mTb8juYtPAppxE1HR3QiCZ2taQIvPxGzQfz3a', 'customer', 'Kadiresa Murugan'),
(373, 'fathima@gmail.com', '$2y$10$90FDgWgAs1MuRnbm3ieR0.HkfKTg6py9MTPbcAu.n0OmSfKD8mCa2', 'customer', 'Fathima Tashiya'),
(374, 'ruvinduardithya@gmail.com', '$2y$10$REoBCYp5fPyfgVtQOICDdOESTPudN8husy0aUSh1NzpFBQpmYoK4W', 'customer', 'ruvindu ardithya'),
(375, 'Ruvinchamod@gmail.com', '$2y$10$Jh5lHg5pkM3q.QApqMRAnOt4ZQn0AYh0UD.XjIhpY1tLqne84ea6i', 'customer', 'Ruvin  chamod'),
(376, 'BanukaChathuranga@gmail.com', '$2y$10$wc3s44oxb.JI2yx1QaQ6eOY1mla.Mv5cBk/n0sH6OT9rffIGuMwNy', 'customer', 'Banuka Chathuranga');

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE `user_notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notification` text DEFAULT NULL,
  `mark_as_read` enum('False','True') DEFAULT 'False',
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_notification`
--

INSERT INTO `user_notification` (`id`, `user_id`, `notification`, `mark_as_read`, `datetime`) VALUES
(676, 221, 'Req ID 345 Has been Assigned', 'True', '2024-04-29 17:35:55'),
(677, 229, 'Req ID 345 Has been Assigned', 'True', '2024-04-29 17:35:55'),
(678, 221, 'Req ID 346 Has been Assigned', 'True', '2024-04-29 17:42:40'),
(679, 229, 'Req ID 346 Has been Assigned', 'True', '2024-04-29 17:42:40'),
(680, 221, 'Req ID 347 Has been Assigned', 'True', '2024-04-29 17:56:21'),
(681, 229, 'Req ID 347 Has been Assigned', 'True', '2024-04-29 17:56:21'),
(682, 221, 'Req ID 343 Collector is On the Way', 'True', '2024-04-29 18:04:47'),
(683, 221, 'Req ID 343 Verify code updated', 'True', '2024-04-29 18:06:21'),
(684, 221, 'Req ID 343 Has been Completed', 'True', '2024-04-29 18:07:24'),
(685, 235, 'Req ID 348 Has been Assigned', 'False', '2024-04-29 18:14:00'),
(686, 229, 'Req ID 348 Has been Assigned', 'True', '2024-04-29 18:14:00'),
(687, 235, 'Req ID 348 Collector is On the Way', 'False', '2024-04-29 18:16:02'),
(688, 235, 'Req ID 348 Verify code updated', 'False', '2024-04-29 18:18:25'),
(689, 235, 'Req ID 348 Has been Completed', 'False', '2024-04-29 18:18:58'),
(690, 289, 'Req ID 349 Has been Assigned', 'True', '2024-04-29 18:23:06'),
(691, 229, 'Req ID 349 Has been Assigned', 'True', '2024-04-29 18:23:06'),
(692, 289, 'Req ID 349 Collector is On the Way', 'True', '2024-04-29 18:24:03'),
(693, 289, 'Req ID 349 Has been Cancelled', 'True', '2024-04-29 18:24:31'),
(694, 289, 'Req ID . 349. fine has been refunded', 'True', '2024-04-29 18:34:56'),
(695, 375, 'Req ID 350 Has been Assigned', 'False', '2024-04-29 19:17:23'),
(696, 280, 'Req ID 350 Has been Assigned', 'False', '2024-04-29 19:17:23'),
(697, 374, 'Req ID 351 Has been Assigned', 'False', '2024-04-29 19:17:43'),
(698, 280, 'Req ID 351 Has been Assigned', 'False', '2024-04-29 19:17:43'),
(699, 363, 'Req ID 352 Has been Assigned', 'False', '2024-04-29 19:17:55'),
(700, 280, 'Req ID 352 Has been Assigned', 'False', '2024-04-29 19:17:55'),
(701, 360, 'Req ID 353 Has been Assigned', 'False', '2024-04-29 19:18:06'),
(702, 280, 'Req ID 353 Has been Assigned', 'False', '2024-04-29 19:18:06'),
(703, 357, 'Req ID 355 Has been Assigned', 'False', '2024-04-29 19:18:13'),
(704, 227, 'Req ID 355 Has been Assigned', 'False', '2024-04-29 19:18:13'),
(705, 358, 'Req ID 354 Has been Assigned', 'False', '2024-04-29 19:19:14'),
(706, 281, 'Req ID 354 Has been Assigned', 'False', '2024-04-29 19:19:14'),
(707, 235, 'Req ID 366 Has been Assigned', 'False', '2024-04-29 22:35:27'),
(708, 229, 'Req ID 366 Has been Assigned', 'True', '2024-04-29 22:35:27'),
(709, 255, 'Req ID 367 Has been Assigned', 'False', '2024-04-29 22:35:54'),
(710, 229, 'Req ID 367 Has been Assigned', 'True', '2024-04-29 22:35:54'),
(711, 289, 'Req ID 369 Has been Assigned', 'False', '2024-04-29 22:46:45'),
(712, 229, 'Req ID 369 Has been Assigned', 'True', '2024-04-29 22:46:45'),
(713, 221, 'Req ID 371 Has been Assigned', 'True', '2024-04-30 06:22:40'),
(714, 229, 'Req ID 371 Has been Assigned', 'True', '2024-04-30 06:22:40'),
(715, 221, 'Req ID 371 Collector is On the Way', 'True', '2024-04-30 06:23:44'),
(716, 221, 'Req ID 371 Verify code updated', 'True', '2024-04-30 06:23:57'),
(717, 221, 'Req ID 371 Has been Completed', 'True', '2024-04-30 06:24:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `annoucement`
--
ALTER TABLE `annoucement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `center`
--
ALTER TABLE `center`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `center_manager_id` (`center_manager_id`),
  ADD UNIQUE KEY `region` (`region`);

--
-- Indexes for table `center_complaints`
--
ALTER TABLE `center_complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `fk_center_id` (`center_id`);

--
-- Indexes for table `center_garbage`
--
ALTER TABLE `center_garbage`
  ADD PRIMARY KEY (`center_id`);

--
-- Indexes for table `center_managers`
--
ALTER TABLE `center_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sd` (`user_id`);

--
-- Indexes for table `center_notification`
--
ALTER TABLE `center_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center_id_fk` (`center_id`);

--
-- Indexes for table `center_workers`
--
ALTER TABLE `center_workers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Foreign` (`center_id`);

--
-- Indexes for table `cm_admin`
--
ALTER TABLE `cm_admin`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `credits_transfer`
--
ALTER TABLE `credits_transfer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `customer_credits`
--
ALTER TABLE `customer_credits`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `discountagent_credit`
--
ALTER TABLE `discountagent_credit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key` (`agent_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `discount_agents`
--
ALTER TABLE `discount_agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `fines`
--
ALTER TABLE `fines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `garbage_confirmed`
--
ALTER TABLE `garbage_confirmed`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `garbage_types`
--
ALTER TABLE `garbage_types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center_id_fkey` (`center_id`);

--
-- Indexes for table `mail_subscriptions`
--
ALTER TABLE `mail_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `released_stocks`
--
ALTER TABLE `released_stocks`
  ADD PRIMARY KEY (`release_id`),
  ADD KEY `fk_center` (`center_id`);

--
-- Indexes for table `request_assigned`
--
ALTER TABLE `request_assigned`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `req_id` (`req_id`),
  ADD KEY `cons` (`req_id`);

--
-- Indexes for table `request_cancelled`
--
ALTER TABLE `request_cancelled`
  ADD UNIQUE KEY `req_id` (`req_id`);

--
-- Indexes for table `request_completed`
--
ALTER TABLE `request_completed`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `request_main`
--
ALTER TABLE `request_main`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `Center_Constaint` (`region`);

--
-- Indexes for table `temp_user`
--
ALTER TABLE `temp_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annoucement`
--
ALTER TABLE `annoucement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `center`
--
ALTER TABLE `center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `center_complaints`
--
ALTER TABLE `center_complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `center_managers`
--
ALTER TABLE `center_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `center_notification`
--
ALTER TABLE `center_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `center_workers`
--
ALTER TABLE `center_workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `cm_admin`
--
ALTER TABLE `cm_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `collectors`
--
ALTER TABLE `collectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `collector_assistants`
--
ALTER TABLE `collector_assistants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `collector_complains`
--
ALTER TABLE `collector_complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `credits_transfer`
--
ALTER TABLE `credits_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `customer_complains`
--
ALTER TABLE `customer_complains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `discountagent_credit`
--
ALTER TABLE `discountagent_credit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `discount_agents`
--
ALTER TABLE `discount_agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fines`
--
ALTER TABLE `fines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `garbage_types`
--
ALTER TABLE `garbage_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `mail_subscriptions`
--
ALTER TABLE `mail_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `released_stocks`
--
ALTER TABLE `released_stocks`
  MODIFY `release_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `request_assigned`
--
ALTER TABLE `request_assigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `request_main`
--
ALTER TABLE `request_main`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT for table `temp_user`
--
ALTER TABLE `temp_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=377;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=718;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `center_complaints`
--
ALTER TABLE `center_complaints`
  ADD CONSTRAINT `fk_center_id` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `center_garbage`
--
ALTER TABLE `center_garbage`
  ADD CONSTRAINT `fk_centerid` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `center_managers`
--
ALTER TABLE `center_managers`
  ADD CONSTRAINT `sd` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `center_notification`
--
ALTER TABLE `center_notification`
  ADD CONSTRAINT `center_id_fk` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `customer_credits`
--
ALTER TABLE `customer_credits`
  ADD CONSTRAINT `customer_credits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discountagent_credit`
--
ALTER TABLE `discountagent_credit`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`agent_id`) REFERENCES `discount_agents` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discount_agents`
--
ALTER TABLE `discount_agents`
  ADD CONSTRAINT `fk_discount_agents_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garbage_confirmed`
--
ALTER TABLE `garbage_confirmed`
  ADD CONSTRAINT `fk_reqid` FOREIGN KEY (`req_id`) REFERENCES `request_completed` (`req_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `holidays`
--
ALTER TABLE `holidays`
  ADD CONSTRAINT `center_id_fkey` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`);

--
-- Constraints for table `released_stocks`
--
ALTER TABLE `released_stocks`
  ADD CONSTRAINT `fk_center` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_cancelled`
--
ALTER TABLE `request_cancelled`
  ADD CONSTRAINT `req` FOREIGN KEY (`req_id`) REFERENCES `request_main` (`req_id`);

--
-- Constraints for table `request_completed`
--
ALTER TABLE `request_completed`
  ADD CONSTRAINT `request_completed_ibfk_1` FOREIGN KEY (`req_id`) REFERENCES `request_main` (`req_id`);

--
-- Constraints for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD CONSTRAINT `user_notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
