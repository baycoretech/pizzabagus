<?php
	if($function_view_history == false) {
?>
	<div class="alert alert-info fade in m-b-15">
		<strong>Empty!</strong>
		You have no history.
		<span class="close" data-dismiss="alert">×</span>
	</div>
<?php
	}
	else {
?>
<!-- begin timeline -->
<ul class="timeline">
			<?php
				$numbericon = 1;
		    	foreach ($function_view_history as $data) {
		    		$history_data = $data->cr_historyDateTime;
                	$history_date = date($function_date_format->cr_settingValue, strtotime($history_data));
                	$history_time = date($functiontime_format->cr_settingValue, strtotime($history_data));

                	$first_date   = new DateTime($history_date);
					$last_date    = new DateTime();

					$date_diff = $last_date->diff($first_date)->format("%a");

					$first_word   = strtok($data->cr_historyDetail, " ");
		    ?>
			    <li id="timeline-list">
			        <!-- begin timeline-time -->
			        <div class="timeline-time">
			            <span class="date"><?php if($date_diff == 0) echo "Today"; elseif($date_diff == 1) echo "Yesterday"; else echo $history_date; ?></span>
			            <span class="time"><?php echo $history_time; ?></span>
			        </div>
			        <!-- end timeline-time -->
			        <!-- begin timeline-icon -->
			        <div class="timeline-icon timeline-icon-<?php echo $numbericon ?> wow flipInX">
			            <a href="javascript:;" <?php if($admin_level=="1") { ?> data-target="#modal-delete-history" data-toggle="modal" data-delete="<?php echo $data->cr_historyID; ?>" <?php } ?>><i id="history-icon-<?php echo $numbericon ?>" class="fa fa-history"></i></a>
			        </div>
			        <!-- end timeline-icon -->
			        <!-- begin timeline-body -->
			        <div class="timeline-body">
			            <div class="timeline-header">
			                <span class="userimage">
			                	<img <?php if($data->cr_adminPhoto == 'assets/img/no-pic.png' || $data->cr_adminPhoto == '') echo 'class="no-admin-photo"' ?> <?php if($data->cr_adminPhoto != 'assets/img/no-pic.png' || $data->cr_adminPhoto == '') { ?> src="<?php if($data->cr_adminPhoto == '') echo MADMINURL."assets/img/no-pic.png"; else echo MADMINURL.$data->cr_adminPhoto ?>" <?php } else { ?> data-name="<?php echo ucwords($data->cr_adminDisplayName); ?>" data-font-size="28" data-width="34" data-height="34" <?php } ?> alt="<?php echo ucwords($data->cr_adminDisplayName); ?>" />
			                </span>
			                <span class="username"><a href="javascript:;"><?php echo ucwords($data->cr_adminDisplayName) ?></a> <small></small></span>
			                <span class="pull-right text-muted"><?php if($data->cr_adminLevel == "1") echo "Administrator"; elseif($data->cr_adminLevel == "2") echo "Editor"; elseif($data->cr_adminLevel == "3") echo "Author"; ?></span>
			            </div>
			            <div class="timeline-content">
                            <p>
                                <?php 
                                	if($data->cr_adminID == $admin_id_session) {
                                		echo "You ".$data->cr_historyDetail;
                                	}
                                	else  {
                                		if(substr($first_word, -1)=="s") {
                                			$modifiedverb = $first_word."es";
                                			$verb = str_replace($first_word,$modifiedverb,$data->cr_historyDetail);
                                			echo ucwords($data->cr_adminDisplayName)." ".$verb;
                                		}
                                		else {
                                			$modifiedverb = $first_word."s";
                                			$verb = str_replace($first_word,$modifiedverb,$data->cr_historyDetail);
                                			echo ucwords($data->cr_adminDisplayName)." ".$verb;
                                		}
                                	}
                                ?>
                            </p>
			            </div>
			        </div>
			        <!-- end timeline-body -->
			        <?php 
			        	if($admin_level=="1") {
			        ?>
			        <script type="text/javascript">
					    $(document).ready(function() {
							$('.timeline-icon-<?php echo $numbericon ?>').hover(
								function() {
					                $('#history-icon-<?php echo $numbericon ?>').removeClass('fa-history');
					                $('#history-icon-<?php echo $numbericon ?>').addClass('fa-trash');
					        	}, 
								function() {
					            	$('#history-icon-<?php echo $numbericon ?>').removeClass('fa-trash');
					                $('#history-icon-<?php echo $numbericon ?>').addClass('fa-history');
					            });
					        });
					</script>
					<?php
						}
					?>
			    </li>
			    
			<?php
					$numbericon++;
				}
			?>
</ul>
<!-- end timeline -->

<!-- #delete-dialog -->
<div class="modal fade" id="modal-delete-history">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete current history?</p>
                <form id="form-delete-history" action="" method="post">
                    <input type="hidden" name="history_id" value="" id="delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-delete-history" type="submit" class="btn btn-danger">Delete</button>
                <button id="button-delete-all-history" type="button" class="btn btn-danger">Delete All</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$.gritter.add({
	        title:"Creatify Tips",
	        text:"Click the history icon to show history delete dialog.",
	        image:"<?php echo MADMINURL.'/assets/img/cr.png'; ?>",
	        sticky:false,
	        time:""
	    });

		$('#modal-delete-history').on('show.bs.modal', function(e) {
            $(this).find('#delete').attr('value', $(e.relatedTarget).data('delete'));
        });

        var delete_current_history;   
	    // Bind to the submit event of our form
	    $("#form-delete-history").submit(function(event){
	        // Abort any pending request
	        if (delete_current_history) {
	            delete_current_history.abort();
	        }
	        // setup some local variables
	        var $form = $(this);
	        // Serialize the data in the form
	        var serializedData = $form.serialize();

	        delete_current_history = $.ajax({
	            url: "<?php echo MADMINURL ?>ajax/history-delete.php",
	            type: "post",
	            beforeSend: function(){ $("#button-delete-history").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-history").attr('disabled','disabled');},
	            data: serializedData
	        });
	        // Callback handler that will be called on success
	        delete_current_history.done(function (data){
	            if(data == 'history-empty') {
	            	$("#button-delete-history").removeAttr('disabled');
                    $("#button-delete-history").html('Delete');
                    $.gritter.add({
                        title:"Failed! History is required",
                        text:"Can't delete current history. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(data == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:"History has been deleted.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
	            else if(data == 'failed') {
	            	$("#button-delete-history").removeAttr('disabled');
                    $("#button-delete-history").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete current history",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
	            	$("#button-delete-history").removeAttr('disabled');
                    $("#button-delete-history").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete current history",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                
	        });
	                
	        // Prevent default posting of form
	        event.preventDefault();
	    });

		$('#button-delete-all-history').click(function() {
			var adminid    = $(this).attr("data-adminid");
		    var dataString = 'adminLoginID='+adminid;
			$.ajax({
	            type: "POST",
	            url:  "<?php echo MADMINURL ?>ajax/history-delete-all.php",
	            data: dataString,
	            cache: false,
	            	beforeSend: function(){ $("#button-delete-all-history").html('<i class="fa fa-spinner fa-pulse"></i> Deleting all history...');$("#button-delete-all-history").attr('disabled','disabled');},
	            	success: function(data){
		            	if(data == "true") {
		            		$.gritter.add({
		                        title:"Success!",
		                        text:"All history has been deleted.",
		                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
		                        sticky:false,
		                        time:""
		                    });
		                    setTimeout(function() {
		                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
		                    }, 2000);
		            	}
		            	else if(data == 'failed') {
		            		("#button-delete-all-history").html('Delete All');
		                    $.gritter.add({
		                        title:"Failed! Can't delete all history",
		                        text:"Please try again.",
		                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
		                        sticky:false,
		                        time:""
		                    });
		            	}
		            	else {
			            	$("#button-delete-all-history").removeAttr('disabled');
		                    $("#button-delete-all-history").html('Delete All');
		                    $.gritter.add({
		                        title:"Error! Can't delete all history",
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
	});	
</script>
<?php
	}
?>