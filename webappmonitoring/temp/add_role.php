<?php

//if(isset($_SESSION['FullName'])){
	include_once "/conn.mysql.php";
	include ("vendor/autoload.php");
	use ElephantIO\Client;
	use ElephantIO\Engine\SocketIO\Version2X;
	$version = new Version2x("http://localhost:3001");
	$client = new Client($version);
	
	$Description = $_POST['Description'];

	
	$pdo->beginTransaction();
	$response;
	
	try{
	
		$stmt = $pdo->prepare("Insert into roles (description) values (?)");
		$array = array($Description);
		$stmt->execute($array);
		
		$pdo->commit();
		
		$response = 'Success';
		
		$client->initialize();
		$client->emit('NewRole', $array);
		$client->close();
		
	}catch(Exception $e){
	
		
		$response = $e->getMessage();
		$pdo->rollBack();
		
	}
	
	$json = json_encode($response);
	echo($json);

//}

?>