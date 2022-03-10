<?php include __DIR__ . '/../inc/header.php'; ?>

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-6 col-12 offset-lg-3">
            <div class="card">
                <div class="card-body p-4">
                    <!-- ===== Recovery Password Content ===== -->
                    <div id="email_content">
                        <div id="content_heading" class="text-center">
                            <h5>Password Recovery</h5>
                            <span>Enter your mail & the instructions will be sent to you</span>
                        </div>

                        <form action="/admin/api/v1/auth/admin/forgot_password.php" id="email_form" name="email_form"
                              novalidate>
                            <div class="form-group mb-3">
                                <label class="my-1" for="email" id="email_label">Email</label>

                                <div class="input-group">
                                    <span id="email_icon_border" class="input-group-text">
                                        <i id="email_icon" class="bi bi-envelope"></i>
                                    </span>
                                    <input id="email" name="email" type="email" placeholder="demo@email.com"
                                           onchange="clearError(this)"
                                           class="form-control" required>
                                </div>

                                <span id="email_error" class="text-danger"></span>
                                <!-- <span id="wait_msg" class="text-danger d-none">Wait For Few Second For Sending OTP in Your Mail</span> -->
                            </div>

                            <button id="submit-button" type="submit"
                                    class="form-control btn btn-primary waves-effect mb-3">
                                <i id="submit-icon" class="bi bi-box-arrow-in-right pe-2" aria-hidden="true"></i>
                                <span id="submit-button-loader" class="spinner-border spinner-border-sm d-none"
                                      role="status" aria-hidden="true"></span>
                                Recover Password
                            </button>
                        </form>

                        <div class="text-center">
                            <span>Go to the Login page ? <a href="login.php" class="text-secondary">Login</a></span>
                        </div>
                    </div>
                    <!-- ===== End Recovery Password Content ===== -->


                    <!-- ===== OTP Content ===== -->
                    <div id="otp_content" class="d-none">
                        <div id="otp_heading" class="text-center ">
                            <span class="iconify" data-icon="bx:bxs-lock" style="color: #ff3d00;" data-width="100"
                                  data-height="100"></span>
                            <h6>We Have Sent A Code To Your Email</h6>
                        </div>

                        <form class="otc" action="/admin/api/v1/auth/admin/verify_otp.php" id="otp_form" name="otp_form"
                              novalidate>
                            <fieldset>
                                <label for="otc-1">Number 1</label>
                                <label for="otc-2">Number 2</label>
                                <label for="otc-3">Number 3</label>
                                <label for="otc-4">Number 4</label>
                                <label for="otc-5">Number 5</label>
                                <label for="otc-6">Number 6</label>

                                <div>
                                    <input type="hidden" id="otp_email" name="email">

                                    <input type="number" pattern="[0-9]*" value="" inputtype="numeric"
                                           autocomplete="one-time-code" id="otc-1" name="code[]" required>

                                    <!-- Autocomplete not to put on other input -->
                                    <input type="number" pattern="[0-9]*" min="0" max="9" name="code[]" maxlength="1"
                                           value=""
                                           inputtype="numeric" id="otc-2" required>
                                    <input type="number" pattern="[0-9]*" min="0" max="9" name="code[]" maxlength="1"
                                           value=""
                                           inputtype="numeric" id="otc-3" required>
                                    <input type="number" pattern="[0-9]*" min="0" max="9" name="code[]" maxlength="1"
                                           value=""
                                           inputtype="numeric" id="otc-4" required>
                                    <input type="number" pattern="[0-9]*" min="0" max="9" name="code[]" maxlength="1"
                                           value=""
                                           inputtype="numeric" id="otc-5" required>
                                    <input type="number" pattern="[0-9]*" min="0" max="9" name="code[]" maxlength="1"
                                           value=""
                                           inputtype="numeric" id="otc-6" required>

                                </div>
                            </fieldset>
                            <span id="code_error"></span>
                            <h6 class="text-center my-5">Did’t get code? <span class="text-danger" style="cursor: pointer" onclick="resendMail()">Resend</span></h6>

                            <button id="submit-button" type="submit"
                                    class="form-control btn btn-primary waves-effect mb-3">
                                
                                <span id="submit-button-loader" class="spinner-border spinner-border-sm d-none"
                                      role="status" aria-hidden="true"></span>
                                Validate OTP
                            </button>

                        </form>
                    </div>
                    <!-- ===== End OTP Content ===== -->


                    <!-- ===== Change Password ===== -->
                    <div id="change_password_content" class="d-none">
                        <div id="otp_heading" class="text-center">
                            <span class="iconify" data-icon="map:sheild" style="color: #da0f0f;" data-width="100"
                                  data-height="100"></span>
                            <h6>Please Set your new password</h6>
                        </div>

                        <form class="otc" action="/admin/api/v1/auth/admin/change_password.php" id="password_form"
                              name="password_form"
                              novalidate>
                            <input type="hidden" id="confirm_email" name="confirm_email">
                            <div class="form-group mb-3">
                                <label class="my-1" for="password" id="password_label">New Password</label>
                                <div class="input-group">

                                    <input id="password" name="password" type="password" placeholder="Type New Password"
                                           onchange="clearError(this)"
                                           class="form-control" required>
                                </div>
                                <span id="password_error" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-3">
                                <label class="my-1" for="password_confirmation" id="password_confirmation_label">New
                                    Password</label>
                                <div class="input-group">

                                    <input id="password_confirmation" name="password_confirmation" type="password"
                                           placeholder="Re-Type New Password"
                                           onchange="clearError(this)"
                                           class="form-control" required>
                                </div>
                                <span id="password_confirmation_error" class="text-danger"></span>
                            </div>

                            <button id="submit-button" type="submit"
                                    class="form-control btn btn-primary waves-effect mb-3">
                                
                                <span id="submit-button-loader" class="spinner-border spinner-border-sm d-none"
                                      role="status" aria-hidden="true"></span>
                                confirm
                            </button>

                        </form>
                    </div>
                    <!-- ===== End OTP Content ===== -->

                    <!-- ===== Confirm Message ===== -->
                    <div id="confirm_msg" class="d-none">
                        <div id="msg"></div>
                        <a href="/auth/login.php" class="btn btn-danger">Go to Login</a>
                    </div>
                    <!-- ===== End Confirm Message ===== -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Vendor JS Files -->
<script src="../assets/vendor/jquery/jquery-3.6.0.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../assets/js/toastr.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js"></script>
<script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>

<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>
<script>
    /**
     * recover email form submit
     */
    $('#email_form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        formSubmit("post", "submit-button", form);
    })

    /**
     * verify OTP code form
     */
    $('#otp_form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        formSubmit("post", "submit-button", form);
    })

    /**
     * Change password form
     */
    $('#password_form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        formSubmit("post", "submit-button", form);
    })

    function resendMail(){
        $('#email_form').submit(function (e) {
            e.preventDefault();
            let form = $(this);
            formSubmit("post", "submit-button", form);
        })
    }

    /**
     * For Form Submitting
     */
    function formSubmit(type, btn, form, headers = null) {
        let url = form.attr('action');
        let form_data = JSON.stringify(form.serializeJSON());
        $.ajax({
            type: type,
            url: url,
            data: form_data,
            headers: headers,

            beforeSend: function () {
                $('#submit-button').prop('disabled', true);
                $('#submit-button-loader').removeClass('d-none');
                $('#submit-icon').addClass('d-none');
            },

            success: function (response) {

                if (response && response.status && response.status === 'success') {

                    if (response.form === 'email_form') {
                        $('#email_content').addClass('d-none');
                        $('#otp_content').removeClass('d-none');
                        $('#otp_email').val(response.email);
                    } else if (response.form === 'otp_form') {
                        $('#email_content').addClass('d-none');
                        $('#otp_content').addClass('d-none');
                        $('#change_password_content').removeClass('d-none');
                        $('#confirm_email').val(response.email);
                    } else if (response.form === 'change_form') {
                        $('#email_content').addClass('d-none');
                        $('#otp_content').addClass('d-none');
                        $('#change_password_content').addClass('d-none');
                        $('#confirm_msg').removeClass('d-none');
                        $('#msg').text(response.data);
                    }


                } else if (response && response.status && response.status === 'validate_error') {
                    console.log(response.data[0].error)
                    $('#code_error').text(response.data[0].error).css('color', 'red')
                    $('#password_confirmation_error').text(response.data[0].error).css('color', 'red')

                }
            },
            error: function (xhr, resp, text) {


                // on error, tell the failed
                if (xhr && xhr.responseText) {
                    let response = JSON.parse(xhr.responseText);

                    if (response.status && response.status === 'validate_error') {
                        console.log(response.data)
                        $.each(response.data, function (index, message) {
                            if (message.field && message.field !== 'global') {
                                $('#' + message.field).addClass('is-invalid');
                                $('#' + message.field + '_label').addClass('text-danger');
                                $('#' + message.field + '_icon').addClass('text-danger');
                                $('#' + message.field + '_icon_border').addClass('field-error');
                                $('#' + message.field + '_error').html(message.error);

                            } else if (message.error) {
                                // toastr.error(message.error);
                                console.log("err 0")
                            } else {
                                // toastr.error('Something went wrong', 'Please try again after sometime.');
                                console.log('err 1')
                            }
                        });
                    } else {
                        // toastr.error('Something went wrong', 'Please try again after sometime.');
                        console.log('err 2')
                    }
                } else {
                    // toastr.error('Something went wrong', 'Please try again after sometime.');
                    console.log('err 3')

                }
            },
            complete: function (xhr, status) {
                $('#submit-button').prop('disabled', false);
                $('#submit-button-loader').addClass('d-none');
                $('#submit-icon').removeClass('d-none');
            }
        });
    }


    /**
     * For OTP code
     */
    let in1 = document.getElementById('otc-1'),
        ins = document.querySelectorAll('input[type="number"]'),
        splitNumber = function (e) {
            let data = e.data || e.target.value; // Chrome doesn't get the e.data, it's always empty, fallback to value then.
            if (!data) return; // Shouldn't happen, just in case.
            if (data.length === 1) return; // Here is a normal behavior, not a paste action.

            popuNext(e.target, data);
            //for (i = 0; i < data.length; i++ ) { ins[i].value = data[i]; }
        },
        popuNext = function (el, data) {
            el.value = data[0]; // Apply first item to first input
            data = data.substring(1); // remove the first char.
            if (el.nextElementSibling && data.length) {
                // Do the same with the next element and next data
                popuNext(el.nextElementSibling, data);
            }
        };
    ins.forEach(function (input) {
        /**
         * Control on keyup to catch what the user intent to do.
         * I could have check for numeric key only here, but I didn't.
         */
        input.addEventListener('keyup', function (e) {
            // Break if Shift, Tab, CMD, Option, Control.
            if (e.keyCode === 16 || e.keyCode == 9 || e.keyCode == 224 || e.keyCode == 18 || e.keyCode == 17) {
                return;
            }

            // On Backspace or left arrow, go to the previous field.
            if ((e.keyCode === 8 || e.keyCode === 37) && this.previousElementSibling && this.previousElementSibling.tagName === "INPUT") {
                this.previousElementSibling.select();
            } else if (e.keyCode !== 8 && this.nextElementSibling) {
                this.nextElementSibling.select();
            }

            // If the target is populated to quickly, value length can be > 1
            if (e.target.value.length > 1) {
                splitNumber(e);
            }
        });

        /**
         * Better control on Focus
         * - don't allow focus on other field if the first one is empty
         * - don't allow focus on field if the previous one if empty (debatable)
         * - get the focus on the first empty field
         */
        input.addEventListener('focus', function (e) {
            // If the focus element is the first one, do nothing
            if (this === in1) return;

            // If value of input 1 is empty, focus it.
            if (in1.value == '') {
                in1.focus();
            }

            // If value of a previous input is empty, focus it.
            // To remove if you don't wanna force user respecting the fields order.
            if (this.previousElementSibling.value == '') {
                this.previousElementSibling.focus();
            }
        });
    });

    /**
     * Handle copy/paste of a big number.
     * It catches the value pasted on the first field and spread it into the inputs.
     */
    in1.addEventListener('input', splitNumber);


</script>
</body>
</html>