var origin   = window.location.origin;
if(origin == 'https://stumento.keylines.net.in'){
    var base_url    = 'https://stumento.keylines.net.in/api/';
    var baseURL     = 'https://stumento.keylines.net.in/';
} else {
    var base_url    = 'http://localhost/stumento/api/';
    var baseURL     = 'http://localhost/stumento/';
}
var projectKey  = 'facb6e0a6fcbe200dca2fb60dec75be7';
var source      = 'WEB';
var dataJson    = {};
dataJson.key    = projectKey;
dataJson.source = source;

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// $(function() {
//     switch (page) {
//         case 'directory':
            
//         break;
//     }
// });
$("#signup_form").submit(function (e) {
    e.preventDefault();
    let flag = commonFormChecking(true, 'requiredCheck');
    if (flag) {
        flag = checkPassword('password', 'confirm_password');
        if (flag) {
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: base_url + "signup",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function () {
                    $("#signup_form").loading();
                },
                success: function (res) {
                    $("#signup_form").loading("stop");
                    if(res.status){
                        $('#signup_form').trigger("reset");
                        toastAlert("success", res.message, true, res.data.redirectUrl);
                        // toastAlert("success", res.message);
                    }else{
                        toastAlert("error", res.message);
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $("#signup_form").loading("stop");
                    var res = xhr.responseJSON;
                    if(!res.status) {
                        $('#signup_form').trigger("reset");
                        toastAlert("error", res.message);
                    }
                }
            });
        }
    }
});
$("#signupotp_form").submit(function (e) {
    e.preventDefault();
    let flag = commonFormChecking(true, 'requiredCheck');
    if (flag) {
        if (flag) {
            var formData                = new FormData(this);
            // var id                      = $('#id').val();
            // var otp1                    = $('#otp1').val();
            // var otp2                    = $('#otp2').val();
            // var otp3                    = $('#otp3').val();
            // var otp4                    = $('#otp4').val();
            // dataJson.otp                = otp1 + otp2 + otp3 + otp4;
            $.ajax({
                type: "POST",
                url: base_url + "validate-signup-otp",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function () {
                    $("#order-list-info").loading();
                },
                success: function (res) {
                    $("#order-list-info").loading("stop");
                    if(res.status){
                        $('#validateotp_form').trigger("reset");
                        toastAlert("success", res.message, true, res.data.redirectUrl);
                    }else{
                        toastAlert("error", res.message);
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $("#order-list-info").loading("stop");
                    var res = xhr.responseJSON;
                    if(!res.status) {
                        $('#validateotp_form').trigger("reset");
                        toastAlert("error", res.message);
                    }
                }
            });
        }
    }
});
$("#fpwd_form").submit(function (e) {
    e.preventDefault();
    let flag = commonFormChecking(true, 'requiredCheck');
    if (flag) {
        if (flag) {
            var formData = new FormData(this);
            dataJson.email              = $('#email').val();
            $.ajax({
                type: "POST",
                url: base_url + "forgot-password",
                data: JSON.stringify(dataJson),
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function () {
                    $("#order-list-info").loading();
                },
                success: function (res) {
                    $("#order-list-info").loading("stop");
                    if(res.status){
                        $('#fpwd_form').trigger("reset");
                        localStorage.setItem('user_id', res.data.id);
                        toastAlert("success", res.message, true, res.data.redirectUrl);
                    }else{
                        toastAlert("error", res.message);
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $("#order-list-info").loading("stop");
                    var res = xhr.responseJSON;
                    if(!res.status) {
                        $('#fpwd_form').trigger("reset");
                        toastAlert("error", res.message);
                    }
                }
            });
        }
    }
});
$("#validateotp_form").submit(function (e) {
    e.preventDefault();
    let flag = commonFormChecking(true, 'requiredCheck');
    if (flag) {
        if (flag) {
            var formData = new FormData(this);
            dataJson.id                 = localStorage.getItem('user_id');
            var otp1                    = $('#otp1').val();
            var otp2                    = $('#otp2').val();
            var otp3                    = $('#otp3').val();
            var otp4                    = $('#otp4').val();
            dataJson.otp                = otp1 + otp2 + otp3 + otp4;
            $.ajax({
                type: "POST",
                url: base_url + "validate-OTP",
                data: JSON.stringify(dataJson),
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function () {
                    $("#order-list-info").loading();
                },
                success: function (res) {
                    $("#order-list-info").loading("stop");
                    if(res.status){
                        $('#validateotp_form').trigger("reset");
                        toastAlert("success", res.message, true, res.data.redirectUrl);
                    }else{
                        toastAlert("error", res.message);
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $("#order-list-info").loading("stop");
                    var res = xhr.responseJSON;
                    if(!res.status) {
                        $('#validateotp_form').trigger("reset");
                        toastAlert("error", res.message);
                    }
                }
            });
        }
    }
});
$("#resetpwd_form").submit(function (e) {
    e.preventDefault();
    let flag = commonFormChecking(true, 'requiredCheck');
    if (flag) {
        flag = checkPassword('password', 'confirmPassword');
        if (flag) {
            var formData                = new FormData(this);
            dataJson.id                 = localStorage.getItem('user_id');
            dataJson.password           = $('#password').val();
            dataJson.confirm_password   = $('#confirmPassword').val();
            $.ajax({
                type: "POST",
                url: base_url + "reset-password",
                data: JSON.stringify(dataJson),
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function () {
                    $("#order-list-info").loading();
                },
                success: function (res) {
                    $("#order-list-info").loading("stop");
                    if(res.status){
                        $('#resetpwd_form').trigger("reset");
                        localStorage.removeItem('user_id');
                        toastAlert("success", res.message, true, res.data.redirectUrl);
                    }else{
                        toastAlert("error", res.message);
                    }
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $("#order-list-info").loading("stop");
                    var res = xhr.responseJSON;
                    if(!res.status) {
                        $('#resetpwd_form').trigger("reset");
                        toastAlert("error", res.message);
                    }
                }
            });
        }
    }
});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function resendOTP(id){
    $.ajax({
        type: "GET",
        url: base_url + "resend-otp",
        data: {"id" : id, "key" : "facb6e0a6fcbe200dca2fb60dec75be7", "source" : "WEB"},
        dataType: "JSON",
        beforeSend: function () {
            $("#order-list-info").loading();
        },
        success: function (res) {
            $("#order-list-info").loading("stop");
            if(res.status){
                $('#signupotp_form').trigger("reset");
                toastAlert("success", res.message);
            }else{
                toastAlert("error", res.message);
            }
        },
        error:function (xhr, ajaxOptions, thrownError){
            $("#order-list-info").loading("stop");
            var res = xhr.responseJSON;
            if(!res.status) {
                $('#signupotp_form').trigger("reset");
                toastAlert("error", res.message);
            }
        }
    });
}
