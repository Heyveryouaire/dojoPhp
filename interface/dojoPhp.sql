-- phpMyAdmin SQL Dump
-- version 4.9.4deb4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 30 mars 2020 à 09:22
-- Version du serveur :  5.7.29-0ubuntu0.18.04.1
-- Version de PHP : 7.3.16-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dojoPhp`
--

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE `Article` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `content` varchar(250) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Article`
--

INSERT INTO `Article` (`id`, `titre`, `content`, `date`, `statut`) VALUES
(1, 'Le coronavirus n\'est qu\'un abominable mensonge', 'On s\'est bien foutu de notre gueule pour augmenter nos impots lol', '2020-03-24', 1),
(2, 'Vive le gazon', 'Et si on allait couper la pelouse ? ', '2020-03-17', 1),
(8, 'La crise', 'C\'est l\'histoire de la crise qui commence avec un simple &lt;script&gt;alert(&quot;hello&quot;)&lt;/script&gt;\r\n\r\n            ', NULL, NULL),
(9, 'zdza', 'azdazd', '2020-03-26', NULL),
(10, 'salut les noobs', 'On s\'fait une action ?', '2020-03-27', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`id`, `nom`) VALUES
(1, 'FakeNews');

-- --------------------------------------------------------

--
-- Structure de la table `Commentaire`
--

CREATE TABLE `Commentaire` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `date` date NOT NULL,
  `id_Utilisateur` int(11) DEFAULT NULL,
  `id_Article` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Commentaire`
--

INSERT INTO `Commentaire` (`id`, `titre`, `content`, `date`, `id_Utilisateur`, `id_Article`) VALUES
(1, 'Pas d\'accord', 'Le coronavirus est belle est bien une maladie, j\'suis pas d\'accord avec ton article moisi', '2020-03-24', 1, 1),
(2, 'Lol', 'J\'ai trop aimé ton article sur le gazon, c\'était pas mal fait!', '2020-03-26', 1, 2),
(3, 'La grippe', 'C\'est quaismeent kiff kiff nan ?', '2020-03-17', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id`, `pseudo`, `email`, `password`, `role`) VALUES
(1, 'mat', 'mat@gmail.com', 'aa', 'user'),
(2, 'charle', 'email;cm', 'qq', 'admin'),
(7, 'jean', 'adresse.email@bidon.fr', '$2y$10$w4aiS5ryDJBi5rd1CJ4JgOic6DIkCKjkhpCUM5xt6HaqGFrAthRT6', 'user'),
(8, 'toto', 'adresse.email@bidon.fr', '$2y$10$dM6Die8z420qR3124ogKa.xBfKHMt4qmW0EGE6TbLxBX9h9/VS/yO', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Commentaire_Utilisateur_FK` (`id_Utilisateur`),
  ADD KEY `Commentaire_Article0_FK` (`id_Article`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD CONSTRAINT `Commentaire_Article0_FK` FOREIGN KEY (`id_Article`) REFERENCES `Article` (`id`),
  ADD CONSTRAINT `Commentaire_Utilisateur_FK` FOREIGN KEY (`id_Utilisateur`) REFERENCES `Utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
