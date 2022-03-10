<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage SMTP</h1>
    </div>

    <section class="section ">
        <div class="row">
            <div class="col-lg-10 col-12 offset-lg-1">
                <a class="btn text-danger my-2" href="javascript:history.go(-1)"><i
                            class="bi bi-arrow-left"></i>Back</a>
                <div class="card p-3">
                    <div class="card-body">
                        <span class="card-title">SMTP Settings</span>
                        <hr>
                        <form id="form" name="form" novalidate>

                           

                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-2 col-12">
                                    <label class="my-1" for="host" id="host_label">HOST <span
                                                class="text-danger">*</span>:</label>
                                </div>
                                <div class="col-lg-10 col-12">
                                    <input id="host" name="host" type="text" placeholder="HOST"
                                           onchange="clearError(this)"
                                           class="form-control" required>
                                    <span id="host_error" class="text-danger"></span>
                                </div>
                            </div>


                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-2 col-12">
                                    <label class="my-1" for="port" id="port_label">PORT <span
                                                class="text-danger">*</span>:</label>

                                </div>
                                <div class="col-lg-10 col-12">
                                    <input id="port" name="port" type="text" placeholder="PORT"
                                           onchange="clearError(this)"
                                           class="form-control" required>

                                    <span id="port_error" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-2 col-12">
                                    <label class="my-1" for="username" id="username_label">Username <span
                                                class="text-danger">*</span>:</label>

                                </div>
                                <div class="col-lg-10 col-12">
                                    <input id="username" name="username" type="text" placeholder="Username"
                                           onchange="clearError(this)"
                                           class="form-control" required>

                                    <span id="username_error" class="text-danger"></span>
                                </div>
                            </div>


                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-2 col-12">
                                    <label class="my-1" for="password" id="password_label">Password <span
                                                class="text-danger">*</span>:</label>
                                </div>
                                <div class="col-lg-10 col-12">
                                    <input id="password" name="password" type="text" placeholder="Password"
                                           onchange="clearError(this)"
                                           class="form-control" required>

                                    <span id="password_error" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-2 col-12">
                                    <label class="my-1" for="encryption" id="encryption_label">Encryption<span
                                                class="text-danger">*</span>:</label>
                                </div>
                                <div class="col-lg-10 col-12">
                                    <select name="encryption" id="encryption" class="form-control" onchange="clearError(this)">
                                        <option value="select">Select Any Encryption Method</option>
                                        <option value="ssl">SSL</option>
                                        <option value="tsl">TSL</option>
                                    </select>
                                    <span id="encryption_error" class="text-danger"></span>
                                </div>
                            </div>
                            
                          

                            <button id="submit-button" type="submit" class="btn btn-primary mb-3">
                                Create
                            </button>

                            <a href="<?= $url?>dashboard" class="btn btn-outline-secondary mb-3">Cancel</a>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main>
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    /**
     * SMTP Form Create Submit
     * */
    $('#form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let apiURL = window.origin + '/api/v1/smtp/save.php'
        formSubmit("post", "submit-button", form, apiURL);
    })
    
    
    /**
     * Page Restriction and GET Editable Data
     * */
    $(document).ready(function () {
        pageRestricted('smtp')
        let url = window.origin + "/api/v1/smtp/getEdit.php";
        getEditData(url)
    })


</script>