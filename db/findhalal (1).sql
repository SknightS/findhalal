-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2018 at 05:49 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findhalal`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `cardId` int(11) NOT NULL,
  `number` varchar(45) DEFAULT NULL,
  `holdername` varchar(45) DEFAULT NULL,
  `fkorderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `fkresturantId` int(11) NOT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `fkresturantId`, `status`) VALUES
(1, 'test food', 4, 'Inactive'),
(2, 'desert', 4, 'Active'),
(3, 'fast food', 6, 'Active'),
(4, 'drinks', 5, 'Active'),
(5, 'ice cream', 7, 'Active'),
(6, 'pasta', 7, 'Active'),
(7, 'Salat', 6, 'Active'),
(8, 'sweet', 8, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` int(25) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstName`, `lastName`, `email`, `phone`, `address`, `city`, `zip`, `status`) VALUES
(30, 'test', 'test', 'test@gmail.com', 12234, 'test', 'test', 1215, NULL),
(31, 'adam', 'smith', 'admin@gmailcom', 1757696165, 'world', 'paris', 60325, NULL),
(32, 'adam', 'smith', 'admin@gmailcom', 1757696165, 'world', 'paris', 60325, NULL),
(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'adam', 'gilchrist', 'coffee@gmail.com', 178273456, 'house-33', 'Bergen-Enkheim', 60320, NULL),
(35, 'ast', 'tkr', 'coffee@gmail.com', 178273456, 'desert', 'Bergen-Enkheim', 60320, NULL),
(36, 'asdf', 'sdf', 'adf@gmail.com', 3435, 'sdf', 'sdf', 345, NULL),
(37, 'asdf', 'sdf', 'adf@gmail.com', 3435, 'sdf', 'sdf', 345, NULL),
(38, 'tom', 'adam', 'coffee@gmail.com', 178273456, 'house-23, road-34', 'nashvelile', 60320, NULL),
(39, 'Rumi', 'rumi', NULL, NULL, 'asd', '123', NULL, NULL),
(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'tom', 'hanks', 'coffee@gmail.com', 178273456, 'house-56,road-4/A', 'nashvelile', 60320, NULL),
(43, 'bryan', 'adams', 'coffee@gmail.com', 178273456, 'house-56', 'Frankfurter Berg', 60320, NULL),
(44, 'bryan', 'adams', 'user@gmail.com', 178273456, 'house-56', 'DHAKA,BANGLADESH', 1204, NULL),
(45, 'james', 'hetfield', 'coffee@gmail.com', 178273456, 'house-56,road-4/A', 'nashvelile', 60320, NULL),
(46, 'sam', 'caflin', 'coffee@gmail.com', 178273456, 'house-56,road-4/A', 'nashvelile', 60320, NULL),
(47, 'sam', 'caflin', 'coffee@gmail.com', 178273456, 'house-56,road-4/A', 'nashvelile', 60320, NULL),
(48, 'sam', 'caflin', 'rashikatasnim@gmail.com', 1757696165, 'house-56,road-4/A', NULL, NULL, NULL),
(49, 'sam', 'caflin', 'admin@gmailcom', 1757696165, 'house-56,road-4/A', 'DHAKA,BANGLADESH', 60320, NULL),
(50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'chris', 'evans', 'coffee@gmail.com', 178273456, 'house-56,road-4/A', 'nashvelile', 60320, NULL),
(52, 'chris', 'evans', 'admin@gmailcom', 1757696165, 'house-56,road-4/A', 'Frankfurter Berg', 60320, NULL),
(53, 'chris', 'evans', 'coffee@gmail.com', 178273456, 'house-56,road-4/A', 'nashvelile', 60320, NULL),
(54, 'chris', 'evans', 'coffee@gmail.com', 178273456, 'house-56,road-4/A', 'nashvelile', 60320, NULL),
(55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'chris', 'evans', 'admin@gmailcom', 1757696165, 'house-56,road-4/A', 'Bergen-Enkheim', 60320, NULL),
(58, 'axl', 'rose', 'coffee@gmail.com', 178273456, 'house-56,road-4/A', 'nashvelile', 60320, NULL),
(59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'chris', 'evans', 'admin@gmailcom', 178273456, 'house-56,road-4/A', 'Bergen-Enkheim', 60320, NULL),
(64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'chris', 'evans', 'admin@gmailcom', 178273456, 'house-56,road-4/A', 'DHAKA,BANGLADESH', 1204, NULL),
(67, 'adam', 'mike', 'coffee@gmail.com', 178273456, 'house-56,road-4/A', 'nashvelile', 60320, NULL),
(68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'farzad', 'r', 'farzad@gmail.com', 65454, 'farzad', 'Bonames', 6320, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `itemId` int(11) NOT NULL,
  `itemName` varchar(45) DEFAULT NULL,
  `itemDetails` varchar(1000) NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  `fkcategoryId` int(11) NOT NULL,
  `fkresturantId` int(11) NOT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`itemId`, `itemName`, `itemDetails`, `image`, `fkcategoryId`, `fkresturantId`, `status`) VALUES
(1, 'Pizza', 't e te ssdff', '1ItemPicture.jpeg', 2, 4, 'Active'),
(2, 'pasta', 'Regular', '2ItemPicture.jpg', 3, 6, 'Active'),
(3, 'vanila ice cream', 'regular', '3ItemPicture.jpeg', 5, 7, 'Active'),
(4, 'baked pasta', 'Special', '4ItemPicture.jpg', 6, 7, 'Active'),
(5, 'Rokolla Salat', 'Made by rokolla grass', '5ItemPicture.jpg', 7, 6, 'Active'),
(6, 'cake', 'chocolate cake', '6ItemPicture.jpeg', 8, 8, 'Active'),
(7, 'sweet coffee', 'small', '7ItemPicture.jpeg', 8, 8, 'Active'),
(8, 'testing images', 'asfsdf', '8ItemPicture.jpg', 3, 6, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `itemsize`
--

CREATE TABLE `itemsize` (
  `itemsizeId` int(11) NOT NULL,
  `itemsizeName` varchar(45) DEFAULT NULL,
  `item_itemId` int(11) NOT NULL,
  `price` double DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemsize`
--

INSERT INTO `itemsize` (`itemsizeId`, `itemsizeName`, `item_itemId`, `price`, `status`) VALUES
(1, 'Big', 1, 80, 'Active'),
(2, 'small', 1, 50, 'Active'),
(3, 'Large', 1, 15, 'Active'),
(4, 'regular', 2, 300, 'Active'),
(5, 'R', 3, 300, 'Active'),
(6, 'vv', 4, 100, 'Active'),
(7, 'large', 5, 3, 'Active'),
(8, NULL, 7, 20, 'Active'),
(9, 'small', 5, 30, 'Active'),
(10, 'test', 8, 50, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` int(11) NOT NULL,
  `delfee` int(11) NOT NULL,
  `fkresturantId` int(11) DEFAULT NULL,
  `fkcustomerId` int(11) DEFAULT NULL,
  `orderTime` datetime DEFAULT NULL,
  `orderStatus` varchar(10) DEFAULT NULL,
  `paymentType` varchar(10) DEFAULT NULL,
  `orderType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderId`, `delfee`, `fkresturantId`, `fkcustomerId`, `orderTime`, `orderStatus`, `paymentType`, `orderType`) VALUES
(22, 6, 6, 30, '2018-03-25 20:03:08', 'Cancelled', 'Cash', 'Delivery'),
(23, 0, 6, 31, '2018-03-25 20:03:42', 'Delivered', NULL, 'Card'),
(24, 6, 6, 33, '2018-03-25 20:03:02', 'Delivered', 'Cash', 'Delivery'),
(25, 0, 8, 34, '2018-03-26 08:03:39', 'Delivered', 'Cash', 'Takeout'),
(26, 6, 6, 35, '2018-03-26 08:03:01', 'Delivered', 'Cash', 'Delivery'),
(27, 0, 6, 37, '2018-03-26 10:03:39', 'Delivered', 'Cash', 'Takeout'),
(28, 0, 7, 38, '2018-03-29 12:03:42', 'Delivered', 'Cash', 'Card'),
(29, 0, 6, 39, '2018-03-29 12:03:26', 'Delivered', 'Cash', 'Takeout'),
(30, 6, 6, 40, '2018-03-29 12:03:55', 'Delivered', 'Cash', 'Delivery'),
(31, 0, 7, 41, '2018-03-30 14:03:56', 'Delivered', 'Cash', 'Takeout'),
(32, 5, 4, 42, '2018-03-31 18:03:42', 'Delivered', 'Cash', 'Delivery'),
(33, 5, 4, 43, '2018-04-03 11:04:15', 'Delivered', 'Cash', 'Delivery'),
(34, 4, 7, 44, '2018-04-03 11:04:11', 'Delivered', 'Cash', 'Delivery'),
(35, 5, 4, 45, '2018-04-03 11:04:09', 'Delivered', 'Cash', 'Delivery'),
(36, 0, 6, 50, '2018-04-05 16:04:33', 'Cancelled', 'Cash', NULL),
(37, 5, 4, 59, '2018-04-06 07:04:49', 'Pending', 'Cash', 'Delivery'),
(38, 0, NULL, 62, '2018-04-06 09:04:52', 'Delivered', 'Cash', 'Takeout'),
(39, 0, 4, 63, '2018-04-06 11:04:19', 'Delivered', NULL, 'Card'),
(40, 5, 4, 64, '2018-04-06 12:04:37', 'Cancelled', 'Cash', 'Delivery'),
(41, 5, 4, 65, '2018-04-06 13:04:24', 'Delivered', 'Cash', 'Delivery'),
(42, 0, 4, 66, '2018-04-06 13:04:29', 'Delivered', 'Cash', 'Takeout'),
(43, 6, 6, 67, '2018-04-15 16:04:17', 'Delivered', 'Cash', 'Delivery'),
(44, 0, 6, 68, '2018-04-28 17:04:08', 'Pending', NULL, 'Card'),
(45, 0, 6, 69, '2018-04-28 18:04:26', 'Pending', NULL, 'Card'),
(46, 0, 6, 70, '2018-04-29 13:04:27', 'Pending', 'Cash', 'Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `orderItemId` int(11) NOT NULL,
  `fkorderId` int(11) NOT NULL,
  `fkitemsizeId` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`orderItemId`, `fkorderId`, `fkitemsizeId`, `quantity`, `price`) VALUES
(20, 22, 4, 1, 300),
(21, 23, 7, 1, 3),
(24, 25, 8, 2, 20),
(25, 26, 7, 1, 3),
(26, 27, 7, 1, 3),
(27, 28, 5, 2, 300),
(28, 29, 4, 1, 300),
(29, 29, 7, 1, 3),
(30, 30, 7, 1, 3),
(31, 31, 6, 1, 100),
(32, 32, 1, 3, 80),
(33, 33, 1, 2, 80),
(34, 34, 5, 1, 300),
(35, 35, 1, 1, 80),
(36, 36, 4, 1, 300),
(37, 37, 1, 1, 80),
(38, 38, 2, 4, 50),
(39, 39, 1, 1, 80),
(40, 40, 1, 1, 80),
(41, 41, 2, 2, 50),
(42, 42, 2, 2, 50),
(43, 43, 4, 2, 300),
(44, 44, 4, 1, 300),
(45, 45, 10, 1, 50),
(46, 46, 4, 2, 300);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseId` int(11) NOT NULL,
  `fkorderId` int(11) NOT NULL,
  `purchasetime` datetime DEFAULT NULL,
  `delFee` double DEFAULT NULL,
  `orderFee` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `restaurantId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseId`, `fkorderId`, `purchasetime`, `delFee`, `orderFee`, `total`, `restaurantId`) VALUES
(3, 24, '2018-03-29 12:05:06', 6, 0, 6, 6),
(4, 23, '2018-03-29 12:05:48', 0, 3, 3, 6),
(5, 28, '2018-03-29 12:07:18', 0, 600, 600, 7),
(6, 29, '2018-03-29 12:42:51', 0, 303, 303, 6),
(7, 30, '2018-03-29 12:51:29', 6, 3, 9, 6),
(8, 31, '2018-03-30 14:07:19', 0, 100, 100, 7),
(9, 31, '2018-03-30 14:07:21', 0, 100, 100, 7),
(10, 32, '2018-03-31 18:38:15', 5, 240, 245, 4),
(11, 33, '2018-04-03 11:44:38', 5, 160, 165, 4),
(12, 34, '2018-04-03 11:47:27', 4, 300, 304, 7),
(13, 35, '2018-04-03 11:49:20', 5, 80, 85, 4),
(14, 42, '2018-04-06 13:18:51', 0, 100, 100, 4),
(15, 41, '2018-04-06 13:20:44', 5, 100, 105, 4),
(16, 43, '2018-04-15 16:13:13', 6, 600, 606, 6),
(17, 39, '2018-04-20 13:16:33', 0, 80, 80, 4);

-- --------------------------------------------------------

--
-- Table structure for table `resturant`
--

CREATE TABLE `resturant` (
  `resturantId` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `details` mediumtext,
  `minOrder` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `delfee` varchar(45) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `featureResturant` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resturant`
--

INSERT INTO `resturant` (`resturantId`, `name`, `details`, `minOrder`, `image`, `delfee`, `status`, `address`, `city`, `zip`, `email`, `phoneNumber`, `country`, `featureResturant`) VALUES
(4, 'Music cafe', 'rt t', 2, '4RestaurantPicture.jpg', '5', 'Active', 'f sadadf asdf fd af', 'Altstadt', '60311', NULL, NULL, 'Germany', 0),
(5, 'test', 'rt t', 2, NULL, '5', 'Active', 'f sadadf asdf fd af', 'Bonames', '', NULL, NULL, 'Germany', 0),
(6, 'KFC', 'Regular', 3, '6RestaurantPicture.jpg', '8', 'Active', 'House-88', 'Fechenheim', '60325', NULL, NULL, 'Germany', 0),
(7, 'Nando\'s', 'Al l type of food', 8, '7RestaurantPicture.jpeg', '4', 'Active', 'house-46, road-26', 'Dornbusch', '60389', NULL, NULL, 'Germany', 0);

-- --------------------------------------------------------

--
-- Table structure for table `resturanttime`
--

CREATE TABLE `resturanttime` (
  `resturanttimeId` int(11) NOT NULL,
  `day` varchar(45) DEFAULT NULL,
  `opentime` varchar(45) DEFAULT NULL,
  `closetime` varchar(45) DEFAULT NULL,
  `fkresturantId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resturanttime`
--

INSERT INTO `resturanttime` (`resturanttimeId`, `day`, `opentime`, `closetime`, `fkresturantId`) VALUES
(1, 'Saturday', NULL, NULL, 4),
(2, 'Sunday', NULL, NULL, 4),
(3, 'Monday', NULL, NULL, 4),
(4, 'Tuesday', NULL, NULL, 4),
(5, 'Wednesday', NULL, NULL, 4),
(6, 'Thursday', '04:00', '20:00', 4),
(7, 'Friday', NULL, NULL, 4),
(8, 'Saturday', '03:00', '14:00', 6),
(9, 'Sunday', '03:00', '14:00', 6),
(10, 'Monday', '12:00', '22:00', 6),
(11, 'Tuesday', '12:00', '00:00', 6),
(12, 'Wednesday', '12:00', '00:00', 6),
(13, 'Thursday', '12:00', '00:00', 6),
(14, 'Friday', '12:00', '22:00', 6),
(15, 'Saturday', NULL, NULL, 7),
(16, 'Sunday', NULL, NULL, 7),
(17, 'Monday', NULL, NULL, 7),
(18, 'Tuesday', '13:00', '23:50', 7),
(19, 'Wednesday', '01:00', '22:00', 7),
(20, 'Thursday', NULL, NULL, 7),
(21, 'Friday', NULL, NULL, 7),
(22, 'Saturday', NULL, NULL, 9),
(23, 'Sunday', NULL, NULL, 9),
(24, 'Monday', '12:00', '17:00', 9),
(25, 'Tuesday', NULL, NULL, 9),
(26, 'Wednesday', NULL, NULL, 9),
(27, 'Thursday', NULL, NULL, 9),
(28, 'Friday', NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `shipaddress`
--

CREATE TABLE `shipaddress` (
  `shipaddressId` int(11) NOT NULL,
  `addressDetails` varchar(255) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `fkcustomerId` int(11) NOT NULL,
  `fkorderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipaddress`
--

INSERT INTO `shipaddress` (`shipaddressId`, `addressDetails`, `city`, `zip`, `country`, `fkcustomerId`, `fkorderId`) VALUES
(11, 'test', 'test', '1215', NULL, 30, 0),
(12, 'world', 'paris', '60325', NULL, 31, 0),
(13, 'world', 'paris', '60325', NULL, 32, 0),
(14, NULL, NULL, NULL, NULL, 33, 0),
(15, 'house-33', 'Bergen-Enkheim', '60320', NULL, 34, 0),
(16, 'desert', 'Bergen-Enkheim', '60320', NULL, 35, 0),
(17, 'sdf', 'sdf', '345', NULL, 37, 27),
(18, 'house-23, road-34', 'nashvelile', '60320', NULL, 38, 28),
(19, 'asd', '123', NULL, NULL, 39, 29),
(20, NULL, NULL, NULL, NULL, 40, 30),
(21, NULL, NULL, NULL, NULL, 41, 31),
(22, 'house-56,road-4/A', 'nashvelile', '60320', NULL, 42, 32),
(23, 'house-56', 'Frankfurter Berg', '60320', NULL, 43, 33),
(24, 'house-56', 'DHAKA,BANGLADESH', '1204', NULL, 44, 34),
(25, 'house-56,road-4/A', 'nashvelile', '60320', NULL, 45, 35),
(27, NULL, NULL, NULL, NULL, 50, 36),
(29, NULL, NULL, NULL, NULL, 59, 37),
(30, NULL, NULL, NULL, NULL, 62, 38),
(33, 'house-56,road-4/A', 'Bergen-Enkheim', '60320', NULL, 63, 39),
(34, NULL, NULL, NULL, NULL, 64, 40),
(36, NULL, NULL, NULL, NULL, 65, 41),
(38, 'house-56,road-4/A', 'DHAKA,BANGLADESH', '1204', NULL, 66, 42),
(40, 'house-56,road-4/A', 'nashvelile', '60320', NULL, 67, 43),
(41, NULL, NULL, NULL, NULL, 68, 44),
(42, NULL, NULL, NULL, NULL, 69, 45),
(43, 'farzad', 'Bonames', '6320', NULL, 70, 46);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `taskId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskId`, `name`, `userId`, `status`, `created_at`) VALUES
(1, 'done', 1, 0, '2018-03-17 04:44:26'),
(2, 'Complete', 1, 1, '2018-03-17 05:00:18'),
(3, 'add', 1, 1, '2018-03-26 07:54:05'),
(4, 'add', 1, 1, '2018-03-26 07:54:05'),
(5, 'add item', 1, 0, '2018-03-26 07:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `fkuserTypeId` varchar(5) NOT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `lastName`, `email`, `password`, `phone`, `status`, `fkuserTypeId`, `address`, `city`, `zip`, `country`, `remember_token`) VALUES
(1, 'Admin', 'Admin', 'admin@findhalal.de', '$2y$10$6uyV1sPMpuqEQR4iFbdFp.HsIxfquF67nk3zdJlYma8U1Mw6ZZ9E6', NULL, NULL, 'ADMIN', NULL, NULL, NULL, NULL, 'abQ74KDjaaVAadEhqqkFTVQQ0W9x5B7VcwxsrzErDMwzZ49WHhDeobvOghZp');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `userTypeId` varchar(5) NOT NULL,
  `typeName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`userTypeId`, `typeName`) VALUES
('ADMIN', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`cardId`),
  ADD KEY `fk_card_order1_idx` (`fkorderId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `fk_category_resturant1_idx` (`fkresturantId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `fk_item_category1_idx` (`fkcategoryId`),
  ADD KEY `fk_item_resturant1_idx` (`fkresturantId`);

--
-- Indexes for table `itemsize`
--
ALTER TABLE `itemsize`
  ADD PRIMARY KEY (`itemsizeId`),
  ADD KEY `fk_itemsize_item1_idx` (`item_itemId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `fk_order_resturant1_idx` (`fkresturantId`),
  ADD KEY `fk_order_customer1_idx` (`fkcustomerId`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`orderItemId`),
  ADD KEY `fk_orderItem_order1_idx` (`fkorderId`),
  ADD KEY `fk_orderItem_itemsize1_idx` (`fkitemsizeId`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseId`),
  ADD KEY `fk_purchase_order1_idx` (`fkorderId`),
  ADD KEY `fk_restaurantid_purchase` (`restaurantId`);

--
-- Indexes for table `resturant`
--
ALTER TABLE `resturant`
  ADD PRIMARY KEY (`resturantId`);

--
-- Indexes for table `resturanttime`
--
ALTER TABLE `resturanttime`
  ADD PRIMARY KEY (`resturanttimeId`),
  ADD KEY `fk_resturanttime_resturant1_idx` (`fkresturantId`);

--
-- Indexes for table `shipaddress`
--
ALTER TABLE `shipaddress`
  ADD PRIMARY KEY (`shipaddressId`),
  ADD KEY `fk_shipaddress_customer1_idx` (`fkcustomerId`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`taskId`),
  ADD KEY `fk_task_userId` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `fk_user_usertype_idx` (`fkuserTypeId`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`userTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `itemsize`
--
ALTER TABLE `itemsize`
  MODIFY `itemsizeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `resturant`
--
ALTER TABLE `resturant`
  MODIFY `resturantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resturanttime`
--
ALTER TABLE `resturanttime`
  MODIFY `resturanttimeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `shipaddress`
--
ALTER TABLE `shipaddress`
  MODIFY `shipaddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
