<?php 
include ('api_check.php');
include('db_connect.php');
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid py-3">
	
	<form action="" id="manage-user">
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		
		<div class="form-group mb-4">
			<label for="name" class="form-label fw-semibold mb-2">
				<i class="fas fa-user-circle text-primary me-2"></i>Full Name
			</label>
			<input type="text" name="name" id="name" class="form-control form-control-lg rounded-3" 
				   value="<?php echo isset($meta['name']) ? htmlspecialchars($meta['name']): '' ?>" 
				   placeholder="Enter full name" required>
			<small class="text-muted mt-1 d-block">Enter the user's complete name</small>
		</div>
		
		<div class="form-group mb-4">
			<label for="username" class="form-label fw-semibold mb-2">
				<i class="fas fa-at text-primary me-2"></i>Username
			</label>
			<input type="text" name="username" id="username" class="form-control form-control-lg rounded-3" 
				   value="<?php echo isset($meta['username']) ? htmlspecialchars($meta['username']): '' ?>" 
				   placeholder="Choose a username" required>
			<small class="text-muted mt-1 d-block">Unique identifier for login</small>
		</div>
		
		<div class="form-group mb-4">
			<label for="password" class="form-label fw-semibold mb-2">
				<i class="fas fa-lock text-primary me-2"></i>Password
			</label>
			<div class="input-group">
				<input type="password" name="password" id="password" class="form-control form-control-lg rounded-3" 
					   value="<?php echo isset($meta['password']) ? $meta['id']: '' ?>" 
					   placeholder="Enter password" required>
				<button class="btn btn-outline-secondary rounded-3" type="button" id="togglePassword" style="border-left: none;">
					<i class="fas fa-eye"></i>
				</button>
			</div>
			<small class="text-muted mt-1 d-block">
				<?php echo isset($meta['id']) ? 'Leave blank to keep current password' : 'Minimum 6 characters required'; ?>
			</small>
		</div>
		
		<div class="form-group mb-4">
			<label for="type" class="form-label fw-semibold mb-2">
				<i class="fas fa-user-tag text-primary me-2"></i>User Role
			</label>
			<select name="type" id="type" class="form-select form-select-lg rounded-3" required>
				<option value="" disabled <?php echo !isset($meta['type']) ? 'selected': '' ?>>Select user role</option>
				<option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>
					<i class="fas fa-crown"></i> Administrator
				</option>
				<option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>
					<i class="fas fa-user"></i> Staff Member
				</option>
			</select>
			<small class="text-muted mt-1 d-block">
				<i class="fas fa-info-circle"></i> Admin: Full access | Staff: Limited access
			</small>
		</div>
		
		<div class="alert alert-info mt-3 rounded-3" style="background: #e8f4fd; border: none; border-radius: 16px;">
			<i class="fas fa-shield-alt me-2"></i>
			<small>User credentials are securely encrypted. Please keep this information confidential.</small>
		</div>
	</form>
</div>

<style>
	/* Enhanced Form Styling */
	.form-group {
		animation: fadeSlideUp 0.4s ease-out;
		animation-fill-mode: both;
	}
	
	.form-group:nth-child(1) { animation-delay: 0.05s; }
	.form-group:nth-child(2) { animation-delay: 0.1s; }
	.form-group:nth-child(3) { animation-delay: 0.15s; }
	.form-group:nth-child(4) { animation-delay: 0.2s; }
	
	@keyframes fadeSlideUp {
		from {
			opacity: 0;
			transform: translateY(15px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}
	
	.form-label {
		font-size: 0.9rem;
		color: #2d3436;
		display: flex;
		align-items: center;
	}
	
	.form-control, .form-select {
		border: 2px solid #e2e8f0;
		transition: all 0.3s ease;
		background: #ffffff;
		font-size: 0.95rem;
		padding: 12px 16px;
	}
	
	.form-control:focus, .form-select:focus {
		border-color: #ff6b35;
		box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
		outline: none;
	}
	
	.input-group .form-control {
		border-right: none;
		border-radius: 12px 0 0 12px;
	}
	
	.input-group .btn-outline-secondary {
		border: 2px solid #e2e8f0;
		border-left: none;
		border-radius: 0 12px 12px 0;
		background: white;
		color: #64748b;
		transition: all 0.3s ease;
	}
	
	.input-group .btn-outline-secondary:hover {
		background: #f8f9fa;
		color: #ff6b35;
		border-color: #e2e8f0;
		border-left: none;
	}
	
	.form-select {
		cursor: pointer;
		appearance: none;
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
		background-repeat: no-repeat;
		background-position: right 16px center;
		background-size: 16px;
	}
	
	/* Alert styling */
	.alert-info {
		border-radius: 16px;
		padding: 12px 16px;
		font-size: 0.85rem;
	}
	
	/* Modal specific adjustments */
	#uni_modal .modal-body {
		padding: 1.5rem;
	}
	
	/* Responsive */
	@media (max-width: 576px) {
		.form-control, .form-select {
			font-size: 0.9rem;
			padding: 10px 14px;
		}
		.form-label {
			font-size: 0.85rem;
		}
		#uni_modal .modal-body {
			padding: 1.2rem;
		}
	}
	
	/* Invalid field styling */
	.form-control.is-invalid, .form-select.is-invalid {
		border-color: #ff7675;
		background-color: #fff5f5;
	}
	
	/* Hover effects */
	.form-control:hover, .form-select:hover {
		border-color: #cbd5e1;
	}
	
	/* Focus visible outline */
	*:focus-visible {
		outline: 2px solid #ff6b35;
		outline-offset: 2px;
	}
</style>

<script>
	// Password visibility toggle
	document.getElementById('togglePassword')?.addEventListener('click', function() {
		const passwordInput = document.getElementById('password');
		const icon = this.querySelector('i');
		
		if (passwordInput.type === 'password') {
			passwordInput.type = 'text';
			icon.classList.remove('fa-eye');
			icon.classList.add('fa-eye-slash');
		} else {
			passwordInput.type = 'password';
			icon.classList.remove('fa-eye-slash');
			icon.classList.add('fa-eye');
		}
	});
	
	// Real-time validation
	const inputs = document.querySelectorAll('#manage-user input, #manage-user select');
	inputs.forEach(input => {
		input.addEventListener('input', function() {
			this.classList.remove('is-invalid');
		});
		input.addEventListener('change', function() {
			this.classList.remove('is-invalid');
		});
	});
	
	// Username validation (no spaces)
	$('#username').on('input', function() {
		let val = $(this).val();
		if (val.includes(' ')) {
			$(this).val(val.replace(/\s/g, ''));
			$(this).addClass('is-invalid');
			setTimeout(() => $(this).removeClass('is-invalid'), 1500);
		}
	});
	
	$('#manage-user').submit(function(e){
		e.preventDefault();
		
		// Client-side validation
		let isValid = true;
		const name = $('#name').val().trim();
		const username = $('#username').val().trim();
		const password = $('#password').val();
		const type = $('#type').val();
		
		if (!name) {
			$('#name').addClass('is-invalid');
			isValid = false;
		}
		if (!username) {
			$('#username').addClass('is-invalid');
			isValid = false;
		}
		if (!password) {
			$('#password').addClass('is-invalid');
			isValid = false;
		}
		if (!type) {
			$('#type').addClass('is-invalid');
			isValid = false;
		}
		
		// Password length validation for new users
		const isEdit = <?php echo isset($meta['id']) ? 'true' : 'false'; ?>;
		if (!isEdit && password.length < 6) {
			alert_toast('Password must be at least 6 characters', 'warning');
			$('#password').addClass('is-invalid');
			isValid = false;
		}
		
		if (!isValid) {
			alert_toast('Please fill in all required fields', 'warning');
			return;
		}
		
		start_load();
		$.ajax({
			url: 'ajax.php?action=save_user',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp){
				if(resp == 1){
					alert_toast("User saved successfully!", 'success');
					setTimeout(function(){
						location.reload();
					}, 1500);
				} else if(resp == 2) {
					alert_toast("Username already exists. Please choose a different username.", 'danger');
					end_load();
				} else if(resp == 3) {
					alert_toast("Password must be at least 6 characters.", 'warning');
					end_load();
				} else {
					alert_toast("An error occurred. Please try again.", 'danger');
					end_load();
				}
			},
			error: function() {
				alert_toast("Connection error. Please try again.", 'danger');
				end_load();
			}
		});
	});
	
	// Add keyboard shortcut (Enter to submit)
	$(document).on('keypress', '#manage-user input, #manage-user select', function(e) {
		if(e.which === 13) {
			e.preventDefault();
			$('#manage-user').submit();
		}
	});
	
	// Auto-focus on first field
	$(document).ready(function() {
		$('#name').focus();
		
		// Add live character counter for password (optional)
		$('#password').on('input', function() {
			const len = $(this).val().length;
			if (len > 0 && len < 6 && <?php echo !isset($meta['id']) ? 'true' : 'false'; ?>) {
				$(this).css('border-color', '#ff7675');
			} else {
				$(this).css('border-color', '#e2e8f0');
			}
		});
	});
</script>