-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2021 at 04:17 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fswd14_cr11_petadoption_lauramoldovan`
--
CREATE DATABASE IF NOT EXISTS `fswd14_cr11_petadoption_lauramoldovan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fswd14_cr11_petadoption_lauramoldovan`;

-- --------------------------------------------------------

--
-- Table structure for table `adoption`
--

CREATE TABLE `adoption` (
  `id` int(11) NOT NULL,
  `a_date` date NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_pet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hobby` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `name`, `breed`, `size`, `location`, `description`, `hobby`, `age`, `picture`, `status`) VALUES
(1, 'Kitty', 'Cat', 'large', 'Burggasse 14', 'A beautiful brown female cat who is waiting to take her home.', 'Sleeping, eating, playing', 9, 'bigcat.jpg', 0),
(2, 'Tom', 'Cat', 'small', 'Praterstrasse 23', 'A beautiful striped little male cat who is waiting to take him home.', 'Sleeping, eating, playing', 1, 'lilcat.jpg', 0),
(3, 'Malty', 'Maltese Dog', 'large', 'Neustiftgasse 44', 'A beautiful white little female dog who is waiting to take her home.', 'Sleeping, eating, playing', 4, 'maltese.jpg', 1),
(4, 'Gino', 'French Buldog', 'large', 'Burggasse 14', 'A beautiful brown male french Buldog who is waiting to take him home.', 'Sleeping, eating, playing', 8, 'pug.jpg', 1),
(5, 'Goldie', 'Fightfish', 'small', 'Praterstrasse 23', 'A beautiful orange fightfish who is waiting to take him home.', 'Swimming, eating, fighting', 1, 'fish.jpg', 0),
(6, 'Guy', 'Guineea pig', 'small', 'Neustiftgasse 44', 'A beautiful white/brown little male Guineea Pig who is waiting to take him home.', 'Sleeping, eating, playing', 3, 'guinea-pig.jpg', 0),
(7, 'Moussie', 'Hamster', 'small', 'Burggasse 14', 'A beautiful brown/white male Hamster who is waiting to take him home.', 'Running, eating, playing', 2, 'hamster.jpg', 1),
(8, 'Stela', 'Horse', 'large', 'Praterstrasse 23', 'A beautiful white female horse who is waiting to take her home.', 'Running, eating, Sleeping', 7, 'horse.jpg', 0),
(9, 'Dany', 'Iguana', 'small', 'Neustiftgasse 44', 'A beautiful green female Iguana who is waiting to take her home.', 'Sleeping, eating, playing', 9, 'iguana.jpg', 1),
(10, 'Paully', 'Parrot', 'small', 'Burggasse 14', 'A beautiful colorfull male Parrot who is waiting to take him home.', 'Talking, eating, playing', 2, 'parrot.jpg', 1),
(11, 'Bunny', 'Rabbit', 'small', 'Praterstrasse 23', 'A beautiful female rabbit who is waiting to take her home.', 'Running, eating, sleeping', 10, 'rabbit.jpg', 1),
(12, 'Spidey', 'Tarantula', 'small', 'Neustiftgasse 44', 'A beautiful female Tarantula who is waiting to take her home.', 'Sleeping, eating, playing', 5, 'tarantula.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(512) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `password`, `email`, `address`, `phone`, `picture`, `status`) VALUES
(1, 'Laura', 'Moldovan', 'LauraM', 'laura.duduma@gmail.com', 'Romania, Oravita, 6790, Andrei Saguna, 32', '+40 765 322 590', 'laura.jpg', 'user'),
(2, 'Britney', 'Spears', 'Brit.S', 'britney@gmail.com', 'U.S.A., Los Angeles, 4327, Heaven Street, 77/7', '+1 207-200 3904', 'britney.jpg', 'user'),
(3, 'Beyonce', 'Knowless', 'QueenB', 'beyonce@gmail.com', 'France, Paris, 5577, Champ d\'Elisee, 3/2/7', '+33 677 85 49 754', 'beyonce.jpg', 'user'),
(4, 'Sebastian', 'Kurz', 'BastiK', 'seby.kurz@gmail.com', 'Austria, Vienna, 1150, Neubaugürtel, 19/14', '+43 660 85 39 704', 'kurz.jpg', 'user'),
(5, 'Channing', 'Tatum', 'MagicMike', 'channing@gmail.com', 'U.S.A., Beverly Hills, 90210, Brenda & Brandon, 12/4', '+1 207-200 4455', 'tatum.jpg', 'user'),
(6, 'Vladimir', 'Putin', 'VladP', 'vladimir@gmail.com', 'Rusia, Moscow, 9099, Kokoshnik, 33/3', '+7 333 44 55 666', 'putin.jpg', 'user'),
(7, 'Jackye', 'Chan', 'KungFu', 'karate@gmail.com', 'Japan, Tokyo, 5465, Driffting Street, 8/2', '+81 555 85 39 009', 'jchan.jpg', 'user'),
(8, 'Jay', 'Z', 'Jay-Z', 'jay_z@gmail.com', 'France, Paris, 5577, Champ d\'Elisee, 3/2/1', '+33 677 95 77 904', 'jayz.jpg', 'user'),
(9, 'Dominic', 'Moldovan', 'DomM', 'domm@gmail.com', 'Romania, Oravita, 6790, Andrei Saguna, 38', '+40 765 322 590', 'dominic.jpg', 'user'),
(10, 'Stana', 'Izbasa', 'SteauaR', 's.izbasa@gmail.com', 'Romania, Timisoara, 23980, Brancoveanu, 42/5/7', '+40 721 85 66 95', 'stana.jpg', 'user'),
(11, 'Dragana', 'Mirkovic', 'DragaM', 'dm@gmail.com', 'Austria, Vienna, 1100 Brunnweg, 4/10/8', '+43 660 85 39 704', 'dragam.jpg', 'user'),
(12, 'William', 'Shakespeare', 'WillyBoy', 'shakespeare@gmail.com', 'Germany, Berlin, 8990, Burggasse, 22/3', '+49 443 89 59 994', 'willy.jpg', 'user'),
(13, 'Gheorghe', 'Zamfir', '16fe1a32824818d30fa36e08e5aec435b1144dcee4670cdfced41ba7cdcf4c1b', 'gheorghe@gmail.com', 'Racasdia 341', '+40 721 85 66 95', '61985d52667c3.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adoption`
--
ALTER TABLE `adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`),
  ADD KEY `fk_pet` (`fk_pet`);

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adoption`
--
ALTER TABLE `adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adoption`
--
ALTER TABLE `adoption`
  ADD CONSTRAINT `adoption_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `adoption_ibfk_2` FOREIGN KEY (`fk_pet`) REFERENCES `animals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
