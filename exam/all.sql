-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2025 at 07:31 AM
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
-- Database: `company`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_manufacture` (`mname` VARCHAR(20), `mcontact` VARCHAR(20))   begin 
insert into manufacturer(name,contact)values(mname,mcontact);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_product` (`pname` VARCHAR(20), `price` DOUBLE(10,2), `m_id` INT(10))   begin 
insert into product(name,price,manufac_id)values(pname,price,m_id);
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `contact`) VALUES
(9, 'SAMSUNG', '9988776655'),
(11, 'V & G', '0987654321'),
(12, 'V & G', '9988776'),
(13, 'Herlan', '0987654321');

--
-- Triggers `manufacturer`
--
DELIMITER $$
CREATE TRIGGER `ad_manufacturer` AFTER DELETE ON `manufacturer` FOR EACH ROW begin 
delete from product where manufac_id = old.id ;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `manufac_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `manufac_id`) VALUES
(8, 'Tablet', 30000.00, 9),
(10, 'Straightner', 6400.00, 11),
(20, 'Straightner', 3000.00, 13),
(22, 'Straightner', 3000.00, 13),
(23, 'Straightner', 3000.00, 13),
(24, 'bag', 3000.00, 13),
(25, 'bag', 3000.00, 13),
(26, 'bag', 3000.00, 13),
(27, 'bag', 3000.00, 13),
(28, 'Straightner', 3000.00, 13),
(29, 'tv', 50666.00, 9);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_product`
-- (See below for the actual view)
--
CREATE TABLE `view_product` (
`id` int(10)
,`name` varchar(20)
,`price` double(10,2)
,`manufac_id` int(10)
);

-- --------------------------------------------------------

--
-- Structure for view `view_product`
--
DROP TABLE IF EXISTS `view_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_product`  AS SELECT `product`.`id` AS `id`, `product`.`name` AS `name`, `product`.`price` AS `price`, `product`.`manufac_id` AS `manufac_id` FROM `product` WHERE `product`.`price` > 5000 ORDER BY `product`.`name` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_id` (`manufac_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`manufac_id`) REFERENCES `manufacturer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;