-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 27, 2019 alle 15:28
-- Versione del server: 10.1.36-MariaDB
-- Versione PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easy_lunch`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Admins`
--

CREATE TABLE `Admins` (
  `UserName` varchar(20) NOT NULL,
  `CreditPerProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `CartData`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `CartData` (
`CartId` int(11)
,`ProductId` int(11)
,`ProductName` varchar(30)
,`Price` float
,`Quantity` int(11)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `Carts`
--

CREATE TABLE `Carts` (
  `Id` int(11) NOT NULL,
  `ClientId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Carts`
--

INSERT INTO `Carts` (`Id`, `ClientId`) VALUES
(2, 'andrea'),
(3, 'andrea'),
(4, 'andrea'),
(5, 'andrea'),
(6, 'andrea'),
(7, 'andrea'),
(8, 'andrea'),
(9, 'andrea'),
(10, 'andrea'),
(11, 'andrea'),
(12, 'andrea'),
(13, 'andrea'),
(14, 'andrea'),
(15, 'andrea'),
(16, 'andrea'),
(17, 'andrea'),
(18, 'andrea'),
(19, 'andrea'),
(20, 'andrea'),
(21, 'andrea'),
(22, 'andrea'),
(23, 'andrea'),
(24, 'andrea'),
(25, 'andrea'),
(26, 'andrea'),
(27, 'andrea');

-- --------------------------------------------------------

--
-- Struttura della tabella `Categories`
--

CREATE TABLE `Categories` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Categories`
--

INSERT INTO `Categories` (`Id`, `Name`) VALUES
(2, 'Fast food'),
(17, 'Indian'),
(18, 'Pizza'),
(19, 'Sushi'),
(1, 'Sweets'),
(9, 'Vegan');

-- --------------------------------------------------------

--
-- Struttura della tabella `Clients`
--

CREATE TABLE `Clients` (
  `UserName` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `Birthdate` date NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Credit` int(11) NOT NULL DEFAULT '0',
  `CurrentCartId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Clients`
--

INSERT INTO `Clients` (`UserName`, `Name`, `Surname`, `Birthdate`, `PhoneNumber`, `Email`, `Credit`, `CurrentCartId`) VALUES
('andrea', 'Andrea', 'Ziani', '1997-09-30', '3315091440', 'andrea@gmail.com', 0, 27),
('nicola', 'nicola', 'ziani', '1994-06-02', '3334234343', 'nik@gmail.com', 0, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `Notifications`
--

CREATE TABLE `Notifications` (
  `Id` int(11) NOT NULL,
  `Tipology` enum('NEW_ORDER','ORDER_COMING','ORDER_ARRIVED') NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` text NOT NULL,
  `OrderId` int(11) NOT NULL,
  `ReceiverId` varchar(20) NOT NULL,
  `IsRead` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Notifications`
--

INSERT INTO `Notifications` (`Id`, `Tipology`, `Timestamp`, `Description`, `OrderId`, `ReceiverId`, `IsRead`) VALUES
(1, 'NEW_ORDER', '2019-01-20 13:35:30', 'Order for andrea at 2019-01-22 12:00:00 and ENTRANCE_A\n Order details:\n	1 Double Hamburger', 20, 'provider1', 1),
(2, 'ORDER_COMING', '2019-01-20 14:17:01', 'Received order for andrea at ENTRANCE_A\n Order details:\n	1 Double Hamburger\nExpected arrival at: 2019-01-20 14:29:01', 20, 'andrea', 1),
(3, 'ORDER_ARRIVED', '2019-01-20 14:29:01', 'Arrived order for andrea at ENTRANCE_A\n Order details:\n	1 Double Hamburger', 20, 'andrea', 1),
(4, 'NEW_ORDER', '2019-01-20 14:22:24', 'Order for pippo at 2019-01-21 12:00:00 and ENTRANCE_B\n Order details:\n	1 Chocolate bar', 21, 'provider1', 1),
(5, 'ORDER_COMING', '2019-01-20 14:22:39', 'Received order for pippo at ENTRANCE_B\n Order details:\n	1 Chocolate bar\nExpected arrival at: 2019-01-20 14:27:39', 21, 'andrea', 1),
(6, 'ORDER_ARRIVED', '2019-01-20 14:27:39', 'Arrived order for pippo at ENTRANCE_B\n Order details:\n	1 Chocolate bar', 21, 'andrea', 1),
(7, 'NEW_ORDER', '2019-01-20 14:24:34', 'Order for andrea at 2019-01-20 14:25:00 and ENTRANCE_A\n Order details:\n	1 Chocolate bar', 22, 'provider1', 1),
(8, 'ORDER_COMING', '2019-01-20 14:25:06', 'Received order for andrea at ENTRANCE_A\n Order details:\n	1 Chocolate bar\nExpected arrival at: 2019-01-20 14:26:06', 22, 'andrea', 1),
(9, 'ORDER_ARRIVED', '2019-01-20 14:26:06', 'Arrived order for andrea at ENTRANCE_A\n Order details:\n	1 Chocolate bar', 22, 'andrea', 1),
(10, 'NEW_ORDER', '2019-01-20 18:25:03', 'Order for andrea at 2019-01-20 18:26:00 and ENTRANCE_A\n Order details:\n	1 Chocolate bar', 23, 'provider1', 1),
(11, 'ORDER_COMING', '2019-01-20 18:25:23', 'Received order for andrea at ENTRANCE_A\n Order details:\n	1 Chocolate bar\nExpected arrival at: 2019-01-20 18:26:23', 23, 'andrea', 1),
(12, 'ORDER_ARRIVED', '2019-01-20 18:26:23', 'Arrived order for andrea at ENTRANCE_A\n Order details:\n	1 Chocolate bar', 23, 'andrea', 1),
(13, 'NEW_ORDER', '2019-01-21 09:00:29', 'Order for andrea\nRequested arrival at 2019-01-21 09:01:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	2 Chocolate bar', 24, 'provider1', 1),
(14, 'ORDER_COMING', '2019-01-21 09:01:10', 'Received order for andrea\nRequested arrival at 2019-01-21 09:01:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	2 Chocolate bar\nExpected arrival at: 2019-01-21 9:02:10', 24, 'andrea', 1),
(15, 'ORDER_ARRIVED', '2019-01-21 09:02:10', 'Arrived order for andrea\nRequested arrival at 2019-01-21 09:01:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	2 Chocolate bar', 24, 'andrea', 1),
(16, 'NEW_ORDER', '2019-01-24 12:21:20', 'Order for Andrea\nRequested arrival at 2019-01-24 12:22:00\nRequested delivery at ENTRANCE_B\nOrder details:\n	1 Big Mac menu', 25, 'provider2', 1),
(17, 'ORDER_COMING', '2019-01-24 12:22:40', 'Received order for Andrea\nRequested arrival at 2019-01-24 12:22:00\nRequested delivery at ENTRANCE_B\nOrder details:\n	1 Big Mac menu\nExpected arrival at: 2019-01-24 12:23:40', 25, 'andrea', 1),
(18, 'ORDER_ARRIVED', '2019-01-24 12:23:40', 'Arrived order for Andrea\nRequested arrival at 2019-01-24 12:22:00\nRequested delivery at ENTRANCE_B\nOrder details:\n	1 Big Mac menu', 25, 'andrea', 1),
(19, 'NEW_ORDER', '2019-01-24 12:28:22', 'Order for andrea\nRequested arrival at 2019-01-24 12:29:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	2 Fries', 27, 'provider2', 1),
(20, 'ORDER_COMING', '2019-01-24 12:28:34', 'Received order for andrea\nRequested arrival at 2019-01-24 12:29:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	2 Fries\nExpected arrival at: 2019-01-24 12:29:34', 27, 'andrea', 1),
(21, 'ORDER_ARRIVED', '2019-01-24 12:29:34', 'Arrived order for andrea\nRequested arrival at 2019-01-24 12:29:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	2 Fries', 27, 'andrea', 1),
(22, 'NEW_ORDER', '2019-01-24 15:57:09', 'Order for Andrea\nRequested arrival at 2019-01-24 15:58:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	1 Chocolate bar', 28, 'provider1', 1),
(23, 'NEW_ORDER', '2019-01-24 15:58:57', 'Order for Andrea\nRequested arrival at 2019-01-24 15:59:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	1 Double Hamburger', 29, 'provider1', 1),
(24, 'ORDER_COMING', '2019-01-24 16:04:36', 'Received order for Andrea\nRequested arrival at 2019-01-24 15:58:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	1 Chocolate bar\nExpected arrival at: 2019-01-24 16:05:36', 28, 'andrea', 1),
(25, 'ORDER_ARRIVED', '2019-01-24 16:05:36', 'Arrived order for Andrea\nRequested arrival at 2019-01-24 15:58:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	1 Chocolate bar', 28, 'andrea', 1),
(26, 'ORDER_COMING', '2019-01-24 16:04:40', 'Received order for Andrea\nRequested arrival at 2019-01-24 15:59:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	1 Double Hamburger\nExpected arrival at: 2019-01-24 16:05:40', 29, 'andrea', 1),
(27, 'ORDER_ARRIVED', '2019-01-24 16:05:40', 'Arrived order for Andrea\nRequested arrival at 2019-01-24 15:59:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	1 Double Hamburger', 29, 'andrea', 1),
(28, 'NEW_ORDER', '2019-01-24 16:13:44', 'Order for Andrea\nRequested arrival at 2019-01-24 16:14:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	1 Chocolate bar', 30, 'provider1', 1),
(29, 'ORDER_COMING', '2019-01-24 17:25:27', 'Received order for Andrea\nRequested arrival at 2019-01-24 16:14:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	1 Chocolate bar\nExpected arrival at: 2019-01-24 17:26:27', 30, 'andrea', 1),
(30, 'ORDER_ARRIVED', '2019-01-24 17:26:27', 'Arrived order for Andrea\nRequested arrival at 2019-01-24 16:14:00\nRequested delivery at ENTRANCE_A\nOrder details:\n	1 Chocolate bar', 30, 'andrea', 1),
(31, 'NEW_ORDER', '2019-01-25 10:24:22', 'Order for andrea\nRequested arrival at 2019-01-25 12:00:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	2 Double Hamburger', 31, 'provider1', 1),
(32, 'ORDER_COMING', '2019-01-25 11:06:34', 'Received order for andrea\nRequested arrival at 2019-01-25 12:00:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	2 Double Hamburger\nExpected arrival at: 2019-01-25 11:07:34', 31, 'andrea', 1),
(33, 'ORDER_ARRIVED', '2019-01-25 11:07:34', 'Arrived order for andrea\nRequested arrival at 2019-01-25 12:00:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	2 Double Hamburger', 31, 'andrea', 1),
(34, 'NEW_ORDER', '2019-01-25 12:58:47', 'Order for Andrea\nRequested arrival at 2019-01-25 13:00:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Cheese cake', 32, 'provider1', 1),
(35, 'NEW_ORDER', '2019-01-25 13:21:46', 'Order for andrea\nRequested arrival at 2019-01-25 13:25:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Mc veggie', 33, 'provider2', 1),
(36, 'NEW_ORDER', '2019-01-25 13:21:46', 'Order for andrea\nRequested arrival at 2019-01-25 13:25:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Cheese cake', 34, 'provider1', 1),
(37, 'ORDER_COMING', '2019-01-25 13:23:07', 'Received order for andrea\nRequested arrival at 2019-01-25 13:25:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Cheese cake\nExpected arrival at: 2019-01-25 13:24:07', 34, 'andrea', 1),
(38, 'ORDER_ARRIVED', '2019-01-25 13:24:07', 'Arrived order for andrea\nRequested arrival at 2019-01-25 13:25:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Cheese cake', 34, 'andrea', 1),
(39, 'ORDER_COMING', '2019-01-25 13:37:47', 'Received order for andrea\nRequested arrival at 2019-01-25 13:25:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Mc veggie\nExpected arrival at: 2019-01-25 13:38:47', 33, 'andrea', 1),
(40, 'ORDER_ARRIVED', '2019-01-25 13:38:47', 'Arrived order for andrea\nRequested arrival at 2019-01-25 13:25:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Mc veggie', 33, 'andrea', 1),
(41, 'NEW_ORDER', '2019-01-25 13:40:45', 'Order for Andrea\nRequested arrival at 2019-01-25 13:41:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Nuggets (size of 9)', 35, 'provider2', 1),
(42, 'ORDER_COMING', '2019-01-25 13:41:14', 'Received order for Andrea\nRequested arrival at 2019-01-25 13:41:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Nuggets (size of 9)\nExpected arrival at: 2019-01-25 13:42:14', 35, 'andrea', 1),
(43, 'ORDER_ARRIVED', '2019-01-25 13:42:14', 'Arrived order for Andrea\nRequested arrival at 2019-01-25 13:41:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Nuggets (size of 9)', 35, 'andrea', 1),
(44, 'NEW_ORDER', '2019-01-25 13:43:06', 'Order for nicol\nRequested arrival at 2019-01-25 13:44:00\nRequested delivery at SECOND_FLOOR\nOrder details:\n	1 Cheese cake', 36, 'provider1', 1),
(45, 'ORDER_COMING', '2019-01-25 13:43:47', 'Received order for nicol\nRequested arrival at 2019-01-25 13:44:00\nRequested delivery at SECOND_FLOOR\nOrder details:\n	1 Cheese cake\nExpected arrival at: 2019-01-25 13:44:47', 36, 'andrea', 1),
(46, 'ORDER_ARRIVED', '2019-01-25 13:44:47', 'Arrived order for nicol\nRequested arrival at 2019-01-25 13:44:00\nRequested delivery at SECOND_FLOOR\nOrder details:\n	1 Cheese cake', 36, 'andrea', 1),
(47, 'NEW_ORDER', '2019-01-25 13:47:26', 'Order for andrea\nRequested arrival at 2019-01-25 13:48:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Kebab', 37, 'alibaba', 1),
(48, 'ORDER_COMING', '2019-01-25 13:47:53', 'Received order for andrea\nRequested arrival at 2019-01-25 13:48:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Kebab\nExpected arrival at: 2019-01-25 13:48:53', 37, 'andrea', 1),
(49, 'ORDER_ARRIVED', '2019-01-25 13:48:53', 'Arrived order for andrea\nRequested arrival at 2019-01-25 13:48:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Kebab', 37, 'andrea', 1),
(50, 'NEW_ORDER', '2019-01-25 13:51:14', 'Order for Andrea\nRequested arrival at 2019-01-25 13:52:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Mc veggie', 38, 'provider2', 1),
(51, 'NEW_ORDER', '2019-01-25 13:52:07', 'Order for andrea\nRequested arrival at 2019-01-25 13:53:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Nuggets (size of 9)', 39, 'provider2', 1),
(52, 'ORDER_COMING', '2019-01-25 13:52:33', 'Received order for Andrea\nRequested arrival at 2019-01-25 13:52:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Mc veggie\nExpected arrival at: 2019-01-25 13:53:33', 38, 'andrea', 1),
(53, 'ORDER_ARRIVED', '2019-01-25 13:53:33', 'Arrived order for Andrea\nRequested arrival at 2019-01-25 13:52:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Mc veggie', 38, 'andrea', 1),
(54, 'NEW_ORDER', '2019-01-26 17:00:04', 'Order for Andrea\nRequested arrival at 2019-01-26 17:01:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Double double', 40, 'provider1', 1),
(55, 'ORDER_COMING', '2019-01-26 17:00:39', 'Received order for Andrea\nRequested arrival at 2019-01-26 17:01:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Double double\nExpected arrival at: 2019-01-26 17:01:39', 40, 'andrea', 1),
(56, 'ORDER_ARRIVED', '2019-01-26 17:01:39', 'Arrived order for Andrea\nRequested arrival at 2019-01-26 17:01:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Double double', 40, 'andrea', 1),
(57, 'NEW_ORDER', '2019-01-26 18:35:47', 'Order for andrea\nRequested arrival at 2019-01-26 18:37:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Onion rings', 41, 'provider1', 1),
(58, 'ORDER_COMING', '2019-01-26 18:37:04', 'Received order for andrea\nRequested arrival at 2019-01-26 18:37:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Onion rings\nExpected arrival at: 2019-01-26 18:38:04', 41, 'andrea', 1),
(59, 'ORDER_ARRIVED', '2019-01-26 18:38:04', 'Arrived order for andrea\nRequested arrival at 2019-01-26 18:37:00\nRequested delivery at FIRST_FLOOR\nOrder details:\n	1 Onion rings', 41, 'andrea', 1),
(60, 'NEW_ORDER', '2019-01-27 10:21:25', 'Order for andrea\nRequested arrival at 2019-01-27 12:00:00\nRequested delivery at ground floor\nOrder details:\n	1 Kebab', 42, 'alibaba', 0),
(61, 'NEW_ORDER', '2019-01-27 10:29:43', 'Order for nicola\nRequested arrival at 2019-01-28 12:00:00\nRequested delivery at ground floor\nOrder details:\n	1 Vegan hamburger', 44, 'provider1', 1),
(62, 'ORDER_COMING', '2019-01-27 10:32:35', 'Received order for nicola\nRequested arrival at 2019-01-28 12:00:00\nRequested delivery at ground floor\nOrder details:\n	1 Vegan hamburger\nExpected arrival at: 2019-01-27 10:37:35', 44, 'andrea', 1),
(63, 'ORDER_ARRIVED', '2019-01-27 10:37:35', 'Arrived order for nicola\nRequested arrival at 2019-01-28 12:00:00\nRequested delivery at ground floor\nOrder details:\n	1 Vegan hamburger', 44, 'andrea', 1);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `OrderData`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `OrderData` (
`OrderId` int(11)
,`ProviderId` varchar(20)
,`ProductId` int(11)
,`ProductName` varchar(30)
,`Quantity` int(11)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `OrderEntries`
--

CREATE TABLE `OrderEntries` (
  `ProductId` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `OrderEntries`
--

INSERT INTO `OrderEntries` (`ProductId`, `OrderId`, `Quantity`, `Price`) VALUES
(7, 20, 1, 5),
(7, 29, 1, 5.5),
(7, 31, 2, 5.5),
(8, 21, 1, 4),
(8, 22, 1, 4),
(8, 23, 1, 4),
(8, 24, 2, 4),
(8, 28, 1, 1.2),
(8, 30, 1, 1.2),
(12, 27, 2, 3),
(15, 25, 1, 7),
(16, 35, 1, 5.5),
(16, 39, 1, 5.5),
(18, 40, 1, 13),
(22, 44, 1, 10),
(23, 41, 1, 5),
(24, 32, 1, 5),
(24, 34, 1, 5),
(24, 36, 1, 5),
(25, 33, 1, 4.5),
(25, 38, 1, 4.5),
(28, 37, 1, 6),
(28, 42, 1, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `Orders`
--

CREATE TABLE `Orders` (
  `Id` int(11) NOT NULL,
  `State` enum('NOT_STARTED','STARTED','ARRIVED','COMPLETED','ARRIVING') NOT NULL DEFAULT 'NOT_STARTED',
  `ProviderId` varchar(20) NOT NULL,
  `CartId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Orders`
--

INSERT INTO `Orders` (`Id`, `State`, `ProviderId`, `CartId`) VALUES
(20, 'COMPLETED', 'provider1', 5),
(21, 'COMPLETED', 'provider1', 6),
(22, 'COMPLETED', 'provider1', 7),
(23, 'COMPLETED', 'provider1', 8),
(24, 'COMPLETED', 'provider1', 9),
(25, 'COMPLETED', 'provider2', 10),
(26, 'STARTED', 'provider1', 10),
(27, 'COMPLETED', 'provider2', 11),
(28, 'COMPLETED', 'provider1', 12),
(29, 'COMPLETED', 'provider1', 13),
(30, 'COMPLETED', 'provider1', 14),
(31, 'ARRIVED', 'provider1', 15),
(32, 'STARTED', 'provider1', 16),
(33, 'ARRIVED', 'provider2', 17),
(34, 'COMPLETED', 'provider1', 17),
(35, 'COMPLETED', 'provider2', 18),
(36, 'ARRIVED', 'provider1', 19),
(37, 'COMPLETED', 'alibaba', 20),
(38, 'ARRIVED', 'provider2', 21),
(39, 'STARTED', 'provider2', 22),
(40, 'COMPLETED', 'provider1', 23),
(41, 'ARRIVED', 'provider1', 24),
(42, 'STARTED', 'alibaba', 25),
(43, 'STARTED', 'provider2', 25),
(44, 'ARRIVED', 'provider1', 26),
(45, 'NOT_STARTED', 'provider1', 27),
(46, 'NOT_STARTED', 'alibaba', 27),
(47, 'NOT_STARTED', 'provider2', 27);

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `OrdersToArrive`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `OrdersToArrive` (
`Id` int(11)
,`Timestamp` timestamp
);

-- --------------------------------------------------------

--
-- Struttura della tabella `Products`
--

CREATE TABLE `Products` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Description` text NOT NULL,
  `Image` text NOT NULL,
  `Price` double NOT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT '1',
  `PreviousVersionId` int(11) DEFAULT NULL,
  `CategoryId` int(11) NOT NULL,
  `ProviderId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Products`
--

INSERT INTO `Products` (`Id`, `Name`, `Description`, `Image`, `Price`, `IsActive`, `PreviousVersionId`, `CategoryId`, `ProviderId`) VALUES
(7, 'Double Hamburger', 'Tasty hamburger with double meat and cheddar cheese.', 'images/productsimages/hamburger.png', 5.5, 0, NULL, 2, 'provider1'),
(8, 'Chocolate bar', 'Tasty dark chocolate bar.', 'images/productsimages/milkchocolate.jpeg', 1.2, 0, NULL, 1, 'provider1'),
(9, 'Mc Veggie', 'Vegan tofu hamburger with salad and guacamole sauce.', 'images/productsimages/mcveggie.jpg', 5, 0, NULL, 9, 'provider2'),
(10, 'Fries', 'Large size of fries.', 'images/productsimages/fries.jpg', 3, 0, NULL, 2, 'provider2'),
(11, 'Fries', 'Large fries', 'images/productsimages/fries.jpg', 3, 0, NULL, 2, 'provider2'),
(12, 'Fries', 'Large fries', 'images/productsimages/fries.jpg', 3, 0, NULL, 2, 'provider2'),
(13, 'Mc Veggie', 'Vegan burger with tofu and salad.', 'images/productsimages/mcveggie.jpg', 6, 0, NULL, 9, 'provider2'),
(14, 'Happy meal', 'Happy meal with chicken hamburger, little fries, little drink and a surprise for babies', 'images/productsimages/happymeal.png', 5.5, 0, NULL, 2, 'provider2'),
(15, 'Big Mac menu', 'Menu with big mac, large coca cola and large fries.', 'images/productsimages/menubigmac.png', 7, 0, NULL, 2, 'provider2'),
(16, 'Nuggets (size of 9)', 'Chicken nuggets with ketchup and maionese souces.', 'images/productsimages/nuggets.jpg', 5.5, 1, NULL, 2, 'provider2'),
(17, 'Double double', 'The biggest hamburger with double meat inside.', 'images/productsimages/double.jpg', 13.2, 0, NULL, 2, 'provider1'),
(18, 'Double double', 'The biggest hamburger with double meat inside.', 'images/productsimages/double.jpg', 13, 1, NULL, 2, 'provider1'),
(19, 'Onion rings', 'Tasty onion rings.', 'images/productsimages/onion.jpg', 6, 0, NULL, 2, 'provider1'),
(20, 'Fries', 'Tasty fries.', 'images/productsimages/friesag.png', 5, 0, NULL, 2, 'provider1'),
(21, 'Vegan American Burger', 'Tasty vegan hamburger with tofu and souces.', 'images/productsimages/veganag.jpg', 10, 0, NULL, 9, 'provider1'),
(22, 'Vegan hamburger', 'Hamburger with tofu and souces.', 'images/productsimages/veganag.jpg', 10, 1, NULL, 9, 'provider1'),
(23, 'Onion rings', 'Onion rings with mayonnaise and ketchup included', 'images/productsimages/onion.jpg', 5, 1, NULL, 2, 'provider1'),
(24, 'Cheese cake', 'Cheese cake with plum marmalade.', 'images/productsimages/cheesecake.jpg', 5, 1, NULL, 1, 'provider1'),
(25, 'Mc veggie', 'Vegan hamburger with seitan.', 'images/productsimages/mcveggie.jpg', 4.5, 1, NULL, 9, 'provider2'),
(26, 'Kebab', 'Doner kebab with fries, beef, salad, onions, tomatoes and souces', 'images/productsimages/kebab.png', 6, 0, NULL, 17, 'alibaba'),
(27, 'Kebab', 'Doner kebab with fries, beef, salad, onions, tomatoes and souces', 'images/productsimages/kebab.png', 6, 0, NULL, 17, 'alibaba'),
(28, 'Kebab', 'Doner kebab with beef, salad, fries, onions and mayonnaise.', 'images/productsimages/kebab.png', 6, 1, NULL, 17, 'alibaba'),
(29, 'Fries', 'Tasty fries.', 'images/productsimages/friesag.png', 4, 0, NULL, 2, 'provider1');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `ProviderRatings`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `ProviderRatings` (
`Name` varchar(20)
,`Rating` decimal(7,4)
,`ReviewNumber` bigint(21)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `Providers`
--

CREATE TABLE `Providers` (
  `UserName` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `Birthdate` date NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `IVA` varchar(30) NOT NULL,
  `CityAddress` varchar(20) NOT NULL,
  `AddressStreet` varchar(20) NOT NULL,
  `AddressNumber` int(11) NOT NULL,
  `CompanyName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Providers`
--

INSERT INTO `Providers` (`UserName`, `Name`, `Surname`, `Birthdate`, `PhoneNumber`, `Email`, `IVA`, `CityAddress`, `AddressStreet`, `AddressNumber`, `CompanyName`) VALUES
('alibaba', 'Ali', 'Baba', '1991-06-05', '3453432233', 'alibaba@gmail.it', '232123432', 'Cesena', 'Via A. Moro', 23, 'Ali kebab'),
('provider1', 'Nicola', 'Ziani', '1992-08-06', '3425533232', 'nicola@gmail.com', '232323232', 'ForlÃ¬', 'Via ca rossa', 2, 'America graffiti'),
('provider2', 'Andrea', 'Ziani', '2018-07-10', '3315091440', 'andrea@gmail.com', '32452323442', 'Cesena', 'Via roma', 33, 'Mc Donald');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `ProvidersReviews`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `ProvidersReviews` (
`OrderId` int(11)
,`Comment` text
,`Rank` tinyint(4)
,`ProviderId` varchar(20)
,`CompanyName` varchar(20)
,`AddressStreet` varchar(20)
,`AddressNumber` int(11)
,`PhoneNumber` varchar(10)
,`Email` varchar(30)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `Purchases`
--

CREATE TABLE `Purchases` (
  `CartId` int(11) NOT NULL,
  `Nominative` varchar(20) NOT NULL,
  `DeliverySpot` enum('FIRST_FLOOR','GROUND_FLOOR') NOT NULL DEFAULT 'GROUND_FLOOR',
  `DeliveryTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Purchases`
--

INSERT INTO `Purchases` (`CartId`, `Nominative`, `DeliverySpot`, `DeliveryTime`) VALUES
(2, 'andrea', '', '2019-01-21 13:00:00'),
(3, 'andrea', '', '2019-01-26 12:00:00'),
(4, 'andrea', '', '2019-01-21 12:00:00'),
(5, 'andrea', '', '2019-01-22 12:00:00'),
(6, 'pippo', '', '2019-01-21 12:00:00'),
(7, 'andrea', '', '2019-01-20 14:25:00'),
(8, 'andrea', '', '2019-01-20 18:26:00'),
(9, 'andrea', '', '2019-01-21 09:01:00'),
(10, 'Andrea', '', '2019-01-24 12:22:00'),
(11, 'andrea', '', '2019-01-24 12:29:00'),
(12, 'Andrea', '', '2019-01-24 15:58:00'),
(13, 'Andrea', '', '2019-01-24 15:59:00'),
(14, 'Andrea', '', '2019-01-24 16:14:00'),
(15, 'andrea', 'FIRST_FLOOR', '2019-01-25 12:00:00'),
(16, 'Andrea', 'FIRST_FLOOR', '2019-01-25 13:00:00'),
(17, 'andrea', 'FIRST_FLOOR', '2019-01-25 13:25:00'),
(18, 'Andrea', 'FIRST_FLOOR', '2019-01-25 13:41:00'),
(19, 'nicol', '', '2019-01-25 13:44:00'),
(20, 'andrea', 'FIRST_FLOOR', '2019-01-25 13:48:00'),
(21, 'Andrea', 'FIRST_FLOOR', '2019-01-25 13:52:00'),
(22, 'andrea', 'FIRST_FLOOR', '2019-01-25 13:53:00'),
(23, 'Andrea', 'FIRST_FLOOR', '2019-01-26 17:01:00'),
(24, 'andrea', 'FIRST_FLOOR', '2019-01-26 18:37:00'),
(25, 'andrea', 'GROUND_FLOOR', '2019-01-27 12:00:00'),
(26, 'nicola', 'GROUND_FLOOR', '2019-01-28 12:00:00');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `ReviewableOrders`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `ReviewableOrders` (
`ClientId` varchar(20)
,`OrderId` int(11)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `Reviews`
--

CREATE TABLE `Reviews` (
  `Id` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Rank` tinyint(4) NOT NULL,
  `OrderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Reviews`
--

INSERT INTO `Reviews` (`Id`, `Comment`, `Rank`, `OrderId`) VALUES
(6, 'Very fast!', 4, 20),
(7, 'It could be better.', 3, 22),
(8, 'Wow, nice products!', 3, 24),
(9, '', 5, 23),
(10, 'Really tasty', 5, 27),
(11, 'Beautiful lunch!', 4, 29),
(12, 'Not so bad.', 3, 30),
(13, 'Really tasty', 5, 28),
(14, 'Very fast delivery!', 4, 34),
(15, 'Standard quality.', 3, 37),
(16, 'Very good.', 4, 35),
(17, '', 4, 40);

-- --------------------------------------------------------

--
-- Struttura della tabella `Users`
--

CREATE TABLE `Users` (
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Type` enum('CLIENT','PROVIDER','ADMIN','') NOT NULL DEFAULT 'CLIENT'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Users`
--

INSERT INTO `Users` (`UserName`, `Password`, `Type`) VALUES
('admin', '$2y$10$u5ylYAklWHnn5VQ89OXmFufqj.EyHtaLJWg.ORBX1VL6p.SAwvTK6', 'ADMIN'),
('alibaba', '$2y$10$aD9e2MubxNPfeHMGFNV0De/Qr6vvqoFm3lolTw1Y2rVJqK.gGdBNS', 'PROVIDER'),
('andrea', '$2y$10$jJvsTFbN4BXcMZp1fh6EQuT4WMHRsPVafWOAHneDGmx6m2PW1juoG', 'CLIENT'),
('nicola', '$2y$10$IbwgqHNtu5xqhBCscpmcB.BAk/JIcGQsgUVl3NBZ7vlUUZtvEn6oC', 'CLIENT'),
('provider1', '$2y$10$bTM4AVFQ02vDgHcyDDE9GOqKsNZruJb5CHXfbzVXIcdzbdUMb0Fum', 'PROVIDER'),
('provider2', '$2y$10$W.xN490fYBM1nQu6MOmPgORCqfO1VgP20a9yp8lFQWHOM/NN1x.Wm', 'PROVIDER');

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `VisibleOrders`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `VisibleOrders` (
`Id` int(11)
,`ClientId` varchar(20)
,`ProviderId` varchar(20)
,`State` enum('NOT_STARTED','STARTED','ARRIVED','COMPLETED','ARRIVING')
,`TotalPrice` double
,`Description` text
);

-- --------------------------------------------------------

--
-- Struttura per vista `CartData`
--
DROP TABLE IF EXISTS `CartData`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `CartData`  AS  select `Carts`.`Id` AS `CartId`,`Products`.`Id` AS `ProductId`,`Products`.`Name` AS `ProductName`,`OrderEntries`.`Price` AS `Price`,`OrderEntries`.`Quantity` AS `Quantity` from (((`Carts` join `Orders` on((`Carts`.`Id` = `Orders`.`CartId`))) join `OrderEntries` on((`Orders`.`Id` = `OrderEntries`.`OrderId`))) join `Products` on((`OrderEntries`.`ProductId` = `Products`.`Id`))) ;

-- --------------------------------------------------------

--
-- Struttura per vista `OrderData`
--
DROP TABLE IF EXISTS `OrderData`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `OrderData`  AS  select `Orders`.`Id` AS `OrderId`,`Products`.`ProviderId` AS `ProviderId`,`Products`.`Id` AS `ProductId`,`Products`.`Name` AS `ProductName`,`OrderEntries`.`Quantity` AS `Quantity` from ((`Orders` join `OrderEntries` on((`Orders`.`Id` = `OrderEntries`.`OrderId`))) join `Products` on((`OrderEntries`.`ProductId` = `Products`.`Id`))) ;

-- --------------------------------------------------------

--
-- Struttura per vista `OrdersToArrive`
--
DROP TABLE IF EXISTS `OrdersToArrive`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `OrdersToArrive`  AS  select `Orders`.`Id` AS `Id`,`Notifications`.`Timestamp` AS `Timestamp` from (`Orders` join `Notifications` on((`Orders`.`Id` = `Notifications`.`OrderId`))) where ((`Orders`.`State` = 'ARRIVING') and (`Notifications`.`Tipology` = 'ORDER_ARRIVED')) ;

-- --------------------------------------------------------

--
-- Struttura per vista `ProviderRatings`
--
DROP TABLE IF EXISTS `ProviderRatings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ProviderRatings`  AS  select `Providers`.`UserName` AS `Name`,avg(`Reviews`.`Rank`) AS `Rating`,count(`Reviews`.`Id`) AS `ReviewNumber` from ((`Providers` join `Orders` on((`Orders`.`ProviderId` = `Providers`.`UserName`))) join `Reviews` on((`Reviews`.`OrderId` = `Orders`.`Id`))) group by `Providers`.`UserName` ;

-- --------------------------------------------------------

--
-- Struttura per vista `ProvidersReviews`
--
DROP TABLE IF EXISTS `ProvidersReviews`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ProvidersReviews`  AS  select `Orders`.`Id` AS `OrderId`,`Reviews`.`Comment` AS `Comment`,`Reviews`.`Rank` AS `Rank`,`Providers`.`UserName` AS `ProviderId`,`Providers`.`CompanyName` AS `CompanyName`,`Providers`.`AddressStreet` AS `AddressStreet`,`Providers`.`AddressNumber` AS `AddressNumber`,`Providers`.`PhoneNumber` AS `PhoneNumber`,`Providers`.`Email` AS `Email` from ((`Orders` join `Providers`) join `Reviews`) where ((`Orders`.`Id` = `Reviews`.`OrderId`) and (`Providers`.`UserName` = `Orders`.`ProviderId`)) ;

-- --------------------------------------------------------

--
-- Struttura per vista `ReviewableOrders`
--
DROP TABLE IF EXISTS `ReviewableOrders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ReviewableOrders`  AS  select `Clients`.`UserName` AS `ClientId`,`Orders`.`Id` AS `OrderId` from ((`Orders` join `Carts` on((`Carts`.`Id` = `Orders`.`CartId`))) join `Clients` on((`Clients`.`UserName` = `Carts`.`ClientId`))) where ((`Orders`.`State` = 'ARRIVED') and (0 = (select count(0) from `Reviews` where (`Reviews`.`OrderId` = `Orders`.`Id`)))) ;

-- --------------------------------------------------------

--
-- Struttura per vista `VisibleOrders`
--
DROP TABLE IF EXISTS `VisibleOrders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `VisibleOrders`  AS  select `Orders`.`Id` AS `Id`,`Carts`.`ClientId` AS `ClientId`,`Orders`.`ProviderId` AS `ProviderId`,`Orders`.`State` AS `State`,sum((`OrderEntries`.`Price` * `OrderEntries`.`Quantity`)) AS `TotalPrice`,`Notifications`.`Description` AS `Description` from (((`Orders` join `Notifications` on((`Orders`.`Id` = `Notifications`.`OrderId`))) join `OrderEntries` on((`Orders`.`Id` = `OrderEntries`.`OrderId`))) join `Carts` on((`Carts`.`Id` = `Orders`.`CartId`))) where (`Notifications`.`Tipology` = 'NEW_ORDER') group by `Orders`.`Id`,`Orders`.`State`,`Notifications`.`ReceiverId`,`Carts`.`ClientId`,`Orders`.`ProviderId`,`Notifications`.`Description` ;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Admins`
--
ALTER TABLE `Admins`
  ADD PRIMARY KEY (`UserName`);

--
-- Indici per le tabelle `Carts`
--
ALTER TABLE `Carts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ClientId` (`ClientId`);

--
-- Indici per le tabelle `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indici per le tabelle `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`UserName`);

--
-- Indici per le tabelle `Notifications`
--
ALTER TABLE `Notifications`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indici per le tabelle `OrderEntries`
--
ALTER TABLE `OrderEntries`
  ADD PRIMARY KEY (`ProductId`,`OrderId`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indici per le tabelle `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CartId` (`CartId`),
  ADD KEY `ProviderId` (`ProviderId`);

--
-- Indici per le tabelle `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `PreviousVersionId` (`PreviousVersionId`),
  ADD KEY `Products_ibfk_3` (`ProviderId`),
  ADD KEY `CategoryId` (`CategoryId`);

--
-- Indici per le tabelle `Providers`
--
ALTER TABLE `Providers`
  ADD PRIMARY KEY (`UserName`);

--
-- Indici per le tabelle `Purchases`
--
ALTER TABLE `Purchases`
  ADD PRIMARY KEY (`CartId`);

--
-- Indici per le tabelle `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indici per le tabelle `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserName`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Carts`
--
ALTER TABLE `Carts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT per la tabella `Categories`
--
ALTER TABLE `Categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `Notifications`
--
ALTER TABLE `Notifications`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT per la tabella `Orders`
--
ALTER TABLE `Orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT per la tabella `Products`
--
ALTER TABLE `Products`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT per la tabella `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Admins`
--
ALTER TABLE `Admins`
  ADD CONSTRAINT `Admins_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `Users` (`Username`);

--
-- Limiti per la tabella `Carts`
--
ALTER TABLE `Carts`
  ADD CONSTRAINT `Carts_ibfk_1` FOREIGN KEY (`ClientId`) REFERENCES `Clients` (`UserName`);

--
-- Limiti per la tabella `Clients`
--
ALTER TABLE `Clients`
  ADD CONSTRAINT `Clients_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `Users` (`Username`);

--
-- Limiti per la tabella `Notifications`
--
ALTER TABLE `Notifications`
  ADD CONSTRAINT `Notifications_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `Orders` (`Id`);

--
-- Limiti per la tabella `OrderEntries`
--
ALTER TABLE `OrderEntries`
  ADD CONSTRAINT `OrderEntries_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `Orders` (`Id`),
  ADD CONSTRAINT `OrderEntries_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `Products` (`Id`);

--
-- Limiti per la tabella `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`CartId`) REFERENCES `Carts` (`Id`),
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`ProviderId`) REFERENCES `Providers` (`Username`);

--
-- Limiti per la tabella `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `Products_ibfk_2` FOREIGN KEY (`PreviousVersionId`) REFERENCES `Products` (`Id`),
  ADD CONSTRAINT `Products_ibfk_3` FOREIGN KEY (`ProviderId`) REFERENCES `Providers` (`Username`),
  ADD CONSTRAINT `Products_ibfk_4` FOREIGN KEY (`CategoryId`) REFERENCES `Categories` (`Id`);

--
-- Limiti per la tabella `Providers`
--
ALTER TABLE `Providers`
  ADD CONSTRAINT `Providers_ibfk_1` FOREIGN KEY (`UserName`) REFERENCES `Users` (`Username`);

--
-- Limiti per la tabella `Purchases`
--
ALTER TABLE `Purchases`
  ADD CONSTRAINT `Purchases_ibfk_1` FOREIGN KEY (`CartId`) REFERENCES `Carts` (`Id`);

--
-- Limiti per la tabella `Reviews`
--
ALTER TABLE `Reviews`
  ADD CONSTRAINT `Reviews_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `Orders` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
