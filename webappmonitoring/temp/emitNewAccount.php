<?php

//if(isset($_SESSION['FullName'])){
	include_once "/conn.mysql.php";
	include ("vendor/autoload.php");
	use ElephantIO\Client;
	use ElephantIO\Engine\SocketIO\Version2X;
	$version = new Version2x("http://localhost:3000");
	$client = new Client($version);
	
	$array = array("Volvo", "BMW", "Toyota");
	$client->initialize();
	$client->emit('NewAccount', $array);
	$client->close();