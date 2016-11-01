<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/include/database/connection.php';
	$class_general_setting = new General_Setting($pdo);
	$function_folder_name  = $class_general_setting->folder_name();
	$host         = "$_SERVER[HTTP_HOST]";
    $explode_url  = explode('/', $_SERVER[REQUEST_URI]);
    $router       = new AltoRouter();
    if($function_folder_name != "0") {
        $router->setBasePath('/'.$function_folder_name);
    }
	require __DIR__.'/../cr-include/routes.php';

	//Session login
	$admin_id_session   = $_SESSION['cr_adminID'];
    $admin_pass_session = $_SESSION['cr_adminPassword'];
    $redirect_to_login  = $router->generate('admin-login');

    if(empty($admin_id_session) && empty($admin_pass_session)) {
    	header("location:$redirect_to_login");
    }
    else {

	    //Set ABSOLUTE URL as variable for header redirect
	    $master_admin_url = MADMINURL;
	    $master_url       = MURL;

	    $class_administrator            = new Administrator($pdo);
		$function_profile_administrator = $class_administrator->profile_administrator($admin_id_session);
		$admin_display    = $function_profile_administrator->cr_adminDisplayName;
		$admin_level      = $function_profile_administrator->cr_adminLevel;
		$admin_photo      = $function_profile_administrator->cr_adminPhoto;
		$admin_last_login = $function_profile_administrator->cr_adminLastlogin;

		$class_administrative  = new Administrative($pdo);
		$class_settings        = new Settings($pdo);

		//Disk size
		$function_disk_size_bytes = $class_settings->disk_size_bytes();
		$function_disk_size       = $class_settings->disk_size();

		//Date and time format 
		$function_date_format     = $class_settings->view_settings_date_format();  
		$function_time_format     = $class_settings->view_settings_time_format();

		//Coming soon
		$function_coming_soon     = $class_settings->view_settings_coming_soon();  

		//History data
		$class_history         = new History($pdo);
		$function_view_history = $class_history->view_history();

		//Appearance
	 	$class_appearance      = new Appearance($pdo);
	 	$function_view_favicon = $class_appearance->view_favicon();

	 	//Menu
	    $class_menu = new Menu($pdo);

	    //Set default language page
        $class_language   = new Language($pdo);
        $default_language = $class_language->default_language();
        $default_lang_code = $default_language->cr_languageCode;

	    //Plan
		$function_user_plan = $class_settings->user_plan();
		$check_plan = creatify_package($function_user_plan, $function_disk_size_bytes);
		$check_page = creatify_package_page($function_user_plan);
		$forbidden_header = $master_url.'403.php';

		if($section == 'themes-preview') {
			require 'themes-preview.php';
		}
		else {
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?php require 'dashboard-head.php' ?>
<body>
	<?php require 'dashboard-page-loader.php' ?>
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar">
		<?php require "dashboard-header.php"; ?>
		<?php require "dashboard-sidebar.php"; ?>
		<!-- begin #content -->
		<div id="content" class="content <?php if(($section == "map" && $action == "preview") || $section == "inbox" || $section == "compose" || $section == "sent" || $section == "trash" || $section == "message" || $section == "messagereply" || $section == "messagetrash") echo "content-full-width"; ?>">
			<?php
				if($section != "inbox" && $section != "compose" && $section != "sent" && $section != "trash" && $section != "message" && $section != "messagereply" && $section != "messagetrash" ) {
					require 'dashboard-breadcrumb.php';
					require "dashboard-page-header.php";
				}
			?>
			<!-- begin row -->
			<?php 
				if(!isset($section))
					require "dashboard-statistic.php"; 
			?>
			<!-- end row -->
			<!-- begin inner content -->
			<?php
				switch ($section) {
				    case "logo":
				        if($action == 'add') {
				        	if($check_plan == 'allow')
					        	require 'logo-add.php';
					        else 
						        header("Location: $forbidden_header");
				        }
				        elseif($action == 'edit') {
				        	if($check_plan == 'allow')
				        		require 'logo-edit.php';
				        	else 
						        header("Location: $forbidden_header");
				        }
				        else {
				        	require 'logo-view.php';
				        }
				    	break;
				    case "favicon":
				        if($action == 'add') {
				        	if($check_plan == 'allow')
				        		require 'favicon-add.php';
				        	else 
						        header("Location: $forbidden_header");
				        }
				        elseif($action == 'edit') {
				        	if($check_plan == 'allow')
				        		require 'favicon-edit.php';
				        	else 
						        header("Location: $forbidden_header");
				        }
				        else {
				        	require 'favicon-view.php';
				        }
				        break;
				    case "fonts":
				        if($action == 'add') {
				        	require 'fonts-add.php';
				        }
				        elseif($action == 'edit') {
				        	require 'fonts-edit.php';
				        }
				        else {
				        	require 'fonts-view.php';
				        }
				        break;
				    case "users":
				    	if($action == 'add') {
				        	require 'users-add.php';
				        }
				        elseif($action == 'edit') {
				        	require 'users-edit.php';
				        }
				        else {
				        	require 'users-view.php';
				        }
				        break;
				    case "customers":
				    	if($action == 'add') {
				        	require 'customer-add.php';
				        }
				        elseif($action == 'edit') {
				        	require 'customer-edit.php';
				        }
				        else {
				        	require 'customer-view.php';
				        }
				        break;
				    case "menu":
				    	if($action == 'add') {
				    		if($check_page == 'allow')
				        		require 'menu-add.php';
				        	else 
						        header("Location: $forbidden_header");
				    	}
				    	else {
				    		require 'menu-view.php';
				    	}
				        break;
				    case "slider":
				        if($action == 'add') {
				        	if($check_plan == 'allow')
				        		require 'slider-add.php';
				        	else 
						        header("Location: $forbidden_header");
				        }
				    	elseif($action == 'edit') {
				        	if($check_plan == 'allow')
				        		require 'slider-edit.php';
				        	else 
						        header("Location: $forbidden_header");
				    	}
				    	else {
				    		require 'slider-view.php';
				    	}
				        break;
				    case "additional-toppings":
				    	require 'additional-toppings-view.php';
				        break;
				    case "payment-information":
				    	require 'payment-information-view.php';
				        break;
			        case "term-of-service":
				    	require 'term-of-service-view.php';
				        break;
			        case "custom-homepage-content":
				    	require 'custom-homepage-content-view.php';
				        break;
				    case "media":
				    	require 'media-view.php';
				        break;
				    case "message":
				    	if(isset($action) && $action != "read" && $action != "unread") {
				    		require 'message-detail-view.php';
				    	}
				    	else {
				    		require 'message-inbox-view.php';
				    	}
				        break;
				    case "messagetrash":
				    	if(isset($action)) {
				    		require 'message-detail-view.php';
				    	}
				    	else {
				    		require 'message-trash-view.php';
				    	}
				        break;
				    case "messagereply":
				    	require 'message-reply-view.php';
				        break;
				    case "inbox":
				    	if(isset($action) && $action != "read" && $action != "unread") {
				    		include 'mail-detail-view.php';
				    	}
				    	else {
				    		include 'mail-inbox-view.php';
				    	}
				        break;
				    case "sent":
				    	if(isset($action)) {
				    		require 'mail-detail-view.php';
				    	}
				    	else {
				    		require 'mail-sent-view.php';
				    	}
				        break;
				    case "trash":
				    	if(isset($action)) {
				    		require 'mail-detail-view.php';
				    	}
				    	else {
				    		require 'mail-trash-view.php';
				    	}
				        break;
				    case "compose":
				    	require 'mail-compose-view.php';
				        break;
				    case "themes":
				    	require 'themes-view.php';
				        break;
				    case "custom-css":
				    	require 'custom-css-view.php';
				        break;
				    case "social":
				    	if($action == 'edit') {
				    		require 'social-edit.php';
				    	}
				    	else {
				    		require 'social-view.php';
				    	}
				        break;
				    case "settings":
				    	if($action == 'edit') {
				    		require 'settings-edit.php';
				    	}
				    	else {
				    		require 'settings-view.php';
				    	}
				        break;
				    case "coloring":
				        require 'coloring-view.php';
				        break;
				    case "contact-header":
				        require 'contact-header-view.php';
				        break;
				    case "page":
				        require 'page.php';
				        break;
			        case "portfolio-extra":
				        include 'page-portfolio-items-extra-edit.php';
				        break;
				    case "map":
				    	if($action == 'preview') {
				    		require 'map-preview.php';
				    	}
				    	else {
				        	require 'map-view.php';
				        }
				        break;
				    case "primary-footer":
				        require 'primary-footer-view.php';
				        break;
				    case "footer":
				        require 'footer-view.php';
				        break;
				    case "quotes":
				        require 'quotes-view.php';
				        break;
				    case "services":
				        if($action == 'add') {
				        	require 'services-add.php';
				        }
				    	elseif($action == 'edit') {
				        	require 'services-edit.php';
				    	}
				    	else {
				    		require 'services-view.php';
				    	}
				        break;
				    case "invoice":
				    	if(isset($action)) {
				        	include 'invoice-detail-view.php';
				    	}
				    	else {
				        	include 'invoice-view.php';
				    	}
				        break;
				    case "clients":
				        if($action == 'add') {
				        	require 'clients-add.php';
				        }
				    	elseif($action == 'edit') {
				        	require 'clients-edit.php';
				    	}
				    	else {
				    		require 'clients-view.php';
				    	}
				        break;
				    case "history":
				        require 'history-view.php';
				        break;
				    case "home-page-style":
				        require 'home-page-style-view.php';
				        break;
				    case "profile":
				    	if($action == 'edit') {
				    		require 'profile-edit.php';
				    	}
				    	else {
				        	require 'profile.php';
				        }
				        break;
				    case "disk-usage":
				        require 'disk-usage.php';
				        break;
				    default:
				        require 'home.php';
				}
			?>
			<!-- end inner content -->
		</div>
		<!-- end #content -->
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<?php
		$function_folder_name = $class_administrative->folder_name();
        if($function_folder_name == false) {
            $target_folder = $_SERVER['DOCUMENT_ROOT']."/";
        }
        else {
            $target_folder = $_SERVER['DOCUMENT_ROOT']."/".$function_folder_name."/";
        }
        $get_version_file  = file($target_folder.'version.txt');
        $creatify_version  = $get_version_file[0];
	?>
	<div class="modal fade" id="modal-about-creatify">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-body bg-cr">
	            	<img src="<?php echo MADMINURL ?>assets/img/logo-creatify.png" width="300">
	            	<p>Version <?php echo $creatify_version ?></p>
	            	<?php
	            		if(strpos($creatify_version, "(Custom)") === false) { 
	            	?>
	            	<p id="check-creatify-update"></p>
	            	<p id="loader-creatify-update"></p>
	            	<?php } ?>
	            	<p>Copyright &copy; 2016. Technologia Creativa</p>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- end page container -->
	<?php
		require 'dashboard-script.php';
		if($section == 'media') {
	?>
	<script type="text/javascript">
		;(function($) {
			$.fn.SuperBox = function(options) {
				var superbox      = $('<div class="superbox-show"></div>'),
					superboximg   = $('<img src="" class="superbox-current-img"><div id="imgInfoBox" class="superbox-imageinfo inline-block"> <h4 class="text-white">Image Title</h4><p><em id="galdate"></em></p><span><dl><dt>Dimension</dt><dd id="galdimension"></dd><dt>Description</dt><dd id="galdescription"></dd><dt>File Name</dt><dd id="galtitle"></dd></dl><p><button id="egal-button" class="btn btn-success" data-target="#media-edit-dialog" data-toggle="modal" data-mediaid="" data-mediatitle="" data-mediadesc="" data-mediaimage=""><i class="fa fa-pencil"></i> Edit </button> <button id="delgal-button" class="btn btn-danger m-l-10" data-target="" data-toggle="modal" data-hapus="" data-dn=""><i class="fa fa-times"></i> Delete</button></p></span> </div>'),
					superboxclose = $('<div class="superbox-close text-white"><i class="fa fa-times fa-lg"></i></div>');
				superbox.append(superboximg).append(superboxclose);
				var imgInfoBox = $('.superbox-imageinfo');
				return this.each(function() {
					$('.superbox-list').click(function() {
						$this = $(this);
						var currentimg = $this.find('.superbox-img'),
							imgData = currentimg.data('img'),
							imgLink = imgData,
							imgName = currentimg.attr('title'),
							imgTitle = currentimg.data('title')  || "No Title",
							imgDesc = currentimg.data('desc') || "No Description",
							img = currentimg.data('desc') || "No Description",
							imgWidth = currentimg.data('width'),
							imgHeight = currentimg.data('height'),
							imgID = currentimg.data('mediaid'),
							imgDate = currentimg.data('mediadate'),
							imgAuthor = currentimg.data('mediaauthor');
							imgPath = currentimg.data('imagepath');
						superboximg.attr('src', imgData);
						$('.superbox-list').removeClass('active');
						$this.addClass('active');
						superboximg.find('#galdate').html('Uploaded '+imgDate+' by <strong>'+imgAuthor+'</strong>');
						superboximg.find('#delgal-button').attr('data-target', '#media-delete-dialog'+imgID);
						superboximg.find('#egal-button').attr('data-target', '#media-edit-dialog'+imgID);
						superboximg.find('>:first-child').text(imgTitle);
						superboximg.find('#galdimension').html(imgWidth+'px x '+imgHeight+'px');
						superboximg.find('#galdescription').html(imgDesc);
						superboximg.find('#galtitle').html(imgName);
						if(imgTitle == 'No Title') {
							superboximg.find('#egal-button').attr('data-mediatitle','');
						}
						else {
							superboximg.find('#egal-button').attr('data-mediatitle',imgTitle);
						}
						if(imgDesc == 'No Description') {
							superboximg.find('#egal-button').attr('data-mediadesc','');
						}
						else {
							superboximg.find('#egal-button').attr('data-mediadesc',imgDesc);
						}
						if($('.superbox-current-img').css('opacity') == 0) {
							$('.superbox-current-img').animate({opacity: 1});
						}
						if ($(this).next().hasClass('superbox-show')) {
							$('.superbox-list').removeClass('active');
							superbox.toggle();
						} else {
							superbox.insertAfter(this).css('display', 'block');
							$this.addClass('active');
						}
						$('html, body').animate({
							scrollTop:superbox.position().top - currentimg.width()
						}, 'medium');

						$('#media-edit-dialog').on('show.bs.modal', function(e) {
				            $(this).find('#media-edit-id').attr('value', $(e.relatedTarget).data('mediaid'));
				            $(this).find('#media-edit-title').attr('value', $(e.relatedTarget).data('mediatitle'));
				            $(this).find('#media-edit-desc').text($(e.relatedTarget).data('mediadesc'));
				            $(this).find('#media-edit-image').attr('src', $(e.relatedTarget).data('mediaimage'));
				        });
				        $('#media-delete-dialog').on('show.bs.modal', function(e) {
				            $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
					        $(this).find('#medianame').attr('value', $(e.relatedTarget).data('dn'));
					        $(this).find('#dn').html($(e.relatedTarget).data('dn'));
					    });
					});		
					$('.superbox').on('click', '.superbox-close', function() {
						$('.superbox-list').removeClass('active');
						$('.superbox-current-img').animate({opacity: 0}, 200, function() {
							$('.superbox-show').slideUp();
						});
					});
				});
			};
		})(jQuery);
		$(document).ready(function(){

		});
	</script>
	<?php
		}
		if($section == "page" && $gallery_on == "gallery") {
	?>
	<script type="text/javascript">
		;(function($) {
			$.fn.SuperBox = function(options) {
				var superbox      = $('<div class="superbox-show"></div>'),
					superboximg   = $('<img src="" class="superbox-current-img"><div id="imgInfoBox" class="superbox-imageinfo inline-block"> <h4 class="text-white">Image Title</h4><p><em id="galdate"></em></p><span><p class="superbox-img-description">Image description</p><p><button id="egal-button" class="btn btn-success" onclick=""><i class="fa fa-pencil"></i> Edit </button> <button id="delgal-button" class="btn btn-danger m-l-10" data-target="#modal-delete-gallery" data-toggle="modal" data-hapus="" data-dn=""><i class="fa fa-times"></i> Delete</button></p></span> </div>'),
					superboxclose = $('<div class="superbox-close text-white"><i class="fa fa-times fa-lg"></i></div>');
				superbox.append(superboximg).append(superboxclose);
				var imgInfoBox = $('.superbox-imageinfo');
				return this.each(function() {
					$('.superbox-list').click(function() {
						$this = $(this);
						var currentimg = $this.find('.superbox-img'),
							imgData = currentimg.data('img'),
							imgDescription = currentimg.attr('alt') || "No description",
							imgLink = imgData,
							imgTitle = currentimg.attr('title') || "No Title",
							imgID = currentimg.data('galid'),
							imgDate = currentimg.data('galdate'),
							imgAuthor = currentimg.data('galauthor'),
							editclick = "location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'edit')) ?>"+ imgID +"'";
						superboximg.attr('src', imgData);
						$('.superbox-list').removeClass('active');
						$this.addClass('active');
						superboximg.find('#galdate').html('Posted '+imgDate+' by <strong>'+imgAuthor+'</strong>');
						superboximg.find('#egal-button').attr('onclick', editclick);
						superboximg.find('#delgal-button').attr('data-dn', imgTitle);
						superboximg.find('#delgal-button').attr('data-hapus', imgID);
						superboximg.find('>:first-child').text(imgTitle);
						superboximg.find('.superbox-img-description').html('Description : <br>'+imgDescription);
						if($('.superbox-current-img').css('opacity') == 0) {
							$('.superbox-current-img').animate({opacity: 1});
						}
						if ($(this).next().hasClass('superbox-show')) {
							$('.superbox-list').removeClass('active');
							superbox.toggle();
						} else {
							superbox.insertAfter(this).css('display', 'block');
							$this.addClass('active');
						}
						$('html, body').animate({
							scrollTop:superbox.position().top - currentimg.width()
						}, 'medium');
					});		
					$('.superbox').on('click', '.superbox-close', function() {
						$('.superbox-list').removeClass('active');
						$('.superbox-current-img').animate({opacity: 0}, 200, function() {
							$('.superbox-show').slideUp();
						});
					});
				});
			};
		})(jQuery);
	</script>
	<?php
		}
		elseif($section == "slider") {
	?>
	<script type="text/javascript">
		;(function($) {
			$.fn.SuperBox = function(options) {
				var superbox      = $('<div class="superbox-show"></div>'),
					superboximg   = $('<img src="" class="superbox-current-img"><div id="imgInfoBox" class="superbox-imageinfo inline-block"> <h4 class="text-white">Image Title</h4><p><em id="galdate"></em></p><span><p class="superbox-img-size m-b-10"></p><p class="superbox-img-description">Image description</p><p><button id="egal-button" class="btn btn-success" onclick=""><i class="fa fa-pencil"></i> Edit</button> <button id="delgal-button" class="btn btn-danger m-l-10" data-target="" data-toggle="modal" data-delete=""><i class="fa fa-times"></i> Delete</button></p></span> </div>'),
					superboxclose = $('<div class="superbox-close text-white"><i class="fa fa-times fa-lg"></i></div>');
				superbox.append(superboximg).append(superboxclose);
				var imgInfoBox = $('.superbox-imageinfo');
				return this.each(function() {
					$('.superbox-list').click(function() {
						$this = $(this);
						var currentimg = $this.find('.superbox-img'),
							imgData = currentimg.data('img'),
							imgDescription = currentimg.attr('alt') || "No description",
							imgLink = imgData,
							imgTitle = currentimg.attr('title') || "No Caption",
							imgID = currentimg.data('sliderid'),
							imgWidth  = currentimg.data('sliderwidth'),
							imgHeight = currentimg.data('sliderheight'),
							imgAuthor = currentimg.data('sliderauthor'),
							editclick = "location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => 'slider', 'action' => 'edit')) ?>" + imgID + "/'";
						superboximg.attr('src', imgData);
						$('.superbox-list').removeClass('active');
						$this.addClass('active');
						superboximg.find('#galdate').html('Posted ' + 'by <strong>' + imgAuthor + '</strong>');
						superboximg.find('#egal-button').attr('onclick', editclick);
						superboximg.find('#delgal-button').attr('data-delete', imgID);
						superboximg.find('#delgal-button').attr('data-target', '#modal-delete-slider' + imgID);
						superboximg.find('>:first-child').text(imgTitle);
						superboximg.find('.superbox-img-description').html('Description : <br>'+imgDescription);
						superboximg.find('.superbox-img-size').html('Image size : <br>'+ imgWidth + 'px x ' + imgHeight + 'px');
						if($('.superbox-current-img').css('opacity') == 0) {
							$('.superbox-current-img').animate({opacity: 1});
						}
						if ($(this).next().hasClass('superbox-show')) {
							$('.superbox-list').removeClass('active');
							superbox.toggle();
						} else {
							superbox.insertAfter(this).css('display', 'block');
							$this.addClass('active');
						}
						$('html, body').animate({
							scrollTop:superbox.position().top - currentimg.width()
						}, 'medium');
					});		
					$('.superbox').on('click', '.superbox-close', function() {
						$('.superbox-list').removeClass('active');
						$('.superbox-current-img').animate({opacity: 0}, 200, function() {
							$('.superbox-show').slideUp();
						});
					});
				});
			};
		})(jQuery);
	</script>
	<?php
		}
		else {
			echo "";
		}
	?>
	<script src="<?php echo MADMINURL; ?>assets/plugins/parsley/dist/parsley.js"></script>
	<?php 
		if(!isset($section)) {
	?>
	<script src="<?php echo MADMINURL; ?>assets/js/dashboard.min.js"></script>
	<?php
		}
	?>
	<script src="<?php echo MADMINURL; ?>assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<?php
		if($page_type == 'blog') 
			require "include/crop-wide.php";
		elseif(($section == 'logo' || $section == 'favicon' || $section == 'profile' || $section == 'page' || $section == 'users' || $section == 'slider') && ($action == 'add' || $action == 'edit' || $id == 'add' || $id == 'edit'))
			require "include/crop-avatar.php";
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			App.init();
			<?php 
				if(!isset($section)) {
			?>
			Dashboard.init();
			<?php } ?>

			$('.no-admin-photo').initial();

			function loadTotalMessage(){
			  $("#totalmessage").load("<?php echo MADMINURL ?>ajax/count-message-unread.php");
			}
			setInterval(function(){loadTotalMessage()}, 2000);

			function loadTotalInbox(){
			  $("#totalinbox, #totalinboxdrop").load("<?php echo MADMINURL ?>ajax/count-inbox-unread.php");
			}
			setInterval(function(){loadTotalInbox()}, 2000);

			function loadTotalAll(){
			  $("#totalnotif1").load("<?php echo MADMINURL ?>ajax/count-all-unread.php");
			}
			setInterval(function(){loadTotalAll()}, 2000);

			function loadTotalAllSidebar(){
			  $("#totalnotif2").load("<?php echo MADMINURL ?>ajax/count-all-unread-sidebar.php");
			}
			setInterval(function(){loadTotalAllSidebar()}, 2000);

			function loadMasterNotification(){
			  $("#notification-master").load("<?php echo MADMINURL ?>ajax/notification-master.php");
			}
			setInterval(function(){loadMasterNotification()}, 2000);

			$('#modal-about-creatify').on('show.bs.modal', function(e) {
                $(this).find('#check-creatify-update').show();
                $(this).find('#check-creatify-update').html('Checking for update...');
                $(this).find('#loader-creatify-update').show();
                $(this).find('#loader-creatify-update').html('<i class="fa fa-spinner fa-pulse fa-2x"></i>');
                var crvers       = "<?php echo str_replace('.','',$creatify_version) ?>";
                var dataString   = 'crvers='+crvers;
                $.ajax({
                    type: "POST",
                    url:  "<?php echo MADMINURL ?>ajax/creatify-check-update.php",
                    data: dataString,
                    cache: false,
                        success: function(data){
                        	setTimeout(function() {
	                            if(data == "available") {
	                                $("#loader-creatify-update").hide();
	                                $("#check-creatify-update").html('<a id="run-creatify-update" role="button">Update is available. Click to update Creatify.</a>');
	                            }
	                            else {
	                                $("#check-creatify-update").hide();
	                                $("#loader-creatify-update").hide();
	                            }
                            }, 2000);

                        }
                });
            });

			$('#run-creatify-update').click(function() {
                var targetfolder = "<?php if($function_folder_name == '0') echo 'withoutfolder'; else echo $function_folder_name ?>";
                var dataString   = 'targetfolder='+targetfolder;
                $.ajax({
                    type: "POST",
                    url:  "<?php echo MADMINURL ?>ajax/creatify-run-update.php",
                    data: dataString,
                    cache: false,
                        beforeSend: function(){ $("#run-creatify-update").html('<i class="fa fa-spinner fa-pulse"></i> Updating Creatify...');},
                        success: function(data){
                            if(data == "success") {
                                $("#run-creatify-update").html("Success update Creatify. Redirecting to dashboard...");
                                setTimeout(function() {
                                    window.location="<?php echo $router->generate('admin-dashboard') ?>";
                                }, 1000);
                            }
                            else {
                                $("#run-creatify-update").html("Can't update Creatify. Please try again later.");
                                setTimeout(function() {
                                    $('#modal-about-creatify').modal('hide')
                                }, 2000);
                            }
                        }
                });
                return false;
            });

			<?php
				if(($section == "page" && $gallery_on == "gallery") || $section == "slider" || $section == "media") {
			?>
				$(".superbox").SuperBox();
			<?php
				}
			?>
			<?php
				if($section =="compose") {
			?>
			$(".selectpicker").selectpicker("render");
			<?php
				}
				if($section == "page" && $page_type == 'menu') {
			?>
			$("#jquery-ingredients").tagit({
				<?php if($ingredients != false) { ?>
                availableTags:[<?php
                	foreach ($ingredients as $data) {
                		echo '"'.$data->cr_ourmenuingredientsName.'", ';
                	}
                 ?>],
                 <?php } ?>
                placeholderText: 'Ingredient Name',
                fieldName: "ingredients[]",
                allowSpaces: true
            })

            $("#jquery-ingredients-id").tagit({
				<?php if($ingredients_id != false) { ?>
                availableTags:[<?php
                	foreach ($ingredients_id as $data) {
                		echo '"'.$data->cr_ourmenuingredientsName_id.'", ';
                	}
                 ?>],
                 <?php } ?>
                placeholderText: 'Ingredient Name',
                fieldName: "ingredients_id[]",
                allowSpaces: true
            })
            <?php 
        		}
				if($section == "page" && $page_type == 'blog') {
			?>
			$("#jquery-blog-tag").tagit({
				<?php if($blog_tags != false) { ?>
                availableTags:[<?php
                	foreach ($blog_tags as $data) {
                		echo '"'.$data->cr_blogtagsName.'", ';
                	}
                 ?>],
                 <?php } ?>
                placeholderText: 'Tag Your Post',
                fieldName: "tags[]"
            })
            <?php } ?>
			$("#datepicker-default, #datepicker-default-edit").datepicker({
		        todayHighlight: true
		    })
		    $("#timepicker").timepicker({
		    	showMeridian: false,
		    	defaultTime: 'current',
		    	showSeconds: true,
		    	minuteStep: 1
		    });
		    $(".time-order").timepicker({
		    	showMeridian: false,
		    	defaultTime: 'current',
		    	minuteStep: 1
		    });
		    <?php 
				if($section == "home-page-style") {
			?>
			FormWizardValidation.init();
			<?php
				}
			?>
			<?php
				if($section == "coloring") {
			?>
			$("#primarycolorpicker, #secondarycolorpicker").colorpicker({
                format:"hex"
            })
            <?php
				}
				if($admin_last_login == "0000-00-00 00:00:00") {
					if(!isset($section)) {
						if($function_user_plan == "premium") {
			?>
			$.gritter.add({
				title:"Personal Premium User",
				text:"How great! You are a personal premium user. You have unlimited disk usage and unlimited pages. Enjoy the unlimited disk usage for your creative website.",
				image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
				sticky:false,
				class_name: "gritter-light",
				time:""
			});
			<?php
						}
						elseif($function_user_plan == "basic") {
			?>
			$.gritter.add({
				title:"Personal Basic User",
				text:"You are a personal basic user. You have 500 MB disk usage and maximum of 7 pages excluding homepage, use wisely for your creative website.",
				image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
				sticky:false,
				class_name: "gritter-light",
				time:""
			});
			<?php
						}
						elseif($function_user_plan == "probasic") {
			?>
			$.gritter.add({
				title:"Professional Basic User",
				text:"How great! You are a professional basic user. You have unlimited disk usage and unlimited pages. Enjoy the unlimited disk usage and pages for your creative website.",
				image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
				sticky:false,
				class_name: "gritter-light",
				time:""
			});
			<?php
						}
						elseif($function_user_plan == "propro") {
			?>
			$.gritter.add({
				title:"Professional Pro User",
				text:"How great! You are a professional pro user. You have unlimited disk usage and unlimited pages. Enjoy the unlimited disk usage and pages for your creative website.",
				image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
				sticky:false,
				class_name: "gritter-light",
				time:""
			});
			<?php
						}
						elseif($function_user_plan == "prosuper") {
			?>
			$.gritter.add({
				title:"Professional Super Pro User",
				text:"How great! You are a professional super pro user. You have unlimited disk usage and unlimited pages. Enjoy the unlimited disk usage and pages for your creative website.",
				image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
				sticky:false,
				class_name: "gritter-light",
				time:""
			});
			<?php
						}
					}
				}
				else {
					if($function_user_plan == "basic") {
						if($function_disk_size_bytes >= 523239424) {
			?>
			$.gritter.add({
				title:"Disk Usage is Almost Full",
				text:"Please upgrade your Creatify to increase the disk usage or delete some post, portfolio or media to free up disk usage.",
				image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
				sticky:true,
				class_name: "gritter-light",
				time:""
			});
			<?php
						}
					}
				}
				if($admin_last_login == "0000-00-00 00:00:00") {
					if(!isset($section)) {
			?>
			$.gritter.add({
				title:"Welcome to Creatify",
				text:"Creatify gives you creativity to create your creative website. Check our documentation for more help, or email us if you have any problems with Creatify.",
				image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
				sticky:false,
				time:""
			});
			<?php
					}
				}
				else {
					if(!isset($section)) {
			?>
			$.gritter.add({
				title:"Welcome <?php echo ucwords($admin_display) ?>!",
				text:"Creatify have been waiting for you to return to your website.",
				image:"<?php if($admin_photo == '') echo MADMINURL.'assets/img/no-pic.png'; else echo MADMINURL.$admin_photo; ?>",
				sticky:false,
				time:"99999999"
			});
			<?php
					}
				}
			?>
			var gritter_image = $(".gritter-item").find('img').attr('src');
		    if(gritter_image == '<?php echo MADMINURL.'assets/img/no-pic.png' ?>') {
		    	$('.gritter-image').attr('data-name','<?php echo ucwords($admin_display); ?>');
		    	$('.gritter-image').attr('data-font-size','42');
		    	$('.gritter-image').attr('data-width','48');
		    	$('.gritter-image').attr('data-height','48');
		    	$('.gritter-image').initial();
		    }
			<?php
				if($section == "disk-usage") {
			?>
			$("#jstree-default").jstree({
		        core: {
		            themes: {
		                responsive: !1
		            }
		        },
		        types: {
		            "default": {
		                icon: "fa fa-folder text-warning fa-lg"
		            },
		            file: {
		                icon: "fa fa-file text-inverse fa-lg"
		            }
		        },
		        plugins: ["types"]
		    }),
		    $("#jstree-default").on("select_node.jstree", function(e, t) {
		        var a = $("#" + t.selected).find("a");
		        return "#" != a.attr("href") && "javascript:;" != a.attr("href") && "" != a.attr("href") ? ("_blank" == a.attr("target") && (a.attr("href").target = "_blank"),
		        document.location.href = a.attr("href"),
		        !1) : void 0
		    })
			<?php
				}
				if(!isset($section)) {
				//date for x axis
				$xdate1   = date($function_date_format->cr_settingValue,strtotime("-1 days"));
				$xdate2   = date($function_date_format->cr_settingValue,strtotime("-2 days"));
				$xdate3   = date($function_date_format->cr_settingValue,strtotime("-3 days"));
				$xdate4   = date($function_date_format->cr_settingValue,strtotime("-4 days"));
				$xdate5   = date($function_date_format->cr_settingValue,strtotime("-5 days"));
				$xdate6   = date($function_date_format->cr_settingValue,strtotime("-6 days"));
				$xdate7   = date($function_date_format->cr_settingValue,strtotime("-7 days"));

				$min1date = date('Y-m-d',strtotime("-1 days"));
				$min2date = date('Y-m-d',strtotime("-2 days"));
				$min3date = date('Y-m-d',strtotime("-3 days"));
				$min4date = date('Y-m-d',strtotime("-4 days"));
				$min5date = date('Y-m-d',strtotime("-5 days"));
				$min6date = date('Y-m-d',strtotime("-6 days"));
				$min7date = date('Y-m-d',strtotime("-7 days"));

				$function_total_visitor_1 = $class_administrative->total_visitor_1($min1date);
    			$function_total_visitor_2 = $class_administrative->total_visitor_2($min2date);
    			$function_total_visitor_3 = $class_administrative->total_visitor_3($min3date);
    			$function_total_visitor_4 = $class_administrative->total_visitor_4($min4date);
    			$function_total_visitor_5 = $class_administrative->total_visitor_5($min5date);
    			$function_total_visitor_6 = $class_administrative->total_visitor_6($min6date);
    			$function_total_visitor_7 = $class_administrative->total_visitor_7($min7date);

    			$maxvisitor = max($function_total_visitor_1, $function_total_visitor_2, $function_total_visitor_3, $function_total_visitor_4, $function_total_visitor_5, $function_total_visitor_6, $function_total_visitor_7);
			?>
			var handleInteractiveChart=function(){"use strict";function e(e,t,n){
				$('<div id="tooltip" class="flot-tooltip">'+n+"</div>")
					.css({top:t-45,left:e-55})
					.appendTo("body")
					.fadeIn(200)}
					if($("#interactive-chart").length!==0){
						var t=[[1,40],[2,50],[3,60],[4,60],[5,60],[6,65],[7,75]];
						var n=[
							[1,<?php echo $function_total_visitor_7 ?>],
							[2,<?php echo $function_total_visitor_6 ?>],
							[3,<?php echo $function_total_visitor_5 ?>],
							[4,<?php echo $function_total_visitor_4 ?>],
							[5,<?php echo $function_total_visitor_3 ?>],
							[6,<?php echo $function_total_visitor_2 ?>],
							[7,<?php echo $function_total_visitor_1 ?>]
						];
						var r=[[1,"<?php echo $xdate7 ?>"],[2,"<?php echo $xdate6 ?>"],[3,"<?php echo $xdate5 ?>"],[4,"<?php echo $xdate4 ?>"],[5,"<?php echo $xdate3 ?>"],[6,"<?php echo $xdate2 ?>"],[7,"<?php echo $xdate1 ?>"]];
						$.plot($("#interactive-chart"),[{
							data:t,
							color:blue,
							lines:{
								show:false
							},
							points:{
								show:false
							}
						},{
							data:n,
							label:"Visitors",
							color:green,
							lines:{
								show:true,
								fill:false,
								lineWidth:2
							},
							points:{
								show:true,
								radius:3,
								fillColor:"#fff"
							},
							shadowSize:0
						}],{
							xaxis:{
								ticks:r,
								tickDecimals:0,
								tickColor:"#ddd"
							},
							yaxis:{
								ticks:10,
								tickColor:"#ddd",
								min:0,
								max:<?php if($maxvisitor<=100) { echo "200";} else { $showmax = $maxvisitor+($maxvisitor*0.5); echo $showmax; } ?>
							},
							grid:{
								hoverable:true,
								clickable:true,
								tickColor:"#ddd",
								borderWidth:1,
								backgroundColor:"#fff",
								borderColor:"#ddd"
							},
							legend:{
								labelBoxBorderColor:"#ddd",
								margin:10,
								noColumns:1,
								show:true
							}
						});
						var i=null;
						$("#interactive-chart").bind("plothover",function(t,n,r){
							$("#x").text(n.x.toFixed(0));
							$("#y").text(n.y.toFixed(0));
							if(r){if(i!==r.dataIndex){
								i=r.dataIndex;$("#tooltip").remove();var s=r.datapoint[1].toFixed(0);var o=r.series.label+" "+s;e(r.pageX,r.pageY,o
							)}
							}else{
								$("#tooltip").remove();i=null
							}t.preventDefault()
						})
				}};
			var chart=function(){"use strict";return{init:function(){
				handleInteractiveChart();
			}}}();
			chart.init();
			<?php
    			$function_total_visitor_gc = $class_administrative->total_visitor_browser_chrome();
    			$function_total_visitor_mf = $class_administrative->total_visitor_browser_firefox();
    			$function_total_visitor_sf = $class_administrative->total_visitor_browser_safari();
    			$function_total_visitor_op = $class_administrative->total_visitor_browser_opera();
    			$function_total_visitor_ns = $class_administrative->total_visitor_browser_netscape();
    			$function_total_visitor_ie = $class_administrative->total_visitor_browser_ie();
			?>

		    if (0 !== $("#donut-chart").length) {
		        var e = [
		        <?php
		        	if($function_total_visitor_gc != 0) {
		        		$data_gc = $function_total_visitor_gc / $function_total_visitor * 100;
		        ?>
		        {
		            label: "Chrome",
		            data: <?php echo $data_gc ?>,
		            color: green
		        },
		        <?php } ?>
		        <?php
		        	if($function_total_visitor_mf != 0) {
		        		$data_mf = $function_total_visitor_mf / $function_total_visitor * 100;
		        ?>
		        {
		            label: "Firefox",
		            data: <?php echo $data_mf ?>,
		            color: orange
		        },
		        <?php } ?>
		        <?php
		        	if($function_total_visitor_sf != 0) {
		        		$data_sf = $function_total_visitor_sf / $function_total_visitor * 100;
		        ?>
		        {
		            label: "Safari",
		            data: <?php echo $data_sf ?>,
		            color: blueLight
		        },
		        <?php } ?>
		        <?php
		        	if($function_total_visitor_op != 0) {
		        		$data_op = $function_total_visitor_op / $function_total_visitor * 100;
		        ?>
		        {
		            label: "Opera",
		            data: <?php echo $data_op ?>,
		            color: red
		        }, 
		        <?php } ?>
		        <?php
		        	if($function_total_visitor_ie != 0) {
		        		$data_ie = $function_total_visitor_ie / $function_total_visitor * 100;
		        ?>
		        {
		            label: "IE",
		            data: <?php echo $data_ie ?>,
		            color: blueDark
		        },
		        <?php } ?>
		        <?php
		        	if($function_total_visitor_ns != 0) {
		        		$data_ns = $function_total_visitor_ns / $function_total_visitor * 100;
		        ?>
		        {
		            label: "Netscape",
		            data: <?php echo $data_ns ?>,
		            color: greenDark
		        }
		        <?php } ?>
		        ];
		        $.plot("#donut-chart", e, {
		            series: {
		                pie: {
		                    innerRadius: .5,
		                    show: !0,
		                    label: {
		                        show: !0
		                    }
		                }
		            },
		            legend: {
		                show: 0
		            }
		        })
		    }
			
			<?php
				}
				if($section == 'mail' || $section == 'message') {
			?>
			CKEDITOR.replace( 'simple_editor', {
				toolbar: [
					{ name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
					[ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],		// Line break - next group will be placed in new line.
					{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Blockquote' ] },
					{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
					'/',
					{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
					{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
					{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
					{ name: 'others', items: [ '-' ] }
				]
			});
		<?php
			}
			if($section == "history") {
		?>
		    var e={
		    	left:"today prev,next ",
		    	center:"title",
		    	right:"month,agendaWeek,agendaDay"
		    	};
		    var t=new Date;
		    var n=t.getMonth();
		    var r=t.getFullYear();
		    var i=$("#calendar").fullCalendar({
		    		header:e,
		    		eventRender:function(e,t,n){
		    				var r=e.media?e.media:"";
		    				var i=e.description?e.description:"";t.find(".fc-event-title").after($('<span class="fc-event-icons"></span>').html(r));t.find(".fc-event-title").append("<small>"+i+"</small>")},
		    		editable:false,
		    		eventLimit: true,
		    		views: {
				        agenda: {
				            eventLimit: 3 // adjust to 6 only for agendaWeek/agendaDay
				        }
				    },
		    		events:[
		    			<?php
		    				foreach ($function_view_history as $data) {
		    					$history_data = $data->cr_historyDateTime;
                    			$history_date = date('Y-m-d', strtotime($history_data));
                    			$history_time = date('H:i', strtotime($history_data));
		    			?>
		    			{
		    				title:"<?php echo $history_time. ' '.$data->cr_historyTitle ?>",
		    				start: "<?php echo $history_date.'T'.$history_time ?>",
		    				allday: false,
		    				className:"bg-<?php echo $data->cr_historyColor ?>",
		    				media:'',
		    				description:"<?php echo $data->cr_historyDetail ?>"
		    			},
		    			<?php
		    				}
		    			?>
		    		]});
		<?php
			}
		?>
		});
	</script>
</body>
</html>
<?php } } ?>