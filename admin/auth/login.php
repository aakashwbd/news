<?php include __DIR__ . '/../../inc/header.php'; ?>
<style>

</style>
<div class="container">
    <div class="row login_box">
        <div class="col-lg-6 col-12 offset-lg-3">
            <div class="card p-5">
                <div class="card-body">
                    <div class="text-center">
                        <h4>Sign In</h4>
                        <span>Log in to your account to continue</span>
                    </div>
                    
                    <form id="form" name="form" novalidate>
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
                        </div>

                        <div class="form-group mb-3">
                            <label class="my-2" for="password" id="password_label">Password</label>
                            <div class="input-group">
                                    <span id="password_icon_border" class="input-group-text">
                                        <i id="password_icon" class="bi bi-lock"></i>
                                    </span>
                                <input id="password" name="password" type="password" placeholder="******"
                                       onchange="clearError(this)"
                                       class="form-control">
                            </div>
                            <span id="password_error" class="text-danger"></span>
                        </div>
                        <div class="text-end mb-3">
                            <a href="recovery_password.php" class="text-secondary">Forgot password?</a>
                        </div>

                        <button id="submit-button" type="submit" class="form-control btn btn-primary waves-effect mb-3">
                            <i id="submit-icon" class="bi bi-box-arrow-in-right pe-2" aria-hidden="true"></i>
                            <span id="submit-button-loader" class="spinner-border spinner-border-sm d-none"
                                  role="status" aria-hidden="true"></span>
                            Sign in
                        </button>
                    </form>

                    <div class="text-center">
                        <span>© 2021 All Rights Reserved. ProjectX</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Vendor JS Files -->
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="../../assets/vendor/jquery/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/toastr.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js"></script>


<!-- Template Main JS File -->
<script src="../../assets/js/main.js"></script>

<script>

    // Clear form error
    function clearError(input) {
        $('#' + input.id).removeClass('is-invalid');
        $('#' + input.id + '_label').removeClass('text-danger');
        $('#' + input.id + '_icon').removeClass('text-danger');
        $('#' + input.id + '_icon_border').removeClass('field-error');
        $('#' + input.id + '_error').html('');
    }

    
    $('#form').submit(function (e) {
        e.preventDefault();

        // get form data
        let form = $(this);
        let url = window.origin + '/api/v1/auth/admin/login.php';
        let form_data = JSON.stringify(form.serializeJSON());

        $.ajax({
            type: "POST",
            url: url,
            data: form_data,
            beforeSend: function () {
                $('#submit-button').prop('disabled', true);
                $('#submit-button-loader').removeClass('d-none');
                $('#submit-icon').addClass('d-none');
            },
            success: function (response) {
                if (response && response.status && response.status === 'success') {

                    toastr.success(response.success_message);
                    form[0].reset();
                    localStorage.setItem("token", response.data.token);
                    window.location.href = '/admin/dashboard';
                    
                } else {
                    toastr.error('Something went wrong', 'Please try again after sometime.')
                }
            },
            error: function (xhr, resp, text) {
                // on error, tell the failed
                if (xhr && xhr.responseText) {
                    let response = JSON.parse(xhr.responseText);
                    console.log(response)
                    if (response.status && response.status === 'validate_error') {
                        $.each(response.data, function (index, message) {
                            if (message.field && message.field !== 'global') {
                                $('#' + message.field).addClass('is-invalid');
                                $('#' + message.field + '_label').addClass('text-danger');
                                $('#' + message.field + '_icon').addClass('text-danger');
                                $('#' + message.field + '_icon_border').addClass('field-error');
                                $('#' + message.field + '_error').html(message.error);
                            } else if (message.error) {
                                toastr.error(message.error);
                            } else {
                                toastr.error('Something went wrong', 'Please try again after sometime.');
                            }
                        });
                    } else {
                        toastr.error('Something went wrong', 'Please try again after sometime.');
                    }
                } else {
                    toastr.error('Something went wrong', 'Please try again after sometime.');
                }
            },
            complete: function (xhr, status) {
                $('#submit-button').prop('disabled', false);
                $('#submit-button-loader').addClass('d-none');
                $('#submit-icon').removeClass('d-none');
            }
        });
    });
</script>
