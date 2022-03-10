<?php include_once __DIR__. '/../../inc/header.php'; ?>
<?php include_once __DIR__. '/../../inc/sidebar.php'; ?>
<style>
    .countCard {
        border: none;
        box-shadow: 0 13px 10px rgba(0, 0, 0, 0.035);
        border-radius: 20px;
    }
</style>
<!-- ===== Main Section ===== -->
<main id="main" class="main">
    <!-- ===== Page Title Section ===== -->
    <div class="pagetitle ">
        <span>👋  Hello!</span>
        <h5 class="my-3">Welcome <span class="text-danger">Onboard</span></h5>
        <h1 class="mt-4">User Overview</h1>
    </div>
    <!-- ===== End Page Title Section ===== -->

    <!-- ===== Dashboard Count Section ===== -->
    <section class="section dashboard mt-5">
        <div class="row">
            <div class="col-lg-10 col-12">
                <div class="row" id="count_list"></div>
                <img src="../../assets/img/analytics.png" class="img-fluid" alt="">
            </div>
        </div>

    </section>
    <!-- ===== End Dashboard Count Section ===== -->
</main>
<!-- ===== End Main Section ===== -->
<?php include_once __DIR__. '/../../inc/footer.php'; ?>

<script>
    /**
     * Dashboard All Count
     * */
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: window.origin + '/api/v1/dashboard/count.php',
            dataType: "json",

            success: function (res) {
                if (res.status === 'success') {
                    Object.entries(res.data).forEach(item => {

                        $('#count_list').append(`
                     
                        <div class="col-lg-3 col-12">
                            <div class="card px-3 py-4 countCard">
                                <div class="d-flex justify-content-between ">
                                    <div>
                                        <h2 class="countLanguage">${item[1]}</h2>
                                        <span class="countingTitle">Total ${item[0]}</span>
                                    </div>
                                    <div class="countingIcon" id="icon${item[0]}"></div>
                                </div>
                            </div>
                        </div>
                     `)

                        if (item[0] === "News") {
                            $('#icon' + item[0]).append(`
                         <span class="iconify" data-icon="emojione-monotone:rolled-up-newspaper" style="color: #da0f0f;" data-width="30" data-height="30"></span>
                         `)
                        } else if (item[0] === "Category") {
                            $('#icon' + item[0]).append(`
                         <span class="iconify" data-icon="ic:outline-category" style="color: #da0f0f;" data-width="30" data-height="30"></span>
                         `)
                        } else if (item[0] === "Approved") {
                            $('#icon' + item[0]).append(`
                         <span class="iconify" data-icon="mdi:newspaper-check" style="color: #da0f0f;" data-width="30" data-height="30"></span>
                         `)
                        } else if (item[0] === "Video") {
                            $('#icon' + item[0]).append(`
                         <span class="iconify" data-icon="bx:bxs-video-plus" style="color: #da0f0f;" data-width="30" data-height="30"></span>
                         `)
                        } else if (item[0] === "Admin") {
                            $('#icon' + item[0]).append(`
                         <span class="iconify" data-icon="eos-icons:admin" style="color: #da0f0f;" data-width="30" data-height="30"></span>
                         `)
                        }
                    })
                }
            },
            error: function (err) {
                console.log(err)
            }
        })
    })

</script>
