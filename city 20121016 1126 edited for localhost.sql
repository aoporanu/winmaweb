-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2012 at 04:25 AM
-- Server version: 5.1.61
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `city`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`%` FUNCTION `hierarchy_connect_by_parent_eq_prior_id_with_level`(`value` INT, `maxlevel` INT) RETURNS int(11)
    READS SQL DATA
BEGIN
            DECLARE _id INT;
            DECLARE _parent INT;
            DECLARE _next INT;
            DECLARE _i INT;
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET @id = NULL;

            SET _parent = @id;
            SET _id = -1;
            SET _i = 0;

            IF @id IS NULL THEN
                    RETURN NULL;
            END IF;

            LOOP
                    SELECT  MIN(id)
                    INTO    @id
                    FROM    user
                    WHERE   parent_id = _parent
                            AND id > _id
                            AND COALESCE(@level < maxlevel, TRUE);
                    IF @id IS NOT NULL OR _parent = @start_with THEN
                            SET @level = @level + 1;
                            RETURN @id;
                    END IF;
                    SET @level := @level - 1;
                    SELECT  id, parent_id
                    INTO    _id, _parent
                    FROM    user
                    WHERE   id = _parent;
                    SET _i = _i + 1;
            END LOOP;
            RETURN NULL;
        END$$

CREATE DEFINER=`root`@`%` FUNCTION `hierarchy_sys_connect_by_path`(`delimiter` TEXT, `node` INT) RETURNS text CHARSET latin1
    READS SQL DATA
BEGIN
                 DECLARE _path TEXT;
             DECLARE _cpath TEXT;
                    DECLARE _id INT;
                DECLARE EXIT HANDLER FOR NOT FOUND RETURN _path;
                SET _id = COALESCE(node, @id);
                  SET _path = _id;
                LOOP
                            SELECT  parent_id
                          INTO    _id
                     FROM    user
                     WHERE   id = _id
                                AND COALESCE(id <> @start_with, TRUE);
                          SET _path = CONCAT(_id, delimiter, _path);
              END LOOP;
            END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `question_id` bigint(20) DEFAULT NULL,
  `answer` text,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `question_id_idx` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_sluggable_idx` (`slug`,`lft`,`rgt`,`level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `lft`, `rgt`, `level`, `slug`) VALUES
(1, 'Category', 1, 34, 0, 'category'),
(14, 'Services', 20, 33, 1, 'services'),
(15, 'WinMaWeb Exclusive Services', 29, 30, 2, 'winmaweb-exclusive-services'),
(16, 'Medical', 27, 28, 2, 'medical'),
(17, 'Travel', 25, 26, 2, 'travel'),
(18, 'Entertainment', 23, 24, 2, 'entertainment'),
(19, 'Restaurants', 21, 22, 2, 'restaurants'),
(20, 'Products', 2, 19, 1, 'products'),
(21, 'Jewelry', 9, 10, 2, 'jewelry'),
(22, 'Clothing Accessories', 7, 8, 2, 'clothing-accessories'),
(24, 'Clothing & Apparel', 5, 6, 2, 'clothing-apparel'),
(25, 'Cosmetics and Beauty Care', 3, 4, 2, 'cosmetics-and-beauty-care'),
(27, 'Health Products & Supplements', 11, 12, 2, 'health-products-supplements'),
(28, 'Home Products Interior', 13, 14, 2, 'home-products-interior'),
(29, 'Home Products Exterior', 15, 16, 2, 'home-products-exterior'),
(30, 'WinMaWeb Exclusive Products', 17, 18, 2, 'winmaweb-exclusive-products'),
(31, 'Training or Education Services', 31, 32, 2, 'training-or-education-services');

-- --------------------------------------------------------

--
-- Table structure for table `charity`
--

CREATE TABLE IF NOT EXISTS `charity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `terms` text,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `sold` bigint(20) DEFAULT '0',
  `amount` double(15,2) DEFAULT '0.00',
  `status` bigint(20) DEFAULT '0',
  `is_first` bigint(20) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_sluggable_idx` (`slug`,`user_id`),
  KEY `statusindex_idx` (`status`),
  KEY `createdindex_idx` (`created_at`,`is_first`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `charity`
--

INSERT INTO `charity` (`id`, `user_id`, `name`, `short_description`, `description`, `terms`, `starttime`, `endtime`, `sold`, `amount`, `status`, `is_first`, `created_at`, `updated_at`, `slug`) VALUES
(1, 1, 'Example', 'Example', 'Example', 'Example', '2012-08-23 00:00:00', '2012-11-30 00:00:00', 0, 0.00, 0, 1, '2012-08-24 05:00:42', '2012-08-24 05:00:42', 'example');

-- --------------------------------------------------------

--
-- Table structure for table `charity_address`
--

CREATE TABLE IF NOT EXISTS `charity_address` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `charity_id` bigint(20) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `latitude` double(18,2) DEFAULT NULL,
  `longitude` double(18,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`charity_id`),
  KEY `country_id_idx` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `charity_address`
--

INSERT INTO `charity_address` (`id`, `charity_id`, `address`, `city`, `county`, `postcode`, `country_id`, `latitude`, `longitude`) VALUES
(1, 1, 'Example', 'Example', 'Example', '123', 198, 1.32, 103.79);

-- --------------------------------------------------------

--
-- Table structure for table `charity_media`
--

CREATE TABLE IF NOT EXISTS `charity_media` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `charity_id` bigint(20) DEFAULT NULL,
  `main` tinyint(4) DEFAULT '0',
  `file_name` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'image',
  `ext` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`charity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `charity_media`
--

INSERT INTO `charity_media` (`id`, `charity_id`, `main`, `file_name`, `dir`, `type`, `ext`) VALUES
(1, 1, 1, 'charity', '/uploads/charity/images', 'image', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `vat` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `company_type` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `company_type` (`company_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `user_id`, `name`, `vat`, `phone`, `company_type`) VALUES
(1, 17, 'Deals', '123456789', '91990982', 0),
(2, 17, 'Best Deals', '123456789', '91990982', 1),
(3, 8, 'Joost', '123456789', '91990982', 0),
(4, 8, 'WinMaWeb- Global Marketing 3000 PTE. LTD.', '123456789', '91990982', 1),
(5, 91, 'Wayan Retreat Balinese Spa', '12345678', '63920035', 0),
(6, 91, 'Wayan Retreat Balinese Spa', '12345678', '63920035', 1),
(7, 22, 'Positive Focus Pte Ltd', '2000608285R', '67372977', 0),
(8, 22, 'Positive Focus Pte Ltd', '2000608285R', '67372977', 1),
(9, 102, 'Daryl Peterson International', '52838317E', '90250743', 1),
(10, 127, 'Siam Ramita Co.,Ltd', '123456789', '90061162', 0),
(11, 127, 'Siam Ramita Co.,Ltd', '123456789', '90061162', 1),
(12, 127, 'Siam Ramita Co.,Ltd', '123456789', '90061162', 0),
(13, 127, 'Siam Ramita Co.,Ltd', '123456789', '90061162', 1),
(14, 129, 'Puma sports', 'G7%', '67412100', 0),
(15, 129, 'Puma sports', 'G7%', '67412100', 1),
(16, 126, '3E Accounting Pte. Ltd.', '201120337C', '82994859', 0),
(17, 126, '3E Accounting Pte. Ltd.', '201120337C', '82994859', 1),
(18, 134, 'Patrick', '12345', '12345', 0),
(19, 135, 'Jenny Siau', 'S7670283G', '83898890', 0),
(20, 136, 'Emerson Louis haryono', 'S7807240g', '+6598555962', 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_address`
--

CREATE TABLE IF NOT EXISTS `company_address` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `latitude` double(18,2) DEFAULT NULL,
  `longitude` double(18,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id_idx` (`company_id`),
  KEY `country_id_idx` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `company_address`
--

INSERT INTO `company_address` (`id`, `company_id`, `address`, `city`, `county`, `postcode`, `country_id`, `latitude`, `longitude`) VALUES
(33, 1, '12 Stirling Rd', 'Queenstown', 'Queens', '95488', 198, NULL, NULL),
(34, 2, '12 Stirling Road', 'Queenstown', 'Queens', '148955', 198, 1.29, 103.81),
(35, 3, '12 Stirling Road', 'Queenstown', 'Queens', '148955', 198, NULL, NULL),
(36, 4, '12 Stirling Rd', 'Queens', 'Queenstown', '148955', 198, 1.29, 103.81),
(37, 5, '61 Bussorah Street ', 'singapore', 'singapore', '199477', 198, NULL, NULL),
(38, 6, '61 Bussorah Street ', 'singapore', 'singapore', '199477', 198, 0.00, 0.00),
(39, 7, '111 North Bridge Rd  Peninsula Plaza Singapore 179098', 'Singapore', 'Singapore', '570166', 198, NULL, NULL),
(40, 8, '111 North Bridge Rd  Peninsula Plaza Singapore 179098', 'singapore', 'singapore', '570166', 198, 0.00, 0.00),
(41, 9, '16 Stirling Road', 'Singapore', 'Singapore', '148957', 198, 0.00, 0.00),
(42, 10, '30 Kovan Road', 'Singapore', 'Singapore', '548096', 198, NULL, NULL),
(43, 11, '30 Kovan Road', 'Singapore', 'Singapore', '548096', 198, 1.35, 103.84),
(44, 12, '30 Kovan road', 'Singapore', 'Singapore', '548096', 198, NULL, NULL),
(45, 13, '30 Kovan Road', 'Singapore', 'Singapore', '548096', 198, 1.38, 103.89),
(46, 14, '190 McPherson road ', 'Singapore', 'Singapore', '348548', 198, NULL, NULL),
(47, 15, '190 McPherson road', 'Singapore', 'Singapore', '348548', 198, 0.00, 0.00),
(48, 16, 'BLK 463 ANG MO KIO AVE 10 #05-1130', 'SINGAPORE', 'SINGAPORE', '560463', 198, NULL, NULL),
(49, 17, 'BLK 463 ANG MO KIO AVE 10 #05-1130', 'SINGAPORE', 'SINGAPORE', '560463', 198, 0.00, 0.00),
(50, 18, '12345', '12345', '12345', '12345', 198, NULL, NULL),
(51, 19, 'Blk 739 Tampines St 72 #08-54', 'Singapore', 'Singapore', '520739', 198, NULL, NULL),
(52, 20, 'Blk 739 tampines street 72 #08-54', 'Singapore', 'Singapore', '520739', 198, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(2) DEFAULT NULL,
  `continent` varchar(2) DEFAULT NULL,
  `latitude` double(18,2) DEFAULT NULL,
  `longitude` double(18,2) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=250 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `code`, `continent`, `latitude`, `longitude`, `active`) VALUES
(1, 'Andorra', 'AD', 'EU', 42.50, 1.50, 0),
(2, 'United Arab Emirates', 'AE', 'AS', 24.00, 54.00, 0),
(3, 'Afghanistan', 'AF', 'AS', 33.00, 66.00, 0),
(4, 'Antigua and Barbuda', 'AG', 'NA', 17.05, -61.80, 0),
(5, 'Anguilla', 'AI', 'NA', 18.22, -63.05, 0),
(6, 'Albania', 'AL', 'EU', 41.00, 20.00, 0),
(7, 'Armenia', 'AM', 'AS', 40.00, 45.00, 0),
(8, 'Angola', 'AO', 'AF', -12.50, 18.50, 0),
(9, 'Antarctica', 'AQ', 'AN', -90.00, 0.00, 0),
(10, 'Argentina', 'AR', 'SA', -34.00, -64.00, 0),
(11, 'American Samoa', 'AS', 'OC', -11.06, -171.08, 0),
(12, 'Austria', 'AT', 'EU', 47.33, 13.33, 0),
(13, 'Australia', 'AU', 'OC', -25.00, 135.00, 0),
(14, 'Aruba', 'AW', 'NA', 12.50, -69.97, 0),
(15, 'Åland Islands', 'AX', 'EU', 60.25, 20.00, 0),
(16, 'Azerbaijan', 'AZ', 'AS', 40.50, 47.50, 0),
(17, 'Bosnia and Herzegovina', 'BA', 'EU', 44.25, 17.83, 0),
(18, 'Barbados', 'BB', 'NA', 13.17, -59.53, 0),
(19, 'Bangladesh', 'BD', 'AS', 24.00, 90.00, 0),
(20, 'Belgium', 'BE', 'EU', 50.83, 4.00, 0),
(21, 'Burkina Faso', 'BF', 'AF', 13.00, -2.00, 0),
(22, 'Bulgaria', 'BG', 'EU', 43.00, 25.00, 0),
(23, 'Bahrain', 'BH', 'AS', 26.00, 50.50, 0),
(24, 'Burundi', 'BI', 'AF', -3.50, 30.00, 0),
(25, 'Benin', 'BJ', 'AF', 9.50, 2.25, 0),
(26, 'Saint Barthélemy', 'BL', 'NA', 17.90, -62.83, 0),
(27, 'Bermuda', 'BM', 'NA', 32.33, -64.75, 0),
(28, 'Brunei', 'BN', 'AS', 4.50, 114.67, 0),
(29, 'Bolivia', 'BO', 'SA', -17.00, -65.00, 0),
(30, 'Bonaire, Saint Eustatius and Saba', 'BQ', 'NA', 12.21, -68.29, 0),
(31, 'Brazil', 'BR', 'SA', -10.00, -55.00, 0),
(32, 'Bahamas', 'BS', 'NA', 24.00, -76.00, 0),
(33, 'Bhutan', 'BT', 'AS', 27.50, 90.50, 0),
(34, 'Bouvet Island', 'BV', 'AN', -54.43, 3.40, 0),
(35, 'Botswana', 'BW', 'AF', -22.00, 24.00, 0),
(36, 'Belarus', 'BY', 'EU', 53.00, 28.00, 0),
(37, 'Belize', 'BZ', 'NA', 17.25, -88.75, 0),
(38, 'Canada', 'CA', 'NA', 60.00, -96.00, 0),
(39, 'Cocos [Keeling] Islands', 'CC', 'AS', -12.16, 96.87, 0),
(40, 'Congo [DRC]', '', 'AF', 0.00, 0.00, 0),
(41, 'Central African Republic', 'CF', 'AF', 7.00, 21.00, 0),
(42, 'Congo [Republic]', 'CG', 'AF', -1.00, 15.00, 0),
(43, 'Switzerland', 'CH', 'EU', 47.00, 8.01, 0),
(44, 'Ivory Coast', 'CI', 'AF', 8.00, -5.00, 0),
(45, 'Cook Islands', 'CK', 'OC', -21.25, -159.79, 0),
(46, 'Chile', 'CL', 'SA', -30.00, -71.00, 0),
(47, 'Cameroon', 'CM', 'AF', 6.00, 12.00, 0),
(48, 'China', 'CN', 'AS', 35.00, 105.00, 0),
(49, 'Colombia', 'CO', 'SA', 4.00, -72.00, 0),
(50, 'Costa Rica', 'CR', 'NA', 10.00, -84.00, 0),
(51, 'Cuba', 'CU', 'NA', 22.00, -79.50, 0),
(52, 'Cape Verde', 'CV', 'AF', 16.00, -24.00, 0),
(53, 'Curacao', 'CW', 'NA', 12.17, -69.00, 0),
(54, 'Christmas Island', 'CX', 'AS', -10.50, 105.67, 0),
(55, 'Cyprus', 'CY', 'EU', 35.00, 33.00, 0),
(56, 'Czech Republic', 'CZ', 'EU', 49.75, 15.00, 0),
(57, 'Germany', 'DE', 'EU', 51.50, 10.50, 0),
(58, 'Djibouti', 'DJ', 'AF', 11.59, 43.14, 0),
(59, 'Denmark', 'DK', 'EU', 56.00, 10.00, 0),
(60, 'Dominica', 'DM', 'NA', 15.50, -61.33, 0),
(61, 'Dominican Republic', 'DO', 'NA', 19.00, -70.67, 0),
(62, 'Algeria', 'DZ', 'AF', 28.00, 3.00, 0),
(63, 'Ecuador', 'EC', 'SA', -2.00, -77.50, 0),
(64, 'Estonia', 'EE', 'EU', 59.00, 26.00, 0),
(65, 'Egypt', 'EG', 'AF', 27.00, 30.00, 0),
(66, 'Western Sahara', 'EH', 'AF', 24.49, -12.66, 0),
(67, 'Eritrea', 'ER', 'AF', 15.00, 39.00, 0),
(68, 'Spain', 'ES', 'EU', 40.00, -4.00, 0),
(69, 'Ethiopia', 'ET', 'AF', 8.00, 38.00, 0),
(70, 'Finland', 'FI', 'EU', 64.00, 26.00, 0),
(71, 'Fiji', 'FJ', 'OC', -18.00, 178.00, 0),
(72, 'Falkland Islands', 'FK', 'SA', -51.75, -59.17, 0),
(73, 'Micronesia', 'FM', 'OC', 6.92, 158.16, 0),
(74, 'Faroe Islands', 'FO', 'EU', 62.00, -7.00, 0),
(75, 'France', 'FR', 'EU', 46.00, 2.00, 0),
(76, 'Gabon', 'GA', 'AF', -1.00, 11.75, 0),
(77, 'United Kingdom', 'GB', 'EU', 54.00, -4.00, 0),
(78, 'Grenada', 'GD', 'NA', 12.12, -61.67, 0),
(79, 'Georgia', 'GE', 'AS', 42.00, 43.50, 0),
(80, 'French Guiana', 'GF', 'SA', 4.00, -53.00, 0),
(81, 'Guernsey', 'GG', 'EU', 49.58, -2.33, 0),
(82, 'Ghana', 'GH', 'AF', 8.00, -2.00, 0),
(83, 'Gibraltar', 'GI', 'EU', 36.14, -5.35, 0),
(84, 'Greenland', 'GL', 'NA', 72.00, -40.00, 0),
(85, 'Gambia', 'GM', 'AF', 13.50, -15.50, 0),
(86, 'Guinea', 'GN', 'AF', 11.00, -10.00, 0),
(87, 'Guadeloupe', 'GP', 'NA', 16.25, -61.58, 0),
(88, 'Equatorial Guinea', 'GQ', 'AF', 2.00, 10.00, 0),
(89, 'Greece', 'GR', 'EU', 39.00, 22.00, 0),
(90, 'South Georgia and the South Sandwich Islands', 'GS', 'AN', -56.00, -33.00, 0),
(91, 'Guatemala', 'GT', 'NA', 15.50, -90.25, 0),
(92, 'Guam', 'GU', 'OC', 13.48, 144.73, 0),
(93, 'Guinea-Bissau', 'GW', 'AF', 12.00, -15.00, 0),
(94, 'Guyana', 'GY', 'SA', 5.00, -59.00, 0),
(95, 'Hong Kong', 'HK', 'AS', 22.29, 114.16, 0),
(96, 'Heard Island and McDonald Islands', 'HM', 'AN', -53.12, 73.51, 0),
(97, 'Honduras', 'HN', 'NA', 15.00, -86.50, 0),
(98, 'Croatia', 'HR', 'EU', 45.17, 15.50, 0),
(99, 'Haiti', 'HT', 'NA', 19.00, -72.42, 0),
(100, 'Hungary', 'HU', 'EU', 47.00, 20.00, 0),
(101, 'Indonesia', 'ID', 'AS', -5.00, 120.00, 0),
(102, 'Ireland', 'IE', 'EU', 53.00, -8.00, 0),
(103, 'Israel', 'IL', 'AS', 31.50, 34.75, 0),
(104, 'Isle of Man', 'IM', 'EU', 54.25, -4.50, 0),
(105, 'India', 'IN', 'AS', 20.00, 77.00, 0),
(106, 'British Indian Ocean Territory', '', 'AS', 0.00, 0.00, 0),
(107, 'Iraq', 'IQ', 'AS', 33.00, 44.00, 0),
(108, 'Iran', 'IR', 'AS', 32.00, 53.00, 0),
(109, 'Iceland', 'IS', 'EU', 65.00, -18.00, 0),
(110, 'Italy', 'IT', 'EU', 42.83, 12.83, 0),
(111, 'Jersey', 'JE', 'EU', 49.22, -2.12, 0),
(112, 'Jamaica', 'JM', 'NA', 18.25, -77.50, 0),
(113, 'Jordan', 'JO', 'AS', 31.00, 36.00, 0),
(114, 'Japan', 'JP', 'AS', 35.69, 139.75, 0),
(115, 'Kenya', 'KE', 'AF', 1.00, 38.00, 0),
(116, 'Kyrgyzstan', 'KG', 'AS', 41.00, 75.00, 0),
(117, 'Cambodia', 'KH', 'AS', 13.00, 105.00, 0),
(118, 'Kiribati', 'KI', 'OC', 1.42, 172.98, 0),
(119, 'Comoros', 'KM', 'AF', -12.17, 44.25, 0),
(120, 'Saint Kitts and Nevis', 'KN', 'NA', 17.33, -62.75, 0),
(121, 'North Korea', 'KP', 'AS', 40.00, 127.00, 0),
(122, 'South Korea', 'KR', 'AS', 37.00, 127.50, 0),
(123, 'Kuwait', 'KW', 'AS', 29.50, 47.75, 0),
(124, 'Cayman Islands', 'KY', 'NA', 19.50, -80.67, 0),
(125, 'Kazakhstan', 'KZ', 'AS', 48.00, 68.00, 0),
(126, 'Laos', 'LA', 'AS', 18.00, 105.00, 0),
(127, 'Lebanon', 'LB', 'AS', 33.83, 35.83, 0),
(128, 'Saint Lucia', 'LC', 'NA', 13.88, -60.97, 0),
(129, 'Liechtenstein', 'LI', 'EU', 47.17, 9.53, 0),
(130, 'Sri Lanka', 'LK', 'AS', 7.00, 81.00, 0),
(131, 'Liberia', 'LR', 'AF', 6.50, -9.50, 0),
(132, 'Lesotho', 'LS', 'AF', -29.50, 28.25, 0),
(133, 'Lithuania', 'LT', 'EU', 56.00, 24.00, 0),
(134, 'Luxembourg', 'LU', 'EU', 49.75, 6.17, 0),
(135, 'Latvia', 'LV', 'EU', 57.00, 25.00, 0),
(136, 'Libya', 'LY', 'AF', 25.00, 17.00, 0),
(137, 'Morocco', 'MA', 'AF', 32.00, -5.00, 0),
(138, 'Monaco', 'MC', 'EU', 43.73, 7.42, 0),
(139, 'Moldova', 'MD', 'EU', 47.00, 29.00, 0),
(140, 'Montenegro', 'ME', 'EU', 42.50, 19.30, 0),
(141, 'Saint Martin', 'MF', 'NA', 18.07, -63.07, 0),
(142, 'Madagascar', 'MG', 'AF', -20.00, 47.00, 0),
(143, 'Marshall Islands', 'MH', 'OC', 7.11, 171.25, 0),
(144, 'Macedonia', 'MK', 'EU', 41.83, 22.00, 0),
(145, 'Mali', 'ML', 'AF', 17.00, -4.00, 0),
(146, 'Myanmar [Burma]', 'MM', 'AS', 22.00, 98.00, 0),
(147, 'Mongolia', 'MN', 'AS', 46.00, 105.00, 0),
(148, 'Macau', 'MO', 'AS', 22.20, 113.55, 0),
(149, 'Northern Mariana Islands', 'MP', 'OC', 15.21, 145.76, 0),
(150, 'Martinique', 'MQ', 'NA', 14.67, -61.00, 0),
(151, 'Mauritania', 'MR', 'AF', 20.00, -12.00, 0),
(152, 'Montserrat', 'MS', 'NA', 16.75, -62.20, 0),
(153, 'Malta', 'MT', 'EU', 35.92, 14.43, 0),
(154, 'Mauritius', 'MU', 'AF', -20.30, 57.58, 0),
(155, 'Maldives', 'MV', 'AS', 3.20, 73.00, 0),
(156, 'Malawi', 'MW', 'AF', -13.50, 34.00, 0),
(157, 'Mexico', 'MX', 'NA', 19.43, -99.13, 0),
(158, 'Malaysia', 'MY', 'AS', 2.50, 112.50, 0),
(159, 'Mozambique', 'MZ', 'AF', -18.25, 35.00, 0),
(160, 'Namibia', 'NA', 'AF', -22.00, 17.00, 0),
(161, 'New Caledonia', 'NC', 'OC', -21.50, 165.50, 0),
(162, 'Niger', 'NE', 'AF', 16.00, 8.00, 0),
(163, 'Norfolk Island', 'NF', 'OC', -29.03, 167.95, 0),
(164, 'Nigeria', 'NG', 'AF', 10.00, 8.00, 0),
(165, 'Nicaragua', 'NI', 'NA', 13.00, -85.00, 0),
(166, 'Netherlands', 'NL', 'EU', 52.50, 5.75, 0),
(167, 'Norway', 'NO', 'EU', 62.00, 10.00, 0),
(168, 'Nepal', 'NP', 'AS', 28.00, 84.00, 0),
(169, 'Nauru', 'NR', 'OC', -0.52, 166.93, 0),
(170, 'Niue', 'NU', 'OC', -19.03, -169.87, 0),
(171, 'New Zealand', 'NZ', 'OC', -42.00, 174.00, 0),
(172, 'Oman', 'OM', 'AS', 21.00, 57.00, 0),
(173, 'Panama', 'PA', 'NA', 9.00, -80.00, 0),
(174, 'Peru', 'PE', 'SA', -10.00, -76.00, 0),
(175, 'French Polynesia', 'PF', 'OC', -15.00, -140.00, 0),
(176, 'Papua New Guinea', 'PG', 'OC', -6.00, 147.00, 0),
(177, 'Philippines', 'PH', 'AS', 13.00, 122.00, 0),
(178, 'Pakistan', 'PK', 'AS', 30.00, 70.00, 0),
(179, 'Poland', 'PL', 'EU', 52.00, 20.00, 0),
(180, 'Saint Pierre and Miquelon', 'PM', 'NA', 46.83, -56.33, 0),
(181, 'Pitcairn Islands', 'PN', 'OC', -25.07, -130.10, 0),
(182, 'Puerto Rico', 'PR', 'NA', 18.25, -66.50, 0),
(183, 'Palestinian Territories', '', 'AS', 0.00, 0.00, 0),
(184, 'Portugal', 'PT', 'EU', 39.50, -8.00, 0),
(185, 'Palau', 'PW', 'OC', 7.50, 134.62, 0),
(186, 'Paraguay', 'PY', 'SA', -22.99, -58.00, 0),
(187, 'Qatar', 'QA', 'AS', 25.50, 51.25, 0),
(188, 'Réunion', 'RE', 'AF', -21.10, 55.60, 0),
(189, 'Romania', 'RO', 'EU', 46.00, 25.00, 0),
(190, 'Serbia', 'RS', 'EU', 44.82, 20.46, 0),
(191, 'Russia', 'RU', 'EU', 60.00, 100.00, 0),
(192, 'Rwanda', 'RW', 'AF', -2.00, 30.00, 0),
(193, 'Saudi Arabia', 'SA', 'AS', 25.00, 45.00, 0),
(194, 'Solomon Islands', 'SB', 'OC', -8.00, 159.00, 0),
(195, 'Seychelles', 'SC', 'AF', -4.58, 55.67, 0),
(196, 'Sudan', 'SD', 'AF', 15.00, 30.00, 0),
(197, 'Sweden', 'SE', 'EU', 62.00, 15.00, 0),
(198, 'Singapore', 'SG', 'AS', 1.29, 103.85, 1),
(199, 'Saint Helena', 'SH', 'AF', -15.95, -5.70, 0),
(200, 'Slovenia', 'SI', 'EU', 46.25, 15.17, 0),
(201, 'Svalbard and Jan Mayen', 'SJ', 'EU', 78.00, 20.00, 0),
(202, 'Slovakia', 'SK', 'EU', 48.67, 19.50, 0),
(203, 'Sierra Leone', 'SL', 'AF', 8.50, -11.50, 0),
(204, 'San Marino', 'SM', 'EU', 43.93, 12.42, 0),
(205, 'Senegal', 'SN', 'AF', 14.00, -14.00, 0),
(206, 'Somalia', 'SO', 'AF', 6.00, 48.00, 0),
(207, 'Suriname', 'SR', 'SA', 4.00, -56.00, 0),
(208, 'São Tomé and Príncipe', 'ST', 'AF', 1.00, 7.00, 0),
(209, 'El Salvador', 'SV', 'NA', 13.83, -88.92, 0),
(210, 'Sint Maarten', 'SX', 'NA', 18.04, -63.07, 0),
(211, 'Syria', 'SY', 'AS', 35.00, 38.00, 0),
(212, 'Swaziland', 'SZ', 'AF', -26.50, 31.50, 0),
(213, 'Turks and Caicos Islands', 'TC', 'NA', 21.73, -71.58, 0),
(214, 'Chad', 'TD', 'AF', 15.00, 19.00, 0),
(215, 'French Southern Territories', 'TF', 'AN', -43.00, 67.00, 0),
(216, 'Togo', 'TG', 'AF', 8.00, 1.17, 0),
(217, 'Thailand', 'TH', 'AS', 15.00, 100.00, 0),
(218, 'Tajikistan', 'TJ', 'AS', 39.00, 71.00, 0),
(219, 'Tokelau', 'TK', 'OC', -9.17, -171.83, 0),
(220, 'East Timor', 'TL', 'OC', -8.83, 125.75, 0),
(221, 'Turkmenistan', 'TM', 'AS', 40.00, 60.00, 0),
(222, 'Tunisia', 'TN', 'AF', 34.00, 9.00, 0),
(223, 'Tonga', 'TO', 'OC', -20.00, -175.00, 0),
(224, 'Turkey', 'TR', 'AS', 39.06, 34.91, 0),
(225, 'Trinidad and Tobago', 'TT', 'NA', 11.00, -61.00, 0),
(226, 'Tuvalu', 'TV', 'OC', -8.52, 179.14, 0),
(227, 'Taiwan', 'TW', 'AS', 24.00, 121.00, 0),
(228, 'Tanzania', 'TZ', 'AF', -6.00, 35.00, 0),
(229, 'Ukraine', 'UA', 'EU', 49.00, 32.00, 0),
(230, 'Uganda', 'UG', 'AF', 2.00, 33.00, 0),
(231, 'U.S. Minor Outlying Islands', '', 'OC', 0.00, 0.00, 0),
(232, 'United States', 'US', 'NA', 39.76, -98.50, 0),
(233, 'Uruguay', 'UY', 'SA', -33.00, -56.00, 0),
(234, 'Uzbekistan', 'UZ', 'AS', 41.71, 63.85, 0),
(235, 'Vatican City', 'VA', 'EU', 41.90, 12.45, 0),
(236, 'Saint Vincent and the Grenadines', 'VC', 'NA', 13.08, -61.20, 0),
(237, 'Venezuela', 'VE', 'SA', 8.00, -66.00, 0),
(238, 'British Virgin Islands', 'VG', 'NA', 18.50, -64.50, 0),
(239, 'U.S. Virgin Islands', 'VI', 'NA', 18.35, -64.98, 0),
(240, 'Vietnam', 'VN', 'AS', 16.17, 107.83, 0),
(241, 'Vanuatu', 'VU', 'OC', -16.00, 167.00, 0),
(242, 'Wallis and Futuna', 'WF', 'OC', -13.30, -176.20, 0),
(243, 'Samoa', 'WS', 'OC', -13.80, -172.18, 0),
(244, 'Kosovo', 'XK', 'EU', 42.58, 21.00, 0),
(245, 'Yemen', 'YE', 'AS', 15.50, 47.50, 0),
(246, 'Mayotte', 'YT', 'AF', -12.83, 45.17, 0),
(247, 'South Africa', 'ZA', 'AF', -30.00, 26.00, 0),
(248, 'Zambia', 'ZM', 'AF', -15.00, 30.00, 0),
(249, 'Zimbabwe', 'ZW', 'AF', -19.00, 29.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint(20) DEFAULT NULL,
  `owner_id` bigint(20) DEFAULT NULL,
  `verifier_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `msg` text,
  `quantity` bigint(20) DEFAULT NULL,
  `price` double(18,2) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `code2` varchar(255) DEFAULT NULL,
  `expire_at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `friend` tinyint(4) DEFAULT '0',
  `friend_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codeindex_idx` (`code`),
  KEY `statusindex_idx` (`status`),
  KEY `friendindex_idx` (`friend`),
  KEY `owner_id_idx` (`owner_id`),
  KEY `verifier_id_idx` (`verifier_id`),
  KEY `transaction_id_idx` (`transaction_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=190 ;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `transaction_id`, `owner_id`, `verifier_id`, `name`, `email`, `msg`, `quantity`, `price`, `code`, `code2`, `expire_at`, `status`, `friend`, `friend_id`, `created_at`, `updated_at`) VALUES
(151, 16, 8, NULL, 'Size M Black Cotton WinMaWeb T-Shirt', NULL, NULL, 1, 15.00, '729VY4NRYYPM', 'EHY9Y365C2BB5BV4P', '2012-09-30 00:00:00', 0, 0, NULL, '2012-07-11 03:59:38', '2012-07-11 03:59:38'),
(152, 22, 8, NULL, 'Exclusive WinMaWeb Key Chain', NULL, NULL, 1, 7.00, '8W73SN5CPGLV', 'EHYA2NLQ5FYBZG9E9', '2012-09-30 00:00:00', 0, 0, NULL, '2012-07-11 04:04:05', '2012-07-11 04:04:05'),
(153, 32, 8, NULL, 'Delux Nail Set', NULL, NULL, 1, 14.00, 'C2Z6Q83QWX8Q', 'EJ3R7SEYHNLMZHFKD', '2012-10-27 00:00:00', 2, 0, NULL, '2012-07-15 09:14:54', '2012-07-15 09:14:54'),
(154, 38, 8, NULL, 'Delux Nail Set', NULL, NULL, 1, 14.00, 'DWWR6VJPDE9C', 'EJ3R8MA7MTULWJUV9', '2012-10-27 00:00:00', 2, 0, NULL, '2012-07-15 09:16:20', '2012-07-15 09:16:20'),
(155, 44, 8, NULL, 'Black Embroidered WinMaWeb Ball Cap', NULL, NULL, 1, 15.00, 'FSPZEU684M4M', 'EJ3RPGAPZ9XTEH7N7', '2012-09-30 00:00:00', 0, 0, NULL, '2012-07-15 09:41:40', '2012-07-15 09:41:40'),
(156, 52, 8, NULL, 'Well-shaped eyebrows', NULL, NULL, 1, 10.00, 'JAAQW38BU3KF', 'EJ5GSQNR53EZVSYSF', '2012-07-31 00:00:00', 2, 0, NULL, '2012-07-17 11:50:58', '2012-07-17 11:50:58'),
(157, 58, 9, NULL, 'Delux Nail Set', NULL, NULL, 1, 14.00, 'L6EUGZRBJHU8', 'EJ5X6FLH69JYX54DS', '2012-10-27 00:00:00', 2, 0, NULL, '2012-07-18 00:55:33', '2012-07-18 00:55:33'),
(158, 76, 22, NULL, 'Well-Shaped Eebrows', NULL, NULL, 1, 10.00, 'RSB6LAHRLPWV', 'EJ6QPFYD2Y7A6M5X7', '2012-07-31 00:00:00', 2, 0, NULL, '2012-07-19 00:09:55', '2012-07-19 00:09:55'),
(159, 82, 17, 17, 'Size L Black Cotton WinMaWeb T-Shirt', NULL, NULL, 1, 15.00, 'TNPFU8CBM5CR', 'EJ6VE4WTPHU64MZQK', '2012-09-30 00:00:00', 1, 0, NULL, '2012-07-19 04:27:02', '2012-08-02 06:14:45'),
(160, 88, 8, NULL, 'Balinese Urut 60 Min.', NULL, NULL, 1, 35.40, 'VJEEVT99RA8X', 'EJ75H44E76XTUJCLT', '2012-08-31 00:00:00', 2, 0, NULL, '2012-07-19 11:49:01', '2012-07-19 11:49:01'),
(161, 98, 10, NULL, 'Size L Black Cotton WinMaWeb T-Shirt', NULL, NULL, 1, 15.00, 'YNYYJA73TZR3', 'EJ7MTAEC8BGZDUDFF', '2012-09-30 00:00:00', 2, 0, NULL, '2012-07-20 02:40:14', '2012-07-20 02:40:14'),
(162, 106, 10, NULL, 'Size L Black Cotton WinMaWeb T-Shirt', NULL, NULL, 1, 15.00, '336JL2ZV863FJ', 'EJ7MUHGNVAKJ3F5GS', '2012-09-30 00:00:00', 0, 0, NULL, '2012-07-20 02:42:19', '2012-07-20 02:42:19'),
(163, 114, 22, NULL, '3 For 1!', NULL, NULL, 1, 29.70, '35NDKF7SR7VU5', 'EJ7NRV69JKDH8DQ52', '2012-08-31 00:00:00', 0, 0, NULL, '2012-07-20 03:32:26', '2012-07-20 03:32:26'),
(164, 121, 17, NULL, 'Size S Black Cotton WinMaWeb T-Shirt', NULL, NULL, 1, 15.00, '37UWYP5VVNYX6', 'EJKLD5S2QLUDTBRHZ', '2012-09-30 00:00:00', 0, 1, 18, '2012-08-03 14:53:00', '2012-08-03 14:53:00'),
(165, 131, 133, NULL, 'Size L Black Cotton WinMaWeb T-Shirt', NULL, NULL, 1, 15.00, '3AYTGDP7W65K7', 'EJL7PQGXYM7YKPDQ9', '2012-09-30 00:00:00', 0, 0, NULL, '2012-08-04 08:28:43', '2012-08-04 08:28:43'),
(167, 143, 144, NULL, 'ONE FOR THREE', NULL, NULL, 1, 29.70, '3EQY55FRDRNLH', 'EJVVY2QNAHRFUAZLM', '2012-09-20 00:00:00', 2, 0, NULL, '2012-08-16 02:53:03', '2012-08-16 02:53:03'),
(169, 161, 17, NULL, 'Black Embroidered WinMaWeb Ball Cap', NULL, NULL, 1, 15.00, '3LCL8ER2CT8WD', 'EJZCQSLREDTPC2U5N', '2012-09-30 00:00:00', 0, 0, NULL, '2012-08-20 07:42:45', '2012-08-20 07:42:45'),
(180, 227, 17, NULL, 'Exclusive WinMaWeb Key Chain', NULL, NULL, 1, 7.00, '48YQSX7G88WXM', 'EJZD8ELACL7PKB2EV', '2012-09-30 00:00:00', 0, 1, 10, '2012-08-20 08:09:25', '2012-08-20 08:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_request`
--

CREATE TABLE IF NOT EXISTS `deposit_request` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `amount` double(18,2) DEFAULT NULL,
  `reason` text,
  `account_number` text,
  `beneficiary_name` text,
  `bank_code` text,
  `bank_branch_code` text,
  `bank_account_number` text,
  `bank_name` text,
  `bank_address` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statusindex_idx` (`type`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `deposit_request`
--

INSERT INTO `deposit_request` (`id`, `user_id`, `type`, `status`, `amount`, `reason`, `account_number`, `beneficiary_name`, `bank_code`, `bank_branch_code`, `bank_account_number`, `bank_name`, `bank_address`, `created_at`, `updated_at`) VALUES
(1, 73, 2, 2, 1500.00, NULL, NULL, '56465456', '5465465456', '654654654', '654654654', 'OCBC', 'ikhkjhkjhkj', '2012-07-09 04:43:33', '2012-07-09 04:45:20'),
(2, 73, 2, 1, NULL, NULL, NULL, 'dfgdgdfg', 'dfgdfgdfg', 'dfgdfgdf', 'gdfgdfgdfgdf', 'OCBC', 'dfgdgdgdfgdfgdf', '2012-07-09 05:05:24', '2012-07-09 05:59:01'),
(3, 66, 2, 2, 1500.00, NULL, NULL, 'sdaasdasd', 'asdasd', 'asdas', 'dasdasd', 'OCBC', 'asdasdasda', '2012-07-09 08:25:17', '2012-07-09 08:25:39'),
(4, 9, 2, 2, 14.00, NULL, NULL, 'gfdgdfg', 'dfgdfgdf', 'gdfgdfg', 'dgdfgdfgdfg', 'OCBC', 'dgdgdfgdfgd', '2012-08-28 09:20:50', '2012-08-28 09:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `help_pages`
--

CREATE TABLE IF NOT EXISTS `help_pages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=15 ;

--
-- Dumping data for table `help_pages`
--

INSERT INTO `help_pages` (`id`, `name`, `content`) VALUES
(1, 'My Offers', '[b]My Offers[/b]\nThe My Offers page allows Agents and Merchants both to download Merchant contracts and to manage their deal offers. (Note: This menu item is only visible once your account has been upgraded to an Agent or Merchant account.)\n\nAdd Offer\nThe Add Off feature allows you to add a deal offer to WMW.\nThrough that function you may enter the Merchant information (Deal Location if other than the Merchant''s Head Office, Merchant''s Contact Phone Number, upload the contract back to WinMaWeb, and to describe the deal itself (including number of stock available and the picture.)\n\nDownload Contract\nThe Download Contract feature allows you to download a Merchant Contract as a .pdf file. You, as an Agent, should save this file to your notebook computer/ flash drive and then take it with you to the Merchant and fill it out together. Once it has been completed then you print it out in triplicate, sign all three copies, then send them in to the WMW offices. You should also upload the completed Merchant contract .pdf file under &ldquo;Add Offers&rdquo;\n\nAdd Merchant\nThe Add Merchant feature allows you to be the Agent for another Merchant. Agents contact Merchants and propose to have that Merchant sell their Products or Services as a Deal Offer on WinMaWeb. The Agent who puts a Merchant''s Deal Offer on WinMaWeb receives 20% of the WinMaWeb share as a commission.\n\nYou may also view any of your current or previous Deal Offers on WinMaWeb from this page. Each Deal Offer you posted to WinMaWeb will be visible here, along with how many of each have been sold on WinMaWeb, the Status of the Deal (Accepted, Pending, or Rejected), and the Merchant Factor (which is the percent of the sale price that the Merchant receives as a Merchant Share.) In addition, there are three buttons to the right of each deal that allow you to add more pictures of the deal or to change the picture displayed (Gallery button), the (Prices button) button allows you to see the regular price of the deal, the discount percentage, the discounted price, how much money the buyer saves, how many deals are sold, as well as how many deals are in stock on WinMaWeb.'),
(2, 'Transactions', '[b]Transactions[/b]\n\n[b][u]Sent Transactions[/u][/b]\n\nUnder Sent Transactions you can view all the deals you have purchased on WinMaWeb. Some Deal Offers may not yet be activated (&ldquo;Not Yet Activated&rdquo; means that a Merchant set a minimum number of deals that need to be sold, and that minimum number has not yet been sold on WinMaWeb.) The Deal Offers will be organized from the most recently purchased at the top to the oldest purchases towards the bottom. Merchants may also view their Verification and Test Transaction Fee here, which is a small one-time transfer used to verify the merchant.\n\n[b][u]Received Transactions[/u][/b]\n\nUnder Received Transactions you can view all the Agent Commissions you have received from Merchants and their Deal Offers which you have brought to WinMaWeb. Agent Commissions will be paid out after the Voucher has been Cashed In by the Merchant. (eg The member will bring in the voucher, redeem the voucher at the Merchant, and then the Merchant will Cash In the Voucher to receive his share. At that point WinMaWeb will pay out the 5th Tier Network Commission and the Agent Commission as well.\n\n[b][u]Network Transactions[/u][/b]\n\nUnder Network Transactions you can view all of the Network Commissions you have received from the 5th Tier of Your Network. Network Commissions will be paid out after the Voucher has been Cashed In by the Merchant. (eg The member will bring in the voucher, redeem the voucher at the Merchant, and then the Merchant will Cash In the Voucher to receive his share. At that point WinMaWeb will pay out the 5th Tier Network Commission.)\n\n[b][u]My Wallet[/u][/b]\n\nThe credits in your My Wallet can be used for a few things.\n\nFirst, they can always be directly cashed out, or redeemed as cash, to your bank account. (From the Withdrawal Request menu item)\n\nSecond, they can be used to buy Deals or make a Donation to a charity on WinMaWeb. If you have credit in your WinMaWeb Account then using your My Wallet will also allow you to move the credit from from your WMW Account to your My Wallet. The ratio is 20% to 80% or 1:4, so if you spend 1 dollar from your My Wallet, then 4 dollars will be allowed to move from your WMW Account to your My Wallet. For example: if you have 1,000 Dollars in your WMW Account, and you spend 100 Dollars from your My Wallet, then 400 Dollars could be moved from your WMW Account to your My Wallet- leaving you with a new WMW Account balance of 600 Dollars, and 400 dollars more in your My Wallet than you had before.\n\n[b][u]My Vouchers[/u][/b]\n\nUnder My Vouchers you may view all of the Vouchers you have purchased on WinMaWeb. Voucher information is also given to easily show when each voucher expires, when it was purchased, how many vouchers were purchased and the cost. The Voucher can be downloaded as a .pdf file and then printed out under the Voucher [Green Button] feature. The Transaction [Green Button] feature allows you to view the Transaction Details on a separate page. Once a Voucher has been Cashed in by the Merchant it will no longer be visible on this page (Voucher''s are cashed in by the Merchant after you redeem them at the Merchant''s location for the deal offer you have purchased.)\n\n[b][u]Sold Vouchers[/u][/b]\n\nOnly Merchants may view the Sold Vouchers page. This is where Merchants may view how many of their deals have been sold on WinMaWeb.\n\n[b][u]Cash In Vouchers[/u][/b]\n\nOnly Merchants may view the Cash In Vouchers page, where Merchants fill in the Voucher Number from each Voucher that is redeemed at their Deal Location, thereby cashing the vouchers in for their Merchant Share. Each &ldquo;Cashed In Voucher&rdquo; may only be cashed in once, and after a short processing period of about one week, the money will be directly deposited to the Merchant''s My Wallet. Once the Merchant cashes in a voucher it also initiates the Agent and Network Commissions.'),
(3, 'Withdraw Request', '[b]Withdrawal Request[/b]\n\nallows you to transfer money from your My Wallet to your own bank account or to your PayPal account..\nInitially, WinMaWeb is set up for PayPal transfers only, so you will need to make a PayPal account in order to withdraw your money from WinMaWeb.\nLater, WinMaWeb will set up GIRO transfers between the main Singapore banks (CitiBank, OCBC, DSB, HSBC, Standard Chartered) for easy transfer requests from WinMaWeb''s corporate account directly to your bank account in Singapore.'),
(4, 'Deposit', '[b]Deposit[/b]\nallows you to transfer money from outside of WinMaWeb to your My Wallet in order to purchase a deal.\n\nNote: If you purchase something with your credit card it counts as having used the money from your My Wallet, which will then allow you to transfer up to four times that purchase amount from your WMW Account to your My Wallet.'),
(5, 'My Network', '[b]My Network[/b]\nallows you to view and manage your network of friends and colleagues.'),
(6, 'Build My Network', '[b]Build My Network[/b]\nallows you to start developing your social network of friends and colleagues.'),
(7, 'Edit Account', '[b]Edit Account[/b]\nallows you to view and edit your account detail such as your first name, last name, address, gender, photo as well as to change your password.'),
(9, 'Request Merchant Account', '[b]Request Merchant Account[/b]\nallows you to take the steps necessary in an easy to follow procedure to become a Merchant for WinMaWeb.\n\nPlease view this short tutorial video on how to become a Merchant for WinMaWeb. [link here]'),
(10, 'Request Agent Account', '[b]Request Agent Account[/b]\nallows you to take the steps necessary in an easy to follow procedure to become an Agent for WinMaWeb so you can bring in your own deals.\n\nPlease view this short tutorial video on how to become an Agent for WinMaWeb. [link here]'),
(11, 'Today''s Deal', 'Today''s Deal'),
(12, 'All Deals', 'All Deals'),
(13, 'Recent Deals', 'Recent Deals'),
(14, 'Charities', 'Charities');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `commission` varchar(255) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `commission`, `lft`, `rgt`, `level`) VALUES
(1, 'root', 1, 18, 0),
(2, '20', 10, 11, 1),
(3, '0', 8, 9, 1),
(4, '0', 6, 7, 1),
(5, '0', 4, 5, 1),
(6, '0', 2, 3, 1),
(7, '1', 12, 13, 1),
(8, '1', 14, 15, 1),
(9, '1', 16, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `merchant_to_agent`
--

CREATE TABLE IF NOT EXISTS `merchant_to_agent` (
  `merchant_user_id` int(11) NOT NULL,
  `agent_user_id` int(11) NOT NULL,
  PRIMARY KEY (`merchant_user_id`,`agent_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchant_to_agent`
--

INSERT INTO `merchant_to_agent` (`merchant_user_id`, `agent_user_id`) VALUES
(8, 17),
(17, 17),
(17, 134),
(17, 135);

-- --------------------------------------------------------

--
-- Table structure for table `page_tags`
--

CREATE TABLE IF NOT EXISTS `page_tags` (
  `tree_id` bigint(20) NOT NULL DEFAULT '0',
  `tag_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tree_id`,`tag_id`),
  KEY `page_tags_tag_id_tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_tags`
--

INSERT INTO `page_tags` (`tree_id`, `tag_id`) VALUES
(6, 80),
(5, 122),
(8, 476),
(7, 478),
(9, 480);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `company_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `wmw_section` varchar(255) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `terms` text,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `sold` bigint(20) DEFAULT '0',
  `min_sold` bigint(20) DEFAULT '1',
  `max_buy` bigint(20) DEFAULT '1',
  `factor` bigint(20) DEFAULT '0',
  `status` bigint(20) DEFAULT '0',
  `is_active` bigint(20) DEFAULT '0',
  `is_first` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `merchant_user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_sluggable_idx` (`slug`,`user_id`),
  KEY `statusindex_idx` (`status`),
  KEY `createdindex_idx` (`created_at`,`is_active`),
  KEY `user_id_idx` (`user_id`),
  KEY `company_id_idx` (`company_id`),
  KEY `category_id_idx` (`category_id`),
  KEY `is_first` (`is_first`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `user_id`, `category_id`, `company_id`, `name`, `phone`, `wmw_section`, `short_description`, `description`, `terms`, `starttime`, `endtime`, `sold`, `min_sold`, `max_buy`, `factor`, `status`, `is_active`, `is_first`, `created_at`, `updated_at`, `slug`, `merchant_user_id`) VALUES
(1, 17, 25, 2, 'WinMaWeb Crystal Laser Light Key Chain', '91990982', NULL, 'Crystal WinMaWeb Key Chain with Laser Etched Logo 3-D inside and internal Laser illumination', 'This Crystal Key Chain with stainless steel chain and ring is ideal for keeping track of your keys and showing the world you were one of the first members to join WinMaWeb. The WinMaWeb logo has been laser etched 3-D into the center of the crystal. The key chain also sports a multicolored laser emitter which illuminates the logo and looks great by day, absolutely fantastic by night. Join WinMaWeb! It''s Free and Always Will Be :-)', 'This exclusive offer is limited to 1 deal per member while supplies last. A collector''s item if there ever was one!  \n\nThis deal and its vouchers will expire on the 31st of September, 2012.\n\n', '2012-07-11 00:00:00', '2012-09-30 00:00:00', 2, 1, 1, 10, 1, 1, 0, '2012-07-11 03:14:14', '2012-08-20 08:15:27', 'winmaweb-crystal-laser-light-key-chain', 0),
(2, 17, 25, 2, 'WinMaWeb T-Shirt- Exclusive Deal!', '91990982', NULL, '100% High grade Black Cotton T-Shirt with stitched embroidery of the WinMaWeb Logo.  ', 'This Black Cotton T-Shirt is an exclusive offer from WinMaWeb. The WinMaWeb logo has been embroidered with the WinMaWeb colors. Be one of the first people to buy our products. Think about it! You can say you were there when WinMaWeb was born. Someday, you can pull out this T-shirt and tell the world you were there at ground zero when WinMaWeb changed the world! :-) \n\n Join WinMaWeb, it''s FREE and ALWAYS will be.', 'This exclusive offer is limited to 1 shirt per member while supplies last.  \n\nThis deal and its vouchers will explire on the 30th of September, 2012.', '2012-07-11 00:00:00', '2012-09-30 00:00:00', 6, 1, 1, 10, 1, 1, 0, '2012-07-11 03:37:25', '2012-07-15 10:02:04', 'winmaweb-t-shirt-exclusive-deal', 0),
(4, 17, 25, 4, 'WinMaWeb Ball Cap-  Exclusive Deal', '91990982', NULL, 'Black embroidered Ball Cap- exclusive Offer from WinMaWeb''s Founder!', 'This once in a lifetime opportunity cannot be missed. Only 10 of these hats were ever made, will ever be made, and the founder of WinMaWeb is selling them himself. You can wear this with pride now, and smile at all your friends, knowing what WinMaWeb will become and having the proof that you were there at ground zero when it all started!!\n\nJoin WinMaWeb today, it''s FREE and always will BE! :-)', 'Offer is limited to 1 hat per member while very limited supplies last.\n\nOffer and Vouchers expire on 30 Sep, 2012', '2012-07-11 00:00:00', '2012-09-30 00:00:00', 2, 1, 1, 10, 1, 1, 0, '2012-07-11 08:48:28', '2012-07-15 10:01:07', 'winmaweb-ball-cap-exclusive-deal', 8),
(5, 8, 25, 4, 'Deluxe Nail and Pedicure Set', '91990982', NULL, 'Packaged in accessible pouch, these beautifully designed long lasting tools \nare made to give you rejuvenating and indulging Spa treatment. ', 'It is time you pamper your hands and nails. Packaged in accessible pouch, these beautifully designed long lasting tools are made to give you rejuvenating and indulging Spa treatment. Following are the contents and their features:\n[b]Cuticle Scissors[/b] Its stainless steel extra fine curved blades minutely trims the dead skin that develops around the base of nail bed, the cuticle.\n[b]Nail File[/b] Precisely constructed hardened steel blade shapes the edges of nails and smoothes out the calluses.\n[b]Nail Clippers[/b] Provided with non-slip handle, its contoured blades trims the rough edges of nails thereby shaping them in the desired shapes.\n[b]Tweezers[/b]Its perfectly structured slant tips helps remove splinters and stray hairs on your hairs.\n\n\nWash your hands in warm soapy water and pat dry before starting the manicure.', 'This great offer is limited to two sets per member.\n', '2012-08-20 00:00:00', '2012-09-30 00:00:00', 3, 5, 2, 30, 1, 0, 0, '2012-07-15 08:13:14', '2012-08-22 05:50:51', 'deluxe-nail-and-pedicure-set', 0),
(6, 8, 15, 4, 'Beautiful Exquisite Eyebrows', '91990982', NULL, 'Your Best Look is Right Here! :-)\nIt is well known that well-shaped and symmetric eyebrows do more to enhance your appearance than any other facial feature.', '[u][b]Different Eyebrow Shapes[/b][/u]\n\nThere are five basic eyebrow shapes that can be used to accentuate or modify facial features. Choosing the right brow for your facial shape is very important choosing the wrong shape can be quite unflattering. For example, a highly arched, angled brow can make a round face appear more oval but the same brow will make a long face look even longer. That is why it is a good idea to get professional advice from a fully qualified and very experienced beauticien- and with this deal offer you need look no further!\n\n[b]The five basic brow shapes are:[/b]\n\n[b]Round:[/b] With a gentle, rounded arch, this shape softens angular faces with sharp features such as pointed chins.\n[b]Sharp Angled:[/b] With a high, sharp peak, this brow opens up the eye giving a youthful appearance. It is a strong brow that can help balance strong features such as a square jaw and give a slimming appearance to a round face.\n[b]Soft Angled:[/b] Still fairly high, more rounded peak give a softer, more delicate look.\n[b]Curved:[/b] This brow has a slight curve between the inner corner and the arched peak giving a strong appearance which works well to balance a square face.\n[b]Flat:[/b] This minimally arched, horizontal brow works well with long faces making them appear more oval.\n\nThey say the eyes are the windows to the soul. If that is true, then it is important to pick out the perfect drapes to compliment those windows; in other words, your eyebrows should frame your eyes and face perfectly.', 'Offer is limited to 1 deal per member.\n10 Deals must be purchased before the deal is activated.\nVouchers are only valid for the month of July at the Deal Location on 12 Stirling Rd. in Queenstown.', '2012-07-25 00:00:00', '2012-07-31 00:00:00', 2, 10, 1, 20, 1, 0, 0, '2012-07-17 11:20:48', '2012-07-25 01:58:37', 'beautiful-exquisite-eyebrows', 0),
(7, 91, 16, 6, 'Balinese Urut Massage', '63920035', NULL, 'An alluring Balinese-styled day-spa haven. Rediscover ancient therapies \nfrom Bali as you rejuvenate, refresh/relax your body, mind and spirit.\nA promise we aspire & strive for.\n', '[b][color=#993300]Healing Touches[/color]\n\n[/b]With just one visit and you''ll fully understand why we have been consistently raved about in numerous local and international publications. Set aside a private moment to let the vitality our healing strokes ease away those aches and tensions.\n\n\n[color=#993300][b]Balinese Urut Massage 60mins[/b][/color]\n\nA must-try at Wayan Retreat! This signature treatment anchors the tradition of Balinese massage. Using waves of long kneading strokes and skin rolling techniques in rhythmic pressures and coupled with our proprietry blend of Balinese oil, you''ll fall in love with it.\n\n[b][color=#993300]A little note from us......[/color] \n\n[/b]Wayan Retreat Balinese Spa is located in the heart of Kampong Glam, a thriving Malay/Arab heritage site which is popular to both locals and tourists alike. Immerse in the surroundings and discover great hotspots as you come by.\n\nIf you have made an appointment, please arrive 10 minutes early for your treatment. Do inform your designated therapist if you are experiencing any injury or are allergic to certain products. If you wish to bring a spare change of clothes feel free to do so.', '1) Offer is limited to 1 deal per member.\n \n2) 5 Deals must be purchased before the deal is activated. \n\n3) Offer is only valid for ladies 18 Years and above at the Location 61 Bussorah street 199477 Singapore. \n\n4) Vouchers must be redeemed between the the 18th of July and the 31st of August, 2012. ', '2012-07-18 09:50:00', '2012-08-01 00:00:00', 1, 5, 1, 40, 1, 0, 0, '2012-07-18 10:25:20', '2012-07-18 11:00:25', 'balinese-urut-massage', 0),
(8, 22, 31, 8, '3 for 1!', '67372977', NULL, 'Creative ways to develop IQ & EQ for your little ones!', '[b]3 For 1![/b]\n\n[u]Creative ways to develop IQ & EQ for your little ones![/u]\n\nA holistic collaboration Between Positive Focus and iGenius! Introduction to Baby Genius, Right Brain Programme, Positive Babies and Positive Tots .Bring home ideas on how to help children develop multiple intelligences through musical moments, brain balancing exercises, yoga play, expressive language play, number play, memory play, imagination play and more!\n\n[b]Workshop 1[/b]\n\nPositive Parents Workshop (Introduction) (0 to 3 yrs)\n\nHolistic, interactive and entertaining! Bring home effective playtime ideas on how to nurture the full potential of your child positively.\n\nWho should attend? If you are a parent, caregiver or teacher and are looking for fun and creative ideas and activities you can do at home or in your classrooms to promote health, well-being, a positive mindset and a love for learning in children from infants to 6 years, this session will definitely benefit you!\n\n● Positive Communication to nurture a happy and confident child\n\nDiscover fun and creative ways to engage young children through both verbal and non-verbal communication, boosting parent-child bonding and building stronger, happier and lasting relationships.\n\n[b]Workshop 2[/b]\n\nBaby Genius (6 months to 3 yrs) (Parent & child class)\n\n[b]Workshop 3[/b]\n\nPositive Babies or Positive Tots (6 months to 3 yrs)(Parent & child class)\n\nContact iGenius or Positive Focus for schedule\nWorkshop Location: iGenius\n180 City Square Mall #09 06/07\nTerms & conditions apply\n\nContact details:\nenquiry@igenius.sg or call iGenius @ Tel: 6737 3333\n\nenquiries@positivefocus.com.sg or\ncall Positive Focus&reg; 63732977 or SMS 81637042\n\nFor more information on BabyGenius, log on to www.igenius.sg\nFor more information on Positive Babies ,Positive Tots and Positive Parents workshop, log on to www.positivefocus.com.sg\n\n\nPositive Focus Pte Ltd\nwww.positivefocus.com.sg | Tel: 67372977 Sms: 81637042Nurturing Positive Habits That Last A Lifetime!', '1) Offer is limited to 10 deals per member. \n2) 1 Deal must be purchased before the deal is activated. \n3) Offer is only valid at City Square Mall\n4) Vouchers must be redeemed between the 20th of July to the 31st of August, 2012. \nPlease call for the class schedule and registration purposes. \n', '2012-07-20 00:00:00', '2012-07-31 00:00:00', 1, 1, 20, 25, 1, 1, 0, '2012-07-20 02:51:51', '2012-07-24 04:49:07', '3-for-1', 0),
(9, 22, 31, 8, '1 FOR 3', '67372977', NULL, 'Creative ways to develop IQ & EQ for your little ones!', '[i][b]A holistic collaboration Between Positive Focus and iGenius![/b] [/i]Introduction to Baby Genius, Right Brain Programme, Positive Babies and Positive Tots. Bring home ideas on how to help children develop multiple intelligences through musical moments, brain balancing exercises, yoga play, expressive language play, number play, memory play, imagination play and more! \n\n[i][b]Workshop 1[/b][/i] \n\n[b]Positive Parents Workshop (Introduction) (0 to 3 years)[/b] \n\nHolistic, interactive and entertaining! Bring home effective playtime ideas on how to nurture the full potential of your child positively. \n\nWho should attend? If you are a parent, caregiver or teacher and are looking for fun and creative ideas and activities you can do at home or in your classrooms to promote health, well-being, a positive mindset and a love for learning in children from infants to 6 years, this session will definitely benefit you! \n\nPositive Communication to nurture a happy and confident child \n\nDiscover fun and creative ways to engage young children through both verbal and non-verbal communication, boosting parent-child bonding and building stronger, happier and lasting relationships. \n\n[i][b]Workshop 2[/b][/i] \n\nBaby Genius (6 months to 3 years) (Parent and child class) \n\n[b]Workshop 3[/b] \n\nPositive Babies or Positive Tots (6 months to 3 years) \n\n(Parent & child class) \n\nContact Positive Focus Tel: 67372977, email: enquiries@positivefocus.com.sg SMS: 81637042 www.positivefocus.com.sg or iGenius Tel: 67372977 email enquiry@igenius.sg www.igenius.sg for schedule \n\nWorkshop Location: iGenius \n\n180 City Square Mall #09 06/07 \n\nTerms & conditions apply', '1) Offer is limited to 1 deals per member. \n2) 5 Deals must be purchased before the deal is activated. \n3) Offer is only valid on weekends atCity square Mall\n5) Strictly by reservations only. Contact Positive Focus or iGenius for schedule and confrimation of space.\n6)Vouchers must be redeemed by 30th Sept, 2012\n7)Not valid with other promotions  \n', '2012-08-08 00:00:00', '2012-08-20 00:00:00', 1, 2, 3, 25, 1, 0, 1, '2012-08-08 10:39:19', '2012-08-09 06:22:54', '1-for-3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_address`
--

CREATE TABLE IF NOT EXISTS `product_address` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `latitude` double(18,2) DEFAULT NULL,
  `longitude` double(18,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`product_id`),
  KEY `country_id_idx` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=120 ;

--
-- Dumping data for table `product_address`
--

INSERT INTO `product_address` (`id`, `product_id`, `address`, `city`, `county`, `postcode`, `country_id`, `latitude`, `longitude`) VALUES
(111, 1, '12 Stirling Road', 'Queenstown', 'Queens', '95488', 198, 1.29, 103.81),
(112, 2, '12 Stirling Road', 'Queenstown', 'Queens', '148955', 198, 1.29, 103.81),
(114, 4, '12 Stirling Rd', 'Queens', 'Queenstown', '148955', 198, 1.32, 103.76),
(115, 5, '12 Stirling Rd', 'Queens', 'Queenstown', '148955', 198, 1.29, 103.81),
(116, 6, '12 Stirling Rd', 'Queens', 'Queenstown', '148955', 198, 1.29, 103.81),
(117, 7, '61 Bussorah Street ', 'singapore', 'singapore', '199477', 198, 0.00, 0.00),
(118, 8, '111 North Bridge Rd  Peninsula Plaza Singapore 179098', 'singapore', 'singapore', '570166', 198, 0.00, 0.00),
(119, 9, '111 North Bridge Rd  Peninsula Plaza Singapore 179098', 'singapore', 'singapore', '570166', 198, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE IF NOT EXISTS `product_media` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) DEFAULT NULL,
  `main` tinyint(4) DEFAULT '0',
  `file_name` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'image',
  `ext` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`id`, `product_id`, `main`, `file_name`, `dir`, `type`, `ext`) VALUES
(57, 1, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(58, 2, 1, 'product', '/uploads/products/images', 'image', 'jpg'),
(61, 4, 1, 'product', '/uploads/products/images', 'image', 'jpg'),
(62, 5, 1, 'product', '/uploads/products/images', 'image', 'jpg'),
(63, 5, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(64, 6, 1, 'product', '/uploads/products/images', 'image', 'jpg'),
(65, 6, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(66, 6, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(73, 7, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(74, 7, 1, 'product', '/uploads/products/images', 'image', 'jpg'),
(75, 8, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(76, 8, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(79, 8, 1, 'product', '/uploads/products/images', 'image', 'jpg'),
(93, 9, 1, 'product', '/uploads/products/images', 'image', 'jpg'),
(94, 9, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(95, 9, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(98, 9, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(103, 1, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(105, 1, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(106, 1, 0, 'product', '/uploads/products/images', 'image', 'jpg'),
(107, 1, 1, 'product', '/uploads/products/images', 'image', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE IF NOT EXISTS `product_price` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `suplier_price` double(18,2) DEFAULT NULL,
  `discount` double(18,2) DEFAULT NULL,
  `money_save` double(18,2) DEFAULT NULL,
  `price` double(18,2) DEFAULT NULL,
  `expire_at` date DEFAULT NULL,
  `stock` bigint(20) DEFAULT '1',
  `sold` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=168 ;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `product_id`, `name`, `suplier_price`, `discount`, `money_save`, `price`, `expire_at`, `stock`, `sold`) VALUES
(118, 4, 'Black Embroidered WinMaWeb Ball Cap', 40.00, 62.50, 25.00, 15.00, '2012-09-30', 8, 1),
(120, 2, 'Size S Black Cotton WinMaWeb T-Shirt', 50.00, 70.00, 35.00, 15.00, '2012-09-30', 7, 1),
(121, 2, 'Size M Black Cotton WinMaWeb T-Shirt', 50.00, 70.00, 35.00, 15.00, '2012-09-30', 7, 0),
(122, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 50.00, 70.00, 35.00, 15.00, '2012-09-30', 7, 4),
(138, 7, 'Balinese Urut 60 Min.', 118.00, 70.00, 82.60, 35.40, '2012-08-31', 50, 1),
(157, 8, '3 For 1!', 135.00, 78.00, 105.30, 29.70, '2012-08-31', 100, 0),
(158, 6, 'Well-Shaped Eebrows', 25.00, 60.00, 15.00, 10.00, '2012-08-31', 30, 0),
(164, 9, 'ONE FOR THREE', 135.00, 78.00, 105.30, 29.70, '2012-09-20', 50, 1),
(166, 1, 'Exclusive WinMaWeb Key Chain', 20.00, 65.00, 13.00, 7.00, '2012-09-30', 50, 0),
(167, 5, 'Delux Nail Set', 35.00, 60.00, 21.00, 14.00, '2012-10-31', 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE IF NOT EXISTS `product_tags` (
  `product_id` bigint(20) NOT NULL DEFAULT '0',
  `tag_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`tag_id`),
  KEY `product_tags_tag_id_tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`product_id`, `tag_id`) VALUES
(4, 117),
(2, 119),
(7, 146),
(8, 381),
(8, 382),
(8, 383),
(8, 384),
(8, 385),
(8, 386),
(8, 387),
(8, 388),
(8, 389),
(8, 390),
(8, 391),
(8, 392),
(8, 393),
(6, 394),
(6, 395),
(9, 460),
(9, 461),
(9, 462),
(9, 463),
(9, 464),
(9, 465),
(9, 466),
(9, 467),
(9, 468),
(9, 469),
(9, 470),
(9, 471),
(1, 474),
(5, 481);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `question` text,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `product_id_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'USER'),
(2, 'SHOP'),
(3, 'ADMIN'),
(4, 'AGENT');

-- --------------------------------------------------------

--
-- Table structure for table `site_config`
--

CREATE TABLE IF NOT EXISTS `site_config` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(255) DEFAULT NULL,
  `config_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `confignameindex_idx` (`config_name`),
  KEY `config_valueindex_idx` (`config_value`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `site_config`
--

INSERT INTO `site_config` (`id`, `config_name`, `config_value`) VALUES
(1, 'merchant_request', 'on'),
(2, 'site_fee', '5'),
(3, 'spend_fee', '20'),
(4, 'merchant_fee', '0'),
(5, 'offer_commission', '20'),
(6, 'agent_request', 'on'),
(7, 'paypal_fee', '3'),
(8, 'payout_delay', '14');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_sluggable_idx` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=482 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`, `slug`) VALUES
(1, 'test', 'test'),
(2, 'wmw', 'wmw'),
(3, 'wmw', 'wmw-1'),
(4, 'android', 'android'),
(5, 'android', 'android-1'),
(6, 'android', 'android-2'),
(7, 'winmaweb', 'winmaweb'),
(8, 'test', 'test-1'),
(9, 'Clothes', 'clothes'),
(10, 'Clothes', 'clothes-1'),
(11, 'Accessories', 'accessories'),
(12, 'Accessories', 'accessories-1'),
(13, 'Accessories', 'accessories-2'),
(14, 'test 2', 'test-2'),
(15, 'test 2', 'test-2-1'),
(16, 'test', 'test-3'),
(17, 'contact', 'contact'),
(18, 'bowling', 'bowling'),
(19, 'bowling', 'bowling-1'),
(20, 'Food', 'food'),
(21, 'Food', 'food-1'),
(22, 'Food', 'food-2'),
(23, 'winmaweb', 'winmaweb-1'),
(24, 'Accessories', 'accessories-3'),
(25, 'Accessories', 'accessories-4'),
(26, 'terms and condiotions', 'terms-and-condiotions'),
(27, 'terms and condiotions', 'terms-and-condiotions-1'),
(28, 'Accessories', 'accessories-5'),
(29, 'test', 'test-4'),
(30, 'test', 'test-5'),
(31, 'test', 'test-6'),
(32, 'test', 'test-7'),
(33, 'terms and condiotions', 'terms-and-condiotions-2'),
(34, 'winmaweb', 'winmaweb-2'),
(35, 'winmaweb', 'winmaweb-3'),
(36, 'winmaweb', 'winmaweb-4'),
(37, 'winmaweb', 'winmaweb-5'),
(38, 'winmaweb', 'winmaweb-6'),
(39, 'winmaweb', 'winmaweb-7'),
(40, 'winmaweb', 'winmaweb-8'),
(41, 'test', 'test-8'),
(42, 'test', 'test-9'),
(43, 'test', 'test-10'),
(44, 'Drinks', 'drinks'),
(45, 'test', 'test-11'),
(46, 'test', 'test-12'),
(47, 'test', 'test-13'),
(48, 'test', 'test-14'),
(49, 'Drinks', 'drinks-1'),
(50, 'test', 'test-15'),
(51, 'test', 'test-16'),
(52, 'test', 'test-17'),
(53, 'test', 'test-18'),
(54, 'test', 'test-19'),
(55, 'test', 'test-20'),
(56, 'test', 'test-21'),
(57, 'test', 'test-22'),
(58, 'test', 'test-23'),
(59, 'test', 'test-24'),
(60, 'Drinks', 'drinks-2'),
(61, 'Test Deals', 'test-deals'),
(62, 'Test Deals', 'test-deals-1'),
(63, 'Drinks', 'drinks-3'),
(64, 'Test Deal', 'test-deal'),
(65, 'Test Deal', 'test-deal-1'),
(66, 'tag', 'tag'),
(67, 'tag', 'tag-1'),
(68, 'Clothing', 'clothing'),
(69, 'Clothing', 'clothing-1'),
(70, 'WinMaWeb', 'winmaweb-9'),
(71, 'Lessons', 'lessons'),
(72, 'Lessons', 'lessons-1'),
(73, 'Lessons', 'lessons-2'),
(74, 'Lessons', 'lessons-3'),
(75, 'Lessons', 'lessons-4'),
(76, 'Test Deal', 'test-deal-2'),
(77, 'Test Deal', 'test-deal-3'),
(78, 'Test Deals', 'test-deals-2'),
(79, 'Test Deals', 'test-deals-3'),
(80, 'contact', 'contact-1'),
(81, 'Massage', 'massage'),
(82, 'Massage', 'massage-1'),
(83, 'test', 'test-25'),
(84, 'test', 'test-26'),
(85, 'test', 'test-27'),
(86, 'test', 'test-28'),
(87, 'Drinks', 'drinks-4'),
(88, 'Test Deal', 'test-deal-4'),
(89, 'Test Deal', 'test-deal-5'),
(90, 'Test Deal', 'test-deal-6'),
(91, 'Test Deal', 'test-deal-7'),
(92, 'Drinks', 'drinks-5'),
(93, 'test', 'test-29'),
(94, 'test', 'test-30'),
(95, 'test', 'test-31'),
(96, 'test', 'test-32'),
(97, 'test', 'test-33'),
(98, 'test', 'test-34'),
(99, 'WinMaWeb', 'winmaweb-10'),
(100, 'WinMaWeb', 'winmaweb-11'),
(101, 'WinMaWeb', 'winmaweb-12'),
(102, 'WinMaWeb', 'winmaweb-13'),
(103, 'WinMaWeb', 'winmaweb-14'),
(104, 'WinMaWeb', 'winmaweb-15'),
(105, 'WinMaWeb', 'winmaweb-16'),
(106, 'cap', 'cap'),
(107, 'WinMaWeb', 'winmaweb-17'),
(108, 'WinMaWeb', 'winmaweb-18'),
(109, 'WinMaWeb', 'winmaweb-19'),
(110, 'test', 'test-35'),
(111, 'Compact Manicure kit', 'compact-manicure-kit'),
(112, 'cosmetic', 'cosmetic'),
(113, 'Cosmetics', 'cosmetics'),
(114, 'Cosmetics', 'cosmetics-1'),
(115, 'Cosmetics', 'cosmetics-2'),
(116, 'WinMaWeb', 'winmaweb-20'),
(117, 'WinMaWeb', 'winmaweb-21'),
(118, 'WinMaWeb', 'winmaweb-22'),
(119, 'WinMaWeb', 'winmaweb-23'),
(120, 'terms and condiotions', 'terms-and-condiotions-3'),
(121, 'terms and condiotions', 'terms-and-condiotions-4'),
(122, 'terms and condiotions', 'terms-and-condiotions-5'),
(123, 'WinMaWeb', 'winmaweb-24'),
(124, 'Cosmetics', 'cosmetics-3'),
(125, 'Cosmetics', 'cosmetics-4'),
(126, 'Cosmetics', 'cosmetics-5'),
(127, 'Beauty Care', 'beauty-care'),
(128, 'Cosmetics', 'cosmetics-6'),
(129, 'Beauty Care', 'beauty-care-1'),
(130, 'Cosmetics', 'cosmetics-7'),
(131, 'Cosmetics', 'cosmetics-8'),
(132, 'Beauty Care', 'beauty-care-2'),
(133, 'Cosmetics', 'cosmetics-9'),
(134, 'Beauty Care', 'beauty-care-3'),
(135, 'Cosmetics', 'cosmetics-10'),
(136, 'Beauty Care', 'beauty-care-4'),
(137, 'Cosmetics', 'cosmetics-11'),
(138, 'Beauty Care', 'beauty-care-5'),
(139, 'Cosmetics', 'cosmetics-12'),
(140, 'Beauty Care', 'beauty-care-6'),
(141, 'Massage', 'massage-2'),
(142, 'Massage', 'massage-3'),
(143, 'Massage', 'massage-4'),
(144, 'Massage', 'massage-5'),
(145, 'Massage', 'massage-6'),
(146, 'Massage', 'massage-7'),
(147, 'Memory Training', 'memory-training'),
(148, 'Right brain training', 'right-brain-training'),
(149, 'Enrichment & Family education', 'enrichment-family-education'),
(150, 'Yoga for kids', 'yoga-for-kids'),
(151, 'NLP for kids', 'nlp-for-kids'),
(152, 'Focused attention', 'focused-attention'),
(153, 'Anger management', 'anger-management'),
(154, 'Creativity', 'creativity'),
(155, 'Multiple intelligence', 'multiple-intelligence'),
(156, 'Smart Kids', 'smart-kids'),
(157, 'camps', 'camps'),
(158, 'Visualization', 'visualization'),
(159, 'Hypnosis', 'hypnosis'),
(160, 'Memory Training', 'memory-training-1'),
(161, 'Right brain training', 'right-brain-training-1'),
(162, 'Enrichment & Family education', 'enrichment-family-education-1'),
(163, 'Yoga for kids', 'yoga-for-kids-1'),
(164, 'NLP for kids', 'nlp-for-kids-1'),
(165, 'Focused attention', 'focused-attention-1'),
(166, 'Anger management', 'anger-management-1'),
(167, 'Creativity', 'creativity-1'),
(168, 'Multiple intelligence', 'multiple-intelligence-1'),
(169, 'Smart Kids', 'smart-kids-1'),
(170, 'camps', 'camps-1'),
(171, 'Visualization', 'visualization-1'),
(172, 'Hypnosis', 'hypnosis-1'),
(173, 'Memory Training', 'memory-training-2'),
(174, 'Right brain training', 'right-brain-training-2'),
(175, 'Enrichment & Family education', 'enrichment-family-education-2'),
(176, 'Yoga for kids', 'yoga-for-kids-2'),
(177, 'NLP for kids', 'nlp-for-kids-2'),
(178, 'Focused attention', 'focused-attention-2'),
(179, 'Anger management', 'anger-management-2'),
(180, 'Creativity', 'creativity-2'),
(181, 'Multiple intelligence', 'multiple-intelligence-2'),
(182, 'Smart Kids', 'smart-kids-2'),
(183, 'camps', 'camps-2'),
(184, 'Visualization', 'visualization-2'),
(185, 'Hypnosis', 'hypnosis-2'),
(186, 'Memory Training', 'memory-training-3'),
(187, 'Right brain training', 'right-brain-training-3'),
(188, 'Enrichment & Family education', 'enrichment-family-education-3'),
(189, 'Yoga for kids', 'yoga-for-kids-3'),
(190, 'NLP for kids', 'nlp-for-kids-3'),
(191, 'Focused attention', 'focused-attention-3'),
(192, 'Anger management', 'anger-management-3'),
(193, 'Creativity', 'creativity-3'),
(194, 'Multiple intelligence', 'multiple-intelligence-3'),
(195, 'Smart Kids', 'smart-kids-3'),
(196, 'camps', 'camps-3'),
(197, 'Visualization', 'visualization-3'),
(198, 'Hypnosis', 'hypnosis-3'),
(199, 'Memory Training', 'memory-training-4'),
(200, 'Right brain training', 'right-brain-training-4'),
(201, 'Enrichment & Family education', 'enrichment-family-education-4'),
(202, 'Yoga for kids', 'yoga-for-kids-4'),
(203, 'NLP for kids', 'nlp-for-kids-4'),
(204, 'Focused attention', 'focused-attention-4'),
(205, 'Anger management', 'anger-management-4'),
(206, 'Creativity', 'creativity-4'),
(207, 'Multiple intelligence', 'multiple-intelligence-4'),
(208, 'Smart Kids', 'smart-kids-4'),
(209, 'camps', 'camps-4'),
(210, 'Visualization', 'visualization-4'),
(211, 'Hypnosis', 'hypnosis-4'),
(212, 'Memory Training', 'memory-training-5'),
(213, 'Right brain training', 'right-brain-training-5'),
(214, 'Enrichment & Family education', 'enrichment-family-education-5'),
(215, 'Yoga for kids', 'yoga-for-kids-5'),
(216, 'NLP for kids', 'nlp-for-kids-5'),
(217, 'Focused attention', 'focused-attention-5'),
(218, 'Anger management', 'anger-management-5'),
(219, 'Creativity', 'creativity-5'),
(220, 'Multiple intelligence', 'multiple-intelligence-5'),
(221, 'Smart Kids', 'smart-kids-5'),
(222, 'camps', 'camps-5'),
(223, 'Visualization', 'visualization-5'),
(224, 'Hypnosis', 'hypnosis-5'),
(225, 'Memory Training', 'memory-training-6'),
(226, 'Right brain training', 'right-brain-training-6'),
(227, 'Enrichment & Family education', 'enrichment-family-education-6'),
(228, 'Yoga for kids', 'yoga-for-kids-6'),
(229, 'NLP for kids', 'nlp-for-kids-6'),
(230, 'Focused attention', 'focused-attention-6'),
(231, 'Anger management', 'anger-management-6'),
(232, 'Creativity', 'creativity-6'),
(233, 'Multiple intelligence', 'multiple-intelligence-6'),
(234, 'Smart Kids', 'smart-kids-6'),
(235, 'camps', 'camps-6'),
(236, 'Visualization', 'visualization-6'),
(237, 'Hypnosis', 'hypnosis-6'),
(238, 'Memory Training', 'memory-training-7'),
(239, 'Right brain training', 'right-brain-training-7'),
(240, 'Enrichment & Family education', 'enrichment-family-education-7'),
(241, 'Yoga for kids', 'yoga-for-kids-7'),
(242, 'NLP for kids', 'nlp-for-kids-7'),
(243, 'Focused attention', 'focused-attention-7'),
(244, 'Anger management', 'anger-management-7'),
(245, 'Creativity', 'creativity-7'),
(246, 'Multiple intelligence', 'multiple-intelligence-7'),
(247, 'Smart Kids', 'smart-kids-7'),
(248, 'camps', 'camps-7'),
(249, 'Visualization', 'visualization-7'),
(250, 'Hypnosis', 'hypnosis-7'),
(251, 'Memory Training', 'memory-training-8'),
(252, 'Right brain training', 'right-brain-training-8'),
(253, 'Enrichment & Family education', 'enrichment-family-education-8'),
(254, 'Yoga for kids', 'yoga-for-kids-8'),
(255, 'NLP for kids', 'nlp-for-kids-8'),
(256, 'Focused attention', 'focused-attention-8'),
(257, 'Anger management', 'anger-management-8'),
(258, 'Creativity', 'creativity-8'),
(259, 'Multiple intelligence', 'multiple-intelligence-8'),
(260, 'Smart Kids', 'smart-kids-8'),
(261, 'camps', 'camps-8'),
(262, 'Visualization', 'visualization-8'),
(263, 'Hypnosis', 'hypnosis-8'),
(264, 'Memory Training', 'memory-training-9'),
(265, 'Right brain training', 'right-brain-training-9'),
(266, 'Enrichment & Family education', 'enrichment-family-education-9'),
(267, 'Yoga for kids', 'yoga-for-kids-9'),
(268, 'NLP for kids', 'nlp-for-kids-9'),
(269, 'Focused attention', 'focused-attention-9'),
(270, 'Anger management', 'anger-management-9'),
(271, 'Creativity', 'creativity-9'),
(272, 'Multiple intelligence', 'multiple-intelligence-9'),
(273, 'Smart Kids', 'smart-kids-9'),
(274, 'camps', 'camps-9'),
(275, 'Visualization', 'visualization-9'),
(276, 'Hypnosis', 'hypnosis-9'),
(277, 'Memory Training', 'memory-training-10'),
(278, 'Right brain training', 'right-brain-training-10'),
(279, 'Enrichment & Family education', 'enrichment-family-education-10'),
(280, 'Yoga for kids', 'yoga-for-kids-10'),
(281, 'NLP for kids', 'nlp-for-kids-10'),
(282, 'Focused attention', 'focused-attention-10'),
(283, 'Anger management', 'anger-management-10'),
(284, 'Creativity', 'creativity-10'),
(285, 'Multiple intelligence', 'multiple-intelligence-10'),
(286, 'Smart Kids', 'smart-kids-10'),
(287, 'camps', 'camps-10'),
(288, 'Visualization', 'visualization-10'),
(289, 'Hypnosis', 'hypnosis-10'),
(290, 'Memory Training', 'memory-training-11'),
(291, 'Right brain training', 'right-brain-training-11'),
(292, 'Enrichment & Family education', 'enrichment-family-education-11'),
(293, 'Yoga for kids', 'yoga-for-kids-11'),
(294, 'NLP for kids', 'nlp-for-kids-11'),
(295, 'Focused attention', 'focused-attention-11'),
(296, 'Anger management', 'anger-management-11'),
(297, 'Creativity', 'creativity-11'),
(298, 'Multiple intelligence', 'multiple-intelligence-11'),
(299, 'Smart Kids', 'smart-kids-11'),
(300, 'camps', 'camps-11'),
(301, 'Visualization', 'visualization-11'),
(302, 'Hypnosis', 'hypnosis-11'),
(303, 'Memory Training', 'memory-training-12'),
(304, 'Right brain training', 'right-brain-training-12'),
(305, 'Enrichment & Family education', 'enrichment-family-education-12'),
(306, 'Yoga for kids', 'yoga-for-kids-12'),
(307, 'NLP for kids', 'nlp-for-kids-12'),
(308, 'Focused attention', 'focused-attention-12'),
(309, 'Anger management', 'anger-management-12'),
(310, 'Creativity', 'creativity-12'),
(311, 'Multiple intelligence', 'multiple-intelligence-12'),
(312, 'Smart Kids', 'smart-kids-12'),
(313, 'camps', 'camps-12'),
(314, 'Visualization', 'visualization-12'),
(315, 'Hypnosis', 'hypnosis-12'),
(316, 'Memory Training', 'memory-training-13'),
(317, 'Right brain training', 'right-brain-training-13'),
(318, 'Enrichment & Family education', 'enrichment-family-education-13'),
(319, 'Yoga for kids', 'yoga-for-kids-13'),
(320, 'NLP for kids', 'nlp-for-kids-13'),
(321, 'Focused attention', 'focused-attention-13'),
(322, 'Anger management', 'anger-management-13'),
(323, 'Creativity', 'creativity-13'),
(324, 'Multiple intelligence', 'multiple-intelligence-13'),
(325, 'Smart Kids', 'smart-kids-13'),
(326, 'camps', 'camps-13'),
(327, 'Visualization', 'visualization-13'),
(328, 'Hypnosis', 'hypnosis-13'),
(329, 'Memory Training', 'memory-training-14'),
(330, 'Right brain training', 'right-brain-training-14'),
(331, 'Enrichment & Family education', 'enrichment-family-education-14'),
(332, 'Yoga for kids', 'yoga-for-kids-14'),
(333, 'NLP for kids', 'nlp-for-kids-14'),
(334, 'Focused attention', 'focused-attention-14'),
(335, 'Anger management', 'anger-management-14'),
(336, 'Creativity', 'creativity-14'),
(337, 'Multiple intelligence', 'multiple-intelligence-14'),
(338, 'Smart Kids', 'smart-kids-14'),
(339, 'camps', 'camps-14'),
(340, 'Visualization', 'visualization-14'),
(341, 'Hypnosis', 'hypnosis-14'),
(342, 'Memory Training', 'memory-training-15'),
(343, 'Right brain training', 'right-brain-training-15'),
(344, 'Enrichment & Family education', 'enrichment-family-education-15'),
(345, 'Yoga for kids', 'yoga-for-kids-15'),
(346, 'NLP for kids', 'nlp-for-kids-15'),
(347, 'Focused attention', 'focused-attention-15'),
(348, 'Anger management', 'anger-management-15'),
(349, 'Creativity', 'creativity-15'),
(350, 'Multiple intelligence', 'multiple-intelligence-15'),
(351, 'Smart Kids', 'smart-kids-15'),
(352, 'camps', 'camps-15'),
(353, 'Visualization', 'visualization-15'),
(354, 'Hypnosis', 'hypnosis-15'),
(355, 'Memory Training', 'memory-training-16'),
(356, 'Right brain training', 'right-brain-training-16'),
(357, 'Enrichment & Family education', 'enrichment-family-education-16'),
(358, 'Yoga for kids', 'yoga-for-kids-16'),
(359, 'NLP for kids', 'nlp-for-kids-16'),
(360, 'Focused attention', 'focused-attention-16'),
(361, 'Anger management', 'anger-management-16'),
(362, 'Creativity', 'creativity-16'),
(363, 'Multiple intelligence', 'multiple-intelligence-16'),
(364, 'Smart Kids', 'smart-kids-16'),
(365, 'camps', 'camps-16'),
(366, 'Visualization', 'visualization-16'),
(367, 'Hypnosis', 'hypnosis-16'),
(368, 'Memory Training', 'memory-training-17'),
(369, 'Right brain training', 'right-brain-training-17'),
(370, 'Enrichment & Family education', 'enrichment-family-education-17'),
(371, 'Yoga for kids', 'yoga-for-kids-17'),
(372, 'NLP for kids', 'nlp-for-kids-17'),
(373, 'Focused attention', 'focused-attention-17'),
(374, 'Anger management', 'anger-management-17'),
(375, 'Creativity', 'creativity-17'),
(376, 'Multiple intelligence', 'multiple-intelligence-17'),
(377, 'Smart Kids', 'smart-kids-17'),
(378, 'camps', 'camps-17'),
(379, 'Visualization', 'visualization-17'),
(380, 'Hypnosis', 'hypnosis-17'),
(381, 'Memory Training', 'memory-training-18'),
(382, 'Right brain training', 'right-brain-training-18'),
(383, 'Enrichment & Family education', 'enrichment-family-education-18'),
(384, 'Yoga for kids', 'yoga-for-kids-18'),
(385, 'NLP for kids', 'nlp-for-kids-18'),
(386, 'Focused attention', 'focused-attention-18'),
(387, 'Anger management', 'anger-management-18'),
(388, 'Creativity', 'creativity-18'),
(389, 'Multiple intelligence', 'multiple-intelligence-18'),
(390, 'Smart Kids', 'smart-kids-18'),
(391, 'camps', 'camps-18'),
(392, 'Visualization', 'visualization-18'),
(393, 'Hypnosis', 'hypnosis-18'),
(394, 'Cosmetics', 'cosmetics-13'),
(395, 'Beauty Care', 'beauty-care-7'),
(396, 'Cosmetics', 'cosmetics-14'),
(397, 'test', 'test-36'),
(398, 'test', 'test-37'),
(399, 'WinMaWeb', 'winmaweb-25'),
(400, 'WinMaWeb', 'winmaweb-26'),
(401, 'WinMaWeb', 'winmaweb-27'),
(402, 'WinMaWeb', 'winmaweb-28'),
(403, 'WinMaWeb', 'winmaweb-29'),
(404, 'WinMaWeb', 'winmaweb-30'),
(405, 'WinMaWeb', 'winmaweb-31'),
(406, 'WinMaWeb', 'winmaweb-32'),
(407, 'WinMaWeb', 'winmaweb-33'),
(408, 'WinMaWeb', 'winmaweb-34'),
(409, 'WinMaWeb', 'winmaweb-35'),
(410, 'WinMaWeb', 'winmaweb-36'),
(411, 'WinMaWeb', 'winmaweb-37'),
(412, 'Parent & Child education', 'parent-child-education'),
(413, 'Family Bonding', 'family-bonding'),
(414, 'Positive Parenting', 'positive-parenting'),
(415, 'Yoga play for children', 'yoga-play-for-children'),
(416, 'Music and Movement', 'music-and-movement'),
(417, 'Memory Play', 'memory-play'),
(418, 'Imagination Play', 'imagination-play'),
(419, 'Number Play', 'number-play'),
(420, 'Positive Communication', 'positive-communication'),
(421, 'Positive Discipline', 'positive-discipline'),
(422, 'Creative education', 'creative-education'),
(423, 'Language Play', 'language-play'),
(424, 'Parent & Child education', 'parent-child-education-1'),
(425, 'Family Bonding', 'family-bonding-1'),
(426, 'Positive Parenting', 'positive-parenting-1'),
(427, 'Yoga play for children', 'yoga-play-for-children-1'),
(428, 'Music and Movement', 'music-and-movement-1'),
(429, 'Memory Play', 'memory-play-1'),
(430, 'Imagination Play', 'imagination-play-1'),
(431, 'Number Play', 'number-play-1'),
(432, 'Positive Communication', 'positive-communication-1'),
(433, 'Positive Discipline', 'positive-discipline-1'),
(434, 'Creative education', 'creative-education-1'),
(435, 'Language Play', 'language-play-1'),
(436, 'Parent & Child education', 'parent-child-education-2'),
(437, 'Family Bonding', 'family-bonding-2'),
(438, 'Positive Parenting', 'positive-parenting-2'),
(439, 'Yoga play for children', 'yoga-play-for-children-2'),
(440, 'Music and Movement', 'music-and-movement-2'),
(441, 'Memory Play', 'memory-play-2'),
(442, 'Imagination Play', 'imagination-play-2'),
(443, 'Number Play', 'number-play-2'),
(444, 'Positive Communication', 'positive-communication-2'),
(445, 'Positive Discipline', 'positive-discipline-2'),
(446, 'Creative education', 'creative-education-2'),
(447, 'Language Play', 'language-play-2'),
(448, 'Parent & Child education', 'parent-child-education-3'),
(449, 'Family Bonding', 'family-bonding-3'),
(450, 'Positive Parenting', 'positive-parenting-3'),
(451, 'Yoga play for children', 'yoga-play-for-children-3'),
(452, 'Music and Movement', 'music-and-movement-3'),
(453, 'Memory Play', 'memory-play-3'),
(454, 'Imagination Play', 'imagination-play-3'),
(455, 'Number Play', 'number-play-3'),
(456, 'Positive Communication', 'positive-communication-3'),
(457, 'Positive Discipline', 'positive-discipline-3'),
(458, 'Creative education', 'creative-education-3'),
(459, 'Language Play', 'language-play-3'),
(460, 'Parent & Child education', 'parent-child-education-4'),
(461, 'Family Bonding', 'family-bonding-4'),
(462, 'Positive Parenting', 'positive-parenting-4'),
(463, 'Yoga play for children', 'yoga-play-for-children-4'),
(464, 'Music and Movement', 'music-and-movement-4'),
(465, 'Memory Play', 'memory-play-4'),
(466, 'Imagination Play', 'imagination-play-4'),
(467, 'Number Play', 'number-play-4'),
(468, 'Positive Communication', 'positive-communication-4'),
(469, 'Positive Discipline', 'positive-discipline-4'),
(470, 'Creative education', 'creative-education-4'),
(471, 'Language Play', 'language-play-4'),
(472, 'success', 'success'),
(473, 'WinMaWeb', 'winmaweb-38'),
(474, 'WinMaWeb', 'winmaweb-39'),
(475, 'winmaweb', 'winmaweb-40'),
(476, 'winmaweb', 'winmaweb-41'),
(477, 'WinMaWeb', 'winmaweb-42'),
(478, 'WinMaWeb', 'winmaweb-43'),
(479, 'test', 'test-38'),
(480, 'test', 'test-39'),
(481, 'Cosmetics', 'cosmetics-15');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `transaction_type` tinyint(4) DEFAULT '0',
  `sender_id` bigint(20) DEFAULT NULL,
  `receiver_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` double(18,2) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `full_payment` double(18,2) DEFAULT '0.00',
  `status` tinyint(4) DEFAULT '0',
  `action` tinyint(4) DEFAULT '0',
  `hint` varchar(255) DEFAULT NULL,
  `paypal_txn_id` varchar(255) DEFAULT NULL,
  `paypal_parent_txn_id` varchar(255) DEFAULT NULL,
  `paypal_txn_type` varchar(255) DEFAULT NULL,
  `paypal_payment_status` varchar(255) DEFAULT NULL,
  `paypal_pending_reason` varchar(255) DEFAULT NULL,
  `paypal_payment_date` varchar(255) DEFAULT NULL,
  `paypal_mc_gross` varchar(255) DEFAULT NULL,
  `paypal_mc_currency` varchar(255) DEFAULT NULL,
  `paypal` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `paypaltxnindex_idx` (`paypal_txn_id`),
  KEY `parentindex_idx` (`parent_id`),
  KEY `transactiontypeindex_idx` (`transaction_type`),
  KEY `product_id_idx` (`product_id`),
  KEY `sender_id_idx` (`sender_id`),
  KEY `receiver_id_idx` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=288 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `parent_id`, `transaction_type`, `sender_id`, `receiver_id`, `product_id`, `product_name`, `product_price`, `quantity`, `full_payment`, `status`, `action`, `hint`, `paypal_txn_id`, `paypal_parent_txn_id`, `paypal_txn_type`, `paypal_payment_status`, `paypal_pending_reason`, `paypal_payment_date`, `paypal_mc_gross`, `paypal_mc_currency`, `paypal`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 17, 17, NULL, NULL, NULL, NULL, 50.00, 0, 0, NULL, '1C644496TB472752J', NULL, 'web_accept', 'Completed', NULL, '23:13:50 Jul 10, 2012 PDT', '50.00', 'SGD', 'Chris_Tarn@web.de', '2012-07-11 02:13:53', '2012-07-11 02:13:53'),
(2, 0, 0, 9, 9, NULL, NULL, NULL, NULL, 1.00, 0, 0, NULL, '8J387379PT119600R', NULL, 'web_accept', 'Completed', NULL, '23:00:35 Jul 10, 2012 PDT', '1.00', 'SGD', 'ingka@siteisfied.com', '2012-07-11 02:14:26', '2012-07-11 02:14:26'),
(3, 0, 0, 9, 9, NULL, NULL, NULL, NULL, 1.00, 0, 0, NULL, '2S333680B4923724S', NULL, 'web_accept', 'Completed', NULL, '23:15:55 Jul 10, 2012 PDT', '1.00', 'SGD', 'ingka@siteisfied.com', '2012-07-11 02:15:59', '2012-07-11 02:15:59'),
(4, 0, 0, 8, 8, NULL, NULL, NULL, NULL, 30.00, 0, 0, NULL, '1AJ733971A257623G', NULL, 'web_accept', 'Completed', NULL, '17:55:19 Jul 10, 2012 PDT', '30.00', 'SGD', 'jgoovaerts@hotmail.com', '2012-07-11 02:17:31', '2012-07-11 02:17:31'),
(5, 0, 0, 9, 9, NULL, NULL, NULL, NULL, 10.00, 0, 0, NULL, '46C80516N1414122C', NULL, 'web_accept', 'Completed', NULL, '18:39:05 Jul 10, 2012 PDT', '10.00', 'SGD', 'ingka@siteisfied.com', '2012-07-11 02:17:35', '2012-07-11 02:17:35'),
(6, 0, 0, 8, 8, NULL, NULL, NULL, NULL, 100.00, 0, 0, NULL, '0JB17291DU040230M', NULL, 'web_accept', 'Completed', NULL, '17:46:28 Jul 10, 2012 PDT', '100.00', 'SGD', 'jgoovaerts@hotmail.com', '2012-07-11 02:17:37', '2012-07-11 02:17:37'),
(9, 0, 0, 9, 9, NULL, NULL, NULL, NULL, 1.50, 0, 0, NULL, '66G24144G3995183S', NULL, 'web_accept', 'Completed', NULL, '23:30:22 Jul 10, 2012 PDT', '1.50', 'SGD', 'ingka@siteisfied.com', '2012-07-11 02:30:27', '2012-07-11 02:30:27'),
(10, 0, 0, 9, 9, NULL, NULL, NULL, NULL, 1.00, 0, 0, NULL, '9R218666PU028192A', NULL, 'web_accept', 'Completed', NULL, '23:38:43 Jul 10, 2012 PDT', '1.00', 'SGD', 'ingka@siteisfied.com', '2012-07-11 02:38:47', '2012-07-11 02:38:47'),
(12, 0, 8, 17, 2, NULL, 'Agent Verification & Test Transaction', NULL, NULL, -3.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 02:54:06', '2012-07-11 02:54:06'),
(13, 0, 8, 17, 2, NULL, 'Merchant Verification & Test Transaction', NULL, NULL, -3.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 02:59:37', '2012-07-11 02:59:37'),
(14, 0, 0, 8, 8, NULL, NULL, NULL, NULL, 2.00, 0, 0, NULL, '6AY32371D52805139', NULL, 'web_accept', 'Completed', NULL, '00:09:07 Jul 11, 2012 PDT', '2.00', 'SGD', 'jgoovaerts@hotmail.com', '2012-07-11 03:09:11', '2012-07-11 03:09:11'),
(15, 0, 0, 8, 8, NULL, NULL, NULL, NULL, 1.00, 0, 0, NULL, '0UR72409DM950450M', NULL, 'web_accept', 'Completed', NULL, '00:14:05 Jul 11, 2012 PDT', '1.00', 'SGD', 'jgoovaerts@hotmail.com', '2012-07-11 03:14:11', '2012-07-11 03:14:11'),
(16, 0, 1, 8, 17, 2, 'Size M Black Cotton WinMaWeb T-Shirt', 15.00, 1, -15.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 03:59:38', '2012-07-11 03:59:38'),
(17, 16, 4, 8, 17, 2, 'Size M Black Cotton WinMaWeb T-Shirt', 15.00, 1, 1.50, 1, 0, 'Deal owner share received (1.5), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 03:59:38', '2012-07-11 03:59:38'),
(18, 16, 3, 8, 2, 2, 'Size M Black Cotton WinMaWeb T-Shirt', 15.00, 1, 13.50, 1, 0, 'Bank share received (13.5), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 03:59:38', '2012-07-11 03:59:38'),
(19, 16, 10, 2, 3, 2, 'Size M Black Cotton WinMaWeb T-Shirt', 15.00, 1, 2.70, 1, 0, 'User level(5) commission received (2.7), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 03:59:38', '2012-07-11 03:59:38'),
(20, 16, 9, 2, 17, 2, 'Size M Black Cotton WinMaWeb T-Shirt', 15.00, 1, 2.70, 1, 0, 'Agent commission received (2.7), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 03:59:38', '2012-07-11 03:59:38'),
(21, 16, 11, 2, 2, 2, 'Size M Black Cotton WinMaWeb T-Shirt', 15.00, 1, 8.10, 0, 0, 'Bank real share received (8.1), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 03:59:38', '2012-07-11 03:59:38'),
(22, 0, 1, 8, 17, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, -7.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 04:04:05', '2012-07-11 04:04:05'),
(23, 22, 4, 8, 17, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, 0.70, 1, 0, 'Deal owner share received (0.7), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 04:04:05', '2012-07-11 04:04:05'),
(24, 22, 3, 8, 2, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, 6.30, 1, 0, 'Bank share received (6.3), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 04:04:05', '2012-07-11 04:04:05'),
(25, 22, 10, 2, 3, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, 1.26, 1, 0, 'User level(5) commission received (1.26), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 04:04:05', '2012-07-11 04:04:05'),
(26, 22, 9, 2, 17, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, 1.26, 1, 0, 'Agent commission received (1.26), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 04:04:05', '2012-07-11 04:04:05'),
(27, 22, 11, 2, 2, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, 3.78, 0, 0, 'Bank real share received (3.78), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 04:04:05', '2012-07-11 04:04:05'),
(28, 0, 8, 8, 2, NULL, 'Agent Verification & Test Transaction', NULL, NULL, -3.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 04:44:29', '2012-07-11 04:44:29'),
(29, 0, 8, 8, 2, NULL, 'Merchant Verification & Test Transaction', NULL, NULL, -3.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 04:46:05', '2012-07-11 04:46:05'),
(30, 0, 0, 8, 8, NULL, NULL, NULL, NULL, 1.00, 0, 0, NULL, '3B865045R7224973H', NULL, 'web_accept', 'Completed', NULL, '05:05:10 Jul 11, 2012 PDT', '1.00', 'SGD', 'jgoovaerts@hotmail.com', '2012-07-11 08:05:16', '2012-07-11 08:05:16'),
(31, 0, 2, 8, 8, NULL, NULL, NULL, NULL, -56.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 11:15:56', '2012-07-11 11:15:56'),
(32, 0, 1, 8, 8, 5, 'Delux Nail Set', 14.00, 1, -14.00, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:14:54', '2012-07-15 09:14:54'),
(33, 32, 4, 8, 8, 5, 'Delux Nail Set', 14.00, 1, 9.80, 1, 0, 'Deal owner share received (9.8), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:14:54', '2012-07-15 09:14:54'),
(34, 32, 3, 8, 2, 5, 'Delux Nail Set', 14.00, 1, 4.20, 1, 0, 'Bank share received (4.2), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:14:54', '2012-07-15 09:14:54'),
(35, 32, 10, 2, 3, 5, 'Delux Nail Set', 14.00, 1, 0.84, 1, 0, 'User level(5) commission received (0.84), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:14:54', '2012-07-15 09:14:54'),
(36, 32, 9, 2, 8, 5, 'Delux Nail Set', 14.00, 1, 0.84, 1, 0, 'Agent commission received (0.84), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:14:54', '2012-07-15 09:14:54'),
(37, 32, 11, 2, 2, 5, 'Delux Nail Set', 14.00, 1, 2.52, 1, 0, 'Bank real share received (2.52), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:14:54', '2012-07-15 09:14:54'),
(38, 0, 1, 8, 8, 5, 'Delux Nail Set', 14.00, 1, -14.00, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:16:20', '2012-07-15 09:16:20'),
(39, 38, 4, 8, 8, 5, 'Delux Nail Set', 14.00, 1, 9.80, 1, 0, 'Deal owner share received (9.8), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:16:20', '2012-07-15 09:16:20'),
(40, 38, 3, 8, 2, 5, 'Delux Nail Set', 14.00, 1, 4.20, 1, 0, 'Bank share received (4.2), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:16:20', '2012-07-15 09:16:20'),
(41, 38, 10, 2, 3, 5, 'Delux Nail Set', 14.00, 1, 0.84, 1, 0, 'User level(5) commission received (0.84), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:16:20', '2012-07-15 09:16:20'),
(42, 38, 9, 2, 8, 5, 'Delux Nail Set', 14.00, 1, 0.84, 1, 0, 'Agent commission received (0.84), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:16:20', '2012-07-15 09:16:20'),
(43, 38, 11, 2, 2, 5, 'Delux Nail Set', 14.00, 1, 2.52, 1, 0, 'Bank real share received (2.52), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:16:20', '2012-07-15 09:16:20'),
(44, 0, 1, 8, 8, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, -15.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:41:40', '2012-07-15 09:41:40'),
(45, 44, 4, 8, 8, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, 1.50, 1, 0, 'Deal owner share received (1.5), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:41:40', '2012-07-15 09:41:40'),
(46, 44, 3, 8, 2, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, 13.50, 1, 0, 'Bank share received (13.5), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:41:40', '2012-07-15 09:41:40'),
(47, 44, 10, 2, 3, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, 2.70, 1, 0, 'User level(5) commission received (2.7), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:41:40', '2012-07-15 09:41:40'),
(48, 44, 9, 2, 17, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, 2.70, 1, 0, 'Agent commission received (2.7), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:41:40', '2012-07-15 09:41:40'),
(49, 44, 11, 2, 2, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, 8.10, 0, 0, 'Bank real share received (8.1), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-15 09:41:40', '2012-07-15 09:41:40'),
(50, 0, 0, 8, 8, NULL, NULL, NULL, NULL, 46.56, 0, 0, NULL, '73F96827V1424623T', NULL, 'web_accept', 'Completed', NULL, '08:50:01 Jul 17, 2012 PDT', '48.00', 'SGD', 'jgoovaerts@hotmail.com', '2012-07-17 11:50:10', '2012-07-17 11:50:10'),
(51, 50, 75, 8, 8, NULL, NULL, NULL, NULL, 1.44, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-17 11:50:10', '2012-07-17 11:50:10'),
(52, 0, 1, 8, 8, 6, 'Well-shaped eyebrows', 10.00, 1, -10.00, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-17 11:50:58', '2012-07-17 11:50:58'),
(53, 52, 4, 8, 8, 6, 'Well-shaped eyebrows', 10.00, 1, 8.00, 1, 0, 'Deal owner share received (8), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-17 11:50:58', '2012-07-17 11:50:58'),
(54, 52, 3, 8, 2, 6, 'Well-shaped eyebrows', 10.00, 1, 2.00, 1, 0, 'Bank share received (2), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-17 11:50:58', '2012-07-17 11:50:58'),
(55, 52, 10, 2, 3, 6, 'Well-shaped eyebrows', 10.00, 1, 0.40, 1, 0, 'User level(5) commission received (0.4), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-17 11:50:58', '2012-07-17 11:50:58'),
(56, 52, 9, 2, 8, 6, 'Well-shaped eyebrows', 10.00, 1, 0.40, 1, 0, 'Agent commission received (0.4), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-17 11:50:58', '2012-07-17 11:50:58'),
(57, 52, 11, 2, 2, 6, 'Well-shaped eyebrows', 10.00, 1, 1.20, 1, 0, 'Bank real share received (1.2), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-17 11:50:58', '2012-07-17 11:50:58'),
(58, 0, 1, 9, 8, 5, 'Delux Nail Set', 14.00, 1, -14.00, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 00:55:33', '2012-07-18 00:55:33'),
(59, 58, 4, 9, 8, 5, 'Delux Nail Set', 14.00, 1, 9.80, 1, 0, 'Deal owner share received (9.8), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 00:55:33', '2012-07-18 00:55:33'),
(60, 58, 3, 9, 2, 5, 'Delux Nail Set', 14.00, 1, 4.20, 1, 0, 'Bank share received (4.2), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 00:55:33', '2012-07-18 00:55:33'),
(61, 58, 10, 2, 4, 5, 'Delux Nail Set', 14.00, 1, 0.84, 1, 0, 'User level(5) commission received (0.84), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 00:55:33', '2012-07-18 00:55:33'),
(62, 58, 9, 2, 8, 5, 'Delux Nail Set', 14.00, 1, 0.84, 1, 0, 'Agent commission received (0.84), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 00:55:33', '2012-07-18 00:55:33'),
(63, 58, 11, 2, 2, 5, 'Delux Nail Set', 14.00, 1, 2.52, 1, 0, 'Bank real share received (2.52), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 00:55:33', '2012-07-18 00:55:33'),
(64, 0, 0, 9, 9, NULL, NULL, NULL, NULL, 0.97, 0, 0, NULL, '8BR83543TG628070J', NULL, 'web_accept', 'Completed', NULL, '22:01:06 Jul 17, 2012 PDT', '1.00', 'SGD', 'ingka@siteisfied.com', '2012-07-18 01:01:10', '2012-07-18 01:01:10'),
(65, 64, 75, 9, 9, NULL, NULL, NULL, NULL, 0.03, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 01:01:10', '2012-07-18 01:01:10'),
(66, 0, 0, 98, 98, NULL, NULL, NULL, NULL, 9.70, 0, 0, NULL, '8W673420ES6622426', NULL, 'web_accept', 'Completed', NULL, '06:32:10 Jul 18, 2012 PDT', '10.00', 'SGD', 'jessamine@igenius.sg', '2012-07-18 09:32:16', '2012-07-18 09:32:16'),
(67, 66, 75, 98, 98, NULL, NULL, NULL, NULL, 0.30, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 09:32:16', '2012-07-18 09:32:16'),
(68, 0, 0, 91, 91, NULL, NULL, NULL, NULL, 7.76, 0, 0, NULL, '07F96285LF284734G', NULL, 'web_accept', 'Completed', NULL, '06:43:08 Jul 18, 2012 PDT', '8.00', 'SGD', 'jgoovaerts@hotmail.com', '2012-07-18 09:43:13', '2012-07-18 09:43:13'),
(69, 68, 75, 91, 91, NULL, NULL, NULL, NULL, 0.24, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 09:43:13', '2012-07-18 09:43:13'),
(70, 0, 8, 91, 2, NULL, 'Agent Verification & Test Transaction', NULL, NULL, -3.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 09:47:01', '2012-07-18 09:47:01'),
(71, 0, 8, 91, 2, NULL, 'Merchant Verification & Test Transaction', NULL, NULL, -3.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-18 09:48:45', '2012-07-18 09:48:45'),
(72, 0, 0, 22, 22, NULL, NULL, NULL, NULL, 9.70, 0, 0, NULL, '8NU12004AJ299121X', NULL, 'web_accept', 'Completed', NULL, '21:08:30 Jul 18, 2012 PDT', '10.00', 'SGD', 'hassynergy@yahoo.com.sg', '2012-07-19 00:08:36', '2012-07-19 00:08:36'),
(73, 72, 75, 22, 22, NULL, NULL, NULL, NULL, 0.30, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 00:08:36', '2012-07-19 00:08:36'),
(74, 0, 0, 22, 22, NULL, NULL, NULL, NULL, 4.85, 0, 0, NULL, '1K0706243G357000U', NULL, 'web_accept', 'Completed', NULL, '21:09:29 Jul 18, 2012 PDT', '5.00', 'SGD', 'hassynergy@yahoo.com.sg', '2012-07-19 00:09:33', '2012-07-19 00:09:33'),
(75, 74, 75, 22, 22, NULL, NULL, NULL, NULL, 0.15, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 00:09:33', '2012-07-19 00:09:33'),
(76, 0, 1, 22, 8, 6, 'Well-Shaped Eebrows', 10.00, 1, -10.00, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 00:09:55', '2012-07-19 00:09:55'),
(77, 76, 4, 22, 8, 6, 'Well-Shaped Eebrows', 10.00, 1, 8.00, 1, 0, 'Deal owner share received (8), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 00:09:55', '2012-07-19 00:09:55'),
(78, 76, 3, 22, 2, 6, 'Well-Shaped Eebrows', 10.00, 1, 2.00, 1, 0, 'Bank share received (2), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 00:09:55', '2012-07-19 00:09:55'),
(79, 76, 10, 2, 5, 6, 'Well-Shaped Eebrows', 10.00, 1, 0.40, 1, 0, 'User level(5) commission received (0.4), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 00:09:55', '2012-07-19 00:09:55'),
(80, 76, 9, 2, 8, 6, 'Well-Shaped Eebrows', 10.00, 1, 0.40, 1, 0, 'Agent commission received (0.4), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 00:09:55', '2012-07-19 00:09:55'),
(81, 76, 11, 2, 2, 6, 'Well-Shaped Eebrows', 10.00, 1, 1.20, 1, 0, 'Bank real share received (1.2), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 00:09:55', '2012-07-19 00:09:55'),
(82, 0, 1, 17, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, -15.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 04:27:02', '2012-07-19 04:27:02'),
(83, 82, 4, 17, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 13.50, 2, 0, 'Deal owner share received (13.5), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 04:27:02', '2012-08-02 06:14:45'),
(84, 82, 3, 17, 2, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 1.50, 1, 0, 'Bank share received (1.5), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 04:27:02', '2012-07-19 04:27:02'),
(85, 82, 10, 2, 4, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.30, 0, 0, 'User level(5) commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 04:27:02', '2012-08-02 06:14:45'),
(86, 82, 9, 2, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.30, 0, 0, 'Agent commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 04:27:02', '2012-08-02 06:14:45'),
(87, 82, 11, 2, 2, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.90, 0, 0, 'Bank real share received (0.9), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 04:27:02', '2012-07-19 04:27:02'),
(88, 0, 1, 8, 91, 7, 'Balinese Urut 60 Min.', 35.40, 1, -35.40, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 11:49:01', '2012-07-19 11:49:01'),
(89, 88, 4, 8, 91, 7, 'Balinese Urut 60 Min.', 35.40, 1, 21.24, 1, 0, 'Deal owner share received (21.24), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 11:49:01', '2012-07-19 11:49:01'),
(90, 88, 3, 8, 2, 7, 'Balinese Urut 60 Min.', 35.40, 1, 14.16, 1, 0, 'Bank share received (14.16), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 11:49:01', '2012-07-19 11:49:01'),
(91, 88, 10, 2, 3, 7, 'Balinese Urut 60 Min.', 35.40, 1, 2.83, 1, 0, 'User level(5) commission received (2.83), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 11:49:01', '2012-07-19 11:49:01'),
(92, 88, 9, 2, 91, 7, 'Balinese Urut 60 Min.', 35.40, 1, 2.83, 1, 0, 'Agent commission received (2.83), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 11:49:01', '2012-07-19 11:49:01'),
(93, 88, 11, 2, 2, 7, 'Balinese Urut 60 Min.', 35.40, 1, 8.50, 1, 0, 'Bank real share received (8.5), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 11:49:01', '2012-07-19 11:49:01'),
(94, 0, 8, 22, 2, NULL, 'Agent Verification & Test Transaction', NULL, NULL, -3.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:10:20', '2012-07-20 02:10:20'),
(95, 0, 0, 22, 22, NULL, NULL, NULL, NULL, 4.85, 0, 0, NULL, '5W33900781157842C', NULL, 'web_accept', 'Completed', NULL, '23:12:08 Jul 19, 2012 PDT', '5.00', 'SGD', 'hassynergy@yahoo.com.sg', '2012-07-20 02:12:13', '2012-07-20 02:12:13'),
(96, 95, 75, 22, 22, NULL, NULL, NULL, NULL, 0.15, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:12:13', '2012-07-20 02:12:13'),
(97, 0, 8, 22, 2, NULL, 'Merchant Verification & Test Transaction', NULL, NULL, -3.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:13:50', '2012-07-20 02:13:50'),
(98, 0, 0, 10, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, -15.00, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:40:14', '2012-07-20 02:40:14'),
(99, 98, 4, 10, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 13.50, 1, 0, 'Deal owner share received (13.5), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:40:14', '2012-07-20 02:40:14'),
(100, 98, 3, 10, 2, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 1.50, 1, 0, 'Bank share received (1.5), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:40:14', '2012-07-20 02:40:14'),
(101, 98, 10, 2, 4, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.30, 1, 0, 'User level(5) commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:40:14', '2012-07-20 02:40:14'),
(102, 98, 9, 2, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.30, 1, 0, 'Agent commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:40:14', '2012-07-20 02:40:14'),
(103, 98, 11, 2, 2, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.90, 1, 0, 'Bank real share received (0.9), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:40:14', '2012-07-20 02:40:14'),
(104, 0, 0, 10, 10, NULL, NULL, NULL, NULL, 19.40, 0, 0, NULL, '1XU10223GU917663T', NULL, 'web_accept', 'Completed', NULL, '23:41:13 Jul 19, 2012 PDT', '20.00', 'SGD', 'digitaldreamsdesign@yahoo.com', '2012-07-20 02:41:16', '2012-07-20 02:41:16'),
(105, 104, 75, 10, 10, NULL, NULL, NULL, NULL, 0.60, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:41:16', '2012-07-20 02:41:16'),
(106, 0, 1, 10, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, -15.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:42:19', '2012-07-20 02:42:19'),
(107, 106, 4, 10, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 13.50, 1, 0, 'Deal owner share received (13.5), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:42:19', '2012-07-20 02:42:19'),
(108, 106, 3, 10, 2, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 1.50, 1, 0, 'Bank share received (1.5), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:42:19', '2012-07-20 02:42:19'),
(109, 106, 10, 2, 4, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.30, 1, 0, 'User level(5) commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:42:19', '2012-07-20 02:42:19'),
(110, 106, 9, 2, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.30, 1, 0, 'Agent commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:42:19', '2012-07-20 02:42:19'),
(111, 106, 11, 2, 2, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.90, 0, 0, 'Bank real share received (0.9), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 02:42:19', '2012-07-20 02:42:19'),
(112, 0, 0, 22, 22, NULL, NULL, NULL, NULL, 29.10, 0, 0, NULL, '1PY55762F1728761R', NULL, 'web_accept', 'Completed', NULL, '00:31:46 Jul 20, 2012 PDT', '30.00', 'SGD', 'hassynergy@yahoo.com.sg', '2012-07-20 03:31:51', '2012-07-20 03:31:51'),
(113, 112, 75, 22, 22, NULL, NULL, NULL, NULL, 0.90, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 03:31:51', '2012-07-20 03:31:51'),
(114, 0, 1, 22, 22, 8, '3 For 1!', 29.70, 1, -29.70, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 03:32:26', '2012-07-20 03:32:26'),
(115, 114, 4, 22, 22, 8, '3 For 1!', 29.70, 1, 22.27, 1, 0, 'Deal owner share received (22.27), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 03:32:26', '2012-07-20 03:32:26'),
(116, 114, 3, 22, 2, 8, '3 For 1!', 29.70, 1, 7.43, 1, 0, 'Bank share received (7.43), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 03:32:26', '2012-07-20 03:32:26'),
(117, 114, 10, 2, 5, 8, '3 For 1!', 29.70, 1, 1.49, 1, 0, 'User level(5) commission received (1.49), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 03:32:26', '2012-07-20 03:32:26'),
(118, 114, 9, 2, 22, 8, '3 For 1!', 29.70, 1, 1.49, 1, 0, 'Agent commission received (1.49), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 03:32:26', '2012-07-20 03:32:26'),
(119, 114, 11, 2, 2, 8, '3 For 1!', 29.70, 1, 4.45, 0, 0, 'Bank real share received (4.45), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 03:32:26', '2012-07-20 03:32:26'),
(120, 83, 5, 2, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 13.50, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-02 06:14:45', '2012-08-02 06:14:45'),
(121, 0, 1, 17, 17, 2, 'Size S Black Cotton WinMaWeb T-Shirt', 15.00, 1, -15.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-03 14:53:00', '2012-08-03 14:53:00'),
(122, 121, 4, 17, 17, 2, 'Size S Black Cotton WinMaWeb T-Shirt', 15.00, 1, 13.50, 1, 0, 'Deal owner share received (13.5), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-03 14:53:00', '2012-08-03 14:53:00'),
(123, 121, 3, 17, 2, 2, 'Size S Black Cotton WinMaWeb T-Shirt', 15.00, 1, 1.50, 1, 0, 'Bank share received (1.5), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-03 14:53:00', '2012-08-03 14:53:00'),
(124, 121, 10, 2, 4, 2, 'Size S Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.30, 1, 0, 'User level(5) commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-03 14:53:00', '2012-08-03 14:53:00'),
(125, 121, 9, 2, 17, 2, 'Size S Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.30, 1, 0, 'Agent commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-03 14:53:00', '2012-08-03 14:53:00'),
(126, 121, 11, 2, 2, 2, 'Size S Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.90, 0, 0, 'Bank real share received (0.9), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-03 14:53:00', '2012-08-03 14:53:00'),
(127, 0, 0, 133, 133, NULL, NULL, NULL, NULL, 15.00, 0, 0, NULL, '7E157970K0583030F', NULL, 'web_accept', 'Completed', NULL, '16:57:30 Aug 03, 2012 PDT', '15.46', 'SGD', 'sanangelotarns@wtxs.net', '2012-08-03 19:57:33', '2012-08-03 19:57:33'),
(128, 127, 75, 133, 133, NULL, NULL, NULL, NULL, 0.46, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-03 19:57:33', '2012-08-03 19:57:33'),
(129, 0, 0, 133, 133, NULL, NULL, NULL, NULL, 24.25, 0, 0, NULL, '95734775EA7950302', NULL, 'web_accept', 'Completed', NULL, '17:01:31 Aug 03, 2012 PDT', '25.00', 'SGD', 'sanangelotarns@wtxs.net', '2012-08-03 20:01:38', '2012-08-03 20:01:38'),
(130, 129, 75, 133, 133, NULL, NULL, NULL, NULL, 0.75, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-03 20:01:38', '2012-08-03 20:01:38'),
(131, 0, 1, 133, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, -15.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-04 08:28:43', '2012-08-04 08:28:43'),
(132, 131, 4, 133, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 13.50, 1, 0, 'Deal owner share received (13.5), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-04 08:28:43', '2012-08-04 08:28:43'),
(133, 131, 3, 133, 2, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 1.50, 1, 0, 'Bank share received (1.5), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-04 08:28:43', '2012-08-04 08:28:43'),
(134, 131, 10, 2, 5, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.30, 1, 0, 'User level(5) commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-04 08:28:43', '2012-08-04 08:28:43'),
(135, 131, 9, 2, 17, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.30, 1, 0, 'Agent commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-04 08:28:43', '2012-08-04 08:28:43'),
(136, 131, 11, 2, 2, 2, 'Size L Black Cotton WinMaWeb T-Shirt', 15.00, 1, 0.90, 0, 0, 'Bank real share received (0.9), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-04 08:28:43', '2012-08-04 08:28:43'),
(143, 0, 0, 144, 22, 9, 'ONE FOR THREE', 29.70, 1, -29.70, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-16 02:53:03', '2012-08-16 02:53:03'),
(144, 143, 4, 144, 22, 9, 'ONE FOR THREE', 29.70, 1, 22.27, 1, 0, 'Deal owner share received (22.27), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-16 02:53:03', '2012-08-16 02:53:03'),
(145, 143, 3, 144, 2, 9, 'ONE FOR THREE', 29.70, 1, 7.43, 1, 0, 'Bank share received (7.43), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-16 02:53:03', '2012-08-16 02:53:03'),
(146, 143, 10, 2, 6, 9, 'ONE FOR THREE', 29.70, 1, 1.49, 1, 0, 'User level(5) commission received (1.49), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-16 02:53:03', '2012-08-16 02:53:03'),
(147, 143, 9, 2, 22, 9, 'ONE FOR THREE', 29.70, 1, 1.49, 1, 0, 'Agent commission received (1.49), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-16 02:53:03', '2012-08-16 02:53:03'),
(148, 143, 11, 2, 2, 9, 'ONE FOR THREE', 29.70, 1, 4.45, 1, 0, 'Bank real share received (4.45), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-16 02:53:03', '2012-08-16 02:53:03'),
(149, 0, 0, 10, 10, NULL, NULL, NULL, NULL, 9.70, 0, 0, NULL, '9N42200814955782A', NULL, 'web_accept', 'Completed', NULL, '23:21:06 Aug 16, 2012 PDT', '10.00', 'SGD', 'radu.d_1336565523_per@digitaldreamsdesign.net', '2012-08-17 02:21:10', '2012-08-17 02:21:10'),
(150, 149, 75, 10, 10, NULL, NULL, NULL, NULL, 0.30, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-17 02:21:10', '2012-08-17 02:21:10'),
(151, 0, 0, 10, 10, NULL, NULL, NULL, NULL, 1.94, 0, 0, NULL, '43U134412P450261F', NULL, 'web_accept', 'Completed', NULL, '23:26:58 Aug 16, 2012 PDT', '2.00', 'SGD', 'digitaldreamsdesign@yahoo.com', '2012-08-17 02:27:01', '2012-08-17 02:27:01'),
(152, 151, 75, 10, 10, NULL, NULL, NULL, NULL, 0.06, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-17 02:27:01', '2012-08-17 02:27:01'),
(153, 0, 0, 8, 8, NULL, NULL, NULL, NULL, 48.50, 0, 0, NULL, '4MN082240H800363P', NULL, 'web_accept', 'Completed', NULL, '04:23:06 Aug 17, 2012 PDT', '50.00', 'SGD', 'jgoovaerts@hotmail.com', '2012-08-17 07:23:16', '2012-08-17 07:23:16'),
(154, 153, 75, 8, 8, NULL, NULL, NULL, NULL, 1.50, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-17 07:23:16', '2012-08-17 07:23:16'),
(161, 0, 1, 17, 8, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, -15.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 07:42:45', '2012-08-20 07:42:45'),
(162, 161, 4, 17, 8, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, 13.50, 1, 0, 'Deal owner share received (13.5), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 07:42:45', '2012-08-20 07:42:45'),
(163, 161, 3, 17, 2, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, 1.50, 1, 0, 'Bank share received (1.5), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 07:42:45', '2012-08-20 07:42:45'),
(164, 161, 10, 2, 4, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, 0.30, 1, 0, 'User level(5) commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 07:42:45', '2012-08-20 07:42:45'),
(165, 161, 9, 2, 17, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, 0.30, 1, 0, 'Agent commission received (0.3), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 07:42:45', '2012-08-20 07:42:45'),
(166, 161, 11, 2, 2, 4, 'Black Embroidered WinMaWeb Ball Cap', 15.00, 1, 0.90, 0, 0, 'Bank real share received (0.9), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 07:42:45', '2012-08-20 07:42:45'),
(227, 0, 1, 17, 17, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, -7.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 08:09:25', '2012-08-20 08:09:25'),
(228, 227, 4, 17, 17, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, 6.30, 1, 0, 'Deal owner share received (6.3), this will remain in stand-by, until the deal owner use the coupon code', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 08:09:25', '2012-08-20 08:09:25'),
(229, 227, 3, 17, 2, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, 0.70, 1, 0, 'Bank share received (0.7), this will be split in other transactions, to see how much each person get', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 08:09:25', '2012-08-20 08:09:25'),
(230, 227, 10, 2, 4, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, 0.14, 1, 0, 'User level(5) commission received (0.14), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 08:09:25', '2012-08-20 08:09:25'),
(231, 227, 9, 2, 17, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, 0.14, 1, 0, 'Agent commission received (0.14), this will be sent in virtual_wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 08:09:25', '2012-08-20 08:09:25'),
(232, 227, 11, 2, 2, 1, 'Exclusive WinMaWeb Key Chain', 7.00, 1, 0.42, 0, 0, 'Bank real share received (0.42), this will be sent in wallet', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-20 08:09:25', '2012-08-20 08:09:25'),
(233, 0, 65, 9, 9, NULL, NULL, NULL, NULL, 14.00, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-28 09:21:29', '2012-08-28 09:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE IF NOT EXISTS `tree` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_content` text,
  `content` text,
  `root_id` bigint(20) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `level` smallint(6) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tree_sluggable_idx` (`slug`,`lft`,`rgt`,`level`,`root_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`id`, `name`, `meta_title`, `meta_content`, `content`, `root_id`, `lft`, `rgt`, `level`, `slug`) VALUES
(1, 'Pages', NULL, NULL, NULL, 1, 1, 18, 0, 'pages'),
(2, 'Static', NULL, NULL, NULL, 1, 2, 17, 1, 'static'),
(3, 'Right - dont forget', NULL, NULL, NULL, 1, 13, 14, 2, 'right-dont-forget'),
(4, 'Footer - about us', NULL, NULL, NULL, 1, 11, 12, 2, 'footer-about-us'),
(5, 'Terms And Conditions', 'terms and conditions', 'WinMaWeb Terms & Conditions with Refund and Privacy Policies', 'Terms and Conditions\n\n1. General Information\n\n1.1 You are reading a legal document which is the agreement between you, the Customer (whom we refer to as "you", "your" or the "Customer" in this document) and us. We are GLOBAL MARKETING 3000 PTE. LTD. and we are the owner of the WinMaWeb website. We are a company registered in Singapore with our registered office at 16 RAFFLES QUAY #33-03 HONG LEONG BUILDING SINGAPORE (048581) (and we refer to ourselves as " WinMaWeb", "Global Marketing 3000 ", "we", "us","our" or &ldquo;company&rdquo; in this document). Our Company Number is 201204928Z.\n\n1.2 Please read this agreement carefully. By browsing, accessing or using this website or by using any facilities or services made available through it or by transacting through or on it, you are agreeing to the terms and conditions that appear below (all of which are called the "Agreement"). This Agreement is made between you and us.\n\n1.3 These Terms and Conditions were most recently updated on 16 July, 2012 (version 1.4). We reserve the right to amend these terms and conditions at any time. All amendments to these terms and conditions will be posted on-line. You may terminate this Agreement by written notice to us (by post or by email at support@winmaweb.com) if you do not wish to be bound by such new terms and conditions. However, your continued use of the Service or the Website or a Voucher will be deemed to constitute your acceptance of the new terms and conditions.\n\n1.4 Your statutory rights: As a consumer, nothing in this Agreement affects your non-excludable statutory rights.\n \n2. DEFINITIONS\n2.1 In this Agreement, we use various defined terms. You will know they are defined because they begin with a capital letter. This is what they mean:\n\n2.1.1 "Register" means to register as a Member of WinMaWeb through the creation of a Membership Account on the WinMaWeb system (and "Registration" means the action of creating an account). \n2.1.2 &ldquo;Member&rdquo; means any individual whose registration has been accepted\n\n2.1.3 "Merchant" means a Member acting as seller of goods and/or services for which a Voucher can be redeemed.\n2.1.4 &ldquo;Purchaser&rdquo; means a Member who purchases a Voucher on the WinMaWeb website. (and "Purchase" means the act of purchasing a voucher)\n\n2.1.5 "Voucher" means a voucher which is subject to terms and conditions, which when purchased allows the Purchaser (but not anyone else) to redeem it in exchange for Voucher Products offered by that Merchant.\n2.1.6 "Voucher Products" means goods and/or services offered by a particular Merchant which are described within the Voucher.\n2.1.7 "Service" means all or any of the services provided by Global Marketing 3000 via the Website (or via other electronic or other communication from Global Marketing 3000) including the information services, content and transaction capabilities on the Website (including the ability to make a Purchase).\n\n2.1.8 "Website" or &ldquo;Site&rdquo; means the winmaweb.com website and any Microsite. \n2.1.9 "Microsite" means an auxiliary website supplementary to our main website. \n\n2.2.0 &ldquo;Levels&rdquo; and &ldquo;Tiers&rdquo; are meant to describe the network of users beyond your own who you have referred to the website, or who have been referred by those whom you have referred before. The terms &ldquo;Level&rdquo;/&rdquo;Levels&rdquo; and &ldquo;Tier&rdquo;/&rdquo;Tiers&rdquo; are interchangeable in this agreement and thus refer to the same thing.\n\n3. GENERAL ISSUES ABOUT THIS WEBSITE AND THE SERVICE\n\n3.1 Use of the Service and the Website and any Purchase are each subject to the terms and conditions set out in this Agreement.\n\n3.2 To use the Website and/or the Service (whether with or without registration) and to make any Purchase, you must be 18 years of age or over.\n\n3.3 The Website and the Service and any Purchase are directed solely at those who access the Website from Singapore. We make no representation that the Service (or any goods or services) are available or otherwise suitable for use outside of Singapore. If you choose to access the Website (or use the Service or make a Purchase) from locations outside Singapore, you do so on your own initiative and are responsible for the consequences and for compliance with all applicable laws.\n\n3.4 The Website, Service and any Purchase are for your non-commercial, personal use only and must not be used for business purposes. The only permissible commercial use of the Website and Service is for a Member acting as an Agent and/or Merchant, to refer others to join as members or introduce an offer of Voucher Products. For the avoidance of doubt, scraping of the Website, any copying of the Website (in full or in part), orany hacking of the Website is not allowed.\n\n3.5 We reserve the right to prevent you from using the Website and the Service (or any part of them) and to prevent you from making any Purchase.\n\n3.6 The Service and use of the Website and the making of any Purchase does not include the provision of a computer or other necessary equipment to access the Website or the Service or making of any Purchase. To use the Website or Service or to make a Purchase, you will require Internet connectivity and appropriate telecommunication links. We shall not be liable for any telephone costs, telecommunications costs or other costs that you may incur through such use.\n\n4. REGISTRATION AND CREDIT ACCOUNTS\n\n4.1 You must Register as a Member on the WinMaWeb system in order to either Purchase a Voucher or, as a Merchant, to offer goods or services as Voucher Products. We reserve the right to decline a new Registration or to cancel an account at any time.\n\n4.2 To Register you need to supply us with your full name, postcode, email address, payment details and possibly some other personal information. See our Privacy Policy for more details about this.\n\n4.2.1 Any person wishing to Register as a Member will only be accepted by WinMaWeb if they have been introduced by an existing Member. Therefore, in addition to the personal information indicated in 4.2 above you will be required to include the Referral ID of an existing member. (This provision is in place to establish the network of users within WinMaWeb.) \n4.2.2 No Member may hold more than one Member Account at any time.\n\n4.3 Once you finish Registration, we will set up your Member Account with your unique Member Account ID (also known as your User Name) and allocate a password. You must keep the password confidential and immediately notify us if any unauthorized third party becomes aware of that password or if there is any unauthorized use of your email address or any breach of security known to you. You agree that any person to whom your user name or password is disclosed is authorized to act as your agent for the purposes of using (and/or transacting via) the Service and Website. Please note that you are entirely responsible if you do not maintain the confidentiality of your password. Should you suspect that your password has been compromised in any way it is your responsibility to immediately change your password and inform WinMaWeb of the possible breach in your user security.\n\n4.3.1 When your Registration is completed you will be able to use your password to access relevant information in your Member Account in order to make a Purchase, view information on past transactions, print Vouchers or modify your preferences.\n\n4.4 All Member Accounts must be registered with a valid personal email address that you access regularly, so that, among other things, moderation emails can be sent to you. Any Member Accounts which have been registered with someone else&rsquo;s email address or with temporary email addresses may be closed without notice. We may require Members to re-validate their accounts if we believe they have been using an invalid email address.\n\n4.5 We reserve the right to close Member Accounts if any user is seen to be using proxy IPs (Internet Protocol addresses) in order to attempt to hide the use of multiple registration accounts, or if an non-SG user pretends to be a SG user, or disrupts the Website or the Service in any way.\n\n4.6 If you use multiple logins for the purpose of disrupting the WinMaWeb Website, or causing annoyance to other Members, your Member Account will be suspended or terminated and action may be taken against you.\n\n4.7 CREDITS FOR THE INTRODUCTION OF NEW MEMBERS (NETWORK COMMISSIONS), AND CREDITS FOR AGENTS BRINGING IN DEALS (AGENT COMMISSIONS)\n4.7.1 As indicated in 4.2.1 above any new Member may only complete their Registration if they have been introduced by an existing Member already Registered on the WinMaWeb System. \n \n4.7.2 The WinMaWeb system records all Member Accounts in a linked series of Levels we refer to as &ldquo;Tiers&rdquo;. The Member Account of any new Members introduced by you will be linked to your own Member Account and be located at the next Tier down in the WinMaWeb system.\n4.7.3 When an existing Member wishes to act as an Agent and introduces a new Member wishing to offer Voucher Products the publication of that offer on the Website is subject to the prior approval of WinMaWeb.\n4.7.3.1 With regard to any Merchant offer of Voucher Products by a Member directly introduced by you, you will receive a Credit to your WinMaWeb Member Account amounting to 20% of the WinMaWeb share of the purchase price of all Vouchers. This Credit will appear in your Member Account under Transactions menu, Received Transactions page automatically after two conditions are met: 1) A waiting period of 14 days after the purchase has elapsed, and 2) the Merchant cashes in the Voucher on the WinMaWeb system. We refer to these credit commissions as &ldquo;Agent Commissions&rdquo;.\n4.7.3.2 Any Members introduced by you will be eligible to introduce further new Members and these would be linked to your own Member Account at the second Tier beyond your own in the WinMaWeb system. Subsequent introductions of new Members by those at the second Level beyond yours will be linked to your member Account at one further Level (the third Tier) beyond yours, and so on for subsequent introductions. WinMaWeb will maintain these links between various Levels in order to monitor the expansion and operation of its systems. \n4.7.3.3 In order that all WinMaWeb Members may benefit from growth in the number of Members using the system you will receive a Credit of 20% of the WinMaWeb share of the purchase price of all Vouchers cashed in from all members inthe fifth Tier beyond your own. These amounts will automatically be credited to your account and viewable under the My Account menu, Transactions menu, Network Transactions page after two conditions are met: : 1) A waiting period of 14 days after the purchase has elapsed, and 2) the Merchant cashes in the Voucher on the WinMaWeb system. We refer to these credit commissions as &ldquo;Network Commissions&rdquo;.\n4.7.4. When you log on to the Website you will be able to view details in your Member Account which will show not only your own transactions but also transactions at other Levels in Member Accounts linked to your own. Your Member Account will show the value of any Credits available to you under Clauses 4.7.3.1 (Agent Commissions) and 4.7.3.3 (Network Commissions) above.\n4.7.4.1. You will be able to make decisions and manage any Credits directly within your Member Account. Your credits may fall into two separate categories. Credits in My Wallet may be directly withdrawn and transferred to cash. Credits in the WinMaWeb Account may not be transferred to your My Wallet. Credits in the WinMaWeb Account may only be used to purchase Vouchers or make Donations on the WinMaWeb system. Your credits from either your My Wallet or the WinMaWeb Account may be used to purchase Vouchers or make Donations on the system. If you choose to make a donation, the money will be donated directly to one of the charities linked to the system. WinMaWeb will endeavor to provide members with a range of charitable organizations for you to choose from. For these purposes such donations to a charity do not qualify as a Purchase of Vouchers and no Network Commissions nor Agent Commissions are paid out. \n4.7.4.2. Should the Purchaser refund money that originally came from the WMW Account then the credits will be placed back into the WinMaWeb Account. \n4.7.5. Any benefits you derive from Credits from your Membership of the WinMaWeb system are by way of commission and it is therefore the responsibility of Members to account for, and pay, any tax liability to the appropriate authorities.\n4.7.6 Agent Commissions and Network Commissions will be paid out to the appropriate members when two criteria have been fulfilled:\n 4.7.6.1 After a period of 14 days have passed since the Voucher was purchased on the system.\n 4.7.6.2 After the Merchant cashes in the voucher.\n\n4.7.7 When commissions are paid out, 80% of the commission will be paid directly into the My Wallet, while the other 20% of the commission will be paid into the WinMaWeb Account.\n\n5. PURCHASE OF VOUCHERS AND REFUND POLICY\n\n5.1 Need for registration: Global Marketing 3000 sells Vouchers via the Website that can be redeemed for Voucher Products from a Merchant. You must Register in order to make a Purchase from the Website.\n\n5.2 As a condition of Purchase, we reserve the right to send you administrative and promotional emails. We may also send you information regarding your account activity and purchases, as well as updates about the Website and Service and Vouchers as well as other promotional offers. (You can always opt-out of our promotional e-mails at any time by clicking the unsubscribe&rsquo; link at the bottom of any of such e-mail correspondence.)\n\n5.3 When a Voucher transaction is complete: When you go through the procedure for purchasing a Voucher, after you have confirmed your acceptance to these terms and conditions and after we have taken payment (by debit card, credit card, Paypal transfer, or any other legal means) the transaction is complete (and a contract for Purchase is made) only when we email you confirming the transaction (which is our acceptance of the transaction). We keep a copy of the contract between us - and you are welcome to print out these terms and conditions from our website as a record.\n\n5.4 Right to cancel: Once you have the Voucher under My Account menu, Transactions menu, My Voucher page you may cancel the transaction at any time up to within 7 working days after the purchase date of the Voucher. (where a working day is any day that is not a Saturday, Sunday or English public holiday). If you do want to cancel, you must do so by sending us an email to tell us you are cancelling to: support@winmaweb.com or writing to us or sending us a fax - in each case, always provided of course that you have not yet redeemed the Voucher.\n\n5.4.1 If you Purchase a Voucher it will be available for you to print immediately once the deal has been activated. You may cancel the Voucher and the transaction, and obtain a credit refund to your WinMaWeb Account, at any time within 7 working days from the purchase date of the Voucher. (where a working day is any day that is not a Saturday, Sunday or English public holiday).\n\n5.4.1.1 Any and all refunds will be made and credited to your WinMaWeb Account and any and all monies credited in the WinMaWeb account are subject to the terms and conditions set forth in this agreement (please see 4.7.4.1 in this agreement)\n\n5.5 By making a Purchase, you acknowledge that the Purchase is made subject to this Agreement.\n\n5.6 Once you have made a Purchase, the Voucher is redeemable by You at the Merchant for Voucher Products provided by that Merchant. The particular Merchant and particular goods and services offered by that Merchant for which the Voucher can be redeemed will be stated on the Voucher. Any attempted redemption of a Voucher not consistent with this Agreement may render a Voucher void at our (or a Merchant&rsquo;s) discretion.\n\n5.7 RESPONSIBILITY: The Merchant, and not Global Marketing 3000, is:\n\n5.7.1 the seller of the Voucher Products;\n\n5.7.2 solely responsible for providing you with the Voucher Products and for the Voucher Products themselves; and\n\n5.7.3 solely responsible for redeeming any Voucher you Purchase.\n\n5.8 Restrictions: (i) Reproduction, sale, resale or trade of a Voucher is prohibited. Any attempt to carry out any of these will potentially void the Voucher at our discretion. (ii) If, for any reason, the Voucher is redeemed for less than its face value, there is no entitlement to a credit, cash or new Voucher equal to the difference between the face value and the amount redeemed. Also, Vouchers are redeemable in their entirety only and may not be redeemed incrementally.\n\n5.9 It is at the discretion of the Merchant to determine whether Vouchers can be combined with any other promotions, vouchers, third party certificates or coupons. Normally though, this will not be allowed by the Merchant and the Purchaser should assume that no other deals or promotions may be mixed with the use of a Voucher.\n\n5.10 Neither we nor the Merchant are responsible for lost or stolen Vouchers or Voucher reference numbers. It is the responsibility of the Purchaser to keep the Voucher and voucher code both safe and secure from loss or theft, by means either physical or electronic.\n\n5.11 The Voucher (including, but not limited to, any discounts provided by the Voucher) expires on the date specified on the Voucher.\n\n5.12 All Vouchers are promotional vouchers that are offered for Purchase below their face value and are subject to this Agreement and to any terms and conditions of the relevant Merchant.\n\n5.13 Currently the sale of Vouchers by us is not subject to VAT. If SG VAT law changes we reserve the right to charge you VAT in addition to the price for the Vouchers.\n\n\n6. YOUR OBLIGATIONS\n\n6.1 Merchant terms: Merchants will have their own applicable terms and conditions, in relation to their own supply of their goods and services, and you agree to (and shall) abide by those terms and conditions. The responsibility to do so is yours alone.\n\n6.2 Accurate information: You warrant that all information provided on Registration and contained as part of your account during the course of this Agreement is true, complete and accurate and that you will promptly inform us of any changes to such information by updating the details in your account.\n\n6.3 Content on the Website and Service and Vouchers: It is your responsibility to ensure that any products, services or information available through the Website or the Service meet your specific requirements.\n\n6.4 Things you cannot do: Without limitation, you undertake not to use or permit anyone else to use the Service or Website:\n\n6.4.1 to send or receive any material which is not civil or tasteful;\n\n6.4.2 to send or receive any material which is threatening, grossly offensive, of an indecent, obscene or menacing character, blasphemous or defamatory of any person, in contempt of court or in breach of confidence, copyright, rights of personality, publicity or privacy or any other third party rights;\n\n6.4.3 to send or receive any material for which you have not obtained all necessary licences and/or approvals (from us or third parties); or which constitutes or encourages conduct that would be considered a criminal offence, give rise to civil liability, or otherwise be contrary to the law of or infringe the rights of any third party in any country in the world;\n\n6.4.4 to send or receive any material which is technically harmful (including computer viruses, logic bombs, Trojan horses, worms, harmful components, corrupted data or other malicious software or harmful data);\n\n6.4.5 to cause annoyance, inconvenience or needless anxiety;\n\n6.4.6 to intercept or attempt to intercept any communications transmitted by way of a telecommunications system;\n\n6.4.7 for a purpose other than which we have designed them or intended them to be used;\n\n6.4.8 for any fraudulent purpose;\n\n6.4.9 other than in conformance with accepted Internet practices and practices of any connected networks; or\n\n6.4.10 in any way which is calculated to incite hatred against any ethnic, religious or any other minority or is otherwise calculated to adversely affect any individual, group or entity.\n\n6.5 Forbidden uses: The following uses of the Service (and Website) and Vouchers are expressly prohibited and you undertake not to do (or to permit anyone else to do) any of the following:\n\n6.5.1 resale of the Service (or Website) or any Voucher;\n\n6.5.2 furnishing false data including false names, addresses and contact details and fraudulent use of credit/debit card numbers;\n\n6.5.3 attempting to circumvent our security or network including accessing data not intended for you, logging into a server or account you are not expressly authorised to access, or probing the security of other networks (such as, but not limited to, running a port scan);\n\n6.5.4 accessing the Service (or Website) in such a way as to, or commit any act that would or does, impose an unreasonable or disproportionately large load on our infrastructure;\n\n6.5.5 executing any form of network monitoring which will intercept data not intended for you;\n\n6.5.6 sending unsolicited mail messages, including the sending of "junk mail" or other advertising material to individuals who did not specifically request such material. You are explicitly prohibited from sending unsolicited bulk mail messages. This includes bulk mailing of commercial advertising, promotional, or informational announcements, and political or religious tracts. Such material may only be sent to those who have explicitly requested it. If a recipient asks to stop receiving email of this nature, you may not send that person any further email; \n\n6.5.7 creating or forwarding "chain letters" or other "pyramid schemes" of any type, whether or not the recipient wishes to receive such mailings; \n\n6.5.8 sending malicious email, including, but not limited to, flooding a user or site with very large or numerous emails;\n\n6.5.9 entering into fraudulent interactions or transactions with us or a Merchant (which shall include entering into interactions or transactions purportedly on behalf of a third party where you have no authority to bind that third party or you are pretending to be a third party);\n\n6.5.10 using the Service or Website (or any relevant functionality of either of them) in breach of this Agreement;\n\n6.5.11 unauthorised use, or forging, of mail header information;\n\n6.5.12 engage in any unlawful activity in connection with the use of the Website and/or the Service or any Voucher; or\n\n6.5.13 engage in any conduct which, in our exclusive reasonable opinion, restricts or inhibits any other customer from properly using or enjoying the Website and Service.\n\n7. RULES ABOUT USE OF THE SERVICE AND THE WEBSITE\n\n7.1 We will use reasonable endeavors and to the best of our ability work to correct any errors or omissions as soon as practicable after being notified of them. However, we do not guarantee that the Service or the Website will be free of faults (or Vouchers will be free of error) and we do not accept liability for any errors or omissions. In the event of an error or fault, you should report it by email to: support@winmaweb.com. \n\n7.2 We do not warrant that your use of the Service or the Website will be uninterrupted and we do not warrant that any information (or messages) transmitted via the Service or the Website will be transmitted accurately, reliably, in a timely manner or at all.\n\n7.3 We do not give any warranty that the Service or the Website is free from viruses or anything else which may have a harmful effect on any technology.\n\n7.4 Also, although we will try to allow uninterrupted access to the Service and the Website, access to the Service and the Website may be suspended, restricted or terminated at any time.\n\n7.5 We reserve the right to change, modify, substitute, suspend or remove without notice any information or Voucher or service on the Website or forming part of the Service from time to time. Your access to the Website and/or the Service may also be occasionally restricted to allow for repairs, maintenance or the introduction of new facilities or services. We will attempt to restore such access as soon as we reasonably can. We assume no responsibility for functionality which is dependent on your browser or other third party software to operate (including, without limitation, RSS feeds). For the avoidance of doubt, we may also withdraw any information or Voucher from the Website or Service at any time.\n\n7.6 We reserve the right to block access to and/or to edit or remove any material which in our reasonable opinion may give rise to a breach of any of this Agreement.\n\n8. SUSPENSION AND TERMINATION\n\n8.1 If you use (or anyone other than you, with your permission uses) the Website or Service or a Voucher in contravention of this Agreement, we may suspend your use of the Service and/or Website (in whole or in part) and/or a Voucher.\n\n8.2 If we suspend the Service or Website or a Voucher, we may refuse to restore the Service or Website or Voucher until we receive an assurance from you, in a form we deem acceptable that there will be no further breach of the provisions of this Agreement.\n\n8.3 Global Marketing 3000 shall fully co-operate with any law enforcement authorities or court order requesting or directing Global Marketing 3000 to disclose the identity or locate anyone in breach of this Agreement.\n\n8.4 Without limitation to anything else in this Clause 8, we shall be entitled immediately or at any time (in whole or in part) to: i) suspend the Service and/or Website; ii) suspend your use of the Service and/or Website; iii) suspend the use of the Service and/or Website for persons we believe to be connected (in whatever manner) to you; and/or iv) terminate this Agreement immediately if:\n\n8.4.1 you commit any breach of this Agreement;\n\n8.4.2 we suspect, on reasonable grounds, that you have, might or will commit a breach of these terms; or\n\n8.4.3 we suspect, on reasonable grounds, that you may have committed or be committing any fraud against us or any person.\n\n8.5 Notwithstanding anything else in this Clause 8, we may terminate this Agreement at any time.\n\n8.6 Our right to terminate this Agreement shall not prejudice any other right or remedy we may have in respect of any breach or any rights, obligations or liabilities accrued prior to termination.\n\n9. INDEMNITY\n\n9.1 You shall indemnify us against each loss, liability or cost incurred by us arising out of:\n\n9.1.1 any claims or legal proceedings which are brought or threatened against us by any person arising from:\n\na) your use of the Service or Website;\nb) the use of a Voucher;\nc) the use of the Service or Website through your password; or\n\n9.1.2 any breach of this Agreement by you.\n\n10. STANDARDS AND LIMITATION OF LIABILITY\n\n10.1 We warrant that:\n\n10.1.1 we will exercise reasonable care and skill in performing any obligation under this Agreement, and\n\n10.1.2 we have the right to sell Vouchers and that Vouchers are of satisfactory quality and fit for their purpose.\n\n10.2 This Clause 10 (and Clause 1.4) prevails over all other Clauses and sets forth our entire Liability, and your sole and exclusive remedies in respect of:\n\n10.2.1 the performance, non-performance, purported performance or delay in performance of this Agreement or the Service or Website (or any part of it or them); or\n\n10.2.2 otherwise in relation to this Agreement or the entering into or performance of this Agreement.\n\n10.3 Nothing in this Agreement shall exclude or limit our Liability for (i) fraud; (ii) death or personal injury caused by our Breach of Duty; (iii) any breach of the obligations implied by ss.12 and 14 Sale of Goods Act 1979 or s.2 Supply of Goods and Services Act 1982; or (iv) any other Liability which cannot be excluded or limited by applicable law (including, without limitation liability pursuant to Clause 1.4).\n\n10.4 We do not warrant and we exclude all Liability in respect of:\n\n10.4.1 the accuracy, completeness, fitness for purpose or legality of any information accessed using the Service or Website or otherwise; and\n\n10.4.2 the transmission or the reception of or the failure to transmit or to receive any material of whatever nature; and\n\n10.4.3 your use of any information or materials on the Website (which is entirely at your own risk and it is your responsibility);\n\n10.4.4 Voucher Products for which Vouchers may be redeemed and in respect of the quality, safety, usability or any other aspect of the products or services in respect of which is Voucher may be redeemed).\n\n10.5 Save as provided in Clause 10.3 but subject to Clause 10.6, we do not accept and hereby exclude any Liability for loss of or damage to your (or any person&rsquo;s) tangible property other than that caused by our Breach of Duty.\n\n10.6 Save as provided in Clause 10.3 but subject to Clauses 10.4.3 and 10.8, our Liability for loss of or damage to your (or another person&rsquo;s) tangible property caused by us, our employees, subcontractors or agents acting within the course of their employment during the performance of this Agreement, shall not exceed S$10. Neither corruption of data nor loss of data shall constitute physical damage to property for the purposes of this Clause 10.6.\n\n10.7 Save as provided in Clauses 10.3 and 10.4.3, we do not accept and hereby exclude any Liability for Breach of Duty other than any such Liability arising pursuant to the terms of this Agreement.\n\n10.8 Save as provided in Clause 10.3, we shall have no Liability for:\n\n10.8.1 loss of revenue;\n\n10.8.2 loss of actual or anticipated profits;\n\n10.8.3 loss of contracts;\n\n10.8.4 loss of the use of money;\n\n10.8.5 loss of anticipated savings;\n\n10.8.6 loss of business;\n\n10.8.7 loss of opportunity;\n\n10.8.8 loss of goodwill;\n\n10.8.9 loss of reputation;\n\n10.8.10 loss of, damage to or corruption of data; or\n\n10.8.11 any indirect or consequential loss;and such Liability is excluded whether it is foreseeable, known, foreseen or otherwise. For the avoidance of doubt, Clauses 10.8.1 to 10.8.10 apply whether such losses are direct, indirect, consequential or otherwise.\n\n10.9 Save as provided in Clause 10.3, our total Liability to you or any third party shall in no circumstances exceed, in aggregate, a sum equal to the greater of: a) S$50; or b) 110% of any aggregate amount paid by you to us in the 12 months preceding any cause of action arising.\n\n10.10 The limitation of Liability under Clause 10.9 has effect in relation both to any Liability expressly provided for under this Agreement and to any Liability arising by reason of the invalidity or unenforceability of any term of this Agreement.\n\n10.11 In this Clause 10:\n\n10.11.1 "Liability" means liability in or for breach of contract, Breach of Duty, misrepresentation, restitution or any other cause of action whatsoever relating to or arising under or in connection with this Agreement, including, without limitation, liability expressly provided for under this Agreement or arising by reason of the invalidity or unenforceability of any term of this Agreement (and for the purposes of this definition, all references to "this Agreement" shall be deemed to include any collateral contract); and\n\n10.11.2 "Breach of Duty" means the breach of any (i) obligation arising from the express or implied terms of a contract to take reasonable care or exercise reasonable skill in the performance of the contract or (ii) common law duty to take reasonable care or exercise reasonable skill (but not any stricter duty).\n\n11. DATA PROTECTION AND PRIVACY POLICY\n\n11.1 Acceptance of Privacy Policy and Modifications Acceptance\nBy using the Website, including purchasing Vouchers through our Site you hereby consent to our collection, use and disclosure of your information as described in this Privacy Policy. \nWe reserve the right to make changes to our Privacy Policy or practices at any given time without prior notice. By visiting our Site, you are acknowledging and accepting our Terms and Conditions and this Privacy Policy. Your continued use of the Site after changes have been posted to the Privacy Policy will constitute your acceptance of such changes for any new personal data that you may supply to us after the change is posted. (Also see 1.3 in Terms and Conditions above.)\nWe recognize the importance of protecting the privacy of personal information. We have instituted strict policies and security measures to protect your information and will not share your personal information with any third party unless legally bound to do so by court order from a competent court of law operating within jurisdictional matters in the country of Singapore. \n\n12. ADVERTISEMENTS\n\n12.1 We may place advertisements in different locations on the Website and at different points during use of the Service. These locations and points may change from time to time - but we will always clearly mark which goods and services are advertisements (i.e. from persons other than us), so that it is clear to you which goods and services are provided on an objective basis and which are not (i.e. the advertisements).\n\n12.2 You are free to select or click on advertised goods and services or not as you see fit.\n\n12.3 Any advertisements may be delivered on our behalf by a third party advertising company.\n\n12.4 No personal data (for example your name, address, email address or telephone number) will be used during the course of serving our advertising, but, on our behalf, our third-party advertiser or affiliate may place or recognise a unique "cookie" on your browser (see our Privacy Policy here about this). This cookie will not collect personal data about you nor is it linked to any personal data about you. If you would like more information about this practice and to know your choices about not having this information used by any company, see our Privacy Policy here about this which you can click on for more information.\n\n\n13. LINKS TO AND FROM OTHER WEBSITES\n\n13.1 Where the Website contains links to third party sites and to resources provided by third parties (together "Other Sites"), those Other Sites are merely linked to provide information only and are solely for your convenience. We have no control over and do not accept and we assume no responsibility for Other Sites or for the content or products or services of Other Sites (including, without limitation, relating to social networking sites such as, but not limited to, Facebook) and we accept no responsibility for any loss or damage that may arise from your use of them. If you decide to access any of the third party websites linked to the website, you do so entirely at your own risk.\n\n13.2 This winmaweb.com website may make available access to Microsites and if it does, it may do so within or otherwise through external hyperlinks. \n\n14. INTELLECTUAL PROPERTY RIGHTS\n\n14.1 All intellectual property rights (including all copyright, patents, trade marks, service marks, trade names, designs (including the "look and feel" and other visual or non-literal elements)) whether registered or unregistered) in the Website and Service, (subject to Clause 14.4) information content on the Website or accessed as part of the Service, any database operated by us and all the website design, text and graphics, software, photos, video, music, sound, and their selection and arrangement, and all software compilations, underlying source code and software (including applets and scripts) shall remain our property (or that of our licensors). You shall not, and shall not attempt to, obtain any title to any such intellectual property rights. All rights are reserved.\n\n14.2 None of the material listed in Clause 14.1 may be reproduced or redistributed or copied, distributed, republished, downloaded, displayed, posted or transmitted in any form or by any means, sold, rented or sub-licensed, used to create derivative works, or in any way exploited without our prior express written permission. You may, however, retrieve and display the content of the Website on a computer screen, store such content in electronic form on disk (but not on any server or other storage device connected to a network) or print one copy of such content for your own personal, non-commercial use, provided you keep intact all and any copyright and proprietary notices. You may not otherwise reproduce, modify, copy or distribute or use for commercial purposes any of the materials or content on the Website without our permission.\n\n14.3 All rights (including goodwill and, where relevant, trade marks) in the Global Marketing 3000 name are owned by us (or our licensors). Other product and company names mentioned on the Website are the trade marks or registered trade marks of their respective owners.\n\n14.4 Title, ownership rights and intellectual property rights in and to the content accessed using the Service is the property of the applicable content owner or Merchant and may be protected by applicable copyright or other law. The Agreement gives you no rights to such content.\n\n14.5 The authors of the literary and artistic works in the pages in the Website have asserted their moral rights to be identified as the author of those works.\n\n14.6 Subject to Clause 14.7, any material you transmit or post or submit to the Website (or otherwise to us) shall be considered (and we may treat it as) non-confidential and non-proprietary, subject to our obligations under data protection legislation. If for some reason, any part of that statement does not work as a matter of law, then for anything which you supply to us from whatever source (i.e. via email, the Website or otherwise) you grant us a royalty-free, perpetual, irrevocable, non-exclusive right to use, copy, modify, adapt, translate, publish and distribute world-wide any such material.\n\n14.7 All comments, suggestions, ideas, notes, drawings, concepts or other information: (i) disclosed or offered to us by you; or (ii) in response to solicitations by us regarding the Service or the Website; (in each foregoing case, these are called "Ideas") shall be deemed to be and shall remain our property and you hereby assign by way of present and future assignment all intellectual property rights in Ideas, to us. You understand and acknowledge that we have both internal resources and other external resources which may have developed or may in the future develop ideas identical to or similar to Ideas and that we are only willing to consider Ideas on these terms. In any event, any Ideas are not submitted in confidence and we assume no obligation, express or implied by considering it. Without limitation, we shall exclusively own all now known or hereafter existing rights to the Ideas of every kind and nature throughout the world and shall be entitled to unrestricted use of the Ideas for any purpose whatsoever, commercial or otherwise without compensation to the provider of the Ideas.\n\n15. GENERAL\n\n15.1 Interpretation: In this Agreement:\n\n15.1.1 words denoting persons includes natural persons, partnerships, limited liability partnerships, bodies corporate and unincorporated associations of persons;\n\n15.1.2 clause headings such as ("15. GENERAL" at the start of this Clause) and clause titles (such as "Interpretation:" at the start of this Clause 15.1) are purely for ease of reference and do not form part of or affect the interpretation of this Agreement; and&rsquo;\n\n15.1.3 references to "include" and "including" shall be deemed to mean respectively "include(s) without limitation" and "including without limitation".\n\n15.2 No partnership/agency: Nothing in this Agreement shall be construed to create a joint venture, partnership or agency relationship between you and us and neither party shall have the right or authority to incur any liability debt or cost or enter into any contracts or other arrangements in the name of or on behalf of the other.\n\n15.3 No other terms: Except as expressly stated in this Agreement, all warranties, conditions and other terms, whether express or implied, by statute, common law or otherwise are hereby excluded to the fullest extent permitted by law.\n\n15.4Assignment: You may not assign or delegate or otherwise deal with all or any of your rights or obligations under this Agreement. We shall have the right to assign or otherwise delegate all or any of our rights or obligations under this Agreement to any person.\n\n15.5 Force majeure: We shall not be liable for any breach of our obligations under this Agreement where we are hindered or prevented from carrying out our obligations by any cause outside our reasonable control, including by lightning, fire, flood, extremely severe weather, strike, lock-out, labour dispute, act of God, war, riot, civil commotion, malicious damage, failure of any telecommunications or computer system, compliance with any law, accident (or by any damage caused by any of such events).\n\n15.6 Entire agreement: This Agreement (inclusive ofour Privacy Policy) contains all the terms agreed between the parties regarding its subject matter and supersedes and excludes any prior agreement, understanding or arrangement between the parties, whether oral or in writing. No representation, undertaking or promise shall be taken to have been given or be implied from anything said or written in negotiations between the parties prior to this Agreement except as expressly stated in this Agreement. Neither party shall have any remedy in respect of any untrue statement made by the other upon which that party relied in entering into this Agreement (unless such untrue statement was made fraudulently or was as to a matter fundamental to a party&rsquo;s ability to perform this Agreement) and that party&rsquo;s only remedies shall be for breach of contract as provided in this Agreement. However, the Service is provided to you under our operating rules, policies, and procedures as published from time to time on the Website.\n\n15.7 No waiver: No waiver by us of any default of yours under this Agreement shall operate or be construed as a waiver by us of any future defaults, whether or a like or different character. No granting of time or other forbearance or indulgence by us to you shall in any way release, discharge or otherwise affect your liability under this Agreement.\n\n15.8 Notices: Unless otherwise stated within this Agreement, notices to be given to either party shall be in writing and shall be delivered by hand, electronic mail (other than, if you are sending a notice to us for the purpose of legal process) sent by fax or by pre-paid post, to you at the address you supplied to us or to us at our registered office.\n\n15.9 Third party rights: All provisions of this Agreement apply equally to and are for the benefit of Global Marketing 3000, its subsidiaries, any holding companies of Global Marketing 3000, its (or their) affiliates and its (or their) third party content providers and licensors and each shall have the right to assert and enforce such provisions directly or on its own behalf (save that this Agreement may be varied or rescinded without the consent of those parties). Subject to the previous sentence, no term of this Agreement is otherwise enforceable pursuant to the Contracts (Rights of Third Parties) Act 1999 by any person who is not a party to it.\n\n15.10 Survival: In any event, the provisions of Clauses 1, 2, 5.7, 5.8, 5.9, 5.10, 5.11, 5.12, 6.1, 9, 10, 14 and 15 of this Agreement, together with those provisions that either are expressed to survive its expiry or termination or from their nature or context it is contemplated that they are to survive such termination, shall survive termination of the Agreement. In the event you use the Website or Service again, then the provisions of the terms and conditions that then apply will govern your re-use of the Website or Service. In the event you use Vouchers bought under this Agreement, then those provisions applicable to Vouchers will survive termination of this Agreement.\n\n15.11 Severability: If any provision of this Agreement is held to be unlawful, invalid or unenforceable, that provision shall be deemed severed and where capable the validity and enforceability of the remaining provisions of this agreement shall not be affected.\n\n15.12 Governing law: This Agreement (and all non-contractual relationships between you and us) shall be governed by and construed in accordance with English law and both parties hereby submit to the exclusive jurisdiction of the courts of Singapore.\n\n\n16.MISCELLANEOUS\n\n16.1 The Website and the Service is owned and operated by Global Marketing 3000 Pte Ltd, a company registered in Singapore whose registered office is at 16 RAFFLES QUAY #33-03 HONG LEONG BUILDING SINGAPORE (048581). If you have any queries please contact Customer Services at support@winmaweb.com', 1, 9, 10, 2, 'terms-and-conditions'),
(6, 'Contact us', '', 'contact address', 'WinMaWeb cares! Please send us your feedback.', 1, 7, 8, 2, 'contact-us');
INSERT INTO `tree` (`id`, `name`, `meta_title`, `meta_content`, `content`, `root_id`, `lft`, `rgt`, `level`, `slug`) VALUES
(7, 'How its working', 'WinMaWeb', 'List of Tutorial Movies Explaining and Showing how WinMaWeb Functions', '[b]FAQ- WinMaWeb[/b] \n[b][i]What is WinMaWeb?[/i][/b] \n\nWinMaWeb is a social network dedicated to redistributing wealth back to the people. \n\n[b][i]How can WinMaWeb benefit me?[/i][/b] \n\nWinMaWeb can benefit members in many ways \n\nA) New members gain immediate access to great deals and can begin saving money. \n\nB) Members who have built up their own social network will receive an income from their 5th tier of WinMaWeb members. \n\nC) Members can become Agents by bringing in local businesses (Deals) to WinMaWeb and . Agents will receive an income each time one of those deals is sold on WinMaWeb. \n\nD) Merchants may join free and benefit from the WinMaWeb membership and free advertising on their products and services. \n\nSummary: Members are offered great deals from local businesses and can begin by saving a lot of money, members who built a network earn an income from their 5th tier, and members (agents) who recruit local businesses also earn an income. \n\n[b][i]Does it cost anything to join?[/i][/b] \n\nNo, WinMaWeb is free and always will be. It will never require a financial investment from you of your hard earned money. There will never be quotas on selling, nor buying*, nor recruiting. No enrollment fees, no montly fees. \n\nFor example: You may join for free and decide to never buy anything through WinMaWeb (but once you see the great deals being offered we doubt that this will happen :-) ! ) \n\n*There is only one exception to this rule: \n\nThe only time that members are required to spend money on WinMaWeb is after they have earned an income through WinMaWeb. At that point, WinMaWeb asks members to put 20% of their WinMaWeb earnings back into the network. The other 80% can be withdrawn directly and transferred to the member''s bank account. \n\n[b][i]How will members be asked to put money earned back into the network?[/i][/b] \n\nAfter you have earned money through WinMaWeb we will ask that you to spend 20% of that income on WinMaWeb deals. This requirement is there to strengthen the ''inner economy'' of WinMaWeb and thus to attract even more businesses to the network. The other 80% of the money you earned is yours to withdraw freely and spend as you wish. \n\n[b][i]Why would businesses offer great deals through WinMaWeb?[/i][/b] \n\nBusinesses receive free marketing and publicity by offering deals on WinMaWeb. The exposure they receive is greater than any traditional advertising campaign. Businesses end up saving money by having to spend less on marketing and advertising, so they are able to offer their products and services at a much reduced cost to you, our WinMaWeb members. \n\nBusinesses are also never asked to &ldquo;buy in&rdquo; to WinMaWeb. Like you, businesses join for free. \n\n[i][b]How can I refer my friends to WinMaWeb and begin growing my own social network?[/b][/i] \n\nEvery member will receive a Referral ID. Give that Referral ID to your friends, post it on your wall in Facebook, etc., so that when they sign up they become your first network tier of WinMaWeb members. \n\n[b][i]What if my friend forgets my Referral ID and signs up on WinMaWeb?[/i][/b] \n\nWinMaWeb will not allow new members to sign up without a Referral ID. If your friend tries to sign up and has forgotten your Referral ID he or she will most likely be contacting you so please keep your Referral ID handy. \n\n[b][i]What if someone signs up on WinMaWeb because they saw the comment on my Facebook wall or a similar electronic link?[/i][/b] \n\nWinMaWeb is designed so that your Referral ID is embedded in all links to the membership registration page. However, please post your Referral ID in the links just in case something goes wrong. \n\n[b][i]How will I know of the great deals being offered through WinMaWeb?[/i][/b] \n\nOnce you sign up for a free membership you will have become a lifetime member. You will then be able to choose how you wish to be informed of the deals. You may subscribe, or unsubscribe, from E-mail notifications, you may login to the website and browse through a detailed listing of deals. In addition you may set up the WinMaWeb website to alert your smart phone of new deals as they are posted on the website. \n\n[b][i]How can I buy a deal through WinMaWeb?[/i][/b] \n\nFirst, you must be a member. To become a member is free and quite easy, you don''t even need a credit card. \n\nThen, once you are a member, there are several ways to buy deals on WinMaWeb. \n\nA) You can transfer money to your My Wallet (eg via PayPal or other means) and use that money to then buy deals through WinMaWeb. \n\nB) Alternatively, you could use your credit card to buy deals without transferring any money. \n\n[b][i]Why is WinMaWeb better than other social networks?[/i][/b] \n\nIn two words: Transparency and Profitability. WinMaWeb is both more transparent and more profitable to members than all other social networks. \n\nMembers can see at any time exactly how their social network of friends and colleagues is building up. Members can see immediately how new businesses offer deals through WinMaWeb. And WinMaWeb is set up and built around the principle to redistribute wealth back to the people, so the percentages, savings and earnings equally favor the members at ANY tier level, and not just those who joined and started early. \n\nEg. The founders of WinMaWeb and those who joined early on will ONLY receive an income from their 5th Tier of members. Not from the 6th, 7th or 50th tiers as well. So a member who signed up on the 34th tier will receive an income from their 5th tier (the 39th tier of friends and colleagues), just like the original members who started on the 1st tier and only earn an income from the 6th tier members of their friends and colleagues. \n\nIn addition, WinMaWeb offers the members (agents) who bring in and recruit businesses an equal share of the profits from that business. This is to guarantee new members and businesses a clear and fair transparency as well as an increased profitability. \n\n[b][i]Why do I have to wait for the 5th tier of members before I earn an income from WinMaWeb?[/i][/b] \n\nWinMaweb is not a Multi Level Marketing Company where only the early members benefit the most, instead we are a Uni Level Marketing Company where activity and commitment will determine how much a member earns. A member may join late and still develop a larger network than the founder. IN that case, the member will literally earn more money from the network than the founder (because members only earn money from their 5th tier, regardless of where they are in the whole network.) \n\nBut there is a simpler answer to that question: Because you will earn more, a lot more, that way. \n\nImagine this scenario: You network and tell all of your friends and colleagues and contacts about WinMaWeb and as a result ten of them become &ldquo;active&rdquo; networkers in your first tier. Those ten people in your first tier do the same and tell all of their contacts about WinMaWeb and as a result each of them gets ten active networkers in their first tier (all of them together means 100 active networkers in your second tier). Following this model you will have 100,000 active networkers in your 5th tier (but only 10,000 in your 4th Tier and 1,000 in your third tier). Your WinMaWeb network income will be generated from the purchases made by everyone in your 5th Tier (not just the 100,000 active networking members, but all the other inactive members as well who are just taking advantage of the deals...) \n\nFollowing this model, if every active networking member spends 10 dollars on WinMaWeb products and services, then you could expect an income of about 100,000 dollars from your 5th tier of active members (and much much more if you consider the purchases made by inactive members) \n\n[b][i]How can I withdraw my money from WinMaWeb?[/i][/b] \n\nYour member account has a My Wallet and a WinMaWeb Account. All the money in your My Wallet may be transferred at any time directly to your bank account or Paypal. Money from your WinMaWeb Account is moved automatically to your wallet after you have made a WinMaWeb purchase. \n\n[b][i]How is money moved from my WinMaWeb Account to My Wallet?[/i][/b] \n\nOnce you make a WinMaWeb purchase an amount of money four times your purchase amount is automatically moved to your My Wallet. Eg. If you make a WinMaWeb purchase from your WinMaweb Account for 20 dollars then 80 dollars will automatically be moved to your My Wallet. \n\n[b][i]What if I only have 30 dollars in my WinMaWeb Account and I make that WinMaWeb purchase for 20 dollars?[/i][/b] \n\nThen the remaining 10 dollars in your WinMaWeb Account will automatically be moved to your My Wallet, and the next 70 dollars deposited into your WinMaWeb Account also be automatically moved to your My Wallet later. In effect, your WinMaWeb purchases will always be credited to your WinMaWeb Account for later. \n\n[b][i]What countries are WinMaWeb in?[/i][/b] \n\nWinMaWeb was founded in Singapore, but as the membership expands it will quickly become a global social network. Plans are already in motion to open WinMaWeb in the USA, Europe as well as in other Asian countries. Contact us if you''d like to help open your nation. \n\n[b][i]What if I want to do more for the company than just being a WinMaWeb member?[/i][/b] \n\nWinMaWeb is always looking for leaders in the community who may assist the network marketing company in opening new countries and assisting in other related areas such as legalization, marketing and network management. Contact us if you think your skills and talents could even further benefit WinMaWeb. \n\n[b]FAQ For Merchants[/b] \n\n[b][i]Why is WinMaWeb better than other Social Networks for Merchants?[/i][/b] \n\nWinMaWeb is better than other social networks because we take care of our members better. WinMaWeb members benefit from a better transparency and more profitability than what other social networks offer. These benefits to the members are directly transferred to the merchants because WinMaWeb will have more members, more members means more market exposure to Merchants, and more deals purchased. \n\n[b][i]What if I lose my Voucher?[/i][/b] \n\nDon''t worry, if you lose your Voucher you may download it and print it out again . Each Voucher has a unique code that the Merchant will verify when you redeem it. Once that Voucher code has been used the Voucher is then consumed and no longer valid. (please see Terms and Conditions) \n\n[b][i]What if I want a refund?[/i][/b] \n\nAfter you purchase a voucher you may automatically refund it within 7 days after the initial purchase, provided you have not used the voucher. If you have used the voucher you may still attempt to refund it, and WinMaWeb will contact the Merchant and discuss your case with them before deciding on the refund. To Refund a Voucher all you must do is send in a message to customer support (via the Contact Us button on any main page) and provide us with your Voucher Code and the details and reasons for the refund. \n\n\n\n[i][b]What if someone steals my Voucher?[/b][/i] \n\nVouchers are like cash (please don''t leave them laying around in a drawer or on your computer desktop). But, if someone steals your Voucher then your first steps should be: \n1) contact the Merchant and let them know a thief is on the way (the Voucher has your name and contact info on it, so their crime will also include identity theft which is a felony in most countries...) \n2) report the theft to the police. \n\nThen let the Merchant and the Police do their jobs and bust the dumb thief. Then please contact us and we will report in our newsletter how WinMaWeb vouchers are safer than cash at helping to stop crime :-) \n\n[b][i]How can I bring a Merchant to WinMaWeb?[/i][/b] \n[b][i]How can I earn Agent Commissions?[/i][/b] \n[b][i]How can I become an Agent and post a deal on WinMaWeb?[/i][/b] \n\n[u]Please click this hyperlink to watch our tutorial movie on how to be an Agent.[/u] \n\n\nIf you want to earn more with WinMaWeb and wish to earn Agent Commissions on each purchase of a deal (then you earn 20% of the WinMaweb share) then you may contact Merchants and bring a Deal Offer in to WinMaWeb. \n\nThe first step is to click the &ldquo;Merchant Contract&rdquo; button on the main menu of the website and then follow the steps to get the contract, and then go find a Merchant. Do you have friends that own businesses? Is there a local business near you that might have a lack of customers on Tuesdays? A store with too many size 38 shoes? A restaurant with the best food but not enough publicity? A dance school or TaeKwonDo studio that has too few students in their classes? Any local product or service provider may become a Merchant with WinMaWeb. Once you have found a Merchant you contact them and bring them the contract and introduce them to WinMaWeb. \n\nThe second step is to get the Merchant to become a member, if they are not one already (don''t forget to use your Referral ID and develop your network at the same time!) and to fill out the Merchant Contract together. Once the deal has been set up then you contact WinMaWeb (link for contact us here) and we verify the contract details. You (the Agent), the Merchant, and a Witness sign and date the contract and then send it/bring it in to WinMaWeb (link to address). \n\nThe third Step is WinMaWeb verifies and validates the contract, WinMaWeb conducts a Verification and Test Transaction on the Agent and Merchant (this is a small payment of less than 1 dollar.) Once that verification is complete WinMaWeb upgrades the Member to an Agent. Agents (and Merchants) have an extra function on the Website- a new menu item appears &ldquo;My Offers&rdquo; under which they may Add Offers to WinMaWeb. \n\nThe fourth Step: The Agent posts the Deal Offer on WinMaWeb (click here to see video/tutorial how to post a Deal Offer). \n\nThe last step: WinMaWeb verifies the Deal Offer. Once the deal offer has been accepted the Deal is now on and WinMaWeb members may purchase it. \n\nThen you, the Agent, watch the deal sell, every sale turns into an Agent Commission of 20% of the WinMaWeb share... and the Agent earns money! Every time the merchant redeems a voucher, the agent earns their commission. Agents can review their income directly under the Transactions: Received Transactions Section on the main menu. \n\n[b][i]What if a Merchant wishes to be his own Agent?[/i][/b] \n[b][i]What if a Merchant wishes to post his own Deal on WinMaWeb?[/i][/b] \n\nWinMaWeb requires that all members (merchants too) be referred by another member. Thus initially, most Merchants will be referred by Agents who are seeking to earn an income through Agent Commissions. However, later, once a Merchant is verified and already had a deal run on WinMaWeb, then the Merchant may post their own deals (and thus earn their own Agent Commissions.) \n\n[b][i]How does a Merchant get paid?[/i][/b] \n\nMerchants have extra functions on the website that are not available to Agents or regular Members. One of those functions is to &ldquo;Cash In Vouchers&rdquo; under Transactions. \nMerchants will Cash In Vouchers once they have been redeemed by members. Once a Voucher has been redeemed by the Merchant through the website the money will automatically be deposited into the Merchant''s My Wallet from which they may transfer the money as they wish. \n\n<iframe src="http://www.youtube.com/embed/pMCPHVjKQdE" width="420" height="315"></iframe>', 1, 5, 6, 2, 'how-its-working'),
(8, 'About us', 'About WinMaWeb', 'about winmaweb', 'WinMaWeb is a social network dedicated to redistributing wealth back to the people. Members join to benefit from great savings on local deals and may earn an income. Businesses join WinMaWeb to save on marketing and advertising costs and to increase their customer base. Members can become Agents by contacting local businesses and placing their deals on WinMaWeb.\n\nMembers can take advantage of the savings, and they may choose to earn an extra income by developing their Network to the 5th Tier. In addition, you can earn even more income by bringing in local businesses. Either way, its always free, so you win.\n[youtube]pMCPHVjKQdE[/youtube]', 1, 3, 4, 2, 'about-us'),
(9, 'FAQ', 'FAQ', 'WinMaWeb FAQ', '[b]FAQ- WinMaWeb[/b] \nWhat is WinMaWeb? \n\nWinMaWeb is a social network dedicated to redistributing wealth back to the people. \n\nHow can WinMaWeb benefit me? \n\nWinMaWeb can benefit members in many ways \n\nA) New members join for free and gain immediate access to great deals and can begin saving money. \n\nB) Members who have built up their own social network will receive an income from their 5th tier of WinMaWeb members. \n\nC) Members can become Agents by bringing in local businesses (Deals) to WinMaWeb and Agents will receive an income each time one of those deals is sold on WinMaWeb. \n\nD) Merchants may join for free and benefit from the WinMaWeb membership and free advertising on their products and services. \n\nSummary: Members are offered great deals from local businesses and can begin by saving a lot of money, members who built a network earn an income from their 5th tier, and members (agents) who recruit local businesses also earn an income. \n\nDoes it cost anything to join? \n\nNo, WinMaWeb is free and always will be. It will never require a financial investment from you of your hard earned money. There will never be quotas on selling, nor buying*, nor recruiting. No enrollment fees, no monthly fees. \n\nFor example: You may join for free and decide to never buy anything through WinMaWeb (but once you see the great deals being offered we doubt that this will happen :-) ! ) \n\n*There is only one exception to this rule: \n\nThe only time that members are required to spend money on WinMaWeb is after they have earned an income through WinMaWeb. At that point, WinMaWeb asks members to put 20% of their WinMaWeb earnings back into the network. The other 80% can be withdrawn directly and transferred to the member''s bank account. \n\nHow will members be asked to put money earned back into the network? \n\nAfter you have earned money through WinMaWeb we will ask that you to spend 20% of that income on WinMaWeb deals. This requirement is there to strengthen the ''inner economy'' of WinMaWeb and thus to attract even more businesses to the network. The other 80% of the money you earned is yours to withdraw freely and spend as you wish. \n\nWhy would businesses offer great deals through WinMaWeb? \n\nBusinesses receive free marketing and publicity by offering deals on WinMaWeb. The exposure they receive is greater than any traditional advertising campaign. Businesses end up saving money by having to spend less on marketing and advertising, so they are able to offer their products and services at a much reduced cost to you, our WinMaWeb members. \n\nBusinesses are also never asked to &ldquo;buy in&rdquo; to WinMaWeb. Like you, businesses join for free. \n\nHow can I refer my friends to WinMaWeb and begin growing my own social network? \n\nEvery member will receive a Referral ID. Give that Referral ID to your friends, post it on your wall in Facebook, etc., so that when they sign up they become your first network tier of WinMaWeb members. \n\nWhat if my friend forgets my Referral ID and signs up on WinMaWeb? \n\nWinMaWeb will not allow new members to sign up without a Referral ID. If your friend tries to sign up and has forgotten your Referral ID he or she will most likely be contacting you so please keep your Referral ID handy. \n\nWhat if someone signs up on WinMaWeb because they saw the comment on my Facebook wall or a similar electronic link? \n\nWinMaWeb is designed so that your Referral ID is embedded in all links to the membership registration page. However, please post your Referral ID in the links just in case something goes wrong. \n\nHow will I know of the great deals being offered through WinMaWeb? \n\nOnce you sign up for a free membership you will have become a lifetime member. You will then be able to choose how you wish to be informed of the deals. You may subscribe, or unsubscribe, from E-mail notifications, you may login to the website and browse through a detailed listing of deals. In addition you may set up the WinMaWeb website to alert your smart phone of new deals as they are posted on the website. \n\nHow can I buy a deal through WinMaWeb? \n\nFirst, you must be a member. To become a member is free and quite easy, you don''t even need a credit card. \n\nThen, once you are a member, there are several ways to buy deals on WinMaWeb. \n\nA) You can transfer money to your My Wallet (eg via PayPal or a GIRO Bank transfer within Singapore) and use that money to then buy deals through WinMaWeb. \n\nB) Alternatively, you could use your credit card to buy deals without transferring any money. Please note that the due to Internet banking fees associated with credit card payments WinMaWeb must charge an additional 4% credit card transaction fee on any and all purchases made with a credit card. \n\nWhy is WinMaWeb better than other social networks? \n\nIn two words: Transparency and Profitability. WinMaWeb is both more transparent and more profitable to members than all other social networks. \n\nMembers can see at any time exactly how their social network of friends and colleagues is building up. Members can see immediately how new businesses offer deals through WinMaWeb. And WinMaWeb is set up and built around the principle to redistribute wealth back to the people, so the percentages, savings and earnings equally favor the members at ANY tier level, and not just those who joined and started early. \n\nEg. The founders of WinMaWeb and those who joined early on will ONLY receive an income from their 5th Tier of members. Not from the 6th, 7th or 50th tiers as well. So a member who signed up on the 34th tier will receive an income from their 5th tier (the 39th tier of friends and colleagues), just like the original members who started on the 1st tier and only earn an income from the 6th tier members of their friends and colleagues. \n\nIn addition, WinMaWeb offers the members (agents) who bring in and recruit businesses an equal share of the profits from that business. This is to guarantee new members and businesses a clear and fair transparency as well as an increased profitability. \n\nWhy do I have to wait for the 5th tier of members before I earn an income from WinMaWeb? \n\nWinMaweb is not a Multi-Level Marketing Company where only the early members benefit the most, instead we are a Uni-Level Marketing Company where activity and commitment will determine how much a member earns. A member may join late and still develop a larger network down to his 5th Tier than the founder. In that case, the member will literally earn more money from the network than the founder (because members only earn money from their 5th tier, regardless of where they are in the whole network.) \n\nBut there is a simpler answer to that question: Because you will earn more, a lot more, that way. \n\nImagine this scenario: You network and tell all of your friends and colleagues and contacts about WinMaWeb and as a result ten of them become &ldquo;active&rdquo; networkers in your first tier. Those ten people in your first tier do the same and tell all of their contacts about WinMaWeb and as a result each of them gets ten active networkers in their first tier (all of them together means 100 active networkers in your second tier). Following this model you will have 100,000 active networkers in your 5th tier (but only 10,000 in your 4th Tier and 1,000 in your third tier). Your WinMaWeb network income will be generated from the purchases made by everyone in your 5th Tier (not just the 100,000 active networking members, but all the other inactive members as well who are just taking advantage of the deals...) \n\nFollowing this model, if every active networking member spends 10 dollars on WinMaWeb products and services, then you could expect an income of about 100,000 dollars from your 5th tier of active members (and much much more if you consider the purchases made by inactive members) \n\nWhy do I have both a My Wallet and a WinMaWeb Account that each hold money? \n\nAll commissions you may receive as an Agent or as a Networker split the money 80%/20%. What happens is 80% of the commissions go to your My Wallet which you may withdraw to your bank account right away, while the other 20% of the commissions go to your WinMaWeb Account where the money may only be used to buy deals or donate to charities on WinMaWeb. The reason for the two accounts is to encourage businesses and to develop an inner economy within WinMaWeb that further strengthens the Company. Imagine how your Network commissions will increase when all the people in your 5th Tier are using their WinMaWeb Account money to buy more deals for themselves and for friends! \n\nHow can I withdraw my money from WinMaWeb? \n\nYour member account has a My Wallet and a WinMaWeb Account. All the money in your My Wallet may be transferred at any time directly to your bank account via a GIRO bank transfer or Paypal. Money in your WinMaWeb Account may only be used to make purchases and donations on WinMaWeb. \n\nCan I move money from my WinMaWeb Account to My Wallet? \n\nMoney is never moved from your WinMaWeb Account to your My Wallet. \n\nWhat countries are WinMaWeb in? \n\nWinMaWeb was founded in Singapore, but as the membership expands it will quickly become a global social network. Plans are already in motion to open WinMaWeb in the USA, Europe as well as in other Asian countries. Contact us if you''d like to help open your nation. \n\nWhat if I want to do more for the company than just being a WinMaWeb member? \n\nWinMaWeb is always looking for leaders in the community who may assist the network marketing company in opening new countries and assisting in other related areas such as legalization, marketing and network management. Contact us if you think your skills and talents could even further benefit WinMaWeb. \n\nFAQ For Merchants \n\nWhy is WinMaWeb better than other Social Networks for Merchants? \n\nWinMaWeb is better than other social networks because we take care of our members better. WinMaWeb members benefit from a clearer transparency and more profitability than what other social networks offer. These benefits to the members are directly transferred to the merchants because WinMaWeb will have more members, more members means more market exposure to Merchants, more deals on the system, as well as more deals being purchased. \n\nWhat if I lose my Voucher? \n\nDon''t worry, if you lose your Voucher you may download it and print it out again . Each Voucher has a unique code that the Merchant will verify when you redeem it. Once that Voucher code has been used the Voucher is then consumed and no longer valid. (please see Terms and Conditions) \n\nWhat if I want a refund? \n\nAfter you purchase a voucher you may automatically refund it within 7 days after the initial purchase, provided you have not used the voucher. If you have used the voucher you may still attempt to refund it, and WinMaWeb will contact the Merchant and investigate your case before deciding on the refund. To Refund a Voucher all you must do is send in a message to customer support (via the Contact Us button on any main page) and provide us with your Voucher Code and the details and reasons for the refund. \n\nWhat if someone steals my Voucher? \n\nVouchers are like cash or checks or credit cards (please don''t leave them laying around in a drawer or on your computer desktop). But, if someone steals your Voucher then your first steps should be: \n1)contact the Merchant and let them know a thief is on the way (the Voucher has your name and contact info on it, so their crime will also include attempted identity theft which is a felony in some countries...) \n2)report the theft to the police. \n\nThen let the Merchant and the Police do their jobs and bust the dumb thief. Then please contact us and we will report in our newsletter how WinMaWeb vouchers are safer than cash at helping to stop crime :-) The Merchant should be able to easily catch the thief and then we will notify you that the Voucher is valid again. And don''t worry, you can print out a new Voucher for yourself :-) \n\nHow can I bring a Merchant to WinMaWeb? \nHow can I earn Agent Commissions? \nHow can I become an Agent and post a deal on WinMaWeb? \n\nPlease click this hyperlink to watch our tutorial movie on how to be an Agent. \n\nIf you want to earn more with WinMaWeb and wish to earn Agent Commissions on each purchase of a deal (then you earn 20% of the WinMaweb share) then you may contact Merchants and bring a Deal Offer in to WinMaWeb. \n\nThe first step is to click the &ldquo;Merchant Contract&rdquo; button on the main menu of the website and then follow the steps to get the contract, and then go find a Merchant. Do you have friends that own businesses? Is there a local business near you that might have a lack of customers on Tuesdays? A store with too many size 38 shoes? A restaurant with the best food but not enough publicity? A dance school or TaeKwonDo studio that has too few students in their afternoon classes? Any local product or service provider may become a Merchant with WinMaWeb. Once you have found a Merchant you contact them and bring them the contract and introduce them to WinMaWeb. \n\nThe second step is to get the Merchant to become a member, if they are not one already (don''t forget to use your Referral ID and develop your network at the same time!) and to fill out the Merchant Contract together. Once the deal has been set up then you contact WinMaWeb (link for contact us here) and we verify the contract details. You (the Agent), the Merchant, and a Witness sign and date the contract and then send it/bring it in to WinMaWeb (link to address). \n\nThe third Step is WinMaWeb verifies and validates the contract, WinMaWeb conducts a Verification and Test Transaction on the Agent and Merchant (this is a small payment of 3 dollars.) Once that verification is complete WinMaWeb upgrades the Member to an Agent. Agents (and Merchants) have an extra function on the Website- a new menu item appears &ldquo;My Offers&rdquo; under which they may Add Offers to WinMaWeb. \n\nThe fourth Step: The Agent posts the Deal Offer on WinMaWeb (click here to see video/tutorial how to post a Deal Offer). \n\nThe last step: WinMaWeb verifies the Deal Offer. Once the deal offer has been accepted the Deal is now on and WinMaWeb members may purchase it. \n\nThen you, the Agent, watch the deal sell, every sale turns into an Agent Commission of 20% of the WinMaWeb share... and the Agent earns money! Every time the merchant redeems a voucher, the agent earns their commission. Agents can review their income directly under the Transactions: Received Transactions Section on the main menu. \n\nWhat if a Merchant wishes to be his own Agent? \nWhat if a Merchant wishes to post his own Deal on WinMaWeb? \n\nWinMaWeb requires that all members (merchants too) be referred by another member. Thus initially, most Merchants will be referred by Agents who are seeking to earn an income through Agent Commissions. However, later, once a Merchant is verified and already had a deal run on WinMaWeb, then the Merchant may post their own deals (and thus earn their own Agent Commissions.) \n\nHow does a Merchant get paid? \n\nMerchants have extra functions on the website that are not available to Agents or regular Members. One of those functions is to &ldquo;Cash In Vouchers&rdquo; under Transactions. \nMerchants will Cash In Vouchers once they have been redeemed by members. Once a Voucher has been redeemed by the Merchant through the website the money will automatically be deposited into the Merchant''s My Wallet from which they may transfer the money as they wish.', 1, 15, 16, 2, 'faq');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT '0',
  `is_active` tinyint(4) DEFAULT '0',
  `is_banned` tinyint(4) DEFAULT '0',
  `is_do` tinyint(4) DEFAULT '0',
  `is_super_admin` tinyint(4) DEFAULT '0',
  `request_step` smallint(6) DEFAULT '0',
  `agent_request_step` smallint(6) DEFAULT '0',
  `ref_id` varchar(50) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `vat_number` varchar(255) DEFAULT NULL,
  `acl` longtext,
  `paypal_email` varchar(255) DEFAULT NULL,
  `wallet` double(18,2) DEFAULT '0.00',
  `virtual_wallet` double(18,2) DEFAULT '0.00',
  `last_emails_sent` datetime DEFAULT NULL,
  `activated_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `mrequest_at` datetime DEFAULT NULL,
  `mrequest_approved_at` datetime DEFAULT NULL,
  `arequest_at` datetime DEFAULT NULL,
  `arequest_approved_at` datetime DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `pass_req_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emailindex_idx` (`email`),
  UNIQUE KEY `usernameindex_idx` (`username`),
  UNIQUE KEY `refidindex_idx` (`code`),
  KEY `parentindex_idx` (`parent_id`),
  KEY `bannedindex_idx` (`is_banned`),
  KEY `doindex_idx` (`is_do`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=151 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `parent_id`, `is_active`, `is_banned`, `is_do`, `is_super_admin`, `request_step`, `agent_request_step`, `ref_id`, `username`, `password`, `email`, `phone`, `first_name`, `last_name`, `company_name`, `vat_number`, `acl`, `paypal_email`, `wallet`, `virtual_wallet`, `last_emails_sent`, `activated_at`, `last_login`, `mrequest_at`, `mrequest_approved_at`, `arequest_at`, `arequest_approved_at`, `code`, `pass_req_at`, `created_at`, `updated_at`, `gender`, `age`) VALUES
(1, 0, 1, 0, 0, 0, 0, 0, NULL, 'admin', '58f879e612489211baad610e22a86d2d ', 'admin@test.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, '2012-10-03 07:35:57', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-18 11:31:19', '2012-10-03 07:35:57', '', ''),
(2, 0, 1, 0, 0, 0, 0, 0, 'root-2', 'root', '1', 'root@test.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53.35, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-18 11:31:19', '2012-07-20 02:13:50', '', ''),
(3, 2, 1, 0, 0, 0, 0, 0, 'sg-wmw1-3', 'wmw1', 'e10adc3949ba59abbe56e057f20f883e', 'wmw1@winmaweb.com', NULL, NULL, NULL, 'company name', '12313212', NULL, 'test@test.com', 0.00, 0.00, NULL, '2012-05-25 08:40:57', '2012-08-20 01:38:58', NULL, NULL, '2012-05-29 00:06:35', NULL, NULL, NULL, '2012-05-25 08:40:55', '2012-08-20 01:38:58', NULL, NULL),
(4, 3, 1, 0, 0, 0, 0, 0, 'sg-wmw2-4', 'wmw2', 'e10adc3949ba59abbe56e057f20f883e', 'wmw2@winmaweb.com', '123456', 'wmw2', 'wmw2', 'wmw2', '123456', NULL, 'test@test.com', 0.24, 0.06, NULL, '2012-05-25 08:44:12', '2012-09-02 00:37:14', '2012-05-31 06:56:53', NULL, NULL, NULL, NULL, NULL, '2012-05-25 08:44:09', '2012-09-02 00:37:14', 'Male', '22'),
(5, 4, 1, 0, 0, 0, 0, 0, 'sg-wmw3-5', 'wmw3', 'e10adc3949ba59abbe56e057f20f883e', 'wmw3@winmaweb.com', '1324654', 'wmw3', 'winma', 'dqddwd', 'wqdqwdqwd', NULL, NULL, 0.00, 0.00, NULL, '2012-05-25 08:44:59', '2012-07-18 05:08:21', '2012-05-31 04:12:39', NULL, NULL, NULL, NULL, NULL, '2012-05-25 08:44:57', '2012-07-18 05:08:21', 'Male', '25'),
(6, 5, 1, 0, 0, 0, 0, 0, 'sg-wmw4-6', 'wmw4', 'e10adc3949ba59abbe56e057f20f883e', 'wmw4@winmaweb.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-25 08:46:12', '2012-06-14 05:33:34', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-25 08:46:09', '2012-06-14 05:33:34', NULL, NULL),
(7, 6, 1, 0, 0, 0, 0, 0, 'sg-wmw5-7', 'wmw5', 'e10adc3949ba59abbe56e057f20f883e', 'wmw5@winmaweb.com', NULL, NULL, NULL, 'Agent WMW', '123456', NULL, NULL, 0.00, 0.00, NULL, '2012-05-25 08:48:09', '2012-06-17 05:01:23', NULL, NULL, '2012-06-17 01:07:34', NULL, NULL, NULL, '2012-05-25 08:48:07', '2012-06-17 05:01:23', NULL, NULL),
(8, 7, 1, 0, 1, 0, 100, 100, 'sg-joost-8', 'joost', '2c44c659e26cfe292ba2a8f5dd010f52', 'jgoovaerts@hotmail.com', '+6591990982', 'Joost', 'Goovaerts', 'WinMaWeb- Global Marketing 3000 PTE. LTD.', '123456789', NULL, 'jgoovaerts@hotmail.com', 56.66, 0.00, NULL, '2012-05-25 08:49:24', '2012-08-30 06:46:25', '2012-07-11 04:46:00', NULL, '2012-07-11 04:44:24', NULL, NULL, NULL, '2012-05-25 08:49:21', '2012-08-30 06:46:25', 'Male', '48'),
(9, 8, 1, 0, 0, 0, 0, 0, 'sg-ingka-9', 'ingka', '4a7fd8b7cc87de7d3f9af7102e4694b4', 'ingka@infinita.biz', '0822123465', 'Ingemar', 'von Kalm', 'Ingka Merchant', 'Merchant 65465456', NULL, 'test@infinita.biz', 15.47, 0.00, '2012-07-09 04:36:03', '2012-05-25 08:53:20', '2012-09-02 03:32:59', '2012-07-09 08:12:52', NULL, '2012-06-19 00:37:41', NULL, 'b46a1faa5fc0707142037020aab34289', '2012-07-09 04:53:06', '2012-05-25 08:52:57', '2012-09-02 03:32:59', 'Male', '44'),
(10, 8, 1, 0, 0, 0, 0, 0, 'sg-christian-10', 'christian', 'e10adc3949ba59abbe56e057f20f883e', 'digitaldreamsdesign@yahoo.com', '1221321321', 'asdadas', 'asdasd', NULL, NULL, NULL, NULL, 16.04, 0.00, NULL, '2012-05-25 08:54:06', '2012-08-31 02:19:31', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-25 08:54:04', '2012-08-31 02:19:31', 'Male', '22'),
(11, 8, 1, 0, 0, 0, 0, 0, 'sg-rynna-11', 'rynna', 'e10adc3949ba59abbe56e057f20f883e', 'jgoovaerts@me.com', '123456789', 'Rynna', 'Goovaerts', 'WMW1', '123456789', NULL, NULL, 0.00, 0.00, NULL, '2012-05-25 09:38:48', '2012-07-22 11:02:46', '2012-05-29 09:22:16', NULL, '2012-05-29 08:51:28', NULL, 'c110a990d8ede566fb5fe8dddc842218', '2012-06-05 00:23:26', '2012-05-25 09:36:49', '2012-07-22 11:02:46', 'Female', '36'),
(12, 11, 1, 0, 0, 0, 0, 0, 'sg-dean-12', 'dean', 'e10adc3949ba59abbe56e057f20f883e', 'dean@winmaweb.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-25 09:48:14', '2012-05-25 09:49:04', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-25 09:47:32', '2012-05-25 09:49:04', NULL, NULL),
(13, 12, 1, 0, 0, 0, 0, 0, 'sg-misha-13', 'misha', 'e10adc3949ba59abbe56e057f20f883e', 'misha@winmaweb.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-25 09:50:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-25 09:50:07', '2012-05-25 09:50:43', NULL, NULL),
(14, 11, 1, 0, 0, 0, 0, 0, 'sg-inez-14', 'inez', 'e10adc3949ba59abbe56e057f20f883e', 'inez@winmaweb.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-25 09:56:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-25 09:54:53', '2012-05-25 09:56:00', NULL, NULL),
(15, 8, 1, 0, 0, 0, 0, 0, 'sg-bart-15', 'bart', 'e10adc3949ba59abbe56e057f20f883e', 'bart@winmaweb.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:12:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-25 10:32:52', '2012-08-15 11:12:01', NULL, NULL),
(16, 8, 1, 0, 0, 0, 0, 0, 'sg-avibouhadana-16', 'avibouhadana', '7e9785c69925c76b9addb4c85cf0bfec', 'avibouhadana@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-25 23:47:21', NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-05 22:53:15', '2012-05-25 23:46:39', '2012-08-05 22:53:50', NULL, NULL),
(17, 8, 1, 0, 1, 0, 100, 100, 'sg-chris-17', 'chris', 'e10adc3949ba59abbe56e057f20f883e', 'chris_tarn@web.de', '+66858673627', 'Chris', 'Tarn', 'Best Deals', '123456789', NULL, 'uthrac_1341817890_per@hotmail.com', 5.74, 0.06, '2012-06-25 05:31:29', '2012-05-26 05:46:53', '2012-09-14 06:54:06', '2012-07-11 04:42:57', NULL, '2012-07-11 02:53:55', NULL, 'b9f637fb343bcf1128ee2e79fe88d223', '2012-06-21 08:54:16', '2012-05-26 05:45:19', '2012-09-14 06:54:06', 'Male', '38'),
(18, 17, 1, 0, 0, 0, 0, 0, 'sg-oh-18', 'oh', 'e10adc3949ba59abbe56e057f20f883e', 'ajeejom@yahoo.com', '+66851291135', 'Anutjarin', 'Tarn', 'aaaaaa', 'aaaaaaa', NULL, NULL, 0.00, 0.00, NULL, '2012-05-26 22:05:09', '2012-08-02 11:17:18', '2012-06-21 08:59:15', NULL, '2012-06-21 08:58:23', NULL, NULL, NULL, '2012-05-26 22:02:35', '2012-08-02 11:17:18', 'Female', '26'),
(19, 17, 1, 0, 0, 0, 0, 0, 'sg-b-boyz-19', 'b-boyz', 'd5883d2babcd6c9532ee59c9823cec4b', 'aldrin.cheah@gmail.com', '91832708', 'Aldrin', 'Cheah', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-27 00:00:26', '2012-08-22 03:48:21', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-26 23:28:02', '2012-08-22 03:48:21', 'Male', '29'),
(20, 17, 1, 0, 0, 0, 0, 0, 'sg-canihelp-20', 'canihelp', '965d41ac436af5f7299b22c900dbbe7b', 'canihelp3003@gmail.com', '97790323', 'Steve', 'Phoi', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-27 00:01:24', '2012-10-03 05:31:21', NULL, NULL, NULL, NULL, '78bb4c30ed53ae23e9a95de05e9d73d6', '2012-08-20 02:08:00', '2012-05-26 23:59:03', '2012-10-03 05:31:21', 'Male', '44'),
(21, 20, 1, 0, 0, 0, 0, 0, 'sg-jackhoy-21', 'jackhoy', 'fa24a62f07b5821a38bf75a68fa02d65', 'jackhoy@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-27 02:25:44', '2012-05-27 07:57:11', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-27 02:23:31', '2012-05-27 07:57:11', NULL, NULL),
(22, 11, 1, 0, 1, 0, 100, 100, 'sg-sunshine-22', 'sunshine', '08fbff54dbf4d5d0682a1fd9228fbefe', 'has@positivefocus.com.sg', '96173269', 'Has', 'Has', 'Positive Focus Pte Ltd', '2000608285R', NULL, NULL, 2.80, 0.00, '2012-07-24 04:54:04', '2012-05-27 02:47:59', '2012-08-22 09:43:44', '2012-07-20 02:13:43', NULL, '2012-07-20 02:10:10', NULL, NULL, '2012-06-03 08:26:57', '2012-05-27 02:46:30', '2012-08-22 09:43:44', 'Female', '44'),
(23, 11, 1, 0, 0, 0, 0, 0, 'sg-wansari-23', 'wansari', 'd7e2abd5d8cc8b9bf78737c9c8bf424a', 'wansari2008@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-09 07:59:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-27 02:49:34', '2012-07-09 07:59:35', NULL, NULL),
(24, 22, 1, 0, 0, 0, 0, 0, 'sg-aidaladida-24', 'aidaladida', '86a4c9305a54b1e466ad6bc6823a88c6', 'aida_ladida@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-27 02:54:32', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-30 23:10:22', '2012-05-27 02:52:19', '2012-07-31 00:34:49', NULL, NULL),
(25, 24, 1, 0, 0, 0, 0, 0, 'sg-malina-25', 'malina', '189949663913ce47e5fde79af0fae9f2', 'malina.alwi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-27 02:58:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-27 02:57:44', '2012-05-27 02:58:03', NULL, NULL),
(26, 19, 1, 0, 0, 0, 0, 0, 'sg-kokfann-26', 'kokfann', '2daa6b52e528a925355b723fb94d68a8', 'kokfann@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-27 06:09:13', '2012-06-02 11:14:43', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-27 06:07:06', '2012-06-02 11:14:43', NULL, NULL),
(27, 19, 1, 0, 0, 0, 0, 0, 'sg-thamweileong-27', 'thamweileong', '93caa2ff93ff162e30b82b6929ba33d8', 'twleong81@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-29 02:54:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-27 06:58:05', '2012-05-29 02:54:01', NULL, NULL),
(28, 26, 1, 0, 0, 0, 0, 0, 'sg-sgwong-28', 'sgwong', '176913cacfa10c2b1e864f096286f494', 'sg_wong83@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:12:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-27 09:43:33', '2012-08-15 11:12:11', NULL, NULL),
(29, 26, 1, 0, 0, 0, 0, 0, 'sg-ahddu2012-29', 'ahddu2012', '4b2ff7ad7f534cc21e727936615ede0f', 'tu.ching.hao@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-27 21:13:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-27 09:50:08', '2012-05-27 21:13:26', NULL, NULL),
(30, 19, 1, 0, 0, 0, 0, 0, 'sg-tammycheah-30', 'tammycheah', 'd5883d2babcd6c9532ee59c9823cec4b', 'tammy_cheah@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-27 11:50:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-27 11:20:47', '2012-05-27 11:50:49', NULL, NULL),
(31, 20, 1, 0, 0, 0, 0, 0, 'sg-jerminson-31', 'jerminson', '9bcf586fbea46b832dd0811c3687a5d3', 'jerminson.lim@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-27 13:24:02', '2012-05-29 07:58:18', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-27 13:22:37', '2012-05-29 07:58:18', NULL, NULL),
(32, 18, 1, 0, 0, 0, 0, 0, 'sg-nikodj-32', 'nikodj', 'c7410f1fac9f3796c8159b93cec8c10a', 'dejongheniko@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-27 15:21:56', '2012-07-11 14:07:25', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-27 15:19:54', '2012-07-11 14:07:25', NULL, NULL),
(33, 9, 1, 0, 0, 0, 0, 0, 'sg-wilddan-33', 'wilddan', '0571749e2ac330a7455809c6b0e7af90', 'wr@wilddan.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, '2012-06-05 05:37:38', NULL, '2012-07-10 21:37:55', NULL, NULL, NULL, NULL, 'd084fc98b87de10dfe9ad3019acde2cb', '2012-06-05 00:31:54', '2012-05-28 03:22:26', '2012-07-10 21:37:55', NULL, NULL),
(34, 2, 1, 0, 0, 0, 0, 0, 'sg-testnow-34', 'testnow', 'e10adc3949ba59abbe56e057f20f883e', 'dddwork1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:12:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-30 10:07:38', '2012-08-15 11:12:21', NULL, NULL),
(35, 17, 1, 0, 0, 0, 0, 0, 'sg-skitsanos-35', 'skitsanos', '6f1d4688707effb240914f7e31b9c8c8', 'skitsanos@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-05 03:53:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-30 10:09:53', '2012-06-05 03:53:01', NULL, NULL),
(36, 20, 1, 0, 0, 0, 0, 0, 'sg-shiershao-36', 'shiershao', '1faf3d1ccf201535f0859661d22dcb4d', 'shiershao83@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-31 05:34:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-30 21:33:14', '2012-05-31 05:34:19', NULL, NULL),
(37, 32, 1, 0, 0, 0, 0, 0, 'sg-anita-37', 'anita', '677e74b722f3907a67d1b0402a3147f1', 'a_nita@abv.bg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-05 03:53:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-31 12:01:26', '2012-06-05 03:53:23', NULL, NULL),
(38, 32, 1, 0, 0, 0, 0, 0, 'sg-jodovitali-38', 'jodovitali', '1af37d29b597084a42c4fdcc68b18eb8', 'josdedonder@skynet.be', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-31 12:59:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-31 12:55:52', '2012-05-31 12:59:16', NULL, NULL),
(39, 38, 1, 0, 0, 0, 0, 0, 'sg-stefaanvp-39', 'stefaanvp', 'caadf6d9a532c3cd0cca5a20b079e690', 'stefaanvp@hotmail.be', '+51945386217', 'Stefaan', 'Van Puymbrouck', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-31 13:01:38', '2012-10-01 22:09:35', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-31 13:00:41', '2012-10-01 22:09:35', 'Male', '47'),
(40, 39, 1, 0, 0, 0, 0, 0, 'sg-annibelle-40', 'annibelle', '177b969024a16c477d8174ce5108d3d0', 'annickdroh@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-31 14:01:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-31 14:01:00', '2012-05-31 14:01:57', NULL, NULL),
(41, 39, 1, 0, 0, 0, 0, 0, 'sg-worker37-41', 'worker37', '64ac756a461750bee7951ef7fb6bc64e', 'verweg05@yahoo.es', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-05-31 14:35:01', '2012-07-12 17:36:56', NULL, NULL, NULL, NULL, NULL, NULL, '2012-05-31 14:33:22', '2012-07-12 17:36:56', NULL, NULL),
(42, 32, 1, 0, 0, 0, 0, 0, 'sg-eaglecash-42', 'eaglecash', '095e7d384dfd8be9695c294e22cd7746', 'willem.de.bleeckere@telenet.be', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-01 06:46:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-01 03:30:06', '2012-06-01 06:46:14', NULL, NULL),
(43, 18, 1, 0, 0, 0, 0, 0, 'sg-teckchin-43', 'teckchin', '27c60f35890cf33d191a3a5bb58c1b5c', 'lim.teckchin@gmail.com', '123456789', 'Teck Chin', 'Lim', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-01 11:42:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-01 11:40:37', '2012-06-01 11:43:47', 'Male', '50'),
(44, 43, 1, 0, 0, 0, 0, 0, 'sg-sexygina-44', 'sexygina', '5d110a5356e40e2eef51b5ca987f5933', 'ginak2609@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-05 03:52:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-01 12:06:40', '2012-06-05 03:52:41', NULL, NULL),
(45, 32, 1, 0, 0, 0, 0, 0, 'sg-riothamus-45', 'riothamus', '78f35497bc83448b86fb32c5e7e3f6f7', 'db.joachim@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-01 14:43:10', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-09 11:09:07', '2012-06-01 14:41:03', '2012-06-09 11:10:59', NULL, NULL),
(46, 10, 1, 0, 0, 0, 0, 0, 'sg-testddd-46', 'testddd', 'e10adc3949ba59abbe56e057f20f883e', 'radu.demetrescu@digitaldreamsdesign.net', NULL, 'Radu', 'Demetrescu', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-02 10:36:32', '2012-08-20 07:50:44', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-02 10:36:23', '2012-08-20 07:50:44', NULL, NULL),
(47, 22, 1, 0, 0, 0, 0, 0, 'sg-deefifi-47', 'deefifi', 'd87a20fc9e8714a582dad54756c9fde0', 'dee_fifi@yahoo.com.sg', NULL, 'Diana', 'Anne', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-04 07:22:38', '2012-06-04 07:32:38', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-04 07:21:54', '2012-06-04 07:32:38', NULL, NULL),
(48, 22, 1, 0, 0, 0, 0, 0, 'sg-daseti-48', 'daseti', 'ff8cbf3f7a0df0350d4b8d4dd07448ac', 'nathanael@daseti.com', NULL, 'Nathanael Seers ', 'Ong', NULL, NULL, NULL, NULL, 0.00, 0.00, '2012-06-04 11:53:37', '2012-06-04 07:29:43', '2012-06-18 06:01:20', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-04 07:27:09', '2012-06-18 06:01:20', NULL, NULL),
(49, 24, 1, 0, 0, 0, 0, 0, 'sg-the-giver-of-all-49', 'the-giver-of-all', '3542efed98366682a6f2e52e1ab8b4b2', 'norskie18@gmail.com', NULL, 'Nora', 'Isa', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-04 08:44:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-04 08:38:58', '2012-06-04 08:44:46', NULL, NULL),
(50, 11, 1, 0, 0, 0, 0, 0, 'sg-chubbynora-50', 'chubbynora', 'b56a91edef0a5b4afff3afc22face9e4', 'chubby_nora@hotmail.com', NULL, 'Nora', 'Atmareh', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-04 09:10:01', '2012-06-04 09:28:03', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-04 09:07:57', '2012-06-04 09:28:03', NULL, NULL),
(51, 49, 1, 0, 0, 0, 0, 0, 'sg-fizahnur-51', 'fizahnur', '45e651b59d6410a052b85fea793b8ae1', 'fizahnur@yahoo.com', NULL, 'nurhafizah', 'ahmad razali', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-04 09:31:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-04 09:13:25', '2012-06-04 09:31:15', NULL, NULL),
(52, 48, 1, 0, 0, 0, 0, 0, 'sg-yuling-52', 'yuling', '588bef76d9378af9a8bd8d5c97e8cc7d', 'xu_yuling84@yahoo.com.sg', NULL, 'Geok Ling', 'Koh', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:12:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-05 02:20:51', '2012-08-15 11:12:31', NULL, NULL),
(53, 48, 1, 0, 0, 0, 0, 0, 'sg-xuyuling-53', 'xuyuling', '004dafddb99c9469e185443a3b8f5b65', 'xuyuling84@gmail.com', NULL, 'Geok Ling', 'Koh', NULL, NULL, NULL, NULL, 0.00, 0.00, '2012-06-05 02:27:39', '2012-06-05 02:25:23', '2012-06-05 02:26:22', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-05 02:24:56', '2012-06-05 02:27:39', NULL, NULL),
(54, 17, 1, 0, 0, 0, 0, 0, 'sg-dcochrane-54', 'dcochrane', '2bc6d04e0108bc9521f0e7480a8da6de', 'dcochrane@me.com', NULL, 'David', 'Cochrane', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-05 03:26:12', '2012-06-09 06:19:33', NULL, NULL, NULL, NULL, '4d4e1a02fad9fe9f717a61f9c50ff712', '2012-06-09 06:18:38', '2012-06-05 03:25:19', '2012-06-09 06:19:33', NULL, NULL),
(55, 33, 1, 0, 0, 0, 0, 0, 'sg-shafiq-55', 'shafiq', 'b3fbfb6817b4435e4cab0a33877ec1fd', 'shafiqsg@gmail.com', '86228557', 'Md Shafiqul', 'Islam', NULL, NULL, NULL, NULL, 0.00, 0.00, '2012-06-14 00:19:33', '2012-06-05 05:55:39', '2012-07-03 06:01:11', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-05 05:55:15', '2012-07-03 06:01:11', 'Male', '46'),
(56, 39, 1, 0, 0, 0, 0, 0, 'sg-pieter-56', 'pieter', '2dd1f8b1bd3fca96a6ed5f6e8c27ae36', 'kb.pieter@gmail.com', NULL, 'Pieter', 'Buining', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:12:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-05 13:47:35', '2012-08-15 11:12:42', NULL, NULL),
(57, 55, 1, 0, 0, 0, 0, 0, 'sg-relahms-57', 'relahms', '90ba9a633f790550fb44d358b34fe38c', 'relawati@gmail.com', '6593815849', 'Relawati', 'HMS', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-06 22:10:00', '2012-06-06 23:01:07', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-06 22:05:11', '2012-06-06 23:01:07', 'Female', ''),
(58, 48, 1, 0, 0, 0, 0, 0, 'sg-veronica-58', 'veronica', 'c65002e11643db1d80afe5f0486e74fd', 'nika.ong@gmail.com', NULL, 'Veronica', 'Ong', NULL, NULL, NULL, NULL, 0.00, 0.00, '2012-07-12 01:42:23', '2012-06-07 00:52:48', '2012-07-19 19:54:59', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-07 00:51:42', '2012-07-19 19:54:59', NULL, NULL),
(59, 20, 1, 0, 0, 0, 0, 0, 'sg-may-59', 'may', 'ec698009f16b22e6632dd69b5f6803c6', 'spppmk@nus.edu.sg', NULL, 'May', 'Phoi', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-07 04:44:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-07 04:21:27', '2012-06-07 04:44:59', NULL, NULL),
(60, 18, 1, 0, 0, 0, 0, 0, 'sg-andy-60', 'andy', '70341fb4c7041c8efb0dc88048a9c467', 'aurumakl@gmail.com', NULL, 'Andreas', 'Osbahr', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-11 05:28:08', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-28 03:21:47', '2012-06-11 05:26:07', '2012-06-28 03:23:14', NULL, NULL),
(61, 8, 1, 0, 0, 0, 0, 0, 'sg-payne-61', 'payne', 'e10adc3949ba59abbe56e057f20f883e', 'mr.enyap@gmail.com', '21312312', 'f name', 'l name', NULL, NULL, NULL, 'paypal@test.com', 0.00, 0.00, '2012-07-02 11:22:59', '2012-06-13 09:32:25', '2012-07-10 20:14:16', NULL, NULL, NULL, NULL, '3740fd0433277bcec30781464efb0f89', '2012-06-13 09:32:49', '2012-06-13 09:32:16', '2012-07-10 20:14:16', 'Male', '23'),
(62, 8, 1, 0, 0, 0, 0, 0, 'sg-achara007-62', 'achara007', '0312fdea2bf21328118227024448b7ca', 'acharahensel@yahoo.de', NULL, 'ACHARA', 'hensel', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-15 09:41:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-15 09:37:22', '2012-06-15 09:41:32', NULL, NULL),
(63, 8, 1, 0, 0, 0, 0, 0, 'sg-merchant-63', 'merchant', 'e10adc3949ba59abbe56e057f20f883e', 'merchant@winmaweb.com', NULL, 'f name', 'l name', 'merchant company', 'vat', NULL, NULL, 0.00, 0.00, NULL, NULL, '2012-06-18 10:36:23', '2012-06-15 13:52:49', NULL, NULL, NULL, NULL, NULL, '2012-06-15 13:51:38', '2012-06-18 10:36:23', NULL, NULL),
(64, 8, 1, 0, 0, 0, 0, 0, 'sg-buyer-64', 'buyer', 'e10adc3949ba59abbe56e057f20f883e', 'buyer@winmaweb.com', '1234', 'f name b', 'l name b', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-15 14:04:07', '2012-06-17 12:48:23', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-15 14:03:49', '2012-06-17 12:48:23', 'Male', '55'),
(65, 17, 1, 0, 0, 0, 0, 0, 'sg-registrationtester-65', 'registrationtester', 'e10adc3949ba59abbe56e057f20f883e', 'chris@winmaweb.com', '876876', '2Chris', '2Tarn', 'Agent Dude', '123456789', NULL, NULL, 0.00, 0.00, NULL, '2012-06-16 07:04:28', '2012-07-06 00:32:53', NULL, NULL, '2012-06-19 00:44:22', NULL, NULL, NULL, '2012-06-16 05:50:23', '2012-07-06 00:32:53', 'Male', '38'),
(66, 9, 1, 0, 0, 0, 0, 0, 'sg-ivk-66', 'ivk', '4a7fd8b7cc87de7d3f9af7102e4694b4', 'ingka@siteisfied.com', '21321', 'Ivk', 'Ivk', NULL, NULL, NULL, 'test@test.com', 0.00, 0.00, NULL, '2012-07-09 08:24:11', '2012-07-09 08:24:33', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-17 05:06:21', '2012-07-09 10:12:10', 'Male', '45'),
(67, 8, 1, 0, 0, 0, 0, 0, 'sg-marcinthailand-67', 'marcinthailand', '62ad1e7c87d3e916ce04cdf70872a4ed', 'zwartgeelrood@yahoo.com', NULL, 'Marc', 'Heylen', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-20 11:03:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-20 07:41:48', '2012-06-20 11:03:03', NULL, NULL),
(68, 17, 1, 0, 0, 0, 0, 0, 'sg-cfo-68', 'cfo', 'e10adc3949ba59abbe56e057f20f883e', 'cfo@winmaweb.com', NULL, 'Chris CFO', 'Tarn CFO', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-21 09:29:55', '2012-06-21 11:31:14', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-21 09:26:30', '2012-06-21 11:31:14', NULL, NULL),
(69, 17, 1, 0, 0, 0, 0, 0, 'sg-sillytest-69', 'sillytest', 'e10adc3949ba59abbe56e057f20f883e', 'sillytest@hotmail.com', NULL, 'Silly', 'Test', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:12:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-21 12:09:35', '2012-08-15 11:12:52', NULL, NULL),
(70, 8, 1, 0, 0, 0, 0, 0, 'sg-nick-76-70', 'nick-76', 'f63eae476ee6c79b6fa73445524eb987', 'dogtooth7677@yahoo.com', NULL, 'Nicholas', 'Chew', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-06-24 12:01:30', '2012-06-24 12:08:21', NULL, NULL, NULL, NULL, NULL, NULL, '2012-06-24 12:00:27', '2012-06-24 12:08:21', NULL, NULL),
(71, 8, 1, 0, 0, 0, 0, 0, 'sg-nickchew-71', 'nickchew', '203f3131dd9fd43b2584204fb4acbc51', 'nicholaschew7677@gmail.com', NULL, 'Nicholas', 'Chew', NULL, NULL, NULL, NULL, 0.00, 0.00, '2012-07-30 11:14:34', '2012-06-24 12:57:33', '2012-07-30 11:12:01', NULL, NULL, NULL, NULL, NULL, '2012-07-22 12:53:19', '2012-06-24 12:57:14', '2012-07-30 11:14:34', NULL, NULL),
(72, 18, 1, 0, 0, 0, 0, 0, 'sg-mari-72', 'mari', 'b6254e34265d684d526d5ac9dbca0026', 'marihakami@hotmail.com', NULL, 'Mari', 'Hakami', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-02 09:59:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-02 09:53:16', '2012-07-02 09:59:57', NULL, NULL),
(73, 9, 1, 0, 0, 0, 0, 0, 'sg-ingka2-73', 'ingka2', 'e10adc3949ba59abbe56e057f20f883e', 'niicco@hotmail.com', NULL, 'Ingka', 'Kalm', 'Ingka2 Agent', 'Agent 231321321', NULL, NULL, 0.00, 0.00, NULL, '2012-07-09 04:39:22', '2012-07-09 07:26:35', NULL, NULL, '2012-07-09 05:13:40', NULL, NULL, '2012-07-09 04:54:10', '2012-07-09 04:38:46', '2012-07-09 07:26:35', NULL, NULL),
(74, 17, 1, 0, 0, 0, 0, 0, 'sg-dcochrane1-74', 'dcochrane1', '9e41c0ea65660ea83bc59704fa618e29', 'davidcoch@gmail.com', '', 'David', 'Cochrane', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-09 09:30:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-09 09:27:41', '2012-07-09 09:38:03', '', ''),
(75, 39, 1, 0, 0, 0, 0, 0, 'sg-emilio-75', 'emilio', '4b9c6d4f5b629c1f96a16c2a3306adb7', 'ayrton@hotmail.com', NULL, 'Emilio', 'Ricaldi Suarez', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:13:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-09 12:36:13', '2012-08-15 11:13:01', NULL, NULL),
(76, 39, 1, 0, 0, 0, 0, 0, 'sg-manuel-76', 'manuel', 'e10adc3949ba59abbe56e057f20f883e', 'ricaldi24@hotmail.com', NULL, 'Manuel', 'Ricaldi Suarez', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-09 12:59:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-09 12:40:09', '2012-07-09 12:59:46', NULL, NULL),
(77, 39, 1, 0, 0, 0, 0, 0, 'sg-anne-77', 'anne', '7028f20c531b1c68216369846d676f45', 'iken.anne@gmail.com', NULL, 'Anne', 'Iken', NULL, NULL, NULL, NULL, 0.00, 0.00, '2012-07-09 17:04:19', '2012-07-09 17:02:17', '2012-07-09 18:04:58', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-09 17:01:34', '2012-07-09 18:04:58', NULL, NULL),
(78, 39, 1, 0, 0, 0, 0, 0, 'sg-christof-78', 'christof', 'cc821f31d270183974cc14bf3a2a31b4', 'christof.torck@euphonynet.be', NULL, 'Christof', 'Torck', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:13:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-09 18:12:19', '2012-08-15 11:13:12', NULL, NULL),
(79, 11, 1, 0, 0, 0, 0, 0, 'sg-salihinsalim-79', 'salihinsalim', '8d0114c64863f2bf311ff1873f774abc', 'salihinsalim@gmail.com', NULL, 'Salihin', 'Salim', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-11 07:25:16', '2012-07-11 08:07:20', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 07:24:28', '2012-07-11 08:07:20', NULL, NULL),
(80, 11, 1, 0, 0, 0, 0, 0, 'sg-fir-80', 'fir', 'e43dfa0615a1ca27a62e35183b88910d', 'mdfirdausanuar@gmail.com', NULL, 'Firdaus', 'Anuar', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-11 07:28:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 07:27:39', '2012-07-11 07:28:58', NULL, NULL),
(81, 11, 1, 0, 0, 0, 0, 0, 'sg-nadia-81', 'nadia', '0544aa53a51591518f9034d9d58ecc0f', 'nadiawednesday19@hotmail.com', NULL, 'nadia', 'wednesday', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-12 10:06:49', '2012-07-12 11:00:06', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-12 10:04:55', '2012-07-12 11:00:06', NULL, NULL),
(82, 81, 1, 0, 0, 0, 0, 0, 'sg-junglesafari-82', 'junglesafari', '5d991220a07e65eb7ab854341691ca7d', 'freakineasy@hotmail.com', NULL, 'safari', 'rahim', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-12 10:25:34', '2012-07-27 23:26:26', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-12 10:14:06', '2012-07-27 23:26:26', NULL, NULL),
(83, 82, 1, 0, 0, 0, 0, 0, 'sg-nadzira-83', 'nadzira', 'f15b286289bb89bf41c126a9c5f93320', 'nadz.wednesday@gmail.com', NULL, 'nadzira', 'wednesday', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-12 10:33:55', '2012-07-12 10:51:03', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-12 10:32:00', '2012-07-12 10:51:03', NULL, NULL),
(84, 83, 1, 0, 0, 0, 0, 0, 'sg-jazzy-84', 'jazzy', 'f15b286289bb89bf41c126a9c5f93320', 'jazz_smiley@hotmail.com', NULL, 'Jazzy', 'Jumaat', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:13:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-12 10:58:29', '2012-08-15 11:13:21', NULL, NULL),
(85, 41, 1, 0, 0, 0, 0, 0, 'sg-thetapper-85', 'thetapper', 'c83e7eca1d7067cc2133c2fd783a16c3', 'dussi@telenet.be', NULL, 'Jan', 'Dusselier', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-12 17:45:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-12 17:42:45', '2012-07-12 17:45:46', NULL, NULL),
(86, 11, 1, 0, 0, 0, 0, 0, 'sg-natashaabidin-86', 'natashaabidin', '4f6f28a9c274c05452f49f59c668a30e', 'natashaabidin@gmail.com', '83351811', 'Norsuhailah Natasha', 'Abidin', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-13 02:47:48', '2012-07-13 03:33:40', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-13 02:46:54', '2012-07-13 03:33:40', 'Female', '20'),
(87, 86, 1, 0, 0, 0, 0, 0, 'sg-sadiqsukiantor-87', 'sadiqsukiantor', '7e37372d54bc0224e9b69b35a0b9090e', 'diq_o@hotmail.com', NULL, 'Sadiq', 'Sukiantor', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:13:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-13 03:36:09', '2012-08-15 11:13:30', NULL, NULL),
(88, 82, 1, 0, 0, 0, 0, 0, 'sg-sarahosgodby-88', 'sarahosgodby', '4b37389cc1bfb4f6496e8e12bd5b1f81', 'sarah_osgodby@hotmail.com', NULL, 'sarah', 'osgodby', NULL, NULL, NULL, NULL, 0.00, 0.00, '2012-07-21 11:20:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-13 14:07:52', '2012-07-13 03:42:37', '2012-07-21 11:20:50', NULL, NULL),
(89, 82, 1, 0, 0, 0, 0, 0, 'sg-farah-89', 'farah', '54f45eebb3b02be180cdecab49f9ab40', 'senorita_fawcett@hotmail.com', NULL, 'farah', 'norliza', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-13 05:28:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-13 05:23:17', '2012-07-13 05:28:30', NULL, NULL),
(90, 11, 1, 0, 0, 0, 0, 0, 'sg-ysiti-90', 'ysiti', '985aadc947cf7d1fee0c1b0339cec582', 'ysitia@yahoo.com', '91919191', 'sjdjfh', 'jdhfuos', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-13 11:16:33', '2012-07-13 11:53:26', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-13 11:14:31', '2012-07-13 12:05:42', NULL, NULL),
(91, 11, 1, 0, 1, 0, 100, 100, 'sg-ydeals-91', 'ydeals', '985aadc947cf7d1fee0c1b0339cec582', 'ysitisuhaila@yahoo.com', NULL, 'Siti Suhaila', 'Yahya-Ong', 'Wayan Retreat Balinese Spa', '12345678', NULL, NULL, 1.76, 0.00, NULL, '2012-07-13 12:08:28', '2012-07-19 22:07:27', '2012-07-18 09:48:40', NULL, '2012-07-18 09:46:49', NULL, NULL, NULL, '2012-07-13 12:07:41', '2012-07-19 22:07:27', NULL, NULL),
(92, 82, 1, 0, 0, 0, 0, 0, 'sg-sarahanissa-92', 'sarahanissa', 'e2c209b9ce4187d19e48d7b8d53f8c4a', 'sarahosgodby@gmaill.com', NULL, 'Sarah', 'Anissa', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:13:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-13 14:03:43', '2012-08-15 11:13:39', NULL, NULL),
(93, 11, 1, 0, 0, 0, 0, 0, 'sg-zuwid0909-93', 'zuwid0909', 'da2ed4bd8b21ba55567370fab8863614', 'zuwid@yahoo.com.sg', NULL, 'WIDYA', 'MISBARI', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-16 02:12:07', '2012-07-16 02:15:35', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-16 02:10:11', '2012-07-16 02:15:35', NULL, NULL),
(94, 11, 1, 0, 0, 0, 0, 0, 'sg-zumbayvonne-94', 'zumbayvonne', 'e10adc3949ba59abbe56e057f20f883e', 'violet6_fm@hotmail.com', NULL, 'yvonne', 'feng', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-16 03:44:44', '2012-07-16 03:45:37', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-16 03:43:01', '2012-07-16 03:45:37', NULL, NULL),
(95, 11, 1, 0, 0, 0, 0, 0, 'sg-starrycarin-95', 'starrycarin', '519ee2f0433bacec42613c64c8d405a7', 'anazor@gmail.com', NULL, 'Rozana', 'Rashid', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-16 09:43:18', '2012-07-16 23:52:49', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-16 09:41:51', '2012-07-16 23:52:49', NULL, NULL),
(96, 11, 1, 0, 0, 0, 0, 0, 'sg-omarchik-96', 'omarchik', '746b73a1816b5ed26901816f62a883ef', 'tressesc02@hotmail.com', NULL, 'omar', 'chik', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:13:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-16 09:55:45', '2012-08-15 11:13:47', NULL, NULL),
(97, 19, 1, 0, 0, 0, 0, 0, 'sg-baxiang0377-97', 'baxiang0377', '81dc2e494b9db20313f28249ab00d891', 'vincentlee_tks87@hotmail.com', NULL, 'Tan', 'keng siang', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:14:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-16 14:02:22', '2012-08-15 11:14:01', NULL, NULL),
(98, 49, 1, 0, 0, 0, 0, 0, 'sg-yeoh-98', 'yeoh', '45677140128405a7999b62ff8ec2dbec', 'jessamine@igenius.sg', '+65 9799 9808', 'Jessamine', 'Teo', NULL, NULL, NULL, NULL, 9.70, 0.00, NULL, '2012-07-16 22:46:15', '2012-07-18 09:22:13', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-16 22:45:13', '2012-07-18 09:32:16', 'Female', '40'),
(99, 11, 1, 0, 0, 0, 0, 0, 'sg-joeblack-99', 'joeblack', '3b85221fd4107ac8a38786aa9ebaa1e9', 'joerahman69@gmail.com', NULL, 'Joe', 'Black', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-17 07:00:45', '2012-07-17 12:32:23', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-17 06:59:29', '2012-07-17 12:32:23', NULL, NULL),
(100, 11, 1, 0, 0, 0, 0, 0, 'sg-firdausfidrahman-100', 'firdausfidrahman', '8d9c6356bccbda2b57839b0149062669', 'impz_03@hotmail.com', NULL, 'Firdaus', 'Rahman', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:14:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-17 22:53:52', '2012-08-15 11:14:11', NULL, NULL),
(101, 11, 1, 0, 0, 0, 0, 0, 'sg-susybachtiar-101', 'susybachtiar', 'd334df22153505b70514dafae020dcdf', 'susylembong@gmail.com', NULL, 'Susy', 'Bachtiar', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-19 09:27:39', '2012-07-19 09:30:13', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 09:10:42', '2012-07-19 09:30:13', NULL, NULL),
(102, 11, 1, 0, 0, 0, 3, 0, 'sg-darylpts-102', 'darylpts', '85477e5c81237bc84f024a0b4e4952c1', '337peter@gmail.com', '90250743', 'Peter ', 'Lee', 'Daryl Peterson International', '52838317E', NULL, NULL, 0.00, 0.00, NULL, '2012-07-19 09:12:07', '2012-09-13 10:25:47', '2012-07-20 02:25:17', NULL, NULL, NULL, NULL, NULL, '2012-07-19 09:11:46', '2012-09-13 10:25:47', 'Male', ''),
(103, 11, 1, 0, 0, 0, 0, 0, 'sg-chithrarogers-103', 'chithrarogers', '13643268714be69d0a474415820f7bae', 'ezina@ymail.com', NULL, 'chithra', 'rogers', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-19 09:38:32', '2012-07-25 05:30:15', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 09:37:50', '2012-07-25 05:30:15', NULL, NULL),
(104, 103, 1, 0, 0, 0, 0, 0, 'sg-veeramani-104', 'veeramani', 'c8f9d6a9b11d4601d4970984faadb718', 'veeramani4029@yahoo.com.sg', NULL, 'veeramani', 'karuppiah', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-19 09:43:05', '2012-07-19 09:44:11', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 09:41:16', '2012-07-19 09:44:11', NULL, NULL),
(105, 104, 1, 0, 0, 0, 0, 0, 'sg-jag0001-105', 'jag0001', '13a451d447cc60d332637e9f08041a1d', 'vivek1@live.com.au', NULL, 'Vivek ', 'Jagatheson', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:14:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 09:47:13', '2012-08-15 11:14:21', NULL, NULL),
(106, 11, 1, 0, 0, 0, 0, 0, 'sg-romifigo2001-106', 'romifigo2001', '82250e888ea37d6dd75fad525c3f986a', 'romifigo2001@yahoo.com', NULL, 'Mohamad Rhomeiny', 'Mohamed Rojis', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-19 11:31:51', '2012-07-23 00:25:22', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 11:31:02', '2012-07-23 00:25:22', NULL, NULL),
(107, 18, 1, 0, 0, 0, 0, 0, 'sg-suziebird-107', 'suziebird', '55f5c01e2cdc1ca530ca72d56e43b4b5', 'suzie6475@yahoo.com', NULL, 'Suzie', 'Bird', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-19 14:19:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 14:18:11', '2012-07-19 14:19:53', NULL, NULL),
(108, 106, 1, 0, 0, 0, 0, 0, 'sg-maanfara-108', 'maanfara', '6e9888a8beb2828a33175bae4c2f16e7', 'mfasantos@gmail.com', NULL, 'Ma''an', 'Santos', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-19 18:23:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 18:22:54', '2012-07-19 18:23:33', NULL, NULL),
(109, 102, 1, 0, 0, 0, 0, 0, 'sg-tommy-109', 'tommy', '3d9fcd181392e88599449a26a8940c66', 'tommyhartono@hotmail.com', '85221633', 'Tommy', 'Tommy', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-19 23:20:28', '2012-07-24 07:59:45', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-19 23:19:24', '2012-07-24 07:59:45', 'Male', '21'),
(110, 109, 1, 0, 0, 0, 0, 0, 'sg-smalldrack-110', 'smalldrack', '8ddcff3a80f4189ca1c9d4d902c3c909', 'smalldrack@hotmail.com', NULL, 'Song', 'hao', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-20 12:09:53', '2012-07-23 07:00:18', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-20 12:08:59', '2012-07-23 07:00:18', NULL, NULL),
(111, 71, 1, 0, 0, 0, 0, 0, 'sg-alfyayob-111', 'alfyayob', '7baa0ce4415e8091aec4b495c2c12ba9', 'longlashes29@yahoo.com', NULL, 'ALFRAYDA', 'Ayob', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-23 10:54:26', '2012-07-23 10:56:23', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-23 10:53:50', '2012-07-23 10:56:23', NULL, NULL),
(112, 22, 1, 0, 0, 0, 0, 0, 'sg-skyrock23-112', 'skyrock23', 'd55028a2dd2c5e484d68b97fbaf4c20b', 'cakemaniah@yahoo.com.sg', NULL, 'su', 'harti', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-24 19:31:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-24 19:30:51', '2012-07-24 19:31:56', NULL, NULL),
(113, 22, 1, 0, 0, 0, 0, 0, 'sg-maywgk-113', 'maywgk', 'ce5de5207f967bc6b3c9ead3db51602c', 'maywgk@gmail.com', NULL, 'May', 'Wong', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-24 19:46:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-24 19:45:44', '2012-07-24 19:46:18', NULL, NULL),
(114, 22, 1, 0, 0, 0, 0, 0, 'sg-chian1605-114', 'chian1605', 'a377a06010c7bb60cdd6a45f4355cac1', 'chianleepoh@yahoo.com.sg', NULL, 'lee chian', 'poh', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:14:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-25 02:45:41', '2012-08-15 11:14:33', NULL, NULL),
(115, 16, 1, 0, 0, 0, 0, 0, 'sg-ophirmagic-115', 'ophirmagic', '2a9eacb69c24df92b1b5403f9049acbe', 'ophirmagic@optusnet.com.au', NULL, 'Ophir', 'Zenou', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:14:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-27 11:10:34', '2012-08-15 11:14:42', NULL, NULL),
(116, 18, 1, 0, 0, 0, 0, 0, 'sg-marlene-116', 'marlene', 'a7f0509c3bc0fc0fe4647ceab4900124', 'marlenevirginia@aol.com', NULL, 'Marlene', 'Virginia', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-30 06:47:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-30 06:45:18', '2012-07-30 06:47:32', NULL, NULL),
(117, 18, 1, 0, 0, 0, 0, 0, 'sg-rayenseow-117', 'rayenseow', 'c2620b3b78006947ecb5c25791bcc4ce', 'rayenseow@gmail.com', NULL, 'Rayen', 'Seow', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-30 14:43:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-30 08:49:58', '2012-07-30 14:43:22', NULL, NULL),
(118, 17, 1, 0, 0, 0, 0, 0, 'sg-nutgamon-118', 'nutgamon', '77094ddb5b35f4d49ea53e320f626f02', 'nutgamon2007@hotmail.com', NULL, 'nutgamon', 'buathong', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-30 14:42:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-30 09:29:33', '2012-07-30 14:42:59', NULL, NULL),
(119, 116, 1, 0, 0, 0, 0, 0, 'sg-dadelaw-119', 'dadelaw', 'a7f0509c3bc0fc0fe4647ceab4900124', 'dadelaw@aol.com', NULL, 'Richard', 'Martin', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-30 14:29:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-30 14:28:31', '2012-07-30 14:29:09', NULL, NULL),
(120, 109, 1, 0, 0, 0, 0, 0, 'sg-tackey-120', 'tackey', '836f0915a9c8eba7fd2ff45c03e76bba', 'dark_anima_tackey@hotmail.com', NULL, 'yeow', 'jia xin', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-31 00:09:55', '2012-07-31 02:18:25', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-31 00:08:53', '2012-07-31 02:18:25', NULL, NULL),
(121, 120, 1, 0, 0, 0, 0, 0, 'sg-alexang-121', 'alexang', '23491f15624d60de75d7193afa327b75', 'alexang711_1986@hotmail.com', NULL, 'Ang', 'Alex', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-31 03:30:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-31 03:29:53', '2012-07-31 03:30:30', NULL, NULL),
(122, 18, 1, 0, 0, 0, 0, 0, 'sg-mslobster-122', 'mslobster', '22eda8012224d2094601e52c9ff66bdc', 'mslobsterad@gmail.com', NULL, 'atcharapun', 'daiporn', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-31 07:20:00', '2012-08-01 10:25:07', NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-31 07:08:24', '2012-08-01 10:25:07', NULL, NULL),
(123, 18, 1, 0, 0, 0, 0, 0, 'sg-darkpanda-123', 'darkpanda', '91b841f083f4cf44db019ffb7eb498f8', 'hidekung9@hotmail.com', NULL, 'Eakaluk', 'Apirucksaroch', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-31 14:14:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-31 08:49:10', '2012-07-31 14:14:42', NULL, NULL),
(124, 19, 1, 0, 0, 0, 0, 0, 'sg-xeph1988-124', 'xeph1988', '1d729b881b5e74d73cbe15e7aab2b855', 'xeph_jerome@hotmail.com', NULL, 'Jerome ', 'Soh', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-31 14:14:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-31 11:48:27', '2012-07-31 14:14:30', NULL, NULL),
(125, 18, 1, 0, 0, 0, 0, 0, 'sg-jajatasana-125', 'jajatasana', '7647cc2868ac834a363c5241c62b8fa0', 'graffiti_bsb_dyskel@yahoo.com', NULL, 'Jaja', 'DySkel', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-07-31 14:14:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-31 13:29:25', '2012-07-31 14:14:17', NULL, NULL),
(126, 122, 1, 0, 1, 0, 100, 100, 'sg-3ecpa-126', '3ecpa', 'bfb0a91f07018838565a635322f4b98d', 'lawrencechai@3ecpa.com.sg', NULL, 'Lawrence', 'Chai', '3E Accounting Pte. Ltd.', '201120337C', NULL, NULL, 0.00, 0.00, '2012-09-05 10:04:29', '2012-08-01 03:21:04', '2012-09-05 10:03:32', '2012-08-01 11:32:05', NULL, '2012-08-01 11:31:06', NULL, NULL, NULL, '2012-08-01 03:20:45', '2012-09-05 10:04:29', NULL, NULL),
(127, 122, 1, 0, 1, 0, 100, 100, 'sg-miangz-127', 'miangz', '48a7470215e84e672432613c3fcaa3e7', 'miangz@hotmail.com', NULL, 'Ben', 'Kunarat', 'Siam Ramita Co.,Ltd', '123456789', NULL, NULL, 0.00, 0.00, NULL, '2012-08-01 06:11:38', '2012-08-01 07:45:25', '2012-08-01 07:48:27', NULL, '2012-08-01 07:46:32', NULL, NULL, NULL, '2012-08-01 06:10:51', '2012-08-01 07:48:31', NULL, NULL),
(128, 127, 1, 0, 0, 0, 0, 0, 'sg-franzb83-128', 'franzb83', 'f37493cf643fb57ccfae971dc3ca5344', 'fbeaujobs@gmail.com', NULL, 'Franz', 'Beauquel', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-01 06:15:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-01 06:13:37', '2012-08-01 06:15:19', NULL, NULL),
(129, 122, 1, 0, 1, 0, 100, 100, 'sg-edwardkcy-129', 'edwardkcy', '7d2425bf500009321e8b61e130f7c6bc', 'edwardkcy@yahoo.com', NULL, 'Khoo', 'Edward', 'Puma sports', 'G7%', NULL, NULL, 0.00, 0.00, NULL, '2012-08-01 09:31:32', '2012-08-10 06:58:37', '2012-08-01 09:39:58', NULL, '2012-08-01 09:38:05', NULL, NULL, NULL, '2012-08-01 09:28:46', '2012-08-10 06:58:37', NULL, NULL),
(130, 122, 1, 0, 0, 0, 0, 0, 'sg-eak-130', 'eak', 'a7491197a208f6145e03a76f78ed9f6e', 'jeejom_23@hotmail.com', NULL, 'Eakkapol', 'Jeejom', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-01 12:04:48', '2012-08-02 11:24:59', NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-01 11:56:40', '2012-08-02 11:24:59', NULL, NULL),
(131, 130, 1, 0, 0, 0, 0, 0, 'sg-aon-131', 'aon', '3d63564a3ad769561b97b6efad4e578b', 'thanchanchanin@hotmail.com', NULL, 'Nunthaphuk', 'Thanchanchanin', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:14:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-01 12:37:01', '2012-08-15 11:14:52', NULL, NULL),
(132, 130, 1, 0, 0, 0, 0, 0, 'sg-narmwarn-132', 'narmwarn', 'b9a2b4a80a1dd3adf6b433a6997f9476', 'narmwarn_23@hotmail.com', NULL, 'Pimwarin', 'Yamsuan', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-03 01:05:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-02 11:33:31', '2012-08-03 01:05:44', NULL, NULL),
(133, 17, 1, 0, 0, 0, 0, 0, 'sg-ae5aw-133', 'ae5aw', 'e10adc3949ba59abbe56e057f20f883e', 'sanangelotarns@wtxs.net', '325-949-0380', 'William Rees', 'Tarn', NULL, NULL, NULL, NULL, 24.25, 0.00, '2012-08-04 07:36:51', '2012-08-02 15:11:29', '2012-09-28 11:05:33', NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-02 15:09:53', '2012-09-28 11:05:33', 'Male', '65'),
(134, 18, 1, 0, 0, 0, 0, 100, 'sg-jobea-134', 'jobea', '52c69e3a57331081823331c4e69d3f2e', 'patrickyong@ymail.com', NULL, 'Patrick', 'Yong', 'Patrick', '12345', NULL, NULL, 0.00, 0.00, NULL, '2012-08-03 02:41:27', '2012-08-03 02:45:10', NULL, NULL, '2012-08-03 02:43:36', NULL, NULL, NULL, '2012-08-03 02:34:45', '2012-08-03 02:45:25', NULL, NULL),
(135, 122, 1, 0, 0, 0, 0, 100, 'sg-jxyy44-135', 'jxyy44', '7e9a8e67197bad8ec246bde2c4cebfb9', 'jxyy44@yahoo.com.sg', NULL, 'Jenny', 'Siau', 'Jenny Siau', 'S7670283G', NULL, NULL, 0.00, 0.00, NULL, '2012-08-03 09:11:47', '2012-08-03 09:51:48', NULL, NULL, '2012-08-03 09:18:08', NULL, NULL, NULL, '2012-08-03 09:10:52', '2012-08-03 09:51:48', NULL, NULL),
(136, 135, 1, 0, 0, 0, 0, 100, 'sg-haryono-136', 'haryono', '936407f46b4d9eb9c8c68b851e5baf50', 'eme_louis@yahoo.com.sg', NULL, 'Emerson', 'Louis', 'Emerson Louis haryono', 'S7807240g', NULL, NULL, 0.00, 0.00, NULL, '2012-08-03 09:22:44', NULL, NULL, NULL, '2012-08-03 09:25:53', NULL, NULL, NULL, '2012-08-03 09:20:59', '2012-08-03 09:32:44', NULL, NULL),
(137, 20, 1, 0, 0, 0, 0, 0, 'sg-tapan-137', 'tapan', '0ff8966ca4c1071abbc7c9e50d7a9e4c', 'tapan_ghadge@yahoo.co.in', NULL, 'tapan', 'ghadge', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-05 02:16:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-05 02:16:35', '2012-08-05 02:16:56', NULL, NULL),
(138, 133, 1, 0, 0, 0, 0, 0, 'sg-queen-138', 'queen', '20c65af11a5f4136f0c3220150c81e58', 'js.kelly@yahoo.com', NULL, 'Jessel', 'Kelly', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-05 15:09:13', '2012-09-26 17:49:12', NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-05 15:06:39', '2012-09-26 17:49:12', NULL, NULL),
(139, 133, 1, 0, 0, 0, 0, 0, 'sg-sable21977-139', 'sable21977', 'a0e65e2e1d8d3a3befbec84aabdf43c9', 'sable21977@aol.com', NULL, 'Pam', 'Robinson', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-06 10:00:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-06 09:59:43', '2012-08-06 10:00:33', NULL, NULL),
(140, 139, 1, 0, 0, 0, 0, 0, 'sg-tbum-140', 'tbum', 'a0e65e2e1d8d3a3befbec84aabdf43c9', 'tbum@aol.com', NULL, 'Hughbert', 'Robinson', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-06 17:47:09', NULL, NULL, NULL, NULL, NULL, '313097139d910021436dda9a7e8e14ab', '2012-08-09 19:42:40', '2012-08-06 10:37:09', '2012-08-09 19:42:40', NULL, NULL),
(141, 133, 1, 0, 0, 0, 0, 0, 'sg-blossom-141', 'blossom', '2af1c4b055026973e27a7d2a84bdf1a6', 'hondamno@gmail.com', NULL, 'blossom', 'owens', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-11 23:33:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-06 11:28:27', '2012-08-11 23:33:49', NULL, NULL),
(142, 138, 1, 0, 0, 0, 0, 0, 'sg-natethegreat-142', 'natethegreat', '1452a6d3aa2d52f0c0cf04571d6bc194', 'hendersonlavertis@yahoo.com', NULL, 'Lavertis', 'Henderson', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-11 23:33:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-06 12:52:42', '2012-08-11 23:33:37', NULL, NULL),
(143, 18, 1, 0, 0, 0, 0, 0, 'sg-waynekoh-143', 'waynekoh', 'dcd4be523ca91f9aae836f5bf641fcec', 'waynekohwg@gmail.com', NULL, 'Wayne', 'Koh', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-08 02:10:14', '2012-08-08 02:11:05', NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-08 02:08:56', '2012-08-08 02:11:05', NULL, NULL),
(144, 22, 1, 0, 0, 0, 0, 0, 'sg-adelinagrace-144', 'adelinagrace', '2d4fb7601bbca16a6dd45fb73c2a5f82', 'adelinagrace@yahoo.com.sg', '+6593625312', 'Adeline', 'Lee', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-11 06:43:47', '2012-08-16 02:52:22', NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-10 04:16:10', '2012-08-16 02:52:22', 'Female', '30'),
(145, 22, 1, 0, 0, 0, 0, 0, 'sg-faithe83-145', 'faithe83', '0b1508a6582eab5016d56ee8377a5d22', 'phoebesim83@hotmail.com', NULL, 'Phoebe', 'Sim', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-11 23:33:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-11 09:20:14', '2012-08-11 23:33:08', NULL, NULL),
(146, 22, 1, 0, 0, 0, 0, 0, 'sg-tracywps-146', 'tracywps', '48a221738b02515d128801176e070392', 'tracy.wps@gmail.com', NULL, 'Tracy', 'Wong', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-15 11:11:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-15 03:27:55', '2012-08-15 11:11:48', NULL, NULL),
(147, 18, 0, 0, 0, 0, 0, 0, 'sg-underoh-147', 'underoh', '833ef31e90725f37ce079b55cba614a5', 'stevewood007@hotmail.com', NULL, 'Steve ', 'Wood', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-17 16:35:30', '2012-08-17 16:35:30', NULL, NULL),
(148, 9, 0, 0, 0, 0, 0, 0, 'sg-test-148', 'test', '4a7fd8b7cc87de7d3f9af7102e4694b4', 'test@siteisfied.com', NULL, 'test', 'test', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-28 03:25:17', '2012-08-28 03:25:17', NULL, NULL),
(149, 9, 0, 0, 0, 0, 0, 0, 'sg-test1-149', 'test1', '4a7fd8b7cc87de7d3f9af7102e4694b4', 'ingemar.von.kalm@gmail.com', NULL, 'Testing', 'Testing', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '042b42ec35572ce1b8bd27881c3c6fa4', '2012-08-28 03:30:49', '2012-08-28 03:28:16', '2012-08-28 03:30:49', NULL, NULL),
(150, 10, 1, 1, 0, 0, 0, 0, 'sg-testforlink-150', 'testforlink', 'e10adc3949ba59abbe56e057f20f883e', 'digitaldreamsdesign@me.com', NULL, 'test', 'alatet', NULL, NULL, NULL, NULL, 0.00, 0.00, NULL, '2012-08-31 02:25:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-08-31 02:21:18', '2012-08-31 02:25:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE IF NOT EXISTS `user_address` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `latitude` double(18,2) DEFAULT NULL,
  `longitude` double(18,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `country_id_idx` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=165 ;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `address`, `city`, `county`, `postcode`, `country_id`, `latitude`, `longitude`) VALUES
(17, 3, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(18, 4, 'wmw2 street', 'city2', 'County2', '2222222', 198, NULL, NULL),
(19, 5, 'Adress', 'City', 'Proivice', '3213', 198, NULL, NULL),
(20, 6, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(21, 7, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(22, 8, '12 Stirling Road 01-13', 'Queenstown', 'Singapore', '148955', 198, NULL, NULL),
(23, 9, 'Adress', 'City', 'Province', '123456', 198, NULL, NULL),
(24, 10, 'asdasd', 'asdasda', 'asdasd', '1111', 198, NULL, NULL),
(25, 11, 'Stirling 12', 'Queenstown', 'Singapore', '148955', 198, NULL, NULL),
(26, 12, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(27, 13, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(28, 14, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(29, 15, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(30, 16, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(31, 17, '3338 McManus Ave', 'LA', 'California', '90232', 198, NULL, NULL),
(32, 18, '3338 McManus Ave', 'Culver City', 'California', '90232', 198, NULL, NULL),
(33, 19, 'Blk 266A Compassvale Bow', 'Singapore ', 'Singapore', '541266', 198, NULL, NULL),
(34, 20, 'Blk 148. Silat Ave', '#03-02', 'Singapore', '160148', 198, NULL, NULL),
(35, 21, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(36, 22, 'Blk 166 Bishan St 13 # 04 - 246', 'Singapore', 'Singapore ', '570166', 198, NULL, NULL),
(37, 23, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(38, 24, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(39, 25, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(40, 26, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(41, 27, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(42, 28, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(43, 29, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(44, 30, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(45, 31, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(46, 32, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(47, 33, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(48, 34, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(49, 35, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(50, 36, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(51, 37, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(52, 38, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(53, 39, 'Av. Los Libertadores 350', 'Lima', 'ATE/Peru', 'Lima 03', 198, NULL, NULL),
(54, 40, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(55, 41, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(56, 42, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(57, 43, '1', '2', 'Singapore', '123456', 198, NULL, NULL),
(58, 44, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(59, 45, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(60, 46, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(61, 47, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(62, 48, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(63, 49, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(64, 50, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(65, 51, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(66, 52, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(67, 53, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(68, 54, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(69, 55, 'Block 2, #13-316 Gim Moh Road', 'Singapore', 'Singapore', '270002', 198, NULL, NULL),
(70, 56, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(71, 57, 'Apt Blk 678, Hougang Avenue 8, #04-513', 'Singapore', 'Singapore', '530678', 198, NULL, NULL),
(72, 58, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(73, 59, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(74, 60, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(75, 61, 'ad', 'asd', 'hkj', 'hkj', 198, NULL, NULL),
(76, 62, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(77, 63, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(78, 64, 'addr', 'city', 'county', 'postal', 198, NULL, NULL),
(79, 65, '76576', 'jhgjkhg', 'jghkj.kj', ',b.kmb.kjbn', 198, NULL, NULL),
(80, 66, 'loljbkj', 'ljbkjbk', 'kjbkljb', 'lkjblkjb', 198, NULL, NULL),
(81, 67, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(82, 68, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(83, 69, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(84, 70, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(85, 71, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(86, 72, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(87, 73, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(88, 74, 'Somewhere', 'Singapore', 'Singapore', '12345', 198, NULL, NULL),
(89, 75, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(90, 76, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(91, 77, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(92, 78, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(93, 79, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(94, 80, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(95, 81, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(96, 82, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(97, 83, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(98, 84, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(99, 85, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(100, 86, 'Blk 840 Jurong West St 81 #03-111', 'Singapore', 'Singapore', '640840', 198, NULL, NULL),
(101, 87, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(102, 88, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(103, 89, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(104, 90, 'xlkxfnlkgjhds', 'jddvus', 'djhvjolsd', '123456', 198, NULL, NULL),
(105, 91, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(106, 92, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(107, 93, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(108, 94, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(109, 95, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(110, 96, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(111, 97, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(112, 98, '34 Tudor Close', 'Singapore', 'Singapore', '297960', 198, NULL, NULL),
(113, 99, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(114, 100, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(115, 101, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(116, 102, '', '', '', '', 198, NULL, NULL),
(117, 103, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(118, 104, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(119, 105, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(120, 106, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(121, 107, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(122, 108, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(123, 109, '16 Stirling Road #09-17', 'Singapore', 'Singapore', '148957', 198, NULL, NULL),
(124, 110, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(125, 111, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(126, 112, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(127, 113, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(128, 114, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(129, 115, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(130, 116, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(131, 117, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(132, 118, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(133, 119, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(134, 120, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(135, 121, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(136, 122, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(137, 123, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(138, 124, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(139, 125, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(140, 126, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(141, 127, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(142, 128, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(143, 129, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(144, 130, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(145, 131, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(146, 132, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(147, 133, '6875 Bismarck Court', 'San Angelo', 'Texas', '76904', 198, NULL, NULL),
(148, 134, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(149, 135, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(150, 136, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(151, 137, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(152, 138, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(153, 139, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(154, 140, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(155, 141, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(156, 142, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(157, 143, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(158, 144, '49 Hoy Fatt Road, #05-107', 'Singapore', 'Singapore', '150049', 198, NULL, NULL),
(159, 145, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(160, 146, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(161, 147, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(162, 148, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(163, 149, NULL, NULL, NULL, NULL, 198, NULL, NULL),
(164, 150, NULL, NULL, NULL, NULL, 198, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_media`
--

CREATE TABLE IF NOT EXISTS `user_media` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `main` tinyint(4) DEFAULT '0',
  `file_name` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'image',
  `ext` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_media`
--

INSERT INTO `user_media` (`id`, `user_id`, `main`, `file_name`, `dir`, `type`, `ext`) VALUES
(1, 55, 1, 'user', '/uploads/users/images', 'image', 'jpg'),
(2, 9, 1, 'user', '/uploads/users/images', 'image', 'jpg'),
(3, 17, 1, 'user', '/uploads/users/images', 'image', 'jpg'),
(4, 73, 1, 'user', '/uploads/users/images', 'image', 'jpg'),
(5, 86, 1, 'user', '/uploads/users/images', 'image', 'jpg'),
(6, 102, 1, 'user', '/uploads/users/images', 'image', 'jpg'),
(7, 109, 1, 'user', '/uploads/users/images', 'image', 'jpg'),
(8, 133, 1, 'user', '/uploads/users/images', 'image', 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `role_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_role_role_id_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(8, 2),
(17, 2),
(22, 2),
(91, 2),
(126, 2),
(127, 2),
(129, 2),
(1, 3),
(8, 4),
(17, 4),
(22, 4),
(91, 4),
(126, 4),
(127, 4),
(129, 4),
(134, 4),
(135, 4),
(136, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_sent_emails`
--

CREATE TABLE IF NOT EXISTS `user_sent_emails` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sent_emails`
--

INSERT INTO `user_sent_emails` (`user_id`, `email`) VALUES
(9, 'ingka@infinita.biz'),
(9, 'ingka@siteisfied.com'),
(9, 'niicco@hotmail.com'),
(22, 'has.positivefocus@gmail.com'),
(22, 'positiveenquiries@gmail.com'),
(22, 'rosesivam@gmail.com'),
(58, 'angie.ng@gammonconstruction.com'),
(58, 'christine.wee@gammonconstruction.com'),
(58, 'crystal.lim@gammonconstruction.com'),
(58, 'dennis.chan@gammonconstruction.com'),
(58, 'elizabeth.goh@gammonconstruction.com'),
(58, 'jasmine.ng@gammonconstruction.com'),
(58, 'lianyun.mak@gammonconstruction.com'),
(58, 'pangboon.chan@gammonconstruction.com'),
(58, 'siti.sulastri@gammonconstruction.com'),
(58, 'xiaoyu.su@gammonconstruction.com'),
(71, 'chienchan02@gmail.com'),
(71, 'longlashes29@yahoo.com'),
(77, 'kb.pieter@gmail.com'),
(88, 'beyoncar45@hotmail.com'),
(88, 'juliana_z@rocketmail.com'),
(88, 'mpointsfinger@gmail.com'),
(88, 'shanderella@hotmail.sg'),
(88, 'silvy_tjokro@hotmail.com'),
(126, 'calljeet_2001@yahoo.com'),
(133, 'abmii@windstream.net'),
(133, 'alex0773@att.net'),
(133, 'arstone@sbcglobal.net'),
(133, 'asu616@yahoo.com'),
(133, 'bjrl@verizon.net'),
(133, 'bob@tahoetarns.com'),
(133, 'bumperbuckshot@gmail.com'),
(133, 'carlpalmer@hotmail.com'),
(133, 'cobra2postgate@aol.com'),
(133, 'constructoravistareal@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_request`
--

CREATE TABLE IF NOT EXISTS `withdraw_request` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `amount` double(18,2) DEFAULT NULL,
  `reason` text,
  `account_number` text,
  `beneficiary_name` text,
  `bank_code` text,
  `bank_branch_code` text,
  `bank_account_number` text,
  `bank_name` text,
  `bank_address` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statusindex_idx` (`status`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `withdraw_request`
--

INSERT INTO `withdraw_request` (`id`, `user_id`, `type`, `status`, `amount`, `reason`, `account_number`, `beneficiary_name`, `bank_code`, `bank_branch_code`, `bank_account_number`, `bank_name`, `bank_address`, `created_at`, `updated_at`) VALUES
(1, 17, 1, 2, 400.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-09 03:17:30', '2012-07-09 03:18:09'),
(3, 66, 1, 1, 500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-09 10:04:31', '2012-07-09 10:06:35'),
(4, 66, 1, 2, 500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-09 10:08:19', '2012-07-09 10:08:38'),
(5, 66, 2, 1, 200.00, NULL, NULL, 'vsvgsd', 'gsdgsd', 'gsdgs', 'dgsdgsd', 'OCBC', 'gsdgsdgsdg', '2012-07-09 10:11:51', '2012-07-09 10:12:10'),
(6, 66, 2, 2, 200.00, NULL, NULL, 'fgsdgsd', 'gsg', 'sdgsd', 'gsdgsdg', 'OCBC', 'sdgs', '2012-07-09 10:12:51', '2012-07-09 10:13:27'),
(7, 8, 1, 1, 51.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 11:09:12', '2012-07-11 11:12:57'),
(8, 8, 1, 2, 56.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-07-11 11:14:54', '2012-07-11 11:15:56');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_question_id_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answer_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `charity`
--
ALTER TABLE `charity`
  ADD CONSTRAINT `charity_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `charity_address`
--
ALTER TABLE `charity_address`
  ADD CONSTRAINT `FK_charity_address_charity` FOREIGN KEY (`charity_id`) REFERENCES `charity` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_charity_address_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `charity_media`
--
ALTER TABLE `charity_media`
  ADD CONSTRAINT `FK_charity_media_charity` FOREIGN KEY (`charity_id`) REFERENCES `charity` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `company_address`
--
ALTER TABLE `company_address`
  ADD CONSTRAINT `company_address_company_id_company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `company_address_country_id_country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Constraints for table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `coupon_ibfk_3` FOREIGN KEY (`verifier_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `coupon_ibfk_4` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `deposit_request`
--
ALTER TABLE `deposit_request`
  ADD CONSTRAINT `deposit_request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `page_tags`
--
ALTER TABLE `page_tags`
  ADD CONSTRAINT `page_tags_tag_id_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `page_tags_tree_id_tree_id` FOREIGN KEY (`tree_id`) REFERENCES `tree` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_company_id_company_id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_address`
--
ALTER TABLE `product_address`
  ADD CONSTRAINT `FK_product_address_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_product_address_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_product_id_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_price`
--
ALTER TABLE `product_price`
  ADD CONSTRAINT `product_price_product_id_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD CONSTRAINT `product_tags_product_id_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tags_tag_id_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_product_id_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_product_id_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaction_receiver_id_user_id` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transaction_sender_id_user_id` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_country_id_country_id` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `user_address_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_media`
--
ALTER TABLE `user_media`
  ADD CONSTRAINT `user_media_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_sent_emails`
--
ALTER TABLE `user_sent_emails`
  ADD CONSTRAINT `user_sent_emails_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdraw_request`
--
ALTER TABLE `withdraw_request`
  ADD CONSTRAINT `withdraw_request_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
