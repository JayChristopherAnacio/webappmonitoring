<?php
include_once "\conn.mysql.php";
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
	<link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/metisMenu.min.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">


		<div class="container">
			<div class="card card-container">
				<!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
				<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
				<p id="profile-name" class="profile-name-card"></p>
				<form action="auth.php" method="post" class="form-signin">
					<span id="reauth-email" class="reauth-email"></span>
					<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
					<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
					<div id="remember" class="checkbox">
						<label>
							<input type="checkbox" value="remember-me"> Remember me
						</label>
					</div>
					<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
				</form><!-- /form -->

			</div><!-- /card-container -->
		</div><!-- /container -->
        

    </div>






    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js" </script>
    <script src = "http://knockoutjs.com/downloads/knockout-3.4.2.js" ></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="/socket.io/socket.io.js"></script>
    <script>
        var socket = io();
    </script>

    <script src="js/metisMenu.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        $(document).ready(function() {


            var table = $('#process_tbl').DataTable({
                //lengthChange: false,
                buttons: [{
                    text: '<i class="glyphicon glyphicon-plus"></i>',
                    className: 'btn_add',
                    action: function(e, dt, node, config) {

                        $('#PartialView_Process').modal('show')
                    }

                }]

            });

            table.buttons().container()
                //.appendTo( '#process_tbl_wrapper .col-sm-6:eq(0)' );
                .appendTo('#process_tbl_wrapper #process_tbl_filter:eq(0)');



        });
    </script>

</body>

</html>