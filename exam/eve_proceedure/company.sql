-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2025 at 06:41 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_manufacture` (IN `mname` VARCHAR(20), IN `dress` VARCHAR(100), IN `mcontact` VARCHAR(50))   begin 
insert into manufacturer(name,address,contact)values(mname,dress,mcontact);
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
  `address` varchar(100) NOT NULL,
  `contact` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `address`, `contact`) VALUES
(12, 'V & G', '', '9988776'),
(17, 'SAMSUNG', 'Canada', '9988776');

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
(34, 'Straightner', 10000.00, 12),
(35, 'bag', 3000.00, 12),
(36, 'bag', 3000.00, 12),
(37, 'bag', 3000.00, 12),
(38, 'Tablet', 47000.00, 17),
(39, 'Bracelet', 3000.00, 12);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_product`
-- (See below for the actual view)
--
CREATE TABLE `view_product` (
`id` int(10)
,`product_name` varchar(20)
,`price` double(10,2)
,`manufacturer_name` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `view_product`
--
DROP TABLE IF EXISTS `view_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_product`  AS SELECT `p`.`id` AS `id`, `p`.`name` AS `product_name`, `p`.`price` AS `price`, `m`.`name` AS `manufacturer_name` FROM (`product` `p` join `manufacturer` `m` on(`p`.`manufac_id` = `m`.`id`)) WHERE `p`.`price` > 5000 ;

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
