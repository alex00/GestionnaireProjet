  -- phpMyAdmin SQL Dump
  -- version 3.5.1
  -- http://www.phpmyadmin.net
  --
  -- Client: localhost
  -- Généré le: Jeu 20 Juin 2013 à 17:31
  -- Version du serveur: 5.5.24-log
  -- Version de PHP: 5.4.3

  SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
  SET time_zone = "+00:00";


  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8 */;

  --
  -- Base de données: `projectmanager`
  --

  DROP DATABASE IF EXISTS `projectmanager`;
  CREATE DATABASE `projectmanager`;
  USE `projectmanager`;



  -- --------------------------------------------------------

  --
  -- Structure de la table `acl_groups`
  --

  DROP TABLE IF EXISTS `acl_groups`;
  CREATE TABLE IF NOT EXISTS `acl_groups` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(10) DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

  --
  -- Contenu de la table `acl_groups`
  --

  INSERT INTO `acl_groups` (`id`, `name`) VALUES
  (1, 'creator'),
  (2, 'admin'),
  (3, 'user');

  -- --------------------------------------------------------

  --
  -- Structure de la table `announces`
  --

  DROP TABLE IF EXISTS `announces`;
  CREATE TABLE IF NOT EXISTS `announces` (
    `announce_id` int(11) NOT NULL AUTO_INCREMENT,
    `announce_title` varchar(100) NOT NULL,
    `announce_code` varchar(100) NOT NULL,
    `announce_date_create` datetime NOT NULL,
    `announce_date_update` datetime NOT NULL,
    `announce_description` text NOT NULL,
    `project_id` int(11) NOT NULL,
    PRIMARY KEY (`announce_id`),
    KEY `fk_announces_projects1` (`project_id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

  -- --------------------------------------------------------

  --
  -- Structure de la table `comments`
  --

  DROP TABLE IF EXISTS `comments`;
  CREATE TABLE IF NOT EXISTS `comments` (
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
  -- Structure de la table `notifiaction_types`
  --

  DROP TABLE IF EXISTS `notifiaction_types`;
  CREATE TABLE IF NOT EXISTS `notifiaction_types` (
    `type_id` int(11) NOT NULL AUTO_INCREMENT,
    `type_name` varchar(60) NOT NULL,
    `type_description` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`type_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

  -- --------------------------------------------------------

  --
  -- Structure de la table `notifications`
  --

  DROP TABLE IF EXISTS `notifications`;
  CREATE TABLE IF NOT EXISTS `notifications` (
    `notification_id` int(11) NOT NULL,
    `project_id` int(11) NOT NULL,
    `ticket_id` int(11) NOT NULL,
    `user_creator_id` int(11) NOT NULL,
    `announce_id` int(11) NOT NULL,
    `roadmap_id` int(11) NOT NULL,
    `user_dest_id` int(11) NOT NULL,
    `service_id` int(11) NOT NULL,
    `type_id` int(11) NOT NULL,
    PRIMARY KEY (`notification_id`),
    KEY `fk_notifications_notifiaction_types1_idx` (`type_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  -- --------------------------------------------------------

  --
  -- Structure de la table `notifications_settings`
  --

  DROP TABLE IF EXISTS `notifications_settings`;
  CREATE TABLE IF NOT EXISTS `notifications_settings` (
    `notifiaction_id` int(11) NOT NULL,
    `users_id` int(11) NOT NULL,
    `notifications_settings` tinyint(1) NOT NULL,
    PRIMARY KEY (`notifiaction_id`,`users_id`),
    KEY `fk_notifiaction_types_has_users_users1` (`users_id`),
    KEY `fk_notifiaction_types_has_users_notifiaction_types1` (`notifiaction_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  -- --------------------------------------------------------

  --
  -- Structure de la table `priorities`
  --

  DROP TABLE IF EXISTS `priorities`;
  CREATE TABLE IF NOT EXISTS `priorities` (
    `priority_id` int(11) NOT NULL AUTO_INCREMENT,
    `priority_name` varchar(45) NOT NULL,
    PRIMARY KEY (`priority_id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

  --
  -- Contenu de la table `priorities`
  --

  INSERT INTO `priorities` (`priority_id`, `priority_name`) VALUES
  (1, 'low'),
  (2, 'normal'),
  (3, 'high'),
  (4, 'immediate');

  -- --------------------------------------------------------

  --
  -- Structure de la table `projects`
  --

  DROP TABLE IF EXISTS `projects`;
  CREATE TABLE IF NOT EXISTS `projects` (
    `project_id` int(11) NOT NULL AUTO_INCREMENT,
    `project_name` varchar(100) NOT NULL,
    `project_date_create` datetime NOT NULL,
    `project_date_update` datetime NOT NULL,
    `project_code` varchar(100) NOT NULL,
    `project_description` text,
    PRIMARY KEY (`project_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

  -- --------------------------------------------------------

  --
  -- Structure de la table `roadmaps`
  --

  DROP TABLE IF EXISTS `roadmaps`;
  CREATE TABLE IF NOT EXISTS `roadmaps` (
    `roadmap_id` int(11) NOT NULL AUTO_INCREMENT,
    `project_id` int(11) NOT NULL,
    `roadmap_title` varchar(100) NOT NULL,
    `roadmap_code` varchar(100) NOT NULL,
    `roadmap_date_create` datetime NOT NULL,
    `roadmap_date_update` datetime NOT NULL,
    `roadmap_description` text NOT NULL,
    PRIMARY KEY (`roadmap_id`),
    KEY `fk_roadmaps_projects1` (`project_id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

  -- --------------------------------------------------------

  --
  -- Structure de la table `services`
  --

  DROP TABLE IF EXISTS `services`;
  CREATE TABLE IF NOT EXISTS `services` (
    `service_id` int(11) NOT NULL AUTO_INCREMENT,
    `service_name` varchar(100) NOT NULL,
    `service_code` varchar(100) NOT NULL,
    `project_id` int(11) NOT NULL,
    PRIMARY KEY (`service_id`),
    KEY `fk_services_projects1` (`project_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

  -- --------------------------------------------------------

  --
  -- Structure de la table `status`
  --

  DROP TABLE IF EXISTS `status`;
  CREATE TABLE IF NOT EXISTS `status` (
    `status_id` int(11) NOT NULL AUTO_INCREMENT,
    `status_name` varchar(45) NOT NULL,
    PRIMARY KEY (`status_id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

  --
  -- Contenu de la table `status`
  --

  INSERT INTO `status` (`status_id`, `status_name`) VALUES
  (1, 'assigned'),
  (2, 'in progress'),
  (3, 'resolved'),
  (4, 'closed'),
  (5, 'canceled');

  -- --------------------------------------------------------

  --
  -- Structure de la table `tickets`
  --

  DROP TABLE IF EXISTS `tickets`;
  CREATE TABLE IF NOT EXISTS `tickets` (
    `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
    `ticket_name` varchar(70) NOT NULL,
    `ticket_code` varchar(70) NOT NULL,
    `ticket_date_create` datetime NOT NULL,
    `ticket_date_update` datetime NOT NULL,
    `ticket_deadline` datetime NOT NULL,
    `ticket_spend_time` float NOT NULL,
    `ticket_progress` int(11) NOT NULL,
    `ticket_description` text NOT NULL,
    `project_id` int(11) NOT NULL,
    `priority_id` int(11) NOT NULL,
    `statut_id` int(11) NOT NULL,
    `tracker_id` int(11) NOT NULL,
    `roadmap_id` int(11) NOT NULL,
    PRIMARY KEY (`ticket_id`),
    KEY `fk_action_project1_idx` (`project_id`),
    KEY `fk_roadmap_tickets_idx` (`roadmap_id`),
    KEY `fk_tickets_prioritys1_idx` (`priority_id`),
    KEY `fk_tickets_status1_idx` (`statut_id`),
    KEY `fk_tickets_trackers1_idx` (`tracker_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

  -- --------------------------------------------------------

  --
  -- Structure de la table `ticket_files`
  --

  DROP TABLE IF EXISTS `ticket_files`;
  CREATE TABLE IF NOT EXISTS `ticket_files` (
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

  DROP TABLE IF EXISTS `trackers`;
  CREATE TABLE IF NOT EXISTS `trackers` (
    `tracker_id` int(11) NOT NULL AUTO_INCREMENT,
    `tracker_name` varchar(45) NOT NULL,
    PRIMARY KEY (`tracker_id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

  --
  -- Contenu de la table `trackers`
  --

  INSERT INTO `trackers` (`tracker_id`, `tracker_name`) VALUES
  (1, 'evolution'),
  (2, 'bug'),
  (3, 'support');

  -- --------------------------------------------------------

  --
  -- Structure de la table `users`
  --

  DROP TABLE IF EXISTS `users`;
  CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_mail` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    `password` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    `user_login` varchar(45) NOT NULL,
    `user_login_code` varchar(45) NOT NULL,
    `user_date_create` datetime NOT NULL,
    `acl_group_id` varchar(45) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

  -- --------------------------------------------------------

  --
  -- Structure de la table `users_receive_tickets`
  --

  DROP TABLE IF EXISTS `users_receive_tickets`;
  CREATE TABLE IF NOT EXISTS `users_receive_tickets` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `ticket_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_user_has_action_action1_idx` (`ticket_id`),
    KEY `fk_user_has_action_user1_idx` (`user_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  -- --------------------------------------------------------

  --
  -- Structure de la table `user_notification`
  --

  DROP TABLE IF EXISTS `user_notification`;
  CREATE TABLE IF NOT EXISTS `user_notification` (
    `notification_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `notification_view` tinyint(1) NOT NULL,
    PRIMARY KEY (`notification_id`,`user_id`),
    KEY `fk_user_notification_users1_idx` (`user_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  -- --------------------------------------------------------

  --
  -- Structure de la table `user_service`
  --

  DROP TABLE IF EXISTS `user_service`;
  CREATE TABLE IF NOT EXISTS `user_service` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `service_id` int(11) NOT NULL,
    `project_id` int(11) NOT NULL,
    `rightKey` int(1) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_users_has_projects_users1_idx` (`user_id`),
    KEY `fk_project_services_userse_id` (`project_id`),
    KEY `fk_user_service_project_services1_idx` (`service_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  --
  -- Contraintes pour les tables exportées
  --

  --
  -- Contraintes pour la table `comments`
  --
  ALTER TABLE `comments`
    ADD CONSTRAINT `fk_comments_tickets1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

  --
  -- Contraintes pour la table `notifications`
  --
  ALTER TABLE `notifications`
    ADD CONSTRAINT `fk_notifications_notifiaction_types1` FOREIGN KEY (`type_id`) REFERENCES `notifiaction_types` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

  --
  -- Contraintes pour la table `notifications_settings`
  --
  ALTER TABLE `notifications_settings`
    ADD CONSTRAINT `fk_notifiaction_types_has_users_notifiaction_types1` FOREIGN KEY (`notifiaction_id`) REFERENCES `notifiaction_types` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_notifiaction_types_has_users_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

  --
  -- Contraintes pour la table `tickets`
  --
  ALTER TABLE `tickets`
    ADD CONSTRAINT `fk_action_project1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_tickets_prioritys1` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`priority_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_tickets_status1` FOREIGN KEY (`statut_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
    ADD CONSTRAINT `fk_user_has_action_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_user_has_action_action1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE;

  --
  -- Contraintes pour la table `user_notification`
  --
  ALTER TABLE `user_notification`
    ADD CONSTRAINT `fk_user_notification_notifications1` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`notification_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_user_notification_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

  --
  -- Contraintes pour la table `user_service`
  --
  ALTER TABLE `user_service`
    ADD CONSTRAINT `fk_users_has_projects_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_project_services_userse_id` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_user_service_project_services1` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
