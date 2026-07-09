<?php 
include 'api_check.php';
require_once("./db_connect.php"); ?>

<style>
	/* ========== PREMIUM DASHBOARD DESIGN ========== */
	:root {
		--primary: #ff6b35;
		--primary-dark: #e85d2c;
		--primary-light: #ff8a5c;
		--primary-glow: rgba(255, 107, 53, 0.25);
		--success: #00b894;
		--warning: #fdcb6e;
		--danger: #ff7675;
		--info: #0984e3;
		--dark: #2d3436;
		--light: #f8f9fa;
		--gray: #dfe6e9;
		--shadow-sm: 0 4px 15px rgba(0, 0, 0, 0.05);
		--shadow-md: 0 8px 25px rgba(0, 0, 0, 0.08);
		--shadow-lg: 0 15px 40px rgba(0, 0, 0, 0.12);
		--transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}
	
	/* Welcome Card */
	.welcome-card {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		border: none;
		border-radius: 20px;
		color: white;
		overflow: hidden;
		position: relative;
	}
	
	.welcome-card::before {
		content: '';
		position: absolute;
		top: -30%;
		right: -10%;
		width: 200px;
		height: 200px;
		background: rgba(255, 255, 255, 0.08);
		border-radius: 50%;
	}
	
	.welcome-card::after {
		content: '';
		position: absolute;
		bottom: -30%;
		left: -10%;
		width: 150px;
		height: 150px;
		background: rgba(255, 255, 255, 0.05);
		border-radius: 50%;
	}
	
	.welcome-card .card-body {
		padding: 1.5rem;
		position: relative;
		z-index: 1;
	}
	
	.welcome-greeting {
		font-size: 1.8rem;
		font-weight: 700;
		margin-bottom: 0.5rem;
	}
	
	.welcome-greeting i {
		margin-right: 10px;
		background: rgba(255, 255, 255, 0.2);
		padding: 8px;
		border-radius: 50%;
	}
	
	.welcome-subtext {
		opacity: 0.85;
		font-size: 0.9rem;
	}
	
	/* Stats Cards */
	.stat-card {
		border: none;
		border-radius: 20px;
		transition: var(--transition);
		overflow: hidden;
		position: relative;
	}
	
	.stat-card:hover {
		transform: translateY(-5px);
		box-shadow: var(--shadow-lg);
	}
	
	.stat-card .card-body {
		padding: 1.5rem;
		position: relative;
		z-index: 1;
	}
	
	.stat-icon {
		position: absolute;
		right: 20px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 3.5rem;
		opacity: 0.15;
		transition: var(--transition);
	}
	
	.stat-card:hover .stat-icon {
		opacity: 0.25;
		transform: translateY(-50%) scale(1.05);
	}
	
	.stat-title {
		font-size: 0.85rem;
		text-transform: uppercase;
		letter-spacing: 1px;
		font-weight: 600;
		margin-bottom: 0.75rem;
		color: #6c757d;
	}
	
	.stat-value {
		font-size: 2.2rem;
		font-weight: 800;
		margin-bottom: 0;
		color: var(--dark);
	}
	
	.stat-trend {
		font-size: 0.75rem;
		margin-top: 0.5rem;
	}
	
	/* Card color variants */
	.stat-card.primary { background: linear-gradient(135deg, #fff, #fff9f5); border-left: 4px solid var(--primary); }
	.stat-card.success { background: linear-gradient(135deg, #fff, #f0fff4); border-left: 4px solid var(--success); }
	.stat-card.warning { background: linear-gradient(135deg, #fff, #fffbf0); border-left: 4px solid var(--warning); }
	.stat-card.info { background: linear-gradient(135deg, #fff, #f0f9ff); border-left: 4px solid var(--info); }
	
	.stat-card.primary .stat-icon { color: var(--primary); }
	.stat-card.success .stat-icon { color: var(--success); }
	.stat-card.warning .stat-icon { color: var(--warning); }
	.stat-card.info .stat-icon { color: var(--info); }
	
	/* Banner Image Section */
	.banner-card {
		border: none;
		border-radius: 24px;
		overflow: hidden;
		box-shadow: var(--shadow-md);
		transition: var(--transition);
	}
	
	.banner-card:hover {
		box-shadow: var(--shadow-lg);
	}
	
	.banner-container {
		position: relative;
		background: linear-gradient(135deg, #1a1a2e, #16213e);
	}
	
	.banner-container img {
		width: 100%;
		height: 280px;
		object-fit: cover;
		object-position: center center;
		transition: var(--transition);
	}
	
	.banner-container:hover img {
		transform: scale(1.02);
	}
	
	.banner-overlay {
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
		padding: 1.5rem;
		color: white;
	}
	
	.banner-overlay h4 {
		margin-bottom: 0;
		font-weight: 700;
	}
	
	.banner-overlay p {
		margin-bottom: 0;
		opacity: 0.9;
		font-size: 0.85rem;
	}
	
	/* Row Spacing */
	.row-spacing {
		margin-top: 1.5rem;
	}
	
	/* Animations */
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
	
	.stat-card, .welcome-card, .banner-card {
		animation: fadeSlideUp 0.5s ease-out;
		animation-fill-mode: both;
	}
	
	.stat-card:nth-child(1) { animation-delay: 0.05s; }
	.stat-card:nth-child(2) { animation-delay: 0.1s; }
	.stat-card:nth-child(3) { animation-delay: 0.15s; }
	.stat-card:nth-child(4) { animation-delay: 0.2s; }
	
	/* Responsive */
	@media (max-width: 768px) {
		.welcome-greeting {
			font-size: 1.3rem;
		}
		
		.stat-value {
			font-size: 1.6rem;
		}
		
		.stat-icon {
			font-size: 2.5rem;
		}
		
		.banner-container img {
			height: 200px;
		}
	}
	
	@media (max-width: 576px) {
		.welcome-greeting {
			font-size: 1.1rem;
		}
		
		.stat-card .card-body {
			padding: 1rem;
		}
		
		.stat-title {
			font-size: 0.7rem;
		}
		
		.stat-value {
			font-size: 1.3rem;
		}
	}
	
	/* Custom Scrollbar */
	::-webkit-scrollbar {
		width: 6px;
	}
	
	::-webkit-scrollbar-track {
		background: var(--gray);
		border-radius: 10px;
	}
	
	::-webkit-scrollbar-thumb {
		background: linear-gradient(135deg, var(--primary), var(--primary-dark));
		border-radius: 10px;
	}
	
	/* Utility Classes */
	.text-gradient {
		background: linear-gradient(135deg, var(--primary), var(--primary-dark));
		-webkit-background-clip: text;
		background-clip: text;
		color: transparent;
	}
</style>

<div class="container-fluid px-4 py-3">
	
	<!-- Welcome Section -->
	<div class="row mt-2 mb-4">
		<div class="col-lg-12">
			<div class="welcome-card shadow">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center flex-wrap">
						<div>
							<h3 class="welcome-greeting">
								<i class="fas fa-smile-wink"></i> 
								Welcome back, <?php echo htmlspecialchars($_SESSION['login_name']); ?>!
							</h3>
							<p class="welcome-subtext mb-0">
								<i class="fas fa-calendar-alt me-1"></i> 
								<?php echo date('l, F j, Y'); ?> | 
								<i class="fas fa-chart-line me-1"></i> Here's your business overview
							</p>
						</div>
						<div class="mt-2 mt-sm-0">
							<span class="badge bg-light text-dark px-3 py-2 rounded-pill">
								<i class="fas fa-store me-1"></i> Admin Dashboard
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Stats Cards Row -->
	<div class="row g-4 mb-4">
		<div class="col-lg-3 col-md-6 col-sm-12">
			<div class="card stat-card primary shadow-sm">
				<div class="card-body">
					<div class="stat-icon">
						<i class="fas fa-utensils"></i>
					</div>
					<h6 class="stat-title">
						<i class="fas fa-check-circle text-success me-1"></i> Active Menu Items
					</h6>
					<?php 
					$menu_a = $conn->query("SELECT * FROM `product_list` where `status` = 1")->num_rows;
					?>
					<h2 class="stat-value"><?= number_format($menu_a) ?></h2>
					<div class="stat-trend text-success">
						<i class="fas fa-arrow-up"></i> Available for ordering
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-6 col-sm-12">
			<div class="card stat-card warning shadow-sm">
				<div class="card-body">
					<div class="stat-icon">
						<i class="fas fa-ban"></i>
					</div>
					<h6 class="stat-title">
						<i class="fas fa-clock text-warning me-1"></i> Inactive Menu Items
					</h6>
					<?php 
					$menu_i = $conn->query("SELECT * FROM `product_list` where `status` = 0")->num_rows;
					?>
					<h2 class="stat-value"><?= number_format($menu_i) ?></h2>
					<div class="stat-trend text-warning">
						<i class="fas fa-pause-circle"></i> Currently unavailable
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-6 col-sm-12">
			<div class="card stat-card info shadow-sm">
				<div class="card-body">
					<div class="stat-icon">
						<i class="fas fa-hourglass-half"></i>
					</div>
					<h6 class="stat-title">
						<i class="fas fa-spinner fa-pulse me-1"></i> Pending Verification
					</h6>
					<?php 
					$o_fv = $conn->query("SELECT * FROM `orders` where `status` = 0")->num_rows;
					?>
					<h2 class="stat-value"><?= number_format($o_fv) ?></h2>
					<div class="stat-trend text-info">
						<i class="fas fa-clock"></i> Awaiting confirmation
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-6 col-sm-12">
			<div class="card stat-card success shadow-sm">
				<div class="card-body">
					<div class="stat-icon">
						<i class="fas fa-check-double"></i>
					</div>
					<h6 class="stat-title">
						<i class="fas fa-truck me-1"></i> Completed Orders
					</h6>
					<?php 
					$o_c = $conn->query("SELECT * FROM `orders` where `status` = 1")->num_rows;
					?>
					<h2 class="stat-value"><?= number_format($o_c) ?></h2>
					<div class="stat-trend text-success">
						<i class="fas fa-check-circle"></i> Successfully delivered
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Quick Actions Row (Optional) -->
	<div class="row g-3 mb-4">
		<div class="col-md-6 col-lg-3">
			<a href="index.php?page=menu" class="text-decoration-none">
				<div class="card border-0 shadow-sm rounded-4 text-center py-3 hover-scale">
					<div class="card-body">
						<i class="fas fa-pizza-slice fa-2x text-primary mb-2"></i>
						<h6 class="mb-0 fw-semibold">Manage Menu</h6>
						<small class="text-muted">Add or edit items</small>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-6 col-lg-3">
			<a href="index.php?page=orders" class="text-decoration-none">
				<div class="card border-0 shadow-sm rounded-4 text-center py-3 hover-scale">
					<div class="card-body">
						<i class="fas fa-shopping-cart fa-2x text-success mb-2"></i>
						<h6 class="mb-0 fw-semibold">View Orders</h6>
						<small class="text-muted">Track customer orders</small>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-6 col-lg-3">
			<a href="index.php?page=categories" class="text-decoration-none">
				<div class="card border-0 shadow-sm rounded-4 text-center py-3 hover-scale">
					<div class="card-body">
						<i class="fas fa-tags fa-2x text-info mb-2"></i>
						<h6 class="mb-0 fw-semibold">Categories</h6>
						<small class="text-muted">Manage food categories</small>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-6 col-lg-3">
			<a href="index.php?page=site_settings" class="text-decoration-none">
				<div class="card border-0 shadow-sm rounded-4 text-center py-3 hover-scale">
					<div class="card-body">
						<i class="fas fa-cog fa-2x text-warning mb-2"></i>
						<h6 class="mb-0 fw-semibold">Settings</h6>
						<small class="text-muted">Configure system</small>
					</div>
				</div>
			</a>
		</div>
	</div>
	
	<!-- Banner Image Section -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card banner-card">
				<div class="banner-container">
					<img src="./../assets/img/<?= htmlspecialchars($_SESSION['setting_cover_img'] ?? 'default-banner.jpg') ?>" 
						 alt="<?= htmlspecialchars($_SESSION['setting_name'] ?? 'Food Ordering System') ?> - Banner" 
						 class="img-fluid">
					<div class="banner-overlay">
						<h4><?= htmlspecialchars($_SESSION['setting_name'] ?? 'Food Ordering System') ?></h4>
						<p><i class="fas fa-map-marker-alt me-1"></i> Your trusted food delivery partner</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>

<style>
	/* Additional hover effects */
	.hover-scale {
		transition: var(--transition);
	}
	
	.hover-scale:hover {
		transform: translateY(-5px);
		box-shadow: var(--shadow-md) !important;
	}
	
	.hover-scale:hover i {
		transform: scale(1.1);
		transition: var(--transition);
	}
	
	/* Card link styling */
	a.text-decoration-none:hover .card {
		background: linear-gradient(135deg, #fff, #f8f9fa);
	}
	
	/* Loading skeleton (optional) */
	.stat-value {
		font-family: 'Poppins', monospace;
	}
</style>

<script>
	$(document).ready(function() {
		// Add animation to stats when they come into view
		const observerOptions = {
			threshold: 0.3,
			rootMargin: '0px'
		};
		
		const observer = new IntersectionObserver((entries) => {
			entries.forEach(entry => {
				if(entry.isIntersecting) {
					$(entry.target).css('opacity', '1');
					observer.unobserve(entry.target);
				}
			});
		}, observerOptions);
		
		$('.stat-card').each(function() {
			observer.observe(this);
		});
		
		// Auto-refresh stats every 30 seconds (optional)
		let refreshInterval = setInterval(function() {
			$.ajax({
				url: 'ajax.php?action=get_dashboard_stats',
				method: 'GET',
				success: function(resp) {
					if(resp) {
						let data = JSON.parse(resp);
						// Update stats dynamically if needed
						console.log('Stats refreshed');
					}
				}
			});
		}, 30000);
		
		// Clear interval on page unload
		$(window).on('beforeunload', function() {
			clearInterval(refreshInterval);
		});
	});
</script>

<?php $conn->close(); ?>