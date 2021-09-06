$(document).ajaxStart(function() {
    $('body').addClass('in-loading');
});
$(document).ajaxStop(function() {
    setTimeout(function(){
        $('body').removeClass('in-loading');
    }, 300);
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
}
var BASE_JS = {
    init:function(){
        BASE_JS.globalNotify();
    },
    globalNotify:function(){
        if(typeNotify != '' && messageNotify != ''){
            toastr.clear();
            toastr[typeNotify](messageNotify);
        }
    }
}
BASE_JS.init();