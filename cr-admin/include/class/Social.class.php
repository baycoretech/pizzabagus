<?php
/**
 * Class Social
 *
 * @author baycore
 */

class Social {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_social() {
    	$result = $this->pdo->query("SELECT * FROM cr_social ORDER BY cr_socialOrder asc");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function edit_social() {
    	$result = $this->pdo->query("SELECT * FROM cr_social order by cr_socialID asc");
    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    $data[]=$rows;
		return $data;
    }
    public function update_social_link($facebook, $twitter, $instagram, $tumblr, $pinterest, $youtube, $behance, $dribbble, $github, $soundcloud, $skype, $googleplus) {

	    $result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'facebook'");	
	    $result->bindParam(1, $facebook);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'twitter'");	
	    $result->bindParam(1, $twitter);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'instagram'");	
	    $result->bindParam(1, $instagram);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'tumblr'");	
	    $result->bindParam(1, $tumblr);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'pinterest'");	
	    $result->bindParam(1, $pinterest);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'youtube'");	
	    $result->bindParam(1, $youtube);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'behance'");	
	    $result->bindParam(1, $behance);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'dribbble'");	
	    $result->bindParam(1, $dribbble);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'github'");	
	    $result->bindParam(1, $github);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'soundcloud'");	
	    $result->bindParam(1, $soundcloud);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'skype'");	
	    $result->bindParam(1, $skype);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'google-plus'");	
	    $result->bindParam(1, $googleplus);
		$result->execute();
		return true;
    }
    public function remove_social_link() {
    	$empty  = NULL;
	    $result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'facebook'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'twitter'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'instagram'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'tumblr'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'pinterest'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'youtube'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'behance'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'dribbble'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'github'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'soundcloud'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'skype'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'google-plus'");	
	    $result->bindParam(1, $empty);
		$result->execute();
		return true;
    }
    public function reorder_social($id_array) {
    	$count = 1;
    	foreach ($id_array as $id){
			$update = $this->pdo->query("UPDATE cr_social SET cr_socialOrder = $count WHERE cr_socialID = '$id'");
			$count ++;	
		}
		return true;
    }
    public function view_instafeed_user_id() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'instafeeduserid'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
		return $row;
    }
    public function view_instafeed_access_token() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'instafeedaccesstoken'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
		return $row;
    }
    public function update_instafeed($userid, $accesstoken, $admin_login_id, $now_date) {
	    $insta_userid = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue      = ? 
	    		WHERE cr_settingName = 'instafeeduserid'");	
	    $insta_userid->bindParam(1, $userid);

		$insta_accesstoken = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue      = ? 
	    		WHERE cr_settingName = 'instafeedaccesstoken'");	
	    $insta_accesstoken->bindParam(1, $accesstoken);
		
		if($insta_userid->execute() && $insta_accesstoken->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update Instafeed User ID and Token', ?, ?, ?)");
			$history_detail = " change user ID and access token for your Instafeed.";
			$get_history->bindParam(1, $history_detail);
			$get_history->bindParam(2, $now_date);
			$get_history->bindParam(3, $admin_login_id);
			$get_history->execute();
			return true;
		}
		else {
			return false;
		}
    }
}
?>