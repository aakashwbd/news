<?php
	$hosts = $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST'];
	$asset = $host . "/assets/";
?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= $asset ?>vendor/jquery/jquery-3.6.0.min.js"></script>
<script src="<?= $asset ?>vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="<?= $asset ?>vendor/ckeditor5-build-classic/ckeditor.js"></script>


<!-- select 2 JS cdn -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- toaster js -->
<script src="<?= $asset ?>js/toastr.js"></script>

<!-- Template Main JS File -->
<script src="<?= $asset ?>js/main.js"></script>


<!-- Auto Complete -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tarekraafat-autocomplete.js/10.2.6/autoComplete.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- Iconify CDN-->
<script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>

<!--Drop Zone-->
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        let token = localStorage.getItem('token') || null

        if (token) {
            let decodedToken = JSON.parse(atob(token.split('.')[1]));

            let currentTime = new Date().getTime() / 1000

            if (currentTime < decodedToken.exp) {
                $("#profile_name_inner").text(decodedToken.data.name)
                $("#profile_name_outter").text(decodedToken.data.name)

                if(decodedToken.data.image !== null){
                    let imageUrls = decodedToken.data.image.split('/')
                    let imageUrl = ''

                    imageUrls.forEach((item, i) => {
                        if (i > 0) imageUrl += '/' + item
                    })


                    $("#profile_image").attr("src", '../uploads/'+imageUrls[2])
                }else{
                    $("#profile_image").attr("src", '<?= $asset ?>img/avatar.png')
                }

                
                // $("#profile_image").attr("src", '../uploads/'+imageUrls[2])
                $("#profile_role").text(decodedToken.data.role)
            
                if (decodedToken.data.role === 'admin') {
                    let access = JSON.parse(decodedToken.data.access)
                    access.push('Index')

                } else if (decodedToken.data.role !== 'superAdmin') {
                    window.location.href = "/admin/auth/login.php"
                }
            } else {
                window.location.href = "/admin/auth/login.php"
            }
        } else {
            window.location.href = "/admin/auth/login.php"
        }
    })

    $('#signOut').click(function () {
        localStorage.removeItem('token')
        window.location.href = '/admin/auth/login.php'
    })
 
    $(document).ready(function () {

        let token = localStorage.getItem('token')
        let decodedToken = JSON.parse(atob(token.split('.')[1]));
        
        let id = decodedToken.data.admin_id;

        if (decodedToken.data.role === 'admin') {
            
            $('#category').hide();
            $('#news').hide();
            $('#news_approval').hide();
            $('#video').hide();
            $('#manage_admin').hide();
            $('#comment').hide();
            $('#report').hide();
            $('#manage_user').hide();
            $('#advertisement').hide();
            $('#notifications').hide();
            $('#settings').hide();
            $('#smtp').hide();
            $('#setting-div').hide();
            $('#users-div').hide();
            $('#administration-div').hide();
            $('#manage-div').hide();
        


            let access = JSON.parse(decodedToken.data.access)
            let accessId = ['category', 'news', 'news_approval', 'comment', 'video', 'report', 'manage_user', 'advertisement', 'notifications', 'settings', 'smtp']

            access.forEach((item) => {
                accessId.forEach((id) => {
                    if (item === id) {
                        $('#' + id).show()


                        if (id === 'category' || id === 'news' || id === 'news_approval' || id === 'video' ){
                            $('#manage-div').show();
                        }

                        if (id === 'manage_user' || id === 'comment' || id === 'report' ){
                            $('#users-div').show();
                        }

                        if (id === 'advertisement' || id === 'notifications' || id === 'settings' || id === 'smtp' ){
                            $('#setting-div').show();
                        }
                    }
                })
            })

        }
    })
    
   
    $('document').ready(function () {
        $.ajax({
            type: 'get',
            url: window.origin + '/api/v1/notification/get_setting.php',
            dataType: 'json',
            success: function (result) {
                let appID = result.data.app_id

                window.OneSignal = window.OneSignal || [];
                OneSignal.push(function () {
                    OneSignal.init({
                        appId: appID
                    });
                });
            },
            error: function (err) {
                console.log(err);
            }
        })
    })

</script>

<script>
    
    let pathname = window.location.pathname.split('/')
    document.title = 'Dashboard - ' + pathname[1].toUpperCase()
    
</script>
</body>

</html>