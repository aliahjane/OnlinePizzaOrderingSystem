<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, viewport-fit=cover" name="viewport">
  <title>Admin | Online Food Ordering System</title>
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
    /* ----- RESET & GLOBAL ----- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      width: 100%;
      height: 100vh;
      overflow: hidden;
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
    }

    main#main {
      width: 100%;
      height: 100vh;
      background: #0a0c10;
      position: relative;
      display: flex;
    }

    /* ---- LEFT PANEL (HERO / BRAND) ---- */
    #login-left {
      flex: 1.2;
      position: relative;
      background: url('./../assets/img/<?php echo $_SESSION['setting_cover_img']; ?>') no-repeat center center/cover;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    /* Modern glass overlay with gradient */
    #login-left::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.4) 100%);
      backdrop-filter: brightness(0.85) blur(2px);
      z-index: 1;
    }

    /* animated decorative accent */
    #login-left::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 6px;
      background: linear-gradient(90deg, #ffb347, #ff6b3d, #ff3b6f);
      z-index: 2;
    }

    #login-left .brand-container {
      position: relative;
      z-index: 2;
      text-align: center;
      padding: 2rem;
      max-width: 85%;
      animation: fadeInUp 1s ease-out;
    }

    #login-left h1 {
      font-family: 'Playfair Display', 'Dancing Script', cursive !important;
      font-weight: 800;
      font-size: 3.8rem;
      color: #fff;
      text-shadow: 0 8px 20px rgba(0,0,0,0.4);
      letter-spacing: -0.5px;
      margin-bottom: 1rem;
      line-height: 1.2;
    }

    #login-left .tagline {
      font-size: 1.1rem;
      font-weight: 400;
      color: rgba(255,255,255,0.9);
      background: rgba(0,0,0,0.3);
      backdrop-filter: blur(8px);
      display: inline-block;
      padding: 0.5rem 1.5rem;
      border-radius: 40px;
      letter-spacing: 0.3px;
      margin-top: 0.5rem;
    }

    /* ---- RIGHT PANEL (CARD FORM) ---- */
    #login-right {
      flex: 0.9;
      background: #ffffff;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      box-shadow: -15px 0 30px rgba(0,0,0,0.05);
      z-index: 3;
    }

    /* Card styling with premium feel */
    .login-card {
      width: 80%;
      max-width: 420px;
      background: transparent;
      border: none;
      border-radius: 0;
      padding: 0.5rem;
    }

    .card-body {
      padding: 2rem 1.8rem;
      background: white;
      border-radius: 32px;
      box-shadow: 0 25px 45px -12px rgba(0,0,0,0.2), 0 2px 8px rgba(0,0,0,0.02);
      transition: transform 0.2s ease;
    }

    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-header .brand-icon {
      font-size: 2.5rem;
      background: linear-gradient(135deg, #ff8c42, #ff3b6f);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      display: inline-block;
      margin-bottom: 0.5rem;
    }

    .login-header h3 {
      font-weight: 700;
      font-size: 1.8rem;
      color: #1e2a3e;
      letter-spacing: -0.3px;
    }

    .login-header p {
      color: #5a6874;
      font-size: 0.9rem;
      margin-top: 0.3rem;
    }

    /* Modern form fields */
    .form-floating-group {
      margin-bottom: 1.5rem;
      position: relative;
    }

    .input-icon {
      position: relative;
    }

    .input-icon i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #9aa6b2;
      font-size: 1.1rem;
      transition: color 0.2s;
      pointer-events: none;
      z-index: 2;
    }

    .input-icon input {
      width: 100%;
      padding: 14px 16px 14px 44px;
      font-size: 0.95rem;
      border: 1.5px solid #e2e8f0;
      border-radius: 24px;
      background: #fefefe;
      transition: all 0.25s;
      font-weight: 500;
      outline: none;
      color: #1a2632;
    }

    .input-icon input:focus {
      border-color: #ff7b2c;
      box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
      background: #ffffff;
    }

    .input-icon input:focus + i {
      color: #ff6b3d;
    }

    /* button design */
    .btn-modern {
      background: linear-gradient(105deg, #ff7b2c, #ff5722);
      border: none;
      padding: 12px 20px;
      font-weight: 700;
      font-size: 1rem;
      letter-spacing: 0.3px;
      border-radius: 40px;
      color: white;
      width: 100%;
      transition: all 0.25s;
      box-shadow: 0 5px 12px rgba(255, 87, 34, 0.3);
      cursor: pointer;
      margin-top: 0.5rem;
    }

    .btn-modern:hover {
      transform: translateY(-2px);
      filter: brightness(1.02);
      box-shadow: 0 10px 18px rgba(255, 87, 34, 0.4);
    }

    .btn-modern:active {
      transform: translateY(1px);
    }

    /* back link */
    .back-link {
      text-align: center;
      margin-top: 1.8rem;
    }

    .back-link a {
      text-decoration: none;
      color: #ff6b3d;
      font-weight: 600;
      font-size: 0.9rem;
      transition: 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .back-link a i {
      font-size: 1rem;
      transition: transform 0.2s;
    }

    .back-link a:hover {
      color: #e05a2a;
    }

    .back-link a:hover i {
      transform: translateX(-3px);
    }

    /* alert enhancement */
    .alert-custom {
      background: #ffeae5;
      border-left: 5px solid #ff5722;
      color: #c23d00;
      padding: 12px 18px;
      border-radius: 20px;
      margin-bottom: 1.5rem;
      font-size: 0.85rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    /* animation */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(25px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive design */
    @media (max-width: 992px) {
      #login-left {
        flex: 1;
      }
      #login-right {
        flex: 1;
      }
      #login-left h1 {
        font-size: 2.5rem;
      }
    }

    @media (max-width: 768px) {
      main#main {
        flex-direction: column;
      }
      #login-left {
        flex: 0.8;
        min-height: 32vh;
      }
      #login-right {
        flex: 1.2;
        box-shadow: 0 -10px 25px rgba(0,0,0,0.05);
      }
      #login-left h1 {
        font-size: 2rem;
      }
      .login-card {
        width: 90%;
      }
      .card-body {
        padding: 1.5rem;
      }
    }

    /* loader button state */
    .btn-modern:disabled {
      opacity: 0.8;
      transform: none;
      cursor: not-allowed;
    }

    /* back-to-top (keep original but restyle) */
    .back-to-top {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #ff7b2c;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transition: all 0.2s;
      z-index: 99;
    }
    .back-to-top:hover {
      background: #e05a2a;
      transform: translateY(-3px);
    }

    /* additional polish */
    .logo-icon {
      font-size: 3rem;
      background: white;
      border-radius: 60px;
      padding: 10px;
    }

    hr {
      opacity: 0.2;
      margin: 1rem 0;
    }
  </style>
  <!-- Font Awesome & Google Fonts for premium look -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
</head>
<body>

<main id="main">
  <!-- LEFT SIDE: Branding, cover image dynamic -->
  <div id="login-left">
    <div class="brand-container">
      <div class="logo-icon" style="display: inline-flex; background: rgba(255,255,255,0.15); backdrop-filter: blur(12px); border-radius: 60px; padding: 12px 24px; margin-bottom: 1rem;">
        <i class="fas fa-utensils" style="font-size: 2.8rem; color: #ffb347;"></i>
      </div>
      <h1><?= $_SESSION['setting_name'] ?></h1>
      <div class="tagline">
        <i class="fas fa-crown"></i> Admin Control Panel
      </div>
    </div>
  </div>

  <!-- RIGHT SIDE: Enhanced Login Form -->
  <div id="login-right">
    <div class="login-card">
      <div class="card-body">
        <div class="login-header">
          <div class="brand-icon">
            <i class="fas fa-shield-alt"></i>
          </div>
          <h3>Welcome back</h3>
          <p>Sign in to manage orders & menu</p>
        </div>
        
        <form id="login-form">
          <div id="alert-placeholder"></div>
          
          <div class="form-floating-group">
            <div class="input-icon">
              <i class="fas fa-user"></i>
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
            <i class="fas fa-key"></i> Login to Dashboard
          </button>
          
          <div class="back-link">
            <a href="./../">
              <i class="fas fa-arrow-left"></i> Back to Website
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<a href="#" class="back-to-top"><i class="fas fa-chevron-up"></i></a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    // Floating label effect placeholders (just for style, but input already has placeholder)
    // Enhance form submit with modern feedback
    $('#login-form').on('submit', function(e){
      e.preventDefault();
      const $btn = $('#loginBtn');
      const originalHtml = $btn.html();
      $btn.html('<i class="fas fa-spinner fa-pulse"></i> Authenticating...').prop('disabled', true);
      
      // Remove any existing alert
      $('#alert-placeholder').empty();
      
      $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: function(err){
          console.error(err);
          $('#alert-placeholder').html('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Network error, please try again.</div>');
          $btn.html(originalHtml).prop('disabled', false);
        },
        success: function(resp){
          if(resp == 1){
            // successful login
            window.location.href = 'index.php?page=home';
          } else {
            // wrong credentials
            $('#alert-placeholder').html('<div class="alert-custom"><i class="fas fa-times-circle"></i> Invalid username or password. Please try again.</div>');
            $btn.html(originalHtml).prop('disabled', false);
            // reset form input styling highlight
            $('#username, #password').addClass('is-invalid').on('focus', function(){
              $(this).removeClass('is-invalid');
            });
            setTimeout(() => {
              $('#username, #password').removeClass('is-invalid');
            }, 1500);
          }
        }
      });
    });
    
    // Add subtle class for invalid fields styling (custom highlight)
    $('input').on('focus', function(){
      $(this).css('border-color', '#ff7b2c');
    }).on('blur', function(){
      if($(this).val() === ''){
        $(this).css('border-color', '#e2e8f0');
      } else {
        $(this).css('border-color', '#cbd5e1');
      }
    });
    
    // back-to-top smooth
    $('.back-to-top').click(function(e){
      e.preventDefault();
      $('html, body').animate({scrollTop: 0}, 300);
    });
  });
</script>
<style>
  /* additional inline fixes for nice cross-browser */
  input.is-invalid {
    border-color: #ff4d4f !important;
    background-color: #fff5f5 !important;
    box-shadow: 0 0 0 2px rgba(255,77,79,0.2);
  }
  .form-floating-group input {
    font-family: 'Inter', sans-serif;
  }
  #login-left .brand-container {
    backdrop-filter: blur(0px);
  }
  /* to preserve original php dynamic img */
  #login-left {
    transition: all 0.3s;
  }
  @media (max-width: 560px) {
    .card-body {
      padding: 1.3rem;
    }
    .btn-modern {
      padding: 10px 16px;
    }
    .login-header h3 {
      font-size: 1.5rem;
    }
  }
</style>
</body>
</html>