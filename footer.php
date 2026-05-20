<!-- Enhanced Global JavaScript Functions -->
<script>
    // ========== ENHANCED GLOBAL FUNCTIONS ==========
    
    // Datepicker initialization with enhanced options
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom auto",
        templates: {
            leftArrow: '<i class="fas fa-chevron-left"></i>',
            rightArrow: '<i class="fas fa-chevron-right"></i>'
        }
    });
    
    // Enhanced preloader with modern design
    window.start_load = function() {
        // Remove existing preloader if any
        if ($('#preloader2').length) {
            $('#preloader2').remove();
        }
        
        // Create modern preloader
        const preloader = `
            <div id="preloader2">
                <div class="preloader-content">
                    <div class="preloader-spinner">
                        <div class="spinner-ring"></div>
                        <div class="spinner-ring"></div>
                        <div class="spinner-ring"></div>
                    </div>
                    <p class="preloader-text">Loading...</p>
                </div>
            </div>
        `;
        $('body').append(preloader);
        
        // Add animation classes
        setTimeout(() => {
            $('#preloader2').addClass('active');
        }, 10);
    }
    
    window.end_load = function() {
        $('#preloader2').removeClass('active');
        setTimeout(function() {
            $('#preloader2').fadeOut(300, function() {
                $(this).remove();
            });
        }, 200);
    }
    
    // Enhanced modal function with better UX
    window.uni_modal = function($title = '', $url = '') {
        start_load();
        $.ajax({
            url: $url,
            error: function(err) {
                console.error(err);
                alert_toast("An error occurred. Please try again.", 'danger');
                end_load();
            },
            success: function(resp) {
                if (resp) {
                    // Set modal title with icon
                    $('#uni_modal .modal-title').html('<i class="fas fa-pen-alt me-2"></i>' + $title);
                    $('#uni_modal .modal-body').html(resp);
                    
                    // Apply enhanced modal styles
                    $('#uni_modal .modal-content').addClass('enhanced-modal');
                    
                    // Show modal with animation
                    $('#uni_modal').modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                    
                    // Trigger any dynamic content initialization
                    if (typeof initializeDynamicContent === 'function') {
                        initializeDynamicContent();
                    }
                    
                    end_load();
                }
            }
        });
    }
    
    // Enhanced right modal function
    window.uni_modal_right = function($title = '', $url = '') {
        start_load();
        $.ajax({
            url: $url,
            error: function(err) {
                console.error(err);
                alert_toast("An error occurred. Please try again.", 'danger');
                end_load();
            },
            success: function(resp) {
                if (resp) {
                    $('#uni_modal_right .modal-title').html('<i class="fas fa-info-circle me-2"></i>' + $title);
                    $('#uni_modal_right .modal-body').html(resp);
                    $('#uni_modal_right .modal-content').addClass('enhanced-modal-right');
                    $('#uni_modal_right').modal('show');
                    end_load();
                }
            }
        });
    }
    
    // Enhanced toast notification with modern design
    window.alert_toast = function($msg = 'TEST', $bg = 'success') {
        // Remove existing toast if present
        $('#alert_toast').removeClass('toast-success toast-danger toast-info toast-warning');
        
        // Set icon based on type
        let icon = '<i class="fas fa-check-circle"></i>';
        let bgClass = '';
        
        switch($bg) {
            case 'success':
                bgClass = 'toast-success';
                icon = '<i class="fas fa-check-circle"></i>';
                break;
            case 'danger':
                bgClass = 'toast-danger';
                icon = '<i class="fas fa-exclamation-circle"></i>';
                break;
            case 'info':
                bgClass = 'toast-info';
                icon = '<i class="fas fa-info-circle"></i>';
                break;
            case 'warning':
                bgClass = 'toast-warning';
                icon = '<i class="fas fa-exclamation-triangle"></i>';
                break;
            default:
                bgClass = 'toast-success';
        }
        
        $('#alert_toast').addClass(bgClass);
        $('#alert_toast .toast-body').html(`
            <div class="toast-icon">${icon}</div>
            <div class="toast-message">${$msg}</div>
            <button class="toast-close" onclick="$('#alert_toast').toast('hide')">&times;</button>
        `);
        
        // Initialize toast with custom options
        $('#alert_toast').toast({ delay: 3500 }).toast('show');
        
        // Auto-hide animation
        setTimeout(() => {
            $('#alert_toast').addClass('hiding');
            setTimeout(() => {
                $('#alert_toast').removeClass('hiding');
            }, 300);
        }, 3200);
    }
    
    // Enhanced load cart function with animation
    window.load_cart = function() {
        $.ajax({
            url: 'admin/ajax.php?action=get_cart_count',
            success: function(resp) {
                if (resp > -1) {
                    const count = resp > 0 ? resp : 0;
                    const $cartBadge = $('.item_count');
                    const oldCount = parseInt($cartBadge.text()) || 0;
                    
                    $cartBadge.html(count);
                    
                    // Add animation effect when count changes
                    if (count !== oldCount) {
                        $cartBadge.addClass('cart-update');
                        setTimeout(() => {
                            $cartBadge.removeClass('cart-update');
                        }, 500);
                    }
                    
                    // Show/hide badge based on count
                    if (count > 0) {
                        $cartBadge.show();
                    } else {
                        $cartBadge.hide();
                    }
                }
            },
            error: function() {
                console.error('Failed to load cart count');
            }
        });
    }
    
    // Login modal trigger
    $('#login_now').click(function() {
        uni_modal("Customer Login", 'login.php');
    });
    
    // Initialize on document ready
    $(document).ready(function() {
        load_cart();
        
        // Auto-refresh cart every 30 seconds
        setInterval(load_cart, 30000);
        
        // Add ripple effect to buttons
        $(document).on('click', '.btn, button:not(.no-ripple)', function(e) {
            const $btn = $(this);
            if (!$btn.hasClass('no-ripple')) {
                const x = e.clientX - $btn.offset().left;
                const y = e.clientY - $btn.offset().top;
                
                const ripple = $('<span class="ripple-effect"></span>');
                ripple.css({
                    left: x + 'px',
                    top: y + 'px',
                    position: 'absolute'
                });
                
                $btn.css('position', 'relative').append(ripple);
                setTimeout(() => ripple.remove(), 600);
            }
        });
        
        // Enhanced form validation styling
        $(document).on('input', '.form-control, .form-select', function() {
            $(this).removeClass('is-invalid');
            if ($(this).val().trim() !== '') {
                $(this).addClass('is-valid');
            } else {
                $(this).removeClass('is-valid');
            }
        });
        
        // Smooth scroll for anchor links
        $(document).on('click', 'a[href^="#"]:not([href="#"])', function(e) {
            const target = $(this.hash);
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 600);
            }
        });
    });
    
    // Helper function for confirmation dialogs
    window._conf = function($msg = '', $func = '', $params = []) {
        $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");
        $('#confirm_modal .modal-body').html(`
            <div class="confirmation-content">
                <i class="fas fa-question-circle confirmation-icon"></i>
                <div class="confirmation-message">${$msg}</div>
            </div>
        `);
        $('#confirm_modal').modal('show');
    }
    
    // Helper function to format currency
    window.formatCurrency = function(amount) {
        return new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2
        }).format(amount);
    }
    
    // Helper function to format date
    window.formatDate = function(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-PH', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
</script>

<!-- Enhanced Modal Styles -->
<style>
    /* Enhanced Preloader */
    #preloader2 {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(8px);
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    #preloader2.active {
        opacity: 1;
        visibility: visible;
    }
    
    .preloader-content {
        text-align: center;
    }
    
    .preloader-spinner {
        position: relative;
        width: 60px;
        height: 60px;
        margin: 0 auto;
    }
    
    .spinner-ring {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 3px solid transparent;
        border-radius: 50%;
        animation: spin 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    }
    
    .spinner-ring:nth-child(1) {
        border-top-color: #ff6b35;
        animation-delay: -0.45s;
    }
    
    .spinner-ring:nth-child(2) {
        border-right-color: #667eea;
        animation-delay: -0.3s;
    }
    
    .spinner-ring:nth-child(3) {
        border-bottom-color: #00b894;
        animation-delay: -0.15s;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .preloader-text {
        margin-top: 20px;
        color: white;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 1px;
        animation: pulse 1.5s ease infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 0.6; }
        50% { opacity: 1; }
    }
    
    /* Enhanced Toast Notification */
    #alert_toast {
        position: fixed;
        top: 90px;
        right: 20px;
        z-index: 9999;
        min-width: 320px;
        background: white;
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        transform: translateX(400px);
        transition: transform 0.3s ease;
    }
    
    #alert_toast.show {
        transform: translateX(0);
    }
    
    #alert_toast.hiding {
        transform: translateX(400px);
    }
    
    #alert_toast .toast-body {
        padding: 14px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .toast-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    
    .toast-message {
        flex: 1;
        font-size: 0.9rem;
        font-weight: 500;
        color: #1a1a2e;
    }
    
    .toast-close {
        background: transparent;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        color: #999;
        transition: color 0.2s;
    }
    
    .toast-close:hover {
        color: #333;
    }
    
    #alert_toast.toast-success .toast-icon {
        background: rgba(0, 184, 148, 0.1);
        color: #00b894;
    }
    
    #alert_toast.toast-danger .toast-icon {
        background: rgba(255, 118, 117, 0.1);
        color: #ff7675;
    }
    
    #alert_toast.toast-warning .toast-icon {
        background: rgba(253, 203, 110, 0.1);
        color: #fdcb6e;
    }
    
    #alert_toast.toast-info .toast-icon {
        background: rgba(9, 132, 227, 0.1);
        color: #0984e3;
    }
    
    /* Enhanced Modal Styles */
    .enhanced-modal .modal-content,
    .enhanced-modal-right .modal-content {
        border-radius: 24px;
        border: none;
        overflow: hidden;
        animation: modalSlideIn 0.3s ease-out;
    }
    
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .enhanced-modal .modal-header,
    .enhanced-modal-right .modal-header {
        background: linear-gradient(135deg, #ff6b35, #e85d2c);
        color: white;
        border: none;
        padding: 1rem 1.5rem;
    }
    
    .enhanced-modal .modal-header .close,
    .enhanced-modal-right .modal-header .close {
        color: white;
        opacity: 0.8;
        text-shadow: none;
    }
    
    .enhanced-modal .modal-header .close:hover,
    .enhanced-modal-right .modal-header .close:hover {
        opacity: 1;
    }
    
    /* Cart Badge Animation */
    .item_count {
        display: inline-block;
        transition: transform 0.3s ease;
    }
    
    .item_count.cart-update {
        transform: scale(1.3);
        animation: cartPulse 0.5s ease;
    }
    
    @keyframes cartPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.3); background-color: #ff6b35; }
        100% { transform: scale(1); }
    }
    
    /* Ripple Effect */
    .ripple-effect {
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        transform: translate(-50%, -50%);
        animation: rippleAnim 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes rippleAnim {
        0% {
            width: 0;
            height: 0;
            opacity: 0.5;
        }
        100% {
            width: 200px;
            height: 200px;
            opacity: 0;
        }
    }
    
    /* Confirmation Modal Content */
    .confirmation-content {
        text-align: center;
        padding: 1rem;
    }
    
    .confirmation-icon {
        font-size: 3rem;
        color: #fdcb6e;
        margin-bottom: 1rem;
    }
    
    .confirmation-message {
        font-size: 1rem;
        color: #2d3436;
        line-height: 1.5;
    }
    
    /* Form Validation Styles */
    .form-control.is-valid {
        border-color: #00b894;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2300b894' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
        padding-right: 40px;
    }
    
    .form-control.is-invalid {
        border-color: #ff7675;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23ff7675' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='10'%3E%3C/circle%3E%3Cline x1='12' y1='8' x2='12' y2='12'%3E%3C/line%3E%3Cline x1='12' y1='16' x2='12.01' y2='16'%3E%3C/line%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
        padding-right: 40px;
    }
    
    /* Responsive Toast */
    @media (max-width: 576px) {
        #alert_toast {
            left: 20px;
            right: 20px;
            min-width: auto;
        }
    }
</style>

<!-- Bootstrap core JS (keep original loading order) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- Font Awesome 6 (if not already included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Core theme JS -->
<script src="js/scripts.js"></script>