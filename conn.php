<?php
	$host = 'localhost';
	$login = 'root';
	$pass = '';
	$db = 'pollub';
	
	/*
	$host = 'mysql.cba.pl';
	$login = 'thekolin';
	$pass = 'Nj6Csv!pUjXr88S';
	$db = 'thekolin';
	*/
	
	$conn = mysqli_connect($host, $login, $pass, $db);
	if(!$conn){
		echo "Błąd ".mysqli_connect_errno();
		exit();
	}else{
		mysqli_set_charset($conn, 'utf8');
	}
?>