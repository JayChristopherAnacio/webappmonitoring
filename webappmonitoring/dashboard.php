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
								</a> DASHBOARD
                        </h2>

                    </div>
                </div>



            </div>



            <div class="page-content inset" data-spy="scroll" data-target="#spy">


                <div class="row">

                    <div class="col-md-10 col-sm-12">
                        <div class="input-group search">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                            <input id="search" type="text" data-bind="textInput: filter" class="form-control " name="search" placeholder="Search" />
                        </div>
                    </div>

                    <div class=" col-md-2">

                        <button type="button" class="btn btn-info">Search</button>

                    </div>

                </div>


                <hr>

                <div class="row">

                    <div class="col-md-12">

                        <h5 data-bind="text:LastestFetch" class="text-info pull-right">

                        </h5>

                        <table id="process_tbl" class="table table-condensed table-responsive borderless table-hover">
                            <thead class="table-head">

                                <tr data-bind="foreach: columns">
                                    <th data-bind="click: $root.sortClick.bind(property)" class="cursor">
                                        <div class="sortable pull-left">
                                            <span data-bind="html: header"></span>
                                        </div>
                                        <div class='pull-right'>
                                            <span class="sort pull-left">
															<i data-bind="css: state"></i>
														</span>
                                            <span class=" pull-right">
															<span class="vertical-line"></span>
                                            </span>
                                        </div>
                                    </th>
                                </tr>


                            </thead>

                            <tbody data-bind="foreach: filteredItems">
                                <tr data-bind="attr: { class: IsSelected}">
                                    <td data-bind="text: Id, visible:display()"></td>
                                    <td data-bind="text: Name,click:rowClick" class="cursor"></td>

                                    <td data-bind="text: Type ,click:rowClick" class="cursor"></td>

                                    <td data-bind="text: Url, visible:display()" class="cursor"></td>
                                    <td data-bind="text: PublicIp ,click:rowClick" class="cursor"></td>
                                    <td>

                                        <button type="button" data-bind="click:rowClick,attr: { class: StatusClassBtn}"> </button> <span class="cursor" data-bind="text:StatusLabel, click:rowClick"></span>

                                    </td>

                                    <td data-bind="text: LastRun,click:rowClick" class="cursor"></td>

                                    <td style="text-align: right;" data-bind="text: ViewAvgDuration ,click:rowClick" class="cursor"></td>
                                    <td style="text-align: right;" data-bind="text: ViewDuration ,click:rowClick" class="cursor"></td>
                                </tr>
                            </tbody>
                        </table>


                        <table id="logs" data-bind="visible:displayLogs().length > 0 " class="table borderless table-condensed table-responsive">
                            <thead data-bind="visible:display()" class="table-head">
                                <tr style="text-align:center">
                                    <th colspan="2">
                                    </th>

                                    <th colspan="5">
                                    </th>

                                </tr>
                            </thead>
                            <tbody data-bind="foreach: displayLogs">
                                <tr style="text-align:center">
                                    <td colspan="2" class="logsDate" data-bind="text: EndTime"></td>


                                    <td colspan="5" class="logsDescription" data-bind="text: LogDescription"></td>
                                </tr>
                            </tbody>

                        </table>




                    </div>

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

            function fetchData() {

                // your function code here
                var now = new Date();
                window.viewModel.LastestFetch("Last Run: " + now.toLocaleDateString() + " " + now.toLocaleTimeString());
                data = {
                    method: 'POST',
                    url: window.viewModel.processUrl(),
                    id: window.viewModel.id(),
                    column: window.viewModel.column(),
                    sortOrder: window.viewModel.sortOrder()
                };

                window.viewModel.getProcess(data);
                setTimeout(fetchData, 5000);

            }

            fetchData();

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