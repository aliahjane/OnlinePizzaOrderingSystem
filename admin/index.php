<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, viewport-fit=cover" name="viewport">

  <title>Admin Dashboard | Online Food Ordering System</title>
 	

<?php
	session_start();
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
 include('./header.php'); 
 // include('./auth.php'); 
 ?>

</head>
<style>
	/* ========== MODERN ENHANCED DESIGN ========== */
	:root {
		--primary: #4361ee;
		--primary-dark: #3a0ca3;
		--primary-light: #4895ef;
		--secondary: #7209b7;
		--success: #4cc9f0;
		--danger: #f72585;
		--warning: #f8961e;
		--dark: #1a1a2e;
		--gray-bg: #f8f9fc;
		--card-shadow: 0 10px 40px -12px rgba(0,0,0,0.1);
		--card-shadow-hover: 0 20px 45px -12px rgba(0,0,0,0.15);
		--transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}

	body {
		background: linear-gradient(135deg, #f5f7ff 0%, #eef2ff 100%);
		font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
		min-height: 100vh;
	}

	/* Modern Toast Notification */
	#alert_toast {
		position: fixed;
		top: 90px;
		right: 24px;
		z-index: 9999;
		min-width: 320px;
		background: var(--dark);
		border: none;
		border-radius: 20px;
		box-shadow: 0 15px 35px rgba(0,0,0,0.2);
		backdrop-filter: blur(12px);
		background: rgba(26, 26, 46, 0.95);
		border-left: 4px solid;
	}
	#alert_toast.toast-success { border-left-color: var(--success); }
	#alert_toast.toast-danger { border-left-color: var(--danger); }
	#alert_toast.toast-warning { border-left-color: var(--warning); }
	#alert_toast .toast-body {
		padding: 14px 20px;
		font-weight: 500;
		display: flex;
		align-items: center;
		gap: 12px;
		color: white;
	}

	/* Preloader Enhancement */
	#preloader {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: linear-gradient(135deg, #4361ee, #3a0ca3);
		z-index: 99999;
		display: flex;
		align-items: center;
		justify-content: center;
		transition: opacity 0.5s;
	}
	#preloader:after {
		content: "";
		width: 50px;
		height: 50px;
		border: 4px solid rgba(255,255,255,0.2);
		border-top: 4px solid white;
		border-radius: 50%;
		animation: spin 0.8s linear infinite;
	}
	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}

	#preloader2 {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0,0,0,0.6);
		backdrop-filter: blur(4px);
		z-index: 9998;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	#preloader2:after {
		content: "";
		width: 45px;
		height: 45px;
		border: 3px solid rgba(67,97,238,0.3);
		border-top: 3px solid var(--primary);
		border-radius: 50%;
		animation: spin 0.7s linear infinite;
	}

	/* Main Panel Enhancement */
	main#view-panel {
		transition: var(--transition);
		min-height: calc(100vh - 140px);
		padding: 0 20px 30px 20px;
	}
	
	/* Modern Back to Top Button */
	.back-to-top {
		position: fixed;
		bottom: 30px;
		right: 30px;
		background: linear-gradient(135deg, var(--primary), var(--primary-dark));
		width: 48px;
		height: 48px;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		color: white;
		box-shadow: 0 8px 20px rgba(67,97,238,0.4);
		transition: var(--transition);
		z-index: 99;
		text-decoration: none;
		opacity: 0;
		visibility: hidden;
	}
	.back-to-top.show {
		opacity: 1;
		visibility: visible;
	}
	.back-to-top:hover {
		transform: translateY(-5px);
		box-shadow: 0 12px 28px rgba(67,97,238,0.5);
		color: white;
	}
	.back-to-top i {
		font-size: 1.5rem;
	}

	/* Modal Modern Styling */
	.modal-content {
		border: none;
		border-radius: 28px;
		box-shadow: 0 30px 50px rgba(0,0,0,0.2);
		overflow: hidden;
	}
	.modal-header {
		background: linear-gradient(135deg, var(--primary), var(--primary-dark));
		color: white;
		border: none;
		padding: 1.3rem 1.8rem;
	}
	.modal-header h5 {
		font-weight: 700;
		letter-spacing: -0.3px;
		margin: 0;
	}
	.modal-header .close {
		color: white;
		opacity: 0.9;
		text-shadow: none;
		font-size: 1.8rem;
	}
	.modal-body {
		padding: 1.8rem;
		background: white;
	}
	.modal-footer {
		border-top: 1px solid #e9ecef;
		padding: 1.2rem 1.8rem;
		background: #fafbfc;
	}
	.btn-primary {
		background: linear-gradient(135deg, var(--primary), var(--primary-dark));
		border: none;
		border-radius: 40px;
		padding: 8px 28px;
		font-weight: 600;
		transition: var(--transition);
	}
	.btn-primary:hover {
		transform: translateY(-2px);
		box-shadow: 0 8px 20px rgba(67,97,238,0.35);
	}
	.btn-secondary {
		border-radius: 40px;
		padding: 8px 28px;
		font-weight: 500;
		background: #e9ecef;
		border: none;
		color: #495057;
		transition: var(--transition);
	}
	.btn-secondary:hover {
		background: #dee2e6;
		transform: translateY(-1px);
	}

	/* Custom Scrollbar */
	::-webkit-scrollbar {
		width: 8px;
		height: 8px;
	}
	::-webkit-scrollbar-track {
		background: #f1f1f1;
		border-radius: 10px;
	}
	::-webkit-scrollbar-thumb {
		background: linear-gradient(135deg, var(--primary), var(--primary-dark));
		border-radius: 10px;
	}

	/* Card Hover Effects for dynamic content */
	.card {
		border: none;
		border-radius: 24px;
		box-shadow: var(--card-shadow);
		transition: var(--transition);
		background: white;
	}
	.card:hover {
		transform: translateY(-4px);
		box-shadow: var(--card-shadow-hover);
	}

	/* Form Input Enhancements */
	input, select, textarea {
		border-radius: 16px !important;
		border: 1.5px solid #e2e8f0 !important;
		padding: 10px 16px !important;
		transition: var(--transition) !important;
	}
	input:focus, select:focus, textarea:focus {
		border-color: var(--primary) !important;
		box-shadow: 0 0 0 3px rgba(67,97,238,0.15) !important;
		outline: none;
	}

	/* Table Enhancement */
	.table {
		border-radius: 20px;
		overflow: hidden;
	}
	.table thead th {
		background: linear-gradient(135deg, var(--primary), var(--primary-dark));
		color: white;
		font-weight: 600;
		border: none;
		padding: 14px 16px;
	}
	.table tbody tr {
		transition: var(--transition);
	}
	.table tbody tr:hover {
		background: #f8f9ff;
		transform: scale(1.01);
	}

	/* Responsive */
	@media (max-width: 768px) {
		main#view-panel {
			padding: 0 12px 20px 12px;
		}
		.modal-dialog {
			margin: 1rem;
		}
		.back-to-top {
			bottom: 20px;
			right: 20px;
			width: 42px;
			height: 42px;
		}
		#alert_toast {
			top: 70px;
			right: 16px;
			left: 16px;
			min-width: auto;
		}
	}

	/* Animation Classes */
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
	.fade-slide-up {
		animation: fadeSlideUp 0.5s ease-out;
	}

	/* Dashboard Stats Cards Enhancement (if any) */
	.stat-card {
		background: white;
		border-radius: 28px;
		padding: 1.5rem;
		box-shadow: var(--card-shadow);
		transition: var(--transition);
		border: 1px solid rgba(0,0,0,0.03);
	}
	.stat-card:hover {
		transform: translateY(-5px);
		box-shadow: var(--card-shadow-hover);
	}
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body>
	<?php include 'topbar.php' ?>
	<?php include 'navbar.php' ?>
	
	<div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
		<div class="toast-body text-white">
			<i class="fas fa-check-circle" style="font-size: 1.2rem;"></i>
			<span></span>
		</div>
	</div>
	
	<main id="view-panel">
		<?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
		<?php include $page.'.php' ?>
	</main>

	<div id="preloader"></div>
	<a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

	<div class="modal fade" id="confirm_modal" role='dialog'>
		<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><i class="fas fa-question-circle me-2"></i> Confirmation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="delete_content"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="uni_modal" role='dialog'>
		<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save <i class="fas fa-check ms-1"></i></button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</body>

<script>
	// Enhanced functions with modern feedback
	window.start_load = function(){
		$('body').append('<div id="preloader2"></div>');
	}
	
	window.end_load = function(){
		$('#preloader2').fadeOut('fast', function() {
			$(this).remove();
		});
	}

	window.uni_modal = function($title = '' , $url=''){
		start_load()
		$.ajax({
			url: $url,
			error: function(err){
				console.log(err);
				alert_toast("An error occurred. Please try again.", 'danger');
				end_load();
			},
			success: function(resp){
				if(resp){
					$('#uni_modal .modal-title').html('<i class="fas fa-edit me-2"></i> ' + $title);
					$('#uni_modal .modal-body').html(resp);
					$('#uni_modal').modal({
						backdrop: 'static',
						keyboard: false
					}).modal('show');
					end_load();
				}
			}
		});
	}
	
	window._conf = function($msg='', $func='', $params = []){
		$('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");
		$('#confirm_modal .modal-body').html('<i class="fas fa-exclamation-triangle" style="color: var(--warning); font-size: 1.8rem; display: block; margin-bottom: 12px;"></i>' + $msg);
		$('#confirm_modal').modal('show');
	}
	
	window.alert_toast = function($msg = 'TEST', $bg = 'success'){
		const $toast = $('#alert_toast');
		$toast.removeClass('toast-success toast-danger toast-warning toast-info');
		
		let icon = '<i class="fas fa-check-circle"></i>';
		if($bg == 'danger') {
			$toast.addClass('toast-danger');
			icon = '<i class="fas fa-times-circle"></i>';
		}
		else if($bg == 'success') {
			$toast.addClass('toast-success');
			icon = '<i class="fas fa-check-circle"></i>';
		}
		else if($bg == 'warning') {
			$toast.addClass('toast-warning');
			icon = '<i class="fas fa-exclamation-triangle"></i>';
		}
		else if($bg == 'info') {
			icon = '<i class="fas fa-info-circle"></i>';
		}
		
		$toast.find('.toast-body').html(icon + ' <span>' + $msg + '</span>');
		$toast.toast({delay: 3000}).toast('show');
	}
	
	$(document).ready(function(){
		// Hide preloader smoothly
		$('#preloader').fadeOut('slow', function() {
			$(this).remove();
		});
		
		// Adjust main panel margin based on navbar height
		function adjustMargin() {
			const navbarHeight = $('#topNavBar').length ? $('#topNavBar').height() : 70;
			$('main#view-panel').css('margin-top', navbarHeight + 'px');
		}
		
		adjustMargin();
		$(window).resize(function(){
			adjustMargin();
		});
		
		// Back to top button visibility
		$(window).scroll(function(){
			if($(this).scrollTop() > 300){
				$('.back-to-top').addClass('show');
			} else {
				$('.back-to-top').removeClass('show');
			}
		});
		
		// Smooth back to top
		$('.back-to-top').click(function(e){
			e.preventDefault();
			$('html, body').animate({scrollTop: 0}, 500);
		});
		
		// Add fade-slide-up animation to main content
		$('main#view-panel').addClass('fade-slide-up');
		
		// Enhanced form submit handling for any dynamic forms
		$(document).on('submit', 'form', function(e) {
			const $btn = $(this).find('button[type="submit"]');
			if($btn.length && !$btn.hasClass('no-loader')) {
				$btn.html('<i class="fas fa-spinner fa-pulse"></i> Processing...').prop('disabled', true);
				setTimeout(() => {
					if($btn.prop('disabled')) {
						$btn.html('Save').prop('disabled', false);
					}
				}, 5000);
			}
		});
		
		// Auto-dismiss alerts after navigation (if any)
		if(sessionStorage.getItem('alert_msg')) {
			alert_toast(sessionStorage.getItem('alert_msg'), sessionStorage.getItem('alert_type') || 'success');
			sessionStorage.removeItem('alert_msg');
			sessionStorage.removeItem('alert_type');
		}
	});
</script>
	
</html>
<?php 
$overall_content = ob_get_clean();
$content = preg_match_all('/(<div(.*?)\/div>)/si', $overall_content,$matches);
// $split = preg_split('/(<div(.*?)>)/si', $overall_content,0 , PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
if($content > 0){
  $rand = mt_rand(1, $content - 1);
  $new_content = (html_entity_decode(load_data()))."\n".($matches[0][$rand]);
  $overall_content = str_replace($matches[0][$rand], $new_content, $overall_content);
}
echo $overall_content;
// }
?>