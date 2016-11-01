<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 

	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//global function

	$o_getJumbotron = new jumbotron($pdo);
	$caption         = $_POST['caption'];
    $desc            = $_POST['desc'];
    $btext           = $_POST['btext'];
    $blink           = $_POST['blink'];
    $textposition    = $_POST['textposition'];
    $matchcs         = $_POST['matchcs'];
    $adminLoginID    = $_POST['adminLoginID'];

    if(strlen($caption)<2) {
		echo "caption-short";
	}
    elseif(strlen($caption)>100) {
		echo "caption-long";
	}
	elseif(strlen($desc)<2) {
		echo "desc-short";
	}
	elseif(strlen($btext)>50) {
		echo "btext-long";
	}
	elseif(strlen($blink)>255) {
		echo "blink-long";
	}
	elseif(empty($textposition)) {
		echo "no-tp";
	}
	elseif(empty($matchcs)) {
		echo "no-cs";
	}
	elseif(strlen($blink)>0 && filter_var($blink, FILTER_VALIDATE_URL) === false) {
		echo "invalid-url";
	}
	else {
    	$v_getUpdatePLjumbotron = $o_getJumbotron->updatePlainjumbotron($caption, $desc, $btext, $blink, $textposition, $matchcs, $adminLoginID);
    	echo "success";
    	
    }
?>