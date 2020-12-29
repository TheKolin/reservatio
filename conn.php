<?php
	$host = 'localhost';
	$login = 'root';
	$pass = '';
	$db = 'pollub';
	
	error_reporting(0);
	$conn = mysqli_connect($host, $login, $pass, $db);
	if(!$conn){
		echo "Błąd ".mysqli_connect_errno();
		exit();
	}else{
		mysqli_set_charset($conn, 'utf8');
	}
?>