-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 08:13 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `joms_installation`
--

CREATE TABLE `joms_installation` (
  `id` int(50) NOT NULL,
  `request_id` varchar(255) DEFAULT NULL,
  `installation_date` date DEFAULT NULL,
  `set_by` varchar(255) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `joms_po_process`
--

CREATE TABLE `joms_po_process` (
  `id` int(50) NOT NULL,
  `request_id` varchar(255) DEFAULT NULL,
  `target_approval_date_of_quotation` date DEFAULT NULL,
  `approval_date_of_quotation` date DEFAULT NULL,
  `target_date_submission_to_purchasing` date DEFAULT NULL,
  `actual_date_of_submission_to_purchasing` date DEFAULT NULL,
  `target_po_date` date DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `po_no` varchar(100) DEFAULT NULL,
  `ordering_additional_details` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `etd` varchar(100) DEFAULT NULL,
  `eta` varchar(100) DEFAULT NULL,
  `actual_arrival_date` date DEFAULT NULL,
  `invoice_no` varchar(100) DEFAULT NULL,
  `classification` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `po_uploaded_by` varchar(255) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `joms_request`
--

CREATE TABLE `joms_request` (
  `id` int(50) NOT NULL,
  `request_id` varchar(255) NOT NULL,
  `status` varchar(10) DEFAULT 'pending',
  `carmaker` varchar(100) DEFAULT NULL,
  `carmodel` varchar(100) DEFAULT NULL,
  `product` varchar(100) DEFAULT NULL,
  `jigname` varchar(100) DEFAULT NULL,
  `drawing_no` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `qty` int(15) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `budget` int(15) DEFAULT NULL,
  `date_requested` date DEFAULT NULL,
  `requested_by` varchar(50) DEFAULT NULL,
  `required_delivery_date` date DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `uploaded_by` varchar(255) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cancel_date` date DEFAULT NULL,
  `cancel_reason` varchar(255) NOT NULL,
  `cancel_by` varchar(255) NOT NULL,
  `cancel_section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `joms_rfq_process`
--

CREATE TABLE `joms_rfq_process` (
  `id` int(50) NOT NULL,
  `request_id` varchar(255) DEFAULT NULL,
  `date_of_issuance_rfq` date DEFAULT NULL,
  `rfq_no` varchar(50) DEFAULT NULL,
  `target_date_reply_quotation` date DEFAULT NULL,
  `i_uploaded_by` varchar(255) NOT NULL,
  `i_date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  `date_reply_quotation` date DEFAULT NULL,
  `leadtime` varchar(20) DEFAULT NULL,
  `quotation_no` varchar(50) DEFAULT NULL,
  `unit_price_jpy` varchar(20) DEFAULT NULL,
  `unit_price_usd` varchar(20) DEFAULT NULL,
  `total_amount` int(15) DEFAULT NULL,
  `c_uploaded_by` varchar(255) NOT NULL,
  `c_date_updated` datetime DEFAULT NULL,
  `fsib_no` varchar(255) NOT NULL,
  `fsib_code` varchar(255) NOT NULL,
  `date_sent_to_internal_signatories` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notif_joms_request`
--

CREATE TABLE `notif_joms_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `interface` varchar(100) NOT NULL,
  `new_joms_request` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notif_joms_request`
--

INSERT INTO `notif_joms_request` (`id`, `interface`, `new_joms_request`) VALUES
(1, 'AME3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(50) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `fullname`, `username`, `password`, `section`, `role`) VALUES
(1, 'jj', 'req', 'admin', 'mppd1', 'admin'),
(2, 'jj', 'ame3', 'admin', 'ame3', 'admin'),
(3, 'jj', 'ame2', 'admin', 'ame2', 'admin'),
(4, 'req2', 'req2', 'admin', 'mppd1', 'admin'),
(5, 'req-user1', 'req-user1', 'user', 'mppd1', 'user'),
(6, 'ame2user1', 'ame2user1', 'user', 'ame2', 'user'),
(7, 'ame3user1', 'ame3user1', 'user', 'ame3', 'user'),
(8, 'ame3user2', 'ame3user2', 'user', 'ame3', 'user'),
(9, 'ame3user3', 'ame3user3', 'user', 'ame3', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `joms_installation`
--
ALTER TABLE `joms_installation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `joms_po_process`
--
ALTER TABLE `joms_po_process`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `joms_request`
--
ALTER TABLE `joms_request`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `request_id` (`request_id`);

--
-- Indexes for table `joms_rfq_process`
--
ALTER TABLE `joms_rfq_process`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `notif_joms_request`
--
ALTER TABLE `notif_joms_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `joms_installation`
--
ALTER TABLE `joms_installation`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `joms_po_process`
--
ALTER TABLE `joms_po_process`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `joms_request`
--
ALTER TABLE `joms_request`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `joms_rfq_process`
--
ALTER TABLE `joms_rfq_process`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notif_joms_request`
--
ALTER TABLE `notif_joms_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
