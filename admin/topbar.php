<style>
	/* ========== PREMIUM TOP NAVIGATION BAR ========== */
	:root {
		--nav-primary: linear-gradient(135deg, #ff6b35 0%, #e85d2c 100%);
		--nav-dark: #1a1a2e;
		--nav-hover: rgba(255, 255, 255, 0.12);
		--shadow-nav: 0 4px 20px rgba(0, 0, 0, 0.08);
		--transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}
	
	.logo {
		margin: auto;
		background: white;
		border-radius: 50%;
		color: #000000b3;
		height: 50px;
		width: 50px;
		position: relative;
		overflow: hidden;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
		transition: var(--transition);
	}
	
	.logo:hover {
		transform: scale(1.05);
		box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
	}
	
	.logo > img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		object-position: center center;
	}
	
	#topNavBar {
		background: var(--nav-primary) !important;
		box-shadow: var(--shadow-nav);
		backdrop-filter: blur(0px);
		transition: var(--transition);
	}
	
	#topNavBar.scrolled {
		padding: 0;
		box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
	}
	
	/* Brand Name Styling */
	.brand-wrapper {
		display: flex;
		align-items: center;
		gap: 12px;
	}
	
	.brand-text {
		font-family: 'Dancing Script', cursive !important;
		font-size: 1.5rem;
		font-weight: 700;
		margin: 0;
		letter-spacing: 0.5px;
	}
	
	.brand-text a {
		color: white;
		text-decoration: none;
		transition: var(--transition);
		position: relative;
	}
	
	.brand-text a::after {
		content: '';
		position: absolute;
		bottom: -4px;
		left: 0;
		width: 0;
		height: 2px;
		background: rgba(255, 255, 255, 0.6);
		transition: var(--transition);
	}
	
	.brand-text a:hover::after {
		width: 100%;
	}
	
	.brand-text a:hover {
		text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
	}
	
	/* User Profile Section */
	.user-section {
		display: flex;
		align-items: center;
		justify-content: flex-end;
		gap: 20px;
	}
	
	.user-profile {
		display: flex;
		align-items: center;
		gap: 12px;
		cursor: pointer;
		position: relative;
		padding: 8px 12px;
		border-radius: 50px;
		transition: var(--transition);
		background: rgba(255, 255, 255, 0.08);
	}
	
	.user-profile:hover {
		background: rgba(255, 255, 255, 0.15);
		transform: translateY(-2px);
	}
	
	.user-avatar {
		width: 36px;
		height: 36px;
		background: rgba(255, 255, 255, 0.2);
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 1rem;
		font-weight: 600;
		color: white;
	}
	
	.user-info {
		display: flex;
		flex-direction: column;
		line-height: 1.2;
	}
	
	.user-name {
		font-weight: 600;
		font-size: 0.9rem;
		color: white;
	}
	
	.user-role {
		font-size: 0.7rem;
		color: rgba(255, 255, 255, 0.7);
	}
	
	.logout-btn {
		color: white;
		text-decoration: none;
		display: flex;
		align-items: center;
		gap: 8px;
		padding: 8px 16px;
		border-radius: 50px;
		background: rgba(255, 255, 255, 0.08);
		transition: var(--transition);
		font-weight: 500;
		font-size: 0.9rem;
	}
	
	.logout-btn:hover {
		background: rgba(255, 255, 255, 0.2);
		transform: translateY(-2px);
		color: white;
	}
	
	.logout-btn i {
		font-size: 1rem;
		transition: var(--transition);
	}
	
	.logout-btn:hover i {
		transform: rotate(180deg);
	}
	
	/* Mobile Menu Toggle */
	.mobile-menu-toggle {
		display: none;
		background: rgba(255, 255, 255, 0.1);
		border: none;
		color: white;
		font-size: 1.3rem;
		padding: 8px 12px;
		border-radius: 12px;
		cursor: pointer;
		transition: var(--transition);
	}
	
	.mobile-menu-toggle:hover {
		background: rgba(255, 255, 255, 0.2);
	}
	
	/* Responsive Design */
	@media (max-width: 992px) {
		.brand-text {
			font-size: 1.2rem;
		}
		
		.user-name {
			font-size: 0.85rem;
		}
		
		.logout-btn span {
			display: none;
		}
		
		.logout-btn {
			padding: 8px 12px;
		}
	}
	
	@media (max-width: 768px) {
		.mobile-menu-toggle {
			display: block;
		}
		
		.brand-text {
			font-size: 1rem;
		}
		
		.logo {
			height: 40px;
			width: 40px;
		}
		
		.user-avatar {
			width: 32px;
			height: 32px;
			font-size: 0.85rem;
		}
		
		.user-name {
			font-size: 0.8rem;
		}
		
		.user-role {
			font-size: 0.65rem;
		}
		
		.user-profile {
			padding: 4px 8px;
		}
	}
	
	@media (max-width: 576px) {
		.user-info {
			display: none;
		}
		
		.user-profile {
			padding: 6px;
		}
		
		.brand-text {
			font-size: 0.9rem;
		}
		
		.logo {
			height: 35px;
			width: 35px;
		}
	}
	
	/* Notification Badge (Optional) */
	.notification-badge {
		position: relative;
	}
	
	.notification-badge .badge {
		position: absolute;
		top: -5px;
		right: -5px;
		background: #ff4757;
		color: white;
		font-size: 0.7rem;
		padding: 2px 6px;
		border-radius: 50%;
	}
	
	/* Pulse Animation for Logo */
	@keyframes softPulse {
		0%, 100% {
			box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.3);
		}
		50% {
			box-shadow: 0 0 0 6px rgba(255, 255, 255, 0);
		}
	}
	
	.logo {
		animation: softPulse 2s ease-in-out infinite;
	}
</style>

<nav class="navbar navbar-dark fixed-top" id="topNavBar" style="padding: 0;">
	<div class="container-fluid py-2 py-md-3 px-3 px-md-4">
		<div class="col-lg-12">
			<div class="row align-items-center">
				<!-- Mobile Menu Toggle Button -->
				<div class="col-2 d-md-none">
					<button class="mobile-menu-toggle" id="mobileMenuToggle">
						<i class="fas fa-bars"></i>
					</button>
				</div>
				
				<!-- Logo Section -->
				<div class="col-3 col-md-2 col-lg-1 d-flex justify-content-start">
					<div class="logo">
						<img src="./../assets/defaults/pizza-logo.png" alt="<?php echo htmlspecialchars($_SESSION['setting_name']); ?> - Brand Logo">
					</div>
				</div>
				
				<!-- Brand Name Section -->
				<div class="col-6 col-md-6 col-lg-7">
					<div class="brand-wrapper">
						<h4 class="brand-text mb-0">
							<a href="./../" class="text-reset text-decoration-none">
								<b><?php echo htmlspecialchars($_SESSION['setting_name']); ?> - Admin Site</b>
							</a>
						</h4>
					</div>
				</div>
				
				<!-- User Actions Section -->
				<div class="col-3 col-md-4 col-lg-4">
					<div class="user-section">
						<!-- User Profile Dropdown -->
						<div class="user-profile" id="userProfile">
							<div class="user-avatar">
								<?php 
									$initial = strtoupper(substr($_SESSION['login_name'], 0, 1));
									echo $initial;
								?>
							</div>
							<div class="user-info">
								<span class="user-name"><?php echo htmlspecialchars($_SESSION['login_name']); ?></span>
								<span class="user-role">
									<?php 
										if(isset($_SESSION['login_type'])) {
											echo $_SESSION['login_type'] == 1 ? 'Administrator' : 'Staff';
										}
									?>
								</span>
							</div>
						</div>
						
						<!-- Logout Button -->
						<a href="ajax.php?action=logout" class="logout-btn" title="Logout">
							<i class="fas fa-sign-out-alt"></i>
							<span>Logout</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>

<script>
	$(document).ready(function() {
		// Navbar scroll effect
		$(window).scroll(function() {
			if ($(this).scrollTop() > 10) {
				$('#topNavBar').addClass('scrolled');
			} else {
				$('#topNavBar').removeClass('scrolled');
			}
		});
		
		// User profile click effect (optional dropdown)
		$('#userProfile').on('click', function() {
			// You can add a dropdown menu here if needed
			console.log('User profile clicked');
		});
		
		// Add ripple effect to logout button
		$('.logout-btn').on('click', function(e) {
			var x = e.clientX - $(this).offset().left;
			var y = e.clientY - $(this).offset().top;
			
			var ripple = $('<span class="ripple-effect"></span>');
			ripple.css({
				left: x + 'px',
				top: y + 'px',
				position: 'absolute',
				width: '0px',
				height: '0px',
				borderRadius: '50%',
				background: 'rgba(255,255,255,0.4)',
				transform: 'translate(-50%, -50%)',
				animation: 'rippleAnim 0.6s linear'
			});
			
			$(this).css('position', 'relative').append(ripple);
			setTimeout(function() {
				ripple.remove();
				$(this).css('position', '');
			}.bind(this), 600);
		});
		
		// Mobile menu toggle functionality (for sidebar)
		$('#mobileMenuToggle').on('click', function() {
			$('#sidebar').toggleClass('mobile-open');
			$('.sidebar-overlay').toggleClass('active');
		});
	});
	
	// Add ripple animation style
	const rippleStyle = document.createElement('style');
	rippleStyle.textContent = `
		@keyframes rippleAnim {
			0% {
				width: 0px;
				height: 0px;
				opacity: 0.8;
			}
			100% {
				width: 200px;
				height: 200px;
				opacity: 0;
			}
		}
		.ripple-effect {
			pointer-events: none;
		}
	`;
	document.head.appendChild(rippleStyle);
</script>

<!-- Optional: Add sidebar overlay for mobile if not already present -->
<style>
	.sidebar-overlay {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.5);
		z-index: 998;
		display: none;
		transition: all 0.3s ease;
	}
	
	.sidebar-overlay.active {
		display: block;
	}
	
	/* Adjust main content padding for fixed navbar */
	main#view-panel {
		padding-top: 80px;
	}
	
	@media (max-width: 768px) {
		main#view-panel {
			padding-top: 70px;
		}
	}
</style>