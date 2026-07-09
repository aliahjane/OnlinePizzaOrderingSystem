<?php 
include ('api_check.php');
include 'db_connect.php';
?>

<div class="container-fluid py-4">
	
	<!-- Header Section with Action Button -->
	<div class="row mb-4">
		<div class="col-lg-12">
			<div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
				<div>
					<h4 class="mb-0 fw-bold text-dark">
						<i class="fas fa-users-cog text-primary me-2"></i>User Management
					</h4>
					<p class="text-muted mb-0 mt-1">Manage system users and their permissions</p>
				</div>
				<button class="btn btn-gradient-primary rounded-pill px-4 py-2" id="new_user">
					<i class="fas fa-plus-circle me-2"></i>Add New User
				</button>
			</div>
		</div>
	</div>
	
	<!-- Users Table Card -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card border-0 shadow-xl rounded-4 overflow-hidden">
				<div class="card-header bg-white border-0 py-3 px-4">
					<div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
						<h5 class="mb-0 fw-semibold">
							<i class="fas fa-users text-primary me-2"></i>System Users
						</h5>
						<span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
							<i class="fas fa-database me-1"></i> 
							<?php 
								$count = $conn->query("SELECT COUNT(*) as cnt FROM users")->fetch_assoc()['cnt'];
								echo $count; 
							?> Total Users
						</span>
					</div>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
						<table class="table table-hover align-middle mb-0" id="usersTable">
							<thead class="bg-gradient-table">
								<tr>
									<th class="text-center py-3 px-3" width="60">#</th>
									<th class="py-3 px-3">
										<i class="fas fa-user-circle me-1"></i> Full Name
									</th>
									<th class="py-3 px-3">
										<i class="fas fa-at me-1"></i> Username
									</th>
									<th class="py-3 px-3">
										<i class="fas fa-user-tag me-1"></i> Role
									</th>
									<th class="text-center py-3 px-3" width="100">
										<i class="fas fa-cog me-1"></i> Actions
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$users = $conn->query("SELECT * FROM users ORDER BY name ASC");
									$i = 1;
									while($row = $users->fetch_assoc()):
										$roleClass = $row['type'] == 1 ? 'admin' : 'staff';
										$roleIcon = $row['type'] == 1 ? 'fa-crown' : 'fa-user';
										$roleText = $row['type'] == 1 ? 'Administrator' : 'Staff Member';
								?>
								<tr class="user-row">
									<td class="text-center fw-bold text-muted"><?php echo $i++ ?> </td>
									<td class="px-3">
										<div class="d-flex align-items-center gap-3">
											<div class="user-avatar rounded-circle d-flex align-items-center justify-content-center"
												 style="width: 42px; height: 42px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
												<i class="fas fa-user text-white"></i>
											</div>
											<div>
												<h6 class="mb-0 fw-semibold text-dark"><?php echo htmlspecialchars($row['name']) ?></h6>
												<small class="text-muted">ID: #<?php echo str_pad($row['id'], 4, '0', STR_PAD_LEFT) ?></small>
											</div>
										</div>
									</td>
									<td class="px-3">
										<span class="fw-medium"><?php echo htmlspecialchars($row['username']) ?></span>
									</td>
									<td class="px-3">
										<span class="badge <?php echo $roleClass == 'admin' ? 'bg-soft-primary' : 'bg-soft-secondary'; ?> rounded-pill px-3 py-2">
											<i class="fas <?php echo $roleIcon ?> me-1"></i> <?php echo $roleText ?>
										</span>
									</td>
									<td class="text-center">
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-sm btn-soft-primary rounded-start-pill edit_user" 
													data-id="<?php echo $row['id'] ?>"
													title="Edit User">
												<i class="fas fa-edit"></i>
											</button>
											<button type="button" class="btn btn-sm btn-soft-danger rounded-end-pill delete_user" 
													data-id="<?php echo $row['id'] ?>"
													data-name="<?php echo htmlspecialchars($row['name']) ?>"
													title="Delete User">
												<i class="fas fa-trash-alt"></i>
											</button>
										</div>
									</td>
								</tr>
								<?php endwhile; ?>
								<?php if($users->num_rows == 0): ?>
									<tr>
										<td colspan="5" class="text-center py-5">
											<i class="fas fa-users-slash fa-3x text-muted mb-3 d-block"></i>
											<p class="text-muted mb-0">No users found. Click "Add New User" to create one.</p>
										</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	/* ========== PREMIUM USER MANAGEMENT STYLES ========== */
	:root {
		--primary-gradient: linear-gradient(135deg, #ff6b35, #e85d2c);
		--primary-soft: rgba(255, 107, 53, 0.1);
		--secondary-soft: rgba(100, 116, 139, 0.1);
		--danger-soft: rgba(255, 118, 117, 0.1);
		--shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.08);
		--transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}
	
	/* Card Styling */
	.card {
		border: none;
		transition: var(--transition);
	}
	
	.card:hover {
		transform: translateY(-4px);
		box-shadow: 0 25px 45px rgba(0, 0, 0, 0.12) !important;
	}
	
	/* Button Styles */
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
	
	.btn-soft-primary {
		background: var(--primary-soft);
		color: #ff6b35;
		border: 1px solid rgba(255, 107, 53, 0.2);
		transition: var(--transition);
		padding: 6px 14px;
	}
	
	.btn-soft-primary:hover {
		background: #ff6b35;
		color: white;
		border-color: #ff6b35;
	}
	
	.btn-soft-danger {
		background: var(--danger-soft);
		color: #ff7675;
		border: 1px solid rgba(255, 118, 117, 0.2);
		transition: var(--transition);
		padding: 6px 14px;
	}
	
	.btn-soft-danger:hover {
		background: #ff7675;
		color: white;
		border-color: #ff7675;
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
	}
	
	.table td {
		vertical-align: middle;
		border-color: #f0f2f5;
	}
	
	.user-row {
		transition: var(--transition);
		animation: fadeSlideUp 0.3s ease-out;
		animation-fill-mode: both;
	}
	
	.user-row:hover {
		background: linear-gradient(90deg, rgba(255, 107, 53, 0.03), transparent);
	}
	
	/* Badge Styles */
	.bg-soft-primary {
		background: var(--primary-soft);
		color: #ff6b35;
	}
	
	.bg-soft-secondary {
		background: var(--secondary-soft);
		color: #64748b;
	}
	
	/* Animations */
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
	
	/* User Avatar Hover */
	.user-avatar {
		transition: var(--transition);
	}
	
	.user-row:hover .user-avatar {
		transform: scale(1.05);
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
	}
	
	/* Responsive */
	@media (max-width: 768px) {
		.btn-group .btn {
			padding: 5px 10px;
		}
		
		.user-avatar {
			width: 35px !important;
			height: 35px !important;
		}
		
		.table th, .table td {
			padding: 0.75rem;
		}
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
		border-color: #ff6b35;
		outline: none;
		box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
	}
	
	.dataTables_wrapper .dataTables_paginate .paginate_button.current {
		background: var(--primary-gradient);
		color: white !important;
		border: none;
		border-radius: 8px;
	}
	
	.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
		background: #ff6b35;
		color: white !important;
		border-radius: 8px;
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
</style>

<script>
	$(document).ready(function() {
		// Initialize DataTable with enhanced options
		$('#usersTable').DataTable({
			pageLength: 10,
			language: {
				search: "<i class='fas fa-search'></i> Search:",
				searchPlaceholder: "Search users...",
				lengthMenu: "Show _MENU_ entries",
				info: "Showing _START_ to _END_ of _TOTAL_ users",
				emptyTable: "No users found",
				zeroRecords: "No matching users found"
			},
			responsive: true,
			dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
				 '<"row"<"col-sm-12"tr>>' +
				 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
		});
		
		// New User Button
		$('#new_user').click(function() {
			uni_modal('Add New User', 'manage_user.php');
		});
		
		// Edit User Button
		$('.edit_user').click(function() {
			var userId = $(this).data('id');
			uni_modal('Edit User', 'manage_user.php?id=' + userId);
		});
		
		// Delete User Button with confirmation
		$('.delete_user').click(function() {
			var userId = $(this).data('id');
			var userName = $(this).data('name') || 'this user';
			_conf("Are you sure you want to delete <strong>'" + userName + "'</strong>? This action cannot be undone.", "delete_user", [userId]);
		});
		
		// Ripple effect for buttons
		$('.btn').on('click', function(e) {
			var x = e.clientX - $(this).offset().left;
			var y = e.clientY - $(this).offset().top;
			
			var ripple = $('<span class="ripple"></span>');
			ripple.css({
				left: x + 'px',
				top: y + 'px',
				width: '20px',
				height: '20px',
				position: 'absolute',
				borderRadius: '50%',
				background: 'rgba(255,255,255,0.5)',
				transform: 'scale(0)',
				animation: 'rippleEffect 0.6s linear',
				pointerEvents: 'none'
			});
			
			$(this).append(ripple);
			setTimeout(function() {
				ripple.remove();
			}, 600);
		});
	});
	
	// Delete user function (called from _conf)
	function delete_user(userId) {
		start_load();
		$.ajax({
			url: 'ajax.php?action=delete_user',
			method: 'POST',
			data: {id: userId},
			success: function(resp) {
				if(resp == 1) {
					alert_toast("User deleted successfully!", 'success');
					setTimeout(function() {
						location.reload();
					}, 1500);
				} else if(resp == 2) {
					alert_toast("Cannot delete the current logged-in user.", 'warning');
					end_load();
				} else {
					alert_toast("Failed to delete user. Please try again.", 'danger');
					end_load();
				}
			},
			error: function() {
				alert_toast("Connection error. Please try again.", 'danger');
				end_load();
			}
		});
	}
</script>

<style>
	/* Additional styles for better visual feedback */
	.user-row {
		cursor: default;
	}
	
	/* Hover effect on table rows */
	.user-row:hover td:first-child,
	.user-row:hover td:last-child {
		background: transparent;
	}
	
	/* Badge styling enhancement */
	.badge.rounded-pill {
		font-weight: 500;
		font-size: 0.75rem;
	}
	
	/* Action buttons group styling */
	.btn-group .btn:first-child {
		border-radius: 30px 0 0 30px !important;
	}
	
	.btn-group .btn:last-child {
		border-radius: 0 30px 30px 0 !important;
	}
	
	/* DataTables search box styling */
	.dataTables_filter label {
		display: flex;
		align-items: center;
		gap: 8px;
	}
	
	.dataTables_filter input {
		width: 250px;
	}
	
	@media (max-width: 576px) {
		.dataTables_filter input {
			width: 180px;
		}
	}
</style>