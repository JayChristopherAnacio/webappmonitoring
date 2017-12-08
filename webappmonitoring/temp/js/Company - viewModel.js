
window.CompanyVm = function(){
	var self = this;

	
	
	//=======POST ADD COMPANY 
	self.AddCompany = function(){
		
		var url = 'add_company.php';
		var data = $('#CompanyForm').serialize();
		
		ajax(url,data);

		if(dataResponse = 'Success'){
			var alert = $('#Notify-box');
			alert.toggleClass('alert-success').toggleClass('alert-success');
			
			alert.show();
		}
		
		
		$('#PartialView_Process').modal('toggle');
		document.getElementById("CompanyForm").reset();
	};
	
	

}
