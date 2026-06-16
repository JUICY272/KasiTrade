-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2026 at 11:18 AM
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
-- Database: `kasitrade_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(255) NOT NULL,
  `sender_id` int(255) NOT NULL,
  `receiver_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `product_id`, `message`, `created_at`) VALUES
(6, 25, 28, 14, 'Hi, Is this still available?', '2026-06-05 14:09:06'),
(7, 28, 25, 14, 'Yes. Not negotiable on the price though.', '2026-06-05 14:09:56');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(255) NOT NULL,
  `buyer_id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Paid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `buyer_id`, `seller_id`, `product_id`, `amount`, `payment_status`, `created_at`) VALUES
(3, 25, 28, 14, 1900.00, 'Paid', '2026-06-05 14:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `seller_id`, `title`, `description`, `price`, `image`, `category`, `status`) VALUES
(8, 24, 'Intel i5 Laptop', 'Had intel core i5 16 GB RAM and internal graphics card', 11500.00, 'uploads/1780666097_ad06cefc-33a7-4e3b-b159-2bac582e9819.avif', 'Electronics', 'Available'),
(9, 25, 'Corner Couch', 'This is a 3X 3 foot corner couch basically new', 8000.00, 'uploads/1780666447_images (1).jpg', 'Furniture', 'Available'),
(10, 26, 'Ford Mustang 1969', 'Old mustang year 1969. Built up myself. Still runs', 665000.00, 'uploads/1780666900_images (2).jpg', 'Vehicles', 'Available'),
(11, 24, 'Xbox series s', 'Comes with controller. Like new with original box', 4500.00, 'uploads/1780667121_Screenshot_20260605_154220_Facebook.jpg', 'Electronics', 'Available'),
(13, 27, 'PSP', 'PSP for sale. Used but only small crack on side. Still Works', 230.00, 'uploads/1780667455_20260605_154645.jpg', 'Electronics', 'Available'),
(14, 28, 'Axe', 'Steel Axe like bran new', 1900.00, 'uploads/1780667881_Screenshot_20260605_155506_Facebook.jpg', 'Other', 'Reserved');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `image_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `product_id`, `image_path`) VALUES
(12, 8, 'uploads/1780666097_ad06cefc-33a7-4e3b-b159-2bac582e9819.avif'),
(13, 8, 'uploads/1780666097_images.jpg'),
(14, 8, 'uploads/1780666097_maxresdefault.jpg'),
(15, 9, 'uploads/1780666447_images (1).jpg'),
(16, 10, 'uploads/1780666900_images (2).jpg'),
(17, 11, 'uploads/1780667121_Screenshot_20260605_154220_Facebook.jpg'),
(18, 11, 'uploads/1780667121_Screenshot_20260605_154410_Facebook.jpg'),
(19, 12, 'uploads/1780667373_20260605_154650.jpg'),
(20, 12, 'uploads/1780667374_20260605_154645.jpg'),
(21, 13, 'uploads/1780667455_20260605_154645.jpg'),
(22, 13, 'uploads/1780667455_20260605_154650.jpg'),
(23, 14, 'uploads/1780667881_Screenshot_20260605_155506_Facebook.jpg'),
(24, 14, 'uploads/1780667882_Screenshot_20260605_155501_Facebook.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(255) NOT NULL,
  `seller_id` int(255) NOT NULL,
  `reviewer_id` int(255) NOT NULL,
  `rating` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `seller_id`, `reviewer_id`, `rating`) VALUES
(8, 28, 24, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`) VALUES
(9, 'Kyle', 'kylepreston1608@gmail.com', '1234567890', 'admin'),
(10, 'Jouma', 'imfakelol@email.com', '000000', 'user'),
(24, 'Anon', 'anon2556@gmail.com', '000000@', 'user'),
(25, 'Jeffrey', 'jeffcell123@gmail.com', '000000@', 'user'),
(26, 'Eric', 'ericrickson1909@gmail.com', '000000@', 'user'),
(27, 'Francisca', 'franslove23@gmail.com', '000000@', 'user'),
(28, 'Harve', 'harvemiller7@gmail.com', '000000@', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
