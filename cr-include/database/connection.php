<?php
	try {
	  $file_connection = __DIR__.'/database.php';
	  $read_line       = fopen($file_connection, 'r');
	  $explode_line    = explode(',', fgets($read_line));

	  $database_name     = $explode_line[0];
	  $database_username = $explode_line[1];
	  $database_password = $explode_line[2];

	  fclose($read_line);

	  $pdo = new PDO("mysql:host=localhost;dbname=$database_name;charset=UTF8", "$database_username", "$database_password");
	  // set error mode
	  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch (PDOException $e) {
	  print "Connection problem : " . $e->getMessage() . "<br/>";
	  die();
	}
?>