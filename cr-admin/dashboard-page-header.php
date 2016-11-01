<!-- begin page-header -->
<h1 class="page-header">
	<?php
		if($section == "coloring")
			echo "Coloring";
		elseif($section == "fonts")
			echo "Fonts";
		elseif($section == "feedback")
			echo "Feedback";
		elseif($section == "media")
			echo "Media";
		elseif($section == "media-gallery")
			echo "Media Galley";
		elseif($section == "font-coloring")
			echo "Font Coloring";
		elseif($section == "themes")
			echo "Themes";
		elseif($section == "logo")
			echo "Logo";
		elseif($section == "custom-css")
			echo "Custom CSS";
		elseif($section == "favicon")
			echo "Favicon";
		elseif($section == "fonts")
			echo "Fonts";
		elseif($section == "additional-toppings")
			echo "Additional Toppings";
		elseif($section == "home-page-style")
			echo "Home Page Style";
		elseif($section == "contact-header")
			echo "Contact Header";
		elseif($section == "footer")
			echo "Secondary Footer";
		elseif($section == "menu")
			echo "Menu";
		elseif($section == "history")
			echo "History";
		elseif($section == "mail")
			echo "Mail";
		elseif($section == "users")
			echo "Users";
		elseif($section == "customers")
			echo "Customers";
		elseif($section == "invoice")
			echo "Invoice";
		elseif($section == "social")
			echo "Social";
		elseif($section == "profile")
			echo "Profile";
		elseif($section == "slider")
			echo "Slider Image";
		elseif($section == "quotes")
			echo "Quotes";
		elseif($section == "services")
			echo "Services";
		elseif($section == "clients")
			echo "Clients";
		elseif($section == "primary-footer")
			echo "Primary Footer";
		elseif($section == "secondary-footer")
			echo "Secondary Footer";
		elseif($section == "services")
			echo "Services";
		elseif($section == "homepage")
			echo "Homepage Styles";
		elseif($section == "map")
			echo "Map";
		elseif($section == "disk-usage")
			echo "Disk Usage";
		elseif($section == "settings")
			echo "Settings";
		elseif($section == "payment-information")
			echo "Payment Information";
		elseif($section == "term-of-service")
			echo "Term of Service";
		elseif($section == "custom-homepage-content")
			echo "Custom Home Page Content";
		elseif($section == "page") {
			if($id == 'comment' )
				echo "Comments";
			else {
				echo $function_view_page_title;
			}
		}
		else {
	?>
	Dashboard 
	<?php } ?>
	<small></small>
</h1>
<!-- end page-header -->