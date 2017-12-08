<?php
include_once "\conn.mysql.php";
session_start();


if(isset($_SESSION['FullName'])){

	
	
}else{

	header("location: login.php");
	
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> PROCESS MONITORING</title>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.bootstrap.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/metisMenu.min.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <?php 
			include "view_navigation.php"
		?>


        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">DASHBOARD</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
            <div class="row">
                
                
				<div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading ">
						<div class = "row">
						
							<div class = "col-md-6">
								<h4>Process</h4>
							</div>
							<div class = "col-md-6">
								<button id ="AddProcess-btn" type="button" class="pull-right btn btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
							</div>
						</div>
					
					</div>
                    <div class="panel-body">
						<div id="Notify-box" class="alert alert-success">
						  <strong>Success!</strong> <p id="message">Indicates a successful or positive action.</p>
						</div>
                        <table id="process_tbl" class="table table-bordered">
                            <thead>
                                <tr>
									<th>ID</th>
                                    <th>Process</th>
                                    <th>Type</th>
									<th>Adress</th>
                                    <th>Public IP</th>
                                    <th>Status</th>
                                    <th>Last Run</th>
                                    <th>AVG Duration</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>

                    </div>
                </div>

				</div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="PartialView_Process" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Process</h4>
                </div>
                <div class="modal-body">

                    <form id = "ProcessForm" class="form-vertical" role="form">

                        <div class="form-group">
                            <label for="ProcessName">Name:</label>
                            <input type="text" class="form-control" id="ProcessName" name="ProcessName"/>
                        </div>
						
						<div class="form-group">
                            <label for="IP">IP:</label>
                            <input type="text" class="form-control" id="IP" name="IPaddress"/>
                        </div>
						
						<div class="form-group">
								<label for="ProcessName">Address:</label>
								<input type="text" class="form-control" id="Address" name="Adress"/>
						</div>
						
                        <div class="form-group">
                            <label for="ProcessType">Type:</label>
                            
							
							<select data-bind = "
													
													options:TypeList,
													optionsText:'Description',
													optionsValue:'TypeId',
													optionsCaption: 'Choose...'
												"
							class="form-control" id="ProcessType" name="ProcessType"/>

							</select>
                        </div>
						
						
						
                        

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="AddProcess_btn" data-bind="click: AddProcess">Submit</button>
                </div>
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
    
    <script src="/socket.io/socket.io.js"></script>


	<script src="js/knockout-2.2.1.js"></script>
    <script src="js/metisMenu.min.js"></script>
    <script src="js/main.js"></script>
	<script src="js/objs.js"></script>
	<script src="js/Dashboard - viewModel.js"></script>

    <script>
		$(document).ready(function() {
		
			
			
			//DATATABLE=========================================================================
            var table = $('#process_tbl').DataTable({
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
			
			//SOCKET IO=========================================================================
			var socket = io.connect("http://localhost:3001");
			
			socket.on('NewProcess', function(data) {
				console.log(data,"data");
				table.ajax.reload();
			});
			
			//MVVM JS KO========================================================================
			window.viewModel = new window.DashboardVm();
			ko.applyBindings(window.viewModel);

        });
    </script>

</body>

</html>