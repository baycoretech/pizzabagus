<?php
    $function_view_administrator = $class_administrator->view_administrator();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">User List</h4>
            </div>
            <div class="panel-toolbar">
	            <button class="btn btn-success" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => 'add')) ?>'"><i class="fa fa-user-plus"></i> Add User</button>
	            <button class="btn btn-info" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => 'profile')) ?>'"><i class="fa fa-user"></i> Profile</button>
            </div>
            <?php
        		if($function_view_administrator == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
				<strong>Empty!</strong>
				No user data found.
				<span class="close" data-dismiss="alert">×</span>
			</div>
            <?php
                }
                else {
            ?>
            <div class="panel-body">
            	<div class="table-responsive">
                    <table id="data-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="">Display</th>
                                <th class="">Username</th>
                                <th class="">Email</th>
                                <th class="">User Level</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            foreach ($function_view_administrator as $user) {
                            	$display_name = ucwords($user->cr_adminDisplayName);
                        ?>
                        	<tr>
                        		<td class="text-center">
                        			<img <?php if($user->cr_adminPhoto == 'assets/img/no-pic.png') echo 'class="rounded-corner no-admin-photo"'; else echo 'class="avatar-photo"' ?> <?php if($user->cr_adminPhoto != 'assets/img/no-pic.png') { ?> src="<?php if($user->cr_adminPhoto == '') echo MADMINURL."assets/img/no-pic.png"; else echo MADMINURL.$user->cr_adminPhoto ?>" <?php } else { ?> data-name="<?php echo ucwords($display_name); ?>" data-font-size="36" data-width="50" data-height="50" <?php } ?> alt="<?php echo ucwords($display_name); ?>" />

                        			<p class="text-center m-t-5 add-caps"><?php echo $display_name ?></p>
                        		</td>
                        		<td class="add-caps"><?php echo $user->cr_adminUsername ?></td>
                        		<td>
                        			<?php 
                        				echo "<a href='mailto:$user->cr_adminEmail'>".$user->cr_adminEmail."</a>" 
                        			?>
                        		</td>
                        		<td class="add-caps">
                        			<?php
                        				if($user->cr_adminLevel==1)
                        			 		echo "Administrator";
                        			 	elseif($user->cr_adminLevel==2)
                        			 		echo "Editor";
                        			 	elseif($user->cr_adminLevel==3)
                        			 		echo "Author";
                        			 	else
                        			 		echo "";
                        			 ?>
                        		</td>
                        		<td class="text-center">
                        			<?php
                        				if($admin_level == 1) {
                        			?>
                        			<button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="tooltip" data-placement="bottom" title="Edit <?php if($admin_id_session == $user->cr_adminID) echo 'Your'; else echo $display_name."'s" ?>  Profile" onclick="location.href='<?php if($admin_id_session == $user->cr_adminID) echo $router->generate('admin-dashboard-id', array('section' => 'profile', 'action' => 'edit', 'id' => $user->cr_adminID)); else echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => 'edit', 'id' => $user->cr_adminID)) ?>'"><i class="fa fa-pencil"></i></button>
                        			<?php
                        					if($user->cr_adminID == $admin_id_session && $user->cr_adminPassword == $admin_pass_session) {
                        						echo '';
                        					}
                        					else {
                        			?>
                        			<button type="button" class="btn btn-danger btn-icon btn-circle" title="Delete <?php echo $display_name ?>'s" data-target="#modal-delete-user" data-toggle="modal" data-dn="<?php echo $display_name; ?>" data-delete="<?php echo $user->cr_adminID; ?>"><i class="fa fa-times"></i></button>
                        			<?php
                        					}
                        				}
                        				else {
                        					echo '';
                        				}
                        			?>
                        		</td>
                        	</tr>
                        <?php
                        		$i++;
                        	}
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            	}
            ?>
        </div>
    </div>
</div>

<?php
    if($admin_level == 1) {
?>
<div class="modal fade" id="modal-delete-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="dn"></span>?</p>
                <form id="form-delete-user" action="" method="post">
                    <input type="hidden" name="user_id" value="" id="delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-delete-user" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<link href="<?php echo MADMINURL ?>assets/plugins/DataTables/css/data-table.css" type="text/css" rel="stylesheet" />
<script>
	$(document).ready(function() {
        $("#data-table").DataTable({dom:'C<"clear">lfrtip'});

		$('#modal-delete-user').on('show.bs.modal', function(e) {
            $(this).find('input[name=user_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });

        var delete_user;
        $("#form-delete-user").submit(function(event){
            if (delete_user) {
                delete_user.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var user_name = $("#modal-delete-user").find("#dn").html();
            var serializedData = $form.serialize();
            delete_user = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/user-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-user").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-user").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_user.done(function (msg){
                if(msg == 'user-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-user").removeAttr('disabled');
                    $("#button-delete-user").html('Delete');
                    $.gritter.add({
                        title:"Failed! Quote is required",
                        text:"Can't delete user from "+quote_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:user_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-user').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-user").removeAttr('disabled');
                    $("#button-delete-user").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+user_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-user").removeAttr('disabled');
                    $("#button-delete-user").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+user_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_user.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        }); 
	});
</script>