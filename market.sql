-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2019 at 11:45 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_user` int(11) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_user`, `description`, `active`, `created_at`) VALUES
(1, 'Phones', 4, 'sdcfdvdfvdffvdf', 1, '2019-06-11 09:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `c_order`
--

CREATE TABLE `c_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_total` varchar(255) NOT NULL,
  `order_status` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `c_order`
--

INSERT INTO `c_order` (`order_id`, `customer_id`, `shipping_id`, `payment_id`, `order_total`, `order_status`, `created_at`) VALUES
(1, 1, 2, 1, '690', 1, '2019-04-28 11:33:31'),
(2, 1, 3, 2, '345', 0, '2019-05-18 08:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `c_order_details`
--

CREATE TABLE `c_order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_qty` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Table structure for table `gallary`
--

CREATE TABLE `gallary` (
  `gallary_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallary`
--

INSERT INTO `gallary` (`gallary_id`, `image_name`, `product_id`, `created_at`) VALUES
(1, 'phonex1560246238.jpg', 1, '2019-06-11 09:43:58'),
(2, 'phonexplus1560246238.jpg', 1, '2019-06-11 09:43:58'),
(3, 'samsung galaxy s61560246239.jpg', 1, '2019-06-11 09:43:59'),
(4, 'samsung galaxy s71560246239.jpg', 1, '2019-06-11 09:43:59'),
(5, 'samsung galaxy s81560246239.jpg', 1, '2019-06-11 09:43:59'),
(6, 'samsung galaxy s91560246239.jpg', 1, '2019-06-11 09:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `manufactures`
--

CREATE TABLE `manufactures` (
  `man_id` int(11) NOT NULL,
  `man_name` varchar(255) NOT NULL,
  `man_user` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufactures`
--

INSERT INTO `manufactures` (`man_id`, `man_name`, `man_user`, `active`, `description`, `created_at`) VALUES
(1, 'Samsung', 1, 1, 'cvdvbvrvdvrvrvrvr', '2019-04-28 10:41:33'),
(2, 'Apple', 1, 1, 'cvdvbvrvdvrvrvrvr', '2019-04-28 10:41:39'),
(3, 'Toshiba', 1, 1, 'i6h5g4grgrg', '2019-04-28 10:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` tinyint(2) NOT NULL DEFAULT '0',
  `payment_shipping` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_id`, `payment_method`, `payment_status`, `payment_shipping`, `created_at`) VALUES
(1, 'cash', 0, 2, '2019-04-28 11:33:30'),
(2, 'cash', 0, 3, '2019-05-18 08:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cat` int(11) NOT NULL,
  `man` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `cat`, `man`, `user`, `active`, `image`, `color`, `size`, `price`, `created_at`) VALUES
(1, 'Samsung G S9', 'dgrdgrrgerdgedgergregr', 1, 1, 4, 1, 'samsung galaxy s91560246211.jpg', 'Red', '5.5 inch', 656, '2019-06-11 09:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `shipping_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `full_name`, `email`, `mobile`, `address`, `city`, `created_at`) VALUES
(1, 'ibrahim elgadid', 'ibrahimelgadid30@gmail.com', '00102 487 6339', 'elsalam', 'kafr sqr', '2019-04-28 11:19:46'),
(2, 'ibrahim elgadid', 'ibrahimelgadid30@gmail.com', '00102 487 6339', 'elsalam', 'kafr sqr', '2019-04-28 11:33:30'),
(3, 'ibrahim elgadid', 'will123@gmail.com', '01024876339', 'elsalam', 'ÙƒÙØ± ØµÙ‚Ø±', '2019-05-18 08:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `vkey` varchar(255) NOT NULL,
  `token_expire` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `image`, `active`, `vkey`, `token_expire`, `verified`, `admin`, `created_at`) VALUES
(1, 'ibrahim elgadid', 'ibrahimelgadid30@gmail.com', '$2y$10$nRqjt1LOwL6h3GzhMASkDutc/Yxy9gCZUeyN9EilWnHSpb/jLEFS6', 'hima1558167663.jpg', 1, 'ad7b0568a23953cd192690997accc9d3', '2019-05-18 08:21:03', 1, 1, '2019-04-28 10:26:07'),
(3, 'emmma', 'emma123@gmail.com', '1', 'noimage.ong', 1, 'cdscccdvdvvferrfeffce', '2019-04-28 10:40:07', 1, 1, '2019-04-28 10:40:07'),
(4, 'will smith', 'will123@gmail.com', '$2y$10$2qL3BvyXxqac0mnEtcxrCOIc1nK.jCCKb1Njes/Vs/XWvLNIHy9wq', '031560246033.png', 1, '62f473020aa5e20fec24064da17de737', '2019-06-11 09:41:08', 1, 1, '2019-06-11 09:33:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_user` (`cat_user`);

--
-- Indexes for table `c_order`
--
ALTER TABLE `c_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `o_shipping` (`shipping_id`),
  ADD KEY `o_payment` (`payment_id`),
  ADD KEY `o_user` (`customer_id`);

--
-- Indexes for table `c_order_details`
--
ALTER TABLE `c_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `d_order` (`order_id`),
  ADD KEY `d_product` (`product_id`);

--
-- Indexes for table `gallary`
--
ALTER TABLE `gallary`
  ADD PRIMARY KEY (`gallary_id`),
  ADD KEY `g_pro` (`product_id`);

--
-- Indexes for table `manufactures`
--
ALTER TABLE `manufactures`
  ADD PRIMARY KEY (`man_id`),
  ADD KEY `man_user` (`man_user`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_id`),
  ADD KEY `pay_shipping` (`payment_shipping`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `p_user` (`user`),
  ADD KEY `p_man` (`man`),
  ADD KEY `p_cat` (`cat`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `c_order`
--
ALTER TABLE `c_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `c_order_details`
--
ALTER TABLE `c_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallary`
--
ALTER TABLE `gallary`
  MODIFY `gallary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manufactures`
--
ALTER TABLE `manufactures`
  MODIFY `man_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `cat_user` FOREIGN KEY (`cat_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `c_order`
--
ALTER TABLE `c_order`
  ADD CONSTRAINT `o_payment` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`Payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `o_shipping` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`shipping_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `o_user` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `c_order_details`
--
ALTER TABLE `c_order_details`
  ADD CONSTRAINT `d_order` FOREIGN KEY (`order_id`) REFERENCES `c_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `d_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallary`
--
ALTER TABLE `gallary`
  ADD CONSTRAINT `g_pro` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manufactures`
--
ALTER TABLE `manufactures`
  ADD CONSTRAINT `man_user` FOREIGN KEY (`man_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `pay_shipping` FOREIGN KEY (`payment_shipping`) REFERENCES `shipping` (`shipping_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `p_cat` FOREIGN KEY (`cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_man` FOREIGN KEY (`man`) REFERENCES `manufactures` (`man_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p_user` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
