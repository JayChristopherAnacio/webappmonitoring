
window.DashboardVm = function(){
	var self = this;
	
	self.TypeList = ko.observableArray([]);
	self.displayLogs = ko.observableArray([]);
	self.ProcessList = ko.observableArray([]);
	self.DisplayProcess = ko.observableArray([]);
	self.filter = ko.observable('');
	self.display = ko.observable(false);
	
	
	//=======GET ALL PROCESS=======//
	self.getProcess = function (url,data){
	
		//CLEAR PROCESS LIST======================================================
		self.ProcessList([]);
		
		//AJAX CALL js/Main.js ===================================================
		ajax(url,data);
		//FOR EACH DATARESPONSE JSON RETURNED ====================================
		
		if(dataResponse){
			if(dataResponse.status == 'success'){
			
				$.each(dataResponse.data, function(i,dataset){
				//KO OBSERVABLE ARRAY PUSH NEW PROCESS OBJ js/objs.js ====================
				
					var avgDuration = parseInt(dataset.average_duration);
					var strAvgDuration = avgDuration.toString();
					var presentationAVGduration = strAvgDuration + "ms";
					
					
					var duration = parseInt(dataset.duration);
					var strDuration = duration.toString();
					var presentationDuration = strDuration + "ms";
				
					self.ProcessList.push(new Process(
							dataset.id
							,dataset.name
							,dataset.type
							,dataset.public_ip
							,dataset.url
							,dataset.status
							,dataset.start_time
							,presentationAVGduration
							,presentationDuration
					));
					deleteInstance(Process);
				});
				
				//REFRESH PROCESS ARRAY ==============================================
				self.ProcessList(self.ProcessList());
				
				//PASS PROCESS ARRAY TO PROCESS ARRAY ON HTML ========================
				window.viewModel.DisplayProcess(self.ProcessList());
			
			}
			
		}else{
		
			console.log("API RESPONSE UNAVAILABLE");
			
		}
	
	};
	
	//======UPDATE ALL PROCESS======//
	self.updateProcess = function(url,data){
	
		//CLEAR PROCESS LIST======================================================
		self.ProcessList([]);
		ajax(url,data);
		//AJAX CALL js/Main.js ===================================================

		if(dataResponse){
		
			if(dataResponse.status == 'success'){
			
				//FOR EACH DATARESPONSE JSON RETURNED ================================
				$.each(dataResponse.data, function(i,dataset){
				//KO OBSERVABLE ARRAY PUSH NEW PROCESS OBJ js/objs.js ====================
				
					var avgDuration = parseInt(dataset.average_duration);
					var strAvgDuration = avgDuration.toString();
					var presentationAVGduration = strAvgDuration + "ms";
					
					
					var duration = parseInt(dataset.duration);
					var strDuration = duration.toString();
					var presentationDuration = strDuration + "ms";
				
					self.ProcessList.push(new Process(
							dataset.id
							,dataset.name
							,dataset.type
							,dataset.public_ip
							,dataset.url
							,dataset.status
							,dataset.start_time
							,presentationAVGduration
							,presentationDuration
					));
					deleteInstance(Process);
				});
				
				//REFRESH PROCESS ARRAY ==============================================
				self.ProcessList(self.ProcessList());
				//FOR EACH PROCESS LIST DATA (HTML DATA BIND) ========================
				$.each(window.viewModel.DisplayProcess(), function(i,displayProcessList){
					var $thisDisplayProcessList = this;
					var selectedRow = $thisDisplayProcessList.IsSelected();
					
					if(selectedRow == 'selected'){
						$.each(self.ProcessList(), function(i,processList){
							var $thisProcessList = this;
							
							if($thisProcessList.Id() == $thisDisplayProcessList.Id()){
								$thisProcessList.IsSelected($thisDisplayProcessList.IsSelected());
							}
						});
					}
				});
				

				window.viewModel.DisplayProcess([]);
				window.viewModel.DisplayProcess(self.ProcessList());
				
				
				//REFRESH DISPLAY ARRAY ===============================================
				window.viewModel.DisplayProcess(window.viewModel.DisplayProcess());
			
			}
			
			
		}else{
		
			console.log("API RESPONSE UNAVAILABLE");
			
		}
	
	};
	
	//=========NOT WORKING=========//
	self.filteredItems = ko.computed(function() {
		var filter = self.filter();
		if (!filter) { return self.ProcessList(); }
		return self.ProcessList().filter(function(i) { return i.indexOf(filter) > -1; });
	});

}
