<!-- Masthead - Enhanced Shopping Cart Header -->
<header class="masthead cart-header">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-center mb-4 page-title">
                <div class="cart-badge">
                    <i class="fas fa-shopping-bag"></i> Your Cart
                </div>
                <h1 class="text-white">Shopping Cart</h1>
                <div class="divider-wrapper">
                    <span class="divider-line"></span>
                    <i class="fas fa-shopping-cart divider-icon"></i>
                    <span class="divider-line"></span>
                </div>
                <p class="text-white-50 mt-3">Review your items before checkout</p>
            </div>
        </div>
    </div>
    <div class="header-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
            <path fill="#ffffff" fill-opacity="1" d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,42.7C672,32,768,32,864,48C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</header>

<section class="page-section cart-section" id="cart">
    <div class="container">
        <div class="row g-4">
            <!-- Cart Items Column -->
            <div class="col-lg-8">
                <div class="sticky-header">
                    <div class="cart-header-card">
                        <div class="cart-header-content">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <i class="fas fa-box-open me-2 text-primary"></i>
                                    <b>Items in Your Cart</b>
                                </div>
                                <div class="col-md-3 text-center">
                                    <i class="fas fa-tag me-1 text-primary"></i>
                                    <b>Unit Price</b>
                                </div>
                                <div class="col-md-2 text-end">
                                    <i class="fas fa-calculator me-1 text-primary"></i>
                                    <b>Total</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php 
                if(isset($_SESSION['login_user_id'])){
                    $data = "where c.user_id = '".$_SESSION['login_user_id']."' ";    
                }else{
                    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
                    $data = "where c.client_ip = '".$ip."' ";    
                }
                $total = 0;
                $get = $conn->query("SELECT *,c.id as cid FROM cart c inner join product_list p on p.id = c.product_id ".$data);
                $cart_count = $get->num_rows;
                ?>

                <?php if($cart_count > 0): ?>
                    <?php while($row = $get->fetch_assoc()):
                        $total += ($row['qty'] * $row['price']);
                    ?>
                    <div class="cart-item-card" data-cart-id="<?php echo $row['cid'] ?>">
                        <div class="card-body p-3 p-md-4">
                            <div class="row align-items-center gy-3">
                                <!-- Product Image & Remove Button -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn-remove-cart rem_cart" data-id="<?php echo $row['cid'] ?>" title="Remove item">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <div class="product-image-wrapper">
                                            <img src="assets/img/<?php echo $row['img_path'] ?>" alt="<?php echo htmlspecialchars($row['name']) ?>" class="cart-product-img">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Product Details -->
                                <div class="col-md-4">
                                    <div class="product-details">
                                        <h6 class="product-name mb-1"><?php echo htmlspecialchars($row['name']) ?></h6>
                                        <p class="product-desc text-muted mb-2">
                                            <?php echo htmlspecialchars(substr($row['description'], 0, 80)) . (strlen($row['description']) > 80 ? '...' : '') ?>
                                        </p>
                                        <div class="product-price">
                                            <span class="price-label">Unit Price:</span>
                                            <span class="price-value">₱ <?php echo number_format($row['price'], 2) ?></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Quantity Controls & Total -->
                                <div class="col-md-4">
                                    <div class="d-flex flex-column align-items-end gap-2">
                                        <div class="quantity-control">
                                            <button class="qty-btn qty-minus" data-id="<?php echo $row['cid'] ?>">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" readonly value="<?php echo $row['qty'] ?>" min="1" class="qty-input text-center" name="qty">
                                            <button class="qty-btn qty-plus" data-id="<?php echo $row['cid'] ?>">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="item-total">
                                            <span class="total-label">Subtotal:</span>
                                            <span class="total-value">₱ <?php echo number_format($row['qty'] * $row['price'], 2) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <!-- Empty Cart State -->
                    <div class="empty-cart-card text-center py-5">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h5 class="mt-4 mb-2">Your cart is empty</h5>
                        <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet</p>
                        <a href="index.php?page=menu" class="btn btn-primary btn-continue">
                            <i class="fas fa-utensils me-2"></i> Browse Menu
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Order Summary Column -->
            <div class="col-md-4">
                <div class="sticky-summary">
                    <div class="summary-card">
                        <div class="summary-header">
                            <h5 class="mb-0">
                                <i class="fas fa-receipt me-2"></i> Order Summary
                            </h5>
                        </div>
                        <div class="summary-body">
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span id="subtotal">₱ <?php echo number_format($total, 2) ?></span>
                            </div>
                            <div class="summary-row">
                                <span>Delivery Fee</span>
                                <span>₱ 0.00</span>
                            </div>
                            <div class="summary-row">
                                <span>Tax (0%)</span>
                                <span>₱ 0.00</span>
                            </div>
                            <div class="summary-divider"></div>
                            <div class="summary-row total-row">
                                <span class="fw-bold fs-5">Total Amount</span>
                                <span class="fw-bold fs-4 text-primary" id="cart-total">₱ <?php echo number_format($total, 2) ?></span>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <button class="btn-checkout" type="button" id="checkout" <?php echo $cart_count == 0 ? 'disabled' : ''; ?>>
                                <i class="fas fa-credit-card me-2"></i> Proceed to Checkout
                            </button>
                            <a href="index.php?page=menu" class="btn-continue-shopping">
                                <i class="fas fa-arrow-left me-1"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* ========== PREMIUM CART PAGE DESIGN ========== */
    :root {
        --primary: #ff6b35;
        --primary-dark: #e85d2c;
        --primary-light: #ff8a5c;
        --primary-soft: rgba(255, 107, 53, 0.1);
        --secondary: #667eea;
        --dark: #1a1a2e;
        --light: #f8f9fa;
        --gray: #6c757d;
        --border: #e2e8f0;
        --shadow-sm: 0 5px 20px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.12);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Header Styling */
    .cart-header {
        position: relative;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, var(--primary) 100%);
        background-size: 200% 200%;
        animation: gradientShift 15s ease infinite;
        height: 45vh !important;
        min-height: 350px;
        overflow: hidden;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .cart-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        color: white;
        margin-bottom: 1rem;
    }

    .cart-header h1 {
        font-size: 3.5rem;
        font-weight: 800;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .divider-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin: 1rem 0;
    }

    .divider-line {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, transparent, white, transparent);
        border-radius: 3px;
    }

    .divider-icon {
        font-size: 1.5rem;
        color: white;
        opacity: 0.8;
    }

    .header-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        line-height: 0;
        z-index: 2;
    }

    /* Section Styling */
    .cart-section {
        padding: 3rem 0 5rem;
        background: #f8f9fc;
    }

    /* Sticky Header */
    .sticky-header {
        position: sticky;
        top: 80px;
        z-index: 15;
        margin-bottom: 1rem;
    }

    .cart-header-card {
        background: white;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
    }

    .cart-header-content {
        color: var(--dark);
        font-size: 0.9rem;
    }

    /* Cart Item Card */
    .cart-item-card {
        background: white;
        border-radius: 20px;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid rgba(0,0,0,0.03);
    }

    .cart-item-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-remove-cart {
        background: rgba(239, 68, 68, 0.1);
        border: none;
        color: #ef4444;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        cursor: pointer;
    }

    .btn-remove-cart:hover {
        background: #ef4444;
        color: white;
        transform: scale(1.05);
    }

    .product-image-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 16px;
        overflow: hidden;
        background: #f1f3f9;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .cart-item-card:hover .cart-product-img {
        transform: scale(1.05);
    }

    .product-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--dark);
    }

    .product-desc {
        font-size: 0.8rem;
        line-height: 1.4;
    }

    .product-price {
        display: flex;
        gap: 8px;
        font-size: 0.85rem;
    }

    .price-label {
        color: var(--gray);
    }

    .price-value {
        font-weight: 600;
        color: var(--primary);
    }

    /* Quantity Controls */
    .quantity-control {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #f1f3f9;
        border-radius: 40px;
        padding: 4px;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: white;
        color: var(--primary);
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
    }

    .qty-btn:hover {
        background: var(--primary);
        color: white;
        transform: scale(1.05);
    }

    .qty-input {
        width: 50px;
        border: none;
        text-align: center;
        font-weight: 600;
        background: transparent;
        font-size: 1rem;
    }

    .qty-input:focus {
        outline: none;
    }

    .item-total {
        text-align: right;
    }

    .total-label {
        font-size: 0.8rem;
        color: var(--gray);
    }

    .total-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary);
    }

    /* Summary Card */
    .sticky-summary {
        position: sticky;
        top: 100px;
    }

    .summary-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
    }

    .summary-header {
        background: linear-gradient(135deg, var(--dark), #2d3748);
        color: white;
        padding: 1.2rem 1.5rem;
    }

    .summary-body {
        padding: 1.5rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        color: var(--gray);
    }

    .summary-divider {
        height: 1px;
        background: var(--border);
        margin: 1rem 0;
    }

    .total-row {
        color: var(--dark);
        font-weight: 700;
    }

    .summary-footer {
        padding: 1rem 1.5rem 1.5rem;
        border-top: 1px solid var(--border);
    }

    .btn-checkout {
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
    }

    .btn-checkout:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
    }

    .btn-checkout:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .btn-continue-shopping {
        display: block;
        text-align: center;
        margin-top: 1rem;
        color: var(--gray);
        text-decoration: none;
        font-size: 0.85rem;
        transition: var(--transition);
    }

    .btn-continue-shopping:hover {
        color: var(--primary);
    }

    /* Empty Cart Styling */
    .empty-cart-card {
        background: white;
        border-radius: 24px;
        padding: 3rem;
        text-align: center;
        box-shadow: var(--shadow-md);
    }

    .empty-cart-icon {
        font-size: 5rem;
        color: #cbd5e1;
    }

    .btn-continue {
        background: var(--primary);
        color: white;
        padding: 12px 28px;
        border-radius: 40px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: var(--transition);
    }

    .btn-continue:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .cart-header h1 { font-size: 2rem; }
        .cart-header { min-height: 280px; }
        .product-image-wrapper { width: 60px; height: 60px; }
        .summary-card { margin-top: 1rem; }
        .sticky-header { top: 70px; }
    }

    @media (max-width: 576px) {
        .cart-header h1 { font-size: 1.6rem; }
        .cart-header-card .row > div { text-align: center; }
        .quantity-control { justify-content: center; }
        .item-total { text-align: center; margin-top: 10px; }
    }

    /* Animations */
    @keyframes fadeSlideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .cart-item-card {
        animation: fadeSlideUp 0.3s ease-out;
    }
</style>

<script>
    $('.view_prod').click(function(){
        uni_modal_right('Product','view_prod.php?id='+$(this).attr('data-id'))
    })
    
    $('.qty-minus').click(function(){
        var qty = parseInt($(this).parent().siblings('.qty-input').val());
        if(qty > 1) {
            update_qty(qty - 1, $(this).data('id'));
        }
    })
    
    $('.qty-plus').click(function(){
        var qty = parseInt($(this).parent().siblings('.qty-input').val());
        update_qty(qty + 1, $(this).data('id'));
    })
    
    function update_qty(qty, id){
        start_load()
        $.ajax({
            url: 'admin/ajax.php?action=update_cart_qty',
            method: "POST",
            data: {id: id, qty: qty},
            success: function(resp){
                if(resp == 1){
                    location.reload();
                }
                end_load()
            }
        })
    }
    
    $('.rem_cart').click(function(e){
        e.preventDefault();
        _conf("Are you sure you want to remove this item from your cart?", "remove_cart", [$(this).data('id')])
    })
    
    function remove_cart(id){
        start_load()
        $.ajax({
            url: 'admin/ajax.php?action=delete_cart',
            method: "POST",
            data: {id: id},
            success: function(resp){
                if(resp == 1){
                    alert_toast("Item removed from cart", 'success');
                    setTimeout(() => location.reload(), 1500);
                }
                end_load()
            }
        })
    }
    
    $('#checkout').click(function(){
        if($(this).prop('disabled')) return;
        if('<?php echo isset($_SESSION['login_user_id']) ?>' == 1){
            location.replace("index.php?page=checkout")
        } else {
            uni_modal("Login to Continue", "login.php?page=checkout")
        }
    })
</script>