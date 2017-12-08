<?php

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	include_once "/conn.mysql.php";

	
	$stmt = $pdo->prepare("SELECT 
								userId
								,emailAddress
								,firstname
								,lastname
								,Parent.dateAdded
								,status
								,Child_Roles.description as 'role'
								,Child_Company.description  'company'
								
						FROM accounts Parent
								
								
						left outer join roles Child_Roles
							on Parent.roleId = Child_Roles.roleId
						left outer join companies Child_Company
							on Parent.companyId = Child_Company.companyId
						");
	$stmt->execute();
	$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
	
	
	$array = array(
		"data" => $results
	);

	$json = json_encode($array);
	echo($json);
	
	

}

?>