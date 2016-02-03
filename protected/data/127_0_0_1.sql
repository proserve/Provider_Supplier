-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Mer 11 Septembre 2013 à 07:14
-- Version du serveur: 5.5.32
-- Version de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cdcol`
--
CREATE DATABASE IF NOT EXISTS `cdcol` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `cdcol`;

-- --------------------------------------------------------

--
-- Structure de la table `cds`
--

CREATE TABLE IF NOT EXISTS `cds` (
  `titel` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `interpret` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `jahr` int(11) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `cds`
--

INSERT INTO `cds` (`titel`, `interpret`, `jahr`, `id`) VALUES
('Beauty', 'Ryuichi Sakamoto', 1990, 1),
('Goodbye Country (Hello Nightclub)', 'Groove Armada', 2001, 4),
('Glee', 'Bran Van 3000', 1997, 5);
--
-- Base de données: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Structure de la table `pma_bookmark`
--

CREATE TABLE IF NOT EXISTS `pma_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pma_column_info`
--

CREATE TABLE IF NOT EXISTS `pma_column_info` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin' AUTO_INCREMENT=2 ;

--
-- Contenu de la table `pma_column_info`
--

INSERT INTO `pma_column_info` (`id`, `db_name`, `table_name`, `column_name`, `comment`, `mimetype`, `transformation`, `transformation_options`) VALUES
(1, 'providerselector', 'ps_evaluator_criteria', 'mark', '', '', '_', '');

-- --------------------------------------------------------

--
-- Structure de la table `pma_designer_coords`
--

CREATE TABLE IF NOT EXISTS `pma_designer_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `v` tinyint(4) DEFAULT NULL,
  `h` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for Designer';

-- --------------------------------------------------------

--
-- Structure de la table `pma_history`
--

CREATE TABLE IF NOT EXISTS `pma_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`,`db`,`table`,`timevalue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pma_pdf_pages`
--

CREATE TABLE IF NOT EXISTS `pma_pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`page_nr`),
  KEY `db_name` (`db_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pma_recent`
--

CREATE TABLE IF NOT EXISTS `pma_recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Contenu de la table `pma_recent`
--

INSERT INTO `pma_recent` (`username`, `tables`) VALUES
('root', '[{"db":"providerselector","table":"ps_criteria"},{"db":"providerselector","table":"ps_evaluator_criteria"},{"db":"providerselector","table":"ps_evaluator"},{"db":"providerselector","table":"ps_user_log"},{"db":"phpmyadmin","table":"pma_column_info"},{"db":"phpmyadmin","table":"pma_designer_coords"},{"db":"phpmyadmin","table":"pma_history"},{"db":"phpmyadmin","table":"pma_pdf_pages"},{"db":"phpmyadmin","table":"pma_recent"},{"db":"phpmyadmin","table":"pma_relation"}]');

-- --------------------------------------------------------

--
-- Structure de la table `pma_relation`
--

CREATE TABLE IF NOT EXISTS `pma_relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  KEY `foreign_field` (`foreign_db`,`foreign_table`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Structure de la table `pma_table_coords`
--

CREATE TABLE IF NOT EXISTS `pma_table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float unsigned NOT NULL DEFAULT '0',
  `y` float unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Structure de la table `pma_table_info`
--

CREATE TABLE IF NOT EXISTS `pma_table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma_table_uiprefs`
--

CREATE TABLE IF NOT EXISTS `pma_table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Contenu de la table `pma_table_uiprefs`
--

INSERT INTO `pma_table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'providerselector', 'ps_evaluator_criteria', '{"sorted_col":"`ps_evaluator_criteria`.`evaluator_id` ASC"}', '2013-09-10 13:13:43');

-- --------------------------------------------------------

--
-- Structure de la table `pma_tracking`
--

CREATE TABLE IF NOT EXISTS `pma_tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`db_name`,`table_name`,`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma_userconfig`
--

CREATE TABLE IF NOT EXISTS `pma_userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Contenu de la table `pma_userconfig`
--

INSERT INTO `pma_userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2013-09-08 07:51:19', '{"lang":"fr"}');
--
-- Base de données: `provider`
--
CREATE DATABASE IF NOT EXISTS `provider` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `provider`;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `ps_criteria`
--

INSERT INTO `ps_criteria` (`id`, `name`, `description`) VALUES
(1, 'Speed', 'Duration ...'),
(2, 'Mantenance & Support', ''),
(3, 'Provider Reputation', 'Throught his old transactions'),
(4, 'Services Quality', ''),
(5, 'Transactions flexibilty', ''),
(6, 'Availability', ''),
(7, 'Experience', ''),
(8, 'Product Quality', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `ps_evaluator`
--

INSERT INTO `ps_evaluator` (`id`, `fist_name`, `last_name`, `function`, `username`, `psswd_hash`) VALUES
(7, 'Hamid', 'HAMADOUCHE', 'Procurment', 'root', '$1$3j2.OY5.$on4q4uDZJnlmbY0/73rW.0'),
(8, 'Khalid', 'GHIBOUB', 'IT information.', 'proserve', '$1$eZ2.Pt1.$UXsQ6TKe0w1XlH9aCPXov/'),
(9, 'Abdelatif', 'CHEBOUB', 'General Director -SEO.', 'admin', '$1$9l0.cM4.$ypxHC.0F3IfiuWSsP6b2P1'),
(10, 'abdelkader', 'tt', 'procurement', 'ABK', '$1$SY..zL1.$ZqHk8vJ/PHlgL7/NGop7T0');

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
(7, 2, 3),
(7, 3, 7),
(7, 4, 5),
(7, 5, 7),
(7, 6, 3),
(7, 7, 3),
(7, 8, 7),
(8, 2, 7),
(8, 3, 5),
(8, 4, 3),
(8, 5, 9),
(8, 6, 3),
(8, 7, 5),
(8, 8, 9),
(9, 1, 5),
(9, 2, 5),
(9, 3, 6.5),
(9, 4, 7),
(9, 5, 1),
(9, 6, 5),
(9, 7, 3),
(9, 8, 7),
(10, 1, 1),
(10, 2, 5),
(10, 3, 5),
(10, 4, 3),
(10, 5, 3),
(10, 6, 1),
(10, 7, 7),
(10, 8, 9);

-- --------------------------------------------------------

--
-- Structure de la table `ps_user`
--

CREATE TABLE IF NOT EXISTS `ps_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `psswd_hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ps_user`
--

INSERT INTO `ps_user` (`id`, `username`, `psswd_hash`) VALUES
(1, 'root', '$1$u.2.fH1.$lA/PwsQYl4oqfpcw6I6We/'),
(2, 'admin', '$1$cs3./R5.$YlHeu4d6Xfk10rxvEN76k1'),
(3, 'proserve', '$1$aH2.bc/.$W/UmNLwgtQCjR69nXXAjI0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

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
(126, 'proserve', '127.0.0.1', '2013-09-10 19:33:25', 'EvaluatorCriteria', 'DELETE', 'User proserve deleted EvaluatorCriteria[8,1].');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ps_evaluator_criteria`
--
ALTER TABLE `ps_evaluator_criteria`
  ADD CONSTRAINT `fk_criteria` FOREIGN KEY (`criteria_id`) REFERENCES `ps_criteria` (`id`),
  ADD CONSTRAINT `fk_evaluator` FOREIGN KEY (`evaluator_id`) REFERENCES `ps_evaluator` (`id`);
--
-- Base de données: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;
--
-- Base de données: `webauth`
--
CREATE DATABASE IF NOT EXISTS `webauth` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `webauth`;

-- --------------------------------------------------------

--
-- Structure de la table `user_pwd`
--

CREATE TABLE IF NOT EXISTS `user_pwd` (
  `name` char(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pass` char(32) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `user_pwd`
--

INSERT INTO `user_pwd` (`name`, `pass`) VALUES
('xampp', 'wampp');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE IF NOT EXISTS `ps_provider` (
  `id` varchar(10)  NOT NULL,
  `fist_name` varchar(256) DEFAULT NULL,
  `last_name` varchar(256) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `ps_provider_compare` (
  `provider_a_id` varchar(10)  NOT NULL,
  `provider_b_id` varchar(10)  NOT NULL,
  `criteria_id` int(10) unsigned NOT NULL,
  `appel_offre_id` int(10) unsigned NOT NULL,
  `mark` float(3) NOT NULL,
  `comp` varchar(3) NOT NULL,
  PRIMARY KEY (`provider_a_id`,`provider_b_id`,`criteria_id`, `appel_offre_id`),
  CONSTRAINT `fk_criteria_comp` FOREIGN key (`criteria_id`) REFERENCES `ps_criteria`(`id`),
  CONSTRAINT `fk_provider_a` FOREIGN key (`provider_a_id`) REFERENCES `ps_provider`(`id`),
  CONSTRAINT `fk_appel_offre_comp` FOREIGN key (`appel_offre_id`) REFERENCES `ps_appel_offre`(`id`),
  CONSTRAINT `fk_provider_b` FOREIGN key (`provider_b_id`) REFERENCES `ps_provider`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE IF NOT EXISTS `ps_appel_offre`(
 `id` varchar(10)  NOT NULL,
  `reference` varchar(256) DEFAULT NULL,
  `number` int(10) DEFAULT NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `dateDebut` date
)