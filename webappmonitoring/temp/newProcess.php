<?php
	include_once "/conn.mysql.php";
	include ("vendor/autoload.php");
	use ElephantIO\Client;
	use ElephantIO\Engine\SocketIO\Version2X;
	$version = new Version2x("http://localhost:3001");
	$client = new Client($version);
	
	
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
	
	
	
	try{
		$client->initialize();
		$client->emit('NewProcess', $array);
		$client->close();
		echo 'success <br>';
		print_r($array);
	}
	catch (ServerConnectionFailureException $e)
	{
		echo 'Server Connection Failure!!';
	}

?>