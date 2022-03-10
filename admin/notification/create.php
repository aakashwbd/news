<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle ">
        <h1>Add Notification</h1>
    </div>

    <section class="section mt-5">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <form id="form" name="form" novalidate>

                    <div class="form-group mb-3">
                        <label class="my-1" for="title" id="title_label">Title</label>
                        <input id="title" name="title" type="text" placeholder="Notification Title..."
                               onchange="clearError(this)"
                               class="form-control">

                        <span id="title_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="description" id="description_label">Description</label>
                        <textarea id="description" name="description" class="form-control"
                                  placeholder="Notification Description..." onchange="clearError(this)"></textarea>
                        <span id="description_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="item_id" id="item_id_label">Select News</label>

                        <select class="form-select mb-3" name="news_id" id="news_id">
                            <option selected value="0">Select Item</option>

                        </select>
                        <span id="news_id_error" class="text-danger"></span>
                    </div>

                    <div class="form-group mb-3">
                        <label class="my-1" for="link" id="link_label">External Link</label>
                        <input id="link" name="link" type="text" placeholder="External Link..."
                               onchange="clearError(this)"
                               class="form-control">

                        <span id="link_error" class="text-danger"></span>
                    </div>

                    <div class="dropzone" id="logo_box"></div>
                    <input type="hidden" id="logo" name="logo">


                    <button id="submit-button" type="submit" class="btn btn-primary mb-3">
                        Create
                    </button>

                    <a href="<?= $url ?>notification" class="btn btn-outline-secondary mb-3">Cancel</a>

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
    let myDropzone = uploads("logo_box", "logo")


    /**
     * Hide link
     * */
    $(document).on('change', '#news_id', function (e) {
        let value = $(this).val();
        if (value !== '0') {
            $('#link').prop('disabled', true);
        } else {
            $('#link').prop('disabled', false);
        }
    });

    $("#link").keyup(function () {
        let value = $(this).val();

        if (value !== '') {
            $("#news_id").prop('disabled', true);
        } else {
            $('#news_id').prop('disabled', false);
        }

    });

    /**
     * Notification Create Form
     * */
    $('#form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let apiURL = window.origin + '/api/v1/notification/create.php'
        formSubmit("post", "submit-button", form, apiURL);
    })

    /**
     * GET All News For Notification
     * */
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: window.origin + '/api/v1/news/get-all.php',
            success: function (response) {
                if (response.status === 'success') {
                    response.data.forEach(item => {
                        $("#news_id").append(`
                            <option value="${item.id}">${item.title}</option>
                        `)
                    })
                }
            },
            error: function (xhr, resp, text) {
                console.log(xhr, resp)
            }
        });

    })

    $(document).ready(function () {
        pageRestricted('notifications')
    })
</script>