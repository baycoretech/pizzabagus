<?php
    $o_getPLjumbotron  = new jumbotron($pdo);
    $v_getPLjumbotron  = $o_getPLjumbotron->viewPlainjumbotron();
    //disabled feature
    $v_getGF     = $o_getGF->folderName();
    if($v_getGF=="0") {
        $targetFolder = $_SERVER['DOCUMENT_ROOT']."/cr-content/themes/";
    }
    else {
        $targetFolder = $_SERVER['DOCUMENT_ROOT']."/".$v_getGF."/cr-content/themes/";
    }
    $v_getThemes   = $o_getSettings->viewSettingsUsedTheme();
    $v_getUThemes  = $v_getThemes->cr_settingValue;
    $getdetailtxt  = file($targetFolder.$v_getUThemes.'/detail.txt');
    $themeOption   = $getdetailtxt[4]; 
    $tOptarr       = explode(',', $themeOption);
?>
<div class="row">
    <?php
        if(in_array("jumbotron", $tOptarr)===true) {
    ?>
    <div class="col-md-12">
        <div class="note note-info">
            <h4>Jumbotron is Not Available</h4>
            <p>Your theme is not support jumbotron. However, other themes that support this feature could remain use it.</p>
        </div>
    </div>
    <?php
        }
    ?>
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
                        <?php
                            if($v_getPLjumbotron=="0") {
                        ?>
                        <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                            <p>
                                <strong>Empty!</strong>
                                No plain jumbotron data found.
                            </p>
                        </div>   
                        <?php
                            }
                            else {
                        ?> 
                        <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="140" class="">Caption</th>
                                                <th class="">Description</th>
                                                <th class="">B.Text</th>
                                                <th class="">B.Link</th>
                                                <th width="100" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class=""><?php echo $v_getPLjumbotron->cr_jumbotronCaption ?></td>
                                                <td class=""><?php echo $v_getPLjumbotron->cr_jumbotronDesc ?></td>
                                                <td class="add-caps">
                                                    <?php 
                                                        if(empty($v_getPLjumbotron->cr_jumbotronButtontext) || $v_getPLjumbotron->cr_jumbotronButtontext=="")
                                                            echo "None";
                                                        else
                                                            echo $v_getPLjumbotron->cr_jumbotronButtontext 
                                                    ?>
                                                </td>
                                                <td class="">
                                                    <?php
                                                        if(empty($v_getPLjumbotron->cr_jumbotronButtonLink) || $v_getPLjumbotron->cr_jumbotronButtonLink=="") {
                                                            echo "None";
                                                        }
                                                        else {
                                                            $bglink = strip_tags($v_getPLjumbotron->cr_jumbotronButtonLink);
                                                            $subbglink = strlen($bglink);
                                                            if($subbglink<=20) {
                                                                echo '<a href="'.$v_getPLjumbotron->cr_jumbotronButtonLink.'">'.$bglink.'</a>';
                                                            }
                                                            else {
                                                                echo '<a href="'.$v_getPLjumbotron->cr_jumbotronButtonLink.'">'.substr($bglink,0,20).'...</a>'; 
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#delete-dialog" data-toggle="modal" data-dn="Plain Jumbotron"><i class="fa fa-times"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        <?php
                            }
                        ?>
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
                                <?php 
                                    if($v_getPLjumbotron==0) {
                                ?>
                                <button class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo MADMINURL; ?>/plain-jumbotron/edit'">
                                    <i class="fa fa-align-left fa-2x pull-left"></i>
                                    <span class="f-w-700">Add Jumbotron</span><br>
                                    <small>Add Plain Jumbotron</small>
                                </button>
                                <?php
                                    }
                                    else {
                                ?>
                                <button type="button" class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo MADMINURL; ?>/plain-jumbotron/edit'">
                                    <i class="fa fa-pencil fa-2x pull-left"></i>
                                    <span class="f-w-700">Edit Jumbotron</span><br>
                                    <small>Edit Plain Jumbotron</small>
                                </button>
                                <?php
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
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
                                                Jumbotron is a lightweight, flexible component that can optionally extend the entire viewport to showcase key content on your site. 
                                            </p>
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
                                                There are one button above, <strong class="text-success">Add Jumbotron</strong>. Click <strong class="text-success">Add Jumbotron</strong> to add new plain jumbotron. If it already exists, the button will change to <strong class="text-success">Edit Jumbotron</strong>, click to edit existing plain jumbotron.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    
                    <!-- end panel -->
                </div>
</div>

<!-- #delete-dialog -->
<div class="modal fade" id="delete-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="dn"></span>?</p>
                <?php
                    if (isset ($_POST['hapus'])) {
                        //Delete Handler
                        $deleteit         = sha1("deleteit");
                        $adminLoginID     = $_POST['adminLoginID'];
                        $v_delPLjumbotron = $o_getPLjumbotron->deletePlainjumbotron($adminLoginID);
                            header("Location: $madinurl/plain-jumbotron/"); 
                    } 
                ?>
                <form action="" method="post">
                    <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" name="hapus">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#delete-dialog').on('show.bs.modal', function(e) {
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });
    });
</script>