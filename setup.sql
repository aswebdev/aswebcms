-- ASCMS Database Export
-- --------------------------------------------------------

--
-- Table structure for table `ADMIN-USERS`
--

CREATE TABLE IF NOT EXISTS `ADMIN-USERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(60) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `EMAIL-ADDRESS` varchar(255) NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `BANNER-TYPES`
--

CREATE TABLE IF NOT EXISTS `BANNER-TYPES` (
  `ID` varchar(60) NOT NULL,
  `LABEL` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `BANNERS`
--

CREATE TABLE IF NOT EXISTS `BANNERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(255) NOT NULL,
  `CLICK-THROUGH-URL` text NOT NULL,
  `IMAGE-FILENAME` text NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `CONTENT`
--

CREATE TABLE IF NOT EXISTS `CONTENT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(255) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `HTML-CONTENT` text NOT NULL,
  `CONTENT-MODULE` varchar(60) NOT NULL,
  `SEO-URL` text NOT NULL,
  `DATE-MODIFIED` datetime NOT NULL,
  `MENU-ITEM` tinyint(1) NOT NULL,
  `MENU-ORDERING` int(11) NOT NULL,
  `MENU-BUTTON` varchar(60) NOT NULL,
  `DISPLAY-IN-SITEMAP` tinyint(1) NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMERS`
--

CREATE TABLE IF NOT EXISTS `CUSTOMERS` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCT-CATEGORIES`
--

CREATE TABLE IF NOT EXISTS `PRODUCT-CATEGORIES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCTS`
--

CREATE TABLE IF NOT EXISTS `PRODUCTS` (
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

CREATE TABLE IF NOT EXISTS `SITE-CONFIG` (
  `PAGE-NAME` varchar(60) NOT NULL,
  `VALUES` text NOT NULL,
  PRIMARY KEY (`PAGE-NAME`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
