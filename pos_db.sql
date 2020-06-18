-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 19, 2020 at 12:27 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales`
(
    `id`         int(11) NOT NULL,
    `clientname` varchar(100)   DEFAULT NULL,
    `amount`     decimal(10, 2) DEFAULT 0.00,
    `discount`   decimal(10, 2) DEFAULT 0.00,
    `total`      decimal(10, 2) DEFAULT 0.00
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `clientname`, `amount`, `discount`, `total`)
VALUES (1, 'Orinda Harrison', '258.25', '20.25', '238.00'),
       (2, 'Orinda Harrison', '258.25', '20.25', '238.00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff`
(
    `id`       int(11)   NOT NULL,
    `email`    varchar(250)   DEFAULT NULL,
    `fullname` varchar(100)   DEFAULT NULL,
    `joindate` timestamp NULL DEFAULT current_timestamp(),
    `status`   tinyint(1)     DEFAULT 1
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `email`, `fullname`, `joindate`, `status`)
VALUES (1, 'user3@domain.com', 'Orinda Harrison', '2020-06-18 21:57:55', 1),
       (2, 'user2@domain.com', 'User Name1', '2020-06-18 22:15:02', 1),
       (3, 'user@domain.com', 'User Name1', '2020-06-18 22:15:28', 1),
       (4, 'user1@domain.com', 'User1 Name1', '2020-06-18 22:15:34', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `staff_email_uindex` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
