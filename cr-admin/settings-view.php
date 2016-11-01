<?php
    $function_sitename           = $class_settings->view_settings_sitename();
    $function_tagline    		 = $class_settings->view_settings_tagline();
    $function_email      		 = $class_settings->view_settings_email();
    $function_phone      		 = $class_settings->view_settings_phone();
    $function_address    		 = $class_settings->view_settings_address();
    $function_meta_keywords      = $class_settings->view_settings_metakeywords();
    $function_meta_desc          = $class_settings->view_settings_metadesc();
    $function_timezone           = $class_settings->view_settings_timezone();
    $function_date_format		 = $class_settings->view_settings_date_format();
    $function_time_format 		 = $class_settings->view_settings_time_format();
    $function_recaptcha_sitekey  = $class_settings->view_settings_recaptcha_sitekey();
    $function_recaptcha_secret   = $class_settings->view_settings_recaptcha_secret();
    $function_api_map     		 = $class_settings->view_settings_apimap();
    $function_analytics_code     = $class_settings->view_settings_analytics();
    $function_coming_soon        = $class_settings->view_settings_coming_soon();
    $function_maintenance        = $class_settings->view_settings_maintenance();
    $function_bg_login           = $class_settings->view_settings_background_login();
    $function_open_order         = $class_settings->view_settings_open_order();
    $function_close_order        = $class_settings->view_settings_close_order();
    $function_gosmsgateway_user  = $class_settings->view_settings_gosmsgateway_username();
    $function_gosmsgateway_pass  = $class_settings->view_settings_gosmsgateway_password();
?>
<div class="row">
    <div class="col-md-9">
	    <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Setting List</h4>
            </div>
            <div class="panel-body">
            		<h4>Website Setting</h4>
                	<div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="table-setting">Setting</th>
                                    <th class="table-value">Value</th>
                                    <th class="table-action text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            		<td class="add-caps">Site Name</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_sitename->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo $function_sitename->cr_settingValue;
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Site Name" data-settingid="<?php echo $function_sitename->cr_settingID; ?>"  data-settingvalue="<?php echo $function_sitename->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Tag Line</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_tagline->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo $function_tagline->cr_settingValue;
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Tag Line" data-settingid="<?php echo $function_tagline->cr_settingID; ?>" data-settingvalue="<?php echo $function_tagline->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Email</td>
                            		<td class="">
                            			<?php
                            				if($function_email->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo strtolower($function_email->cr_settingValue);
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Email" data-settingid="<?php echo $function_email->cr_settingID; ?>" data-settingvalue="<?php echo $function_email->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Phone</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_phone->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo $function_phone->cr_settingValue;
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Phone" data-settingid="<?php echo $function_phone->cr_settingID; ?>" data-settingvalue="<?php echo $function_phone->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Address</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_address->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo $function_address->cr_settingValue;
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Address" data-settingid="<?php echo $function_address->cr_settingID; ?>" data-settingvalue="<?php echo $function_address->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Timezone</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_timezone->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo $function_timezone->cr_settingValue;
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-timezone" data-dn="Timezone" data-settingid="<?php echo $function_timezone->cr_settingID; ?>" data-settingvalue="<?php echo $function_timezone->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Date Format</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_date_format->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo date($function_date_format->cr_settingValue);
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-date-format" data-dn="Date Format" data-settingid="<?php echo $function_date_format->cr_settingID; ?>" data-settingvalue="<?php echo $function_date_format->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Time Format</td>
                            		<td class="">
                            			<?php
                            				if($function_time_format->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo date($function_time_format->cr_settingValue);
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-time-format" data-dn="Time Format" data-settingid="<?php echo $function_time_format->cr_settingID; ?>" data-settingvalue="<?php echo $function_time_format->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            </tbody>
                        </table>
                    </div>

                    <h4>Google reCaptcha, Map API, and Analytics</h4>
                   	<div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="table-setting">Setting</th>
                                    <th class="table-value">Value</th>
                                    <th class="table-action text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<!-- reCaptcha -->
                            	<tr>
                            		<td class="add-caps">Google reCaptcha Sitekey</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_recaptcha_sitekey->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo $function_recaptcha_sitekey->cr_settingValue;
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Google reCaptcha Sitekey" data-settingid="<?php echo $function_recaptcha_sitekey->cr_settingID; ?>" data-settingvalue="<?php echo $function_recaptcha_sitekey->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Google reCaptcha Secret Code</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_recaptcha_secret->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo $function_recaptcha_secret->cr_settingValue;
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Google reCaptcha Secret Code" data-settingid="<?php echo $function_recaptcha_secret->cr_settingID; ?>" data-settingvalue="<?php echo $function_recaptcha_secret->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Google Map API</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_api_map->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo $function_api_map->cr_settingValue;
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Google Map API" data-settingid="<?php echo $function_api_map->cr_settingID; ?>" data-settingvalue="<?php echo $function_api_map->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Google Analytics Code</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_analytics_code->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo "Click pencil icon to see your Google Analytics code";
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-analytics" data-dn="Google Analytics Code" data-settingid="<?php echo $function_analytics_code->cr_settingID; ?>" data-settingvalue="<?php echo $function_analytics_code->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            </tbody>
                        </table>
                    </div>

                    <h4>Go SMS Gateway Setting</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="table-setting">Setting</th>
                                    <th class="table-value">Value</th>
                                    <th class="table-action text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- reCaptcha -->
                                <tr>
                                    <td class="add-caps">Username</td>
                                    <td class="add-caps">
                                        <?php
                                            if($function_gosmsgateway_user->cr_settingValue == '')
                                                echo "None";
                                            else
                                                echo $function_gosmsgateway_user->cr_settingValue;
                                         ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Go SMS Gateway Username" data-settingid="<?php echo $function_gosmsgateway_user->cr_settingID; ?>" data-settingvalue="<?php echo $function_gosmsgateway_user->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="add-caps">Password</td>
                                    <td class="add-caps">
                                        <?php
                                            if($function_gosmsgateway_pass->cr_settingValue == '')
                                                echo "None";
                                            else
                                                echo $function_gosmsgateway_pass->cr_settingValue;
                                         ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Go SMS Gateway Password" data-settingid="<?php echo $function_gosmsgateway_pass->cr_settingID; ?>" data-settingvalue="<?php echo $function_gosmsgateway_pass->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h4>SEO Setting</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="table-setting">Setting</th>
                                    <th class="table-value">Value</th>
                                    <th class="table-action text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            		<td class="add-caps">Meta Keywords</td>
                            		<td class="add-caps">
                            			<?php
                            				if($function_meta_keywords->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo $function_meta_keywords->cr_settingValue;
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Meta Keywords" data-settingid="<?php echo $function_meta_keywords->cr_settingID; ?>"  data-settingvalue="<?php echo $function_meta_keywords->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            	<tr>
                            		<td class="add-caps">Meta Description</td>
                            		<td class="">
                            			<?php
                            				if($function_meta_desc->cr_settingValue == '')
                            			 		echo "None";
                            			 	else
                            			 		echo $function_meta_desc->cr_settingValue;
                            			 ?>
                            		</td>
                            		<td class="text-center">
                            			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#modal-edit-settings" data-dn="Meta Description" data-settingid="<?php echo $function_meta_desc->cr_settingID; ?>"  data-settingvalue="<?php echo $function_meta_desc->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
                            		</td>
                            	</tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-9 -->
	<!-- begin col-3 -->
    <div class="col-md-3">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Maintenance Mode</h4>
            </div>
            <div class="panel-body">
				<button id="btn-mtn" class="btn btn-lg btn-success btn-block" data-toggle="modal" data-target="#<?php if($function_coming_soon->cr_settingValue == "enable") echo "modal-disable-maintenance"; elseif($function_coming_soon->cr_settingValue == "disable") echo "modal-enable-maintenance" ?>" data-settingcs="<?php echo $function_coming_soon->cr_settingID ?>" data-settingm="<?php echo $function_maintenance->cr_settingID ?>" data-settingcsname="<?php echo $function_coming_soon->cr_settingValue ?>">
					<i class="fa fa-wrench fa-2x pull-left"></i>
					<span class="f-w-700">Maintenance</span><br>
					<small>Change Website Mode</small>
				</button>
                <button id="btn-order-time" class="btn btn-lg btn-brown btn-block" data-toggle="modal" data-target="#modal-order-time">
                    <i class="fa fa-clock-o fa-2x pull-left"></i>
                    <span class="f-w-700">Order Time</span><br>
                    <small>Change Order Time</small>
                </button>
			</div>
		</div>
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Login Background</h4>
            </div>
            <div class="panel-body">
                <div id="used-image-container">
                    <?php
                        if($function_bg_login->cr_settingValue == '') 
                            echo '<img width="100%" src="'.MADMINURL.'assets/img/login-bg/bg.jpg">';
                        else 
                            echo '<img width="100%" src="'.MURL.'cr-editor/images/'.$function_bg_login->cr_settingValue.'">'
                    ?>
                </div>
                <form action="<?php echo MADMINURL ?>ajax/media-select-upload.php" class="dropzone" id="logindropzone">
                    <div class="dz-message text-center">
                        <h3><i class="fa fa-cloud-upload fa-2x"></i></h3>
                        <h4>Drag and Drop Files</h4>
                    </div>
                </form>
                <p class="fancy m-t-20"><span>OR</span></p>
                <button id="browse-media-button" data-target="#browse-media-dialog" data-toggle="modal" class="btn btn-success btn-block m-t-15"><i class="fa fa-image"></i> Browse Media</button>
            </div>
        </div>
        <div class="panel-group" id="accordion">
			<div class="panel panel-inverse overflow-hidden">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a aria-expanded="true" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseSettingValue">
						    <i class="fa fa-plus-circle pull-right"></i> 
							Settings and Value
						</a>
					</h3>
				</div>
				<div style="" aria-expanded="true" id="collapseSettingValue" class="panel-collapse collapse in">
					<div class="panel-body">
						<p>Setting page contains the general website setting and SEO setting. Fill the SEO setting, Meta Keywords and Meta Description for found more easily by search engines.</p>
					</div>
				</div>
			</div>
			<div class="panel panel-inverse overflow-hidden">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a aria-expanded="false" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseReCaptcha">
						    <i class="fa fa-plus-circle pull-right"></i> 
							Google reCaptcha
						</a>
					</h3>
				</div>
				<div style="" aria-expanded="false" id="collapseReCaptcha" class="panel-collapse collapse">
					<div class="panel-body">
						<img src="<?php echo MADMINURL ?>assets/img/google-recaptcha-logo.png" width="100%">
						<p>Creatify uses Google reCaptcha for sending message from contact page,sending comment from post page, and send feedback. Click <a href="https://www.google.com/recaptcha/intro/index.html"><span class="badge badge-success badge-square">here</span></a> if you don't have Google reCaptcha Sitekey and Secret Code.</p>
					</div>
				</div>
			</div>
			<div class="panel panel-inverse overflow-hidden">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a aria-expanded="false" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseMapApi">
						    <i class="fa fa-plus-circle pull-right"></i> 
							Google Map API
						</a>
					</h3>
				</div>
				<div style="" aria-expanded="false" id="collapseMapApi" class="panel-collapse collapse">
					<div class="panel-body">
						<img src="<?php echo MADMINURL ?>assets/img/google-map-logo.png" width="100%">
						<p>You need to create or select a project in the Google Developers Console and enable the API for your website. Click <a href="https://console.developers.google.com//flows/enableapi?apiid=maps_backend&keyType=CLIENT_SIDE&reusekey=true"><span class="badge badge-success badge-square">here</span></a>, which guides you through the process and activates the Google Maps JavaScript API automatically.</p>
					</div>
				</div>
			</div>
			<div class="panel panel-inverse overflow-hidden">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a aria-expanded="false" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseAnalyticscode">
						    <i class="fa fa-plus-circle pull-right"></i> 
							Google Analytics Code
						</a>
					</h3>
				</div>
				<div style="" aria-expanded="false" id="collapseAnalyticscode" class="panel-collapse collapse">
					<div class="panel-body">
						<img src="<?php echo MADMINURL ?>assets/img/google-analytics-logo.png" width="100%">
						<p>Google Analytics helps you analyze visitor traffic and paint a complete picture of your audience and their needs. Track the routes people take to reach you and the devices they use to get there with reporting tools. Click <a href="http://www.google.com/analytics/"><span class="badge badge-success badge-square">here</span></a> to get your code.</p>
					</div>
				</div>
			</div>
			<div class="panel panel-inverse overflow-hidden">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a aria-expanded="false" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
							<i class="fa fa-plus-circle pull-right"></i> 
							Action Button
						</a>
					</h3>
				</div>
				<div style="height: 0px;" aria-expanded="false" id="collapseTwo" class="panel-collapse collapse">
					<div class="panel-body">
						<p>
							Click the pencil button <button type="button" class="btn btn-success btn-xs btn-icon btn-circle"><i class="fa fa-pencil"></i></button> to edit setting value. It will show the pop up with form to edit the setting.
						</p>
					</div>
				</div>
			</div>
		</div>
        <!-- end panel -->
    </div>
</div>

<?php
    $class_media = new Media($pdo);
    $function_view_media_data = $class_media->view_media_data();
?>
<div class="modal fade" id="browse-media-dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Browse Media</h4>
            </div>
            <div class="modal-body">
                <div id="error-handling"></div>
                <div class="row">
                    <div class="col-md-9">
                    <form id="form-media-browse" action="" method="POST">
                        <div class="form-group">
                        <?php
                            $i = 1;
                            foreach($function_view_media_data as $data) {
                        ?>
                            <div class="col-md-3">   
                                <label class="rwi">
                                    <input class="" type="radio" name="mediaselect" value="<?php echo $data->cr_mediaName ?>" data-title="<?php if(empty($data->cr_mediaTitle)) echo 'No title'; else echo $data->cr_mediaTitle ?>" data-desc="<?php if(empty($data->cr_mediaDesc)) echo 'No description'; else echo $data->cr_mediaDesc ?>" <?php if($i == 1) echo 'checked="checked"' ?>>
                                    <div class="nailthumb-container modal-square-thumb">
                                        <img style="width:100%" src="<?php echo MURL."cr-editor/images/".$data->cr_mediaName ?>">
                                    </div>
                                </label>
                            </div>
                        <?php
                                $i++;
                            }
                        ?>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    </div>
                    <div class="col-md-3">
                        <?php
                            $function_view_latest_media_data = $class_media->view_latest_media_data();
                        ?>
                        <legend>Media Information</legend>
                        <dl>
                            <dt>Title</dt>
                            <dd id="media-title-info"><?php if(empty($function_view_latest_media_data->cr_mediaTitle)) echo 'No title'; else echo $function_view_latest_media_data->cr_mediaTitle ?></dd>
                            <dt class="m-t-10">Description</dt>
                            <dd id="media-desc-info"><?php if(empty($function_view_latest_media_data->cr_mediaDesc)) echo 'No title'; else echo $function_view_latest_media_data->cr_mediaDesc ?></dd>
                        </dl>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-media-select" type="button" class="btn btn-success">Select</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Failed to upload the image. Please try again.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="dng" class="modal-title"></h4>
      </div>
        <div class="modal-body">
            <form id="form-edit-settings" data-parsley-validate action="" method="POST">
                <input type="hidden" name="settingIDh" value="" id="settingidg">
                <input type="hidden" name="settingname" value="" id="dng2">
                <div class="form-group">
                    <label class="control-label">Value</label>
                    <input id="settingvalueg" class="form-control" placeholder="Setting Value" type="text" name="value" value="" data-parsley-maxlength="100">
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-edit-settings" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-analytics" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="dna" class="modal-title"></h4>
      </div>
        <div class="modal-body">
            <form id="form-edit-analytics" data-parsley-validate action="" method="POST">
                <input type="hidden" name="settingIDh" value="" id="settingida">
                <input type="hidden" name="settingname" value="" id="dna2">
                <div class="form-group">
                    <label class="control-label">Value</label>
                    <textarea id="settingvaluea" class="form-control" placeholder="Setting Value" name="value" rows="6"></textarea>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-edit-analytics" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-enable-maintenance" tabindex="-1" role="dialog" aria-labelledby="modal-enable-maintenance" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Maintenance Mode</h4>
      </div>
        <div class="modal-body">
            <form id="form-enable-maintenance" data-parsley-validate action="" method="POST">
                <input type="hidden" name="settingIDhe" value="" id="settingcsenable">
            	<input type="hidden" name="settingIDhm" value="">
                <input type="hidden" name="settingname" value="" id="settingcsnameenable">
                <div class="form-group">
                	<input type="text" class="form-control" id="datepicker-default" placeholder="Will be online at" data-date-format="yyyy-mm-dd" data-date-start-date="Date.default" name="datemaintenance" required />
                </div>
                <div class="form-group">
                	<div class="input-group bootstrap-timepicker">
						<input id="timepicker" type="text" class="form-control" name="timemaintenance" required />
						<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
					</div>
				</div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-enable-maintenance" type="submit" class="btn btn-success">Enable</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-disable-maintenance" tabindex="-1" role="dialog" aria-labelledby="modal-disable-maintenance" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Maintenance Mode</h4>
      </div>
        <div class="modal-body">
        	<p>Are you sure want to disable maintenance mode?</p>
            <form id="form-disable-maintenance" data-parsley-validate action="" method="POST">
                <input type="hidden" name="settingIDh" value="" id="settingcs">
                <input type="hidden" name="settingname" value="" id="settingcsname">
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-disable-maintenance" type="submit" class="btn btn-success">Disable</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-order-time" tabindex="-1" role="dialog" aria-labelledby="modal-order-time" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order Time</h4>
      </div>
        <div class="modal-body">
            <form id="form-order-time" data-parsley-validate action="" method="POST">
                <input type="hidden" name="settingIDopen" value="<?php echo $function_open_order->cr_settingID ?>">
                <input type="hidden" name="settingIDclose" value="<?php echo $function_close_order->cr_settingID ?>">
                <div class="form-group">
                    <div class="input-group bootstrap-timepicker">
                        <input type="text" class="form-control time-order" name="timeopen" value="<?php echo $function_open_order->cr_settingValue ?>" required />
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group bootstrap-timepicker">
                        <input type="text" class="form-control time-order" name="timeclose" value="<?php echo $function_close_order->cr_settingValue ?>" required />
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-order-time" type="submit" class="btn btn-success">Change</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-timezone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="dnt" class="modal-title"></h4>
      </div>
        <div class="modal-body">
        <form id="form-edit-timezone" data-parsley-validate action="" method="POST">
            <input type="hidden" name="settingIDh" value="" id="settingidt">
            <input type="hidden" name="settingname" value="" id="dnt2">
            <div class="form-group">
                <label class="control-label">Select Timezone</label>
                <select class="form-control" name="value" required>
                    <option value="">Select Timezone</option>
                <?php
                	$timezonelist = generate_timezone_list();
					foreach ($timezonelist as $listtz) {
                ?>
                    <option value="<?php echo $listtz ?>" <?php if($function_timezone->cr_settingValue==$listtz) echo "selected" ?>><?php echo $listtz ?></option>
                <?php
                	}
                ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-edit-timezone" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-date-format" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="dndf" class="modal-title"></h4>
      </div>
        <div class="modal-body">
	        <form id="form-date-format" data-parsley-validate action="" method="POST">
	            <input type="hidden" name="settingIDh" value="" id="settingiddf">
	            <input type="hidden" name="settingname" value="" id="dndf2">
	            <div class="form-group">
	                <label class="control-label">Select Date Format</label>
	                <select class="form-control" name="value" required>
	                    <option value="">Select Date Format</option>
	                    <option value="F d, Y" <?php if($function_date_format->cr_settingValue=="F d, Y") echo "selected" ?>><?php echo date('F d, Y') ?></option>
	                    <option value="Y-n-d" <?php if($function_date_format->cr_settingValue=="Y-n-d") echo "selected" ?>><?php echo date('Y-n-d') ?></option>
	                    <option value="n/d/Y" <?php if($function_date_format->cr_settingValue=="n/d/Y") echo "selected" ?>><?php echo date('n/d/Y') ?></option>
	                    <option value="d/n/Y" <?php if($function_date_format->cr_settingValue=="d/n/Y") echo "selected" ?>><?php echo date('d/n/Y') ?></option>
	                </select>
	            </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-date-format" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-time-format" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="dntf" class="modal-title"></h4>
      </div>
        <div class="modal-body">
            <form id="form-time-format" data-parsley-validate action="" method="POST">
                <input type="hidden" name="settingIDh" value="" id="settingidtf">
                <input type="hidden" name="settingname" value="" id="dntf2">
                <div class="form-group">
                    <label class="control-label">Select Time Format</label>
                    <select class="form-control" name="value" required>
                        <option value="">Select Time Format</option>
                        <option value="g:i a" <?php if($function_time_format->cr_settingValue=="g:i a") echo "selected" ?>><?php echo date('g:i a') ?></option>
                        <option value="g:i A" <?php if($function_time_format->cr_settingValue=="g:i A") echo "selected" ?>><?php echo date('g:i A') ?></option>
                        <option value="G:i" <?php if($function_time_format->cr_settingValue=="G:i") echo "selected" ?>><?php echo date('G:i') ?></option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-time-format" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-price-format" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="dnpf" class="modal-title"></h4>
      </div>
        <div class="modal-body">
            <form id="form-price-format" data-parsley-validate action="" method="POST">
                <input type="hidden" name="settingIDh" value="" id="settingidpf">
                <input type="hidden" name="settingname" value="" id="dnpf2">
                <div class="form-group">
                    <label class="control-label">Select Price Format</label>
                    <select class="form-control" name="value" required>
                        <option value="">Select Price Format</option>
                        <option value="idr" <?php if($function_price_format->cr_settingValue == 'idr') echo 'selected="selected"' ?>><?php echo format_idr(1000000) ?></option>
                        <option value="rp" <?php if($function_price_format->cr_settingValue == 'rp') echo 'selected="selected"' ?>><?php echo format_rupiah(1000000) ?></option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-price-format" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<link href="<?php echo MADMINURL ?>assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
<link href="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL ?>assets/plugins/dropzone/dropzone.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/number-updown/updown.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#browse-media-dialog').on('show.bs.modal', function(e) {
            var thumbnail_width = $('.modal-square-thumb').width();
            $('.modal-square-thumb').css({'height':thumbnail_width+'px'});
            $('.nailthumb-container').nailthumb();
        });
        Dropzone.options.logindropzone = {
          maxFilesize: 5, // MB
          maxFiles: 1,
          acceptedFiles: "image/*",
          success: function( file, response ){
            if(response != false) {
                $('#browse-media-button').attr('disabled','disabled');
                $('#used-image-container').slideUp(1000);
                var setting      = 'Login Background';
                var setting_idh  = '<?php echo $function_bg_login->cr_settingID ?>';
                var dataString   = 'value='+response+'&settingname='+setting+'&settingIDh='+setting_idh;
                $.ajax({
                    type: "POST",
                    url:  "<?php echo MADMINURL ?>ajax/settings-update.php",
                    data: dataString,
                    cache: false,
                    success: function(msg){
                        var message = msg.split('!')[0];
                        var setting_name = msg.split('!')[1];
                        if(message == 'false') {
                            $.gritter.add({
                                title:"Failed! Something error with media file",
                                text:"Can't select media. Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(message == 'true') {
                            $.gritter.add({
                                title:"Success!",
                                text:setting_name + " has been updated.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                            setTimeout(function() {
                                window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                            }, 2000);
                        }
                        else {
                            $.gritter.add({
                                title:"Error! Can't update setting",
                                text:"Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                    }
                });
            }
            else {
                $('#modal-alert').modal('show');
            }
          }
        };
        var selected_media_title = $('input[name=mediaselect]:checked').attr('data-title');
        var selected_media_desc  = $('input[name=mediaselect]:checked').data('desc');
        $('#media-title-info').html(selected_media_title);
        $('#media-desc-info').html(selected_media_desc);
        $('input[name=mediaselect]').click(function() {
            var selected_media_title = $(this).data('title');
            var selected_media_desc  = $(this).data('desc');
            $('#media-title-info').html(selected_media_title);
            $('#media-desc-info').html(selected_media_desc);
        })
        $("#button-media-select").click(function(){
            var media = $('input[name=mediaselect]:checked').val();
            $("#button-media-select").attr('disabled','disabled');
            $("#button-media-select").html('<i class="fa fa-spinner fa-pulse"></i>');
            setTimeout(function() {
                $('#browse-media-dialog').modal('hide');
                $("#button-media-select").removeAttr('disabled');
                $("#button-media-select").html('Select');
            }, 2000);
            $('#used-image-container').html('<img style="width: 100%" class="" src="<?php echo MURL."cr-editor/images/" ?>'+media+'">');
            //$('#mediafile').attr('value', media);
            var setting      = 'Login Background';
            var setting_idh  = '<?php echo $function_bg_login->cr_settingID ?>';
            var dataString   = 'value='+media+'&settingname='+setting+'&settingIDh='+setting_idh;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/settings-update.php",
                data: dataString,
                cache: false,
                success: function(msg){
                    var message = msg.split('!')[0];
                    var setting_name = msg.split('!')[1];
                    if(message == 'false') {
                        $.gritter.add({
                            title:"Failed! Something error with media file",
                            text:"Can't select media. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(message == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:setting_name + " has been updated.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else {
                        $.gritter.add({
                            title:"Error! Can't update setting",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                }
            });
            return false;
        });

        var val1 = $('#btn-mtn').data("settingcs");
    	var val2 = $('#btn-mtn').data("settingcsname");
        var val3 = $('#btn-mtn').data("settingm");

    	$('#settingcsenable').val(val1);
        $('#settingcsnameenable').val(val2);
    	$('input[name="settingIDhm"]').val(val3);

        $('#modal-disable-maintenance').on('show.bs.modal', function(e) {
            $(this).find('#settingcs').attr('value', $(e.relatedTarget).data('settingcs'));
            $(this).find('#settingcsname').attr('value', $(e.relatedTarget).data('settingcsname'));
        });

        $('#e-commerce-modal').on('show.bs.modal', function(e) {
            $(this).find('#ecvalue').attr('value', $(e.relatedTarget).data('settingec'));
            $(this).find('#settingid').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('#settingcsname').attr('value', $(e.relatedTarget).data('settingecname'));
        });

        $('#modal-edit-settings').on('show.bs.modal', function(e) {
            $(this).find('#settingidg').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('#settingvalueg').attr('value', $(e.relatedTarget).data('settingvalue'));
            $(this).find('#dng').html($(e.relatedTarget).data('dn'));
            $(this).find('#dng2').attr('value', $(e.relatedTarget).data('dn'));

            var validtype = $(this).find(".modal-title").html();
            if(validtype == "Email") {
            	$("#settingvalueg").attr("data-parsley-type", "email");
            }
            else if(validtype == "Phone") {
                $("#settingvalueg").mask("9999999999?99");
            }
            else {
            	$("#settingvalueg").removeAttr("data-parsley-type");
            }

            if(validtype == "Site Name") {
            	$("#settingvalueg").attr("data-parsley-maxlength",70);
            }
            else if(validtype == "Meta Description") {
            	$("#settingvalueg").attr("data-parsley-maxlength",155);
            }
            else {
            	$("#settingvalueg").attr("data-parsley-maxlength",100);
            }
        });

        $('#modal-tax-settings').on('show.bs.modal', function(e) {
            $(this).find('input[name=settingIDh]').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('input[name=value]').attr('value', $(e.relatedTarget).data('settingvalue'));
            $(this).find('.modal-title').html($(e.relatedTarget).data('dn'));
            $(this).find('input[name=settingname]').attr('value', $(e.relatedTarget).data('dn'));

            var $tax_value = $(this).find('input[name=value]');
            $tax_value.updown({
                step: 1,
                min: 0,
                max: 100
            });
            var $updown = $tax_value.data('updown');
            $(this).find('#tax-increase').click(function(event){
                $updown.increase(event);
                $updown.triggerEvents();
            });
            $(this).find('#tax-decrease').click(function(event){
                $updown.decrease(event);
                $updown.triggerEvents();
            });
        });

        $('#modal-edit-timezone').on('show.bs.modal', function(e) {
            $(this).find('#settingidt').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('#settingvaluet').attr('value', $(e.relatedTarget).data('settingvalue'));
            $(this).find('#dnt').html($(e.relatedTarget).data('dn'));
            $(this).find('#dnt2').attr('value', $(e.relatedTarget).data('dn'));
        });

        $('#modal-date-format').on('show.bs.modal', function(e) {
            $(this).find('#settingiddf').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('#dndf').html($(e.relatedTarget).data('dn'));
            $(this).find('#dndf2').attr('value', $(e.relatedTarget).data('dn'));
        });

        $('#modal-time-format').on('show.bs.modal', function(e) {
            $(this).find('#settingidtf').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('#dntf').html($(e.relatedTarget).data('dn'));
            $(this).find('#dntf2').attr('value', $(e.relatedTarget).data('dn'));
        });

        $('#modal-price-format').on('show.bs.modal', function(e) {
            $(this).find('#settingidpf').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('#dnpf').html($(e.relatedTarget).data('dn'));
            $(this).find('#dnpf2').attr('value', $(e.relatedTarget).data('dn'));
        });

        $('#modal-edit-analytics').on('show.bs.modal', function(e) {
            $(this).find('#settingida').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('#settingvaluea').attr('value', $(e.relatedTarget).data('settingvalue'));
            $(this).find('#dna').html($(e.relatedTarget).data('dn'));
            $(this).find('#dna2').attr('value', $(e.relatedTarget).data('dn'));
        });

        var edit_settings;
        $("#form-edit-settings").submit(function(event){
            if (edit_settings) {
                edit_settings.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_settings = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-update.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-settings").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-settings").attr('disabled','disabled');},
                data: serializedData
            });
            edit_settings.done(function (msg){
            	var message = msg.split('!')[0];
            	var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-edit-settings").removeAttr('disabled');
                    $("#button-edit-settings").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! No setting selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been updated.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-edit-settings").removeAttr('disabled');
                    $("#button-edit-settings").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update setting",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-edit-settings").removeAttr('disabled');
                    $("#button-edit-settings").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update setting",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_settings.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var edit_tax_settings;
        $("#form-tax-settings").submit(function(event){
            if (edit_tax_settings) {
                edit_tax_settings.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_tax_settings = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-update.php",
                type: "post",
                beforeSend: function(){ $("#button-tax-settings").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-tax-settings").attr('disabled','disabled');},
                data: serializedData
            });
            edit_tax_settings.done(function (msg){
                var message = msg.split('!')[0];
                var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-tax-settings").removeAttr('disabled');
                    $("#button-tax-settings").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! No setting selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been updated.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-tax-settings").removeAttr('disabled');
                    $("#button-tax-settings").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update setting",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-tax-settings").removeAttr('disabled');
                    $("#button-tax-settings").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update setting",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_tax_settings.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var edit_analytics;
        $("#form-edit-analytics").submit(function(event){
            if (edit_analytics) {
                edit_analytics.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_analytics = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-analytics.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-analytics").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-analytics").attr('disabled','disabled');},
                data: serializedData
            });
            edit_analytics.done(function (msg){
            	var message = msg.split('!')[0];
            	var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-edit-analytics").removeAttr('disabled');
                    $("#button-edit-analytics").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! No setting selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been updated.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-edit-analytics").removeAttr('disabled');
                    $("#button-edit-analytics").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update setting",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-edit-analytics").removeAttr('disabled');
                    $("#button-edit-analytics").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update setting",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_analytics.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var enable_maintenance;
        $("#form-enable-maintenance").submit(function(event){
            if (enable_maintenance) {
                enable_maintenance.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            enable_maintenance = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-enable-maintenance.php",
                type: "post",
                beforeSend: function(){ $("#button-enable-maintenance").html('<i class="fa fa-spinner fa-pulse"></i> Enabling...');$("#button-enable-maintenance").attr('disabled','disabled');},
                data: serializedData
            });
            enable_maintenance.done(function (msg){
            	var message = msg.split('!')[0];
            	var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-enable-maintenance").removeAttr('disabled');
                    $("#button-enable-maintenance").html('Enable');
                    $.gritter.add({
                        title:"Failed! No setting selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been enabled.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-enable-maintenance").removeAttr('disabled');
                    $("#button-enable-maintenance").html('Enable');
                    $.gritter.add({
                        title:"Failed! Can't enable maintenance mode",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-enable-maintenance").removeAttr('disabled');
                    $("#button-enable-maintenance").html('Enable');
                    $.gritter.add({
                        title:"Error! Can't enable maintenance mode",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            enable_maintenance.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var disable_maintenance;
        $("#form-disable-maintenance").submit(function(event){
            if (disable_maintenance) {
                disable_maintenance.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            disable_maintenance = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-disable-maintenance.php",
                type: "post",
                beforeSend: function(){ $("#button-disable-maintenance").html('<i class="fa fa-spinner fa-pulse"></i> Disabling...');$("#button-disable-maintenance").attr('disabled','disabled');},
                data: serializedData
            });
            disable_maintenance.done(function (msg){
            	var message = msg.split('!')[0];
            	var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-disable-maintenance").removeAttr('disabled');
                    $("#button-disable-maintenance").html('Disable');
                    $.gritter.add({
                        title:"Failed! No setting selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been disabled.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-disable-maintenance").removeAttr('disabled');
                    $("#button-disable-maintenance").html('Disable');
                    $.gritter.add({
                        title:"Failed! Can't disable maintenance mode",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-disable-maintenance").removeAttr('disabled');
                    $("#button-disable-maintenance").html('Disable');
                    $.gritter.add({
                        title:"Error! Can't disable maintenance mode",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            disable_maintenance.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var set_order_time;
        $("#form-order-time").submit(function(event){
            if (set_order_time) {
                set_order_time.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            set_order_time = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-update-order-time.php",
                type: "post",
                beforeSend: function(){ $("#button-order-time").html('<i class="fa fa-spinner fa-pulse"></i> Changing...');$("#button-order-time").attr('disabled','disabled');},
                data: serializedData
            });
            set_order_time.done(function (msg){
                var message = msg.split('!')[0];
                var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-order-time").removeAttr('disabled');
                    $("#button-order-time").html('Change');
                    $.gritter.add({
                        title:"Failed! No setting selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been change.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-order-time").removeAttr('disabled');
                    $("#button-order-time").html('Change');
                    $.gritter.add({
                        title:"Failed! Can't change order time",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-order-time").removeAttr('disabled');
                    $("#button-order-time").html('Change');
                    $.gritter.add({
                        title:"Error! Can't change order time",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            set_order_time.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var edit_timezone;
        $("#form-edit-timezone").submit(function(event){
            if (edit_timezone) {
                edit_timezone.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_timezone = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-update.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-timezone").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-timezone").attr('disabled','disabled');},
                data: serializedData
            });
            edit_timezone.done(function (msg){
            	var message = msg.split('!')[0];
            	var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-edit-timezone").removeAttr('disabled');
                    $("#button-edit-timezone").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! No setting selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been updated.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-edit-timezone").removeAttr('disabled');
                    $("#button-edit-timezone").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update timezone",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-edit-timezone").removeAttr('disabled');
                    $("#button-edit-timezone").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update timezone",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_timezone.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var date_format;
        $("#form-date-format").submit(function(event){
            if (date_format) {
                date_format.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            date_format = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-update.php",
                type: "post",
                beforeSend: function(){ $("#button-date-format").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-date-format").attr('disabled','disabled');},
                data: serializedData
            });
            date_format.done(function (msg){
            	var message = msg.split('!')[0];
            	var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-date-format").removeAttr('disabled');
                    $("#button-date-format").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! No setting selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been updated.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-date-format").removeAttr('disabled');
                    $("#button-date-format").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update date format",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-date-format").removeAttr('disabled');
                    $("#button-date-format").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update date format",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            date_format.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var time_format;
        $("#form-time-format").submit(function(event){
            if (time_format) {
                time_format.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            time_format = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-update.php",
                type: "post",
                beforeSend: function(){ $("#button-time-format").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-time-format").attr('disabled','disabled');},
                data: serializedData
            });
            time_format.done(function (msg){
            	var message = msg.split('!')[0];
            	var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-time-format").removeAttr('disabled');
                    $("#button-time-format").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! No setting selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been updated.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-time-format").removeAttr('disabled');
                    $("#button-time-format").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update time format",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-time-format").removeAttr('disabled');
                    $("#button-time-format").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update time format",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            time_format.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var price_format;
        $("#form-price-format").submit(function(event){
            if (price_format) {
                price_format.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            price_format = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-update.php",
                type: "post",
                beforeSend: function(){ $("#button-price-format").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-price-format").attr('disabled','disabled');},
                data: serializedData
            });
            price_format.done(function (msg){
                var message = msg.split('!')[0];
                var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-price-format").removeAttr('disabled');
                    $("#button-price-format").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! No setting selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been updated.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-price-format").removeAttr('disabled');
                    $("#button-price-format").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update price format",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-price-format").removeAttr('disabled');
                    $("#button-price-format").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update price format",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            price_format.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    });
</script>