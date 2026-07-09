<?php
include ('api_check.php');
include('db_connect.php');?>

<div class="container-fluid py-4">
	
	<div class="col-lg-12">
		<div class="row g-4">
			<!-- FORM Panel - Enhanced -->
			<div class="col-md-4">
				<form action="" id="manage-menu">
					<div class="card border-0 shadow-xl rounded-4 overflow-hidden">
						<div class="card-header bg-gradient-primary text-white border-0 py-3">
							<h5 class="mb-0 fw-bold"><i class="fas fa-utensils me-2"></i>Menu Form</h5>
						</div>
						<div class="card-body p-4">
							<input type="hidden" name="id">
							
							<div class="form-group mb-4">
								<label class="form-label fw-semibold mb-2">
									<i class="fas fa-tag text-primary me-1"></i> Menu Name
								</label>
								<input type="text" class="form-control form-control-lg rounded-3" name="name" placeholder="Enter menu name">
							</div>
							
							<div class="form-group mb-4">
								<label class="form-label fw-semibold mb-2">
									<i class="fas fa-align-left text-primary me-1"></i> Description
								</label>
								<textarea cols="30" rows="3" class="form-control rounded-3" name="description" placeholder="Describe the menu item..."></textarea>
							</div>
							
							<div class="form-group mb-4">
								<div class="custom-control custom-switch">
									<input type="checkbox" name="status" class="custom-control-input" id="availability" checked>
									<label class="custom-control-label fw-semibold" for="availability">
										<i class="fas fa-check-circle text-success me-1"></i> Available
									</label>
								</div>
							</div>
							
							<div class="form-group mb-4">
								<label class="form-label fw-semibold mb-2">
									<i class="fas fa-folder text-primary me-1"></i> Category
								</label>
								<select name="category_id" id="category_id" class="form-select form-select-lg rounded-3">
									<option value="" disabled selected>Select category</option>
									<?php
									$cat = $conn->query("SELECT * FROM category_list order by name asc ");
									while($row=$cat->fetch_assoc()):
									?>
									<option value="<?php echo $row['id'] ?>"><?php echo htmlspecialchars($row['name']) ?></option>
									<?php endwhile; ?>
								</select>
							</div>
							
							<div class="form-group mb-4">
								<label class="form-label fw-semibold mb-2">
									<i class="fas fa-dollar-sign text-primary me-1"></i> Price
								</label>
								<div class="input-group">
									<span class="input-group-text bg-transparent border-2 rounded-start-3">$</span>
									<input type="number" class="form-control form-control-lg rounded-end-3" name="price" step="0.01" placeholder="0.00">
								</div>
							</div>
							
							<div class="form-group mb-4">
								<label class="form-label fw-semibold mb-2">
									<i class="fas fa-image text-primary me-1"></i> Image
								</label>
								<input type="file" class="form-control rounded-3" name="img" accept="image/*" onchange="displayImg(this,$(this))">
								<small class="text-muted mt-1 d-block">Supported formats: JPG, PNG, GIF (Max 2MB)</small>
							</div>
							
							<div class="form-group text-center">
								<img src="<?php echo isset($image_path) ? '../assets/img/'.$cover_img : '' ?>" alt="Preview" id="cimg" class="img-thumbnail rounded-3" style="max-height: 120px;">
							</div>
						</div>
								
						<div class="card-footer bg-transparent border-0 pb-4 px-4">
							<div class="row g-2">
								<div class="col-md-12 d-flex gap-2">
									<button class="btn btn-gradient flex-fill py-2 rounded-3 fw-semibold">
										<i class="fas fa-save me-2"></i> Save Menu
									</button>
									<button class="btn btn-outline-secondary flex-fill py-2 rounded-3 fw-semibold" 
											type="button" onclick="$('#manage-menu').get(0).reset(); $('#cimg').attr('src', '');">
										<i class="fas fa-undo-alt me-2"></i> Reset
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- FORM Panel End -->

			<!-- Table Panel - Enhanced -->
			<div class="col-md-8">
				<div class="card border-0 shadow-xl rounded-4 overflow-hidden">
					<div class="card-header bg-white border-0 py-3 px-4">
						<div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
							<h5 class="mb-0 fw-bold text-dark">
								<i class="fas fa-pizza-slice text-primary me-2"></i>Menu Items
							</h5>
							<span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
								<i class="fas fa-database me-1"></i> 
								<?php 
									$count = $conn->query("SELECT COUNT(*) as cnt FROM product_list")->fetch_assoc()['cnt'];
									echo $count; 
								?> Items
							</span>
						</div>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table table-hover align-middle mb-0" id="menuTable">
								<thead class="bg-gradient-table">
									<tr>
										<th class="text-center py-3 px-3" width="60">#</th>
										<th class="text-center py-3 px-3" width="80">Image</th>
										<th class="py-3 px-3">Item Details</th>
										<th class="text-center py-3 px-3" width="120">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i = 1;
									$cats = $conn->query("SELECT p.*, c.name as cat FROM product_list p inner join category_list c on c.id = p.category_id order by p.id asc");
									while($row=$cats->fetch_assoc()):
									?>
									<tr class="menu-row">
										<td class="text-center fw-bold text-muted"><?php echo $i++ ?> </td>
										<td class="text-center">
											<div class="image-wrapper">
												<img src="<?php echo isset($row['img_path']) && $row['img_path'] ? '../assets/img/'.$row['img_path'] : 'https://placehold.co/400x400?text=No+Image' ?>" 
													 alt="<?php echo htmlspecialchars($row['name']) ?>" 
													 class="menu-img rounded-3">
											</div>
										</td>
										<td class="px-3">
											<div class="d-flex flex-column gap-1">
												<h6 class="mb-0 fw-bold text-dark"><?php echo htmlspecialchars($row['name']) ?></h6>
												<div class="d-flex flex-wrap gap-2 mb-1">
													<span class="badge bg-soft-primary rounded-pill">
														<i class="fas fa-folder me-1"></i> <?php echo htmlspecialchars($row['cat']) ?>
													</span>
													<span class="badge bg-soft-success rounded-pill">
														<i class="fas fa-dollar-sign me-1"></i> <?php echo number_format($row['price'],2) ?>
													</span>
													<span class="badge <?php echo $row['status'] == 1 ? 'bg-soft-success' : 'bg-soft-danger'; ?> rounded-pill">
														<i class="fas <?php echo $row['status'] == 1 ? 'fa-check-circle' : 'fa-times-circle'; ?> me-1"></i>
														<?php echo $row['status'] == 1 ? 'Available' : 'Unavailable'; ?>
													</span>
												</div>
												<p class="mb-0 text-muted small description-text">
													<?php echo nl2br(htmlspecialchars(substr($row['description'], 0, 100))) ?>
													<?php echo strlen($row['description']) > 100 ? '...' : ''; ?>
												</p>
											</div>
										</td>
										<td class="text-center">
											<div class="btn-group gap-2" role="group">
												<button class="btn btn-sm btn-soft-primary rounded-pill px-3 edit_menu" 
														type="button" 
														data-id="<?php echo $row['id'] ?>" 
														data-name="<?php echo htmlspecialchars($row['name']) ?>" 
														data-status="<?php echo $row['status'] ?>" 
														data-description="<?php echo htmlspecialchars($row['description']) ?>" 
														data-price="<?php echo $row['price'] ?>" 
														data-category_id="<?php echo $row['category_id'] ?>" 
														data-img_path="<?php echo $row['img_path'] ?>">
													<i class="fas fa-edit me-1"></i> Edit
												</button>
												<button class="btn btn-sm btn-soft-danger rounded-pill px-3 delete_menu" 
														type="button" 
														data-id="<?php echo $row['id'] ?>"
														data-name="<?php echo htmlspecialchars($row['name']) ?>">
													<i class="fas fa-trash-alt me-1"></i> Delete
												</button>
											</div>
										</td>
									</tr>
									<?php endwhile; ?>
									<?php if($cats->num_rows == 0): ?>
									<tr>
										<td colspan="4" class="text-center py-5">
											<i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
											<p class="text-muted mb-0">No menu items found. Create your first menu item!</p>
										</td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- Table Panel End -->
		</div>
	</div>	

</div>

<style>
	/* ========== ENHANCED STYLES ========== */
	:root {
		--primary-gradient: linear-gradient(135deg, #ff6b35, #e85d2c);
		--primary-light: #ff8a5c;
		--primary-soft: rgba(255, 107, 53, 0.1);
		--success-soft: rgba(0, 184, 148, 0.1);
		--danger-soft: rgba(255, 118, 117, 0.1);
		--shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.08);
	}

	.bg-gradient-primary {
		background: var(--primary-gradient);
	}
	
	.bg-gradient-table {
		background: linear-gradient(135deg, #f8f9fc 0%, #f1f3f9 100%);
		border-bottom: 2px solid #e2e8f0;
	}
	
	.btn-gradient {
		background: var(--primary-gradient);
		color: white;
		border: none;
		transition: all 0.3s ease;
		box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
	}
	
	.btn-gradient:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
		color: white;
	}
	
	.btn-soft-primary {
		background: var(--primary-soft);
		color: #ff6b35;
		border: 1px solid rgba(255, 107, 53, 0.2);
		transition: all 0.3s ease;
	}
	
	.btn-soft-primary:hover {
		background: #ff6b35;
		color: white;
		border-color: #ff6b35;
		transform: translateY(-1px);
	}
	
	.btn-soft-danger {
		background: var(--danger-soft);
		color: #ff7675;
		border: 1px solid rgba(255, 118, 117, 0.2);
		transition: all 0.3s ease;
	}
	
	.btn-soft-danger:hover {
		background: #ff7675;
		color: white;
		border-color: #ff7675;
		transform: translateY(-1px);
	}
	
	.btn-outline-secondary {
		border: 2px solid #e2e8f0;
		color: #64748b;
		transition: all 0.3s ease;
	}
	
	.btn-outline-secondary:hover {
		border-color: #ff6b35;
		color: #ff6b35;
		background: rgba(255, 107, 53, 0.05);
	}
	
	.form-control, .form-select {
		border: 2px solid #e2e8f0;
		transition: all 0.3s ease;
	}
	
	.form-control:focus, .form-select:focus {
		border-color: #ff6b35;
		box-shadow: 0 0 0 4px rgba(255, 107, 53, 0.1);
	}
	
	.menu-img {
		width: 60px;
		height: 60px;
		object-fit: cover;
		border-radius: 12px;
		transition: all 0.3s ease;
		cursor: pointer;
	}
	
	.menu-img:hover {
		transform: scale(1.05);
		box-shadow: 0 4px 12px rgba(0,0,0,0.15);
	}
	
	.menu-row {
		transition: all 0.2s ease;
	}
	
	.menu-row:hover {
		background: linear-gradient(90deg, rgba(255, 107, 53, 0.03), transparent);
	}
	
	.bg-soft-primary {
		background: var(--primary-soft);
		color: #ff6b35;
	}
	
	.bg-soft-success {
		background: var(--success-soft);
		color: #00b894;
	}
	
	.bg-soft-danger {
		background: var(--danger-soft);
		color: #ff7675;
	}
	
	.description-text {
		font-size: 0.85rem;
		line-height: 1.4;
	}
	
	.image-wrapper {
		display: inline-block;
	}
	
	/* Custom switch styling */
	.custom-switch .custom-control-label::before {
		border-radius: 20px;
		width: 50px;
		height: 24px;
		background-color: #e2e8f0;
		border: none;
	}
	
	.custom-switch .custom-control-label::after {
		width: 20px;
		height: 20px;
		border-radius: 50%;
		background-color: white;
		top: calc(0.25rem + 2px);
		left: calc(-2.25rem + 2px);
	}
	
	.custom-switch .custom-control-input:checked ~ .custom-control-label::before {
		background: var(--primary-gradient);
	}
	
	/* Animations */
	@keyframes fadeInUp {
		from {
			opacity: 0;
			transform: translateY(20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}
	
	.card, .menu-row {
		animation: fadeInUp 0.4s ease-out;
	}
	
	/* Responsive */
	@media (max-width: 768px) {
		.btn-group {
			flex-direction: column;
			gap: 8px;
		}
		.btn-group .btn {
			width: 100%;
		}
		.menu-img {
			width: 45px;
			height: 45px;
		}
	}
	
	/* DataTables customization */
	.dataTables_wrapper .dataTables_length, 
	.dataTables_wrapper .dataTables_filter {
		margin: 1rem;
	}
	
	.dataTables_wrapper .dataTables_paginate .paginate_button.current {
		background: var(--primary-gradient);
		color: white !important;
		border: none;
		border-radius: 8px;
	}
</style>

<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#cimg').attr('src', e.target.result).show();
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$('#manage-menu').submit(function(e){
		e.preventDefault()
		
		// Validate form
		let isValid = true;
		$(this).find('input[name="name"], select[name="category_id"], input[name="price"]').each(function() {
			if(!$(this).val()) {
				$(this).addClass('is-invalid');
				isValid = false;
			} else {
				$(this).removeClass('is-invalid');
			}
		});
		
		if(!isValid) {
			alert_toast("Please fill in all required fields", 'warning');
			return;
		}
		
		start_load()
		$.ajax({
			url: 'ajax.php?action=save_menu',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp){
				if(resp == 1){
					alert_toast("Menu item added successfully!", 'success')
					setTimeout(function(){
						location.reload()
					}, 1500)
				}
				else if(resp == 2){
					alert_toast("Menu item updated successfully!", 'success')
					setTimeout(function(){
						location.reload()
					}, 1500)
				} else {
					alert_toast("An error occurred. Please try again.", 'danger')
					end_load()
				}
			},
			error: function() {
				alert_toast("Connection error. Please try again.", 'danger')
				end_load()
			}
		})
	})
	
	$('.edit_menu').click(function(){
		start_load()
		var cat = $('#manage-menu')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		cat.find("[name='category_id']").val($(this).attr('data-category_id'))
		
		if($(this).attr('data-status') == 1)
			$('#availability').prop('checked', true)
		else
			$('#availability').prop('checked', false)
		
		var imgPath = $(this).attr('data-img_path');
		if(imgPath && imgPath != '') {
			cat.find("#cimg").attr('src', '../assets/img/' + imgPath)
		} else {
			cat.find("#cimg").attr('src', '')
		}
		end_load()
	})
	
	$('.delete_menu').click(function(){
		var menuName = $(this).data('name') || 'this menu item';
		_conf("Are you sure you want to delete <strong>'" + menuName + "'</strong>? This action cannot be undone.", "delete_menu", [$(this).attr('data-id')])
	})
	
	function delete_menu($id){
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_menu',
			method: 'POST',
			data: {id: $id},
			success: function(resp){
				if(resp == 1){
					alert_toast("Menu item deleted successfully!", 'success')
					setTimeout(function(){
						location.reload()
					}, 1500)
				} else {
					alert_toast("Failed to delete menu item.", 'danger')
					end_load()
				}
			},
			error: function() {
				alert_toast("Connection error.", 'danger')
				end_load()
			}
		})
	}
	
	$('#menuTable').DataTable({
		pageLength: 10,
		language: {
			search: "<i class='fas fa-search'></i> Search:",
			lengthMenu: "Show _MENU_ entries",
			info: "Showing _START_ to _END_ of _TOTAL_ items",
			emptyTable: "No menu items available"
		},
		responsive: true
	})
	
	// Remove invalid class on input
	$('.form-control, .form-select').on('input change', function() {
		$(this).removeClass('is-invalid');
	})
</script>