-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 23, 2025 at 02:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orphanage_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Administrator', 'orphanadmin@gmail.com', '$2y$10$ZqeHJ82g7wxXSth8quFatumkgGoQk0GiAbB2IVWj028nii18sfKru', '2025-10-15 07:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `adoptions`
--

CREATE TABLE `adoptions` (
  `adoption_id` int(11) NOT NULL,
  `orphan_id` int(11) NOT NULL,
  `adopter_name` varchar(100) NOT NULL,
  `adopter_email` varchar(100) DEFAULT NULL,
  `adopter_phone` varchar(20) DEFAULT NULL,
  `adoption_date` date DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `adopter_address` varchar(500) DEFAULT NULL,
  `delete_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adoptions`
--

INSERT INTO `adoptions` (`adoption_id`, `orphan_id`, `adopter_name`, `adopter_email`, `adopter_phone`, `adoption_date`, `status`, `adopter_address`, `delete_status`) VALUES
(1, 5, 'Priyanka Parashar', '', '7689863098', '2025-09-26', 'Approved', 'Pune', 0),
(2, 8, 'Shravani Tope', '', '9345764356', '2025-10-08', 'Approved', 'Mumbai', 0),
(3, 2, 'Parth Chatupale', 'dyuga123@gmail.com', '9356820967', NULL, 'Pending', 'Chhatrapati Sambhajinagar', 0),
(4, 1, 'Shivam vox', 'shivamvox34@gmail.com', '8845673907', '0000-00-00', 'Rejected', 'Nashik', 0);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `donation_id` int(11) NOT NULL,
  `donor_id` int(11) DEFAULT NULL,
  `amount` varchar(200) DEFAULT '0',
  `type` enum('Money','Clothes','Food','Medicine','Other') DEFAULT 'Money',
  `description` text DEFAULT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0,
  `donation_date` date DEFAULT current_timestamp(),
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`donation_id`, `donor_id`, `amount`, `type`, `description`, `delete_status`, `donation_date`, `datetime`) VALUES
(1, 1, '20000', 'Money', '', 0, '2025-10-08', '2025-10-15 05:52:59'),
(2, 2, '', 'Food', '20 kg wheet flour', 0, '2025-10-13', '2025-10-16 08:50:48'),
(3, 2, '10000', 'Money', '', 0, '2025-10-15', '2025-10-16 08:51:34'),
(4, 1, '', 'Clothes', '50 shirts', 0, '2025-10-14', '2025-10-16 09:17:59'),
(5, 1, '30000', 'Money', '', 0, '2025-11-23', '2025-11-23 06:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0,
  `joined_on` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_id`, `name`, `email`, `phone`, `address`, `delete_status`, `joined_on`) VALUES
(1, 'Nikhil Joshi', 'nikhiljoshi21@gmail.com4', '9565787346', 'Chhatrappati Sambhajinagar', 0, '2025-10-15'),
(2, 'Yuga', 'yuga123456@gmail.com', '8754678934', 'Chhatrapati Sambhajinagar', 0, '2025-10-15'),
(3, 'Manasi Kulkarni', 'kmanasi357@gmail.com', '7689864567', 'Usmanpura,Chhatrapati sambhajinagar', 0, '2025-11-23');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` enum('Food','Clothes','Medicine','Other') DEFAULT 'Other',
  `quantity` int(11) DEFAULT 0,
  `unit` varchar(50) DEFAULT 'pcs',
  `received_date` date DEFAULT NULL,
  `donation_id` int(11) DEFAULT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_id`, `item_name`, `category`, `quantity`, `unit`, `received_date`, `donation_id`, `delete_status`) VALUES
(1, 'Wheat Flour', 'Food', 20, 'Kg', '2025-10-15', 2, 0),
(2, 'Sweaters', 'Clothes', 200, 'kg', '2025-11-19', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `type` enum('Event','Reminder','Alert') DEFAULT 'Event',
  `created_at` datetime DEFAULT current_timestamp(),
  `status` enum('Unread','Read') DEFAULT 'Unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orphans`
--

CREATE TABLE `orphans` (
  `orphan_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT 'Other',
  `dob` date DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `health_status` varchar(255) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(500) NOT NULL,
  `guardian_contact` varchar(10) NOT NULL,
  `status` enum('Available','Adopted') DEFAULT 'Available',
  `delete_status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orphans`
--

INSERT INTO `orphans` (`orphan_id`, `name`, `gender`, `dob`, `age`, `health_status`, `education`, `admission_date`, `photo`, `guardian_name`, `guardian_contact`, `status`, `delete_status`, `created_at`) VALUES
(1, 'Rohan Patil', 'Male', '2016-05-10', '9', 'Healthy', 'Primary School', '2021-06-02', '17605589801.jpg', '', '', 'Available', 0, '2025-10-16 01:39:40'),
(2, 'Yuga', 'Female', '2025-10-06', '18 Years', 'Healthy', '3rd', '2025-10-06', '17638935071.jpg', '', '', 'Available', 0, '2025-11-23 03:55:07'),
(3, 'Yuga', 'Female', '2025-10-06', '15 Years', 'Healty', '3rd', '2025-10-06', '17605134731.png', '', '', 'Available', 1, '2025-10-15 01:01:13'),
(4, 'Trupti Vyahalkar', 'Female', '2022-06-14', '3', 'Healthy', '', '2025-10-07', '17605589531.jpg', '', '', 'Available', 0, '2025-10-16 01:39:13'),
(5, 'Mihir Bhalerao', 'Male', '2021-11-17', '3', '', '', '2025-08-07', '17605591811.jpeg', 'Vishakha Bhalerao', '9834567654', 'Adopted', 0, '2025-10-16 01:43:01'),
(6, 'Shubham Rathore', 'Male', '2021-05-23', '4', '', '', '2025-10-14', '17605594201.jpg', '', '', 'Available', 0, '2025-10-16 01:47:00'),
(7, 'Vishnu Joshi', 'Male', '2022-03-18', '3', '', '', '2025-10-03', '17605605781.jpeg', '', '', 'Available', 0, '2025-10-16 02:06:18'),
(8, 'Akash Verma', 'Male', '2021-07-09', '4', '', '', '2025-10-11', '17605606211.jpg', '', '', 'Adopted', 0, '2025-10-16 02:07:01'),
(9, 'Dharti Ahuja', 'Female', '2022-09-05', '3', '', '', '2025-10-12', '17605606761.jpeg', '', '', 'Available', 0, '2025-10-16 02:07:56'),
(10, 'Nikita Jain', 'Female', '2021-01-04', '4', '', '', '2025-10-03', '17605607421.jpeg', '', '', 'Available', 0, '2025-10-16 02:09:02'),
(11, 'Mihika Verma', 'Female', '2022-03-25', '3', '', '', '2025-10-15', '17605608131.jpg', '', '', 'Available', 0, '2025-10-16 02:10:13'),
(12, 'A', 'Male', '2021-01-15', '4', 'Healthy', 'Primary School', '2025-10-06', '17638936221.jpg', 'Vishakha Bhalerao', '9834567654', 'Available', 0, '2025-11-23 03:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `salary` varchar(200) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `delete_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `email`, `phone`, `role_id`, `address`, `salary`, `join_date`, `status`, `delete_status`) VALUES
(1, 'Manav Thakre', 'yuga123456@gmail.com', '8765678643', 4, 'Sambhajinagar', '12000', '2025-09-29', 'Active', 0),
(2, 'Revati Chatupale', '', '8765432176', 9, 'Samarthnagar, Chhatrapati Sambhajinagar', '10000', '2025-10-15', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_roles`
--

CREATE TABLE `staff_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_description` text DEFAULT NULL,
  `delete_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_roles`
--

INSERT INTO `staff_roles` (`role_id`, `role_name`, `role_description`, `delete_status`) VALUES
(1, 'Administrator / Manager', 'Oversees overall operations, finance, and staff coordination.', 0),
(2, 'Accountant / Finance Officer', 'Manages financial records, donations, and expenses.', 0),
(3, 'Receptionist / Clerk', 'Handles front-desk tasks, record-keeping, and visitor management.', 0),
(4, 'HR Officer', 'Manages staff recruitment, attendance, and leaves.', 0),
(5, 'Caregiver / Warden', 'Takes care of children’s daily needs, safety, and discipline.', 0),
(6, 'Teacher / Tutor', 'Provides education and academic assistance to children.', 0),
(7, 'Counsellor / Psychologist', 'Supports mental and emotional well-being of children.', 0),
(8, 'Activity Coordinator', 'Organizes fun and educational activities for children.', 0),
(9, 'Nurse / Health Officer', 'Looks after children’s health and medical requirements.', 0),
(10, 'Security Guard', 'Ensures the safety and security of the orphanage premises.', 0),
(11, 'Cook / Kitchen Staff', 'Prepares food and maintains kitchen cleanliness.', 0),
(12, 'Cleaner / Housekeeper', 'Cleans and maintains rooms, washrooms, and other facilities.', 0),
(13, 'Donor Relations Officer', 'Maintains communication with donors and manages donation records.', 0),
(14, 'Volunteer Coordinator', 'Supervises volunteers and assigns daily responsibilities.', 0),
(15, 'Adoption Coordinator', 'Manages adoption records and family communications.', 0),
(16, 'IT / System Operator', 'Handles the orphanage management system, data, and backups.', 0),
(17, 'Driver', 'Transports children and staff safely to schools or hospitals.', 0),
(18, 'Storekeeper', 'Maintains inventory and donation stock records.', 0),
(19, 'Legal Advisor', 'Advises on legal matters related to adoption and compliance.', 0),
(20, 'Field Officer', 'Monitors post-adoption progress and sponsor relationships.', 0),
(21, 'Test', 'testttt', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `orphan_id` (`orphan_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`donor_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `donation_id` (`donation_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `orphans`
--
ALTER TABLE `orphans`
  ADD PRIMARY KEY (`orphan_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `role_fk` (`role_id`);

--
-- Indexes for table `staff_roles`
--
ALTER TABLE `staff_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adoptions`
--
ALTER TABLE `adoptions`
  MODIFY `adoption_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orphans`
--
ALTER TABLE `orphans`
  MODIFY `orphan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_roles`
--
ALTER TABLE `staff_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoptions`
--
ALTER TABLE `adoptions`
  ADD CONSTRAINT `adoptions_ibfk_1` FOREIGN KEY (`orphan_id`) REFERENCES `orphans` (`orphan_id`) ON DELETE CASCADE;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`donor_id`) ON DELETE SET NULL;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`donation_id`) REFERENCES `donations` (`donation_id`) ON DELETE SET NULL;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `role_fk` FOREIGN KEY (`role_id`) REFERENCES `staff_roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
