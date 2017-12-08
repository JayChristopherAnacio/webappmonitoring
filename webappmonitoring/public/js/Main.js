var ajax = function(data) {

    $.ajax({
        url: data.url,
        data: data,
        dataType: 'json',
        type: data.method,
        async: false,
        beforeSend: function() {

        },
        success: function(returnData) {
            dataResponse = returnData;
            return dataResponse;
        },
        error: function(xhr, ajaxOptions, thrownError) {
            dataResponse = thrownError;
            return dataResponse;
        },
        complete: function() {

        }
    });
}

var deleteInstance = function(obj) {
    obj = null;
    delete obj;
}

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

function formatDate(date) {

    var d = new Date(date);
    var hh = d.getHours();
    var m = d.getMinutes();
    var s = d.getSeconds();
    var dd = "AM";
    var h = hh;
    if (h >= 12) {
        h = hh - 12;
        dd = "PM";
    }
    if (h == 0) {
        h = 12;
    }
    m = m < 10 ? "0" + m : m;

    s = s < 10 ? "0" + s : s;

    /* if you want 2 digit hours:
    h = h<10?"0"+h:h; */

    var pattern = new RegExp("0?" + hh + ":" + m + ":" + s);

    var replacement = h + ":" + m;
    /* if you want to add seconds*/
    replacement += ":" + s;
    replacement += " " + dd;
    deleteInstance(Date);
    deleteInstance(RegExp);
    var tempDate = date.replace(/-/g, "/");
    return tempDate.replace(pattern, replacement);

}