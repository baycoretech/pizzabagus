<div id="crop-customthumbnail" class="panel-body">
                    <div class="form-group">
                        <div id="avatar-view2" class="avatar-view" title="Change custom thumbnail">
                            <img id="gambarAvatar" src="<?php if($_GET['id']=='add') { echo MADMINURL."/assets/img/no-pic-items.png"; } elseif($_GET['id']=='edit') { if($v_getEditPortfolio->cr_portfolioCustomthumb=="") echo MADMINURL."/assets/img/no-pic-items.png"; else echo MURL.$v_getEditPortfolio->cr_portfolioCustomthumb; } else { echo "";} ?>" alt="Portfolio Custom Thumbnail">
                        </div>
                    </div>

                    <!-- Cropping modal -->
                        <div class="modal fade" id="customthumbnail-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <form class="avatar-form" action="<?php echo MADMINURL; ?>/crop-portfolio.php" enctype="multipart/form-data" method="post">
                                <div class="modal-header">
                                  <button class="close" data-dismiss="modal" type="button">&times;</button>
                                  <h4 class="modal-title" id="avatar-modal-label">Change Custom Thumbnail</h4>
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
</div>