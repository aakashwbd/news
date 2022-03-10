<?php include __DIR__.'/../inc/header.php'; ?>
<?php include __DIR__.'/../inc/sidebar.php'; ?>

<!-- ===== Main Section ===== -->
<main id="main" class="main">
	<!-- ===== Page Title Section ===== -->
	<div class="pagetitle">
		<h1>Update Password</h1>
	</div>
	<!-- ===== End Page Title Section ===== -->
	
	
	<section class="section mt-5">
	
		<form action="/admin/api/v1/admin/update_password.php" id="form" name="form" novalidate>
			<div class="row">
				<div class="col-lg-6 col-12 offset-lg-3">
					<div class="card p-3">
						<div class="card-body">

                            <div class="form-group mb-3">
                                <label class="my-1" for="current_password" id="current_password_label">Current Password</label>
                                <div class="input-group">
                                    <input id="current_password" name="current_password" type="password" placeholder="******"
                                           onchange="clearError(this)"
                                           class="form-control" required>
                                </div>
                                <span id="current_password_error" class="text-danger"></span>
                            </div>

                            <div class="form-group mb-3">
                                <label class="my-1" for="new_password" id="new_password_label">New Password</label>
                                <div class="input-group">
                                    <input id="new_password" name="new_password" type="password" placeholder="*****"
                                           onchange="clearError(this)"
                                           class="form-control" required>
                                </div>
                                <span id="new_password_error" class="text-danger"></span>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="my-1" for="confirm_password" id="confirm_password_label">Confirm Password</label>
                                <div class="input-group">
                                    <input id="confirm_password" name="confirm_password" type="password" placeholder="*****"
                                           onchange="clearError(this)"
                                           class="form-control" required>
                                </div>
                                <span id="confirm_password_error" class="text-danger"></span>
                            </div>
                            
                            <button id="submit-button" type="submit" class="btn btn-primary waves-effect mb-3">
                                Update
                            </button>

                            <a href="profile.php" class="btn btn-outline-secondary mb-3">Cancel</a>
						</div>
					</div>
				</div>
			</div>
			
		</form>
	
	</section>
	
</main>
<!-- ===== Emd Main Section ===== -->
<?php include __DIR__.'/../inc/footer.php'; ?>

<script>
    $(document).ready(function () {
        pageRestricted('manage_admin')
    })
    
    $('#form').submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let headers = {'Authorization': localStorage.getItem('token')}
        formSubmit("post", "submit-button", form, headers);
    })
</script>
