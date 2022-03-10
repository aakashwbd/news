<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit User</h1>
    </div>

    <section class="section category mt-5 ">
        <div class="row">
            <div class="col-lg-6 col-12">
                <form id="form" name="form" novalidate>
                    <div class="form-group mb-3">
                        <label class="my-1" for="name" id="name_label">Name</label>
                        <div class="input-group">
                            <input id="name" name="name" type="text" placeholder="John Doe"
                                   onchange="clearError(this)"
                                   class="form-control" required>
                        </div>
                        <span id="name_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="email" id="email_label">Email</label>
                        <div class="input-group">
                            <input id="email" name="email" type="email" placeholder="demo@mail.com"
                                   onchange="clearError(this)"
                                   class="form-control" required>
                        </div>
                        <span id="email_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="phone" id="phone_label">Phone</label>
                        <div class="input-group">
                            <input id="phone" name="phone" type="tel" placeholder="019 **** "
                                   onchange="clearError(this)"
                                   class="form-control" required>
                        </div>
                        <span id="phone_error" class="text-danger"></span>
                    </div>
                    
                    <div class="form-group">
                        <label  for="image" id="image_label">Profile Image</label>
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

</main>
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    /**
     * Image Upload By Dropzone
     * */
    let myDropzone = uploads("image_box","image")


    /**
     * GET User Data For Edit
     * */
    let url = window.origin + '/api/v1/user/getEdit.php?id=<?= $_GET['id'] ?>';
    getEditData(url, myDropzone)


    /**
     * Update Form Submit
     * */

    $('#form').submit(function (e){
        e.preventDefault();
        let form = $(this);
        let apiURL = window.origin + '/api/v1/user/update.php?id=<?= $_GET['id'] ?>'
        formSubmit("post", "submit-button", form, apiURL);
    })



    $(document).ready(function () {
        pageRestricted('manage_user')
    })
</script>