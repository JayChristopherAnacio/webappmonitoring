<?php

//if(isset($_SESSION['FullName'])){
	include_once "/conn.mysql.php";

	
	$stmt = $pdo->prepare("SELECT 

								TypeId
								,Description

								
						FROM type
						");
	$stmt->execute();
	$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
	
	
	$json = json_encode($results);
	echo($json);
	
	

//}

?>