-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 24 juin 2020 à 11:46
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `codflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Horreur'),
(3, 'Science-Fiction');

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `finish_date` datetime DEFAULT NULL,
  `watch_duration` int(11) NOT NULL DEFAULT 0 COMMENT 'in seconds'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `trailer_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `genre_id`, `title`, `type`, `status`, `release_date`, `summary`, `trailer_url`) VALUES
(1, 3, 'Star Wars, épisode I : La Menace fantôme', 'Film', 'Média publié', '1999-10-13', 'Avant de devenir un célèbre chevalier Jedi, et bien avant de se révéler l\'âme la plus noire de la galaxie, Anakin Skywalker est un jeune esclave sur la planète Tatooine. La Force est déjà puissante en lui et il est un remarquable pilote de Podracer. Le maître Jedi Qui-Gon Jinn le découvre et entrevoit alors son immense potentiel. Pendant ce temps, l\'armée de droïdes de l\'insatiable Fédération du Commerce a envahi Naboo dans le cadre d\'un plan secret des Sith visant à accroître leur pouvoir.', 'https://www.youtube.com/embed/utFSzR0r-20'),
(2, 2, 'L\'Exorciste', 'Film', 'Média publié', '1974-09-11', 'Regan, âgée de 12 ans, souffre d\'inquiétants troubles du comportement. Après de nombreux examens médicaux, sa mère Chris MacNeil sollicite l\'aide d\'un jeune prête psychiatre, le Père Karras qui lui apprend que la jeune fille est possédée par le diable. Avec l\'aide de son confrère le père Merrin, il va se lancer dans des séances d\'exorcisme d\'une incroyable intensité...', 'https://www.youtube.com/embed/kuowPVqvnRk'),
(3, 1, 'Peaky Blinders', 'Série', 'En production', '2013-09-12', 'Birmingham, en 1919. Un gang familial règne sur un quartier de la ville : les Peaky Blinders, ainsi nommés pour les lames de rasoir qu\'ils cachent dans la visière de leur casquette.', 'https://www.youtube.com/embed/oVzVdvGIC7U');

-- --------------------------------------------------------

--
-- Structure de la table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `saison` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `name` varchar(254) CHARACTER SET latin1 NOT NULL,
  `summary` longtext CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `duration` time NOT NULL,
  `url` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `series`
--

INSERT INTO `series` (`id`, `serie_id`, `saison`, `episode`, `name`, `summary`, `duration`, `url`) VALUES
(1, 3, 1, 1, 'Episode 1', 'L\'ambitieux chef de gang Thomas Shelby tombe sur une caisse d\'armes égarée et saute sur l\'occasion pour renforcer son emprise sur la pègre de Birmingham.', '00:57:07', 'https://www.youtube.com/embed/OgtBFgqC1KQ'),
(2, 3, 1, 2, 'Episode 2', 'Thomas provoque un gros bonnet local en truquant une course hippique et se met à dos une famille gitane. L\'inspecteur Chester Campbell prend la tête d\'un raid brutal.', '00:58:00', 'https://www.youtube.com/embed/cK9QjvEY7Xo'),
(3, 3, 2, 1, 'Episode 1', 'Quand son pub fétiche est détruit par une bombe, Tommy Shelby, chef de gang de Birmingham, se voit forcé d\'assassiner un dissident irlandais.', '00:59:05', 'https://www.youtube.com/embed/Rde7qsxUCNY'),
(4, 3, 2, 2, 'Episode 2', 'Après avoir assassiné un dissident irlandais, Tommy devient bien malgré lui un pion dans le jeu politique retors de l\'inspecteur Campbell.', '00:57:40', 'https://www.youtube.com/embed/baqrqWBzaHw'),
(5, 3, 2, 3, 'Episode 3', 'Après être devenu le partenaire en affaires du chef de gang londonien Alfie Solomons, Tommy craint que l\'instabilité d\'Alfie ne pose problème.', '00:58:46', 'https://www.youtube.com/embed/qkW29nMKoEc');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(80) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `isActive`) VALUES
(13, 'roman.clavier.2001@gmail.com', '123', 1),
(14, 'coding@gmail.com', '123456', 1),
(15, 'crabou@gmail.com', 'a', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_user_id_fk_media_id` (`user_id`),
  ADD KEY `history_media_id_fk_media_id` (`media_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_genre_id_fk_genre_id` (`genre_id`) USING BTREE;

--
-- Index pour la table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_media_serie_id` (`serie_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_media_id_fk_media_id` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_user_id_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_genre_id_b1257088_fk_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);

--
-- Contraintes pour la table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `fk_media_serie_id` FOREIGN KEY (`serie_id`) REFERENCES `media` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
