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
                        <h6>Edit News</h6>
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
                            
                            <!-- News category Type -->
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label for="type" id="type_label">News Category Type:</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <select class="form-select" id="category_type" name="category_type" onchange="clearError(this)">
                                        <option selected value="select">Select News Type</option>
                                        <option value="feature">Feature</option>
                                        <option value="non-feature">Non-Feature</option>
                                    </select>
                                    <span id="category__error" class="text-danger"></span>
                                </div>
                            </div>

                            <!-- News Category -->
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label for="category_list" id="category_list_label">News Category:</label>
                                </div>
                                <div class="col-lg-9 col-12" id="category_list">
                                    <select class="category-list form-control" id="category_id" name="category[]"
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
                                Update
                            </button>

                            <a href="<?= $url ?>news" class="btn btn-outline-secondary mb-3">Cancel</a>

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
     * Update Form Submit
     * */
    $('#form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let apiURL = window.origin + '/api/v1/news/update.php?id=<?= $_GET['id'] ?>'
        formSubmit("post", "submit-button", form, apiURL);
    })

    /**
     * GET All Category, Category in SELECT2  & Page Restriction for admin
     * */
    let catList = [];
    $(document).ready(function () {

        $('.category-list').select2({
            placeholder: "Select Categories",
        });

        $.ajax({
            type: 'GET',
            url: window.origin + '/api/v1/category/get-all.php',
            dataType: 'JSON',
            success: function (res) {
                res.data.forEach((item) => {
                    catList.push({
                        category_id: item.id,
                        category_name: item.name
                    })
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
        } else {
            $("#video_link").addClass("d-none");
        }
    })


    /**
     * GET Data For Edit
     * */
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: window.origin + "/api/v1/news/getEdit.php?id=<?= $_GET['id']?>",
            success: function (res) {
                $('#type').val(res.data[0].type)
                $('#category_type').val(res.data[0].category_type)

                if (res.data[0].type === 'video') {
                    $("#video_link").removeClass("d-none");
                    $("#link").val(res.data[0].link);
                }

                $('#title').val(res.data[0].title)
                newsEditor.setData(res.data[0].description)

                let mockFile = {name: 'image', size: 600,};
                let imageUrls = res.data[0].image.split('/')
                let imageUrl = ''
                imageUrls.forEach((item, i) => {
                    if (i > 0) imageUrl += '/' + item
                })


                myDropzone.displayExistingFile(mockFile, window.origin + imageUrl);

                catList.forEach((item) => {
                    if (jQuery.inArray(item.category_id, res.data[0].category_id) !== -1) {
                        $('.category-list').append(`
                                <option value="${item.category_id}" selected>${item.category_name}</option>
                        `)
                    } else {
                        $('.category-list').append(`
                                <option value="${item.category_id}">${item.category_name}</option>
                        `)
                    }
                })
            },
            error: function (err) {
                console.log(err)
            }

        })
    })


    $(document).ready(function () {
        pageRestricted('news')
    })

</script>