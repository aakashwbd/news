<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between align-items-center">
        <h1>Reports</h1>
    </div>
    <!-- End Page Title -->

    <section class="section mt-5" style="overflow-x: auto;">
        <!-- ===== Report Nav Tab  ===== -->
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
        <!-- ===== End Report Nav Tab  ===== -->

        <!-- ===== Report Tab Content ===== -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="newsTabContent" role="tabpanel" aria-labelledby="newsTab">
                <table class="table table-borderless mt-5">
                    <thead>
                    <tr>
                        <th scope="col">News Title</th>
                        <th scope="col">Name of User</th>
                        <th scope="col">Report Text</th>
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
                        <th scope="col">Report Text</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>

                    <tbody id='videoList'></tbody>
                </table>
            </div>
        </div>
        <!-- ===== End Report Tab Content ===== -->
    </section>

</main><!-- End #main -->
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    $(document).ready(function () {
        pageRestricted('report')
    })

    let url = window.origin +"/api/v1/reports/news/getAll.php";
    let url2 = window.origin + "/api/v1/reports/video/getAll.php";
    let headers = [
        {title: 'News Title', field: 'news_title'},
        {title: 'Video Title', field: 'video_title'},
        {title: 'Name of User', field: 'user_name'},
        {title: 'Report Text', field: 'report_text'},
        {title: 'Action', field: 'action'},
    ];

    let actions = [
        {label: 'Delete', url: window.origin + '/api/v1/reports/news/delete.php?id=:id'}
    ]
    let actions2 = [
        {label: 'Delete', url: window.origin + '/api/v1/reports/video/delete.php?id=:id'}
    ]

    getAllData(url, "newsList", headers, actions);
    getAllData(url2, "videoList", headers, actions2);

</script>