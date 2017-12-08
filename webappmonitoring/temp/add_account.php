<?php

//if(isset($_SESSION['FullName'])){
	include_once "/conn.mysql.php";
	include ("vendor/autoload.php");
	use ElephantIO\Client;
	use ElephantIO\Engine\SocketIO\Version2X;
	$version = new Version2x("http://localhost:3001");
	$client = new Client($version);
	
	$Email = $_POST['Email'];
	$Fname = $_POST['Fname'];
	$Lname = $_POST['Lname'];
	$Role = $_POST['Role'];
	$Company = $_POST['Company'];
	$statusId = '2';
	
	$pdo->beginTransaction();
	$response;
	
	try{
	
		$stmt = $pdo->prepare("Insert into accounts (emailAddress, firstname, lastname, roleId, companyId, status) values (?,?,?,?,?,?)");
		$array = array($Email, $Fname,$Lname,$Role,$Company,$statusId);
		$stmt->execute($array);
		
		$pdo->commit();
		
		$response = 'Success';
		
		$client->initialize();
		$client->emit('NewAccount', $array);
		$client->close();
		
	}catch(Exception $e){
	
		
		$response = $e->getMessage();
		$pdo->rollBack();
		
	}
	
	$json = json_encode($response);
	echo($json);

//}

?>