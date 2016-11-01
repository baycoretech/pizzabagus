<?php
/**
 * Global Function
 *
 * @author baycore
 */

$o_get_global_function = new General_Setting($pdo);
$v_get_site_url        = $o_get_global_function->site_url();
$v_get_folder_name     = $o_get_global_function->folder_name();

if($v_get_folder_name == '0') {
	define('MURL', $v_get_site_url.'/');
	define('MADMINURL', $v_get_site_url.'/cr-admin/');
	define('ABSPATH', '/');
	define('ABSPATHADMIN', '/cr-admin/');
	$master_url       = $v_get_site_url.'/';
	$master_admin_url = $v_get_site_url.'/cr-admin/';
	$abs_path         = ABSPATH;
	$abs_path_admin   = ABSPATHADMIN;
}
else {
	define('MURL', $v_get_site_url . '/' . $v_get_folder_name.'/');
	define('MADMINURL', $v_get_site_url . '/' . $v_get_folder_name .'/cr-admin/');
	define('ABSPATH', '/' .$v_get_folder_name.'/');
	define('ABSPATHADMIN', '/' .$v_get_folder_name .'/cr-admin/');
	$master_url       = $v_get_site_url . '/' . $v_get_folder_name.'/';
	$master_admin_url = $v_get_site_url . '/' . $v_get_folder_name .'/cr-admin/';
	$abs_path         = ABSPATH;
	$abs_path_admin   = ABSPATHADMIN;
}
function only_date($date) {
	return date('d F Y', strtotime($date));
}
function only_time($date) {
	return date('H:i', strtotime($date));
}
function full_date($date) {
	return date('d F Y H:i', strtotime($date));
}
function create_slug($string){     
    $replace = '-';         
    $string  = strtolower($string);     
    //replace / and . with white space     
    $string  = preg_replace("/[\/\.]/", " ", $string);     
    $string  = preg_replace("/[^a-z0-9_\s-]/", "", $string);     
    //remove multiple dashes or whitespaces     
    $string  = preg_replace("/[\s-]+/", " ", $string);     
    //convert whitespaces and underscore to $replace     
    $string  = preg_replace("/[\s_]/", $replace, $string);       
    //slug is generated     
    return $string; 
} 
function hash_password($password) {
    // Use PHPass's portable hashes with a cost of 10.
    $phpass = new Password_Hash(10, true);
    return $phpass->HashPassword($password);
}
function timing_safe_compare($known, $unknown) {
    // Prevent issues if string length is 0
    $known .= chr(0);
    $unknown .= chr(0);

    $knownLength = strlen($known);
    $unknownLength = strlen($unknown);

    // Set the result to the difference between the lengths
    $result = $knownLength - $unknownLength;

    // Note that we ALWAYS iterate over the user-supplied length to prevent leaking length info.
    for ($i = 0; $i < $unknownLength; $i++) {
        // Using % here is a trick to prevent notices. It's safe, since if the lengths are different, $result is already non-0
        $result |= (ord($known[$i % $knownLength]) ^ ord($unknown[$i]));
    }

    // They are only identical strings if $result is exactly 0...
    return $result === 0;
}
function verify_password($password, $hash) {
    $rehash = false;
    $match = false;

    // If we are using phpass
    if (strpos($hash, '$P$') === 0) {
        // Use PHPass's portable hashes with a cost of 10.
        $phpass = new Password_Hash(10, true);

        $match = $phpass->CheckPassword($password, $hash);

        $rehash = false;
    }
    else {
        // Check the password
        $parts = explode(':', $hash);
        $crypt = $parts[0];
        $salt  = @$parts[1];

        $rehash = true;

        $testcrypt = md5($password . $salt) . ($salt ? ':' . $salt : '');

        $match = timing_safe_compare($hash, $testcrypt);
    }
    return $match;
}
function add_caps($string) {
	return ucwords($string);
}
function short_description($desc, $long) {
	$desc    = strip_tags($desc);
    $subdesc = strlen($desc);
    if($subdesc <= $long) {
        echo $desc;
    }
    else {
        echo substr($desc,0,$long)."..."; 
    }
}
function format_rupiah($price) {
	$price_format = 'Rp. '.number_format($price,2,',','.');
	return $price_format;
}
function format_idr($price) {
	$price_format = 'IDR '.number_format($price,0,'','.');
	return $price_format;
}
function get_real_ip() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	    $ip=$_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
	    $ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}	
function get_visitor_browser() { 
    $u_agent  = $_SERVER['HTTP_USER_AGENT']; 
    $bname    = 'Unknown';
    $platform = 'Unknown';
    $version  = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'Linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'Mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'Windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 

    // finally get the correct version number
    $known   = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)) {
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    // check if we have a number
    if ($version == NULL || $version=="") {$version="?";}
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'   => $pattern
    );
} 
function sms_gateway_send_sms($username, $password, $message, $mobile) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.gosmsgateway.net/api/Send.php?username=$username&mobile=$mobile&message=$message&password=$password",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}
function sms_gateway_account_balance($username, $password) {
    $auth = md5($username.$password);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.gosmsgateway.net/api/creditsLeft.php?username=$username&auth=$auth",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}
?>