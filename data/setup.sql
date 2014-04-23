-- ASCMS Database Import
-- --------------------------------------------------------

--
-- Create the Database
--

CREATE DATABASE IF NOT EXISTS `ascms`;

--
-- Create the User
--

CREATE USER 'ascms_user'@'127.0.0.1' IDENTIFIED BY 'ascms_password';

--
-- Create the User Permissions
--

GRANT ALL PRIVILEGES ON `ascms`.* TO 'ascms_user'@'127.0.0.1';

--
-- Table structure for table `ADMIN-USERS`
--

CREATE TABLE IF NOT EXISTS `ascms`.`ADMIN-USERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(60) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `EMAIL-ADDRESS` varchar(255) NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Insert the default user to the database
--

INSERT INTO `ascms`.`ADMIN-USERS` SET `USERNAME` = 'ascms', `PASSWORD` = '30571bd3258b84ab6903d17a3592e815', `EMAIL-ADDRESS` = 'andrew.schadendorff@gmail.com', `ACTIVE` = '1';

-- --------------------------------------------------------

--
-- Table structure for table `BANNER-TYPES`
--

CREATE TABLE IF NOT EXISTS `ascms`.`BANNER-TYPES` (
  `ID` varchar(60) NOT NULL,
  `LABEL` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `BANNERS`
--

CREATE TABLE IF NOT EXISTS `ascms`.`BANNERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(255) NOT NULL,
  `CLICK-THROUGH-URL` text NOT NULL,
  `IMAGE-FILENAME` text NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CONTENT`
--

CREATE TABLE IF NOT EXISTS `ascms`.`CONTENT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(255) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `HTML-CONTENT` text NOT NULL,
  `SEO-URL` text NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMERS`
--

CREATE TABLE IF NOT EXISTS `ascms`.`CUSTOMERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIRST-NAME` varchar(255) NOT NULL,
  `LAST-NAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `CONTACT-PHONE` varchar(60) NOT NULL,
  `BILLING-ADDRESS-1` text NOT NULL,
  `BILLING-ADDRESS-2` text NOT NULL,
  `BILLING-SUBURB` text NOT NULL,
  `BILLING-STATE` text NOT NULL,
  `BILLING-POSTCODE` varchar(6) NOT NULL,
  `BILLING-COUNTRY` varchar(60) NOT NULL,
  `DELIVERY-ADDRESS-1` text NOT NULL,
  `DELIVERY-ADDRESS-2` text NOT NULL,
  `DELIVERY-INSTRUCTIONS` text NOT NULL,
  `DELIVERY-SUBURB` text NOT NULL,
  `DELIVERY-STATE` text NOT NULL,
  `DELIVERY-POSTCODE` varchar(6) NOT NULL,
  `DELIVERY-COUNTRY` varchar(60) NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `EMAIL` (`EMAIL`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCT-CATEGORIES`
--

CREATE TABLE IF NOT EXISTS `ascms`.`PRODUCT-CATEGORIES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCTS`
--

CREATE TABLE IF NOT EXISTS `ascms`.`PRODUCTS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(255) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `KEY-FEATURES` text NOT NULL,
  `IMAGE-FILENAME` varchar(255) NOT NULL,
  `DOCUMENT-UPLOAD` varchar(255) NOT NULL,
  `PRODUCT-CATEGORY` int(11) NOT NULL,
  `PRODUCT-GROUP` int(11) NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  `PRODUCT-CODE` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SITE-CONFIG`
--

CREATE TABLE IF NOT EXISTS `ascms`.`SITE-CONFIG` (
  `PAGE-NAME` varchar(60) NOT NULL,
  `VALUES` text NOT NULL,
  PRIMARY KEY (`PAGE-NAME`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;