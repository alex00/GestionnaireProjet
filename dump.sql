-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 12 Juin 2013 à 18:05
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `gestionnaire_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `announcement`
--

CREATE TABLE `announcement` (
  `idannouncement` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_title` varchar(100) NOT NULL,
  `announcement_description` text NOT NULL,
  `announcement_date_create` datetime NOT NULL,
  `announcement_date_update` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`idannouncement`),
  KEY `fk_announcement_projects1_idx` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_description` text NOT NULL,
  `comment_date_create` datetime NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `fk_comments_tickets1_idx` (`ticket_id`),
  KEY `fk_comments_users1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `logs_key` varchar(45) NOT NULL,
  `logs_value` varchar(45) NOT NULL,
  `logs_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`logs_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notifiaction_types`
--

CREATE TABLE `notifiaction_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_code` varchar(60) NOT NULL,
  `type_description` tinytext NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_creator_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `notification_date_create` datetime NOT NULL,
  `notification_view` tinyint(1) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `user_receive_id` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `fk_notifications_notifiaction_types1_idx` (`type_id`),
  KEY `fk_notifications_users1_idx` (`user_receive_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prioritys`
--

CREATE TABLE `prioritys` (
  `priority_id` int(11) NOT NULL AUTO_INCREMENT,
  `priority_code` varchar(45) NOT NULL,
  `priority_name` varchar(45) NOT NULL,
  `priority_color` varchar(45) NOT NULL,
  PRIMARY KEY (`priority_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `prioritys`
--

INSERT INTO `prioritys` (`priority_id`, `priority_code`, `priority_name`, `priority_color`) VALUES
(1, 'low', 'low', ''),
(2, 'normal', 'normal', ''),
(3, 'high', 'high', ''),
(4, 'urgent', 'urgent', ''),
(5, 'immediate', 'immediate', '');

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(100) NOT NULL,
  `project_date_create` datetime NOT NULL,
  `project_date_update` datetime NOT NULL,
  `project_img_url` varchar(255) NOT NULL,
  `project_code` varchar(100) NOT NULL,
  `project_description` text,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `rights_project`
--

CREATE TABLE `rights_project` (
  `right_key` int(11) NOT NULL,
  `right_value` varchar(45) NOT NULL,
  PRIMARY KEY (`right_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `roadmap`
--

CREATE TABLE `roadmap` (
  `roadmap_id` int(11) NOT NULL AUTO_INCREMENT,
  `roadmap_name` varchar(155) NOT NULL,
  `roadmap_code` varchar(155) NOT NULL,
  `roadmap_date_create` datetime NOT NULL,
  `roadmap_date_update` datetime NOT NULL,
  `roadmap_description` text NOT NULL,
  PRIMARY KEY (`roadmap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) NOT NULL,
  `service_code` varchar(100) NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `statuts`
--

CREATE TABLE `statuts` (
  `statut_id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_name` varchar(45) NOT NULL,
  `statut_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`statut_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `statuts`
--

INSERT INTO `statuts` (`statut_id`, `statut_name`, `statut_code`) VALUES
(1, 'attributed', 'attributed'),
(2, 'in progress', 'in-progess'),
(3, 'resolved', 'resolved'),
(4, 'closed', 'closed'),
(5, 'canceled', 'canceled');

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_name` varchar(70) NOT NULL,
  `ticket_date_create` datetime NOT NULL,
  `ticket_date_update` datetime NOT NULL,
  `ticket_deadline` datetime NOT NULL,
  `ticket_spend_time` float NOT NULL,
  `ticket_progress` int(11) NOT NULL,
  `ticket_description` text NOT NULL,
  `ticket_parent_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `statut_id` int(11) NOT NULL,
  `tracker_id` int(11) NOT NULL,
  `roadmap_id` int(11) NOT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `fk_action_project1_idx` (`project_id`),
  KEY `fk_tickets_prioritys1_idx` (`priority_id`),
  KEY `fk_tickets_trackers1_idx` (`tracker_id`),
  KEY `fk_tickets_roadmap1_idx` (`roadmap_id`),
  KEY `fk_tickets_statuts1_idx` (`statut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ticket_files`
--

CREATE TABLE `ticket_files` (
  `ticket_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_url` varchar(255) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY (`ticket_file_id`),
  KEY `fk_ticket_files_tickets1_idx` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `trackers`
--

CREATE TABLE `trackers` (
  `tracker_id` int(11) NOT NULL AUTO_INCREMENT,
  `tracker_name` varchar(45) NOT NULL,
  `tracker_code` varchar(45) NOT NULL,
  PRIMARY KEY (`tracker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `trackers`
--

INSERT INTO `trackers` (`tracker_id`, `tracker_name`, `tracker_code`) VALUES
(1, 'evolution', 'evolution'),
(2, 'bug', 'bug'),
(3, 'assistance', 'assistance'),
(4, 'to be confirmed', 'to-be-confirmed');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_mail` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_pass` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_img_url` varchar(255) NOT NULL,
  `user_login` varchar(45) NOT NULL,
  `user_login_code` varchar(45) NOT NULL,
  `user_date_create` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users_receive_tickets`
--

CREATE TABLE `users_receive_tickets` (
  `user_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`ticket_id`),
  KEY `fk_user_has_action_action1_idx` (`ticket_id`),
  KEY `fk_user_has_action_user1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_project`
--

CREATE TABLE `user_project` (
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `rights_key` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`project_id`,`rights_key`),
  KEY `fk_user_has_project_project1_idx` (`project_id`),
  KEY `fk_user_has_project_user_idx` (`user_id`),
  KEY `fk_user_project_rights1_idx` (`rights_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_service_project`
--

CREATE TABLE `user_service_project` (
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`project_id`,`service_id`),
  KEY `fk_users_has_projects_projects1_idx` (`project_id`),
  KEY `fk_users_has_projects_users1_idx` (`user_id`),
  KEY `fk_user_service_project_services1_idx` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `fk_announcement_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_tickets1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_notifiaction_types1` FOREIGN KEY (`type_id`) REFERENCES `notifiaction_types` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notifications_users1` FOREIGN KEY (`user_receive_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_action_project1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tickets_prioritys1` FOREIGN KEY (`priority_id`) REFERENCES `prioritys` (`priority_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tickets_roadmap1` FOREIGN KEY (`roadmap_id`) REFERENCES `roadmap` (`roadmap_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tickets_status1` FOREIGN KEY (`statut_id`) REFERENCES `statuts` (`statut_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tickets_trackers1` FOREIGN KEY (`tracker_id`) REFERENCES `trackers` (`tracker_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ticket_files`
--
ALTER TABLE `ticket_files`
  ADD CONSTRAINT `fk_ticket_files_tickets1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users_receive_tickets`
--
ALTER TABLE `users_receive_tickets`
  ADD CONSTRAINT `fk_user_has_action_action1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_has_action_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_project`
--
ALTER TABLE `user_project`
  ADD CONSTRAINT `fk_user_has_project_project1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_has_project_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_project_rights1` FOREIGN KEY (`rights_key`) REFERENCES `rights_project` (`right_key`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_service_project`
--
ALTER TABLE `user_service_project`
  ADD CONSTRAINT `fk_users_has_projects_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_has_projects_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_service_project_services1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;
