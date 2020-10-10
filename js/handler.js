//Add more fields
function addMore() {
    $("<DIV>").load("additional-fields.php", function () {
        $("#custom-input-container").append($(this).html());
    });
}
//Field Validation and Ajax Request
$(document).ready(function () {

    $('#loader, .success-msg').hide();

    $.validator.addMethod("regex", function (value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    }, "Invalid Validation Expression");

    $('#contact-form').validate({
        rules: {
            name: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                regex: /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/,
                minlength: 3,
                maxlength: 100
            },
            email: {
                required: {
                    depends: function () {
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
                maxlength: 100,
                regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            },
            phone: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                regex: /^0\d{9}$/
            },

        },
        messages: {
            name: {
                required: 'Please Enter Your Name',
                minlength: 'Please Enter a Valid Name',
                maxlength: 'Only 100 Charaters Allowed',
                regex: 'Only letters are Allowed'
            },
            email: {
                required: 'Please Enter Email Address',
                maxlength: 'Only 100 Charaters Allow',
                regex: 'Please Enter a Valid Email Address'
            },
            phone: {
                required: 'Please Enter Phone number',
                regex: 'Please Enter a Valid Number'
            },
            custom_value: {
                required: 'Please Enter a Response',
                minlength: 'Please Enter a Valid Response',
                maxlength: 'Only 100 Charaters Allowed'
            },

        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        },
        submitHandler: function () {

            $.ajax({

                type: 'POST',
                url: 'php/php-contact.php',
                data: $('#contact-form').serialize(),
                beforeSend: function () {
                    $('#loader').show();
                    $('#submit').hide();
                },
                complete: function () {
                    $('#loader').hide();
                    $('#submit').show();

                },
                success: function (response) {

                    var get_data = JSON.parse(response);
                    if (get_data.status == 200) {

                        $('#contact-form').trigger("reset");
                        $("#name, #email, #phone, #selectFields,#valueFields").removeClass("is-valid");

                        $(".success-msg").delay(100).fadeIn("slow", function () {
                            $(this).delay(2000).fadeOut("slow");
                        });

                        console.log(get_data.msg);

                    }
                    else {
                        console.log(get_data.msg);
                    }

                }

            });

            return false;

        }

    });

});