-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 06:39 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itemtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `id` int(8) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `desc` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`id`, `username`, `name`, `code`, `image`, `desc`, `price`) VALUES
(80, 'MickeyTheMouse', 'Women Uniqlo Dress Size M', '0608820faa55afd16a6250d0781353b0', 'product/0608820faa55afd16a6250d0781353b020221114162537153347_6.jpg', 'Uniqlo Dress M size suitable for slim girls :)', 20.00),
(81, 'MickeyTheMouse', 'Uniqlo Casual T', 'cd23bfa1a6df4f23ffb604b7aed6f785', 'product/cd23bfa1a6df4f23ffb604b7aed6f78520221114162537075313.jpg', 'Uniqlo Casual T-shirt S size feels very comfy ', 10.00),
(83, 'MickeyTheMouse', 'Keith Cross Over Shirt', '52357e32b080be666d93a3a95465ee92', 'product/52357e32b080be666d93a3a95465ee9220221114162537090978.jpg', 'Keith x Uniqlo Shirt Size XS', 20.00),
(84, 'MickeyTheMouse', 'Sweater Unbrand', '057864d440c7546a5556a5d3234326a3', 'product/057864d440c7546a5556a5d3234326a320221114162537324034.jpg', 'Dk brought from where, but size M looks nice & comfy', 7.00),
(85, 'MickeyTheMouse', 'HLA Sweater', '6bbdd4233d490cc08ee37ee9cf5de45b', 'product/6bbdd4233d490cc08ee37ee9cf5de45b20221114162537340507.jpg', 'Green Green Sweater Size M ', 12.00),
(86, 'MickeyTheMouse', 'T shirt', '49c04a9eac2918330e690b3ee7a60e7f', 'product/49c04a9eac2918330e690b3ee7a60e7f20221114162537355819.jpg', 'Used T Shirt Size M unbranded', 5.00),
(87, 'MickeyTheMouse', 'Elephant T', '2e03b9455dc1b913a7b0393d94012e80', 'product/2e03b9455dc1b913a7b0393d94012e8020221114162537090379_2.jpg', 'Women T- Shirt Size XXS', 10.00),
(88, 'MickeyTheMouse', 'Big Head Mickey T', '4c2b5295aedd97f79c0b4a3e507aea66', 'product/4c2b5295aedd97f79c0b4a3e507aea6620221114162537106572_3.jpg', 'Uniqlo X Mickey Size L', 13.00),
(89, 'MickeyTheMouse', 'Black Mini Skirt', 'a102ffd31ddd5def82494506221b6b04', 'product/a102ffd31ddd5def82494506221b6b0420221114162537153166_6.jpg', 'Cotton On Skirt Size M', 25.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
