<?php
/**
 * Class Database
 *
 * @author baycore
 */
 
class Get_Database {
    public function get_db() {
		$array_file    = file(__DIR__.'/../database/database.php');
		$array_line    = $array_file[0];
		$explode_line  = explode(',', $array_line);
		$database_name = $explode_line[0];
		return $database_name;
	}

	public function get_db_info() {
	    $array_file        = file(__DIR__.'/../database/database.php');
	    $array_line        = $array_file[0];
		$explode_line      = explode(',', $array_line);
		$database_name     = $explode_line[0];
		$database_username = $explode_line[1];

		if(empty($database_name) && empty($database_username)) {
			return false;
		}
		else {
			return true;
		}
	}
}
?>