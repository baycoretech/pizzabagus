<?php
    $o_get_currency   = new Currency($pdo);
    $v_get_currency   = $o_get_currency->view_currency();
    $v_get_total_currency  = $o_get_currency->count_currency();
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
                            if($v_get_currency=="0") {
                        ?>
                        <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                            <p>
                                <strong>Empty!</strong>
                                No currency data found.
                            </p>
                        </div>   
                        <?php
                            }
                            else {
                        ?> 
                        <div class="panel-body">
                            <?php
                                if($v_get_total_currency>8) {
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
                                                <th class="">Symbol</th>
                                                <th class="">Decimals</th>
                                                <th class="">Decimal Point</th>
                                                <th class="">Separator</th>
                                                <th class="">Example</th>
                                                <th class="">Status</th>
                                                <th width="100" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i=1;
                                            foreach ($v_get_currency as $data) {
                                                if($data->cr_currencySpace == '0') 
                                                    $space_symbol_number = '';
                                                elseif($data->cr_currencySpace == '1')
                                                    $space_symbol_number = ' ';
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i; ?></td>
                                                <td class="add-caps"><?php echo $data->cr_currencyName." (".$data->cr_currencyCode.")" ?></td>
                                                <td class="add-caps"><?php echo $data->cr_currencySymbol ?></td>
                                                <td class="add-caps"><?php echo $data->cr_currencyDecimals ?></td>
                                                <td class="add-caps"><?php echo $data->cr_currencyDecimalpoint ?></td>
                                                <td class="add-caps"><?php echo $data->cr_currencySeparator ?></td>
                                                <td class="add-caps">
                                                	<?php echo $data->cr_currencySymbol.$space_symbol_number.number_format("1000", $data->cr_currencyDecimals, $data->cr_currencyDecimalpoint, $data->cr_currencySeparator) ?>
                                                </td>
                                                <td class="add-caps"><?php if($data->cr_currencyStatus == '1') echo 'Active'; else echo '' ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-icon btn-circle" data-target="#edit-dialog" data-toggle="modal" data-id="<?php echo $data->cr_currencyID ?>" data-name="<?php echo $data->cr_currencyName ?>" data-code="<?php echo $data->cr_currencyCode ?>" data-decimals="<?php echo $data->cr_currencyDecimals ?>" data-decimalpoint="<?php echo $data->cr_currencyDecimalpoint ?>"  data-separator="<?php echo $data->cr_currencySeparator ?>" data-symbol="<?php echo $data->cr_currencySymbol ?>" data-space="<?php echo $data->cr_currencySpace ?>"><i class="fa fa-pencil"></i></button>
                                                    <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#delete-dialog" data-toggle="modal" data-dn="<?php echo $data->cr_currencyName ?>" data-hapus="<?php echo $data->cr_currencyID; ?>"><i class="fa fa-times"></i></button>
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
                                if($v_get_total_currency>8) {
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
                                    <i class="fa fa-money fa-2x pull-left"></i>
                                    <span class="f-w-700">Add Currency</span><br>
                                    <small>Add New Currency</small>
                                </button>
                                <button class="btn btn-lg btn-primary btn-block" data-target="#set-dialog" data-toggle="modal">
                                    <i class="fa fa-check fa-2x pull-left"></i>
                                    <span class="f-w-700">Set Currency</span><br>
                                    <small>Set Active Currency</small>
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
                <h4 class="modal-title text-white">Add Currency</h4>
            </div>
            <div class="modal-body">
                <?php
                        if (isset ($_POST['add_currency'])) {
                                $name              = ucwords($_POST['name']);
                                $symbol            = $_POST['symbol'];
                                $decimals          = $_POST['decimals'];
                                $decimal_point     = $_POST['decimal_point'];
                                $decimal_separator = $_POST['separator'];
                                $space             = $_POST['space'];
                                if($_POST['select_currency'] == 'paypal_support') {
                                    $code = $_POST['code'];
                                }
                                elseif($_POST['select_currency'] == 'other_currency') {
                                    $code = strtoupper($_POST['other_code']);
                                }
                                $admin_login_id    = $_POST['admin_login_id'];

                            if(empty($name) || empty($symbol) || empty($admin_login_id)){
                                       header("Location: $madinurl/currency/");             
                            }
                            else {
                                    $v_get_add_currency = $o_get_currency->add_currency($symbol, $decimals, $decimal_point, $decimal_separator, $name, $code, $space, $admin_login_id);
                                    header("Location: $madinurl/currency/"); 
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
                            <label class="control-label">Select Currency Code</label>
                            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                                <p>
                                    Check <a href="http://www.science.co.il/International/Currency-codes.asp"><strong>currency list and code</strong></a> for all country.
                                </p>
                            </div> 
                            <div class="radio">
                                <label>
                                    <input id="paypal_support" type="radio" name="select_currency" value="paypal_support" required>
                                    Paypal Support
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input id="other_currency" type="radio" name="select_currency" value="other_currency">
                                    Other Currency 
                                </label>
                            </div>
                            <select id="select_paypal_support" name="code" class="form-control" required>
                              <option value="">Select Currency</option>
                              <option value="AUD">Australian Dollar</option>
                              <option value="BRL">Brazilian Real </option>
                              <option value="CAD">Canadian Dollar</option>
                              <option value="CZK">Czech Koruna</option>
                              <option value="DKK">Danish Krone</option>
                              <option value="EUR">Euro</option>
                              <option value="HKD">Hong Kong Dollar</option>
                              <option value="HUF">Hungarian Forint </option>
                              <option value="ILS">Israeli New Sheqel</option>
                              <option value="JPY">Japanese Yen</option>
                              <option value="MYR">Malaysian Ringgit</option>
                              <option value="MXN">Mexican Peso</option>
                              <option value="NOK">Norwegian Krone</option>
                              <option value="NZD">New Zealand Dollar</option>
                              <option value="PHP">Philippine Peso</option>
                              <option value="PLN">Polish Zloty</option>
                              <option value="GBP">Pound Sterling</option>
                              <option value="SGD">Singapore Dollar</option>
                              <option value="SEK">Swedish Krona</option>
                              <option value="CHF">Swiss Franc</option>
                              <option value="TWD">Taiwan New Dollar</option>
                              <option value="THB">Thai Baht</option>
                              <option value="TRY">Turkish Lira</option>
                              <option value="USD" selected>U.S. Dollar</option>
                            </select>
                            <input id="select_other_currency" class="form-control" placeholder="Other Currency" type="text" name="other_code" data-parsley-minlength="3" data-parsley-maxlength="3">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Symbol</label>
                            <input class="form-control" placeholder="Symbol" type="text" name="symbol" data-parsley-minlength="1" data-parsley-maxlength="25" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Decimals</label>
                            <input class="form-control" placeholder="Decimals" type="text" name="decimals" data-parsley-type="integer">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Decimal Point</label>
                            <input class="form-control" placeholder="Decimal Point" type="text" name="decimal_point" data-parsley-maxlength="5">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Separator</label>
                            <input class="form-control" placeholder="Separator" type="text" name="separator" data-parsley-maxlength="5">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Space Between Symbol and Number</label>
                            <select class="form-control" name="space" required>
                                <option value="0" selected="selected">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="add_currency">Save</button>
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
                <h4 class="modal-title text-white">Edit Currency</h4>
            </div>
            <div class="modal-body">
                <?php
                        if (isset ($_POST['update_currency'])) {
                                //Success and Error handle
                                $name           = ucwords($_POST['name']);
                                $symbol         = $_POST['symbol'];
                                $decimals       = $_POST['decimals'];
                                $decimal_point  = $_POST['decimal_point'];
                                $decimal_separator = $_POST['separator'];
                                $space          = $_POST['space'];
                                if($_POST['select_currency'] == 'paypal_support') {
                                    $code = $_POST['code'];
                                }
                                elseif($_POST['select_currency'] == 'other_currency') {
                                    $code = strtoupper($_POST['other_code']);
                                }
                                $currency_idh   = $_POST['currency_idh'];
                                $admin_login_id = $_POST['admin_login_id'];

                            if(empty($name) || empty($symbol) || empty($admin_login_id) || empty($currency_idh)){
                                       header("Location: $madinurl/currency/");             
                            }
                            else {
                                    $v_get_update_currency = $o_get_currency->update_currency($symbol, $decimals, $decimal_point, $decimal_separator, $name, $code, $space, $currency_idh, $admin_login_id);
                                    header("Location: $madinurl/currency/"); 
                            } 
                        }
                ?>
                <form data-parsley-validate action="" method="POST">
                        <input type="hidden" name="currency_idh" value="" id="currency_idh">
                        <input type="hidden" name="admin_login_id" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input id="name" class="form-control" placeholder="Name" type="text" name="name" data-parsley-minlength="3" data-parsley-maxlength="100" autofocus required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Currency Code</label>
                            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                                <p>
                                    Check <a href="http://www.science.co.il/International/Currency-codes.asp"><strong>currency list and code</strong></a> for all country.
                                </p>
                            </div> 
                            <div class="radio">
                                <label>
                                    <input id="edit_paypal_support" type="radio" name="select_currency" value="paypal_support" required>
                                    Paypal Support
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input id="edit_other_currency" type="radio" name="select_currency" value="other_currency">
                                    Other Currency 
                                </label>
                            </div>
                            <select id="edit_select_paypal_support" name="code" class="form-control" required>
                              <option value="">Select Currency</option>
                              <option value="AUD">Australian Dollar</option>
                              <option value="BRL">Brazilian Real </option>
                              <option value="CAD">Canadian Dollar</option>
                              <option value="CZK">Czech Koruna</option>
                              <option value="DKK">Danish Krone</option>
                              <option value="EUR">Euro</option>
                              <option value="HKD">Hong Kong Dollar</option>
                              <option value="HUF">Hungarian Forint </option>
                              <option value="ILS">Israeli New Sheqel</option>
                              <option value="JPY">Japanese Yen</option>
                              <option value="MYR">Malaysian Ringgit</option>
                              <option value="MXN">Mexican Peso</option>
                              <option value="NOK">Norwegian Krone</option>
                              <option value="NZD">New Zealand Dollar</option>
                              <option value="PHP">Philippine Peso</option>
                              <option value="PLN">Polish Zloty</option>
                              <option value="GBP">Pound Sterling</option>
                              <option value="SGD">Singapore Dollar</option>
                              <option value="SEK">Swedish Krona</option>
                              <option value="CHF">Swiss Franc</option>
                              <option value="TWD">Taiwan New Dollar</option>
                              <option value="THB">Thai Baht</option>
                              <option value="TRY">Turkish Lira</option>
                              <option value="USD">U.S. Dollar</option>
                            </select>
                            <input id="edit_select_other_currency" class="form-control" placeholder="Other Currency" type="text" name="other_code" data-parsley-minlength="3" data-parsley-maxlength="3">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Symbol</label>
                            <input id="symbol" class="form-control" placeholder="Symbol" type="text" name="symbol" data-parsley-minlength="1" data-parsley-maxlength="25" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Decimals</label>
                            <input id="decimals" class="form-control" placeholder="Decimals" type="text" name="decimals" data-parsley-type="integer">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Decimal Point</label>
                            <input id="decimalpoint" class="form-control" placeholder="Decimal Point" type="text" name="decimal_point" data-parsley-maxlength="5">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Separator</label>
                            <input id="separator" class="form-control" placeholder="Separator" type="text" name="separator" data-parsley-maxlength="5">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Space Between Symbol and Number</label>
                            <select class="form-control" id="space" name="space" required>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="update_currency">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- #add-dialog -->
<div class="modal fade" id="set-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Set Active Currency</h4>
            </div>
            <div class="modal-body">
                <?php
                        if (isset ($_POST['set_currency'])) {
                                $currency_id    = $_POST['currency_id'];
                                $admin_login_id = $_POST['admin_login_id'];

                            if(empty($currency_id) || empty($admin_login_id)){
                                       header("Location: $madinurl/currency/");             
                            }
                            else {
                                    $v_get_set_currency = $o_get_currency->set_currency($currency_id, $admin_login_id);
                                    header("Location: $madinurl/currency/"); 
                            } 
                        }
                ?>
                <form data-parsley-validate action="" method="POST">
                        <input type="hidden" name="admin_login_id" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Currency</label>
                            <select class="form-control" name="currency_id" required>
                                <option value="">Select Currency</option>
                                <?php
                                    foreach ($v_get_currency as $data) {
                                ?>
                                <option value="<?php echo $data->cr_currencyID ?>" <?php if($data->cr_currencyStatus == '1') echo 'selected' ?>><?php echo $data->cr_currencyName ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" name="set_currency">Save</button>
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
                <p>Are you sure want to delete <span id="dn"></span> from currency?</p>
                <?php
                    if (isset ($_POST['delete_currency'])) {
                        $currency_id       = $_POST['currency_id'];
                        $admin_login_id    = $_POST['admin_login_id'];
                        $v_delete_currency = $o_get_currency->delete_currency($currency_id, $admin_login_id);
                            header("Location: $madinurl/currency/"); 
                    } 
                ?>
                <form action="" method="post">
                    <input type="hidden" name="currency_id" value="" id="delete">
                    <input type="hidden" name="admin_login_id" value="<?php echo $cradminID_session ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" name="delete_currency">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#add-dialog').on('show.bs.modal', function(e) {
            $("#select_paypal_support").hide();
            $("#select_other_currency").hide();
            $("#paypal_support").click(function(){
                if ($("#paypal_support").is(":checked")) {
                    $('#select_paypal_support').slideDown();
                    $('#select_paypal_support').attr('required','required');
                    $('#select_other_currency').removeAttr('required','required');
                    $('#select_other_currency').hide();
                } 
                else {
                    $("#select_paypal_support").hide();
                    $("#select_paypal_support").removeAttr('required');
                    $("#select_other_currency").hide();
                }
            })
            $("#other_currency").click(function(){
                if ($("#other_currency").is(":checked")) {
                    $("#select_other_currency").slideDown();
                    $("#select_other_currency").attr('required','required');
                    $("#select_paypal_support").removeAttr('required');
                    $("#select_paypal_support").hide();
                } 
                else {
                    $("#select_other_currency").hide();
                    $("#select_other_currency").removeAttr('required');
                    $("#select_paypal_support").hide();
                }
            })
        })
        $('#edit-dialog').on('show.bs.modal', function(e) {
            $(this).find('#currency_idh').attr('value', $(e.relatedTarget).data('id'));
            $(this).find('#name').attr('value', $(e.relatedTarget).data('name'));
            $(this).find('#symbol').attr('value', $(e.relatedTarget).data('symbol'));
            $(this).find('#decimals').attr('value', $(e.relatedTarget).data('decimals'));
            $(this).find('#decimalpoint').attr('value', $(e.relatedTarget).data('decimalpoint'));
            $(this).find('#space').attr('value', $(e.relatedTarget).data('space'));
            $(this).find('#edit_select_paypal_support').attr('value', $(e.relatedTarget).data('code'));
            $(this).find('#separator').attr('value', $(e.relatedTarget).data('separator'));
            if($(e.relatedTarget).data('code') == 'AUD' || $(e.relatedTarget).data('code') == 'BRL' || $(e.relatedTarget).data('code') == 'CAD' || $(e.relatedTarget).data('code') == 'CZK' || $(e.relatedTarget).data('code') == 'DKK' || $(e.relatedTarget).data('code') == 'EUR' || $(e.relatedTarget).data('code') == 'HKD' ||  $(e.relatedTarget).data('code') == 'HUF' || $(e.relatedTarget).data('code') == 'ILS' || $(e.relatedTarget).data('code') == 'JPY' || $(e.relatedTarget).data('code') == 'MYR' || $(e.relatedTarget).data('code') == 'MXN' || $(e.relatedTarget).data('code') == 'NOK' || $(e.relatedTarget).data('code') == 'NZD' || $(e.relatedTarget).data('code') == 'PHP' || $(e.relatedTarget).data('code') == 'PLN' || $(e.relatedTarget).data('code') == 'GBP' || $(e.relatedTarget).data('code') == 'SGD' || $(e.relatedTarget).data('code') == 'SEK' || $(e.relatedTarget).data('code') == 'CHF' || $(e.relatedTarget).data('code') == 'TWD' || $(e.relatedTarget).data('code') == 'THB' || $(e.relatedTarget).data('code') == 'TRY' || $(e.relatedTarget).data('code') == 'USD') {
                $("#edit_paypal_support").attr("checked",'checked');
                $("#edit_select_paypal_support").show();
                $(this).find('#edit_select_other_currency').attr('value', '');
                $('#edit_select_paypal_support').attr('required','required');
                $('#edit_select_other_currency').removeAttr('required','required');
                $("#edit_select_other_currency").hide();
            }
            else {
                $("#edit_other_currency").attr("checked",'checked');
                $("#edit_select_other_currency").show();
                $(this).find('#edit_select_other_currency').attr('value', $(e.relatedTarget).data('code'));
                $("#edit_select_other_currency").attr('required','required');
                $("#edit_select_paypal_support").removeAttr('required');
                $("#edit_select_paypal_support").hide();
            }
            $("#edit_paypal_support").click(function(){
                if ($("#edit_paypal_support").is(":checked")) {
                    $('#edit_select_paypal_support').slideDown();
                    $('#edit_select_paypal_support').attr('required','required');
                    $('#edit_select_other_currency').removeAttr('required','required');
                    $('#edit_select_other_currency').hide();
                } 
                else {
                    $("#edit_select_paypal_support").hide();
                    $("#edit_select_paypal_support").removeAttr('required');
                    $("#edit_select_other_currency").hide();
                }
            })
            $("#edit_other_currency").click(function(){
                if ($("#edit_other_currency").is(":checked")) {
                    $("#edit_select_other_currency").slideDown();
                    $("#edit_select_other_currency").attr('required','required');
                    $("#edit_select_paypal_support").removeAttr('required');
                    $("#edit_select_paypal_support").hide();
                } 
                else {
                    $("#edit_select_other_currency").hide();
                    $("#edit_select_other_currency").removeAttr('required');
                    $("#edit_select_paypal_support").hide();
                }
            })
        });
        $('#delete-dialog').on('show.bs.modal', function(e) {
            $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });
    });
</script>