<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>

<!-- ===== Main Section ===== -->
<main id="main" class="main">
    <!-- ===== Page Title Section ===== -->
    <div class="pagetitle">
        <h1>Manage Advertisement</h1>
    </div>
    <!-- ===== End Page Title Section ===== -->

    <!-- ===== Advertisement Form ===== -->
    <form action="" id="ad_form" method="post" enctype="multipart/form-data">
        <section class="section mt-5">
            <div class="row">
                <!-- Google Ad -->
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header googleTitle d-flex justify-content-between align-items-center">
                            <h6 class="text-white">Google Advertisement</h6>
                            <div class="form-check form-switch" id="googleStatusBox">
                                <!--                                <input class="form-check-input" type="checkbox" name="status[google]"  id="googleStatus">-->
                                <label class="switch">
                                    <input type="checkbox" name="status[google]" id="googleStatus">
                                    <div class="slider round"></div>
                                </label>
                            </div>
                            <input type="hidden" name="ad_type[]" value="google">
                        </div>


                        <div class="card-body mt-3">
                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Banner Admob ID</label>
                                <input id="googleBannerAdmobID" name="banner_id[google]" type="text" placeholder=""
                                       class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Interstitial Admob ID</label>
                                <input id="googleIntertidalAdmobID" name="interstitial_id[google]" type="text"
                                       placeholder=""
                                       class="form-control">
                            </div>

                            <div class="card p-4">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Interstitial Admob Click</label>
                                    <input id="googleIntertidalAdmobClick" name="interstitial_click[google]"
                                           type="number"
                                           placeholder="" class="form-control">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Native Admob ID</label>
                                <input id="googleNativeAdID" name="native_id[google]" type="text" placeholder=""
                                       class="form-control">
                            </div>

                            <div class="card p-4">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Native Ad Per News</label>
                                    <input id="googleNativeAdPerNews" name="native_per_news[google]" type="number"
                                           placeholder="" class="form-control">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Native Ad Per Video</label>
                                    <input id="googleNativeAdPerVideo" name="native_per_video[google]" type="number"
                                           placeholder="" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Google Ad -->


                <!-- Facebook Ad -->
                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-header facebookTitle d-flex justify-content-between align-items-center">
                            <h6 class="text-white">Facebook Advertisement</h6>

                            <div class="form-check form-switch" id="facebookStatusBox">
                                <!--                                <input class="form-check-input" type="checkbox" name="status[facebook]" id="facebookStatus">-->
                                <label class="switch">
                                    <input type="checkbox" name="status[facebook]" id="facebookStatus">
                                    <div class="slider round"></div>
                                </label>
                            </div>
                        </div>

                        <input type="hidden" name="ad_type[]" value="facebook">

                        <div class="card-body mt-3">
                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Banner Admob ID</label>
                                <input id="facebookBannerAdID" name="banner_id[facebook]" type="text" placeholder=""
                                       class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Interstitial Admob ID</label>
                                <input id="facebookInterstitialAdID" name="interstitial_id[facebook]" type="text"
                                       placeholder=""
                                       class="form-control">
                            </div>

                            <div class="card p-4">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Interstitial Admob Click</label>
                                    <input id="facebookInterstitialAdClick" name="interstitial_click[facebook]"
                                           type="number"
                                           placeholder="" class="form-control">
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="mb-2">Native Admob ID</label>
                                <input id="facebookNativeAdID" name="native_id[facebook]" type="text" placeholder=""
                                       class="form-control">
                            </div>

                            <div class="card p-4">
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Native Ad Per News</label>
                                    <input id="facebookNativeAdPerNews" name="native_per_news[facebook]" type="number"
                                           placeholder="" class="form-control">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="" class="mb-2">Native Ad Per Video</label>
                                    <input id="facebookNativeAdPerVideo" name="native_per_video[facebook]" type="number"
                                           placeholder="" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Facebook Ad -->
            </div>


            <!-- custom ads -->
            <div class="card">
                <div class="card-header customAdTitle d-flex justify-content-between align-items-center">
                    <h6 class="text-white">Custom Advertisement</h6>

                    <div class="form-check form-switch" id="customStatusBox">
                        <!--                        <input class="form-check-input" type="checkbox" name="status[custom]" id="customStatus">-->
                        <label class="switch">
                            <input type="checkbox" name="status[custom]" id="customStatus">
                            <div class="slider round"></div>
                        </label>
                    </div>
                </div>
                <input type="hidden" name="ad_type[]" value="custom">
                <div class="card-body p-3 mt-3">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <label for="">Banner AD Image</label>
                            <div id="banner_image_input" class="dropzone upload_image"></div>
                            <input id="banner_image" name="banner_image[custom]" type="hidden">

                            <div class="form-group">
                                <label for="customBannerAdLink" class="mb-2">Banner AD Link</label>
                                <input id="customBannerAdLink" name="banner_link[custom]" type="text"
                                       class="form-control mb-3">
                            </div>

                            <label for="">Native AD Image</label>
                            <div id="native_image_input" class="dropzone"></div>
                            <input id="native_image" name="native_image[custom]" type="hidden">

                            <div class="form-group">
                                <label for="" class="mb-2">Native Ad Link</label>
                                <input id="customAdNativeLink" name="native_link[custom]" type="text"
                                       class="form-control mb-3">
                            </div>

                            <div class="form-group">
                                <label for="" class="mb-2">Native Ad Per News</label>
                                <input id="customAdNativePerNews" name="native_per_news[custom]" type="number"
                                       class="form-control mb-3">
                            </div>
                            
                            <div class="form-group">
                                <label for="" class="mb-2">Native Ad Per Video</label>
                                <input id="customAdNativePerVideo" name="native_per_video[custom]" type="number"
                                       class="form-control mb-3">
                            </div>

                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="">Interstitial AD Image</label>
                            <div class="dropzone" id="interstitial_image_input"></div>
                            <input id="interstitial_image" name="interstitial_image[custom]" type="hidden">

                            <div class="form-group">
                                <label for="" class="mb-2">Interstitial AD Link</label>
                                <input id="customAdInterstitialLink" name="interstitial_link[custom]" type="text"
                                       class="form-control mb-3">
                            </div>

                            <div class="form-group">
                                <label for="" class="mb-2">Interstitial Admob Click</label>
                                <input id="customAdInterstitialAdClick" name="interstitial_click[custom]" type="number"
                                       class="form-control mb-3">
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- started add -->
            <div class="card">
                <div class="card-header bg-dark  d-flex justify-content-between align-items-center">
                    <h6 class="text-white">Startup Advertisement</h6>
                    <div class="form-check form-switch" id="startupStatusBox">
                        <!--                        <input class="form-check-input" type="checkbox" name="status[startup]" id="startupStatus">-->
                        <label class="switch ">
                            <input type="checkbox" name="status[startup]" id="startupStatus">
                            <div class="slider round"></div>
                        </label>
                    </div>
                </div>
                <input type="hidden" name="ad_type[]" value="startup">
                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="" class="mb-2">Startup AD ID</label>
                                <input id="startupAdID" name="startup_id[startup]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" id="submit_btn" class="btn btn-primary">Create</button>
            <a href="../dashboard/index.php" class="btn btn-outline-secondary">Cancel</a>
        </section>
    </form>
    <!-- ===== End Advertisement Form ===== -->
</main>
<!-- ===== End Main Section ===== -->
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    /**
     * Upload Image
     * */
    let bannerImgUpload = adUpload('banner_image_input', 'banner_image');
    let nativeImgUpload = adUpload('native_image_input', 'native_image');
    let interstitialImgUpload = adUpload('interstitial_image_input', 'interstitial_image');
    
    function adUpload(dropzoneImgID, inputID){
        let data = null;
        let image = new Dropzone("#" + dropzoneImgID, {
            url: window.origin + "/api/v1/uploads.php",
            method: "post",
            uploadMultiple: false,
            createImageThumbnails: true,
            paramName: "file",
            clickable: true,
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            success: function (file, res) {
                $('#' + inputID).val(res.data)
                data = res.data;
            },
        });
        return image;
    }

    // function adUpload(dropzoneImgID, inputID) {
    //
    //     let data = null;
    //
    //     let image = new Dropzone("#" + dropzoneImgID, {
    //         url: "/api/v1/uploads.php",
    //         method: "post",
    //         uploadMultiple: false,
    //         createImageThumbnails: true,
    //         paramName: "file",
    //         clickable: true,
    //
    //         init: function () {
    //             this.on('addedfile', function (file) {
    //                 if (this.files.length > 1) {
    //                     this.removeFile(this.files[0]);
    //                 }
    //             });
    //         },
    //
    //         success: function (file, res) {
    //             let defaultExistFile = $('.dz-preview.dz-complete.dz-image-preview')
    //             if (defaultExistFile) {
    //                 defaultExistFile.remove()
    //             }
    //             $('#' + inputID).val(res.data)
    //             data = res.data;
    //         },
    //     });
    //
    //     return image;
    // }

    

    $(document).ready(function () {
        pageRestricted('advertisement')
    })
    
    $("input[name='status[]']").each(function (index, obj) {
        console.log('index', index, 'object', obj)
    });

    /**
     * Advertisement Status On/Off
     * */
    $(document).on('change', '#googleStatus', function () {
        $('#facebookStatus').prop('checked', false)
        $('#customStatus').prop('checked', false)
        $('#startupStatus').prop('checked', false)
    })
    $(document).on('change', '#facebookStatus', function () {
        $('#googleStatus').prop('checked', false)
        $('#customStatus').prop('checked', false)
        $('#startupStatus').prop('checked', false)
    })
    $(document).on('change', '#customStatus', function () {
        $('#googleStatus').prop('checked', false)
        $('#facebookStatus').prop('checked', false)
        $('#startupStatus').prop('checked', false)
    })
    $(document).on('change', '#startupStatus', function () {
        $('#googleStatus').prop('checked', false)
        $('#facebookStatus').prop('checked', false)
        $('#customStatus').prop('checked', false)
    })

    /**
     * Advertisement Create/Update Form
     * */
    $(document).on("click", "#submit_btn", function (e) {
        e.preventDefault();

        let formData = new FormData($('#ad_form')[0]);

        let status = {
            google: $('#googleStatus').prop('checked') ? 'on' : 'off',
            facebook: $('#facebookStatus').prop('checked') ? 'on' : 'off',
            custom: $('#customStatus').prop('checked') ? 'on' : 'off',
            startup: $('#startupStatus').prop('checked') ? 'on' : 'off'
        }

        formData.append('status', JSON.stringify(status))

        $.ajax({
            method: 'POST',
            dataType: "JSON",
            data: formData,
            url: window.origin + '/api/v1/advertisement/create.php',
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status === 'error') {
                    toastr.error(res.message)
                } else if (res.status === 'success') {
                    toastr.success(res.message)
                    $("#ad_form")[0].reset();
                    setTimeout((function () {
                        window.location.reload();
                    }), 500);
                }
            },
            error: function (err) {
                console.log(err)
            }
        })

    })


    /**
     * Advertisement GET
     * */
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: window.origin + '/api/v1/advertisement/mobile.php',
            
            success: function (res) {

                $('#googleBannerAdmobID').val(res.data[0].banner_id)
                $('#googleIntertidalAdmobID').val(res.data[0].interesticial_id)
                $('#googleIntertidalAdmobClick').val(res.data[0].interesticial_click)
                $('#googleNativeAdID').val(res.data[0].native_id)
                $('#googleNativeAdPerNews').val(res.data[0].native_per_news)
                $('#googleNativeAdPerVideo').val(res.data[0].native_per_video)

                $('#facebookBannerAdID').val(res.data[1].banner_id)
                $('#facebookInterstitialAdID').val(res.data[1].interesticial_id)
                $('#facebookInterstitialAdClick').val(res.data[1].interesticial_click)
                $('#facebookNativeAdID').val(res.data[1].native_id)
                $('#facebookNativeAdPerNews').val(res.data[1].native_per_news)
                $('#facebookNativeAdPerVideo').val(res.data[1].native_per_video)


                $('#banner_image').val(res.data[2].banner_image)
                $('#customBannerAdLink').val(res.data[2].banner_link)
                $('#native_image').val(res.data[2].native_image)
                $('#customAdNativeLink').val(res.data[2].native_link)
                $('#customAdNativePerNews').val(res.data[2].native_per_news)
                $('#customAdNativePerVideo').val(res.data[2].native_per_video)
                $('#interstitial_image').val(res.data[2].interesticial_image)
                $('#customAdInterstitialLink').val(res.data[2].interesticial_link)
                $('#customAdInterstitialAdClick').val(res.data[2].interesticial_click)

                $('#startupAdID').val(res.data[3].startup_id)

                $('#googleStatus').attr("checked", res.data[0].status === 'on' ? true : false)
                $('#facebookStatus').attr("checked", res.data[1].status === 'on' ? true : false)
                $('#customStatus').attr("checked", res.data[2].status === 'on' ? true : false)
                $('#startupStatus').attr("checked", res.data[3].status === 'on' ? true : false)

                let mockFile = {name: 'image', size: 600,};
                // let imageUrls = res.data[2].banner_image.split('/')
                let imageUrl = res.data[2].banner_image
                // imageUrls.forEach((item, i) => {
                //     if (i > 0) imageUrl += '/' + item
                // })
                bannerImgUpload.displayExistingFile(mockFile, imageUrl);


                let mockFile2 = {name: 'image', size: 600,};
                // let imageUrls2 = res.data[2].native_image.split('/')
                let imageUrl2 = res.data[2].native_image
                // imageUrls2.forEach((item, i) => {
                //     if (i > 0) imageUrl2 += '/' + item
                // })
                nativeImgUpload.displayExistingFile(mockFile2, imageUrl2);


                let mockFile3 = {name: 'image', size: 600,};
                // let imageUrls3 = res.data[2].interstitial_image.split('/')
                let imageUrl3 = res.data[2].interesticial_image

                // console.log(res.data[2]);
                // imageUrls3.forEach((item, i) => {
                //     if (i > 0) imageUrl3 += '/' + item
                // })

                interstitialImgUpload.displayExistingFile(mockFile3, imageUrl3);

                $('#submit_btn').text('Update')

            },

            error: function (err) {
                console.log(err)
            }
        })
    })
</script>