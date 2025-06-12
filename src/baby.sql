-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 09:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baby`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklists`
--

CREATE TABLE `checklists` (
  `id` int(64) NOT NULL,
  `title` varchar(256) NOT NULL,
  `user_id` int(64) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklists`
--

INSERT INTO `checklists` (`id`, `title`, `user_id`, `created_timestamp`, `updated_timestamp`) VALUES
(1, 'Test 1', 3, '2025-05-19 12:43:05', '2025-05-19 12:43:05'),
(3, 'Ayam', 4, '2025-06-01 20:11:14', '2025-06-01 20:11:14'),
(5, 'Ikan', 4, '2025-06-02 01:55:42', '2025-06-02 01:55:42'),
(7, 'tidur', 4, '2025-06-02 05:42:51', '2025-06-02 05:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `checklists_parent`
--

CREATE TABLE `checklists_parent` (
  `id` int(11) NOT NULL,
  `checklist_id` int(11) DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `user_id` int(64) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklists_parent`
--

INSERT INTO `checklists_parent` (`id`, `checklist_id`, `title`, `user_id`, `created_timestamp`, `updated_timestamp`) VALUES
(15, 3, 'Ayam', 5, '2025-06-02 05:04:41', '2025-06-02 05:04:41'),
(17, NULL, 'Baby', 5, '2025-06-02 05:18:26', '2025-06-02 05:18:26'),
(18, 5, 'Ikan', 5, '2025-06-02 05:18:54', '2025-06-02 05:18:54'),
(19, NULL, 'bagi susu', 5, '2025-06-02 05:28:25', '2025-06-02 05:28:25'),
(20, 7, 'tidur', 5, '2025-06-02 05:43:10', '2025-06-02 05:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `checklist_items`
--

CREATE TABLE `checklist_items` (
  `id` int(64) NOT NULL,
  `item` varchar(256) NOT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT 0,
  `checklist_id` int(64) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklist_items`
--

INSERT INTO `checklist_items` (`id`, `item`, `is_done`, `checklist_id`, `created_timestamp`, `updated_timestamp`) VALUES
(2, 'Test 2', 1, 1, '2025-05-19 12:43:12', '2025-06-01 20:01:32'),
(4, 'test 3', 1, 1, '2025-06-01 19:31:19', '2025-06-01 20:03:42'),
(5, 'test 3', 0, 1, '2025-06-01 20:03:50', '2025-06-01 20:03:50'),
(6, 'test 4', 0, 1, '2025-06-01 20:04:06', '2025-06-01 20:04:06'),
(8, 'haha', 0, 1, '2025-06-01 20:10:13', '2025-06-01 20:10:13'),
(9, 'goreng', 1, 3, '2025-06-01 20:11:23', '2025-06-02 05:19:44'),
(10, 'rebus', 0, 3, '2025-06-01 20:11:28', '2025-06-01 20:11:28'),
(11, 'salai', 0, 3, '2025-06-01 20:11:34', '2025-06-01 20:11:34'),
(15, 'Pedas', 0, 3, '2025-06-02 01:55:34', '2025-06-02 01:55:34'),
(19, 'Goreng', 0, 5, '2025-06-02 02:27:04', '2025-06-02 02:27:04'),
(20, 'nap 1', 0, 7, '2025-06-02 05:43:04', '2025-06-02 05:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `checklist_items_parent`
--

CREATE TABLE `checklist_items_parent` (
  `id` int(11) NOT NULL,
  `checklist_item_id` int(11) DEFAULT NULL,
  `item` varchar(256) DEFAULT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT 0,
  `checklist_id` int(64) NOT NULL,
  `user_id` int(64) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklist_items_parent`
--

INSERT INTO `checklist_items_parent` (`id`, `checklist_item_id`, `item`, `is_done`, `checklist_id`, `user_id`, `created_timestamp`, `updated_timestamp`) VALUES
(53, 15, NULL, 1, 15, 5, '2025-06-02 05:04:41', '2025-06-02 07:01:55'),
(54, 11, NULL, 1, 15, 5, '2025-06-02 05:04:41', '2025-06-02 05:22:42'),
(55, 10, NULL, 1, 15, 5, '2025-06-02 05:04:41', '2025-06-02 05:22:09'),
(56, 9, NULL, 1, 15, 5, '2025-06-02 05:04:41', '2025-06-02 05:19:28'),
(57, NULL, 'Kecik', 0, 16, 0, '2025-06-02 05:09:12', '2025-06-02 05:09:12'),
(58, NULL, 'kecik', 0, 17, 5, '2025-06-02 05:18:32', '2025-06-02 05:18:32'),
(59, NULL, 'Comel', 1, 17, 5, '2025-06-02 05:18:49', '2025-06-02 05:19:25'),
(60, 19, NULL, 0, 18, 5, '2025-06-02 05:18:54', '2025-06-02 05:18:54'),
(63, NULL, 'nyenyak', 1, 20, 5, '2025-06-02 07:02:53', '2025-06-02 07:03:08'),
(64, NULL, 'tidak nyenyak', 0, 20, 5, '2025-06-02 07:02:59', '2025-06-02 07:02:59'),
(65, NULL, 'tipu', 0, 20, 5, '2025-06-02 07:03:05', '2025-06-02 07:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(64) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `filename` varchar(256) NOT NULL,
  `category` varchar(64) NOT NULL DEFAULT 'baby',
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(32) NOT NULL DEFAULT 'parent',
  `filename` varchar(128) DEFAULT NULL,
  `reset_code` varchar(256) DEFAULT NULL,
  `new_password` varchar(256) DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `role`, `filename`, `reset_code`, `new_password`, `is_enabled`, `created_timestamp`, `updated_timestamp`) VALUES
(1, 'admin@gmail.com', 'ADMINISTRATOR', 'BABY', '$2y$10$HaKgwnl25MieHZN52ZTn6OMhFl1CiLs2ohoC/Vr4SOVPdJaWka1Ta', 'admin', NULL, NULL, NULL, 1, '2020-01-01 00:00:00', '2020-01-01 00:00:00'),
(2, 'azrin@gmail.com', 'AZRIN', 'AZIZ', '$2y$10$xUIp4OECPcVWS/nSCZKOIuhSUNi5kBMSAaiJF46V2MybjsYymSDGe', 'parent', NULL, NULL, NULL, 0, '2020-01-01 00:00:00', '2020-01-01 00:00:00'),
(3, 'syafiq@gmail.com', 'SYAFIQ', 'HADI', '$2y$10$qddk3fvMz3jByHgvA5qXsO/.27kcSALX2CWQZ6JlHd6A5Pk55I3jq', 'parent', NULL, NULL, NULL, 1, '2020-01-01 00:00:00', '2020-01-01 00:00:00'),
(4, 'admin1@gmail.com', 'ADMIN1', 'ADMIN1', '$2y$10$19ceRBOMV4frIUhzqahwpuv3iKttHdn1MNXPmvr84QDpSbph2cf1a', 'admin', NULL, NULL, NULL, 1, '2025-06-01 19:29:30', '2025-06-01 19:29:30'),
(5, 'ayah@gmail.com', 'AYAH', 'AYAH', '$2y$10$JpnrumaUjvzcTJkCQAggBefp0lSciNV6VUe87/yvjbdaSuL3jGFkO', 'parent', NULL, NULL, NULL, 1, '2025-06-01 20:32:53', '2025-06-01 20:32:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklists_ibfk_1` (`user_id`);

--
-- Indexes for table `checklists_parent`
--
ALTER TABLE `checklists_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklist_items`
--
ALTER TABLE `checklist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_id` (`checklist_id`);

--
-- Indexes for table `checklist_items_parent`
--
ALTER TABLE `checklist_items_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `checklists_parent`
--
ALTER TABLE `checklists_parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `checklist_items`
--
ALTER TABLE `checklist_items`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `checklist_items_parent`
--
ALTER TABLE `checklist_items_parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checklists`
--
ALTER TABLE `checklists`
  ADD CONSTRAINT `checklists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `checklist_items`
--
ALTER TABLE `checklist_items`
  ADD CONSTRAINT `checklist_items_ibfk_1` FOREIGN KEY (`checklist_id`) REFERENCES `checklists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
