-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 29 août 2023 à 20:37
-- Version du serveur : 8.0.32
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pokemonzoo`
--
CREATE DATABASE IF NOT EXISTS `pokemonzoo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pokemonzoo`;

-- --------------------------------------------------------

--
-- Structure de la table `fences`
--

DROP TABLE IF EXISTS `fences`;
CREATE TABLE IF NOT EXISTS `fences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nameFence` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `cleanliness` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `background` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `population` int NOT NULL,
  `zoo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zoo_id` (`zoo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fences`
--

INSERT INTO `fences` (`id`, `nameFence`, `cleanliness`, `type`, `background`, `population`, `zoo_id`) VALUES
(33, 'Reserve', 'Correct', 'Reserve', 'images/reserve.jpg', 0, 6),
(34, 'Enclos de la poiscaille', 'Propre', 'Aquarium', 'images/aquarium.jpg', 2, 6),
(35, 'Forêt', 'Propre', 'Forest', 'images/forest.jpg', 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `pokemons`
--

DROP TABLE IF EXISTS `pokemons`;
CREATE TABLE IF NOT EXISTS `pokemons` (
  `idPokemon` int NOT NULL AUTO_INCREMENT,
  `age` int NOT NULL,
  `sex` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `weight` int NOT NULL,
  `height` int NOT NULL,
  `health` int NOT NULL DEFAULT '100',
  `hungry` tinyint(1) NOT NULL,
  `sleepy` tinyint(1) NOT NULL,
  `sleeping` tinyint(1) NOT NULL,
  `sick` tinyint(1) NOT NULL,
  `species_id` int NOT NULL,
  `fence_id` int DEFAULT NULL,
  PRIMARY KEY (`idPokemon`),
  KEY `fence_id` (`fence_id`),
  KEY `species_id` (`species_id`)
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pokemons`
--

INSERT INTO `pokemons` (`idPokemon`, `age`, `sex`, `weight`, `height`, `health`, `hungry`, `sleepy`, `sleeping`, `sick`, `species_id`, `fence_id`) VALUES
(180, 6, 'female', 10, 50, 100, 0, 0, 0, 0, 8, 34),
(182, 6, 'male', 8, 70, 100, 0, 0, 1, 0, 14, 35),
(183, 6, 'female', 20, 99, 100, 0, 0, 0, 0, 7, 34);

-- --------------------------------------------------------

--
-- Structure de la table `species`
--

DROP TABLE IF EXISTS `species`;
CREATE TABLE IF NOT EXISTS `species` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `diet` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `Type1` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `Type2` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `species`
--

INSERT INTO `species` (`id`, `name`, `diet`, `Type1`, `Type2`, `avatar`) VALUES
(5, 'Carapuce', 'Végétarien', 'Eau', NULL, 'images/carapuce.gif'),
(6, 'Salamèche', 'Carnivore', 'Feu', NULL, 'images/salamèche.gif'),
(7, 'Psykokwak', 'Végétarien', 'Eau', NULL, 'images/psykokwak.gif'),
(8, 'Carabaffe', 'Végétarien', 'Eau', NULL, 'images/carabaffe.gif'),
(9, 'Tortank', 'Omnivore', 'Eau', NULL, 'images/tortank.gif'),
(10, 'Reptincel', 'Carnivore', 'Feu', NULL, 'images/reptincel.gif'),
(11, 'Dracaufeu', 'Carnivore', 'Feu', 'Vol', 'images/dracaufeu.gif'),
(12, 'Akwakwak', 'Carnivore', 'Eau', NULL, 'images/akwakwak.gif'),
(13, 'Bulbizarre', 'Végétarien', 'Plante', 'Poison', 'images/bulbizarre.gif'),
(14, 'Herbizarre', 'Végétarien', 'Plante', 'Poison', 'images/herbizarre.gif'),
(15, 'Florizarre', 'Végétarien', 'Plante', 'Poison', 'images/florizarre.gif'),
(16, 'Chenipan', 'Végétarien', 'Insecte', NULL, 'images/chenipan.gif'),
(17, 'Chrysacier', 'Végétarien', 'Insecte', NULL, 'images/chrysacier.gif'),
(18, 'Papilusion', 'Omnivore', 'Insecte', 'Vol', 'images/papilusion.gif');

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nameEmployee` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `age` int NOT NULL,
  `sex` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `zoo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zoo_id` (`zoo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `staff`
--

INSERT INTO `staff` (`id`, `nameEmployee`, `age`, `sex`, `zoo_id`) VALUES
(6, 'Robert', 20, 'male', 6);

-- --------------------------------------------------------

--
-- Structure de la table `zoo`
--

DROP TABLE IF EXISTS `zoo`;
CREATE TABLE IF NOT EXISTS `zoo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nameZoo` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `numberMaxFences` int NOT NULL,
  `pokedollars` int NOT NULL,
  `time` int NOT NULL,
  `popularity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `zoo`
--

INSERT INTO `zoo` (`id`, `nameZoo`, `password`, `numberMaxFences`, `pokedollars`, `time`, `popularity`) VALUES
(6, 'Zoo de Roanne', '$2y$10$WyPP3Ik4vNh0qwOVeYmkmeYM7ugHV94MW4.rivSo4nqd766.Yg9S.', 4, 1, 6, 75);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fences`
--
ALTER TABLE `fences`
  ADD CONSTRAINT `fence_of_zoo` FOREIGN KEY (`zoo_id`) REFERENCES `zoo` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pokemons`
--
ALTER TABLE `pokemons`
  ADD CONSTRAINT `fence_of_animal` FOREIGN KEY (`fence_id`) REFERENCES `fences` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `species_of_animal` FOREIGN KEY (`species_id`) REFERENCES `species` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `zoo_of_staff` FOREIGN KEY (`zoo_id`) REFERENCES `zoo` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
