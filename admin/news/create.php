<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>
<main id="main" class="main">
    <section class="section category">
        <div class="row">
            <div class="col-lg-10 col-sm-6 col-12 offset-lg-1 offset-sm-3">
                <a class="btn text-danger my-2" href="javascript:history.go(-1)"><i
                            class="bi bi-arrow-left"></i>Back</a>
                <div class="card py-4  ">
                    <div class="card-body">
                        <h6>Add News</h6>
                        <hr>

                        <form id="form" name="form" novalidate>


                        

                            <!-- News Type -->
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label for="type" id="type_label">News Type:</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <select class="form-select" id="type" name="type" onchange="clearError(this)">
                                        <option selected value="select">Select News Type</option>
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                    </select>
                                    <span id="type_error" class="text-danger"></span>
                                </div>
                            </div>


                            <!-- News Category Type -->
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label for="type" id="type_label">News Category Type:</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <select class="form-select" id="category_type" name="category_type" onchange="clearError(this)">
                                        <option selected value="select">Select News Category Type</option>
                                        <option value="feature">Feature</option>
                                        <option value="non-feature">Non-Feature</option>
                                    </select>
                                    <span id="category_type_error" class="text-danger"></span>
                                </div>
                            </div>

                            <!-- News Category -->
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label for="category" id="category_label">News Category:</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <select class="category-list form-control" id="category" name="category[]"
                                            multiple="multiple" onchange="clearError(this)"></select>
                                    <span id="category_error" class="text-danger"></span>
                                </div>
                            </div>

                            <!-- News Title -->
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label class="my-1" for="title" id="title_label">News Title</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <input id="title" name="title" type="text" placeholder="Write Here..."
                                           onchange="clearError(this)"
                                           class="form-control">
                                    <span id="title_error" class="text-danger"></span>
                                </div>
                            </div>

                            <!-- Video Link -->
                            <div class="row align-items-center mb-3 d-none" id="video_link">
                                <div class="col-lg-3 col-12">
                                    <label class="my-1" for="link" id="link_label">Video Link</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <input id="link" name="link" type="text" placeholder="Video Link Here..."
                                           onchange="clearError(this)"
                                           class="form-control">

                                    <span id="link_error" class="text-danger"></span>
                                </div>
                            </div>


                            <div class="row align-items-center mb-3 d-none" id="videoType">
                                <div class="col-lg-3 col-12">
                                    <label class="my-1" for="title" id="title_label">Video Type</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <select name="video_type" id="video_type" class="form-select">
                                        <option value="youtube">Youtube</option>
                                        <option value="dailymotion">Dailymotion</option>
                                        <option value="vimeo">Vimeo</option>
                                        <option value="m3u8">M3u8</option>
                                        <option value="mp4">Mp4</option>
                                    </select>
                                </div>
                            </div>

                            <!-- News Description -->
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label for="description" id="description_label">View Description:</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                            </div>

                            <!-- News Image -->
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label class="my-1" for="logo_box" id="logo_box_label">Image</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <div class="dropzone" id="logo_box"></div>
                                    <input type="hidden" id="logo" name="logo">
                                </div>
                                <span id="logo_box_error" class="text-danger"></span>
                            </div>

                            <button id="submit-button" type="submit" class="btn btn-primary mb-3">
                                Create
                            </button>

                            <a href="<?= $url?>news" class="btn btn-outline-secondary mb-3">Cancel</a>

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
     * News Editor TextField To CKEditor
     * */
    let newsEditor;
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            window.editor = editor;
            newsEditor = editor;
        })

    /**
     * Image Upload By Dropzone JS
     * */
    let myDropzone = uploads("logo_box", "logo");

    /**
     * News Create Form Submit
     * */
    $('#form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let apiURL = window.origin + '/api/v1/news/save.php'
        let header = {"Authorization": localStorage.getItem('token')}
        formSubmit("post", "submit-button", form, apiURL, header);
    })

    /**
     * GET All Category, Category in SELECT2  & Page Restriction for admin
     * */
    $(document).ready(function () {
        pageRestricted('news')

        $('.category-list').select2({
            placeholder: "Select Categories",
        });
        
        $.ajax({
            type: 'GET',
            url: window.origin + '/api/v1/category/get-all.php',
            dataType: 'JSON',
            success: function (res) {
                res.data.forEach((item) => {
                    $('.category-list').append(`
                            <option value="${item.id}">${item.name}</option>
                    `)
                })
            },
            error: function (err) {
                console.log(err)
            }
        })
    })

    /**
     * Select Type Video then show video link input
     * */
    $(document).on("change", "#type", function () {
        let type = $('#type').val();
        if (type === "video") {
            $("#video_link").removeClass("d-none");
            $("#videoType").removeClass("d-none");
        } else {
            $("#video_link").addClass("d-none");
            $("#videoType").addClass("d-none");
        }
    })
</script>