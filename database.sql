-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_email` varchar(150) DEFAULT NULL,
  `admin_login` varchar(32) NOT NULL,
  `admin_password` varchar(40) NOT NULL,
  `admin_last_login` int(11) DEFAULT NULL,
  `admin_last_ip` varchar(45) DEFAULT NULL,
  `admin_last_browser` text DEFAULT NULL,
  `admin_group_id` int(11) NOT NULL,
  `admin_forgot_code` varchar(32) DEFAULT NULL,
  `admin_forgot_status` int(11) NOT NULL,
  `admin_status` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admins` (`admin_id`, `created`, `updated`, `created_by`, `updated_by`, `admin_name`, `admin_email`, `admin_login`, `admin_password`, `admin_last_login`, `admin_last_ip`, `admin_last_browser`, `admin_group_id`, `admin_forgot_code`, `admin_forgot_status`, `admin_status`) VALUES
(1,	1530809061,	1575815159,	'SinauID',	'SinauID',	'Imam Kusniadi',	'imamganz666@gmail.com',	'imamkusniadi',	'4427254d6887d297fe5c6d714dae05623937c9bc',	1575815159,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36',	1,	NULL,	2,	1);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admin_group`;
CREATE TABLE `admin_group` (
  `admin_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `admin_group_name` varchar(150) NOT NULL,
  `admin_group_role` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`admin_group_role`)),
  `admin_group_status` smallint(6) NOT NULL,
  PRIMARY KEY (`admin_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin_group` (`admin_group_id`, `created`, `updated`, `created_by`, `updated_by`, `admin_group_name`, `admin_group_role`, `admin_group_status`) VALUES
(1,	1575786337,	1575786337,	'SinauID',	'SinauID',	'Super Admin',	'{ \"admin\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"admin_group\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"answer\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"change_log\":{ \"index\":\"1\" }, \"exam_scedule\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"exam_status\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"exam\":{ \"index\":\"1\" }, \"participant\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"question_type\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"question\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"upload\":{ \"exam\":\"1\", \"answer\":\"1\", \"ktp\":\"1\" }, \"helper\":{ \"province\":\"1\", \"regencie\":\"1\" } }',	1);

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `question_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `answer_id` smallint(6) NOT NULL,
  `answer_text` text NOT NULL,
  `answer_image` text DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `change_logs`;
CREATE TABLE `change_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `controller` varchar(64) NOT NULL,
  `action` varchar(64) NOT NULL,
  `querystring` text DEFAULT NULL,
  `post` text DEFAULT NULL,
  `url` text NOT NULL,
  `ip` varchar(45) NOT NULL,
  `current_data` text DEFAULT NULL,
  `new_data` text DEFAULT NULL,
  `db_query` text DEFAULT NULL,
  `browser` text DEFAULT NULL,
  `method` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `exams`;
CREATE TABLE `exams` (
  `participant_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `question_number` smallint(6) NOT NULL,
  `question_id` smallint(6) NOT NULL,
  `answer_id` smallint(6) DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `exam_schedules`;
CREATE TABLE `exam_schedules` (
  `exam_schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `start_date` int(11) DEFAULT NULL,
  `completion_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`exam_schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `exam_status`;
CREATE TABLE `exam_status` (
  `participant_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `total_question` smallint(6) DEFAULT NULL,
  `total_answered` smallint(6) DEFAULT NULL,
  `total_correct` smallint(6) DEFAULT NULL,
  `value` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `module_type_id` int(11) NOT NULL,
  `module_text` text DEFAULT NULL,
  `module_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `module_group`;
CREATE TABLE `module_group` (
  `module_group_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `module_group` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `module_types`;
CREATE TABLE `module_types` (
  `module_type_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `module_type` varchar(30) DEFAULT NULL,
  `total` smallint(6) DEFAULT NULL,
  `module_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `participants`;
CREATE TABLE `participants` (
  `participant_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `participant_name` varchar(150) NOT NULL,
  `participant_email` varchar(150) DEFAULT NULL,
  `participant_login` varchar(32) NOT NULL,
  `participant_password` varchar(40) NOT NULL,
  `participant_last_login` int(11) DEFAULT NULL,
  `participant_last_ip` varchar(45) DEFAULT NULL,
  `participant_last_browser` text DEFAULT NULL,
  `participant_group_id` int(11) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `regencie` int(11) DEFAULT NULL,
  `province` int(11) DEFAULT NULL,
  `postal_code` varchar(5) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `participant_forgot_code` varchar(32) DEFAULT NULL,
  `participant_forgot_status` int(11) NOT NULL,
  `participant_status` int(11) NOT NULL,
  PRIMARY KEY (`participant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `participants` (`participant_id`, `created`, `updated`, `created_by`, `updated_by`, `participant_name`, `participant_email`, `participant_login`, `participant_password`, `participant_last_login`, `participant_last_ip`, `participant_last_browser`, `participant_group_id`, `address`, `regencie`, `province`, `postal_code`, `telephone`, `participant_forgot_code`, `participant_forgot_status`, `participant_status`) VALUES
(1,	1562253113,	1575815220,	'SinauID',	'SinauID',	'Meritha Vridawati',	'testuser@example.com',	'testuser',	'4427254d6887d297fe5c6d714dae05623937c9bc',	1575815220,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	2,	1);

DROP TABLE IF EXISTS `participant_group`;
CREATE TABLE `participant_group` (
  `participant_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `participant_group_name` varchar(150) NOT NULL,
  `participant_group_role` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `participant_group_status` smallint(6) NOT NULL,
  PRIMARY KEY (`participant_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `participant_group` (`participant_group_id`, `created`, `updated`, `created_by`, `updated_by`, `participant_group_name`, `participant_group_role`, `participant_group_status`) VALUES
(1,	1530884439,	1565659498,	'SinauID',	'SinauID',	'Reguler',	'{ \"admin\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"admin_group\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"answer\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"change_log\":{ \"index\":\"1\" }, \"exam_scedule\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"exam_status\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"exam\":{ \"index\":\"1\" }, \"participant\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"question_type\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"question\":{ \"index\":\"1\", \"detail\":\"1\", \"add\":\"1\", \"update\":\"1\" }, \"upload\":{ \"exam\":\"1\", \"answer\":\"1\", \"ktp\":\"1\" }, \"helper\":{ \"province\":\"1\", \"regencie\":\"1\" } }',	1);

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces` (
  `province_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `question_type_id` int(11) NOT NULL,
  `question_text` text DEFAULT NULL,
  `question_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `question_group`;
CREATE TABLE `question_group` (
  `question_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `question_group` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`question_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `question_types`;
CREATE TABLE `question_types` (
  `question_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `question_type` varchar(30) DEFAULT NULL,
  `total` smallint(6) DEFAULT NULL,
  `question_group_id` int(11) NOT NULL,
  PRIMARY KEY (`question_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `regencies`;
CREATE TABLE `regencies` (
  `regencie_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2019-12-08 14:59:17
