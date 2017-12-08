<?php

//if(isset($_SESSION['FullName'])){
	include_once "/conn.mysql.php";
	include ("vendor/autoload.php");
	use ElephantIO\Client;
	use ElephantIO\Engine\SocketIO\Version2X;
	$version = new Version2x("http://localhost:3001");
	$client = new Client($version);
	
	
	function getAllProcess() {
		$stmt = $pdo->prepare("SELECT 

								Parent.process_id
								,Parent.name
								,Child_Type.Description
								,Parent.publicIp
								,Child_Status.Description
								,Child_Logs.Start_Time
								,Child_Logs.End_Time
								,Child_Logs.End_Time
								,Child_Status.Description
								
								
						FROM process Parent
						left outer join logs Child_Logs
							on Parent.process_id = Child_Logs.ProcessId
						left outer join status Child_Status
							on Child_Status.StatusId = Parent.StatusId
						left outer join type Child_Type
							on Child_Type.TypeId = Parent.TypeId
						
						");
		$stmt->execute();
		//$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$results=$stmt->fetchAll(PDO::FETCH_NUM);
		$array = array(
			"data" => $results
		);
		
		
		$json = json_encode($array);
		echo($json);
	}
	$stmt = $pdo->prepare("SELECT 
								
								Parent.process_id
								,Parent.name
								,Child_Type.Description as 'Type'
								,Parent.publicIp
								,Parent.adress
								,Child_Status.Description as 'Status'
								,Child_Logs.Start_Time as 'StartTime'
								,Child_Logs.End_Time as 'EndTime'
								,Child_Logs.End_Time as 'Duration'
								
								
								
						FROM process Parent
						left outer join logs Child_Logs
							on Parent.process_id = Child_Logs.ProcessId
						left outer join status Child_Status
							on Child_Status.StatusId = Parent.StatusId
						left outer join type Child_Type
							on Child_Type.TypeId = Parent.TypeId
						LIMIT 1
						");
		$stmt->execute();
		$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		//$results=$stmt->fetchAll(PDO::FETCH_NUM);
		$array = array(
			"data" => $results
		);
		
		
		$json = json_encode($array);
		echo($json);
	
	
	

//}

?>