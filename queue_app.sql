-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 31 Oct 2017 la 10:31
-- Versiune server: 5.7.17-log
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queue_app`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `customer_title`
--

CREATE TABLE `customer_title` (
  `id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `customer_title`
--

INSERT INTO `customer_title` (`id`, `Title`) VALUES
(1, 'Dr.'),
(2, 'Mr.'),
(3, 'Mrs.'),
(4, 'Ms.'),
(5, 'Prof.'),
(6, 'Sr.'),
(7, 'St.');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `customer_type`
--

CREATE TABLE `customer_type` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `customer_type`
--

INSERT INTO `customer_type` (`id`, `Name`) VALUES
(1, 'Citizen'),
(2, 'Organization'),
(3, 'Anonymous');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `queue_list`
--

CREATE TABLE `queue_list` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `service_id` int(11) NOT NULL,
  `customer_type_id` int(11) NOT NULL,
  `customer_title_id` int(11) DEFAULT NULL,
  `queued_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `services`
--

INSERT INTO `services` (`id`, `Name`) VALUES
(1, 'Housing'),
(2, 'Benefits'),
(3, 'Council Tax'),
(4, 'Fly-tipping'),
(5, 'Missed Bin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_title`
--
ALTER TABLE `customer_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue_list`
--
ALTER TABLE `queue_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_type_fk` (`customer_type_id`),
  ADD KEY `customer_title_fk` (`customer_title_id`),
  ADD KEY `service_fk` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_title`
--
ALTER TABLE `customer_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `queue_list`
--
ALTER TABLE `queue_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `queue_list`
--
ALTER TABLE `queue_list`
  ADD CONSTRAINT `customer_title_fk` FOREIGN KEY (`customer_title_id`) REFERENCES `customer_title` (`id`),
  ADD CONSTRAINT `customer_type_fk` FOREIGN KEY (`customer_type_id`) REFERENCES `customer_type` (`id`),
  ADD CONSTRAINT `service_fk` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
