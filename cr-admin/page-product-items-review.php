<?php
    $pagelink = $_GET['s'];
    $pID      = $_GET['eid'];
    $o_getReviews = new E_Commerce_Product_Reviews($pdo);
    $v_getReviews = $o_getReviews->view_reviews($pID);
?>
<link href="<?php echo MADMINURL ?>/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL ?>/assets/plugins/switchery/switchery.min.js"></script>
<div class="row">
    <!-- begin col-3 -->
    <div class="col-md-12">
    <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="ui-media-object-4">
                <div class="panel-heading">
                     <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Reviews</h4>
                </div>
                <?php
                    if($v_getReviews=="0") {
                ?>
                <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                    <p>
                        <strong>Empty!</strong>
                        No review found.
                    </p>
                </div>   
                <?php
                    }
                    else {
                ?> 
                <div class="panel-body">
                    <ul class="media-list media-list-with-divider">
                    <?php
                        $i=1;
                        foreach ($v_getReviews as $data) {
                            $reviewDate = date($v_getDateFormat->cr_settingValue." ".$v_getTimeFormat->cr_settingValue, strtotime($data->cr_productreviewsDate));
                    ?>
                        <li class="media media-sm">
                            <a class="media-left" href="javascript:;">
                                <img src="<?php echo MADMINURL."/assets/img/no-pic.png" ?>" alt="" class="media-object rounded-corner" />
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $data->cr_productreviewsName   ; ?></h4>
                                <p><i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo $data->cr_productreviewsEmail     ?>"><?php echo $data->cr_productreviewsEmail  ?></a> <i class="fa fa-calendar m-l-15"></i> <?php echo $reviewDate ?> <i class="fa fa-globe m-l-15"></i> <span id="reviewstatus<?php echo $i ?>"><?php if($data->cr_productreviewsStatus=='2') echo 'Approve'; elseif($data->cr_productreviewsStatus=='1') echo 'Unapprove'; ?></span></p>
                                <p>
                                    <?php
                                        $reviewstar = $data->cr_productreviewsStar;
                                        $diffstar   = 5-$reviewstar;
                                        for($j=1;$j<=$reviewstar;$j++) {
                                            echo '<i class="fa fa-star"></i> ';
                                        }
                                        if($diffstar!=0) {
                                           for($k=1;$k<=$diffstar;$k++) {
                                            echo '<i class="fa fa-star-o"></i> ';
                                            } 
                                        }
                                        echo "<strong class='m-l-10'>".$reviewstar."</strong> off 5 stars";
                                    ?>
                                </p>
                                <h5><?php echo $data->cr_productreviewsTitle ?></h5>
                                <p id="replycontent">
                                    <?php echo $data->cr_productreviewsReview ?>
                                </p>
                                <p>
                                    <span class="m-r-5"> 
                                        <input id="switchery-elem<?php echo $i ?>" class="switchery-elem" type="checkbox" data-render="switchery" data-theme="default" <?php if($data->cr_productreviewsStatus=='2') echo 'checked'; else echo ''; ?> />
                                    </span>
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            var elem<?php echo $i ?> = document.querySelector('#switchery-elem<?php echo $i ?>');
                                            var init<?php echo $i ?> = new Switchery(elem<?php echo $i ?>, {color: '#00acac'});
                                            elem<?php echo $i ?>.onchange = function() {
                                            if(elem<?php echo $i ?>.checked==true) {
                                                var status   = '2';
                                                var reviewid = '<?php echo $data->cr_productreviewsID ?>';
                                                var adminID  = '<?php echo $cradminID_session ?>';
                                                var dataString   = 'adminID='+adminID+'&status='+status+'&reviewid='+reviewid;
                                                $.ajax({
                                                    type: "POST",
                                                    url:  "<?php echo MADMINURL ?>/product-review-update.php",
                                                    data: dataString,
                                                    cache: false,
                                                        success: function(data){
                                                            if(data=="success") {
                                                                $('#reviewstatus<?php echo $i ?>').text('Approve');
                                                            }
                                                            else {
                                                                alert("Can't approve review. Please try again.");
                                                            }
                                                        }
                                                });
                                                return false;
                                            }
                                            else {
                                                var status   = '1';
                                                var reviewid = '<?php echo $data->cr_productreviewsID ?>';
                                                var adminID  = '<?php echo $cradminID_session ?>';
                                                var dataString   = 'adminID='+adminID+'&status='+status+'&reviewid='+reviewid;
                                                $.ajax({
                                                    type: "POST",
                                                    url:  "<?php echo MADMINURL ?>/product-review-update.php",
                                                    data: dataString,
                                                    cache: false,
                                                        success: function(data){
                                                            if(data=='success') {
                                                                $('#reviewstatus<?php echo $i ?>').text('Unapprove');
                                                            }
                                                            else {
                                                                alert("Can't unapprove review. Please try again.");
                                                            }
                                                        }
                                                });
                                                return false;
                                            }
                                            };
                                        });
                                    </script>    
                                    <button class="btn btn-sm btn-danger m-t-5" data-toggle="modal" data-target="#delete-dialog" data-rid="<?php echo $data->cr_productreviewsID ?>" data-rname="<?php echo $data->cr_portfolioreviewsName ?>"><i class="fa fa-times"></i> Delete</button>
                                </p>
                        </div>
                    </li>
                    <?php
                            $i++;
                        }
                    ?>
                </ul>
             </div>
            <?php
                }
            ?>
        </div>
     <!-- end panel -->
    </div>
</div>

<div class="modal fade" id="delete-dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-white" id="myModalLabel">Alert</h4>
      </div>
        <div class="modal-body">
                <div id="delete-response"></div>
                <p>Are you sure want to delete review from <span id="rname" class="add-caps"></span>?</p>
                <form id="delete-form" action="" method="post">
                    <input type="hidden" name="reviewID" value="" id="rid">
                    <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="submit-delete" type="submit" class="btn btn-danger" name="submit-delete">Delete</button>
                </form>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#replycontent').readmore({
      speed: 100,
      moreLink: '<a href="#" class="btn btn-sm btn-white"><i class="fa fa-angle-double-down"></i></a>',
      collapsedHeight: 50,
      lessLink: '<a href="#" class="btn btn-sm btn-white"><i class="fa fa-angle-double-up"></i></a>'
    });

    var requestdelete;
    $("#delete-form").submit(function(event){
        if (requestdelete) {
            requestdelete.abort();
        }
        var $form = $(this);
        var serializedData = $form.serialize();
        requestdelete = $.ajax({
            url: "<?php echo MADMINURL ?>/product-review-delete.php",
            type: "post",
            beforeSend: function(){ $("#submit-delete").html('<i class="fa fa-spinner fa-pulse"></i> Deleting review...');},
            data: serializedData
        });
        requestdelete.done(function (msg){
            if(msg!="false") {
                $("#submit-delete").attr("disabled","disabled");
                window.location="<?php echo $madinurl.'/page/'.$pagelink.'/reviews/'.$pID ?>";
            }
            else {
                $("#delete-response").html('<div class="alert alert-danger fade in"><strong>Error!</strong> Failed deleting review. Please try again.<span class="close" data-dismiss="alert">×</span></div>');
                $("#submit-delete").html("Delete");
            }
        });
        event.preventDefault();
    });

    $('#delete-dialog').on('show.bs.modal', function(e) {
        $(this).find('#rid').attr('value', $(e.relatedTarget).data('rid'));
        $(this).find('#rname').html($(e.relatedTarget).data('rname'));
    });
});
</script>