<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="signup">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <a href="{{route('intialPage')}}"><img src="{{asset('assets/loginLogo.svg')}}" alt="logo"></a>
                </div>
                <h3 class="mt-4" style="text-align:center;color:#fff;font-weight:700">SIGNUP</h3>
                <form class="form-horizontal" action="{{ route('postregister') }}" method="post" id="multi_step_form">
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
                                    <input type="password" id="pass" name="password"
                                        class="form-control form-control-sm">
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
                            <button type="button" name="previous_btn_personal_details"
                                id="btn_previous_personal_details" class="btn btn-info btn-sm">Previous</button>
                            <button type="button" class="btn-sm btn-primary"
                                id="btn_next_personal_details">Next</button>
                        </div>
                        <div class="tab-pane" id="app_details">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="zip">Zip*:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="zip" name="zip" class="form-control form-control-sm">
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
                                <label class="control-label col-sm-2" for="terms_and_condition">Zip*:</label>
                                <div class="col-sm-8">
                                    <input type="checkbox" name="terms_and_condition" class="mb-3">
                                    You must agree with our Terms and conditions
                                </div>
                            </div>
                            <br>
                            <button type="button" name="previous_btn_personal_details" id="previous_btn_app_details"
                                class="btn btn-info btn-sm">Previous</button>
                            <button type="submit" class="btn-sm btn-primary" name="save" id="save">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6" id="signRight">
                <!-- <img src="" alt="logo" id="signImage" width="100%" height="600px"> -->
            </div>
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
                },
                address: "required",
                state: "required",
                city: "required",
                zip: {
                    required: true,
                    minlength: 6
                },
                terms_and_condition: "required",
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
                },
                address: "Please enter your address",
                state: "Please enter your state",
                city: "Please enter your city",
                zip: {
                    required: "Please enter your ZIP code",
                    minlength: "ZIP code must be at least 6 characters long"
                },
                terms_and_condition: "Please accept the terms and conditions",
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
        // Step 1 to Step 2 Navigation
        $("#btn_next_user_details").click(function () {
            if ($("#multi_step_form").valid()) {
                $("#user_details").removeClass("active");
                $("#personal_details").addClass("active");
            }
        });

        // Step 2 to Step 1 Navigation
        $("#btn_previous_personal_details").click(function () {
            $("#personal_details").removeClass("active");
            $("#user_details").addClass("active");
        });

        // Step 2 to Step 3 Navigation
        $("#btn_next_personal_details").click(function () {
            if ($("#multi_step_form").valid()) {
                $("#personal_details").removeClass("active");
                $("#app_details").addClass("active");
            }
        });

        // Step 3 to Step 2 Navigation
        $("#previous_btn_app_details").click(function () {
            $("#app_details").removeClass("active");
            $("#personal_details").addClass("active");
        });


        $("#save").click(function () {
            // console.log('validate data',$("#multi_step_form").data();)
            if ($("#multi_step_form").valid()) {
                $("#app_details").removeClass("active");
            }
        })
    });
</script>