-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mer. 29 juil. 2020 à 05:45
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `GBAF`
--

-- --------------------------------------------------------

--
-- Structure de la table `actor`
--

CREATE TABLE `actor` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `actor`
--

INSERT INTO `actor` (`id`, `name`, `description`, `filename`) VALUES
(1, 'Formation&co', 'Formation&co est une association française présente sur tout le territoire. <br /><br />\r\nNous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.<br /><br />\r\nNotre proposition :<br /><br />\r\n●	Un financement jusqu’à 30 000€ ;<br />\r\n●	Un suivi personnalisé et gratuit ;<br />\r\n●	Une lutte acharnée contre les freins sociétaux et les stéréotypes.<br /><br />\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… .<br /><br />\r\nNous collaborons avec des personnes talentueuses et motivées.<br /><br />\r\nVous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.\r\n', 'logo_formationco.png'),
(2, 'Protectpeople', 'Protectpeople finance la solidarité nationale. Nous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.<br /><br />\r\n\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.<br /><br />\r\nProectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.<br /><br />\r\nNous garantissons un accès aux soins et une retraite.<br /><br />\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.<br /><br />\r\nNotre mission est double :<br /><br />\r\n●	Sociale : nous garantissons la fiabilité des données sociales ;<br />\r\n●	Economique : nous apportons une contribution aux activités économiques.\r\n', 'logo_protectpeople.png'),
(3, 'DSA France', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.<br /><br />\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.<br /><br />\r\nNotre philosophie : s’adapter à chaque entreprise.<br /><br />\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.', 'logo_dsafrance.png'),
(4, 'CDE', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation.<br /><br />\r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.<br /><br />\r\n', 'logo_cde.png');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `actor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `created_at`, `actor_id`, `user_id`) VALUES
(5, 'test', '2020-07-16 11:39:44', 1, 1),
(6, 'test commentaire 170720201028', '2020-07-17 10:28:59', 2, 2),
(11, 'test commentaires', '2020-07-21 10:11:35', 4, 2),
(12, 'commentaires test\r\nBLA BLA BLA\r\nBLA BLA BLA\r\nBLA BLA BLA\r\nBLA BLA BLA\r\nBLA BLA BLA\r\nBLA BLA BLA\r\nBLA BLA BLA\r\n\r\n', '2020-07-21 10:22:29', 1, 2),
(13, 'test commentaires 2807', '2020-07-28 08:05:51', 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(70) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `lastname`, `firstname`, `username`, `password`, `question`, `answer`) VALUES
(1, 'THOMAS', 'stephane', 'ltexp1998', '$2y$10$MffgovBRyRHgYaqFC1CRb.yBk/cJnWl7eeaaaDJG/6Z7Pqad4ae9W', 'username', 'ltexp1998'),
(2, 'test', 'test', 'test', '$2y$10$ca28GkTeF/CyNHbrGaQZPuF4L02KaTHjpRZ.nJo/fNsDpL/4xSGIq', 'test', 'test'),
(3, 'nom', 'prenom', 'username', '$2y$10$wEG//CWLNRepBbOJV3PzTuslf3F8uyQseAzHaMuznF0i5YrEg.t/.', 'password', 'password'),
(5, 'test 2807 NOM', 'test 2807 PRENOM', 'test 2807', '$2y$10$pPE1NPpxKhqBfwucZAFap.Jb2NPPU98BL1./N61PkFH4kWIv1Pzp.', 'test test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `vote` tinyint(1) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id`, `vote`, `actor_id`, `user_id`) VALUES
(26, 1, 1, 2),
(27, 1, 2, 2),
(28, 0, 3, 2),
(29, 0, 4, 2),
(30, 0, 1, 3),
(31, 0, 2, 3),
(32, 1, 3, 3),
(33, 1, 4, 3),
(34, 1, 1, 1),
(35, 1, 1, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`,`actor_id`,`user_id`),
  ADD KEY `fk_gbaf_comment_gbaf_actor1_idx` (`actor_id`),
  ADD KEY `fk_gbaf_comment_gbaf_member1_idx` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`,`actor_id`,`user_id`),
  ADD KEY `fk_gbaf_vote_gbaf_actor1_idx` (`actor_id`),
  ADD KEY `fk_gbaf_vote_gbaf_member1_idx` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actor`
--
ALTER TABLE `actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_gbaf_comment_gbaf_actor1` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_gbaf_comment_gbaf_member1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `fk_gbaf_vote_gbaf_actor1` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_gbaf_vote_gbaf_member1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
