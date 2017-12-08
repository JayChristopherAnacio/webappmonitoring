
window.DashboardVm = function(){
	var self = this;
	
	self.TypeList = ko.observableArray([]);

	
	
	
	//=======GET ALL TYPES FOR DROPDOWN TYPE
	var url = 'get_types.php';
	var data = '';
	ajax(url,data);
	$.each(dataResponse, function(i,row){
		self.TypeList.push(new Type(row.TypeId,row.Description));
	});
	self.TypeList(self.TypeList());
	
	
	//=======POST ADD PROCESS 
	self.AddProcess = function(){
		
		var url = 'add_process.php';
		var data = $('#ProcessForm').serialize();
		
		ajax(url,data);
		console.log(dataResponse);
		if(dataResponse = 'Success'){
			var alert = $('#Notify-box');
			alert.toggleClass('alert-success').toggleClass('alert-success');
			
			alert.show();
		}
		
		
		$('#PartialView_Process').modal('toggle');
		document.getElementById("ProcessForm").reset();
	};
	
	

}
