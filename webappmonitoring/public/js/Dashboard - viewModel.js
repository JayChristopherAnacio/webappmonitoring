window.DashboardVm = function() {
    var self = this;

    var now = new Date();
    self.LastestFetch = ko.observable("Last Run: " + now.toLocaleDateString() + " " + now.toLocaleTimeString());
    self.TypeList = ko.observableArray([]);
    self.displayLogs = ko.observableArray([]);
    self.ProcessList = ko.observableArray([]);
    self.DisplayProcess = ko.observableArray([]);
    self.filter = ko.observable('');
    self.display = ko.observable(false);

    self.processUrl = ko.observable('Curl_Process.php');
    self.id = ko.observable('1');
    self.column = ko.observable('id');

    self.sortOrder = ko.observable('asc');
    self.descending = "glyphicon glyphicon-chevron-down";
    self.ascending = "glyphicon glyphicon-chevron-up";
    // Observable array that represents each column in the table
    self.columns = ko.observableArray([{
            property: "Name",
            header: "Name",
            type: "string",
            state: ko.observable("glyphicon glyphicon-chevron-down")
        },
        {
            property: "Type",
            header: "Type",
            type: "string",
            state: ko.observable("glyphicon glyphicon-chevron-down")
        },
        {
            property: "PublicIp",
            header: "Public Ip",
            type: "string",
            state: ko.observable("glyphicon glyphicon-chevron-down")
        },
        {
            property: "StatusData",
            header: "Status",
            type: "int",
            state: ko.observable("glyphicon glyphicon-chevron-down")
        },
        {
            property: "LastRun",
            header: "Last Run",
            type: "date",
            state: ko.observable("glyphicon glyphicon-chevron-down")
        },
        {
            property: "AvgDuration",
            header: "Average Duration",
            type: "int",
            state: ko.observable("glyphicon glyphicon-chevron-down")
        },
        {
            property: "Duration",
            header: "Duration",
            type: "int",
            state: ko.observable("glyphicon glyphicon-chevron-down")
        }
    ]);

    //=========DATA METHODS=========//

    //======UPDATE ALL PROCESS======//
    self.getProcess = function(data) {

        //CLEAR PROCESS LIST======================================================
        self.ProcessList([]);
        ajax(data);
        //AJAX CALL js/Main.js ===================================================

        if (dataResponse) {

            if (dataResponse.status == 'success') {

                //FOR EACH DATARESPONSE JSON RETURNED ================================
                $.each(dataResponse.data, function(i, dataset) {
                    //KO OBSERVABLE ARRAY PUSH NEW PROCESS OBJ js/objs.js ====================

                    var avgDuration = parseInt(dataset.average_duration);
                    var duration = parseInt(dataset.duration);


                    self.ProcessList.push(new Process(
                        dataset.id, dataset.name, dataset.type, dataset.public_ip, dataset.url, dataset.status, dataset.start_time, avgDuration, duration
                    ));
                    deleteInstance(Process);
                });


                //REFRESH PROCESS ARRAY ==============================================
                self.ProcessList(self.ProcessList());
                //FOR EACH PROCESS LIST DATA (HTML DATA BIND) ========================
                $.each(window.viewModel.DisplayProcess(), function(i, displayProcessList) {
                    var $thisDisplayProcessList = this;
                    var selectedRow = $thisDisplayProcessList.IsSelected();

                    if (selectedRow == 'selected') {
                        $.each(self.ProcessList(), function(i, processList) {
                            var $thisProcessList = this;

                            if ($thisProcessList.Id() == $thisDisplayProcessList.Id()) {
                                $thisProcessList.IsSelected($thisDisplayProcessList.IsSelected());
                            }
                        });
                    }
                });


                window.viewModel.DisplayProcess([]);
                window.viewModel.DisplayProcess(self.ProcessList());


                //REFRESH DISPLAY ARRAY ===============================================
                window.viewModel.DisplayProcess(window.viewModel.DisplayProcess());

            } else {
                Command: toastr["error"]("Process API response unavailable", "App - Monitoring");
            }


        } else {
            Command: toastr["error"]("PROCESS API RESPONSE UNAVAILABLE", "App - Monitoring");
        }

    };


    //======PAGE EVENT METHODS======//

    //=====SORTING EVENT METHOD=====//
    self.sortClick = function(column) {
        try {
            // Call this method to clear the state of any columns OTHER than the target
            // so we can keep track of the ascending/descending
            self.clearColumnStates(column);
            switch (column.type) {
                case "int":
                    self.columnState(column, false);
                    break;
                case "date":
                    self.columnState(column, false);
                    break;
                case "object":
                    self.columnState(column, false);
                    break;
                case "string":
                    self.columnState(column, true);
                    break;
            }
            switch (column.property) {
                case "Name":
                    self.column("name");
                    break;
                case "Type":
                    self.column("type");
                    break;
                case "PublicIp":
                    self.column("public_ip");
                    break;
                case "StatusData":
                    self.column("status");
                    break;
                case "LastRun":
                    self.column("start_time");
                    break;
                case "AvgDuration":
                    self.column("average_duration");
                    break;
                case "Duration":
                    self.column("duration");
                    break;
            }

            data = {
                method: 'POST',
                url: window.viewModel.processUrl(),
                id: window.viewModel.id(),
                column: window.viewModel.column(),
                sortOrder: window.viewModel.sortOrder()
            };
            window.viewModel.getProcess(data);

        } catch (err) {
            // Always remember to handle those errors that could occur during a user interaction
            alert(err);
        }
    };
    //====SEARCHING EVENT METHOD====//
    self.filteredItems = ko.computed(function() {
        var filter = self.filter();
        if (!filter) {
            return self.DisplayProcess();
        }
        return self.DisplayProcess().filter(function(i) {
            return i.Name().toLowerCase().indexOf(filter) > -1 || i.Type().toLowerCase().indexOf(filter) > -1 || i.PublicIp().toLowerCase().indexOf(filter) > -1 || i.StatusLabel().toLowerCase().indexOf(filter) > -1 || i.LastRun().toLowerCase().indexOf(filter) > -1 || i.ViewDuration().toLowerCase().indexOf(filter) > -1 || i.ViewAvgDuration().toLowerCase().indexOf(filter) > -1;
        });
    });


    //=======UTILITY METHODS=======//
    self.clearColumnStates = function(selectedColumn) {
        var otherColumns = self.columns().filter(function(col) {
            return col != selectedColumn;
        });

        for (var i = 0; i < otherColumns.length; i++) {
            otherColumns[i].state(self.descending);
        }
    };

    self.columnState = function(column, isString) {
        if (isString == true) {
            // Get the state of the sort type
            if (column.state() === "" || column.state() === self.descending) {
                column.state(self.ascending);
                self.sortOrder('asc');
            } else {
                column.state(self.descending);
                self.sortOrder('desc');
            }

        } else {
            // Get the state of the sort type
            if (column.state() === "" || column.state() === self.descending) {
                column.state(self.ascending);
                self.sortOrder('desc');
            } else {
                column.state(self.descending);
                self.sortOrder('asc');
            }

        }
    };

}