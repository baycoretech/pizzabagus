<?php
/**
 * Class Administrator
 *
 * @author baycore
 */

class Administrator {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function login_administrator($username) {
     	$result = $this->pdo->prepare("SELECT * FROM cr_admin WHERE cr_adminUsername = ?");
	    $result->bindParam(1, $username);
	    if($result->execute()) {
		    $rows = $result->fetch(PDO::FETCH_OBJ);
		    return $rows;
		}
		else {
			return false;
		}
	}
    public function count_administrator() {
    	$result = $this->pdo->query("SELECT * FROM cr_admin ORDER BY cr_adminID asc");
    	$total  = $result->rowCount();
    	return $total;
    }
    public function view_administrator() {
    	$result = $this->pdo->query("SELECT * FROM cr_admin ORDER BY cr_adminID asc");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function profile_administrator($admin_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID = '$admin_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function add_administrator($username, $password, $email, $photo, $displayname, $level, $aboutyou, $fb, $gp, $tw, $admin_login_id, $now_date) {
    	$check_username = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminUsername = '$username' OR cr_adminDisplayName = '$displayname'");
    	$password_administrator = generate_hash($password);
    	if(($check_username->rowCount() < 1)) {
	    	$result = $this->pdo->prepare("INSERT INTO cr_admin(
			    		cr_adminUsername, cr_adminPassword, cr_adminEmail, cr_adminPhoto, cr_adminRegistered, cr_adminDisplayName, cr_adminLevel, cr_adminAbout, cr_adminFacebook, cr_adminGoogleplus, cr_adminTwitter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		    $result->bindParam(1, $username);
		    $result->bindParam(2, $password_administrator);
		    $result->bindParam(3, $email);
		    $result->bindParam(4, $photo);
		    $result->bindParam(5, $now_date);
		    $result->bindParam(6, $displayname);
		    $result->bindParam(7, $level);
		    $result->bindParam(8, $aboutyou);
		    $result->bindParam(9, $fb);
		    $result->bindParam(10, $gp);
		    $result->bindParam(11, $tw);
		    if($result->execute()) {
			    $get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Administrator', ?, ?, ?)");
			    if($level == 1) {
			    	$level_admin = "Administrator";
			    }
			    elseif($level==2) {
			    	$level_admin = "Editor";
			    }
			    $history_detail = " add ".ucwords($displayname)." as an ".$leveluser.".";
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
	    else {
	    	$same_name = 'same-name';
	    	return $same_name;
	    }
    }
    public function edit_administrator($admin_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID = '$admin_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function update_administrator($username, $password, $email, $photo, $displayname, $level, $aboutyou, $fb, $gp, $tw, $user_id, $admin_login_id, $now_date) {
    	$password_administrator = generate_hash($password);

    	$check_q = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID = '$admin_login_id'");
    	$check_f = $check_q->fetch(PDO::FETCH_OBJ);
    	$thumb   = $check_f->cr_adminPhoto;

    	if($thumb != $photo) {
	    	if(empty($password)) {
	    		$result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminEmail       = ?,
			    		cr_adminPhoto       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $email);
				$result->bindParam(3, $photo);
				$result->bindParam(4, $displayname);
				$result->bindParam(5, $level);
				$result->bindParam(6, $aboutyou);
				$result->bindParam(7, $fb);
				$result->bindParam(8, $gp);
				$result->bindParam(9, $tw);
				$result->bindParam(10, $user_id);
				if($result->execute()) {
					$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Administrator', ?, ?, ?)");
					$history_detail = " edit ".ucwords($displayname)."'s profile data.";
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
	    	else {
			    $result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminPassword    = ?,  
			    		cr_adminEmail       = ?,
			    		cr_adminPhoto       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $password_administrator);
				$result->bindParam(3, $email);
				$result->bindParam(4, $photo);
				$result->bindParam(5, $displayname);
				$result->bindParam(6, $level);
				$result->bindParam(7, $aboutyou);
				$result->bindParam(8, $fb);
				$result->bindParam(9, $gp);
				$result->bindParam(10, $tw);
				$result->bindParam(11, $user_id);
				if($result->execute()) {
					$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Administrator', ?, ?, ?)");
					$history_detail = " edit ".ucwords($displayname)."'s profile data.";
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
		else {
			if(empty($password)) {
				$result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminEmail       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $email);
				$result->bindParam(3, $displayname);
				$result->bindParam(4, $level);
				$result->bindParam(5, $aboutyou);
				$result->bindParam(6, $fb);
				$result->bindParam(7, $gp);
				$result->bindParam(8, $tw);
				$result->bindParam(9, $user_id);
				if($result->execute()) {
					$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Administrator', ?, ?, ?)");
					$history_detail = " edit ".ucwords($displayname)."'s profile data.";
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
			else {
				$result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminPassword    = ?,  
			    		cr_adminEmail       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $password_administrator);
				$result->bindParam(3, $email);
				$result->bindParam(4, $displayname);
				$result->bindParam(5, $level);
				$result->bindParam(6, $aboutyou);
				$result->bindParam(7, $fb);
				$result->bindParam(8, $gp);
				$result->bindParam(9, $tw);
				$result->bindParam(10, $user_id);
				if($result->execute()) {
					$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Administrator', ?, ?, ?)");
					$history_detail = " edit ".ucwords($displayname)."'s profile data.";
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
    }
    public function delete_administrator($admin_id, $admin_login_id, $now_date) {
    	$check   = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID = '$admin_id'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$name    = $check_f->cr_adminDisplayName;
    	$result  = $this->pdo->prepare("DELETE FROM cr_admin WHERE cr_adminID = ?");
    	$result->bindParam(1, $admin_id);
    	if($result->execute()) {
    		$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete User', ?, ?, ?)");
			$history_detail = " delete ".ucwords($name)." from users data.";
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
    public function update_profile($username, $password, $email, $photo, $displayname, $level, $aboutyou, $fb, $gp, $tw, $admin_login_id, $now_date) {
    	$password_administrator = generate_hash($password);

    	$check_q = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID = '$admin_login_id'");
    	$check_f = $check_q->fetch(PDO::FETCH_OBJ);
    	$thumb   = $check_f->cr_adminPhoto;

    	if($thumb != $photo) {
	    	if(empty($password)) {
	    		$result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminEmail       = ?,
			    		cr_adminPhoto       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $email);
				$result->bindParam(3, $photo);
				$result->bindParam(4, $displayname);
				$result->bindParam(5, $level);
				$result->bindParam(6, $aboutyou);
				$result->bindParam(7, $fb);
				$result->bindParam(8, $gp);
				$result->bindParam(9, $tw);
				$result->bindParam(10, $admin_login_id);
				if($result->execute()) {
					$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Administrator', ?, ?, ?)");
					$history_detail = " edit ".ucwords($displayname)."'s profile data.";
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
	    	else {
			    $result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminPassword    = ?,  
			    		cr_adminEmail       = ?,
			    		cr_adminPhoto       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $password_administrator);
				$result->bindParam(3, $email);
				$result->bindParam(4, $photo);
				$result->bindParam(5, $displayname);
				$result->bindParam(6, $level);
				$result->bindParam(7, $aboutyou);
				$result->bindParam(8, $fb);
				$result->bindParam(9, $gp);
				$result->bindParam(10, $tw);
				$result->bindParam(11, $admin_login_id);
				if($result->execute()) {
					$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Administrator', ?, ?, ?)");
					$history_detail = " edit ".ucwords($displayname)."'s profile data.";
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
		else {
			if(empty($password)) {
				$result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminEmail       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $email);
				$result->bindParam(3, $displayname);
				$result->bindParam(4, $level);
				$result->bindParam(5, $aboutyou);
				$result->bindParam(6, $fb);
				$result->bindParam(7, $gp);
				$result->bindParam(8, $tw);
				$result->bindParam(9, $admin_login_id);
				if($result->execute()) {
					$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Administrator', ?, ?, ?)");
					$history_detail = " edit ".ucwords($displayname)."'s profile data.";
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
			else {
				$result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminPassword    = ?,  
			    		cr_adminEmail       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $password_administrator);
				$result->bindParam(3, $email);
				$result->bindParam(4, $displayname);
				$result->bindParam(5, $level);
				$result->bindParam(6, $aboutyou);
				$result->bindParam(7, $fb);
				$result->bindParam(8, $gp);
				$result->bindParam(9, $tw);
				$result->bindParam(10, $admin_login_id);
				if($result->execute()) {
					$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Administrator', ?, ?, ?)");
					$history_detail = " edit ".ucwords($displayname)."'s profile data.";
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
    }
    public function set_last_login($admin_id, $now_date) {
    	$result = $this->pdo->prepare("UPDATE cr_admin SET 
		    		cr_adminLastlogin = ?  
		    		WHERE cr_adminID  = ?");
		$result->bindParam(1, $now_date);
		$result->bindParam(2, $admin_id);
		if($result->execute()) {
			return true;
    	}
    	else {
    		return false;
		}
    }
    public function check_forgot_password($email) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminEmail = '$email'");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
    		return true;
    	}
    }
    public function insert_token($email, $token) {
    	$result = $this->pdo->prepare("UPDATE cr_admin SET 
		    		cr_adminToken       = ?
		    		WHERE cr_adminEmail = ?");
		$result->bindParam(1, $token);
		$result->bindParam(2, $email);
		if($result->execute()) {
			return true;
    	}
    	else {
    		return false;
		}
    }
    public function verify_administrator($token) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminToken = '$token' LIMIT 1");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
    		$rows = $result->fetch(PDO::FETCH_OBJ);
		    return $rows;
    	}
    }
    public function change_password($email, $password) {
    	$token  = "";
    	$result = $this->pdo->prepare("UPDATE cr_admin SET 
		    		cr_adminPassword    = ?,
		    		cr_adminToken       = ?
		    		WHERE cr_adminEmail = ?");
		$result->bindParam(1, $password);
		$result->bindParam(2, $token);
		$result->bindParam(3, $email);
		if($result->execute()) {
			return true;
		}
		else {
			return false;
		}
    }
    public function get_username($email) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminEmail = '$email'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
		return $rows;
    }
}
?>