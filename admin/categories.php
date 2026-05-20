<?php include('db_connect.php');?>

<div class="container-fluid py-4">
	
	<div class="col-lg-12">
		<div class="row g-4">
			<!-- FORM Panel - Enhanced -->
			<div class="col-md-4">
				<form action="" id="manage-category">
					<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
						<div class="card-header bg-gradient-primary text-white border-0 py-3">
							<h5 class="mb-0 fw-bold"><i class="fas fa-tag me-2"></i>Category Form</h5>
						</div>
						<div class="card-body p-4">
							<input type="hidden" name="id">
							<div class="form-group mb-4">
								<label class="form-label fw-semibold text-dark mb-2">
									<i class="fas fa-pencil-alt text-primary me-1"></i> Category Name
								</label>
								<input type="text" class="form-control form-control-lg rounded-3 border-2" 
									   name="name" placeholder="Enter category name..." 
									   style="border-color: #e2e8f0; transition: all 0.3s;">
								<small class="text-muted mt-1 d-block">Example: Appetizers, Main Course, Desserts</small>
							</div>
						</div>
								
						<div class="card-footer bg-transparent border-0 pb-4 px-4">
							<div class="row g-2">
								<div class="col-md-12 d-flex gap-2">
									<button class="btn btn-gradient flex-fill py-2 rounded-3 fw-semibold">
										<i class="fas fa-save me-2"></i> Save Category
									</button>
									<button class="btn btn-outline-secondary flex-fill py-2 rounded-3 fw-semibold" 
											type="button" onclick="$('#manage-category').get(0).reset()">
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
				<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
					<div class="card-header bg-white border-0 py-3 px-4">
						<div class="d-flex justify-content-between align-items-center">
							<h5 class="mb-0 fw-bold text-dark">
								<i class="fas fa-list-ul text-primary me-2"></i>Categories List
							</h5>
							<span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
								<i class="fas fa-database me-1"></i> <?php 
									$count = $conn->query("SELECT COUNT(*) as cnt FROM category_list")->fetch_assoc()['cnt'];
									echo $count; 
								?> Categories
							</span>
						</div>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table table-hover align-middle mb-0" id="categoryTable">
								<thead class="bg-gradient-table">
									<tr>
										<th class="text-center py-3 px-4" width="80">#</th>
										<th class="py-3 px-4">Category Name</th>
										<th class="text-center py-3 px-4" width="150">Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$i = 1;
									$cats = $conn->query("SELECT * FROM category_list order by id asc");
									while($row=$cats->fetch_assoc()):
									?>
									<tr class="category-row">
										<td class="text-center fw-bold text-muted"><?php echo $i++ ?></td>
										<td class="px-4">
											<div class="d-flex align-items-center gap-3">
												<div class="category-icon rounded-circle bg-light d-flex align-items-center justify-content-center" 
													 style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
													<i class="fas fa-folder-open text-white"></i>
												</div>
												<span class="fw-semibold text-dark fs-6"><?php echo htmlspecialchars($row['name']) ?></span>
											</div>
										</td>
										<td class="text-center">
											<div class="btn-group gap-2" role="group">
												<button class="btn btn-sm btn-soft-primary edit_cat rounded-pill px-3" 
														type="button" 
														data-id="<?php echo $row['id'] ?>" 
														data-name="<?php echo htmlspecialchars($row['name']) ?>">
													<i class="fas fa-edit me-1"></i> Edit
												</button>
												<button class="btn btn-sm btn-soft-danger delete_cat rounded-pill px-3" 
														type="button" 
														data-id="<?php echo $row['id'] ?>">
													<i class="fas fa-trash-alt me-1"></i> Delete
												</button>
											</div>
										</td>
									</tr>
									<?php endwhile; ?>
									<?php if($cats->num_rows == 0): ?>
									<tr>
										<td colspan="3" class="text-center py-5">
											<i class="fas fa-box-open fa-3x text-muted mb-3 d-block"></i>
											<p class="text-muted mb-0">No categories found. Create your first category!</p>
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
	/* Enhanced Styling */
	:root {
		--primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		--primary-light: #8b5cf6;
		--success: #10b981;
		--danger: #ef4444;
		--warning: #f59e0b;
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
		box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
	}
	
	.btn-gradient:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
		color: white;
	}
	
	.btn-soft-primary {
		background: rgba(102, 126, 234, 0.1);
		color: #667eea;
		border: 1px solid rgba(102, 126, 234, 0.2);
		transition: all 0.3s ease;
	}
	
	.btn-soft-primary:hover {
		background: #667eea;
		color: white;
		border-color: #667eea;
		transform: translateY(-1px);
	}
	
	.btn-soft-danger {
		background: rgba(239, 68, 68, 0.1);
		color: #ef4444;
		border: 1px solid rgba(239, 68, 68, 0.2);
		transition: all 0.3s ease;
	}
	
	.btn-soft-danger:hover {
		background: #ef4444;
		color: white;
		border-color: #ef4444;
		transform: translateY(-1px);
	}
	
	.btn-outline-secondary {
		border: 2px solid #e2e8f0;
		color: #64748b;
		transition: all 0.3s ease;
	}
	
	.btn-outline-secondary:hover {
		border-color: #667eea;
		color: #667eea;
		background: rgba(102, 126, 234, 0.05);
	}
	
	.form-control-lg {
		font-size: 1rem;
		padding: 12px 16px;
		border: 2px solid #e2e8f0;
		transition: all 0.3s ease;
	}
	
	.form-control-lg:focus {
		border-color: #667eea;
		box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
	}
	
	.category-row {
		transition: all 0.2s ease;
	}
	
	.category-row:hover {
		background: linear-gradient(90deg, rgba(102, 126, 234, 0.05), transparent);
		transform: scale(1.01);
	}
	
	.card {
		transition: transform 0.3s ease, box-shadow 0.3s ease;
	}
	
	.card:hover {
		transform: translateY(-4px);
		box-shadow: 0 20px 35px -12px rgba(0,0,0,0.15) !important;
	}
	
	/* Table styling enhancements */
	.table th, .table td {
		vertical-align: middle;
		padding: 1rem 0.75rem;
	}
	
	.table tbody tr {
		border-bottom: 1px solid #f0f2f5;
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
	
	.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
		background: #667eea;
		color: white !important;
		border-radius: 8px;
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
	
	.card, .category-row {
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
		
		.category-icon {
			width: 32px !important;
			height: 32px !important;
		}
		
		.table th, .table td {
			padding: 0.75rem;
		}
	}
	
	/* Custom scrollbar */
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
</style>

<script>
	$(document).ready(function() {
		// Initialize DataTable with enhanced options
		$('#categoryTable').DataTable({
			language: {
				search: "<i class='fas fa-search'></i> Search:",
				searchPlaceholder: "Search categories...",
				lengthMenu: "Show _MENU_ entries",
				info: "Showing _START_ to _END_ of _TOTAL_ categories",
				emptyTable: "No categories available",
				zeroRecords: "No matching categories found"
			},
			pageLength: 10,
			responsive: true,
			dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
				 '<"row"<"col-sm-12"tr>>' +
				 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
		});
	});
	
	$('#manage-category').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_category',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Category added successfully!",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
				else if(resp==2){
					alert_toast("Category updated successfully!",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
				else if(resp==3){
					alert_toast("Category name already exists!",'warning')
					end_load()
				}
			},
			error: function() {
				alert_toast("An error occurred. Please try again.",'danger')
				end_load()
			}
		})
	})
	
	$('.edit_cat').click(function(){
		start_load()
		var cat = $('#manage-category')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		// Add visual feedback
		cat.find("[name='name']").focus()
		end_load()
	})
	
	$('.delete_cat').click(function(){
		var catName = $(this).closest('tr').find('td:eq(1) .fw-semibold').text()
		_conf("Are you sure you want to delete category <strong>'" + catName + "'</strong>? This action cannot be undone.", "delete_cat", [$(this).attr('data-id')])
	})
	
	function delete_cat($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_category',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Category deleted successfully!",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
				else {
					alert_toast("Failed to delete category. It may have associated items.",'danger')
					end_load()
				}
			},
			error: function() {
				alert_toast("An error occurred while deleting.",'danger')
				end_load()
			}
		})
	}
	
	// Form input enhancement - clear on success
	$('#manage-category input[name="name"]').on('keypress', function(e) {
		if(e.which === 13) {
			e.preventDefault();
			$('#manage-category').submit();
		}
	})
	
	// Live search highlight (optional)
	$('#categoryTable_filter input').on('keyup', function() {
		var searchTerm = $(this).val().toLowerCase();
		$('#categoryTable tbody tr').each(function() {
			var text = $(this).find('td:eq(1)').text().toLowerCase();
			if(text.indexOf(searchTerm) > -1) {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	});
</script>