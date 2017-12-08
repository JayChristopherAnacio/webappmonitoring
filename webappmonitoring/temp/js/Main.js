
$(function() {
    $('#side-menu').metisMenu();
});

$('#side-menu').click( function(){
    $(this).find('span').toggleClass('glyphicon-menu-left').toggleClass('glyphicon-menu-down');
});

$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
});

$('#AddProcess-btn').click(function (){

	$('#PartialView_Process').modal('show');

});

var ajax = function(url,id){

	$.ajax({
		url: url,
		data: {data : id},
		dataType: 'json',
		type: "POST",
		async: false,
		beforeSend: function () {
			
		},
		success: function (returnData) {
			dataResponse = returnData;
			return dataResponse;
		},
		error: function (xhr, ajaxOptions, thrownError) {
			dataResponse = thrownError;
			return dataResponse;
		},
		complete: function () {
			
		}
	});
}

var deleteInstance = function(obj){
	obj = null;
	delete obj;
}


