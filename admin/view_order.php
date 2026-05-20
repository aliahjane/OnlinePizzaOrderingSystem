<div class="container-fluid p-3">
	
	<!-- Enhanced Order Summary Card -->
	<div class="card border-0 shadow-lg rounded-4 mb-4 overflow-hidden">
		<div class="card-header bg-gradient-primary text-white border-0 py-3">
			<div class="d-flex align-items-center justify-content-between">
				<h5 class="mb-0 fw-bold">
					<i class="fas fa-shopping-bag me-2"></i>Order Details
				</h5>
				<span class="badge bg-light text-primary px-3 py-2 rounded-pill">
					<i class="fas fa-receipt me-1"></i> Order #<?php echo htmlspecialchars($_GET['id']); ?>
				</span>
			</div>
		</div>
		<div class="card-body p-0">
			<div class="table-responsive">
				<table class="table table-hover align-middle mb-0" id="orderItemsTable">
					<thead class="bg-light">
						<tr class="text-muted">
							<th class="py-3 px-4 text-center" width="100">
								<i class="fas fa-calculator me-1"></i> Qty
							</th>
							<th class="py-3 px-4">
								<i class="fas fa-hamburger me-1"></i> Item
							</th>
							<th class="py-3 px-4 text-end" width="150">
								<i class="fas fa-dollar-sign me-1"></i> Amount
							</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$total = 0;
						include 'db_connect.php';
						$qry = $conn->query("SELECT * FROM order_list o inner join product_list p on o.product_id = p.id  where order_id =".$_GET['id']);
						while($row=$qry->fetch_assoc()):
							$subtotal = $row['qty'] * $row['price'];
							$total += $subtotal;
						?>
						<tr class="order-item-row">
							<td class="text-center py-3">
								<span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold fs-6">
									<?php echo $row['qty'] ?> ×
								</span>
							</td>
							<td class="py-3">
								<div class="d-flex align-items-center gap-3">
									<div class="item-icon rounded-circle bg-light d-flex align-items-center justify-content-center" 
										 style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
										<i class="fas fa-pizza-slice text-white"></i>
									</div>
									<div>
										<h6 class="mb-0 fw-semibold text-dark"><?php echo htmlspecialchars($row['name']) ?></h6>
										<small class="text-muted">₱ <?php echo number_format($row['price'], 2) ?> each</small>
									</div>
								</div>
							</td>
							<td class="text-end py-3 fw-bold text-dark fs-6">
								₱ <?php echo number_format($subtotal, 2) ?>
							</td>
						</tr>
						<?php endwhile; ?>
						<?php if($qry->num_rows == 0): ?>
						<tr>
							<td colspan="3" class="text-center py-5">
								<i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
								<p class="text-muted mb-0">No items found in this order</p>
							</td>
						</tr>
						<?php endif; ?>
					</tbody>
					<tfoot class="bg-light">
						<tr class="border-top">
							<th colspan="2" class="text-end py-3 px-4">
								<span class="fs-5 fw-semibold text-dark">Total Amount</span>
							</th>
							<th class="text-end py-3 px-4">
								<span class="badge bg-success fs-6 px-4 py-2 rounded-pill">
									₱ <?php echo number_format($total, 2) ?>
								</span>
							</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	
	<!-- Action Buttons -->
	<div class="d-flex justify-content-center gap-3 mt-3">
		<button class="btn btn-gradient-primary px-4 py-2 rounded-pill fw-semibold" id="confirm" type="button" onclick="confirm_order()">
			<i class="fas fa-check-circle me-2"></i>Confirm Order
		</button>
		<button type="button" class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-semibold" data-dismiss="modal">
			<i class="fas fa-times-circle me-2"></i>Close
		</button>
	</div>
</div>

<style>
	/* Enhanced Styling */
	:root {
		--primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		--success: #10b981;
		--danger: #ef4444;
		--warning: #f59e0b;
		--info: #3b82f6;
	}
	
	.bg-gradient-primary {
		background: var(--primary-gradient);
	}
	
	.btn-gradient-primary {
		background: var(--primary-gradient);
		color: white;
		border: none;
		transition: all 0.3s ease;
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
	}
	
	.btn-gradient-primary:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
		color: white;
	}
	
	.btn-gradient-primary:active {
		transform: translateY(0);
	}
	
	.btn-outline-secondary {
		border: 2px solid #e2e8f0;
		background: white;
		color: #64748b;
		transition: all 0.3s ease;
	}
	
	.btn-outline-secondary:hover {
		border-color: #667eea;
		color: #667eea;
		background: rgba(102, 126, 234, 0.05);
		transform: translateY(-2px);
	}
	
	/* Table styling enhancements */
	.table {
		margin-bottom: 0;
	}
	
	.table th, .table td {
		vertical-align: middle;
		border-color: #f0f2f5;
	}
	
	.table thead th {
		font-weight: 600;
		font-size: 0.9rem;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	
	/* Item row animation */
	.order-item-row {
		transition: all 0.2s ease;
		animation: fadeInUp 0.3s ease-out;
		animation-fill-mode: both;
	}
	
	.order-item-row:hover {
		background: linear-gradient(90deg, rgba(102, 126, 234, 0.03), transparent);
		transform: scale(1.01);
	}
	
	/* Stagger animation for rows */
	.order-item-row:nth-child(1) { animation-delay: 0.05s; }
	.order-item-row:nth-child(2) { animation-delay: 0.1s; }
	.order-item-row:nth-child(3) { animation-delay: 0.15s; }
	.order-item-row:nth-child(4) { animation-delay: 0.2s; }
	.order-item-row:nth-child(5) { animation-delay: 0.25s; }
	
	@keyframes fadeInUp {
		from {
			opacity: 0;
			transform: translateY(15px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}
	
	/* Card hover effect */
	.card {
		transition: transform 0.3s ease, box-shadow 0.3s ease;
	}
	
	.card:hover {
		transform: translateY(-4px);
		box-shadow: 0 20px 35px -12px rgba(0,0,0,0.15) !important;
	}
	
	/* Custom badge styling */
	.badge.bg-primary.bg-opacity-10 {
		background: rgba(102, 126, 234, 0.1) !important;
		color: #667eea !important;
	}
	
	.badge.bg-success {
		background: linear-gradient(135deg, #10b981, #059669) !important;
		box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
	}
	
	/* Modal body padding adjustment */
	.modal-body {
		padding: 0;
	}
	
	/* Responsive adjustments */
	@media (max-width: 576px) {
		.container-fluid {
			padding: 0.5rem !important;
		}
		
		.btn-gradient-primary, .btn-outline-secondary {
			padding: 0.5rem 1rem !important;
			font-size: 0.9rem;
		}
		
		.item-icon {
			width: 35px !important;
			height: 35px !important;
		}
		
		.table th, .table td {
			padding: 0.75rem;
		}
		
		.badge.bg-success.fs-6 {
			font-size: 0.9rem !important;
			padding: 0.35rem 1rem !important;
		}
	}
	
	/* Custom scrollbar for table */
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
	
	/* Loading state for confirm button */
	.btn-gradient-primary.loading {
		pointer-events: none;
		opacity: 0.7;
	}
	
	.btn-gradient-primary.loading i {
		animation: spin 1s linear infinite;
	}
	
	@keyframes spin {
		from { transform: rotate(0deg); }
		to { transform: rotate(360deg); }
	}
	
	/* Price highlight animation */
	@keyframes highlightPulse {
		0%, 100% { transform: scale(1); }
		50% { transform: scale(1.05); }
	}
	
	.badge.bg-success {
		animation: highlightPulse 0.5s ease-out;
	}
</style>

<script>
	function confirm_order(){
		// Add loading state to button
		const $btn = $('#confirm');
		const originalText = $btn.html();
		$btn.html('<i class="fas fa-spinner fa-pulse me-2"></i>Processing...').prop('disabled', true).addClass('loading');
		
		start_load()
		$.ajax({
			url:'ajax.php?action=confirm_order',
			method:'POST',
			data:{id:'<?php echo $_GET['id'] ?>'},
			success:function(resp){
				if(resp == 1){
					alert_toast("Order confirmed successfully!", 'success')
					setTimeout(function(){
						location.reload()
					},1500)
				} else if(resp == 2) {
					alert_toast("Order already confirmed.", 'warning')
					end_load()
					$btn.html(originalText).prop('disabled', false).removeClass('loading');
				} else {
					alert_toast("Failed to confirm order. Please try again.", 'danger')
					end_load()
					$btn.html(originalText).prop('disabled', false).removeClass('loading');
				}
			},
			error: function() {
				alert_toast("An error occurred. Please check your connection.", 'danger')
				end_load()
				$btn.html(originalText).prop('disabled', false).removeClass('loading');
			}
		})
	}
	
	// Add keyboard shortcut for confirmation (Enter key)
	$(document).ready(function() {
		$(document).on('keypress', function(e) {
			if(e.which === 13 && $('#confirm').is(':visible')) {
				e.preventDefault();
				$('#confirm').click();
			}
		});
		
		// Add hover effect to table rows
		$('.order-item-row').hover(
			function() {
				$(this).find('.badge.bg-primary').addClass('shadow-sm');
			},
			function() {
				$(this).find('.badge.bg-primary').removeClass('shadow-sm');
			}
		);
	});
</script>

<style>
	/* Additional modal-specific overrides */
	#uni_modal .modal-footer {
		display: none !important;
	}
	
	#uni_modal .modal-body {
		padding: 1.5rem !important;
	}
	
	@media (max-width: 576px) {
		#uni_modal .modal-body {
			padding: 1rem !important;
		}
	}
</style>