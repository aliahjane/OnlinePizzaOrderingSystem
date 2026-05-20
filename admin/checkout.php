<!DOCTYPE html>
<style>
  /* ========== PREMIUM CHECKOUT DESIGN ========== */
  :root {
    --primary: #ff6b35;
    --primary-dark: #e85d2c;
    --primary-light: #ff8a5c;
    --primary-glow: rgba(255, 107, 53, 0.25);
    --secondary: #2d3436;
    --success: #00b894;
    --danger: #ff7675;
    --warning: #fdcb6e;
    --dark: #2d3436;
    --light: #f8f9fa;
    --gray: #dfe6e9;
    --shadow-sm: 0 10px 30px -10px rgba(0, 0, 0, 0.08);
    --shadow-md: 0 20px 40px -15px rgba(0, 0, 0, 0.12);
    --shadow-lg: 0 30px 50px -20px rgba(0, 0, 0, 0.15);
    --transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
  }

  /* Hero Section Enhancement */
  header.masthead {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    height: 40vh !important;
    min-height: 320px;
    overflow: hidden;
  }

  header.masthead::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" fill-opacity="0.3" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>') repeat-x bottom;
    background-size: cover;
    pointer-events: none;
  }

  header.masthead .page-title h3 {
    font-size: 3.5rem;
    font-weight: 800;
    text-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    animation: fadeInDown 0.8s ease-out;
  }

  header.masthead .divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), #fff);
    border: none;
    border-radius: 4px;
    margin: 1rem auto;
    animation: fadeInUp 0.8s ease-out;
  }

  @keyframes fadeInDown {
    from {
      opacity: 0;
      transform: translateY(-30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Card Enhancement */
  .card {
    border: none;
    border-radius: 28px;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    transition: var(--transition);
    margin-top: -60px;
    background: white;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 35px 55px -20px rgba(0, 0, 0, 0.2);
  }

  .card-body {
    padding: 2rem 2rem;
  }

  /* Form Title */
  .card-body h4 {
    font-size: 1.8rem;
    font-weight: 700;
    background: linear-gradient(135deg, var(--dark), var(--primary));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    margin-bottom: 1.8rem;
    padding-bottom: 0.8rem;
    border-bottom: 3px solid var(--primary);
    display: inline-block;
  }

  /* Form Groups */
  .form-group {
    margin-bottom: 1.5rem;
  }

  .form-group label {
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
  }

  .form-group label i {
    color: var(--primary);
    font-size: 1rem;
  }

  .form-control {
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    padding: 12px 16px;
    font-size: 0.95rem;
    transition: var(--transition);
    background: #fefefe;
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

  /* Button Styling */
  .btn-checkout {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border: none;
    padding: 14px 32px;
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
    border-radius: 50px;
    color: white;
    transition: var(--transition);
    box-shadow: 0 8px 20px rgba(255, 107, 53, 0.35);
    width: 100%;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }

  .btn-checkout:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(255, 107, 53, 0.5);
  }

  .btn-checkout:active {
    transform: translateY(1px);
  }

  .btn-checkout:disabled {
    opacity: 0.7;
    transform: none;
    cursor: not-allowed;
  }

  /* Loading state */
  .btn-checkout.loading {
    pointer-events: none;
  }

  .btn-checkout.loading i {
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
  }

  /* Responsive */
  @media (max-width: 768px) {
    header.masthead {
      height: 30vh !important;
      min-height: 250px;
    }
    header.masthead .page-title h3 {
      font-size: 2rem;
    }
    .card {
      margin-top: -40px;
    }
    .card-body {
      padding: 1.5rem;
    }
    .card-body h4 {
      font-size: 1.4rem;
    }
    .btn-checkout {
      padding: 12px 24px;
      font-size: 1rem;
    }
  }

  /* Animation for form fields */
  .form-group {
    animation: slideInRight 0.5s ease-out;
    animation-fill-mode: both;
  }

  .form-group:nth-child(1) { animation-delay: 0.05s; }
  .form-group:nth-child(2) { animation-delay: 0.1s; }
  .form-group:nth-child(3) { animation-delay: 0.15s; }
  .form-group:nth-child(4) { animation-delay: 0.2s; }
  .form-group:nth-child(5) { animation-delay: 0.25s; }

  @keyframes slideInRight {
    from {
      opacity: 0;
      transform: translateX(-20px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  /* Order Summary Preview (optional) */
  .order-preview {
    background: linear-gradient(135deg, #f8f9fa, #fff);
    border-radius: 20px;
    padding: 1.2rem;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(0,0,0,0.05);
  }

  /* Custom checkbox/radio styling if needed */
  input[type="checkbox"], input[type="radio"] {
    accent-color: var(--primary);
  }

  /* Floating label effect on focus */
  .form-group {
    position: relative;
  }

  /* Error styling */
  .form-control.is-invalid {
    border-color: var(--danger);
    background-color: #fff5f5;
  }

  .invalid-feedback {
    color: var(--danger);
    font-size: 0.8rem;
    margin-top: 0.25rem;
  }
</style>

<header class="masthead">
  <div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-10 align-self-end mb-4 page-title">
        <h3 class="text-white">
          <i class="fas fa-shopping-bag me-2"></i>Checkout
        </h3>
        <hr class="divider my-4" />
        <p class="text-white-50">Complete your order with delivery information</p>
      </div>
    </div>
  </div>
</header>

<section class="page-section mb-5" id="checkout-section">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-7">
            <h4>
              <i class="fas fa-truck me-2" style="color: var(--primary);"></i>
              Confirm Delivery Information
            </h4>
            <form action="" id="checkout" method="POST">
              <div class="form-group">
                <label for="first_name">
                  <i class="fas fa-user"></i> First Name
                </label>
                <input type="text" id="first_name" name="first_name" required class="form-control" 
                       value="<?php echo htmlspecialchars($_SESSION['login_first_name'] ?? ''); ?>">
              </div>
              
              <div class="form-group">
                <label for="last_name">
                  <i class="fas fa-user-friends"></i> Last Name
                </label>
                <input type="text" id="last_name" name="last_name" required class="form-control" 
                       value="<?php echo htmlspecialchars($_SESSION['login_last_name'] ?? ''); ?>">
              </div>
              
              <div class="form-group">
                <label for="mobile">
                  <i class="fas fa-phone-alt"></i> Contact Number
                </label>
                <input type="tel" id="mobile" name="mobile" required class="form-control" 
                       value="<?php echo htmlspecialchars($_SESSION['login_mobile'] ?? ''); ?>">
              </div>
              
              <div class="form-group">
                <label for="address">
                  <i class="fas fa-map-marker-alt"></i> Delivery Address
                </label>
                <textarea id="address" name="address" rows="3" required class="form-control" 
                          placeholder="Enter your complete delivery address"><?php echo htmlspecialchars($_SESSION['login_address'] ?? ''); ?></textarea>
              </div>
              
              <div class="form-group">
                <label for="email">
                  <i class="fas fa-envelope"></i> Email Address
                </label>
                <input type="email" id="email" name="email" required class="form-control" 
                       value="<?php echo htmlspecialchars($_SESSION['login_email'] ?? ''); ?>">
              </div>

              <div class="text-center mt-4">
                <button type="submit" class="btn-checkout" id="checkoutBtn">
                  <i class="fas fa-check-circle me-2"></i> Place Order
                </button>
              </div>
            </form>
          </div>
          
          <div class="col-lg-5 mt-4 mt-lg-0">
            <div class="order-preview">
              <h5 class="mb-3" style="font-weight: 700;">
                <i class="fas fa-receipt me-2" style="color: var(--primary);"></i>
                Order Summary
              </h5>
              <div id="order-items-preview">
                <div class="text-center text-muted py-3">
                  <i class="fas fa-spinner fa-pulse"></i> Loading cart items...
                </div>
              </div>
              <hr>
              <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="fw-bold">Total Amount:</span>
                <span class="fw-bold fs-5" style="color: var(--primary);" id="cart-total">₱ 0.00</span>
              </div>
            </div>
            
            <div class="alert alert-info mt-3" style="border-radius: 16px; background: #e8f4fd; border: none;">
              <i class="fas fa-info-circle me-2"></i>
              <small>By placing your order, you agree to our terms and conditions. Your food will be delivered within 30-45 minutes.</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function(){
    // Load cart preview
    function loadCartPreview() {
      $.ajax({
        url: 'ajax.php?action=get_cart_preview',
        method: 'GET',
        success: function(resp) {
          try {
            const data = JSON.parse(resp);
            if(data.items && data.items.length > 0) {
              let html = '';
              data.items.forEach(item => {
                html += `
                  <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <div>
                      <span class="fw-semibold">${item.name}</span>
                      <small class="text-muted d-block">x${item.qty}</small>
                    </div>
                    <span class="fw-semibold">₱ ${parseFloat(item.subtotal).toFixed(2)}</span>
                  </div>
                `;
              });
              $('#order-items-preview').html(html);
              $('#cart-total').text(`₱ ${parseFloat(data.total).toFixed(2)}`);
            } else {
              $('#order-items-preview').html('<div class="text-center text-muted py-3"><i class="fas fa-shopping-cart"></i> Your cart is empty</div>');
              $('#cart-total').text('₱ 0.00');
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
    
    loadCartPreview();
    
    // Form submission
    $('#checkout').submit(function(e){
      e.preventDefault();
      
      const $btn = $('#checkoutBtn');
      const originalHtml = $btn.html();
      $btn.html('<i class="fas fa-spinner fa-pulse me-2"></i> Processing...').prop('disabled', true).addClass('loading');
      
      // Validate form
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
        $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
        return;
      }
      
      // Email validation
      const email = $('#email').val();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if(!emailRegex.test(email)) {
        $('#email').addClass('is-invalid');
        alert_toast('Please enter a valid email address', 'warning');
        $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
        return;
      }
      
      // Phone validation (basic)
      const mobile = $('#mobile').val();
      const phoneRegex = /^[\d\s\-+()]{8,15}$/;
      if(!phoneRegex.test(mobile)) {
        $('#mobile').addClass('is-invalid');
        alert_toast('Please enter a valid contact number', 'warning');
        $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
        return;
      }
      
      start_load();
      $.ajax({
        url: "ajax.php?action=save_order",
        method: 'POST',
        data: $(this).serialize(),
        success: function(resp){
          end_load();
          if(resp == 1){
            alert_toast("Order successfully placed!", 'success');
            setTimeout(function(){
              location.replace('index.php?page=home');
            }, 2000);
          } else if(resp == 2) {
            alert_toast("Your cart is empty. Please add items to continue.", 'warning');
            setTimeout(function(){
              location.replace('index.php?page=cart_list');
            }, 1500);
          } else {
            alert_toast("Failed to place order. Please try again.", 'danger');
            $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
          }
        },
        error: function(xhr, status, error){
          end_load();
          console.error("AJAX Error:", error);
          alert_toast("An error occurred. Please check your connection.", 'danger');
          $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
        }
      });
    });
    
    // Remove invalid class on input
    $('.form-control').on('input', function() {
      $(this).removeClass('is-invalid');
    });
    
    // Add focus effect
    $('.form-control').on('focus', function() {
      $(this).parent().addClass('focused');
    }).on('blur', function() {
      $(this).parent().removeClass('focused');
    });
  });
</script>

<style>
  /* Additional styles for order preview */
  .order-preview {
    background: linear-gradient(135deg, #f8f9fa, #ffffff);
    border-radius: 24px;
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid rgba(0,0,0,0.05);
    position: sticky;
    top: 100px;
  }
  
  .order-preview h5 {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    border-left: 4px solid var(--primary);
    padding-left: 12px;
  }
  
  .btn-checkout i {
    transition: var(--transition);
  }
  
  /* Fix for start_load/end_load if not defined */
  window.start_load = window.start_load || function() {
    $('body').append('<div id="preloader2" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;align-items:center;justify-content:center;"><div class="spinner-border text-light" role="status"><span class="sr-only">Loading...</span></div></div>');
  };
  
  window.end_load = window.end_load || function() {
    $('#preloader2').fadeOut('fast', function() { $(this).remove(); });
  };
  
  window.alert_toast = window.alert_toast || function(msg, type) {
    alert(msg);
  };
</script>