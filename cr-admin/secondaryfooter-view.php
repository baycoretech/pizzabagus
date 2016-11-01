<?php
    $o_getSFooter = new sfooter($pdo);
    $v_getSFooter = $o_getSFooter->viewSFooter();
    $exSFooter    = explode(',', $v_getSFooter->cr_settingValue);
    $firstColumn  = $exSFooter[0];
    $secondColumn = $exSFooter[1];
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
                            <h4 class="panel-title">View</h4>
                        </div>
                        <div class="panel-body">
                        	<?php
                        		if($v_getSFooter->cr_settingValue=='' || $v_getSFooter->cr_settingValue==NULL) {
		                    ?>
		                        <div class="alert alert-info fade in m-b-15">
									<strong>Empty!</strong>
									No secondary footer data found found.
									<span class="close" data-dismiss="alert">×</span>
								</div>
		                    <?php
		                        }
		                        else {
		                    ?>
                                <dl class="dl-horizontal m-t-10">
                                    <dt>Left Column</dt>
                                        <dd>
                                            <?php
                                                if($firstColumn=="NULL" || $firstColumn=="")
                                                    echo "Empty";
                                                else
                                                    echo $firstColumn; 
                                             ?>
                                        </dd>
                                    <hr>
                                    <dt>Right Column</dt>
                                        <dd>
                                            <?php
                                                if($secondColumn=="NULL" || $secondColumn=="")
                                                    echo "Empty";
                                                else
                                                    echo $secondColumn; 
                                             ?>
                                        </dd>
                                </dl>
                        	
	                        <?php
	                        	}
	                        ?>
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
                            <h4 class="panel-title">Action</h4>
                        </div>
                        <div class="panel-body">
                            <p class="">
                                <button class="btn btn-lg btn-success btn-block" data-target="#edit-dialog" data-toggle="modal" data-settingid="<?php echo $v_getSFooter->cr_settingID ?>" data-firstcolumn='<?php if($v_getSFooter->cr_settingValue=='' || $v_getSFooter->cr_settingValue==NULL || $firstColumn=='NULL') echo ""; else echo $firstColumn ?>' data-secondcolumn='<?php if($v_getSFooter->cr_settingValue=='' || $v_getSFooter->cr_settingValue==NULL || $secondColumn=='NULL') echo ""; else echo $secondColumn ?>'>
                                    <i class="fa fa-pencil-square-o fa-2x pull-left"></i>
                                    <span class="f-w-700">Edit Footer</span><br>
                                    <small>Change the Footer</small>
                                </button>
                            </p>
                        </div>
                    </div>
                    <!-- end panel -->
                    <div class="panel-group" id="accordion">
                                <div class="panel panel-inverse overflow-hidden">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a aria-expanded="true" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                <i class="fa fa-plus-circle pull-right"></i> 
                                                Information
                                            </a>
                                        </h3>
                                    </div>
                                    <div style="" aria-expanded="true" id="collapseOne" class="panel-collapse collapse in">
                                        <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                                            <p>
                                                Secondary footer split into two columns, <strong>Left Column</strong> and <strong>Right Column</strong>. 
                                                Secondary footer usually contains copyright of a website.
                                            </p>
                                            <ul class="fa-ul">
                                                <li><i class="fa-li fa fa-dot-circle-o"></i><strong>Left Column</strong> - 
                                                Content that will appear in the left column</li>
                                                <li><i class="fa-li fa fa-dot-circle-o"></i><strong>Right Column</strong> - Content that will appear in the right column</li>
                                            </ul>
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
                                                There are one button below, <strong class="text-success">Edit Footer</strong>. Click <strong class="text-success">Edit Footer</strong> to edit existing footer data.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    
                </div>
</div>

<!-- #edit-dialog -->
<div class="modal fade" id="edit-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Edit Secondary Footer</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                    <p>
                       You can use HTML tag in both column. Use double quote for HTML tag.        
                    </p>
                </div>
                <?php
                        if (isset ($_POST['savefooter'])) {
                                //Success and Error handle
                                $sc              = sha1("addsuccess");
                                $er              = sha1("adderror");
                                $firstcolumn     = $_POST['firstcolumn'];
                                $secondcolumn    = $_POST['secondcolumn'];
                                $settingIDh      = $_POST['settingIDh'];
                                $adminLoginID    = $_POST['adminLoginID'];
                                if(empty($firstcolumn))
                                    $arr = array('NULL',$secondcolumn);
                                elseif(empty($secondcolumn)) 
                                    $arr = array($firstcolumn,'NULL');
                                elseif(empty($secondcolumn) && empty($firstcolumn)) 
                                    $arr = array('NULL','NULL');
                                else
                                    $arr = array($firstcolumn,$secondcolumn);

                                $value   = implode(",", $arr);

                            if(empty($adminLoginID)){
                                       header("Location: $madinurl/secondary-footer/");             
                            }
                            else {
                                    $v_getUpdateSFooter = $o_getSFooter->updateSFooter($value, $adminLoginID, $settingIDh);
                                    header("Location: $madinurl/secondary-footer/"); 
                            } 
                        }
                ?>
                <form data-parsley-validate action="" method="POST">
                        <input type="hidden" name="settingIDh" value="" id="settingid">
                        <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Left Column</label>
                            <input id="firstcolumn" class="form-control" placeholder="Left Column" type="text" name="firstcolumn" value="" data-parsley-minlength="2" data-parsley-maxlength="700">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Right Column</label>
                            <input id="secondcolumn" class="form-control" placeholder="Right Column" type="text" name="secondcolumn" value="" data-parsley-minlength="2" data-parsley-maxlength="700">
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="savefooter">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#edit-dialog').on('show.bs.modal', function(e) {
            $(this).find('#firstcolumn').attr('value', $(e.relatedTarget).data('firstcolumn'));
            $(this).find('#secondcolumn').attr('value', $(e.relatedTarget).data('secondcolumn'));
            $(this).find('#settingid').attr('value', $(e.relatedTarget).data('settingid'));
        });
    });
</script>