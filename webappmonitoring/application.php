<?php

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/sidebar.css" />
    <link rel="stylesheet" href="public/css/table.css" />
    <link rel="stylesheet" href="public/css/Main.css" />
    <link rel="stylesheet" href="public/css/toastr.min.css" />
    <link rel="stylesheet" href="public/css/selectList.css" />

    <meta charset="utf-8" />
</head>

<body>
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <?php include_once "sidebar.php";
		   ?>
        </div>

        <!-- Page content -->
        <div id="page-content-wrapper">

            <div class="content-header">


                <div class="row">
                    <div class="col-md-12 col-sm-2">
                        <h2 id="home" class="text-info">
                            <a id="menu-toggle" href="#" class="glyphicon glyphicon-align-justify btn-menu toggle">
									<i class="fa fa-bars"></i>
								</a> Add Application
                        </h2>

                    </div>
                </div>



            </div>



            <div class="page-content inset" data-spy="scroll" data-target="#spy">

                <div class="row">

                    <div class="col-md-12">
                        <form class="form-inline" action="/action_page.php">
                            <div class="row">

                                <div class="col-md-4 center-block">
                                    <label for="Name">Name </label>
                                    <div class="form-group pull-right">


                                        <input type="textbox" name="Name" class="form-control" id="Name" />

                                    </div>

                                </div>

                                <div class="col-md-4 center-block">
                                    <label for="PublicIp">Public Ip </label>
                                    <div class="form-group pull-right">


                                        <input type="textbox" name="PublicIp" class="form-control" id="PublicIp" />

                                    </div>

                                </div>

                                <div class="col-md-4 center-block">
                                    <label for="Status">Status </label>
                                    <div class="form-group pull-right">

                                        <div class="selectdiv">

                                            <select name="Status" class="form-control" id="Status">
														<option></option>
														<option>Enable</option>
														<option>Disable</option>
													</select>
                                        </div>
                                    </div>

                                </div>



                            </div>
                            <br>
                            <div class="row">

                                <div class="col-md-4 center-block">
                                    <label>Type </label>
                                    <div class="form-group pull-right">
                                        <div class="selectdiv">
                                            <select name="Type" class="form-control" id="Type">
														<option></option>
														<option>Database</option>
														<option>Websocket</option>
													</select>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4 center-block">
                                    <label>URL </label>
                                    <div class="form-group pull-right">
                                        <input type="textbox" name="URL" class="form-control" id="URL" />
                                    </div>

                                </div>

                                <div class="col-md-4 center-block">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>

                            </div>

                        </form>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="process_tbl" class="table table-condensed table-responsive borderless table-striped">
                            <thead class="table-head">

                                <tr>

                                    <th data-bind="visible:display()">
                                        <div class="sortable pull-left">
                                            <span>Id </span>
                                        </div>
                                        <div class='pull-right'>
                                            <span class="sort pull-left">
															
														</span>
                                            <span class=" pull-right">
															<span class="vertical-line"></span>
                                            </span>
                                        </div>
                                    </th>

                                    <th>
                                        <div class="sortable pull-left">
                                            <span>Name </span>
                                        </div>
                                        <div class='pull-right'>
                                            <span class="sort pull-left">
															
														</span>
                                            <span class=" pull-right">
															<span class="vertical-line"></span>
                                            </span>
                                        </div>
                                    </th>

                                    <th>
                                        <div class="sortable pull-left">
                                            <span>Type </span>
                                        </div>
                                        <div class='pull-right'>
                                            <span class="sort pull-left">
															
														</span>
                                            <span class=" pull-right">
															<span class="vertical-line"></span>
                                            </span>
                                        </div>
                                    </th>

                                    <th>
                                        <div class="sortable pull-left">
                                            <span>Public IP </span>
                                        </div>
                                        <div class='pull-right'>
                                            <span class="sort pull-left">
															
														</span>
                                            <span class=" pull-right">
															<span class="vertical-line"></span>
                                            </span>
                                        </div>
                                    </th>

                                    <th>
                                        <div class="sortable pull-left">
                                            <span>URL </span>
                                        </div>
                                        <div class='pull-right'>
                                            <span class="sort pull-left">
															
														</span>
                                            <span class=" pull-right">
															<span class="vertical-line"></span>
                                            </span>
                                        </div>
                                    </th>

                                    <th>
                                        <div class="sortable pull-left">
                                            <span>Status </span>
                                        </div>
                                        <div class='pull-right'>
                                            <span class="sort pull-left">
															
														</span>
                                            <span class=" pull-right">
															<span class="vertical-line"></span>
                                            </span>
                                        </div>
                                    </th>

                                </tr>


                            </thead>

                            <tbody data-bind="foreach: DisplayProcess">
                                <tr>
                                    <td data-bind="text: Id, visible:display()"></td>
                                    <td data-bind="text: Name"></td>
                                    <td data-bind="text: Type"></td>
                                    <td data-bind="text: PublicIp"></td>
                                    <td data-bind="text: Url"></td>
                                    <td data-bind="text:StatusLabel"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
        <div id="toast"></div>

        <script src="public/js/jquery-3.2.1.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        <script src="public/js/toastr.min.js"></script>
        <script src="public/js/knockout-3.4.2.js"></script>

        <script src="public/js/Main.js"></script>
        <script src="public/js/objs.js"></script>
        <script src="public/js/Dashboard - viewModel.js"></script>

        <script>
            $(document).ready(function() {

                //MVVM JS KO========================================================================
                window.viewModel = new window.DashboardVm();
                ko.applyBindings(window.viewModel);


                data = {
                    method: 'POST',
                    url: window.viewModel.processUrl(),
                    id: window.viewModel.id(),
                    column: window.viewModel.column(),
                    sortOrder: window.viewModel.sortOrder()
                };
                window.viewModel.getProcess(data);


                $(document).ajaxStart(function() {
                        console.clear();
                    })
                    .ajaxStop(function() {
                        console.clear();
                    });



            });
        </script>
        <script src="public/js/sidebar.js"></script>
</body>

</html>