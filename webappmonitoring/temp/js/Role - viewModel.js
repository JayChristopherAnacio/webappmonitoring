
window.CompanyVm = function(){
	var self = this;

	
	
	//=======POST ADD COMPANY 
	self.AddBtn = function(){
		
		var url = 'add_role.php';
		var data = $('#Form').serialize();
		
		ajax(url,data);

		if(dataResponse = 'Success'){
			var alert = $('#Notify-box');
			alert.toggleClass('alert-success').toggleClass('alert-success');
			
			alert.show();
		}
		
		
		$('#PartialView_Process').modal('toggle');
		document.getElementById("Form").reset();
	};
	
	

}
