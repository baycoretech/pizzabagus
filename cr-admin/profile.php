<?php
    $function_profile_administrator = $class_administrator->profile_administrator($admin_id_session);
?>
<div class="profile-container">
    <!-- begin profile-section -->
    <div class="profile-section">
        <!-- begin profile-left -->
        <div class="profile-left">
            <!-- begin profile-image -->
            <div class="profile-image">
            <img <?php if($function_profile_administrator->cr_adminPhoto == 'assets/img/no-pic.png' || $function_profile_administrator->cr_adminPhoto == '') echo 'class="no-admin-photo"' ?> <?php if($function_profile_administrator->cr_adminPhoto != 'assets/img/no-pic.png' || $function_profile_administrator->cr_adminPhoto == '') { ?> src="<?php if($function_profile_administrator->cr_adminPhoto == '') echo MADMINURL."assets/img/no-pic.png"; else echo MADMINURL.$function_profile_administrator->cr_adminPhoto ?>" <?php } else { ?> data-name="<?php echo ucwords($function_profile_administrator->cr_adminDisplayName); ?>" data-font-size="140" data-width="100%" data-height="175" <?php } ?> alt="<?php echo ucwords($function_profile_administrator->cr_adminDisplayName); ?>" />
                <i class="fa fa-user hide"></i>
            </div>
            <!-- end profile-image -->
            <?php
                if($admin_level == 1) {
            ?>
            <div class="m-b-10">
                <a href="<?php echo $router->generate('admin-dashboard-id', array('section' => 'profile', 'action' => 'edit', 'id' => $function_profile_administrator->cr_adminID)) ?>" class="btn btn-success btn-block btn-sm">Edit Profile</a>
            </div>
            <?php
                }
                else {
                    echo "";
                }
            ?>
        </div>
        <!-- end profile-left -->
        <!-- begin profile-right -->
        <div class="profile-right">
            <!-- begin profile-info -->
            <div class="profile-info">
                <!-- begin table -->
                <div class="table-responsive">
                    <table class="table table-profile">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    <h4><?php echo ucwords($function_profile_administrator->cr_adminDisplayName) ?> <small><?php echo $function_profile_administrator->cr_adminPosition ?></small></h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td class="field">Username</td>
                                <td><?php echo $function_profile_administrator->cr_adminUsername; ?></td>
                            </tr>
                            <tr>
                                <td class="field">Email</td>
                                <td><a href="mailto:<?php echo $function_profile_administrator->cr_adminEmail; ?>"><?php echo $function_profile_administrator->cr_adminEmail; ?></a></td>
                            </tr>
                            <tr>
                                <td class="field">Level</td>
                                <td>
                                    <?php
                                        if($function_profile_administrator->cr_adminLevel == 1)
                                            echo "Administrator";
                                        elseif($function_profile_administrator->cr_adminLevel == 2)
                                            echo "Editor";
                                        ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="field">About You</td>
                                <td>
                                    <?php
                                        if($function_profile_administrator->cr_adminAbout == '' || empty($function_profile_administrator->cr_adminAbout))
                                            echo 'Nothing about you.';
                                        else
                                            echo $function_profile_administrator->cr_adminAbout;
                                    ?>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr class="">
                                <td class="field">Facebook</td>
                                <td>
                                    <?php 
                                        if($function_profile_administrator->cr_adminFacebook == '')
                                            echo '-';
                                        else {
                                    ?>
                                    <a href="<?php echo $function_profile_administrator->cr_adminFacebook; ?>" target="_blank"><?php echo $function_profile_administrator->cr_adminFacebook; ?></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="field">Google+</td>
                                <td>
                                    <?php 
                                        if($function_profile_administrator->cr_adminGoogleplus == '')
                                            echo '-';
                                        else {
                                    ?>
                                    <a href="<?php echo $function_profile_administrator->cr_adminGoogleplus; ?>" target="_blank"><?php echo $function_profile_administrator->cr_adminGoogleplus; ?></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="field">Twitter</td>
                                <td>
                                    <?php 
                                        if($function_profile_administrator->cr_adminTwitter == '')
                                            echo '-';
                                        else {
                                    ?>
                                    <a href="<?php echo $function_profile_administrator->cr_adminTwitter; ?>" target="_blank"><?php echo $function_profile_administrator->cr_adminTwitter; ?></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                                        
                        </tbody>
                    </table>
                </div>
                <!-- end table -->
            </div>
            <!-- end profile-info -->
        </div>
        <!-- end profile-right -->
    </div>
    <!-- end profile-section -->
</div>
<!-- end profile-container -->