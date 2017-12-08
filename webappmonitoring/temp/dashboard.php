<?php
//include_once "\conn.mysql.php";
//session_start();



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> Application Monitoring</title>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/metisMenu.min.css" rel="stylesheet">

</head>

<body>
	
    

       
			 <!-- Navigation -->
			<div class="navbar navbar-inverse navbar-fixed-left">
			  <a class="navbar-brand text-center center-block" href="#">
				LOGO HERE
			  </a>
			  
			  <ul class="nav navbar-nav">

			   
				<li>

					<div class="top-line">
						<hr>
					</div>
					
					<a href="Dashboard.php">
						<i class="glyphicon glyphicon-menu-hamburger"></i> 
						Dashboard
					</a>
				</li>
				

				<li>
					<a href="Settings.php">
						<i class="glyphicon glyphicon-cog"></i> 
						Settings
					</a>
					
					<div class="buttom-line">
						<hr>
					</div>
				</li>
			  
			  </ul>
			
			</div>
			
			<div class = 'col-md-2'></div>
			
			<div class="col-md-10">
			
				
					<div class="row">
						
						<div class="col-md-12">
							<h1 class="text-info">DASHBOARD</h1>
						</div>
						
						
						<div class="col-md-10">
							<div class="input-group search">
								<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
								<input id="search" type="text" class="form-control " name="search" data-bind="textInput: filter" placeholder="Search"/>
							</div>
						</div>
						
						<div class="col-md-2">
							<button type="button" class="btn btn-info">Search</button>
						</div>
						
					</div>
					
					<br>
					<div class="row">
						
						
						<div class="col-lg-12">

							
								<table id="process_tbl" class="table table-condensed table-responsive borderless">
									<thead class="table-head">
										<tr>
											<th data-bind="visible:display()">ID 	
													<span class="dropdown pull-right">
														<span class="caret pull right"></span>
													</span>
													
											</th>
											
											<th>Name<span class="dropdown pull-right">
														<span class="caret pull right"></span>
													</span>
													<div class="vl"></div>
											</th>
											<th>Type<span class="dropdown pull-right">
														<span class="caret pull right"></span>
													</span>
											</th>
											<th data-bind="visible:display()">Address<span class="dropdown pull-right">
														<span class="caret pull right"></span>
													</span>
											</th>
											<th>Public IP	<span class="dropdown pull-right">
																<span class="caret pull right"></span>
															</span>
											</th>
											<th>Status		<span class="dropdown pull-right">
																<span class="caret pull right"></span>
															</span>
											
											</th>
											<th>Last Run	<span class="dropdown pull-right">
																<span class="caret pull right"></span>
															</span>
											</th>
											<th>AVG Duration<span class="dropdown pull-right">
																<span class="caret pull right"></span>
															</span>
											</th>
											<th>Duration	<span class="dropdown pull-right">
																<span class="caret pull right"></span>
															</span>
											</th>
										</tr>
									</thead>
									<tbody data-bind="foreach: DisplayProcess">
										<tr  data-bind = "attr: { class: IsSelected}">
											<td data-bind="text: Id, visible:display()"></td>
											<td data-bind="text: Name,click:rowClick" class="cursor"></td>
											
											<td data-bind="text: Type"></td>
											
											<td data-bind="text: Address, visible:display()"></td>
											<td data-bind="text: PublicIp"></td>
											<td>
											
												<button type="button" data-bind = "attr: { class: StatusClassBtn}"> </button> <span  data-bind="text:StatusLabel"></span>
											
											</td>
											
											<td data-bind="text: LastRun"></td>
											
											<td data-bind="text: AvgDuration"></td>
											<td data-bind="text: Duration"></td>
										</tr>
									</tbody>
								</table>
							
							
								<table id="logs" data-bind = "visible:displayLogs().length > 0 " class="table borderless table-condensed table-responsive">
									<thead data-bind = "visible:display()" class="table-head">
										<tr style="text-align:center">
											<th> 	
											</th>
											<th> 	
											</th>
										</tr>
									</thead>
									<tbody data-bind="foreach: displayLogs">
										<tr style="text-align:center">
											<td class="logsDate" data-bind="text: EndTime"></td>
											<td class="logsDescription" data-bind="text: LogDescription"></td>
										</tr>
									</tbody>
								
								</table>
							

				

						</div>
					</div>
				
			
			</div>
			
			
    

   



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js" </script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.2/knockout-min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    
    


	<script src="js/knockout-2.2.1.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/Main.js"></script>
	<script src="js/objs.js"></script>
	<script src="js/Dashboard - viewModel.js"></script>

    <script>
		$(document).ready(function() {
		
			
			
			//DATATABLE=========================================================================
            var table = $('#process_tbl1').DataTable({
				responsive: true,
						"ajax" : "Curl_Process.php",
						"type": "GET",
						"columns": [
							{ "data":"id" },
							{ "data":"name" },
							{ "data":"type" },
							{ "data":"url" },
							{ "data":"public_ip" },
							{ "data":"status" },
							{ "data":"start_time" },
							{ "data":"end_time" },
							{ "data":"log_description" }
						],
					
				
            });

            table.buttons().container()
                //.appendTo( '#process_tbl_wrapper .col-sm-6:eq(0)' );
                .appendTo('#process_tbl_wrapper #process_tbl_filter:eq(0)');
			
			
			//MVVM JS KO========================================================================
			window.viewModel = new window.DashboardVm();
			ko.applyBindings(window.viewModel);
			
			var data = '';
			var url = 'Curl_Process.php'
			window.viewModel.getProcess(url,data);
			
			function fetchData() {

				// your function code here
				window.viewModel.updateProcess(url,data);
				setTimeout(fetchData, 5000);
				
			}

			fetchData();

        });
    </script>

</body>

</html>