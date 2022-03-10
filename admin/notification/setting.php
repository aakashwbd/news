<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage Notification</h1>
    </div>

    <section class="section mt-5">
        <div class="row">
            <div class="col-lg-6 col-12">
                <form id="form" name="form" novalidate>

                    <div class="form-group mb-3">
                        <label class="my-1" for="app_id" id="app_id_label">OneSignal API ID</label>
                        <input id="app_id" name="app_id" type="text" placeholder="APP ID..."
                               onchange="clearError(this)"
                               class="form-control" required>
                        <span id="app_id_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="api_key" id="api_key_label">OneSignal API KEY</label>
                        <input id="api_key" name="api_key" type="text" placeholder="API KEY..."
                               onchange="clearError(this)"
                               class="form-control" required>

                        <span id="api_key_error" class="text-danger"></span>
                    </div>

                    <button id="submit-button" type="submit" class="btn btn-primary mb-3">
                        Create
                    </button>

                    <a href="<?= $url?>notification" class="btn btn-outline-secondary mb-3">Cancel</a>

                </form>
            </div>
        </div>
    </section>

</main>
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    
    /**
    * OneSignal API KEY & ID Create Form Submit
    * */
    $('#form').submit(function (e){
        e.preventDefault();
        let form = $(this);
        let apiURL = window.origin + '/api/v1/notification/setting.php'
        formSubmit("post", "submit-button", form, apiURL);
    })
    /**
     * OneSignal API KEY & ID GET DATA
     * */
    $(document).ready(function (){
        pageRestricted('notifications');
        getEditData(window.origin + "/api/v1/notification/get_setting.php");
    })


</script>