-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2023 at 07:10 AM
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

--
-- Dumping data for table `joms_installation`
--

INSERT INTO `joms_installation` (`id`, `request_id`, `installation_date`, `set_by`, `date_updated`) VALUES
(1, 'JOMS:230915126190e', '2023-09-23', 'jj', '2023-09-15 12:28:20'),
(2, 'JOMS:2309151274b99', '2023-09-23', 'jj', '2023-09-15 12:28:20');

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
  `uploaded_by` varchar(255) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `joms_po_process`
--

INSERT INTO `joms_po_process` (`id`, `request_id`, `target_approval_date_of_quotation`, `approval_date_of_quotation`, `target_date_submission_to_purchasing`, `actual_date_of_submission_to_purchasing`, `target_po_date`, `po_date`, `po_no`, `ordering_additional_details`, `supplier`, `etd`, `eta`, `actual_arrival_date`, `invoice_no`, `classification`, `remarks`, `uploaded_by`, `date_updated`) VALUES
(1, 'JOMS:230915126190e', '2023-09-24', '2023-09-24', '2023-09-24', '2023-09-24', '2023-09-24', '2023-09-24', 'asd1', 'asd1', 'FAS', '2023-09-24', 'hahaaaa', '2023-09-28', 'FAS', '2023-09-24', '2023-09-24', 'jj', '2023-09-15 12:22:55'),
(2, 'JOMS:2309151274b99', '2023-09-25', '2023-09-25', '2023-09-25', '2023-09-25', '2023-09-25', '2023-09-25', 'asd1', 'asd1', 'FAS', '2023-09-25', 'hahaaaa', '2023-09-28', 'FAS', '2023-09-25', '2023-09-25', 'jj', '2023-09-15 12:22:55'),
(3, 'JOMS:23091512322db', '2023-09-26', '2023-09-26', '2023-09-26', '2023-09-26', '2023-09-26', '2023-09-26', 'asd1', 'asd1', 'FAS', '2023-09-26', 'hahaaaa', '2023-09-28', 'FAS', '2023-09-26', '2023-09-26', 'jj', '2023-09-15 12:22:55'),
(4, 'JOMS:230915126fea3', '2023-09-27', '2023-09-27', '2023-09-27', '2023-09-27', '2023-09-27', '2023-09-27', 'asd1', 'asd1', 'FAS', '2023-09-27', 'hahaaaa', '2023-09-28', 'FAS', '2023-09-27', '2023-09-27', 'jj', '2023-09-15 12:22:55'),
(5, 'JOMS:23091512603b6', '2023-09-28', '2023-09-28', '2023-09-28', '2023-09-28', '2023-09-28', '2023-09-28', 'asd1', 'asd1', 'FAS', '2023-09-28', 'hahaaaa', '2023-09-28', 'FAS', '2023-09-28', '2023-09-28', 'jj', '2023-09-15 12:22:55'),
(6, 'JOMS:2309151216938', '2023-09-29', '2023-09-29', '2023-09-29', '2023-09-29', '2023-09-29', '2023-09-29', 'asd1', 'asd1', 'FAS', '2023-09-29', 'hahaaaa', '2023-09-28', 'FAS', '2023-09-29', '2023-09-29', 'jj', '2023-09-15 12:22:55'),
(7, 'JOMS:230915123ce38', '2023-09-30', '2023-09-30', '2023-09-30', '2023-09-30', '2023-09-30', '2023-09-30', 'asd1', 'asd1', 'FAS', '2023-09-30', 'hahaaaa', '2023-09-28', 'FAS', '2023-09-30', '2023-09-30', 'jj', '2023-09-15 12:22:55'),
(8, 'JOMS:2309151269671', '2023-10-01', '2023-10-01', '2023-10-01', '2023-10-01', '2023-10-01', '2023-10-01', 'asd1', 'asd1', 'FAS', '2023-10-01', 'hahaaaa', '2023-09-28', 'FAS', '2023-10-01', '2023-10-01', 'jj', '2023-09-15 12:22:55');

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
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `joms_request`
--

INSERT INTO `joms_request` (`id`, `request_id`, `status`, `carmaker`, `carmodel`, `product`, `jigname`, `drawing_no`, `type`, `qty`, `purpose`, `budget`, `date_requested`, `requested_by`, `required_delivery_date`, `remarks`, `uploaded_by`, `date_updated`) VALUES
(1, 'JOMS:230915126190e', 'closed', 'Mazda', 'J12S RHD', '50', 'EA15', '', 'Metal Parts', 100, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'haha', 'jj', '2023-09-15 12:19:03'),
(2, 'JOMS:2309151274b99', 'closed', 'Mazda', 'J12S RHD', '50', 'EA20', '', 'Metal Parts', 225, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'gege', 'jj', '2023-09-15 12:21:08'),
(3, 'JOMS:23091512322db', 'closed', 'Mazda', 'J12S RHD', '50', 'EA20H', '', 'Metal Parts', 15, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'hehe', 'jj', '2023-09-15 12:21:08'),
(4, 'JOMS:230915126fea3', 'closed', 'Mazda', 'J12S RHD', '50', 'EA20H', '', 'Metal Parts', 15, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'hhiji', 'jj', '2023-09-15 12:21:08'),
(5, 'JOMS:23091512603b6', 'closed', 'Mazda', 'J12S RHD', '50', 'EA20H', '', 'Metal Parts', 15, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'huhu', 'jj', '2023-09-15 12:21:08'),
(6, 'JOMS:2309151216938', 'closed', 'Mazda', 'J12S RHD', '50', 'EA20H', '', 'Metal Parts', 15, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'hekhek', 'jj', '2023-09-15 12:21:08'),
(7, 'JOMS:230915123ce38', 'closed', 'Mazda', 'J12S RHD', '50', 'EA15', '', 'Metal Parts', 100, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'haha', 'jj', '2023-09-15 12:21:08'),
(8, 'JOMS:2309151269671', 'closed', 'Mazda', 'J12S RHD', '50', 'EA20', '', 'Metal Parts', 225, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'gege', 'jj', '2023-09-15 12:21:08'),
(9, 'JOMS:23091512ab81a', 'open', 'Mazda', 'J12S RHD', '50', 'EA20H', '', 'Metal Parts', 15, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'hehe', 'jj', '2023-09-15 12:07:32'),
(10, 'JOMS:23091512c4111', 'open', 'Mazda', 'J12S RHD', '50', 'EA20H', '', 'Metal Parts', 15, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'hhiji', 'jj', '2023-09-15 12:07:32'),
(11, 'JOMS:230915126be90', 'pending', 'Mazda', 'J12S RHD', '50', 'EA20H', '', 'Metal Parts', 15, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'huhu', 'jj', '2023-09-15 12:02:31'),
(12, 'JOMS:2309151274c69', 'pending', 'Mazda', 'J12S RHD', '50', 'EA20H', '', 'Metal Parts', 15, 'EV-MP Set up', 23017000, '2023-08-24', 'imat', '2023-09-24', 'hekhek', 'jj', '2023-09-15 12:02:31');

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

--
-- Dumping data for table `joms_rfq_process`
--

INSERT INTO `joms_rfq_process` (`id`, `request_id`, `date_of_issuance_rfq`, `rfq_no`, `target_date_reply_quotation`, `i_uploaded_by`, `i_date_updated`, `date_reply_quotation`, `leadtime`, `quotation_no`, `unit_price_jpy`, `unit_price_usd`, `total_amount`, `c_uploaded_by`, `c_date_updated`, `fsib_no`, `fsib_code`, `date_sent_to_internal_signatories`) VALUES
(1, 'JOMS:230915126190e', '2023-09-24', 'asdas', '2023-09-24', 'jj', '2023-09-15 12:07:31', '2023-09-24', 'asda', 'asdasd', '1123', '123123', 12312, 'jj', '2023-09-15 12:10:00', 'asdasd1', 'asdasd1', '2023-09-24'),
(2, 'JOMS:2309151274b99', '2023-09-25', 'asdas', '2023-09-25', 'jj', '2023-09-15 12:07:31', '2023-09-25', 'asda', 'asdasd', '1123', '123123', 12312, 'jj', '2023-09-15 12:10:00', 'asdasd1', 'asdasd1', '2023-09-25'),
(3, 'JOMS:23091512322db', '2023-09-26', 'asdas', '2023-09-26', 'jj', '2023-09-15 12:07:31', '2023-09-26', 'asda', 'asdasd', '1123', '123123', 12312, 'jj', '2023-09-15 12:10:00', 'asdasd1', 'asdasd1', '2023-09-26'),
(4, 'JOMS:230915126fea3', '2023-09-27', 'asdas', '2023-09-27', 'jj', '2023-09-15 12:07:31', '2023-09-27', 'asda', 'asdasd', '1123', '123123', 12312, 'jj', '2023-09-15 12:10:00', 'asdasd1', 'asdasd1', '2023-09-27'),
(5, 'JOMS:23091512603b6', '2023-09-28', 'asdas', '2023-09-28', 'jj', '2023-09-15 12:07:31', '2023-09-28', 'asda', 'asdasd', '1123', '123123', 12312, 'jj', '2023-09-15 12:10:00', 'asdasd1', 'asdasd1', '2023-09-28'),
(6, 'JOMS:2309151216938', '2023-09-29', 'asdas', '2023-09-29', 'jj', '2023-09-15 12:07:31', '2023-09-29', 'asda', 'asdasd', '1123', '123123', 12312, 'jj', '2023-09-15 12:10:00', 'asdasd1', 'asdasd1', '2023-09-29'),
(7, 'JOMS:230915123ce38', '2023-09-30', 'asdas', '2023-09-30', 'jj', '2023-09-15 12:07:31', '2023-09-30', 'asda', 'asdasd', '1123', '123123', 12312, 'jj', '2023-09-15 12:10:00', 'asdasd1', 'asdasd1', '2023-09-30'),
(8, 'JOMS:2309151269671', '2023-10-01', 'asdas', '2023-10-01', 'jj', '2023-09-15 12:07:32', '2023-10-01', 'asda', 'asdasd', '1123', '123123', 12312, 'jj', '2023-09-15 12:10:00', 'asdasd1', 'asdasd1', '2023-10-01'),
(9, 'JOMS:23091512ab81a', '2023-10-02', 'asdas', '2023-10-02', 'jj', '2023-09-15 12:07:32', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', NULL),
(10, 'JOMS:23091512c4111', '2023-10-03', 'asdas', '2023-10-03', 'jj', '2023-09-15 12:07:32', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', NULL);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joms_po_process`
--
ALTER TABLE `joms_po_process`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `joms_po_process`
--
ALTER TABLE `joms_po_process`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `joms_request`
--
ALTER TABLE `joms_request`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `joms_rfq_process`
--
ALTER TABLE `joms_rfq_process`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
