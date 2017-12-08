<?php

	if(isset($_POST['email']) && isset($_POST['password'])){

	include_once "\conn.mysql.php";

	$username = $_POST['email'];
	$password = $_POST['password'];

	$stmt = $pdo->prepare("SELECT emailAddress, password,firstname,lastname FROM accounts where emailAddress = ? and password = ? LIMIT 1");
		
	$stmt->execute(array($username, $password));
	$row = $stmt->fetch();

	if($stmt->rowCount() > 0){
		session_start();
		$_SESSION['FullName'] = $row['lastname'] . ", " . $row['firstname'];
		header("location: dashboard.php");
	}



	}else{
	
		
		header("location: signout.php");
		exit();

	}



?>