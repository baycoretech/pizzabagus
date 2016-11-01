-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2016 at 06:20 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzabagus`
--

-- --------------------------------------------------------

--
-- Table structure for table `cr_admin`
--

CREATE TABLE `cr_admin` (
  `cr_adminID` int(11) NOT NULL,
  `cr_adminUsername` varchar(50) NOT NULL,
  `cr_adminPassword` varchar(200) NOT NULL,
  `cr_adminEmail` varchar(100) NOT NULL,
  `cr_adminPhoto` varchar(200) NOT NULL,
  `cr_adminRegistered` datetime NOT NULL,
  `cr_adminDisplayName` varchar(100) NOT NULL,
  `cr_adminLevel` int(1) NOT NULL,
  `cr_adminAbout` varchar(255) NOT NULL,
  `cr_adminLastlogin` datetime NOT NULL,
  `cr_adminFacebook` varchar(200) NOT NULL,
  `cr_adminGoogleplus` varchar(200) NOT NULL,
  `cr_adminTwitter` varchar(200) NOT NULL,
  `cr_adminToken` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_admin`
--

INSERT INTO `cr_admin` (`cr_adminID`, `cr_adminUsername`, `cr_adminPassword`, `cr_adminEmail`, `cr_adminPhoto`, `cr_adminRegistered`, `cr_adminDisplayName`, `cr_adminLevel`, `cr_adminAbout`, `cr_adminLastlogin`, `cr_adminFacebook`, `cr_adminGoogleplus`, `cr_adminTwitter`, `cr_adminToken`) VALUES
(1, 'roberto', '$2y$11$c936846214a8d2029f85bOLm6FnfTde32LIaRyKmZ2t1wDH7fU4SW', 'baycorephotography@gmail.com', 'assets/img/no-pic.png', '2016-09-30 13:55:56', 'Roberto', 1, 'Owner of Pizza Bagus', '2016-11-01 12:30:24', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cr_blog`
--

CREATE TABLE `cr_blog` (
  `cr_blogID` int(11) NOT NULL,
  `cr_blogTitle` varchar(200) NOT NULL,
  `cr_blogContent` text NOT NULL,
  `cr_blogPostdate` datetime NOT NULL,
  `cr_blogModifieddate` datetime NOT NULL,
  `cr_blogLink` varchar(200) NOT NULL,
  `cr_blogtypeID` int(11) NOT NULL,
  `cr_blogcategoryID` int(11) NOT NULL,
  `cr_blogTags` text,
  `cr_blogComment` varchar(3) NOT NULL,
  `cr_blogFeatured` varchar(500) NOT NULL,
  `cr_blogMetaKeywords` text NOT NULL,
  `cr_blogMetaDescription` text NOT NULL,
  `cr_blogStatus` varchar(10) NOT NULL,
  `cr_adminID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_blog`
--

INSERT INTO `cr_blog` (`cr_blogID`, `cr_blogTitle`, `cr_blogContent`, `cr_blogPostdate`, `cr_blogModifieddate`, `cr_blogLink`, `cr_blogtypeID`, `cr_blogcategoryID`, `cr_blogTags`, `cr_blogComment`, `cr_blogFeatured`, `cr_blogMetaKeywords`, `cr_blogMetaDescription`, `cr_blogStatus`, `cr_adminID`) VALUES
(3, 'Coba Posting', '<p>asd asd asd asd asdasd asd asdasd asd asd asda sdasdasd</p>\r\n\r\n<p>asd asd asdasdas</p>\r\n\r\n<p>d asdasdasd</p>\r\n', '2016-11-01 13:12:52', '0000-00-00 00:00:00', 'coba-posting', 1, 3, NULL, 'on', '', '', '', 'publish', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cr_blogcategory`
--

CREATE TABLE `cr_blogcategory` (
  `cr_blogcategoryID` int(11) NOT NULL,
  `cr_blogcategoryName` varchar(100) NOT NULL,
  `cr_blogcategorySlug` varchar(100) NOT NULL,
  `cr_blogcategoryLink` varchar(100) NOT NULL,
  `cr_blogcategoryCreateddate` datetime NOT NULL,
  `cr_blogcategoryModifieddate` datetime NOT NULL,
  `cr_blogcategoryOrder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_blogcategory`
--

INSERT INTO `cr_blogcategory` (`cr_blogcategoryID`, `cr_blogcategoryName`, `cr_blogcategorySlug`, `cr_blogcategoryLink`, `cr_blogcategoryCreateddate`, `cr_blogcategoryModifieddate`, `cr_blogcategoryOrder`) VALUES
(3, 'Try This', 'try-this', 'news', '2016-11-01 12:47:37', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cr_bloglikes`
--

CREATE TABLE `cr_bloglikes` (
  `cr_bloglikesID` int(11) NOT NULL,
  `cr_bloglikesIP` varchar(50) NOT NULL,
  `cr_bloglikesDate` datetime NOT NULL,
  `cr_blogID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_bloglikes`
--

INSERT INTO `cr_bloglikes` (`cr_bloglikesID`, `cr_bloglikesIP`, `cr_bloglikesDate`, `cr_blogID`) VALUES
(2, '::1', '2016-10-04 13:43:29', 2),
(3, '::1', '2016-10-04 13:47:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cr_blogtags`
--

CREATE TABLE `cr_blogtags` (
  `cr_blogtagsID` int(11) NOT NULL,
  `cr_blogtagsName` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_blogtags`
--

INSERT INTO `cr_blogtags` (`cr_blogtagsID`, `cr_blogtagsName`) VALUES
(1, 'cars'),
(2, 'design'),
(3, 'mockup'),
(4, 'music');

-- --------------------------------------------------------

--
-- Table structure for table `cr_blogtype`
--

CREATE TABLE `cr_blogtype` (
  `cr_blogtypeID` int(11) NOT NULL,
  `cr_blogtypeName` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_blogtype`
--

INSERT INTO `cr_blogtype` (`cr_blogtypeID`, `cr_blogtypeName`) VALUES
(1, 'standard'),
(2, 'image'),
(3, 'video'),
(4, 'sound');

-- --------------------------------------------------------

--
-- Table structure for table `cr_blogvisitor`
--

CREATE TABLE `cr_blogvisitor` (
  `cr_blogvisitorID` int(11) NOT NULL,
  `cr_blogvisitorIP` varchar(50) NOT NULL,
  `cr_blogvisitorDate` datetime NOT NULL,
  `cr_blogID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_blogvisitor`
--

INSERT INTO `cr_blogvisitor` (`cr_blogvisitorID`, `cr_blogvisitorIP`, `cr_blogvisitorDate`, `cr_blogID`) VALUES
(1, '::1', '2016-10-03 15:36:33', 1),
(2, '::1', '2016-10-03 15:43:39', 2),
(3, '::1', '2016-10-03 16:12:03', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cr_clients`
--

CREATE TABLE `cr_clients` (
  `cr_clientsID` int(11) NOT NULL,
  `cr_clientsName` varchar(50) NOT NULL,
  `cr_clientsLink` varchar(255) DEFAULT NULL,
  `cr_clientsImage` varchar(255) NOT NULL,
  `cr_clientsOrder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cr_comment`
--

CREATE TABLE `cr_comment` (
  `cr_commentID` int(11) NOT NULL,
  `cr_commentName` varchar(50) NOT NULL,
  `cr_commentEmail` varchar(100) NOT NULL,
  `cr_commentWebsite` varchar(200) NOT NULL,
  `cr_commentContent` varchar(1000) NOT NULL,
  `cr_commentDate` datetime NOT NULL,
  `cr_commentStatus` int(1) NOT NULL,
  `cr_commentReply` int(11) NOT NULL,
  `cr_adminID` int(11) DEFAULT NULL,
  `cr_blogID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cr_contact`
--

CREATE TABLE `cr_contact` (
  `cr_contactID` int(11) NOT NULL,
  `cr_contactCustomheader` varchar(100) NOT NULL,
  `cr_contactCustomDesc` text NOT NULL,
  `cr_contactDesc` text NOT NULL,
  `cr_contactSocial` varchar(20) NOT NULL,
  `cr_contactLink` varchar(100) NOT NULL,
  `cr_adminID` int(11) NOT NULL,
  `cr_contactCustomheader_id` varchar(100) NOT NULL,
  `cr_contactCustomDesc_id` text NOT NULL,
  `cr_contactDesc_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_contact`
--

INSERT INTO `cr_contact` (`cr_contactID`, `cr_contactCustomheader`, `cr_contactCustomDesc`, `cr_contactDesc`, `cr_contactSocial`, `cr_contactLink`, `cr_adminID`, `cr_contactCustomheader_id`, `cr_contactCustomDesc_id`, `cr_contactDesc_id`) VALUES
(2, '', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</p>\r\n', 'show', 'contact', 1, '', '', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `cr_customer`
--

CREATE TABLE `cr_customer` (
  `cr_customerID` int(11) NOT NULL,
  `cr_customerDisplayname` varchar(255) NOT NULL,
  `cr_customerEmail` varchar(255) NOT NULL,
  `cr_customerUsername` varchar(50) NOT NULL,
  `cr_customerPassword` varchar(255) NOT NULL,
  `cr_customerHotelvilla` varchar(255) DEFAULT NULL,
  `cr_customerTitle` varchar(3) NOT NULL,
  `cr_customerFirstname` varchar(100) NOT NULL,
  `cr_customerMiddlename` varchar(100) DEFAULT NULL,
  `cr_customerLastname` varchar(100) NOT NULL,
  `cr_customerAddress1` text NOT NULL,
  `cr_customerAddress2` text,
  `cr_customerCity` varchar(100) NOT NULL,
  `cr_customerDetail` text,
  `cr_customerPhone` varchar(30) NOT NULL,
  `cr_customerStatus` tinyint(4) NOT NULL,
  `cr_customerLastlogin` datetime NOT NULL,
  `cr_customerToken` varchar(255) NOT NULL,
  `cr_customerRegistered` datetime NOT NULL,
  `cr_customerNumber` int(11) NOT NULL,
  `cr_customerModified` datetime NOT NULL,
  `cr_customerModifiedby` varchar(50) NOT NULL,
  `cr_customerPhoneverify` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_customer`
--

INSERT INTO `cr_customer` (`cr_customerID`, `cr_customerDisplayname`, `cr_customerEmail`, `cr_customerUsername`, `cr_customerPassword`, `cr_customerHotelvilla`, `cr_customerTitle`, `cr_customerFirstname`, `cr_customerMiddlename`, `cr_customerLastname`, `cr_customerAddress1`, `cr_customerAddress2`, `cr_customerCity`, `cr_customerDetail`, `cr_customerPhone`, `cr_customerStatus`, `cr_customerLastlogin`, `cr_customerToken`, `cr_customerRegistered`, `cr_customerNumber`, `cr_customerModified`, `cr_customerModifiedby`, `cr_customerPhoneverify`) VALUES
(638, 'Super User', 'order@pizzabagus.com', 'Pizza', '$P$DNLpI5ZzcXh/yCNqR0.cb6gw6rJCyZ.', NULL, '', 'Italian', '', 'Restaurant', 'Jalan Raya Pengosekan', '', 'Ubud', '', '62361978520', 1, '0000-00-00 00:00:00', '', '2014-03-24 04:34:14', 0, '2014-08-21 02:36:46', '', ''),
(639, 'Roberto niken', 'laivesindo@yahoo.com', 'Roby', '$P$DY4PZr63aOAYCQH.S9mz9VyGoZfdlY0', NULL, 'Mr', 'Roberto', '', 'niken', 'tengkulak tngh', '', '', 'depan resto dewa malen rumah putih pagar bamboo', '81239492927', 1, '0000-00-00 00:00:00', '', '2014-03-25 04:02:58', 999, '2014-07-11 04:38:51', '', ''),
(644, 'Zoray Kraemer', 'zo@zobabe.com', 'ZoBabe', '$P$DQIqo.t6n/mnfNxJmCA3tj2LqJx0ja1', NULL, 'Ms', 'Zoray', '', 'Kraemer', 'Jl. Tirta Tawar 31', 'Kutuh Kaja', '', 'Next to Sari Jahe Market', '81999399242', 1, '0000-00-00 00:00:00', '', '2014-06-27 07:59:42', 35, '2016-09-24 03:38:03', '', ''),
(647, 'Vivian', 'info@pizzabagus.com', 'vivian', '$P$Dy497S5u3lNqIXv/jYIJNXXWHEzJEG/', NULL, '', 'vivian', '', 'bolo', 'tngklk', 'pb', '', '', '81239492927', 1, '0000-00-00 00:00:00', '', '2014-07-07 10:37:38', 0, '2014-07-27 05:44:32', '', ''),
(641, 'Andrea', 'ansamiho64@gmx.de', 'Andrea', '$P$DH5LQZy.P2Hcvle3lj19nCV6h4NonT.', NULL, 'Ms', 'Andrea', '', 'Hockenmaier', 'Jalan Tirta Tawar 18 (sec', 'Kutuh Kaja', 'UBUD, BALI', 'Just past Sugars Villas.', '6282144905919', 1, '0000-00-00 00:00:00', '', '2014-07-12 08:12:36', 0, '2014-07-12 08:16:36', '', ''),
(657, 'Dewi Syrowatka', 'dewisyrowatka@gmail.com', 'dewisyrowatka', '$P$DsGCLuPY3hGTgGIjXGdgcSNncDnrTn/', NULL, 'Mrs', 'Dewi', '', 'Syrowatka', 'Jalan Tirta Tawar', 'Banjar Kutuh Kaje', '', 'Complex Villa Sancita, Rumah Number 2.\n(ada peta di buku)', '8123606367', 1, '0000-00-00 00:00:00', '', '2014-07-17 10:47:13', 64, '2014-11-08 08:42:54', '', ''),
(659, 'Roberto Bolo', 'laivesindo@gmail.com', 'Roberto', '$P$DJWgnte0sOvtsi1eTnoJHUXK2fSSp2.', NULL, '', 'Roberto', '', 'Bolo', 'Tngklk tengah', '', '', 'di depan dewa malen', '81239492927', 1, '0000-00-00 00:00:00', '', '2014-07-18 03:37:30', 0, '2014-07-27 05:43:48', '', ''),
(660, 'I Wayan Wiguna', 'ediwiguna91@gmail.com', 'ediwiguna91@gmail.com', '$P$D378xSoetz19SBCha6Vf2hnR2CLi091', NULL, 'Mr', 'I Wayan', 'Edi', 'Wiguna', 'Br. Kedampal, Abiansemal', '', '', 'Abiansemal Dauh Yeh Caning , Badung - Bali', '85738007101', 1, '0000-00-00 00:00:00', '', '2014-07-19 08:56:44', 0, '2014-07-27 05:43:33', '', ''),
(661, 'gobind vashdev', 'v_gobind@yahoo.com', 'gobind', '$P$Dv8uGqqhEh4A0Y7hmnYegw0f3IyzEJ0', NULL, 'Mr', 'gobind', '', 'vashdev', 'jl. tirta tawar br. kutuh kaja,', '', '', '100 mtr utara ubud botanic garden (timur jalan)', '8155722100', 1, '0000-00-00 00:00:00', '', '2014-07-20 11:22:31', 0, '2014-07-27 05:43:17', '', ''),
(662, 'Yehezkiel Felix', 'yfx_8@yahoo.com.sg', 'yfelix8', '$P$DFc3ky60syK8CCR8LOXfaVGFxSSnpg/', NULL, 'Mr', 'Yehezkiel', '', 'Felix', 'Sandat V/25', '', '', '', '81806068898', 1, '0000-00-00 00:00:00', '', '2014-07-20 15:27:58', 0, '2014-07-27 05:43:03', '', ''),
(663, 'Sandra Kemper', 'kemper_sandra@hotmail.com', 'Sandra', '$P$DR2.a/e7DsdVKGcKBgVcJNunBARQql.', NULL, '', 'Sandra', '', 'Kemper', 'Nami house on jl Sugriwa nr 16', '', '', '', '85792120314', 1, '0000-00-00 00:00:00', '', '2014-07-23 04:08:38', 0, '2016-06-18 01:35:16', '', ''),
(664, 'Rama Sumerta', 'Ramaadiguna081@yahoo.co.id', 'Rama adiguna', '$P$DnzBCn5fkQG.tNiaJdxgmbgelNX8zq0', NULL, 'Mr', 'Rama', 'Adiguna', 'Sumerta', 'Jalan pengosekan, gajah mas galeri', '', '', 'Gajah mas galeri', '81999983771', 1, '0000-00-00 00:00:00', '', '2014-07-26 11:31:40', 0, '2014-07-27 05:47:55', '', ''),
(665, 'Testing Testing', 'zoraylee@gmail.com', 'Testing', '$P$D3PThW8Hk6vOfpQkgR5P0ZFAnUaZ/F1', NULL, '', 'Testing', '', 'Testing', '123', '', '', '', '82247072869', 1, '0000-00-00 00:00:00', '', '2014-07-27 05:50:21', 0, '2014-11-08 05:28:44', '', ''),
(666, 'Djuna Ivereigh', 'djuna@djunapix.com', 'Djuna', '$P$DrLxlWbILgxLsJOdl0Ok.km7xD78bD/', NULL, 'Ms', 'Djuna', '', 'Ivereigh', 'Gang Nyuh Sangket #4', 'Nyuh Kuning', '', 'di ujung gang', '8123855853', 1, '0000-00-00 00:00:00', '', '2014-07-27 08:20:14', 0, '2014-07-27 08:20:14', '', '427065'),
(667, 'Rob Wood', 'clobber@gmail.com', 'clobber', '$P$DkZMKXHyciNFLp5WtTxPUrMR1GJXnm/', NULL, 'Mr', 'Rob', '', 'Wood', 'Jl Bojog', 'Nyuh Kuning', '', 'large family cottage directly behind Chili Cafe', '82236361736', 1, '0000-00-00 00:00:00', '', '2014-07-28 02:32:30', 77, '2014-08-31 06:38:39', '', ''),
(668, 'valensi florie', 'florie.aroundtheworld@gmail.com', 'florie', '$P$DuQ7cvPI3sgI0krr51x6C8cxZ6qGUo1', NULL, 'Ms', 'valensi', 'florie', 'florie', 'Orange House, tirta tawar Kutuh kaja', '', '', 'Stlh wr Made Becik jln pertama ke kiri rumah pertama sblh kanan', '82147449286', 1, '0000-00-00 00:00:00', '', '2014-07-29 11:48:52', 0, '2014-07-30 04:39:05', '', ''),
(669, 'Michiko Swiggs', 'michiko23@gmail.com', 'michiko23', '$P$DdwiuZOLeP5Y8lJT3mgBE71CPobnjV.', NULL, '', 'Michiko', '', 'Swiggs', 'T House Kaja, Lodtunduh', '', '', '', '82237563843', 1, '0000-00-00 00:00:00', '', '2014-07-30 11:42:48', 0, '2014-08-01 02:38:17', '', ''),
(670, 'Rose Burrowes', 'rose.burrowes@gmail.com', 'rose', '$P$DPKSUeK0/bq50cN26O1TQFf2cRA/bT/', NULL, 'Ms', 'Rose', '', 'Burrowes', '88x Monkey Forest Road', '', '', '', '82237563906', 1, '0000-00-00 00:00:00', '', '2014-07-31 12:44:43', 0, '2014-08-01 00:08:14', '', ''),
(671, 'Nicki Janczak', 'nickijanczak@hotmail.com', 'Nicki', '$P$DngIMZK/yyD1uRVpRa3m3XcKMtFAM6/', NULL, 'Ms', 'Nicki', '', 'Janczak', 'JL Andong 86', '', '', 'Just 3 or 4 shops past Warung Candra.  Just after Kertas Gingsir and the big Selamat Datang ke Desa Petulu sign.  If gate is closed please open and come into parking lot.  Go up 2 small sets of stairs.  My hosue is on the right. Ibu Nyoman kanal saya.', '81337170348', 1, '0000-00-00 00:00:00', '', '2014-08-02 09:39:59', 87, '2015-01-31 09:01:14', '', ''),
(672, 'Eka Nur Aziza', 'info@fairfuturefoundation.org', 'taranalex', '$P$DKfSHKuZYKX4SgOLYngSIzi.Hq1Uoh1', NULL, 'Ms', 'Eka', '', 'Nur Aziza', 'Jalan Suweta', 'Sakti - Bentuyung', '', 'Di atas depo bengungan, di depan Villa Capung Sakti.', '81246175725', 1, '0000-00-00 00:00:00', '', '2014-08-03 11:35:22', 65, '2014-09-09 09:50:28', '', ''),
(673, 'martje nietzman', 'martje@desabulan.com', 'martje', '$P$D7jKmelQhVlhhS1mCHqRoCtjMPBdOl.', NULL, 'Ms', 'martje', '', 'nietzman', 'banjar abiansemal kaja kauh', 'lodtunduh', '', 'I am in villa number 6, Crescent Moon', '81236700265', 1, '0000-00-00 00:00:00', '', '2014-08-04 05:17:58', 66, '2014-09-15 02:13:57', '', ''),
(674, 'Jack Gore', 'aliishotton@live.co.uk', 'jackandalex', '$P$DCS.tjtjf7496H7GgnemOYH5g6r5h7.', NULL, 'Mr', 'Jack', '', 'Gore', 'Penestanan', 'Jalan Campuhan', '', '', '81238454650', 1, '0000-00-00 00:00:00', '', '2014-08-05 06:18:25', 0, '2014-08-05 06:18:25', '', '794273'),
(675, 'stacy romillah', 'Stacy@StacyRomillah.com', 'stacyrae', '$P$Dfeir9/BnSskMvB3nZkYKnKYZ4Ixs90', NULL, 'Mrs', 'stacy', '', 'romillah', 'jl. Nyuh Kuning, kadiga villa, villa Jepun', '', '', 'Jl. Pengosekan to right turn on Jl. Nyuh Kuning. Pass big new resto, see building with "cuci motor" on the side and turn right just after it at the sign saying "Kadiga Villa".  NOT in Nyuh Kuning Village. We are before that.', '81246605827', 1, '0000-00-00 00:00:00', '', '2014-08-05 10:06:35', 0, '2014-08-05 10:06:35', '', '666862'),
(676, 'Valeria  Diaz', 'valeriediazc@gmail.com', 'Valeria', '$P$DJcaXCl9t9VCQTsGoieEt4pNV3ofSc/', NULL, 'Mrs', 'Valeria', '', 'Diaz', 'Penestanan Kelod', 'Sayan', '', 'Next to Devi Place \nLook for Teblin House sign on the wall next to Devi Place', '82236176740', 1, '0000-00-00 00:00:00', '', '2014-08-06 02:41:38', 0, '2014-08-06 02:41:38', '', '916807'),
(677, 'Scott Brierley', 'scottbrierley21@yahoo.com', 'Scott', '$P$D.1Fg91zc/dOdizTLMS7a/f2sb7IEj0', NULL, 'Mr', 'Scott', '', 'Brierley', 'Jukut Paku (Singakerta)', 'Zen house', '', 'Setelah jembatan Nyu kuning ke kiri', '81236640203', 1, '0000-00-00 00:00:00', '', '2014-08-07 13:31:38', 74, '2014-08-31 06:38:17', '', ''),
(678, 'Steve Steve', 'steveny9@gmail.com', 'steveny9', '$P$D0w5zFzITQ2/w.ckwfkP4C76PH8ejT1', NULL, 'Mr', 'Steve', '', 'Steve', 'Next to Uma Mandi', 'katiklantang', '', 'I am the path across from Nefatari in Katik Lantang South of Penestanan.  I am next to Uma Mandi.  I am the last house on the left with the green walls and banana trees.  From you go from Pizza Bagus go toward Nuh Kunning.  Take the right turn on the main road to Penestanan.  At the curve there is Villa Mandi, D''Villa and Nefatari.  I am the path directly across Nefatari.  (If you pass Uma Mandi you went to far).  Go down the path.  There are 2 villas.  I am the last one in the back.', '82237448648', 1, '0000-00-00 00:00:00', '', '2014-08-08 04:16:06', 107, '2015-06-21 06:39:23', '', ''),
(679, 'Lucinda R', 'thelucinda@gmail.com', 'Lucinda', '$P$DlFl0wrK6vgmy75mXyPrC7UqStR.5r.', NULL, 'Ms', 'Lucinda', '', 'R', 'Jl Tirta Tawar', 'Br Kutuh Kaja', '', 'Masuk Kutuh Kaja, kiri jalan ada Bale Banjar, lurus lagi 100m, belok kanan ke ''The Purist'' Hotel &amp; D''Legon Villa (jalan kaping). Setelah tempat parkir ada Pundung Kembar (tembok putih/pintu masuk besi hitam).', '81236753933', 1, '0000-00-00 00:00:00', '', '2014-08-08 11:06:16', 103, '2015-06-21 06:33:55', '', ''),
(680, 'Stephanie Mee', 'stephanie.mee@hotmail.com', 'steph.mee', '$P$DOld99yaeSOT0ZsNxxPwtNBx2mzHkb.', NULL, 'Ms', 'Stephanie', '', 'Mee', 'House Becik', 'Kutuh Kaja', '', 'Jalan Tirta Tawar #18\nRumah di Belakang', '82147651382', 1, '0000-00-00 00:00:00', '', '2014-08-09 04:25:29', 61, '2015-11-27 07:05:58', '', ''),
(681, 'Zuzana Padychova', 'zpadychova@gmail.com', 'zpadychova@gmail.com', '$P$DgNehCGAlukLyXN9sOfLB2RHQ/tPuJ0', NULL, 'Ms', 'Zuzana', '', 'Padychova', 'Jl. Hanoman 43, room 8', '', '', 'opposite restaurant KAFE', '82236901556', 1, '0000-00-00 00:00:00', '', '2014-08-09 07:07:41', 73, '2014-10-11 01:04:10', '', ''),
(682, 'David Ross', 'steerpike4@gmail.com', 'steerpike4', '$P$D4KDc0CvFXZ1sMcrQcoyvGtoL7Yd9h0', NULL, 'Mr', 'David', '', 'Ross', 'Jl Raya Kedewatan', '', '', 'Room 111', '89636502829', 1, '0000-00-00 00:00:00', '', '2014-08-09 11:22:31', 0, '2014-08-09 11:22:31', '', '614926'),
(683, 'Anjet Lanting', 'Lantinganjet@yahoo.com', 'Anjet', '$P$DOyrkfEWxsPklruZxffhNI3p6iPlBm0', NULL, 'Ms', 'Anjet', '', 'Lanting', 'Matahari', '', '', 'Villas in lodtunduh. Sunrise villa', '85238356491', 1, '0000-00-00 00:00:00', '', '2014-08-10 00:58:34', 0, '2014-08-10 00:58:34', '', '156625'),
(684, 'Monique Martin', 'monique2807@me.com', 'monique28', '$P$DXd1Yf7bHARIIURz66oYMMOC0TB91Q1', NULL, 'Ms', 'Monique', '', 'Martin', 'Lodtunduh', '', '', 'My house is around the right corner of Mama''s house', '82236647728', 1, '0000-00-00 00:00:00', '', '2014-08-10 05:14:56', 82, '2015-01-31 08:56:12', '', ''),
(685, 'Rukiya McNair', 'rukiya.mcnair@gmail.com', 'Rukiya81', '$P$DHC1Pf204XaE8kEIpU0KLdUFEvSNmh1', NULL, 'Mrs', 'Rukiya', '', 'McNair', 'Jl. Raya Sayan', '', '', 'Coming from Jl. Raya Ubud, make a left onto Jl Raya Sayan, you will see the conveneince store 4w on the right, make the next immediate left onto the dirt road with the "Dekorasi" sign, first house on the right. If you see YanYan restaurant you''ve gone a little too far.', '81236401522', 1, '0000-00-00 00:00:00', '', '2014-08-10 08:22:13', 68, '2014-08-23 05:02:34', '', ''),
(686, 'Doug Mekle', 'd.meikleii@gmail.com', 'Doug', '$P$DAlJCg.s0y36c2UeaeEXnZPieWemo1/', NULL, '', 'Doug', '', 'Mekle', 'Bedulu', 'Near Yeh Puluh', '', 'In Bedulu village, go to Yeh Puluh.\nTurn right at the beginning of the hill where the road goes down to Yeh Puluh carpark. (Warung on corner.) Just before second street light, turn right into narrow gang.\nHouse is first gate on left side of gang.\nFor directions in Bahasa Indonesia, Call Nili 081934319077 or Ketut 085739114037', '81236073550', 1, '0000-00-00 00:00:00', '', '2014-08-11 11:03:23', 67, '2014-09-09 09:49:57', '', ''),
(687, 'Barry Thorpe', 'radiosobarry@gmail.com', 'Barry Thorpe', '$P$DXbtGMULwI.wewrcS.FWOZaihja/F20', NULL, 'Mr', 'Barry', '', 'Thorpe', 'Banjar Lebah', 'Jalan Yeh Pulu', '', 'We are in Bedulu near Villa Dedari.\nWe don''t expect to requre delivery to our home.', '81353390502', 1, '0000-00-00 00:00:00', '', '2014-08-13 04:56:55', 0, '2014-08-13 04:56:55', '', '114977'),
(688, 'Jo taylor', 'Jotgypsy@live.com', 'Jotay', '$P$DK20ojrT2UXpCWFIDoICbt3h3T7.NN0', NULL, 'Ms', 'Jo', '', 'taylor', 'Jl Suweta', '', '', 'Room number 3', '82236901552', 1, '0000-00-00 00:00:00', '', '2014-08-13 11:28:10', 71, '2014-08-23 05:01:33', '', ''),
(689, 'Vern Castle', 'verncastlesgv@gmail.com', 'Vern', '$P$DtN9fxvuwmPdcK1Sw5hbDfrcKjj0wX/', NULL, 'Mr', 'Vern', '', 'Castle', 'Jl. Tirta Tawar 20b', '', '', '100 m north of Pura Desa Kutuh, small lane to the side of Toko Bunga. Ask for ''Rumah Anom" or Villa M', '81246605808', 1, '0000-00-00 00:00:00', '', '2014-08-14 08:38:57', 0, '2014-08-14 08:38:57', '', '44967'),
(690, 'Julia Stupak', 'yulia.stupak@gmail.com', 'kittity', '$P$DEMTPV8ozIH6TJ7ODzUYhdu8mIjz7L/', NULL, 'Ms', 'Julia', '', 'Stupak', '12 jalan nyuh bojog', '', '', '', '82247037754', 1, '0000-00-00 00:00:00', '', '2014-08-14 09:29:23', 76, '2014-08-31 06:37:12', '', ''),
(691, 'Karina Singleton', 'karinasingleton@live.com', 'Chickiebabe34', '$P$D2WDGt/v4VLVpllpkCnzfMZ178/4Kc0', NULL, 'Ms', 'Karina', '', 'Singleton', 'Jalan raya sayan', 'Kutuh', '', 'Room 4\n\nHip and chic suite\n\nRed bulldog at door', '87861534709', 1, '0000-00-00 00:00:00', '', '2014-08-14 11:04:10', 0, '2014-08-14 11:04:10', '', '194370'),
(692, 'yael rotfus', 'yaegashy@gmail.com', 'yaman', '$P$Dbo3/.ygP6m4tS7Kp1AO7nouZ8lflO/', NULL, 'Mr', 'yael', '', 'rotfus', 'wisnu lane, monkey forest road', '', '', '', '82146515256', 1, '0000-00-00 00:00:00', '', '2014-08-14 11:37:40', 0, '2014-08-14 11:37:40', '', '259334'),
(693, 'I naya', 'pondoknayaubud@gmail.com', 'wiliantara', '$P$DRtQ5lWTifd35/.ZJJecAbKyIXrVbA/', NULL, 'Mr', 'I', 'made', 'naya', 'Br. Penestanan Kelod', '', '', 'Br.Penestanan Kelod, sebelah Blue line internet / sebelah Melati cottage', '81999374393', 1, '0000-00-00 00:00:00', '', '2014-08-14 12:59:48', 0, '2014-08-14 12:59:48', '', '402252'),
(694, 'Katherine  Tate', 'katherinetate@gmail.com', 'kattate', '$P$D0mdBpScZS1CohVFh2SznTF4EJxNPK1', NULL, 'Ms', 'Katherine', '', 'Tate', 'Room 106', 'Jl. Raya Pengosekan', '', '', '82237453958', 1, '0000-00-00 00:00:00', '', '2014-08-16 04:58:21', 0, '2014-08-16 04:58:21', '', '346273'),
(695, 'Nancy Anello', 'n_anello@yahoo.com', 'nanello', '$P$Diu5T/rv7SmOdMnvOmLdQBlPodsDIC1', NULL, 'Ms', 'Nancy', '', 'Anello', 'Teges', '', '', 'Rumah Ibu Nancy di Teges', '81916389492', 1, '0000-00-00 00:00:00', '', '2014-08-16 10:08:47', 0, '2014-08-16 10:08:47', '', '773948'),
(696, 'Shannon  Goans', 'shannon.goans@gmail.com', 'ShannonG', '$P$DYmpOIjGfyArjyZxVdgXgY4VC4FxGs1', NULL, 'Ms', 'Shannon', '', 'Goans', 'Next door to Dag Dig Dug House', 'Jalan Tirta Tawar', '', 'Driveway is just before the Dag Dig Dug house.  On left hand side of road just before reaching Warung Made Becik', '81236144793', 1, '0000-00-00 00:00:00', '', '2014-08-16 11:18:33', 0, '2014-08-16 11:18:33', '', '517296'),
(697, 'Sophie Strassl', 'sophie9635@gmail.com', 'Sophie35', '$P$DPzI5Tn9JrxGjIuCkwVbUHlkB/04Kw.', NULL, 'Ms', 'Sophie', '', 'Strassl', 'Br. Katik Lantang Desa Singakerta', '', '', 'Our house is not the Aura Ubud, but the house on the left side of the street, about 15 metres from the Aura', '82147542847', 1, '0000-00-00 00:00:00', '', '2014-08-17 08:18:43', 70, '2014-08-23 05:00:58', '', ''),
(698, 'Lee Docherty', 'Leeozolins@hotmail.com', 'LeeDoc', '$P$Dqot8HU4QFr2Eisx97nhNV5JzjFSBF0', NULL, 'Mrs', 'Lee', '', 'Docherty', 'Lodtunduh', '', '', 'Near harmony villa', '81236662813', 1, '0000-00-00 00:00:00', '', '2014-08-17 09:19:17', 84, '2015-01-31 08:58:55', '', ''),
(699, 'Michelle Navarro', 'm_xel@yahoo.com', 'Michelle', '$P$DgGGiIfgNsGiq6ykY4a06H/t2nQwby0', NULL, 'Ms', 'Michelle', '', 'Navarro', 'Penestanan Kelod', '', '', 'Near Alchemy.  \nRoad across from Melati Cottages sign.  \nGang behind Round Bar parking area. \n1st building on the left (Pink, big windows, hanging plants, red scooter outside.)', '81236400456', 1, '0000-00-00 00:00:00', '', '2014-08-17 10:12:08', 0, '2014-08-17 10:12:08', '', '733977'),
(700, 'Aristya Subadra', 'aristya_dewi77@yahoo.co.id', 'aristya', '$P$DfQh3eF0Dz8OPvTydnxxAuVQiANUkj1', NULL, 'Ms', 'Aristya', 'Dewi', 'Subadra', 'jalan hanoman, banjar padsngtegal kelod, ubud', '', '', '', '85738415250', 1, '0000-00-00 00:00:00', '', '2014-08-17 11:22:22', 0, '2014-08-17 11:22:22', '', '537716'),
(701, 'Frans Huneker', 'f.huneker@gmail.com', 'f.huneker', '$P$DkAlX43lQ.2K8VAiTVTuS10aO1uUQZ0', NULL, 'Mr', 'Frans', '', 'Huneker', 'Jl. Sri Wedari 10 B', 'Tegallantang', '', '50 m. north of Ubud Green Hotel, masuk gang 10 B di sebelah timur.', '81353302849', 1, '0000-00-00 00:00:00', '', '2014-08-17 12:13:28', 85, '2015-01-31 08:59:35', '', ''),
(702, 'John Kelleher', 'jkresides@gmail.com', 'jakehay', '$P$DKUbPBzYqR1og3o3lwAvFOd7mVgGGS1', NULL, 'Mr', 'John', '', 'Kelleher', 'Gang Sawah #2', 'Jalan Raya Andong', '', '500m past Indomaret, on the right. Gang Sawah has ''BSA'' sign and ''Warung Kanza'' at entrance. Go to end of Gang and turn right and we are middle house.', '82236364386', 1, '0000-00-00 00:00:00', '', '2014-08-17 12:54:49', 69, '2014-09-04 01:26:48', '', ''),
(703, 'Kimberley Vanderheyden', 'kimberley@k-flow.biz', 'Kim', '$P$DdpoUFyzWfzHO55JOlB/XtcR6pUoZb.', NULL, '', 'Kimberley', '', 'Vanderheyden', 'Banjar Kalah , Peliatan', '', '', '', '81237447579', 1, '0000-00-00 00:00:00', '', '2014-08-19 05:04:41', 101, '2015-06-21 06:32:58', '', ''),
(704, 'Nigel Jones', 'nigelatoxic@gmail.com', 'nigelindo', '$P$DTypkmLP1dYmQE8JNOZckxsalAtu8N.', NULL, 'Mr', 'Nigel', '', 'Jones', 'Suci House Nr 2', '', '', '', '82147466579', 1, '0000-00-00 00:00:00', '', '2014-08-19 05:38:43', 0, '2014-08-19 05:38:43', '', '494812'),
(705, 'Jillian Wilks', 'fred.jill@bigpond.com', 'Jillian', '$P$Dwzj7LnnOujc.9uvnrZanNdpqWqlTu0', NULL, 'Ms', 'Jillian', '', 'Wilks', 'THouse Kaja', '', '', 'Near pool', '87860276450', 1, '0000-00-00 00:00:00', '', '2014-08-19 11:33:35', 0, '2014-08-19 11:33:35', '', '408037'),
(706, 'Rachael Jones', 'Rachael289@msn.com', 'Dreamteam', '$P$DJDwNg1Y1aPZPDBdVkZpZUvy7vlTyq1', NULL, 'Ms', 'Rachael', '', 'Jones', 'Br. Penestanan Kelod', '', '', '', '81236017364', 1, '0000-00-00 00:00:00', '', '2014-08-19 12:08:38', 0, '2014-08-19 12:08:38', '', '529756'),
(707, 'Isabel Vial', 'ivial7@yahoo.es', 'ivial7', '$P$DpMWOdODiWbXAFPEI4eCs2reWLbl7E1', NULL, 'Mrs', 'Isabel', '', 'Vial', 'Jalan Suweta, Bentuyung', 'Aprox. 3 kms north from Jalan Raya Ubud.', '', 'After the temple, and just when the little town finishes. On your right side. The house in the middle.', '82237819241', 1, '0000-00-00 00:00:00', '', '2014-08-20 11:54:49', 0, '2014-08-20 11:54:49', '', '785584'),
(708, 'Marc Summers', 'marc@informationstreet.com', 'marcpsummers', '$P$DPrZh0M2UN8YRh3ItBB8tm0P.95uL9/', NULL, 'Mr', 'Marc', 'P', 'Summers', 'Lodtunduh', 'Br Abian Semal', '', 'Pintu gerbang geser warna putih', '82236364839', 1, '0000-00-00 00:00:00', '', '2014-08-22 09:44:06', 75, '2014-09-05 08:44:10', '', ''),
(709, 'Jay Wennington', 'jay.wennington@googlemail.com', 'Jaywatch', '$P$DJIoeSnkSugwYVYi8WTYYHpXKf1/621', NULL, 'Mr', 'Jay', '', 'Wennington', 'Villa Awang Awang', '', '', '', '82146558733', 1, '0000-00-00 00:00:00', '', '2014-08-23 07:13:40', 0, '2014-08-23 07:13:40', '', '609610'),
(710, 'Mary Lou Pavlovic', 'maryloupav@yahoo.com.au', 'marylou', '$P$DXDjm5/ym5o1BSd.msdtpD7Y38jINT/', NULL, 'Ms', 'Mary Lou', '', 'Pavlovic', 'Jalan Nyuh Bojog  twenty eight', 'Nyuh Kuning', '', 'Close to Lake Leke Restaurant.\nNext to Garden View Hotel  - it is the next driveway after the green garden view sign.', '82146896470', 1, '0000-00-00 00:00:00', '', '2014-08-24 10:58:18', 0, '2014-08-24 10:58:18', '', '160639'),
(711, 'Brandon Hou', 'houjiaxiang87@hotmail.com', 'brandon', '$P$DqhbJA/5s5gitfB./4laiW01I.GYB1.', NULL, 'Mr', 'Brandon', '', 'Hou', 'Jalan.Suweta st No.65', '', '', '', '81239338605', 1, '0000-00-00 00:00:00', '', '2014-08-27 11:32:07', 0, '2014-10-11 04:52:30', '', ''),
(712, 'Michelle Pettit', 'Michelle@atmankafe.com', 'Mpettit', '$P$DtaSpEDOYyk2WgEJeB2e/6NbSOheCi1', NULL, 'Mrs', 'Michelle', 'Lee', 'Pettit', 'Junjungan', '', '', 'Past the Kecak Temple in Junjungan. Meditation and yoga ashram on the left side, with lion statues at the carpark entrance. Room Down by the river, next to the Beji.', '85333454915', 1, '0000-00-00 00:00:00', '', '2014-08-28 08:23:20', 86, '2015-01-31 09:00:23', '', ''),
(713, 'Bianca Keating', 'Biancakeating@gmail.com', 'Bianca', '$P$DwHDlTwSUoXbuUgpmv7t2mgXYWLf4i/', NULL, 'Ms', 'Bianca', '', 'Keating', 'Thouse kaja', '', '', '', '81236772509', 1, '0000-00-00 00:00:00', '', '2014-08-28 11:17:27', 0, '2014-08-28 11:17:27', '', '311255'),
(714, 'jeremy herve', 'chebs.herve@laposte.net', 'jeremy', '$P$Dbwi3lyLVDlS/zGZgbhKiTsamm4hUI1', NULL, 'Mr', 'jeremy', '', 'herve', 'jl sukma 8', 'tebesaya;peliatan', '', 'open gate and go till the end', '82146518418', 1, '0000-00-00 00:00:00', '', '2014-08-28 12:05:41', 0, '2014-08-28 12:05:41', '', '546138'),
(715, 'vern castle', 'castlev@saber.net', 'castlev', '$P$DMMHsGLbNYkAfU8mC8Q/GYE4mPU9Fx/', NULL, 'Mr', 'vern', '', 'castle', 'Jl. Tirta Tawar 20 b', '', '', '100 meter north of Pura Desa Kutuh, dekat Toko Bunga', '0812 4660 5808', 1, '0000-00-00 00:00:00', '', '2014-09-01 10:09:20', 0, '2014-09-01 10:09:20', '', '407088'),
(716, 'komang witariyani', 'witariyani@gmail.com', 'witari', '$P$Dhoqk4Qa65rsJY6oX.Vhpe5Gtg/Qua0', NULL, 'Mrs', 'komang', '', 'witariyani', 'kedewatan no 26', '', '', 'near BRI bank', '85739875982', 1, '0000-00-00 00:00:00', '', '2014-09-01 12:10:02', 0, '2014-09-01 12:10:02', '', '784066'),
(717, 'Gareth Wilson', 'garethswilson@gmail.com', 'garethswilson', '$P$DMYOjZHed8QPpTiQwMugT1IsEUa1NU/', NULL, 'Mr', 'Gareth', '', 'Wilson', 'Banjar sala', 'Pejeng-Kawan', '', 'House name - Pondok Ari\nbeside hotel Kubu Sari. at end of small driveway\nYou deliver to my house many times', '81238150310', 1, '0000-00-00 00:00:00', '', '2014-09-02 09:50:10', 96, '2015-06-21 06:28:50', '', ''),
(718, 'Daniela Wagner', 'daniela.pk.wagner@gmail.com', 'Dwagner', '$P$D2.Ic9sVxUufGUeQAiYfCdesMn75V1.', NULL, 'Ms', 'Daniela', '', 'Wagner', 'Jl Raya Pengosekan', 'Banjar Kumbuh, Mas', '', 'Cory Villa is located 2 houses from the Pelangi school and across from the Sankara Resort.', '82144162780', 1, '0000-00-00 00:00:00', '', '2014-09-02 10:18:46', 0, '2014-09-02 10:18:46', '', '821348'),
(719, 'luke westerman', 'kdelahunty@hotmail.co.nz', 'kyle', '$P$DYRXHSMTV4cEzfjkoquCuYEVcZDTtS0', NULL, 'Mr', 'luke', '', 'westerman', '4 jatayu street', '', '', '', '82144423545', 1, '0000-00-00 00:00:00', '', '2014-09-04 13:31:26', 0, '2014-09-04 13:31:26', '', '539503'),
(720, 'Anna vsekhsvyatskaya', 'nostupidrules@gmail.com', 'avseh', '$P$DqkwQF5fESjnFdhbPfbfr37w7QSROa.', NULL, 'Mrs', 'Anna', '', 'vsekhsvyatskaya', 'tirta tawar jl.', '', '', 'http://goo.gl/maps/NZJzm\n\nhere is map\n\nour house near ubud syailendra villas', '82237564376', 1, '0000-00-00 00:00:00', '', '2014-09-05 09:48:35', 0, '2014-09-05 09:48:35', '', '313754'),
(721, 'deb Oliver', 'debdeb11@hotmail.co.nz', 'debdeb', '$P$DLBLhy.3XcMRKOSUnSU9yJ8X/9/XnA0', NULL, 'Ms', 'deb', '', 'Oliver', 'Jl. Sukma', 'Tebesaya', '', 'House is in between a bridge and ''Toko Angsa'', not far from Yoga Barn parking area', '82237087803', 1, '0000-00-00 00:00:00', '', '2014-09-08 05:50:55', 94, '2015-06-21 06:25:16', '', ''),
(722, 'Paul Shakespeare', 'mistashakespeare@gmail.com', 'paulshakespeare', '$P$DY0JRQGSuSs87FePnz8Ju35t2r2u9v0', NULL, 'Mr', 'Paul', '', 'Shakespeare', 'Beside Jepun House near Nirvana Realty', 'Penestanan', '', 'Penestanan, past Sri Ratih Cottages and Waka Namya on your left and Melati Cottages on your right.\n\nThe road will dip and then rise through a densely forested area.\n\nTurn right at the first cross junction. Turn right again at the second cross junction into a small road. Please park on this road, near Bali Gen villa.\n\nAfter Bali Gen, you will see a path and some steps going down to a small bridge. No cars are allowed down this path, only pedestrians and motorcycles.\n\nFollow the path for about 150 meters. You will see Villa Nirvana on your left. \n\nThere is a path about 20 meters on your right beside the motorbike(s). Walk up the stairs and we are the second door on your left before Jepun House.', '82144670948', 1, '0000-00-00 00:00:00', '', '2014-09-08 12:04:19', 0, '2014-09-09 03:52:43', '', ''),
(723, 'Craig  Docherty ', 'cr_docherty@hotmail.com', 'Doc88', '$P$DhWY8YfcD/G3aousadN2Ec83RaT9i8.', NULL, 'Mr', 'Craig', '', 'Docherty', 'Lod Tunduh 3', '', '', '', '82247037368', 1, '0000-00-00 00:00:00', '', '2014-09-09 06:18:34', 79, '2014-10-26 23:18:57', '', ''),
(724, 'Kate Young', 'Kate.young@ncable.net.au', 'Kateyoung', '$P$Dy3eR7CTYGMxSXyGqjxae1TqWEMAEn1', NULL, 'Mrs', 'Kate', '', 'Young', 'Villa Santana', 'Jalan Kajeng', '', 'Right up the top, past Villa Samsara, need motorbike to drive there.', '82342151406', 1, '0000-00-00 00:00:00', '', '2014-09-09 09:39:09', 0, '2014-09-09 09:39:09', '', '42961'),
(725, 'Joppe Zaat', 'joppezaat@live.nl', 'joppezaat', '$P$D6MmZlhw/lfP3xKaAZ2zJq6XhRq9PK0', NULL, '', 'Joppe', '', 'Zaat', 'jalan Suweta 199', '', '', 'Next to the temple which is still under construction, 2 floor villa.', '81933012015', 1, '0000-00-00 00:00:00', '', '2014-09-18 07:57:01', 88, '2015-01-31 09:01:47', '', ''),
(726, 'Kinchem Hegedus', 'hegedus.kinchem@gmail.com', 'River House', '$P$DWoC29TCz5wcKPY0QzcsfwUVecGpPZ.', NULL, '', 'Kinchem', '', 'Hegedus', 'River House', 'Green Village, Sibang', '', 'Please call Green Village for directions 03618088746', '82144661637', 1, '0000-00-00 00:00:00', '', '2014-09-20 03:39:54', 0, '2014-09-20 03:39:54', '', '847356'),
(727, 'Amy Ratcliff', 'amylamorinda@gmail.com', 'amymoraga', '$P$DCaSzpMbNwuf3ktEvn.95W32RYZbfj0', NULL, '', 'Amy', '', 'Ratcliff', '34 Jembawan', '', '', 'Jl Hanoman 30 Shiva house\napp. nr 5', '81246260015', 1, '0000-00-00 00:00:00', '', '2014-09-20 08:27:50', 81, '2014-11-03 03:26:04', '', ''),
(728, 'Simon Loprete', 'simone.loprete@icloud.com', 'Loprete', '$P$DPLopmuhb9HGastCkFDmX4jRL/6uGU/', NULL, 'Mr', 'Simon', '', 'Loprete', 'Jalan Bisma No 28', '', '', '', '82146520017', 1, '0000-00-00 00:00:00', '', '2014-09-22 10:06:59', 0, '2014-09-22 10:06:59', '', '539384'),
(729, 'Maria Griffiths', 'mariaagstri@gmail.com', 'Mariagode', '$P$D.5e1s3v1A3AFkQe02G.pdE8s/HaiX.', NULL, 'Mrs', 'Maria', '', 'Griffiths', 'Banjar Abiansemal, Lodtunduh', '', '', 'Dari arah Ubud, Perempatan Puri Kawan mini market Lodtunduh, Belok kanan di perempatan, setelah Villa Kitty belok kanan lagi menuju Runa Jewelry Museum (Desa Bulan), Gang pertama disebelah kanan (ada warung penjual aqua galon). D'' Teba House ada di dalam gang itu, di pojok. Gang nya jalan buntu (dead end).', '85715383705', 1, '0000-00-00 00:00:00', '', '2014-09-26 11:04:27', 0, '2014-09-26 11:04:27', '', '393408'),
(730, 'Sal Gordon', 'margotreeve@gmail.com', 'Happy House', '$P$DrvbTMKsPPZGqasa6pabe8ARmuiCRC.', NULL, 'Mr', 'Sal', '', 'Gordon', 'just off Jl Kedewatan 2', 'Penestanan Kaja', '', '', '81239944974', 1, '0000-00-00 00:00:00', '', '2014-09-28 09:51:30', 0, '2014-09-28 09:51:30', '', '719095'),
(731, 'Darryn Hope', 'darrynhope@gmail.com', 'darrynhope@gmail.com', '$P$DiCaQNGNIbFlhWtl7PX3FJskGHr/Mn0', NULL, 'Mr', 'Darryn', '', 'Hope', 'gang Kupu Kupu No.5', 'Nyuh Kuning', '', '', '82339990824', 1, '0000-00-00 00:00:00', '', '2014-10-01 10:30:08', 78, '2014-10-26 23:18:32', '', ''),
(732, 'Rika Rika', 'harukarika@gmail.com', 'rika_beji', '$P$D8CaKBcH0urHrNxSr5Ebd.06rJ95oR1', NULL, 'Ms', 'Rika', 'Rika', 'Rika', 'Jalan Raya Sanggingan Ubud', 'Jalan Raya Sanggingan Ubud', '', 'Beji Ubud Resort - Receptionist', '87861488212', 1, '0000-00-00 00:00:00', '', '2014-10-02 10:02:21', 0, '2014-10-03 00:08:22', '', ''),
(733, 'Anton Eshtokin', 'ant.eshtokin@gmail.com', 'Tonik', '$P$DdpiHzR79Rr1b5K3mT3h0r7datldFe/', NULL, '', 'Anton', '', 'Eshtokin', 'Pondok Seken 2, Penestanan', '', '', 'Driving to Penestanan, turn to the left before "Round Bar" and go straight inside the village.', '8989817918', 1, '0000-00-00 00:00:00', '', '2014-10-03 11:36:54', 80, '2014-10-26 23:19:21', '', ''),
(734, 'Ibu Kat Wheeler', 'catalystbali@gmail.com', 'ibukat', '$P$D7KFM1UTIQNL5lB4eV8.UhMNyyvEjR0', NULL, '', 'Ibu Kat', '', 'Wheeler', '1A Lorong Bedangin', 'Tebesaya Timur', '', 'sebelah SD4\ndibelakan Pura Dalem Puri', '817341868', 1, '0000-00-00 00:00:00', '', '2014-10-08 09:30:13', 97, '2015-06-21 06:29:14', '', ''),
(735, 'Victor Dem', 'demedrolvs@mail.ru', 'Vic', '$P$DCl0Ft7OtEt7z3Sj2EkI5EVcXtwzqE0', NULL, 'Mr', 'Victor', '', 'Dem', 'Ubud 80571', '', '', 'Behind the Puri Gangga hotel', '81337557714', 1, '0000-00-00 00:00:00', '', '2014-10-12 13:15:38', 0, '2014-10-13 02:36:39', '', ''),
(736, 'fani  putra', 'fanivectorious@gmail.com', 'fanikini', '$P$DmdzhbE1VkoD7Sb41SYLsHzampDL7B0', NULL, 'Mr', 'fani', 'cahya', 'putra', 'jl. tirta tawar 50. kutuh kelod', '', '', 'I''m living on the 2nd floor of Mr. Nyoman Moning''s boarding house', '81999452590', 1, '0000-00-00 00:00:00', '', '2014-10-13 12:36:18', 0, '2014-10-13 12:36:18', '', '683075'),
(737, 'zczx czx', 'anil.k@cisinlabs.com', 'CISin', '$P$Dodags66nidp8zY4USc4SyMqakruTh0', NULL, 'Mr', 'zczx', '', 'czx', 'zczxc', '', 'UBUD, BALI', '', '123456789', 1, '0000-00-00 00:00:00', '', '2014-10-29 09:20:51', 0, '2014-11-08 05:26:48', '', ''),
(739, 'Artem Fedorov', 'artemf@mail.ru', 'artemf', '$P$D3WtwLLJNWpwcLoodVPRSyRxfo1/1B/', NULL, 'Mr', 'Artem', '', 'Fedorov', 'Monkey Forest Road 88x', '', '', '', '81239338693', 1, '0000-00-00 00:00:00', '', '2014-11-14 08:25:52', 0, '2014-11-14 08:25:52', '', '950265'),
(740, 'ilse', 'i_de_fouw@hotmail.com', 'ilse', '$P$DVlyoGRMyGEovE1eR3VYwnEErmPMk.1', NULL, 'Ms', 'ilse', '', '', 'Villa Pleiades, BR Abian Semal, Lotunduh, Ubud', '', '', '', '81932637437', 1, '0000-00-00 00:00:00', '', '2014-11-16 10:08:58', 0, '2014-11-17 00:26:11', '', ''),
(741, 'oka satria', 'o_satria@yahoo.com', 'okasatria', '$P$Df32nvm1MNOKU0z9SksDOFBijocp3U/', NULL, 'Mr', 'oka', 'satria', 'pramudana', 'alaya ubud resort &amp; spa', '', '', '', '81337005105', 1, '0000-00-00 00:00:00', '', '2014-11-16 12:06:42', 0, '2014-11-16 12:06:42', '', '560425'),
(742, 'Joni Kokkonen', 'jni.kokkonen@gmail.com', 'joni.kokkonen', '$P$Dvx1Pw/Z1IV9u1ly2GqJInoaC02Ojd/', NULL, 'Mr', 'Joni', 'Tapio', 'Kokkonen', 'Gang Panila no 11', '', '', 'Villa Cemara Kelecung\nGang Panila no 11\n\nDepan the Grove\nUmalas-Kelecung', '81285490640', 1, '0000-00-00 00:00:00', '', '2014-11-17 03:50:27', 0, '2014-11-17 03:50:27', '', '162985'),
(743, 'Christopher Burns', 'humansins.asia@gmail.com', 'Chris Burns', '$P$DGkYhX.R3Yk7Y/ZQpup4Q1BYQoNjVk.', NULL, 'Mr', 'Christopher', '', 'Burns', 'Jl. Pasung Griggis, Gg Gotami, Mas, Tengkulak Kelod', '', '', 'Di belakang art shop DW Malen. BUKAN warungnya tapi tempat ukiran kayu yg ada di tikungan.\n\n Masuk ke belakang sampai Pura pengajengan. Villa saya di depan Pura.', '81236759380', 1, '0000-00-00 00:00:00', '', '2014-11-18 08:25:30', 91, '2015-06-21 06:19:23', '', ''),
(744, 'Thomas', 'xninethreefourz@yahoo.com', 'xninethree', '$P$DWJ.WmXhYWvQidnXc5V3jwjiITGI9i0', NULL, 'Mr', 'Thomas', '', 'Wibowo', 'Jln.Presmasanti No.17', '', '', 'Kamandhani Cottage \nUnit 202', '819666118', 1, '0000-00-00 00:00:00', '', '2014-11-18 10:43:20', 0, '2014-11-18 10:43:20', '', '66238'),
(745, 'Daniela', 'daniela.pk.wagner@gmx.net', 'daniela.pk.wagner@gmx.net', '$P$DWbq2wNBXladcLwHTN80sV2hvVD.rz.', NULL, 'Ms', 'Daniela', '', 'Wagner', 'Br. Kumbuh', 'Mas', '', 'Cory Villa is 2 houses next to the Pelangi school, across from the Sekara Resort. We are in villa #2.', '82144162780', 1, '0000-00-00 00:00:00', '', '2014-11-18 12:09:49', 0, '2014-11-18 12:09:49', '', '144225'),
(746, 'Djuna', 'djunapix@gmail.com', 'djunaivereigh', '$P$DfrpeJn/WNsnkhxjhAa732bgMvjDH8.', NULL, 'Ms', 'Djuna', '', 'Ivereigh', 'Gang Nyuh Sangket #4, Nyuh Kuning', '', '', 'Di ujung Gang Nyuh Sangket. Sudah sering di-order. Tinggal tanya teman-teman di sana...', '8123855853', 1, '0000-00-00 00:00:00', '', '2014-11-21 13:46:47', 0, '2014-11-21 13:46:47', '', '863605'),
(747, 'Peter', 'brad.pete@web.de', 'Petlis', '$P$DGdgFpfKN8kfDkvxUMscW.fRpRqMQ10', NULL, 'Mr', 'Peter', '', '', 'Penestanan', '', '', 'Naga-Naga near Yellow Flower Café und Villa Pagoda (Penestanan, Ubud)', '81908512138', 1, '0000-00-00 00:00:00', '', '2014-11-22 08:32:46', 0, '2014-11-23 02:00:12', '', ''),
(748, 'Alexis Guillaud', 'alexis.guillaud@gmail.com', 'Alexis10000', '$P$D9hoFsf3sp5yQoda/DCe4PhD89APSd1', NULL, 'Mr', 'Alexis', '', 'Guillaud', 'Hanoman Street, Padang Tegal, Ubud, Gianyar, Bali,Indonesia', 'Room 7', '', 'In Hanoman street, next to a small Delta Dewata. There is a small way to access to the homestay. From Hanoman street you can see the Delta Dewata, and next to it you can see a sign "Jati Homestay". On the right side of the road.', '81239134030', 1, '0000-00-00 00:00:00', '', '2014-11-22 10:06:08', 0, '2014-11-22 10:06:08', '', '292846'),
(749, 'leong chin chin', 'crystal681984@yahoo.com', 'leong', '$P$DbTXrgCGvejJ7sqVDEeFw3P5Y4fQhk0', NULL, 'Ms', 'leong', 'chinchin', '', 'jl sugriwa,no.59,br. padang tegal klod', '', '', '', '87861620251', 1, '0000-00-00 00:00:00', '', '2014-11-26 11:32:26', 0, '2014-11-26 11:32:26', '', '683307'),
(750, 'Alejandro Keymer Gausset', 'akeymer@gmail.com', 'akeymer', '$P$DYqF1A8GcfiN6Eg.dHlq1zIRcc.AVl.', NULL, 'Mr', 'Alejandro', 'Keymer', 'Gausset', 'T-house kaja, Lodtunduh', '', '', 'Lodtunduh village, next to Lodtunduh Sari.', '82245949506', 1, '0000-00-00 00:00:00', '', '2014-11-27 07:46:39', 0, '2014-11-28 00:13:19', '', ''),
(751, 'Klaus Ridder', 'mails.pizzabagus.com@kridder.de', 'catzee', '$P$DYtuFTgjNlwyY1xP9i9MpgPSprRFl3/', NULL, 'Mr', 'Klaus', '', 'Ridder', 'Banjar Teruna, Peliatan', '', '', '', '81314835199', 1, '0000-00-00 00:00:00', '', '2014-11-27 12:04:26', 0, '2014-11-27 12:04:26', '', '664477'),
(752, 'Nick Watson', 'nickwatson@hotmail.com.au', 'Nickwatts42', '$P$D4Zo/oDwZ/mpaRn6iDAL.Jy13yqH.U1', NULL, 'Mr', 'Nick', '', 'Watson', 'Jalan Monkey Forest', '', '', 'Room 207', '81238099895', 1, '0000-00-00 00:00:00', '', '2014-11-28 10:03:35', 0, '2014-11-28 10:03:35', '', '612677'),
(753, 'Sherlyn Toh', 'zeraviel@gmail.com', 'lynnie', '$P$D4x09eiXZTc6FWto8IaeUuG4YWn4ep.', NULL, 'Ms', 'Sherlyn', '', 'Toh', 'Ajun Villa', 'Sri wedari, junjungan', '', '', '82236637296', 1, '0000-00-00 00:00:00', '', '2014-11-30 09:10:41', 0, '2014-12-01 00:50:22', '', ''),
(754, 'Itziar', 'itzisss@hotmail.com', 'Itziar', '$P$DWGOdC3s8kppgYBgzbHAAP8yJmMyar1', NULL, 'Mrs', 'Itziar', '', 'San sebastian', 'Jl. Kajeng', '', '', 'Jl. Kajeng up to the rice fields. Pass the Samaras. Satori Villas. The first one Villa Solera', '81236143726', 1, '0000-00-00 00:00:00', '', '2014-11-30 10:42:58', 98, '2015-06-21 06:30:04', '', ''),
(755, 'Renee', 'Images@reneebrazel.com', 'Renee', '$P$D.DxYRUCknSqIxxGMwxfFL4wlL8jqr.', NULL, 'Ms', 'Renee', 'Mel', 'Brazel', 'Tatiapi kaja', 'Pejeng kawan', '', 'We are staying at Indigo Tree Villas, 15 mins from city centre. best number to contact is the villas(as we have limited service and credit), we have informed the front desk. We will be there for easy collection. The villas number is 0361976522 if you need directions.', '81239376597', 1, '0000-00-00 00:00:00', '', '2014-11-30 11:08:17', 0, '2014-11-30 11:08:17', '', '324042'),
(756, 'Ali Freeman', 'ali.freeman@jpalglobal.com', 'alifree', '$P$DbdkqFhdC8m7tM1u/DdFRRNcbcPJPw1', NULL, 'Ms', 'Ali', '', 'Freeman', 'Jalan Raya Nyuh Kuning', '', '', 'We are right next to the Bali Cultural Center, before Jalan Raya Bojong.\nThere is a sign out front that says "Balibbu"', '81337395628', 1, '0000-00-00 00:00:00', '', '2014-12-01 06:21:41', 0, '2014-12-01 06:21:41', '', '161795'),
(757, 'Tia', 'tia-kurtz@live.com.au', 'Tkurt4', '$P$D38XXM1XSi/CZ6TjOy89iqVGreEGhk1', NULL, 'Ms', 'Tia', '', '', 'Satori next to sanctuary village at the end of Jalan Pengosaken', '', '', '', '81237868397', 1, '0000-00-00 00:00:00', '', '2014-12-01 11:11:10', 0, '2014-12-01 11:11:10', '', '556730'),
(758, 'Nina', 'A@hot.com', 'Nina', '$P$DXixfZy.zlN6a6aE1mjx48aJX/XlAA.', NULL, 'Mrs', 'Nina', '', 'Nina', 'Jl.Sriwedari no. 21', '', '', '0361 970527', '81338770122', 1, '0000-00-00 00:00:00', '', '2014-12-02 10:28:43', 0, '2015-03-07 03:05:48', '', ''),
(759, 'Luffy', 'lutfiah13@gmail.com', 'Luffy', '$P$DtMBQkDnvvRQxEU2vxTRrhDlD8Il5X.', NULL, '', 'Luffy', '', 'A.J', 'Taman Indrakila', '', '', 'Please call us when u arrive we will pick up from reception.', '81239195574', 1, '0000-00-00 00:00:00', '', '2014-12-06 13:27:30', 0, '2014-12-06 13:27:30', '', '362246'),
(760, 'Chris', 'christianst@gmx.net', 'christianst', '$P$DxwgDQqaEVnBp2zC9siHR7PSJjlJ4C/', NULL, 'Mr', 'Christian', '', 'Schulze-Thüsing', 'Jalan Nyuh Bojog', 'Room No. 6', '', '', '81361294880', 1, '0000-00-00 00:00:00', '', '2014-12-07 10:04:45', 0, '2015-03-07 03:03:11', '', ''),
(761, 'Lindsey Stirling', 'linzi7888@hotmail.com', 'linzi', '$P$Dg5/GQIuNDzqmb9WN8S6nj6LER3XBE1', NULL, 'Mrs', 'Lindsey', '', 'Stirling', 'Rumah Irwin, gang nyuh pelet 06, jalan raya, nyuh kuning', '', '', 'Near temple', '0813 3831 1638', 1, '0000-00-00 00:00:00', '', '2014-12-10 10:31:12', 0, '2014-12-10 10:31:12', '', '87120'),
(762, 'Mr. Greg', 'Koshkind@gmail.com', 'Mr. Greg', '$P$DLKPDYFoyDprXh/oCrE6gBbBM5WIjo1', NULL, 'Mr', 'Greg', '', 'Matukov', 'Jl Suweta, Gang Madya No 3', '', '', 'near Bali Asli Lodge', '81337427760', 1, '0000-00-00 00:00:00', '', '2014-12-11 03:11:08', 83, '2015-06-11 01:25:17', '', ''),
(763, 'BAWA', 'debdeb@bawabali.com', 'BAWA', '$P$DKIM9zOtrJv4xcr.ZsweSa5BxBDKq41', NULL, 'Ms', 'deb &amp; tanti', '', 'oliver', '100X Jl. Monkey Forest st.', '', '', 'sebelah Venezia Spa  :)', '82237087803', 1, '0000-00-00 00:00:00', '', '2014-12-11 03:58:28', 93, '2015-06-21 06:45:42', '', ''),
(764, 'lindsey', 'lj3stirling@students.latrobe.edu.au', 'lj3stirling', '$P$D7I6HJy8U55TzAk6Uhc9jp6UqQp7K1/', NULL, 'Ms', 'Lindsey', '', 'Stirling', 'rumah irwin, gang nyuh pelet 06, nyuh kuning', '', '', 'please bring food upstairs', '81338311638', 1, '0000-00-00 00:00:00', '', '2014-12-12 11:52:43', 0, '2014-12-12 11:52:43', '', '863981'),
(765, 'Pu Tzu', 'pustuff@gmail.com', 'pub1tzu', '$P$D.k/VyF/lMtR0VId8ae7Fj7edxMCyh/', NULL, '', 'Robert', '', 'Fowler', 'Monkey Forest Rd.', '', '', '', '81999146934', 1, '0000-00-00 00:00:00', '', '2014-12-12 11:59:55', 0, '2014-12-12 11:59:55', '', '579074'),
(766, 'Anna', 'annafischerkrayer@gmail.com', 'annafischer', '$P$DytLxarPL8EMVZhno1Hqx80yiawo0G/', NULL, 'Ms', 'Anna', '', 'Fischer', 'Bamboo House', 'T House Klod', '', '', '82273977307', 1, '0000-00-00 00:00:00', '', '2014-12-18 07:59:05', 0, '2014-12-18 07:59:05', '', '383292'),
(767, 'Cami', 'hello@camellie.com', 'cami', '$P$D.nhvmvZa7bs4UW86Fj1aNzHxgsS1i1', NULL, 'Ms', 'Cami', '', 'Dobrin', 'Sri Wedari', '', '', '', '82145833368', 1, '0000-00-00 00:00:00', '', '2014-12-18 08:37:40', 0, '2014-12-18 08:37:40', '', '309088'),
(768, 'Ebonie', 'ebonie@ebonieallard.co.uk', 'ebonie', '$P$Dp329d6tGr4DoS60BiIZiR/LPCgNSU0', NULL, 'Ms', 'Ebonie', '', 'Allard', 'jalan Pengoseken', '', '', 'If you ask the office at Rumah David for Ebonie they can show you which villa I am in. Thank you.', '85738425056', 1, '0000-00-00 00:00:00', '', '2014-12-20 05:47:31', 0, '2014-12-20 05:47:31', '', '97588'),
(769, 'Daniel Struba', 'dan.struba@bluewin.ch', 'Anogenic', '$P$DR4kl/Rb/CXnTG7lVdn4HOMwoMeuIl1', NULL, 'Mr', 'Daniel', '', 'Struba', 'Tirta Tewar', 'Kutuh Kaja', '', '100 meters after Warung Made Becik turn left, sign to "Big orange house", down steep hill then straight up other side, Agunk Villa Group, Sita House', '81337700970', 1, '0000-00-00 00:00:00', '', '2014-12-21 12:54:20', 92, '2015-06-21 06:22:49', '', ''),
(770, 'David Schult', 'filosofic@gmail.com', 'filosofic', '$P$DXKApbuBjpb7LxzZixSpXs1.NXbeuU1', NULL, 'Mr', 'David', '', 'Schult', 'Bali T House', '', '', 'Kamanta House', '82111553453', 1, '0000-00-00 00:00:00', '', '2014-12-22 09:17:09', 0, '2014-12-22 09:17:09', '', '796057'),
(771, 'Rebecca Kingsbury', 'becksurfinbabe@hotmail.com', 'Radiant', '$P$DIZAHmkPDs/NsXXEciBYKiGaw1YyqH1', NULL, 'Ms', 'Rebecca', '', 'Kingsbury', 'Jalan Bisma', '', '', '', '87862473662', 1, '0000-00-00 00:00:00', '', '2014-12-22 12:23:42', 0, '2014-12-22 12:23:42', '', '853967'),
(772, 'Shane', 'shane@jca.com.au', 'shane', '$P$DB/AVO6hHUcuex74a6NFbVjHhO839H.', NULL, '', 'Shane', '', 'McRae', 'Jl Raya Mas, No 50', '', '', 'Tempat Aman is 450m past Ari Canti Klinic (Mas Hospital) on the opposite side. It is next door to Arca Alon Gallery.', '8123809044', 1, '0000-00-00 00:00:00', '', '2014-12-23 03:27:27', 0, '2014-12-23 03:27:27', '', '503803'),
(773, 'Di Rowling', 'di@iikon.biz', 'Di Rowling', '$P$Dhk.jumo.wecV.PlMCSsP.geGEb/aC0', NULL, 'Ms', 'Di', '', 'Rowlng', '1a Lorong Bedangin', 'Tebasaya (di samping SD 4)', '', '', '82147449506', 1, '0000-00-00 00:00:00', '', '2014-12-25 09:23:55', 0, '2014-12-29 02:55:48', '', ''),
(774, 'Samantha Jane Bond', 'samantha.bond1414@gmail.com', 'Samb14', '$P$D2SHniJzwYKvx4CAzcG2mnpJI/IKrj0', NULL, 'Ms', 'Samantha', 'Jane', 'Bond', 'Jl. Raya Nyuh Kuning', '', '', 'We are in a backpackers called Balibbu. There is a green sign out the front with the name on it.', '81288733735', 1, '0000-00-00 00:00:00', '', '2014-12-25 10:34:15', 0, '2014-12-25 10:34:15', '', '533757'),
(775, 'roman', 'spam1922@mail.ru', 'roman', '$P$DvrCqlb9Go614Mb/Lq5eD6s/gPx0WN/', NULL, 'Mr', 'Roman', '', 'Naumov', '37B Jalan Tirta Tawar Kuth Kaja Ubud', '', '', '', '82247055713', 1, '0000-00-00 00:00:00', '', '2014-12-27 11:42:28', 0, '2014-12-29 02:56:06', '', ''),
(776, 'Tara', 'Taracroberts@yahoo.com', 'Taracroberts', '$P$DWe5Gqk8F0kRJrGXm6YE4WC8.fvyNS1', NULL, '', 'Tara', '', 'Roberts', 'Galah penestanan', '', '', '', '82236901359', 1, '0000-00-00 00:00:00', '', '2014-12-31 04:53:29', 0, '2014-12-31 04:53:29', '', '488928'),
(777, 'carol', 'Carol@suncountryfurniture.com', 'carolbali', '$P$DDsExeDko3PMk8j4EfCnlZwuGvpO4M1', NULL, '', 'Carol', '', 'Dodge', 'on the path to Sari Organic', '', '', 'First villa on the left after Nur Salon - take the path to sari organic............. the first house on the left. House is directly across nur salon.', '8979034222', 1, '0000-00-00 00:00:00', '', '2014-12-31 12:32:39', 0, '2014-12-31 12:32:39', '', '742529'),
(778, 'Maxime', 'biffmax78@yahoo.fr', 'maxime', '$P$DaY/J2L5lxdI.4HydWGZDN8HwwkzVB/', NULL, 'Mr', 'maxime', '', 'hazera', 'jalan suweta', '', '', 'Just after the big resort WAKA DI UME, on the left side.', '82146494968', 1, '0000-00-00 00:00:00', '', '2015-01-01 11:34:56', 0, '2015-01-01 11:34:56', '', '167011'),
(779, 'BIbie', 'envy_pangestuti@yahoo.com', 'bibie', '$P$DN/H9yDZn8JL/o8By4EzlXNkhBoDNF.', NULL, 'Mr', 'Kartiko', 'sri', 'Kuncoro', 'sapulidi resort Jl Raya pengosekan Banjar pengosekan kelod mas', '', '', '', '8161145666', 1, '0000-00-00 00:00:00', '', '2015-01-03 12:19:15', 0, '2015-01-03 12:19:15', '', '218902'),
(780, 'alsit', 'sitaropoulos@gmail.com', 'alsit', '$P$Do7SOFTH56X9ffGtC7h/SDx4pX55GC/', NULL, 'Mr', 'Alexis', '', 'Sitaropoulos', 'Jl. Raya Anak Agung Gede Rai, Banjar Abian Semel', 'Lod Tunduh Village', '', 'We are next door to the Gino Feruci Villa and Spa', '81916364209', 1, '0000-00-00 00:00:00', '', '2015-01-03 12:35:59', 0, '2015-03-07 02:50:17', '', ''),
(781, 'Mschouren', 'schou22m@mtholyoke.edu', 'Mschouten', '$P$DzrtCGnzfvH8lg8zz8g2BH6t/fBVuj0', NULL, 'Ms', 'Marijke', '', 'Schouten', 'Jl suweta', '', '', '200m north of  Wapa Di Ume Resort on the right side with a sign of a bird and a heart. We can come collect on the road if you call us', '81283699920', 1, '0000-00-00 00:00:00', '', '2015-01-03 13:36:49', 0, '2015-01-03 13:36:49', '', '742784'),
(782, 'Hoggs', 'Richard.hogg@electrolux.com.au', 'RPECG', '$P$DSNmngGAq/jk3FMCQ2aiYSbtmk1Clv1', NULL, 'Mr', 'Richard', '', 'Hogg', 'Villa3 jumah JL Bisma', '', '', 'We are in the 3rd villa at the bottom of the steps at the jumah', '82247400804', 1, '0000-00-00 00:00:00', '', '2015-01-04 09:18:56', 0, '2015-01-04 09:18:56', '', '473756'),
(783, 'Tom', 'tom.mcardle240@gmail.com', 'WuTom', '$P$DHSH8OzRiAsc3xzhuW0lh1x2.twx5F.', NULL, 'Mr', 'Tom', '', 'McArdle', 'Penestanan Kelod', '', '', 'When you get to the volleyball court, house is on other side of the road. Over small wooden bridge, up the stairs.', '81236799696', 1, '0000-00-00 00:00:00', '', '2015-01-11 11:44:41', 124, '2016-10-04 03:43:02', '', ''),
(784, 'Christian', 'c.ackermann@kabelmail.de', 'Christian', '$P$Dk1TOm0NDoHPh5x9Y4EUFqe3eWIGVX1', NULL, 'Mr', 'Christian', '', 'Ackermann', 'Room @ Bali, Jl. Raya Sayan, Kutuh', '', '', 'Appartement 4, Hip &amp; Chic Suite', '82236647621', 1, '0000-00-00 00:00:00', '', '2015-01-11 12:20:24', 0, '2015-01-11 12:20:24', '', '538461'),
(785, 'Mirksa', 'Mirjeke@gmail.com', 'Mirksa', '$P$DOmUZmEAQFChr6N8BBvbVlRYSq5y6b.', NULL, '', 'Mirje', '', 'Kuris', 'in Nyuh Kuning, jalan Nyuh Gading, gang sudemale no 3', '', '', 'in Nyuh Kuning, jalan Nyuh Gading, gang sudemale no 3.in front of bumi\nsehat.and next loka pala villa', '82237770794', 1, '0000-00-00 00:00:00', '', '2015-01-11 12:34:48', 0, '2015-01-11 12:34:48', '', '13754'),
(786, 'Erin Bender', 'erin@bender.com.co', 'erinbender', '$P$DCGqTLm0rhIA1R64tHj4Udd0DFTFK20', NULL, 'Mrs', 'Erin', '', 'Bender', 'Jl. Penestanan Kelod', '', '', 'Enter next to Round Bar on Jl Raya Penestanan. Continue straight past a laundry and mini mart and turn first right.\nIf you can''t find it, just call my mobile when you''ve reached the Round Bar and I will walk out and meet you.', '81239377802', 1, '0000-00-00 00:00:00', '', '2015-01-18 10:15:09', 95, '2015-06-21 06:28:15', '', ''),
(787, 'Stevo', 'stephenvovan@gmail.com', 'vovantics', '$P$DCZwl/0cy/YtMZWu77LkXPtoIfC0Jv0', NULL, 'Mr', 'Stephen', '', 'Vo Van', 'Jln Raya Pengosekan, Ubud, Bali 80571, Indonesia', 'Ontario', '', '', '81248787818', 1, '0000-00-00 00:00:00', '', '2015-01-20 06:13:29', 0, '2015-01-20 06:13:29', '', '760085'),
(788, 'erik emsey', 'erikemsley@gmail.com', 'erike', '$P$DLXKqCxBPTMSAVE5Q8wSpOdhliiZbf0', NULL, 'Mr', 'erik', '', 'emsley', 'Jl. Lodtunduh 1 Ubud Bali', '', '', 'the villa is behind galeri tanah THO. Villa is called kakul villa.  Located on jalan lodtunduh 1, banjar abiansemal Ubud', '87861571431', 1, '0000-00-00 00:00:00', '', '2015-01-21 03:19:16', 0, '2015-01-21 03:19:16', '', '821373'),
(789, 'Beth Anderson', 'bethlouiseanderson@yahoo.com.au', 'Beth Anderson', '$P$D7IYZJIIMOCgNh9dkkTI4B1gIV1gHJ1', NULL, 'Ms', 'Beth', '', 'Anderson', 'T House Kaja - Hibiscus', 'Lodtunduh', '', '', '81353193862', 1, '0000-00-00 00:00:00', '', '2015-01-21 03:58:03', 0, '2015-01-21 03:58:03', '', '145927'),
(790, 'Tamilyn Foley', 'tam.97@hotmail.com', 'tamilynfoley', '$P$DWtFcdJ0pAFENLQTFPlMvkpLh61VlT1', NULL, 'Ms', 'Tamilyn', '', 'Foley', 'Jl. Penestanan', '', '', '', '81337675372', 1, '0000-00-00 00:00:00', '', '2015-01-23 10:34:33', 0, '2015-01-23 10:34:33', '', '458730'),
(791, 'Capodieci', 'roberto@capodieci.com', 'capodieci', '$P$DZOyw4p8xzipKOGaXmJY0JmWC5ddsY1', NULL, 'Mr', 'Roberto', '', 'Capodieci', 'Br Abangan', '', '', '', '82262226666', 1, '0000-00-00 00:00:00', '', '2015-01-24 05:27:09', 105, '2015-06-21 06:49:45', '', ''),
(792, 'enginewitty', 'enginewitty@yahoo.com', 'enginewitty', '$P$DyrLeJM1qgNXPo/TN4rFAHq9utqAQM.', NULL, '', 'Andy', '', 'Harless', ' Jalan Raya Andong', '', '', '', '82147949216', 1, '0000-00-00 00:00:00', '', '2015-01-24 14:27:06', 0, '2015-01-24 14:27:06', '', '520388'),
(793, 'Tom', 'tom.vaswani@gmail.com', 'Anonymous', '$P$DHI9Odg6GylG/Hle1xI65YC5NfnDwP0', NULL, 'Mr', 'Tom', '', 'Tom', 'Jalan Raya Sayan', 'Br. Kutuh', '', 'Turn left at sign of Puksemas II. Villa compound 50m from main road. Ask security guard for entry.', '8121078880', 1, '0000-00-00 00:00:00', '', '2015-01-25 08:48:37', 108, '2015-06-21 06:40:48', '', ''),
(794, 'Widi', 'info@ubudskinorganic.com', 'Widi', '$P$DkbhyvaAyZFBqM.60mPso3YQfoAsBh0', NULL, 'Ms', 'Widi', '', 'Widi', '36 Jl Sanggingan', '', '', 'Above SKIN Spa, Sanggingan.\nAcross road from Kopi Kats Resto.\nPark in back.\nStairs upstairs in back.', '81936035067', 1, '0000-00-00 00:00:00', '', '2015-01-28 12:27:56', 0, '2015-01-28 12:27:56', '', '931818'),
(795, 'Aski Catranti', 'aski_catranti@yahoo.com', 'Aski', '$P$DAqwmT5gEvLcz.LtioVN1g6eqpNmBo.', NULL, 'Mrs', 'Aski', '', 'Catranti', 'Jl. Gunung Sari Peliatan Ubud', '', '', '', '81291900085', 1, '0000-00-00 00:00:00', '', '2015-01-29 12:40:12', 0, '2015-01-29 12:40:12', '', '51353'),
(796, 'StarrLove', 'nicole@nikstarr.com', 'StarrLove', '$P$DW241dhwKszMnj/SpJEkC7kBBkYxFQ.', NULL, 'Ms', 'Nicole', '', 'Starr', 'Jl. Suweta', 'Bentuyung', '', 'Driving up Jl. Suweta pass the Sri Wedari Bridge.\n2.4 kilometre more.\nVilla on right with color flags, opposite Bumi Resto..', '87860222930', 1, '0000-00-00 00:00:00', '', '2015-01-30 10:47:42', 0, '2015-01-30 10:47:42', '', '901427'),
(797, 'Mila', 'milavandermeer@hotmail.com', 'mila', '$P$DYuD2FxISG9NTS8meTnM8xS0h7OoH6/', NULL, 'Ms', 'Mila', 'van der', 'Meer', 'Jalan Sri wedari', '', '', 'Setelah warung jepun masuk gang di kiri jalan, namanya Yang Way (gang buntu). Rumah yang terakhir.', '82144801442', 1, '0000-00-00 00:00:00', '', '2015-01-30 11:03:53', 104, '2015-06-21 06:35:41', '', '');
INSERT INTO `cr_customer` (`cr_customerID`, `cr_customerDisplayname`, `cr_customerEmail`, `cr_customerUsername`, `cr_customerPassword`, `cr_customerHotelvilla`, `cr_customerTitle`, `cr_customerFirstname`, `cr_customerMiddlename`, `cr_customerLastname`, `cr_customerAddress1`, `cr_customerAddress2`, `cr_customerCity`, `cr_customerDetail`, `cr_customerPhone`, `cr_customerStatus`, `cr_customerLastlogin`, `cr_customerToken`, `cr_customerRegistered`, `cr_customerNumber`, `cr_customerModified`, `cr_customerModifiedby`, `cr_customerPhoneverify`) VALUES
(798, 'Tami Tacklind', 'tamitack@gmail.com', 'tamitack', '$P$DteoLyKwY/TkfY/vTyHZla8LZww3qd1', NULL, 'Mrs', 'Tami', '', 'Tacklind', 'Ujung House', 'Jl. Tirta Tawar', '', 'Driveway called "Sapas Sari"\nLeft side of road\n\nJust before Warung Made Becik', '08123 666 3365', 1, '0000-00-00 00:00:00', '', '2015-01-30 11:38:19', 0, '2015-01-30 11:38:19', '', '73145'),
(799, 'Tegan', 'Tegan.liddell@gmail.com', 'Tegan', '$P$DvZXn0.6KMiOCLFwHi4CAqObFOj68Z0', NULL, 'Ms', 'Tegan', '', 'Liddell', 'Monkey forest road', '', '', 'Room 17 far room on the left', '87860131363', 1, '0000-00-00 00:00:00', '', '2015-01-31 11:17:06', 0, '2015-01-31 11:17:06', '', '769096'),
(800, 'simon', 'info@simonamon.com', 'simonamon', '$P$DfqiwySBGjqJO.HkFC.SFG1fyUI6ei0', NULL, 'Mr', 'simon', '', 'amon', 'Jalan Raya Goa Gajah 1, Banjar Tengkulak Tengah, Desa Kemenuh', '', '', '', '81575697984', 1, '0000-00-00 00:00:00', '', '2015-01-31 12:05:38', 0, '2015-01-31 12:05:38', '', '704876'),
(801, 'MarS', 'bucitindah@gmail.com', 'MarS', '$P$D.TMcwGF9PJ4TWSgkY8krbnpEs02Tu1', NULL, 'Mr', 'Martin', '', 'Schmelter', 'Jl. Sugriwa No. 30', '', '', '', '82167431274', 1, '0000-00-00 00:00:00', '', '2015-02-01 10:31:00', 0, '2015-02-01 10:31:00', '', '610039'),
(802, 'Liam', 'liamtravel@gmail.com', 'Liam', '$P$DZjGW1mnbOVZ7zsf0ZBK/wsb3LtbYW1', NULL, 'Mr', 'Liam', '', 'Birch', 'Jl Tirta Tawar', 'Jungungan', '', 'Andrews old house.\nbeside Villa Jungungan  (Not Jungugnan Resort)', '81236060400', 1, '0000-00-00 00:00:00', '', '2015-02-05 04:25:17', 102, '2015-06-21 06:33:22', '', ''),
(803, 'Pete', 'netlink@juno.com', 'Ubudbali', '$P$DD99ohWU/wUUDn1vFMvvHf4G6FFfZM/', NULL, 'Mr', 'Pete', '', 'Hall', 'Villa Palm Kuning', 'Penestanan', '', 'In Penestanan, located behind Alchemy.  Enter the parking lot on the side of Round Bar and continue straight through past Gratitude Cafe. Villa Palm Kuning is located in the private villas on the left down a small lane.  It is the 2nd villa on the lane.', '82236654424', 1, '0000-00-00 00:00:00', '', '2015-02-05 10:08:48', 0, '2015-02-05 10:08:48', '', '459329'),
(804, 'Giovanirosa', 'ochamystica93@gmail.com', 'giovanirosa', '$P$DB9kjtE6qU.wMRdmBD07vCjXXdvR99.', NULL, 'Mr', 'Putu', 'Agus', 'Indrayana', 'Jl. Pura Samuan Tiga No. 3, Bedulu, Blahbatu, Gianyar', '', '', 'Dari Pizza Bagus ke arah Goa Gajah, kemudian lurus sampai menemukan patung di perempatan jalan. lurus ke arah Pura Samuan Tiga, rumah nomor 3 di kiri jalan, berlantai 2, terlihat paling tinggi.', '82137482575', 1, '0000-00-00 00:00:00', '', '2015-02-10 15:03:33', 0, '2015-02-10 15:03:33', '', '322948'),
(805, 'Heleen', 'hasdehoog@gmail.com', 'Heleen', '$P$DYNp8NaML5du76jFfAiBkfvvl9bV2//', NULL, 'Ms', 'Heleen', 'de', 'Hoog', 'Jalan Bisma', '', '', 'In Jalan bisma, go for 600 meters, when you arrive at Nicks Pension restaurants (left side), turn right on the small paths through the rice field. (only by feet or bike/motorbike, too small for cars). After 100 meters, go on your right until you see Happy Inn 2 and Pelangui Homestay. Pass them, and after my house is the last one on the left side before the rice field.', '82247405937', 1, '0000-00-00 00:00:00', '', '2015-02-14 09:31:50', 0, '2015-02-14 09:31:50', '', '67075'),
(806, 'Jacob', 'Iamjacobwynn@hotmail.com', 'Marlzzz', '$P$DWTC3ivV1fyf0EKa5pPqDowlgWZ3t1/', NULL, 'Mr', 'Jacob', '', 'Wynn', 'Uma Sari villa #3', 'Penestanan Kelod', '', 'Just before dreams cafe you will see the sign for uma Sari. My villa gate will be open', '82236176767', 1, '0000-00-00 00:00:00', '', '2015-02-15 05:48:57', 0, '2015-02-15 05:48:57', '', '256536'),
(807, 'John', 'john@johnabbott.me', 'Emjay', '$P$Dkz7HNcXkiZBvevaMFCMHHGpflfjHq/', NULL, 'Mr', 'John', '', 'Abbott', 'Jl Tirta Tawar, Kutuh Kaja', 'No 69', '', '', '82147596286', 1, '0000-00-00 00:00:00', '', '2015-02-15 08:06:17', 0, '2015-02-15 08:06:17', '', '806853'),
(808, 'Roman', 'robertkein@gmail.com', 'robertkein', '$P$D5ACcVo68enrbXvtR.GBIdWqDFqFpA1', NULL, 'Mr', 'Roman', '', 'Kozyrev', 'Petulu village, Katuh Kaja', 'Jalan Tirta Tawar 9', '', 'It`s a new house, so It has no number plate on it.\nIt`s located 150-200 meters north from Kubu Merta hotel.\nYou have to stop right infornt of blue Suzuki Grand Vitara with number 513 on plate that is parked on the left side of the road.\nThan you can call my phone number so I explain the way and meet you.', '81236001373', 1, '0000-00-00 00:00:00', '', '2015-02-15 08:53:19', 106, '2015-06-21 06:38:10', '', ''),
(809, 'callie', 'Callie.j.helms@gmail.com', 'cj.helms', '$P$DVeQJaWm1Esq.V2G/3ShHe9Tpt.EXA1', NULL, 'Ms', 'Amy', '', 'Harper', 'Jalan  hanoman  no.40 ubud', '', '', 'Room 5', '85738006380', 1, '0000-00-00 00:00:00', '', '2015-02-15 10:07:51', 0, '2015-02-15 10:07:51', '', '804198'),
(810, 'Toby', 'tloneragan@gmail.com', 'Toby', '$P$DreT5ZKikFOZqO0bdh8Jo.DDMgMHie/', NULL, 'Mr', 'Toby', '', 'Loneragan', 'Gang JJ Salon, Jl Raya Andong', '', '', '', '82236611331', 1, '0000-00-00 00:00:00', '', '2015-02-16 11:09:28', 0, '2015-02-16 11:09:28', '', '520953'),
(811, 'Christopher Burns', 'chris@secretsumatra.com', 'humansinc', '$P$Dz98qVZJ5JXEop6TB1I6Me1bwdPgwz.', NULL, 'Mr', 'Christopher', 'M', 'Burns', 'Jl. Pasung Griggis, Gg Gotami, Mas, Tengkulak Kelod', '', '', 'Di belakang DW Malen Gallery. Masuk ke belakang. Rumah saya di depan pura pengajengan', '81236759380', 1, '0000-00-00 00:00:00', '', '2015-02-19 12:32:57', 91, '2015-06-21 06:21:19', '', ''),
(812, 'Johann', 'ecrismoiunmouton@gmail.com', 'Johann', '$P$Dh8vutp6kTN4oogHfctTxXkxrGurF0.', NULL, 'Mr', 'Johann', '', 'Tonon', 'Jl. Arjuna', 'First little Street one the left in Arjuna str', '', 'Room Rama 2', '82144021957', 1, '0000-00-00 00:00:00', '', '2015-02-20 04:19:28', 0, '2015-02-20 04:19:28', '', '118180'),
(813, 'Anders Alm', 'anders.alm.no@gmail.com', 'anders', '$P$DDGGgIpSlAQuqtBXygfJelFmHnmBZn1', NULL, 'Mr', 'Anders', '', 'Alm', 'Banjar Laplapan', '', '', 'Phone hotel : 0361 8987898\n\nRoom: Gabah 1', '82146432344', 1, '0000-00-00 00:00:00', '', '2015-02-23 14:01:27', 0, '2015-02-23 14:01:27', '', '419482'),
(814, 'Kate', 'k.gaika@mail.ru', 'Katrin', '$P$Dv3Koi58edtt2APrqx.tx4QBcAmJjA1', NULL, '', 'Kate', '', 'Gavrilenko', 'Lodtuntuh', '', '', '', '81529115158', 1, '0000-00-00 00:00:00', '', '2015-03-03 12:59:13', 0, '2015-03-03 12:59:13', '', '466144'),
(815, 'Laura', 'laurascheffner.ls@gmail.com', 'laura123', '$P$Dijjry3pwxcVtRCUpuKQuE7G/awgA51', NULL, 'Mrs', 'Laura', '', 'Scheffner', 'Jalan Tirta Tawar', 'stop Aneh Aneh', '', 'Next to Warung AA. Go down the hill and it''s the last house. If you can not find please call.', '81238377069', 1, '0000-00-00 00:00:00', '', '2015-03-05 09:21:00', 0, '2015-03-05 09:21:00', '', '59757'),
(816, 'Chloe', 'chloe.c.kirk@gmail.com', 'Chloe Kirk', '$P$D/AS1BgWHIsfQhVplg8QfmOG9umLBW0', NULL, 'Mr', 'Chloe', '', 'Kirk', 'Jl. Sukma, Indonesia', '', '', 'In the back by the pool. Please bring paper plates and napkins if you have them', '81999779791', 1, '0000-00-00 00:00:00', '', '2015-03-10 12:10:24', 0, '2015-03-10 12:10:24', '', '415899'),
(817, 'Tomas Jasovsky', 'jasovskyt@gmail.com', 'madeinmoments', '$P$DixGbAkG6rQy5.tsrnj06LCHmPcErG0', NULL, 'Mr', 'Tomas', '', 'Jasovsky', 'Pengosekan Road', 'Br Kumbuh, Mas- Ubud', '', 'Call hotel if you couldn''t find it.\nTel. 0361 971915\nRoom n 104', '81238120296', 1, '0000-00-00 00:00:00', '', '2015-03-11 12:53:13', 0, '2015-03-11 12:53:13', '', '767255'),
(818, 'mexes 0618', 'mexes0618@aliyun.com', 'mexes0618', '$P$D9xbyY3CM8KslX3WseYf0FmgRcdEKK/', NULL, 'Mr', 'XI', '', 'Xie', 'Jalan Kajeng', '', '', '', '82144091553', 1, '0000-00-00 00:00:00', '', '2015-03-12 10:06:15', 0, '2015-03-12 10:06:15', '', '315535'),
(819, 'Anna', 'dajana.asia@gmail.com', 'dajana.asia', '$P$D..QIV9aD6zm6Z3poMAEUTHjVxbu4I0', NULL, 'Ms', 'Anna', '', 'Prima', 'Penestanan Padi''s home stay', '', '', 'behind Bintang Supermarket', '81210649582', 1, '0000-00-00 00:00:00', '', '2015-03-16 11:03:56', 90, '2015-06-21 04:05:28', '', ''),
(820, 'ABENE USABIAGA', 'abeneusabiaga@gmail.com', 'ABENE USABIAGA', '$P$DgBawvpbC5TzKK46HmIyJWquJhxujH.', NULL, 'Ms', 'ABENE', 'USABIAGA', 'ZABALETA', 'JALAN SUKMA 70, UBUD', '', '', 'THE HOMESTAY IS SITUATED IN THE CORNER BETWEEN JALAN SUKMA AND JATAYU. YOU SHOULD ASK FOR SPANISH GIRLS (WE LIVE IN THE BACK OF THE HOMESTAY)', '81238099831', 1, '0000-00-00 00:00:00', '', '2015-03-17 13:56:46', 0, '2015-03-17 13:56:46', '', '907603'),
(821, 'Julie', 'juliemeermohr@gmail.com', 'julietaman', '$P$DOlSutExMjG.8UZXrkrVMRg3HrsIVT0', NULL, 'Ms', 'julie', '', 'van der meer mohr', 'jalan sri wedari', '', '', '200 m after warung jepun there is a small alley on the left side (gang way). last house in the alley.', '81236488487', 1, '0000-00-00 00:00:00', '', '2015-03-20 03:21:20', 100, '2015-06-21 06:32:15', '', ''),
(822, 'mcook4', 'matt@matthewdavidcook.com', 'mcook4', '$P$Djf1S0AnJgw3GLXFNB8rHrQYGa204U.', NULL, 'Mr', 'Matthew', '', 'Cook', 'Jalan Ambarwati', 'Lod Tunduh', '', 'Makananya bisa di-pick up dari perempatan di Lod Tunduh (Jl Raya Lod Tunduh dan Jl Ambarwati)', '82214562497', 1, '0000-00-00 00:00:00', '', '2015-03-20 08:11:37', 0, '2015-03-20 08:11:37', '', '334126'),
(823, 'William', 'wdimac@gmail.com', 'wdimac', '$P$D0.406RIQb6Dh/T2V5ci0rc/mZOad..', NULL, 'Mr', 'William', '', 'Dimaculangan', 'Gang Kupu Kupu #5', 'Jln Nyuh Bojog, Nyuh Kuning', '', '', '0821 4437 3905', 1, '0000-00-00 00:00:00', '', '2015-03-24 08:46:21', 109, '2015-06-21 06:41:28', '', ''),
(824, 'JohnRobert', 'electronicweather@me.com', 'JohnRobert', '$P$Dn2VGocjNanwwA/QrSUfQ9LMNFcypI/', NULL, 'Mr', 'John', 'R', 'Halstead', '1 Taman', 'Jln Sri wedari', '', '', '+6281239946101‬', 1, '0000-00-00 00:00:00', '', '2015-03-24 09:29:03', 99, '2015-06-21 06:31:37', '', ''),
(825, 'Tom', 'tom_mac121@hotmail.com', 'tomtomtom', '$P$DWhjKRyNFymfVJrfnMTvCcECAkOzwA.', NULL, 'Mr', 'Tom', '', 'McArdle', 'Penestanan Kelod', '', '', 'Opposite side of road of the volleyball court and temple.', '82247479621', 1, '0000-00-00 00:00:00', '', '2015-03-24 11:52:36', 0, '2015-03-24 11:52:36', '', '453345'),
(826, 'Dina', 'primasy@yandex.ru', 'dina_lun', '$P$DXFQpwv.z8cY0VUh7nALT496WRZcjE0', NULL, 'Mrs', 'Dina', '', 'Popova', 'Jln Raya Penestanan Kelod', '', '', 'Our private house located near Lily Lane Villas, you just should stop at the parking and call us,  we''ll came in 5 min.', '0812 3894 6169', 1, '0000-00-00 00:00:00', '', '2015-03-26 11:58:36', 0, '2015-03-26 11:58:36', '', '943096'),
(827, 'Francesca', 'francescamontanar@libero.it', 'francesca', '$P$DbIjVX2saVEtHvnO5igiCT.riMrcof1', NULL, 'Ms', 'Francesca', '', 'Montanar', 'Banjar Penestanan Kaja, Sayan', '', '', 'the house is located next to Aloha House; where you can find a Batik Centre', '81999458222', 1, '0000-00-00 00:00:00', '', '2015-03-26 12:06:08', 0, '2015-03-26 12:06:08', '', '41198'),
(828, 'Jerry Pavia', 'plantshooter@hotmail.com', 'plantshooter', '$P$D4pqix2ILBaQm7Bq8fd9gG2SiZ1Qdv0', NULL, 'Mr', 'Jerry', '', 'Pavia', 'Thouse Klod', '', '', '', '81934372617', 1, '0000-00-00 00:00:00', '', '2015-03-28 07:17:31', 0, '2015-03-28 07:17:31', '', '2118'),
(829, 'Coco', 'withoutmouth@gmail.com', 'coco_juice', '$P$DhsvGlBfn5f51tkng7XT/hhJS2fGK11', NULL, 'Mrs', 'Dina', '', 'Popova', 'Jl. Raya Penestanan Kelod', '', '', 'Our private house located near Lily Lane Villas, you just should stop at the parking and call, we came in 5 min. Or if you know Awan''s House it''s 3 house from the right hand.', '0821 4470 1406', 1, '0000-00-00 00:00:00', '', '2015-04-01 13:10:04', 0, '2015-04-01 13:10:04', '', '348691'),
(830, 'sofia', 'sofia.zgraggen@gmail.com', 'sofia', '$P$DSrT.AyBLP/esynOg4p/ooL.nK0Jr3.', NULL, 'Ms', 'sofia', '', 'zgraggen', 'jl.sugriwa no.59', '', '', '', '81237761315', 1, '0000-00-00 00:00:00', '', '2015-04-02 11:59:18', 0, '2015-04-02 11:59:18', '', '899059'),
(831, 'Serg', 'kozachenkos@gmail.com', 'serg123', '$P$DTGEnHTAzpPZ3AmA.ZAikVJhl07HOe/', NULL, 'Mr', 'Sergey', '', 'Kozachenko', ' Bumi Sehat , Ubud, Jl. Nyuh Kuning', '', '', '', '0813-374-15731', 1, '0000-00-00 00:00:00', '', '2015-04-04 11:48:54', 0, '2015-04-04 11:48:54', '', '579356'),
(832, 'Oliver', 'burstingthrough@gmail.com', 'oliveroliver', '$P$DeJ.xr3Uj9yFsWMkC5Xn2nC5eB0SrB.', NULL, 'Ms', 'Debra', '', 'Oliver', 'Rumah ''Kamboja'' di Adi Santia Bungalows', 'Raya Pengosekan', '', 'Adi Santia ada di belakang ''Ubud Wellness Spa'' (di depan Warung Enak). Rumah namanya ''Kamboja''.', '82237087803', 1, '0000-00-00 00:00:00', '', '2015-04-04 12:00:39', 0, '2015-04-04 12:00:39', '', '595428'),
(833, 'Emily', 'emilylester@gmail.com', 'emilylester', '$P$DYCkmkBFjJutglDoL3gT/QzcUzXfNR0', NULL, 'Ms', 'Emily', '', 'Lester', 'T house kaja lodtunduh', '', '', '', '89614406061', 1, '0000-00-00 00:00:00', '', '2015-04-05 05:41:21', 0, '2015-04-05 05:41:21', '', '995981'),
(834, 'James', 'james@javanomad.com', 'james', '$P$DJysm3X5tSdBZHLKLLJO8zqVzphidt0', NULL, 'Mr', 'James', '', 'Allen', 'Coco Balibali #6', 'Jl. Raya Andong', '', '', '81353330266', 1, '0000-00-00 00:00:00', '', '2015-04-05 08:26:37', 0, '2015-04-05 08:26:37', '', '430984'),
(835, 'Meg Mac', 'ubudmeg@gmail.com', 'megabeast', '$P$DVbBpNCgX.n/F286NbtSRYPzHk9.f81', NULL, 'Ms', 'Meg', '', 'Mac', 'Banjar Kumbuh -- Megan''s House (wooden house)', '', '', 'Take RIGHT path to the wooden house (not the Big House)', '82144086093', 1, '0000-00-00 00:00:00', '', '2015-04-05 10:07:37', 0, '2015-04-05 10:07:37', '', '751654'),
(836, 'diah', 'disasayaka@gmail.com', 'diah', '$P$D5lv.efCyCF9mNsryFYMe2UvOyEfeA.', NULL, 'Mrs', 'diah', 'suci', 'hapsari', 'villa sayan no 3 banjar tegal bingin mas', '', '', '', '82247071860', 1, '0000-00-00 00:00:00', '', '2015-04-05 11:08:30', 0, '2015-04-05 11:08:30', '', '803596'),
(837, 'Julia', 'juliahird84@gmail.com', 'Juliahird', '$P$DcGsXOsTnENiJYTzxu0IIql2WhLjOy0', NULL, 'Ms', 'Julia', '', 'Hird', 'Br Katiklantang', '', '', 'If you get lost, call Agung on 087861300535 he can give you directions to the villa. Thank you! it is on the same street at the restaurant Alchemy, about 2km from here.', '81338311640', 1, '0000-00-00 00:00:00', '', '2015-04-11 11:17:43', 0, '2015-04-11 11:17:43', '', '177674'),
(838, 'Andrew', 'volz.andrew@gmail.com', 'andyv75', '$P$DZBvuTIyYLlQG9G/nCUyCz1QPdHUld.', NULL, '', 'Andrew', '', 'Volz', 'Jalan Raya Sanggingan,  Indon…', '80361 Ubud,', '', '', '82144883793', 1, '0000-00-00 00:00:00', '', '2015-04-12 09:28:26', 0, '2015-04-12 09:28:26', '', '355225'),
(839, 'debbie h', '941deb@gmail.com', 'debbie h', '$P$DofdyVSVx7VruSvtNlp8CPn6XGjG0r/', NULL, '', 'debbie', '', 'hudzik', 'bali putra villa #4', '', '', '', '82247149391', 1, '0000-00-00 00:00:00', '', '2015-04-14 10:52:06', 0, '2015-04-14 10:52:06', '', '358107'),
(840, 'Gabrieller', 'Richard.gabrielle@gmail.com', 'Gabrieller', '$P$DaQiq8d.8TN.igHmTBKlCQZ8s6FV271', NULL, 'Ms', 'Gabrielle', '', 'Richard', 'Kajeng street no 10', '', '', 'In front of Padma accomodation on Kajeng street.   My room is 4 at the back of the garden.', '82340076421', 1, '0000-00-00 00:00:00', '', '2015-04-14 11:11:49', 0, '2015-04-14 11:11:49', '', '107897'),
(841, 'clem', 'clementine.ferretjans@gmail.com', 'clementine.ferretjans@gma', '$P$D59RrbbSM.6AwFQo7w7yoYPwDIE6p10', NULL, 'Ms', 'Clementine', '', 'Ferretjans', 'Jl Monkey Forrest', '', '', 'Down the path next to Cinta Grill', '82144700249', 1, '0000-00-00 00:00:00', '', '2015-04-14 11:33:45', 0, '2015-04-14 11:33:45', '', '558107'),
(842, 'Carly', 'Carly.mayou@gmail.com', 'cmayou', '$P$DavYQmuEVPEVmASgP5yemonynu676j0', NULL, 'Ms', 'Carly', '', 'Mayou', 'Jl. Kajeng No. 29', '', '', '', '81238809328', 1, '0000-00-00 00:00:00', '', '2015-04-16 10:59:40', 0, '2015-04-17 05:25:05', '', ''),
(843, 'tom church', 'tlchurch1@gmail.com', 'tlchurch1', '$P$DcGTEhBAjw6uNWp2YScCe0yn.hBgtJ1', NULL, 'Mr', 'Tom', '', 'Church', 'Jl. Raya Andong, Petulu', '', '', '', '82144843088', 1, '0000-00-00 00:00:00', '', '2015-04-17 12:50:34', 0, '2015-04-17 12:50:34', '', '729333'),
(844, 'Desiree', 'willedesiree@gmail.com', 'desireewille', '$P$DnRNA.Cb2GQbzJp857FCebeXeuzTaq.', NULL, 'Mrs', 'Desiree', '', 'Wille', 'Jalan Jembawan 70', '', '', 'Jalan Jembawan is a street next to Hannoman street. Belos house is next to Warsa homestay.', '82147949218', 1, '0000-00-00 00:00:00', '', '2015-04-25 14:25:10', 0, '2015-04-25 14:25:10', '', '5959'),
(845, 'Sally', 'theemeralddream@hotmail.com', 'Sally Halstead', '$P$Dn8blcG2ZdjiEYIQoxQA0Gf0WtKhxL1', NULL, 'Ms', 'Sally', '', 'Halstead', 'Jalan Batu Kurung, No 106', 'Bunutan', '', 'Ibu Sally yang dekat Royal Pita Maha', '8123858292', 1, '0000-00-00 00:00:00', '', '2015-04-26 07:27:57', 0, '2015-04-26 07:27:57', '', '124909'),
(846, 'Cok yana', 'Julyanadewi@rocketmail.com', 'Cok yana', '$P$Dp2LcAfMjQbGfZ3.yZ6w24dXREE.Hv0', NULL, 'Mrs', 'Cok', 'Yana', 'Dewi', 'Jln. Raya campuhan. (Puri Anyar Campuhan)', '', '', 'Setelah hotel tjampuhan, di depan badra gallery.', '81294044795', 1, '0000-00-00 00:00:00', '', '2015-04-27 06:07:39', 0, '2015-04-27 06:07:39', '', '321037'),
(847, 'paulking', 'paulking76@gmail.com', 'paulking', '$P$DAxktnHO3/91GyCqckpnk9D92zaoRe0', NULL, 'Mr', 'Paul', '', 'King', 'jalan tirta tawar no 11', 'kutuh', '', 'Just past the sushi place , opposite the shop with the gates.', '82144971347', 1, '0000-00-00 00:00:00', '', '2015-04-27 10:30:36', 0, '2015-04-27 10:30:36', '', '413646'),
(848, 'pollilop', 'pollilop@rambler.ru', 'pollilop', '$P$Dz1iIijkUaNOUAu885TpojNrzjzlU7/', NULL, '', 'Taras', '', 'Havrylyukh', 'Hubud', '', '', '', '81236709126', 1, '0000-00-00 00:00:00', '', '2015-04-30 10:02:31', 0, '2015-04-30 10:02:31', '', '535857'),
(849, 'Brigitte', 'bri_joo@yahoo.fr', 'brigitte', '$P$D/Uxe8Fajmx0DQzyaNyoMWRSreGnOd.', NULL, 'Mrs', 'Brigitte', 'Ghislaine', 'Jooken', 'Uma Soca (depan Kubu Soca)', 'Br Kalah, Peliatan', '', 'balinese house on the corner (not villa Uma Soca), depan Kubu Soca', '81236751138', 1, '0000-00-00 00:00:00', '', '2015-05-05 09:23:34', 0, '2015-05-05 09:23:34', '', '260502'),
(850, 'Sam', 'hungsamuel@hotmail.com', 'hungsamuel', '$P$DB0/rlpKgDqOf24J09rrDCvIxJlp.b0', NULL, 'Mr', 'Samuel', '', 'Hung', 'Jl. Tirta Tawar', '', '', 'Our villa is on the right side of the road, after Aneh Aneh, and right after White Villa.', '82147781121', 1, '0000-00-00 00:00:00', '', '2015-05-10 08:35:54', 116, '2015-09-24 10:07:38', '', ''),
(851, 'Egle', 'egleinfo@yahoo.co.uk', 'Egle', '$P$D3UhfZWsOG7DXUF1/KIVVzOREILgCs1', NULL, 'Ms', 'Egle', '', 'Raulickyte', 'No 8 Padang Tegal Kaje', '80571', '', '', '0878 62228297', 1, '0000-00-00 00:00:00', '', '2015-05-10 10:50:57', 0, '2015-05-10 10:50:57', '', '750935'),
(852, 'I Wayan Rismawan', 'rismawan2501@gmail.com', 'Rismawan', '$P$Dom3cUyl1kjyuk1sTm/9cTZJ6yD4LP.', NULL, 'Mr', 'Rismawan', 'wayan', 'Nyoman Rawa', 'teges kawan, peliatan', '', '', 'Barat pertigaan mas-goa gajah, gg keselatan rumag no 21, blakang toko bunga', '82247037354', 1, '0000-00-00 00:00:00', '', '2015-05-10 11:07:37', 0, '2015-05-11 01:03:30', '', ''),
(853, 'Liza', 'lizazwijnenberg@hotmail.nl', 'Liza.Zwijn', '$P$DLlklhbDBlzxYScZY6TfIx1JbApxGW.', NULL, 'Mrs', 'Liza', '', 'Zwijnenberg', 'Jalan Jembawan 70', '', '', 'Belos house, is close by the Hannoman street.  And at the same place as Warsa house', '87762584259', 1, '0000-00-00 00:00:00', '', '2015-05-13 10:52:57', 0, '2015-05-13 10:52:57', '', '998759'),
(854, 'Pieter-Jan', 'waysofbeing@gmail.com', 'pjv', '$P$Dxts7grJ91y7cdEoR1EcCS3RsDvXfs.', NULL, 'Mr', 'Pieter-Jan', '', 'Vandormael', 'Jl. Jatayu', '', '', 'Please deliver around 20:30.', '81213382262', 1, '0000-00-00 00:00:00', '', '2015-05-15 11:35:35', 0, '2015-05-15 11:35:35', '', '773523'),
(855, 'Dan', 'dapa767@hotmail.com', 'dapa767', '$P$DwsqNqPeUtuUaWNKiVwByrakP5jRuy1', NULL, 'Mr', 'Daniel', '', 'Davies', 'JALAN SRIWEDARI NO.8', '', '', '', '81237301810', 1, '0000-00-00 00:00:00', '', '2015-05-20 11:46:40', 0, '2015-05-20 11:46:40', '', '2746'),
(856, 'Yasmin Muridan', 'lihat.daku@gmail.com', 'yasmin', '$P$Djba9JDxWZI10Xz/2DF9MHrb07Ur8u0', NULL, 'Ms', 'Yasminida', 'Purwati', 'Muridan', 'Jalan Sukma #5', '', '', 'The same alley with DESAK PUTU PUTERA HIDDEN, ENTER THE GATE AND OUR HOUSE IS THE FIRST DOOR ON THE RIGHT.', '81237349205', 1, '0000-00-00 00:00:00', '', '2015-05-21 12:33:20', 0, '2015-05-21 12:33:20', '', '392594'),
(857, 'delaneyvb', 'delaneyvb@hotmail.com', 'delaneyvb@Hotmail.com', '$P$DELBJCD5xNAAnGAYr5QDyBycMJKuvl0', NULL, 'Ms', 'Delaney', '', 'Van Baalen', ' Jl. Nusa Indah - Mas', 'Mas', '', 'google map\nhttp://goo.gl/maps/BfehL\n\nOpposite Pura Telaga Waja \n\n5th villa', '0822 3744 2320', 1, '0000-00-00 00:00:00', '', '2015-05-23 09:34:31', 112, '2015-09-24 09:57:59', '', ''),
(858, 'tanaym', 'mail@tanaymishra.com', 'tanaym', '$P$DXHL.QNkwkeCPjMNgQgOKf7xIGZnqY/', NULL, 'Mr', 'Tanay', '', 'Mishra', 'Room #2, Asiti Salon and Spa', ' 58 Hanoman Street, Ubud, Bali 80571, Indonesia', '', 'Very close to Coco Supermarket', '81237408607', 1, '0000-00-00 00:00:00', '', '2015-05-30 11:33:33', 0, '2015-05-30 11:33:33', '', '316383'),
(859, 'Karina Tenija', 'karina.tenija@hotmail.com', 'Karinatenija', '$P$DZJ.bEnB5RtSxklKWIzzJizYwyfhjO0', NULL, 'Ms', 'Karina', '', 'Tenija', 'Warung Uma Sari, jalan campuhan 3, singa kerta', '', '', 'Sebelah Galeri Sinteg', '81294100901', 1, '0000-00-00 00:00:00', '', '2015-06-06 11:25:39', 113, '2015-09-24 09:58:48', '', ''),
(860, 'Craig doc', 'Craig_docherty@fusionsafetymgt.com', 'Craig doc', '$P$DeJThXxCP/ySJyVkHptvIsIN9n79rb0', NULL, 'Mr', 'Craig', '', 'Docherty', 'Penistanan', '', '', '', '82247037368', 1, '0000-00-00 00:00:00', '', '2015-06-07 09:14:12', 89, '2015-06-21 04:04:30', '', ''),
(861, 'kelsey', 'kelseygenna@hotmail.com', 'kelseygenna', '$P$DTE.glM/A5v8lwjmNihqneWkNMum5s/', NULL, 'Ms', 'Kelsey', '', 'Genna', 'Pengoskan Road, Lodtunduh', '', '', 'T house KLOD not Kaja', '82247976055', 1, '0000-00-00 00:00:00', '', '2015-06-07 11:59:45', 0, '2015-06-07 11:59:45', '', '607457'),
(862, 'Alon', 'alonzehavi@gmail.com', 'alon', '$P$DPFszndOaR.Bx0s1GcA0UomT.ECVjg1', NULL, 'Mr', 'Alon', '', 'Zehavi', 'jln tirta tawar behind junjungan hotel', '', '', 'the villa is located on jln tirta tawar behind junjungan hotel', '81237252539', 1, '0000-00-00 00:00:00', '', '2015-06-07 12:26:26', 0, '2015-06-07 12:26:26', '', '18300'),
(863, 'Lukas', 'Lukaslunger@gmail.com', 'Lukas', '$P$DzBVC/5a074atiCE8UL4o5Ve3PE9oF0', NULL, 'Mr', 'Lukas', '', 'Lunger', 'Jalan Raya Sebali, banjar sebali, desa Keliki - Ubud Bali 80571', '', '', 'Room 710', '82134760826', 1, '0000-00-00 00:00:00', '', '2015-06-08 11:23:03', 0, '2015-06-08 11:23:03', '', '801786'),
(864, 'rambow', 'saikarthikreddy@gmail.com', 'rambow', '$P$DmLPBB32ilTalPhFmvzS5S.mPbb0eH1', NULL, 'Mr', 'Sai Karthik', 'Reddy', 'Mekala', 'jalan raya penestanan', '', '', '', '81236101943', 1, '0000-00-00 00:00:00', '', '2015-06-11 06:31:49', 115, '2015-09-24 10:06:13', '', ''),
(865, 'Adi', 'adrian.rueedi@gmail.com', 'adislittlecity', '$P$DDd/lqx18J52ztG.ZYNk6wIWu8buYX.', NULL, 'Mr', 'adrian', '', 'Rüedi', 'Jalan Hanoman Behind Banjar Padangtegal', '', '', '', '81337803078', 1, '0000-00-00 00:00:00', '', '2015-06-11 13:11:12', 0, '2015-06-11 13:11:12', '', '811579'),
(866, 'Lesley', 'lesley@renascentcollege.com', 'lesleymitchell', '$P$DFTbGgADmICE7NXC8oaC7hmnWP.OMQ1', NULL, 'Mrs', 'Lesley', '', 'Mitchell', 'Villa #1, Nth Entrance (NAYA Sign) Living Light Bali', 'Jl. Raya Sayan No.53, Ubud, Kab.', '', 'Enter via North entrance near NAYA sign, our rear entry door is towards the motorbike parking, knock on back door', '0821 4708 2289', 1, '0000-00-00 00:00:00', '', '2015-06-13 10:34:10', 0, '2015-06-13 10:34:10', '', '437230'),
(867, 'nofan', 'nofanpro.alghifari@gmail.com', 'nofan', '$P$DUw9ZJVbkCA1RQMlC1kH2NgTnHPvKN0', NULL, 'Mr', 'Nofan', '', 'firmansyah', 'Jl. Raya Pengosekan', '', '', 'Kopernik\nJl. Raya Pengosekan, Ubud\nin front of Kupo mart', '83831089715', 1, '0000-00-00 00:00:00', '', '2015-06-14 08:34:25', 0, '2015-06-14 08:34:25', '', '433837'),
(868, 'Ryu', 'hirakawaryuichi@gmail.com', 'Ryu', '$P$Dy.s7W3lmXmYbWsydQdhnQBPzHXaJe.', NULL, 'Mr', 'Ryuichi', '', 'Hirakawa', 'Jl.Tilta Tawar', '', '', 'North of ex Botanical Garden,across Hotel Sugar''s Villa,next of White Villa,a Villa with  a boo fence.', '81238246402', 1, '0000-00-00 00:00:00', '', '2015-06-15 10:59:58', 0, '2015-06-15 10:59:58', '', '699981'),
(869, 'rajarshi', 'raj.metallicarulez@gmail.com', 'rajarshi', '$P$DBra5gktKP52tlGfEoCkKeN.ZYcnxy0', NULL, 'Mr', 'Rajarshi', '', 'Mitra', 'Villa Debana, Jl Tirta Tawar', 'Near Made Becik Warung', '', 'Here is exact address on Google Maps:http://goo.gl/maps/ld8Xi\n\nHow to reach: take left from road just ahead of Made Becik, go down the slope, and follow road straight to Debana Villa', '81237184026', 1, '0000-00-00 00:00:00', '', '2015-06-16 11:25:04', 0, '2015-06-16 11:25:04', '', '366563'),
(870, 'Sanghun kim', 'kksshh@gmail.com', 'Sanghun kim', '$P$DWMpbbwtns9dkGD6/eNEvfJmFrv2rI/', NULL, '', 'Sang hun', '', 'Kim', 'Green field', '202', '', '', '82240759079', 1, '0000-00-00 00:00:00', '', '2015-06-17 10:41:55', 0, '2015-06-17 10:41:55', '', '513252'),
(871, 'Michaela', 'michaela.safirova@gmail.com', 'misarisa', '$P$DK.4wqdsVgDuksz3SzpMFbeTkvAEGv0', NULL, '', 'Michaela', '', 'S', 'Jalan Cok Gede Rai, Br. Ambengan, Peliatan, Ubud, BA 80571', '', '', 'Please let us know once you are before Tagel Karsa by phone. We will come to the entrance. Thank you', '81353055138', 1, '0000-00-00 00:00:00', '', '2015-06-18 12:53:07', 0, '2015-06-18 12:53:07', '', '594389'),
(872, 'Bobi', 'Bobi.morris@gmail.com', 'Bobimorris', '$P$DbDo5ZSifnGoJI/gq1udjg7i6OeE.g/', NULL, '', 'Bobi', '', 'Morris', 'Japan Rays sanggingan', '', '', '', '87776632069', 1, '0000-00-00 00:00:00', '', '2015-06-19 11:47:05', 0, '2015-06-19 11:47:05', '', '673685'),
(873, 'Tjok Gde', 'tjok.g.d.p.sukawati@gmail.com', 'Fliko16', '$P$DV6IGNlF67Gk8aKTxO//PtG/5VJRMq/', NULL, '', 'Tjok Gde', '', 'D. P. Sukawati', 'Puri Kumara Sakti, Jalan Sweta', '', '', '+-50 metres from the Sambahan Bridges on the left side if you are from the South.', '8113880333', 1, '0000-00-00 00:00:00', '', '2015-06-20 07:47:59', 0, '2015-06-20 07:47:59', '', '264071'),
(874, 'nick', 'lorie.smith@flightcentre.com.au', 'nick32', '$P$DHBKF4IBTo1PSHtyOsJkljux5uhSkT1', NULL, 'Mr', 'Nick', '', 'Wilson', 'Jalan Sriwedari No.8', '', '', 'please deliver to villa', '811393841', 1, '0000-00-00 00:00:00', '', '2015-06-20 10:41:57', 0, '2015-06-20 10:41:57', '', '92078'),
(875, 'Veronique', 'veronique-boyer@hotmail.com', 'Veronique', '$P$D05FJ6V.7JLbbbY.ELUdpITlqoajc20', NULL, 'Mrs', 'coky', 'col', 'brooke', 'nyuh kuning', '', '', 'balibbu hostel ,jln nyuh kuning', '85338179871', 1, '0000-00-00 00:00:00', '', '2015-06-22 06:37:59', 0, '2015-06-22 06:37:59', '', '632776'),
(876, 'Aditya Nagpal', 'aditya.nagpal@gmail.com', 'nagpal', '$P$D5jOqAa92FQiktULLN1tJOAqwvXPqT1', NULL, 'Mr', 'Aditya', '', 'Nagpal', 'Villa 407, Kamandalu Ubud', '', '', '', '81246365096', 1, '0000-00-00 00:00:00', '', '2015-06-22 07:55:25', 0, '2015-06-22 07:55:25', '', '531524'),
(877, 'arthurrjw', 'arthur@worsley.co', 'arthurrjw', '$P$DRPcH.jaQ17h26fnABbKGQRyjFm7FI/', NULL, 'Mr', 'Arthur', '', 'Worsley', 'Bayu Guest House', 'Lane Mandia Bungalow No.3, 80571', '', '', '81239014190', 1, '0000-00-00 00:00:00', '', '2015-06-23 09:44:39', 0, '2015-06-23 09:44:39', '', '938505'),
(878, 'Williambelong', 'Williamjohnsouter@hotmail.co.uk', 'Williambelong', '$P$Da1HBlT9GsZMCFjJbjMuu4mtKLInj.1', NULL, 'Mr', 'William', '', 'Souter', 'Jl. Cocoa II no. 80, Banjar Bunutan Kedewatan, Ubud, Gianyar Bal', '', '', '', '82247036311', 1, '0000-00-00 00:00:00', '', '2015-06-28 04:21:12', 0, '2015-06-28 04:21:12', '', '199582'),
(879, 'maggie', 'maggiekanggoro@gmail.com', 'maggiekanggoro', '$P$DKJU7dsQzxBEqf4db8CeBS9nTqrga4/', NULL, 'Ms', 'maggie', '', 'kanggoro', 'jalan raya sanggingan no 88', '', '', 'Rumah di atas knit butik. Di depan rumah ada billbord wastra butik. Rumah di lantai 2, masuk dari samping knit butik.', '81238286399', 1, '0000-00-00 00:00:00', '', '2015-06-28 13:45:32', 0, '2015-06-28 13:45:32', '', '31937'),
(880, 'mpatera', 'mpatera9449@gmail.com', 'melissaconnelly', '$P$DtvSKGm6MYCF4RoZPjMqEd5M5PGsjE0', NULL, 'Mrs', 'Melissa', '', 'Connelly', 'Br. Penestanan Kelod', '', '', 'We are in the 3Rd private villa on the left. You can call the number and we can meet at the front.', '81246861954', 1, '0000-00-00 00:00:00', '', '2015-07-02 09:20:37', 0, '2015-07-06 00:57:23', '', ''),
(881, 'arianeho', 'ariane-h@live.fr', 'arianeho', '$P$DWOdZ1GTkBCAqH1JpWYFk4yUiXtAxN0', NULL, 'Ms', 'Ariane', '', 'Hochet', 'Jalan Goutama No 14 Padangtegal', '', '', 'When entering in Goutama Homestay, climb the first stairs on your left, until the second floor :\nRoom number 11', '8563821239', 1, '0000-00-00 00:00:00', '', '2015-07-07 11:50:54', 0, '2015-07-07 11:50:54', '', '623441'),
(882, 'caroline', 'carolinqua@gmail.com', 'linka', '$P$DLhSEeaBLe.o8lh9YFlwd1HizqFgVd0', NULL, 'Mrs', 'Caroline', '', 'King', 'Pondok Selamat', 'Penestanan', '', 'https://www.google.co.id/maps/place/8%C2%B030%2739.7%22S+115%C2%B015%2706.9%22E/@-8.5110276,115.2519167,15z/data=!3m1!4b1!4m2!3m1!1s0x0:0x0?hl=enizza%20ubud\n\nTurn in the Round Bar in Penestanan .. go through the car park and down the path... go past Bali Dream Cafe.. keep going all the way to the end.. it is the last Villa before the rice fields. PONDOK SELAMAT', '81237307317', 1, '0000-00-00 00:00:00', '', '2015-07-09 09:28:53', 0, '2015-07-09 09:28:53', '', '935597'),
(883, 'Refky reza', 'Refkyreza@gmail.com', 'Refkyreza', '$P$DTOyphTr6kM0AbAzcS/ntJG20ytuJA.', NULL, 'Mr', 'Refky', '', 'Reza', 'Jl.goutama samping skin salon', '', '', '', '82213149272', 1, '0000-00-00 00:00:00', '', '2015-07-09 10:12:52', 0, '2015-07-09 10:12:52', '', '971227'),
(884, 'Neo Ishida', 'pissyouguysoff@yahoo.co.jp', 'Nishida', '$P$DRIZHZi6lMeqWzshNbHNywK0biT1hg.', NULL, 'Mr', 'Naoto', '', 'Ishida', 'Jalan raya nyuh kuning', '', '', '', '85854187037', 1, '0000-00-00 00:00:00', '', '2015-07-10 08:00:56', 0, '2015-07-10 08:00:56', '', '280377'),
(885, 'dwi', 'dwiitrismayantii@gmail.com', 'Dwii', '$P$D.L2BtRSW2bYW.CBJcOLpf6MSoijBb.', NULL, 'Mrs', 'Dwii', 'Trisma', 'yanti', 'br. piakan sibangkaja', 'br piakan sibangkaja', '', 'Br. Pengosekan ubud', '85737117359', 1, '0000-00-00 00:00:00', '', '2015-07-19 06:19:43', 0, '2015-07-19 06:19:43', '', '596191'),
(886, 'Glenn Sims', 'glenn.sims@fremantlemedia.com', 'redflamenz', '$P$Ds9otFh9B.I2MjxXqRLfPX2Y1VVCjz/', NULL, 'Mr', 'Glenn', '', 'Sims', 'Jl Tirta Tawa No 47', 'Kutu Kaja', '', 'My house is at the rear of the kampung at No 47.  47 is in the next block of houses on the left side of the road after Sari Jahe.    No 47 has a small sign outside.  Down the path there is a small local house, then a new house and at the end of the path another house before the river.  Mine is the last house.    Drivers have delivered here before.', '81510381193', 1, '0000-00-00 00:00:00', '', '2015-07-19 12:48:48', 0, '2015-07-19 12:48:48', '', '359616'),
(887, 'Lynne', 'lynsti@yahoo.com', 'skyhunt2015', '$P$D3uQDmUYvyEE.O82CI/sPvYdoJ2NI31', NULL, 'Mrs', 'Lynne', '', 'Stiegler', 'Jalan Penestanan Kelod', 'Room 4', '', 'Go to the back of the parking lot and call mobile - we will come down and get food', '0813-3887-7401', 1, '0000-00-00 00:00:00', '', '2015-07-21 09:51:11', 0, '2015-07-21 09:51:11', '', '35945'),
(888, 'dodomymyari', 'dorotheecasalin@hotmail.fr', 'dodo', '$P$DlwzLJ/q1hDvuZ48N2RTp1cZ9/Lycm.', NULL, 'Mrs', 'dorothee', 'dodo', 'casalin', 'Monkey forest street', 'beiji lane', '', '', '81246578903', 1, '0000-00-00 00:00:00', '', '2015-07-21 12:18:22', 0, '2015-07-21 12:18:22', '', '528698'),
(889, 'Ulrika', 'ulren45@gmail.com', 'cellmonster', '$P$DXFVI/3gKPSqnY2o9or2/pAY7gvcLd.', NULL, 'Ms', 'Ulrika', '', 'Englund', 'Jalan Jembawan', '70', '', 'Alley in the corner where Jalan Jembawan turns left and continues up to the post office', '85737392982', 1, '0000-00-00 00:00:00', '', '2015-07-22 04:18:11', 0, '2015-07-22 04:18:11', '', '973831'),
(890, 'Andy', 'andy.potanin@gmail.com', 'andy.potanin@gmail.com', '$P$DXiXUl5fnzFOr8c5dFePrQAqeEzC360', NULL, 'Mr', 'Andy', '', 'Potanin', 'Jl. Sukma No 6 Br. Tebesaya Peliatan', '', '', '', '81238813065', 1, '0000-00-00 00:00:00', '', '2015-07-22 13:21:59', 0, '2015-07-22 13:21:59', '', '449487'),
(891, 'Rebecca', 'gustiiswandira3@gmail.com', 'Rebecca', '$P$DzvqhFIQciMly4QGUk8hFGNOBK3GLL0', NULL, '', 'Rebecca', '', 'Kingsbury', 'Jl. AA. Gede Rai, Br.Tengah Lodtunduh', '', '', '', '87862050975', 1, '0000-00-00 00:00:00', '', '2015-07-28 11:17:17', 0, '2015-07-28 11:17:17', '', '476481'),
(892, 'lin', 'jiangyou76@gmail.com', 'jiangyou76', '$P$DPb1uUs1vR849zd42llQ3yDWhffAAs.', NULL, 'Ms', 'lin', '', 'wu', 'NO.71,JL.JEMBAWAN,', '', '', 'room number 302', '81353051288', 1, '0000-00-00 00:00:00', '', '2015-07-29 01:30:52', 0, '2015-07-29 01:30:52', '', '17943'),
(893, 'Ariani', 'guillaume.fourreau@hotmail.fr', 'guiri', '$P$DpO/yefeiCzPn.OBNvPaUWO9NuZp7F1', NULL, 'Ms', 'Ariane', '', 'Hochet', 'Jalan Sandat', '', '', '', '8563821239', 1, '0000-00-00 00:00:00', '', '2015-07-30 11:48:42', 0, '2015-07-30 11:48:42', '', '400954'),
(894, 'Anne', 'annelousbekkers@hotmail.com', 'Bekkers', '$P$DZTTEhivd9HCS2xpNIqbmTVVBynpx/.', NULL, 'Ms', 'Anne', '', 'Bekkers', 'jl. pengosekan', '', '', '', '81237307315', 1, '0000-00-00 00:00:00', '', '2015-08-02 09:25:31', 111, '2015-09-24 09:56:16', '', ''),
(895, 'Karen Wilmot', 'karenwilmot@gmail.com', 'karen', '$P$DPCCf.LsoPXO1anX1MJwwSbHSQRRhz0', NULL, 'Ms', 'Karen', '', 'Wilmot', 'T house', 'lodtonduh', '', 'lotonduh - it is the first house on the right (with scooter parked outside)', '81337395167', 1, '0000-00-00 00:00:00', '', '2015-08-06 09:38:42', 0, '2015-08-06 09:38:42', '', '414803'),
(896, 'Kara Harding', 'karaharding@gmail.com', 'karaharding', '$P$DJ4nzFjLjIjbaIzNKPgUZewyqgIdBP1', NULL, 'Mrs', 'Kara', '', 'Harding', 'Jalan Raya Campuhan', '', '', 'Down the laneway next to Office of Jungle Run Production, which is next to Pulau Kelapa on Jalan Raya Campuhan. There are two doors at the end of the laneway, about 50m with sign Villa Mountain View.', '0813-3935-9374', 1, '0000-00-00 00:00:00', '', '2015-08-09 11:04:04', 0, '2015-08-09 11:04:04', '', '562724'),
(897, 'Emilie Sibourg', 'emilie.sibourg@hotmail.com', 'emilie.sibourg', '$P$D4ulLwyzVFqU2m4Of3QcUJIK/I17nC1', NULL, 'Ms', 'Emilie', '', 'Sibourg', 'Jalan Nakula V', 'Nomor 9, Apartement 2A (lantai 1)', '', 'Jalan Nakula, masuk di Jalan Nakula V, nomor 9 Anzen apartements, kamar 2A (lantai 1)', '87861684024', 1, '0000-00-00 00:00:00', '', '2015-08-10 10:18:24', 0, '2015-08-10 10:18:24', '', '866006'),
(898, 'Laure Degui', 'laure@sasuka.com', 'lauredegui', '$P$DovaacHY99BzVIXjZfqBtyl7ujhaWt/', NULL, 'Ms', 'Laure', '', 'degui', 'Penestanan Kaja', '', '', 'Rumah lauren, Penestanan Kaja, dekat Villa Sandat.', '81337188471', 1, '0000-00-00 00:00:00', '', '2015-08-14 02:42:52', 0, '2015-08-14 02:42:52', '', '745177'),
(899, 'Charles Courivaud', 'charles.courivaud@gmail.com', 'charles courivaud', '$P$DVwyIQEl0Yn8qvHEl/6QHrWlpbJqNc/', NULL, 'Mr', 'Charles', '', 'Courivaud', 'JL. Tebesaya No. 29, Ubud, Bali', '', '', '', '81338874576', 1, '0000-00-00 00:00:00', '', '2015-08-15 04:24:49', 0, '2015-08-15 04:24:49', '', '976310'),
(900, 'Ines', 'ines.ben-hamida@iscparis.com', 'Ines_b', '$P$D46kOr60QZKxu/dsKZ2V7gETaDEb110', NULL, 'Mrs', 'Ines', '', 'Ben Hamida', 'Jl tira tawar', '', '', 'Just after om ham hotel.\nVilla #5', '82144851983', 1, '0000-00-00 00:00:00', '', '2015-08-16 04:05:05', 0, '2015-08-16 04:05:05', '', '261739'),
(901, 'Julius', 'juliusmatt1997@googlemail.com', 'juma', '$P$Dl5ho9C40qCFPQD/ucoxarlHL2oveo/', NULL, 'Mr', 'Julius', '', 'Matt', 'Jalan, Penestanan Kaja, Sayan', '', '', 'GEED - House', '81246970229', 1, '0000-00-00 00:00:00', '', '2015-08-17 09:35:26', 0, '2015-08-17 09:35:26', '', '972686'),
(902, 'Mark Williams', 'mwilliams@mscon.com', 'mwilliams', '$P$DncPtod7IMSb0N.g2hk.HPyyzD/Z6T.', NULL, 'Mr', 'Mark', '', 'Williams', 'Monkey Forest Rd.', '', '', '', '81338923991', 1, '0000-00-00 00:00:00', '', '2015-08-17 13:08:00', 0, '2015-08-17 13:08:00', '', '542462'),
(903, 'Philippe Roy', 'roy.ph@videotron.ca', 'tramac87', '$P$D/NjaWlSu6lFnhAErELvXWhCMvOOlA/', NULL, 'Mr', 'Philippe', '', 'Roy', 'Br. Penestanan Kelod, ubud Bali', '', '', '', '82236636176', 1, '0000-00-00 00:00:00', '', '2015-08-21 10:40:35', 114, '2015-09-24 09:59:14', '', ''),
(904, 'Simone', 'simone.schiassi@gmail.com', 'simoschi', '$P$D6P7shxUJFyej62GUNSFHYiKsHSkCk/', NULL, 'Mr', 'Simone', '', 'schiassi', 'Banjar Penestanan Kaja, Ubud, Bali 80571, IndonesiaY', '', '', 'We can meet at the Bintang supermarket if you call 10 minutes before arriving', '81246317027', 1, '0000-00-00 00:00:00', '', '2015-08-22 09:13:38', 0, '2015-08-22 09:13:38', '', '690080'),
(905, 'Karen', 'hikerkaren10@gmail.com', 'hikerkaren', '$P$D/rYvsDPtGxHsxLXBi0JH.7itGTY8L1', NULL, 'Ms', 'Karen', '', 'Landes', 'Jl. Hanoman, Gang Anila No.10', '', '', 'Room #4', '0823 3998 7793', 1, '0000-00-00 00:00:00', '', '2015-08-23 11:19:57', 0, '2015-08-23 11:19:57', '', '414468'),
(906, 'Tom', 'tom_nalis@yahoo.com', 'speedyconnalis', '$P$DlpKfXHGRtfJgjsEGAPf1IsZnO/hAB.', NULL, 'Mr', 'Tom', '', 'Nalis', 'Jln raya Nyuh Kuning, gang Nyuh Pelet no7', '', '', 'Sebelah balai banjar Nyuh Kuning.', '81238197041', 1, '0000-00-00 00:00:00', '', '2015-08-26 12:14:06', 0, '2016-01-15 02:19:18', '', ''),
(907, 'brittneyy', 'btillett1@gmail.com', 'brittneyy', '$P$DpG2Yb0p.nAA9JbDCFIps/LyN4xiHc1', NULL, 'Ms', 'Brittney', '', 'Tillett', 'Jalan Raya Ubud', '', '', 'Angel''s roof is located behind Bintang supermarket.  If you go up the stairs from the ground level towards Penestaan, and walk down the path, it is at the first crossing path right after you pass Bintang, immediately to the left.  There is a sign that says ''Angel''s Roof'' on the fence outside, as well as a street light directly above the door. It is the stairs/pathway you would need to take if you wanted to walk to Yellow Flower Cafe from Bintang - except right behind the supermarket.', '81238301391', 1, '0000-00-00 00:00:00', '', '2015-08-29 11:06:52', 0, '2015-08-29 11:06:52', '', '974973'),
(908, 'Jamie Chan', 'c_chiamin@yahoo.com', 'jamieccm', '$P$DgknFybBikkl4h5ADxYZMknVgQi7UI0', NULL, 'Ms', 'Jamie', '', 'Chan', 'Banjar Katiklantang. Desa singekerta', '', '', 'Room Pacah', '81246739528', 1, '0000-00-00 00:00:00', '', '2015-08-29 11:20:37', 0, '2015-08-29 11:20:37', '', '592216'),
(909, 'Allan Fein', 'iamhikeral@yahoo.com', 'hikeral', '$P$DoHhQ31XJcs6oldT2eDZvsmzYbhiVF1', NULL, 'Mr', 'Allan', '', 'Fein', 'Jl. Tirta Tawar', '', '', 'We are in jungjungan before delta''s villa.\nAcross from new building project. The third gated entrance. If call, we can meet outside.\nGoogle map location: 8°29''00.5"S 115°16''16.8"E', '82339987793', 1, '0000-00-00 00:00:00', '', '2015-08-30 10:03:46', 0, '2015-08-30 10:03:46', '', '481684'),
(910, 'Mila S', 'milashwaiko@hotmail.com', 'Mila S', '$P$DKan92Qi8A1BzgcsPwMWLxmvv0Dt4s.', NULL, 'Ms', 'Mila', '', 'Shwaiko', 'Jl Suweta No 8', '', '', '', '81337021825', 1, '0000-00-00 00:00:00', '', '2015-08-31 10:18:59', 0, '2015-08-31 10:18:59', '', '785957'),
(911, 'elliecowlam', 'elliecowlam_x@hotmail.co.uk', 'elliec', '$P$DG4kUa3G8NUHRG3e3xtzX5nuVXrR1z/', NULL, 'Mrs', 'ellie', '', 'cowlam', 'ji. tirta tawat br', 'kutuh kaja', '', 'the hotel driveway is easily missed', '87860354441', 1, '0000-00-00 00:00:00', '', '2015-08-31 13:18:10', 0, '2015-08-31 13:18:10', '', '53947'),
(912, 'Ayuk', 'widhiayu17@ymail.com', 'ayuk', '$P$D9A47xG0aXxDMf7FXESQgAOLYrd9Cp0', NULL, 'Ms', 'putu', 'ayu', 'widhiasih', 'br penestanan kelod', '', '', 'Vila biyu siyu,belakang restauran sri ratih', '8563808275', 1, '0000-00-00 00:00:00', '', '2015-09-02 03:24:26', 0, '2015-09-02 03:24:26', '', '629912'),
(913, 'Charlotte Kelly', 'Charlotteekelly@me.com', 'Charlottekelly', '$P$DZqygyd9tBua0ApHeYUc6lWtjo2Hhx.', NULL, 'Ms', 'Charlotte', '', 'Kelly', 'Jalan Sandat No 9 Br Taman Kaja', '80571', '', 'Pls call 081215743173 when at gate.', '81215743173', 1, '0000-00-00 00:00:00', '', '2015-09-03 12:50:07', 0, '2015-09-03 12:50:07', '', '301727'),
(914, 'EllenBeltman', 'ellenbeltman@live.nl', 'ellenbeltman@live.nl', '$P$Dw/4Oemctv0mkVnvmSIR3V86LF0fHW1', NULL, 'Mrs', 'Ellen', '', 'Beltman', 'Jalan raya andong, Gang Nuri', '', '', 'It''s after Loka Sari in the left side in a small road', '81339360247', 1, '0000-00-00 00:00:00', '', '2015-09-04 10:21:20', 0, '2015-09-04 10:21:20', '', '222633'),
(915, 'aub', 'almondartery@gmail.com', 'aub', '$P$DNgn3mg5q2pfGdjzU0mh27e73l5CyC/', NULL, 'Mr', 'Aubs', '', 'urquhart', 'Villa Labak', 'Singakerta Ubud', '', '', '81237217733', 1, '0000-00-00 00:00:00', '', '2015-09-06 10:55:18', 0, '2015-09-06 10:55:18', '', '544034'),
(916, 'shelby ann', 'shelbymatias7@sbcglobal.net', 'shelby ann', '$P$DPi44NjpQH/n1i8vXp/h6fPn9DWtdy1', NULL, 'Ms', 'Shelby', '', 'Matias', 'Jl. Lodtunduh', '', '', 'my villa is located behind villa kecot. I am approximately 300 meters before Bali Hati school.', '81246317174', 1, '0000-00-00 00:00:00', '', '2015-09-06 10:58:41', 0, '2015-09-06 10:58:41', '', '657288'),
(917, 'John Abbott', 'john@resultsplatform.org', 'maxiabb', '$P$DQyBfpf0uchDwTRD1YZV3XcUpXOzoX1', NULL, 'Mr', 'John', '', 'Abbott', 'JL Tirta Tawar, 69', 'Kutuh Kaja', '', 'Next door to Villa Sancita.\n150m after Ubud Botanical Gardens (Aneh Aneh)', '82147596286', 1, '0000-00-00 00:00:00', '', '2015-09-08 03:58:27', 0, '2015-09-08 03:58:27', '', '950491'),
(918, 'Leila', 'leila_alihassan@hotmail.com', 'leilaalihassan', '$P$DxO3DCWIdWtHqXF9Tad5xLhDyIrlwp0', NULL, 'Ms', 'Leila', '', 'Hassan', 'Kubu Soca 5, JL. Yudistira', '', '', '', '81339360247', 1, '0000-00-00 00:00:00', '', '2015-09-10 06:17:33', 0, '2015-09-22 00:24:25', '', ''),
(919, 'Leila', 'leila.alihassan@gmail.com', 'leilaalihassan1', '$P$Dr96FPQ4ahgzMbYs/TuvbjV9QpXeJ40', NULL, 'Ms', 'Leila', '', 'Hassan', 'Kubu Soca 5, JL. Yudistira', '', '', '', '81339360247', 1, '0000-00-00 00:00:00', '', '2015-09-10 06:23:34', 0, '2015-09-10 06:23:34', '', '824203'),
(920, 'Camilledlh', 'camille.delahaye5@gmail.com', 'Camilledlh', '$P$DpsBBjlAQ9YeymhIyYbkOd412E4bI//', NULL, 'Ms', 'Camille', 'Alexandre', 'Delahaye', 'Jalan Raya Andong Gang Nuri', '', '', 'Rumah madechra, last house in the street. Please call when you are there.', '81339360247', 1, '0000-00-00 00:00:00', '', '2015-09-11 04:13:53', 0, '2015-09-11 04:13:53', '', '2410'),
(921, 'gregmercer', 'marketingunlimited100@gmail.com', 'gregmercer', '$P$D2DY1cYJ2AkG6GTQc1txuKS8HkIbO9.', NULL, 'Mr', 'greg', '', 'mercer', 'Hubud', '', '', '', '0812 37303872', 1, '0000-00-00 00:00:00', '', '2015-09-13 10:25:24', 0, '2015-09-14 01:54:07', '', ''),
(922, 'Julia Behles', 'julia_behles@gmx.de', 'juliab', '$P$DZkbwLT/aPwmwNax1NKUkIq2UfGzX/1', NULL, 'Ms', 'Julia', '', 'Behles', 'Jalan Sukma No 22, Banjar Tebasaye, Peliatan', '', '', '', '81339871421', 1, '0000-00-00 00:00:00', '', '2015-09-13 12:53:59', 0, '2015-09-13 12:53:59', '', '875069'),
(923, 'Mark Reilly', 'marcusreilly@gmail.com', 'marcusreilly', '$P$DG0085l7edcj5DAwemd92RPBcFxjcU.', NULL, 'Mr', 'Mark', '', 'Reilly', 'Bj. Abian Samal', 'Jl. Jineng, Lodtunduh', '', 'Follow Jl. Pengoseken into Lodtunduh.  Pass Warung 9 and follow straight.  At "Luwak Coffee" sign turn right into Bj. Abian Samal.  Follow straight past banjar and through perempatan.  first house on the right before the rice field.  Close to Tea House Kelod', '87761621327', 1, '0000-00-00 00:00:00', '', '2015-09-14 06:11:40', 0, '2015-09-14 06:11:40', '', '540908'),
(924, 'Clover', 'Mtsunshine2@yahoo.com', 'Tckinch', '$P$D65uIpZLnbwUyCoFe2GrlfYJ4BQSai1', NULL, 'Mrs', 'Clover', '', 'Kincheloe', 'Jl. Nyuh bulan', 'Nuyh kuning', '', 'Villa is next to laundry. Take path to the back unit.', '82144969342', 1, '0000-00-00 00:00:00', '', '2015-09-18 09:06:50', 0, '2015-09-22 00:21:19', '', ''),
(925, 'TAYA', 'taya-othmane@outlook.fr', 'TAYA', '$P$DJAuw6AkJ5RDXYTy53Qu4Q2pVdIdeL1', NULL, 'Mr', 'TAYA', '', 'Othmane', 'Kubu Soca number 5', '', '', '', '81246963065', 1, '0000-00-00 00:00:00', '', '2015-09-21 05:04:10', 0, '2015-09-22 00:19:59', '', ''),
(926, 'Eka Fitriani', 'ekanurfitriani@gmail.com', 'Eka Fitriani', '$P$DaiVb0W4vcU/Z5IZkbg6JijyyymX0S/', NULL, 'Ms', 'Eka', '', 'Fitriani', 'Jl. Raya Penestanan Kelod, Sayan', 'Br. Teges Kangin', '', '', '87861552205', 1, '0000-00-00 00:00:00', '', '2015-09-23 05:36:09', 0, '2015-09-23 05:36:09', '', '460242'),
(927, 'Shobna Mudaliar', 'shobna.mudaliar@gmail.com', 'Shobna', '$P$DBucXEj2HZY/3YvLu4zPUedhiDCBO11', NULL, 'Ms', 'Shobna', '', 'Mudaliar', 'Jalan Pinus, Banjar Kumbuh', 'Pengosekan', '', 'Please ask for Shobna or Shiva.  We are in Villa 1', '81239744446', 1, '0000-00-00 00:00:00', '', '2015-09-24 05:18:18', 0, '2015-09-24 05:18:18', '', '67521'),
(928, 'Russ', 'russ_bolton@hotmail.co.uk', 'Russbolton', '$P$Dq4taoe0IAmltE7OYn97gj/GIuEEAC0', NULL, 'Mr', 'Russell', '', 'Bolton', ' Jalan Cok Gede Rai, Banjar Tengah, Peliatan, 80571 Ubud Bali', '', '', '', '82144656779', 1, '0000-00-00 00:00:00', '', '2015-09-24 06:39:33', 0, '2015-09-24 06:39:33', '', '461466'),
(929, 'Agus', 'agusmikus@gmail.com', 'Agus', '$P$DA2wcad3.k34QiNLb5Qko3T.qHEqOe1', NULL, 'Mrs', 'Agnieszka', '', 'Kusnierz', 'Jalan Katik Lantang', '', '', '', '81339692987', 1, '0000-00-00 00:00:00', '', '2015-09-25 12:29:54', 0, '2015-09-25 12:29:54', '', '512288'),
(930, 'veuu', 'vespertine.observer@gmail.com', 'veuu', '$P$DQEy0l8R7ic0LeSMTlCaqQRVV/xqOO1', NULL, '', 'Veronika', '', 'Sarkanyova', 'Londo Bungalow 2', 'Penestanan', '', 'Our bungalow is right after Yellow Flower Cafe and Intuitive flow yoga in Penestanan.', '81339420972', 1, '0000-00-00 00:00:00', '', '2015-09-28 03:59:03', 0, '2015-09-28 03:59:03', '', '81087'),
(931, 'VillaIcylah', 'justnonsense@hotmail.com', 'VillaIcylah', '$P$D5R/Op0CRwa4gkEXKoq6qqVIgFwcWW.', NULL, 'Ms', 'Stephanie', '', 'McClain', 'Lodtunduh', '', '', 'Dari pompa bensin pengosekan jalan lurus sekitar 2 kilo. Perempatan belok kanan, 100 meter setelah Villa Kitty belok kiri. Setelah 300 meter ada tulisan Pura Panti Bija. Belok kanan masuk gang. Sekitar 100 meter belok kanan lagi, dan sekitar 30 meter kanan jalan rumah saya.', '89650182367', 1, '0000-00-00 00:00:00', '', '2015-09-30 02:54:44', 0, '2015-09-30 02:54:44', '', '521049'),
(932, 'Jeff', 'Sam@gmail.com', 'Jmac', '$P$DsTH6wIqOwfhFINRoixOqgkpCwuytI0', NULL, '', 'Jeff', '', 'McFaddin', 'Japan katik', '', '', 'By devi''s place', '81246315965', 1, '0000-00-00 00:00:00', '', '2015-09-30 07:59:59', 0, '2015-09-30 07:59:59', '', '562033'),
(933, 'Dannii Olsen', 'Danniijordison@tpg.com.au', 'DanniiOlsen', '$P$D0ay9w.656b2Xs/hDsiV.LgMMUAtK10', NULL, 'Mrs', 'Dannii', '', 'Olsen', 'Jl. Tirta Tawar 18', '', '', 'Villa 104', '81246513687', 1, '0000-00-00 00:00:00', '', '2015-10-01 02:52:04', 0, '2015-10-01 02:52:04', '', '676744'),
(934, 'Shiva', 'avihs.krishnan@gmail.com', 'shiva1', '$P$DACl3ksMUBI8Bxz8GK4mkSiWfl8Pon0', NULL, 'Mr', 'Shiva', '', 'Krishnan', 'Kumbuh', '', '', 'Hi, we are at Cory Villa right opposite Sankara hotel. Same street as Bhuwana hotel, Pengosekan.', '81239744446', 1, '0000-00-00 00:00:00', '', '2015-10-02 04:17:07', 0, '2015-10-02 04:17:07', '', '583917'),
(935, 'Hiram Rios', 'chefhiramrios@gmail.com', 'Hiram Rios', '$P$DM5/vp14hWg.YjrP5EZjFziB7OMFg20', NULL, 'Mr', 'Hiram', '', 'Rios', 'ayu masari spa', 'interior # 2', '', '', '82247958844', 1, '0000-00-00 00:00:00', '', '2015-10-02 09:42:55', 118, '2016-02-12 03:56:18', '', ''),
(936, 'John', 'seeyouinayear@hotmail.com', 'John', '$P$Dp0ePv3wIERRM0YUqn7KecSjee6FMK/', NULL, 'Mr', 'John', '', 'Samson', 'Jalan Tirta Tawar', 'Kutuh Kaja', '', 'Top floor', '81339823052', 1, '0000-00-00 00:00:00', '', '2015-10-03 02:37:26', 0, '2015-10-03 02:37:26', '', '401957'),
(937, 'Jonlajoie', 'Theomnibobulator@hotmail.com', 'Jonlajoie', '$P$DhFDKhSoqyT0ROFT9yJMXXqzcubNMM0', NULL, 'Mr', 'Jon', 'La', 'Joie', 'Villa 3, leneh', 'Ubud', '', 'The road next to chili villa', '81339871395', 1, '0000-00-00 00:00:00', '', '2015-10-04 09:30:17', 0, '2015-10-04 09:30:17', '', '457463'),
(938, 'Jason', 'jason_95_@hotmail.com', 'Jasonkip', '$P$DihfNmPIBw5emyfRHiVkTVk7h3eA5Y0', NULL, 'Mr', 'jason', '', 'masius', 'Jalan Raya Nyuh Kuning Pengosekan, Gianyar, Bali 80571, Indonesi', '', '', 'Before the ubud village to the right. At the end of the way at the right house!', '81332936573', 1, '0000-00-00 00:00:00', '', '2015-10-08 04:15:45', 0, '2015-10-11 05:58:35', '', ''),
(939, 'sangayu', 'sangayu41@yahoo.com', 'sangayu', '$P$DH5kezo6PvLuKkXZjafyicoIiL2ZI6/', NULL, '', 'Sang', '', 'Ayu', 'Jl. Raya Mas ( Oka Wood Carver), Mas, Ubud', '', '', '', '89678474364', 1, '0000-00-00 00:00:00', '', '2015-10-11 08:01:08', 0, '2015-10-11 08:01:08', '', '194688'),
(940, 'cj', 'clint.johnson@yahoo.com', 'cjbali', '$P$DA0iwNN0EaoRN.kN5Q61IKSfMT4O/V.', NULL, '', 'Clint', '', 'Johnson', 'Kemenuh, Sukawati, Gianyar, Bali 80581, Indonesia', '', '', 'Please call the Villa Manger Santi @ 0813-3825-3013 for help with directions', '81238719182', 1, '0000-00-00 00:00:00', '', '2015-10-12 06:59:25', 0, '2015-10-12 06:59:25', '', '67406'),
(941, 'Raec', 'Rachel_Coburn@hotmail.com', 'RaeC', '$P$Dx9qExdqNF419WMBAWZxrTS9W9Ux.Y.', NULL, 'Ms', 'Rachel', '', 'Coburn', 'Kubu Rama', 'Jl. Tirta Tawar', '', 'The villa is just past Ubud Botanical Gardens, next to Pure restaurant, on the left hand side. It is before Sugars Villas. You can call 081339691765 when you arrive in the area.', '81339691765', 1, '0000-00-00 00:00:00', '', '2015-10-13 11:51:25', 0, '2015-10-13 11:51:25', '', '142784');
INSERT INTO `cr_customer` (`cr_customerID`, `cr_customerDisplayname`, `cr_customerEmail`, `cr_customerUsername`, `cr_customerPassword`, `cr_customerHotelvilla`, `cr_customerTitle`, `cr_customerFirstname`, `cr_customerMiddlename`, `cr_customerLastname`, `cr_customerAddress1`, `cr_customerAddress2`, `cr_customerCity`, `cr_customerDetail`, `cr_customerPhone`, `cr_customerStatus`, `cr_customerLastlogin`, `cr_customerToken`, `cr_customerRegistered`, `cr_customerNumber`, `cr_customerModified`, `cr_customerModifiedby`, `cr_customerPhoneverify`) VALUES
(942, 'gaetan zell', 'skagrut@homail.com', 'kae808', '$P$DD4GNA2h/ScNyzr40TOokxTj7MJNYj.', NULL, 'Mr', 'zell', '', 'gaetan', 'Sri Wedari Tegalantan', '', '', 'room 3 on  the terrace', '82247039557', 1, '0000-00-00 00:00:00', '', '2015-10-14 10:30:43', 0, '2015-10-14 10:30:43', '', '144638'),
(943, 'Shaun Johnston', 'shaun@shift3.net', 'shaunj', '$P$DyKqXEtMnyepLF1WfTkFycu5THQmAZ.', NULL, 'Mr', 'Shaun', '', 'Johnston', 'Jalan Lodtunduh', 'Banjar Kaja Kauh', '', 'Behind Gallery Tanah Tho, on the T-House road', '81339673884', 1, '0000-00-00 00:00:00', '', '2015-10-14 10:40:49', 0, '2015-10-14 10:40:49', '', '507531'),
(944, 'Filip', 'fkarwacki3@gmail.com', 'Filip', '$P$Dn6Qu8J2dTFQgCHVCFp1Tko2ntEj7B/', NULL, 'Mr', 'Filip', 'Franciszek', 'Karwacki', 'Teges Kanginan Ubud', '', '', '', '8113955774', 1, '0000-00-00 00:00:00', '', '2015-10-14 12:35:25', 0, '2015-10-14 12:35:25', '', '752276'),
(945, 'Raye', 'RayeCreativeDesigns@gmail.com', 'Raye', '$P$DcAPbxVyuI9Hc/Ql8VcCuWwgBWeLMA0', NULL, '', 'Raye', '', 'Stratford', 'Penestanan', '', '', 'Fourth villa north of Yellow Flower cafe. Please phone me on 0821 4497 8912 if you cannot find us!', '82144978912', 1, '0000-00-00 00:00:00', '', '2015-10-16 05:09:09', 0, '2015-10-16 05:09:09', '', '826692'),
(946, 'laura rathbone', 'laura@mccarthystudios.net', 'bdrlgngrl', '$P$DgMBk6uXcHXqFFDk.vKFHWHLcu35u9/', NULL, 'Mrs', 'laura', '', 'rathbone', 'jl. monkey forsest', 'room #8', '', 'villa is down alley next to delta store. room is all the way in the back on right side', '81246862415', 1, '0000-00-00 00:00:00', '', '2015-10-16 09:09:33', 0, '2015-10-16 09:09:33', '', '140734'),
(947, 'Erin', 'erinlittle1970@me.com', 'Erin Little', '$P$Dl9TMhiGo6fzro/ttDMnkWQn7lcMBu.', NULL, 'Ms', 'Erin', '', 'Little', '3 Nyuh Gede', 'Nyuh Kuning', '', 'For Delivery please. The gang is right at the north end of the soccer field.  Up the gang, first left, #3 on the right.', '81246315941', 1, '0000-00-00 00:00:00', '', '2015-10-16 10:04:48', 0, '2015-10-16 10:04:48', '', '455919'),
(948, 'leilaalihassan', 'leila_alihassan@icloud.com', 'Leilaalihasan', '$P$DVURK3jWXiCO7QCAgZgn1BqpKf.35x.', NULL, 'Ms', 'Leila', '', 'Ali Hassan', 'Jalan Raya Andong, gang nuri 6', '', '', '', '81339360247', 1, '0000-00-00 00:00:00', '', '2015-10-21 04:23:36', 0, '2015-10-21 04:23:36', '', '697565'),
(949, 'Brittany', 'Itsbrittanyjoy@gmail.com', 'Brittanyjoy', '$P$Dj77UQ6oZlgVm3LBtYHJbke/K8Cr1e1', NULL, 'Ms', 'Brittany', '', 'Joy', 'Helen House', 'Bangkiang Sidem', '', 'Helen House past Karsa Spa', '82144883703', 1, '0000-00-00 00:00:00', '', '2015-10-21 05:43:52', 0, '2015-10-21 06:11:42', '', ''),
(950, 'Gulsen Ergun', 'gulsenergun@gmail.com', 'gulsenergun', '$P$DbNI/XHQZbrqBhrOwpJsQFc1PAq/Tc1', NULL, 'Ms', 'Gulsen', '', 'Ergun', 'Jalan Tirta Tawar', '', '', 'After Junjungan Hotel and Spa, on the right hand side.', '81239579418', 1, '0000-00-00 00:00:00', '', '2015-10-21 12:35:48', 0, '2015-10-21 12:35:48', '', '753476'),
(951, 'BaliBruce', 'briscoe@brucebriscoe.com', 'balibruce', '$P$DTEZW68fowldL2rnr3PnbuioTQVxDH/', NULL, 'Mr', 'Bruce', 'Martin', 'Briscoe', 'PO Box 213 Ubud', '', '', 'Villa on Jl Raya Mas behind Ubud Deli with RED gate', '81337598422', 1, '0000-00-00 00:00:00', '', '2015-10-25 09:18:55', 0, '2015-10-25 09:18:55', '', '913169'),
(952, 'Wu', 'nlits.mail@gmail.com', 'nlits', '$P$DsyKWzjGhlgOlGJnBl31YnKpFg8gFz0', NULL, 'Ms', 'Wulan', '', 'Sastra', 'Jl. Suweta No. 7', 'Central Ubud', '', 'right across the street from Rio Helmi café', '82144859342', 1, '0000-00-00 00:00:00', '', '2015-10-26 12:31:32', 0, '2015-10-26 12:31:32', '', '470956'),
(953, 'alan', 'alan.c.park@gmail.com', 'alan', '$P$D5dGyGdrTOv6t3DH33yaVtYyCg9ZMh/', NULL, '', 'Alan', '', 'Park', 'hanoman street', 'Gang Anila', '', '', '81239582193', 1, '0000-00-00 00:00:00', '', '2015-10-27 05:01:32', 0, '2015-10-28 01:36:08', '', ''),
(954, 'Claire Y', 'claire.young@live.com.au', 'clairealiceyoung', '$P$DRhauPCSGQ5D1lT38KpUJGmrPOs2HO.', NULL, 'Ms', 'Claire', '', 'Young', 'Private laneway off from Jalan Raya Penestanan', '', '', 'Turn left at Round Cafe Bar on Jl. Penestanan Kelod onto a small private street, continue driving past Gratitude Cafe  and then turn right after the tourist/taxi shop. Our villa is down this small street on the left, it has a name "Villa Anggrek". It is one of the Private Ubud Villas.\n\nGoogle maps: https://www.google.com.au/maps/place/8°30''24.3%22S+115°15''01.7%22E/@-8.5067437,115.2482863,17z/data=!3m1!4b1!4m2!3m1!1s0x0:0x0', '82145096212', 1, '0000-00-00 00:00:00', '', '2015-10-28 05:36:15', 0, '2015-10-28 05:36:15', '', '457187'),
(955, 'Bonnie', 'Bonnieandcosmo@gmail.com', 'Stars', '$P$D1CsIlUbPiQDFJGRtPYr87LCdLu7w61', NULL, 'Ms', 'Bonnie', '', 'Cooper', 'Pejeng kawan', '', '', 'By indigo tree', '81337700747', 1, '0000-00-00 00:00:00', '', '2015-10-28 06:23:59', 0, '2015-10-28 06:23:59', '', '361669'),
(956, 'Yoga Barn (Noel)', 'operations@theyogabarn.com', 'YogaBarn', '$P$DKFnicy72CksBC3cEQv/aiwRN2Uu3x.', NULL, 'Mr', 'Noel', '', 'Bernhardt', 'Jl. Pengosekan', 'Behind Siam Sally Restaurant', '', 'Mohon deliver Ke Upper Reception', '81936036466', 1, '0000-00-00 00:00:00', '', '2015-10-30 07:23:36', 0, '2015-10-30 07:23:36', '', '502440'),
(957, 'Colleen Schell', 'colleen.schell@gmail.com', 'colleen.schell@gmail.com', '$P$DLnDMkPJDGbKqItw/IoGE6H5HwPL2f1', NULL, '', 'Colleen', '', 'Schell', 'Jalan Raya Pengosekan (East of Gas Station)', '', '', 'I live behind Toya Medika Clinic', '82247004715', 1, '0000-00-00 00:00:00', '', '2015-10-30 11:06:38', 0, '2015-10-30 11:06:38', '', '97878'),
(958, 'Poyan', 'poyan.d.b@hotmail.com', 'Poyan', '$P$DmsRMBzfSa5Nojw.Vzo/iq913qZV8i.', NULL, 'Mr', 'Poyan', 'Wayan', 'Shifter', 'Room@Bali in Sayan. Room number 5', '', '', 'Room@bali is 300 meter after the four season resort on the left side in Sayan.', '81337700587', 1, '0000-00-00 00:00:00', '', '2015-10-31 09:18:30', 123, '2016-09-24 03:39:10', '', ''),
(959, 'Lisa', 'lisawagland@gmail.com', 'lisa', '$P$DlEAns.4W2nmgbJHnUScM427ABZSHq1', NULL, 'Mrs', 'Lisa', '', 'Wagland', 'Jl. Campuhan Br. Penestanan Kaja', '', '', '', '81338871503', 1, '0000-00-00 00:00:00', '', '2015-10-31 11:37:31', 0, '2015-10-31 11:37:31', '', '889859'),
(960, 'David Okon', 'djokon@gmx.net', 'Davidokon', '$P$D2A.SFasVdhqLfUMHFzoxWNNioGvPW0', NULL, 'Mr', 'David', 'Jan', 'Okon', 'Penestanan Kaja, made Kunci House', 'At Komang mankok''s place , bamboo house', '', 'Bamboo House', '81239545312', 1, '0000-00-00 00:00:00', '', '2015-11-01 07:35:45', 0, '2015-11-01 07:35:45', '', '637154'),
(961, 'Irene Bucheli', 'diverbuchi@hotmail.com', 'Irene Bucheli', '$P$DqjOLj641eVsD3Dx.8fC4DWWi93Ypx/', NULL, 'Ms', 'Irene', '', 'Bucheli', 'Alas Petulu Cottages', 'Jl Tirta Tawar No 18 Banjar Kutuh Kelod', '', 'Room 102', '82254540915', 1, '0000-00-00 00:00:00', '', '2015-11-02 10:46:31', 0, '2015-11-02 10:46:31', '', '210612'),
(962, 'Asta', 'thorisasta@internet.is', 'Asta', '$P$DWo/TqZQMwoQUnk0CiKytCvknVuhOD1', NULL, 'Ms', 'Asta', '', 'Thoris', 'Penestanan Kaja', '', '', 'Near Cafe Vespa\nBehind Happy House', '81238304693', 1, '0000-00-00 00:00:00', '', '2015-11-02 10:46:40', 0, '2015-11-02 10:46:40', '', '824039'),
(963, 'Bli Shannon', 'thegreenknight_au@hotmail.com', 'Bli_Shannon_Rasa_Bule', '$P$DPUyERsXI7I5WJrZP.t1.wh1HlUJhq0', NULL, 'Mr', 'Shannon', 'Leigh', 'McCabe', 'Jalan Kelabang Moding', 'Bentuyung', '', 'Belok Kiri dari Jalan Suweta di Bali Banjar Bentuyung, langsung 300m ada jalan pribadi besar di kanan dengan plang Pyramids of Chi', '81239307857', 1, '0000-00-00 00:00:00', '', '2015-11-06 07:21:03', 0, '2015-11-06 07:21:03', '', '180916'),
(964, 'Jack', 'Jackthoward@gmail.com', 'Jackkk', '$P$DyPYwvE.eh/2MNzKCDhTd8CwMSOjAX0', NULL, 'Mr', 'Jack', '', 'Howard', 'Jalan pengosekan', '', '', '', '85205184791', 1, '0000-00-00 00:00:00', '', '2015-11-08 11:10:50', 0, '2015-11-08 11:10:50', '', '972962'),
(965, 'David Hu', 'boomerwei@gmail.com', 'boomerwei@gmail.com', '$P$DDknYzZeDLdZAGiTLKQ/am4KSIVLjQ1', NULL, 'Mr', 'David', '', 'Hu', 'Jln Raya Sayan', '', '', 'Room 1, Pool Suite', '81338703970', 1, '0000-00-00 00:00:00', '', '2016-03-04 08:15:54', 0, '2016-03-04 08:15:54', '', '955058'),
(966, 'Nathan Darvill', 'nathan.darvill@gmail.com', 'Darvinator83', '$P$DDZ6nqHm.iM8EbcefpLn8U07qGgQdY1', NULL, 'Mr', 'Nathan', '', 'Darvill', 'JI. Cocoa No.80', 'Bunutan, Kedewatan', '', 'Cocoa Private Villa', '82237805171', 1, '0000-00-00 00:00:00', '', '2016-03-04 10:22:53', 0, '2016-03-04 10:22:53', '', '851291'),
(967, 'jane', 'janelewis6@gmail.com', 'jane', '$P$DzfSr4nH8vScby/3AtVh3.YA/lxMFS.', NULL, 'Ms', 'jane', '', 'lewis', 'Jalan Raya Mas No.149', '', '', 'Take the alley at "Virgo Cargo"and then first left. About 60 m on the right. Driveway to Villa. Lights on.', '81238168524', 1, '0000-00-00 00:00:00', '', '2016-03-05 11:02:39', 0, '2016-03-05 11:02:39', '', '214582'),
(968, 'Fina', 'iamolopina@gmail.com', 'Fina', '$P$Di7QRI7pAg1yEiIJ5X9UinyBxC28JF1', NULL, 'Ms', 'Fina', '', 'Simanjuntak', 'Jln. Raya Pejeng Kawan', 'Br. Laplapan', '', '250 meter setelah Manyi Village. Sebelah kiri jalan', '81339283238', 1, '0000-00-00 00:00:00', '', '2016-03-07 08:34:00', 0, '2016-03-07 08:34:00', '', '994517'),
(969, 'Louise', 'mybusinessjedi@gmail.com', 'mybusinessjedi', '$P$DomUBNHV0Si6/r3iGQbU9I/.Nty59w.', NULL, 'Ms', 'Louise', 'M', 'Sullivan', 'Gedes House, Harmony Villas', 'Lodtunduh', '', 'I live in a private villa Geded House next to Harmony Villas in Lodtunduh, Ubud. In between Malati villas and Harmony Villas.', '82146400672', 1, '0000-00-00 00:00:00', '', '2016-03-11 13:54:41', 0, '2016-03-13 08:39:16', '', ''),
(970, 'Christina', 'Damian.tew@gmail.com', 'Kris.tew@gmail.com', '$P$DZaTrzgVn.H/2tYdvLIvFoLYeJ3ymt0', NULL, '', 'Christina', '', 'Chang', 'Jl. Raya Nyuh', 'Kuning No. 15', '', 'Go past gate to back look for wooden door blocking path. This is us!', '8123806487', 1, '0000-00-00 00:00:00', '', '2016-03-17 11:16:00', 0, '2016-03-22 00:31:21', '', ''),
(971, 'Alanawhyte', 'alana.whyte@hotmail.com', 'alanawhyte', '$P$DJpuK2.zbE8fHvTX7dCaMqwGJa4G9.1', NULL, 'Ms', 'Alana', '', 'Whyte', 'Jl. Cok Rai pudak, peliatan,', '', '', 'Please deliver to the friendly house Bali hostel.', '81236827549', 1, '0000-00-00 00:00:00', '', '2016-03-17 13:33:56', 0, '2016-03-22 00:31:04', '', ''),
(972, 'Alexandre Rahir', 'alex.rahir@free.fr', 'alexbike', '$P$DEYa0pTXkJR7ZIpd4gNNzDHHf2ThiY1', NULL, 'Mr', 'Alexander', '', 'Rahir', 'Jalan Suweta, Km 2 (from Ubud Royal Palace)', '', '', 'It''s 200M North of "WAPA DI UME Resort and Spa", on the right.\n\nIn front, there is a BIRD &amp; HEART logo in Black and White, It''s here.', '83114794392', 1, '0000-00-00 00:00:00', '', '2016-03-18 08:01:46', 0, '2016-03-22 00:30:49', '', ''),
(973, 'Daria Kravtsova', 'dariaakravtsova@gmail.com', 'dariaakravtsova', '$P$DtxYU6uhC7NuBAG4uo8SJpUMwFzcm1/', NULL, 'Ms', 'Daria', '', 'Kravtsova', 'Jl. No. 4, Jl. Seruni, Sriwedari, Grogol, Sukoharjo, Jawa Tengah', '', '', '', '85738811576', 1, '0000-00-00 00:00:00', '', '2016-03-18 09:19:33', 0, '2016-03-22 00:30:20', '', ''),
(974, 'Peterson32966', 'Peterson32966@yahoo.com', 'Peterson32966', '$P$DycvLYUU/0r19fMmuekFbGf/BIgr8Q.', NULL, 'Mrs', 'Elizabeth', '', 'Peterson', 'Jl Monkey Forest', 'Room 303', '', '', '82144825390', 1, '0000-00-00 00:00:00', '', '2016-03-18 12:12:32', 0, '2016-03-22 00:30:05', '', ''),
(975, 'César Xans', 'cesar.xans@ece-france.com', 'cesarx', '$P$DVPuSnhFBRgJn8rcU02.nqBo5LLq4a0', NULL, 'Mr', 'Xans', '', 'César', 'jalan raya andong gang nuri', '', '', 'Rumah Madeshra homestay', '82340984753', 1, '0000-00-00 00:00:00', '', '2016-03-19 08:40:58', 0, '2016-03-22 00:29:51', '', ''),
(976, 'Brett Birkett', 'brettbirkett@yahoo.com.au', 'bbirkett', '$P$Dw9L/M6b6efAZPc3IwjT1k7nQgYJ9n/', NULL, 'Mr', 'Brett', '', 'Birkett', 'Monkey forest road', '', '', 'Near monkey forest', '82167945814', 1, '0000-00-00 00:00:00', '', '2016-03-21 09:40:26', 0, '2016-03-22 00:29:33', '', ''),
(977, 'Valentine Cuvillier', 'vcuvillier@hotmail.fr', 'Valentine', '$P$DG0ms0HStz938HW7LoKpVB/eezzDKz.', NULL, 'Mrs', 'Valentine', '', 'Cuvillier', 'Gang Meduri, Mas, Ubud', '', '', '', '82145905948', 1, '0000-00-00 00:00:00', '', '2016-03-21 10:54:40', 125, '2016-10-13 05:19:01', '', ''),
(978, 'Nicole cunningham', 'Nicole@puraforceremedies.com', 'Puraforce', '$P$DbYhkgN0Ud5ahJhRnGG8baCgvPwDQ7.', NULL, 'Ms', 'Nicole', '', 'Cunningham', 'Jl. Sarah Indah near restaurant bebek Tepi sawah', 'Up the lane way after the sawah Indah restaurant 100m', '', 'We are up the lane way after sawah Indah restaurant 100m, private villa with no car access.', '81236762064', 1, '0000-00-00 00:00:00', '', '2016-03-23 08:29:21', 0, '2016-03-23 08:29:21', '', '176441'),
(979, 'Annisu', 'ahs.sunila@gmail.com', 'Annisu', '$P$D0zDOuttrl7IALZdWyXXdnwafy3smX/', NULL, 'Ms', 'Annika', '', 'Sunila', 'Jalan made lebah, peliatan', '', '', 'Its the first right turn from jalan peliatan-yudistira, and then It''s on the left side at the end of the small gang.', '89651555764', 1, '0000-00-00 00:00:00', '', '2016-03-23 09:13:15', 0, '2016-03-23 09:13:15', '', '383423'),
(980, 'Jan', 'janfong14@gmail.com', 'janfong14@gmail.com', '$P$DhGKgp.QeVLq.ZuH1zaOphtGc4BnJm1', NULL, 'Ms', 'Jan', '', 'Fong', 'JALAN DEWI SITA', 'GANG MARUTI NO. 4', '', 'Instead of carrots can I please have onions. Thank you.', '81236756286', 1, '0000-00-00 00:00:00', '', '2016-03-23 11:16:50', 0, '2016-03-23 11:16:50', '', '275583'),
(981, 'Roderick', 'R.l.r.ernst@gmail.com', 'Zakdoek94', '$P$D.rTs9YNJzDOjvrG8Wfn6vAPsTLug/0', NULL, 'Mr', 'Roderick', '', 'Ernst', 'Jalan Jembawan in corner next to Belos', '', '', '', '81338645219', 1, '0000-00-00 00:00:00', '', '2016-03-23 11:58:37', 0, '2016-03-23 11:58:37', '', '453302'),
(982, 'Kristine', 'hunnyanya@gmail.com', 'PizzaBagus', '$P$DgUJZm.RNK/CMFf85Hk1TtFWM9fGHg/', NULL, 'Mrs', 'Kristine', '', 'Hunny', '. Banjar Batulumbang , Bedulu, Gianyar', '', '', '', '81337961907', 1, '0000-00-00 00:00:00', '', '2016-03-23 12:32:39', 121, '2016-10-04 03:44:16', '', ''),
(983, 'Aldi', 'aldimuslim@gmail.com', 'aldimuslim@gmail.com', '$P$DDy0Qmd08ZV4SyLXY6sCxpiZ7J/hWb0', NULL, 'Mr', 'Aldi', '', 'Muslim', 'The Royal Pita Maha', 'Desa Kedewatan, ubud 80571', '', 'Room 155', '82111157404', 1, '0000-00-00 00:00:00', '', '2016-03-26 11:24:01', 0, '2016-03-26 11:24:01', '', '967560'),
(984, 'alex37373', 'Alex_probyn@hotmail.com', 'Probyna', '$P$DvqAkx9C3X4ZxlW/kRfl1OXVBacoNS1', NULL, 'Mr', 'Alex', '', 'Probyn', 'Warsa hotel', 'Room L7', '', 'Deliver to room L7', '81339685453', 1, '0000-00-00 00:00:00', '', '2016-03-29 10:05:42', 0, '2016-03-29 10:05:42', '', '823314'),
(985, 'netta', 'netta.lonnqvist@gmail.com', 'netta', '$P$DgV/PUDopDMzObFwrNZnzu3mOXdAY0/', NULL, '', 'Netta', '', 'Lönnqvist', 'Banjar Abian Semal Kaja kauh, Lodutunduh Village', '', '', 'Hibiscus House is located to the left from the parking', '89652052898', 1, '0000-00-00 00:00:00', '', '2016-03-31 10:07:49', 0, '2016-03-31 10:07:49', '', '44211'),
(986, 'Suryo', 'Gumilarsuryo@gmail.com', 'Suryo', '$P$Dgv4mVSzWrxTjflb1bYf7ek6ArDhz/.', NULL, 'Mr', 'Suryo', '', 'Gumilar', 'Jl. Pinus IV no.25. Bandung', '', '', '', '81322949227', 1, '0000-00-00 00:00:00', '', '2016-03-31 11:17:53', 0, '2016-03-31 11:17:53', '', '953008'),
(987, 'Clementine', 'youcanchangethisworld@gmail.com', 'clementine', '$P$DckTTzXLSwJYGUtPv4VUy0Wt2diH/K/', NULL, 'Ms', 'Clementine', '', 'Ferretjans', 'Jalan Raya Sayan', '', '', 'Please call or text when arrive and I will come up from villa to collect', '82237337747', 1, '0000-00-00 00:00:00', '', '2016-04-01 09:41:16', 0, '2016-04-01 09:41:16', '', '933596'),
(988, 'jackchitt', 'jackchittenden@googlemail.com', 'jackchitt', '$P$DGi6Vex5itZjf4MB8FGQ/MUkRu4E0m/', NULL, 'Mr', 'Jack', '', 'Chittenden', 'jl. raya sanggingan', '', '', '', '81236860897', 1, '0000-00-00 00:00:00', '', '2016-04-04 08:48:14', 0, '2016-04-04 08:48:14', '', '804971'),
(989, 'Miranda', 'miranda.stamps@gmail.com', 'miranda', '$P$D.2C9LSIX2nkxHc1IY0nRN5wEAWqMu0', NULL, '', 'Miranda', '', 'Stamps', 'Esa House 2', 'Penestanan Kelod Ubud', '', 'Turn left just before Bali Dream Hotel and go to end of path.', '82237056813', 1, '0000-00-00 00:00:00', '', '2016-04-04 09:44:36', 0, '2016-04-04 09:44:36', '', '971039'),
(990, 'Parker Johnson', 'gparkerjohnson@gmail.com', 'Parker', '$P$DEY6oPWOJf7H1U1qvrAUd.ZGBk1uWv/', NULL, 'Mr', 'Parker', '', 'Johnson', 'Green Village', 'Sibang Gede', '', 'Go Jek will pick up and deliver', '81237213327', 1, '0000-00-00 00:00:00', '', '2016-04-05 09:34:32', 0, '2016-04-05 09:34:32', '', '381983'),
(991, 'Sebastian', 'seba.kuzminski@gmail.com', 'seba1988', '$P$DqWNS6n7y0vZNBdMweSU60cGClbqmN/', NULL, 'Mr', 'Sebastian', '', 'Kuzminski', 'room 332', '', '', '', '81338653051', 1, '0000-00-00 00:00:00', '', '2016-04-05 10:27:52', 0, '2016-04-05 10:27:52', '', '602354'),
(992, 'Peter Banik', 'peter@froggle.org', 'peterzen', '$P$DvOYlpxZhJRbWgdTKJbg.l7jDIs3jU1', NULL, 'Mr', 'Peter', '', 'Banik', 'Gang Nuri 14', 'Teges', '', 'From Gg Nuri please turn right on the driveway at the sign ''Villa A''\n\nMap: https://goo.gl/maps/yTjxT1KGZLQ2', '0812 36697176', 1, '0000-00-00 00:00:00', '', '2016-04-06 06:44:45', 0, '2016-04-06 06:44:45', '', '721789'),
(993, 'MichellePawson', 'monasis2014@gmail.com', 'Mpawson', '$P$DfY6m21uRitPAFOJoj0b6psmkpB77X0', NULL, 'Mrs', 'Michelle', '', 'Pawson', 'VILLA #1 - Jl. Raya Sayan No.53', 'Sayan', '', 'Kabupaten Gianyar, Bali', '81236702299', 1, '0000-00-00 00:00:00', '', '2016-04-07 08:49:57', 0, '2016-04-07 08:49:57', '', '514080'),
(994, 'Fynn', 'f.hildebrand.australia@web.de', 'FynnH', '$P$D8bAo6d5uOh/.kpg7PIkPWIrEfd1zI0', NULL, '', 'Fynn', '', 'Hildebrand', 'Jl. Tirta Tawar No. 888', '', '', '', '81239707420', 1, '0000-00-00 00:00:00', '', '2016-04-07 11:19:59', 0, '2016-04-07 11:19:59', '', '110618'),
(995, 'Chelsey', 'Chelseylrq@gmail.com', 'Cloo', '$P$D95FFtTwkxz3BLMseoDSwBczwajtrk.', NULL, 'Ms', 'Chelsey', '', 'Loo', 'Puri Asri VillaSt. Nyuh Bojog, Nyuh Bulan, Nyuh Kuning, Ubud', 'Bali, Indonesia 80571', '', 'Near Amarthasiddhi Centre', '81338710234', 1, '0000-00-00 00:00:00', '', '2016-04-07 12:18:57', 0, '2016-04-07 12:18:57', '', '164511'),
(996, 'Damar', 'damar.theilmann@gmail.com', 'Damar', '$P$DCLzXzo1/j/fjC6bz5M5PfdMBk9Vzu.', NULL, 'Mrs', 'Damar', '', 'Theilmann', 'Jl. Sugriwa 48', '', '', 'Is it possible to cut the pizza in slices? That would be great. Thank you!', '81216859663', 1, '0000-00-00 00:00:00', '', '2016-04-08 12:04:47', 0, '2016-04-08 12:04:47', '', '574801'),
(997, 'Alice', 'mabife@web.de', 'einstein1', '$P$DsPwQe2J8vTot7LrbV1bg1brAqI6kp0', NULL, 'Mrs', 'Alice', '', 'Krause', 'Jl. Raya Pengosekan', '', '', 'Waiting at the door.', '81238198504', 1, '0000-00-00 00:00:00', '', '2016-04-08 14:15:56', 0, '2016-04-08 14:15:56', '', '553219'),
(998, 'Melissa', 'Melmmcnerney@gmail.com', 'Emceenerney', '$P$DI7nWRXG5d/aLjJ.IcNMJ9rK9mnZ4B1', NULL, '', 'Melissa', '', 'McNerney', 'No., Jl. Suweta No.88, Ubud, Kabupaten Gianyar, Bali, Indonesia', '', '', 'Villa is just before above address on left hand side look for round matsu spa academy sign', '81236764735', 1, '0000-00-00 00:00:00', '', '2016-04-09 09:00:03', 0, '2016-04-09 09:00:03', '', '48585'),
(999, 'Christian', 'chrisphil.18@live.de', 'chrisphil.18@live.de', '$P$DyX1shUOogmJQDQwZGkv9BJdKG8jPo0', NULL, 'Mr', 'Christian', '', 'philippi', 'Jl. Tirta Tawar 888', '', '', '', '81239531539', 1, '0000-00-00 00:00:00', '', '2016-04-10 11:47:10', 0, '2016-04-10 11:47:10', '', '998126'),
(1000, 'Jaime', 'j.d.peijl@gmail.com', 'Jaime', '$P$DHaCGWproeeFZ1tNyf2MnOQ6kTgtHc0', NULL, 'Mr', 'Nevena', 'Pizza', 'Lover', 'Jl. Jembawan', 'In the corner', '', '', '81338645257', 1, '0000-00-00 00:00:00', '', '2016-04-13 12:10:11', 0, '2016-04-13 12:10:11', '', '783226'),
(1001, 'Alex', 'alexrahr@gmail.com', 'alexrahr', '$P$Daxqz9e6qK49Xus8IKijP/lHMc/LCj.', NULL, 'Mr', 'Alex', '', 'Rahr', 'Sayan, Ubud, Gianyar, Bali, Indonesia', '', '', '', '81239527809', 1, '0000-00-00 00:00:00', '', '2016-04-16 11:19:39', 0, '2016-04-26 04:06:52', '', ''),
(1002, 'emilie', 'g_emy@hotmail.com', 'emilie', '$P$DALWgUCp2Q2sRMtF4rANN3crwon1bm0', NULL, 'Ms', 'emilie', '', 'gouhier', 'JI. Gautama #6, P Tegal Kaja', '', '', 'guest house', '81238203032', 1, '0000-00-00 00:00:00', '', '2016-04-16 12:39:10', 0, '2016-04-16 12:39:10', '', '615951'),
(1003, 'Nevena', 'Nevenatamis@hotmail.com', 'Nevena', '$P$Di1/Of8iHUJ2U/EF25iOVvPrM8CltR.', NULL, 'Ms', 'Nevena', 'Pizza', 'Lover', 'Jalan jembawan', 'In the corner next to belos house.', '', 'Upstairs, not downstairs.', '81236181774', 1, '0000-00-00 00:00:00', '', '2016-04-17 01:48:23', 0, '2016-04-17 01:48:23', '', '77871'),
(1004, 'Laura', 'LauraS_1990@gmx.de', 'LauraGwen', '$P$DmxgCRvouiwEABOV/x03KvzDMUXzBW1', NULL, 'Ms', 'Laura', '', 'Schmidt', 'Jalan Suweta', '', '', 'The house is next to the resort Wapa di Ume. Please come upstairs', '81239509610', 1, '0000-00-00 00:00:00', '', '2016-04-18 10:44:52', 0, '2016-04-18 10:44:52', '', '555862'),
(1005, 'rfm1974', 'rfminna1974@yahoo.com', 'rfminna1974@yahoo.com', '$P$Dq8.sR0gAIsSuEcqY0WXGreZsgIcRf1', NULL, 'Mrs', 'Rebecca', '', 'Minna', 'Jl Tirta Tawar Kutuh Kaja', 'No. 69 Rai Bungalow', '', '', '82146844284', 1, '0000-00-00 00:00:00', '', '2016-04-19 10:29:30', 0, '2016-04-19 10:29:30', '', '409780'),
(1006, 'Milly', 'Milly_mcpherson@hotmail.co.uk', 'Milly', '$P$DrcflFOzHg4ntFP3KAvtBYrhesnERi/', NULL, 'Ms', 'Milly', '', 'Mcpherson', '24 Penestanan kelod', '', '', '(Private villa, just down the path from villa D''Omah, big yellow villa with brown gate, number 24 big of the front)', '81236353452', 1, '0000-00-00 00:00:00', '', '2016-04-20 08:54:54', 0, '2016-04-21 08:46:25', '', ''),
(1007, 'Made Zeni', 'zenmarketingintel@gmail.com', 'ZenPizza', '$P$D/82bkyXTy8GcM83MTVZ7NlheawYfM1', NULL, 'Mr', 'Zen', '', 'Joseph', 'Villa DeVadi', '', '', 'Jl Tirta Tawar, appx 3km, past Botanic Garden (cement dinosaur outside), then past SUGARS VILLA (green sign on left), then THIRD DRIVE ON LEFT. \n\nI will put a SIGN ON ROAD TO SAY ''PIZZA BAGUS HERE''.. \n\nGo down PATH on LEFT to FIRST GATE ON RIGHT.. it will be OPEN WITH LIGHTS ON INSIDE..', '81337218930', 1, '0000-00-00 00:00:00', '', '2016-04-21 10:44:57', 0, '2016-04-26 04:04:48', '', ''),
(1008, 'Pascal Wegner', 'wegnerp@gmail.com', 'pwegner', '$P$D/i3FRLTtOtOlKx./.p/nGBXxRFXmd0', NULL, 'Mr', 'Pascal', '', 'Wegner', 'Jalan Nyuh Gading Nyuh Kuning', 'Jalan Nyuh Gading gg sudamala no5 ', '', 'Our villa  is opposite of Yayasan Bumi Sehat  (Birthing Clinic) on Jl Nyuh Gading.   \nIf you are coming  from Jl. Pengosekan, get on  to Jl. Nyuh Kuning,   \nand drive  for a couple of minutes and  turn  right at  the  first street  to Jl Nyuh Gading and soon you''ll see a Loka\nPala Villa sign  to your  right.   \nPlease  follow  the signs on  the alley  /Gang Nyuh Sudamala. The villa  is at  the end of  the alley  to your  left. ', '081338765575‬', 1, '0000-00-00 00:00:00', '', '2016-04-24 05:42:23', 0, '2016-04-26 13:35:12', '', ''),
(1009, 'Philippe', 'csbali.lr.imports@gmail.com', 'Phil78', '$P$DovX/uLkcG4NXrx9hT/6iNxEWwYfLr/', NULL, 'Mr', 'Philippe', '', 'Roy', 'Teblin House Penestanan Room 8', '', '', '', '81239123504', 1, '0000-00-00 00:00:00', '', '2016-04-25 08:33:27', 114, '2016-06-03 04:06:05', '', ''),
(1010, 'Zsolt', 'reg@zsoltbako.com', 'reg@zsoltbako.com', '$P$DocyifBI2IpjdFBfwyFSxw1j2rq/B01', NULL, '', 'Zsolt', '', 'Bako', 'https://goo.gl/maps/fdTZtwqQ3E42', '', '', 'Directions: after Alchemy restaurant turn left, go to this point: https://goo.gl/maps/fdTZtwqQ3E42 then turn right. The 3rd house is ours.', '81236105598', 1, '0000-00-00 00:00:00', '', '2016-04-26 05:15:07', 0, '2016-04-26 05:15:07', '', '174325'),
(1011, 'Marta', 'martablancodelrio@gmail.com', 'Marta', '$P$Deb1gjPQknoQEt2IuGFHyWteDr2lF51', NULL, 'Ms', 'Marta', '', 'Blanco', 'Br. Penestanan Kaja Ubud', '', '', 'It is a Villa one  minutes for the Siddhi Ayu Body Massage or the Yellow Flower Cafe. If you call me I will be there are in one minute.', '8124632660', 1, '0000-00-00 00:00:00', '', '2016-04-29 05:37:55', 0, '2016-04-29 05:37:55', '', '899254'),
(1012, 'Elke Andernach', 'pythia79@aol.com', 'Pythia', '$P$DqnOZBygbSXv.hHNnL7Agvaai8wtc0/', NULL, 'Ms', 'Elke', '', 'Andernach', 'sudamala no 5, Gg. Nyuh Gadang, MAS, Ubud, Kabupaten Gianyar, Ba', '', '', '', '81338765574', 1, '0000-00-00 00:00:00', '', '2016-04-29 12:07:29', 0, '2016-04-29 12:07:29', '', '225301'),
(1013, 'Marta', 'mbraconi@gmail.com', 'mbraconi', '$P$DmfCBmM4Rq356wNVouleRFcRF.slU4.', NULL, 'Ms', 'Marta', 'Torres', 'Braconi', 'Villa Uma D''Tulu - Vilage of Petulu', '', '', 'Go up over Jalan Tirta Tawar for about 4 km, then turn right to Vilage Putulu.', '81236536079', 1, '0000-00-00 00:00:00', '', '2016-04-29 13:28:33', 0, '2016-04-29 13:28:33', '', '819855'),
(1014, 'jayd', 'greenjayd@gmail.com', 'jayd', '$P$DfmsQsj9RZgSvD61tmoTyIIBzsksMg1', NULL, '', 'jayd', '', 'hutchison', 'off jalan raya mas', '', '', 'go down Jalan Raya Mas, turn left at the sign for Rapuan cili\ndrive pass makan rapuan cili\nwe are the 2nd small street on the right\nwe have the grass ulang ulang roof', '81239908129', 1, '0000-00-00 00:00:00', '', '2016-05-01 08:10:58', 0, '2016-05-01 08:10:58', '', '971505'),
(1015, 'David', 'David.Haritos@Hotmail.com', 'davidh', '$P$DrCAwBHLdq1F4MTyK33P9Wtryn9Lm80', NULL, 'Mr', 'David', '', 'Haritos', 'Jalan Raya Sayan', '', '', 'Room 4', '82237337747', 1, '0000-00-00 00:00:00', '', '2016-05-01 11:56:18', 0, '2016-05-01 11:56:18', '', '783217'),
(1016, 'janis', 'JKArkossa@googlemail.com', 'jango', '$P$D2GRK8ZZAn6aoRzQjzyqLg2fX58NG2/', NULL, '', 'janis', '', 'karkossa', 'jalan raya kedisah', 'gianyar', '', '', '81239696572', 1, '0000-00-00 00:00:00', '', '2016-05-02 08:26:33', 0, '2016-05-04 01:24:36', '', ''),
(1017, 'karli', 'karli.jaenike@gmail.com', 'karli.jaenike@gmail.com', '$P$DV1RJOnFrJGxUo.m/NO9ezm9vIVYxQ0', NULL, 'Ms', 'Karli', '', 'Jaenike', 'Hanoman Street', '', '', 'In room J12, it is in the back past the temple they are renovating, on the first floor right by the pool.', '82191337526', 1, '0000-00-00 00:00:00', '', '2016-05-04 03:26:52', 0, '2016-05-04 03:26:52', '', '686299'),
(1018, 'Wiktor', 'wiktor.garbacz@gmail.com', 'wiktor', '$P$D9gdSeZI2.915JbhycSiln21uCrX0K/', NULL, 'Mr', 'Wiktor', '', 'Garbacz', ' Jalan Raya Andong', '', '', 'Opposite to Puripadma Hotel\nJust before sinarmas bank.\nOn the west side of the road.', '8123974721', 1, '0000-00-00 00:00:00', '', '2016-05-04 11:17:48', 0, '2016-05-04 11:17:48', '', '449867'),
(1019, 'chelcee johns', 'johnschelcee@gmail.com', 'johnschelcee@gmail.com', '$P$DPhhyJ0mM2zK.RGewUhvT2Q/22ALMW1', NULL, 'Ms', 'chelcee', '', 'johns', 'nyuh bojog 12', '', '', 'i live in nyuh kuning, and i am on the second floor', '82144273673', 1, '0000-00-00 00:00:00', '', '2016-05-06 04:59:46', 0, '2016-05-06 04:59:46', '', '584841'),
(1020, 'Jan-Philipp', 'jpholzheimet@googlemail.com', 'Janie1001', '$P$DmLDQujazl3sPJmx2CT09cjfqtfxV6.', NULL, '', 'Jan-Philipp', '', 'Holzheimer', 'Kubu Soca Jalan Yudistira, Peliatan, Br. Kalah, Ubud', '', '', 'Last Villa, Villa is Rented in the Name "Daniela"\n\nThanks:)', '81331674297', 1, '0000-00-00 00:00:00', '', '2016-05-07 11:12:42', 0, '2016-05-07 11:12:42', '', '629708'),
(1021, 'Serkan Kablan', 'serkan.kablan@hotmail.de', 'Serk', '$P$Dnfji7zkc73jRH9avup1jl4TLFmD82/', NULL, 'Mr', 'Serkan', '', 'Kablan', 'Jalan Raya Penestanan Kelod, Penestenan Kelod', '', '', 'please call if you don''t know where the villa is.\n\nthere is a sign with "villa way an 1&amp;2" on the way to our villa', '81558401073', 1, '0000-00-00 00:00:00', '', '2016-05-07 11:21:09', 0, '2016-05-07 11:21:09', '', '877616'),
(1022, 'Nico', 'nicorus96@web.de', 'Nico', '$P$DrmpHbxYd/PCucdVIjbGyT.je9BBa/1', NULL, 'Mr', 'Nico', '', 'Rus', 'Gang anila', 'Anila shanti room 3', '', '', '628124634026', 1, '0000-00-00 00:00:00', '', '2016-05-08 11:03:29', 0, '2016-05-08 11:03:29', '', '806689'),
(1023, 'Marcus', 'meccan86@gmail.com', 'Marcus', '$P$D2rrSO25wG9pzNo7VKbM8wY.dJ7eg81', NULL, 'Mr', 'Marcus', '', 'Wistisen', 'Kawan gang Merak, Jl. Raya Teges, Peliatan', '', '', 'Room 1. Phone number is to Hotel', '81239508733', 1, '0000-00-00 00:00:00', '', '2016-05-09 08:35:16', 0, '2016-05-09 08:35:16', '', '117744'),
(1024, 'Anthony Durkin', 'ahdurkin@bigpond.net.au', 'Anthony Durkin', '$P$DgTR07Gym2CkxTA7vBzRrwnQp/gDfL/', NULL, 'Mr', 'Anthony', '', 'Durkin', 'Kamanta Villa', 'Bali T House', '', 'Bali T House Klod \nKamanta villa', '81246091321', 1, '0000-00-00 00:00:00', '', '2016-05-15 07:41:30', 0, '2016-05-15 07:41:30', '', '915705'),
(1025, 'Alan', 'alan.anwar@gmail.com', 'Alan.A', '$P$DX2oJE2O2pJHrXqw0VLlWdfp9pEs/B1', NULL, 'Mr', 'Alan', '', 'Anwar', 'Jl Cemp', '', '', 'My villa is next to Sandat Glamping tents. Please call me if you''re close and need further directions.', '081236096144‬', 1, '0000-00-00 00:00:00', '', '2016-05-15 10:58:11', 0, '2016-05-15 10:58:11', '', '436654'),
(1026, 'Radu', 'fradian@nitrk.com', 'fradian', '$P$DoEhtzrglDx5Bw08v25E77A4QAV77N1', NULL, 'Mr', 'Radu', '', 'Florea', 'Jl. Raya Penestanan, Sayan, Ubud', '', '', 'My house is near Villa Wayan at 100m. (at back of Alchemy restaurant) When you arrive in front of Villa Wayan please call me and I will come outside to take the order. Thank you.', '81238904011', 1, '0000-00-00 00:00:00', '', '2016-05-17 10:11:09', 0, '2016-05-17 10:11:09', '', '653774'),
(1027, 'Conrad O', 'conrad_oriodan@yahoo.co.uk', 'Conrad O', '$P$Dw8svy6wGPj/F6H/EWJNEQUlD267Mu/', NULL, 'Mr', 'Conrad', '', 'Oriordan', 'Jalan raya penestanan', '', '', 'directly opposite Villa Anggrek', '81236353452', 1, '0000-00-00 00:00:00', '', '2016-05-22 10:47:29', 0, '2016-05-22 10:47:29', '', '287333'),
(1028, 'Barbara', 'Sfbarb1@yahoo.com', 'Bmillstein', '$P$DVGg33WGXiNtGSOPBqf2ggNJm7yVnd/', NULL, '', 'Barbara', '', 'Millstein', 'Camphuan Path', '', '', 'Up behind Bintang supermarket. Take the small steps and walk towards Yellow Flower Cafe. We ate half way between the small and big steps. The name of the villa is on the wall which is grey. The entrance is on the side.', '82144216670', 1, '0000-00-00 00:00:00', '', '2016-05-23 10:17:49', 0, '2016-05-23 10:17:49', '', '776327'),
(1029, 'Attilio', 'sgorlon.attilio@gmail.com', 'balihi03', '$P$Dc1rQBT6NES6Fkn3ELvjVsntrvyuKF.', NULL, 'Mr', 'attilio', '', 'sgorlon', 'Jalan Sandat No 9 Br Taman Kaja', 'Gianyar', '', '', '81237605236', 1, '0000-00-00 00:00:00', '', '2016-05-25 03:53:03', 0, '2016-05-25 03:53:03', '', '633251'),
(1030, 'Zandra Wolfe', 'zandrawolfe@gmail.com', 'Zandra', '$P$DDhEMSrEN8aKspOakCAD3RK7VmtxaI0', NULL, 'Ms', 'Zandra', '', 'Wolfe', 'Jalan Suweta, no. 99', '', '', 'Go down Jalan Suweta Head north (approx 1.7 kms), left side resort Wapa Di Ume. next door to the resort is a small toko and you will see a sign with Redjon on it. Next to that is a small gang my place is right next to that, a 2 story villa I have the part at the bottom. You will see a large iron gate with the number 99 on it. Pull it open, come in and close behind you. If you have gone too far you will see a new resort driveway, Visesa, that is on the other side of the villa. When inside, you will see another wrought iron gate, open and close again and head down the stairs, that is where I live.', '82237757515', 1, '0000-00-00 00:00:00', '', '2016-05-26 10:44:06', 122, '2016-09-24 03:34:59', '', ''),
(1031, 'Phil', 'phil@balintro.com', 'Phil16', '$P$DY1.XnBZEDCPSiSQl.u93altWo9.c50', NULL, 'Mr', 'Phil', '', 'Taylor', 'Jalan Monkey Forest', '', '', 'Room B2', '82144373715', 1, '0000-00-00 00:00:00', '', '2016-05-26 13:26:45', 0, '2016-05-26 13:26:45', '', '258620'),
(1032, 'Gerrit Sonnabend', 'gerrit.sonnabend@gmail.com', 'Gerrit90', '$P$DTsJTHdotCjKalSOFpTYt4juMk4uyp.', NULL, 'Mr', 'Gerrit', '', 'Sonnabend', 'Hubud; Monkey Forest Road 88x', '', '', 'upstairs', '81337298857', 1, '0000-00-00 00:00:00', '', '2016-05-28 08:06:14', 0, '2016-05-28 08:06:14', '', '270929'),
(1033, 'Mélissa Raymond', 'melissa.raymond20@gmail.com', 'Meletkai', '$P$D26336Kv8GCj6oGL4f6QcSOqkF7M0z0', NULL, 'Ms', 'Mélissa', '', 'Raymond', 'Monkey Forest St.,  Gianyar', '', '', '', '81236575600', 1, '0000-00-00 00:00:00', '', '2016-05-29 12:00:41', 0, '2016-05-29 12:00:41', '', '257044'),
(1034, 'Eugen', 'me@sp1r1t.com', 'eugenf', '$P$D2wPRaKz.blv1SywILSWI43FWuXQuc0', NULL, 'Mr', 'Eugen', '', 'Figursky', 'Jalan Tirta Tawar', 'Banjar Junjungan, Kadja', '', 'near Om Ham Retreat/Ashram Munivara and behind Pak Meres''s house', '81237610622', 1, '0000-00-00 00:00:00', '', '2016-06-02 12:08:23', 0, '2016-06-02 12:08:23', '', '359908'),
(1035, 'Carolina Galli', 'carolinagalli@gmail.com', 'carolinagalli@gmail.com', '$P$DADMguPoUuaIwnPxsnQC0iHNAzpviD.', NULL, 'Mrs', 'Carolina', '', 'Galli', 'Nyuhkuning village, gang nyuhpelet no 2', '', '', '', '81237427400', 1, '0000-00-00 00:00:00', '', '2016-06-10 12:37:12', 0, '2016-06-10 12:37:12', '', '738995'),
(1036, 'Leigh Ramadge', 'leighramadge@hotmail.com', 'leighramadge@hotmail.com', '$P$DyZyqXV4Rg2kqDTOjrcMOogS.jbyoa/', NULL, 'Mr', 'Leigh', '', 'Ramadge', 'Jalan Raya Laplapan Ubud, Bali 80571', '', '', 'Dari Jalan raya Ubud, ke arah barat lurus sampai di Perempatan lampu merah (patung Arjuna), lurus ke jalan melewati Maya Ubud Resort and spa. dan atas sungai jembatan, jalan lurus sampai di pertigaan dengan lampu di tengah jalan, belok ke kiri (jl laplapan) Nik Jalan Setelah belok kiri untuk 200 mtr kira kira., Villa Madella di sebelah kiri jalan. Gang untuk villa geng sebelah toko di sebelah kanan. toko menjual Gas, bensin, hp kredit , Tanya Maderson rumah.\n\nFor your driver. \nThe Manager here is Ibu Komang and her number is +6287862140375 or +6281337037162\n\nhttps://www.airbnb.com.au/rooms/7639807', '81236772058', 1, '0000-00-00 00:00:00', '', '2016-06-11 05:33:45', 0, '2016-06-11 05:33:45', '', '298057'),
(1037, 'Kensey', 'Kensey.l.frank@gmail.com', 'Kfrank2', '$P$Dgu1DfimlZj5uQcvnd6i5KHy6aNn5G1', NULL, 'Ms', 'Kensey', '', 'Frank', 'Jl. Raya Andong No.12 Peliatan BA', '', '', 'Call when here', '081239622396‬', 1, '0000-00-00 00:00:00', '', '2016-06-12 09:47:19', 0, '2016-06-14 01:44:43', '', ''),
(1038, 'michell mercer', 'michell.mercer@gmail.com', 'michell.mercer@gmail.com', '$P$DgF3i/B4mbb8q00lEhSDatRuA.86/u/', NULL, 'Ms', 'michell', '', 'mercer', 'Monkey forest road', 'room 8', '', 'across the road  from the soccer field', '81236755026', 1, '0000-00-00 00:00:00', '', '2016-06-16 10:27:15', 0, '2016-06-16 10:27:15', '', '250508'),
(1039, 'AshleyBowen', 'A.rene.ais13@gmail.com', 'MrsBowen', '$P$DOlPXQAeV9as8t60MrDXZYW8OiX2oP.', NULL, 'Mrs', 'Ashley', 'Rene', 'Huson', 'Jalan Raya laplapan', '', '', '', '81236772058', 1, '0000-00-00 00:00:00', '', '2016-06-17 09:09:19', 0, '2016-06-17 09:09:19', '', '320089'),
(1040, 'Elizabeth', 'elizabeth@windupbird.com.au', 'Elizabeth', '$P$DH3prRZXseXJHeCij7RPBGKySOlYzB.', NULL, 'Mrs', 'Elizabeth', '', 'Davies', 'Banjar Kumbuh, Mas', '', '', '', '8123764047', 1, '0000-00-00 00:00:00', '', '2016-06-17 11:00:04', 0, '2016-06-17 11:00:04', '', '106222'),
(1041, 'Mr Jay', 'Jernej.rot@gmail.com', 'Jay', '$P$DkZTj7ghAtNDObvaF7IOpxoJSnMt2E/', NULL, 'Mr', 'Jay', '', 'Rot', 'Singakerta', '', '', '', '85739543563', 1, '0000-00-00 00:00:00', '', '2016-06-17 11:18:59', 0, '2016-06-17 11:18:59', '', '848537'),
(1042, 'Sarah', 'Sarah410@hotmail.com', 'roupjm', '$P$DKOmd/EM1vQ/xM9lO3IHgWFC06A2pd0', NULL, '', 'James', '', 'Roupell', 'Lotus 1, Sunrise Villa', 'Jl. Raya Sanggingan', '', '', '85101177733', 1, '0000-00-00 00:00:00', '', '2016-06-17 11:56:54', 0, '2016-06-17 11:56:54', '', '210539'),
(1043, 'Rocio', 'roromaya11@gmail.com', 'Rocio', '$P$DYG81wdDUZHuEsD9ScwlsLtKBZ8mXU0', NULL, 'Ms', 'Rocio', '', 'Becerra', 'Jalan Penestanan Kelod', 'Sentaha house or in road bar go inside', '', '', '81246091224', 1, '0000-00-00 00:00:00', '', '2016-06-18 09:13:01', 0, '2016-06-19 01:42:19', '', ''),
(1044, 'David Rey', 'davidrey@yahoo.com', 'davidrey', '$P$Dr7LB8CYczRW1f2LwKYuIdfxetGgMQ/', NULL, 'Mr', 'David', '', 'Rey', 'Matahari villa  Banjar abiansemal kaja jauh lodtunduh ubud', 'https://goo.gl/maps/SGERY6ooH7x', '', 'Matahari villa \nBanjar abiansemal kaja jauh lodtunduh ubud,on the behind tanah tho gallery ubud', '81339672969', 1, '0000-00-00 00:00:00', '', '2016-06-18 11:52:44', 0, '2016-06-18 11:52:44', '', '852421'),
(1045, 'Tif', 'itsmetif@gmail.com', 'Tif', '$P$Dw6yQklwm32cV.V0v29qui36TudhY51', NULL, 'Mrs', 'Tif', '', 'Flynn', 'JaLan sandat', '', '', 'At the end of JaLan sandat', '85792802002', 1, '0000-00-00 00:00:00', '', '2016-06-21 03:49:09', 0, '2016-06-21 03:49:09', '', '624225'),
(1046, 'Patrizius', 'lightspiritbali@gmail.com', 'Patrizius', '$P$D7l9u22yQ1npGROUM1OqNRUbx8wVjX/', NULL, 'Mr', 'Patrizius', 'Wolfgang', 'Suppan', 'Tangkulak Mas', '80571 Ubud', '', '', '8113851220', 1, '0000-00-00 00:00:00', '', '2016-06-23 12:29:48', 0, '2016-06-23 12:29:48', '', '120245'),
(1047, 'Kakul villa & suites', 'reservation@kakulvillaubud.com', 'kakul villa', '$P$DjCZsgzUDGcSoYNkNDMhJC9KSAPf6g0', NULL, 'Ms', 'Ria', '', 'Nasis', 'jln Lodtunduh 1', '', '', 'Kakul villa &amp; suites', '81238319598', 1, '0000-00-00 00:00:00', '', '2016-06-24 05:45:35', 0, '2016-06-24 05:45:35', '', '415335'),
(1048, 'robbiee', 'rob.hoefnagel@hotmail.com', 'robbiee', '$P$DsBVxzyZj12AR3EElbxcJ3d51vY59i1', NULL, 'Ms', 'nevena', '', 'tamis', 'cocoa 2. no 69, kedewatan ubud', '', '', '', '81236181774', 1, '0000-00-00 00:00:00', '', '2016-06-25 11:46:27', 0, '2016-06-25 11:46:27', '', '116244'),
(1049, 'Kerry', 'Pizzalilly@gmail.com', 'Kerry', '$P$DReUMwkvHp439HUXmDpdNdFegGr7qT.', NULL, '', 'Kerry', '', 'Lizon', 'Br. Penestanan Kaja sayan Ubud', '', '', 'You can email me easier than calling the house phone', '81236037088', 1, '0000-00-00 00:00:00', '', '2016-06-26 10:59:19', 0, '2016-06-26 10:59:19', '', '650146'),
(1050, 'SILVANA SITA', 'animaisilvestres@gmail.com', 'silvanasita', '$P$DBM9d.Udr2BgaNZVR9Co2dR2NaTa4n/', NULL, '', 'SILVANA', '', 'SITA', 'rua marina sirangelo castello 54 apto 107', '', '', '', '81311269202', 1, '0000-00-00 00:00:00', '', '2016-06-26 13:28:53', 0, '2016-06-26 13:28:53', '', '614369'),
(1051, 'Linda Curley', 'lindacurley1@live.com', 'LindaC', '$P$D1qJbr.2wEbB78sFHx6PaF1EiQ9zZo1', NULL, 'Ms', 'Linda', '', 'Curley', 'Taro Gallery (Beside Nuri''s Mexican)', 'Sangingan', '', 'driving up sangingan, past bintang on the left, pass mini mart on the right, then sign for Bali botanic day spa on left, then Taro gallery is just after mosaic, beside Nuri''s Mexican... The house is behind the gallery, from front of the gallery go down the steps and follow path to the right of the gallery, through the bamboo gate, follow the path down the steps, last house on the left', '81337297809', 1, '0000-00-00 00:00:00', '', '2016-06-27 13:42:21', 0, '2016-06-29 02:18:32', '', ''),
(1052, 'Karina', 'karina.neu@live.com', 'Karina', '$P$D3OKEx/pEX406oZU982WDJJc7E8hpg.', NULL, 'Ms', 'Arin', '', 'Karina', 'Jl. Suweta', '', '', 'Request dry chilli', '82144396052', 1, '0000-00-00 00:00:00', '', '2016-06-30 05:57:29', 0, '2016-06-30 05:57:29', '', '938733'),
(1053, 'RebeccaMartindale', 'rebeccajmartindale@gmail.com', 'RebeccaMartindale', '$P$D.p8laAFtNlBpVADKQbKyn3tRXujDg0', NULL, 'Ms', 'Rebecca', '', 'Martindale', 'Jalan Suweta', '', '', 'Past ubud high school\nPast Wapa Di Ume Resort and Spa\nOn the left hand side.', '81999316770', 1, '0000-00-00 00:00:00', '', '2016-07-01 14:04:30', 0, '2016-07-01 14:04:30', '', '861990'),
(1054, 'Cokde Satria', 'gamingg29@yahoo.com', 'Cokorda Gede Satria Utama', '$P$DVBTlTonKyBOOMnycQ1rpN3e7Cni6D1', NULL, 'Mr', 'Cokorda Gede', '', 'Satria Utama', 'Jalan Suweta No. 198 Junjungan', '', '', 'Lokasi sebelah timur jalan ,disebelah utara Villa Ibu (Perbatasan Bentuyung-Junjungan)', '81238202198', 1, '0000-00-00 00:00:00', '', '2016-07-02 07:15:53', 0, '2016-07-02 07:15:53', '', '219102'),
(1055, 'Wendy', 'skies.elithx@gmail.com', 'skieszero', '$P$DHet8UQIhXtyENEiqiUISUP7YQSk/o/', NULL, 'Mr', 'ignatius', 'wendy', 'gunawan', 'Rip Curl store ubud', 'monkey forest 85', '', 'Sebelum lapangan', '82226922236', 1, '0000-00-00 00:00:00', '', '2016-07-02 07:24:52', 0, '2016-07-02 07:24:52', '', '300851'),
(1056, 'Anya', 'aunyawan.t@gmail.com', 'aunyawan', '$P$DGUvUUIgBkxpy1Fv0Gpe5tkYo.4Br2.', NULL, 'Ms', 'Aunyawan', '', 'Thongboonrod', 'Br. Pengosekan Kaja, Mas Ubud Gianyar Bali 90571', '', '', '', '81237794851', 1, '0000-00-00 00:00:00', '', '2016-07-02 10:33:46', 0, '2016-07-02 10:33:46', '', '869561'),
(1057, 'Ms Gavra', 'gavra.sin@gmail.com', 'gavra1982', '$P$DxR/pEX3IPOdNwtAdg.K0kgOgV.P8O/', NULL, 'Ms', 'gavra', '', 'sin', '77 jl raya sayan', 'Sayan', '', 'Please enter from back street near Kayumanis Hotel.\n\nMusak di belangkan, guest house dekik hotel kayumanis.', '81246750108', 1, '0000-00-00 00:00:00', '', '2016-07-04 12:17:04', 0, '2016-07-04 12:17:04', '', '415700'),
(1058, 'Allison', 'alliecat1092@yahoo.com', 'alliecat1092@yahoo.com', '$P$DT44KqlHbOXWhBHHMAJ/2jjmncG1Os.', NULL, 'Ms', 'Allison', '', 'Weingarden', 'Br Penestanan Kaja', '', '', 'Next to Laksmi Ecottages, also known as Sudi House', '81246767341', 1, '0000-00-00 00:00:00', '', '2016-07-06 13:45:28', 0, '2016-07-06 13:45:28', '', '744865'),
(1059, 'Andrei', 'matroskin.79@mail.ru', 'Ethnomagic', '$P$DRbuEoV7eT3Ozj6y7vyhKFKmx8uqLW/', NULL, 'Mr', 'Andrei', '', 'Zhizhov', 'Sri wedari no 6', '', '', 'After Gaia vila before Coffe Cafe is gates. go inside //you need rigth old door', '81353326694', 1, '0000-00-00 00:00:00', '', '2016-07-07 05:54:18', 0, '2016-07-07 05:54:18', '', '290602'),
(1060, 'Jovanna', 'Jovanna.ortega@yahoo.com', 'Jovieo8', '$P$DzHT0NeMD504BiWJluLQfL/aaarIt8.', NULL, 'Ms', 'Jovanna', '', 'Ortgea', ' 41 Jalan Monkey Forest', 'Gang Beji', '', 'Near the football field, behind the primary school. Call us at 0361979129.', '81239982351', 1, '0000-00-00 00:00:00', '', '2016-07-07 11:57:46', 0, '2016-07-07 11:57:46', '', '801183'),
(1061, 'Quynh Hoa', 'dangquynhhoa89@gmail.com', 'Quynh Hoa', '$P$D.JAbGKnM4I37ZskPwX2XlwVFf3u8u/', NULL, 'Mrs', 'Hoa', '', 'Dang', 'Hanoman street, gang Anila No 9 Padang Tegal Kelod', '', '', '', '081246274549‬', 1, '0000-00-00 00:00:00', '', '2016-07-07 13:02:13', 0, '2016-07-07 13:02:13', '', '570133'),
(1062, 'Nick Tobing', 'gemnick@gmail.com', 'nicktobing', '$P$DgHTtJO0xCVgeDjd971KYze/a0AYIB/', NULL, 'Mr', 'Nick', '', 'Tobing', 'Jalan Raya Penestenan', '', '', 'Rumah Karda, masuk ke jalan sebelum Y Resort', '81339158382', 1, '0000-00-00 00:00:00', '', '2016-07-11 09:17:13', 0, '2016-07-11 09:17:13', '', '505395'),
(1063, 'David Shastry', 'david.shastry@gmail.com', 'david.shastry@gmail.com', '$P$D4bb1mCtEtxQd4gOAFyElm/.UUQy3q0', NULL, 'Mr', 'David', '', 'Shastry', 'Suara Hari, Jl Tirta Tawar', 'Near Jungjugan Hotel &amp; Spa', '', 'There will be red light at Suara Hari. The house is at the end of the road inside the rice field next to Suara Hari', '81246574491', 1, '0000-00-00 00:00:00', '', '2016-07-11 13:41:36', 0, '2016-07-11 13:41:36', '', '152393'),
(1064, 'Matt Allen', 'matthew.allen@anu.edu.au', 'Mallen', '$P$DxUpw49DKoyYNRjdtXV2MBNV0JDM80.', NULL, 'Mr', 'Matthew', '', 'Allen', 'JL Suweta 40', '', '', '', '85857838654', 1, '0000-00-00 00:00:00', '', '2016-07-12 10:14:24', 0, '2016-08-07 07:39:04', '', ''),
(1065, 'Ashwin1', 'Ashwin.karanth@gmail.com', 'Karanth123', '$P$D264f06nAGhYZ84V4Y37QAGjuBnSWo1', NULL, 'Mr', ' Ashwin', '', 'Karanth', 'Room R1,  Sapulidi Resort', '', '', '', '82247885209', 1, '0000-00-00 00:00:00', '', '2016-07-14 12:09:53', 0, '2016-08-12 03:33:27', '', ''),
(1066, 'yaditimika', 'yaditimika@outlook.com', 'yaditimika', '$P$D4BFjgVUKoN254bGEyucH2SPa1w8WA1', NULL, 'Mr', 'Rhett', '', 'McDonald', 'Jalan Hanoman No.43', '', '', '', '8113985098', 1, '0000-00-00 00:00:00', '', '2016-07-15 14:06:12', 0, '2016-07-15 14:06:12', '', '230389'),
(1067, 'Dodo', 'how_wonderful@hotmail.fr', 'Dodo123', '$P$D/DEKCmCGbdo.i1Q4OnCA1B.gmggDS1', NULL, 'Mr', 'Charles', '', 'Dodo', 'Katik Lantang Street (Campuan 3) singakerta', '', '', 'Room 103 call The reception', '82144140552', 1, '0000-00-00 00:00:00', '', '2016-07-16 13:29:08', 0, '2016-07-16 13:29:08', '', '505966'),
(1068, 'Vaj', 'Vaja.dejonge@gmail.com', 'Vaj', '$P$DXZRXDP42/uBwpOt1b9vRJBszl6mOA/', NULL, 'Mr', 'Leon', '', 'Noort', 'Jalan Raya Laplapan No.15', '', '', 'It''s next to Payuk Bali Cooking Class. You recognize it by the blue flats. If you call we come outside.', '81236772058', 1, '0000-00-00 00:00:00', '', '2016-08-01 11:31:02', 0, '2016-08-01 11:31:02', '', '55284'),
(1069, 'Colin Reed', 'colinreed47@gmail.com', 'colinreed47@gmail.com', '$P$DIz5KWvm87Hc2aKFggjbPND8mtaUMa1', NULL, 'Mr', 'Colin', '', 'Reed', ' Jl. Monkey Forest, Ubud, Kec. Gianyar, Kabupaten Gianya', '', '', '', '81239459165', 1, '0000-00-00 00:00:00', '', '2016-08-06 11:49:44', 0, '2016-08-07 07:37:44', '', ''),
(1070, 'poole.kayleigh@gmail.com', 'poole.kayleigh@gmail.com', 'kayleigh', '$P$DcC8yoG55yHf67.7lhHHWCtVeAXdH41', NULL, 'Ms', 'Kayleigh', '', 'Poole', 'Address: Jl. Monkey Forest, Ubud, Kec. Gianyar, Kabupaten Gianya', '', '', '', '81239459165', 1, '0000-00-00 00:00:00', '', '2016-08-06 14:09:23', 0, '2016-08-07 07:37:20', '', ''),
(1071, 'J&J Stewart', 'jus.stewart@live.com.au', 'jus.stewart@live.com.au', '$P$Dcb4/doVZEnfZNmQBZdpNUYYDe2Msh1', NULL, '', 'Justin &amp; Justin', '', 'Stewart', 'Jalan Raya Andong, Peliatan', 'Gang Manyi', '', '200M FROM DRUM FACTORY (SAME SIDE) IN GANG MANYI.\nCLOSEST SHOP NAME IS KALYANA CRAFTS.\nHOUSE IS ALSO INFRONT OF ARJUNA LEGAL SERVICE.\nDRIVE UP GANG MANYI, WE ARE FIRST HOUSE ON KANAN WITH BLACK GATE.', '81238098909', 1, '0000-00-00 00:00:00', '', '2016-08-08 11:04:43', 0, '2016-08-08 13:07:33', '', ''),
(1072, 'Natacha SAGNA', 'natachasagna@gmail.com', 'Natacha', '$P$Dg4QJQy/hMR.KdBZwdOhERCGtksrU20', NULL, 'Ms', 'Natacha', '', 'SAGNA', 'Jl. Tirta Tawar, Petulu', 'Ubud, Kabupaten Gianyar, Bali', '', 'We are located on a small side street off Tirta Tawar Road in  Kutuh Kaja. From the main road of Ubud, head north on Tirta Tawar for about 2.5km. After passing AA Juicery, continue a bit further and then turn left down a side street, marked by a sign RAI BUNGALOWS. Our place is on the left side of the side street, behind the car port.', '81239978389', 1, '0000-00-00 00:00:00', '', '2016-08-09 10:49:55', 0, '2016-08-12 03:31:11', '', ''),
(1073, 'Brian C Currie', 'briancurrie@me.com', 'brianccurrie', '$P$DJiBUbq1igL7ZsQNKEpKqkY7HiF8pS0', NULL, 'Mr', 'Brian', 'Chris', 'Currie', '52 Jl. Raya Sayan', 'Unit #2', '', '', '81239524139', 1, '0000-00-00 00:00:00', '', '2016-08-10 10:51:50', 0, '2016-08-12 03:36:45', '', ''),
(1074, 'Gijs', 'gijsackermann@gmail.com', 'GijsAck', '$P$DLBlB1csKfUxBT6mEll/u19AHCxYP51', NULL, 'Mr', 'Gijs', '', 'Ackermann', 'Banjar Kalah, 80361', '', '', '', '85858914008', 1, '0000-00-00 00:00:00', '', '2016-08-11 09:53:20', 0, '2016-08-11 09:53:20', '', '643330'),
(1075, 'Nathalie Huelsberg', 't.s.engel@gmx.de', 'Nathalie', '$P$DMxmB.2JXATcOT8aWls4waMHAVcb4b0', NULL, 'Ms', 'Nathalie', '', 'Hülsberg', 'Jl. Sugriwa No.59', '', '', 'Room No.2', '85857615840', 1, '0000-00-00 00:00:00', '', '2016-08-11 10:23:00', 0, '2016-08-11 10:23:00', '', '693158'),
(1076, 'Jengoodand', 'Jengoodand@gmail.com', 'Jengoodand', '$P$DEhgHvdZEyq0.5tr4cTIHEZu03Ifcp0', NULL, 'Mrs', 'Jennifer', '', 'Anderson', 'Jl Nyuh bojog', 'Gang alam shanti, Nyuh kuning', '', 'Di belakang spa alam wangi, rumah nay Ibu ayu', '85877207002', 1, '0000-00-00 00:00:00', '', '2016-08-11 10:51:09', 0, '2016-08-11 10:51:09', '', '661730'),
(1077, 'Matthias Bruening', 'mabruening@gmail.com', 'mabruening', '$P$DZuqLXkWa7zbqesSnK00/lj6j1Maie1', NULL, '', 'Matthias', '', 'Bruening', 'Br. Dukuh Kawan, Pejeng Kawan', '', '', '', '81339178348', 1, '0000-00-00 00:00:00', '', '2016-08-11 11:19:01', 0, '2016-08-14 05:03:55', '', ''),
(1078, 'Daniel', 'danielwlker@gmail.com', 'danielw131', '$P$DJAeoP2V2sq/eG263GSBSj9ggTZjjH1', NULL, 'Mr', 'Daniel', 'William', 'Walker', 'Jalan Raya Sanggingan', '', '', '50 mt setelah rumah Pk Joss masuk gang sebelah kanan di ujung ada villa Lippside', '81239771802', 1, '0000-00-00 00:00:00', '', '2016-08-11 13:29:47', 0, '2016-08-12 03:28:59', '', ''),
(1079, 'div', 'diviya.nand@gmail.com', 'diviya.nand@gmail.com', '$P$DEZYCqN8Iqh61dgvsv3sAzAmo7brCj/', NULL, 'Ms', 'Diviya', '', 'Nand', 'Gg. Nuri 19-27, Peliatan, Ubud, Kabupaten Gianyar, Bali, Indones', '', '', 'Look for the Kiyan Teges sign, then turn right there and go all the way to the end to Villa C', '81339821827', 1, '0000-00-00 00:00:00', '', '2016-08-13 06:16:32', 0, '2016-08-13 06:16:32', '', '218188'),
(1080, 'Jason', 'bucklager@outlook.com', 'Jasonb', '$P$DDQUrKTVu2P4B1FEPA7/FWyt4pin640', NULL, 'Mr', 'Jason', '', 'Buchanan', 'Jl Pengosekan', '', '', 'De Dalam is beside Lili House next to Who''s Who restaurant.  We are in Villa 1, which is right down the bottom of the path, past the first four little villas, past some construction, and at the bottom there are 3 more.  Villa 1 is right at the bottom.', '82145015707', 1, '0000-00-00 00:00:00', '', '2016-08-13 11:23:50', 120, '2016-10-04 03:45:24', '', ''),
(1081, 'Kathryn', 'siriuslylost97@yahoo.com', 'siriuslylost97@yahoo.com', '$P$DdoETyRFoeGWKvg.h/KwDZaq6s1R00.', NULL, 'Ms', 'Kathryn', '', 'Weller', 'Jl. Jero Gadung no. 82', 'Pondok aget untung', '', 'With blue flag outside', '81246914434', 1, '0000-00-00 00:00:00', '', '2016-08-13 11:57:00', 0, '2016-08-14 05:02:43', '', '');
INSERT INTO `cr_customer` (`cr_customerID`, `cr_customerDisplayname`, `cr_customerEmail`, `cr_customerUsername`, `cr_customerPassword`, `cr_customerHotelvilla`, `cr_customerTitle`, `cr_customerFirstname`, `cr_customerMiddlename`, `cr_customerLastname`, `cr_customerAddress1`, `cr_customerAddress2`, `cr_customerCity`, `cr_customerDetail`, `cr_customerPhone`, `cr_customerStatus`, `cr_customerLastlogin`, `cr_customerToken`, `cr_customerRegistered`, `cr_customerNumber`, `cr_customerModified`, `cr_customerModifiedby`, `cr_customerPhoneverify`) VALUES
(1082, 'Theodore Cleary', 'ted.cleary@gmail.com', 'ted.cleary@gmail.com', '$P$DmiFoU0pEOzfxVsfAv08BOSvIjScN/.', NULL, 'Mr', 'Theodore', '', 'Cleary', 'Banjar Dukuh Kawan, Pejeng Kawan, Kec. Gianyar, Kabupaten Gianya', '', '', 'Amori Villas\nBanjar Dukuh Kawan, Pejeng Kawan, Kec. Gianyar, Kabupaten Gianyar, Bali 80552', '081246065346‬', 1, '0000-00-00 00:00:00', '', '2016-08-15 05:39:33', 0, '2016-08-15 13:19:06', '', ''),
(1083, 'Nino Laeubli', 'laeublin@ethz.ch', 'laeublin', '$P$D1JwXhFkWjTzONNm6YN6aP5WmiOPxU/', NULL, 'Mr', 'Nino', '', 'Laeubli', 'Jl. Tirta Tawar 22', 'Petulu', '', 'Room 4. The sign shows The Bali Shanti &amp; Villa Padma. It comes right after Alas Petulu Cottages.', '82144826680', 1, '0000-00-00 00:00:00', '', '2016-08-15 12:04:08', 0, '2016-08-15 12:04:08', '', '696259'),
(1084, 'Feronikaamelia', 'feronikaamelia500@gmail.com', 'feronikaamelia', '$P$DceyLw.c2N4w8/.NWMMhRfownIyO2Q/', NULL, 'Mrs', 'Feronika', 'Amelia', 'Ribka', 'Belakang Abangan Bungalow', '', '', 'Kantor mr. roberto capodieci , belakang hotel abangan bungalow.', '82133882277', 1, '0000-00-00 00:00:00', '', '2016-08-17 09:46:12', 0, '2016-08-17 09:46:12', '', '925438'),
(1085, 'Andrew Williams', 'andrew@williamsandrew.com', 'anwill999', '$P$D6aghc8rewPFmtnCOl0xNZSfT9vblL.', NULL, '', 'Andrew', '', 'Williams', 'jln. raya katiklantang', 'singakerta village', '', '', '81246222491', 1, '0000-00-00 00:00:00', '', '2016-08-18 06:51:21', 0, '2016-08-18 06:51:21', '', '267417'),
(1086, 'Madalena Pinheiro', 'madalena_diaspinheiro@hotmail.com', 'MadalenaMachadoDp', '$P$DOXpB2PmnaSz2g6Im.vKtg/ip88JTt.', NULL, 'Mrs', 'Madalena', '', 'Pinheiro', 'Jl. Sigriwa No.53', '', '', '', '82144233429', 1, '0000-00-00 00:00:00', '', '2016-08-19 11:01:49', 0, '2016-08-23 03:57:23', '', ''),
(1087, 'Cynthia Nuńez', 'cynthia1237@hotmail.com', 'Cyn1237', '$P$DLAbWhVaiP.Ep.WcJpRI3oRhYlb6zE/', NULL, 'Ms', 'Cynthia', '', 'Nuñez', 'Nuri St. Teges Yangloni, peliatan', '', '', 'Room Cempaka', '85851347922', 1, '0000-00-00 00:00:00', '', '2016-08-23 13:59:21', 0, '2016-08-23 13:59:21', '', '22126'),
(1088, 'Ben', 'ben.chew@telus.net', 'benchew22', '$P$DrXDos64baHQHJkU1TZWR.KyvKdzYD1', NULL, 'Mr', 'Ben', '', 'Chew', 'Jalan Sri wedari No. 9', 'Banjar Tegal Lantang-Ubud', '', '', '81339609901', 1, '0000-00-00 00:00:00', '', '2016-08-24 09:38:37', 0, '2016-08-24 09:38:37', '', '459500'),
(1089, 'Brasille', 'brasilleclaessens@outlook.com', 'Brasille', '$P$DWjKEbiqljUoBZkRZj6FoCW4OZq4Is.', NULL, 'Mr', 'Ketut', '', 'Ningmas', ' br. Kelingkung, Lodtunduh', '', '', 'Please call the number for the adress directions', '81338618080', 1, '0000-00-00 00:00:00', '', '2016-08-26 11:30:05', 0, '2016-08-26 11:30:05', '', '981891'),
(1090, 'Anna', 'ann.sutanto@gmail.com', 'Anna S', '$P$DFYtm3UsJn4n.eIpVHuVZdno05Bdvs.', NULL, 'Ms', 'Anna', '', 'Sutanto', 'Jl. Suweta km 2.5', 'Belakang Bale Banjar Sakti', '', 'Banjar Bentuyung Sakti\nJalan turun menuju Frannie''s House\nRumah pertama di belakang Bale Banjar', '81237879597', 1, '0000-00-00 00:00:00', '', '2016-08-27 07:59:49', 0, '2016-08-27 07:59:49', '', '903331'),
(1091, 'Louis Louis', 'louisemorris1@yahoo.co.uk', 'louisemorris1', '$P$DOA90II/RmvRznoqdEcecIltP1byEi0', NULL, 'Ms', 'Louise', 'Sullivan', 'Sullivan', 'Villa Krishna', 'Gang Witney, Penastanan', '', 'We Live in a private Villa along Gang witney. If you come down and get to Witney house you have gone too far, but ask at the Warung and Wayan will tell you our house.', '81236705595', 1, '0000-00-00 00:00:00', '', '2016-08-28 11:38:03', 0, '2016-08-28 11:38:03', '', '944862'),
(1092, 'ayu', 'tasteofayn@gmail.com', 'naaYnaa', '$P$D3sohC0LekjOkE1zv2axp3SqiYZsHt.', NULL, 'Ms', 'Ayu', '', 'Sriwidayati', 'Jl Monkey Forest', '', '', 'reservation ( sales and marketing Dept )', '81236230829', 1, '0000-00-00 00:00:00', '', '2016-09-04 05:17:00', 0, '2016-09-04 05:17:00', '', '893662'),
(1093, 'Kimberley22', 'Kimberley.brennan@yahoo.com', 'Kimberley22', '$P$DuS/saVykddojN.rnMWvsLzNzS1FAE0', NULL, 'Ms', 'Kimberley', '', 'Brennan', 'Jalan Penestanan Kelod', '', '', 'Take the small path between the parking hut and Walk Gallery off Jalan Penestanan Kelod to the very end. It is the door at the end of this path. There is no number but the outside light will be on.', '81339672912', 1, '0000-00-00 00:00:00', '', '2016-09-04 10:46:17', 0, '2016-09-05 12:50:31', '', ''),
(1094, 'louise', 'ledzeppo3@hotmail.com', 'louise morris 123', '$P$D5GEOdZ01Sce4bI28hnRMSq63XrAkc1', NULL, 'Ms', 'Louise', 'Marie', 'sullivan', '18 Gang Whitney', 'Penastanan', '', 'Over the rainbow house number 18 gang whitney. Go down the path and first house on the right.', '81236705595', 1, '0000-00-00 00:00:00', '', '2016-09-05 12:18:06', 0, '2016-09-05 12:18:06', '', '908415'),
(1095, 'Lizz', 'lquain@yahoo.com', 'lquain', '$P$DloVzy89oz1GR/GELVI5.3T/DR2ByP1', NULL, '', 'Lizz', '', 'Quain', 'Jln. Suweta', '', '', '500 meters to the north from Wapa di Uma Resort. On the left side of the road there is a sign Adi Sentana Putra and Gasuta.', '81246561272', 1, '0000-00-00 00:00:00', '', '2016-09-12 09:55:16', 0, '2016-09-13 01:34:59', '', ''),
(1096, 'Daniel', 'daniel.riveong@gmail.com', 'DanielJPR', '$P$DUUFehe/vscEN3fEy2gm6Q13eGqvC.1', NULL, 'Mr', 'Daniel', '', 'Riveong', 'Jalan Sanggingan', 'Gang Kecil (Puri Abing)', '', 'Dekat Nuri''s BBQ, Masuk Gang Seberang Kit Kat cafe, ada tanda untuk Puri Abing, masuk gang, belok kiri, belok kenan', '81807065777', 1, '0000-00-00 00:00:00', '', '2016-09-13 11:40:59', 0, '2016-09-13 11:40:59', '', '686207'),
(1097, 'Pizzaplease', 'jasminair@gmail.com', 'Jasmin', '$P$Dz3hTqqhPjYAXt9/PG7HTgsaf/t.C61', NULL, 'Ms', 'Jasmin', '', 'Air', 'Jl. Tirta Tawar No. 101X, 80571', '', '', '', '81240883240', 1, '0000-00-00 00:00:00', '', '2016-09-20 13:09:24', 0, '2016-09-20 13:09:24', '', '487975'),
(1098, 'Jenny', 'leeckn@gmail.com', 'JYCK', '$P$DbnZT/k2YXtzw.R2oii.Y/bX4X.FpJ0', NULL, 'Mrs', 'Jenny', '', 'An', 'Jl. Raya kumbuh,Mas, 80571', '', '', 'Room Saturday', '82213276766', 1, '0000-00-00 00:00:00', '', '2016-09-21 10:23:34', 0, '2016-09-21 10:23:34', '', '394448'),
(1099, 'John', 'holdwayj@gmail.com', 'Akael', '$P$Dp4AXdhhqFBh8D/mm3p3jAnStwWTWn.', NULL, 'Mr', 'John', '', 'Holdway', 'Gang Morak (off Jl. Raya Andong)', 'Petulu', '', '''Gang Morak'' is opposite the 2nd Indomart on Jl. Raya Andong. Go all the way down Gang Morak to find villa ''Rumah Karana'' and call my number.', '81236299535', 1, '0000-00-00 00:00:00', '', '2016-09-24 10:10:10', 0, '2016-09-24 10:10:10', '', '898512'),
(1100, 'Drew', 'drew@dbtlr.com', 'dbtlr', '$P$DLyyiZKA4VVI0G7dOY4jg/Ybhc8pX11', NULL, 'Mr', 'Drew', '', 'Butler', 'Jl. Nyuh Bulan No.10b', '', '', 'The villa is through the red gate and the 2nd gate on the left inside', '81339674279', 1, '0000-00-00 00:00:00', '', '2016-09-24 10:57:15', 0, '2016-09-25 02:36:45', '', ''),
(1101, 'Mariah', 'Mooney.mariah@gmail.com', 'Mariahmoon', '$P$DYowPUcqrMssOAZa8BeMhKA075fX8y0', NULL, 'Ms', 'Mariah', '', 'Mooney', 'Jl. Made Lebah no. 36', '', '', '', '82147054050', 1, '0000-00-00 00:00:00', '', '2016-09-24 11:05:03', 0, '2016-09-24 11:05:03', '', '695856'),
(1102, 'Juliapendyk', 'Juliapendyk@gmail.com', 'Juliapendyk', '$P$DBETTqF1AElDHGsobSO7oKNDdhBLRh0', NULL, 'Ms', 'Julia', '', 'Pendyk', 'Tegallalang, Gianyar', '', '', 'Room 5 \nCan call once arrive and will come out :-) thanks!', '82266073231', 1, '0000-00-00 00:00:00', '', '2016-09-24 12:25:06', 0, '2016-09-24 12:25:06', '', '775661'),
(1103, 'Francisco Piments', 'xicopimenta@gmail.com', 'xicopimenta@gmail.com', '$P$DUU8zhh5dLgo25gDXEQD/PDnIHA/O40', NULL, 'Mr', 'Francisco', '', 'Pimenta', 'Nyuh Kuning', 'Villa 7', '', 'Inside BCC. Turn right to Budhi Ayu Villas. Ask Front Desk.', '8113974107', 1, '0000-00-00 00:00:00', '', '2016-09-25 06:37:36', 0, '2016-09-25 06:37:36', '', '88495'),
(1104, 'Chad', 'Chadlinney@live.co.uk', 'Chad', '$P$DTJ0nbHux3J.7QjtBNRHsXs7ABHzrM/', NULL, 'Mr', 'Chad', '', 'Linney', 'Yudistira selatan street, no 12', 'Banjar kalah, peliatan', '', '', '82144177132', 1, '0000-00-00 00:00:00', '', '2016-09-25 13:03:17', 0, '2016-09-25 13:03:17', '', '877908'),
(1105, 'alexwettstein', 'alexandre1@me.com', 'alexwettstein', '$P$DaYEBZVsLtrvbFQLu1u9JEme7BIha41', NULL, 'Mr', 'Alexandre', '', 'Wettstein', 'Jalan Sriwedari 6', 'Taman kaja', '', 'Di depan Warung Balé ada gang kecil, masuk dalam, belok kanan ada nomor 2. Lurus 20 meter, rumah merah mudah, ada lampu ijo, dans anjin Beagle namanya Tara', '81246175725', 1, '0000-00-00 00:00:00', '', '2016-09-25 13:09:31', 0, '2016-09-25 13:09:31', '', '438450'),
(1106, 'Sam', 'Salgar93@yahoo.co.uk', 'salgar93@yahoo.co.uk', '$P$D518NfIE.lCc9ZBBlBfiLG8hE375Ww1', NULL, 'Ms', 'Samantha', '', 'Algar', 'Jalan raya Sayan. Gang puskesmas ubud 2', '', '', 'Cars cannot fit down the drive, if you ring the number we will come and collect.', '82147806858', 1, '0000-00-00 00:00:00', '', '2016-09-26 12:04:28', 0, '2016-09-26 12:04:28', '', '186909'),
(1107, 'Alix Poupart', 'alice.poupart@live.fr', 'Alix', '$P$DGPhIqa.MwovqsWzkP4jeJMevWM3up.', NULL, 'Ms', 'Alix', '', 'Poupart', 'Jalan Jembawan no.20B', '', '', 'House with small garden at front. \nWhite door with the number 20 B on it.\nWhite pick up car at the front.', '82145896755', 1, '0000-00-00 00:00:00', '', '2016-09-27 09:39:14', 0, '2016-09-27 09:39:14', '', '556074'),
(1108, 'Kelly Bryant', 'brekel@y7mail.com', 'Kelly', '$P$D38SaE7SMLJ6VaRxYkbDJj4t5HcCeA/', NULL, '', 'Kelly', '', 'Bryant', 'Tirta Tawar', '', '', 'If you ring when you get to AA Laundry i will come up and meet you as i am the steep driveway next to it and there is no house number to give.', '81239786079', 1, '0000-00-00 00:00:00', '', '2016-09-27 11:20:11', 0, '2016-09-27 11:20:11', '', '923265'),
(1109, 'Sinisa Krisan', 'sinisa@suburbans.org', 'sinisakrisan', '$P$DEfoBBEOqiOZrrlXNVmzEML9Fbv2Qf0', NULL, 'Mr', 'Sinisa', '', 'Krisan', 'jl. Pengosekan', '', '', '', '81337349726', 1, '0000-00-00 00:00:00', '', '2016-09-28 08:18:09', 0, '2016-10-06 10:03:47', '', ''),
(1110, 'Widya', 'christanti.kusuma@gmail.com', 'Tanti', '$P$DtyWE6Rb/me8JVH4dejO7fQolQvcGu0', NULL, 'Mrs', 'Widya', 'Christanti', 'Kusumaningtyas', 'Jl. Ubud Raya No', '', '', 'in front of Breadlife and Bisama Spa', '81380851899', 1, '0000-00-00 00:00:00', '', '2016-09-29 05:14:01', 0, '2016-09-29 05:14:01', '', '465575'),
(1111, 'Caleb', 'calebcru93@gmail.com', 'calebcruz', '$P$D.7E4s8GpbE.OS0YeEi2BzhjSlUkKL0', NULL, 'Mr', 'Caleb', '', 'Cruz', 'Gg. Nuri No.28, Peliatan, Ubud, Gianyar, Bali 80571', '', '', 'We are staying in Gusti Putu Oka homestay. Sometimes my phone doesn''t work. If this happens, please call 08123689190 which is the phone number for homestay', '82237958025', 1, '0000-00-00 00:00:00', '', '2016-10-02 09:11:50', 0, '2016-10-02 09:11:50', '', '530315'),
(1121, 'Bayu Kurniawan', 'baycorephotography@gmail.com', 'baycore', '$P$DibEgMqzm2b9VtgczD3uC9EsVItfSZ0', '', 'Mr', 'Bayu', '', 'Kurniawan', 'Jalan Danau Beratan Gang VI No 5 Sanur Denpasar', '', 'Ubud, Bali', 'Depan Br. Buruwan ya', '085737309066', 1, '2016-11-01 11:50:41', '', '2016-10-31 16:08:03', 0, '2016-10-31 16:29:32', 'customer,1121', ''),
(1122, 'Agung', 'technologiacreativa@gmail.com', 'agung', '$P$DJ5uPXdsAEV2vqhDl6g4TWSQo4M6XB0', '', 'Mr', 'Agung', '', 'Prad', 'Tabanan', '', 'Ubud, Bali', '', '08573730906', 1, '2016-10-31 16:18:00', '', '2016-10-31 16:17:38', 0, '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cr_fonts`
--

CREATE TABLE `cr_fonts` (
  `cr_fontsID` int(11) NOT NULL,
  `cr_fontsName` varchar(100) NOT NULL,
  `cr_fontsLink` varchar(255) NOT NULL,
  `cr_fontsFamily` varchar(100) NOT NULL,
  `cr_fontsApplied` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cr_footer`
--

CREATE TABLE `cr_footer` (
  `cr_footerID` int(11) NOT NULL,
  `cr_footerName` varchar(200) NOT NULL,
  `cr_footerType` varchar(100) NOT NULL,
  `cr_footerTitle` varchar(200) NOT NULL,
  `cr_footerContent` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_footer`
--

INSERT INTO `cr_footer` (`cr_footerID`, `cr_footerName`, `cr_footerType`, `cr_footerTitle`, `cr_footerContent`) VALUES
(1, 'footer-column1', 'customtext', 'WHO WE ARE', '<p>Magnis modipsae voloratati andigen daepeditem quiate re porem que aut labor. Laceaque eictemperum quiae sitiorem rest non restibusaes maio es dem tumquam.</p>\r\n'),
(2, 'footer-column2', 'blog', 'Gggg', 'm1,0,3'),
(3, 'footer-column3', 'gallery', 'Gallery', '8'),
(4, 'footer-column4', 'instafeed', 'My Instagram', '8');

-- --------------------------------------------------------

--
-- Table structure for table `cr_gallery`
--

CREATE TABLE `cr_gallery` (
  `cr_galleryID` int(11) NOT NULL,
  `cr_galleryTitle` varchar(255) NOT NULL,
  `cr_galleryDesc` text NOT NULL,
  `cr_galleryDate` datetime NOT NULL,
  `cr_galleryThumb` varchar(255) NOT NULL,
  `cr_galleryLink` varchar(255) NOT NULL,
  `cr_galleryOrder` int(11) NOT NULL,
  `cr_adminID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cr_general`
--

CREATE TABLE `cr_general` (
  `cr_generalID` int(11) NOT NULL,
  `cr_generalTitle` varchar(100) NOT NULL,
  `cr_generalColumn1` text NOT NULL,
  `cr_generalColumn2` text NOT NULL,
  `cr_generalColumn3` text NOT NULL,
  `cr_generalFeaturedImage` varchar(255) DEFAULT NULL,
  `cr_generalMetaKeywords` text NOT NULL,
  `cr_generalMetaDescription` text NOT NULL,
  `cr_generalPostdate` datetime NOT NULL,
  `cr_generalModifieddate` datetime NOT NULL,
  `cr_generalLink` varchar(100) NOT NULL,
  `cr_adminID` int(11) NOT NULL,
  `cr_generalTitle_id` varchar(100) NOT NULL,
  `cr_generalColumn1_id` text NOT NULL,
  `cr_generalColumn2_id` text NOT NULL,
  `cr_generalColumn3_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_general`
--

INSERT INTO `cr_general` (`cr_generalID`, `cr_generalTitle`, `cr_generalColumn1`, `cr_generalColumn2`, `cr_generalColumn3`, `cr_generalFeaturedImage`, `cr_generalMetaKeywords`, `cr_generalMetaDescription`, `cr_generalPostdate`, `cr_generalModifieddate`, `cr_generalLink`, `cr_adminID`, `cr_generalTitle_id`, `cr_generalColumn1_id`, `cr_generalColumn2_id`, `cr_generalColumn3_id`) VALUES
(2, 'Our Deli', '<div class="btgrid">\r\n<div class="row row-1">\r\n<div class="col-md-8">\r\n<div class="content">\r\n<p><big>As an extension to the side of Pizza Bagus you can now enjoy a deli gourmet shop, probably the first of its kind in Ubud. Here you will find the finest imported delights, like cheese and meet cold cuts that can be be sliced to your requirements at any time. A choice of delicious breads, fresh baked every morning, are also available so you can build your own mouthwatering sandwich or panino (like we call it in Italy) for breakfast, lunch, dinner or just a snack in between.</big></p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-md-4">\r\n<div class="content">\r\n<p><img alt="" src="/pizzabagus/cr-editor/images/deli-Ubud.jpg" style="width:100%" /></p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="row row-2">\r\n<div class="col-md-4">\r\n<div class="content">\r\n<p><img alt="" src="/pizzabagus/cr-editor/images/Deli-in-Ubud-imported-cheese.jpg" style="width:100%" /></p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-md-8">\r\n<div class="content">\r\n<p><big>Check out all of our tasty offerings and choose from the following imported favorites that you can eat in or take away. French and Italian Cheeses Take your pick from....camembert, roquefort, gorgonzola, grana padano, fontina, fresh mozzarella, asiago, scamorza affumicata and more.</big></p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="row row-3">\r\n<div class="col-md-8">\r\n<div class="content">\r\n<p><big>Choose from the best gourmet meat lovers choices like hungarian salami, veneto salami, soppressa, mortadella, prosciutto crudo, prosciutto cotto, ham, smoked turkey, forest ham, sausages and others.</big></p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-md-4">\r\n<div class="content">\r\n<p><img alt="" src="/pizzabagus/cr-editor/images/Deli-cold-cut-meat-range.jpg" style="width:100%" /></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n', '', '', NULL, 'pizza bagus, deli, ubud, pizza, cheese', '', '2016-10-07 14:50:37', '2016-10-26 16:39:47', 'our-deli', 1, 'Deli Kami', '<div class="btgrid">\r\n<div class="row row-1">\r\n<div class="col-md-8">\r\n<div class="content">\r\n<p><big>Sebagai perpanjangan ke sisi Pizza Bagus Anda sekarang dapat menikmati gourmet toko deli, mungkin yang pertama dari jenisnya di Ubud. Di sini Anda akan menemukan kelezatan terbaik yang diimpor, seperti keju dan memenuhi dingin pemotongan yang dapat diiris dengan kebutuhan Anda setiap saat. Sebuah pilihan roti yang lezat, segar dipanggang setiap pagi, juga tersedia sehingga Anda dapat membangun sandwich yang lezat Anda sendiri atau panino (seperti kita menyebutnya di Italia) untuk sarapan, makan siang, makan malam atau hanya makanan ringan di antara.</big></p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-md-4">\r\n<div class="content">\r\n<p><img alt="" src="/pizzabagus/cr-editor/images/deli-Ubud.jpg" style="width:100%" /></p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="row row-2">\r\n<div class="col-md-4">\r\n<div class="content">\r\n<p><img alt="" src="/pizzabagus/cr-editor/images/Deli-in-Ubud-imported-cheese.jpg" style="width:100%" /></p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-md-8">\r\n<div class="content">\r\n<p><big>Memeriksa semua persembahan lezat kami dan memilih dari favorit diimpor berikut yang Anda dapat makan di atau mengambil. Prancis dan Italia Keju Pilihlah dari .... camembert, roquefort, gorgonzola, grana padano, fontina, mozzarella segar, asiago, scamorza affumicata dan banyak lagi.</big></p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="row row-3">\r\n<div class="col-md-8">\r\n<div class="content">\r\n<p><big>Pilih dari yang terbaik pecinta daging gourmet pilihan seperti salami Hongaria, veneto salami, sopressa, mortadella, prosciutto crudo, prosciutto Cotta, ham, kalkun asap, ham hutan, sosis dan lain-lain.</big></p>\r\n</div>\r\n</div>\r\n\r\n<div class="col-md-4">\r\n<div class="content">\r\n<p><img alt="" src="/pizzabagus/cr-editor/images/Deli-cold-cut-meat-range.jpg" style="width:100%" /></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n', '', ''),
(3, 'Delivery Area', '<p><iframe height="600" src="https://www.google.com/maps/d/u/0/embed?mid=1JFYjlSvx4jTy7yMGz3lzQWaU9Uk" width="100%"></iframe></p>\r\n', '', '', NULL, '', '', '2016-10-07 15:04:31', '2016-10-26 16:49:36', 'delivery-area', 1, 'Daerah Pengiriman', '<iframe src="https://www.google.com/maps/d/u/0/embed?mid=1JFYjlSvx4jTy7yMGz3lzQWaU9Uk" width="100%" height="600"></iframe>', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cr_history`
--

CREATE TABLE `cr_history` (
  `cr_historyID` int(11) NOT NULL,
  `cr_historyTitle` varchar(200) NOT NULL,
  `cr_historyDetail` text NOT NULL,
  `cr_historyDateTime` datetime NOT NULL,
  `cr_adminID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_history`
--

INSERT INTO `cr_history` (`cr_historyID`, `cr_historyTitle`, `cr_historyDetail`, `cr_historyDateTime`, `cr_adminID`) VALUES
(1, 'Add Menu', ' add menu Asdasd (Publish) to your website.', '2016-10-03 11:27:56', 1),
(2, 'Add Blog Category', ' add Ssdsd in blog category.', '2016-10-03 11:28:49', 1),
(3, 'Add New Post', ' add new post(Standard, Publish) in  category.', '2016-10-03 11:32:49', 1),
(4, 'Edit Administrator', ' edit Baycore''s profile data.', '2016-10-03 12:37:31', 1),
(5, 'Edit Administrator', ' edit Baycoretech''s profile data.', '2016-10-03 12:38:55', 1),
(6, 'Change Website Theme', ' change website theme to REEN.', '2016-10-03 14:38:14', 1),
(7, 'Change Website Theme', ' change website theme to The Project.', '2016-10-03 14:39:12', 1),
(8, 'Edit Menu', ' edit menu Blog (Publish).', '2016-10-03 14:39:58', 1),
(9, 'Add Menu', ' add menu Portfolio (Publish) to your website.', '2016-10-03 14:46:36', 1),
(10, 'Add Menu', ' add menu About Us (Publish) to your website.', '2016-10-03 14:47:14', 1),
(11, 'Add Menu', ' add menu Contact Us (Publish) to your website.', '2016-10-03 14:47:35', 1),
(12, 'Add Menu', ' add menu Gallery (Publish) to your website.', '2016-10-03 14:48:01', 1),
(13, 'Edit Blog Category', ' edit blog category from Ssdsd to Identity.', '2016-10-03 14:48:42', 1),
(14, 'Edit Blog', ' edit Learn How To Successfully Design Brand Identities (Publish) in Identity category.', '2016-10-03 14:49:20', 1),
(15, 'Add Portfolio  Category', ' add Graphic Design in portfolio category.', '2016-10-03 14:50:00', 1),
(16, 'Add New Media', ' upload b47613f9a6ef579141323e7411e19a19.jpg as a new media.', '2016-10-03 14:52:03', 1),
(17, 'Add Portfolio', ' add Fresh Branding For A Creative Startup (Publish) as a new portfolio in Graphic Design category.', '2016-10-03 14:52:16', 1),
(18, 'Add Contact Information', ' add contact information in page Contact Us.', '2016-10-03 14:52:41', 1),
(19, 'Add Data to Page About Us', ' add data to page About Us.', '2016-10-03 14:54:51', 1),
(20, 'Edit Data in Page About Us', ' edit data in page About Us.', '2016-10-03 14:55:13', 1),
(21, 'Add New Photo in Gallery(Gallery) menu.', ' add Gallery 1 to Gallery(gallery) menu.', '2016-10-03 14:58:14', 1),
(22, 'Add New Extra Content to Portfolio', ' add new extra content to Fresh Branding For A Creative Startup.', '2016-10-03 15:06:07', 1),
(23, 'Add Blog Category', ' add Video in blog category.', '2016-10-03 15:41:15', 1),
(24, 'Add New Post', ' add new post(Video, Publish) in Video category.', '2016-10-03 15:42:04', 1),
(25, 'Edit Blog', ' edit Test Drive Daihatsu Sigra (Publish) in Video category.', '2016-10-03 15:44:09', 1),
(26, 'Add New Post', ' add new post(Image, Publish) in Identity category.', '2016-10-03 15:46:59', 1),
(27, 'Add New Post', ' add new post(Sound, Publish) in Identity category.', '2016-10-03 15:47:37', 1),
(28, 'Add First Column Primary Footer', ' add new data in first column primary footer with custom text type.', '2016-10-03 16:22:25', 1),
(29, 'Add Second Column Primary Footer', ' add new data in second column primary footer with latest blog in specific page.', '2016-10-03 16:28:20', 1),
(30, 'Add Third Column Primary Footer', ' add new data in third column primary footer with latest gallery type.', '2016-10-03 16:28:54', 1),
(31, 'Delete Post', ' delete Hear My Voice in Identity category.', '2016-10-04 11:27:31', 1),
(32, 'Delete Post', ' delete Mockup Design in Identity category.', '2016-10-04 11:27:31', 1),
(33, 'Update Second Column Primary Footer', ' update blogs data for specific page in second column primary footer.', '2016-10-04 11:56:24', 1),
(34, 'Edit Setting Value', ' edit  setting value to b47613f9a6ef579141323e7411e19a19.jpg.', '2016-10-04 12:36:24', 1),
(35, 'Change Website Layout Mode', ' change website layout mode to boxed.', '2016-10-04 12:36:37', 1),
(36, 'Change Website Background Image Option', ' change website background image option.', '2016-10-04 12:40:40', 1),
(37, 'Change Website Background Image Option', ' change website background image option.', '2016-10-04 12:42:34', 1),
(38, 'Update Instafeed User ID and Token', ' change user ID and access token for your Instafeed.', '2016-10-04 12:45:25', 1),
(39, 'Add Fourth Column Primary Footer', ' add new data in fourth column primary footer with instagram feed type.', '2016-10-04 12:45:53', 1),
(40, 'Edit Setting Value', ' edit  setting value to enable.', '2016-10-04 12:47:57', 1),
(41, 'Change Website Theme', ' change website theme to REEN.', '2016-10-04 12:48:24', 1),
(42, 'Change Website Theme', ' change website theme to The Project.', '2016-10-04 13:28:33', 1),
(43, 'Change Website Theme', ' change website theme to REEN.', '2016-10-04 13:45:29', 1),
(44, 'Change Website Theme', ' change website theme to The Project.', '2016-10-04 13:48:42', 1),
(45, 'Reply Post Comment', ' reply comment from Haaa Aaa A.', '2016-10-04 13:52:40', 1),
(46, 'Change Website Theme', ' change website theme to REEN.', '2016-10-04 14:18:36', 1),
(47, 'Change Website Theme', ' change website theme to The Project.', '2016-10-05 11:57:14', 1),
(48, 'Change Website Layout Mode', ' change website layout mode to wide.', '2016-10-05 14:20:00', 1),
(49, 'Edit Footer', ' edit footer data.', '2016-10-05 14:28:00', 1),
(50, 'Edit Administrator', ' edit Roberto''s profile data.', '2016-10-06 10:45:48', 1),
(51, 'Add New Media', ' upload 4b360521f235f6ca5e9a436f2159dcbc.jpg as a new media.', '2016-10-06 10:49:05', 1),
(52, 'Edit Setting Value', ' edit  setting value to 4b360521f235f6ca5e9a436f2159dcbc.jpg.', '2016-10-06 10:49:05', 1),
(53, 'Delete Photo in Gallery(Gallery) menu.', ' delete Gallery 1 in Gallery(gallery) menu.', '2016-10-06 10:52:22', 1),
(54, 'Delete Contact Information', ' delete contact information in page .', '2016-10-06 10:52:37', 1),
(55, 'Delete Portfolio', ' delete Fresh Branding For A Creative Startup in Graphic Design category.', '2016-10-06 10:53:11', 1),
(56, 'Delete Portfolio Category', ' delete Graphic Design in portfolio category.', '2016-10-06 10:53:26', 1),
(57, 'Delete Post', ' delete Test Drive Daihatsu Sigra in Video category.', '2016-10-06 10:53:52', 1),
(58, 'Delete Post', ' delete Learn How To Successfully Design Brand Identities in Identity category.', '2016-10-06 10:53:52', 1),
(59, 'Delete Blog Category', ' delete Video in blog category.', '2016-10-06 10:54:09', 1),
(60, 'Delete Blog Category', ' delete Identity in blog category.', '2016-10-06 10:55:16', 1),
(61, 'Delete Menu', ' delete menu Gallery.', '2016-10-06 10:55:25', 1),
(62, 'Delete Menu', ' delete menu Contact Us.', '2016-10-06 10:55:32', 1),
(63, 'Delete Menu', ' delete menu About Us.', '2016-10-06 10:55:41', 1),
(64, 'Delete Menu', ' delete menu Blog.', '2016-10-06 10:55:48', 1),
(65, 'Delete Menu', ' delete menu Portfolio.', '2016-10-06 10:55:55', 1),
(66, 'Delete Media', ' delete b47613f9a6ef579141323e7411e19a19.jpg from media.', '2016-10-06 10:56:10', 1),
(67, 'Add New Media', ' upload 4476aad35d4d6d8acbe09a504ff50a15.jpg as a new media.', '2016-10-06 11:01:28', 1),
(68, 'Edit Slider Image', ' edit slider image in slider image section.', '2016-10-06 11:01:32', 1),
(69, 'Add New Media', ' upload addcc1e20dc8e61960acf9fe7a59f899.jpg as a new media.', '2016-10-06 11:01:51', 1),
(70, 'Add New Slider Image', ' add new slider image in slider image section', '2016-10-06 11:01:57', 1),
(71, 'Add New Map and Location', ' add new map and location data.', '2016-10-06 11:07:31', 1),
(72, 'Edit Setting Value', ' edit  setting value to AIzaSyC68T-zrmjNmWoFgsjgX2ws7TlR4PV9Nfk.', '2016-10-06 11:08:15', 1),
(73, 'Add Quote', ' add new quote from .Jamie Oliver(Show).', '2016-10-06 11:25:34', 1),
(74, 'Add Quote', ' add new quote from .Mike Elwis(Show).', '2016-10-06 11:26:14', 1),
(75, 'Add Quote', ' add new quote from .John Doe(Show).', '2016-10-06 11:26:49', 1),
(76, 'Edit Setting Value', ' edit  setting value to What They Say.', '2016-10-06 11:27:19', 1),
(77, 'Add New Favicon', ' add new favicon to your website.', '2016-10-06 11:45:59', 1),
(78, 'Add New Website Logo', ' add new logo to your website.', '2016-10-06 11:46:30', 1),
(79, 'Edit Setting Value', ' edit  setting value to Pizza Bagus.', '2016-10-06 11:47:55', 1),
(80, 'Edit Setting Value', ' edit  setting value to Restaurant, Delivery, & Deli.', '2016-10-06 11:48:44', 1),
(81, 'Edit Contact Header', ' edit contact header data.', '2016-10-06 11:55:17', 1),
(82, 'Edit Setting Value', ' edit  setting value to (036) 197-8520.', '2016-10-06 11:55:57', 1),
(83, 'Edit Setting Value', ' edit  setting value to example@mail.com.', '2016-10-06 11:57:18', 1),
(84, 'Add Menu', ' add menu Food (Publish) to your website.', '2016-10-06 12:48:17', 1),
(85, 'Add Menu', ' add menu Drinks (Publish) to your website.', '2016-10-06 12:55:55', 1),
(86, 'Add Menu', ' add menu Contact (Publish) to your website.', '2016-10-06 12:56:22', 1),
(87, 'Add Menu  Category', ' add SIDE DISHES AND STARTERS in menu category.', '2016-10-06 13:10:30', 1),
(88, 'Add Menu  Category', ' add PIZZA in menu category.', '2016-10-06 13:10:42', 1),
(89, 'Add Menu  Category', ' add PASTA in menu category.', '2016-10-06 13:10:47', 1),
(90, 'Add Menu  Category', ' add SALAD in menu category.', '2016-10-06 13:10:57', 1),
(91, 'Add Menu  Category', ' add SANDWICHES in menu category.', '2016-10-06 13:11:10', 1),
(92, 'Add Menu  Category', ' add BEER in menu category.', '2016-10-06 13:13:08', 1),
(93, 'Add Menu  Category', ' add SOFT DRINKS in menu category.', '2016-10-06 13:13:27', 1),
(94, 'Add Menu  Category', ' add OTHER in menu category.', '2016-10-06 13:13:39', 1),
(95, 'Add Menu  Category', ' add INDONESIAN in menu category.', '2016-10-06 13:14:08', 1),
(96, 'Add Menu  Category', ' add DESSERTS in menu category.', '2016-10-06 13:14:53', 1),
(97, 'Edit Menu Category', ' edit menu category from SIDE DISHES AND STARTERS to SIDE DISHES AND STARTERS6.', '2016-10-06 13:19:39', 1),
(98, 'Edit Menu Category', ' edit menu category from SIDE DISHES AND STARTERS6 to SIDE DISHES AND STARTERS.', '2016-10-06 13:19:44', 1),
(99, 'Add Menu  Category', ' add Dsdsd in menu category.', '2016-10-06 13:59:06', 1),
(100, 'Delete Menu Category', ' delete Dsdsd in menu category.', '2016-10-06 14:02:14', 1),
(101, 'Add Menu', ' add Sample Pizza 1 (Publish) as a new menu in PIZZA category.', '2016-10-06 16:12:43', 1),
(102, 'Add Menu', ' add Sample Pizza 2 (Publish) as a new menu in PIZZA category.', '2016-10-06 16:19:38', 1),
(103, 'Add Menu', ' add Sample Spaghetti 1 (Publish) as a new menu in PASTA category.', '2016-10-06 16:26:50', 1),
(104, 'Edit Menu', ' edit Sample Spaghetti 1 (Publish) in PASTA category.', '2016-10-07 12:07:12', 1),
(105, 'Add New Font', ' add Engagement to font list.', '2016-10-07 12:10:08', 1),
(106, 'Set Menu as Special Menu', ' edit menu as special ourmenu.', '2016-10-07 12:17:49', 1),
(107, 'Edit Font', ' edit Engagement in font list.', '2016-10-07 12:25:07', 1),
(108, 'Edit Setting Value', ' edit  setting value to What They Say.', '2016-10-07 12:58:43', 1),
(109, 'Edit Setting Value', ' edit  setting value to food.', '2016-10-07 12:58:43', 1),
(110, 'Add Menu', ' add menu Location (Publish) to your website.', '2016-10-07 14:41:19', 1),
(111, 'Add Submenu', ' add submenu Our Deli (Publish) under Location to your website.', '2016-10-07 14:41:49', 1),
(112, 'Add Data to Page ', ' add data to page .', '2016-10-07 14:50:37', 1),
(113, 'Edit Data in Page Our Deli', ' edit data in page Our Deli.', '2016-10-07 14:55:29', 1),
(114, 'Edit Data in Page Our Deli', ' edit data in page Our Deli.', '2016-10-07 14:56:54', 1),
(115, 'Add Submenu', ' add submenu Delivery Area (Publish) under Location to your website.', '2016-10-07 15:03:31', 1),
(116, 'Add Data to Page ', ' add data to page .', '2016-10-07 15:04:31', 1),
(117, 'Edit Setting Value', ' edit  setting value to 08:00.', '2016-10-07 15:38:32', 1),
(118, 'Edit Setting Value', ' edit  setting value to 18:30.', '2016-10-07 15:38:32', 1),
(119, 'Edit Setting Value', ' edit  setting value to 17:00.', '2016-10-07 15:39:58', 1),
(120, 'Edit Setting Value', ' edit  setting value to 08:30.', '2016-10-07 15:39:58', 1),
(121, 'Edit Setting Value', ' edit  setting value to 11:00.', '2016-10-07 15:46:24', 1),
(122, 'Edit Setting Value', ' edit  setting value to 08:30.', '2016-10-07 15:46:24', 1),
(123, 'Edit Setting Value', ' edit  setting value to 11:00.', '2016-10-07 15:46:41', 1),
(124, 'Edit Setting Value', ' edit  setting value to 08:30.', '2016-10-07 15:46:41', 1),
(125, 'Edit Setting Value', ' edit  setting value to 18:00.', '2016-10-07 15:47:04', 1),
(126, 'Edit Setting Value', ' edit  setting value to 08:30.', '2016-10-07 15:47:04', 1),
(127, 'Add Menu', ' add Beer Bintang Small (Publish) as a new menu in BEER category.', '2016-10-07 15:54:57', 1),
(128, 'Add Menu', ' add Fanta Strawberry (Publish) as a new menu in SOFT DRINKS category.', '2016-10-07 15:56:02', 1),
(129, 'Edit Menu', ' edit Beer Bintang Small (Publish) in BEER category.', '2016-10-07 15:56:22', 1),
(130, 'Edit Setting Value', ' edit  setting value to 12:00.', '2016-10-07 16:03:48', 1),
(131, 'Edit Setting Value', ' edit  setting value to 08:30.', '2016-10-07 16:03:48', 1),
(132, 'Edit Data in Page Delivery Area', ' edit data in page Delivery Area.', '2016-10-07 16:13:32', 1),
(133, 'Edit Setting Value', ' edit  setting value to 18:00.', '2016-10-10 11:57:55', 1),
(134, 'Edit Setting Value', ' edit  setting value to 08:30.', '2016-10-10 11:57:55', 1),
(135, 'Add Menu', ' add menu News (Publish) to your website.', '2016-10-10 12:00:14', 1),
(136, 'Add Additional Toppings', ' add Bacon in additional toppings.', '2016-10-10 16:16:01', 1),
(137, 'Add Additional Toppings', ' add Bacon in additional toppings.', '2016-10-10 16:19:11', 1),
(138, 'Add Additional Toppings', ' add Double Mozarella in additional toppings.', '2016-10-10 16:30:37', 1),
(139, 'Add Additional Toppings', ' add Jalapeno in additional toppings.', '2016-10-10 16:31:32', 1),
(140, 'Add Additional Toppings', ' add Shrimp in additional toppings.', '2016-10-10 16:32:20', 1),
(141, 'Add Additional Toppings', ' add Chicken in additional toppings.', '2016-10-10 16:35:31', 1),
(142, 'Edit Additional Toppings', ' edit additional toppings from Double Mozarella to Double Mozarella.', '2016-10-11 13:04:44', 1),
(143, 'Edit Additional Toppings', ' edit additional toppings from Double Mozarella to Double Mozarella.', '2016-10-11 13:05:39', 1),
(144, 'Edit Additional Toppings', ' edit additional toppings from Double Mozarella to Double Mozarella.', '2016-10-11 13:08:57', 1),
(145, 'Edit Additional Toppings', ' edit additional toppings from Bacon to Bacon.', '2016-10-11 13:09:38', 1),
(146, 'Delete Additional Toppings', ' delete Jalapeno in additional toppings.', '2016-10-11 13:13:09', 1),
(147, 'Delete Additional Toppings', ' delete Chicken in additional toppings.', '2016-10-11 13:13:45', 1),
(148, 'Add Menu', ' add Vegetable Sandwich (Publish) as a new menu in SANDWICHES category.', '2016-10-11 13:33:31', 1),
(149, 'Add Additional Toppings', ' add Chicken in additional toppings.', '2016-10-11 13:55:11', 1),
(150, 'Delete Customer', ' delete Bayu Kurniawan from customers data.', '2016-10-20 11:26:28', 1),
(151, 'Edit Administrator', ' edit Bayu Kw''s profile data.', '2016-10-20 13:56:28', 1),
(152, 'Delete Font', ' delete Engagement from font list.', '2016-10-20 16:26:18', 1),
(153, 'Change Invoice Status', ' change invoice status(00027) from unpaid to paid.', '2016-10-21 12:48:15', 1),
(154, 'Change Invoice Delivery Status', ' change invoice delivery status(00027) from on process to delivered.', '2016-10-21 13:05:08', 1),
(155, 'Add Additional Toppings', ' add Test in additional toppings.', '2016-10-21 14:26:49', 1),
(156, 'Edit Setting Value', ' edit  setting value to 14:00.', '2016-10-21 14:39:06', 1),
(157, 'Edit Setting Value', ' edit  setting value to 08:30.', '2016-10-21 14:39:06', 1),
(158, 'Delete Invoice', ' delete invoice #00029 from invoice data.', '2016-10-21 15:08:18', 1),
(159, 'Edit Menu', ' edit Vegetable Sandwich (Publish) in SANDWICHES category.', '2016-10-21 16:12:17', 1),
(160, 'Edit Additional Toppings', ' edit additional toppings from Chicken to Chicken.', '2016-10-21 16:29:11', 1),
(161, 'Edit Additional Toppings', ' edit additional toppings from Test to Test.', '2016-10-21 16:30:37', 1),
(162, 'Add Additional Toppings', ' add Chicken in additional toppings.', '2016-10-21 16:34:53', 1),
(163, 'Edit Additional Toppings', ' edit additional toppings from Bacon to Bacon.', '2016-10-21 16:37:03', 1),
(164, 'Edit Additional Toppings', ' edit additional toppings from Shrimp to Shrimp.', '2016-10-21 16:37:23', 1),
(165, 'Edit Setting Value', ' edit  setting value to 18:00.', '2016-10-21 16:42:55', 1),
(166, 'Edit Setting Value', ' edit  setting value to 08:30.', '2016-10-21 16:42:55', 1),
(167, 'Edit Menu', ' edit Vegetable Sandwich (Publish) in SANDWICHES category.', '2016-10-24 13:13:55', 1),
(168, 'Edit Menu', ' edit Vegetable Sandwich (Publish) in SANDWICHES category.', '2016-10-24 13:17:48', 1),
(169, 'Set Menu as Special Menu', ' edit menu as special ourmenu.', '2016-10-24 13:48:19', 1),
(170, 'Edit Menu', ' edit Sample Pizza 2 (Publish) in PIZZA category.', '2016-10-24 14:09:56', 1),
(171, 'Add Menu', ' add Vegie Food (Publish) as a new menu in SALAD category.', '2016-10-24 14:46:41', 1),
(172, 'Edit Menu', ' edit Sample Spaghetti 1 (Publish) in PASTA category.', '2016-10-24 15:01:01', 1),
(173, 'Edit Setting Value', ' edit  setting value to 12:00.', '2016-10-24 15:35:06', 1),
(174, 'Edit Setting Value', ' edit  setting value to 08:30.', '2016-10-24 15:35:06', 1),
(175, 'Edit Setting Value', ' edit  setting value to 18:00.', '2016-10-24 16:09:29', 1),
(176, 'Edit Setting Value', ' edit  setting value to 08:30.', '2016-10-24 16:09:29', 1),
(177, 'Add Menu', ' add menu Wawe En (Publish) to your website.', '2016-10-25 16:28:32', 1),
(178, 'Edit Menu', ' edit menu Wawe English (Publish).', '2016-10-25 16:42:11', 1),
(179, 'Add Custom Link', ' add custom link <a href=''https://fonts.googleapis.com/css?family=Engagement'' target=''_blank''></a> () to your website.', '2016-10-25 16:47:07', 1),
(180, 'Edit Custom Link', ' edit custom link <a href=''https://fonts.googleapis.com/css?family=Engagement'' target=''_blank''>Hjkddfg</a> (Publish).', '2016-10-25 16:48:59', 1),
(181, 'Delete Menu', ' delete menu .', '2016-10-26 11:10:58', 1),
(182, 'Delete Menu', ' delete menu Wawe English.', '2016-10-26 11:11:30', 1),
(183, 'Edit Setting Value', ' edit  setting value to <p>No online payment!. Payments are made with cash when your order arrive at your location. Prices are inclusive of 10% government tax. asdasd</p>\r\n.', '2016-10-26 12:21:52', 1),
(184, 'Edit Setting Value', ' edit  setting value to <p>No online payment!. Payments are made with cash when your order arrive at your location. Prices are inclusive of 10% government tax.</p>\r\n.', '2016-10-26 12:22:18', 1),
(185, 'Edit Setting Value', ' edit  setting value to <p>Tidak ada pembayaran online!. Pembayaran tunai saat pesanan anda sampai di tempat anda. Harga sudah termasuk pajak sebesar 10%. asd</p>\r\n.', '2016-10-26 12:23:18', 1),
(186, 'Edit Setting Value', ' edit  setting value to <p>No online payment!. Payments are made with cash when your order arrive at your location. Prices are inclusive of 10% government tax. asdasdasd</p>\r\n.', '2016-10-26 12:35:55', 1),
(187, 'Edit Setting Value', ' edit  setting value to <p>Tidak ada pembayaran online!. Pembayaran tunai saat pesanan anda sampai di tempat anda. Harga sudah termasuk pajak sebesar 10%. asdaaawwww</p>\r\n.', '2016-10-26 12:35:55', 1),
(188, 'Edit Setting Value', ' edit  setting value to <p>No online payment!. Payments are made with cash when your order arrive at your location. Prices are inclusive of 10% government tax.</p>\r\n.', '2016-10-26 12:36:32', 1),
(189, 'Edit Setting Value', ' edit  setting value to <p>Tidak ada pembayaran online!. Pembayaran tunai saat pesanan anda sampai di tempat anda. Harga sudah termasuk pajak sebesar 10%.</p>\r\n.', '2016-10-26 12:36:32', 1),
(190, 'Edit Setting Value', ' edit  setting value to <p><strong>DELIVERY TIMES</strong><br />\r\nBusiness Hours are Between 9:00 and 22:00. Orders received after 22:00 will not be processed.</p>\r\n\r\n<p><strong>DELIVERY AREA</strong><br />\r\nWe deliver only in the Ubud Area. If your delivery address is outside of the Ubud area, your order will not be processed. Click here to view a map of our coverage area.</p>\r\n\r\n<p><strong>PRICES</strong><br />\r\nPrices are subject to change without prior notification. There may be a short delay between price changes and website updates. Order modifications In &quot;Notes and Special Requests&quot; may also effect prices. In the event that the final bill on delivery is different from the total on checkout, you will be responsible to pay the full amount due on delivery.</p>\r\n.', '2016-10-26 12:53:43', 1),
(191, 'Edit Setting Value', ' edit  setting value to <p><strong>WAKTU PENGIRIMAN</strong><br />\r\nJam bisnis antara 09:00 dan 22:00. Pesanan yang diterima setelah pukul 22:00 tidak akan diproses.</p>\r\n\r\n<p><strong>AREA PENGIRIMAN</strong><br />\r\nKami mengirim pesanan hanya di daerah Ubud. Jika alamat pengiriman Anda berada di luar daerah Ubud, pesanan Anda tidak akan diproses. Klik di sini untuk melihat peta wilayah cakupan kami.</p>\r\n\r\n<p><strong>HARGA</strong><br />\r\nHarga dapat berubah tanpa pemberitahuan terlebih dahulu. Mungkin ada penundaan singkat antara perubahan harga dan update website. permintaan dalam &quot;Catatan dan Permintaan Khusus&quot; juga dapat mempengaruhi harga. Dalam hal tagihan akhir pengiriman berbeda dari total pada checkout, Anda akan bertanggung jawab untuk membayar jumlah penuh pada tagihan pengiriman.</p>\r\n.', '2016-10-26 12:53:43', 1),
(192, 'Edit Setting Value', ' edit  setting value to <h3>HISTORY OF OUR PIZZERIA &amp; ITALIAN FOOD RESTAURANT IN UBUD BALI</h3>\r\n\r\n<p>Proudly known today as a Pizzeria, Gelateria and Ristorante Italiano, Pizza Bagus was established in 1996 as a tiny kitchen for providing a pasta and pizza delivery service in the periphery of Ubud, Bali. It soon became very popular thanks to the fine Italian food recipes from our Neapolitan chef and his ability to bring to the table the real flavor and taste of Italian cuisine.</p>\r\n\r\n<p>After a few years of hard work to overcome the difficulties of the economic crisis that hit Indonesia in 1998, Pizza Bagus moved to a new location closer to the center of Ubud. This time with the addition of a little dining room and a larger selection of delicious Italian pasta, pizzas and great espresso coffee that brought even more popularity to the still very small &quot;Italian restaurant&quot;.</p>\r\n\r\n<p>With a growing reputation that had customers constantly coming back for more, in 2003 Pizza Bagus was forced to move location again due to lack of space. Now located in the Pengosekan area, Pizza Bagus offers you a large space to come with friends, family and children, to enjoy Italian specialties and a final Italian touch, traditional Italian gelato in many different flavors.</p>\r\n\r\n<p>Through growing ever more popular over the years, it has now become a meeting place for the Italian community living in Ubud, travelers, business people from all over the world and local people. Finally it can be said that Pizza Bagus has succeeded in literally bringing a piece of Italy to Ubud.</p>\r\n\r\n<p>If you are in Bali and are looking to enjoy an authentic Italian meal in friendly surroundings please be sure to pay us a visit in Ubud. We look forward to meeting you! Ciao!</p>\r\n.', '2016-10-26 14:30:28', 1),
(193, 'Edit Setting Value', ' edit  setting value to <h3>SEJARAH PIZZERIA KAMI &amp; RESTORAN MAKANAN ITALIA&nbsp;DI UBUD BALI</h3>\r\n\r\n<p>Bangga dikenal sebagai Pizzeria, Gelateria dan Ristorante Italiano, Pizza Bagus didirikan pada tahun 1996 sebagai dapur kecil untuk menyediakan layanan pengiriman pasta dan pizza di Ubud, Bali. Segera menjadi sangat populer untuk resep makanan Italia dari koki Neapolitan dan kemampuannya untuk menyajikan rasa yang nyata dan rasa masakan Italia.</p>\r\n\r\n<p>Setelah beberapa tahun kerja keras untuk mengatasi kesulitan dari krisis ekonomi yang melanda Indonesia pada tahun 1998, Pizza Bagus pindah ke lokasi baru yang lebih dekat ke pusat Ubud. kali ini dengan penambahan ruang makan kecil dan pilihan yang lebih besar dari pasta yang lezat, pizza dan kopi espresso besar yang membawa popularitas lebih ke &quot;restoran Italia&quot; yang masih sangat kecil.</p>\r\n\r\n<p>Dengan perkembangan reputasi yang membuat pelanggan terus datang kembali, pada tahun 2003 Pizza Bagus terpaksa pindah lokasi lagi karena kurangnya ruang. Sekarang terletak di daerah Pengosekan, Pizza Bagus menawarkan ruang yang besar untuk datang dengan teman-teman, keluarga dan anak-anak, untuk menikmati masakan khas Italia dan sentuhan Italia, gelato Italia tradisional dalam berbagai rasa yang berbeda.</p>\r\n\r\n<p>Dengan tumbuh semakin populer selama bertahun-tahun, sekarang telah menjadi tempat pertemuan bagi masyarakat Italia yang tinggal di Ubud, wisatawan, orang-orang bisnis dari seluruh dunia dan orang-orang lokal. Akhirnya dapat dikatakan bahwa Pizza Bagus telah berhasil membawa sepotong Italia ke Ubud.</p>\r\n\r\n<p>Jika Anda berada di Bali dan ingin menikmati makanan Italia yang otentik dalam lingkungan yang ramah pastikan untuk mengunjungi kami di Ubud. Kami berharap untuk bertemu Anda! Ciao!</p>\r\n.', '2016-10-26 14:30:28', 1),
(194, 'Edit Setting Value', ' edit  setting value to <h3>HISTORY OF OUR PIZZERIA &amp; ITALIAN FOOD RESTAURANT IN UBUD BALI</h3>\r\n\r\n<p>Proudly known today as a Pizzeria, Gelateria and Ristorante Italiano, Pizza Bagus was established in 1996 as a tiny kitchen for providing a pasta and pizza delivery service in the periphery of Ubud, Bali. It soon became very popular thanks to the fine Italian food recipes from our Neapolitan chef and his ability to bring to the table the real flavor and taste of Italian cuisine.</p>\r\n\r\n<p>After a few years of hard work to overcome the difficulties of the economic crisis that hit Indonesia in 1998, Pizza Bagus moved to a new location closer to the center of Ubud. This time with the addition of a little dining room and a larger selection of delicious Italian pasta, pizzas and great espresso coffee that brought even more popularity to the still very small &quot;Italian restaurant&quot;.</p>\r\n\r\n<p>With a growing reputation that had customers constantly coming back for more, in 2003 Pizza Bagus was forced to move location again due to lack of space. Now located in the Pengosekan area, Pizza Bagus offers you a large space to come with friends, family and children, to enjoy Italian specialties and a final Italian touch, traditional Italian gelato in many different flavors.</p>\r\n\r\n<p>Through growing ever more popular over the years, it has now become a meeting place for the Italian community living in Ubud, travelers, business people from all over the world and local people. Finally it can be said that Pizza Bagus has succeeded in literally bringing a piece of Italy to Ubud.</p>\r\n\r\n<p>If you are in Bali and are looking to enjoy an authentic Italian meal in friendly surroundings please be sure to pay us a visit in Ubud. We look forward to meeting you! Ciao!</p>\r\n.', '2016-10-26 14:30:53', 1),
(195, 'Edit Setting Value', ' edit  setting value to <h3>SEJARAH PIZZERIA KAMI &amp; RESTORAN MAKANAN ITALIA&nbsp;DI UBUD BALI</h3>\r\n\r\n<p>Bangga dikenal sebagai Pizzeria, Gelateria dan Ristorante Italiano, Pizza Bagus didirikan pada tahun 1996 sebagai dapur kecil untuk menyediakan layanan pengiriman pasta dan pizza di Ubud, Bali. Segera menjadi sangat populer untuk resep makanan Italia dari koki Neapolitan dan kemampuannya untuk menyajikan rasa yang nyata dan rasa masakan Italia.</p>\r\n\r\n<p>Setelah beberapa tahun kerja keras untuk mengatasi kesulitan dari krisis ekonomi yang melanda Indonesia pada tahun 1998, Pizza Bagus pindah ke lokasi baru yang lebih dekat ke pusat Ubud. kali ini dengan penambahan ruang makan kecil dan pilihan yang lebih besar dari pasta yang lezat, pizza dan kopi espresso besar yang membawa popularitas lebih ke &quot;restoran Italia&quot; yang masih sangat kecil.</p>\r\n\r\n<p>Dengan perkembangan reputasi yang membuat pelanggan terus datang kembali, pada tahun 2003 Pizza Bagus terpaksa pindah lokasi lagi karena kurangnya ruang. Sekarang terletak di daerah Pengosekan, Pizza Bagus menawarkan ruang yang besar untuk datang dengan teman-teman, keluarga dan anak-anak, untuk menikmati masakan khas Italia dan sentuhan Italia, gelato Italia tradisional dalam berbagai rasa yang berbeda.</p>\r\n\r\n<p>Dengan tumbuh semakin populer selama bertahun-tahun, sekarang telah menjadi tempat pertemuan bagi masyarakat Italia yang tinggal di Ubud, wisatawan, orang-orang bisnis dari seluruh dunia dan orang-orang lokal. Akhirnya dapat dikatakan bahwa Pizza Bagus telah berhasil membawa sepotong Italia ke Ubud.</p>\r\n\r\n<p>Jika Anda berada di Bali dan ingin menikmati makanan Italia yang otentik dalam lingkungan yang ramah pastikan untuk mengunjungi kami di Ubud. Kami berharap untuk bertemu Anda! Ciao!</p>\r\n.', '2016-10-26 14:30:53', 1),
(196, 'Edit Setting Value', ' edit  setting value to 0361978520.', '2016-10-26 14:43:19', 1),
(197, 'Edit Setting Value', ' edit  setting value to <p><strong>DELIVERY TIMES</strong><br />\r\nBusiness Hours are Between 9:00 and 22:00. Orders received after 22:00 will not be processed.</p>\r\n\r\n<p><strong>DELIVERY AREA</strong><br />\r\nWe deliver only in the Ubud Area. If your delivery address is outside of the Ubud area, your order will not be processed. Click here to view a map of our coverage area.</p>\r\n\r\n<p><strong>PRICES</strong><br />\r\nPrices are subject to change without prior notification. There may be a short delay between price changes and website updates. Order modifications In &quot;Notes and Special Requests&quot; &nbsp;may also effect prices. In the event that the final bill on delivery is different from the total on checkout, you will be responsible to pay the full amount due on delivery.</p>\r\n.', '2016-10-26 15:09:40', 1),
(198, 'Edit Setting Value', ' edit  setting value to <p><strong>WAKTU PENGIRIMAN</strong><br />\r\nJam bisnis antara 09:00 dan 22:00. Pesanan yang diterima setelah pukul 22:00 tidak akan diproses.</p>\r\n\r\n<p><strong>AREA PENGIRIMAN</strong><br />\r\nKami mengirim pesanan hanya di daerah Ubud. Jika alamat pengiriman Anda berada di luar daerah Ubud, pesanan Anda tidak akan diproses. Klik di sini untuk melihat peta wilayah cakupan kami.</p>\r\n\r\n<p><strong>HARGA</strong><br />\r\nHarga dapat berubah tanpa pemberitahuan terlebih dahulu. Mungkin ada penundaan singkat antara perubahan harga dan pembaharuan website. permintaan dalam &quot;Catatan dan Permintaan Khusus&quot; juga dapat mempengaruhi harga. Bila tagihan akhir pengiriman berbeda dari total pada tagihan, anda akan bertanggung jawab untuk membayar jumlah penuh pada pengiriman.</p>\r\n.', '2016-10-26 15:09:40', 1),
(199, 'Edit Data in Page Our Deli', ' edit data in page Our Deli.', '2016-10-26 16:39:47', 1),
(200, 'Edit Data in Page Delivery Area', ' edit data in page Delivery Area.', '2016-10-26 16:49:36', 1),
(201, 'Edit Footer', ' edit footer data.', '2016-10-26 16:51:05', 1),
(202, 'Add Menu  Category', ' add Rice in menu category.', '2016-10-27 10:56:22', 1),
(203, 'Delete Menu Category', ' delete Rice in menu category.', '2016-10-27 10:57:53', 1),
(204, 'Edit Menu Category', ' edit menu category from OTHER to OTHER.', '2016-10-27 11:00:57', 1),
(205, 'Edit Menu Category', ' edit menu category from PIZZA to PIZZA.', '2016-10-27 11:01:26', 1),
(206, 'Edit Menu Category', ' edit menu category from PASTA to PASTA.', '2016-10-27 11:01:35', 1),
(207, 'Edit Menu Category', ' edit menu category from SANDWICHES to SANDWICHES.', '2016-10-27 11:01:49', 1),
(208, 'Edit Menu Category', ' edit menu category from DESSERTS to DESSERTS.', '2016-10-27 11:02:57', 1),
(209, 'Edit Menu Category', ' edit menu category from INDONESIAN to INDONESIAN.', '2016-10-27 11:04:32', 1),
(210, 'Edit Menu Category', ' edit menu category from SIDE DISHES AND STARTERS to SIDE DISHES AND STARTERS.', '2016-10-27 11:05:02', 1),
(211, 'Edit Menu Category', ' edit menu category from SALAD to SALAD.', '2016-10-27 11:05:11', 1),
(212, 'Edit Menu Category', ' edit menu category from BEER to BEER.', '2016-10-27 11:05:41', 1),
(213, 'Edit Menu Category', ' edit menu category from SOFT DRINKS to SOFT DRINKS.', '2016-10-27 11:05:50', 1),
(214, 'Edit Menu', ' edit Vegie Food (Http://localhost/pizzabagus/cr-admin/assets/img/no-pic-items.png) in  category.', '0000-00-00 00:00:00', 20000),
(215, 'Edit Menu', ' edit Vegie Food (Publish) in SALAD category.', '2016-10-27 11:30:06', 1),
(216, 'Edit Menu', ' edit Vegetable Sandwich (Publish) in SANDWICHES category.', '2016-10-27 11:32:57', 1),
(217, 'Edit Menu', ' edit Vegie Food (Publish) in SALAD category.', '2016-10-27 11:37:49', 1),
(218, 'Add Menu', ' add Margarita Pizza (Publish) as a new menu in PIZZA category.', '2016-10-27 11:40:02', 1),
(219, 'Edit Menu', ' edit Sample Pizza 1 (Publish) in PIZZA category.', '2016-10-27 11:55:53', 1),
(220, 'Edit Menu', ' edit Sample Pizza 2 (Publish) in PIZZA category.', '2016-10-27 12:02:19', 1),
(221, 'Edit Menu', ' edit Sample Spaghetti 1 (Publish) in PASTA category.', '2016-10-27 12:09:47', 1),
(222, 'Edit Menu', ' edit Fanta Strawberry (Publish) in SOFT DRINKS category.', '2016-10-27 12:14:40', 1),
(223, 'Edit Menu', ' edit Beer Bintang (Publish) in BEER category.', '2016-10-27 12:15:21', 1),
(224, 'Edit Additional Toppings', ' edit additional toppings from Chicken to Chicken.', '2016-10-27 12:46:19', 1),
(225, 'Edit Additional Toppings', ' edit additional toppings from Chicken to Chicken.', '2016-10-27 12:50:32', 1),
(226, 'Edit Additional Toppings', ' edit additional toppings from Shrimp to Shrimp.', '2016-10-27 12:50:42', 1),
(227, 'Add Additional Toppings', ' add Mayonaise in additional toppings.', '2016-10-27 12:54:32', 1),
(228, 'Edit Additional Toppings', ' edit additional toppings from Bacon to Bacon.', '2016-10-27 12:57:15', 1),
(229, 'Edit Additional Toppings', ' edit additional toppings from Double Mozarella to Double Mozarella.', '2016-10-27 12:57:45', 1),
(230, 'Edit Additional Toppings', ' edit additional toppings from Test to Test.', '2016-10-27 12:57:53', 1),
(231, 'Add Contact Information', ' add contact information in page Contact.', '2016-10-27 15:17:16', 1),
(232, 'Edit Contact Information', ' edit contact information in page Contact.', '2016-10-27 15:21:57', 1),
(233, 'Edit Contact Information', ' edit contact information in page Contact.', '2016-10-27 15:33:10', 1),
(234, 'Edit Contact Information', ' edit contact information in page Contact.', '2016-10-27 15:41:11', 1),
(235, 'Add Additional Toppings', ' add Mushroom in additional toppings.', '2016-10-27 16:07:33', 1),
(236, 'Edit Menu', ' edit Vegie Food (Publish) in SALAD category.', '2016-10-27 16:14:44', 1),
(237, 'Add Additional Toppings', ' add Cherry Tomato in additional toppings.', '2016-10-27 16:21:01', 1),
(238, 'Edit Additional Toppings', ' edit additional toppings from Cherry Tomato to Cherry Tomato.', '2016-10-27 16:22:34', 1),
(239, 'Edit Footer', ' edit footer data.', '2016-10-31 14:14:09', 1),
(240, 'Edit Setting Value', ' edit  setting value to <p>No online payment!. Payments are made with cash when your order arrive at your location. Prices are inclusive of 10% government tax.&nbsp;The order will be confirmed via sms.</p>\r\n.', '2016-11-01 12:31:42', 1),
(241, 'Edit Setting Value', ' edit  setting value to <p>Tidak ada pembayaran online!. Pembayaran tunai saat pesanan anda sampai di tempat anda. Harga sudah termasuk pajak sebesar 10%.&nbsp;Order akan dikonfirmasi melalui sms.</p>\r\n.', '2016-11-01 12:31:42', 1),
(242, 'Add Blog Category', ' add Try This in blog category.', '2016-11-01 12:47:37', 1),
(243, 'Add New Post', ' add new post(Standard, Publish) in  category.', '2016-11-01 13:12:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cr_inbox`
--

CREATE TABLE `cr_inbox` (
  `cr_inboxID` int(11) NOT NULL,
  `cr_inboxSubject` varchar(200) NOT NULL,
  `cr_inboxContent` text NOT NULL,
  `cr_inboxFrom` int(11) NOT NULL,
  `cr_inboxTo` int(11) NOT NULL,
  `cr_inboxDate` datetime NOT NULL,
  `cr_inboxRead` int(1) NOT NULL,
  `cr_inboxTimestamp` varchar(100) NOT NULL,
  `cr_inboxFromFolder` varchar(20) NOT NULL,
  `cr_inboxToFolder` varchar(20) NOT NULL,
  `cr_inboxType` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cr_invoice`
--

CREATE TABLE `cr_invoice` (
  `cr_invoiceID` int(11) NOT NULL,
  `cr_invoiceNumber` varchar(255) NOT NULL,
  `cr_invoiceDate` datetime NOT NULL,
  `cr_invoiceShipping` int(11) DEFAULT NULL,
  `cr_invoiceStatus` varchar(100) NOT NULL,
  `cr_invoiceType` varchar(50) NOT NULL,
  `cr_invoiceCustomername` varchar(100) NOT NULL,
  `cr_invoiceCustomeremail` varchar(100) NOT NULL,
  `cr_invoiceCustomerphone` varchar(100) NOT NULL,
  `cr_invoiceCustomeraddress` varchar(255) NOT NULL,
  `cr_invoiceCustomernationality` varchar(100) NOT NULL,
  `cr_invoiceCustomeraddinfo` text,
  `cr_invoicePayment` varchar(100) NOT NULL,
  `cr_invoiceDeliverystatus` varchar(20) NOT NULL,
  `cr_invoiceCourier` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_invoice`
--

INSERT INTO `cr_invoice` (`cr_invoiceID`, `cr_invoiceNumber`, `cr_invoiceDate`, `cr_invoiceShipping`, `cr_invoiceStatus`, `cr_invoiceType`, `cr_invoiceCustomername`, `cr_invoiceCustomeremail`, `cr_invoiceCustomerphone`, `cr_invoiceCustomeraddress`, `cr_invoiceCustomernationality`, `cr_invoiceCustomeraddinfo`, `cr_invoicePayment`, `cr_invoiceDeliverystatus`, `cr_invoiceCourier`) VALUES
(32, '00032', '2016-11-01 11:56:02', NULL, 'unpaid', 'member,1121', '', '', '', '', '', 'Gak pake lama', 'cash', 'on process', NULL),
(31, '00031', '2016-10-27 15:49:17', NULL, 'unpaid', 'member,1120', '', '', '', '', '', 'Tolong cepet ya bro', 'cash', 'on process', NULL),
(30, '00030', '2016-10-27 14:29:00', NULL, 'unpaid', 'member,1120', '', '', '', '', '', NULL, 'cash', 'on process', NULL),
(28, '00028', '2016-10-21 13:55:46', NULL, 'unpaid', 'member,1120', '', '', '', '', '', NULL, 'cash', 'on process', NULL),
(27, '00027', '2016-10-21 12:01:04', NULL, 'paid', 'member,1120', '', '', '', '', '', NULL, 'cash', 'delivered', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cr_invoicedetail`
--

CREATE TABLE `cr_invoicedetail` (
  `cr_invoicedetailID` int(11) NOT NULL,
  `cr_ourmenuID` int(11) NOT NULL,
  `cr_ourmenuQuantity` int(11) NOT NULL,
  `cr_ourmenuToppings` text,
  `cr_invoiceNumber` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_invoicedetail`
--

INSERT INTO `cr_invoicedetail` (`cr_invoicedetailID`, `cr_ourmenuID`, `cr_ourmenuQuantity`, `cr_ourmenuToppings`, `cr_invoiceNumber`) VALUES
(123, 4, 2, 'null', '00032'),
(122, 7, 1, '5', '00032'),
(121, 3, 1, 'null', '00032'),
(120, 1, 1, '7', '00032'),
(119, 8, 1, 'null', '00031'),
(118, 2, 1, '9', '00031'),
(117, 2, 1, '9', '00030'),
(116, 8, 1, 'null', '00030'),
(115, 3, 1, 'null', '00030'),
(114, 7, 1, '5', '00030'),
(113, 1, 1, 'null', '00030'),
(112, 3, 1, 'null', '00029'),
(111, 3, 1, '3,2', '00029'),
(110, 6, 1, 'null', '00029'),
(109, 4, 1, 'null', '00028'),
(108, 5, 1, 'null', '00027'),
(107, 2, 1, '3', '00027'),
(106, 3, 1, '3,2', '00027'),
(105, 6, 1, 'null', '00027');

-- --------------------------------------------------------

--
-- Table structure for table `cr_jumbotron`
--

CREATE TABLE `cr_jumbotron` (
  `cr_jumbotronID` int(11) NOT NULL,
  `cr_jumbotronName` varchar(100) NOT NULL,
  `cr_jumbotronImage` varchar(255) NOT NULL,
  `cr_jumbotronCaption` varchar(100) NOT NULL,
  `cr_jumbotronDesc` text NOT NULL,
  `cr_jumbotronButtontext` varchar(50) NOT NULL,
  `cr_jumbotronButtonLink` varchar(255) NOT NULL,
  `cr_jumbotronTextposition` varchar(6) NOT NULL,
  `cr_jumbotronColorscheme` varchar(10) NOT NULL,
  `cr_adminID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_jumbotron`
--

INSERT INTO `cr_jumbotron` (`cr_jumbotronID`, `cr_jumbotronName`, `cr_jumbotronImage`, `cr_jumbotronCaption`, `cr_jumbotronDesc`, `cr_jumbotronButtontext`, `cr_jumbotronButtonLink`, `cr_jumbotronTextposition`, `cr_jumbotronColorscheme`, `cr_adminID`) VALUES
(1, 'plainjumbotron', '', '', '', '', '', '', '', 1),
(2, 'backgroundjumbotron', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cr_language`
--

CREATE TABLE `cr_language` (
  `cr_languageID` int(11) NOT NULL,
  `cr_languageCode` varchar(4) NOT NULL,
  `cr_languageFlag` varchar(255) NOT NULL,
  `cr_languageStatus` int(1) NOT NULL,
  `cr_languageDefault` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_language`
--

INSERT INTO `cr_language` (`cr_languageID`, `cr_languageCode`, `cr_languageFlag`, `cr_languageStatus`, `cr_languageDefault`) VALUES
(1, 'en', 'gb.svg', 1, 'yes'),
(2, 'id', 'id.svg', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cr_map`
--

CREATE TABLE `cr_map` (
  `cr_mapID` int(11) NOT NULL,
  `cr_mapLatLong` varchar(100) NOT NULL,
  `cr_mapDesc` text NOT NULL,
  `cr_mapmarkerID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_map`
--

INSERT INTO `cr_map` (`cr_mapID`, `cr_mapLatLong`, `cr_mapDesc`, `cr_mapmarkerID`) VALUES
(1, '-8.5222512,115.2627883', 'Jl. Raya Pengosekan, Ubud<br />\r\nBali 80571<br />\r\n(0361) 978520', 5);

-- --------------------------------------------------------

--
-- Table structure for table `cr_mapmarker`
--

CREATE TABLE `cr_mapmarker` (
  `cr_mapmarkerID` int(11) NOT NULL,
  `cr_mapmarkerName` varchar(100) NOT NULL,
  `cr_mapmarkerImage` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_mapmarker`
--

INSERT INTO `cr_mapmarker` (`cr_mapmarkerID`, `cr_mapmarkerName`, `cr_mapmarkerImage`) VALUES
(1, 'Default Marker', 'cr-include/images/map-marker/map-marker-default.png'),
(2, 'Bubble Pink', 'cr-include/images/map-marker/map-marker-bubble-pink.png'),
(3, 'Buble Azure', 'cr-include/images/map-marker/map-marker-bubble-azure.png'),
(4, 'Bubble Chartreuse', 'cr-include/images/map-marker/map-marker-bubble-chartreuse.png'),
(5, 'Pizza Marker', 'cr-include/images/map-marker/map-marker-pizza.png');

-- --------------------------------------------------------

--
-- Table structure for table `cr_media`
--

CREATE TABLE `cr_media` (
  `cr_mediaID` int(11) NOT NULL,
  `cr_mediaName` varchar(255) NOT NULL,
  `cr_mediaDate` datetime NOT NULL,
  `cr_mediaTitle` varchar(255) NOT NULL,
  `cr_mediaDesc` text NOT NULL,
  `cr_adminID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_media`
--

INSERT INTO `cr_media` (`cr_mediaID`, `cr_mediaName`, `cr_mediaDate`, `cr_mediaTitle`, `cr_mediaDesc`, `cr_adminID`) VALUES
(3, '4476aad35d4d6d8acbe09a504ff50a15.jpg', '2016-10-06 11:01:28', '', '', 1),
(2, '4b360521f235f6ca5e9a436f2159dcbc.jpg', '2016-10-06 10:49:05', '', '', 1),
(4, 'addcc1e20dc8e61960acf9fe7a59f899.jpg', '2016-10-06 11:01:51', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cr_menu`
--

CREATE TABLE `cr_menu` (
  `cr_menuID` int(11) NOT NULL,
  `cr_menuTitle` varchar(100) NOT NULL,
  `cr_menuTitle_id` varchar(100) NOT NULL,
  `cr_menuLink` varchar(100) NOT NULL,
  `cr_menuOrder` int(11) NOT NULL,
  `cr_menuHasSub` int(11) NOT NULL,
  `cr_menuStatus` int(1) NOT NULL,
  `cr_pagetemplateID` int(11) NOT NULL,
  `cr_option` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_menu`
--

INSERT INTO `cr_menu` (`cr_menuID`, `cr_menuTitle`, `cr_menuTitle_id`, `cr_menuLink`, `cr_menuOrder`, `cr_menuHasSub`, `cr_menuStatus`, `cr_pagetemplateID`, `cr_option`) VALUES
(9, 'Location', 'Lokasi', 'location', 1, 1, 1, 1, ''),
(6, 'Food', 'Makanan', 'food', 2, 0, 1, 10, ''),
(7, 'Drinks', 'Minuman', 'drinks', 3, 0, 1, 10, ''),
(8, 'Contact', 'Kontak', 'contact', 4, 0, 1, 2, 'contact'),
(10, 'News', 'Berita', 'news', 10, 0, 1, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `cr_message`
--

CREATE TABLE `cr_message` (
  `cr_messageID` int(11) NOT NULL,
  `cr_messageSubject` varchar(100) NOT NULL,
  `cr_messageContent` text NOT NULL,
  `cr_messageName` varchar(50) NOT NULL,
  `cr_messageEmail` varchar(200) NOT NULL,
  `cr_messageDate` datetime NOT NULL,
  `cr_messageRead` int(1) NOT NULL,
  `cr_messageFolder` varchar(20) NOT NULL,
  `cr_messageReplied` int(1) NOT NULL,
  `cr_messageType` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cr_ourmenu`
--

CREATE TABLE `cr_ourmenu` (
  `cr_ourmenuID` int(11) NOT NULL,
  `cr_ourmenuTitle` varchar(200) NOT NULL,
  `cr_ourmenuIngredients` text,
  `cr_ourmenuLink` varchar(200) NOT NULL,
  `cr_ourmenuDesc` text NOT NULL,
  `cr_ourmenuDate` datetime NOT NULL,
  `cr_ourmenuThumb` varchar(200) NOT NULL,
  `cr_ourmenuSelected` varchar(3) NOT NULL,
  `cr_ourmenucategoryID` int(11) NOT NULL,
  `cr_ourmenuStatus` varchar(10) NOT NULL,
  `cr_ourmenuPrice` int(11) NOT NULL,
  `cr_ourmenuSize` varchar(10) NOT NULL,
  `cr_adminID` int(11) NOT NULL,
  `cr_ourmenuType` varchar(100) NOT NULL,
  `cr_ourmenuIngredients_id` text NOT NULL,
  `cr_ourmenuDesc_id` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_ourmenu`
--

INSERT INTO `cr_ourmenu` (`cr_ourmenuID`, `cr_ourmenuTitle`, `cr_ourmenuIngredients`, `cr_ourmenuLink`, `cr_ourmenuDesc`, `cr_ourmenuDate`, `cr_ourmenuThumb`, `cr_ourmenuSelected`, `cr_ourmenucategoryID`, `cr_ourmenuStatus`, `cr_ourmenuPrice`, `cr_ourmenuSize`, `cr_adminID`, `cr_ourmenuType`, `cr_ourmenuIngredients_id`, `cr_ourmenuDesc_id`) VALUES
(1, 'Sample Pizza 1', 'tomato, mozzarella', 'sample-pizza-1', '<p>Only sample of food menu.</p>\r\n', '2016-10-27 11:55:53', '', '', 2, 'publish', 30000, 'small', 1, 'none', 'tomat, keju mozzarela', '<p>hanya contoh menu.</p>\r\n'),
(2, 'Sample Pizza 2', 'tomato, mozzarella, olive oil', 'sample-pizza-2', '<p>Just sample food.</p>\r\n', '2016-10-27 12:02:19', '', 'yes', 2, 'publish', 54000, 'large', 1, 'fish', 'tomat, keju mozzarela, minyak oliv', '<p>hanya contoh makanan</p>\r\n'),
(3, 'Sample Spaghetti 1', 'Garlic, chili, tomato sauce', 'sample-spaghetti-1', '<p>Image and name is just for example.&nbsp;Labore pertinax et eos, mei dicat scaevola ei.</p>\r\n', '2016-10-27 12:09:47', '', '', 3, 'publish', 30000, 'small', 1, 'none', 'bawang putih, cabai, saus tomat', '<p>Nama makanan hanya contoh.&nbsp;Labore pertinax et eos, mei dicat scaevola ei.</p>\r\n'),
(4, 'Beer Bintang', NULL, 'beer-bintang', '<p>Image and name is just for example.</p>\r\n', '2016-10-27 12:15:21', '', '', 6, 'publish', 27000, 'small', 1, 'none', '', '<p>hanya contoh</p>\r\n'),
(5, 'Fanta Strawberry', NULL, 'fanta-strawberry', '<p>Image and name is just for example.</p>\r\n', '2016-10-27 12:14:40', '', '', 7, 'publish', 15000, 'none', 1, 'none', '', '<p>hanya contoh</p>\r\n'),
(6, 'Vegetable Sandwich', 'bread, salad', 'vegetable-sandwich', '', '2016-10-27 11:32:57', '', 'yes', 5, 'publish', 25000, 'none', 1, 'vegetarian', 'roti, selada', ''),
(7, 'Vegie Food', 'cabbage, salad', 'vegie-food', '', '2016-10-27 16:14:44', '', '', 4, 'publish', 20000, 'none', 1, 'vegetarian', 'kol, selada', ''),
(8, 'Margarita Pizza', 'cheese, tomato, tomato sauce', 'margarita-pizza', '', '2016-10-27 11:40:02', '', '', 2, 'publish', 40000, 'medium', 1, 'none', 'keju, tomat, saus tomat', '');

-- --------------------------------------------------------

--
-- Table structure for table `cr_ourmenucategory`
--

CREATE TABLE `cr_ourmenucategory` (
  `cr_ourmenucategoryID` int(11) NOT NULL,
  `cr_ourmenucategoryName` varchar(100) NOT NULL,
  `cr_ourmenucategoryLink` varchar(100) NOT NULL,
  `cr_ourmenucategoryDate` datetime NOT NULL,
  `cr_ourmenucategoryOrder` int(11) NOT NULL,
  `cr_ourmenucategoryName_id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_ourmenucategory`
--

INSERT INTO `cr_ourmenucategory` (`cr_ourmenucategoryID`, `cr_ourmenucategoryName`, `cr_ourmenucategoryLink`, `cr_ourmenucategoryDate`, `cr_ourmenucategoryOrder`, `cr_ourmenucategoryName_id`) VALUES
(1, 'SIDE DISHES AND STARTERS', 'food', '2016-10-27 11:05:02', 1, 'HIDANGAN PEMBUKA'),
(2, 'PIZZA', 'food', '2016-10-27 11:01:26', 2, 'PIZZA'),
(3, 'PASTA', 'food', '2016-10-27 11:01:35', 3, 'PASTA'),
(4, 'SALAD', 'food', '2016-10-27 11:05:11', 4, 'SALAD'),
(5, 'SANDWICHES', 'food', '2016-10-27 11:01:49', 5, 'ROTI ISI'),
(6, 'BEER', 'drinks', '2016-10-27 11:05:41', 0, 'BIR'),
(7, 'SOFT DRINKS', 'drinks', '2016-10-27 11:05:50', 0, 'MINUMAN RINGAN'),
(8, 'OTHER', 'food', '2016-10-27 11:00:57', 6, 'LAINNYA'),
(9, 'INDONESIAN', 'food', '2016-10-27 11:04:32', 7, 'MAKANAN INDONESIA'),
(10, 'DESSERTS', 'food', '2016-10-27 11:02:57', 8, 'PENCUCI MULUT');

-- --------------------------------------------------------

--
-- Table structure for table `cr_ourmenuingredients`
--

CREATE TABLE `cr_ourmenuingredients` (
  `cr_ourmenuingredientsID` int(11) NOT NULL,
  `cr_ourmenuingredientsName` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_ourmenuingredients`
--

INSERT INTO `cr_ourmenuingredients` (`cr_ourmenuingredientsID`, `cr_ourmenuingredientsName`) VALUES
(1, 'tomato'),
(2, 'mozzarella'),
(3, 'olive oil'),
(4, 'Garlic'),
(5, 'chili'),
(6, 'tomato sauce'),
(7, 'ingre1'),
(8, 'ingre2'),
(9, 'fish'),
(10, 'carbage'),
(16, 'cheese'),
(15, 'salad'),
(14, 'cabbage');

-- --------------------------------------------------------

--
-- Table structure for table `cr_ourmenuingredients_id`
--

CREATE TABLE `cr_ourmenuingredients_id` (
  `cr_ourmenuingredients_idID` int(11) NOT NULL,
  `cr_ourmenuingredientsName_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_ourmenuingredients_id`
--

INSERT INTO `cr_ourmenuingredients_id` (`cr_ourmenuingredients_idID`, `cr_ourmenuingredientsName_id`) VALUES
(1, 'kol'),
(2, 'selada'),
(3, 'keju'),
(4, 'tomat'),
(5, 'saus tomat'),
(6, 'keju mozzarela'),
(7, 'minyak oliv'),
(8, 'bawang putih'),
(9, 'cabai');

-- --------------------------------------------------------

--
-- Table structure for table `cr_pagetemplate`
--

CREATE TABLE `cr_pagetemplate` (
  `cr_pagetemplateID` int(11) NOT NULL,
  `cr_pagetemplateName` varchar(100) NOT NULL,
  `cr_pagetemplateImage` varchar(150) NOT NULL,
  `cr_pagetemplateType` varchar(100) NOT NULL,
  `cr_pagetemplateColumn` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_pagetemplate`
--

INSERT INTO `cr_pagetemplate` (`cr_pagetemplateID`, `cr_pagetemplateName`, `cr_pagetemplateImage`, `cr_pagetemplateType`, `cr_pagetemplateColumn`) VALUES
(1, 'One Columns', 'assets/img/pagetemplate-one-column.png', 'general', 1),
(2, 'Two Columns', 'assets/img/pagetemplate-two-column.png', 'general', 2),
(3, 'Three Columns', 'assets/img/pagetemplate-three-column.png', 'general', 3),
(4, 'Left Sidebar', 'assets/img/pagetemplate-blog-left-sidebar.png', 'blog', 2),
(5, 'Right Sidebar', 'assets/img/pagetemplate-blog-right-sidebar.png', 'blog', 2),
(6, 'Three Columns', 'assets/img/pagetemplate-portfolio-three-column.png', 'portfolio', 3),
(7, 'Four Columns', 'assets/img/pagetemplate-portfolio-four-column.png', 'portfolio', 4),
(8, 'Three Columns with Detail', 'assets/img/pagetemplate-portfolio-three-column-with-detail.png', 'portfolio', 3),
(9, 'Four Columns with Detail', 'assets/img/pagetemplate-portfolio-four-column-with-detail.png', 'portfolio', 4),
(10, 'One Column Listing', 'assets/img/pagetemplate-menu.png', 'menu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cr_portfolio`
--

CREATE TABLE `cr_portfolio` (
  `cr_portfolioID` int(11) NOT NULL,
  `cr_portfolioTitle` varchar(200) NOT NULL,
  `cr_portfolioLink` varchar(200) NOT NULL,
  `cr_portfolioDesc` text NOT NULL,
  `cr_portfolioDate` datetime NOT NULL,
  `cr_portfolioSliderimage` text NOT NULL,
  `cr_portfolioThumb` varchar(200) NOT NULL,
  `cr_portfolioSelected` varchar(3) NOT NULL,
  `cr_portfoliocategoryID` int(11) NOT NULL,
  `cr_portfolioMetaKeywords` text NOT NULL,
  `cr_portfolioMetaDescription` text NOT NULL,
  `cr_portfolioStatus` varchar(10) NOT NULL,
  `cr_adminID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cr_portfoliocategory`
--

CREATE TABLE `cr_portfoliocategory` (
  `cr_portfoliocategoryID` int(11) NOT NULL,
  `cr_portfoliocategoryName` varchar(100) NOT NULL,
  `cr_portfoliocategoryLink` varchar(100) NOT NULL,
  `cr_portfoliocategoryDate` datetime NOT NULL,
  `cr_portfoliocategoryOrder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cr_portfolioextra`
--

CREATE TABLE `cr_portfolioextra` (
  `cr_portfolioextraID` int(11) NOT NULL,
  `cr_portfolioextraName` varchar(200) NOT NULL,
  `cr_portfolioextraContent` text NOT NULL,
  `cr_portfolioextraOrder` int(11) NOT NULL,
  `cr_portfolioID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_portfolioextra`
--

INSERT INTO `cr_portfolioextra` (`cr_portfolioextraID`, `cr_portfolioextraName`, `cr_portfolioextraContent`, `cr_portfolioextraOrder`, `cr_portfolioID`) VALUES
(1, 'Extra 1', '<p>asd asd asd asd</p>\r\n', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cr_portfoliolikes`
--

CREATE TABLE `cr_portfoliolikes` (
  `cr_portfoliolikesID` int(11) NOT NULL,
  `cr_portfoliolikesIP` varchar(50) NOT NULL,
  `cr_portfoliolikesDate` datetime NOT NULL,
  `cr_portfolioID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_portfoliolikes`
--

INSERT INTO `cr_portfoliolikes` (`cr_portfoliolikesID`, `cr_portfoliolikesIP`, `cr_portfoliolikesDate`, `cr_portfolioID`) VALUES
(2, '::1', '2016-10-04 13:30:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cr_portfoliovisitor`
--

CREATE TABLE `cr_portfoliovisitor` (
  `cr_portfoliovisitorID` int(11) NOT NULL,
  `cr_portfoliovisitorIP` varchar(50) NOT NULL,
  `cr_portfoliovisitorDate` datetime NOT NULL,
  `cr_portfolioID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_portfoliovisitor`
--

INSERT INTO `cr_portfoliovisitor` (`cr_portfoliovisitorID`, `cr_portfoliovisitorIP`, `cr_portfoliovisitorDate`, `cr_portfolioID`) VALUES
(1, '::1', '2016-10-03 15:04:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cr_quotes`
--

CREATE TABLE `cr_quotes` (
  `cr_quotesID` int(11) NOT NULL,
  `cr_quotesName` varchar(100) NOT NULL,
  `cr_quotesPhoto` varchar(200) DEFAULT NULL,
  `cr_quotesText` text NOT NULL,
  `cr_quotesStatus` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_quotes`
--

INSERT INTO `cr_quotes` (`cr_quotesID`, `cr_quotesName`, `cr_quotesPhoto`, `cr_quotesText`, `cr_quotesStatus`) VALUES
(1, 'Jamie Oliver', NULL, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat', 'show'),
(2, 'Mike Elwis', NULL, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat', 'show'),
(3, 'John Doe', NULL, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat', 'show');

-- --------------------------------------------------------

--
-- Table structure for table `cr_services`
--

CREATE TABLE `cr_services` (
  `cr_servicesID` int(11) NOT NULL,
  `cr_servicesName` varchar(200) NOT NULL,
  `cr_servicesDesc` text NOT NULL,
  `cr_servicesImage` varchar(255) DEFAULT NULL,
  `cr_adminID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cr_setting`
--

CREATE TABLE `cr_setting` (
  `cr_settingID` int(11) NOT NULL,
  `cr_settingName` varchar(100) NOT NULL,
  `cr_settingValue` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_setting`
--

INSERT INTO `cr_setting` (`cr_settingID`, `cr_settingName`, `cr_settingValue`) VALUES
(1, 'sitename', 'Pizza Bagus'),
(2, 'siteurl', 'http://'),
(3, 'foldername', 'pizzabagus'),
(4, 'tagline', 'Restaurant, Delivery, & Deli'),
(5, 'template', 'pizzabagus'),
(6, 'email', 'example@mail.com'),
(7, 'phone', '0361978520'),
(8, 'secondaryfooter', 'Copyright © 2016. All Rights Reserved.,Prices are Inclusive of 10% Government Tax<br>Open Daily 09:00 to 22:00'),
(9, 'metakeywords', ''),
(10, 'metadescription', ''),
(11, 'contactheader', '1,1,1'),
(12, 'address', ''),
(13, 'websitelogo', '20161006054628.png'),
(14, 'colorscheme', 'green'),
(15, 'homepagestyle', 'image-slider,NULL,NULL,NULL'),
(16, 'favicon', '20161006054557.png'),
(17, 'timezone', '(UTC+08:00) Asia/Makassar'),
(18, 'recaptchasitekey', ''),
(19, 'recaptchasecret', ''),
(20, 'customprimary', ''),
(21, 'customsecondary', ''),
(22, 'googlemapapi', 'AIzaSyC68T-zrmjNmWoFgsjgX2ws7TlR4PV9Nfk'),
(23, 'googleanalyticscode', ''),
(24, 'layoutmode', ''),
(25, 'backgroundtemplate', ''),
(26, 'dateformat', 'F d, Y'),
(27, 'timeformat', 'g:i a'),
(28, 'comingsoon', 'disable'),
(29, 'datetimemaintenance', ''),
(30, 'backgroundrepeat', ''),
(31, 'backgroundposition', 'center center'),
(32, 'backgroundattachment', 'fixed'),
(33, 'backgroundsize', ''),
(34, 'homepagelink', 'show'),
(35, 'backgroundlogin', '4b360521f235f6ca5e9a436f2159dcbc.jpg'),
(36, 'footer-column4', 'enable'),
(37, 'invoicelogo', ''),
(38, 'quotesinpage', 'food'),
(39, 'servicestitle', 'Services'),
(40, 'servicesinpage', ''),
(41, 'clientspartnersinpage', ''),
(42, 'quotestitle', 'What They Say'),
(43, 'userplan', 'propro'),
(44, 'totalpage', '999999'),
(45, 'instafeeduserid', ''),
(46, 'instafeedaccesstoken', ''),
(47, 'clientstitle', 'Our Clients'),
(48, 'openorder', '08:30'),
(49, 'closeorder', '18:00'),
(50, 'paymentinformation', '<p>No online payment!. Payments are made with cash when your order arrive at your location. Prices are inclusive of 10% government tax.&nbsp;The order will be confirmed via sms.</p>\r\n'),
(51, 'customhomecontent', '<h3>HISTORY OF OUR PIZZERIA &amp; ITALIAN FOOD RESTAURANT IN UBUD BALI</h3>\r\n\r\n<p>Proudly known today as a Pizzeria, Gelateria and Ristorante Italiano, Pizza Bagus was established in 1996 as a tiny kitchen for providing a pasta and pizza delivery service in the periphery of Ubud, Bali. It soon became very popular thanks to the fine Italian food recipes from our Neapolitan chef and his ability to bring to the table the real flavor and taste of Italian cuisine.</p>\r\n\r\n<p>After a few years of hard work to overcome the difficulties of the economic crisis that hit Indonesia in 1998, Pizza Bagus moved to a new location closer to the center of Ubud. This time with the addition of a little dining room and a larger selection of delicious Italian pasta, pizzas and great espresso coffee that brought even more popularity to the still very small &quot;Italian restaurant&quot;.</p>\r\n\r\n<p>With a growing reputation that had customers constantly coming back for more, in 2003 Pizza Bagus was forced to move location again due to lack of space. Now located in the Pengosekan area, Pizza Bagus offers you a large space to come with friends, family and children, to enjoy Italian specialties and a final Italian touch, traditional Italian gelato in many different flavors.</p>\r\n\r\n<p>Through growing ever more popular over the years, it has now become a meeting place for the Italian community living in Ubud, travelers, business people from all over the world and local people. Finally it can be said that Pizza Bagus has succeeded in literally bringing a piece of Italy to Ubud.</p>\r\n\r\n<p>If you are in Bali and are looking to enjoy an authentic Italian meal in friendly surroundings please be sure to pay us a visit in Ubud. We look forward to meeting you! Ciao!</p>\r\n'),
(52, 'paymentinformation_id', '<p>Tidak ada pembayaran online!. Pembayaran tunai saat pesanan anda sampai di tempat anda. Harga sudah termasuk pajak sebesar 10%.&nbsp;Order akan dikonfirmasi melalui sms.</p>\r\n'),
(53, 'customhomecontent_id', '<h3>SEJARAH PIZZERIA KAMI &amp; RESTORAN MAKANAN ITALIA&nbsp;DI UBUD BALI</h3>\r\n\r\n<p>Bangga dikenal sebagai Pizzeria, Gelateria dan Ristorante Italiano, Pizza Bagus didirikan pada tahun 1996 sebagai dapur kecil untuk menyediakan layanan pengiriman pasta dan pizza di Ubud, Bali. Segera menjadi sangat populer untuk resep makanan Italia dari koki Neapolitan dan kemampuannya untuk menyajikan rasa yang nyata dan rasa masakan Italia.</p>\r\n\r\n<p>Setelah beberapa tahun kerja keras untuk mengatasi kesulitan dari krisis ekonomi yang melanda Indonesia pada tahun 1998, Pizza Bagus pindah ke lokasi baru yang lebih dekat ke pusat Ubud. kali ini dengan penambahan ruang makan kecil dan pilihan yang lebih besar dari pasta yang lezat, pizza dan kopi espresso besar yang membawa popularitas lebih ke &quot;restoran Italia&quot; yang masih sangat kecil.</p>\r\n\r\n<p>Dengan perkembangan reputasi yang membuat pelanggan terus datang kembali, pada tahun 2003 Pizza Bagus terpaksa pindah lokasi lagi karena kurangnya ruang. Sekarang terletak di daerah Pengosekan, Pizza Bagus menawarkan ruang yang besar untuk datang dengan teman-teman, keluarga dan anak-anak, untuk menikmati masakan khas Italia dan sentuhan Italia, gelato Italia tradisional dalam berbagai rasa yang berbeda.</p>\r\n\r\n<p>Dengan tumbuh semakin populer selama bertahun-tahun, sekarang telah menjadi tempat pertemuan bagi masyarakat Italia yang tinggal di Ubud, wisatawan, orang-orang bisnis dari seluruh dunia dan orang-orang lokal. Akhirnya dapat dikatakan bahwa Pizza Bagus telah berhasil membawa sepotong Italia ke Ubud.</p>\r\n\r\n<p>Jika Anda berada di Bali dan ingin menikmati makanan Italia yang otentik dalam lingkungan yang ramah pastikan untuk mengunjungi kami di Ubud. Kami berharap untuk bertemu Anda! Ciao!</p>\r\n'),
(54, 'termofservice', '<p><strong>DELIVERY TIMES</strong><br />\r\nBusiness Hours are Between 9:00 and 22:00. Orders received after 22:00 will not be processed.</p>\r\n\r\n<p><strong>DELIVERY AREA</strong><br />\r\nWe deliver only in the Ubud Area. If your delivery address is outside of the Ubud area, your order will not be processed. Click here to view a map of our coverage area.</p>\r\n\r\n<p><strong>PRICES</strong><br />\r\nPrices are subject to change without prior notification. There may be a short delay between price changes and website updates. Order modifications In &quot;Notes and Special Requests&quot; &nbsp;may also effect prices. In the event that the final bill on delivery is different from the total on checkout, you will be responsible to pay the full amount due on delivery.</p>\r\n'),
(55, 'termofservice_id', '<p><strong>WAKTU PENGIRIMAN</strong><br />\r\nJam bisnis antara 09:00 dan 22:00. Pesanan yang diterima setelah pukul 22:00 tidak akan diproses.</p>\r\n\r\n<p><strong>AREA PENGIRIMAN</strong><br />\r\nKami mengirim pesanan hanya di daerah Ubud. Jika alamat pengiriman Anda berada di luar daerah Ubud, pesanan Anda tidak akan diproses. Klik di sini untuk melihat peta wilayah cakupan kami.</p>\r\n\r\n<p><strong>HARGA</strong><br />\r\nHarga dapat berubah tanpa pemberitahuan terlebih dahulu. Mungkin ada penundaan singkat antara perubahan harga dan pembaharuan website. permintaan dalam &quot;Catatan dan Permintaan Khusus&quot; juga dapat mempengaruhi harga. Bila tagihan akhir pengiriman berbeda dari total pada tagihan, anda akan bertanggung jawab untuk membayar jumlah penuh pada pengiriman.</p>\r\n'),
(56, 'gosmsgatewayusername', ''),
(57, 'gosmsgatewaypassword', '');

-- --------------------------------------------------------

--
-- Table structure for table `cr_slider`
--

CREATE TABLE `cr_slider` (
  `cr_sliderID` int(11) NOT NULL,
  `cr_sliderImage` varchar(255) NOT NULL,
  `cr_sliderCaption` varchar(100) NOT NULL,
  `cr_sliderDesc` text NOT NULL,
  `cr_sliderButtontext` varchar(50) NOT NULL,
  `cr_sliderButtonlink` varchar(255) NOT NULL,
  `cr_sliderTextposition` varchar(6) NOT NULL,
  `cr_adminID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_slider`
--

INSERT INTO `cr_slider` (`cr_sliderID`, `cr_sliderImage`, `cr_sliderCaption`, `cr_sliderDesc`, `cr_sliderButtontext`, `cr_sliderButtonlink`, `cr_sliderTextposition`, `cr_adminID`) VALUES
(1, '4476aad35d4d6d8acbe09a504ff50a15.jpg', '', '', '', '', 'center', 1),
(2, 'addcc1e20dc8e61960acf9fe7a59f899.jpg', '', '', '', '', 'center', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cr_social`
--

CREATE TABLE `cr_social` (
  `cr_socialID` int(11) NOT NULL,
  `cr_socialName` varchar(100) NOT NULL,
  `cr_socialLink` varchar(255) NOT NULL,
  `cr_socialIcon` varchar(100) NOT NULL,
  `cr_socialImage` varchar(100) NOT NULL,
  `cr_socialOrder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_social`
--

INSERT INTO `cr_social` (`cr_socialID`, `cr_socialName`, `cr_socialLink`, `cr_socialIcon`, `cr_socialImage`, `cr_socialOrder`) VALUES
(1, 'facebook', 'https://facebook.com/asdasdasd', '<i class="fa fa-facebook"></i>', 'assets/img/social-icon/facebook.png', 1),
(2, 'twitter', '', '<i class="fa fa-twitter"></i>', 'assets/img/social-icon/twitter.png', 5),
(3, 'instagram', 'https://instagram.com/asdasdasd', '<i class="fa fa-instagram"></i>', 'assets/img/social-icon/instagram.png', 2),
(4, 'tumblr', '', '<i class="fa fa-tumblr"></i>', 'assets/img/social-icon/tumblr.png', 8),
(5, 'pinterest', '', '<i class="fa fa-pinterest-p"></i>', 'assets/img/social-icon/pinterest.png', 4),
(6, 'youtube', '', '<i class="fa fa-youtube"></i>', 'assets/img/social-icon/youtube.png', 3),
(7, 'behance', '', '<i class="fa fa-behance"></i>', 'assets/img/social-icon/behance.png', 9),
(8, 'dribbble', '', '<i class="fa fa-dribbble"></i>', 'assets/img/social-icon/dribbble.png', 7),
(9, 'github', '', '<i class="fa fa-github"></i>', 'assets/img/social-icon/github.png', 6),
(10, 'soundcloud', '', '<i class="fa fa-soundcloud"></i>', 'assets/img/social-icon/soundcloud.png', 10),
(11, 'google-plus', '', '<i class="fa fa-google-plus"></i>', 'assets/img/social-icon/google-plus.png', 11),
(12, 'skype', '', '<i class="fa fa-skype"></i>', 'assets/img/social-icon/skype.png', 12);

-- --------------------------------------------------------

--
-- Table structure for table `cr_submenu`
--

CREATE TABLE `cr_submenu` (
  `cr_submenuID` int(11) NOT NULL,
  `cr_submenuTitle` varchar(100) NOT NULL,
  `cr_submenuTitle_id` varchar(100) NOT NULL,
  `cr_submenuLink` varchar(100) NOT NULL,
  `cr_menuID` int(11) NOT NULL,
  `cr_submenuStatus` int(1) NOT NULL,
  `cr_pagetemplateID` int(11) NOT NULL,
  `cr_option` varchar(50) NOT NULL,
  `cr_submenuOrder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_submenu`
--

INSERT INTO `cr_submenu` (`cr_submenuID`, `cr_submenuTitle`, `cr_submenuTitle_id`, `cr_submenuLink`, `cr_menuID`, `cr_submenuStatus`, `cr_pagetemplateID`, `cr_option`, `cr_submenuOrder`) VALUES
(1, 'Our Deli', 'Deli Kami', 'our-deli', 9, 1, 1, '', 0),
(2, 'Delivery Area', 'Daerah Pengiriman', 'delivery-area', 9, 1, 1, '', 0),
(3, 'ABdasd', 'ABdasd', '', 1, 0, 0, '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cr_toppings`
--

CREATE TABLE `cr_toppings` (
  `cr_toppingsID` int(11) NOT NULL,
  `cr_toppingsName` varchar(255) NOT NULL,
  `cr_toppingsPrice` int(11) NOT NULL,
  `cr_ourmenucategoryID` text,
  `cr_toppingsOrder` int(11) NOT NULL,
  `cr_toppingsSize` varchar(10) NOT NULL,
  `cr_toppingsName_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_toppings`
--

INSERT INTO `cr_toppings` (`cr_toppingsID`, `cr_toppingsName`, `cr_toppingsPrice`, `cr_ourmenucategoryID`, `cr_toppingsOrder`, `cr_toppingsSize`, `cr_toppingsName_id`) VALUES
(2, 'Bacon', 5000, '1,3', 2, 'none', 'Babi'),
(3, 'Double Mozarella', 10000, '1,2,3', 1, 'none', 'Dobel Keju Mozarela'),
(5, 'Shrimp', 8000, '4', 3, 'none', 'Udang'),
(7, 'Chicken', 6000, '2', 0, 'small', 'Ayam'),
(8, 'Test', 10000, '3', 0, 'none', 'Tes'),
(9, 'Chicken', 8000, '2', 0, 'large', 'Ayam'),
(10, 'Mayonaise', 2000, '4', 0, 'none', 'Mayones'),
(11, 'Mushroom', 20000, '4', 0, 'medium', 'Jamur'),
(12, 'Cherry Tomato', 10000, '2', 0, 'large', 'Tomat Ceri');

-- --------------------------------------------------------

--
-- Table structure for table `cr_visitor`
--

CREATE TABLE `cr_visitor` (
  `cr_visitorID` int(11) NOT NULL,
  `cr_visitorIP` varchar(50) NOT NULL,
  `cr_visitorBrowser` varchar(100) NOT NULL,
  `cr_visitorPlatform` varchar(100) NOT NULL,
  `cr_visitorDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cr_visitor`
--

INSERT INTO `cr_visitor` (`cr_visitorID`, `cr_visitorIP`, `cr_visitorBrowser`, `cr_visitorPlatform`, `cr_visitorDate`) VALUES
(1, '::1', 'Google Chrome', 'Windows', '2016-09-30 13:56:02'),
(2, '192.168.1.12', 'Mozilla Firefox', 'Mac', '2016-10-07 16:01:56'),
(3, '192.168.1.196', 'Google Chrome', 'Linux', '2016-10-31 16:08:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cr_admin`
--
ALTER TABLE `cr_admin`
  ADD PRIMARY KEY (`cr_adminID`);

--
-- Indexes for table `cr_blog`
--
ALTER TABLE `cr_blog`
  ADD PRIMARY KEY (`cr_blogID`);

--
-- Indexes for table `cr_blogcategory`
--
ALTER TABLE `cr_blogcategory`
  ADD PRIMARY KEY (`cr_blogcategoryID`);

--
-- Indexes for table `cr_bloglikes`
--
ALTER TABLE `cr_bloglikes`
  ADD PRIMARY KEY (`cr_bloglikesID`);

--
-- Indexes for table `cr_blogtags`
--
ALTER TABLE `cr_blogtags`
  ADD PRIMARY KEY (`cr_blogtagsID`),
  ADD UNIQUE KEY `cr_blogtagsName` (`cr_blogtagsName`);

--
-- Indexes for table `cr_blogtype`
--
ALTER TABLE `cr_blogtype`
  ADD PRIMARY KEY (`cr_blogtypeID`);

--
-- Indexes for table `cr_blogvisitor`
--
ALTER TABLE `cr_blogvisitor`
  ADD PRIMARY KEY (`cr_blogvisitorID`);

--
-- Indexes for table `cr_clients`
--
ALTER TABLE `cr_clients`
  ADD PRIMARY KEY (`cr_clientsID`);

--
-- Indexes for table `cr_comment`
--
ALTER TABLE `cr_comment`
  ADD PRIMARY KEY (`cr_commentID`);

--
-- Indexes for table `cr_contact`
--
ALTER TABLE `cr_contact`
  ADD PRIMARY KEY (`cr_contactID`);

--
-- Indexes for table `cr_customer`
--
ALTER TABLE `cr_customer`
  ADD PRIMARY KEY (`cr_customerID`);

--
-- Indexes for table `cr_fonts`
--
ALTER TABLE `cr_fonts`
  ADD PRIMARY KEY (`cr_fontsID`);

--
-- Indexes for table `cr_footer`
--
ALTER TABLE `cr_footer`
  ADD PRIMARY KEY (`cr_footerID`);

--
-- Indexes for table `cr_gallery`
--
ALTER TABLE `cr_gallery`
  ADD PRIMARY KEY (`cr_galleryID`);

--
-- Indexes for table `cr_general`
--
ALTER TABLE `cr_general`
  ADD PRIMARY KEY (`cr_generalID`);

--
-- Indexes for table `cr_history`
--
ALTER TABLE `cr_history`
  ADD PRIMARY KEY (`cr_historyID`);

--
-- Indexes for table `cr_inbox`
--
ALTER TABLE `cr_inbox`
  ADD PRIMARY KEY (`cr_inboxID`);

--
-- Indexes for table `cr_invoice`
--
ALTER TABLE `cr_invoice`
  ADD PRIMARY KEY (`cr_invoiceID`);

--
-- Indexes for table `cr_invoicedetail`
--
ALTER TABLE `cr_invoicedetail`
  ADD PRIMARY KEY (`cr_invoicedetailID`);

--
-- Indexes for table `cr_jumbotron`
--
ALTER TABLE `cr_jumbotron`
  ADD PRIMARY KEY (`cr_jumbotronID`);

--
-- Indexes for table `cr_language`
--
ALTER TABLE `cr_language`
  ADD PRIMARY KEY (`cr_languageID`);

--
-- Indexes for table `cr_map`
--
ALTER TABLE `cr_map`
  ADD PRIMARY KEY (`cr_mapID`);

--
-- Indexes for table `cr_mapmarker`
--
ALTER TABLE `cr_mapmarker`
  ADD PRIMARY KEY (`cr_mapmarkerID`);

--
-- Indexes for table `cr_media`
--
ALTER TABLE `cr_media`
  ADD PRIMARY KEY (`cr_mediaID`),
  ADD UNIQUE KEY `cr_mediaName` (`cr_mediaName`);

--
-- Indexes for table `cr_menu`
--
ALTER TABLE `cr_menu`
  ADD PRIMARY KEY (`cr_menuID`);

--
-- Indexes for table `cr_message`
--
ALTER TABLE `cr_message`
  ADD PRIMARY KEY (`cr_messageID`);

--
-- Indexes for table `cr_ourmenu`
--
ALTER TABLE `cr_ourmenu`
  ADD PRIMARY KEY (`cr_ourmenuID`),
  ADD KEY `cr_portfolioTitle` (`cr_ourmenuTitle`);

--
-- Indexes for table `cr_ourmenucategory`
--
ALTER TABLE `cr_ourmenucategory`
  ADD PRIMARY KEY (`cr_ourmenucategoryID`);

--
-- Indexes for table `cr_ourmenuingredients`
--
ALTER TABLE `cr_ourmenuingredients`
  ADD PRIMARY KEY (`cr_ourmenuingredientsID`),
  ADD UNIQUE KEY `cr_blogtagsName` (`cr_ourmenuingredientsName`);

--
-- Indexes for table `cr_ourmenuingredients_id`
--
ALTER TABLE `cr_ourmenuingredients_id`
  ADD PRIMARY KEY (`cr_ourmenuingredients_idID`),
  ADD UNIQUE KEY `cr_blogtagsName` (`cr_ourmenuingredientsName_id`);

--
-- Indexes for table `cr_pagetemplate`
--
ALTER TABLE `cr_pagetemplate`
  ADD PRIMARY KEY (`cr_pagetemplateID`);

--
-- Indexes for table `cr_portfolio`
--
ALTER TABLE `cr_portfolio`
  ADD PRIMARY KEY (`cr_portfolioID`),
  ADD KEY `cr_portfolioTitle` (`cr_portfolioTitle`);

--
-- Indexes for table `cr_portfoliocategory`
--
ALTER TABLE `cr_portfoliocategory`
  ADD PRIMARY KEY (`cr_portfoliocategoryID`);

--
-- Indexes for table `cr_portfolioextra`
--
ALTER TABLE `cr_portfolioextra`
  ADD PRIMARY KEY (`cr_portfolioextraID`);

--
-- Indexes for table `cr_portfoliolikes`
--
ALTER TABLE `cr_portfoliolikes`
  ADD PRIMARY KEY (`cr_portfoliolikesID`);

--
-- Indexes for table `cr_portfoliovisitor`
--
ALTER TABLE `cr_portfoliovisitor`
  ADD PRIMARY KEY (`cr_portfoliovisitorID`);

--
-- Indexes for table `cr_quotes`
--
ALTER TABLE `cr_quotes`
  ADD PRIMARY KEY (`cr_quotesID`);

--
-- Indexes for table `cr_services`
--
ALTER TABLE `cr_services`
  ADD PRIMARY KEY (`cr_servicesID`);

--
-- Indexes for table `cr_setting`
--
ALTER TABLE `cr_setting`
  ADD PRIMARY KEY (`cr_settingID`);

--
-- Indexes for table `cr_slider`
--
ALTER TABLE `cr_slider`
  ADD PRIMARY KEY (`cr_sliderID`);

--
-- Indexes for table `cr_social`
--
ALTER TABLE `cr_social`
  ADD PRIMARY KEY (`cr_socialID`);

--
-- Indexes for table `cr_submenu`
--
ALTER TABLE `cr_submenu`
  ADD PRIMARY KEY (`cr_submenuID`);

--
-- Indexes for table `cr_toppings`
--
ALTER TABLE `cr_toppings`
  ADD PRIMARY KEY (`cr_toppingsID`);

--
-- Indexes for table `cr_visitor`
--
ALTER TABLE `cr_visitor`
  ADD PRIMARY KEY (`cr_visitorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cr_admin`
--
ALTER TABLE `cr_admin`
  MODIFY `cr_adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cr_blog`
--
ALTER TABLE `cr_blog`
  MODIFY `cr_blogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cr_blogcategory`
--
ALTER TABLE `cr_blogcategory`
  MODIFY `cr_blogcategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cr_bloglikes`
--
ALTER TABLE `cr_bloglikes`
  MODIFY `cr_bloglikesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cr_blogtags`
--
ALTER TABLE `cr_blogtags`
  MODIFY `cr_blogtagsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cr_blogtype`
--
ALTER TABLE `cr_blogtype`
  MODIFY `cr_blogtypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cr_blogvisitor`
--
ALTER TABLE `cr_blogvisitor`
  MODIFY `cr_blogvisitorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cr_clients`
--
ALTER TABLE `cr_clients`
  MODIFY `cr_clientsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cr_comment`
--
ALTER TABLE `cr_comment`
  MODIFY `cr_commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cr_contact`
--
ALTER TABLE `cr_contact`
  MODIFY `cr_contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cr_customer`
--
ALTER TABLE `cr_customer`
  MODIFY `cr_customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1123;
--
-- AUTO_INCREMENT for table `cr_fonts`
--
ALTER TABLE `cr_fonts`
  MODIFY `cr_fontsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cr_footer`
--
ALTER TABLE `cr_footer`
  MODIFY `cr_footerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cr_gallery`
--
ALTER TABLE `cr_gallery`
  MODIFY `cr_galleryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cr_general`
--
ALTER TABLE `cr_general`
  MODIFY `cr_generalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cr_history`
--
ALTER TABLE `cr_history`
  MODIFY `cr_historyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;
--
-- AUTO_INCREMENT for table `cr_inbox`
--
ALTER TABLE `cr_inbox`
  MODIFY `cr_inboxID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cr_invoice`
--
ALTER TABLE `cr_invoice`
  MODIFY `cr_invoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `cr_invoicedetail`
--
ALTER TABLE `cr_invoicedetail`
  MODIFY `cr_invoicedetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `cr_jumbotron`
--
ALTER TABLE `cr_jumbotron`
  MODIFY `cr_jumbotronID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cr_language`
--
ALTER TABLE `cr_language`
  MODIFY `cr_languageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cr_map`
--
ALTER TABLE `cr_map`
  MODIFY `cr_mapID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cr_mapmarker`
--
ALTER TABLE `cr_mapmarker`
  MODIFY `cr_mapmarkerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cr_media`
--
ALTER TABLE `cr_media`
  MODIFY `cr_mediaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cr_menu`
--
ALTER TABLE `cr_menu`
  MODIFY `cr_menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `cr_message`
--
ALTER TABLE `cr_message`
  MODIFY `cr_messageID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cr_ourmenu`
--
ALTER TABLE `cr_ourmenu`
  MODIFY `cr_ourmenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cr_ourmenucategory`
--
ALTER TABLE `cr_ourmenucategory`
  MODIFY `cr_ourmenucategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `cr_ourmenuingredients`
--
ALTER TABLE `cr_ourmenuingredients`
  MODIFY `cr_ourmenuingredientsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `cr_ourmenuingredients_id`
--
ALTER TABLE `cr_ourmenuingredients_id`
  MODIFY `cr_ourmenuingredients_idID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `cr_pagetemplate`
--
ALTER TABLE `cr_pagetemplate`
  MODIFY `cr_pagetemplateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cr_portfolio`
--
ALTER TABLE `cr_portfolio`
  MODIFY `cr_portfolioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cr_portfoliocategory`
--
ALTER TABLE `cr_portfoliocategory`
  MODIFY `cr_portfoliocategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cr_portfolioextra`
--
ALTER TABLE `cr_portfolioextra`
  MODIFY `cr_portfolioextraID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cr_portfoliolikes`
--
ALTER TABLE `cr_portfoliolikes`
  MODIFY `cr_portfoliolikesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cr_portfoliovisitor`
--
ALTER TABLE `cr_portfoliovisitor`
  MODIFY `cr_portfoliovisitorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cr_quotes`
--
ALTER TABLE `cr_quotes`
  MODIFY `cr_quotesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cr_services`
--
ALTER TABLE `cr_services`
  MODIFY `cr_servicesID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cr_setting`
--
ALTER TABLE `cr_setting`
  MODIFY `cr_settingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `cr_slider`
--
ALTER TABLE `cr_slider`
  MODIFY `cr_sliderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cr_social`
--
ALTER TABLE `cr_social`
  MODIFY `cr_socialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `cr_submenu`
--
ALTER TABLE `cr_submenu`
  MODIFY `cr_submenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cr_toppings`
--
ALTER TABLE `cr_toppings`
  MODIFY `cr_toppingsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `cr_visitor`
--
ALTER TABLE `cr_visitor`
  MODIFY `cr_visitorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
