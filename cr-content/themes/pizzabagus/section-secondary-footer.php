<?php
    $class_secondary_footer   = new Secondary_Footer($pdo);
    $secondary_footer         = $class_secondary_footer->view_secondary_footer();
    $explode_secondary_footer = explode(',', $secondary_footer->cr_settingValue);
    $first_column             = $explode_secondary_footer[0];
    $second_column            = $explode_secondary_footer[1];
?>
<div class="secondary-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6 secondary-footer-left">
                <p>
                    <?php
                        if($first_column=="NULL" || $first_column=="")
                            echo "";
                        else
                            echo $first_column; 
                    ?>
                </p>
            </div>
            <div class="col-md-6 secondary-footer-right">
                <p>
                    <?php
                        if($second_column=="NULL" || $second_column=="")
                            echo "";
                        else
                            echo $second_column; 
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>