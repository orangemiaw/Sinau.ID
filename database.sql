-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 10, 2020 at 08:10 AM
-- Server version: 5.7.27-log
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xhatus_sinauid`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
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
  `admin_last_browser` text,
  `admin_group_id` int(11) NOT NULL,
  `admin_forgot_code` varchar(32) DEFAULT NULL,
  `admin_forgot_status` int(11) NOT NULL,
  `admin_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `created`, `updated`, `created_by`, `updated_by`, `admin_name`, `admin_email`, `admin_login`, `admin_password`, `admin_last_login`, `admin_last_ip`, `admin_last_browser`, `admin_group_id`, `admin_forgot_code`, `admin_forgot_status`, `admin_status`) VALUES
(1, 1530809061, 1578615370, 'SinauID', 'SinauID', 'Imam Kusniadi', 'imamganz666@gmail.com', 'imamkusniadi', '4427254d6887d297fe5c6d714dae05623937c9bc', 1578615370, '180.246.216.53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36 OPR/65.0.3467.78', 1, NULL, 2, 1),
(2, 1578527174, 1578551277, 'imamkusniadi', 'SinauID', 'Unix Triple Six', 'unix666@protonmail.com', 'unix666', '4427254d6887d297fe5c6d714dae05623937c9bc', NULL, NULL, NULL, 1, 'ffbb32fd96e7d553d8e12380c6e22c18', 1, 1),
(3, 1578609978, 1578610001, 'imamkusniadi', 'SinauID', 'Zeus brother', 'zeus@fbi.gov', 'Zeus', '4427254d6887d297fe5c6d714dae05623937c9bc', 1578610001, '36.72.215.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_group`
--

CREATE TABLE `admin_group` (
  `admin_group_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `admin_group_name` varchar(150) NOT NULL,
  `admin_group_role` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `admin_group_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_group`
--

INSERT INTO `admin_group` (`admin_group_id`, `created`, `updated`, `created_by`, `updated_by`, `admin_group_name`, `admin_group_role`, `admin_group_status`) VALUES
(1, 1575786337, 1578544988, 'SinauID', 'imamkusniadi', 'Super Admin', '{\"dashboard\":{\"index\":\"1\"},\"change_logs\":{\"index\":\"1\"},\"config\":{\"index\":\"1\"},\"payment\":{\"index\":\"1\"},\"account_profile\":{\"detail\":\"1\",\"change_password\":\"1\"},\"admin\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"change_password\":\"1\",\"terminate\":\"1\"},\"admin_group\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"delete\":\"1\"},\"participant\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"change_password\":\"1\",\"terminate\":\"1\"},\"participant_group\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"delete\":\"1\"},\"module\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"delete\":\"1\"},\"module_group\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"delete\":\"1\"},\"module_type\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"delete\":\"1\"},\"question\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"delete\":\"1\"},\"question_group\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"delete\":\"1\"},\"question_type\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"delete\":\"1\"},\"answer\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"detail\":\"1\",\"delete\":\"1\"}}', 1),
(6, 1575963622, 1578303467, 'SinauID', 'imamkusniadi', 'Admin', '{\"dashboard\":{\"index\":\"1\"},\"change_logs\":{\"index\":\"1\"},\"account_profile\":{\"detail\":\"1\",\"change_password\":\"1\"}}', 1),
(11, 1576406687, 1577059516, 'imamkusniadi', 'imamkusniadi', 'Mentor', '{\"dashboard\":{\"index\":\"1\"},\"change_logs\":{\"index\":\"1\"},\"account_profile\":{\"detail\":\"1\",\"change_password\":\"1\"},\"module\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"delete\":\"1\"},\"module_group\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"delete\":\"1\"},\"module_type\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"delete\":\"1\"},\"question\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"delete\":\"1\"},\"question_group\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"delete\":\"1\"},\"question_type\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"delete\":\"1\"},\"answer\":{\"index\":\"1\",\"add\":\"1\",\"update\":\"1\",\"delete\":\"1\"}}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `question_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `answer_id` smallint(6) NOT NULL,
  `answer_text` text NOT NULL,
  `answer_image` text,
  `status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`question_id`, `created`, `updated`, `created_by`, `updated_by`, `answer_id`, `answer_text`, `answer_image`, `status`) VALUES
(1, 1577628822, 1578571965, 'imamkusniadi', 'imamkusniadi', 1, 'PHP: Hypertext Prepocessor', NULL, 0),
(1, 1577628822, 1578559126, 'imamkusniadi', 'imamkusniadi', 2, 'Pemberi Harapan Palsu', NULL, 1),
(1, 1577628822, 1577628822, 'imamkusniadi', 'imamkusniadi', 3, 'HyperText Markup Language', NULL, 1),
(1, 1577628822, 1577628822, 'imamkusniadi', 'imamkusniadi', 4, 'Personal Home Page', NULL, 1),
(1, 1577628822, 1577628822, 'imamkusniadi', 'imamkusniadi', 5, 'Cascading Style Sheets', NULL, 1),
(2, 1577628822, 1578558946, 'imamkusniadi', 'imamkusniadi', 1, 'test aja aggf', NULL, 1),
(3, 1578608248, 1578608248, 'imamkusniadi', 'imamkusniadi', 1, 'eXtensible Markup Language', NULL, 0),
(3, 1578608280, 1578608280, 'imamkusniadi', 'imamkusniadi', 2, 'eXtensible Mockup Language', NULL, 1),
(3, 1578608303, 1578608303, 'imamkusniadi', 'imamkusniadi', 3, 'eXtensible Markup Larrange', NULL, 1),
(3, 1578608327, 1578608327, 'imamkusniadi', 'imamkusniadi', 4, 'eXtended Markup Language', NULL, 1),
(3, 1578608355, 1578608355, 'imamkusniadi', 'imamkusniadi', 5, 'eXtensible Merge Language', NULL, 1),
(4, 1578609266, 1578609266, 'imamkusniadi', 'imamkusniadi', 1, 'XML menampilkan ui dan HTML menampilkan data', NULL, 1),
(4, 1578609293, 1578609293, 'imamkusniadi', 'imamkusniadi', 2, 'XML didesain untuk menyimpan dan membawa data,Sedangkan HTML didesain untuk menampilkan data', NULL, 0),
(4, 1578609314, 1578609314, 'imamkusniadi', 'imamkusniadi', 3, 'HTML didesain untuk menyimpan dan membawa data,Sedangkan XML didesain untuk menampilkan data', NULL, 1),
(4, 1578609355, 1578609355, 'imamkusniadi', 'imamkusniadi', 4, 'XML didesain untuk menyimpan data,Sedangkan HTML didesain untuk menampilkan data', NULL, 1),
(4, 1578609387, 1578609387, 'imamkusniadi', 'imamkusniadi', 5, 'HTML didesain untuk menyimpan data,Sedangkan XML didesain untuk menampilkan data', NULL, 1),
(5, 1578615513, 1578615513, 'imamkusniadi', 'imamkusniadi', 1, 'Bundles', NULL, 0),
(5, 1578615558, 1578615558, 'imamkusniadi', 'imamkusniadi', 2, 'Activity', NULL, 1),
(5, 1578615598, 1578615598, 'imamkusniadi', 'imamkusniadi', 3, 'String', NULL, 1),
(6, 1578615969, 1578615969, 'imamkusniadi', 'imamkusniadi', 1, 'number = getIntent().getByteExtra(\"number\");', NULL, 1),
(6, 1578616007, 1578616007, 'imamkusniadi', 'imamkusniadi', 2, 'number = getIntent().getIntExtra(\"number\");', NULL, 1),
(6, 1578616033, 1578616033, 'imamkusniadi', 'imamkusniadi', 3, 'number = getIntent().getIntExtra(\"number\", 0);', NULL, 0),
(6, 1578616059, 1578616059, 'imamkusniadi', 'imamkusniadi', 4, 'number = getIntent().getIntExtra(\"number\", 0);', NULL, 1),
(7, 1578616212, 1578616212, 'imamkusniadi', 'imamkusniadi', 1, 'Styles.xml', NULL, 0),
(7, 1578616237, 1578616237, 'imamkusniadi', 'imamkusniadi', 2, 'Dimens.xml', NULL, 1),
(7, 1578616407, 1578616407, 'imamkusniadi', 'imamkusniadi', 3, 'Strings.xml', NULL, 1),
(7, 1578616435, 1578616435, 'imamkusniadi', 'imamkusniadi', 4, 'Colors.xml', NULL, 1),
(7, 1578616460, 1578616460, 'imamkusniadi', 'imamkusniadi', 5, 'AndroidManifest.xml', NULL, 1),
(8, 1578616818, 1578616818, 'imamkusniadi', 'imamkusniadi', 1, 'ListView lebih bagus dalam menampilkan animasi', NULL, 1),
(8, 1578616838, 1578616838, 'imamkusniadi', 'imamkusniadi', 2, 'ListView lebih fleksibel daripada RecyclerView', NULL, 1),
(8, 1578616871, 1578616871, 'imamkusniadi', 'imamkusniadi', 3, 'RecyclerView lebih powerful dan fleksibel daripada ListView', NULL, 0),
(8, 1578616890, 1578616890, 'imamkusniadi', 'imamkusniadi', 4, 'RecyclerView lebih sulit untuk mengatur OnItemTouchListener', NULL, 1),
(8, 1578616925, 1578616925, 'imamkusniadi', 'imamkusniadi', 5, 'RecyclerView lebih cocok untuk data yang statik', NULL, 1),
(9, 1578617631, 1578617631, 'imamkusniadi', 'imamkusniadi', 1, 'Image, RelativeLayout', NULL, 1),
(9, 1578617680, 1578617680, 'imamkusniadi', 'imamkusniadi', 2, 'ListView, GridLayout, ImageView, TextView', NULL, 0),
(9, 1578617702, 1578617702, 'imamkusniadi', 'imamkusniadi', 3, 'Image, EditText, TableLayout', NULL, 1),
(9, 1578617724, 1578617724, 'imamkusniadi', 'imamkusniadi', 4, 'Image, Button, LinearLayout', NULL, 1),
(9, 1578617758, 1578617758, 'imamkusniadi', 'imamkusniadi', 5, 'ScrollView, Image, Button', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `change_logs`
--

CREATE TABLE `change_logs` (
  `log_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `controller` varchar(64) NOT NULL,
  `action` varchar(64) NOT NULL,
  `querystring` text,
  `post` text,
  `url` text NOT NULL,
  `ip` varchar(45) NOT NULL,
  `current_data` text,
  `new_data` text,
  `db_query` text,
  `browser` text,
  `method` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `faceai_server` varchar(100) DEFAULT NULL,
  `faceai_login` varchar(36) DEFAULT NULL,
  `faceai_password` varchar(36) DEFAULT NULL,
  `paypal_sandbox_account` varchar(36) DEFAULT NULL,
  `paypal_client_id` text,
  `paypal_client_secret` text,
  `paypal_live_payment` smallint(6) DEFAULT NULL,
  `ovo_number` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`created`, `updated`, `created_by`, `updated_by`, `faceai_server`, `faceai_login`, `faceai_password`, `paypal_sandbox_account`, `paypal_client_id`, `paypal_client_secret`, `paypal_live_payment`, `ovo_number`) VALUES
(1578540940, 1578571362, 'imamkusniadi', 'imamkusniadi', 'https://faceai.id/api/v1/', 'sinauid', 'p@$$w0rds4y4', 'sb-d643gi783512@business.example.com', 'ASZablu8aoAO0-_1asXPYSjM9-BQ9qdkwE3eUDiITp_Snxouz4vWvSGGPf1lYFz3_ekUwHB8Xss5OhCX', 'EFTBuQQD5RmjvRRZ8x5rd2967DrU7-k6u3eGgZ_nudXHoEnhTaMCuZAes8xfCrmXhrvLlzJAliAjeg3E', 1, '082334118150');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

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

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`participant_id`, `created`, `updated`, `created_by`, `updated_by`, `question_number`, `question_id`, `answer_id`, `status`, `time`) VALUES
(3, 1578540940, 1578540940, 'mahmudza', 'mahmudza', 1, 1, 1, 2, 1578540940),
(3, 1578541046, 1578541046, 'mahmudza', 'mahmudza', 2, 2, 1, 2, 1578541046);

-- --------------------------------------------------------

--
-- Table structure for table `exam_status`
--

CREATE TABLE `exam_status` (
  `participant_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `question_type_id` int(11) NOT NULL,
  `total_question` smallint(6) DEFAULT NULL,
  `total_answered` smallint(6) DEFAULT NULL,
  `total_correct` smallint(6) DEFAULT NULL,
  `value` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_status`
--

INSERT INTO `exam_status` (`participant_id`, `created`, `updated`, `created_by`, `updated_by`, `question_type_id`, `total_question`, `total_answered`, `total_correct`, `value`) VALUES
(3, 1578540940, 1578541047, 'mahmudza', 'mahmudza', 1, 10, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `module_type_id` int(11) NOT NULL,
  `module_text` text,
  `module_image` varchar(100) DEFAULT NULL,
  `module_file` varchar(225) DEFAULT NULL,
  `module_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `created`, `updated`, `created_by`, `updated_by`, `module_type_id`, `module_text`, `module_image`, `module_file`, `module_status`) VALUES
(2, 1578607611, 1578607611, 'imamkusniadi', 'imamkusniadi', 1, 'Introducing PHP', 'app/files/images/cbc2c627e57b855f3d586b39b0e42dd923cef59a.png', 'app/files/modules/cbc2c627e57b855f3d586b39b0e42dd923cef59a.pdf', 1),
(3, 1578607790, 1578607790, 'imamkusniadi', 'imamkusniadi', 2, 'Introducing Java', 'app/files/images/f1b8fe50fb53afe1622efd6be2f597f570ee7fe7.png', 'app/files/modules/f1b8fe50fb53afe1622efd6be2f597f570ee7fe7.pdf', 1),
(4, 1578607962, 1578607962, 'imamkusniadi', 'imamkusniadi', 3, 'React native dasar', 'app/files/images/f1203c7d59ace101ac2c190ecafbc16da2503735.png', 'app/files/modules/f1203c7d59ace101ac2c190ecafbc16da2503735.pdf', 1),
(5, 1578608567, 1578608567, 'imamkusniadi', 'imamkusniadi', 4, 'Kotlin Part 1', 'app/files/images/d647e8ce2e0b830a0db2770ee4803d715c3b28a7.png', 'app/files/modules/d647e8ce2e0b830a0db2770ee4803d715c3b28a7.pdf', 1),
(6, 1578608674, 1578608674, 'imamkusniadi', 'imamkusniadi', 1, 'Membuat Form Validation', 'app/files/images/8d980925165b8207129f835a197ead8f1742e4e0.png', 'app/files/modules/8d980925165b8207129f835a197ead8f1742e4e0.pdf', 1),
(7, 1578608824, 1578608824, 'imamkusniadi', 'imamkusniadi', 4, 'Membuat login page', 'app/files/images/e0318a44f187c14faa182277c69a486f20eec228.png', 'app/files/modules/e0318a44f187c14faa182277c69a486f20eec228.pdf', 1),
(8, 1578609011, 1578609011, 'imamkusniadi', 'imamkusniadi', 5, 'Learning XML UI', 'app/files/images/f27a82bf9599b2c6867f16bc14f9038fe3313b95.png', 'app/files/modules/f27a82bf9599b2c6867f16bc14f9038fe3313b95.pdf', 1),
(9, 1578609519, 1578609519, 'imamkusniadi', 'imamkusniadi', 5, 'Android Modul', 'app/files/images/5ee5bbca9074643663eb2188d47d01b17c75f270.png', 'app/files/modules/5ee5bbca9074643663eb2188d47d01b17c75f270.pdf', 1),
(10, 1578609899, 1578609899, 'imamkusniadi', 'imamkusniadi', 5, 'Android java', 'app/files/images/7708572d5ba63e9061f10312b5a75b9d1c2b3a7d.png', 'app/files/modules/7708572d5ba63e9061f10312b5a75b9d1c2b3a7d.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_group`
--

CREATE TABLE `module_group` (
  `module_group_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `module_group_name` varchar(150) DEFAULT NULL,
  `module_group_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_group`
--

INSERT INTO `module_group` (`module_group_id`, `created`, `updated`, `created_by`, `updated_by`, `module_group_name`, `module_group_status`) VALUES
(2, 1578532927, 1578572827, 'imamkusniadi', 'imamkusniadi', 'Pemrograman Web Dasar', 1),
(3, 1578607664, 1578607664, 'imamkusniadi', 'imamkusniadi', 'Java', 1),
(4, 1578607835, 1578607835, 'imamkusniadi', 'imamkusniadi', 'React', 1),
(5, 1578608449, 1578608449, 'imamkusniadi', 'imamkusniadi', 'Android Kotlin', 1),
(6, 1578608941, 1578608941, 'imamkusniadi', 'imamkusniadi', 'Android', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_types`
--

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

--
-- Dumping data for table `module_types`
--

INSERT INTO `module_types` (`module_type_id`, `created`, `updated`, `created_by`, `updated_by`, `module_type`, `total`, `module_group_id`) VALUES
(1, 1578533118, 1578533124, 'imamkusniadi', 'imamkusniadi', 'PHP Dasar', 1, 2),
(2, 1578607678, 1578607678, 'imamkusniadi', 'imamkusniadi', 'Java', 1, 3),
(3, 1578607856, 1578607856, 'imamkusniadi', 'imamkusniadi', 'React Native', 1, 4),
(4, 1578608471, 1578608471, 'imamkusniadi', 'imamkusniadi', 'Kotlin introduction', 1, 5),
(5, 1578608962, 1578608962, 'imamkusniadi', 'imamkusniadi', 'Android', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `participant_id` int(11) NOT NULL,
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
  `participant_last_browser` text,
  `participant_group_id` int(11) NOT NULL,
  `profile_image` text NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `regencie` int(11) DEFAULT NULL,
  `province` int(11) DEFAULT NULL,
  `postal_code` varchar(5) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `participant_forgot_code` varchar(32) DEFAULT NULL,
  `participant_forgot_status` int(11) NOT NULL,
  `participant_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`participant_id`, `created`, `updated`, `created_by`, `updated_by`, `participant_name`, `participant_email`, `participant_login`, `participant_password`, `participant_last_login`, `participant_last_ip`, `participant_last_browser`, `participant_group_id`, `profile_image`, `address`, `regencie`, `province`, `postal_code`, `telephone`, `participant_forgot_code`, `participant_forgot_status`, `participant_status`) VALUES
(1, 1562253113, 1577975667, 'SinauID', 'SinauID', 'Meritha Vridawati', 'imamganz.666@gmail.com', 'testuser', '4427254d6887d297fe5c6d714dae05623937c9bc', 1577972947, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 0, '', 'Via Lanzone, 7', NULL, NULL, '20123', NULL, NULL, 2, 1),
(3, 1575858628, 1578611173, 'SinauID', 'SinauID', 'Cristian Dana', 'mahmudza@sinau.id', 'mahmudza', '4427254d6887d297fe5c6d714dae05623937c9bc', 1578611173, '180.254.90.89', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 1, 'app/files/ktp/3e8c5d46b650de360e44ba94bf4fe4cd50872600.jpg', 'Via Lanzone, 7', 1102, 15, '20123', '3495100296', '', 2, 1),
(4, 1575969908, 1575969967, 'SinauID', 'SinauID', 'mahmud', 'aaa@email.com', 'mahmud12', '00f5bad54327b6fbeb7c0999253fec930c7119c5', 1575969967, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(6, 1578388349, 1578388357, 'SinauID', 'SinauID', 'Faqih Apaaja', 'faqih98@gmail.com', 'faqih98', '4427254d6887d297fe5c6d714dae05623937c9bc', 1578388357, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(7, 1578388685, 1578576507, 'SinauID', 'SinauID', 'bambang', 'bams@gmail.com', 'bams98', '4427254d6887d297fe5c6d714dae05623937c9bc', 1578576507, '36.72.215.97', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 2, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(8, 1578615234, 1578617223, 'SinauID', 'imamkusniadi', 'Boy Candra', '', '', '1234483914f10abda05ad45788659db27c8d0019', NULL, NULL, NULL, 1, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, 3),
(9, 1578615283, 1578616597, 'SinauID', 'SinauID', 'boy candra', 'boycandra@gmail.com', 'boycandra', '4427254d6887d297fe5c6d714dae05623937c9bc', 1578616597, '180.246.216.53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `participant_group`
--

CREATE TABLE `participant_group` (
  `participant_group_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `participant_group_name` varchar(150) NOT NULL,
  `participant_group_role` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `participant_group_price` float DEFAULT NULL,
  `participant_group_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participant_group`
--

INSERT INTO `participant_group` (`participant_group_id`, `created`, `updated`, `created_by`, `updated_by`, `participant_group_name`, `participant_group_role`, `participant_group_price`, `participant_group_status`) VALUES
(1, 1530884439, 1578548324, 'SinauID', 'imamkusniadi', 'Reguler', '{\"dashboard\":{\"index\":\"1\"},\"change_logs\":{\"index\":\"1\"},\"payment\":{\"index\":\"1\"},\"account_profile\":{\"detail\":\"1\",\"change_password\":\"1\"},\"module\":{\"index\":\"1\"},\"assessment\":{\"index\":\"1\",\"exam\":\"1\",\"activity\":\"1\",\"record\":\"1\"}}', 0, 1),
(2, 1576980629, 1578548332, 'imamkusniadi', 'imamkusniadi', 'Premium', '{\"dashboard\":{\"index\":\"1\"},\"change_logs\":{\"index\":\"1\"},\"payment\":{\"index\":\"1\"},\"account_profile\":{\"detail\":\"1\",\"change_password\":\"1\"},\"module\":{\"index\":\"1\",\"premium\":\"1\"},\"assessment\":{\"index\":\"1\",\"activity\":\"1\",\"record\":\"1\",\"premium\":\"1\"}}', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `transaction_id` varchar(120) DEFAULT NULL,
  `invoice_id` varchar(120) DEFAULT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_amount` float NOT NULL,
  `payment_status` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `created`, `updated`, `created_by`, `updated_by`, `participant_id`, `transaction_id`, `invoice_id`, `payment_method`, `payment_amount`, `payment_status`) VALUES
(2, 1577010480, 1577010480, 'SinauID', 'SinauID', 1, 'PAYID-LX7UJ6Q5T1388327N814792K', '5DFF44F6A77DB-2', 1, 10, 'approved'),
(3, 1577010805, 1577010805, 'SinauID', 'SinauID', 1, 'PAYID-LX7UMWA0ST31722242875125', '5DFF465471DC0-2', 1, 10, 'approved'),
(4, 1577010948, 1577010948, 'SinauID', 'SinauID', 1, 'PAYID-LX7UNZI06W381198T638113B', '5DFF46E1A158A-2', 1, 10, 'approved'),
(5, 1577011505, 1577011505, 'SinauID', 'SinauID', 1, 'PAYID-LX7UR7I3MK805414G966912L', '5DFF48FA4354D-2', 1, 10, 'approved'),
(6, 1577011560, 1577011560, 'SinauID', 'SinauID', 1, 'PAYID-LX7UR7I3MK805414G966912L', '5DFF48FA4354D-2', 1, 10, 'approved'),
(7, 1577975667, 1577975667, 'SinauID', 'SinauID', 1, 'OVOID-1577975667', '5E0DFF7360D10-2', 2, 10, 'approved'),
(8, 1578388953, 1578388953, 'bams98', 'bams98', 7, 'PAYID-LYKE3NQ5GJ04985T9156415Y', '5E144DB02BEDF-2', 1, 10, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `province_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`province_id`, `name`) VALUES
(11, 'ACEH'),
(12, 'SUMATERA UTARA'),
(13, 'SUMATERA BARAT'),
(14, 'RIAU'),
(15, 'JAMBI'),
(16, 'SUMATERA SELATAN'),
(17, 'BENGKULU'),
(18, 'LAMPUNG'),
(19, 'KEPULAUAN BANGKA BELITUNG'),
(21, 'KEPULAUAN RIAU'),
(31, 'DKI JAKARTA'),
(32, 'JAWA BARAT'),
(33, 'JAWA TENGAH'),
(34, 'DI YOGYAKARTA'),
(35, 'JAWA TIMUR'),
(36, 'BANTEN'),
(51, 'BALI'),
(52, 'NUSA TENGGARA BARAT'),
(53, 'NUSA TENGGARA TIMUR'),
(61, 'KALIMANTAN BARAT'),
(62, 'KALIMANTAN TENGAH'),
(63, 'KALIMANTAN SELATAN'),
(64, 'KALIMANTAN TIMUR'),
(65, 'KALIMANTAN UTARA'),
(71, 'SULAWESI UTARA'),
(72, 'SULAWESI TENGAH'),
(73, 'SULAWESI SELATAN'),
(74, 'SULAWESI TENGGARA'),
(75, 'GORONTALO'),
(76, 'SULAWESI BARAT'),
(81, 'MALUKU'),
(82, 'MALUKU UTARA'),
(91, 'PAPUA BARAT'),
(94, 'PAPUA');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `question_type_id` int(11) NOT NULL,
  `question_text` text,
  `question_image` varchar(100) DEFAULT NULL,
  `question_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `created`, `updated`, `created_by`, `updated_by`, `question_type_id`, `question_text`, `question_image`, `question_status`) VALUES
(1, 1577628822, 1577628822, 'imamkusniadi', 'imamkusniadi', 1, 'Apa kepanjangan dari PHP?', NULL, 1),
(2, 1577628822, 1578611063, 'imamkusniadi', 'imamkusniadi', 1, 'Test aja', 'app/files/questions/d5d30e4c7abb2077ba09f894d8880b80743ce837.png', 1),
(3, 1578608118, 1578608118, 'imamkusniadi', 'imamkusniadi', 2, 'Apa itu xml?', 'app/files/questions/f991244bb1185f5222eb2adf87631029e13904d9.png', 1),
(4, 1578609160, 1578609160, 'imamkusniadi', 'imamkusniadi', 2, 'Perbedaan XML dan HTML ?', 'app/files/questions/77045527967a7342f5bc9d27a162cd88a21e3f0d.png', 1),
(5, 1578615115, 1578615153, 'imamkusniadi', 'imamkusniadi', 2, 'Objek apa yang disimpan di dalam onSaveInstanceState?', NULL, 1),
(6, 1578615855, 1578615892, 'imamkusniadi', 'imamkusniadi', 2, 'Kode berikut digunakan untuk mengirim data dari sebuah activity ke activity lain :  Bagaimana cara menerima data tersebut pada activity yang dituju?', 'app/files/questions/87dfaef864fe65927af24be21bd524c32586d87c.png', 1),
(7, 1578616160, 1578616160, 'imamkusniadi', 'imamkusniadi', 2, 'File manakah yang bisa kita gunakan jika kita ingin membuat tema baru?', NULL, 1),
(8, 1578616765, 1578616765, 'imamkusniadi', 'imamkusniadi', 2, 'Berikut adalah pernyataan yang benar mengenai RecyclerView dan ListView ?', NULL, 1),
(9, 1578617591, 1578617591, 'imamkusniadi', 'imamkusniadi', 2, 'Perhatikan gambar di bawah ini:Apa saja komponen yang dibutuhkan untuk menyusun tampilan seperti ini?', 'app/files/questions/af61bdfab791ed01d7dec6526f81058ffb7cb2db.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_group`
--

CREATE TABLE `question_group` (
  `question_group_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `question_group_name` varchar(150) NOT NULL,
  `question_group_status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_group`
--

INSERT INTO `question_group` (`question_group_id`, `created`, `updated`, `created_by`, `updated_by`, `question_group_name`, `question_group_status`) VALUES
(1, 1576914926, 1578571823, 'imamkusniadi', 'imamkusniadi', 'Kalkulus', 1),
(2, 1577628822, 1577628822, 'imamkusniadi', 'imamkusniadi', 'Pemrograman Web Lanjut', 1),
(3, 1578608001, 1578608001, 'imamkusniadi', 'imamkusniadi', 'Android', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

CREATE TABLE `question_types` (
  `question_type_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `created_by` varchar(32) NOT NULL,
  `updated_by` varchar(32) NOT NULL,
  `question_type` varchar(30) DEFAULT NULL,
  `total` smallint(6) DEFAULT NULL,
  `question_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_types`
--

INSERT INTO `question_types` (`question_type_id`, `created`, `updated`, `created_by`, `updated_by`, `question_type`, `total`, `question_group_id`) VALUES
(1, 1577628822, 1577628822, 'imamkusniadi', 'imamkusniadi', 'Dasar Pemrograman PHP', 10, 2),
(2, 1578608021, 1578616987, 'imamkusniadi', 'imamkusniadi', 'Android java', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `regencies`
--

CREATE TABLE `regencies` (
  `regencie_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regencies`
--

INSERT INTO `regencies` (`regencie_id`, `province_id`, `name`) VALUES
(1101, 11, 'KABUPATEN SIMEULUE'),
(1102, 11, 'KABUPATEN ACEH SINGKIL'),
(1103, 11, 'KABUPATEN ACEH SELATAN'),
(1104, 11, 'KABUPATEN ACEH TENGGARA'),
(1105, 11, 'KABUPATEN ACEH TIMUR'),
(1106, 11, 'KABUPATEN ACEH TENGAH'),
(1107, 11, 'KABUPATEN ACEH BARAT'),
(1108, 11, 'KABUPATEN ACEH BESAR'),
(1109, 11, 'KABUPATEN PIDIE'),
(1110, 11, 'KABUPATEN BIREUEN'),
(1111, 11, 'KABUPATEN ACEH UTARA'),
(1112, 11, 'KABUPATEN ACEH BARAT DAYA'),
(1113, 11, 'KABUPATEN GAYO LUES'),
(1114, 11, 'KABUPATEN ACEH TAMIANG'),
(1115, 11, 'KABUPATEN NAGAN RAYA'),
(1116, 11, 'KABUPATEN ACEH JAYA'),
(1117, 11, 'KABUPATEN BENER MERIAH'),
(1118, 11, 'KABUPATEN PIDIE JAYA'),
(1171, 11, 'KOTA BANDA ACEH'),
(1172, 11, 'KOTA SABANG'),
(1173, 11, 'KOTA LANGSA'),
(1174, 11, 'KOTA LHOKSEUMAWE'),
(1175, 11, 'KOTA SUBULUSSALAM'),
(1201, 12, 'KABUPATEN NIAS'),
(1202, 12, 'KABUPATEN MANDAILING NATAL'),
(1203, 12, 'KABUPATEN TAPANULI SELATAN'),
(1204, 12, 'KABUPATEN TAPANULI TENGAH'),
(1205, 12, 'KABUPATEN TAPANULI UTARA'),
(1206, 12, 'KABUPATEN TOBA SAMOSIR'),
(1207, 12, 'KABUPATEN LABUHAN BATU'),
(1208, 12, 'KABUPATEN ASAHAN'),
(1209, 12, 'KABUPATEN SIMALUNGUN'),
(1210, 12, 'KABUPATEN DAIRI'),
(1211, 12, 'KABUPATEN KARO'),
(1212, 12, 'KABUPATEN DELI SERDANG'),
(1213, 12, 'KABUPATEN LANGKAT'),
(1214, 12, 'KABUPATEN NIAS SELATAN'),
(1215, 12, 'KABUPATEN HUMBANG HASUNDUTAN'),
(1216, 12, 'KABUPATEN PAKPAK BHARAT'),
(1217, 12, 'KABUPATEN SAMOSIR'),
(1218, 12, 'KABUPATEN SERDANG BEDAGAI'),
(1219, 12, 'KABUPATEN BATU BARA'),
(1220, 12, 'KABUPATEN PADANG LAWAS UTARA'),
(1221, 12, 'KABUPATEN PADANG LAWAS'),
(1222, 12, 'KABUPATEN LABUHAN BATU SELATAN'),
(1223, 12, 'KABUPATEN LABUHAN BATU UTARA'),
(1224, 12, 'KABUPATEN NIAS UTARA'),
(1225, 12, 'KABUPATEN NIAS BARAT'),
(1271, 12, 'KOTA SIBOLGA'),
(1272, 12, 'KOTA TANJUNG BALAI'),
(1273, 12, 'KOTA PEMATANG SIANTAR'),
(1274, 12, 'KOTA TEBING TINGGI'),
(1275, 12, 'KOTA MEDAN'),
(1276, 12, 'KOTA BINJAI'),
(1277, 12, 'KOTA PADANGSIDIMPUAN'),
(1278, 12, 'KOTA GUNUNGSITOLI'),
(1301, 13, 'KABUPATEN KEPULAUAN MENTAWAI'),
(1302, 13, 'KABUPATEN PESISIR SELATAN'),
(1303, 13, 'KABUPATEN SOLOK'),
(1304, 13, 'KABUPATEN SIJUNJUNG'),
(1305, 13, 'KABUPATEN TANAH DATAR'),
(1306, 13, 'KABUPATEN PADANG PARIAMAN'),
(1307, 13, 'KABUPATEN AGAM'),
(1308, 13, 'KABUPATEN LIMA PULUH KOTA'),
(1309, 13, 'KABUPATEN PASAMAN'),
(1310, 13, 'KABUPATEN SOLOK SELATAN'),
(1311, 13, 'KABUPATEN DHARMASRAYA'),
(1312, 13, 'KABUPATEN PASAMAN BARAT'),
(1371, 13, 'KOTA PADANG'),
(1372, 13, 'KOTA SOLOK'),
(1373, 13, 'KOTA SAWAH LUNTO'),
(1374, 13, 'KOTA PADANG PANJANG'),
(1375, 13, 'KOTA BUKITTINGGI'),
(1376, 13, 'KOTA PAYAKUMBUH'),
(1377, 13, 'KOTA PARIAMAN'),
(1401, 14, 'KABUPATEN KUANTAN SINGINGI'),
(1402, 14, 'KABUPATEN INDRAGIRI HULU'),
(1403, 14, 'KABUPATEN INDRAGIRI HILIR'),
(1404, 14, 'KABUPATEN PELALAWAN'),
(1405, 14, 'KABUPATEN S I A K'),
(1406, 14, 'KABUPATEN KAMPAR'),
(1407, 14, 'KABUPATEN ROKAN HULU'),
(1408, 14, 'KABUPATEN BENGKALIS'),
(1409, 14, 'KABUPATEN ROKAN HILIR'),
(1410, 14, 'KABUPATEN KEPULAUAN MERANTI'),
(1471, 14, 'KOTA PEKANBARU'),
(1473, 14, 'KOTA D U M A I'),
(1501, 15, 'KABUPATEN KERINCI'),
(1502, 15, 'KABUPATEN MERANGIN'),
(1503, 15, 'KABUPATEN SAROLANGUN'),
(1504, 15, 'KABUPATEN BATANG HARI'),
(1505, 15, 'KABUPATEN MUARO JAMBI'),
(1506, 15, 'KABUPATEN TANJUNG JABUNG TIMUR'),
(1507, 15, 'KABUPATEN TANJUNG JABUNG BARAT'),
(1508, 15, 'KABUPATEN TEBO'),
(1509, 15, 'KABUPATEN BUNGO'),
(1571, 15, 'KOTA JAMBI'),
(1572, 15, 'KOTA SUNGAI PENUH'),
(1601, 16, 'KABUPATEN OGAN KOMERING ULU'),
(1602, 16, 'KABUPATEN OGAN KOMERING ILIR'),
(2104, 21, 'KABUPATEN LINGGA'),
(2105, 21, 'KABUPATEN KEPULAUAN ANAMBAS'),
(2171, 21, 'KOTA B A T A M'),
(2172, 21, 'KOTA TANJUNG PINANG'),
(3101, 31, 'KABUPATEN KEPULAUAN SERIBU'),
(3171, 31, 'KOTA JAKARTA SELATAN'),
(3172, 31, 'KOTA JAKARTA TIMUR'),
(3173, 31, 'KOTA JAKARTA PUSAT'),
(3174, 31, 'KOTA JAKARTA BARAT'),
(3175, 31, 'KOTA JAKARTA UTARA'),
(3201, 32, 'KABUPATEN BOGOR'),
(3202, 32, 'KABUPATEN SUKABUMI'),
(3203, 32, 'KABUPATEN CIANJUR'),
(3204, 32, 'KABUPATEN BANDUNG'),
(3205, 32, 'KABUPATEN GARUT'),
(3206, 32, 'KABUPATEN TASIKMALAYA'),
(3207, 32, 'KABUPATEN CIAMIS'),
(3208, 32, 'KABUPATEN KUNINGAN'),
(3209, 32, 'KABUPATEN CIREBON'),
(3210, 32, 'KABUPATEN MAJALENGKA'),
(3211, 32, 'KABUPATEN SUMEDANG'),
(3212, 32, 'KABUPATEN INDRAMAYU'),
(3213, 32, 'KABUPATEN SUBANG'),
(3214, 32, 'KABUPATEN PURWAKARTA'),
(3215, 32, 'KABUPATEN KARAWANG'),
(3216, 32, 'KABUPATEN BEKASI'),
(3217, 32, 'KABUPATEN BANDUNG BARAT'),
(3218, 32, 'KABUPATEN PANGANDARAN'),
(3271, 32, 'KOTA BOGOR'),
(3272, 32, 'KOTA SUKABUMI'),
(3273, 32, 'KOTA BANDUNG'),
(3274, 32, 'KOTA CIREBON'),
(3275, 32, 'KOTA BEKASI'),
(3276, 32, 'KOTA DEPOK'),
(3277, 32, 'KOTA CIMAHI'),
(3278, 32, 'KOTA TASIKMALAYA'),
(3279, 32, 'KOTA BANJAR'),
(3301, 33, 'KABUPATEN CILACAP'),
(3302, 33, 'KABUPATEN BANYUMAS'),
(3303, 33, 'KABUPATEN PURBALINGGA'),
(3304, 33, 'KABUPATEN BANJARNEGARA'),
(3305, 33, 'KABUPATEN KEBUMEN'),
(3306, 33, 'KABUPATEN PURWOREJO'),
(3307, 33, 'KABUPATEN WONOSOBO'),
(3308, 33, 'KABUPATEN MAGELANG'),
(3309, 33, 'KABUPATEN BOYOLALI'),
(3310, 33, 'KABUPATEN KLATEN'),
(3311, 33, 'KABUPATEN SUKOHARJO'),
(3312, 33, 'KABUPATEN WONOGIRI'),
(3313, 33, 'KABUPATEN KARANGANYAR'),
(3314, 33, 'KABUPATEN SRAGEN'),
(3315, 33, 'KABUPATEN GROBOGAN'),
(3316, 33, 'KABUPATEN BLORA'),
(3317, 33, 'KABUPATEN REMBANG'),
(3318, 33, 'KABUPATEN PATI'),
(3319, 33, 'KABUPATEN KUDUS'),
(3320, 33, 'KABUPATEN JEPARA'),
(3321, 33, 'KABUPATEN DEMAK'),
(3322, 33, 'KABUPATEN SEMARANG'),
(3323, 33, 'KABUPATEN TEMANGGUNG'),
(3324, 33, 'KABUPATEN KENDAL'),
(3325, 33, 'KABUPATEN BATANG'),
(3326, 33, 'KABUPATEN PEKALONGAN'),
(3327, 33, 'KABUPATEN PEMALANG'),
(3328, 33, 'KABUPATEN TEGAL'),
(3329, 33, 'KABUPATEN BREBES'),
(3371, 33, 'KOTA MAGELANG'),
(3372, 33, 'KOTA SURAKARTA'),
(3373, 33, 'KOTA SALATIGA'),
(3374, 33, 'KOTA SEMARANG'),
(3375, 33, 'KOTA PEKALONGAN'),
(3376, 33, 'KOTA TEGAL'),
(3401, 34, 'KABUPATEN KULON PROGO'),
(3402, 34, 'KABUPATEN BANTUL'),
(3403, 34, 'KABUPATEN GUNUNG KIDUL'),
(3404, 34, 'KABUPATEN SLEMAN'),
(3471, 34, 'KOTA YOGYAKARTA'),
(3501, 35, 'KABUPATEN PACITAN'),
(3502, 35, 'KABUPATEN PONOROGO'),
(3503, 35, 'KABUPATEN TRENGGALEK'),
(3504, 35, 'KABUPATEN TULUNGAGUNG'),
(3505, 35, 'KABUPATEN BLITAR'),
(3506, 35, 'KABUPATEN KEDIRI'),
(3507, 35, 'KABUPATEN MALANG'),
(3508, 35, 'KABUPATEN LUMAJANG'),
(3509, 35, 'KABUPATEN JEMBER'),
(3510, 35, 'KABUPATEN BANYUWANGI'),
(3511, 35, 'KABUPATEN BONDOWOSO'),
(3512, 35, 'KABUPATEN SITUBONDO'),
(3513, 35, 'KABUPATEN PROBOLINGGO'),
(3514, 35, 'KABUPATEN PASURUAN'),
(3515, 35, 'KABUPATEN SIDOARJO'),
(3516, 35, 'KABUPATEN MOJOKERTO'),
(3517, 35, 'KABUPATEN JOMBANG'),
(3518, 35, 'KABUPATEN NGANJUK'),
(3519, 35, 'KABUPATEN MADIUN'),
(3520, 35, 'KABUPATEN MAGETAN'),
(3521, 35, 'KABUPATEN NGAWI'),
(3522, 35, 'KABUPATEN BOJONEGORO'),
(3523, 35, 'KABUPATEN TUBAN'),
(3524, 35, 'KABUPATEN LAMONGAN'),
(3525, 35, 'KABUPATEN GRESIK'),
(3526, 35, 'KABUPATEN BANGKALAN'),
(3527, 35, 'KABUPATEN SAMPANG'),
(3528, 35, 'KABUPATEN PAMEKASAN'),
(3529, 35, 'KABUPATEN SUMENEP'),
(3571, 35, 'KOTA KEDIRI'),
(3572, 35, 'KOTA BLITAR'),
(3573, 35, 'KOTA MALANG'),
(3574, 35, 'KOTA PROBOLINGGO'),
(3575, 35, 'KOTA PASURUAN'),
(3576, 35, 'KOTA MOJOKERTO'),
(3577, 35, 'KOTA MADIUN'),
(3578, 35, 'KOTA SURABAYA'),
(3579, 35, 'KOTA BATU'),
(3601, 36, 'KABUPATEN PANDEGLANG'),
(3602, 36, 'KABUPATEN LEBAK'),
(3603, 36, 'KABUPATEN TANGERANG'),
(3604, 36, 'KABUPATEN SERANG'),
(3671, 36, 'KOTA TANGERANG'),
(3672, 36, 'KOTA CILEGON'),
(3673, 36, 'KOTA SERANG'),
(3674, 36, 'KOTA TANGERANG SELATAN'),
(5101, 51, 'KABUPATEN JEMBRANA'),
(5102, 51, 'KABUPATEN TABANAN'),
(5103, 51, 'KABUPATEN BADUNG'),
(5104, 51, 'KABUPATEN GIANYAR'),
(5105, 51, 'KABUPATEN KLUNGKUNG'),
(5106, 51, 'KABUPATEN BANGLI'),
(5107, 51, 'KABUPATEN KARANG ASEM'),
(5108, 51, 'KABUPATEN BULELENG'),
(5171, 51, 'KOTA DENPASAR'),
(5201, 52, 'KABUPATEN LOMBOK BARAT'),
(5202, 52, 'KABUPATEN LOMBOK TENGAH'),
(5203, 52, 'KABUPATEN LOMBOK TIMUR'),
(5204, 52, 'KABUPATEN SUMBAWA'),
(5205, 52, 'KABUPATEN DOMPU'),
(5206, 52, 'KABUPATEN BIMA'),
(5207, 52, 'KABUPATEN SUMBAWA BARAT'),
(5208, 52, 'KABUPATEN LOMBOK UTARA'),
(5271, 52, 'KOTA MATARAM'),
(5272, 52, 'KOTA BIMA'),
(5301, 53, 'KABUPATEN SUMBA BARAT'),
(5302, 53, 'KABUPATEN SUMBA TIMUR'),
(5303, 53, 'KABUPATEN KUPANG'),
(5304, 53, 'KABUPATEN TIMOR TENGAH SELATAN'),
(5305, 53, 'KABUPATEN TIMOR TENGAH UTARA'),
(5306, 53, 'KABUPATEN BELU'),
(5307, 53, 'KABUPATEN ALOR'),
(5308, 53, 'KABUPATEN LEMBATA'),
(5309, 53, 'KABUPATEN FLORES TIMUR'),
(5310, 53, 'KABUPATEN SIKKA'),
(5311, 53, 'KABUPATEN ENDE'),
(5312, 53, 'KABUPATEN NGADA'),
(5313, 53, 'KABUPATEN MANGGARAI'),
(5314, 53, 'KABUPATEN ROTE NDAO'),
(5315, 53, 'KABUPATEN MANGGARAI BARAT'),
(5316, 53, 'KABUPATEN SUMBA TENGAH'),
(5317, 53, 'KABUPATEN SUMBA BARAT DAYA'),
(5318, 53, 'KABUPATEN NAGEKEO'),
(5319, 53, 'KABUPATEN MANGGARAI TIMUR'),
(5320, 53, 'KABUPATEN SABU RAIJUA'),
(5321, 53, 'KABUPATEN MALAKA'),
(5371, 53, 'KOTA KUPANG'),
(6101, 61, 'KABUPATEN SAMBAS'),
(6102, 61, 'KABUPATEN BENGKAYANG'),
(6103, 61, 'KABUPATEN LANDAK'),
(6104, 61, 'KABUPATEN MEMPAWAH'),
(6105, 61, 'KABUPATEN SANGGAU'),
(6106, 61, 'KABUPATEN KETAPANG'),
(6107, 61, 'KABUPATEN SINTANG'),
(6108, 61, 'KABUPATEN KAPUAS HULU'),
(6109, 61, 'KABUPATEN SEKADAU'),
(6110, 61, 'KABUPATEN MELAWI'),
(6111, 61, 'KABUPATEN KAYONG UTARA'),
(6112, 61, 'KABUPATEN KUBU RAYA'),
(6171, 61, 'KOTA PONTIANAK'),
(6172, 61, 'KOTA SINGKAWANG'),
(6201, 62, 'KABUPATEN KOTAWARINGIN BARAT'),
(6202, 62, 'KABUPATEN KOTAWARINGIN TIMUR'),
(6203, 62, 'KABUPATEN KAPUAS'),
(6204, 62, 'KABUPATEN BARITO SELATAN'),
(6205, 62, 'KABUPATEN BARITO UTARA'),
(6206, 62, 'KABUPATEN SUKAMARA'),
(6207, 62, 'KABUPATEN LAMANDAU'),
(6208, 62, 'KABUPATEN SERUYAN'),
(6209, 62, 'KABUPATEN KATINGAN'),
(6210, 62, 'KABUPATEN PULANG PISAU'),
(6211, 62, 'KABUPATEN GUNUNG MAS'),
(6212, 62, 'KABUPATEN BARITO TIMUR'),
(6213, 62, 'KABUPATEN MURUNG RAYA'),
(6271, 62, 'KOTA PALANGKA RAYA'),
(6301, 63, 'KABUPATEN TANAH LAUT'),
(6302, 63, 'KABUPATEN KOTA BARU'),
(6303, 63, 'KABUPATEN BANJAR'),
(6304, 63, 'KABUPATEN BARITO KUALA'),
(6305, 63, 'KABUPATEN TAPIN'),
(6306, 63, 'KABUPATEN HULU SUNGAI SELATAN'),
(6307, 63, 'KABUPATEN HULU SUNGAI TENGAH'),
(6308, 63, 'KABUPATEN HULU SUNGAI UTARA'),
(7606, 76, 'KABUPATEN MAMUJU TENGAH'),
(8101, 81, 'KABUPATEN MALUKU TENGGARA BARAT'),
(8102, 81, 'KABUPATEN MALUKU TENGGARA'),
(8103, 81, 'KABUPATEN MALUKU TENGAH'),
(8104, 81, 'KABUPATEN BURU'),
(8105, 81, 'KABUPATEN KEPULAUAN ARU'),
(8106, 81, 'KABUPATEN SERAM BAGIAN BARAT'),
(8107, 81, 'KABUPATEN SERAM BAGIAN TIMUR'),
(8108, 81, 'KABUPATEN MALUKU BARAT DAYA'),
(8109, 81, 'KABUPATEN BURU SELATAN'),
(8171, 81, 'KOTA AMBON'),
(8172, 81, 'KOTA TUAL'),
(8201, 82, 'KABUPATEN HALMAHERA BARAT'),
(8202, 82, 'KABUPATEN HALMAHERA TENGAH'),
(8203, 82, 'KABUPATEN KEPULAUAN SULA'),
(8204, 82, 'KABUPATEN HALMAHERA SELATAN'),
(8205, 82, 'KABUPATEN HALMAHERA UTARA'),
(8206, 82, 'KABUPATEN HALMAHERA TIMUR'),
(8207, 82, 'KABUPATEN PULAU MOROTAI'),
(8208, 82, 'KABUPATEN PULAU TALIABU'),
(8271, 82, 'KOTA TERNATE'),
(8272, 82, 'KOTA TIDORE KEPULAUAN'),
(9101, 91, 'KABUPATEN FAKFAK'),
(9102, 91, 'KABUPATEN KAIMANA'),
(9103, 91, 'KABUPATEN TELUK WONDAMA'),
(9104, 91, 'KABUPATEN TELUK BINTUNI'),
(9105, 91, 'KABUPATEN MANOKWARI'),
(9106, 91, 'KABUPATEN SORONG SELATAN'),
(9107, 91, 'KABUPATEN SORONG'),
(9108, 91, 'KABUPATEN RAJA AMPAT'),
(9109, 91, 'KABUPATEN TAMBRAUW'),
(9110, 91, 'KABUPATEN MAYBRAT'),
(9111, 91, 'KABUPATEN MANOKWARI SELATAN'),
(9112, 91, 'KABUPATEN PEGUNUNGAN ARFAK'),
(9171, 91, 'KOTA SORONG'),
(9401, 94, 'KABUPATEN MERAUKE'),
(9402, 94, 'KABUPATEN JAYAWIJAYA'),
(9403, 94, 'KABUPATEN JAYAPURA'),
(9404, 94, 'KABUPATEN NABIRE'),
(9408, 94, 'KABUPATEN KEPULAUAN YAPEN'),
(9409, 94, 'KABUPATEN BIAK NUMFOR'),
(9410, 94, 'KABUPATEN PANIAI'),
(9411, 94, 'KABUPATEN PUNCAK JAYA'),
(9412, 94, 'KABUPATEN MIMIKA'),
(9413, 94, 'KABUPATEN BOVEN DIGOEL'),
(9414, 94, 'KABUPATEN MAPPI'),
(9415, 94, 'KABUPATEN ASMAT'),
(9416, 94, 'KABUPATEN YAHUKIMO'),
(9417, 94, 'KABUPATEN PEGUNUNGAN BINTANG'),
(9418, 94, 'KABUPATEN TOLIKARA'),
(9419, 94, 'KABUPATEN SARMI'),
(9420, 94, 'KABUPATEN KEEROM'),
(9426, 94, 'KABUPATEN WAROPEN'),
(9427, 94, 'KABUPATEN SUPIORI'),
(9428, 94, 'KABUPATEN MAMBERAMO RAYA'),
(9429, 94, 'KABUPATEN NDUGA'),
(9430, 94, 'KABUPATEN LANNY JAYA'),
(9431, 94, 'KABUPATEN MAMBERAMO TENGAH'),
(9432, 94, 'KABUPATEN YALIMO'),
(9433, 94, 'KABUPATEN PUNCAK'),
(9434, 94, 'KABUPATEN DOGIYAI'),
(9435, 94, 'KABUPATEN INTAN JAYA'),
(9436, 94, 'KABUPATEN DEIYAI'),
(9471, 94, 'KOTA JAYAPURA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_group`
--
ALTER TABLE `admin_group`
  ADD PRIMARY KEY (`admin_group_id`);

--
-- Indexes for table `change_logs`
--
ALTER TABLE `change_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `exam_status`
--
ALTER TABLE `exam_status`
  ADD KEY `question_type_id` (`question_type_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `module_group`
--
ALTER TABLE `module_group`
  ADD PRIMARY KEY (`module_group_id`);

--
-- Indexes for table `module_types`
--
ALTER TABLE `module_types`
  ADD PRIMARY KEY (`module_type_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`participant_id`);

--
-- Indexes for table `participant_group`
--
ALTER TABLE `participant_group`
  ADD PRIMARY KEY (`participant_group_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `participant_id` (`participant_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `question_group`
--
ALTER TABLE `question_group`
  ADD PRIMARY KEY (`question_group_id`);

--
-- Indexes for table `question_types`
--
ALTER TABLE `question_types`
  ADD PRIMARY KEY (`question_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_group`
--
ALTER TABLE `admin_group`
  MODIFY `admin_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `change_logs`
--
ALTER TABLE `change_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `module_group`
--
ALTER TABLE `module_group`
  MODIFY `module_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `module_types`
--
ALTER TABLE `module_types`
  MODIFY `module_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `participant_group`
--
ALTER TABLE `participant_group`
  MODIFY `participant_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `question_group`
--
ALTER TABLE `question_group`
  MODIFY `question_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question_types`
--
ALTER TABLE `question_types`
  MODIFY `question_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam_status`
--
ALTER TABLE `exam_status`
  ADD CONSTRAINT `exam_status_ibfk_1` FOREIGN KEY (`question_type_id`) REFERENCES `question_types` (`question_type_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`participant_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
