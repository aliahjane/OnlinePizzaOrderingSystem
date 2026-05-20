<?php 
  include 'admin/db_connect.php';
  $qry = $conn->query("SELECT * FROM product_list WHERE id = ".$_GET['id'])->fetch_array();
?>
<div class="container-fluid p-3">
    <div class="product-modal-card">
        <div class="row g-0">
            <!-- Product Image Column -->
            <div class="col-md-5">
                <div class="product-image-wrapper">
                    <img src="assets/img/<?php echo htmlspecialchars($qry['img_path']) ?>" alt="<?php echo htmlspecialchars($qry['name']) ?>" class="product-image">
                    <div class="image-badge">
                        <i class="fas fa-fire"></i> Popular
                    </div>
                </div>
            </div>
            
            <!-- Product Details Column -->
            <div class="col-md-7">
                <div class="product-details">
                    <div class="product-header">
                        <h3 class="product-title"><?php echo htmlspecialchars($qry['name']) ?></h3>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>(4.5)</span>
                        </div>
                    </div>
                    
                    <div class="product-price-section">
                        <span class="price-label">Price</span>
                        <span class="product-price">₱ <?php echo number_format($qry['price'], 2) ?></span>
                    </div>
                    
                    <div class="product-description">
                        <span class="desc-label">Description</span>
                        <p class="desc-text"><?php echo nl2br(htmlspecialchars($qry['description'])) ?></p>
                    </div>
                    
                    <div class="product-meta">
                        <div class="meta-item">
                            <i class="fas fa-tag"></i>
                            <span>Fresh Ingredients</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span>Ready in 20-30 min</span>
                        </div>
                    </div>
                    
                    <div class="quantity-section">
                        <div class="quantity-label">
                            <i class="fas fa-shopping-cart"></i> Select Quantity
                        </div>
                        <div class="quantity-control">
                            <button class="qty-btn qty-minus" type="button" id="qty-minus">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" readonly value="1" min="1" class="qty-input" name="qty">
                            <button class="qty-btn qty-plus" type="button" id="qty-plus">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="total-price-section">
                        <span>Total Amount:</span>
                        <span class="total-price" id="total-price">₱ <?php echo number_format($qry['price'], 2) ?></span>
                    </div>
                    
                    <button class="btn-add-to-cart" id="add_to_cart_modal">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ========== PREMIUM PRODUCT MODAL DESIGN ========== */
    :root {
        --primary: #ff6b35;
        --primary-dark: #e85d2c;
        --primary-light: #ff8a5c;
        --primary-glow: rgba(255, 107, 53, 0.25);
        --success: #00b894;
        --dark: #1a1a2e;
        --gray: #6c757d;
        --gray-light: #e2e8f0;
        --shadow-sm: 0 5px 20px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    #uni_modal_right .modal-footer {
        display: none !important;
    }
    
    #uni_modal_right .modal-body {
        padding: 0 !important;
    }
    
    #uni_modal_right .modal-content {
        border-radius: 28px;
        overflow: hidden;
        max-width: 900px;
        margin: 0 auto;
    }
    
    .product-modal-card {
        background: white;
        overflow: hidden;
    }
    
    /* Product Image Section */
    .product-image-wrapper {
        position: relative;
        height: 100%;
        min-height: 350px;
        background: linear-gradient(135deg, #f8f9fc, #f1f3f9);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }
    
    .product-image:hover {
        transform: scale(1.05);
    }
    
    .image-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: var(--shadow-sm);
    }
    
    /* Product Details Section */
    .product-details {
        padding: 1.8rem;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .product-header {
        margin-bottom: 1rem;
    }
    
    .product-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }
    
    .product-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #fdcb6e;
        font-size: 0.85rem;
    }
    
    .product-rating span {
        color: var(--gray);
        margin-left: 5px;
    }
    
    /* Price Section */
    .product-price-section {
        background: linear-gradient(135deg, #fff9f5, #fff5f0);
        padding: 0.8rem 1rem;
        border-radius: 16px;
        margin-bottom: 1rem;
        display: flex;
        align-items: baseline;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .price-label {
        font-size: 0.8rem;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .product-price {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary);
    }
    
    /* Description Section */
    .product-description {
        margin-bottom: 1rem;
    }
    
    .desc-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--dark);
        display: block;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .desc-text {
        font-size: 0.9rem;
        color: var(--gray);
        line-height: 1.6;
        margin-bottom: 0;
    }
    
    /* Product Meta */
    .product-meta {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.2rem;
        padding: 0.5rem 0;
        border-top: 1px solid var(--gray-light);
        border-bottom: 1px solid var(--gray-light);
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        color: var(--gray);
    }
    
    .meta-item i {
        color: var(--primary);
        font-size: 0.9rem;
    }
    
    /* Quantity Section */
    .quantity-section {
        margin-bottom: 1rem;
    }
    
    .quantity-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .quantity-label i {
        color: var(--primary);
    }
    
    .quantity-control {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .qty-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid var(--gray-light);
        background: white;
        color: var(--primary);
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .qty-btn:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        transform: scale(1.05);
    }
    
    .qty-input {
        width: 60px;
        height: 40px;
        text-align: center;
        border: 2px solid var(--gray-light);
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        background: white;
    }
    
    .qty-input:focus {
        outline: none;
        border-color: var(--primary);
    }
    
    /* Total Price Section */
    .total-price-section {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        padding: 0.8rem 0;
        margin-bottom: 1rem;
        border-top: 1px solid var(--gray-light);
        font-weight: 600;
        color: var(--dark);
    }
    
    .total-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--primary);
    }
    
    /* Add to Cart Button */
    .btn-add-to-cart {
        width: 100%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        padding: 14px;
        border-radius: 40px;
        color: white;
        font-weight: 700;
        font-size: 1rem;
        transition: var(--transition);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: auto;
    }
    
    .btn-add-to-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px var(--primary-glow);
    }
    
    .btn-add-to-cart:active {
        transform: translateY(0);
    }
    
    .btn-add-to-cart:disabled {
        opacity: 0.7;
        transform: none;
        cursor: not-allowed;
    }
    
    /* Loading state */
    .btn-add-to-cart.loading {
        pointer-events: none;
    }
    
    .btn-add-to-cart.loading i {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .product-image-wrapper {
            min-height: 250px;
        }
        
        .product-title {
            font-size: 1.3rem;
        }
        
        .product-price {
            font-size: 1.4rem;
        }
        
        .product-details {
            padding: 1.2rem;
        }
        
        .qty-btn {
            width: 35px;
            height: 35px;
        }
        
        .qty-input {
            width: 50px;
            height: 35px;
        }
        
        .total-price {
            font-size: 1.2rem;
        }
    }
    
    @media (max-width: 576px) {
        .product-title {
            font-size: 1.2rem;
        }
        
        .product-price {
            font-size: 1.2rem;
        }
        
        .product-meta {
            gap: 0.8rem;
        }
        
        .meta-item {
            font-size: 0.7rem;
        }
    }
    
    /* Add to cart success animation */
    @keyframes addToCartPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); background: var(--success); }
        100% { transform: scale(1); }
    }
    
    .btn-add-to-cart.success {
        animation: addToCartPulse 0.5s ease;
    }
</style>

<script>
    // Calculate and update total price
    function updateTotalPrice() {
        const qty = parseInt($('input[name="qty"]').val()) || 1;
        const unitPrice = <?php echo $qry['price']; ?>;
        const total = qty * unitPrice;
        $('#total-price').text('₱ ' + total.toFixed(2));
    }
    
    // Quantity minus button
    $('#qty-minus').click(function() {
        let qty = parseInt($('input[name="qty"]').val());
        if (qty > 1) {
            $('input[name="qty"]').val(qty - 1);
            updateTotalPrice();
        }
        // Add haptic feedback
        $(this).addClass('active');
        setTimeout(() => $(this).removeClass('active'), 150);
    });
    
    // Quantity plus button
    $('#qty-plus').click(function() {
        let qty = parseInt($('input[name="qty"]').val());
        $('input[name="qty"]').val(qty + 1);
        updateTotalPrice();
        // Add haptic feedback
        $(this).addClass('active');
        setTimeout(() => $(this).removeClass('active'), 150);
    });
    
    // Manual input change
    $('input[name="qty"]').on('change', function() {
        let qty = parseInt($(this).val());
        if (isNaN(qty) || qty < 1) {
            qty = 1;
            $(this).val(1);
        }
        updateTotalPrice();
    });
    
    // Add to cart button
    $('#add_to_cart_modal').click(function() {
        const $btn = $(this);
        const originalHtml = $btn.html();
        const qty = parseInt($('input[name="qty"]').val()) || 1;
        
        $btn.html('<i class="fas fa-spinner fa-pulse"></i> Adding...').prop('disabled', true).addClass('loading');
        
        $.ajax({
            url: 'admin/ajax.php?action=add_to_cart',
            method: 'POST',
            data: {
                pid: '<?php echo $_GET['id'] ?>',
                qty: qty
            },
            success: function(resp) {
                if (resp == 1) {
                    // Update cart count
                    const currentCount = parseInt($('.item_count').html()) || 0;
                    $('.item_count').html(currentCount + qty);
                    
                    // Success animation
                    $btn.html('<i class="fas fa-check-circle"></i> Added to Cart!').addClass('success');
                    
                    // Show success toast
                    alert_toast("Item successfully added to cart!", 'success');
                    
                    // Close modal after delay
                    setTimeout(function() {
                        $('#uni_modal_right').modal('hide');
                        end_load();
                    }, 800);
                } else {
                    $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
                    alert_toast("Failed to add item to cart. Please try again.", 'danger');
                    end_load();
                }
            },
            error: function() {
                $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
                alert_toast("Connection error. Please try again.", 'danger');
                end_load();
            }
        });
    });
    
    // Initialize total price on load
    $(document).ready(function() {
        updateTotalPrice();
        
        // Add keyboard support for quantity
        $('input[name="qty"]').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                updateTotalPrice();
            }
        });
        
        // Close modal on escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $('#uni_modal_right').is(':visible')) {
                $('#uni_modal_right').modal('hide');
            }
        });
    });
</script>