-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2020 at 10:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6


-- IMPORT INTO PHPYMYADMIN TO SET THIS UP WITH THE WEBSITE
--Has some generated data to verify import process
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `developers`
--

CREATE TABLE `developers` (
  `id` int(5) NOT NULL,
  `developer` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `developers`
--

INSERT INTO `developers` (`id`, `developer`) VALUES
(1, 'ID Software'),
(2, 'Valve'),
(3, 'Bethesda'),
(4, 'Gearbox'),
(675968084, 'Ion');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gId` int(5) NOT NULL,
  `gameTitle` varchar(150) NOT NULL,
  `devId` int(5) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `yearReleased` int(4) NOT NULL,
  `genreId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gId`, `gameTitle`, `devId`, `summary`, `yearReleased`, `genreId`) VALUES
(2, 'Rage', 1, 'RAAAAAAAAAAGE', 2011, 3),
(3, 'DOOM', 1, 'DOOOOOOOOOOOOOOOOOOOOOOM', 1990, 1),
(4, 'Risk of Rain 2', 4, 'You gun die son', 2018, 4),
(5, 'Half Life', 2, 'HELLO FREEMAN', 1997, 1),
(44, 'Skyrim', 3, 'DOVAHKIN', 2011, 2),
(1231574118, 'Deus Ex', 675968084, 'OLD MEN', 1997, 2);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(5) NOT NULL,
  `catName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `catName`) VALUES
(1, 'FPS'),
(2, 'RPG'),
(3, 'Adventure'),
(4, 'Indie');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uName` varchar(100) NOT NULL,
  `pWord` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uName`, `pWord`) VALUES
('%', 'myPassword'),
('test', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gId`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
