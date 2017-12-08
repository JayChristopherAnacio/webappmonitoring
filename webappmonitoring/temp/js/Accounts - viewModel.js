
window.AccountsVm = function(){
	var self = this;
	

	self.RoleList = ko.observableArray([]);
	self.CompanyList = ko.observableArray([]);
	

	//=======GET ALL ROLES FOR DROPDOWN ROLES
	var url = 'get_roles.php';
	var data = '';
	ajax(url,data);
	$.each(dataResponse, function(i,dataset){
		$.each(dataset, function(x,row){
			self.RoleList.push(new Role(row.RoleId,row.Description));
		});
	});
	self.RoleList(self.RoleList());
	
	
	//=======GET ALL COMPANIES FOR DROPDOWN COMPANY
	var url = 'get_companies.php';
	var data = '';
	ajax(url,data);
	$.each(dataResponse, function(i,dataset){
		$.each(dataset, function(x,row){
			self.CompanyList.push(new Company(row.companyId,row.Description));
		});
	});
	self.CompanyList(self.CompanyList());
	
	
	//=======ADD ACCOUNT
	self.AddAccount = function(){
		
		var url = 'add_Account.php';
		var data = $('#AccountForm').serialize();
		
		ajax(url,data);
		if(dataResponse = 'Success'){
			var alert = $('#Notify-box');
			alert.toggleClass('alert-success').toggleClass('alert-success');
			
			alert.show();
		}
		
		
		$('#PartialView_Process').modal('toggle');
		document.getElementById("AccountForm").reset();
	};
	
	

}
