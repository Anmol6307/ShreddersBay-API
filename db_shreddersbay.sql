-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2021 at 12:22 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shreddersbay`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_area`
--

CREATE TABLE `delivery_area` (
  `d_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `darea_name` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `addr_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `pin_code` int(11) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`addr_id`, `user_id`, `country_id`, `state_id`, `city_id`, `address`, `pin_code`, `landmark`, `status`, `date`) VALUES
(1, 1, 1, 1, 1, 'Aliganj, Sector 12, colony 56, Lucknow.', 20061, 'Near Adarsh hospital', 1, '2021-12-07 10:10:19'),
(2, 1, 1, 1, 2, 'Yogendra vihar, Sector 22, Ghantaghar, Kanpur.', 20061, 'Near TCS center', 1, '2021-12-07 10:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `area_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `total_weight` float NOT NULL,
  `total_price` float NOT NULL,
  `filename` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `city_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contacts`
--

CREATE TABLE `tbl_contacts` (
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-call\r\n1-called\r\n2-not responded',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE `tbl_country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `country_code` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faqs`
--

CREATE TABLE `tbl_faqs` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_faqs`
--

INSERT INTO `tbl_faqs` (`faq_id`, `question`, `answer`, `status`, `created_at`) VALUES
(1, 'How can I track my Orders & Payment?', 'After logging into your account, the status of your checkout history can be\r\n                                        found under order history.', 1, '2021-11-29 05:22:36'),
(2, 'How do I activate my Account?', 'The instructions to activate your account will be sent to your email once you have submitted the registration form.', 1, '2021-11-29 05:18:03'),
(3, 'What are the Payment methods are available?', 'At the moment, we only accept Credit/Debit cards Payments.', 1, '2021-11-29 05:19:13'),
(4, 'How do I find my Order details?', 'Go to My Orders in your account to find details for all your orders.', 1, '2021-11-29 05:20:05'),
(5, 'Can I reschedule the pickup date?', 'You can schedule the pickup date based on your convenience.', 1, '2021-11-29 05:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `addr_id` int(11) NOT NULL,
  `total_weight` float NOT NULL,
  `approx_price` float NOT NULL,
  `filename` varchar(255) NOT NULL,
  `booking_date` datetime NOT NULL,
  `schedule_date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0-cancel 1-current 2-accept 3-ignore 4-complete',
  `updated_at` datetime NOT NULL,
  `canceled_date` datetime NOT NULL,
  `completed_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`booking_id`, `user_id`, `dealer_id`, `prod_id`, `addr_id`, `total_weight`, `approx_price`, `filename`, `booking_date`, `schedule_date`, `status`, `updated_at`, `canceled_date`, `completed_date`) VALUES
(1, 1, 0, 3, 1, 40, 2000, '1.jpg', '2021-12-07 15:40:46', '2021-12-17 15:39:00', 0, '0000-00-00 00:00:00', '2021-12-07 15:46:45', '0000-00-00 00:00:00'),
(2, 1, 2, 4, 2, 40, 2400, '2.jpg', '2021-12-07 15:43:00', '2021-12-25 15:41:00', 4, '2021-12-07 16:21:43', '2021-12-07 15:51:59', '2021-12-07 16:22:32'),
(3, 1, 2, 5, 1, 40, 2800, '4.jpg', '2021-12-07 15:44:10', '2021-12-18 15:43:00', 0, '2021-12-07 16:32:25', '2021-12-07 18:10:24', '0000-00-00 00:00:00'),
(4, 1, 2, 6, 2, 50, 4000, '5.jpg', '2021-12-07 15:45:19', '2021-12-15 15:45:00', 0, '2021-12-08 11:09:17', '2021-12-08 11:23:41', '0000-00-00 00:00:00'),
(5, 1, 2, 7, 1, 40, 3600, '7.jpg', '2021-12-07 17:52:09', '2021-12-14 17:51:00', 4, '2021-12-08 11:21:00', '0000-00-00 00:00:00', '2021-12-08 11:22:15'),
(6, 1, 2, 8, 2, 40, 4000, '6.jpg', '2021-12-07 17:53:42', '2021-12-13 05:53:00', 1, '2021-12-08 11:49:54', '2021-12-08 13:16:37', '0000-00-00 00:00:00'),
(7, 1, 2, 9, 1, 40, 4400, '10.jpg', '2021-12-08 11:03:45', '2021-12-10 11:05:00', 2, '2021-12-08 11:47:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 2, 10, 2, 20, 2400, '7.jpg', '2021-12-08 11:07:47', '2021-12-10 11:10:00', 2, '2021-12-08 12:22:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`p_id`, `p_name`, `sub_name`, `weight`, `price`, `file`, `created_at`) VALUES
(3, 'Aluminiums', 'Heavy', '1', '50', 'aluminium.jpeg', '2021-08-17'),
(4, 'Brass', 'Light', '1', '60', 'brass.jpg', '2021-08-17'),
(5, 'Cables', 'Light', '1', '70', 'cable.jpg', '2021-08-17'),
(6, 'Cardboard', 'Cardboard Material', '1', '80', 'cardboard.jpg', '2021-08-17'),
(7, 'Copper', 'Heavy Weight', '1', '90', 'Copper.jpeg', '2021-08-17'),
(8, 'Glass Bottels', 'Glass Bottle, Heavy Weight', '1', '100', 'glass-bottels.jpg', '2021-08-17'),
(9, 'Iron', 'Heavy', '1', '110', 'iron.png', '2021-08-17'),
(10, 'Lead', 'Heavy', '1', '120', 'lead.jpg', '2021-08-17'),
(11, 'Motor Pumps', 'Heavy Weight', '1', '130', 'motor.jpg', '2021-08-17'),
(12, 'Newspaper', 'Newspaper', '1', '140', 'newspaper.jpg', '2021-08-17'),
(13, 'Packaging Item Paper', 'Packaging Cartoon', '1', '150', 'packaging-paper.jpg', '2021-08-17'),
(14, 'Plastic', 'Plastic Bottels', '1', '160', 'plastic.jpg', '2021-08-17'),
(15, 'Steel', 'Heavy Weight', '1', '170', 'steel.jpg', '2021-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`id`, `user_id`, `name`, `rating`, `message`) VALUES
(1, 1, 'Shikha Gupta', '5', 'This Website is very helpful for me........!'),
(2, 2, 'Annu Gupta', '5', 'This Website is very helpful for me........!');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `state_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `user_role` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `google_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `user_role`, `name`, `email`, `password`, `profile`, `mobile`, `google_id`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Shikha', 'shikha@gmail.com', 'Hello@123', 'profile.jpg', 9087654321, '', '', 1, '2021-12-07 09:57:32', '2021-12-07 15:27:32'),
(2, 1, 'Annu', 'annu@gmail.com', 'Hello@123', 'profile.jpg', 9876543210, '', '', 1, '2021-12-07 10:03:54', '2021-12-07 15:33:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_area`
--
ALTER TABLE `delivery_area`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`addr_id`);

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_country`
--
ALTER TABLE `tbl_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_area`
--
ALTER TABLE `delivery_area`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `addr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_country`
--
ALTER TABLE `tbl_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
