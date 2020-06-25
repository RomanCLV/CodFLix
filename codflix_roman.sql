-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  jeu. 25 juin 2020 à 20:49
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
(3, 'Science-Fiction'),
(4, 'Adolescent');

-- --------------------------------------------------------

--
-- Structure de la table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `episode_id` int(11) DEFAULT NULL,
  `lastTimeOpened` timestamp NOT NULL DEFAULT current_timestamp(),
  `start_date` datetime DEFAULT NULL,
  `finish_date` datetime DEFAULT NULL,
  `watch_duration` int(11) NOT NULL DEFAULT 0 COMMENT 'in seconds'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `history`
--

INSERT INTO `history` (`id`, `user_id`, `media_id`, `episode_id`, `lastTimeOpened`, `start_date`, `finish_date`, `watch_duration`) VALUES
(4, 1, 3, 1, '2020-06-25 00:46:25', NULL, NULL, 0),
(5, 1, 1, NULL, '2020-06-25 09:48:22', NULL, NULL, 0),
(6, 1, 2, NULL, '2020-06-24 22:26:00', NULL, NULL, 0),
(7, 1, 3, 3, '2020-06-25 00:45:54', NULL, NULL, 0),
(8, 1, 3, 5, '2020-06-24 22:26:08', NULL, NULL, 0),
(9, 1, 3, 4, '2020-06-24 22:26:09', NULL, NULL, 0),
(10, 1, 3, 2, '2020-06-25 00:46:12', NULL, NULL, 0),
(23, 2, 3, 1, '2020-06-25 15:56:09', NULL, NULL, 0),
(25, 2, 1, NULL, '2020-06-25 15:56:14', NULL, NULL, 0);

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
  `duration` time DEFAULT NULL,
  `release_date` date NOT NULL,
  `summary` longtext NOT NULL,
  `trailer_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `genre_id`, `title`, `type`, `status`, `duration`, `release_date`, `summary`, `trailer_url`) VALUES
(1, 3, 'Star Wars, épisode I : La Menace fantôme', 'Film', 'Média publié', '02:16:00', '1999-10-13', 'Avant de devenir un célèbre chevalier Jedi, et bien avant de se révéler l\'âme la plus noire de la galaxie, Anakin Skywalker est un jeune esclave sur la planète Tatooine. La Force est déjà puissante en lui et il est un remarquable pilote de Podracer. Le maître Jedi Qui-Gon Jinn le découvre et entrevoit alors son immense potentiel. Pendant ce temps, l\'armée de droïdes de l\'insatiable Fédération du Commerce a envahi Naboo dans le cadre d\'un plan secret des Sith visant à accroître leur pouvoir.', 'https://www.youtube.com/embed/utFSzR0r-20'),
(2, 2, 'L\'Exorciste', 'Film', 'Média publié', '02:12:00', '1974-09-11', 'Regan, âgée de 12 ans, souffre d\'inquiétants troubles du comportement. Après de nombreux examens médicaux, sa mère Chris MacNeil sollicite l\'aide d\'un jeune prête psychiatre, le Père Karras qui lui apprend que la jeune fille est possédée par le diable. Avec l\'aide de son confrère le père Merrin, il va se lancer dans des séances d\'exorcisme d\'une incroyable intensité...', 'https://www.youtube.com/embed/kuowPVqvnRk'),
(3, 1, 'Peaky Blinders', 'Série', 'En production', NULL, '2013-09-12', 'Birmingham, en 1919. Un gang familial règne sur un quartier de la ville : les Peaky Blinders, ainsi nommés pour les lames de rasoir qu\'ils cachent dans la visière de leur casquette.', 'https://www.youtube.com/embed/oVzVdvGIC7U');

-- --------------------------------------------------------

--
-- Structure de la table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `saison` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `name` varchar(254) NOT NULL,
  `summary` longtext NOT NULL,
  `duration` time NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `series`
--

INSERT INTO `series` (`id`, `serie_id`, `saison`, `episode`, `name`, `summary`, `duration`, `url`) VALUES
(1, 3, 1, 1, 'Episode 1', 'L\'ambitieux chef de gang Thomas Shelby tombe sur une caisse d\'armes égarée et saute sur l\'occasion pour renforcer son emprise sur la pègre de Birmingham.', '00:02:07', 'https://www.youtube.com/embed/OgtBFgqC1KQ'),
(2, 3, 1, 2, 'Episode 2', 'Thomas provoque un gros bonnet local en truquant une course hippique et se met à dos une famille gitane. L\'inspecteur Chester Campbell prend la tête d\'un raid brutal.', '00:10:39', 'https://www.youtube.com/embed/cK9QjvEY7Xo'),
(3, 3, 2, 1, 'Episode 1', 'Quand son pub fétiche est détruit par une bombe, Tommy Shelby, chef de gang de Birmingham, se voit forcé d\'assassiner un dissident irlandais.', '00:01:52', 'https://www.youtube.com/embed/Rde7qsxUCNY'),
(4, 3, 2, 2, 'Episode 2', 'Après avoir assassiné un dissident irlandais, Tommy devient bien malgré lui un pion dans le jeu politique retors de l\'inspecteur Campbell.', '00:15:52', 'https://www.youtube.com/embed/baqrqWBzaHw'),
(5, 3, 2, 3, 'Episode 3', 'Après être devenu le partenaire en affaires du chef de gang londonien Alfie Solomons, Tommy craint que l\'instabilité d\'Alfie ne pose problème.', '00:17:45', 'https://www.youtube.com/embed/qkW29nMKoEc');

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
(1, 'roman.clavier.2001@gmail.com', '530fe0e0d55493c93d3140b0f8fc929323ec34a82ddeb60bbf5090e5e3b49b5e', 1),
(2, 'coding@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 0);

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
  ADD KEY `history_media_id_fk_media_id` (`media_id`),
  ADD KEY `history_episode_id_fk_series_id` (`episode_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_episode_id_fk_series_id` FOREIGN KEY (`episode_id`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
