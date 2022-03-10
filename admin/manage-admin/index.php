<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>

<!-- ===== Main Section  ===== -->
<main id="main" class="main">

    <div class="row align-items-center">
        <div class="col-lg-2 col-6">
            <div class="pagetitle">
                <h1>Manage Admin</h1>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <a href="<?= $url?>manage-admin/create.php" class="btn primary-color-btn "><i class="bi bi-plus-circle-fill me-3"></i>Add
                Admin</a>
        </div>

        <div class="col-lg-8 col-12">
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

    <!-- ===== Manage Admin Section  ===== -->
    <section class="section mt-5 manage_adimn">
        <!-- ===== Manage Admin Nav Tab  ===== -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="adminTab" data-bs-toggle="tab" data-bs-target="#adminTabContent"
                        type="button"
                        role="tab" aria-controls="home" aria-selected="true">Admin
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="superAdminTab" data-bs-toggle="tab" data-bs-target="#superAdminTabContent"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Super Admin
                </button>
            </li>
        </ul>
        <!-- ===== End Manage Admin Nav Tab  ===== -->

        <!-- ===== Manage Admin Tab Content ===== -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="adminTabContent" role="tabpanel" aria-labelledby="adminTab">
                <table class="table table-borderless mt-5">
                    <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>

                    <tbody id='adminList'></tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="superAdminTabContent" role="tabpanel" aria-labelledby="superAdminTab">
                <table class="table table-borderless mt-5">
                    <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody id='super_admin'></tbody>
                </table>
            </div>
        </div>
        <!-- ===== End Manage Admin Tab Content ===== -->
    </section>
    <!-- ===== End Manage Admin Section  ===== -->
</main>
<!-- ===== Main Section  ===== -->
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    /**
     * Search For User
     * */
    $('#search-form').keyup(function (e) {
        e.preventDefault();

        let form = $(this);
        let url = window.origin + "/api/v1/admin/admin-search.php";
        let form_data = JSON.stringify(form.serializeJSON());

        $.ajax({
            type: "POST",
            url: url,
            data: form_data,
            success: function (response) {
                if (response.status === 'success') {
                    let data = response.data
                    let headers = [
                        {title: 'Image', field: 'image'},
                        {title: 'Name', field: 'name'},
                        {title: 'Phone No', field: 'phone'},
                        {title: 'Email', field: 'email'},
                        {title: 'Action', field: 'action'},
                    ];

                    let actions = [
                        {label: 'Edit', url: window.origin + 'update.php?id=:id'},
                        {label: 'Delete', url: window.origin + '/api/v1/admin/delete.php?id=:id'}
                    ]
                    generateTable("adminList", headers, data, actions)
                }
            },
            error: function (xhr, resp, text) {
                console.log(resp)
            }
        });
    });


    $(document).ready(function () {
        pageRestricted('manage_admin')

        let url = window.origin + "/api/v1/admin/get_all_admin.php";
        let url2 = window.origin + "/api/v1/admin/get_all_super_admin.php";
        let headers = [
            {title: 'Image', field: 'image'},
            {title: 'Name', field: 'name'},
            {title: 'Phone No', field: 'phone'},
            {title: 'Email', field: 'email'},
            {title: 'Action', field: 'action'},
        ];

        let actions = [
            {label: 'Edit', url: '<?= $url?>manage-admin/update.php?id=:id'},
            {label: 'Delete', url: window.origin + '/api/v1/admin/delete.php?id=:id'}
        ]

        getAllData(url, "adminList", headers, actions);
        getAllData(url2, "super_admin", headers, actions);
    })

</script>