-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 19 Septembre 2013 à 10:52
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `new_schema`
--
CREATE DATABASE IF NOT EXISTS `new_schema` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `new_schema`;
--
-- Base de données: `providerselector`
--
CREATE DATABASE IF NOT EXISTS `providerselectorV1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `providerselectorV1`;

-- --------------------------------------------------------

--
-- Structure de la table `ps_appel_offre`
--

CREATE TABLE IF NOT EXISTS `ps_appel_offre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference` varchar(256) DEFAULT NULL,
  `number` int(10) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `description` text,
  `condition` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ps_appel_offre`
--

INSERT INTO `ps_appel_offre` (`id`, `reference`, `number`, `titre`, `dateDebut`, `dateFin`, `description`, `condition`) VALUES
(1, 'test', 125, 'test', '2013-08-15', '1900-12-28', '', ''),
(3, 'testyy', 12555, 'testijij', '0000-00-00', '2013-09-04', 'jhh', 'kjkj');

-- --------------------------------------------------------

--
-- Structure de la table `ps_categorie`
--

CREATE TABLE IF NOT EXISTS `ps_categorie` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `ps_categorie`
--

INSERT INTO `ps_categorie` (`id`, `name`, `description`) VALUES
(1, 'finance', ''),
(2, 'technique', '');

-- --------------------------------------------------------

--
-- Structure de la table `ps_concern`
--

CREATE TABLE IF NOT EXISTS `ps_concern` (
  `appel_offre_id` int(10) unsigned NOT NULL,
  `criteria_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`appel_offre_id`,`criteria_id`),
  KEY `fk_criteria_concern` (`criteria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ps_convoquer`
--

CREATE TABLE IF NOT EXISTS `ps_convoquer` (
  `appel_offre_id` int(10) unsigned NOT NULL,
  `evaluator_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`appel_offre_id`,`evaluator_id`),
  KEY `fk_evaluator_convoquer` (`evaluator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ps_criteria`
--

CREATE TABLE IF NOT EXISTS `ps_criteria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `ps_criteria`
--

INSERT INTO `ps_criteria` (`id`, `name`, `description`) VALUES
(1, 'Speed', 'Duration ...'),
(2, 'Mantenance & Support', ''),
(4, 'Services Quality', ''),
(5, 'Transactions flexibilty', ''),
(6, 'Availability', ''),
(7, 'Experience', ''),
(8, 'Product Quality', ''),
(12, 'test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `ps_criteria_categorie`
--

CREATE TABLE IF NOT EXISTS `ps_criteria_categorie` (
  `categorie_id` int(10) unsigned NOT NULL,
  `criteria_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`categorie_id`,`criteria_id`),
  KEY `fk_criteria_categorie` (`criteria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ps_criteria_categorie`
--

INSERT INTO `ps_criteria_categorie` (`categorie_id`, `criteria_id`) VALUES
(1, 12);

-- --------------------------------------------------------

--
-- Structure de la table `ps_evaluator`
--

CREATE TABLE IF NOT EXISTS `ps_evaluator` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fist_name` varchar(256) DEFAULT NULL,
  `last_name` varchar(256) DEFAULT NULL,
  `function` varchar(255) NOT NULL,
  `username` varchar(256) NOT NULL,
  `psswd_hash` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `ps_evaluator`
--

INSERT INTO `ps_evaluator` (`id`, `fist_name`, `last_name`, `function`, `username`, `psswd_hash`) VALUES
(7, 'Hamid', 'HAMADOUCHE', 'Procurment', 'root', '$1$3j2.OY5.$on4q4uDZJnlmbY0/73rW.0'),
(8, 'Khalid', 'GHIBOUB', 'IT information.', 'proserve', '$1$eZ2.Pt1.$UXsQ6TKe0w1XlH9aCPXov/'),
(9, 'Abdelatif', 'CHEBOUB', 'General Director -SEO.', 'admin', '$1$9l0.cM4.$ypxHC.0F3IfiuWSsP6b2P1'),
(15, '125', '125', 'IT information.', 'ttr', '$1$1T4..V2.$CFsfa2lfE0iQi9E1DceCM1');

-- --------------------------------------------------------

--
-- Structure de la table `ps_evaluator_categorie`
--

CREATE TABLE IF NOT EXISTS `ps_evaluator_categorie` (
  `categorie_id` int(10) unsigned NOT NULL,
  `evaluator_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`categorie_id`,`evaluator_id`),
  KEY `fk_evaluator_categorie` (`evaluator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ps_evaluator_categorie`
--

INSERT INTO `ps_evaluator_categorie` (`categorie_id`, `evaluator_id`) VALUES
(2, 15);

-- --------------------------------------------------------

--
-- Structure de la table `ps_evaluator_criteria`
--

CREATE TABLE IF NOT EXISTS `ps_evaluator_criteria` (
  `evaluator_id` int(10) unsigned NOT NULL,
  `criteria_id` int(10) unsigned NOT NULL,
  `mark` float NOT NULL,
  PRIMARY KEY (`evaluator_id`,`criteria_id`),
  KEY `fk_criteria` (`criteria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ps_evaluator_criteria`
--

INSERT INTO `ps_evaluator_criteria` (`evaluator_id`, `criteria_id`, `mark`) VALUES
(7, 1, 9),
(7, 2, 7),
(7, 4, 9),
(7, 5, 9),
(7, 6, 3),
(7, 7, 3),
(7, 8, 7),
(8, 1, 9),
(8, 2, 7),
(8, 4, 9),
(8, 5, 9),
(8, 6, 3),
(8, 7, 5),
(8, 8, 9),
(9, 1, 7),
(9, 2, 9),
(9, 4, 9),
(9, 5, 9),
(9, 6, 5),
(9, 7, 3),
(9, 8, 7);

-- --------------------------------------------------------

--
-- Structure de la table `ps_participe`
--

CREATE TABLE IF NOT EXISTS `ps_participe` (
  `appel_offre_id` int(10) unsigned NOT NULL,
  `provider_id` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`appel_offre_id`,`provider_id`),
  KEY `fk_provider_participe` (`provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ps_provider`
--

CREATE TABLE IF NOT EXISTS `ps_provider` (
  `id` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `name` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `postal_address` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `post_code` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `finance` int(16) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `postal_address` (`postal_address`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `ps_provider`
--

INSERT INTO `ps_provider` (`id`, `name`, `postal_address`, `post_code`, `email`, `phone`, `finance`) VALUES
('F1', 'ghiboub', '', '', 'ak_ghiboub@hotmail.co.uk', '', 1000),
('F2', 'hamid', '', '', 'ak_ghiboub@esi.dz', '', 950),
('F3', 'test', '', '', 'ak@eki.dz', '', 900),
('F4', 'test', 'test', '', 'test@test.test', '', 960);

-- --------------------------------------------------------

--
-- Structure de la table `ps_provider_compare`
--

CREATE TABLE IF NOT EXISTS `ps_provider_compare` (
  `provider_a_id` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `provider_b_id` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `criteria_id` int(10) unsigned NOT NULL,
  `mark` float NOT NULL,
  `comp` varchar(3) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`provider_a_id`,`provider_b_id`,`criteria_id`),
  KEY `fk_criteria_comp` (`criteria_id`),
  KEY `fk_provider_b` (`provider_b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `ps_provider_compare`
--

INSERT INTO `ps_provider_compare` (`provider_a_id`, `provider_b_id`, `criteria_id`, `mark`, `comp`) VALUES
('F1', 'F2', 5, 5, '>'),
('F1', 'F2', 8, 3, '<'),
('F1', 'F3', 8, 2, '<'),
('F1', 'F4', 2, 3, '>'),
('F1', 'F4', 4, 5, '<'),
('F1', 'F4', 5, 6.25, '>'),
('F1', 'F4', 6, 9, '<'),
('F1', 'F4', 8, 3, '>'),
('F2', 'F1', 1, 5, '>'),
('F2', 'F1', 2, 5.23, '>'),
('F2', 'F1', 4, 5, '>'),
('F2', 'F3', 2, 3, '<'),
('F2', 'F3', 4, 9, '>'),
('F2', 'F3', 5, 1, '='),
('F2', 'F3', 6, 5, '<'),
('F2', 'F4', 1, 9, '>'),
('F2', 'F4', 2, 5.95, '>'),
('F2', 'F4', 4, 9, '<'),
('F2', 'F4', 5, 2.35, '<'),
('F2', 'F4', 6, 4, '<'),
('F2', 'F4', 8, 3, '<'),
('F3', 'F1', 1, 5, '>'),
('F3', 'F1', 2, 3, '<'),
('F3', 'F1', 4, 3, '<'),
('F3', 'F1', 5, 3, '>'),
('F3', 'F1', 6, 3, '>'),
('F3', 'F2', 1, 3, '>'),
('F3', 'F2', 8, 3, '<'),
('F3', 'F4', 2, 5.26, '<'),
('F3', 'F4', 4, 5.5, '>'),
('F3', 'F4', 5, 2.25, '<'),
('F3', 'F4', 6, 5.25, '>'),
('F3', 'F4', 8, 5, '>'),
('F4', 'F1', 1, 9, '>'),
('F4', 'F3', 1, 9, '>');

-- --------------------------------------------------------

--
-- Structure de la table `ps_user_log`
--

CREATE TABLE IF NOT EXISTS `ps_user_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `ipaddress` varchar(64) NOT NULL,
  `logtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `controller` varchar(255) NOT NULL DEFAULT '',
  `action` varchar(255) NOT NULL DEFAULT '',
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=334 ;

--
-- Contenu de la table `ps_user_log`
--

INSERT INTO `ps_user_log` (`id`, `username`, `ipaddress`, `logtime`, `controller`, `action`, `details`) VALUES
(1, 'proserve', '127.0.0.1', '2013-09-07 20:59:26', 'Evaluator', 'CREATE', 'User proserve created Evaluator[5].'),
(2, 'proserve', '127.0.0.1', '2013-09-07 21:02:31', 'Evaluator', 'Update', 'User proserve changed username for Evaluator[5].'),
(3, 'proserve', '127.0.0.1', '2013-09-07 21:02:54', 'Evaluator', 'Update', 'User proserve changed username for Evaluator[5].'),
(4, 'proserve', '127.0.0.1', '2013-09-07 21:05:33', 'Evaluator', 'CREATE', 'User proserve created Evaluator[6].'),
(5, 'proserve', '127.0.0.1', '2013-09-07 21:05:42', 'Evaluator', 'DELETE', 'User proserve deleted Evaluator[6].'),
(6, 'proserve', '127.0.0.1', '2013-09-07 21:07:13', 'Evaluator', 'CREATE', 'User proserve created Evaluator[7].'),
(7, 'proserve', '127.0.0.1', '2013-09-07 21:07:52', 'Evaluator', 'CREATE', 'User proserve created Evaluator[8].'),
(8, 'proserve', '127.0.0.1', '2013-09-07 21:10:39', 'Evaluator', 'CREATE', 'User proserve created Evaluator[9].'),
(9, 'proserve', '127.0.0.1', '2013-09-07 21:13:52', 'Criteria', 'CREATE', 'User proserve created Criteria[1].'),
(10, 'proserve', '127.0.0.1', '2013-09-07 21:17:05', 'Criteria', 'CREATE', 'User proserve created Criteria[2].'),
(11, 'proserve', '127.0.0.1', '2013-09-07 21:18:55', 'Criteria', 'CREATE', 'User proserve created Criteria[3].'),
(12, 'proserve', '127.0.0.1', '2013-09-07 21:20:00', 'Criteria', 'CREATE', 'User proserve created Criteria[4].'),
(13, 'proserve', '127.0.0.1', '2013-09-07 21:20:20', 'Criteria', 'CREATE', 'User proserve created Criteria[5].'),
(14, 'proserve', '127.0.0.1', '2013-09-07 21:20:51', 'Criteria', 'CREATE', 'User proserve created Criteria[6].'),
(15, 'proserve', '127.0.0.1', '2013-09-07 21:21:05', 'Criteria', 'Update', 'User proserve changed name for Criteria[6].'),
(16, 'proserve', '127.0.0.1', '2013-09-07 21:21:44', 'Criteria', 'CREATE', 'User proserve created Criteria[7].'),
(17, 'proserve', '127.0.0.1', '2013-09-07 21:23:19', 'Criteria', 'CREATE', 'User proserve created Criteria[8].'),
(18, 'proserve', '127.0.0.1', '2013-09-07 21:23:27', 'Criteria', 'Update', 'User proserve changed name for Criteria[4].'),
(19, 'proserve', '127.0.0.1', '2013-09-07 21:27:38', 'EvaluatorCriteria', 'CREATE', 'User proserve created EvaluatorCriteria[8,1].'),
(20, 'proserve', '127.0.0.1', '2013-09-07 21:28:22', 'EvaluatorCriteria', 'CREATE', 'User proserve created EvaluatorCriteria[8,2].'),
(21, 'proserve', '127.0.0.1', '2013-09-07 21:28:34', 'EvaluatorCriteria', 'CREATE', 'User proserve created EvaluatorCriteria[8,3].'),
(22, 'proserve', '127.0.0.1', '2013-09-07 21:29:01', 'EvaluatorCriteria', 'CREATE', 'User proserve created EvaluatorCriteria[8,4].'),
(23, 'proserve', '127.0.0.1', '2013-09-07 21:29:08', 'EvaluatorCriteria', 'CREATE', 'User proserve created EvaluatorCriteria[8,5].'),
(24, 'proserve', '127.0.0.1', '2013-09-07 21:29:16', 'EvaluatorCriteria', 'CREATE', 'User proserve created EvaluatorCriteria[8,6].'),
(25, 'proserve', '127.0.0.1', '2013-09-07 21:29:21', 'EvaluatorCriteria', 'CREATE', 'User proserve created EvaluatorCriteria[8,7].'),
(26, 'proserve', '127.0.0.1', '2013-09-07 21:29:24', 'EvaluatorCriteria', 'CREATE', 'User proserve created EvaluatorCriteria[8,8].'),
(27, 'root', '127.0.0.1', '2013-09-08 08:07:51', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,1].'),
(28, 'root', '127.0.0.1', '2013-09-08 08:07:57', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,2].'),
(29, 'root', '127.0.0.1', '2013-09-08 08:08:02', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,3].'),
(30, 'root', '127.0.0.1', '2013-09-08 08:08:08', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,4].'),
(31, 'root', '127.0.0.1', '2013-09-08 08:08:13', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,5].'),
(32, 'root', '127.0.0.1', '2013-09-08 08:08:17', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,6].'),
(33, 'root', '127.0.0.1', '2013-09-08 08:08:23', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,7].'),
(34, 'root', '127.0.0.1', '2013-09-08 08:08:28', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,8].'),
(35, 'admin', '127.0.0.1', '2013-09-08 08:08:58', 'EvaluatorCriteria', 'CREATE', 'User admin created EvaluatorCriteria[9,1].'),
(36, 'admin', '127.0.0.1', '2013-09-08 08:09:26', 'EvaluatorCriteria', 'CREATE', 'User admin created EvaluatorCriteria[9,2].'),
(37, 'admin', '127.0.0.1', '2013-09-08 12:30:49', 'EvaluatorCriteria', 'CREATE', 'User admin created EvaluatorCriteria[9,3].'),
(38, 'admin', '127.0.0.1', '2013-09-08 12:30:53', 'EvaluatorCriteria', 'CREATE', 'User admin created EvaluatorCriteria[9,4].'),
(39, 'admin', '127.0.0.1', '2013-09-08 12:30:57', 'EvaluatorCriteria', 'CREATE', 'User admin created EvaluatorCriteria[9,5].'),
(40, 'admin', '127.0.0.1', '2013-09-08 12:31:03', 'EvaluatorCriteria', 'CREATE', 'User admin created EvaluatorCriteria[9,6].'),
(41, 'admin', '127.0.0.1', '2013-09-08 12:31:07', 'EvaluatorCriteria', 'CREATE', 'User admin created EvaluatorCriteria[9,7].'),
(42, 'admin', '127.0.0.1', '2013-09-08 12:31:11', 'EvaluatorCriteria', 'CREATE', 'User admin created EvaluatorCriteria[9,8].'),
(43, 'root', '127.0.0.1', '2013-09-08 12:56:02', 'Evaluator', 'CREATE', 'User root created Evaluator[10].'),
(44, 'root', '127.0.0.1', '2013-09-08 12:59:17', 'Evaluator', 'Update', 'User root changed username for Evaluator[10].'),
(45, 'root', '127.0.0.1', '2013-09-08 12:59:34', 'Evaluator', 'DELETE', 'User root deleted Evaluator[10].'),
(46, 'root', '127.0.0.1', '2013-09-08 13:00:55', 'Evaluator', 'Update', 'User root changed psswd_hash for Evaluator[7].'),
(47, 'root', '127.0.0.1', '2013-09-08 13:01:43', 'Evaluator', 'Update', 'User root changed psswd_hash for Evaluator[8].'),
(48, 'root', '127.0.0.1', '2013-09-08 13:01:56', 'Evaluator', 'Update', 'User root changed psswd_hash for Evaluator[9].'),
(49, 'proserve', '127.0.0.1', '2013-09-08 13:03:58', 'Evaluator', 'Update', 'User proserve changed psswd_hash for Evaluator[8].'),
(50, 'admin', '127.0.0.1', '2013-09-08 13:05:18', 'Evaluator', 'Update', 'User admin changed psswd_hash for Evaluator[9].'),
(51, 'admin', '127.0.0.1', '2013-09-08 23:20:38', 'EvaluatorCriteria', 'Update', 'User admin changed mark for EvaluatorCriteria[9,2].'),
(52, 'admin', '127.0.0.1', '2013-09-08 23:20:50', 'EvaluatorCriteria', 'Update', 'User admin changed mark for EvaluatorCriteria[9,1].'),
(53, 'admin', '127.0.0.1', '2013-09-08 23:35:30', 'EvaluatorCriteria', 'Update', 'User admin changed mark for EvaluatorCriteria[9,3].'),
(54, 'root', '127.0.0.1', '2013-09-09 14:18:35', 'Evaluator', 'CREATE', 'User root created Evaluator[10].'),
(55, 'ABK', '127.0.0.1', '2013-09-09 14:19:10', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,2].'),
(56, 'ABK', '127.0.0.1', '2013-09-09 14:22:49', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(57, 'ABK', '127.0.0.1', '2013-09-09 17:08:06', 'Evaluator', 'Update', 'User ABK changed psswd_hash for Evaluator[10].'),
(58, 'ABK', '127.0.0.1', '2013-09-09 17:09:02', 'Evaluator', 'Update', 'User ABK changed psswd_hash for Evaluator[10].'),
(59, 'ABK', '127.0.0.1', '2013-09-10 09:33:56', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,3].'),
(60, 'ABK', '127.0.0.1', '2013-09-10 09:34:04', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,4].'),
(61, 'ABK', '127.0.0.1', '2013-09-10 09:34:12', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,5].'),
(62, 'ABK', '127.0.0.1', '2013-09-10 09:34:28', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(63, 'ABK', '127.0.0.1', '2013-09-10 09:37:06', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,6].'),
(64, 'ABK', '127.0.0.1', '2013-09-10 10:02:26', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,7].'),
(65, 'ABK', '127.0.0.1', '2013-09-10 10:04:28', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,8].'),
(66, 'ABK', '127.0.0.1', '2013-09-10 10:11:36', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(67, 'ABK', '127.0.0.1', '2013-09-10 10:13:01', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(68, 'ABK', '127.0.0.1', '2013-09-10 10:13:05', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(69, 'ABK', '127.0.0.1', '2013-09-10 10:13:16', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(70, 'ABK', '127.0.0.1', '2013-09-10 10:16:33', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(71, 'ABK', '127.0.0.1', '2013-09-10 10:18:13', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(72, 'ABK', '127.0.0.1', '2013-09-10 10:18:20', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(73, 'ABK', '127.0.0.1', '2013-09-10 10:20:36', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(74, 'ABK', '127.0.0.1', '2013-09-10 10:21:48', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(75, 'ABK', '127.0.0.1', '2013-09-10 10:22:48', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(76, 'ABK', '127.0.0.1', '2013-09-10 10:23:11', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(77, 'ABK', '127.0.0.1', '2013-09-10 10:23:24', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,1].'),
(78, 'ABK', '127.0.0.1', '2013-09-10 10:28:39', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,1].'),
(79, 'ABK', '127.0.0.1', '2013-09-10 10:28:52', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,1].'),
(80, 'ABK', '127.0.0.1', '2013-09-10 10:29:14', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,1].'),
(81, 'ABK', '127.0.0.1', '2013-09-10 10:32:07', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,1].'),
(82, 'ABK', '127.0.0.1', '2013-09-10 10:32:22', 'Evaluator', 'Update', 'User ABK changed psswd_hash for Evaluator[10].'),
(83, 'root', '127.0.0.1', '2013-09-10 11:19:49', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[7,1].'),
(84, 'ABK', '127.0.0.1', '2013-09-10 11:21:35', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(85, 'ABK', '127.0.0.1', '2013-09-10 11:24:04', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,2].'),
(86, 'ABK', '127.0.0.1', '2013-09-10 11:26:36', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,4].'),
(87, 'ABK', '127.0.0.1', '2013-09-10 11:27:20', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,3].'),
(88, 'ABK', '127.0.0.1', '2013-09-10 11:27:54', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,7].'),
(89, 'ABK', '127.0.0.1', '2013-09-10 11:29:00', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,5].'),
(90, 'ABK', '127.0.0.1', '2013-09-10 11:33:03', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,6].'),
(91, 'ABK', '127.0.0.1', '2013-09-10 11:34:50', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,8].'),
(92, 'ABK', '127.0.0.1', '2013-09-10 11:38:34', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,4].'),
(93, 'ABK', '127.0.0.1', '2013-09-10 11:38:49', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(94, 'ABK', '127.0.0.1', '2013-09-10 13:07:59', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(95, 'ABK', '127.0.0.1', '2013-09-10 13:08:15', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(96, 'ABK', '127.0.0.1', '2013-09-10 13:08:32', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,4].'),
(97, 'ABK', '127.0.0.1', '2013-09-10 13:16:07', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,3].'),
(98, 'ABK', '127.0.0.1', '2013-09-10 13:40:30', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,2].'),
(99, 'ABK', '127.0.0.1', '2013-09-10 13:57:04', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(100, 'ABK', '127.0.0.1', '2013-09-10 13:57:55', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,6].'),
(101, 'ABK', '127.0.0.1', '2013-09-10 13:58:57', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,7].'),
(102, 'ABK', '127.0.0.1', '2013-09-10 13:59:23', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,8].'),
(103, 'ABK', '127.0.0.1', '2013-09-10 13:59:50', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(104, 'ABK', '127.0.0.1', '2013-09-10 14:00:01', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(105, 'ABK', '127.0.0.1', '2013-09-10 14:00:24', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(106, 'ABK', '127.0.0.1', '2013-09-10 14:00:30', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(107, 'ABK', '127.0.0.1', '2013-09-10 14:01:03', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(108, 'ABK', '127.0.0.1', '2013-09-10 14:01:10', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(109, 'ABK', '127.0.0.1', '2013-09-10 14:03:32', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(110, 'ABK', '127.0.0.1', '2013-09-10 14:03:37', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(111, 'ABK', '127.0.0.1', '2013-09-10 14:04:01', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(112, 'ABK', '127.0.0.1', '2013-09-10 14:04:08', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(113, 'ABK', '127.0.0.1', '2013-09-10 14:05:18', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(114, 'ABK', '127.0.0.1', '2013-09-10 14:05:22', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(115, 'ABK', '127.0.0.1', '2013-09-10 14:06:13', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,5].'),
(116, 'ABK', '127.0.0.1', '2013-09-10 14:09:12', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(117, 'ABK', '127.0.0.1', '2013-09-10 14:09:21', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(118, 'ABK', '127.0.0.1', '2013-09-10 14:11:15', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,2].'),
(119, 'ABK', '127.0.0.1', '2013-09-10 14:53:44', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,3].'),
(120, 'ABK', '127.0.0.1', '2013-09-10 14:53:46', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(121, 'ABK', '127.0.0.1', '2013-09-10 15:18:05', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(122, 'ABK', '127.0.0.1', '2013-09-10 15:18:23', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,2].'),
(123, 'ABK', '127.0.0.1', '2013-09-10 15:18:37', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,3].'),
(124, 'ABK', '127.0.0.1', '2013-09-10 15:52:45', 'Evaluator', 'Update', 'User ABK changed psswd_hash for Evaluator[10].'),
(125, 'proserve', '127.0.0.1', '2013-09-10 19:03:23', 'EvaluatorCriteria', 'Update', 'User proserve changed mark for EvaluatorCriteria[8,5].'),
(126, 'proserve', '127.0.0.1', '2013-09-10 19:33:25', 'EvaluatorCriteria', 'DELETE', 'User proserve deleted EvaluatorCriteria[8,1].'),
(127, 'ABK', '127.0.0.1', '2013-09-11 05:20:09', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,7].'),
(128, 'ABK', '127.0.0.1', '2013-09-11 05:20:48', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,8].'),
(129, 'ABK', '127.0.0.1', '2013-09-11 05:22:44', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,8].'),
(130, 'ABK', '127.0.0.1', '2013-09-11 05:54:38', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,7].'),
(131, 'ABK', '127.0.0.1', '2013-09-11 05:56:04', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,7].'),
(132, 'ABK', '127.0.0.1', '2013-09-11 05:57:10', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,7].'),
(133, 'ABK', '127.0.0.1', '2013-09-11 06:28:22', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,1].'),
(134, 'ABK', '127.0.0.1', '2013-09-11 06:29:24', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,1].'),
(135, 'ABK', '127.0.0.1', '2013-09-11 06:37:48', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,7].'),
(136, 'ABK', '127.0.0.1', '2013-09-11 06:40:37', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,7].'),
(137, 'ABK', '127.0.0.1', '2013-09-11 06:43:16', 'EvaluatorCriteria', 'Update', 'User ABK changed mark for EvaluatorCriteria[10,1].'),
(138, 'ABK', '127.0.0.1', '2013-09-11 08:12:25', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(139, 'ABK', '127.0.0.1', '2013-09-11 08:52:45', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(140, 'ABK', '127.0.0.1', '2013-09-11 08:54:02', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,1].'),
(141, 'ABK', '127.0.0.1', '2013-09-11 08:54:22', 'EvaluatorCriteria', 'DELETE', 'User ABK deleted EvaluatorCriteria[10,3].'),
(142, 'ABK', '127.0.0.1', '2013-09-11 09:00:54', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,3].'),
(143, 'ABK', '127.0.0.1', '2013-09-11 09:01:42', 'EvaluatorCriteria', 'CREATE', 'User ABK created EvaluatorCriteria[10,1].'),
(144, 'root', '127.0.0.1', '2013-09-11 10:15:37', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,1].'),
(145, 'root', '127.0.0.1', '2013-09-11 10:17:45', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[7,1].'),
(146, 'root', '127.0.0.1', '2013-09-11 10:42:51', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,1].'),
(147, 'root', '127.0.0.1', '2013-09-11 10:44:41', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[7,1].'),
(148, 'root', '127.0.0.1', '2013-09-11 10:45:41', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,1].'),
(149, 'root', '127.0.0.1', '2013-09-11 11:06:53', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[7,4].'),
(150, 'root', '127.0.0.1', '2013-09-11 11:08:51', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,4].'),
(151, 'root', '127.0.0.1', '2013-09-11 17:57:19', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2].'),
(152, 'root', '127.0.0.1', '2013-09-11 17:58:57', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2].'),
(153, 'root', '127.0.0.1', '2013-09-11 17:59:57', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2].'),
(154, 'root', '127.0.0.1', '2013-09-11 18:46:46', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F3].'),
(155, 'root', '127.0.0.1', '2013-09-11 18:46:51', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F3].'),
(156, 'root', '127.0.0.1', '2013-09-11 22:35:51', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F4,F1].'),
(157, 'root', '127.0.0.1', '2013-09-12 04:48:54', 'Evaluator', 'CREATE', 'User root created Evaluator[11].'),
(158, 'test', '127.0.0.1', '2013-09-12 04:49:54', 'EvaluatorCriteria', 'CREATE', 'User test created EvaluatorCriteria[11,2].'),
(159, 'test', '127.0.0.1', '2013-09-12 04:50:01', 'EvaluatorCriteria', 'CREATE', 'User test created EvaluatorCriteria[11,1].'),
(160, 'root', '127.0.0.1', '2013-09-12 04:51:16', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[7,2].'),
(161, 'root', '127.0.0.1', '2013-09-12 04:51:20', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[7,1].'),
(162, 'root', '127.0.0.1', '2013-09-12 04:52:27', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[7,3].'),
(163, 'root', '127.0.0.1', '2013-09-12 04:56:05', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,1].'),
(164, 'root', '127.0.0.1', '2013-09-12 04:56:18', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[7,1].'),
(165, 'root', '127.0.0.1', '2013-09-12 05:08:54', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[11,1].'),
(166, 'root', '127.0.0.1', '2013-09-12 05:09:04', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[8,3].'),
(167, 'root', '127.0.0.1', '2013-09-12 05:12:38', 'EvaluatorCriteria', 'DELETE', 'User root deleted EvaluatorCriteria[11,2].'),
(168, 'root', '127.0.0.1', '2013-09-12 05:12:49', 'Evaluator', 'DELETE', 'User root deleted Evaluator[11].'),
(169, 'root', '127.0.0.1', '2013-09-12 05:13:14', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,2].'),
(170, 'root', '127.0.0.1', '2013-09-12 05:13:22', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,3].'),
(171, 'root', '127.0.0.1', '2013-09-12 05:13:29', 'EvaluatorCriteria', 'CREATE', 'User root created EvaluatorCriteria[7,1].'),
(172, 'root', '127.0.0.1', '2013-09-12 05:49:28', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F2,F3].'),
(173, 'root', '127.0.0.1', '2013-09-12 05:50:03', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F1,F3].'),
(174, 'root', '127.0.0.1', '2013-09-12 05:52:16', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F1,F3].'),
(175, 'root', '127.0.0.1', '2013-09-12 05:52:16', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F1,F3].'),
(176, 'root', '127.0.0.1', '2013-09-12 05:58:44', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F1,F3].'),
(177, 'root', '127.0.0.1', '2013-09-12 05:58:44', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F1,F3].'),
(178, 'root', '127.0.0.1', '2013-09-12 05:58:59', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F1,F2].'),
(179, 'root', '127.0.0.1', '2013-09-12 05:59:01', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F2,F3].'),
(180, 'root', '127.0.0.1', '2013-09-12 05:59:03', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F4,F1].'),
(181, 'root', '127.0.0.1', '2013-09-12 06:02:17', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F4,F1].'),
(182, 'root', '127.0.0.1', '2013-09-12 06:03:50', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F1,F2].'),
(183, 'root', '127.0.0.1', '2013-09-12 06:03:50', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F1,F2].'),
(184, 'root', '127.0.0.1', '2013-09-12 06:38:44', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2,1].'),
(185, 'root', '127.0.0.1', '2013-09-12 06:41:11', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F3,1].'),
(186, 'root', '127.0.0.1', '2013-09-12 06:47:22', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F1,F2,1].'),
(187, 'root', '127.0.0.1', '2013-09-12 06:47:23', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F1,F2,1].'),
(188, 'root', '127.0.0.1', '2013-09-12 06:47:39', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F2,1].'),
(189, 'root', '127.0.0.1', '2013-09-12 06:47:51', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F1,F3,1].'),
(190, 'root', '127.0.0.1', '2013-09-12 06:58:17', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F1,1].'),
(191, 'root', '127.0.0.1', '2013-09-12 06:58:24', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F3,5].'),
(192, 'root', '127.0.0.1', '2013-09-12 06:58:30', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F3,2].'),
(193, 'root', '127.0.0.1', '2013-09-12 06:58:54', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F3,1].'),
(194, 'root', '127.0.0.1', '2013-09-12 06:59:46', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F3,2].'),
(195, 'root', '127.0.0.1', '2013-09-14 11:17:49', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F3,F1,1].'),
(196, 'root', '127.0.0.1', '2013-09-14 11:17:54', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F2,F3,5].'),
(197, 'root', '127.0.0.1', '2013-09-14 11:17:59', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F2,F3,2].'),
(198, 'root', '127.0.0.1', '2013-09-14 11:18:02', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F2,F3,1].'),
(199, 'root', '127.0.0.1', '2013-09-14 11:18:03', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F3,2].'),
(200, 'root', '127.0.0.1', '2013-09-14 11:18:06', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F3,1].'),
(201, 'root', '127.0.0.1', '2013-09-14 12:06:47', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F1,1].'),
(202, 'root', '127.0.0.1', '2013-09-14 12:14:08', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2,1].'),
(203, 'root', '127.0.0.1', '2013-09-14 12:14:20', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F2,F1,1].'),
(204, 'root', '127.0.0.1', '2013-09-14 13:05:33', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F2,2].'),
(205, 'root', '127.0.0.1', '2013-09-14 13:14:46', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F3,F2,2].'),
(206, 'root', '127.0.0.1', '2013-09-14 13:14:46', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F3,F2,2].'),
(207, 'root', '127.0.0.1', '2013-09-14 13:14:56', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F3,F2,2].'),
(208, 'root', '127.0.0.1', '2013-09-14 13:14:56', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F3,F2,2].'),
(209, 'root', '127.0.0.1', '2013-09-14 13:15:05', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F3,F2,2].'),
(210, 'root', '127.0.0.1', '2013-09-14 13:15:17', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F1,F2,1].'),
(211, 'root', '127.0.0.1', '2013-09-14 13:28:43', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F2,4].'),
(212, 'root', '127.0.0.1', '2013-09-14 13:29:07', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F3,4].'),
(213, 'root', '127.0.0.1', '2013-09-14 13:31:54', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F5,1].'),
(214, 'root', '127.0.0.1', '2013-09-14 13:34:02', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F1,1].'),
(215, 'root', '127.0.0.1', '2013-09-14 13:51:15', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F5,F1,3].'),
(216, 'root', '127.0.0.1', '2013-09-14 13:51:59', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F5,F3,3].'),
(217, 'root', '127.0.0.1', '2013-09-14 13:53:16', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F2,3].'),
(218, 'root', '127.0.0.1', '2013-09-14 13:54:00', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F3,8].'),
(219, 'admin', '127.0.0.1', '2013-09-14 13:59:23', 'EvaluatorCriteria', 'DELETE', 'User admin deleted EvaluatorCriteria[9,1].'),
(220, 'admin', '127.0.0.1', '2013-09-14 14:02:02', 'EvaluatorCriteria', 'DELETE', 'User admin deleted EvaluatorCriteria[9,2].'),
(221, 'root', '127.0.0.1', '2013-09-14 14:13:45', 'Evaluator', 'DELETE', 'User root deleted Evaluator[10].'),
(222, 'root', '127.0.0.1', '2013-09-14 14:14:56', 'Criteria', 'DELETE', 'User root deleted Criteria[3].'),
(223, 'root', '127.0.0.1', '2013-09-14 15:39:15', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F125,F2,1].'),
(224, 'root', '127.0.0.1', '2013-09-14 15:39:21', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F3,F125,1].'),
(225, 'root', '127.0.0.1', '2013-09-14 15:45:55', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F3,F2,4].'),
(226, 'root', '127.0.0.1', '2013-09-14 15:46:06', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F3,F2,4].'),
(227, 'root', '127.0.0.1', '2013-09-14 15:47:16', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F2,4].'),
(228, 'root', '127.0.0.1', '2013-09-14 15:47:55', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F3,2].'),
(229, 'root', '127.0.0.1', '2013-09-14 16:29:52', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F125,8].'),
(230, 'root', '127.0.0.1', '2013-09-14 16:30:11', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F3,F125,8].'),
(231, 'root', '127.0.0.1', '2013-09-14 16:30:13', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F3,F2,2].'),
(232, 'root', '127.0.0.1', '2013-09-14 16:32:40', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F3,F2,4].'),
(233, 'root', '127.0.0.1', '2013-09-14 17:28:57', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F125,F2,8].'),
(234, 'root', '127.0.0.1', '2013-09-14 17:32:00', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F2,8].'),
(235, 'root', '127.0.0.1', '2013-09-14 17:32:13', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F125,F2,8].'),
(236, 'root', '127.0.0.1', '2013-09-14 17:33:05', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2,8].'),
(237, 'root', '127.0.0.1', '2013-09-14 17:33:34', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2,5].'),
(238, 'root', '127.0.0.1', '2013-09-14 17:33:46', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F3,5].'),
(239, 'root', '127.0.0.1', '2013-09-14 17:33:59', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F3,5].'),
(240, 'root', '127.0.0.1', '2013-09-14 17:34:25', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F1,4].'),
(241, 'root', '127.0.0.1', '2013-09-14 17:34:36', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F1,4].'),
(242, 'root', '127.0.0.1', '2013-09-14 17:35:09', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2,2].'),
(243, 'root', '127.0.0.1', '2013-09-14 17:35:18', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F1,2].'),
(244, 'root', '127.0.0.1', '2013-09-14 17:35:31', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2,6].'),
(245, 'root', '127.0.0.1', '2013-09-14 17:35:45', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F3,6].'),
(246, 'root', '127.0.0.1', '2013-09-14 17:36:04', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F3,6].'),
(247, 'root', '127.0.0.1', '2013-09-14 17:36:42', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F3,F1,2].'),
(248, 'root', '127.0.0.1', '2013-09-14 17:37:48', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F3,F1,2].'),
(249, 'root', '127.0.0.1', '2013-09-14 17:38:09', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F3,F1,2].'),
(250, 'root', '127.0.0.1', '2013-09-14 17:38:50', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F3,F1,2].'),
(251, 'root', '127.0.0.1', '2013-09-14 17:38:56', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F2,5].'),
(252, 'root', '127.0.0.1', '2013-09-14 17:38:57', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F3,6].'),
(253, 'root', '127.0.0.1', '2013-09-14 17:38:57', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F2,F1,4].'),
(254, 'root', '127.0.0.1', '2013-09-14 17:38:58', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F2,F3,6].'),
(255, 'root', '127.0.0.1', '2013-09-14 17:38:59', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F3,F1,4].'),
(256, 'root', '127.0.0.1', '2013-09-14 17:39:18', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2,5].'),
(257, 'root', '127.0.0.1', '2013-09-14 17:39:50', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2,4].'),
(258, 'root', '127.0.0.1', '2013-09-14 17:40:01', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F1,4].'),
(259, 'root', '127.0.0.1', '2013-09-14 17:40:15', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F1,2].'),
(260, 'root', '127.0.0.1', '2013-09-14 17:48:34', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F1,6].'),
(261, 'root', '127.0.0.1', '2013-09-14 17:48:47', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F3,6].'),
(262, 'root', '127.0.0.1', '2013-09-15 13:29:29', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F4,8].'),
(263, 'root', '127.0.0.1', '2013-09-15 13:29:35', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F4,8].'),
(264, 'root', '127.0.0.1', '2013-09-15 13:29:42', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F4,8].'),
(265, 'root', '127.0.0.1', '2013-09-15 13:30:00', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F4,5].'),
(266, 'root', '127.0.0.1', '2013-09-15 13:30:09', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F4,5].'),
(267, 'root', '127.0.0.1', '2013-09-15 13:30:17', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F4,5].'),
(268, 'root', '127.0.0.1', '2013-09-15 13:30:27', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F4,4].'),
(269, 'root', '127.0.0.1', '2013-09-15 13:30:37', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F4,4].'),
(270, 'root', '127.0.0.1', '2013-09-15 13:30:49', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F4,4].'),
(271, 'root', '127.0.0.1', '2013-09-15 13:31:00', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F4,2].'),
(272, 'root', '127.0.0.1', '2013-09-15 13:31:07', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F4,2].'),
(273, 'root', '127.0.0.1', '2013-09-15 13:31:14', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F4,2].'),
(274, 'root', '127.0.0.1', '2013-09-15 13:31:25', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F4,6].'),
(275, 'root', '127.0.0.1', '2013-09-15 13:31:29', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F4,6].'),
(276, 'root', '127.0.0.1', '2013-09-15 13:31:34', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F4,6].'),
(277, 'root', '127.0.0.1', '2013-09-15 21:51:33', 'ProviderCompare', 'Update', 'User root changed mark for ProviderCompare[F2,F4,4].'),
(278, 'root', '127.0.0.1', '2013-09-15 21:51:33', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F2,F4,4].'),
(279, 'root', '127.0.0.1', '2013-09-15 21:51:50', 'ProviderCompare', 'Update', 'User root changed comp for ProviderCompare[F2,F4,4].'),
(280, 'root', '127.0.0.1', '2013-09-16 09:57:40', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F2,2].'),
(281, 'root', '127.0.0.1', '2013-09-16 09:58:09', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F1,2].'),
(282, 'root', '127.0.0.1', '2013-09-16 10:10:43', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F2,4].'),
(283, 'root', '127.0.0.1', '2013-09-16 10:11:20', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F1,4].'),
(284, 'root', '127.0.0.1', '2013-09-16 10:13:54', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F3,5].'),
(285, 'root', '127.0.0.1', '2013-09-16 10:17:03', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F1,5].'),
(286, 'root', '127.0.0.1', '2013-09-16 10:18:20', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F2,6].'),
(287, 'root', '127.0.0.1', '2013-09-16 10:19:11', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F2,6].'),
(288, 'root', '127.0.0.1', '2013-09-16 10:22:49', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F4,2].'),
(289, 'root', '127.0.0.1', '2013-09-16 11:12:06', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F1,F4,2].'),
(290, 'root', '127.0.0.1', '2013-09-16 12:14:44', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[9,4].'),
(291, 'root', '127.0.0.1', '2013-09-16 12:14:45', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[8,4].'),
(292, 'root', '127.0.0.1', '2013-09-16 12:14:48', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[7,4].'),
(293, 'root', '127.0.0.1', '2013-09-16 12:17:41', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[8,4].'),
(294, 'root', '127.0.0.1', '2013-09-16 12:17:43', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[7,4].'),
(295, 'root', '127.0.0.1', '2013-09-16 12:19:06', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[8,4].'),
(296, 'root', '127.0.0.1', '2013-09-16 12:19:08', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[7,4].'),
(297, 'root', '127.0.0.1', '2013-09-16 12:19:39', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[7,4].'),
(298, 'root', '127.0.0.1', '2013-09-16 12:19:42', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[8,4].'),
(299, 'root', '127.0.0.1', '2013-09-16 12:40:39', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[7,1].'),
(300, 'proserve', '127.0.0.1', '2013-09-16 12:43:07', 'EvaluatorCriteria', 'CREATE', 'User proserve created EvaluatorCriteria[8,1].'),
(301, 'admin', '127.0.0.1', '2013-09-16 12:44:45', 'EvaluatorCriteria', 'CREATE', 'User admin created EvaluatorCriteria[9,2].'),
(302, 'admin', '127.0.0.1', '2013-09-16 12:44:52', 'EvaluatorCriteria', 'CREATE', 'User admin created EvaluatorCriteria[9,1].'),
(303, 'root', '127.0.0.1', '2013-09-16 12:49:10', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F1,1].'),
(304, 'root', '127.0.0.1', '2013-09-16 12:49:24', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F1,1].'),
(305, 'root', '127.0.0.1', '2013-09-16 12:50:20', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F4,F1,1].'),
(306, 'root', '127.0.0.1', '2013-09-16 12:50:34', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F4,F3,1].'),
(307, 'root', '127.0.0.1', '2013-09-16 12:50:42', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F2,F4,1].'),
(308, 'root', '127.0.0.1', '2013-09-16 12:50:52', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F2,1].'),
(309, 'root', '127.0.0.1', '2013-09-16 12:53:27', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[7,4].'),
(310, 'root', '127.0.0.1', '2013-09-16 12:53:30', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[8,4].'),
(311, 'root', '127.0.0.1', '2013-09-16 12:56:54', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[9,5].'),
(312, 'root', '127.0.0.1', '2013-09-16 12:59:02', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[7,5].'),
(313, 'root', '127.0.0.1', '2013-09-16 14:54:38', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F1,F2,6].'),
(314, 'root', '127.0.0.1', '2013-09-16 14:55:13', 'ProviderCompare', 'DELETE', 'User root deleted ProviderCompare[F3,F2,1].'),
(315, 'root', '127.0.0.1', '2013-09-16 14:58:01', 'ProviderCompare', 'CREATE', 'User root created ProviderCompare[F3,F2,1].'),
(316, 'root', '127.0.0.1', '2013-09-16 16:05:55', 'EvaluatorCriteria', 'Update', 'User root changed mark for EvaluatorCriteria[9,2].'),
(317, 'root', '127.0.0.1', '2013-09-18 15:14:56', 'Evaluator', 'CREATE', 'User root created Evaluator[10].'),
(318, 'root', '127.0.0.1', '2013-09-18 19:23:48', 'Evaluator', 'DELETE', 'User root deleted Evaluator[10].'),
(319, 'root', '127.0.0.1', '2013-09-18 19:25:19', 'Evaluator', 'CREATE', 'User root created Evaluator[11].'),
(320, 'root', '127.0.0.1', '2013-09-18 19:27:42', 'Evaluator', 'DELETE', 'User root deleted Evaluator[11].'),
(321, 'root', '127.0.0.1', '2013-09-18 19:27:49', 'Evaluator', 'CREATE', 'User root created Evaluator[12].'),
(322, 'root', '127.0.0.1', '2013-09-18 19:37:16', 'Evaluator', 'DELETE', 'User root deleted Evaluator[12].'),
(323, 'root', '127.0.0.1', '2013-09-18 19:37:27', 'Evaluator', 'CREATE', 'User root created Evaluator[13].'),
(324, 'root', '127.0.0.1', '2013-09-18 19:38:45', 'Evaluator', 'DELETE', 'User root deleted Evaluator[13].'),
(325, 'root', '127.0.0.1', '2013-09-18 19:39:07', 'Evaluator', 'CREATE', 'User root created Evaluator[14].'),
(326, 'root', '127.0.0.1', '2013-09-18 19:39:55', 'Evaluator', 'DELETE', 'User root deleted Evaluator[14].'),
(327, 'root', '127.0.0.1', '2013-09-18 19:53:54', 'Evaluator', 'CREATE', 'User root created Evaluator[15].'),
(328, 'root', '127.0.0.1', '2013-09-18 20:58:26', 'Evaluator', 'Update', 'User root changed psswd_hash for Evaluator[15].'),
(329, 'root', '127.0.0.1', '2013-09-18 21:15:21', 'Criteria', 'CREATE', 'User root created Criteria[9].'),
(330, 'root', '127.0.0.1', '2013-09-18 21:18:21', 'Criteria', 'DELETE', 'User root deleted Criteria[9].'),
(331, 'root', '127.0.0.1', '2013-09-18 21:19:08', 'Criteria', 'CREATE', 'User root created Criteria[11].'),
(332, 'root', '127.0.0.1', '2013-09-18 21:19:34', 'Criteria', 'DELETE', 'User root deleted Criteria[11].'),
(333, 'root', '127.0.0.1', '2013-09-18 21:20:48', 'Criteria', 'CREATE', 'User root created Criteria[12].');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ps_concern`
--
ALTER TABLE `ps_concern`
  ADD CONSTRAINT `fk_appel_offre_concern` FOREIGN KEY (`appel_offre_id`) REFERENCES `ps_appel_offre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_criteria_concern` FOREIGN KEY (`criteria_id`) REFERENCES `ps_criteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ps_convoquer`
--
ALTER TABLE `ps_convoquer`
  ADD CONSTRAINT `fk_appel_offre_convoquer` FOREIGN KEY (`appel_offre_id`) REFERENCES `ps_appel_offre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evaluator_convoquer` FOREIGN KEY (`evaluator_id`) REFERENCES `ps_evaluator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ps_criteria_categorie`
--
ALTER TABLE `ps_criteria_categorie`
  ADD CONSTRAINT `fk_categorie_criteria` FOREIGN KEY (`categorie_id`) REFERENCES `ps_categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_criteria_categorie` FOREIGN KEY (`criteria_id`) REFERENCES `ps_criteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ps_evaluator_categorie`
--
ALTER TABLE `ps_evaluator_categorie`
  ADD CONSTRAINT `fk_categorie_evaluator` FOREIGN KEY (`categorie_id`) REFERENCES `ps_categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evaluator_categorie` FOREIGN KEY (`evaluator_id`) REFERENCES `ps_evaluator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ps_evaluator_criteria`
--
ALTER TABLE `ps_evaluator_criteria`
  ADD CONSTRAINT `fk_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `ps_criteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evaluator` FOREIGN KEY (`evaluator_id`) REFERENCES `ps_evaluator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ps_participe`
--
ALTER TABLE `ps_participe`
  ADD CONSTRAINT `fk_appel_offre_participe` FOREIGN KEY (`appel_offre_id`) REFERENCES `ps_appel_offre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_provider_participe` FOREIGN KEY (`provider_id`) REFERENCES `ps_provider` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ps_provider_compare`
--
se-- Base de données: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE IF NOT EXISTS `ps_evaluator_criteria` (
  `evaluator_id` int(10) unsigned NOT NULL,
  `criteria_id` int(10) unsigned NOT NULL,
  `appel_offre_id` int(10) unsigned NOT NULL,
  `mark` float NOT NULL,
  PRIMARY KEY (`evaluator_id`, `criteria_id`, `appel_offre_id`),
  CONSTRAINT `fk_evaluator` FOREIGN key (`evaluator_id`) REFERENCES `ps_evaluator`(`id`),
  CONSTRAINT `fk_criteria` FOREIGN key (`criteria_id`) REFERENCES `ps_criteria`(`id`),
  CONSTRAINT `fk_appel_offre` FOREIGN key (`appel_offre_id`) REFERENCES `ps_appel_offre`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `ps_evaluator_criteria` (
  `provider_a_id` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `provider_b_id` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `criteria_id` int(10) unsigned NOT NULL,
  `appel_offre_id` int(10) unsigned NOT NULL,
  `mark` float NOT NULL,
  `comp` varchar(3) COLLATE latin1_general_ci NOT NULL,

  PRIMARY KEY (`provider_a_id`,`provider_b_id`,`criteria_id`, `appel_offre_id`),
  CONSTRAINT `fk_provider_a` FOREIGN key (`provider_a_id`) REFERENCES `ps_provider`(`id`),
  CONSTRAINT `fk_provider_b` FOREIGN key (`provider_b_id`) REFERENCES `ps_provider`(`id`),
  CONSTRAINT `fk_criteria` FOREIGN key (`criteria_id`) REFERENCES `ps_criteria`(`id`),
  CONSTRAINT `fk_appel_offre` FOREIGN key (`appel_offre_id`) REFERENCES `ps_appel_offre`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;