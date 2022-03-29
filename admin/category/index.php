<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>


<main id="main" class="main">
    <div class="row align-items-center">
        <div class="col-lg-2 col-sm-9 col-6">
            <div class="pagetitle">
                <h1>Manage Category</h1>
            </div>
        </div>
        <div class="col-lg-2 col-sm-3 col-6">
            <a href="<?= $url ?>category/create.php" class="btn primary-color-btn btn-res"><i
                        class="bi bi-plus-circle-fill me-3"></i>Add
                Category</a>
        </div>

        <div class="col-lg-8 col-sm-12 col-12">
            <div class="d-flex flex-column align-items-end">
                <form id="search-form" name="search-form" novalidate>
                <span class="iconify search_icon" id="search_icon" data-icon="codicon:search" data-width="20"
                      data-height="20"></span>
                    <input type="text" id="search_input" name="search" class="search_input"
                           placeholder="Search...">
                </form>
            </div>

        </div>
    </div>

    <section class="section mt-5">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div id="empty_msg" class="alert alert-warning"></div>
            </div>
        </div>
        <div class="row" id="categoryBox"></div>
    </section>
</main>
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    /**
     * GET ALL Category & Page Restriction for Admin
     * */
    $('document').ready(function () {
        pageRestricted('category')
        $.ajax({
            type: 'get',
            url: window.origin + '/api/v1/category/get-all-category.php',
            dataType: 'json',
            success: function (result) {
                if (result.status === 'success') {
                    $('#empty_msg').hide()
                    fetchData(result)
                }
            },
            error: function (xhr, resp, text) {
                let response = xhr.responseJSON
                if (response.status === 'error' && response.status_code === 404) {
                    $('#empty_msg').html('Category Not Create Yet...');
                }
            }
        })
    })

    /**
     * Search For Category
     * */

    $('#search-form').keyup(function (e) {
        e.preventDefault();

        let form = $(this);
        let url = window.origin + '/api/v1/category/category-search.php';
        let form_data = JSON.stringify(form.serializeJSON());

        $.ajax({
            type: "POST",
            url: url,
            data: form_data,
            success: function (response) {
                $('#empty_msg').hide();

                $('#categoryBox').html("")
                fetchData(response)

            },
            error: function (xhr, resp, text) {
                let response = xhr.responseJSON
                if (response.status === 'error' && response.status_code === 404) {
                    $('#categoryBox').html("")
                    $('#empty_msg').show().html('Please Try With Another Words...');
                }
            }
        });
    });

    /**
     * GET Fetch Data Function
     * */
    function fetchData(response) {
        let imgSrc = null;
        response.data.forEach(item => {
            if (item.image !== "") {
                // let imageUrls = item.image.split('/')
                let imageUrl = item.image

                console.log("img",imageUrl);

                // imageUrls.forEach((item, i) => {
                //     if (i > 0) imageUrl += '/' + item
                // })

                imgSrc = imageUrl
            } else {
                imgSrc = window.origin + "/assets/img/default.png"
            }


            $('#categoryBox').append(`
                            <div class="col-lg-4 col-sm-4 col-12">
                                <div class="card">
                                    <img src="${imgSrc}"class="border-bottom" style="width: 100%; height: 200px" alt="">
                                    
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between my-3">
                                            <div class="col-lg-8 col-6 col-sm-6">
                                                <h6>${item.name}</h6>
                                            </div>
                                        
                                            <div class="col-lg-4 col-5 col-sm-6">
                                                <div class="form-check form-switch">
                                                    <label class="switch">
                                                        <input type="checkbox" ${item.status === 'Active' ? 'checked' : ''} data-id=${item.id} id='enableStatus${item.id}' onchange="statusHandler('enableStatus${item.id}', '/api/v1/category/status.php');">
                                                        <div class="slider round"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="mt-4 my-2 card-aciton">
                                            <div class="row">
                                                <div class="col-lg-6 col-12 mb-2">
                                                    <a href="<?= $url?>category/update.php?id=${item.id}" class="btn btn-outline-secondary form-control customBtn">
                                                        <span class="iconify" data-icon="ant-design:edit-filled" data-width="18" data-height="18"></span>
                                                        Edit
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <button class="btn btn-outline-secondary form-control customBtn" id='deleteHandlerBtn${item.id}' onclick="deleteHandler('/api/v1/category/delete.php?id=${item.id}')">
                                                        <span class="iconify" data-icon="ant-design:delete-filled" data-width="18" data-height="18"></span>
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        `)
        })
    }

</script>

