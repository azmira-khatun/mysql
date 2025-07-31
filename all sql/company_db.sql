-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2025 at 09:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `catagori` (IN `name` VARCHAR(100), IN `price` INT(100), IN `user_id` VARCHAR(100))   BEGIN
INSERT INTO brand(name,email,contact)VALUES(name,price,user_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GETproductBYname` (IN `c` VARCHAR(100))   BEGIN
SELECT p.id,p.name pname,p.price,b.name bname,b.email,b.contact FROM product p,brand b WHERE b.id=p.brand_id ;
/*JOIN car c ON c.car_id=d.car_id 
JOIN salary s ON d.driver_id=s.driver_id
WHERE c.car_name=c;*/
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `email`, `contact`) VALUES
(1, 'as', '0', 6565367),
(6, 'lenovo', 'as@gmail.com', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `brand_id`) VALUES
(1, 'mouse', 345.00, 6),
(2, 'mouse', 345.00, 6),
(3, 'mouse', 345.00, 6),
(4, 'mouse', 345.00, 6),
(5, 'mouse', 345.00, 6),
(6, 'mouse', 345.00, 6),
(7, 'mouse', 345.00, 6),
(8, 'mouse', 345.00, 6),
(9, 'mouse', 345.00, 6),
(10, 'mouse', 345.00, 6),
(11, 'mouse', 345.00, 6),
(12, 'mouse', 1.00, 6),
(13, 'mouse', 1.00, 6),
(14, 'mouse', 1.00, 6),
(15, 'Phone', 300.00, 6),
(16, 'Phone', 300.00, 6),
(17, 'Phone', 3000.00, 6);

-- --------------------------------------------------------

--
-- Stand-in structure for view `select_product`
-- (See below for the actual view)
--
CREATE TABLE `select_product` (
`id` int(11)
,`name` varchar(100)
,`price` decimal(10,2)
,`brand_id` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `select_product`
--
DROP TABLE IF EXISTS `select_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `select_product`  AS SELECT `product`.`id` AS `id`, `product`.`name` AS `name`, `product`.`price` AS `price`, `product`.`brand_id` AS `brand_id` FROM `product` WHERE `product`.`price` > 5000 ORDER BY `product`.`id` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
