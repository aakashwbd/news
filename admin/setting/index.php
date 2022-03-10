<?php include __DIR__.'/../../inc/header.php'; ?>
<?php include __DIR__.'/../../inc/sidebar.php'; ?>

<!-- ===== Main Section ===== -->
<main id="main" class="main">
    <!-- ===== Page Title Section ===== -->
    <div class="pagetitle">
        <h1>Basic Settings</h1>

    </div>
    <!-- ===== End Page Title Section ===== -->

    <!-- ===== Create Settings Section ===== -->
    <section class="section mt-5">
        <!-- create form -->
        <form  id="form" name="form" novalidate>
            <!-- basic settings -->
            <div class="row">

                <div class="col-lg-6 col-12">
                    <div class="form-group mb-3">
                        <label class="my-1" for="name" id="name_label">System Name</label>
                        <input id="name" name="name" type="text" placeholder="App Name"
                               onchange="clearError(this)"
                               class="form-control" required>

                        <span id="name_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="app_version" id="app_version_label">App Version</label>
                        <input id="app_version" name="app_version" type="text" placeholder="0.0.01"
                               onchange="clearError(this)"
                               class="form-control" >

                        <span id="app_version_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="mail" id="mail_label">Mail</label>
                        <input id="mail" name="mail" type="email" placeholder="example@example.com"
                               onchange="clearError(this)"
                               class="form-control">

                        <span id="mail_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="update_app" id="update_app_label">Update App</label>
                        <input id="update_app" name="update_app" type="text" placeholder="https://play.google.com/store/apps/developer?id=example.live"
                               onchange="clearError(this)"
                               class="form-control" >

                        <span id="update_app_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="developed_by" id="developed_by_label">Developed By</label>
                        <input id="developed_by" name="developed_by" type="text" placeholder="Developed By"
                               onchange="clearError(this)"
                               class="form-control" >

                        <span id="developed_by_error" class="text-danger"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="form-group mb-3">
                        <label class="my-1" for="facebook_link" id="facebook_link_label">Facebook</label>
                        <input id="facebook_link" name="facebook_link" type="text" placeholder="www.facebook.com/app_name"
                               onchange="clearError(this)"
                               class="form-control" >

                        <span id="facebook_link_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="instagram_link" id="instagram_link_label">Instagram</label>
                        <input id="instagram_link" name="instagram_link" type="text" placeholder="www.instagram.com/app_name"
                               onchange="clearError(this)"
                               class="form-control" >

                        <span id="instagram_link_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="twitter_link" id="twitter_link_label">Twitter</label>
                        <input id="twitter_link" name="twitter_link" type="text" placeholder="www.twitter.com/app_name"
                               onchange="clearError(this)"
                               class="form-control" >

                        <span id="twitter_link_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="youtube_link" id="youtube_link_label">Youtube</label>
                        <input id="youtube_link" name="youtube_link" type="text" placeholder="www.youtube.com/app_name"
                               onchange="clearError(this)"
                               class="form-control" >

                        <span id="youtube_link_error" class="text-danger"></span>
                    </div>
                </div>
            </div>

            <!-- other settings -->
            <div class="pagetitle">
                <h1>Other</h1>
            </div>

            <div class="row mt-5">
                <div class="col-lg-6 col-12">
                    <div class="form-group mb-3">
                        <label class="my-1" for="copyright" id="Copyright_label">Copyright</label>
                        <input id="copyright" name="copyright" type="text" placeholder="Copyright"
                               onchange="clearError(this)"
                               class="form-control" >

                        <span id="Copyright_error" class="text-danger"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <label class="" for="logo_box" id="logo_box_label">Logo</label>
                    <div class="dropzone" id="logo_box" style="margin-top: 5px"></div>
                    <input type="hidden" id="logo" name="logo">
                </div>
            </div>

            <div class="form-group my-5">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
            </div>

            <!-- privacy policy -->
            <div class="form-group mb-5">
                <label for="privacy_policy">Privacy Policy</label>
                <textarea name="privacy_policy" id="privacy_policy" class="" placeholder="Privacy Policy"></textarea>
            </div>

            <!-- Cookies Policy -->
            <div class="form-group mb-5">
                <label for="cookies_policy">Cookies Policy</label>
                <textarea name="cookies_policy" id="cookies_policy" class="mb-5" placeholder="Cookies Policy"></textarea>
            </div>


            <!-- Terms & Policy -->
            <div class="form-group mb-5">
                <label for="terms_policy">Terms Policy</label>
                <textarea name="terms_policy" id="terms_policy" class="mb-5" placeholder="Terms & Policy"></textarea>
            </div>

            <button id="submit-button" type="submit" class="btn btn-primary mb-3">
                Create
            </button>

            <a href="../dashboard/index.php" class="btn btn-outline-secondary mb-3">
                Cancel
            </a>
        </form>

    </section>
    <!-- ===== End Create Settings Section ===== -->
</main>
<!-- ===== Emd Main Section ===== -->
<?php include __DIR__.'/../../inc/footer.php'; ?>

<script>
    /**
    * TextFiled To CKEditor
    * */
    let descriptionEditor;
    ClassicEditor.create(document.querySelector('#description'))
        .then(editor => {
            window.editor = editor;
            descriptionEditor = editor;
        });

    let privacyEditor;
    ClassicEditor.create(document.querySelector('#privacy_policy'))
        .then(editor => {
            window.editor = editor;
            privacyEditor = editor;
        });
    
    let cookiesEditor;
    ClassicEditor.create(document.querySelector('#cookies_policy'))
        .then(editor => {
            window.editor = editor;
            cookiesEditor = editor;
        });
    let termsEditor;
    ClassicEditor.create(document.querySelector('#terms_policy'))
        .then(editor => {
            window.editor = editor;
            termsEditor = editor;
        });


    /**
     * Form Submit
     * */
    $('#form').submit(function (e){
        e.preventDefault();
        let form = $(this);
        let apiURL = window.origin + '/api/v1/setting/save.php'
        formSubmit("post", "submit-button", form, apiURL);
    })
    
    /**
     * Image Upload By Dropzone
     * */
    let myDropzone = uploads("logo_box","logo")


    /**
     * GET Editable Data
     * */
    getEditData(window.origin+ "/api/v1/setting/getAll.php", myDropzone)


    /**
     * Page Restriction For Admin
     * */
    $(document).ready(function (){
        pageRestricted('settings')
        
    })
    
 
</script>
