<?php

//if(isset($_SESSION['FullName'])){
	include_once "/conn.mysql.php";

	
	$stmt = $pdo->prepare("SELECT 

								companyId
								,Description

								
						FROM companies
						");
	$stmt->execute();
	$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
	$array = array(
		"data" => $results
	);
	
	
	$json = json_encode($array);
	echo($json);
	
	

//}

?>