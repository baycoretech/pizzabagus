<div id="crop-avatar" class="panel-body">
    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form" action="<?php echo MADMINURL; ?>crop-logo.php" enctype="multipart/form-data" method="post">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">Change Logo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <label for="avatarInput">Local upload</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>
                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
                            <div class="row avatar-btns m-t-20">
                                <div class="col-md-9">
                                    <div class="btn-group">
                                        <button class="btn btn-success" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                                        <button class="btn btn-success" data-method="rotate" data-option="-15" type="button">-15deg</button>
                                        <button class="btn btn-success" data-method="rotate" data-option="-30" type="button">-30deg</button>
                                        <button class="btn btn-success" data-method="rotate" data-option="-45" type="button">-45deg</button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-success" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                                        <button class="btn btn-success" data-method="rotate" data-option="15" type="button">15deg</button>
                                        <button class="btn btn-success" data-method="rotate" data-option="30" type="button">30deg</button>
                                        <button class="btn btn-success" data-method="rotate" data-option="45" type="button">45deg</button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success btn-block avatar-save" type="submit">Done</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                    </div> -->
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
    <div class="form-group">
        <div class="avatar-view" title="Change Logo">
            <img id="gambarAvatar" src="<?php if($action == 'add') { echo MADMINURL."assets/img/no-pic-items.png"; } elseif($action == 'edit') { if($function_edit_logo->cr_settingValue == "") echo MADMINURL."assets/img/no-pic-items.png"; else echo MURL.'cr-editor/_thumbs/Images/'.$function_edit_logo->cr_settingValue; } else { echo ""; } ?>" alt="Logo">
        </div>
    </div>
    <form id="<?php if($action == "add") echo "form-add-logo"; elseif($action == "edit") echo "form-edit-logo" ?>" data-parsley-validate action="" method="POST">
        <input id="avatarForm" type="hidden" name="photo" value="">
</div>
<div class="panel-footer text-center">
    <button id="<?php if($action == 'add') echo "button-add-logo"; elseif($action == 'edit') echo "button-edit-logo" ?>" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
    <button type="button" class="btn btn-default button-cancel m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => 'logo')) ?>'">Cancel</button>
  </form>
</div>