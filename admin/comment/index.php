<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>

<style>
    #newsList .form-switch, #newsList .form-check, #videoList .form-check, #videoList .form-switch {
         padding-left: 0;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Comments</h1>
    </div>
    <!-- End Page Title -->

    <section class="section mt-5" style="overflow-x: auto;">
        <!-- ===== Comments Nav Tab  ===== -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="newsTab" data-bs-toggle="tab" data-bs-target="#newsTabContent" type="button"
                        role="tab" aria-controls="home" aria-selected="true">News
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="videoTab" data-bs-toggle="tab" data-bs-target="#videoTabContent"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Video
                </button>
            </li>
        </ul>
        <!-- ===== End Comments Nav Tab  ===== -->

        <!-- ===== Comments Tab Content ===== -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="newsTabContent" role="tabpanel" aria-labelledby="newsTab">
                <table class="table table-borderless mt-5">
                    <thead>
                    <tr>
                        <th scope="col">News Title</th>
                        <th scope="col">Name of User</th>
                        <th scope="col">Comment Text</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>

                    <tbody id='newsList'></tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="videoTabContent" role="tabpanel" aria-labelledby="videoTab">
                <table class="table table-borderless mt-5">
                    <thead>
                    <tr>
                        <th scope="col">Video Title</th>
                        <th scope="col">Name of User</th>
                        <th scope="col">Comment Text</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>

                    <tbody id='videoList'></tbody>
                </table>
            </div>
        </div>
        <!-- ===== End Comments Tab Content ===== -->
    </section>

</main><!-- End #main -->
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    $(document).ready(function () {
        pageRestricted('comment')
    })

    let url =  window.origin + "/api/v1/comment/news/getAll.php";
    let url2 = window.origin + "/api/v1/comment/video/getAll.php";
    
    let headers = [
        {title: 'News Title', field: 'news_title'},
        {title: 'Video Title', field: 'video_title'},
        {title: 'Name of User', field: 'user_name'},
        {title: 'Comment Text', field: 'comment_text'},
        {title: 'Status', field: 'status'},
        {title: 'Action', field: 'action'},
    ];

    let actions = [
        {label: 'Delete', url: window.origin + '/api/v1/comment/news/delete.php?id=:id'}
    ]
    let status = {label: "Status", url: window.origin + "/api/v1/comment/news/status.php?id=:id"}
    getAllData(url, "newsList", headers, actions, status);
    
    let actions2 = [
        {label: 'Delete', url: window.origin + '/api/v1/comment/video/delete.php?id=:id'}
    ]
    let status2 = {label: "Status", url: window.origin + "/api/v1/comment/video/status.php?id=:id"}

    getAllData(url2, "videoList", headers, actions2, status2);
    
</script>