<div class="container-fluid py-4">
	<div class="card border-0 shadow-xl rounded-4 overflow-hidden">
		<div class="card-header bg-gradient-primary text-white border-0 py-4">
			<div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
				<div class="d-flex align-items-center gap-3">
					<div class="header-icon">
						<i class="fas fa-shopping-cart fa-2x"></i>
					</div>
					<div>
						<h4 class="mb-0 fw-bold">Order Management</h4>
						<p class="mb-0 opacity-75 small">View and manage customer orders</p>
					</div>
				</div>
				<div class="d-flex gap-2">
					<span class="badge bg-soft-warning px-3 py-2 rounded-pill">
						<i class="fas fa-clock me-1"></i> Pending: <span id="pendingCount">0</span>
					</span>
					<span class="badge bg-soft-success px-3 py-2 rounded-pill">
						<i class="fas fa-check-circle me-1"></i> Confirmed: <span id="confirmedCount">0</span>
					</span>
				</div>
			</div>
		</div>
		<div class="card-body p-0">
			<div class="table-responsive">
				<table class="table table-hover align-middle mb-0" id="ordersTable">
					<thead class="bg-gradient-table">
						<tr>
							<th class="text-center py-3 px-3" width="60">#</th>
							<th class="py-3 px-3">
								<i class="fas fa-user me-1"></i> Customer Name
							</th>
							<th class="py-3 px-3">
								<i class="fas fa-map-marker-alt me-1"></i> Address
							</th>
							<th class="py-3 px-3">
								<i class="fas fa-envelope me-1"></i> Email
							</th>
							<th class="py-3 px-3">
								<i class="fas fa-phone-alt me-1"></i> Mobile
							</th>
							<th class="text-center py-3 px-3" width="130">
								<i class="fas fa-flag-checkered me-1"></i> Status
							</th>
							<th class="text-center py-3 px-3" width="120">
								<i class="fas fa-eye me-1"></i> Action
							</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1;
						$pending = 0;
						$confirmed = 0;
						include 'db_connect.php';
						$qry = $conn->query("SELECT * FROM orders ORDER BY id DESC");
						while($row = $qry->fetch_assoc()):
							if($row['status'] == 1) {
								$confirmed++;
							} else {
								$pending++;
							}
						?>
						<tr class="order-row" data-status="<?php echo $row['status']; ?>">
							<td class="text-center fw-bold text-muted"><?php echo $i++ ?> </td>
							<td class="px-3">
								<div class="d-flex align-items-center gap-3">
									<div class="customer-avatar rounded-circle d-flex align-items-center justify-content-center"
										 style="width: 42px; height: 42px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
										<i class="fas fa-user text-white"></i>
									</div>
									<div>
										<h6 class="mb-0 fw-semibold text-dark"><?php echo htmlspecialchars($row['name']) ?></h6>
										<small class="text-muted">Order #<?php echo str_pad($row['id'], 6, '0', STR_PAD_LEFT) ?></small>
									</div>
								</div>
							</td>
							<td class="px-3">
								<i class="fas fa-location-dot text-muted me-1"></i>
								<?php echo htmlspecialchars(substr($row['address'], 0, 50)) . (strlen($row['address']) > 50 ? '...' : '') ?>
							</td>
							<td class="px-3">
								<i class="fas fa-envelope text-muted me-1"></i>
								<?php echo htmlspecialchars($row['email']) ?>
							</td>
							<td class="px-3">
								<i class="fas fa-phone-alt text-muted me-1"></i>
								<?php echo htmlspecialchars($row['mobile']) ?>
							</td>
							<td class="text-center">
								<?php if($row['status'] == 1): ?>
									<span class="badge bg-success rounded-pill px-3 py-2">
										<i class="fas fa-check-circle me-1"></i> Confirmed
									</span>
								<?php else: ?>
									<span class="badge bg-warning rounded-pill px-3 py-2 text-dark">
										<i class="fas fa-hourglass-half me-1"></i> For Verification
									</span>
								<?php endif; ?>
							</td>
							<td class="text-center">
								<button class="btn btn-sm btn-soft-primary rounded-pill px-3 view_order" 
										data-id="<?php echo $row['id'] ?>"
										title="View Order Details">
									<i class="fas fa-eye me-1"></i> View
								</button>
							</td>
						</tr>
						<?php endwhile; ?>
						<?php if($qry->num_rows == 0): ?>
						<tr>
							<td colspan="7" class="text-center py-5">
								<i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
								<p class="text-muted mb-0">No orders found</p>
							</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<style>
	/* ========== PREMIUM ORDERS PAGE STYLES ========== */
	:root {
		--primary: #ff6b35;
		--primary-dark: #e85d2c;
		--primary-light: #ff8a5c;
		--primary-glow: rgba(255, 107, 53, 0.2);
		--success: #00b894;
		--warning: #fdcb6e;
		--danger: #ff7675;
		--info: #0984e3;
		--dark: #2d3436;
		--light: #f8f9fa;
		--gray: #dfe6e9;
		--shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
		--shadow-md: 0 5px 20px rgba(0, 0, 0, 0.08);
		--shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.12);
		--transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}
	
	/* Card Styling */
	.card {
		transition: var(--transition);
	}
	
	.card:hover {
		transform: translateY(-3px);
		box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
	}
	
	/* Gradient Header */
	.bg-gradient-primary {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	}
	
	.header-icon {
		animation: pulse 2s ease-in-out infinite;
	}
	
	@keyframes pulse {
		0%, 100% { transform: scale(1); }
		50% { transform: scale(1.05); }
	}
	
	/* Table Styling */
	.bg-gradient-table {
		background: linear-gradient(135deg, #f8f9fc 0%, #f1f3f9 100%);
		border-bottom: 2px solid #e2e8f0;
	}
	
	.table {
		margin-bottom: 0;
	}
	
	.table th {
		font-weight: 600;
		font-size: 0.85rem;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		color: #4a5568;
		border-bottom: none;
	}
	
	.table td {
		vertical-align: middle;
		border-color: #f0f2f5;
	}
	
	.order-row {
		transition: var(--transition);
		animation: fadeSlideUp 0.3s ease-out;
		animation-fill-mode: both;
	}
	
	.order-row:hover {
		background: linear-gradient(90deg, rgba(102, 126, 234, 0.04), transparent);
	}
	
	@keyframes fadeSlideUp {
		from {
			opacity: 0;
			transform: translateY(10px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}
	
	/* Badge Styling */
	.badge {
		font-weight: 500;
		font-size: 0.75rem;
	}
	
	.bg-success {
		background: linear-gradient(135deg, #00b894, #009432) !important;
	}
	
	.bg-warning {
		background: linear-gradient(135deg, #fdcb6e, #f39c12) !important;
	}
	
	/* Button Styling */
	.btn-soft-primary {
		background: rgba(102, 126, 234, 0.1);
		color: #667eea;
		border: 1px solid rgba(102, 126, 234, 0.2);
		transition: var(--transition);
	}
	
	.btn-soft-primary:hover {
		background: #667eea;
		color: white;
		border-color: #667eea;
		transform: translateY(-2px);
	}
	
	/* Avatar Animation */
	.customer-avatar {
		transition: var(--transition);
	}
	
	.order-row:hover .customer-avatar {
		transform: scale(1.05);
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
	}
	
	/* DataTables Customization */
	.dataTables_wrapper .dataTables_length,
	.dataTables_wrapper .dataTables_filter {
		margin: 1rem;
	}
	
	.dataTables_wrapper .dataTables_filter input {
		border: 2px solid #e2e8f0;
		border-radius: 40px;
		padding: 8px 16px;
		margin-left: 8px;
		transition: var(--transition);
	}
	
	.dataTables_wrapper .dataTables_filter input:focus {
		border-color: #667eea;
		outline: none;
		box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
	}
	
	.dataTables_wrapper .dataTables_paginate .paginate_button.current {
		background: linear-gradient(135deg, #667eea, #764ba2);
		color: white !important;
		border: none;
		border-radius: 8px;
	}
	
	.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
		background: #667eea;
		color: white !important;
		border-radius: 8px;
	}
	
	.dataTables_wrapper .dataTables_info {
		padding: 1rem;
		color: #64748b;
	}
	
	/* Responsive */
	@media (max-width: 768px) {
		.table th, .table td {
			padding: 0.75rem;
		}
		
		.customer-avatar {
			width: 35px !important;
			height: 35px !important;
		}
		
		.btn-soft-primary {
			padding: 5px 10px;
			font-size: 0.75rem;
		}
		
		.badge {
			padding: 5px 10px;
			font-size: 0.7rem;
		}
	}
	
	/* Custom Scrollbar */
	.table-responsive::-webkit-scrollbar {
		height: 6px;
	}
	
	.table-responsive::-webkit-scrollbar-track {
		background: #f1f1f1;
		border-radius: 10px;
	}
	
	.table-responsive::-webkit-scrollbar-thumb {
		background: linear-gradient(135deg, #667eea, #764ba2);
		border-radius: 10px;
	}
	
	/* Status Badge Animations */
	.badge {
		transition: var(--transition);
	}
	
	.badge:hover {
		transform: scale(1.02);
	}
	
	/* Loading Skeleton Effect (optional) */
	.order-row {
		position: relative;
	}
	
	/* Empty State Styling */
	.fa-inbox {
		opacity: 0.5;
	}
</style>

<script>
	$(document).ready(function() {
		// Update pending and confirmed counts
		let pending = 0;
		let confirmed = 0;
		
		$('.order-row').each(function() {
			if($(this).data('status') == 1) {
				confirmed++;
			} else {
				pending++;
			}
		});
		
		$('#pendingCount').text(pending);
		$('#confirmedCount').text(confirmed);
		
		// Initialize DataTable with enhanced options
		$('#ordersTable').DataTable({
			pageLength: 10,
			language: {
				search: "<i class='fas fa-search'></i> Search:",
				searchPlaceholder: "Search orders...",
				lengthMenu: "Show _MENU_ entries",
				info: "Showing _START_ to _END_ of _TOTAL_ orders",
				emptyTable: "No orders found",
				zeroRecords: "No matching orders found"
			},
			responsive: true,
			order: [[0, 'desc']],
			dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
				 '<"row"<"col-sm-12"tr>>' +
				 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
		});
		
		// View order button handler
		$('.view_order').click(function(){
			let orderId = $(this).data('id');
			uni_modal('Order Details', 'view_order.php?id=' + orderId);
		});
		
		// Add row click animation
		$('.order-row').on('click', function(e) {
			if(!$(e.target).is('button')) {
				$(this).find('.view_order').click();
			}
		});
		
		// Ripple effect for buttons
		$('.btn').on('click', function(e) {
			let x = e.clientX - $(this).offset().left;
			let y = e.clientY - $(this).offset().top;
			
			let ripple = $('<span class="ripple"></span>');
			ripple.css({
				left: x + 'px',
				top: y + 'px',
				position: 'absolute',
				width: '0px',
				height: '0px',
				borderRadius: '50%',
				background: 'rgba(255,255,255,0.5)',
				transform: 'translate(-50%, -50%)',
				animation: 'rippleEffect 0.6s linear'
			});
			
			$(this).css('position', 'relative').append(ripple);
			setTimeout(() => ripple.remove(), 600);
		});
	});
	
	// Ripple animation style
	const rippleStyle = document.createElement('style');
	rippleStyle.textContent = `
		@keyframes rippleEffect {
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
	`;
	document.head.appendChild(rippleStyle);
</script>