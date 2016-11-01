<div id="crop-avatar" class="panel-body">
                    <!-- Cropping modal -->
                        <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <form class="avatar-form" action="<?php echo MADMINURL; ?>/crop-background.php" enctype="multipart/form-data" method="post">
                                <div class="modal-header">
                                  <button class="close" data-dismiss="modal" type="button">&times;</button>
                                  <h4 class="modal-title" id="avatar-modal-label">Change Image</h4>
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
                                          <button class="btn btn-primary" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees">Rotate Left</button>
                                          <button class="btn btn-primary" data-method="rotate" data-option="-15" type="button">-15deg</button>
                                          <button class="btn btn-primary" data-method="rotate" data-option="-30" type="button">-30deg</button>
                                          <button class="btn btn-primary" data-method="rotate" data-option="-45" type="button">-45deg</button>
                                        </div>
                                        <div class="btn-group">
                                          <button class="btn btn-primary" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees">Rotate Right</button>
                                          <button class="btn btn-primary" data-method="rotate" data-option="15" type="button">15deg</button>
                                          <button class="btn btn-primary" data-method="rotate" data-option="30" type="button">30deg</button>
                                          <button class="btn btn-primary" data-method="rotate" data-option="45" type="button">45deg</button>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <button class="btn btn-primary btn-block avatar-save" type="submit">Done</button>
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
                    <?php
                        $v_getBgrepeat        = $o_getSettings->viewSettingsBgrepeat();
                        $v_getBgposition      = $o_getSettings->viewSettingsBgposition();
                        $v_getBgattachment    = $o_getSettings->viewSettingsBgattachment();
                        $v_getBgsize          = $o_getSettings->viewSettingsBgsize();
                        $bgrepeatID           = $v_getBgrepeat->cr_settingID;
                        $bgpositionID         = $v_getBgposition->cr_settingID;
                        $bgattachmentID       = $v_getBgattachment->cr_settingID;
                        $bgsizeID             = $v_getBgsize->cr_settingID;
                        if (isset ($_POST['save'])) {
                                $photourl             = $_POST['photo'];
                                $photo                = str_replace(MADMINURL."/..","",$photourl);
                                $backgroundrepeat     = $_POST['backgroundrepeat'];
                                $backgroundposition   = $_POST['backgroundposition'];
                                $backgroundattachment = $_POST['backgroundattachment'];
                                $backgroundsize       = $_POST['backgroundsize'];
                                $adminLoginID         = $_POST['adminLoginID'];

                            if($photourl==MADMINURL."/assets/img/no-pic-items.png" || empty($backgroundrepeat) || empty($backgroundposition) || empty($backgroundattachment) || empty($backgroundsize) || empty($adminLoginID)){
                                       header("Location: $madinurl/themes");             
                            }
                            else {
                                    $v_getUpdateBg = $o_getSettings->updateBgtemplate($photo, $adminLoginID);
                                    $v_getUpdateBR = $o_getSettings->updateSettings($backgroundrepeat, "background repeat", $adminLoginID, $bgrepeatID);
                                    $v_getUpdateBP = $o_getSettings->updateSettings($backgroundposition, "background position", $adminLoginID, $bgpositionID);
                                    $v_getUpdateBA = $o_getSettings->updateSettings($backgroundattachment, "background attachment", $adminLoginID, $bgattachmentID);
                                    $v_getUpdateBS = $o_getSettings->updateSettings($backgroundsize, "background size", $adminLoginID, $bgsizeID);
                                    header("Location: $madinurl/themes");     
                            } 
                        }
                    ?>
                    <form data-parsley-validate action="" method="POST">
                        <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                        <input id="avatarForm" type="hidden" name="photo" value="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Background Repeat</label>
                                    <select class="form-control" name="backgroundrepeat" required>
                                        <option value="">Select Background Repeat</option>
                                        <option value="repeat" <?php if($v_getBgrepeat->cr_settingValue=="repeat") echo 'selected="selected"' ?>>Repeat</option>
                                        <option value="repeat-x" <?php if($v_getBgrepeat->cr_settingValue=="repeat-x") echo 'selected="selected"' ?>>Repeat-x</option>
                                        <option value="repeat-y" <?php if($v_getBgrepeat->cr_settingValue=="repeat-y") echo 'selected="selected"' ?>>Repeat-y</option>
                                        <option value="no-repeat" <?php if($v_getBgrepeat->cr_settingValue=="no-repeat") echo 'selected="selected"' ?>>No repeat</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Background Position</label>
                                    <select class="form-control" name="backgroundposition" required>
                                        <option value="">Select Background Position</option>
                                        <option value="left top" <?php if($v_getBgposition->cr_settingValue=="left top") echo 'selected="selected"' ?>>Left Top</option>
                                        <option value="left center" <?php if($v_getBgposition->cr_settingValue=="left center") echo 'selected="selected"' ?>>Left Center</option>
                                        <option value="left bottom" <?php if($v_getBgposition->cr_settingValue=="left bottom") echo 'selected="selected"' ?>>Left Bottom</option>
                                        <option value="top center" <?php if($v_getBgposition->cr_settingValue=="top center") echo 'selected="selected"' ?>>Top Center</option>
                                        <option value="center center" <?php if($v_getBgposition->cr_settingValue=="center center") echo 'selected="selected"' ?>>Center Center</option>
                                        <option value="bottom center" <?php if($v_getBgposition->cr_settingValue=="bottom center") echo 'selected="selected"' ?>>Bottom Center</option>
                                        <option value="right top" <?php if($v_getBgposition->cr_settingValue=="right top") echo 'selected="selected"' ?>>Right Top</option>
                                        <option value="right center" <?php if($v_getBgposition->cr_settingValue=="right center") echo 'selected="selected"' ?>>Right Center</option>
                                        <option value="right bottom" <?php if($v_getBgposition->cr_settingValue=="right bottom") echo 'selected="selected"' ?>>Right Bottom</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Background Attachment</label>
                                    <select class="form-control" name="backgroundattachment" required>
                                        <option value="">Select Background Attachment</option>
                                        <option value="scroll" <?php if($v_getBgattachment->cr_settingValue=="scroll") echo 'selected="selected"' ?>>Scroll</option>
                                        <option value="fixed" <?php if($v_getBgattachment->cr_settingValue=="fixed") echo 'selected="selected"' ?>>Fixed</option>
                                        <option value="none" <?php if($v_getBgattachment->cr_settingValue=="none") echo 'selected="selected"' ?>>None</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Background Size</label>
                                    <select class="form-control" name="backgroundsize" required>
                                        <option value="">Select Background Size</option>
                                        <option value="auto" <?php if($v_getBgsize->cr_settingValue=="auto") echo 'selected="selected"' ?>>Auto</option>
                                        <option value="cover" <?php if($v_getBgsize->cr_settingValue=="cover") echo 'selected="selected"' ?>>Cover</option>
                                        <option value="50%" <?php if($v_getBgsize->cr_settingValue=="50%") echo 'selected="selected"' ?>>50%</option>
                                        <option value="100%" <?php if($v_getBgsize->cr_settingValue=="100%") echo 'selected="selected"' ?>>100%</option>
                                        <option value="200%" <?php if($v_getBgsize->cr_settingValue=="200%") echo 'selected="selected"' ?>>200%</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="avatar-view m-t-30" title="Change Background Image">
                                        <img id="gambarAvatar" src="<?php if($v_getBg->cr_settingValue=="") echo MADMINURL."/assets/img/no-pic-items.png"; else echo MURL.$v_getBg->cr_settingValue; ?>" alt="Background Image">
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
</div>
                
<div class="panel-footer text-center">
    <button type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
    <button type="button" class="btn btn-warning m-r-5 m-b-5" onclick="location.href='<?php echo MADMINURL; ?>/logo/'"><i class="fa fa-reply"></i> Cancel</button>
    <button id="remove-bg" data-admin="<?php echo $cradminID_session ?>" type="button" class="btn btn-danger m-b-5"><i class="fa fa-times"></i> Remove</button>
  </form>
</div>

                    
</div>