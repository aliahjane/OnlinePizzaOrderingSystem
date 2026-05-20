<nav id="sidebar" class="mx-lt-5">
	<div class="sidebar-header">
		<div class="logo-wrapper">
			<i class="fas fa-utensils"></i>
			<span class="logo-text">FoodAdmin</span>
		</div>
		<button class="sidebar-toggle" id="sidebarToggle">
			<i class="fas fa-bars"></i>
		</button>
	</div>
	
	<div class="sidebar-list">
		<a href="index.php?page=home" class="nav-item nav-home">
			<span class="icon-field"><i class="fas fa-tachometer-alt"></i></span>
			<span class="nav-text">Dashboard</span>
			<span class="nav-badge"></span>
		</a>
		
		<a href="index.php?page=orders" class="nav-item nav-orders">
			<span class="icon-field"><i class="fas fa-shopping-cart"></i></span>
			<span class="nav-text">Orders</span>
			<span class="nav-badge order-count" style="display: none;"></span>
		</a>
		
		<a href="index.php?page=menu" class="nav-item nav-menu">
			<span class="icon-field"><i class="fas fa-pizza-slice"></i></span>
			<span class="nav-text">Menu Items</span>
		</a>
		
		<a href="index.php?page=categories" class="nav-item nav-categories">
			<span class="icon-field"><i class="fas fa-tags"></i></span>
			<span class="nav-text">Categories</span>
		</a>
		
		<?php if($_SESSION['login_type'] == 1): ?>
		<div class="nav-divider"></div>
		
		<a href="index.php?page=users" class="nav-item nav-users">
			<span class="icon-field"><i class="fas fa-users"></i></span>
			<span class="nav-text">User Management</span>
		</a>
		
		<a href="index.php?page=site_settings" class="nav-item nav-site_settings">
			<span class="icon-field"><i class="fas fa-sliders-h"></i></span>
			<span class="nav-text">Site Settings</span>
		</a>
		<?php endif; ?>
		
		<div class="nav-footer">
			<a href="ajax.php?action=logout" class="nav-item nav-logout">
				<span class="icon-field"><i class="fas fa-sign-out-alt"></i></span>
				<span class="nav-text">Logout</span>
			</a>
		</div>
	</div>
</nav>

<style>
	/* ========== PREMIUM SIDEBAR DESIGN ========== */
	:root {
		--sidebar-bg: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
		--sidebar-hover: linear-gradient(90deg, rgba(255, 107, 53, 0.15), transparent);
		--sidebar-active: linear-gradient(90deg, #ff6b35, #e85d2c);
		--sidebar-text: #a0aec0;
		--sidebar-text-hover: #ffffff;
		--sidebar-border: rgba(255, 255, 255, 0.05);
		--transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}
	
	#sidebar {
		position: fixed;
		left: 0;
		top: 0;
		height: 100vh;
		width: 280px;
		background: var(--sidebar-bg);
		box-shadow: 5px 0 25px rgba(0, 0, 0, 0.15);
		z-index: 1000;
		transition: var(--transition);
		overflow-y: auto;
		overflow-x: hidden;
		border-right: 1px solid var(--sidebar-border);
	}
	
	/* Sidebar Toggle (Collapsed State) */
	#sidebar.collapsed {
		width: 80px;
	}
	
	#sidebar.collapsed .sidebar-header .logo-text,
	#sidebar.collapsed .nav-text,
	#sidebar.collapsed .nav-badge,
	#sidebar.collapsed .nav-divider span {
		display: none;
	}
	
	#sidebar.collapsed .nav-item {
		justify-content: center;
		padding: 12px 0;
	}
	
	#sidebar.collapsed .icon-field {
		margin-right: 0;
		font-size: 1.3rem;
	}
	
	#sidebar.collapsed .sidebar-header {
		justify-content: center;
		padding: 20px 0;
	}
	
	#sidebar.collapsed .sidebar-header .logo-wrapper {
		justify-content: center;
	}
	
	/* Sidebar Header */
	.sidebar-header {
		padding: 20px 24px;
		border-bottom: 1px solid var(--sidebar-border);
		display: flex;
		align-items: center;
		justify-content: space-between;
		margin-bottom: 20px;
	}
	
	.logo-wrapper {
		display: flex;
		align-items: center;
		gap: 12px;
	}
	
	.logo-wrapper i {
		font-size: 1.8rem;
		color: #ff6b35;
		background: rgba(255, 107, 53, 0.15);
		padding: 8px;
		border-radius: 12px;
	}
	
	.logo-text {
		font-size: 1.3rem;
		font-weight: 700;
		background: linear-gradient(135deg, #fff, #ff8a5c);
		-webkit-background-clip: text;
		background-clip: text;
		color: transparent;
		font-family: 'Dancing Script', cursive;
	}
	
	.sidebar-toggle {
		background: rgba(255, 255, 255, 0.08);
		border: none;
		color: var(--sidebar-text);
		cursor: pointer;
		padding: 8px;
		border-radius: 8px;
		transition: var(--transition);
		display: flex;
		align-items: center;
		justify-content: center;
	}
	
	.sidebar-toggle:hover {
		background: rgba(255, 107, 53, 0.2);
		color: #ff6b35;
	}
	
	/* Navigation Items */
	.sidebar-list {
		display: flex;
		flex-direction: column;
		padding: 0 12px;
	}
	
	.nav-item {
		display: flex;
		align-items: center;
		padding: 12px 16px;
		margin: 4px 0;
		border-radius: 12px;
		color: var(--sidebar-text);
		text-decoration: none;
		transition: var(--transition);
		position: relative;
		overflow: hidden;
		gap: 12px;
	}
	
	.nav-item::before {
		content: '';
		position: absolute;
		left: 0;
		top: 0;
		width: 3px;
		height: 0;
		background: linear-gradient(135deg, #ff6b35, #ff8a5c);
		transition: var(--transition);
		border-radius: 0 3px 3px 0;
	}
	
	.nav-item:hover {
		background: var(--sidebar-hover);
		color: var(--sidebar-text-hover);
		transform: translateX(4px);
	}
	
	.nav-item.active {
		background: linear-gradient(90deg, rgba(255, 107, 53, 0.2), transparent);
		color: #ff6b35;
	}
	
	.nav-item.active::before {
		height: 100%;
	}
	
	.nav-item.active .icon-field i {
		color: #ff6b35;
	}
	
	.icon-field {
		width: 32px;
		text-align: center;
		font-size: 1.2rem;
		transition: var(--transition);
	}
	
	.icon-field i {
		transition: var(--transition);
	}
	
	.nav-text {
		flex: 1;
		font-size: 0.9rem;
		font-weight: 500;
		letter-spacing: 0.3px;
	}
	
	.nav-badge {
		background: #ff6b35;
		color: white;
		font-size: 0.7rem;
		padding: 2px 8px;
		border-radius: 20px;
		font-weight: 600;
	}
	
	/* Divider */
	.nav-divider {
		height: 1px;
		background: var(--sidebar-border);
		margin: 16px 0;
		position: relative;
	}
	
	/* Footer / Logout */
	.nav-footer {
		margin-top: auto;
		padding-top: 20px;
		border-top: 1px solid var(--sidebar-border);
		margin-top: 20px;
	}
	
	.nav-logout {
		color: #ff7675;
	}
	
	.nav-logout:hover {
		background: rgba(255, 118, 117, 0.1);
		color: #ff7675;
	}
	
	.nav-logout.active {
		background: rgba(255, 118, 117, 0.15);
		color: #ff7675;
	}
	
	/* Custom Scrollbar */
	#sidebar::-webkit-scrollbar {
		width: 4px;
	}
	
	#sidebar::-webkit-scrollbar-track {
		background: rgba(255, 255, 255, 0.05);
	}
	
	#sidebar::-webkit-scrollbar-thumb {
		background: #ff6b35;
		border-radius: 10px;
	}
	
	/* Animation for nav items */
	.nav-item {
		animation: slideIn 0.3s ease-out;
		animation-fill-mode: both;
	}
	
	.nav-item:nth-child(1) { animation-delay: 0.05s; }
	.nav-item:nth-child(2) { animation-delay: 0.1s; }
	.nav-item:nth-child(3) { animation-delay: 0.15s; }
	.nav-item:nth-child(4) { animation-delay: 0.2s; }
	.nav-item:nth-child(5) { animation-delay: 0.25s; }
	.nav-item:nth-child(6) { animation-delay: 0.3s; }
	
	@keyframes slideIn {
		from {
			opacity: 0;
			transform: translateX(-20px);
		}
		to {
			opacity: 1;
			transform: translateX(0);
		}
	}
	
	/* Tooltip for collapsed mode */
	#sidebar.collapsed .nav-item:hover .nav-text {
		position: absolute;
		left: 70px;
		background: #1a1a2e;
		padding: 8px 16px;
		border-radius: 8px;
		white-space: nowrap;
		z-index: 1001;
		box-shadow: 0 4px 12px rgba(0,0,0,0.2);
		display: block;
		font-size: 0.85rem;
	}
	
	/* Responsive */
	@media (max-width: 768px) {
		#sidebar {
			width: 260px;
			transform: translateX(-100%);
			transition: transform 0.3s ease;
		}
		
		#sidebar.mobile-open {
			transform: translateX(0);
		}
		
		.sidebar-overlay {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0,0,0,0.5);
			z-index: 999;
			display: none;
		}
		
		.sidebar-overlay.active {
			display: block;
		}
	}
	
	/* Ripple effect on click */
	.nav-item {
		position: relative;
		overflow: hidden;
	}
	
	.nav-item .ripple {
		position: absolute;
		border-radius: 50%;
		background: rgba(255, 107, 53, 0.4);
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
</style>

<script>
	$(document).ready(function() {
		// Set active navigation item
		var currentPage = '<?php echo isset($_GET['page']) ? $_GET['page'] : ''; ?>';
		$('.nav-' + currentPage).addClass('active');
		
		// Sidebar toggle functionality
		$('#sidebarToggle').on('click', function() {
			$('#sidebar').toggleClass('collapsed');
			
			// Store preference in localStorage
			var isCollapsed = $('#sidebar').hasClass('collapsed');
			localStorage.setItem('sidebarCollapsed', isCollapsed);
		});
		
		// Load collapsed state from localStorage
		var savedState = localStorage.getItem('sidebarCollapsed');
		if (savedState === 'true') {
			$('#sidebar').addClass('collapsed');
		}
		
		// Mobile sidebar handling
		var sidebarOverlay = $('<div class="sidebar-overlay"></div>').appendTo('body');
		
		$('#mobileMenuToggle').on('click', function() {
			$('#sidebar').addClass('mobile-open');
			sidebarOverlay.addClass('active');
		});
		
		sidebarOverlay.on('click', function() {
			$('#sidebar').removeClass('mobile-open');
			sidebarOverlay.removeClass('active');
		});
		
		// Ripple effect on nav items
		$('.nav-item').on('click', function(e) {
			var x = e.clientX - $(this).offset().left;
			var y = e.clientY - $(this).offset().top;
			
			var ripple = $('<span class="ripple"></span>');
			ripple.css({
				left: x + 'px',
				top: y + 'px',
				width: '20px',
				height: '20px',
				position: 'absolute'
			});
			
			$(this).append(ripple);
			setTimeout(function() {
				ripple.remove();
			}, 600);
		});
		
		// Fetch order count badge (if needed)
		function fetchOrderCount() {
			$.ajax({
				url: 'ajax.php?action=get_pending_orders_count',
				method: 'GET',
				success: function(resp) {
					if(resp > 0) {
						$('.order-count').text(resp).show();
					} else {
						$('.order-count').hide();
					}
				},
				error: function() {
					console.log('Failed to fetch order count');
				}
			});
		}
		
		// Uncomment to enable order count badge
		// fetchOrderCount();
		// setInterval(fetchOrderCount, 30000);
		
		// Add hover tooltip for collapsed mode
		if ($('#sidebar').hasClass('collapsed')) {
			$('.nav-item').each(function() {
				var text = $(this).find('.nav-text').text();
				$(this).attr('data-tooltip', text);
			});
		}
	});
	
	// Add mobile menu toggle button (if not exists)
	if ($('#mobileMenuToggle').length === 0 && $(window).width() <= 768) {
		$('body').prepend(`
			<button class="mobile-menu-toggle" id="mobileMenuToggle" style="
				position: fixed;
				top: 15px;
				left: 15px;
				z-index: 1001;
				background: linear-gradient(135deg, #ff6b35, #e85d2c);
				border: none;
				color: white;
				width: 45px;
				height: 45px;
				border-radius: 12px;
				font-size: 1.2rem;
				cursor: pointer;
				box-shadow: 0 4px 12px rgba(0,0,0,0.2);
				display: flex;
				align-items: center;
				justify-content: center;
			">
				<i class="fas fa-bars"></i>
			</button>
		`);
		
		// Adjust main content margin
		$('main#view-panel').css('margin-left', '0');
	}
</script>

<style>
	/* Additional styles for main content adjustment */
	main#view-panel {
		margin-left: 280px;
		transition: var(--transition);
	}
	
	#sidebar.collapsed + main#view-panel,
	#sidebar.collapsed ~ main#view-panel {
		margin-left: 80px;
	}
	
	@media (max-width: 768px) {
		main#view-panel {
			margin-left: 0 !important;
		}
	}
	
	/* Active state icon color enhancement */
	.nav-item.active .icon-field i {
		text-shadow: 0 0 8px rgba(255, 107, 53, 0.5);
	}
	
	/* Hover glow effect */
	.nav-item:hover .icon-field i {
		transform: scale(1.05);
	}
</style>