<?php
    $function_disk_size_admin    = $class_settings->disk_size_specific_folder('cr-admin');
    $function_disk_size_content  = $class_settings->disk_size_specific_folder('cr-content');
    $function_disk_size_editor   = $class_settings->disk_size_specific_folder('cr-editor');
    $function_disk_size_include  = $class_settings->disk_size_specific_folder('cr-include');
?>
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Directory Tree and Disk Usage Details</h4>
            </div>
            <div class="panel-body">
                <div class="col-md-8">
                    <div class="height-sm" data-scrollbar="true">
                        <div id="jstree-default">
                            <?php
                                read_list_files($_SERVER['DOCUMENT_ROOT'].ABSPATH);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 m-sm-t-15">
                    <dl class="dl-horizontal">
                        <dt><i class="fa fa-folder"></i> cr-admin/</dt>
                        <dd><?php echo $function_disk_size_admin ?></dd>

                        <dt><i class="fa fa-folder"></i> cr-content/</dt>
                        <dd><?php echo $function_disk_size_content ?></dd>

                        <dt><i class="fa fa-folder"></i> cr-editor/</dt>
                        <dd><?php echo $function_disk_size_editor ?></dd>

                        <dt><i class="fa fa-folder"></i> cr-include/</dt>
                        <dd><?php echo $function_disk_size_include ?></dd>
                        <hr>

                        <dt>Total Disk Usage</dt>
                        <dd><?php echo $function_disk_size ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>