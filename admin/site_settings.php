<?php
include 'db_connect.php';

$qry = $conn->query("SELECT * FROM system_settings LIMIT 1");

if($qry->num_rows > 0){
	while($row = $qry->fetch_assoc()){
		$meta = $row;
	}
}
?>

<div class="container-fluid py-4">

	<div class="card col-lg-12 mx-auto border-0 shadow-xl rounded-4 overflow-hidden">

		<!-- HEADER -->
		<div class="card-header bg-gradient-primary text-white border-0 py-4">
			<div class="d-flex align-items-center gap-3">
				<div class="header-icon">
					<i class="fas fa-cogs fa-2x"></i>
				</div>

				<div>
					<h4 class="mb-0 fw-bold">System Configuration</h4>
					<p class="mb-0 opacity-75 small">
						Manage your application settings and branding
					</p>
				</div>
			</div>
		</div>

		<!-- BODY -->
		<div class="card-body p-4">

			<form action="" id="manage-settings">

				<div class="row g-4">

					<!-- LEFT SIDE -->
					<div class="col-lg-6">

						<div class="form-group mb-4">
							<label class="form-label fw-semibold mb-2">
								<i class="fas fa-store text-primary me-2"></i>
								System Name
							</label>

							<input type="text"
								   class="form-control form-control-lg rounded-3"
								   name="name"
								   value="<?php echo isset($meta['name']) ? htmlspecialchars($meta['name']) : '' ?>"
								   required>

							<small class="text-muted">
								This name appears throughout the application
							</small>
						</div>


						<div class="form-group mb-4">
							<label class="form-label fw-semibold mb-2">
								<i class="fas fa-envelope text-primary me-2"></i>
								Email Address
							</label>

							<input type="email"
								   class="form-control form-control-lg rounded-3"
								   name="email"
								   value="<?php echo isset($meta['email']) ? htmlspecialchars($meta['email']) : '' ?>"
								   required>

							<small class="text-muted">
								Used for system notifications and contact
							</small>
						</div>


						<div class="form-group mb-4">
							<label class="form-label fw-semibold mb-2">
								<i class="fas fa-phone-alt text-primary me-2"></i>
								Contact Number
							</label>

							<input type="text"
								   class="form-control form-control-lg rounded-3"
								   name="contact"
								   value="<?php echo isset($meta['contact']) ? htmlspecialchars($meta['contact']) : '' ?>"
								   required>

							<small class="text-muted">
								Customer support contact number
							</small>
						</div>


						<div class="form-group mb-4">
							<label class="form-label fw-semibold mb-2">
								<i class="fas fa-align-left text-primary me-2"></i>
								About Content
							</label>

							<textarea name="about" class="text-jqte form-control" rows="10"><?php
								echo isset($meta['about_content'])
									? html_entity_decode($meta['about_content'])
									: '';
							?></textarea>

							<small class="text-muted">
								Describe your restaurant/business story
							</small>
						</div>

					</div>

					<!-- RIGHT SIDE -->
					<div class="col-lg-6">

						<div class="card bg-light border-0 rounded-3 mb-4">

							<div class="card-body p-4">

								<h6 class="fw-bold mb-3">
									<i class="fas fa-image text-primary me-2"></i>
									Cover Image
								</h6>

								<div class="form-group mb-3">

									<label class="form-label fw-semibold mb-2">
										Upload New Image
									</label>

									<input type="file"
										   class="form-control rounded-3"
										   name="img"
										   accept="image/*"
										   onchange="displayImg(this)">

									<small class="text-muted">
										Supported formats: JPG, PNG, GIF
									</small>

								</div>

								<div class="image-preview-wrapper text-center">

									<div class="preview-container">

										<img
											src="<?php echo isset($meta['cover_img']) && !empty($meta['cover_img'])
												? '../assets/img/'.$meta['cover_img']
												: 'https://placehold.co/600x400?text=No+Image'; ?>"
											alt="Cover Image"
											id="cimg"
											class="img-fluid rounded-3">

									</div>

									<small class="text-muted mt-2 d-block">
										Current cover image preview
									</small>

								</div>

							</div>
						</div>


						<div class="alert alert-info rounded-3 d-flex align-items-start gap-3 info-box">
							<i class="fas fa-info-circle fa-lg mt-1"></i>

							<div>
								<strong class="d-block mb-1">
									Settings Information
								</strong>

								<small>
									Changes made here will affect the entire system.
								</small>
							</div>
						</div>

					</div>

				</div>

				<hr class="my-4">

				<div class="d-flex justify-content-center gap-3 flex-wrap">

					<button type="submit"
							class="btn btn-gradient-primary px-5 py-2 rounded-pill fw-semibold">

						<i class="fas fa-save me-2"></i>
						Save Settings
					</button>


					<button type="reset"
							class="btn btn-outline-secondary px-5 py-2 rounded-pill fw-semibold">

						<i class="fas fa-undo-alt me-2"></i>
						Reset
					</button>

				</div>

			</form>

		</div>
	</div>
</div>


<!-- ================== STYLE ================== -->

<style>

:root{
	--primary:#ff6b35;
	--primary-dark:#e85d2c;
	--gradient:linear-gradient(135deg,#ff6b35 0%,#e85d2c 100%);
	--shadow:0 15px 35px rgba(0,0,0,0.08);
	--transition:all .3s ease;
}

body{
	background:#f4f7fb;
}

/* CARD */
.shadow-xl{
	box-shadow:var(--shadow);
}

.bg-gradient-primary{
	background:var(--gradient);
}

.card{
	border:none;
	overflow:hidden;
	animation:fadeUp .5s ease;
}

@keyframes fadeUp{
	from{
		opacity:0;
		transform:translateY(20px);
	}
	to{
		opacity:1;
		transform:translateY(0);
	}
}

/* HEADER */
.header-icon{
	width:60px;
	height:60px;
	border-radius:50%;
	background:rgba(255,255,255,.15);
	display:flex;
	align-items:center;
	justify-content:center;
	backdrop-filter:blur(10px);
}

/* INPUTS */
.form-control{
	border:2px solid #e2e8f0;
	padding:12px 15px;
	transition:var(--transition);
}

.form-control:focus{
	border-color:var(--primary);
	box-shadow:0 0 0 4px rgba(255,107,53,.15);
}

/* BUTTON */
.btn-gradient-primary{
	background:var(--gradient);
	border:none;
	color:#fff;
	transition:var(--transition);
	box-shadow:0 5px 15px rgba(255,107,53,.3);
}

.btn-gradient-primary:hover{
	transform:translateY(-2px);
	color:#fff;
	box-shadow:0 10px 20px rgba(255,107,53,.4);
}

.btn-outline-secondary{
	border:2px solid #dee2e6;
	background:#fff;
	transition:var(--transition);
}

.btn-outline-secondary:hover{
	background:#f8f9fa;
	transform:translateY(-2px);
}

/* IMAGE */
.image-preview-wrapper{
	background:#f8fafc;
	border-radius:18px;
	padding:1rem;
}

.preview-container{
	background:#fff;
	padding:1rem;
	border-radius:15px;
}

#cimg{
	max-height:250px;
	object-fit:cover;
	box-shadow:0 10px 25px rgba(0,0,0,.1);
	transition:var(--transition);
}

#cimg:hover{
	transform:scale(1.02);
}

/* ALERT */
.info-box{
	background:#eaf6ff;
	border:none;
	color:#0f4c81;
}

/* JQTE */
.jqte{
	border:2px solid #e2e8f0 !important;
	border-radius:15px !important;
	overflow:hidden;
}

.jqte_editor{
	min-height:200px !important;
}

/* MOBILE */
@media(max-width:768px){

	.card-body{
		padding:1.5rem !important;
	}

	.btn{
		width:100%;
	}

	#cimg{
		max-height:180px;
	}
}

</style>


<!-- ================== SCRIPT ================== -->

<script>

$('.text-jqte').jqte();

function displayImg(input){

	if(input.files && input.files[0]){

		var reader = new FileReader();

		reader.onload = function(e){

			$('#cimg').attr('src',e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}


// SAVE SETTINGS
$('#manage-settings').submit(function(e){

	e.preventDefault();

	start_load();

	$.ajax({

		url:'ajax.php?action=save_settings',
		data:new FormData($(this)[0]),
		cache:false,
		contentType:false,
		processData:false,
		method:'POST',

		success:function(resp){

			if(resp == 1){

				alert_toast("Settings successfully saved","success");

				setTimeout(function(){

					location.reload();

				},1500);

			}else{

				alert_toast("Failed to save settings","danger");
			}

			end_load();
		}
	});
});


// TOAST
window.alert_toast = function($msg = '', $bg = 'success'){

	$('#alert_toast').remove();

	let toast = `
	<div id="alert_toast"
		 class="toast bg-${$bg}"
		 role="alert"
		 style="position:fixed;top:20px;right:20px;z-index:9999;min-width:300px;">

		<div class="toast-body text-white d-flex justify-content-between align-items-center">

			<span>${$msg}</span>

			<button type="button"
					class="ml-2 mb-1 close text-white"
					data-dismiss="toast">

				<span>&times;</span>
			</button>
		</div>
	</div>
	`;

	$('body').append(toast);

	$('#alert_toast').toast({
		delay:3000
	}).toast('show');
};

</script>