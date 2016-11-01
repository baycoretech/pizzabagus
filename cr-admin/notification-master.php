<?php
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data

	$cradminID_session = $_GET['admin'];

	$o_getMail        = new mail($pdo);
    $v_getTotalUnread = $o_getMail->countInboxUnread($cradminID_session);
    $o_getMessage     = new message($pdo);
    $v_countMessage   = $o_getMessage->countInboxUnread();

    $v_AllMessage     = $o_getMessage->viewAllMessageInbox($cradminID_session);
    $total = $v_countMessage+$v_getTotalUnread;

    echo '<li class="dropdown-header">';
    if($total==0) {
        echo "There is no notification";
    }
    else {
        echo 'Notifications (<span>'.$total.'</span>)';
    }
    echo '</li>';
    
    foreach ($v_AllMessage as $data) {
        $tanggal = date('d F Y H:i',strtotime($data->tanggal)); 
?>
    <li class="media">
        <a href="<?php
            if($data->tipe=='inbox') {
                echo MADMINURL."/inbox/".$data->idpesan;
            }
            elseif($data->tipe=='message') {
                echo MADMINURL."/message/".$data->idpesan;
            }
        ?>">
            <div class="media-left"><img src="<?php 
                if($data->tipe=="message") {
                    echo MADMINURL."/assets/img/no-pic.png"; 
                }
                elseif($data->tipe=="inbox") {
                    $getAdminPhoto = $o_getMessage->getPhoto($data->idpesan);
                    if($getAdminPhoto=="" || empty($getAdminPhoto)) 
                        echo MADMINURL."/assets/img/no-pic.png"; 
                    else 
                        echo MADMINURL.$getAdminPhoto; 
                } ?>" class="media-object" alt="" />
            </div>
            <div class="media-body">
                <h6 class="media-heading"><?php echo addCaps($data->messagename) ?></h6>
                    <p>
                        <?php
                            $content    = strip_tags($data->content);
                            $subcontent = strlen($content);
                            if($subcontent<=35) {
                                echo $content;
                            }
                            else {
                                echo substr($content,0,35)."..."; 
                            }
                        ?>
                    </p>
                    <div class="text-muted"><?php echo $tanggal ?></div>
                </div>
        </a>
    </li>
<?php
    }
?>
    <li class="dropdown-footer text-center">
        <?php
            if($total==0) {
                echo "&nbsp;";
            }
            else {
        ?>
        <a href="<?php echo MADMINURL."/inbox" ?>">View more</a>
        <?php
            }
        ?>
    </li>