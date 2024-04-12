-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 08:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `wholesale`
--
-- --------------------------------------------------------
--
-- Table structure for table `cart`
--
CREATE TABLE `cart` (
    `id` int(11) NOT NULL,
    `user_id` int(11) DEFAULT NULL,
    `product_id` int(11) NOT NULL,
    `quantity` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
-- --------------------------------------------------------
--
-- Table structure for table `orders`
--
CREATE TABLE `orders` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `shipping_address` varchar(255) NOT NULL,
    `product_id` int(11) NOT NULL,
    `quantity` int(11) NOT NULL,
    `total_amount` decimal(10, 2) NOT NULL,
    `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
    `status` varchar(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `orders`
--
INSERT INTO `orders` (
        `id`,
        `user_id`,
        `shipping_address`,
        `product_id`,
        `quantity`,
        `total_amount`,
        `order_date`,
        `status`
    )
VALUES (
        1,
        2,
        '',
        1,
        2,
        20.00,
        '2024-02-23 10:28:01',
        'Processing'
    ),
    (2, 2, '', 3, 1, 15.00, '2024-02-23 10:28:01', ''),
    (3, 1, '', 2, 1, 20.00, '2024-02-28 14:25:40', ''),
    (4, 1, '', 2, 1, 20.00, '2024-02-29 07:17:36', ''),
    (
        9,
        7,
        'St Narshak',
        1,
        1,
        10.00,
        '2024-03-02 11:21:06',
        NULL
    );
-- --------------------------------------------------------
--
-- Table structure for table `products`
--
CREATE TABLE `products` (
    `id` int(11) NOT NULL,
    `name` varchar(100) NOT NULL,
    `price` decimal(10, 2) NOT NULL,
    `description` text DEFAULT NULL,
    `category` enum('shirts', 'furniture', 'techgadgets', 'watches') NOT NULL,
    `image_path` varchar(255) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `products`
--
INSERT INTO `products` (
        `id`,
        `name`,
        `price`,
        `description`,
        `category`,
        `image_path`
    )
VALUES (
        1,
        'Product 1',
        10.00,
        'Description of product 1',
        'watches',
        '/wholesale/public/img/products/watches/watch1.jpg'
    ),
    (
        2,
        'Product 2',
        20.00,
        'Description of product 2',
        'watches',
        '/wholesale/public/img/products/watches/watch2.jpg'
    ),
    (
        3,
        'Product 3',
        15.00,
        'Description of product 3',
        'watches',
        '/wholesale/public/img/products/watches/watch3.jpg'
    ),
    (
        4,
        'Product 4',
        25.00,
        'Description of product 4',
        'watches',
        '/wholesale/public/img/products/watches/watch4.jpg'
    ),
    (
        18,
        'Shirt 1',
        19.99,
        'Description for Shirt 1',
        'shirts',
        '/wholesale/public/img/products/shirts/shirt1.jpg'
    ),
    (
        19,
        'Shirt 2',
        24.99,
        'Description for Shirt 2',
        'shirts',
        '/wholesale/public/img/products/shirts/shirt2.jpg'
    ),
    (
        20,
        'Shirt 3',
        29.99,
        'Description for Shirt 3',
        'shirts',
        '/wholesale/public/img/products/shirts/shirt3.jpg'
    ),
    (
        21,
        'Shirt 4',
        34.99,
        'Description for Shirt 4',
        'shirts',
        '/wholesale/public/img/products/shirts/shirt4.jpg'
    ),
    (
        22,
        'Furniture 1',
        99.99,
        'Description for Furniture 1',
        'furniture',
        '/wholesale/public/img/products/furniture/furniture1.jpg'
    ),
    (
        23,
        'Furniture 2',
        149.99,
        'Description for Furniture 2',
        'furniture',
        '/wholesale/public/img/products/furniture/furniture2.jpg'
    ),
    (
        24,
        'Furniture 3',
        199.99,
        'Description for Furniture 3',
        'furniture',
        '/wholesale/public/img/products/furniture/furniture3.jpg'
    ),
    (
        25,
        'Furniture 4',
        249.99,
        'Description for Furniture 4',
        'furniture',
        '/wholesale/public/img/products/furniture/furniture4.jpg'
    ),
    (
        26,
        'Gadget 1',
        199.99,
        'Description for Gadget 1',
        'techgadgets',
        '/wholesale/public/img/products/gadgets/gadget1.jpg'
    ),
    (
        27,
        'Gadget 2',
        299.99,
        'Description for Gadget 2',
        'techgadgets',
        '/wholesale/public/img/products/gadgets/gadget2.jpg'
    ),
    (
        28,
        'Gadget 3',
        399.99,
        'Description for Gadget 3',
        'techgadgets',
        '/wholesale/public/img/products/gadgets/gadget3.jpg'
    ),
    (
        29,
        'Gadget 4',
        499.99,
        'Description for Gadget 4',
        'techgadgets',
        '/wholesale/public/img/products/gadgets/gadget4.jpg'
    );
-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` enum('admin', 'client') NOT NULL,
    `email` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;
--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`)
VALUES (1, 'admin', 'admin_password', 'admin', ''),
    (2, 'client1', 'client1_password', 'client', ''),
    (3, 'client44', 'client44_password', 'client', ''),
    (7, 'ansh', '1234', 'admin', 'ansh@test.com'),
    (
        8,
        'client5',
        'secret',
        'client',
        'ansh5@test.com'
    );
--
-- Indexes for dumped tables
--
--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`),
    ADD KEY `product_id` (`product_id`);
--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`),
    ADD KEY `product_id` (`product_id`);
--
-- Indexes for table `products`
--
ALTER TABLE `products`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 39;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 19;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 30;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 9;
--
-- Constraints for dumped tables
--
--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;