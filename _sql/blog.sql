-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 03 Décembre 2018 à 17:03
-- Version du serveur :  5.7.24-0ubuntu0.16.04.1
-- Version de PHP :  7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog_articles`
--

CREATE TABLE `blog_articles` (
  `art_id` int(10) UNSIGNED NOT NULL,
  `art_fk_user_id` int(10) UNSIGNED NOT NULL,
  `art_date_publi` datetime NOT NULL,
  `art_title` varchar(45) NOT NULL,
  `art_content` mediumtext NOT NULL,
  `art_picture` varchar(255) DEFAULT NULL,
  `art_tags` varchar(255) DEFAULT NULL,
  `art_status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `blog_articles`
--

INSERT INTO `blog_articles` (`art_id`, `art_fk_user_id`, `art_date_publi`, `art_title`, `art_content`, `art_picture`, `art_tags`, `art_status`) VALUES
(1, 24, '2018-12-02 00:00:00', 'jtghdf', 'hdxhh', 'vyhvgkhbggk', NULL, 0),
(2, 24, '2018-12-02 00:00:00', 'jtghdf', 'hdxhh', 'vyhvgkhbggk', '', 0),
(3, 24, '2018-11-30 00:00:00', 'Salut', 'cdcfqvzq', 'vyhvgkhbggk', '', 0),
(4, 24, '2018-12-05 00:00:00', 'fr"af"', 'vfrae', 'vyhvgkhbggk', '#tag', 0),
(5, 24, '2018-11-15 00:00:00', 'bkjbk', 'bviyhviyk', 'vyhvgkhbggk', 'bk', 0),
(6, 25, '2018-12-04 00:00:00', 'fFV', 'VD', '', 'VDS', 0),
(7, 25, '2018-12-04 00:00:00', 'FZQGQ', 'VZQFZ', '', 'VZQ', 0),
(8, 25, '2018-12-04 00:00:00', 'bonjour', 'vdsvds', '/tmp/phpAM41pu', 'vds', 0),
(9, 25, '2018-12-14 00:00:00', 'vezqv', 'vqezc', '', 'cdzcdz', 0),
(10, 25, '2018-12-08 00:00:00', 'bgesvews', 'vewqgb', '', 'berwqg', 0),
(11, 25, '2018-12-07 00:00:00', ' fsw', 'vfdw', '', 'vfdwq', 0),
(12, 25, '2018-12-07 00:00:00', ' fsw', 'vfdw', '', 'vfdwq', 0),
(13, 25, '2018-12-07 00:00:00', ' fsw', 'vfdw', '', 'vfdwq', 0),
(14, 25, '2018-12-07 00:00:00', 'czdqcf', 'CZCeA', '', 'CEAZCVZ', 0),
(15, 25, '2018-12-07 00:00:00', 'vzqf', 'veqsrveqs', '', 'vfeqsve', 0),
(16, 25, '2018-12-14 00:00:00', 'besvq', 'vfesqebv', '', 'vfesbfe', 0),
(17, 25, '2018-12-07 00:00:00', 'brh', 'rhndeh', '/tmp/phpv1nYLq', 'hreh', 0),
(18, 25, '2018-12-13 00:00:00', 'zcvqfe', 'czc', '../upload/image_zcvqfe.jpg', 'cvzqcv', 0);

-- --------------------------------------------------------

--
-- Structure de la table `blog_articles_has_blog_categories`
--

CREATE TABLE `blog_articles_has_blog_categories` (
  `blog_articles_art_id` int(10) UNSIGNED NOT NULL,
  `blog_categories_cat_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `blog_articles_has_blog_categories`
--

INSERT INTO `blog_articles_has_blog_categories` (`blog_articles_art_id`, `blog_categories_cat_id`) VALUES
(16, 2),
(18, 2),
(14, 3),
(17, 3);

-- --------------------------------------------------------

--
-- Structure de la table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `cat_id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_ordre` int(11) DEFAULT NULL,
  `cat_fk_cat_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `blog_categories`
--

INSERT INTO `blog_categories` (`cat_id`, `cat_name`, `cat_ordre`, `cat_fk_cat_id`) VALUES
(2, 'Humour', NULL, NULL),
(3, 'Chiens', NULL, NULL),
(4, 'Chats', NULL, NULL),
(5, 'Lapins', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `blog_commentaires`
--

CREATE TABLE `blog_commentaires` (
  `com_id` int(10) UNSIGNED NOT NULL,
  `com_fk_art_id` int(10) UNSIGNED NOT NULL,
  `com_content` varchar(45) NOT NULL,
  `com_date_publi` datetime NOT NULL,
  `com_email` varchar(255) NOT NULL,
  `com_username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `blog_user`
--

CREATE TABLE `blog_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_nom` varchar(50) NOT NULL,
  `user_prenom` varchar(50) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_bio` tinytext,
  `user_avatar` varchar(255) DEFAULT NULL,
  `user_username` varchar(20) DEFAULT NULL,
  `user_roles` varchar(40) NOT NULL DEFAULT 'auteur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `blog_user`
--

INSERT INTO `blog_user` (`user_id`, `user_nom`, `user_prenom`, `user_email`, `user_password`, `user_bio`, `user_avatar`, `user_username`, `user_roles`) VALUES
(17, 'Selles', 'Fabien', 'fab@alti-com.fr', '$2y$10$fj6omSaEvv7za8vtDZ3FeuVOVzbz7uORknjfeq5Ie7Sqqif1jXZUS', '', NULL, 'fab', 'auteur'),
(18, '', '', '', '$2y$10$a5lz/0QB9BnkUVP5z.lRCObGTEp10/vj.MbU.Hv8ZwEGBD.PkMFsm', '', NULL, '', 'auteur'),
(20, 'vbgruei', 'bjcezoœ', 'cnez@vreg.hf', '$2y$10$TR59slAQt8CWqLuIv/9AHuO33hSIVdHLHs1bZtKq71JnbzdFL2rwi', 'vreo', NULL, 'bvzo', 'auteur'),
(21, 'tzh', ',ufkj', 'vbyhiq@cvI.fr', '$2y$10$0.otgnecBShCdKFbnbN4k.SvG.MM0.BCM5mZ8wCTjQQBjs4AQ60uW', 'vgyigiy', NULL, 'htnrht', 'auteur'),
(22, 'vrefqvrq', 'vqervq', 'vfes@cgyuezqguzy.fr', '$2y$10$3ui6fOQziK2zir2koRS7s.Um.NiZuczWiyhzDmD1tagRd28k93Ngi', 'vrezqv', NULL, 'vrfeqsv', 'auteur'),
(23, 'leopold', 'sandy', 'bdeiz@biez.fr', '$2y$10$QlHOpvuhU/03tPjCilHl5uov7LBPgAzpQw0rPJ2M/9FkwCrdYRMEG', 'salut', NULL, 'sand', 'auteur'),
(24, 'leopold', 'sandy', 'root@gmail.com', '$2y$10$.qrpNvyNm8/JP4rSqMOmLex4pf3ax/eG1j8q3C52oWVMYrl3p1Rn2', 'salut', NULL, 'sand', 'auteur'),
(25, 'LAGORGETTE', 'Elora', 'elo@gmail.com', '$2y$10$yaVKm1IBSQU5KozdSW2zyOvPyKNBp/mNRjp9nEW3s6D3SastfvnzC', 'bvrjuibhoquehbnoerq', NULL, 'Elo', 'auteur');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `blog_articles`
--
ALTER TABLE `blog_articles`
  ADD PRIMARY KEY (`art_id`),
  ADD KEY `fk_articles_auteurs_idx` (`art_fk_user_id`);

--
-- Index pour la table `blog_articles_has_blog_categories`
--
ALTER TABLE `blog_articles_has_blog_categories`
  ADD PRIMARY KEY (`blog_articles_art_id`,`blog_categories_cat_id`),
  ADD KEY `fk_blog_articles_has_blog_categories_blog_categories1_idx` (`blog_categories_cat_id`),
  ADD KEY `fk_blog_articles_has_blog_categories_blog_articles1_idx` (`blog_articles_art_id`);

--
-- Index pour la table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `fk_blog_categories_blog_categories1_idx` (`cat_fk_cat_id`);

--
-- Index pour la table `blog_commentaires`
--
ALTER TABLE `blog_commentaires`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `fk_commentaires_articles1_idx` (`com_fk_art_id`);

--
-- Index pour la table `blog_user`
--
ALTER TABLE `blog_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`user_email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `blog_articles`
--
ALTER TABLE `blog_articles`
  MODIFY `art_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `cat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `blog_commentaires`
--
ALTER TABLE `blog_commentaires`
  MODIFY `com_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `blog_user`
--
ALTER TABLE `blog_user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `blog_articles`
--
ALTER TABLE `blog_articles`
  ADD CONSTRAINT `fk_articles_auteurs` FOREIGN KEY (`art_fk_user_id`) REFERENCES `blog_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `blog_articles_has_blog_categories`
--
ALTER TABLE `blog_articles_has_blog_categories`
  ADD CONSTRAINT `fk_blog_articles_has_blog_categories_blog_articles1` FOREIGN KEY (`blog_articles_art_id`) REFERENCES `blog_articles` (`art_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_blog_articles_has_blog_categories_blog_categories1` FOREIGN KEY (`blog_categories_cat_id`) REFERENCES `blog_categories` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD CONSTRAINT `fk_blog_categories_blog_categories1` FOREIGN KEY (`cat_fk_cat_id`) REFERENCES `blog_categories` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `blog_commentaires`
--
ALTER TABLE `blog_commentaires`
  ADD CONSTRAINT `fk_commentaires_articles1` FOREIGN KEY (`com_fk_art_id`) REFERENCES `blog_articles` (`art_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
