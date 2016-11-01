<?php
/**
 * Global Function
 *
 * @author baycore
 */

$class_general_setting       = new General_Setting($pdo);
$function_site_url           = $class_general_setting->site_url();
$function_folder_name        = $class_general_setting->folder_name();
$function_user_page          = $class_general_setting->user_page();
$function_total_created_page = $class_general_setting->total_created_page();

if($function_folder_name == '0') {
	define('MURL', $function_site_url.'/');
	define('MADMINURL', $function_site_url.'/cr-admin/');
	define('ABSPATH', '/');
	define('ABSPATHADMIN', '/cr-admin/');
	$master_url       = $function_site_url.'/';
	$master_admin_url = $function_site_url.'/cr-admin/';
	$abs_path         = ABSPATH;
	$abs_path_admin   = ABSPATHADMIN;
}
else {
	define('MURL', $function_site_url . '/' . $function_folder_name.'/');
	define('MADMINURL', $function_site_url . '/' . $function_folder_name .'/cr-admin/');
	define('ABSPATH', '/' .$function_folder_name.'/');
	define('ABSPATHADMIN', '/' .$function_folder_name .'/cr-admin/');
	$master_url       = $function_site_url . '/' . $function_folder_name.'/';
	$master_admin_url = $function_site_url . '/' . $function_folder_name .'/cr-admin/';
	$abs_path         = ABSPATH;
	$abs_path_admin   = ABSPATHADMIN;
}

function creatify_package($userplan, $size) {
	if($userplan == 'basic') {
		if($size >= 523239424) {
			return 'forbidden';
		}
		else {
			return 'allow';
		}
	}
	elseif($userplan == 'premium' || $userplan == 'probasic' || $userplan == 'propro' || $userplan == 'prosuper') {
		return 'allow';
	}
	else {
		return 'forbidden';
	}
}

function creatify_package_page($userplan) {
	if($userplan == 'basic' || $userplan == 'premium') {
		if($function_total_created_page == $function_user_page) {
			return 'forbidden';
		}
		else {
			return 'allow';
		}
	}
	elseif($userplan == 'probasic' || $userplan == 'propro' || $userplan == 'prosuper') {
		return 'allow';
	}
	else {
		return 'forbidden';
	}
}

function generate_timezone_list() {
	static $regions = array(
	  	DateTimeZone::AFRICA,
	    DateTimeZone::AMERICA,
	    DateTimeZone::ANTARCTICA,
	    DateTimeZone::ASIA,
	    DateTimeZone::ATLANTIC,
	    DateTimeZone::AUSTRALIA,
	    DateTimeZone::EUROPE,
	    DateTimeZone::INDIAN,
	    DateTimeZone::PACIFIC,
	);
	$timezones = array();
	foreach($regions as $region) {
	    $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
	}
	$timezone_offsets = array();
	foreach($timezones as $timezone){
	    $tz = new DateTimeZone($timezone);
	    $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
	}
	//Sort timezone by offset
	asort($timezone_offsets);
	$timezone_list = array();
	foreach($timezone_offsets as $timezone => $offset) {
	    $offset_prefix = $offset < 0 ? '-' : '+';
	    $offset_formatted = gmdate( 'H:i', abs($offset) );
	    $pretty_offset = "UTC${offset_prefix}${offset_formatted}";
	    $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
	}
	return $timezone_list;
}
function read_list_files($path) {
    $ffs = scandir($path);
    echo '<ul>';
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..') {
        	if(is_dir($path.'/'.$ff))
            	echo "<li>".$ff;
            else
            	echo "<li data-jstree='{ \"icon\" : \"fa fa-file-code-o fa-lg\" }'>".$ff;
            if(is_dir($path.'/'.$ff)) read_list_files($path.'/'.$ff);
            echo '</li>';
        }
    }
    echo '</ul>';
}
function get_directory_size($path){
	$bytestotal = 0;
	$path = realpath($path);
	if($path!==false){
	    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path,FilesystemIterator::SKIP_DOTS)) as $object){
	        $bytestotal += $object->getSize();
	    }
	}
	return $bytestotal;
	//return 5000000;
}
function format_bytes($bytes, $precision = 2) { 
	$units = array('B', 'KB', 'MB', 'GB', 'TB'); 
	$bytes = max($bytes, 0); 
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	$pow = min($pow, count($units) - 1); 
	$bytes /= pow(1024, $pow);
	return round($bytes, $precision) . ' ' . $units[$pow]; 
}
function generate_hash($password) {
	if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
	    $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
	    return crypt($password, $salt);
	}
}
/* Customer Only */
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
function format_rupiah($price) {
	$price_format = 'Rp. '.number_format($price,2,',','.');
	return $price_format;
}
function format_idr($price) {
	$price_format = 'IDR '.number_format($price,0,'','.');
	return $price_format;
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
function create_slug($string){     
    $replace = '-';         
    $string = strtolower($string);     
    //replace / and . with white space     
    $string = preg_replace("/[\/\.]/", " ", $string);     
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);     
    //remove multiple dashes or whitespaces     
    $string = preg_replace("/[\s-]+/", " ", $string);     
    //convert whitespaces and underscore to $replace     
    $string = preg_replace("/[\s_]/", $replace, $string);       
    //slug is generated     
    return $string; 
} 
?>