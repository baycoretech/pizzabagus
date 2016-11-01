<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li><a href="<?php echo $router->generate('admin-dashboard') ?>">Home</a></li>
	<?php
		$class_page = new Page($pdo);
	    $function_view_page_title = $class_page->view_page_title($action);
		if($section == 'logo') {
			if($action == 'add') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'logo')) ?>">Logo</a></li>
	<li class="active">Add</li>
	<?php
			}
			elseif($action == 'edit') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'logo')) ?>">Logo</a></li>
	<li class="active">Edit</li>
	<?php
			}
			else {
	?>
	<li class="active">Logo</li>
	<?php
			}
		}
		elseif($section == "page") {
			if($id == 'comment') {
	?>
		<li>Page</li>
		<li>
			<?php echo $function_view_page_title ?>
		</li>
		<li class="active">
			Comments
		</li>
	<?php
			}
			else {
	?>
		<li>Page</li>
		<li class="active">
			<?php echo $function_view_page_title ?>
		</li>
	<?php
			}
		}
		elseif($section == 'favicon') {
			if($action == 'add') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'favicon')) ?>">Favicon</a></li>
	<li class="active">Add</li>
	<?php
			}
			elseif($action == 'edit') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'favicon')) ?>">Favicon</a></li>
	<li class="active">Edit</li>
	<?php
			}
			else {
	?>
	<li class="active">Favicon</li>
	<?php
			}
		}
		elseif($section == 'fonts') {
			if($action == 'add') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'fonts')) ?>">Fonts</a></li>
	<li class="active">Add</li>
	<?php
			}
			elseif($action == 'edit') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'fonts')) ?>">Fonts</a></li>
	<li class="active">Edit</li>
	<?php
			}
			else {
	?>
	<li class="active">Fonts</li>
	<?php
			}
		}
		elseif($section == 'slider') {
			if($action == 'add') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'slider')) ?>">Slider Image</a></li>
	<li class="active">Add</li>
	<?php
			}
			elseif($action == 'edit') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'slider')) ?>">Slider Image</a></li>
	<li class="active">Edit</li>
	<?php
			}
			else {
	?>
	<li class="active">Slider</li>
	<?php
			}
		}
		elseif($section == 'clients') {
			if($action == 'add') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'clients')) ?>">Clients</a></li>
	<li class="active">Add</li>
	<?php
			}
			elseif($action == 'edit') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'clients')) ?>">Clients</a></li>
	<li class="active">Edit</li>
	<?php
			}
			else {
	?>
	<li class="active">Clients</li>
	<?php
			}
		}
		elseif($section == 'map') {
			if($action == 'preview') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'map')) ?>">Map</a></li>
	<li class="active">Preview</li>
	<?php
			}
			else {
	?>
	<li class="active">Map</li>
	<?php
			}
		}
		elseif($section == 'invoice') {
			if(isset($action)) {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'invoice')) ?>">Invoice</a></li>
	<li class="active"><?php echo $action ?></li>
	<?php
			}
			else {
	?>
	<li class="active">Invoice</li>
	<?php
			}
		}
		elseif($section == 'contact-header') {
	?>
	<li class="active">Contact Header</li>
	<?php
		}
		elseif($section == 'additional-toppings') {
	?>
	<li class="active">Additional Toppings</li>
	<?php
		}
		elseif($section == 'primary-footer') {
	?>
	<li class="active">Primary Footer</li>
	<?php
		}
		elseif($section == 'custom-css') {
	?>
	<li class="active">Custom CSS</li>
	<?php
		}
		elseif($section == 'footer') {
	?>
	<li class="active">Secondary Footer</li>
	<?php
		}
		elseif($section == 'media') {
	?>
	<li class="active">Media</li>
	<?php
		}
		elseif($section == 'themes') {
	?>
	<li class="active">Themes</li>
	<?php
		}
		elseif($section == 'profile') {
	?>
	<li class="active">Profile</li>
	<?php
		}
		elseif($section == 'coloring') {
	?>
	<li class="active">Coloring</li>
	<?php
		}
		elseif($section == 'fonts') {
	?>
	<li class="active">Fonts</li>
	<?php
		}
		elseif($section == 'payment-information') {
	?>
	<li class="active">Payment Information</li>
	<?php
		}
		elseif($section == 'term-of-service') {
	?>
	<li class="active">Term of Service</li>
	<?php
		}
		elseif($section == 'custom-homepage-content') {
	?>
	<li class="active">Custom Home Page Content</li>
	<?php
		}
		elseif($section == 'settings') {
	?>
	<li class="active">Settings</li>
	<?php
		}
		elseif($section == 'disk-usage') {
	?>
	<li class="active">Disk Usage</li>
	<?php
		}
		elseif($section == 'quotes') {
	?>
	<li class="active">Quotes</li>
	<?php
		}
		elseif($section == 'home-page-style') {
	?>
	<li class="active">Home Page Style</li>
	<?php
		}
		elseif($section == 'services') {
			if($action == 'add') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'services')) ?>">Services</a></li>
	<li class="active">Add</li>
	<?php
			}
			elseif($action == 'edit') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'services')) ?>">Services</a></li>
	<li class="active">Edit</li>
	<?php
			}
			else {
	?>
	<li class="active">Services</li>
	<?php
			}
		}
		elseif($section == 'users') {
			if($action == 'add') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'users')) ?>">Users</a></li>
	<li class="active">Add</li>
	<?php
			}
			elseif($action == 'edit') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'users')) ?>">Users</a></li>
	<li class="active">Edit</li>
	<?php
			}
			else {
	?>
	<li class="active">Users</li>
	<?php
			}
		}
		elseif($section == 'customers') {
			if($action == 'add') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'customers')) ?>">Customers</a></li>
	<li class="active">Add</li>
	<?php
			}
			elseif($action == 'edit') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'customers')) ?>">Customers</a></li>
	<li class="active">Edit</li>
	<?php
			}
			else {
	?>
	<li class="active">Customers</li>
	<?php
			}
		}
		elseif($section == 'social') {
			if($action == 'edit') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'social')) ?>">Social</a></li>
	<li class="active">Edit</li>
	<?php
			}
			else {
	?>
	<li class="active">Social</li>
	<?php
			}
		}
		elseif($section == 'menu') {
			if($action == 'add') {
	?>
	<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'menu')) ?>">Menu</a></li>
	<li class="active">Add</li>
	<?php
			}
			else {
	?>
	<li class="active">Menu</li>
	<?php
			}
		}
		else {
	?>
	<li class="active">Dashboard</li>
	<?php
		}
	?>
</ol>
<!-- end breadcrumb -->