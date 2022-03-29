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
                        <h6>Add Video</h6>
                        <hr>

                        <form id="form" name="form" novalidate>

                            <div class="row align-items-center mb-3">
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


                            <!-- Video Title -->
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label class="my-1" for="title" id="title_label">Video Title</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <input id="title" name="title" type="text" placeholder="Video Title..."
                                           onchange="clearError(this)"
                                           class="form-control" >
                                    <span id="title_error" class="text-danger"></span>
                                </div>
                            </div>
                            
                            <!-- Video URL -->
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label class="my-1" for="url" id="url_label">Video URL</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <input id="url" name="url" type="text" placeholder="Video URL..."
                                           onchange="clearError(this)"
                                           class="form-control" >
                                    <span id="url_error" class="text-danger"></span>
                                </div>
                            </div>
                            
                            <!-- Video Description -->
                            <div class="row align-items-center mb-3">
                                <div class="row align-items-center mb-3">
                                    <div class="col-lg-3 col-12">
                                        <label for="description" id="description_label">Video Description:</label>
                                    </div>
                                    <div class="col-lg-9 col-12">
                                        <textarea name="description" id="description" placeholder="Description" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Video Image -->
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

                            <a href="<?= $url?>video" class="btn btn-outline-secondary mb-3">Cancel</a>

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
    * Page Restricted
    * */
    $(document).ready(function () {
        pageRestricted('video')
    })
    /**
     * Description TextFiled To CKEditor
     * */
    let descriptionEditor;
    ClassicEditor
        .create(document.querySelector('#description'))
        .then(editor => {
            window.editor = editor;
            descriptionEditor = editor;
        })


    /**
     * Image Upload By Dropzone
     * */
     let myDropzone =  uploads("logo_box","logo");

    /**
     * Video Create Form Submit
     * */
    $('#form').submit(function (e){
        e.preventDefault();
        let form = $(this);
        let apiURL = window.origin + '/api/v1/video/save.php';
        formSubmit("post", "submit-button", form, apiURL);
    })
</script>