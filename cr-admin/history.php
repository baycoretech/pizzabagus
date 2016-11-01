<?php
	if($v_getHistory==0) {
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
		    	foreach ($v_getHistory as $data) {
		    		$historyData = $data->cr_historyDateTime;
                	$historyDate = date($v_getDateFormat->cr_settingValue, strtotime($historyData));
                	$historyTime = date($v_getTimeFormat->cr_settingValue, strtotime($historyData));

                	$firstDate   = new DateTime($historyDate);
					$lastDate    = new DateTime();

					$bedatanggal = $lastDate->diff($firstDate)->format("%a");

					$firstword   = strtok($data->cr_historyDetail, " ");
		    ?>
			    <li id="timeline-list">
			        <!-- begin timeline-time -->
			        <div class="timeline-time wow fadeInLeft" data-wow-duration="1s">
			            <span class="date"><?php if($bedatanggal==0) echo "Today"; elseif($bedatanggal==1) echo "Yesterday"; else echo $historyDate; ?></span>
			            <span class="time"><?php echo $historyTime; ?></span>
			        </div>
			        <!-- end timeline-time -->
			        <!-- begin timeline-icon -->
			        <div class="timeline-icon timeline-icon-<?php echo $numbericon ?> wow flipInX">
			            <a href="javascript:;" <?php if($cradminLevel=="1") { ?> data-target="#delete-dialog" data-toggle="modal" data-hapus="<?php echo $data->cr_historyID; ?>" <?php } ?>><i id="history-icon-<?php echo $numbericon ?>" class="fa fa-history"></i></a>
			        </div>
			        <!-- end timeline-icon -->
			        <!-- begin timeline-body -->
			        <div class="timeline-body wow fadeInUp" data-wow-duration="2s">
			            <div class="timeline-header">
			                <span class="userimage"><img src="<?php if($data->cr_adminPhoto=='') echo MADMINURL."/assets/img/no-pic.png"; else echo MADMINURL.$data->cr_adminPhoto; ?>" alt="" /></span>
			                <span class="username"><a href="javascript:;"><?php echo ucwords($data->cr_adminDisplayName) ?></a> <small></small></span>
			                <span class="pull-right text-muted"><?php if($data->cr_adminLevel=="1") echo "Administrator"; elseif($data->cr_adminLevel=="2") echo "Editor"; if($data->cr_adminLevel=="3") echo "Author"; ?></span>
			            </div>
			            <div class="timeline-content">
                            <p>
                                <?php 
                                	if($data->cr_adminID==$cradminID_session) {
                                		echo "You ".$data->cr_historyDetail;
                                	}
                                	else  {
                                		if(substr($firstword, -1)=="s") {
                                			$modifiedverb = $firstword."es";
                                			$verb = str_replace($firstword,$modifiedverb,$data->cr_historyDetail);
                                			echo ucwords($data->cr_adminDisplayName)." ".$verb;
                                		}
                                		else {
                                			$modifiedverb = $firstword."s";
                                			$verb = str_replace($firstword,$modifiedverb,$data->cr_historyDetail);
                                			echo ucwords($data->cr_adminDisplayName)." ".$verb;
                                		}
                                	}
                                ?>
                            </p>
			            </div>
			        </div>
			        <!-- end timeline-body -->
			        <?php 
			        	if($cradminLevel=="1") {
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
<div class="modal fade" id="delete-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete current history?</p>
                <form id="delete-form" action="" method="post">
                    <input type="hidden" name="historyID" value="" id="delete">
                    <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="submit-delete" type="submit" class="btn btn-danger" name="hapus">Delete</button>
                <button type="button" class="btn btn-danger delete-all-history" data-adminid="<?php echo $cradminID_session ?>">Delete All</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function() {
		$.gritter.add({
	        title:"Creatify Tips",
	        text:"Click the history icon to show history delete dialog.",
	        image:"<?php echo MADMINURL.'/assets/img/cr.png'; ?>",
	        sticky:false,
	        time:""
	    });
		$('#delete-dialog').on('show.bs.modal', function(e) {
            $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
        });
        var requestdelete;   
	    // Bind to the submit event of our form
	    $("#delete-form").submit(function(event){
	        // Abort any pending request
	        if (requestdelete) {
	            requestdelete.abort();
	        }
	        // setup some local variables
	        var $form = $(this);
	        // Serialize the data in the form
	        var serializedData = $form.serialize();

	        requestdelete = $.ajax({
	            url: "<?php echo MADMINURL ?>/history-delete.php",
	            type: "post",
	            beforeSend: function(){ $("#submit-delete").html('<i class="fa fa-spinner fa-pulse"></i> Deleting history...');},
	            data: serializedData
	        });
	        // Callback handler that will be called on success
	        requestdelete.done(function (msg){
	            if(msg=='failed') {
                    $("#submit-delete").html('Delete');
                    $.gritter.add({
                        title:"Failed!",
                        text:"Can't delete current history. Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $.gritter.add({
                        title:"Success!",
                        text:"History has been deleted.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo MADMINURL ?>/history";
                    }, 2000);
                }
	        });
	                
	        // Prevent default posting of form
	        event.preventDefault();
	    });
		$('.delete-all-history').click(function() {
				var adminid    = $(".delete-all-history").attr("data-adminid");
			    var dataString = 'adminLoginID='+adminid;
				$.ajax({
		            type: "POST",
		            url:  "<?php echo MADMINURL ?>/history-delete-all.php",
		            data: dataString,
		            cache: false,
		            	beforeSend: function(){ $(".delete-all-history").html('<i class="fa fa-spinner fa-pulse"></i> Deleting all history...');},
		            	success: function(data){
			            	if(data!="failed") {
			            		$.gritter.add({
			                        title:"Success!",
			                        text:"All history has been deleted.",
			                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
			                        sticky:false,
			                        time:""
			                    });
			                    setTimeout(function() {
			                        window.location="<?php echo MADMINURL ?>/history";
			                    }, 2000);
			            	}
			            	else {
			            		(".delete-all-history").html('Delete All');
			                    $.gritter.add({
			                        title:"Failed!",
			                        text:"Can't delete all history. Please try again.",
			                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
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