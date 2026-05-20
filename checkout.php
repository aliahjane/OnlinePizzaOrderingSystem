<?php
include 'admin/db_connect.php';
$chk = $conn->query("SELECT * FROM cart where user_id = {$_SESSION['login_user_id']} ")->num_rows;
if($chk <= 0){
    echo "<script>alert('You don\'t have an Item in your cart yet.'); location.replace('./')</script>";
}
?>

<!-- Enhanced Checkout Header -->
<header class="masthead checkout-header">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-center mb-4 page-title">
                <div class="checkout-badge">
                    <i class="fas fa-credit-card"></i> Secure Checkout
                </div>
                <h1 class="text-white">Checkout</h1>
                <div class="divider-wrapper">
                    <span class="divider-line"></span>
                    <i class="fas fa-shopping-bag divider-icon"></i>
                    <span class="divider-line"></span>
                </div>
                <p class="text-white-50 mt-3">Complete your order with delivery details</p>
            </div>
        </div>
    </div>
    <div class="header-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
            <path fill="#ffffff" fill-opacity="1" d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,42.7C672,32,768,32,864,48C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</header>

<!-- Enhanced Checkout Section -->
<section class="checkout-section">
    <div class="container">
        <div class="row g-4">
            <!-- Checkout Form Column -->
            <div class="col-lg-7">
                <div class="checkout-card">
                    <div class="checkout-card-header">
                        <div class="step-indicator">
                            <div class="step active">
                                <span class="step-number">1</span>
                                <span class="step-label">Delivery Info</span>
                            </div>
                            <div class="step-line"></div>
                            <div class="step">
                                <span class="step-number">2</span>
                                <span class="step-label">Payment</span>
                            </div>
                            <div class="step-line"></div>
                            <div class="step">
                                <span class="step-number">3</span>
                                <span class="step-label">Confirm</span>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-card-body">
                        <form action="" id="checkout-frm">
                            <h4 class="form-title">
                                <i class="fas fa-truck me-2"></i> Confirm Delivery Information
                            </h4>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-user"></i> First Name
                                        </label>
                                        <input type="text" name="first_name" required class="form-control" 
                                               value="<?php echo htmlspecialchars($_SESSION['login_first_name'] ?? '') ?>"
                                               placeholder="Enter first name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-user-friends"></i> Last Name
                                        </label>
                                        <input type="text" name="last_name" required class="form-control" 
                                               value="<?php echo htmlspecialchars($_SESSION['login_last_name'] ?? '') ?>"
                                               placeholder="Enter last name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-phone-alt"></i> Contact Number
                                        </label>
                                        <input type="tel" name="mobile" required class="form-control" 
                                               value="<?php echo htmlspecialchars($_SESSION['login_mobile'] ?? '') ?>"
                                               placeholder="+63 912 345 6789">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-envelope"></i> Email Address
                                        </label>
                                        <input type="email" name="email" required class="form-control" 
                                               value="<?php echo htmlspecialchars($_SESSION['login_email'] ?? '') ?>"
                                               placeholder="name@example.com">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt"></i> Delivery Address
                                        </label>
                                        <textarea cols="30" rows="3" name="address" required class="form-control" 
                                                  placeholder="Enter your complete delivery address"><?php echo htmlspecialchars($_SESSION['login_address'] ?? '') ?></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <a href="index.php?page=cart" class="btn-back">
                                    <i class="fas fa-arrow-left"></i> Back to Cart
                                </a>
                                <button type="submit" class="btn-place-order">
                                    <i class="fas fa-check-circle"></i> Place Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary Column -->
            <div class="col-lg-5">
                <div class="order-summary-card">
                    <div class="summary-header">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt me-2"></i> Order Summary
                        </h5>
                    </div>
                    <div class="summary-body">
                        <div id="order-items-preview">
                            <div class="text-center py-4">
                                <i class="fas fa-spinner fa-pulse"></i> Loading cart items...
                            </div>
                        </div>
                        <div class="summary-total">
                            <div class="total-row">
                                <span>Subtotal</span>
                                <span id="subtotal">₱ 0.00</span>
                            </div>
                            <div class="total-row">
                                <span>Delivery Fee</span>
                                <span>₱ 0.00</span>
                            </div>
                            <div class="total-row">
                                <span>Tax (0%)</span>
                                <span>₱ 0.00</span>
                            </div>
                            <div class="total-divider"></div>
                            <div class="total-row grand-total">
                                <span>Total Amount</span>
                                <span class="grand-total-value" id="cart-total">₱ 0.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="summary-footer">
                        <div class="secure-badge">
                            <i class="fas fa-lock"></i> Secure SSL Encryption
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* ========== PREMIUM CHECKOUT DESIGN ========== */
    :root {
        --primary: #ff6b35;
        --primary-dark: #e85d2c;
        --primary-light: #ff8a5c;
        --primary-glow: rgba(255, 107, 53, 0.25);
        --secondary: #667eea;
        --success: #00b894;
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
    .checkout-header {
        position: relative;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, var(--primary) 100%);
        background-size: 200% 200%;
        animation: gradientShift 15s ease infinite;
        height: 45vh !important;
        min-height: 320px;
        overflow: hidden;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .checkout-badge {
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

    .checkout-header h1 {
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
    .checkout-section {
        padding: 4rem 0;
        background: #f8f9fc;
    }

    /* Checkout Card */
    .checkout-card {
        background: white;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }

    .checkout-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .checkout-card-header {
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .step-indicator {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .step-number {
        width: 36px;
        height: 36px;
        background: #e2e8f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: var(--gray);
        transition: var(--transition);
    }

    .step.active .step-number {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        box-shadow: 0 4px 12px var(--primary-glow);
    }

    .step-label {
        font-size: 0.75rem;
        color: var(--gray);
    }

    .step.active .step-label {
        color: var(--primary);
        font-weight: 600;
    }

    .step-line {
        flex: 1;
        height: 2px;
        background: var(--border);
        margin: 0 10px;
    }

    .checkout-card-body {
        padding: 2rem;
    }

    .form-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--border);
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .form-label i {
        color: var(--primary);
        font-size: 0.85rem;
    }

    .form-control {
        width: 100%;
        border: 2px solid var(--border);
        border-radius: 16px;
        padding: 12px 16px;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-glow);
        outline: none;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }

    .btn-back {
        background: transparent;
        border: 2px solid var(--border);
        padding: 10px 24px;
        border-radius: 40px;
        color: var(--gray);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-back:hover {
        border-color: var(--primary);
        color: var(--primary);
    }

    .btn-place-order {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        padding: 10px 32px;
        border-radius: 40px;
        color: white;
        font-weight: 700;
        transition: var(--transition);
        cursor: pointer;
    }

    .btn-place-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px var(--primary-glow);
    }

    /* Order Summary Card */
    .order-summary-card {
        background: white;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        position: sticky;
        top: 100px;
    }

    .summary-header {
        background: linear-gradient(135deg, var(--dark), #2d3748);
        color: white;
        padding: 1.2rem 1.5rem;
    }

    .summary-body {
        padding: 1.5rem;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
    }

    .cart-item-info {
        flex: 1;
    }

    .cart-item-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--dark);
    }

    .cart-item-qty {
        font-size: 0.75rem;
        color: var(--gray);
    }

    .cart-item-price {
        font-weight: 600;
        color: var(--primary);
    }

    .summary-total {
        margin-top: 1rem;
        padding-top: 0.5rem;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.8rem;
        color: var(--gray);
        font-size: 0.9rem;
    }

    .total-divider {
        height: 1px;
        background: var(--border);
        margin: 1rem 0;
    }

    .grand-total {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
    }

    .grand-total-value {
        color: var(--primary);
        font-size: 1.3rem;
    }

    .summary-footer {
        padding: 1rem 1.5rem 1.5rem;
        border-top: 1px solid var(--border);
        text-align: center;
    }

    .secure-badge {
        font-size: 0.75rem;
        color: var(--gray);
    }

    .secure-badge i {
        color: var(--success);
        margin-right: 5px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .checkout-header h1 { font-size: 2rem; }
        .checkout-header { min-height: 280px; }
        .checkout-card-body { padding: 1.5rem; }
        .step-label { display: none; }
        .step-number { width: 30px; height: 30px; font-size: 0.8rem; }
        .btn-back, .btn-place-order { padding: 8px 20px; font-size: 0.85rem; }
        .order-summary-card { margin-top: 1rem; position: static; }
    }

    @media (max-width: 576px) {
        .checkout-header h1 { font-size: 1.6rem; }
        .form-actions { flex-direction: column; gap: 1rem; }
        .btn-back, .btn-place-order { width: 100%; text-align: center; }
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

    .checkout-card, .order-summary-card {
        animation: fadeSlideUp 0.4s ease-out;
    }
</style>

<script>
    $(document).ready(function(){
        // Load cart preview
        function loadCartPreview() {
            $.ajax({
                url: 'admin/ajax.php?action=get_cart_preview',
                method: 'GET',
                success: function(resp) {
                    try {
                        const data = JSON.parse(resp);
                        if(data.items && data.items.length > 0) {
                            let html = '';
                            data.items.forEach(item => {
                                html += `
                                    <div class="cart-item">
                                        <div class="cart-item-info">
                                            <div class="cart-item-name">${escapeHtml(item.name)}</div>
                                            <div class="cart-item-qty">Quantity: ${item.qty}</div>
                                        </div>
                                        <div class="cart-item-price">₱ ${parseFloat(item.subtotal).toFixed(2)}</div>
                                    </div>
                                `;
                            });
                            $('#order-items-preview').html(html);
                            $('#subtotal').text(`₱ ${parseFloat(data.total).toFixed(2)}`);
                            $('#cart-total').text(`₱ ${parseFloat(data.total).toFixed(2)}`);
                        } else {
                            $('#order-items-preview').html('<div class="text-center text-muted py-3"><i class="fas fa-shopping-cart"></i> Your cart is empty</div>');
                        }
                    } catch(e) {
                        console.error('Error parsing cart data');
                    }
                },
                error: function() {
                    $('#order-items-preview').html('<div class="text-center text-muted py-3">Unable to load cart</div>');
                }
            });
        }
        
        function escapeHtml(str) {
            return str.replace(/[&<>]/g, function(m) {
                if(m === '&') return '&amp;';
                if(m === '<') return '&lt;';
                if(m === '>') return '&gt;';
                return m;
            });
        }
        
        loadCartPreview();
        
        // Form submission
        $('#checkout-frm').submit(function(e){
            e.preventDefault();
            
            const $btn = $(this).find('button[type="submit"]');
            const originalHtml = $btn.html();
            $btn.html('<i class="fas fa-spinner fa-pulse"></i> Processing...').prop('disabled', true);
            
            let isValid = true;
            $(this).find('input[required], textarea[required]').each(function() {
                if(!$(this).val().trim()) {
                    $(this).addClass('is-invalid');
                    isValid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            if(!isValid) {
                alert_toast('Please fill in all required fields', 'warning');
                $btn.html(originalHtml).prop('disabled', false);
                return;
            }
            
            // Email validation
            const email = $('input[name="email"]').val();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(!emailRegex.test(email)) {
                alert_toast('Please enter a valid email address', 'warning');
                $btn.html(originalHtml).prop('disabled', false);
                return;
            }
            
            start_load();
            $.ajax({
                url: "admin/ajax.php?action=save_order",
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp){
                    end_load();
                    if(resp == 1){
                        alert_toast("Order successfully placed!", 'success');
                        setTimeout(function(){
                            location.replace('index.php?page=home');
                        }, 1500);
                    } else {
                        alert_toast("Failed to place order. Please try again.", 'danger');
                        $btn.html(originalHtml).prop('disabled', false);
                    }
                },
                error: function() {
                    end_load();
                    alert_toast("An error occurred. Please try again.", 'danger');
                    $btn.html(originalHtml).prop('disabled', false);
                }
            });
        });
        
        // Remove invalid class on input
        $('.form-control').on('input', function() {
            $(this).removeClass('is-invalid');
        });
    });
</script>