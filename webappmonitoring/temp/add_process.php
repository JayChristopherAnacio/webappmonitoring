<?php

//if(isset($_SESSION['FullName'])){
	include_once "/conn.mysql.php";
	include ("vendor/autoload.php");
	use ElephantIO\Client;
	use ElephantIO\Engine\SocketIO\Version2X;
	$version = new Version2x("http://localhost:3001");
	$client = new Client($version);
	
	
	$name = $_POST['ProcessName'];
	$publicIp = $_POST['IPaddress'];
	$address = $_POST['Adress'];
	$typeId = $_POST['ProcessType'];
	$statusId = '2';
	//We start our transaction.
	$pdo->beginTransaction();
	$response;
	
	try{
	
		$stmt = $pdo->prepare("Insert into process (name, publicIp, adress, TypeId, StatusId) values (?,?,?,?,?)");
		$stmt->execute(array($name, $publicIp,$address,$typeId,$statusId));
		
		$pdo->commit();
		
		$response = 'Success';
		
		
	}catch(Exception $e){
	
		
		$response = $e->getMessage();
		$pdo->rollBack();
		
	}
	
	$json = json_encode($response);
	echo($json);

//}

?>