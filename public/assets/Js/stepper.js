
// validate form on keyup and submit

var v = jQuery("#msform").validate({
    ignore: ".ignore",
    rules: {
        name: "required",
        email: "required",
        phone: "required",
        date_of_birth: "required",
        password: "required",
        confirm_password: "required"
        // address: "required",
        // country: "required",
        // state: "required",
        // city: "required",
        // zip: "required",
        // how_do_you_know_about_garcia: "required",
    },
    submitHandler: function (form) {
        var formData = new FormData(form);
        //e.preventDefault();
        $("#loadingmessage").show();
        $.ajax({
            url: "home",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data == 'success') {
                    $("#loadingmessage").hide();
                    $("#sucessmsg").show();
                }
                if (data == 'error') {
                    $("#loadingmessage").hide();
                    $("#errormsg").show();
                }

            },
            error: function () { }

        });

        //return false;  //This doesn't prevent the form from submitting.
    },
    highlight: function (element, errorClass) {

        window.scrollTo(0, 0);

    },
    unhighlight: function (element, errorClass) {
        //$(element).closest(".form-group").removeClass("has-error");
    },
});

$("#stepone").click(function () {

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    if (v.form()) {

        $("input", "#step2").removeClass("ignore");

        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        $('#step1').hide();
        $('#step2').show();
        window.scrollTo(0, 0);
    }

});

$("#previous1").click(function () {

    $("input", "#step2").addClass("ignore");

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    $('#step2').hide();
    $('#step1').show();
    window.scrollTo(0, 0);
});