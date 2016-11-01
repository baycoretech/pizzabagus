<?php
    $o_getProduct = new E_Commerce_Product($pdo);
    $o_getCurrency = new Currency($pdo);
    $pagelink = $_GET['s'];
    $pc       = $_GET['id'];
    $o_getPC  = new E_Commerce_Product_Category($pdo);
    $v_getPC  = $o_getPC->view_product_category($pagelink);
    $v_get_active_curency = $o_getCurrency->view_active_currency();
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
                <h4 class="panel-title">E-Commerce Product Slider Image</h4>
            </div>
            <div id="panel-slider" class="panel-body">
                <form action="<?php echo MADMINURL ?>/media-select-upload2.php" class="dropzone" id="mediaupload">
                    <div class="dz-message text-center">
                        <h2><i class="fa fa-cloud-upload fa-3x"></i></h2>
                        <h3>Drag and Drop Files</h3>
                    </div>
                </form>
                <div id="dropzone-cover" style="background-color: rgba(0,0,0,.5); position: absolute;"></div>
                <p class="fancy m-t-20"><span>OR</span></p>
                <button id="browse-media-button" data-target="#browse-media-dialog" data-toggle="modal" class="btn btn-success btn-block m-t-15"><i class="fa fa-image"></i> Browse Media</button>
                <div id="show-selected-media" class="m-t-15"></div>
            </div>
        </div>
    </div>
    <!-- begin col-8 -->
    <div class="col-md-8">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">E-Commerce Product Information</h4>
            </div>
                <div id="" class="panel-body">
                    <form id="formaddproduct" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                        <input id="avatarForm" type="hidden" name="photo" value="">
                        <input id="filepdf" type="hidden" name="filepdf" value="">
                        <input id="mediafile" type="hidden" name="slider" value="">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" placeholder="Product Title" type="text" name="title" data-parsley-minlength="3" data-parsley-maxlength="200" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <select class="form-control" name="cat" required>
                                <option value="">Select Category</option>
                            <?php
                                foreach ($v_getPC as $data) {
                            ?>
                                <option value="<?php echo $data->cr_productcategoryID ?>"><?php echo $data->cr_productcategoryName ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Price</label>
                            <div class="input-group">
                              <span class="input-group-addon"><?php echo $v_get_active_curency->cr_currencySymbol ?></span>
                              <input class="form-control" placeholder="Product Price" type="text" name="price" data-parsley-minlength="1" data-parsley-maxlength="10" data-parsley-type="integer" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Discount</label>
                            <input type="text" id="product-discount" name="discount" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Weight (gram)</label>
                            <input class="form-control" placeholder="Product Weight (gram)" type="text" name="weight" data-parsley-minlength="1" data-parsley-type="integer" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Stock</label>
                            <input class="form-control" placeholder="Product Stock" type="text" name="stock" data-parsley-minlength="1" data-parsley-type="integer" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Available Colors (enter, tab, or comma after type)</label>
                            <ul id="jquery-tagIt-color" class="success">
                            </ul>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="publish" selected="selected">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="note note-info">
                            <p>
                                Just press Enter in Description if you want a blank description.          
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="editorproduct" required></textarea>
                        </div>

                        <legend>Reviews</legend>
                        <div class="form-group">
                            <label class="control-label">Allow User to Write a Review</label>
                            <select class="form-control" name="review" required>
                                <option value="yes" selected="selected">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <legend>SEO</legend>
                        <div id="note-gallery" class="note note-info">
                            <p>
                                Fill the SEO, Meta Keywords and Meta Description for found more easily by search engines.          
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Meta Keywords</label>
                            <input class="form-control" placeholder="Meta Keywords" type="text" name="metakey" data-parsley-maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Meta Description</label>
                            <textarea class="form-control" rows="5" placeholder="Meta Description" name="metadesc" data-parsley-maxlength="155"></textarea>
                        </div>
                </div>
            <div class="panel-footer">
                <button id="submitaddproduct" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-warning m-r-5 m-b-5" onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $pagelink ?>/view'"><i class="fa fa-reply"></i> Cancel</button>
                </form>
            </div>
         </div>
        <!-- end panel -->
    </div>

    <div class="col-md-4">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">E-Commerce Product Thumbnail</h4>
            </div>
                <?php require "product-items-upload.php" ?>
         </div>
        <!-- end panel -->
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">PDF File Upload</h4>
            </div>
            <div class="panel-body">
                <form action="<?php echo MADMINURL ?>/product-upload-pdf.php" class="dropzone" id="myAwesomeDropzone"></form>
            </div>
         </div>
    </div>
</div>
<?php
    $o_get_media = new Media($pdo);
    $v_get_media = $o_get_media->view_media_data();
?>
<div class="modal fade" id="browse-media-dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Browse Media</h4>
            </div>
            <div class="modal-body">
                <div id="error-handling"></div>
                <form id="form-media-browse" action="" method="POST">
                    <div class="form-group">
                    <?php
                        foreach($v_get_media as $data) {
                    ?>
                        <div class="col-md-2">   
                            <label class="rwi">
                                <input class="" type="checkbox" name="mediaselect" value="<?php echo $data->cr_mediaName ?>">
                                <div class="nailthumb-container modal-square-thumb">
                                    <img style="width:100%" src="<?php echo MURL."/cr-editor/images/".$data->cr_mediaName ?>">
                                </div>
                            </label>
                        </div>
                    <?php
                        }
                    ?>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-media-select" type="button" class="btn btn-success">Select</button>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo MADMINURL; ?>/assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
<link href="<?php echo MADMINURL; ?>/assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL; ?>/assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<link href="<?php echo MADMINURL; ?>/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
<link href="<?php echo MADMINURL; ?>/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
<script src="<?php echo MADMINURL; ?>/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<link href="<?php echo MADMINURL; ?>/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />

<script>
        $(document).ready(function() {
            $("#dropzone-cover").hide();
            var set_height = setInterval(
                function () {
                    var dzh = $("#mediaupload").outerHeight()+"px";
                    var dzw = $("#mediaupload").outerWidth()+"px";
                    $("#dropzone-cover").css("height", dzh);
                    $("#dropzone-cover").css("width", dzw);
                    $("#dropzone-cover").css("top", '55px');
                }, 500
            );
            $('#browse-media-dialog').on('show.bs.modal', function(e) {
                var thumbnail_width = $('.modal-square-thumb').width();
                $('.modal-square-thumb').css({'height':thumbnail_width+'px'});
                $('.nailthumb-container').nailthumb();
            });
            Dropzone.options.mediaupload = {
              maxFilesize: 5, // MB
              maxFiles: 20,
              uploadMultiple: true,
              parallelUploads: 20,
              acceptedFiles: "image/*",
              success: function( file, response ){
                $('#mediafile').val(response);
                $('#used-image').attr('src','<?php echo MURL."/cr-editor/images/" ?>'+response);
                $('#browse-media-button').attr('disabled','disabled');
                setTimeout(function() {
                    $("#dropzone-cover").slideDown(1000);
                    $("#show-selected-media").slideUp(1000);
                }, 1500);
              }
            };

            $("#button-media-select").click(function(){
                var media = $('input[name=mediaselect]:checked').map( function() {
                    return this.value;
                }).get().join(",");
                $("#button-media-select").attr('disabled','disabled');
                $("#button-media-select").html('<i class="fa fa-spinner fa-pulse"></i>');
                
                var dataString   = 'media='+media;
                $.ajax({
                    type: "POST",
                    url:  "<?php echo MADMINURL ?>/media-show-selected.php",
                    data: dataString,
                    cache: false,
                    success: function(data){
                        if(data == "failed") {
                            $.gritter.add({
                                title:"Failed! Something error with media file",
                                text:"Can't select media. Please try again.",
                                image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else {
                            $('#show-selected-media').html(data);
                            var thumbnail_width = $('.selected-square-thumb').width();
                            $('.selected-square-thumb').css({'height':thumbnail_width+'px'});
                            $('.nailthumb-container').nailthumb();
                            setTimeout(function() {
                                $('#browse-media-dialog').modal('hide');
                                $("#button-media-select").removeAttr('disabled');
                                $("#button-media-select").html('Select');
                            }, 2000);
                            $('#mediafile').attr('value', media);
                        }
                    }
                });
                return false;
            });
            var auto_refresh = setInterval(
            function () {
                var asd = $('#avatar-view1').find('img').attr('src');
                $('#avatarForm').attr('value', asd);
            }, 500);

            $("#product-discount").ionRangeSlider({
                min:0,
                max:100,
                type:"single",
                prettify:false,
                hasGrid:true,
                postfix: "%"
            });

            $("#jquery-tagIt-color").tagit({
                availableTags:[
                    "AliceBlue",
                    "AntiqueWhite",
                    "Aqua",
                    "Aquamarine",
                    "Azure",
                    "Beige",
                    "Bisque",
                    "Black",
                    "BlanchedAlmond",
                    "Blue",
                    "BlueViolet",
                    "Brown",
                    "BurlyWood",
                    "CadetBlue",
                    "Chartreuse",
                    "Chocolate",
                    "Coral",
                    "CornflowerBlue",
                    "Cornsilk",
                    "Crimson",
                    "Cyan",
                    "DarkBlue",
                    "DarkCyan",
                    "DarkGoldenRod",
                    "DarkGray",
                    "DarkGrey",
                    "DarkGreen",
                    "DarkKhaki",
                    "DarkMagenta",
                    "DarkOliveGreen",
                    "DarkOrange",
                    "DarkOrchid",
                    "DarkRed",
                    "DarkSalmon",
                    "DarkSeaGreen",
                    "DarkSlateBlue",
                    "DarkSlateGray",
                    "DarkSlateGrey",
                    "DarkTurquoise",
                    "DarkViolet",
                    "DeepPink",
                    "DeepSkyBlue",
                    "DimGray",
                    "DimGrey",
                    "DodgerBlue",
                    "FireBrick",
                    "FloralWhite",
                    "ForestGreen",
                    "Fuchsia",
                    "Gainsboro",
                    "GhostWhite",
                    "Gold",
                    "GoldenRod",
                    "Gray",
                    "Grey",
                    "Green",
                    "GreenYellow",
                    "HoneyDew",
                    "HotPink",
                    "IndianRed",
                    "Indigo",
                    "Ivory",
                    "Khaki",
                    "Lavender",
                    "LavenderBlush",
                    "LawnGreen",
                    "LemonChiffon",
                    "LightBlue",
                    "LightCoral",
                    "LightCyan",
                    "LightGoldenRodYellow",
                    "LightGray",
                    "LightGrey",
                    "LightGreen",
                    "LightPink",
                    "LightSalmon",
                    "LightSeaGreen",
                    "LightSkyBlue",
                    "LightSlateGray",
                    "LightSlateGrey",
                    "LightSteelBlue",
                    "LightYellow",
                    "Lime",
                    "LimeGreen",
                    "Linen",
                    "Magenta",
                    "Maroon",
                    "MediumAquaMarine",
                    "MediumBlue",
                    "MediumOrchid",
                    "MediumPurple",
                    "MediumSeaGreen",
                    "MediumSlateBlue",
                    "MediumSpringGreen",
                    "MediumTurquoise",
                    "MediumVioletRed",
                    "MidnightBlue",
                    "MintCream",
                    "MistyRose",
                    "Moccasin",
                    "NavajoWhite",
                    "Navy",
                    "OldLace",
                    "Olive",
                    "OliveDrab",
                    "Orange",
                    "OrangeRed",
                    "Orchid",
                    "PaleGoldenRod",
                    "PaleGreen",
                    "PaleTurquoise",
                    "PaleVioletRed",
                    "PapayaWhip",
                    "PeachPuff",
                    "Peru",
                    "Pink",
                    "Plum",
                    "PowderBlue",
                    "Purple",
                    "RebeccaPurple",
                    "Red",
                    "RosyBrown",
                    "RoyalBlue",
                    "SaddleBrown",
                    "Salmon",
                    "SandyBrown",
                    "SeaGreen",
                    "SeaShell",
                    "Sienna",
                    "Silver",
                    "SkyBlue",
                    "SlateBlue",
                    "SlateGray",
                    "SlateGrey",
                    "Snow",
                    "SpringGreen",
                    "SteelBlue",
                    "Tan",
                    "Teal",
                    "Thistle",
                    "Tomato",
                    "Turquoise",
                    "Violet",
                    "Wheat",
                    "White",
                    "WhiteSmoke",
                    "Yellow",
                    "YellowGreen"
                ],
                placeholderText: 'Available Colors',
                fieldName: "color[]",
                allowSpaces: true
            })

            Dropzone.options.myAwesomeDropzone = {
              maxFilesize: 5, // MB
              maxFiles: 1,
              acceptedFiles: "application/pdf",
              success: function( file, response ){
                $('#filepdf').val(response);
              }
            };

            CKEDITOR.replace( 'editorproduct', {
                    filebrowserBrowseUrl : '<?php echo MURL; ?>/cr-include/ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl : '<?php echo MURL; ?>/cr-include/ckfinder/ckfinder.html?type=Images',
                    filebrowserFlashBrowseUrl : '<?php echo MURL; ?>/cr-include/ckfinder/ckfinder.html?type=Flash',
                    filebrowserUploadUrl : '<?php echo MURL; ?>/cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl : '<?php echo MURL; ?>/cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl : '<?php echo MURL; ?>/cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            });

            // Variable to hold request add portfolio
            var requestaddproduct;
                        
            // Bind to the submit event of our form
            $("#formaddproduct").submit(function(event){
                        
                // Abort any pending requestaddproduct
                if (requestaddproduct) {
                    requestaddproduct.abort();
                }
                // setup some local variables
                var $form = $(this);
                        
                // Let's select and cache all the fields
                var $inputs = $form.find("input, button");
                        
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                
                // Serialize the data in the form
                var serializedData = $form.serialize();

                requestaddproduct = $.ajax({
                    url: "<?php echo MADMINURL ?>/product-add.php",
                    type: "post",
                    beforeSend: function(){ $("#submitaddproduct").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');},
                    data: serializedData
                });
                        
                // Callback handler that will be called on success
                requestaddproduct.done(function (msg){
                    if(msg=='same-title') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't add new e-commerce product. Portfolio or product title is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='title-long') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Product title is too long",
                            text:"Can't add new e-commerce product. It should have 200 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='title-short') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Product title is too short",
                            text:"Can't add new e-commerce product. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='price-empty') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Product price is empty",
                            text:"Can't add new e-commerce product. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='stock-empty') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Product stock is empty",
                            text:"Can't add new e-commerce product. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='weight-empty') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Product weight is empty",
                            text:"Can't add new e-commerce product. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='reserved-word') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't add new e-commerce product. Don't use word like 'sort', it's a reserved word. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='metakey-long') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Meta Keywords is too long",
                            text:"Can't add new e-commerce product. It should have 255 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='metadesc-long') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Meta Description is too long",
                            text:"Can't add new e-commerce product. It should have 155 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='no-image') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not uploaded an image",
                            text:"Can't add new e-commerce product. You have to upload the portfolio or product image. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='no-slider') {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not uploaded a slider image",
                            text:"Can't add new e-commerce product. You have to upload at least one e-commerce product slider image. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='success') {
                        $.gritter.add({
                            title:"Success!",
                            text:"New e-commerce product has been added.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/view";
                        }, 2000);
                    }
                    else {
                        $("#submitaddproduct").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Something wrong",
                            text:"Can't add new e-commerce product. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                })
                requestaddproduct.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            });
        });
</script>