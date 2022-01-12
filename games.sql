-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 11:16 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `games`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `pass`) VALUES
(1, 'p.paulprem@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `gamepic` varchar(25) NOT NULL,
  `gamename` varchar(25) NOT NULL,
  `gamedetail` varchar(110) NOT NULL,
  `gameauthor` varchar(25) NOT NULL,
  `gamepub` varchar(25) NOT NULL,
  `branch` varchar(110) NOT NULL,
  `gameprice` varchar(25) NOT NULL,
  `gamequantity` varchar(25) NOT NULL,
  `gameava` int(11) NOT NULL,
  `gamerent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `gamepic`, `gamename`, `gamedetail`, `gameauthor`, `gamepub`, `branch`, `gameprice`, `gamequantity`, `gameava`, `gamerent`) VALUES
(8, 'arrow.jpg', 'Witcher3', 'Adventure', 'Reddit', 'Facebook', 'Dhanmondi', '1500', '15', 14, 1),
(9, 'download.jpg', 'Nba2k21', 'baskertball', 'Reddit', 'Facebook', 'Mohakhali', '1500', '20', 17, 3);

-- --------------------------------------------------------

--
-- Table structure for table `issuegame`
--

CREATE TABLE `issuegame` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `issuename` varchar(25) NOT NULL,
  `issuegame` varchar(25) NOT NULL,
  `issuetype` varchar(25) NOT NULL,
  `issuedays` int(11) NOT NULL,
  `issuedate` varchar(25) NOT NULL,
  `issuereturn` varchar(25) NOT NULL,
  `fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issuegame`
--

INSERT INTO `issuegame` (`id`, `userid`, `issuename`, `issuegame`, `issuetype`, `issuedays`, `issuedate`, `issuereturn`, `fine`) VALUES
(12, 7, 'Ashit', 'Nba2k21', 'stuff', 50, '11/01/2022', '02/03/2022', 0),
(13, 7, 'Ashit', 'Witcher3', 'stuff', 10, '11/01/2022', '21/01/2022', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requestgame`
--

CREATE TABLE `requestgame` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `usertype` varchar(25) NOT NULL,
  `gamename` varchar(25) NOT NULL,
  `issuedays` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requestgame`
--

INSERT INTO `requestgame` (`id`, `userid`, `gameid`, `username`, `usertype`, `gamename`, `issuedays`) VALUES
(7, 8, 3, 'Ashit', 'admin', 'NBA2k21', '5');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `name`, `email`, `pass`, `type`) VALUES
(1, 'salman', 'idno22382@gmail.com', '123', 'stuff'),
(2, 'Randall Burch', 'voqo@mailinator.com', 'Ratione nulla dolore', 'admin'),
(3, 'Gabriel Daugherty', 'bipacer@mailinator.com', 'Voluptas explicabo ', 'stuff'),
(5, 'salmannew', '1234@gmail.com', '123', 'stuff'),
(7, 'Ashit', 'ashit@Paul.com', '456', 'stuff'),
(8, 'PritomO', 'pritomboy@gmial.com', '124', 'admin'),
(9, 'Anabil', 'anabizz@yahoo.com', '456', 'admin'),
(10, 'nauman', 'naumanboy@gmail.com', '123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuegame`
--
ALTER TABLE `issuegame`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_fk` (`userid`);

--
-- Indexes for table `requestgame`
--
ALTER TABLE `requestgame`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_fk_book` (`gameid`),
  ADD KEY `pk_fk_users` (`userid`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `issuegame`
--
ALTER TABLE `issuegame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `requestgame`
--
ALTER TABLE `requestgame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issuegame`
--
ALTER TABLE `issuegame`
  ADD CONSTRAINT `pk_fk` FOREIGN KEY (`userid`) REFERENCES `userdata` (`id`);

--
-- Constraints for table `requestgame`
--
ALTER TABLE `requestgame`
  ADD CONSTRAINT `pk_fk_users` FOREIGN KEY (`userid`) REFERENCES `userdata` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
