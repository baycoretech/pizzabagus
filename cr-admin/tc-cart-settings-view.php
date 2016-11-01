<?php
    $o_get_settings = new settings($pdo);
    $v_get_settings_shipping_origin = $o_get_settings->view_settings_shipping_origin();
    $v_get_settings_featured  = $o_get_settings->view_settings_featured_product_system();
    $v_get_settings_topseller = $o_get_settings->view_settings_topseller_product_system();
?>
<div class="row">
				<!-- begin col-9 -->
			    <div class="col-md-9">
			        <!-- begin panel -->
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
                        		<h4>Shipping Setting</h4>
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
		                                		<td class="add-caps">Shipping Origin</td>
		                                		<td class="add-caps">
		                                			<?php
		                                				if($v_get_settings_shipping_origin->cr_settingValue=="")
		                                			 		echo "None";
		                                			 	else {
		                                			 		$v_get_shipping_origin_city = explode(',', $v_get_settings_shipping_origin->cr_settingValue);
		                                			 		echo $v_get_shipping_origin_city[2];
		                                			 	}
		                                			 ?>
		                                		</td>
		                                		<td class="text-center">
		                                			<button type="button" class="btn btn-success btn-icon btn-circle wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s" data-toggle="modal" data-target="#editsettingModal" data-dn="Shipping Origin" data-settingid="<?php echo $v_get_settings_shipping_origin->cr_settingID; ?>" data-settingvalue="<?php echo $v_get_settings_shipping_origin->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
		                                		</td>
		                                	</tr>
		                                </tbody>
		                            </table>
		                        </div>
		                        <h4>Product System</h4>
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
		                                		<td class="add-caps">Featured Product System</td>
		                                		<td class="add-caps">
		                                			<?php
		                                				if($v_get_settings_featured->cr_settingValue=="")
		                                			 		echo "None";
		                                			 	else {
		                                			 		if($v_get_settings_featured->cr_settingValue == 'automatic')
		                                			 			echo 'Automatic by system';
		                                			 		elseif($v_get_settings_featured->cr_settingValue == 'manual')
		                                			 			echo 'Manual';
		                                			 	}
		                                			 ?>
		                                		</td>
		                                		<td class="text-center">
		                                			<button type="button" class="btn btn-success btn-icon btn-circle wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s" data-toggle="modal" data-target="#edit-setting-featured-modal" data-dn="Featured Product System" data-settingid="<?php echo $v_get_settings_featured->cr_settingID; ?>" data-settingvalue="<?php echo $v_get_settings_featured->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
		                                		</td>
		                                	</tr>
		                                	<tr>
		                                		<td class="add-caps">Top Selling Product System</td>
		                                		<td class="add-caps">
		                                			<?php
		                                				if($v_get_settings_topseller->cr_settingValue=="")
		                                			 		echo "None";
		                                			 	else {
		                                			 		if($v_get_settings_topseller->cr_settingValue == 'automatic')
		                                			 			echo 'Automatic by system';
		                                			 		elseif($v_get_settings_topseller->cr_settingValue == 'manual')
		                                			 			echo 'Manual';
		                                			 	}
		                                			 ?>
		                                		</td>
		                                		<td class="text-center">
		                                			<button type="button" class="btn btn-success btn-icon btn-circle wow flipInX" data-wow-duration="1s" data-wow-delay="0.5s" data-toggle="modal" data-target="#edit-setting-topseller-modal" data-dn="Top Selling Product System" data-settingid="<?php echo $v_get_settings_topseller->cr_settingID; ?>" data-settingvalue="<?php echo $v_get_settings_topseller->cr_settingValue; ?>"><i class="fa fa-pencil"></i></button>
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
			        <div class="panel-group" id="accordion">
						<div class="panel panel-inverse overflow-hidden">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a aria-expanded="true" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseSettingValue">
									    <i class="fa fa-plus-circle pull-right"></i> 
										Shipping Origin
									</a>
								</h3>
							</div>
							<div style="" aria-expanded="true" id="collapseSettingValue" class="panel-collapse collapse in">
								<div class="panel-body">
									<p>Choose your shipping origin, so user get the correct shipping cost. Shipping cost API is using <a href="http://rajaongkir.com">Raja Ongkir</a></p>
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

<div class="modal fade" id="editsettingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="dng" class="modal-title text-white"></h4>
      </div>
        <div class="modal-body">
                    <?php
                        if (isset ($_POST['savesetting'])) {
                                $value          = $_POST['value'];
                                $setting_name   = $_POST['setting_name'];
                                $setting_idh    = $_POST['setting_idh'];
                                $admin_login_id = $_POST['admin_login_id'];

                            if(empty($setting_idh) || empty($admin_login_id)){
                                       header("Location: $madinurl/tc-cart-settings");             
                            }
                            else {
                                $v_getUpdateSettings = $o_getSettings->updateSettings($value, $setting_name, $admin_login_id, $setting_idh);
                                header("Location: $madinurl/tc-cart-settings"); 
                                    
                            } 
                        }
                    ?>
                    <form data-parsley-validate action="" method="POST">
                        <input type="hidden" name="setting_idh" value="" id="settingidg">
                        <input type="hidden" name="setting_name" value="" id="dng2">
                        <input type="hidden" name="admin_login_id" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Value</label>
                            <?php
								$v_get_rajaongkir_city = rajaongkir_city();
								$data = json_decode($v_get_rajaongkir_city, true);
	 							$city =  json_encode($data['rajaongkir']['results']);
								$get_city = json_decode($city);
							?>
                            <select class="form-control" name="value" required>
                            	<option value="">Select Origin</option>
                            	<?php
									foreach($get_city as $get_cities) {
								?>
								<option value="<?php echo $get_cities->city_id.",".$get_cities->province_id.",".$get_cities->city_name ?>"><?php echo $get_cities->city_name ?></option>
								<?php } ?>
                            </select>
                        </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="savesetting">Save</button>
                </form>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit-setting-featured-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="featured-product-system-title" class="modal-title text-white"></h4>
      </div>
        <div class="modal-body">
                    <?php
                        if (isset ($_POST['savesetting'])) {
                                $value          = $_POST['value'];
                                $setting_name   = $_POST['setting_name'];
                                $setting_idh    = $_POST['setting_idh'];
                                $admin_login_id = $_POST['admin_login_id'];

                            if(empty($setting_idh) || empty($admin_login_id)){
                                       header("Location: $madinurl/tc-cart-settings");             
                            }
                            else {
                                $v_getUpdateSettings = $o_getSettings->updateSettings($value, $setting_name, $admin_login_id, $setting_idh);
                                header("Location: $madinurl/tc-cart-settings"); 
                                    
                            } 
                        }
                    ?>
                    <form data-parsley-validate action="" method="POST">
                        <input type="hidden" name="setting_idh" value="" id="featured-product-system-id">
                        <input type="hidden" name="setting_name" value="" id="featured-product-system-name">
                        <input type="hidden" name="admin_login_id" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Select Featured Product System</label>
                            <select id="featured-product-system-value" class="form-control" name="value" required>
								<option value="automatic">Automatic by system</option>
								<option value="manual">Manual</option>
                            </select>
                        </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="savesetting">Save</button>
                </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-setting-topseller-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="topseller-product-system-title" class="modal-title text-white"></h4>
      </div>
        <div class="modal-body">
                    <?php
                        if (isset ($_POST['savesetting'])) {
                                $value          = $_POST['value'];
                                $setting_name   = $_POST['setting_name'];
                                $setting_idh    = $_POST['setting_idh'];
                                $admin_login_id = $_POST['admin_login_id'];

                            if(empty($setting_idh) || empty($admin_login_id)){
                                       header("Location: $madinurl/tc-cart-settings");             
                            }
                            else {
                                $v_getUpdateSettings = $o_getSettings->updateSettings($value, $setting_name, $admin_login_id, $setting_idh);
                                header("Location: $madinurl/tc-cart-settings"); 
                            } 
                        }
                    ?>
                    <form data-parsley-validate action="" method="POST">
                        <input type="hidden" name="setting_idh" value="" id="topseller-product-system-id">
                        <input type="hidden" name="setting_name" value="" id="topseller-product-system-name">
                        <input type="hidden" name="admin_login_id" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Select Top Selling Product System</label>
                            <select id="topseller-product-system-value" class="form-control" name="value" required>
								<option value="automatic">Automatic by system</option>
								<option value="manual">Manual</option>
                            </select>
                        </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="savesetting">Save</button>
                </form>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
	    $('#editsettingModal').on('show.bs.modal', function(e) {
	        $(this).find('#settingidg').attr('value', $(e.relatedTarget).data('settingid'));
	        $(this).find('#settingvalueg').attr('value', $(e.relatedTarget).data('settingvalue'));
	        $(this).find('#dng').html($(e.relatedTarget).data('dn'));
	        $(this).find('#dng2').attr('value', $(e.relatedTarget).data('dn'));
	    });
	    $('#edit-setting-featured-modal').on('show.bs.modal', function(e) {
	        $(this).find('#featured-product-system-id').attr('value', $(e.relatedTarget).data('settingid'));
	        $(this).find('#featured-product-system-value').attr('value', $(e.relatedTarget).data('settingvalue'));
	        $(this).find('#featured-product-system-title').html($(e.relatedTarget).data('dn'));
	        $(this).find('#featured-product-system-name').attr('value', $(e.relatedTarget).data('dn'));
	    });
	    $('#edit-setting-topseller-modal').on('show.bs.modal', function(e) {
	        $(this).find('#topseller-product-system-id').attr('value', $(e.relatedTarget).data('settingid'));
	        $(this).find('#topseller-product-system-value').attr('value', $(e.relatedTarget).data('settingvalue'));
	        $(this).find('#topseller-product-system-title').html($(e.relatedTarget).data('dn'));
	        $(this).find('#topseller-product-system-name').attr('value', $(e.relatedTarget).data('dn'));
	    });
	});
</script>