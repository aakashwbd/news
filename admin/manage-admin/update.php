<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>

<!-- ===== Main Section ===== -->
<main id="main" class="main">
    <!-- ===== Page Title ===== -->
    <div class="pagetitle">
        <h1>Update Admin</h1>
    </div>
    <!-- ===== End Page Title ===== -->

    <!-- ===== Edit Admin Section ===== -->
    <section class="section category mt-5">
        <div class="row">
            <div class="col-lg-6 col-12">
                <form id="form" name="form" novalidate>
                    <!-- Admin Name -->
                    <div class="form-group mb-3">
                        <label class="my-1" for="name" id="name_label">Name</label>
                        <div class="input-group">
                            <input id="name" name="name" type="text" placeholder="John Doe"
                                   onchange="clearError(this)"
                                   class="form-control" required>
                        </div>
                        <span id="name_error" class="text-danger"></span>
                    </div>


                    <!-- Admin Role -->
                    <div class="form-group mb-3">
                        <label class="my-1" for="role" id="role_label">Role</label>

                        <select id="role" name="role" class="form-select form-control mb-3" onchange="clearError(this)">
                            <option value="admin">Admin</option>
                            <option value="superAdmin">Super Admin</option>
                        </select>
                        <span id="role_error" class="text-danger"></span>
                    </div>


                    <!-- Admin Access -->
                    <div class="row mb-3" id="accessControl">
                        <div class="col-lg-12 col-12">
                            <label for="">Access Control</label>

                            <div class="row ms-4">
                                <!-- Access Category -->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" name='access[]'
                                               value="category">
                                        <label class="form-check-label">
                                            Category
                                        </label>
                                    </div>
                                </div>

                                <!-- Access News -->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" name='access[]'
                                               value="news">
                                        <label class="form-check-label">
                                            News
                                        </label>
                                    </div>
                                </div>

                                <!-- Access News Approval-->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" name='access[]'
                                               value="news_approval">
                                        <label class="form-check-label">
                                            News Approval
                                        </label>
                                    </div>
                                </div>
                                <!-- Access Video-->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" name='access[]'
                                               value="video">
                                        <label class="form-check-label">
                                            Video
                                        </label>
                                    </div>
                                </div>

                                <!-- Access Comment-->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" name='access[]'
                                               value="comment">
                                        <label class="form-check-label">
                                            Comment
                                        </label>
                                    </div>
                                </div>

                                <!-- Access Report-->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" name='access[]'
                                               value="report">
                                        <label class="form-check-label">
                                            Report
                                        </label>
                                    </div>
                                </div>
                                <!-- Access Manage User -->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" name='access[]'
                                               value="manage_user">
                                        <label class="form-check-label">
                                            Manage User
                                        </label>
                                    </div>
                                </div>

                                <!-- Access Advertisement -->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" name='access[]' type="checkbox"
                                               value="advertisement">
                                        <label class="form-check-label">
                                            Advertisement
                                        </label>
                                    </div>
                                </div>
                                <!-- Access Notification -->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" name='access[]' type="checkbox"
                                               value="notifications">
                                        <label class="form-check-label">
                                            Notifications
                                        </label>
                                    </div>
                                </div>
                                <!-- Access Setting -->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" name='access[]' type="checkbox"
                                               value="settings">
                                        <label class="form-check-label">
                                            Settings
                                        </label>
                                    </div>
                                </div>

                                <!-- Access SMTP -->
                                <div class="col-lg-4 col-12 mb-2">
                                    <div class="form-check ">
                                        <input class="form-check-input" name='access[]' type="checkbox"
                                               value="smtp">
                                        <label class="form-check-label">
                                            SMTP
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Phone -->
                    <div class="form-group mb-3">
                        <label class="my-1" for="phone" id="phone_label">Phone</label>
                        <div class="input-group">
                            <input id="phone" name="phone" type="text" placeholder="019*****"
                                   onchange="clearError(this)"
                                   class="form-control" required>
                        </div>
                        <span id="phone_error" class="text-danger"></span>
                    </div>

                    <!-- Admin Image -->
                    <div class="form-group">
                        <label for="image" id="image_label">Profile Image</label>
                        <div class="dropzone" id="image_box"></div>
                        <input type="hidden" id="image" name="image">
                        <span id="image_error" class="text-danger"></span>
                    </div>

                    <button id="submit-button" type="submit" class="btn btn-primary waves-effect mb-3">
                        Update
                    </button>

                    <a href="index.php" class="btn-outline-secondary btn mb-3">Cancel</a>
                </form>
            </div>
        </div>
    </section>
    <!-- ===== End Edit Admin Section ===== -->
</main>
<!-- ===== End Main Section ===== -->
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    /**
     * Upload Image By Dropzone
     * */
    let myDropzone = uploads("image_box", "image");


    /**
     * GET Edit Data
     * */
    getEditData(window.origin + '/api/v1/admin/get_edit.php?id=<?php echo $_GET['id'] ?>', myDropzone);

    /**
     * Update Form Submit
     * */
    $('#form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let apiURL = window.origin + '/api/v1/admin/update.php?id=<?= $_GET['id'] ?>'
        formSubmit("post", "submit-button", form, apiURL);
    })

    /**
     * Access Control Hidden By Selecting Super Admin
     * */
    $(document).on('change', '#role', function () {
        let role = $(this).val()
        if (role === 'superAdmin') {
            $('#accessControl').hide()
        } else {
            $('#accessControl').show()
        }
    })


    $(document).ready(function () {
        pageRestricted('manage_admin')
    })

</script>