-- phpMyAdmin SQL Dump

-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2018 at 07:34 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2


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
(1, 'test food', 4, 'Active'),
(2, 'desert', 4, 'Active'),
(3, 'fast food', 6, 'Active'),
(4, 'drinks', 5, 'Active'),
(5, 'ice cream', 7, 'Active'),
(6, 'pasta', 7, 'Active'),
(7, 'Salat', 6, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `firstName`, `lastName`, `email`, `phone`, `status`) VALUES
(1, 'Dummy', 'Customer', 'customer@gmail.com', 131354, 'active'),
(2, 'customer2', 'customer2', 'customer2@gmail.com', 6464, 'active');

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
(5, 'Rokolla Salat', 'Made by rokolla grass', '5ItemPicture.jpg', 7, 6, 'Active');

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
(6, NULL, 4, 100, 'Active'),
(7, 'large', 5, 3, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` int(11) NOT NULL,
  `fkresturantId` int(11) NOT NULL,
  `fkcustomerId` int(11) NOT NULL,
  `orderTime` datetime DEFAULT NULL,
  `orderStatus` varchar(10) DEFAULT NULL,
  `paymentType` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderId`, `fkresturantId`, `fkcustomerId`, `orderTime`, `orderStatus`, `paymentType`) VALUES
(1, 6, 1, '2018-03-16 10:00:00', 'active', 'cash'),
(2, 6, 2, '2018-03-16 12:00:00', 'active', 'card'),
(3, 4, 2, '2018-03-16 00:00:00', 'active', 'cash');

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
(1, 1, 2, 1, 50),
(2, 2, 4, 1, 100),
(3, 3, 7, 1, 50);

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
(1, 1, '2018-03-16 00:00:00', 5, 25, 30, 6),
(2, 2, '2018-03-16 00:00:00', 5, 40, 45, 6),
(3, 3, '2018-03-16 00:00:00', 5, 50, 55, 4);

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
  `country` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resturant`
--

INSERT INTO `resturant` (`resturantId`, `name`, `details`, `minOrder`, `image`, `delfee`, `status`, `address`, `city`, `zip`, `country`) VALUES
(4, 'Music cafe', 'rt t', 2, '4RestaurantPicture.jpg', '5', 'Inactive', 'f sadadf asdf fd af', 'Altstadt', '60311', 'Germany'),
(5, 'test', 'rt t', 2, NULL, '5', 'Active', 'f sadadf asdf fd af', 'Bonames', '', 'Germany'),
(6, 'KFC', 'Regular', 3, '6RestaurantPicture.jpg', '6', 'Active', 'House-88', 'Fechenheim', '60325', 'Germany'),
(7, 'Nando\'s', 'Al l type of food', 8, '7RestaurantPicture.jpeg', '4', 'Active', 'house-46, road-26', 'Dornbusch', '60389', 'Germany');

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
(1, 'saturday', NULL, NULL, 4),
(2, 'sunday', NULL, NULL, 4),
(3, 'monday', NULL, NULL, 4),
(4, 'tuesday', NULL, NULL, 4),
(5, 'wednesday', NULL, NULL, 4),
(6, 'thursday', NULL, NULL, 4),
(7, 'friday', NULL, NULL, 4),
(8, 'saturday', '10:00', '02:00', 6),
(9, 'sunday', '10:00', '02:00', 6),
(10, 'monday', '12:00', '00:00', 6),
(11, 'tuesday', '12:00', '00:00', 6),
(12, 'wednesday', '12:00', '00:00', 6),
(13, 'thursday', '12:00', '00:00', 6),
(14, 'friday', '12:00', '02:00', 6),
(15, 'saturday', NULL, NULL, 7),
(16, 'sunday', NULL, NULL, 7),
(17, 'monday', NULL, NULL, 7),
(18, 'tuesday', NULL, NULL, 7),
(19, 'wednesday', NULL, NULL, 7),
(20, 'thursday', NULL, NULL, 7),
(21, 'friday', NULL, NULL, 7);

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
  `fkcustomerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'done', 1, 1, '2018-03-17 04:44:26'),
(2, 'Complete', 1, 1, '2018-03-17 05:00:18');

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
(1, 'Admin', 'Admin', 'admin@findhalal.de', '$2y$10$6uyV1sPMpuqEQR4iFbdFp.HsIxfquF67nk3zdJlYma8U1Mw6ZZ9E6', NULL, NULL, 'ADMIN', NULL, NULL, NULL, NULL, '9dO5bdSnwXUwQXdVcYXbeLlkOCPcy2m8cjFOKBfgN3Dua68OZ0Qj0SEJNeKR');

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
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `itemsize`
--
ALTER TABLE `itemsize`
  MODIFY `itemsizeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resturant`
--
ALTER TABLE `resturant`
  MODIFY `resturantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resturanttime`
--
ALTER TABLE `resturanttime`
  MODIFY `resturanttimeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `shipaddress`
--
ALTER TABLE `shipaddress`
  MODIFY `shipaddressId` int(11) NOT NULL AUTO_INCREMENT;

<<<<<<< HEAD
=======
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `taskId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

>>>>>>> 4b50ac1768efafd72c07e5528ff617f9ceae8cd0
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `fk_card_order1` FOREIGN KEY (`fkorderId`) REFERENCES `order` (`orderId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_category_resturant1` FOREIGN KEY (`fkresturantId`) REFERENCES `resturant` (`resturantId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_category1` FOREIGN KEY (`fkcategoryId`) REFERENCES `category` (`categoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_resturant1` FOREIGN KEY (`fkresturantId`) REFERENCES `resturant` (`resturantId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `itemsize`
--
ALTER TABLE `itemsize`
  ADD CONSTRAINT `fk_itemsize_item1` FOREIGN KEY (`item_itemId`) REFERENCES `item` (`itemId`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_customer1` FOREIGN KEY (`fkcustomerId`) REFERENCES `customer` (`customerId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_resturant1` FOREIGN KEY (`fkresturantId`) REFERENCES `resturant` (`resturantId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `fk_orderItem_itemsize1` FOREIGN KEY (`fkitemsizeId`) REFERENCES `itemsize` (`itemsizeId`),
  ADD CONSTRAINT `fk_orderItem_order1` FOREIGN KEY (`fkorderId`) REFERENCES `order` (`orderId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `fk_purchase_order1` FOREIGN KEY (`fkorderId`) REFERENCES `order` (`orderId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_restaurantid_purchase` FOREIGN KEY (`restaurantId`) REFERENCES `resturant` (`resturantId`) ON DELETE NO ACTION;

--
-- Constraints for table `resturanttime`
--
ALTER TABLE `resturanttime`
  ADD CONSTRAINT `fk_resturanttime_resturant1` FOREIGN KEY (`fkresturantId`) REFERENCES `resturant` (`resturantId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shipaddress`
--
ALTER TABLE `shipaddress`
  ADD CONSTRAINT `fk_shipaddress_customer1` FOREIGN KEY (`fkcustomerId`) REFERENCES `customer` (`customerId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk_task_userId` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_usertype` FOREIGN KEY (`fkuserTypeId`) REFERENCES `usertype` (`userTypeId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
