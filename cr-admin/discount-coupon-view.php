<?php
    $o_get_discount_coupon       = new Discount_Coupon($pdo);
    $v_get_discount_coupon       = $o_get_discount_coupon->view_discount_coupon();
    $v_get_total_discount_coupon = $o_get_discount_coupon->count_discount_coupon();
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
                        <?php
                            if($v_get_discount_coupon=="0") {
                        ?>
                        <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                            <p>
                                <strong>Empty!</strong>
                                No discount coupon data found.
                            </p>
                        </div>   
                        <?php
                            }
                            else {
                        ?> 
                        <div class="panel-body">
                            <?php
                                if($v_get_total_discount_coupon>8) {
                            ?>
                            <div data-scrollbar="true" data-height="500px">
                            <?php
                                }
                            ?>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30" class="text-center">#</th>
                                                <th width="100" class="">Name</th>
                                                <th class="">Code</th>
                                                <th class="">Discount (%)</th>
                                                <th class="">Valid Until</th>
                                                <th width="100" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i=1;
                                            foreach ($v_get_discount_coupon as $data) {
                                                $discount_coupon_valid = date($v_getDateFormat->cr_settingValue, strtotime($data->cr_discountcouponValiduntil));
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i; ?></td>
                                                <td class="add-caps"><?php echo $data->cr_discountcouponName ?></td>
                                                <td class="add-caps"><?php echo $data->cr_discountcouponCode ?></td>
                                                <td class="add-caps"><?php echo $data->cr_discountcouponDiscount ?></td>
                                                <td class="add-caps"><?php echo $discount_coupon_valid ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-icon btn-circle" data-target="#edit-dialog" data-toggle="modal" data-id="<?php echo $data->cr_discountcouponID ?>" data-name="<?php echo $data->cr_discountcouponName ?>"  data-code="<?php echo $data->cr_discountcouponCode ?>" data-discount="<?php echo $data->cr_discountcouponDiscount ?>"  data-validuntil="<?php echo $data->cr_discountcouponValiduntil ?>"><i class="fa fa-pencil"></i></button>
                                                    <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#delete-dialog" data-toggle="modal" data-dn="<?php echo $data->cr_discountcouponName ?>" data-hapus="<?php echo $data->cr_discountcouponID; ?>"><i class="fa fa-times"></i></button>
                                                </td>
                                            </tr>
                                        <?php
                                                $i++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php
                                if($v_get_total_discount_coupon>8) {
                            ?>
                            </div>
                            <?php
                                }
                            ?>
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
                                <button class="btn btn-lg btn-success btn-block" data-target="#add-dialog" data-toggle="modal">
                                    <i class="fa fa-ticket fa-2x pull-left"></i>
                                    <span class="f-w-700">Add Coupon</span><br>
                                    <small>Add New Coupon</small>
                                </button>
                            </p>
                        </div>
                    </div>
			        <!-- end panel -->
			    </div>
</div>

<!-- #add-dialog -->
<div class="modal fade" id="add-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Add Discount Coupon</h4>
            </div>
            <div class="modal-body">
                <?php
                        if (isset ($_POST['add_discount_coupon'])) {
                                $name           = $_POST['name'];
                                $code           = $_POST['code'];
                                $discount       = $_POST['discount'];
                                $validuntil     = $_POST['validuntil'];
                                $admin_login_id = $_POST['admin_login_id'];

                            if(empty($name) || empty($code) || empty($discount) || empty($validuntil) || empty($admin_login_id)){
                                header("Location: $madinurl/discount-coupon/");             
                            }
                            else {
                                if(!is_numeric($discount)) {
                                    header("Location: $madinurl/discount-coupon/"); 
                                }
                                elseif($discount>100 || $discount<2) {
                                    header("Location: $madinurl/discount-coupon/"); 
                                }
                                else {
                                    $v_get_add_discount_coupon = $o_get_discount_coupon->add_discount_coupon($name, $code, $discount, $validuntil, $admin_login_id);
                                    header("Location: $madinurl/discount-coupon/"); 
                                }
                            } 
                        }
                ?>
                <form data-parsley-validate action="" method="POST">
                        <input type="hidden" name="admin_login_id" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input class="form-control" placeholder="Name" type="text" name="name" data-parsley-minlength="3" data-parsley-maxlength="100" autofocus required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Code</label>
                            <input class="form-control" placeholder="Code" type="text" name="code" data-parsley-minlength="1" data-parsley-maxlength="25" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Discount</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Discount" aria-describedby="discount" name="discount" data-parsley-type="integer" data-parsley-min="1" data-parsley-max="100" required>
                                <span class="input-group-addon" id="discount">%</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Valid Until</label>
                            <input type="text" class="form-control" id="datepicker-default" placeholder="Select Date" data-date-format="yyyy-mm-dd" data-date-start-date="Date.default" name="validuntil" required />
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="add_discount_coupon">Save</button>
                </form>
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
                <h4 class="modal-title text-white">Edit Discount Coupon</h4>
            </div>
            <div class="modal-body">
                <?php
                        if (isset ($_POST['update_discount_coupon'])) {
                                $name           = $_POST['name'];
                                $code           = $_POST['code'];
                                $discount       = $_POST['discount'];
                                $validuntil     = $_POST['validuntil'];
                                $discount_coupon_idh = $_POST['discount_coupon_idh'];
                                $admin_login_id = $_POST['admin_login_id'];

                            if(empty($name) || empty($code) || empty($discount) || empty($validuntil) || empty($admin_login_id) || empty($discount_coupon_idh)){
                                header("Location: $madinurl/discount-coupon/");             
                            }
                            else {
                                if(!is_numeric($discount)) {
                                    header("Location: $madinurl/discount-coupon/"); 
                                }
                                elseif($discount>100 || $discount<2) {
                                    header("Location: $madinurl/discount-coupon/"); 
                                }
                                else {
                                    $v_get_update_discount_coupon = $o_get_discount_coupon->update_discount_coupon($name, $code, $discount, $validuntil, $discount_coupon_idh, $admin_login_id);
                                    header("Location: $madinurl/discount-coupon/"); 
                                }
                            } 
                        }
                ?>
                <form data-parsley-validate action="" method="POST">
                        <input type="hidden" name="discount_coupon_idh" value="" id="discount_coupon_idh">
                        <input type="hidden" name="admin_login_id" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input id="name" class="form-control" placeholder="Name" type="text" name="name" data-parsley-minlength="3" data-parsley-maxlength="100" autofocus required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Code</label>
                            <input id="code" class="form-control" placeholder="Code" type="text" name="code" data-parsley-minlength="1" data-parsley-maxlength="25" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Discount</label>
                            <div class="input-group">
                                <input id="discount" type="text" class="form-control" placeholder="Discount" name="discount" data-parsley-type="integer" data-parsley-min="1" data-parsley-max="100" required>
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Valid Until : <span id="validuntil"></span></label>
                            <input type="text" class="form-control" id="datepicker-default-edit" placeholder="Select Date" data-date-format="yyyy-mm-dd" data-date-start-date="Date.default" name="validuntil" required />
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="update_discount_coupon">Save</button>
                </form>
            </div>
        </div>
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
                <p>Are you sure want to delete <span id="dn"></span> discount coupon?</p>
                <?php
                    if (isset ($_POST['delete_discount_coupon'])) {
                        $discount_coupon_id = $_POST['discount_coupon_id'];
                        $admin_login_id     = $_POST['admin_login_id'];
                        $v_delete_discount_coupon  = $o_get_discount_coupon->delete_discount_coupon($discount_coupon_id, $admin_login_id);
                            header("Location: $madinurl/discount-coupon/"); 
                    } 
                ?>
                <form action="" method="post">
                    <input type="hidden" name="discount_coupon_id" value="" id="delete">
                    <input type="hidden" name="admin_login_id" value="<?php echo $cradminID_session ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" name="delete_discount_coupon">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#edit-dialog').on('show.bs.modal', function(e) {
            $(this).find('#discount_coupon_idh').attr('value', $(e.relatedTarget).data('id'));
            $(this).find('#name').attr('value', $(e.relatedTarget).data('name'));
            $(this).find('#code').attr('value', $(e.relatedTarget).data('code'));
            $(this).find('#discount').attr('value', $(e.relatedTarget).data('discount'));
            $(this).find('#validuntil').html($(e.relatedTarget).data('validuntil'));
        });
        $('#delete-dialog').on('show.bs.modal', function(e) {
            $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });
    });
</script>