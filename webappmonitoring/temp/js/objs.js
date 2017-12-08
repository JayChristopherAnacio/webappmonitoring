

//PROCESS OBJ=============================================================
var Process = function(Id,Name,Type,PublicIp,Address,Status,LastRun,AvgDuration,Duration){
	var self = this;
	//JSON DATA===========================================================
	self.Id = ko.observable(Id);
	self.Name = ko.observable(Name);
	self.Type = ko.observable(Type);
	self.Address = ko.observable(Address);
	self.PublicIp = ko.observable(PublicIp);
	self.StatusData = ko.observable(Status);
	self.LastRun = ko.observable(LastRun);
	self.AvgDuration = ko.observable(AvgDuration);
	self.Duration = ko.observable(Duration);
	 
	 
	//OBJ PROPERTIES======================================================
	self.display = ko.observable(false);
	self.StatusClassBtn =  ko.observable();
	self.StatusLabel =  ko.observable();
	self.StatusClassGlyph = ko.observable();
	self.Logs = ko.observableArray([]);
	self.IsSelected = ko.observable();
	self.Logs = ko.observableArray([]);

	var statusInt = self.StatusData();
	if(statusInt == 1){
		self.StatusLabel('Running');
		self.StatusClassBtn('btn btn-success btn-circle');
		self.StatusClassGlyph('glyphicon glyphicon-ok');
	}else{
		self.StatusLabel('Stop');
		self.StatusClassBtn('btn btn-danger btn-circle');
		self.StatusClassGlyph('glyphicon glyphicon-remove');
	 }
	 
	self.rowClick = function(data, event) {
	
		//VARIABLES ===========================================================
		var id = self.Id();
		var url = 'Curl_Logs.php'
		
		//AJAX CALL js/Main.js ================================================
		ajax(url,id);
		
		//CLEAR LOGS DISPLAY ON HTML ==========================================
		window.viewModel.displayLogs([]);
		if(dataResponse){
			if(dataResponse.status == 'success'){
				//FOR EACH DATARESPONSE JSON RETURNED =================================
				$.each(dataResponse.data, function(i,dataset){
				
				//KO OBSERVABLE ARRAY PUSH NEW LOG OBJ js/objs.js =====================
					self.Logs.push(new Log(
							dataset.end_time
							,dataset.log_description
					));
					deleteInstance(Log);
				});
				//REFRESH LOGS ARRAY ==================================================
				self.Logs(self.Logs());
				//PASS LOGS ARRAY TO LOGS ARRAY ON HTML ===============================
				window.viewModel.displayLogs(self.Logs());
				
			}
		}
		//HIGHLIGHT FUNCTIONALITY =============================================
		
		//CLEAR CURRENT SELECTED ROW (TOGGLE-CLASS) ===========================
		$.each(window.viewModel.DisplayProcess(), function(i,displayProcessList){
			var MySelf = this;
			var highlightStatus = MySelf.IsSelected();
			if(highlightStatus == 'selected'){
				MySelf.IsSelected('');
			}
		});
		
		//CHANGE CURRENT OBJ SELECTED CLASS ===================================
		self.IsSelected('selected');
		//console.log(ko.toJS(self.IsSelected()));
		
	};

};

//LOGS OBJ=====================================================================
var Log = function(EndTime,LogDescription){
	var self = this;
	
	
	self.Id = ko.observable();
	self.ProcessId = ko.observable();
	self.StartTime = ko.observable();
	self.EndTime = ko.observable(EndTime);
	self.Status = ko.observable();
	self.LogDescription = ko.observable(LogDescription);
	self.CreatedAt = ko.observable();
	self.UpdatedAt = ko.observable();
	
	window.viewModel.displayLogs();

};

//USERS OBJ====================================================================
var Users = function(UserId,UserName,Password){
	var self = this;
	
	self.UserId = ko.observable(UserId);
	self.UserName = ko.observable(UserName);
	self.Password = ko.observable(Password);


};

//TYPE OBJ=====================================================================
var Type = function(TypeId,Description){
	var self = this;
	
	self.TypeId = ko.observable(TypeId);
	self.Description = ko.observable(Description);

};

//ROLES OBJ====================================================================
var Role = function(RoleId,Description){
	var self = this;
	
	self.RoleId = ko.observable(RoleId);
	self.Description = ko.observable(Description);

};

//COMPANY======================================================================
var Company = function(CompanyId,Description){
	var self = this;
	
	self.CompanyId = ko.observable(CompanyId);
	self.Description = ko.observable(Description);

};