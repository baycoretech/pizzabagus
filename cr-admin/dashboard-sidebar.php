<?php
	$class_menu = new menu($pdo);
    $function_view_menu = $class_menu->view_menu();
?>
<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<a href="<?php echo $router->generate('admin-dashboard') ?>" data-toggle="nav-profile">
                    <div class="image">
                        <img <?php if($admin_photo == 'assets/img/no-pic.png') echo 'class="no-admin-photo"' ?> <?php if($admin_photo != 'assets/img/no-pic.png') { ?> src="<?php if($admin_photo == '') echo MADMINURL."assets/img/no-pic.png"; else echo MADMINURL.$admin_photo ?>" <?php } else { ?> data-name="<?php echo ucwords($admin_display); ?>" data-font-size="36" data-width="50" data-height="50" <?php } ?> alt="<?php echo ucwords($admin_display); ?>" />
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        <?php echo ucwords($admin_display); ?>
                        <small><?php if($admin_level == 1) echo "Administrator"; elseif($admin_level == 2) echo "Editor"; ?></small>
                    </div>
				</a>
			</li>
            <li>
                <ul class="nav nav-profile">
                    <li <?php if($section == "profile") echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'profile')) ?>"><i class="material-icons">person</i> Profile</a></li>
                    <?php
                        if($admin_level == 1) {
                    ?>
                    <li <?php if($section == "settings") echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'settings')) ?>"><i class="material-icons">settings</i> Settings</a></li>
                    <li class="has-sub <?php if($section == "payment-information" || $section == "term-of-service") echo "active" ?>">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="material-icons">shopping_cart</i>
							<span>Commerce Settings</span>
						</a>
						<ul class="sub-menu">
							<li <?php if($section == 'payment-information') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'payment-information')) ?>">Payment Information</a></li>
							<li <?php if($section == 'term-of-service') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'term-of-service')) ?>">Term of Service</a></li>
						</ul>
					</li>
                    <?php } ?>
                </ul>
            </li>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav">
			<li class="<?php if(!isset($section)) echo "active"; ?>">
				<a href="<?php echo $router->generate('admin-dashboard') ?>">
					<i class="material-icons">home</i>
					<span>Dashboard</span>
				</a>
			</li>
			<?php if($admin_level == 1) { ?>
			<li class="has-sub <?php if($section == "coloring" || $section == "home-page-style" || $section == "logo" || $section == "favicon" || $section == "themes" || $section == "fonts" || $section == "custom-css") echo "active" ?>">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="material-icons">color_lens</i>
					<span>Appearance</span>
				</a>
				<ul class="sub-menu">
					<li <?php if($section == 'themes') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'themes')) ?>">Themes</a></li>
					<li <?php if($section == 'home-page-style') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'home-page-style')) ?>">Home Page Style </a></li>
					<li <?php if($section == 'coloring') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'coloring')) ?>">Coloring</a></li>
					<li <?php if($section == 'custom-css') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'custom-css')) ?>">Custom CSS</a></li>
					<li <?php if($section == 'fonts') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'fonts')) ?>">Fonts</a></li>
					<li <?php if($section == 'logo') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'logo')) ?>">Logo</a></li>
					<li <?php if($section == 'favicon') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'favicon')) ?>">Favicon</a></li>
				</ul>
			</li>
			<li class="has-sub <?php if($section == "slider" || $section == "custom-homepage-content" || $section == "map" || $section == "footer" || $section == "primary-footer" || $section == "clients"|| $section == "services" || $section == "quotes" || $section == "contact-header") echo "active" ?>">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="material-icons">view_compact</i>
					<span>Section</span>
				</a>
				<ul class="sub-menu">
					<li <?php if($section == 'contact-header') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'contact-header')) ?>">Contact Header</a></li>
					<li <?php if($section == 'clients') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'clients')) ?>">Clients</a></li>
					<li <?php if($section == 'slider') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'slider')) ?>">Slider Image</a></li>
					<li <?php if($section == 'custom-homepage-content') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'custom-homepage-content')) ?>">Custom Home Page Content</a></li>
					<li <?php if($section == 'map') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'map')) ?>">Map</a></li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							Footer
						</a>
						<ul class="sub-menu" <?php if($section == 'primary-footer' || $section == 'footer') echo 'style="display:block"' ?>>
							<li <?php if($section == 'primary-footer') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'primary-footer')) ?>">Primary Footer </a></li>
							<li <?php if($section == 'footer') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'footer')) ?>">Secondary Footer </a></li>
						</ul>
					</li>
					<li <?php if($section == 'quotes') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'quotes')) ?>">Quotes</a></li>
					<li <?php if($section == 'services') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'services')) ?>">Services</a></li>
				</ul>
			</li>
			<?php } ?>
			<li class="has-sub <?php if($section == "media" || $section == "media-gallery") echo "active" ?>">
				<a href="javascript:;">
					<!--<span class="badge pull-right">10</span>-->
					<b class="caret pull-right"></b>
					<i class="material-icons">collections</i>
					<span>Media <!--<span class="label label-theme m-l-5">NEW</span></span>-->
				</a>
				<ul class="sub-menu">
					<li <?php if($section == 'media') echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'media')) ?>">All Media</a></li>
					<!--<li><a href="<?php echo MADMINURL; ?>/media-gallery">Media Gallery</a></li>-->
				</ul>
			</li>
			<?php if($admin_level == 1) { ?>
			<li class="<?php if($section == "menu") echo "active"; ?>">
				<a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'menu')) ?>">
					<i class="material-icons">menu</i>
					<span>Menu</span>
				</a>
			</li>
			<?php
				}
				if($function_view_menu != false) {
			?>
			<li class="has-sub <?php if($section == "page") echo "active" ?>">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="material-icons">import_contacts</i>
					<span>Page</span>
				</a>
				<ul class="sub-menu">
					<?php
						foreach ($function_view_menu as $menu) {
							$menu_id     = $menu->cr_menuID;
							$menu_title  = $menu->cr_menuTitle;
							$menu_slug   = $menu->cr_menuLink;
							$menu_hassub = $menu->cr_menuHasSub;
							$function_view_menu_sub = $class_menu->view_menu_sub($menu_id);
							if($menu->cr_option != 'customlink') {
					?>
					<li class="<?php if($menu_hassub == 1) echo 'has-sub '; if($action == $menu_slug) echo 'active' ?>">
						<a href="<?php if($menu_hassub == 1) { echo "javascript:;"; } else { if($menu->cr_option == 'customlink') echo $menu->cr_menuLink; else echo $router->generate('admin-dashboard-action', array('section' => 'page', 'action' => $menu_slug)); } ?>">
							<?php if($menu_hassub == 1) { if($function_view_menu_sub == false) echo ''; else echo '<b class="caret pull-right"></b>'; } ?>
							<?php echo $menu_title ?>
						</a>
						<?php 
				    		if($menu_hassub != false) {
				    			if($function_view_menu_sub == false) {
				    	?>
				    		<ul class="sub-menu">
								<li><a>This page have no submenu</a></li>	
							</ul>
				    	<?php
				    			}
				    			else {
				    	?>
					    	<ul class="sub-menu">
					    		<?php
					    			foreach ($function_view_menu_sub as $submenu) {
					    				if($submenu->cr_option != 'customlink') {
					    		?>
								<li <?php if($action == $submenu->cr_submenuLink) echo 'class="active"' ?>><a href="<?php if($submenu->cr_option == 'customlink') echo $submenu->cr_submenuLink; else echo $router->generate('admin-dashboard-action', array('section' => 'page', 'action' => $submenu->cr_submenuLink)); ?>"><?php echo $submenu->cr_submenuTitle ?> <?php if($submenu->cr_option == 'customlink') { ?><i class="fa fa-external-link-square text-theme"></i><?php } ?></a></li>
								<?php
									} }
								?>	
							</ul>
						<?php } } ?>
					</li>
					<?php } } ?>
				</ul>
			</li>
			<?php
				}
			?>			
			<li class="has-sub <?php if($section == "message" || $section == "inbox") echo "active" ?>">
				<a href="javascript:;">
					<b class="caret pull-right"></b>
					<i class="material-icons">inbox</i>
					<span>Mail</span> <span id="totalnotif2" class="badge pull-right"></span>
				</a>
				<ul class="sub-menu">
					<li <?php if($section == 'inbox') echo 'class="active"' ?>><a id="totalinbox" href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'inbox')) ?>">Inbox</a></li>
					<li <?php if($section == 'message') echo 'class="active"' ?>><a id="totalmessage" href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'message')) ?>">Message</a></li>
				</ul>
			</li>
			<?php if($admin_level == 1) { ?>
			<li class="has-sub <?php if($section == "social") echo "active" ?>">
				<a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'social')) ?>">
					<i class="material-icons">share</i>
					<span>Social</span>
				</a>
			</li>
			<li class="has-sub <?php if($section == "invoice") echo "active" ?>">
				<a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'invoice')) ?>">
					<i class="material-icons">description</i>
					<span>Invoice</span>
				</a>
			</li>
			<li class="has-sub <?php if($section == "customers") echo "active" ?>">
				<a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'customers')) ?>">
					<i class="material-icons">people</i>
					<span>Customers</span>
				</a>
			</li>
			<li class="has-sub <?php if($section == "users") echo "active" ?>">
				<a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'users')) ?>">
					<i class="material-icons">account_circle</i>
					<span>Users</span>
				</a>
			</li>
			<?php } ?>
			<!-- begin sidebar minify button -->
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			<!-- end sidebar minify button -->
		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->