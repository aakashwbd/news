<?php include_once __DIR__ . '/../../inc/header.php'; ?>
<?php include_once __DIR__ . '/../../inc/sidebar.php'; ?>
<main id="main" class="main">

    <div class="row align-items-center">
        <div class="col-lg-2 col-6">
            <div class="pagetitle">
                <h1>Manage User</h1>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <a href="<?= $url?>user/create.php" class="btn primary-color-btn "><i class="bi bi-plus-circle-fill me-3"></i>Add
                User</a>
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

    <section class="section mt-5" style="overflow-x: auto;">
        <table class="table table-borderless">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Phone No</th>
                <th scope="col">Email</th>
                <th scope="col">Account Created</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody id='user_list'></tbody>
        </table>
    </section>

</main><!-- End #main -->
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    /**
     * Search For User
     * */
    $('#search-form').keyup(function (e) {
        e.preventDefault();

        let form = $(this);
        let url = window.origin + '/api/v1/user/user-search.php';
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
                        {title: 'Account Created', field: 'created_at'},
                        {title: 'Action', field: 'action'},
                    ];

                    let actions = [
                        {label: 'Edit', url: '<?= $url?>user/edit.php?id=:id'},
                        {label: 'Delete', url: window.origin + '/api/v1/user/delete.php?id=:id'}
                    ]

                    generateTable("user_list", headers, data, actions)
                }
            },
            error: function (xhr, resp, text) {
                console.log(resp)
            }
        });
    });

    /**
     * Page Restriction & GET User
     * */
    $(document).ready(function () {
        pageRestricted('manage_user')

        let url = window.origin + "/api/v1/user/getAll.php";
        let headers = [
            {title: 'Image', field: 'image'},
            {title: 'Name', field: 'name'},
            {title: 'Phone No', field: 'phone'},
            {title: 'Email', field: 'email'},
            {title: 'Account Created', field: 'created_at'},
            {title: 'Action', field: 'action'},
        ];

        let actions = [
            {label: 'Edit', url: '<?= $url?>user/edit.php?id=:id'},
            {label: 'Delete', url: window.origin + '/api/v1/user/delete.php?id=:id'}
        ]

        getAllData(url, "user_list", headers, actions);
    })
</script>