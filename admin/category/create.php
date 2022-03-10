<?php include __DIR__ . '/../../inc/header.php'; ?>
<?php include __DIR__ . '/../../inc/sidebar.php'; ?>

<main id="main" class="main">
    <section class="section category">
        <div class="row">
            <div class="col-lg-10 col-sm-6 col-12 offset-lg-1 offset-sm-3">

                <a class="btn text-danger my-2" href="javascript:history.go(-1)"><i
                            class="bi bi-arrow-left"></i>Back</a>
                <div class="card py-4  ">
                    <div class="card-body">
                        <h6>Add Category</h6>
                        <hr>

                        <form id="form" name="form" novalidate>

                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label class="my-1" for="name" id="name_label">Category Name</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <input id="name" name="name" type="text" placeholder="Ex: Life Style, Entertainment ..."
                                           onchange="clearError(this)"
                                           class="form-control" >
                                 
                                    <span id="name_error" class="text-danger"></span>
                                </div>
                                
                            </div>
                            
                            
                            <div class="row align-items-center mb-3">
                                <div class="col-lg-3 col-12">
                                    <label class="my-1" for="logo_box" id="logo_box_label">Image</label>
                                </div>
                                <div class="col-lg-9 col-12">
                                    <div class="dropzone" id="logo_box"></div>
                                    <input type="hidden" id="logo" name="logo">
                                </div>
                                <span id="logo_box_error" class="text-danger"></span>
                            </div>

                            <button id="submit-button" type="submit" class="btn btn-primary mb-3">
                                Create
                            </button>

                            <a href="<?= $url ?>category" class="btn btn-outline-secondary mb-3">Cancel</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
<?php include __DIR__ . '/../../inc/footer.php'; ?>

<script>
    /* uploads logo */
    uploads("logo_box","logo")

    /* form submit */
    $('#form').submit(function (e){
        e.preventDefault();
        let form = $(this);
        let url = window.origin + '/api/v1/category/save.php'
        formSubmit("post", "submit-button", form, url);
    })
    
    $(document).ready(function () {
        pageRestricted('category')
    })
  
</script>