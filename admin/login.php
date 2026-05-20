<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, viewport-fit=cover" name="viewport">
  <title>Admin Login | Online Food Ordering System</title>
  <?php include('./header.php'); ?>
  <?php include('./db_connect.php'); ?>
  <?php 
    session_start();
    if(isset($_SESSION['login_id']))
    header("location:index.php?page=home");

    $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach ($query as $key => $value) {
      if(!is_numeric($key))
        $_SESSION['setting_'.$key] = $value;
    }
  ?>
  <style>
    /* ========== PREMIUM ADMIN LOGIN DESIGN ========== */
    :root {
      --primary: #ff6b35;
      --primary-dark: #e85d2c;
      --primary-light: #ff8a5c;
      --primary-glow: rgba(255, 107, 53, 0.4);
      --dark-bg: #0f0f1a;
      --card-bg: rgba(255, 255, 255, 0.98);
      --text-dark: #1a1a2e;
      --text-muted: #6c757d;
      --border-light: rgba(0, 0, 0, 0.08);
      --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      --shadow-glow: 0 0 30px rgba(255, 107, 53, 0.3);
      --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      width: 100%;
      height: 100vh;
      overflow: hidden;
      font-family: 'Inter', 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Animated background particles */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: 
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 50%);
      pointer-events: none;
      z-index: 0;
    }

    main#main {
      width: 100%;
      height: 100vh;
      position: relative;
      display: flex;
      overflow: hidden;
    }

    /* ---- LEFT PANEL (HERO / BRAND) ENHANCED ---- */
    #login-left {
      flex: 1.2;
      position: relative;
      background: url('./../assets/img/<?php echo $_SESSION['setting_cover_img']; ?>') no-repeat center center/cover;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    #login-left::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.5) 100%);
      backdrop-filter: brightness(0.85) blur(3px);
      z-index: 1;
    }

    #login-left::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 8px;
      background: linear-gradient(90deg, #ff6b35, #f5576c, #ff3b6f, #ff6b35);
      background-size: 300% 100%;
      animation: gradientShift 3s ease infinite;
      z-index: 2;
    }

    @keyframes gradientShift {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }

    #login-left .brand-container {
      position: relative;
      z-index: 2;
      text-align: center;
      padding: 2rem;
      max-width: 85%;
      animation: fadeInUp 1s ease-out;
    }

    /* Animated logo wrapper */
    .logo-wrapper {
      display: inline-flex;
      background: rgba(255,255,255,0.12);
      backdrop-filter: blur(16px);
      border-radius: 80px;
      padding: 20px 32px;
      margin-bottom: 1.5rem;
      border: 1px solid rgba(255,255,255,0.2);
      animation: pulseGlow 2s ease-in-out infinite;
    }

    @keyframes pulseGlow {
      0%, 100% { box-shadow: 0 0 0 0 rgba(255,255,255,0.2); }
      50% { box-shadow: 0 0 0 15px rgba(255,255,255,0); }
    }

    .logo-wrapper i {
      font-size: 3.2rem;
      color: #ffb347;
      filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
    }

    #login-left h1 {
      font-family: 'Playfair Display', 'Dancing Script', cursive !important;
      font-weight: 800;
      font-size: 4rem;
      color: #fff;
      text-shadow: 0 8px 25px rgba(0,0,0,0.5);
      letter-spacing: -0.5px;
      margin-bottom: 1rem;
      line-height: 1.2;
      background: linear-gradient(135deg, #fff, #ffd6b0);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      text-shadow: none;
    }

    #login-left .tagline {
      font-size: 1.1rem;
      font-weight: 500;
      color: rgba(255,255,255,0.95);
      background: rgba(0,0,0,0.4);
      backdrop-filter: blur(12px);
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 0.6rem 1.8rem;
      border-radius: 50px;
      letter-spacing: 0.5px;
      border: 1px solid rgba(255,255,255,0.2);
    }

    /* ---- RIGHT PANEL (PREMIUM CARD) ---- */
    #login-right {
      flex: 0.9;
      background: linear-gradient(135deg, #ffffff 0%, #fef9f5 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      z-index: 3;
    }

    .login-card {
      width: 85%;
      max-width: 440px;
    }

    .card-body {
      padding: 2.5rem 2rem;
      background: var(--card-bg);
      border-radius: 48px;
      box-shadow: var(--shadow-xl), var(--shadow-glow);
      transition: var(--transition-smooth);
      backdrop-filter: blur(2px);
      border: 1px solid rgba(255,255,255,0.3);
    }

    .card-body:hover {
      transform: translateY(-5px);
      box-shadow: 0 30px 55px -15px rgba(0,0,0,0.3), 0 0 0 2px rgba(255,107,53,0.2);
    }

    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-header .brand-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, #ff6b35, #f5576c);
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
      box-shadow: 0 10px 25px rgba(255,107,53,0.3);
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-8px); }
    }

    .login-header .brand-icon i {
      font-size: 2rem;
      color: white;
    }

    .login-header h3 {
      font-weight: 800;
      font-size: 2rem;
      background: linear-gradient(135deg, var(--text-dark), #ff6b35);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      letter-spacing: -0.5px;
      margin-bottom: 0.5rem;
    }

    .login-header p {
      color: var(--text-muted);
      font-size: 0.9rem;
      font-weight: 500;
    }

    /* Premium form fields */
    .form-floating-group {
      margin-bottom: 1.5rem;
    }

    .input-icon {
      position: relative;
    }

    .input-icon i {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #a0aec0;
      font-size: 1.1rem;
      transition: var(--transition-smooth);
      pointer-events: none;
      z-index: 2;
    }

    .input-icon input {
      width: 100%;
      padding: 15px 18px 15px 48px;
      font-size: 0.95rem;
      border: 2px solid #e2e8f0;
      border-radius: 28px;
      background: #ffffff;
      transition: var(--transition-smooth);
      font-weight: 500;
      outline: none;
      color: var(--text-dark);
    }

    .input-icon input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 4px var(--primary-glow);
      background: #ffffff;
    }

    .input-icon input:focus + i {
      color: var(--primary);
      transform: translateY(-50%) scale(1.05);
    }

    /* Modern animated button */
    .btn-modern {
      background: linear-gradient(105deg, #ff6b35, #f5576c);
      border: none;
      padding: 14px 24px;
      font-weight: 700;
      font-size: 1rem;
      letter-spacing: 0.5px;
      border-radius: 40px;
      color: white;
      width: 100%;
      transition: var(--transition-smooth);
      box-shadow: 0 8px 20px rgba(255, 107, 53, 0.35);
      cursor: pointer;
      margin-top: 0.5rem;
      position: relative;
      overflow: hidden;
    }

    .btn-modern::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: rgba(255,255,255,0.3);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }

    .btn-modern:hover::before {
      width: 300px;
      height: 300px;
    }

    .btn-modern:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 28px rgba(255, 107, 53, 0.5);
    }

    .btn-modern:active {
      transform: translateY(1px);
    }

    /* Back link */
    .back-link {
      text-align: center;
      margin-top: 2rem;
    }

    .back-link a {
      text-decoration: none;
      color: var(--primary);
      font-weight: 600;
      font-size: 0.9rem;
      transition: var(--transition-smooth);
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 16px;
      border-radius: 40px;
      background: rgba(255,107,53,0.08);
    }

    .back-link a i {
      font-size: 0.9rem;
      transition: transform 0.3s;
    }

    .back-link a:hover {
      background: rgba(255,107,53,0.15);
      color: var(--primary-dark);
    }

    .back-link a:hover i {
      transform: translateX(-5px);
    }

    /* Alert styling */
    .alert-custom {
      background: linear-gradient(135deg, #ffe5e0, #ffd6cc);
      border-left: 4px solid #ff5722;
      color: #c23d00;
      padding: 14px 18px;
      border-radius: 20px;
      margin-bottom: 1.5rem;
      font-size: 0.85rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 12px;
      animation: shakeX 0.5s ease;
    }

    @keyframes shakeX {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }

    /* Animations */
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

    /* Responsive Design */
    @media (max-width: 992px) {
      #login-left h1 { font-size: 2.8rem; }
      .login-card { width: 90%; }
    }

    @media (max-width: 768px) {
      main#main {
        flex-direction: column;
      }
      #login-left {
        flex: 0.7;
        min-height: 35vh;
      }
      #login-right {
        flex: 1.3;
        box-shadow: 0 -20px 30px rgba(0,0,0,0.1);
      }
      #login-left h1 { font-size: 2rem; }
      .card-body { padding: 1.8rem; }
      .logo-wrapper { padding: 12px 24px; }
      .logo-wrapper i { font-size: 2.2rem; }
    }

    @media (max-width: 480px) {
      .card-body { padding: 1.5rem; border-radius: 32px; }
      .login-header h3 { font-size: 1.6rem; }
      .btn-modern { padding: 12px 20px; }
    }

    /* Invalid input styling */
    input.is-invalid {
      border-color: #ff4d4f !important;
      background-color: #fff5f5 !important;
      animation: shakeX 0.4s ease;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 6px;
    }
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    ::-webkit-scrollbar-thumb {
      background: var(--primary);
      border-radius: 10px;
    }

    /* Particles effect container */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 0;
    }
  </style>
  
  <!-- Font Awesome & Google Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Playfair+Display:wght@700;800;900&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<main id="main">
  <!-- LEFT PANEL: Enhanced Branding -->
  <div id="login-left">
    <div class="brand-container">
      <div class="logo-wrapper">
        <i class="fas fa-utensils"></i>
      </div>
      <h1><?= $_SESSION['setting_name'] ?></h1>
      <div class="tagline">
        <i class="fas fa-shield-alt"></i> Admin Dashboard
      </div>
    </div>
  </div>

  <!-- RIGHT PANEL: Premium Login Form -->
  <div id="login-right">
    <div class="login-card">
      <div class="card-body">
        <div class="login-header">
          <div class="brand-icon">
            <i class="fas fa-user-shield"></i>
          </div>
          <h3>Secure Access</h3>
          <p>Enter your credentials to continue</p>
        </div>
        
        <form id="login-form">
          <div id="alert-placeholder"></div>
          
          <div class="form-floating-group">
            <div class="input-icon">
              <i class="fas fa-envelope"></i>
              <input type="text" id="username" name="username" autofocus placeholder="Username" autocomplete="username">
            </div>
          </div>
          
          <div class="form-floating-group">
            <div class="input-icon">
              <i class="fas fa-lock"></i>
              <input type="password" id="password" name="password" placeholder="Password" autocomplete="current-password">
            </div>
          </div>
          
          <button type="submit" class="btn-modern" id="loginBtn">
            <i class="fas fa-arrow-right-to-bracket"></i> Sign In
          </button>
          
          <div class="back-link">
            <a href="./../">
              <i class="fas fa-arrow-left"></i> Return to Website
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<a href="#" class="back-to-top" style="display: none;"><i class="fas fa-chevron-up"></i></a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    // Animated placeholder effect
    $('.input-icon input').on('focus', function() {
      $(this).parent().find('i').css('color', '#ff6b35');
    }).on('blur', function() {
      if($(this).val() === '') {
        $(this).parent().find('i').css('color', '#a0aec0');
      }
    });
    
    // Enhanced form submission
    $('#login-form').on('submit', function(e){
      e.preventDefault();
      const $btn = $('#loginBtn');
      const originalHtml = $btn.html();
      $btn.html('<i class="fas fa-spinner fa-pulse"></i> Authenticating...').prop('disabled', true);
      
      $('#alert-placeholder').empty();
      
      $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: function(err){
          console.error(err);
          $('#alert-placeholder').html('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Connection error. Please try again.</div>');
          $btn.html(originalHtml).prop('disabled', false);
        },
        success: function(resp){
          if(resp == 1){
            // Add success animation before redirect
            $btn.html('<i class="fas fa-check-circle"></i> Success! Redirecting...');
            setTimeout(function(){
              window.location.href = 'index.php?page=home';
            }, 500);
          } else {
            $('#alert-placeholder').html('<div class="alert-custom"><i class="fas fa-times-circle"></i> Invalid username or password. Please try again.</div>');
            $btn.html(originalHtml).prop('disabled', false);
            $('#username, #password').addClass('is-invalid').on('focus', function(){
              $(this).removeClass('is-invalid');
            });
            setTimeout(() => {
              $('#username, #password').removeClass('is-invalid');
            }, 2000);
            // Shake animation on error
            $('.card-body').addClass('animate__shake');
            setTimeout(() => {
              $('.card-body').removeClass('animate__shake');
            }, 500);
          }
        }
      });
    });
    
    // Input field animation on focus
    $('input').on('focus', function(){
      $(this).css('border-color', '#ff6b35');
    }).on('blur', function(){
      if($(this).val() === ''){
        $(this).css('border-color', '#e2e8f0');
      } else {
        $(this).css('border-color', '#cbd5e1');
      }
    });
    
    // Add ripple effect to button
    $('.btn-modern').on('click', function(e) {
      let x = e.clientX - $(this).offset().left;
      let y = e.clientY - $(this).offset().top;
      let ripple = $('<span class="ripple"></span>');
      ripple.css({
        left: x + 'px',
        top: y + 'px',
        position: 'absolute',
        width: '0px',
        height: '0px',
        borderRadius: '50%',
        background: 'rgba(255,255,255,0.5)',
        transform: 'translate(-50%, -50%)',
        animation: 'rippleAnim 0.6s linear'
      });
      $(this).append(ripple);
      setTimeout(() => ripple.remove(), 600);
    });
  });
  
  // Add ripple animation style
  const style = document.createElement('style');
  style.textContent = `
    @keyframes rippleAnim {
      0% { width: 0px; height: 0px; opacity: 0.8; }
      100% { width: 200px; height: 200px; opacity: 0; }
    }
    .btn-modern { position: relative; overflow: hidden; }
    .animate__shake {
      animation: shakeX 0.5s ease;
    }
  `;
  document.head.appendChild(style);
</script>

<style>
  /* Additional cross-browser fixes */
  input.is-invalid {
    border-color: #ff4d4f !important;
    background-color: #fff5f5 !important;
  }
  
  /* Hide back-to-top as not needed on login page */
  .back-to-top {
    display: none !important;
  }
  
  /* Focus visible outline */
  *:focus-visible {
    outline: 2px solid #ff6b35;
    outline-offset: 2px;
  }
  
  /* Smooth transitions for all interactive elements */
  a, button, input {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }
</style>
</body>
</html>