@extends('layouts.app')

@section('register')
<p>Register</p>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form class="form-horizontal" action="{{route('postregister')}}" method="post" id="multi_step_form">
                @csrf
                <div class="tab-content">
                    <!-- Step 1: User Details -->
                    <div class="tab-pane active" id="user_details">
                        <!-- User Details Form Fields -->
                        <!-- Input fields for username and password -->
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name*:</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" id="name" class="form-control form-control-sm">
                            </div>
                        </div>
                        <br />
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email*:</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" id="email" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="phone">phone*:</label>
                            <div class="col-sm-8">
                                <input type="number" name="phone" id="phone" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="date_of_birth">date_of_birth*:</label>
                            <div class="col-sm-8">
                                <input type="date" name="date_of_birth" id="date_of_birth"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="Password">Password*:</label>
                            <div class="col-sm-8">
                                <input type="password" id="pass" name="password" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="confirm_password">Confirm Password*:</label>
                            <div class="col-sm-8">
                                <input type="password" id="confirm_password" name="confirm_password"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                        <button type="button" class="btn-sm btn-primary" id="btn_next_user_details">Next</button>
                    </div>

                    <!-- Step 2: Personal Details -->
                    <div class="tab-pane" id="personal_details">
                        <!-- Personal Details Form Fields -->
                        <!-- Input fields for phone number and address -->
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="Address">Address*:</label>
                            <div class="col-sm-8">
                                <textarea name="address" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="country">Country*:</label>
                            <div class="col-sm-8">
                                <input type="text" id="country" name="country" class="form-control form-control-sm">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="state">State*:</label>
                            <div class="col-sm-8">
                                <input type="text" id="state" name="state" class="form-control form-control-sm">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="city">City*:</label>
                            <div class="col-sm-8">
                                <input type="text" id="city" name="city" class="form-control form-control-sm">
                            </div>
                        </div>
                        <br>
                        <button type="button" name="btn_previous_personal_details" id="btn_previous_personal_details"
                            class="btn btn-info btn-sm">Previous</button>
                        <button type="button" class="btn-sm btn-primary" id="btn_next_personal_details">Next</button>

                    </div>
                    <div class="tab-pane" id="app_details">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="Zip">Zip*:</label>
                            <div class="col-sm-8">
                                <input type="text" id="Zip" name="Zip" class="form-control form-control-sm">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-sm-2"
                                for="how_do_you_know_about_garcia">how_do_you_know_about_garcia*:</label>
                            <div class="col-sm-8">
                                <select name="how_do_you_know_about_garcia" id="how_do_you_know_about_garcia">
                                    <option value="select">Select</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="twitter">Twitter</option>
                                    <option value="youtube">YouTube</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="terms_and_conditions">Zip*:</label>
                            <div class="col-sm-8">
                                <input type="checkbox" name="terms_and_conditions" class="mb-3">
                                You must agree with our Terms and conditions
                            </div>
                        </div>
                        <br>
                        <button type="button" name="previous_btn_personal_details" id="btn_previous_app_details"
                            class="btn btn-info btn-sm">Previous</button>
                        <button type="submit" class="btn-sm btn-primary" name="save">Save</button>
                    </div>
                </div>
            </form>
            <div class="signFoot m-4">
                <label for="">Already have an account?
                    <a id="loginAnchor" href="">Login</a>
                </label>
            </div>
        </div>
        <div class="col-md-6">
            
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function () {
        // Initialize form validation on the multi-step form
        $("#multi_step_form").validate({
            // Specify validation rules for each step
            rules: {
                name: "required",
                // email: "required",
                // phone: "required",
                // date_of_birth: "required",
                // password: "required",
                // confirm_password: "required",
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    digits: true
                },
                date_of_birth: "required",
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: "#pass"
                }

            },
            // Specify validation error messages
            messages: {
                name: "Please enter your name",
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email address"
                },
                phone: {
                    required: "Please enter your phone number",
                    digits: "Please enter a valid phone number"
                },
                date_of_birth: "Please select your date of birth",
                password: {
                    required: "Please enter a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                confirm_password: {
                    required: "Please confirm your password",
                    equalTo: "Password and Confirm Password do not match"
                }
            },
            // Specify the error class to be used
            errorClass: "invalid-feedback",
            // Specify the validation error placement
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            // Specify how to highlight invalid fields
            highlight: function (element, errorClass) {
                $(element).addClass("is-invalid");
            },
            // Specify how to un-highlight valid fields
            unhighlight: function (element, errorClass) {
                $(element).removeClass("is-invalid");
            }
        });
    });
    $(document).ready(function () {
        // Step 1 to Step 2
        $("#btn_next_user_details").click(function                      if ($("#multi_step_form").va                             $("#user_details").removeClas
        $("#personal_details").add            ct        );
                }
        });

    //        p 2 to Step 1 Navigation
    $("#btn_previous_person            ls").click(function () {
        $("#perso            ils").removeClass("active");
        "#use        tails").addClass("active");
            });

        // Step 2 to Step 3 Navigation
                   _next_personal_details").click(function () {
    $("#personal_details").removeClass("active                        $("#app_details").addClass("        ve");
        });

    // Step 3 to Step 2 Navigation
    $("#btn_previous_app_details").click(function ()                   $("#app_details").removeClass("activ        
            l_details").addClass("active");
        });
    });
</script>
@endsection