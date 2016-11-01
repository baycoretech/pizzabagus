<?php
	header('Content-type: text/plain');
	require_once "cr-include/database.php";//database
  	require_once "cr-include/config.php";
  	require_once "cr-include/class-data.php";
  	require_once "cr-include/global-function.php";
?>
User-agent: *
Disallow: /cgi-bin
Disallow: /cr-admin
Disallow: /cr-include
User-agent: Mediapartners-Google
Allow: /
User-agent: Adsbot-Google
Allow: /
User-agent: Googlebot-Image
Allow: /
User-agent: Googlebot-Mobile
Allow: /
Sitemap: <?php echo MURL ?>/sitemap.xml
#Begin Attracta SEO Tools Sitemap. Do not remove
sitemap: http://cdn.attracta.com/sitemap/4214615.xml.gz
#End Attracta SEO Tools Sitemap. Do not remove
