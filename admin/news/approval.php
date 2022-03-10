<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Manage News</h1>
    </div>

    <section class="section mt-5">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div id="empty_msg" class="alert alert-warning"></div>
            </div>
        </div>

        <div class="row " id="newsBox"></div>
    </section>

</main>
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    /**
     * GET All Active News & Page Restriction for admin
     * */
    $('document').ready(function () {
        pageRestricted('news_approval')
        $.ajax({
            type: 'GET',
            url: window.origin + '/api/v1/news/get-inactive-news.php',
            dataType: 'json',

            success: function (result) {
                $('#empty_msg').hide()
                if (result.status === 'success') {
                    fetchData(result)
                }
            },
            error: function (xhr, resp, text) {
                let response = xhr.responseJSON
                if (response.status === 'error' && response.status_code === 404){
                    $('#empty_msg').show().html('All News Are Approved.');
                }
            }

        })
    })



    /**
     * GET Data Fetch Function
     * */
    function fetchData(result) {
        let imgSrc = null;
        result.data.forEach((item) => {
            if (item.status === 'Inactive') {

                if (item.image !== "") {
                    let imageUrls = item.image.split('/')
                    let imageUrl = ''
                    imageUrls.forEach((item, i) => {
                        if (i > 0) imageUrl += '/' + item
                    })

                    imgSrc = window.origin + "/uploads/" + imageUrls[2]
                } else {
                    imgSrc = window.origin + "/assets/img/default.png"
                }


                $('#newsBox').append(`
                  <div class="col-lg-4 col-sm-4 col-12 ">
                       <div class="card">
                            <img src="${imgSrc}" style="height: 200px; width: 100% !important;" class="border-bottom" alt="">
                            <div class="card-body">
                                        <div class="row  justify-content-between my-3">
                                            <div class="col-lg-8 col-6 col-sm-6">
                                                <h6>${item.title}</h6>
                                            </div>
                                        
                                            <div class="col-lg-4 col-5 col-sm-6">
                                                <div class="form-check form-switch">
                                                    <label class="switch">
                                                        <input type="checkbox" ${item.status === 'Active' ? 'checked' : ''} data-id=${item.id} id='enableStatus${item.id}' onchange="statusHandler('enableStatus${item.id}', '/api/v1/news/status.php');">
                                                        <div class="slider round"></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                               
                                <div class="mt-4 my-2 card-aciton">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2">
                                            <a href="update.php?id=${item.id}" class="btn btn-outline-secondary form-control customBtn">
                                                <span class="iconify" data-icon="ant-design:edit-filled" data-width="18" data-height="18"></span>
                                                Edit
                                            </a>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <button class="btn btn-outline-secondary form-control customBtn" id='deleteHandlerBtn${item.id}' onclick="deleteHandler('../api/v1/news/delete.php?id=${item.id}')">
                                                <span class="iconify" data-icon="ant-design:delete-filled" data-width="18" data-height="18"></span>
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>`)
            }
        })
    }


</script>