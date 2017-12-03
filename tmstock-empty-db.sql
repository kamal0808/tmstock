-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2017 at 05:12 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmstock`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `businessid` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerid` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `godowns`
--

CREATE TABLE `godowns` (
  `godownid` int(10) UNSIGNED NOT NULL,
  `type` varchar(6) NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `managerid` int(10) UNSIGNED NOT NULL,
  `city` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemid` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `godownid` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `business` varchar(8) NOT NULL,
  `itemtype` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `managerid` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `contact` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `orderitemid` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` float DEFAULT NULL,
  `itemid` int(10) UNSIGNED NOT NULL,
  `orderid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(10) UNSIGNED NOT NULL,
  `orderdate` date NOT NULL,
  `customerid` int(10) UNSIGNED NOT NULL,
  `managerid` int(10) UNSIGNED NOT NULL,
  `eventfrom` date DEFAULT NULL,
  `eventto` date DEFAULT NULL,
  `eventtype` varchar(45) DEFAULT NULL,
  `godownid` int(10) UNSIGNED NOT NULL,
  `invoice` tinyint(1) NOT NULL DEFAULT '0',
  `business` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseitems`
--

CREATE TABLE `purchaseitems` (
  `purchaseitemid` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` float DEFAULT '0',
  `itemid` int(10) UNSIGNED NOT NULL,
  `purchaseid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchaseid` int(10) UNSIGNED NOT NULL,
  `purchasedate` date NOT NULL,
  `supplierid` int(10) UNSIGNED NOT NULL,
  `managerid` int(10) UNSIGNED NOT NULL,
  `invoice` tinyint(1) NOT NULL DEFAULT '0',
  `business` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rentalsfrom`
--

CREATE TABLE `rentalsfrom` (
  `rentalsfromid` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `supplierid` int(10) UNSIGNED NOT NULL,
  `managerid` int(10) UNSIGNED NOT NULL,
  `rentfrom` date NOT NULL,
  `rentupto` date NOT NULL,
  `business` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rentalsfromitems`
--

CREATE TABLE `rentalsfromitems` (
  `rentalsfromitemsid` int(10) UNSIGNED NOT NULL,
  `itemid` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED DEFAULT NULL,
  `rentalsfromid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rentalsto`
--

CREATE TABLE `rentalsto` (
  `rentalstoid` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `customerid` int(10) UNSIGNED NOT NULL,
  `managerid` int(10) UNSIGNED NOT NULL,
  `rentfrom` date NOT NULL,
  `rentupto` date NOT NULL,
  `business` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rentalstoitems`
--

CREATE TABLE `rentalstoitems` (
  `rentalstoitemsid` int(10) UNSIGNED NOT NULL,
  `itemid` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED DEFAULT NULL,
  `rentalstoid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierid` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(10) UNSIGNED NOT NULL,
  `privilege` varchar(8) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `privilege`, `username`, `password`) VALUES
(6, 'admin', 'admin', '18963a1cd7ed6b68ce6e2363a5176c75');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`businessid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `godowns`
--
ALTER TABLE `godowns`
  ADD PRIMARY KEY (`godownid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemid`),
  ADD KEY `godownid` (`godownid`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`managerid`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`orderitemid`),
  ADD KEY `orderid` (`orderid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `customerid1` (`customerid`);

--
-- Indexes for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  ADD PRIMARY KEY (`purchaseitemid`),
  ADD KEY `purchaseid` (`purchaseid`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchaseid`) USING BTREE,
  ADD KEY `supplierid` (`supplierid`);

--
-- Indexes for table `rentalsfrom`
--
ALTER TABLE `rentalsfrom`
  ADD PRIMARY KEY (`rentalsfromid`),
  ADD KEY `supplierid1` (`supplierid`);

--
-- Indexes for table `rentalsfromitems`
--
ALTER TABLE `rentalsfromitems`
  ADD PRIMARY KEY (`rentalsfromitemsid`),
  ADD KEY `rentalsfromid` (`rentalsfromid`);

--
-- Indexes for table `rentalsto`
--
ALTER TABLE `rentalsto`
  ADD PRIMARY KEY (`rentalstoid`),
  ADD KEY `customerid` (`customerid`);

--
-- Indexes for table `rentalstoitems`
--
ALTER TABLE `rentalstoitems`
  ADD PRIMARY KEY (`rentalstoitemsid`),
  ADD KEY `rentalstoid` (`rentalstoid`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `businessid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `godowns`
--
ALTER TABLE `godowns`
  MODIFY `godownid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `managerid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `orderitemid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  MODIFY `purchaseitemid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchaseid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rentalsfrom`
--
ALTER TABLE `rentalsfrom`
  MODIFY `rentalsfromid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `rentalsfromitems`
--
ALTER TABLE `rentalsfromitems`
  MODIFY `rentalsfromitemsid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `rentalsto`
--
ALTER TABLE `rentalsto`
  MODIFY `rentalstoid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rentalstoitems`
--
ALTER TABLE `rentalstoitems`
  MODIFY `rentalstoitemsid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `godownid` FOREIGN KEY (`godownid`) REFERENCES `godowns` (`godownid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderid` FOREIGN KEY (`orderid`) REFERENCES `orders` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `customerid1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`customerid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  ADD CONSTRAINT `purchaseid` FOREIGN KEY (`purchaseid`) REFERENCES `purchases` (`purchaseid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `supplierid` FOREIGN KEY (`supplierid`) REFERENCES `suppliers` (`supplierid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rentalsfrom`
--
ALTER TABLE `rentalsfrom`
  ADD CONSTRAINT `supplierid1` FOREIGN KEY (`supplierid`) REFERENCES `suppliers` (`supplierid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rentalsfromitems`
--
ALTER TABLE `rentalsfromitems`
  ADD CONSTRAINT `rentalsfromid` FOREIGN KEY (`rentalsfromid`) REFERENCES `rentalsfrom` (`rentalsfromid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rentalsto`
--
ALTER TABLE `rentalsto`
  ADD CONSTRAINT `customerid` FOREIGN KEY (`customerid`) REFERENCES `customers` (`customerid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rentalstoitems`
--
ALTER TABLE `rentalstoitems`
  ADD CONSTRAINT `rentalstoid` FOREIGN KEY (`rentalstoid`) REFERENCES `rentalsto` (`rentalstoid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
