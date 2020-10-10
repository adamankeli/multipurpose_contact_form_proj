<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media-query.css">
    <title>Contact Us</title>
</head>
<body>

<div class="container-fluid">
    <div class="container">
        <div class="row">

            <div class="contact-box">
                <div class="contact-area">
                    <div class="contact-header">
                        <h4 class="header-text"> Contact Form Project</h4>
                    </div>
                    <div class="contact-body">
                        <form method="post" id="contact-form" autocomplete="off">
                            <div class="contact-field">
                                <div class="contact-field-sub">
                                    <label class="label-text">Name *</label>
                                    <span class="primary-field-icon"><i class="fas fa-user"></i></span>
                                    <input type="text" name="name" id="name" class="primary-field form-control">
                                </div>
                            </div>
                            <div class="contact-field">
                                <div class="contact-field-sub">
                                    <label class="label-text">Email *</label>
                                    <span class="primary-field-icon"><i class="fas fa-envelope"></i></span>
                                    <input type="text" name="email" id="email" class="primary-field form-control">
                                </div>
                                <div class="contact-field-sub">
                                    <label class="label-text">Phone Number *</label>
                                    <span class="primary-field-icon"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="phone" id="phone" class="primary-field form-control">
                                </div>
                            </div>
                            <div class="contact-field" id="custom-input-container"></div>
                                <div class="contact-field-sub" id="custom-input-container">
                                    <input type="button" class="btn-add-more" value="Add More Details" onClick="addMore()" />
                                </div>
                            <div class="contact-field">
                                <div class="success-msg"> Thank You For Contacting Us. </div>
                            </div>    
                            <div class="contact-field">
                                <input type="submit" value="Send" class="my-btn" id="submit">
                                <button class="my-btn" id="loader" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

     <script type="text/javascript">
     //Add more fields
     function addMore() {
        	   $("<DIV>").load("additional-fields.php", function() {
        	      $("#custom-input-container").append($(this).html());
        	   });	
    }

    $(document).ready(function (){

        $('#loader, .success-msg').hide();

        $.validator.addMethod("regex", function(value, element, regexp){
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        }, "Invalid Validation Expression" );    

        $('#contact-form').validate({
            rules : {
                name : {
                    required : true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                    regex : /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/,
                    minlength : 3,
                    maxlength : 100
                },
                email : {
                    required : {
                        depends: function () {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    maxlength : 100,
                    regex : /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                },
                phone : {
                    required : true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                    regex : /^(1\s?)?((\([0-9]{3}\))|[0-9]{3})[\s\-]?[\0-9]{3}[\s\-]?[0-9]{4}$/
                },
                custom_value : {
                    required : true,
                    normalizer: function(value) {
                        return $.trim(value);
                    },
                    minlength : 3,
                    maxlength : 100
                }

            },
            messages : {
                name : {
                    required : 'Please Enter Your Name',
                    minlength : 'Please Enter a Valid Name',
                    maxlength : 'Only 100 Charaters Allowed',
                    regex : 'Only letters are Allowed'
                },
                email : {
                    required : 'Please Enter Email Address',
                    maxlength : 'Only 100 Charaters Allow',
                    regex : 'Please Enter a Valid Email Address'
                },
                phone : {
                    required : 'Please Enter Phone number',
                    regex : 'Please Enter Valid Number (US)' 
                },
                custom_value : {
                    required : 'Please Enter a Response',
                    minlength : 'Please Enter a Valid Response',
                    maxlength : 'Only 100 Charaters Allowed'
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

                    type : 'POST',
                    url : 'php/php-contact.php',
                    data : $('#contact-form').serialize(),
                    beforeSend : function(){
                        $('#loader').show();
                        $('#submit').hide();
                    },
                    complete : function(){
                        $('#loader').hide();
                        $('#submit').show();

                    },
                    success : function(response){

                        var get_data = JSON.parse(response);
                        if(get_data.status == 200){
                            
                            $('#contact-form').trigger("reset");
                            $("#name, #email, #phone, #addFields").removeClass("is-valid");

                            $(".success-msg").delay(100).fadeIn( "slow", function (){
                                $(this).delay(2000).fadeOut("slow");
                            });

                            console.log(get_data.msg);

                        }
                        else{
                            console.log(get_data.msg);
                        }

                    }

                });

                return false;

            }
            
        });

    });

    </script>

</body>
</html>

