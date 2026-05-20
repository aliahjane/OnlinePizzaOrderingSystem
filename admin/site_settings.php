<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * from system_settings limit 1");
if($qry->num_rows > 0){
	foreach($qry->fetch_array() as $k => $val){
		$meta[$k] = $val;
	}
}
 ?>
<div class="container-fluid py-4">
	
	<div class="card col-lg-12 mx-auto border-0 shadow-xl rounded-4 overflow-hidden">
		<div class="card-header bg-gradient-primary text-white border-0 py-4">
			<div class="d-flex align-items-center gap-3">
				<div class="header-icon">
					<i class="fas fa-cogs fa-2x"></i>
				</div>
				<div>
					<h4 class="mb-0 fw-bold">System Configuration</h4>
					<p class="mb-0 opacity-75 small">Manage your application settings and branding</p>
				</div>
			</div>
		</div>
		<div class="card-body p-4">
			<form action="" id="manage-settings">
				<div class="row g-4">
					<!-- Left Column -->
					<div class="col-lg-6">
						<div class="form-group mb-4">
							<label for="name" class="form-label fw-semibold mb-2">
								<i class="fas fa-store text-primary me-2"></i>System Name
							</label>
							<input type="text" class="form-control form-control-lg rounded-3" id="name" name="name" 
								   value="<?php echo isset($meta['name']) ? htmlspecialchars($meta['name']) : '' ?>" 
								   placeholder="Enter system name" required>
							<small class="text-muted mt-1 d-block">This name appears throughout the application</small>
						</div>
						
						<div class="form-group mb-4">
							<label for="email" class="form-label fw-semibold mb-2">
								<i class="fas fa-envelope text-primary me-2"></i>Email Address
							</label>
							<input type="email" class="form-control form-control-lg rounded-3" id="email" name="email" 
								   value="<?php echo isset($meta['email']) ? htmlspecialchars($meta['email']) : '' ?>" 
								   placeholder="admin@example.com" required>
							<small class="text-muted mt-1 d-block">Used for system notifications and contact</small>
						</div>
						
						<div class="form-group mb-4">
							<label for="contact" class="form-label fw-semibold mb-2">
								<i class="fas fa-phone-alt text-primary me-2"></i>Contact Number
							</label>
							<input type="text" class="form-control form-control-lg rounded-3" id="contact" name="contact" 
								   value="<?php echo isset($meta['contact']) ? htmlspecialchars($meta['contact']) : '' ?>" 
								   placeholder="+1 234 567 8900" required>
							<small class="text-muted mt-1 d-block">Customer support contact number</small>
						</div>
						
						<div class="form-group mb-4">
							<label for="about" class="form-label fw-semibold mb-2">
								<i class="fas fa-align-left text-primary me-2"></i>About Content
							</label>
							<textarea name="about" class="text-jqte form-control"><?php echo isset($meta['about_content']) ? htmlspecialchars($meta['about_content']) : '' ?></textarea>
							<small class="text-muted mt-1 d-block">Describe your restaurant/business story</small>
						</div>
					</div>
					
					<!-- Right Column -->
					<div class="col-lg-6">
						<div class="card bg-light border-0 rounded-3 mb-4">
							<div class="card-body p-4">
								<h6 class="fw-bold mb-3">
									<i class="fas fa-image text-primary me-2"></i>Cover Image
								</h6>
								<div class="form-group mb-3">
									<label class="form-label fw-semibold mb-2">Upload New Image</label>
									<input type="file" class="form-control rounded-3" name="img" accept="image/*" onchange="displayImg(this,$(this))">
									<small class="text-muted mt-1 d-block">Supported formats: JPG, PNG, GIF (Max 2MB)</small>
								</div>
								<div class="image-preview-wrapper text-center">
									<div class="preview-container">
										<img src="<?php echo isset($meta['cover_img']) ? '../assets/img/'.$meta['cover_img'] : 'https://placehold.co/600x400?text=No+Image' ?>" 
											 alt="Cover Image" id="cimg" class="img-fluid rounded-3">
									</div>
									<small class="text-muted mt-2 d-block">Current cover image preview</small>
								</div>
							</div>
						</div>
						
						<div class="alert alert-info rounded-3 d-flex align-items-start gap-3" style="background: #e8f4fd; border: none;">
							<i class="fas fa-info-circle fa-lg mt-1" style="color: #0984e3;"></i>
							<div>
								<strong class="d-block mb-1">Settings Information</strong>
								<small>Changes made here will affect the entire system. Make sure to review before saving.</small>
							</div>
						</div>
					</div>
				</div>
				
				<hr class="my-4">
				
				<div class="d-flex justify-content-center gap-3">
					<button type="submit" class="btn btn-gradient-primary px-5 py-2 rounded-pill fw-semibold">
						<i class="fas fa-save me-2"></i>Save Settings
					</button>
					<button type="reset" class="btn btn-outline-secondary px-5 py-2 rounded-pill fw-semibold" onclick="resetForm()">
						<i class="fas fa-undo-alt me-2"></i>Reset
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<style>
	/* ========== PREMIUM SITE SETTINGS STYLES ========== */
	:root {
		--primary-gradient: linear-gradient(135deg, #ff6b35 0%, #e85d2c 100%);
		--primary-soft: rgba(255, 107, 53, 0.1);
		--shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.08);
		--transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}
	
	.bg-gradient-primary {
		background: var(--primary-gradient);
	}
	
	.btn-gradient-primary {
		background: var(--primary-gradient);
		color: white;
		border: none;
		transition: var(--transition);
		box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
	}
	
	.btn-gradient-primary:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
		color: white;
	}
	
	.btn-gradient-primary:active {
		transform: translateY(0);
	}
	
	.btn-outline-secondary {
		border: 2px solid #e2e8f0;
		color: #64748b;
		transition: var(--transition);
		background: white;
	}
	
	.btn-outline-secondary:hover {
		border-color: #ff6b35;
		color: #ff6b35;
		background: rgba(255, 107, 53, 0.05);
		transform: translateY(-2px);
	}
	
	.form-control, .form-select {
		border: 2px solid #e2e8f0;
		transition: var(--transition);
	}
	
	.form-control:focus, .form-select:focus {
		border-color: #ff6b35;
		box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
		outline: none;
	}
	
	.form-label {
		font-size: 0.9rem;
		color: #2d3436;
	}
	
	/* Image Preview Enhancement */
	.image-preview-wrapper {
		background: #f8f9fa;
		border-radius: 16px;
		padding: 1rem;
	}
	
	.preview-container {
		background: white;
		border-radius: 12px;
		padding: 1rem;
		text-align: center;
	}
	
	#cimg {
		max-height: 200px;
		max-width: 100%;
		object-fit: cover;
		border-radius: 12px;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
		transition: var(--transition);
	}
	
	#cimg:hover {
		transform: scale(1.02);
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
	}
	
	/* Card Animation */
	.card {
		animation: fadeSlideUp 0.5s ease-out;
	}
	
	@keyframes fadeSlideUp {
		from {
			opacity: 0;
			transform: translateY(20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}
	
	/* Header Icon Animation */
	.header-icon {
		animation: pulse 2s ease-in-out infinite;
	}
	
	@keyframes pulse {
		0%, 100% {
			transform: scale(1);
		}
		50% {
			transform: scale(1.05);
		}
	}
	
	/* JQTE Editor Customization (if used) */
	.jqte {
		border: 2px solid #e2e8f0 !important;
		border-radius: 16px !important;
		overflow: hidden;
	}
	
	.jqte_toolbar {
		background: #f8f9fa !important;
		border-bottom: 1px solid #e2e8f0 !important;
	}
	
	.jqte_editor {
		min-height: 200px !important;
		font-family: inherit !important;
	}
	
	/* Responsive */
	@media (max-width: 768px) {
		.preview-container {
			padding: 0.75rem;
		}
		
		#cimg {
			max-height: 150px;
		}
		
		.btn-gradient-primary, .btn-outline-secondary {
			padding: 10px 24px;
			font-size: 0.9rem;
		}
		
		.form-control-lg {
			font-size: 0.9rem;
			padding: 10px 14px;
		}
	}
	
	/* Custom Scrollbar */
	::-webkit-scrollbar {
		width: 6px;
	}
	
	::-webkit-scrollbar-track {
		background: #f1f1f1;
		border-radius: 10px;
	}
	
	::-webkit-scrollbar-thumb {
		background: linear-gradient(135deg, #ff6b35, #e85d2c);
		border-radius: 10px;
	}
	
	/* Ripple Effect for Buttons */
	.btn {
		position: relative;
		overflow: hidden;
	}
	
	.btn .ripple {
		position: absolute;
		border-radius: 50%;
		background: rgba(255, 255, 255, 0.5);
		transform: scale(0);
		animation: rippleEffect 0.6s linear;
		pointer-events: none;
	}
	
	@keyframes rippleEffect {
		to {
			transform: scale(4);
			opacity: 0;
		}
	}
	
	/* Loading state styles */
	.btn.loading {
		pointer-events: none;
		opacity: 0.7;
	}
	
	.btn.loading i {
		animation: spin 1s linear infinite;
	}
	
	@keyframes spin {
		from { transform: rotate(0deg); }
		to { transform: rotate(360deg); }
	}
</style>

<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#cimg').attr('src', e.target.result).fadeIn('slow');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	function resetForm() {
		$('#manage-settings')[0].reset();
		// Reset image preview to original
		<?php if(isset($meta['cover_img'])): ?>
		$('#cimg').attr('src', '../assets/img/<?php echo $meta['cover_img']; ?>');
		<?php else: ?>
		$('#cimg').attr('src', 'https://placehold.co/600x400?text=No+Image');
		<?php endif; ?>
	}
	
	// Initialize JQTE Editor
	$('.text-jqte').jqte({
		link: false,
		unlink: false,
		format: false,
		fs: false,
		rule: false,
		source: false,
		title: false,
		sub: false,
		sup: false,
		outdent: false,
		indent: false
	});
	
	// Ripple effect for buttons
	$('.btn').on('click', function(e) {
		var x = e.clientX - $(this).offset().left;
		var y = e.clientY - $(this).offset().top;
		
		var ripple = $('<span class="ripple"></span>');
		ripple.css({
			left: x + 'px',
			top: y + 'px',
			width: '0px',
			height: '0px',
			position: 'absolute',
			borderRadius: '50%',
			background: 'rgba(255,255,255,0.5)',
			transform: 'translate(-50%, -50%)',
			animation: 'rippleEffect 0.6s linear'
		});
		
		$(this).css('position', 'relative').append(ripple);
		setTimeout(function() {
			ripple.remove();
			$(this).css('position', '');
		}.bind(this), 600);
	});
	
	$('#manage-settings').submit(function(e){
		e.preventDefault();
		const $btn = $(this).find('button[type="submit"]');
		const originalHtml = $btn.html();
		$btn.html('<i class="fas fa-spinner fa-pulse me-2"></i>Saving...').prop('disabled', true).addClass('loading');
		
		// Validate required fields
		let isValid = true;
		$('#manage-settings input[required]').each(function() {
			if(!$(this).val().trim()) {
				$(this).addClass('is-invalid');
				isValid = false;
			} else {
				$(this).removeClass('is-invalid');
			}
		});
		
		if(!isValid) {
			alert_toast('Please fill in all required fields', 'warning');
			$btn.html(originalHtml).prop('disabled', false).removeClass('loading');
			return;
		}
		
		// Email validation
		const email = $('#email').val();
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		if(!emailRegex.test(email)) {
			$('#email').addClass('is-invalid');
			alert_toast('Please enter a valid email address', 'warning');
			$btn.html(originalHtml).prop('disabled', false).removeClass('loading');
			return;
		}
		
		start_load();
		$.ajax({
			url: 'ajax.php?action=save_settings',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			error: function(err){
				console.log(err);
				alert_toast('An error occurred. Please try again.', 'danger');
				end_load();
				$btn.html(originalHtml).prop('disabled', false).removeClass('loading');
			},
			success: function(resp){
				end_load();
				if(resp == 1){
					alert_toast('Settings saved successfully!', 'success');
					setTimeout(function(){
						location.reload();
					}, 1500);
				} else {
					alert_toast('Failed to save settings. Please try again.', 'danger');
					$btn.html(originalHtml).prop('disabled', false).removeClass('loading');
				}
			}
		});
	});
	
	// Remove invalid class on input
	$('.form-control').on('input', function() {
		$(this).removeClass('is-invalid');
	});
	
	// Auto-focus on first field
	$(document).ready(function() {
		$('#name').focus();
	});
</script>