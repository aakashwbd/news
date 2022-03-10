<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>
<main id="main" class="main">

    <div class="row align-items-center">
        <div class="col-lg-3 col-6 col-sm-4 mb-2">
            <div class="pagetitle">
                <h1>Manage Notification</h1>
            </div>
        </div>
        <div class="col-lg-3 col-6 mb-2 col-sm-4">

            <a class="btn primary-color-btn sm-padding-0" href="<?= $url?>notification/create.php"><i class="bi bi-plus-circle-fill me-3"></i>Add
                Notification</a>
        </div>

        <div class="col-lg-6 col-12 text-lg-end my-2 col-sm-4">
            <a class="btn btn-outline-secondary " href="<?= $url?>notification/setting.php">Manage Notification</a>
        </div>
    </div>

    <section class="section " style="overflow-x: auto;">
        <table class="table table-borderless mt-5">
            <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Notification Time</th>
                <th scope="col">Action</th>
            </tr>
            </thead>

            <tbody id='notification_list'></tbody>
        </table>
    </section>
</main>

<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    /**
     * GET All Notification & Page Restricted For Admin
     * */
    $(document).ready(function () {
        pageRestricted('notifications')
        $.ajax({
            type: 'GET',
            url: window.origin + '/api/v1/notification/get-notification.php',
            success: function (response) {
                if (response.status === 'success') {
                    let i = 1;
                    response.data.forEach(item => {
                        $("#notification_list").append(`
                            <tr>
                                <td>
                                  ${i++}
                                </td>

                                <td>
                                  ${item.title}
                                </td>
                
                                <td>
                                  ${item.description}
                                </td>

                                <td >${item.created_at}</td>
            
                              <td>
                                <button onclick="deleteHandler(window.origin + '/api/v1/notification/delete.php?id=${item.id}')" class="btn btn-outline-secondary">Delete</button>
                              </td>
                            </tr>
                        `)
                    })

                }
            },
            error: function (xhr, resp, text) {
                console.log(xhr, resp)
            }
        });

    })
</script>