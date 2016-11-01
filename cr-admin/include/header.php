<?php
	$o_getMail        = new mail($pdo);
    $v_getTotalUnread = $o_getMail->countInboxUnread($cradminID_session);
    $o_getMessage     = new message($pdo);
    $v_countMessage   = $o_getMessage->countInboxUnread();
    $v_AllMessage     = $o_getMessage->viewAllMessageInbox($cradminID_session);
    $total = $v_countMessage+$v_getTotalUnread;
?>
<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="<?php echo MADMINURL; ?>/dashboard" class="navbar-brand"><img src="<?php echo MADMINURL; ?>/assets/img/logo-creatify.png" height="35"></a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo MURL ?>" class="btn f-s-14" target="_blank"><i class="fa fa-globe"></i> View Website</a>
                    </li>
					<li class="dropdown">
						<a id="totalnotif1" href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">

						</a>
						<ul id="notification-master" class="dropdown-menu media-list pull-right animated fadeInDown">
                            <li id="totalnotif2" class="dropdown-header"></li>
                            <?php
                            	foreach ($v_AllMessage as $data) {
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
                                    	} ?>" class="media-object" alt="" /></div>
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
                                        <div class="text-muted" data-livestamp="<?php echo $data->tanggal ?>"></div>
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
						</ul>
					</li>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php if($cradminPhoto=="") echo MADMINURL."/assets/img/no-pic.png"; else echo MADMINURL.$cradminPhoto; ?>" alt="" /> 
							<span class="hidden-xs"><?php echo addCaps($v_getAdminData->cr_adminDisplayName); ?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="<?php echo MADMINURL; ?>/profile">Profile</a></li>
							<li>
                                <a id="totalinboxdrop" href="<?php echo MADMINURL; ?>/inbox">
                                    
                                </a>
                            </li>
							<li><a href="<?php echo MADMINURL; ?>/history">History</a></li>
                            <li><a href="<?php echo MADMINURL; ?>/settings">Setting</a></li>
							<li><a role="button" data-target="#about-creatify-modal" data-toggle="modal">About Creatify</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo MADMINURL; ?>/logout.php">Log Out</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
</div>