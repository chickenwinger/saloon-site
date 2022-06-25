-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2020 at 12:00 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdp_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_datetime`
--

DROP TABLE IF EXISTS `booking_datetime`;
CREATE TABLE IF NOT EXISTS `booking_datetime` (
  `bookingID` int(255) NOT NULL AUTO_INCREMENT,
  `memberID` int(255) NOT NULL,
  `servID` int(255) NOT NULL,
  `employee_serviceID` int(255) DEFAULT NULL,
  `bookingDate` date NOT NULL,
  `bookingTime` varchar(255) NOT NULL,
  `notesToEmployee` longtext DEFAULT NULL,
  `notesToMember` longtext DEFAULT NULL,
  `bookingStatus` varchar(255) NOT NULL DEFAULT 'pending' COMMENT 'pending, accepted, declined',
  PRIMARY KEY (`bookingID`),
  KEY `memberID` (`memberID`),
  KEY `servID` (`servID`),
  KEY `employee_serviceID` (`employee_serviceID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_datetime`
--

INSERT INTO `booking_datetime` (`bookingID`, `memberID`, `servID`, `employee_serviceID`, `bookingDate`, `bookingTime`, `notesToEmployee`, `notesToMember`, `bookingStatus`) VALUES
(1, 1, 2, 2, '2020-04-09', '1000', NULL, 'qwe', 'accepted'),
(3, 1, 2, 2, '2020-04-20', '1000', 'qwe', NULL, 'pending'),
(17, 1, 3, 24, '2020-04-17', '1000', NULL, NULL, 'pending'),
(18, 1, 8, 20, '2020-04-17', '1000', NULL, NULL, 'pending'),
(19, 1, 12, 49, '2020-04-18', '1500', NULL, NULL, 'pending'),
(20, 1, 7, 34, '2020-04-18', '1500', 'send help', NULL, 'pending'),
(21, 1, 6, 21, '2020-04-18', '1000', NULL, NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

DROP TABLE IF EXISTS `employee_list`;
CREATE TABLE IF NOT EXISTS `employee_list` (
  `empID` int(255) NOT NULL AUTO_INCREMENT,
  `empFN` varchar(255) DEFAULT NULL,
  `empLN` varchar(255) NOT NULL,
  `empGender` varchar(255) DEFAULT NULL,
  `empEmail` varchar(255) NOT NULL,
  `empPhone` varchar(255) DEFAULT NULL,
  `empSkill` longtext DEFAULT NULL,
  `empYearOfExp` int(255) DEFAULT NULL,
  `empOffDay` int(255) DEFAULT NULL,
  `empPassword` varchar(255) NOT NULL,
  `empRole` varchar(255) NOT NULL DEFAULT 'stylist',
  `empPicture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`empID`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_list`
--

INSERT INTO `employee_list` (`empID`, `empFN`, `empLN`, `empGender`, `empEmail`, `empPhone`, `empSkill`, `empYearOfExp`, `empOffDay`, `empPassword`, `empRole`, `empPicture`) VALUES
(1, 'Zero', 'Admin', NULL, 'adminzero@on9fashion.com', NULL, NULL, NULL, NULL, '0a5d9c7897a3243b2d1215b9e2e345cc', 'admin', NULL),
(2, 'One', 'Admin', NULL, 'adminone@on9fashion.com', NULL, NULL, NULL, NULL, '21f9188e66d4c94c09b7e096f8deda50', 'admin', NULL),
(3, 'Two', 'Admin', NULL, 'admintwo@on9fashion.com', NULL, NULL, NULL, NULL, '5588cb33a7361470d0bd5302143e8c18', 'admin', NULL),
(4, 'Ong', 'Caris', 'female', 'caris_ong@on9fashion.com', '0149280765', 'Inspired by the renowned Japanese drama ', 8, 3, '4788acf2cdefc64b12c4c3fd0031249e', 'stylist', 'stylist-image/caris_ong.png'),
(5, 'Chua', 'Cody', 'male', 'cody_chua@on9fashion.com', '0132278356', 'With more than a decade of experience, Cody is always seen with a smile; ever ready to share his infectious joy with anyone. Inspired by his interest in art, exhibitions, and stage plays, he aims to achieve a perfectly balanced hairstyle for each individual.', 11, 7, '638a14bcae5b709b34b038e251947f41', 'stylist', 'stylist-image/cody_chua.png'),
(6, 'Zainul Ehsan', 'Diyana', 'female', 'diyana@on9fashion.com', '0115669828', 'Has over 5 years of experience in the styling industry. Diyana is always friendly and mingles with anyone easily. She aims to provide the best makeup service to her clients. She also provides extra hijab styling services to every female Malay clients.', 7, 6, '22b8674cae76000aa3c8f6a0a5575a4f', 'stylist', 'stylist-image/diyana_zainul_ehsan.png'),
(7, 'Sunada', 'Eriko', 'female', 'eriko_sunada@on9fashion.com', '0199775468', 'With more than a decade of experience in the industry, Eriko can create easily-maintained styles for both genders that can be simply reproduced to its salon results even at home. As a mother, she gives her best to support busy moms in their hectic days from the aspect of style and beauty.', 16, 3, 'ddf6c1c88a96bccac3e3f048c2c97e3b', 'stylist', 'stylist-image/eriko_sunada.png'),
(8, 'Yoong', 'Fung', 'male', 'fung_yoong@on9fashion.com', '012337690057', 'A growing name in the hair styling world, his charm and good-natured temperament draw guests to seek advice for tresses in distress. He enjoys strategizing and executing full-on hair makeovers, and takes satisfaction in the smiles of happy guests.', 8, 4, '5ae3ffcc0fdb5179061f450754f2a4da', 'stylist', 'stylist-image/fung_yoong.png'),
(9, 'Cao', 'Grace', 'female', 'grace_cao@on9fashion.com', '0167178699', 'Grace Cao is passionate about food and fashion. She provides wardrobe makeover, home styling, personal and fashion styling, personal shopping, beauty consultation and world-class Mandarin Chinese lesson. She has over a decade of experiences in her career.', 14, 1, '800e7b96b94f44e241c606e9da948f36', 'stylist', 'stylist-image/grace_cao.png'),
(10, 'Wang', 'Grace', 'female', 'grace_wang@on9fashion.com', '0146678831', 'Grace Wang believes that with proper make-up will enhance personal features and make them feel good about themselves. Grace has completed bridal makeup & hairstyling course in Taiwan and she is using high quality products. Grace is more than happy to see you look beautiful as she can feel your happiness too. For this simple reason she was inspired to be a make-up artist. ', 12, 6, '634620dda6c975657a620ac1ac411f6c', 'stylist', 'stylist-image/grace_wang.png'),
(11, NULL, 'Jack', 'male', 'jack@on9fashion.com', '0159359962', 'It is once said that true life is lived when tiny changes occur. Seeking pleasure in instigating such changes, Jack offers gorgeous permed \'dos, balayage color designs, and many more hair styles to enhance your natural beauty in line with the trends of Japan!', 5, 5, '4ff9fc6e4e5d5f590c4f2134a8cc96d1', 'stylist', 'stylist-image/jack.png'),
(12, 'Lim', 'Jeddy', 'male', 'jeddy_lim@on9fashion.com', '0182235162', 'With several years of styling experience, his ultimate goal is to achieve maximum customer satisfaction. His creativity is especially optimized in the various shades of color mixes that he pulls out to suit each individual personality on his extensive list of happy customers.', 7, 4, '41c804651f8454f067467d29df2d9d75', 'stylist', 'stylist-image/jeddy_lim.png'),
(13, 'Ee', 'Jeff', 'male', 'jeff_ee@on9fashion.com', '0112696653', 'With amiable manners and an easy-going disposition, Jeff seeks the thrill of exciting styles to bring out each customer\'s best features. Feel free to seek his opinion on what color and styles will suit your best.', 3, 6, 'a51f28a0a7ef21a51790f60229068c46', 'stylist', 'stylist-image/jeff_ee.png'),
(14, 'Nakamura', 'Kei', 'female', 'kei_nakamura@on9fashion.com', '0175124568', 'With her insightful vision towards beauty trends, Kei is dedicated to immerse herself in this industry that could blooms her talents and passion. Gentle yet attentive personality have made it natural for Kei to master and create loads of beautiful works, especially her favourite luscious eyelash design for every beauty seeker.', 8, 7, '7ca660ffdee2b4d5fc9273e39fa5662a', 'stylist', 'stylist-image/kei_nakamura.png'),
(15, 'Luna', 'Min', 'female', 'min_luna@on9fashion.com', '0156896115', 'She grew up not caring about fashion at all, but now it is integral in her life and career. Min Luna certainly has witnessed an about turn in where her passion lies. On advice for styling oneself, especially when it comes to creating a capsule wardrobe (which is a big trend right now), she points out, Never ever wear your fashion items in just one way.', 16, 1, '5ef80b347ce0f9ca2ddb41c375d59124', 'stylist', 'stylist-image/min_luna.png'),
(16, 'Makino', 'Natsumi', 'female', 'natsumi_makino@on9fashion.com', '0199954826', 'With past experiences working in the UK, Natsumi smoothly communicates in English as she skillfully plays with edgy cuts and creative colours. She sets her sights on discovering the best hair style that can bring out every individual’s natural beauty.', 12, 6, 'cc81b06645b966c161ca53acc8597037', 'stylist', 'stylist-image/natsumi_makino.png'),
(17, 'Lim', 'Suky', 'female', 'suky_lim@on9fashion.com', '0142122363', 'Suky has spent some years gaining experiences and building solid relationships with regulars who highly approve of her works. With swift hands and deft fingers, she is ever-determined to do her best to make a mark in the highly-driven hair industry.', 9, 3, '89c4b3228adf7fbca4fab4d4baee19da', 'stylist', 'stylist-image/suky_lim.png'),
(18, 'Cheh', 'Vicky', 'female', 'vicky_cheh@on9fashion.com', '0187575618', 'A courteous yet friendly city girl that aimed to become a professional stylist in this highly-driven hair and beauty industry. Vicky has been honing her skills patiently in the past 7 years and she has gained a long list of happy customers even during her assistant career. For her, nothing beats the satisfaction of seeing her guest enjoys the new look!', 8, 7, '5cc45ee4d02c865a65504e47532a4b8d', 'stylist', 'stylist-image/vicky_cheh.png'),
(19, 'Lee', 'Xuan', 'female', 'xuan_lee@on9fashion.com', '0112113556', 'Xuan has a list of happy regulars who have trusted her styling instincts for many years. With a warm and sincere heart, alongside trained techniques, she hopes to satisfy every customer’s personal preferences and needs as best she can.', 12, 4, '09b0d3f2333fe2d45518803873bf4da7', 'stylist', 'stylist-image/xuan_lee.png'),
(20, 'Inao', 'Yoshitaka', 'male', 'yoshitaka_inao@on9fashion.com', '0156265537', 'With more than a decade of experience, his regulars, including the country\'s top bloggers, have commended on his lively personality and unwavering focus when it comes to hair stylng. His sole passion lies in the creative art of hair design.', 18, 5, '379b7f0c698e55e22d59890643b845b9', 'stylist', 'stylist-image/yoshitaka_inao.png'),
(21, 'Chong', 'Yves', 'male', 'yves_chong@on9fashion.com', '0126335164', 'Pronounced “eev”, he embraces challenges in new styles and trends, though his first love will always be natural, classic hairstyles. His philosophy in lifelong learning and pleasant charm has contributed to a growing list of returning customers which includes public figures.', 14, 1, 'yves_chong', 'stylist', 'stylist-image/yves_chong.png'),
(22, 'Lee', 'Zack', 'male', 'zack_lee@on9fashion.com', '0178495238', 'The years spent under the tutelage of the country\'s best stylists has honed his knowledge, skills, and creativity in perfecting chic cuts, colours, perms, and styles for both men and women. Change your hair to change the way you look and feel today!', 8, 2, '06e92d037dc3f4b0d640fca8177ecbb6', 'stylist', 'stylist-image/zack_lee.png'),
(23, 'Iwahashi', 'Kotoko', 'female', 'kotoko_iwahashi@on9fashion.com', '0165523648', 'Kotoko loves talking to customers. Every day, she considers the best way to provide enjoyable, relaxing moments for customers in NALU. Especially for shampooing and massaging, she strives to give her best to provide these moments. Are you looking for a soothing, pampering hair wash? We look forward to serving you.', 6, 4, 'c1d4c6700d70605171b536ddd7f7d7c0', 'stylist', 'stylist-image/kotoko_iwahashi.png');

-- --------------------------------------------------------

--
-- Table structure for table `employee_service`
--

DROP TABLE IF EXISTS `employee_service`;
CREATE TABLE IF NOT EXISTS `employee_service` (
  `emp_servID` int(255) NOT NULL AUTO_INCREMENT,
  `empID` int(255) DEFAULT NULL,
  `servID` int(255) DEFAULT NULL,
  PRIMARY KEY (`emp_servID`),
  KEY `empID` (`empID`),
  KEY `servID` (`servID`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_service`
--

INSERT INTO `employee_service` (`emp_servID`, `empID`, `servID`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 4, 3),
(4, 5, 2),
(5, 5, 4),
(6, 5, 5),
(7, 6, 6),
(8, 6, 9),
(9, 6, 13),
(10, 7, 1),
(11, 7, 5),
(12, 7, 3),
(13, 8, 10),
(14, 8, 11),
(15, 8, 12),
(16, 9, 8),
(17, 9, 9),
(18, 9, 13),
(19, 10, 7),
(20, 10, 8),
(21, 10, 6),
(22, 11, 2),
(23, 11, 4),
(24, 11, 3),
(25, 12, 10),
(26, 12, 4),
(27, 12, 12),
(28, 13, 1),
(29, 13, 2),
(30, 13, 3),
(31, 14, 13),
(32, 14, 9),
(33, 14, 3),
(34, 15, 7),
(35, 15, 8),
(36, 15, 6),
(37, 16, 2),
(38, 16, 3),
(39, 16, 5),
(40, 17, 1),
(41, 17, 7),
(42, 17, 6),
(43, 18, 10),
(44, 18, 3),
(45, 18, 4),
(46, 19, 4),
(47, 19, 5),
(48, 19, 3),
(49, 20, 12),
(50, 20, 13),
(51, 20, 11),
(52, 21, 1),
(53, 21, 3),
(54, 21, 5),
(55, 22, 8),
(56, 22, 12),
(57, 22, 10),
(58, 23, 7),
(59, 23, 8),
(60, 23, 12);

-- --------------------------------------------------------

--
-- Table structure for table `member_address`
--

DROP TABLE IF EXISTS `member_address`;
CREATE TABLE IF NOT EXISTS `member_address` (
  `member_addressID` int(255) NOT NULL AUTO_INCREMENT,
  `memberID` int(255) NOT NULL,
  `memberAddress` longtext NOT NULL,
  `defaultAddress` varchar(255) DEFAULT NULL COMMENT 'null, default, removed',
  PRIMARY KEY (`member_addressID`),
  KEY `memberID` (`memberID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_address`
--

INSERT INTO `member_address` (`member_addressID`, `memberID`, `memberAddress`, `defaultAddress`) VALUES
(1, 1, '1, Jalan Nanas 16, Bandar Botanik, 41200, Klang, Selangor', 'default'),
(2, 2, '1, Jalan Teknologi 4, Parkhill, 51300, Bukit Jalil, Kuala Lumpur', 'default'),
(3, 1, '20, Jalan Delima 12, Bandar Parklands, 41200, Klang, Selangor', NULL),
(4, 3, '1, Jalan Kasturi 5, Taman Botanik, 41200, Klang, Selangor', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `member_list`
--

DROP TABLE IF EXISTS `member_list`;
CREATE TABLE IF NOT EXISTS `member_list` (
  `memberID` int(255) NOT NULL AUTO_INCREMENT,
  `memberFN` varchar(255) NOT NULL,
  `memberLN` varchar(255) NOT NULL,
  `memberGender` varchar(255) NOT NULL,
  `memberUsername` varchar(255) NOT NULL,
  `memberEmail` varchar(255) NOT NULL,
  `memberPhone` varchar(255) NOT NULL,
  `memberPassword` varchar(255) NOT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_list`
--

INSERT INTO `member_list` (`memberID`, `memberFN`, `memberLN`, `memberGender`, `memberUsername`, `memberEmail`, `memberPhone`, `memberPassword`) VALUES
(1, 'Kong Weng', 'Chia', 'male', 'ckw', 'ckw@hotmail.com', '0132237917', 'bbb4b38004869f86a753f937cc26dce8'),
(2, 'Wei Han', 'Lee', 'male', 'lwh', 'lwh@hotmail.com', '0196788841', '2424cea8861a4cfc03ea8b8df96b1e86'),
(3, 'Zheng Hong', 'Chee', 'male', 'chee', 'chee@hotmai.com', '0194567829', '5efdc8a07a2d58175d4cb734069221e0');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

DROP TABLE IF EXISTS `order_list`;
CREATE TABLE IF NOT EXISTS `order_list` (
  `orderID` int(255) NOT NULL AUTO_INCREMENT,
  `memberID` int(255) NOT NULL,
  `orderPrice` int(255) DEFAULT NULL,
  PRIMARY KEY (`orderID`),
  KEY `memberID` (`memberID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`orderID`, `memberID`, `orderPrice`) VALUES
(1, 1, 637),
(3, 2, NULL),
(4, 1, NULL),
(5, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `outfit_list`
--

DROP TABLE IF EXISTS `outfit_list`;
CREATE TABLE IF NOT EXISTS `outfit_list` (
  `outfitID` int(255) NOT NULL AUTO_INCREMENT,
  `outfitTitle` varchar(255) NOT NULL,
  `outfitGender` varchar(255) NOT NULL,
  `outfitCategory` varchar(255) NOT NULL,
  `outfitDescription` longtext NOT NULL,
  `outfitPrice` int(255) NOT NULL,
  `outfitPicture` varchar(255) NOT NULL,
  PRIMARY KEY (`outfitID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outfit_list`
--

INSERT INTO `outfit_list` (`outfitID`, `outfitTitle`, `outfitGender`, `outfitCategory`, `outfitDescription`, `outfitPrice`, `outfitPicture`) VALUES
(1, 'Wedding Dress 1', 'female', 'Wedding', 'ADLN New Custom Plus Size Cap Sleeve Wedding Dresses Sequin Tulle Ball Gown Wedding Bride Dress Applique Vestidos De Novia', 150, 'outfit/outfit-image/wd1.png'),
(2, 'Wedding Dress 2', 'female', 'Wedding', 'SL-5061 Off the Shoulder Wedding Bridal Dress Ball Gown Embroidery Lace applique Boho Wedding Dress 2020', 150, 'outfit/outfit-image/wd2.png'),
(3, 'Wedding Dress 3', 'female', 'Wedding', 'SL-5 Charming A-Line Short Sleeve Tulle Lace Appliques Vintage Boho Wedding Dress', 150, 'outfit/outfit-image/wd3.png'),
(4, 'Dinner Dress 1', 'female', 'Event', 'Dinner Dress suitable for wedding dinner, company annual dinner, award dinner, prom night, graduation night, product launching event, charity dinner, etc', 100, 'outfit/outfit-image/dd1.png'),
(5, 'Dinner Dress 2', 'female', 'Event', 'Dinner Dress suitable for wedding dinner, company annual dinner, award dinner, prom night, graduation night, product launching event, charity dinner, etc', 100, 'outfit/outfit-image/dd2.png'),
(6, 'Dinner Dress 3', 'female', 'Event', 'Dinner Dress suitable for wedding dinner, company annual dinner, award dinner, prom night, graduation night, product launching event, charity dinner, etc', 100, 'outfit/outfit-image/dd3.png'),
(7, 'Dinner Suit 1', 'male', 'Event', 'Dinner Suit suitable for wedding dinner, company annual dinner, award dinner, prom night, graduation night, product launching event, charity dinner, etc', 150, 'outfit/outfit-image/ds1.png'),
(8, 'Dinner Suit 2', 'male', 'Event', 'Dinner Suit suitable for wedding dinner, company annual dinner, award dinner, prom night, graduation night, product launching event, charity dinner, etc', 150, 'outfit/outfit-image/ds2.png'),
(9, 'Dinner Suit 3', 'male', 'Event', 'Dinner Suit suitable for wedding dinner, company annual dinner, award dinner, prom night, graduation night, product launching event, charity dinner, etc', 150, 'outfit/outfit-image/ds3.png'),
(10, 'Halloween Costume 1', 'male', 'Event', 'Typical Halloween costume with a scary mask!', 50, 'outfit/outfit-image/halloween1.png'),
(11, 'Halloween Costume 2', 'female', 'Event', 'Typical Halloween witch costume! ', 70, 'outfit/outfit-image/halloween2.png'),
(12, 'Christmas Costume 1', 'male', 'Event', 'Santa Claus Costume', 70, 'outfit/outfit-image/christmas1.png'),
(13, 'Christmas Costume 2', 'female', 'Event', 'Female Christmas Costume', 60, 'outfit/outfit-image/christmas2.png'),
(14, 'Traditional Chinese Suit 1', 'male', 'Event', 'Traditional Chinese clothing tang suit red tunic men', 60, 'outfit/outfit-image/c1.png'),
(15, 'Traditional Chinese Suit 2', 'female', 'Event', 'New Red Chinese Women Satin Cheongsam Qipao Flower Wedding Dress', 60, 'outfit/outfit-image/c2.png'),
(16, 'Traditional Malay Suit 1', 'male', 'Event', 'New Baju Melayu Satin Male', 80, 'outfit/outfit-image/m1.png'),
(17, 'Traditional Malay Suit 2', 'female', 'Event', 'New Baju Kurung Women Satin Malay', 90, 'outfit/outfit-image/m2.png'),
(18, 'Traditional Indian Suit 1', 'male', 'Event', 'Indian Men Clothing Black', 90, 'outfit/outfit-image/i2.png'),
(19, 'Traditional Indian Suit 2', 'female', 'Event', 'Net Embroidery Sharara Suit in Black', 100, 'outfit/outfit-image/i1.png'),
(20, 'Groom Wedding Suit 1', 'male', 'Wedding', 'Grey Blue Plaid Suit Men, 3 Piece Groom Wedding Suit Burgundy Suits For Men, High Quality Mens Formal Business Wear', 100, 'outfit/outfit-image/ws3.png'),
(22, 'qwer', 'male', 'Wedding', 'qwer', 1234, 'outfit/outfit-image/c1.png');

-- --------------------------------------------------------

--
-- Table structure for table `outfit_rental`
--

DROP TABLE IF EXISTS `outfit_rental`;
CREATE TABLE IF NOT EXISTS `outfit_rental` (
  `rentalID` int(255) NOT NULL AUTO_INCREMENT,
  `memberID` int(255) NOT NULL,
  `outfitID` int(255) NOT NULL,
  `outfit_sizeID` int(255) NOT NULL,
  `rentalDate` date NOT NULL,
  `rentalDuration` int(255) NOT NULL,
  `outfitReturn` varchar(255) NOT NULL DEFAULT 'on-rent' COMMENT 'on-rent, returned',
  `depositStatus` varchar(255) NOT NULL DEFAULT 'on-hold' COMMENT 'on-hold, returned, damaged',
  PRIMARY KEY (`rentalID`),
  KEY `memberID` (`memberID`),
  KEY `outfitID` (`outfitID`),
  KEY `outfit_sizeID` (`outfit_sizeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outfit_rental`
--

INSERT INTO `outfit_rental` (`rentalID`, `memberID`, `outfitID`, `outfit_sizeID`, `rentalDate`, `rentalDuration`, `outfitReturn`, `depositStatus`) VALUES
(1, 1, 16, 48, '2020-04-18', 2, 'on-rent', 'on-hold'),
(2, 1, 16, 48, '2020-04-24', 3, 'on-rent', 'on-hold'),
(3, 1, 20, 26, '2020-04-16', 2, 'on-rent', 'on-hold'),
(4, 1, 12, 1, '2020-04-16', 2, 'on-rent', 'on-hold');

-- --------------------------------------------------------

--
-- Table structure for table `outfit_size`
--

DROP TABLE IF EXISTS `outfit_size`;
CREATE TABLE IF NOT EXISTS `outfit_size` (
  `outfit_sizeID` int(255) NOT NULL AUTO_INCREMENT,
  `outfitID` int(255) NOT NULL,
  `outfitSize` varchar(255) NOT NULL COMMENT 'S, M, L, XL, XXL',
  `outfitstock` int(255) NOT NULL,
  PRIMARY KEY (`outfit_sizeID`),
  KEY `outfitID` (`outfitID`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outfit_size`
--

INSERT INTO `outfit_size` (`outfit_sizeID`, `outfitID`, `outfitSize`, `outfitstock`) VALUES
(1, 12, 'S', 1),
(2, 12, 'M', 3),
(3, 12, 'L', 1),
(4, 13, 'XS', 2),
(5, 13, 'M', 3),
(6, 4, 'M', 4),
(7, 4, 'L', 2),
(8, 4, 'XL', 2),
(9, 5, 'S', 4),
(10, 5, 'M', 2),
(11, 5, 'L', 3),
(12, 6, 'XS', 1),
(13, 6, 'M', 2),
(14, 6, 'L', 3),
(15, 7, 'M', 4),
(16, 7, 'L', 3),
(17, 7, 'XL', 2),
(18, 7, 'XXL', 1),
(19, 8, 'M', 4),
(20, 8, 'L', 3),
(21, 8, 'XL', 2),
(22, 9, 'S', 2),
(23, 9, 'M', 2),
(24, 9, 'L', 3),
(25, 20, 'S', 2),
(26, 20, 'M', 1),
(27, 20, 'L', 3),
(28, 10, 'XS', 2),
(29, 10, 'S', 3),
(30, 10, 'M', 2),
(31, 10, 'L', 3),
(32, 11, 'S', 2),
(33, 11, 'M', 2),
(34, 14, 'S', 2),
(35, 14, 'M', 4),
(36, 14, 'L', 3),
(37, 14, 'XL', 2),
(38, 15, 'M', 3),
(39, 15, 'L', 2),
(40, 15, 'XL', 2),
(41, 18, 'S', 3),
(42, 18, 'M', 4),
(43, 18, 'L', 3),
(44, 19, 'S', 3),
(45, 19, 'M', 4),
(46, 19, 'L', 2),
(47, 16, 'S', 3),
(48, 16, 'M', 3),
(49, 16, 'L', 2),
(50, 16, 'XL', 1),
(51, 17, 'S', 3),
(52, 17, 'M', 3),
(53, 17, 'L', 2),
(54, 17, 'XL', 1),
(55, 1, 'S', 2),
(56, 1, 'M', 2),
(57, 1, 'L', 1),
(58, 1, 'XL', 1),
(59, 2, 'S', 2),
(60, 2, 'M', 2),
(61, 2, 'L', 1),
(62, 2, 'XL', 1),
(63, 3, 'S', 2),
(64, 3, 'L', 3),
(65, 3, 'XL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

DROP TABLE IF EXISTS `product_list`;
CREATE TABLE IF NOT EXISTS `product_list` (
  `productID` int(255) NOT NULL AUTO_INCREMENT,
  `productTitle` varchar(255) NOT NULL,
  `productContent` longtext NOT NULL,
  `productDescription` longtext DEFAULT NULL,
  `productStock` int(255) NOT NULL,
  `productCategory` varchar(255) NOT NULL,
  `productPrice` int(255) NOT NULL,
  `productPicture` varchar(255) NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`productID`, `productTitle`, `productContent`, `productDescription`, `productStock`, `productCategory`, `productPrice`, `productPicture`) VALUES
(1, 'Gucci Sheer Lipstick', 'x1 Gucci Lipstick', 'test test test', 3, 'makeup', 210, 'product/product-image/gucci-lipstick.png'),
(2, 'Bio Essence 24K Gold', 'x1 Bottle of Bio Essence Skincare', NULL, 17, 'skincare', 100, 'product/product-image/bio-essence-gold.png'),
(3, 'Estee Lauder Skincare Set (Limited)', 'x1 Micro Essence Skin Activating Treatment Lotion\r\nx1 Advanced Night Repair Synchronized Recovery Complex II\r\nx1 Advanced Night Repair Eye Supercharged Complex Synchronized Recover', 'qwe', 1, 'makeup', 150, 'product/product-image/estee-lauder-skincare.png'),
(4, 'Aveeno Shampoo & Conditioner', 'x1 Aveeno Shampoo\r\nx1 Aveeno Conditioner', NULL, 14, 'hairproduct', 282, 'product/product-image/aveeno-shampoo.png'),
(5, 'MAC Lipstick (Ruby Woo)', 'x1 Retro Matte Lipstick 3g (Ruby Woo)', 'MAC Cosmetic\'s Retro Matte Lipstick is the iconic product that made MAC famous. This long-wearing formula provides a completely matte finish.', 20, 'makeup', 85, 'product/product-image/lip1.png'),
(6, 'MAC Lipstick (Relentlessly Red)', 'x1 Retro Matte Lipstick 3g (Relentlessly Red)', 'MAC Cosmetic\'s Retro Matte Lipstick is the iconic product that made MAC famous. This long-wearing formula provides a completely matte finish.', 20, 'makeup', 85, 'product/product-image/lip2.png'),
(7, 'MAC Lipstick (All Fired Up)', 'x1 Retro Matte Lipstick 3g (All Fired Up)', 'MAC Cosmetic\'s Retro Matte Lipstick is the iconic product that made MAC famous. This long-wearing formula provides a completely matte finish.', 20, 'makeup', 85, 'product/product-image/lip3.png'),
(8, 'MAC Lipstick (Fat Out Fabulous)', 'x1 Retro Matte Lipstick 3g (Fat Out Fabulous)', 'MAC Cosmetic\'s Retro Matte Lipstick is the iconic product that made MAC famous. This long-wearing formula provides a completely matte finish.', 20, 'makeup', 85, 'product/product-image/lip4.png'),
(9, 'MAC Lipstick (Runway Hit)', 'x1 Retro Matte Lipstick 3g (Runway Hit)', 'MAC Cosmetic\'s Retro Matte Lipstick is the iconic product that made MAC famous. This long-wearing formula provides a completely matte finish.', 20, 'makeup', 85, 'product/product-image/lip5.png'),
(10, 'MAC Lipstick (Dangerous)', 'x1 Retro Matte Lipstick 3g (Dangerous)', 'MAC Cosmetic\'s Retro Matte Lipstick is the iconic product that made MAC famous. This long-wearing formula provides a completely matte finish.', 20, 'makeup', 85, 'product/product-image/lip6.png'),
(11, 'MARC JACOBS Eyeliner (Blacquer)', 'x1 Highliner Liquid-Gel Eyeliner 3g (Blacquer)', 'A waterproof, liquid-gel eyeliner with extreme longwear, shiny color, available in Marc’s signature black shade and eye-catching metallic finishes. ', 20, 'makeup', 120, 'product/product-image/el1.png'),
(12, 'MARC JACOBS Eyeliner (Gold Getter)', 'x1 Highliner Liquid-Gel Eyeliner 3g (Gold Getter)', 'A waterproof, liquid-gel eyeliner with extreme longwear, shiny color, available in Marc’s signature black shade and eye-catching metallic finishes. ', 20, 'makeup', 120, 'product/product-image/el2.png'),
(13, 'MARC JACOBS Eyeliner (Blitz Coin)', 'x1 Highliner Liquid-Gel Eyeliner 3g (Blitz Coin)', 'A waterproof, liquid-gel eyeliner with extreme longwear, shiny color, available in Marc’s signature black shade and eye-catching metallic finishes.', 20, 'makeup', 120, 'product/product-image/el3.png'),
(14, 'MARC JACOBS Eyeliner (Star Magic)', 'x1 Highliner Liquid-Gel Eyeliner 3g (Star Magic)', 'A waterproof, liquid-gel eyeliner with extreme longwear, shiny color, available in Marc’s signature black shade and eye-catching metallic finishes. ', 20, 'makeup', 120, 'product/product-image/el4.png'),
(15, 'SEPHORA COLLECTION Powder Foundation (Delicate Beige)', 'x1 Matte Perfection Powder Foundation (Delicate Beige)', 'A Sephora Collection powder foundation with a creamy texture that blends with the skin for a comfortable matte finish that lasts for 8 hours.', 20, 'makeup', 80, 'product/product-image/pf1.png'),
(16, 'SEPHORA COLLECTION Powder Foundation (Cream)', 'x1 Matte Perfection Powder Foundation (Cream)', 'A Sephora Collection powder foundation with a creamy texture that blends with the skin for a comfortable matte finish that lasts for 8 hours.', 20, 'makeup', 80, 'product/product-image/pf2.png'),
(17, 'SEPHORA COLLECTION Powder Foundation (Camel)', 'x1 Matte Perfection Powder Foundation (Camel)', 'A Sephora Collection powder foundation with a creamy texture that blends with the skin for a comfortable matte finish that lasts for 8 hours.', 20, 'makeup', 80, 'product/product-image/pf3.png'),
(18, 'SEPHORA COLLECTION Powder Foundation (Amber)', 'x1 Matte Perfection Powder Foundation (Amber)', 'A Sephora Collection powder foundation with a creamy texture that blends with the skin for a comfortable matte finish that lasts for 8 hours.', 20, 'makeup', 80, 'product/product-image/pf4.png'),
(19, 'CLINIQUE Moisture Surge 30ml', 'x1 Moisture Surge 72-Hour Auto-Replenishing Hydrator', 'A refreshing gel-cream that provides an instant moisture boost, now enhanced to deliver almost twice as much hydration at the end of the day than it did before.', 20, 'skincare', 100, 'product/product-image/ms1.png'),
(20, 'CLINIQUE Moisture Surge 50ml', 'x1 Moisture Surge 72-Hour Auto-Replenishing Hydrator', 'A refreshing gel-cream that provides an instant moisture boost, now enhanced to deliver almost twice as much hydration at the end of the day than it did before.', 20, 'skincare', 175, 'product/product-image/ms2.png'),
(21, 'CLINIQUE Moisturising Lotion 30ml', 'x1 Moisturising Lotion 30ml', 'Dermatologist-developed formula combines all-day hydration with skin-strengthening ingredients to help skin look younger, longer. Helps strengthen skin\'s own moisture barrier by 54%, so more moisture stays in.', 20, 'skincare', 50, 'product/product-image/ml1.png'),
(22, 'CLINIQUE Moisturising Lotion 50ml', 'x1 Moisturising Lotion 50ml', 'Dermatologist-developed formula combines all-day hydration with skin-strengthening ingredients to help skin look younger, longer. Helps strengthen skin\'s own moisture barrier by 54%, so more moisture stays in.', 20, 'skincare', 80, 'product/product-image/ml2.png'),
(23, 'CLINIQUE Moisturising Lotion 125ml', 'x1 Moisturising Lotion 30ml (with pump)', 'Dermatologist-developed formula combines all-day hydration with skin-strengthening ingredients to help skin look younger, longer. Helps strengthen skin\'s own moisture barrier by 54%, so more moisture stays in.', 20, 'skincare', 150, 'product/product-image/ml3.png'),
(24, 'KERASTASE PARIS', 'x1 Kerastase Résistance Shampoo Force Architecte 250ml', 'The KERASTASE RÉSISTANCE BAIN FORCE ARCHITECTE is a strengthening shampoo for brittle, damaged hair with split ends reconstructing your hair bringing softeness, smoother and leaving your hair strong and revitalised.', 20, 'hairproduct', 55, 'product/product-image/shampoo2.png'),
(25, 'KERASTASE PARIS', 'x1 Kerastase Aura Botanica Shampoo Micellaire 250ml', 'Aura Botanica by Kérastase relies on the power of nature. The KERASTASE AURA BOTANICA BAIN MICELLAIRE is a natural and gentle shampoo that does not complicate the hair. The gentle micellar hairbath, like all Aura Botanica products, works with natural and biodegradable ingredients. Valuable oils make the hair shine, healthy, smooth and light. The gentle cleansing removes all impurities preparing the hair optimally to absorb the care ingredients of the following step with Conditioner Soin Fondamental.', 20, 'hairproduct', 60, 'product/product-image/shampoo3.png'),
(26, 'KERASTASE PARIS', 'x1 Kerastase Resistance Ciment TherMique 150ml\r\nx1 Ciment Anti-Usure 200ml\r\nx1 Bain Force Architecte 250ml\r\n', 'Strengthening hair shampoo, which reconstructs light to more structurally damaged hair and strengthens the hair fibers on the surface. The Vita-Ciment ® Complex fills the putty substance and strengthens the inside of the hair fiber. Vita-Topseal is responsible for the construction of the outer protective layer and thus covers the fiber to protect it from external attacks. The resilience of the hair is increased and the hairstyle is supple shiny.', 10, 'hairproduct', 240, 'product/product-image/shampoo4.png'),
(27, 'BIOTIN & COLLAGEN SHAMPOO 385ml', 'x1 Bottle of BIOTIN & COLLAGEN SHAMPOO 385ml', 'Help thicken and texturize any hair type with just one use. This powerful formula helps volumize even the skinniest strands into fuller and more abundant looking locks.', 20, 'hairproduct', 48, 'product/product-image/shampoo1.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

DROP TABLE IF EXISTS `product_order`;
CREATE TABLE IF NOT EXISTS `product_order` (
  `product_orderID` int(255) NOT NULL AUTO_INCREMENT,
  `orderID` int(255) NOT NULL,
  `productID` int(255) NOT NULL,
  `orderQuantity` int(255) NOT NULL,
  `orderDateTime` date DEFAULT NULL,
  `orderPayment` varchar(255) NOT NULL DEFAULT 'pending' COMMENT 'pending, paid, cancelled',
  PRIMARY KEY (`product_orderID`),
  KEY `productID` (`productID`),
  KEY `orderID` (`orderID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`product_orderID`, `orderID`, `productID`, `orderQuantity`, `orderDateTime`, `orderPayment`) VALUES
(18, 3, 10, 1, NULL, 'pending'),
(19, 3, 2, 1, NULL, 'pending'),
(20, 3, 8, 1, NULL, 'pending'),
(21, 3, 20, 1, NULL, 'pending'),
(22, 3, 25, 1, NULL, 'pending'),
(23, 3, 3, 1, NULL, 'pending'),
(38, 1, 23, 1, '2020-04-09', 'paid'),
(39, 1, 4, 1, '2020-04-09', 'paid'),
(40, 1, 9, 1, '2020-04-09', 'paid'),
(41, 1, 12, 1, '2020-04-09', 'paid'),
(43, 4, 25, 2, NULL, 'pending'),
(44, 4, 3, 1, NULL, 'pending'),
(45, 4, 9, 2, NULL, 'pending'),
(46, 4, 20, 1, NULL, 'pending'),
(47, 4, 11, 14, NULL, 'pending'),
(48, 5, 16, 1, NULL, 'pending'),
(49, 5, 11, 2, NULL, 'pending'),
(50, 5, 27, 1, NULL, 'pending'),
(51, 5, 24, 1, NULL, 'pending'),
(52, 4, 5, 4, NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

DROP TABLE IF EXISTS `service_list`;
CREATE TABLE IF NOT EXISTS `service_list` (
  `servID` int(255) NOT NULL AUTO_INCREMENT,
  `servTitle` varchar(255) NOT NULL,
  `servCategory` varchar(255) NOT NULL,
  `servDescription` longtext NOT NULL,
  `servPrice` int(255) NOT NULL,
  `servPicture` varchar(255) NOT NULL,
  PRIMARY KEY (`servID`)
) ENGINE=InnoDB AUTO_INCREMENT=490 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`servID`, `servTitle`, `servCategory`, `servDescription`, `servPrice`, `servPicture`) VALUES
(1, 'Hair Wash & Cut', 'Hair Styling', 'Wash & Cut is perfect for those who want to look good, quick. This wash and cut option includes a thorough shampooing session utilizing professional shampoo and condition products.\r\nOnce that’s done, you can choose from a list of our senior stylists to director stylists who will consult what works best with your style needs.\r\n', 130, 'service/service-image/hair1.png'),
(2, 'Hair Wash & Blow', 'Hair Styling', 'Wash & Blow is for those that want to be an instant celebrity, just consult our stylists on what works best on you! This wash and blow option includes a wash with professional shampoo and conditioner followed by 3 different blow-dry options to finish off your look.', 110, 'service/service-image/hair2.png'),
(3, 'Hair Coloring', 'Hair Styling', 'If you are looking to add some ‘oomph’ into your hairstyle or to do a cover up on your sprouting gray hairs!\r\nChoosing a hair color could be one of the most difficult decisions, but with our professional stylists, worry no more as they will choose the perfect color just for you.\r\n', 180, 'service/service-image/hair3.png'),
(4, 'Hair Extension', 'Hair Styling', 'Make your dream come true! Have the longer, luscious, fuller hair you have always dreamt of with our hair extensions, which you can style easily as if it’s your own hair.\r\nOur stylists uses an innovative bonding technique that does not hurt your original hair, it also makes the extensions invisible and last for months.\r\n', 220, 'service/service-image/hair4.png'),
(5, 'Rebonding', 'Hair Styling', 'Reborn your hair with this service! Completely change your hairstyle either from crazy unmanageable hair to silky smooth straight hair. Bye bye damaged hair!\r\nOur professional stylists will provide you tips and tricks so you can keep your beautifully reborn hair longer!\r\n', 250, 'service/service-image/hair5.png'),
(6, 'Traditional Outfit Design', 'Design', 'Book the service to design your desired outfit by enjoying our doorstep outfit design service provided by our professional outfit designer.', 150, 'service/service-image/design1.png'),
(7, 'Wedding Outfit Design', 'Design', 'Book the service to design your desired outfit by enjoying our doorstep outfit design service provided by our professional outfit designer.', 150, 'service/service-image/design2.png'),
(8, 'Business Casual Outfit Design', 'Design', 'Book the service to design your desired outfit by enjoying our doorstep outfit design service provided by our professional outfit designer.', 150, 'service/service-image/design3.png'),
(9, 'Dinner Makeup Service', 'Makeup ', 'Need a dinner makeup service but tired of searching high and low for the best makeup artist in Malaysia? Or just simply running out of time and needed last minute booking? ON9 Studio will send your desired artist to your doorstep to help you in makeup service according to your style preference.', 120, 'service/service-image/dinner_makeup.png'),
(10, 'Special Event Makeup Service', 'Makeup', 'Costume makeup requires highly professional skills set, On9 Fashion Studio handpicks professional makeup artist that has experience in doing special effect makeup for the specific character that you\'re looking for.', 150, 'service/service-image/special_event_makeup.png'),
(11, 'Graduation Makeup Service', 'Makeup', 'Graduation is your milestone event and you need to get ready early in the morning. On9 Fashion Studio sends certified and experienced makeup artist right to your doorstep to help you and your family members get ready on time.', 150, 'service/service-image/graduation_makeup.png'),
(12, 'Commercial Makeup Service', 'Makeup', 'Makeup for commercial filming or video requires natural, subtle yet features defining skills. On9 Fashion Studio handpick the most talented makeup artist and send them to work with your crew to bring out the best of your talent in commercials.', 380, 'service/service-image/commercial_makeup.png'),
(13, 'Kid Makeup Service', 'Makeup', 'Looking for kids makeup for birthday event or performance in school? On9 Fashion Studio handpicks experienced makeup artist that knows the right type of makeup suitable for different types of occasion. Leave it to us to help doll your kid up like a prince or a princess.', 100, 'service/service-image/kid_makeup.png');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_datetime`
--
ALTER TABLE `booking_datetime`
  ADD CONSTRAINT `booking_datetime_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member_list` (`memberID`),
  ADD CONSTRAINT `booking_datetime_ibfk_2` FOREIGN KEY (`servID`) REFERENCES `service_list` (`servID`),
  ADD CONSTRAINT `booking_datetime_ibfk_3` FOREIGN KEY (`employee_serviceID`) REFERENCES `employee_service` (`emp_servID`);

--
-- Constraints for table `employee_service`
--
ALTER TABLE `employee_service`
  ADD CONSTRAINT `employee_service_ibfk_1` FOREIGN KEY (`servID`) REFERENCES `service_list` (`servID`),
  ADD CONSTRAINT `employee_service_ibfk_2` FOREIGN KEY (`empID`) REFERENCES `employee_list` (`empID`);

--
-- Constraints for table `member_address`
--
ALTER TABLE `member_address`
  ADD CONSTRAINT `member_address_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member_list` (`memberID`);

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `order_list_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member_list` (`memberID`);

--
-- Constraints for table `outfit_rental`
--
ALTER TABLE `outfit_rental`
  ADD CONSTRAINT `outfit_rental_ibfk_1` FOREIGN KEY (`memberID`) REFERENCES `member_list` (`memberID`),
  ADD CONSTRAINT `outfit_rental_ibfk_2` FOREIGN KEY (`outfitID`) REFERENCES `outfit_list` (`outfitID`),
  ADD CONSTRAINT `outfit_rental_ibfk_3` FOREIGN KEY (`outfit_sizeID`) REFERENCES `outfit_size` (`outfit_sizeID`);

--
-- Constraints for table `outfit_size`
--
ALTER TABLE `outfit_size`
  ADD CONSTRAINT `outfit_size_ibfk_1` FOREIGN KEY (`outfitID`) REFERENCES `outfit_list` (`outfitID`);

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product_list` (`productID`),
  ADD CONSTRAINT `product_order_ibfk_3` FOREIGN KEY (`orderID`) REFERENCES `order_list` (`orderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
