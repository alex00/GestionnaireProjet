-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 23 Janvier 2013 à 13:40
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `tzbase`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8_bin,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user_id`,`post_id`),
  KEY `fk_comments_users1` (`user_id`),
  KEY `fk_comments_posts1` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `date`, `user_id`, `post_id`) VALUES
(1, 'Il est nuullll ton poeme ! ', '2013-01-24 00:00:00', 1, 5),
(2, 'trop mignon !!!!', '2013-01-17 00:00:00', 5, 3),
(3, 'bitch. fais des meilleurs post', '2013-01-10 00:00:00', 1, 5),
(4, 'Bonjour,\r\ntrès intéressant votre article, j''ajouterai que je paye mes tits pour pas cher.', '2013-01-10 00:00:00', 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `content` text COLLATE utf8_bin,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user_id`),
  KEY `fk_posts_users` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `date`, `user_id`) VALUES
(1, 'Ceci est le premier post tavu', '<!-- start slipsum code -->\r\n\r\n<h1>No man, I don''t eat pork</h1>\r\n<p>Now that there is the Tec-9, a crappy spray gun from South Miami. This gun is advertised as the most popular gun in American crime. Do you believe that shit? It actually says that in the little book that comes with it: the most popular gun in American crime. Like they''re actually proud of that shit.  </p>\r\n\r\n<h1>I gotta piss</h1>\r\n<p>Now that there is the Tec-9, a crappy spray gun from South Miami. This gun is advertised as the most popular gun in American crime. Do you believe that shit? It actually says that in the little book that comes with it: the most popular gun in American crime. Like they''re actually proud of that shit.  </p>\r\n\r\n<h1>No man, I don''t eat pork</h1>\r\n<p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don''t know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I''m breaking now. We said we''d say it was the snow that killed the other two, but it wasn''t. Nature is lethal but it doesn''t hold a candle to man. </p>\r\n\r\n', '2013-01-23 00:00:00', 2),
(2, 'Dis iz a motherfuckin title', '<!-- start slipsum code -->\r\n\r\n<h1>No man, I don''t eat pork</h1>\r\n<p>Now that there is the Tec-9, a crappy spray gun from South Miami. This gun is advertised as the most popular gun in American crime. Do you believe that shit? It actually says that in the little book that comes with it: the most popular gun in American crime. Like they''re actually proud of that shit.  </p>\r\n\r\n<h1>I gotta piss</h1>\r\n<p>Now that there is the Tec-9, a crappy spray gun from South Miami. This gun is advertised as the most popular gun in American crime. Do you believe that shit? It actually says that in the little book that comes with it: the most popular gun in American crime. Like they''re actually proud of that shit.  </p>\r\n\r\n<h1>No man, I don''t eat pork</h1>\r\n<p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don''t know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I''m breaking now. We said we''d say it was the snow that killed the other two, but it wasn''t. Nature is lethal but it doesn''t hold a candle to man. </p>\r\n\r\n<!-- please do not remove this line -->\r\n\r\n<div style="display:none;">\r\n<a href="http://slipsum.com">lorem ipsum</a></div>\r\n\r\n<!-- end slipsum code -->\r\n', '2013-01-14 00:00:00', 6),
(3, 'Bonjour le titre - Je suis un titre', 'Ceci est un post qui est un peu inutile enfet ...\r\n\r\nvoilà', '2013-01-15 00:00:00', 4),
(4, 'C’est une bonne situation ça scribe ?', '\r\n- Vous savez, moi je ne crois pas qu’il y ait de bonne ou de mauvaise situation. Moi, si je devais résumer ma vie aujourd’hui avec vous, je dirais que c’est d’abord des rencontres. Des gens qui m’ont tendu la main, peut-être à un moment où je ne pouvais pas, où j’étais seul chez moi. Et c’est assez curieux de se dire que les hasards, les rencontres forgent une destinée... Parce que quand on a le goût de la chose, quand on a le goût de la chose bien faite, le beau geste, parfois on ne trouve pas l’interlocuteur en face je dirais, le miroir qui vous aide à avancer. Alors ça n’est pas mon cas, comme je disais là, puisque moi au contraire, j’ai pu : et je dis merci à la vie, je lui dis merci, je chante la vie, je danse la vie... je ne suis qu’amour ! Et finalement, quand beaucoup de gens aujourd’hui me disent « Mais comment fais-tu pour avoir cette humanité ? », et bien je leur réponds très simplement, je leur dis que c’est ce goût de l’amour ce goût donc qui m’a poussé aujourd’hui à entreprendre une construction mécanique, mais demain qui sait ? Peut-être simplement à me mettre au service de la communauté, à faire le don, le don de soi...', '2013-01-25 00:00:00', 4),
(5, 'Bonjouir les copains', 'A Mon Doux Mignonnet\r\n\r\nJ''aime la paix du soir\r\nLa nuit mystérieuse\r\nLe doux matin d''espoir\r\nEt l''aurore rieuse.\r\n\r\nJ''aime te regarder\r\nLe coeur fou d''un bonheur\r\nQue je sens déborder\r\nÀ chacune des heures.\r\n\r\nJ''aime tes grands yeux doux\r\nMon gentil bichounet.\r\nÀ toi mon proche époux\r\nQui sait enluminer\r\n\r\nPar mille délicatesses\r\nChaque instant de ma vie\r\nJe dis avec tendresse\r\nUn infini merci.', '2013-01-09 00:00:00', 5),
(6, 'Wesh moré', 'trankil le post tahu', '2012-10-10 00:00:00', 3),
(7, 'Ya know wat i mean bitch', '<!-- start slipsum code -->\r\n\r\n<h1>Uuummmm, this is a tasty burger!</h1>\r\n<p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don''t know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I''m breaking now. We said we''d say it was the snow that killed the other two, but it wasn''t. Nature is lethal but it doesn''t hold a candle to man. </p>\r\n\r\n<h1>Is she dead, yes or no?</h1>\r\n<p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don''t know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I''m breaking now. We said we''d say it was the snow that killed the other two, but it wasn''t. Nature is lethal but it doesn''t hold a candle to man. </p>\r\n\r\n<h1>Hold on to your butts</h1>\r\n<p>Your bones don''t break, mine do. That''s clear. Your cells react to bacteria and viruses differently than mine. You don''t get sick, I do. That''s also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We''re on the same curve, just on opposite ends. </p>\r\n\r\n<h1>Is she dead, yes or no?</h1>\r\n<p>Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that''s what you see at a toy store. And you must think you''re in a toy store, because you''re here shopping for an infant named Jeb. </p>\r\n\r\n<h1>I gotta piss</h1>\r\n<p>Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that''s what you see at a toy store. And you must think you''re in a toy store, because you''re here shopping for an infant named Jeb. </p>\r\n\r\n\r\n', '2012-06-03 00:00:00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `rights`
--

INSERT INTO `rights` (`id`, `name`) VALUES
(1, 'blogger'),
(2, 'administrator'),
(3, 'big_administrator');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `right_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`right_id`),
  KEY `fk_users_rights1` (`right_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `address`, `right_id`) VALUES
(1, 'Clement', 'Sellier', '4 rue du chateau, 77340 pontault', 1),
(2, 'Cyril', 'Teixeira', '49 avenue du rêve, 77220 Gretz Armainvilliers', 1),
(3, 'Benjamin', 'Debernardi', '13 rue Roger Salengro', 2),
(4, 'Romain', 'Reynaud', '25 rue du hardware', 3),
(5, 'Arnaud', 'Raulet', '3 avenue grincheux', 3),
(6, 'Tellier', 'Guillaume', '13 rue Roger Salengro', 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_posts1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_rights1` FOREIGN KEY (`right_id`) REFERENCES `rights` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
