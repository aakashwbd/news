<?php include __DIR__.'/../inc/header.php'; ?>
<?php include __DIR__.'/../inc/sidebar.php'; ?>

<!-- ===== Main Section ===== -->
<main id="main" class="main">
    <!-- ===== Page Title ===== -->
    <div class="row">
        <div class="col-lg-10 col-12">
            <div class="pagetitle">
                <h1>Admin Profile</h1>
            </div>
        </div>
        
        <div class="col-lg-2 col-12">
            <a href="password.php" class="btn btn-primary">Change Password</a>
        </div>
    </div>
   
    <!-- ===== End Page Title ===== -->

    <!-- ===== Edit Admin Section ===== -->
    <section class="section category mt-5">
        
        <div class="row">
            <div class="col-lg-6 col-12">
                
                <form action="../api/v1/admin/profile_update.php" id="form" name="form" novalidate>

                    <div class="form-group mb-3">
                        <label class="my-1" for="name" id="name_label">Name</label>
                        <div class="input-group">
                            <input id="name" name="name" type="text" placeholder="John Doe"
                                   onchange="clearError(this)"
                                   class="form-control" required>
                        </div>
                        <span id="name_error" class="text-danger"></span>
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

                    <a href="index.php" class="btn btn-outline-secondary mb-3">Cancel</a>
                </form>
            </div>
        </div>
    </section>
    <!-- ===== End Edit Admin Section ===== -->
</main>
<!-- ===== End Main Section ===== -->
<?php include __DIR__.'/../inc/footer.php'; ?>
<script>
    /**
    * Image Upload By Dropzone
    * */
    let myDropzone = uploads("image_box", "image")

    /**
     * GET Admin Profile For Show & Update
     * */
    let decodedToken = JSON.parse(atob(token.split('.')[1]));
    let url = '../api/v1/admin/get_edit.php?id='+ decodedToken.data.id;
    getEditData(url, myDropzone)

    $('#form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let headers = {'Authorization': localStorage.getItem('token')}
        formSubmit("post", "submit-button", form, headers);
    })

    $(document).ready(function () {
        pageRestricted('manage_admin')
    })

</script>