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
                            <div class="contact-field">
                                <label class="label-text">Additional Details</label>
                                    <div class="contact-field-sub">
                                        <div id="custom-input-container">
                                            <div class="input-row">
                                                <select name="custom_name[]" class="cprimary-field form-control">
                                                    <option value="volvo">Date of Birth</option>
                                                    <option value="saab">Gender</option>
                                                    <option value="mercedes">Car Make</option>
                                                    <option value="audi">Car Colour</option>
                                                </select>
                                                <input type="text" class="primary-field form-control" name="custom_value[]" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contact-field-sub" id="custom-input-container">
                                        <input type="button" class="btn-add-more" value="Add More" onClick="addMore()" />
                                    </div>
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
