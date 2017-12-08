<?php

	/* Tycoon */
	$MySQL_Host = "localhost";
	$MySQL_ID = "root";
	$MySQL_PW = "";
	$MySQL_DB = "monitoringapps";

	$host = 'localhost';
	$db   = 'monitoringapp';
	$user = 'root';
	$pass = '';
	$charset = 'utf8mb4';

	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	$opt = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];
	$pdo = new PDO($dsn, $user, $pass, $opt);
	
	try {
		//$dbh = new PDO("mysql:host=$hostname;dbname=mysql", $username, $password);
		//echo "Connected to database"; // check for connection
	} catch (PDOException $e) {
		echo $e -> getMessage();
	}
	

?>
