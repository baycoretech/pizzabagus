<?php
/**
 * Class Setup
 *
 * @author baycore
 */

class Setup_Page {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function collect_database($database_name, $database_username, $database_password) {
    	//database
		$write_database_setup = $database_name.','.$database_username.','.$database_password;
		if(!file_put_contents(__DIR__.'/../database/database.php', $write_database_setup)) {
			return false;
		}
		else {
			return true;
		}
	}
	public function create_database_table($site_name, $site_url, $folder_name, $admin_username, $admin_password_encrypt, $admin_password, $admin_email, $url_value) {
		//CREATE TABLE ADMIN
	    $result = $this->pdo->query("CREATE table cr_admin(
	     cr_adminID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_adminUsername VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
	     cr_adminPassword VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminEmail VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminPhoto VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminRegistered DATETIME NOT NULL,
	     cr_adminDisplayName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminLevel INT( 1 ) NOT NULL,
	     cr_adminAbout VARCHAR ( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminLastlogin DATETIME NOT NULL,
	     cr_adminFacebook VARCHAR ( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminGoogleplus VARCHAR ( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminTwitter VARCHAR ( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminToken VARCHAR ( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	    //
	    ////
	    	$result = $this->pdo->query("INSERT INTO cr_admin(
	    	 cr_adminUsername, cr_adminPassword, cr_adminEmail, cr_adminPhoto, cr_adminRegistered, cr_adminDisplayName, cr_adminLevel) VALUES (
	    	 '$admin_username', '$admin_password_encrypt', '$admin_email', 'assets/img/no-pic.png', NOW(), '$admin_username', '1')");

	    //CREATE TABLE BLOG
	    $result = $this->pdo->query("CREATE table cr_blog(
	     cr_blogID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_blogTitle VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
	     cr_blogContent TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_blogPostdate DATETIME NOT NULL,
	     cr_blogModifieddate DATETIME NOT NULL,
	     cr_blogLink VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_blogtypeID INT( 11 ) NOT NULL,
	     cr_blogcategoryID INT( 11 ) NOT NULL,
	     cr_blogTags TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	     cr_blogComment VARCHAR( 3 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_blogFeatured VARCHAR( 500 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_blogMetaKeywords TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_blogMetaDescription TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_blogStatus VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //SET FULLTEXT SEARCHING FOR RELATED POST
	    $result = $this->pdo->query("ALTER TABLE cr_blog ADD FULLTEXT (cr_blogTitle, cr_blogContent)");

	    //SET FULLTEXT SEARCHING FOR TAG SEARCHING
	    $result = $this->pdo->query("ALTER TABLE cr_blog ADD FULLTEXT (cr_blogTags)");

	    //CREATE TABLE BLOG CATEGORY
	    $result = $this->pdo->query("CREATE table cr_blogcategory(
	     cr_blogcategoryID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_blogcategoryName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
	     cr_blogcategorySlug VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
	     cr_blogcategoryLink VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_blogcategoryCreateddate DATETIME NOT NULL,
	     cr_blogcategoryModifieddate DATETIME NOT NULL,
	     cr_blogcategoryOrder INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE BLOG LIKES
	    $result = $this->pdo->query("CREATE table cr_bloglikes(
	     cr_bloglikesID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_bloglikesIP VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_bloglikesDate DATETIME NOT NULL,
	     cr_blogID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE BLOG TAGS
	    $result = $this->pdo->query("CREATE table cr_blogtags(
	     cr_blogtagsID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_blogtagsName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, UNIQUE (cr_blogtagsName)) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE BLOG TYPE
	    $result = $this->pdo->query("CREATE table cr_blogtype(
	     cr_blogtypeID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_blogtypeName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	    //
	    ////
	    	$result = $this->pdo->query("INSERT INTO cr_blogtype(
	    	 cr_blogtypeName) VALUES ('standard')");
	    	$result = $this->pdo->query("INSERT INTO cr_blogtype(
	    	 cr_blogtypeName) VALUES ('image')");
	    	$result = $this->pdo->query("INSERT INTO cr_blogtype(
	    	 cr_blogtypeName) VALUES ('video')");
	    	$result = $this->pdo->query("INSERT INTO cr_blogtype(
	    	 cr_blogtypeName) VALUES ('sound')");

	    //CREATE TABLE BLOG VISITOR
	    $result = $this->pdo->query("CREATE table cr_blogvisitor(
	     cr_blogvisitorID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_blogvisitorIP VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_blogvisitorDate DATETIME NOT NULL,
	     cr_blogID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE CLIENTS
	    $result = $this->pdo->query("CREATE table cr_clients(
	     cr_clientsID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_clientsName VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_clientsLink VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	     cr_clientsImage VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_clientsOrder INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE COMMENTS
	    $result = $this->pdo->query("CREATE table cr_comment(
	     cr_commentID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_commentName VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_commentEmail VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_commentWebsite VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_commentContent VARCHAR( 1000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_commentDate DATETIME NOT NULL,
	     cr_commentStatus INT( 1 ) NOT NULL,
	     cr_commentReply INT( 11 ) NOT NULL,
	     cr_adminID INT( 11 ) NULL,
	     cr_blogID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE CONTACT
	    $result = $this->pdo->query("CREATE table cr_contact(
	     cr_contactID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_contactCustomheader VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_contactCustomDesc TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_contactDesc TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_contactSocial VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_contactLink VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE FONTS
	    $result = $this->pdo->query("CREATE table cr_fonts(
	     cr_fontsID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_fontsName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_fontsLink VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_fontsFamily VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_fontsApplied VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE FOOTER
	    $result = $this->pdo->query("CREATE table cr_footer(
	     cr_footerID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_footerName VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_footerType VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_footerTitle VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_footerContent TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	    //
	    ////
	    	$result = $this->pdo->query("INSERT INTO cr_footer(
	    	 cr_footerName) VALUES ('footer-column1')");
	    	$result = $this->pdo->query("INSERT INTO cr_footer(
	    	 cr_footerName) VALUES ('footer-column2')");
	    	$result = $this->pdo->query("INSERT INTO cr_footer(
	    	 cr_footerName) VALUES ('footer-column3')");
	    	$result = $this->pdo->query("INSERT INTO cr_footer(
	    	 cr_footerName) VALUES ('footer-column4')");

	    //CREATE TABLE GALLERY
	    $result = $this->pdo->query("CREATE table cr_gallery(
	     cr_galleryID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_galleryTitle VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_galleryDesc TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_galleryDate DATETIME NOT NULL,
	     cr_galleryThumb VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_galleryLink VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_galleryOrder INT( 11 ) NOT NULL,
	     cr_adminID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE GENERAL
	    $result = $this->pdo->query("CREATE table cr_general(
	     cr_generalID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_generalTitle VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_generalColumn1 TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_generalColumn2 TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_generalColumn3 TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_generalFeaturedImage VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	     cr_generalMetaKeywords TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_generalMetaDescription TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_generalPostdate DATETIME NOT NULL,
	     cr_generalModifieddate DATETIME NOT NULL,
	     cr_generalLink VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE HISTORY
	    $result = $this->pdo->query("CREATE table cr_history(
	     cr_historyID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_historyTitle VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_historyDetail TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_historyDateTime DATETIME NOT NULL,
	     cr_adminID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE INBOX
	    $result = $this->pdo->query("CREATE table cr_inbox(
	     cr_inboxID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_inboxSubject VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_inboxContent TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_inboxFrom INT( 11 ) NOT NULL,
	     cr_inboxTo INT( 11 ) NOT NULL,
	     cr_inboxDate DATETIME NOT NULL,
	     cr_inboxRead INT( 1 ) NOT NULL,
	     cr_inboxTimestamp VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_inboxFromFolder VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_inboxToFolder VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_inboxType VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");	 

	    //CREATE TABLE JUMBOTRON
	    $result = $this->pdo->query("CREATE table cr_jumbotron(
	     cr_jumbotronID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_jumbotronName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_jumbotronImage VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_jumbotronCaption VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_jumbotronDesc TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_jumbotronButtontext VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_jumbotronButtonLink VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_jumbotronTextposition VARCHAR( 6 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_jumbotronColorscheme VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");	
	    //
	    ////
	    	$result = $this->pdo->query("INSERT INTO cr_jumbotron(
		    	 cr_jumbotronName, cr_adminID) VALUES 
		    	('plainjumbotron', '1'),
		    	('backgroundjumbotron', '1')");

	    //CREATE TABLE MAP
	    $result = $this->pdo->query("CREATE table cr_map(
	     cr_mapID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_mapLatLong VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_mapDesc TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_mapmarkerID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE MAP MARKER
	    $result = $this->pdo->query("CREATE table cr_mapmarker(
	     cr_mapmarkerID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_mapmarkerName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_mapmarkerImage VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	    //
	    ////
	    	$result = $this->pdo->query("INSERT INTO cr_mapmarker(
		    	 cr_mapmarkerName, cr_mapmarkerImage) VALUES 
		    	('Default Marker', 'cr-include/images/map-marker/map-marker-default.png'),
		    	('Bubble Pink', 'cr-include/images/map-marker/map-marker-bubble-pink.png'),
		    	('Buble Azure', 'cr-include/images/map-marker/map-marker-bubble-azure.png'),
		    	('Bubble Chartreuse', 'cr-include/images/map-marker/map-marker-bubble-chartreuse.png')");

	    //CREATE TABLE MEDIA
	    $result = $this->pdo->query("CREATE table cr_media(
	     cr_mediaID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_mediaName VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_mediaDate DATETIME NOT NULL,
	     cr_mediaTitle VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_mediaDesc TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminID INT( 11 ) NOT NULL, UNIQUE (cr_mediaName)) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE MENU
	    $result = $this->pdo->query("CREATE table cr_menu(
	     cr_menuID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_menuTitle VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_menuLink VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_menuOrder INT( 11 ) NOT NULL,
	     cr_menuHasSub INT( 11 ) NOT NULL,
	     cr_menuStatus INT( 1 ) NOT NULL,
	     cr_pagetemplateID INT( 11 ) NOT NULL,
	     cr_option VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE MESSAGE
	    $result = $this->pdo->query("CREATE table cr_message(
	     cr_messageID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_messageSubject VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_messageContent TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_messageName VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_messageEmail VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_messageDate DATETIME NOT NULL,
	     cr_messageRead INT( 1 ) NOT NULL,
	     cr_messageFolder VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_messageReplied INT( 1 ) NOT NULL,
	     cr_messageType VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE PAGE TEMPLATE
	    $result = $this->pdo->query("CREATE table cr_pagetemplate(
	     cr_pagetemplateID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_pagetemplateName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_pagetemplateImage VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_pagetemplateType VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_pagetemplateColumn INT( 1 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	    //
	    ////
	    	$result = $this->pdo->query("INSERT INTO cr_pagetemplate(
	    	 cr_pagetemplateName, cr_pagetemplateImage, cr_pagetemplateType, cr_pagetemplateColumn) VALUES ('One Columns', 'assets/img/pagetemplate-one-column.png', 'general', '1')");
	    	$result = $this->pdo->query("INSERT INTO cr_pagetemplate(
	    	 cr_pagetemplateName, cr_pagetemplateImage, cr_pagetemplateType, cr_pagetemplateColumn) VALUES ('Two Columns', 'assets/img/pagetemplate-two-column.png', 'general', '2')");
	    	$result = $this->pdo->query("INSERT INTO cr_pagetemplate(
	    	 cr_pagetemplateName, cr_pagetemplateImage, cr_pagetemplateType, cr_pagetemplateColumn) VALUES ('Three Columns', 'assets/img/pagetemplate-three-column.png', 'general', '3')");
	    	$result = $this->pdo->query("INSERT INTO cr_pagetemplate(
	    	 cr_pagetemplateName, cr_pagetemplateImage, cr_pagetemplateType, cr_pagetemplateColumn) VALUES ('Left Sidebar', 'assets/img/pagetemplate-blog-left-sidebar.png', 'blog', '2')");
	    	$result = $this->pdo->query("INSERT INTO cr_pagetemplate(
	    	 cr_pagetemplateName, cr_pagetemplateImage, cr_pagetemplateType, cr_pagetemplateColumn) VALUES ('Right Sidebar', 'assets/img/pagetemplate-blog-right-sidebar.png', 'blog', '2')");
	    	$result = $this->pdo->query("INSERT INTO cr_pagetemplate(
	    	 cr_pagetemplateName, cr_pagetemplateImage, cr_pagetemplateType, cr_pagetemplateColumn) VALUES ('Three Columns', 'assets/img/pagetemplate-portfolio-three-column.png', 'portfolio', '3')");
	    	$result = $this->pdo->query("INSERT INTO cr_pagetemplate(
	    	 cr_pagetemplateName, cr_pagetemplateImage, cr_pagetemplateType, cr_pagetemplateColumn) VALUES ('Four Columns', 'assets/img/pagetemplate-portfolio-four-column.png', 'portfolio', '4')");
	    	$result = $this->pdo->query("INSERT INTO cr_pagetemplate(
	    	 cr_pagetemplateName, cr_pagetemplateImage, cr_pagetemplateType, cr_pagetemplateColumn) VALUES ('Three Columns with Detail', 'assets/img/pagetemplate-portfolio-three-column-with-detail.png', 'portfolio', '3')");
	    	$result = $this->pdo->query("INSERT INTO cr_pagetemplate(
	    	 cr_pagetemplateName, cr_pagetemplateImage, cr_pagetemplateType, cr_pagetemplateColumn) VALUES ('Four Columns with Detail', 'assets/img/pagetemplate-portfolio-four-column-with-detail.png', 'portfolio', '4')");

	    //CREATE TABLE PORTFOLIO
	    $result = $this->pdo->query("CREATE table cr_portfolio(
	     cr_portfolioID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_portfolioTitle VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfolioLink VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfolioDesc TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfolioDate DATETIME NOT NULL,
	     cr_portfolioSliderimage TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfolioThumb VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfolioSelected VARCHAR( 3 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfoliocategoryID INT( 11 ) NOT NULL,
	     cr_portfolioMetaKeywords TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfolioMetaDescription TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfolioStatus VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //SET INDEX FOR PORTFOLIO TITLE
	    $result = $this->pdo->query("ALTER TABLE cr_portfolio ADD INDEX (cr_portfolioTitle)");

	    //CREATE TABLE PORTFOLIO CATEGORY
	    $result = $this->pdo->query("CREATE table cr_portfoliocategory(
	     cr_portfoliocategoryID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_portfoliocategoryName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfoliocategoryLink VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfoliocategoryDate DATETIME NOT NULL,
	     cr_portfoliocategoryOrder INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE PORTFOLIO EXTRA
	    $result = $this->pdo->query("CREATE table cr_portfolioextra(
	     cr_portfolioextraID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_portfolioextraName VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfolioextraContent TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfolioextraOrder INT( 11 ) NOT NULL,
	     cr_portfolioID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

		//CREATE TABLE PORTFOLIO LIKES
	    $result = $this->pdo->query("CREATE table cr_portfoliolikes(
	     cr_portfoliolikesID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_portfoliolikesIP VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfoliolikesDate DATETIME NOT NULL,
	     cr_portfolioID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE PORTFOLIO VISITOR
	    $result = $this->pdo->query("CREATE table cr_portfoliovisitor(
	     cr_portfoliovisitorID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_portfoliovisitorIP VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_portfoliovisitorDate DATETIME NOT NULL,
	     cr_portfolioID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE QUOTES
	    $result = $this->pdo->query("CREATE table cr_quotes(
	     cr_quotesID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_quotesName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_quotesPhoto VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	     cr_quotesText TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_quotesStatus VARCHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE SERVICE
	    $result = $this->pdo->query("CREATE table cr_services(
	     cr_servicesID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_servicesName VARCHAR( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_servicesDesc TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_servicesImage VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	     cr_adminID INT( 11 )  NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");	 

	    //CREATE TABLE SETTING
	    $result = $this->pdo->query("CREATE table cr_setting(
	     cr_settingID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_settingName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_settingValue VARCHAR( 500 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL)  ENGINE=MyISAM DEFAULT CHARSET=utf8");
	    //
	    ////
	    	if($url_value == 1) {
		    	$result = $this->pdo->query("INSERT INTO cr_setting(
		    	 cr_settingName, cr_settingValue) VALUES 
		    	('sitename', '$site_name'),
		    	('siteurl', '$site_url'),
		    	('foldername', '$folder_name'),
		    	('tagline', ''),
		    	('template', 'reen'),
		    	('email', ''),
		    	('phone', ''),
		    	('secondaryfooter', 'NULL,Powered by <a href=\"http://creativabali.com\">Technologia Creativa</a>'),
		    	('metakeywords', ''),
		    	('metadescription', ''),
		    	('contactheader', ''),
		    	('address', ''),
		    	('websitelogo', ''),
		    	('colorscheme', 'green'),
		    	('homepagestyle', 'image-slider,NULL,NULL,NULL'),
		    	('favicon', ''),
		    	('timezone', '(UTC+08:00) Asia/Makassar'),
		    	('recaptchasitekey', '6LcDihITAAAAABBLxl-IiN2TRVWqiHv2Oqi0VTLZ'),
		    	('recaptchasecret', '6LcDihITAAAAAPYjBF-VsXxZaHfT7uV91XUadWw0'),
		    	('customprimary', ''),
		    	('customsecondary', ''),
		    	('googlemapapi', 'AIzaSyC68T-zrmjNmWoFgsjgX2ws7TlR4PV9Nfk'),
		    	('googleanalyticscode', ''),
		    	('layoutmode', ''),
		    	('backgroundtemplate', ''),
		    	('dateformat', 'F d, Y'),
		    	('timeformat', 'g:i a'),
		    	('comingsoon', 'disable'),
		    	('datetimemaintenance', ''),
		    	('backgroundrepeat', ''),
		    	('backgroundposition', ''),
		    	('backgroundattachment', ''),
		    	('backgroundsize', ''),
		    	('homepagelink', 'show'),
		    	('backgroundlogin', ''),
		    	('footer-column4', 'disable'),
		    	('invoicelogo', ''),
		    	('quotesinpage', ''),
		    	('servicestitle', 'Services'),
		    	('servicesinpage', ''),
		    	('clientspartnersinpage', ''),
		    	('quotestitle', ''),
		    	('userplan', 'probasic'),
		    	('totalpage', '999999'),
		    	('instafeeduserid', ''),
		    	('instafeedaccesstoken', ''),
		    	('clientstitle', 'Our Clients')");
		    }
		    else {
		    	$result = $this->pdo->query("INSERT INTO cr_setting(
		    	 cr_settingName, cr_settingValue) VALUES 
		    	('sitename', '$site_name'),
		    	('siteurl', '$site_url'),
		    	('foldername', '$folder_name'),
		    	('tagline', ''),
		    	('template', 'reen'),
		    	('email', ''),
		    	('phone', ''),
		    	('secondaryfooter', 'NULL,Powered by <a href=\"http://creativabali.com\">Technologia Creativa</a>'),
		    	('metakeywords', ''),
		    	('metadescription', ''),
		    	('contactheader', ''),
		    	('address', ''),
		    	('websitelogo', ''),
		    	('colorscheme', 'green'),
		    	('homepagestyle', 'image-slider,NULL,NULL,NULL'),
		    	('favicon', ''),
		    	('timezone', '(UTC+08:00) Asia/Makassar'),
		    	('recaptchasitekey', ''),
		    	('recaptchasecret', ''),
		    	('customprimary', ''),
		    	('customsecondary', ''),
		    	('googlemapapi', ''),
		    	('googleanalyticscode', ''),
		    	('layoutmode', ''),
		    	('backgroundtemplate', ''),
		    	('dateformat', 'F d, Y'),
		    	('timeformat', 'g:i a'),
		    	('comingsoon', 'disable'),
		    	('datetimemaintenance', ''),
		    	('backgroundrepeat', ''),
		    	('backgroundposition', ''),
		    	('backgroundattachment', ''),
		    	('backgroundsize', ''),
		    	('homepagelink', 'show'),
		    	('backgroundlogin', ''),
		    	('footer-column4', 'disable'),
		    	('invoicelogo', ''),
		    	('quotesinpage', ''),
		    	('servicestitle', 'Services'),
		    	('servicesinpage', ''),
		    	('clientspartnersinpage', ''),
		    	('quotestitle', ''),
		    	('userplan', 'probasic'),
		    	('totalpage', '999999'),
		    	('instafeeduserid', ''),
		    	('instafeedaccesstoken', ''),
		    	('clientstitle', 'Our Clients')");
		    }

	    //CREATE TABLE SLIDER
	    $result = $this->pdo->query("CREATE table cr_slider(
	     cr_sliderID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_sliderImage VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_sliderCaption VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_sliderDesc TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_sliderButtontext VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_sliderButtonlink VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_sliderTextposition VARCHAR( 6 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_adminID INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	    //
	    ////
	    	$result = $this->pdo->query("INSERT INTO cr_slider(
	    	 cr_sliderImage, cr_sliderCaption, cr_sliderDesc, cr_sliderTextposition, cr_adminID) VALUES ('f01bfa094347d65475e748b8d0d27bcd.jpeg', 'WELCOME TO MY WEBSITE', 'Create Your Creative Website with Creatify','center', '1')");

	    //CREATE TABLE SOCIAL
	    $result = $this->pdo->query("CREATE table cr_social(
	     cr_socialID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_socialName VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_socialLink VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_socialIcon VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_socialImage VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_socialOrder INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	    //
	    ////
	    	$result = $this->pdo->query("INSERT INTO cr_social (cr_socialName, cr_socialLink, cr_socialIcon, cr_socialImage, cr_socialOrder) VALUES
				('facebook', 'Empty', '<i class=\"fa fa-facebook\"></i>', 'assets/img/social-icon/facebook.png', 5),
				('twitter', 'Empty', '<i class=\"fa fa-twitter\"></i>', 'assets/img/social-icon/twitter.png', 4),
				('instagram', 'Empty', '<i class=\"fa fa-instagram\"></i>', 'assets/img/social-icon/instagram.png', 3),
				('tumblr', 'Empty', '<i class=\"fa fa-tumblr\"></i>', 'assets/img/social-icon/tumblr.png', 8),
				('pinterest', 'Empty', '<i class=\"fa fa-pinterest-p\"></i>', 'assets/img/social-icon/pinterest.png', 2),
				('youtube', 'Empty', '<i class=\"fa fa-youtube\"></i>', 'assets/img/social-icon/youtube.png', 1),
				('behance', 'Empty', '<i class=\"fa fa-behance\"></i>', 'assets/img/social-icon/behance.png', 9),
				('dribbble', 'Empty', '<i class=\"fa fa-dribbble\"></i>', 'assets/img/social-icon/dribbble.png', 7),
				('github', 'Empty', '<i class=\"fa fa-github\"></i>', 'assets/img/social-icon/github.png', 6),
				('soundcloud', 'Empty', '<i class=\"fa fa-soundcloud\"></i>', 'assets/img/social-icon/soundcloud.png', 10),
				('google-plus', 'Empty', '<i class=\"fa fa-google-plus\"></i>', 'assets/img/social-icon/google-plus.png', 11),
				('skype', 'Empty', '<i class=\"fa fa-skype\"></i>', 'assets/img/social-icon/skype.png', 12)");

	    //CREATE TABLE SUBMENU
	    $result = $this->pdo->query("CREATE table cr_submenu(
	     cr_submenuID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_submenuTitle VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_submenuLink VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_menuID INT( 11 ) NOT NULL,
	     cr_submenuStatus INT( 1 ) NOT NULL,
	     cr_pagetemplateID INT( 11 ) NOT NULL,
	     cr_option VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_submenuOrder INT( 11 ) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    //CREATE TABLE VISITOR
	    $result = $this->pdo->query("CREATE table cr_visitor(
	     cr_visitorID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
	     cr_visitorIP VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_visitorBrowser VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_visitorPlatform VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	     cr_visitorDate DATETIME NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");

	    return $result;
	}
	public function last_setup() {
	    $result = $this->pdo->query("SELECT * FROM cr_admin ORDER BY cr_adminID desc LIMIT 1 ");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
	}
}
?>