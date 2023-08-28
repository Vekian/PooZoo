-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Aug 25, 2023 at 11:05 AM
-- Server version: 10.6.12-MariaDB-1:10.6.12+maria~ubu2004-log
-- PHP Version: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PokemonZoo`
--
CREATE DATABASE IF NOT EXISTS `PokemonZoo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `PokemonZoo`;

-- --------------------------------------------------------

--
-- Table structure for table `fences`
--

CREATE TABLE `fences` (
  `id` int(11) NOT NULL,
  `nameFence` varchar(30) NOT NULL,
  `cleanliness` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `background` varchar(50) NOT NULL,
  `population` int(11) NOT NULL,
  `zoo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fences`
--

INSERT INTO `fences` (`id`, `nameFence`, `cleanliness`, `type`, `background`, `population`, `zoo_id`) VALUES
(1, 'Reserve', 'Propre', 'Reserve', 'images/reserve.jpg', 5, 1),
(5, 'Enclos des carapuces', 'Propre', 'Aquarium', 'images/aquarium.jpg', 4, 1),
(6, 'Enclos des salamèches', 'Propre', 'Normal', 'images/normal.jpg', 2, 1),
(19, 'Forêt de BourgPalette', 'Propre', 'Forest', 'images/forest.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pokemons`
--

CREATE TABLE `pokemons` (
  `id` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `health` int(11) NOT NULL DEFAULT 100,
  `hungry` tinyint(1) NOT NULL,
  `sleepy` tinyint(1) NOT NULL,
  `sick` tinyint(1) NOT NULL,
  `species_id` int(11) NOT NULL,
  `fence_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pokemons`
--

INSERT INTO `pokemons` (`id`, `age`, `sex`, `weight`, `height`, `health`, `hungry`, `sleepy`, `sick`, `species_id`, `fence_id`) VALUES
(9, 4, 'male', 8, 50, 100, 0, 0, 0, 5, 5),
(10, 2, 'female', 4, 25, 100, 0, 0, 0, 5, 5),
(12, 0, 'female', 3, 10, 100, 0, 0, 0, 5, 5),
(14, 0, 'female', 2, 12, 100, 0, 0, 0, 6, 6),
(21, 0, 'male', 7, 15, 100, 0, 0, 0, 7, 5),
(23, 0, 'female', 3, 10, 100, 0, 0, 0, 5, 1),
(24, 0, 'female', 2, 12, 100, 0, 0, 0, 6, 6),
(26, 0, 'female', 7, 15, 100, 1, 0, 0, 7, 1),
(29, 0, 'female', 3, 10, 100, 0, 0, 0, 5, 1),
(30, 0, 'female', 7, 15, 100, 1, 1, 0, 7, 1),
(31, 0, 'male', 3, 10, 100, 1, 1, 0, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `species`
--

CREATE TABLE `species` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `diet` varchar(30) NOT NULL,
  `Type1` varchar(30) NOT NULL,
  `Type2` varchar(30) DEFAULT NULL,
  `avatar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `species`
--

INSERT INTO `species` (`id`, `name`, `diet`, `Type1`, `Type2`, `avatar`) VALUES
(5, 'Carapuce', 'Végétarien', 'Eau', NULL, 'images/carapuce.gif'),
(6, 'Salamèche', 'Carnivore', 'Feu', NULL, 'images/salamèche.gif'),
(7, 'Psykokwak', 'Végétarien', 'Eau', NULL, 'images/psykokwak.gif');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `nameEmployee` varchar(40) NOT NULL,
  `age` int(3) NOT NULL,
  `sex` varchar(15) NOT NULL,
  `zoo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `nameEmployee`, `age`, `sex`, `zoo_id`) VALUES
(2, 'Sasha', 15, 'male', 1);

-- --------------------------------------------------------

--
-- Table structure for table `zoo`
--

CREATE TABLE `zoo` (
  `id` int(11) NOT NULL,
  `nameZoo` varchar(50) NOT NULL,
  `numberMaxFences` int(11) NOT NULL,
  `pokedollars` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `popularity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zoo`
--

INSERT INTO `zoo` (`id`, `nameZoo`, `numberMaxFences`, `pokedollars`, `time`, `popularity`) VALUES
(1, 'BourgPalette Zoo', 4, 100, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fences`
--
ALTER TABLE `fences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zoo_id` (`zoo_id`);

--
-- Indexes for table `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fence_id` (`fence_id`),
  ADD KEY `species_id` (`species_id`);

--
-- Indexes for table `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zoo_id` (`zoo_id`);

--
-- Indexes for table `zoo`
--
ALTER TABLE `zoo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fences`
--
ALTER TABLE `fences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `species`
--
ALTER TABLE `species`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zoo`
--
ALTER TABLE `zoo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fences`
--
ALTER TABLE `fences`
  ADD CONSTRAINT `fence_of_zoo` FOREIGN KEY (`zoo_id`) REFERENCES `zoo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pokemons`
--
ALTER TABLE `pokemons`
  ADD CONSTRAINT `fence_of_animal` FOREIGN KEY (`fence_id`) REFERENCES `fences` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `species_of_animal` FOREIGN KEY (`species_id`) REFERENCES `species` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `zoo_of_staff` FOREIGN KEY (`zoo_id`) REFERENCES `zoo` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
