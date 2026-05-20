<?php session_start() ?>
<div class="container-fluid p-3">
    <form action="" id="login-frm">
        <div class="text-center mb-4">
            <div class="login-icon-wrapper">
                <i class="fas fa-user-circle"></i>
            </div>
            <h4 class="login-title">Welcome Back!</h4>
            <p class="login-subtitle">Sign in to continue your order</p>
        </div>
        
        <div class="form-group mb-3">
            <label for="email" class="form-label">
                <i class="fas fa-envelope"></i> Email Address
            </label>
            <input type="email" name="email" id="email" required class="form-control" placeholder="Enter your email">
        </div>
        
        <div class="form-group mb-3">
            <label for="password" class="form-label">
                <i class="fas fa-lock"></i> Password
            </label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" required class="form-control" placeholder="Enter your password">
                <button type="button" class="toggle-password" tabindex="-1">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <small><a href="javascript:void(0)" class="text-primary" id="new_account">Create New Account</a></small>
                <small><a href="javascript:void(0)" class="text-muted" id="forgot_password">Forgot Password?</a></small>
            </div>
        </div>
        
        <button type="submit" class="btn-login">
            <i class="fas fa-arrow-right-to-bracket"></i> Sign In
        </button>
    </form>
</div>

<style>
    /* ========== PREMIUM LOGIN MODAL DESIGN ========== */
    :root {
        --primary: #ff6b35;
        --primary-dark: #e85d2c;
        --primary-light: #ff8a5c;
        --primary-glow: rgba(255, 107, 53, 0.25);
        --dark: #1a1a2e;
        --gray: #6c757d;
        --gray-light: #e2e8f0;
        --success: #00b894;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    #uni_modal .modal-footer {
        display: none !important;
    }
    
    #uni_modal .modal-body {
        padding: 2rem !important;
    }
    
    #uni_modal .modal-content {
        border-radius: 28px;
        overflow: hidden;
    }
    
    .login-icon-wrapper {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 10px 25px var(--primary-glow);
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    
    .login-icon-wrapper i {
        font-size: 2.5rem;
        color: white;
    }
    
    .login-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }
    
    .login-subtitle {
        font-size: 0.85rem;
        color: var(--gray);
        margin-bottom: 0;
    }
    
    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .form-label i {
        color: var(--primary);
        font-size: 0.85rem;
    }
    
    .form-control {
        width: 100%;
        border: 2px solid var(--gray-light);
        border-radius: 16px;
        padding: 12px 16px;
        font-size: 0.9rem;
        transition: var(--transition);
        background: white;
    }
    
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-glow);
        outline: none;
    }
    
    .password-wrapper {
        position: relative;
    }
    
    .password-wrapper .form-control {
        padding-right: 45px;
    }
    
    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: var(--gray);
        cursor: pointer;
        font-size: 1rem;
        transition: var(--transition);
    }
    
    .toggle-password:hover {
        color: var(--primary);
    }
    
    .btn-login {
        width: 100%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        padding: 12px;
        border-radius: 40px;
        color: white;
        font-weight: 700;
        font-size: 1rem;
        transition: var(--transition);
        cursor: pointer;
        margin-top: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px var(--primary-glow);
    }
    
    .btn-login:active {
        transform: translateY(0);
    }
    
    .btn-login:disabled {
        opacity: 0.7;
        transform: none;
        cursor: not-allowed;
    }
    
    .text-primary {
        color: var(--primary) !important;
        text-decoration: none;
        transition: var(--transition);
    }
    
    .text-primary:hover {
        color: var(--primary-dark) !important;
        text-decoration: underline;
    }
    
    .text-muted {
        color: var(--gray) !important;
        text-decoration: none;
        transition: var(--transition);
    }
    
    .text-muted:hover {
        color: var(--primary) !important;
    }
    
    /* Alert Styling */
    .alert-custom {
        background: linear-gradient(135deg, #ffe5e0, #ffd6cc);
        border-left: 4px solid var(--danger);
        color: #c23d00;
        padding: 12px 16px;
        border-radius: 16px;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: shakeX 0.5s ease;
    }
    
    @keyframes shakeX {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    /* Invalid input styling */
    .form-control.is-invalid {
        border-color: #ff7675 !important;
        background-color: #fff5f5 !important;
    }
    
    /* Responsive */
    @media (max-width: 576px) {
        #uni_modal .modal-body {
            padding: 1.5rem !important;
        }
        
        .login-title {
            font-size: 1.3rem;
        }
        
        .login-icon-wrapper {
            width: 55px;
            height: 55px;
        }
        
        .login-icon-wrapper i {
            font-size: 1.8rem;
        }
    }
    
    /* Loading state for button */
    .btn-login.loading {
        pointer-events: none;
    }
    
    .btn-login.loading i {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<script>
    // Toggle password visibility
    $(document).ready(function() {
        $('.toggle-password').click(function() {
            const passwordInput = $('#password');
            const icon = $(this).find('i');
            
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
        
        // Auto-focus on email field
        $('#email').focus();
        
        // Remove invalid class on input
        $('.form-control').on('input', function() {
            $(this).removeClass('is-invalid');
        });
        
        // Enter key submit
        $('#password, #email').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $('#login-frm').submit();
            }
        });
    });
    
    $('#new_account').click(function() {
        const redirect = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home'; ?>';
        uni_modal("Create an Account", 'signup.php?redirect=' + encodeURIComponent(redirect));
    });
    
    $('#forgot_password').click(function() {
        uni_modal("Reset Password", 'forgot_password.php');
    });
    
    $('#login-frm').submit(function(e) {
        e.preventDefault();
        
        const $btn = $('#login-frm button[type="submit"]');
        const originalHtml = $btn.html();
        $btn.html('<i class="fas fa-spinner fa-pulse"></i> Signing in...').prop('disabled', true).addClass('loading');
        
        // Remove any existing alerts
        $(this).find('.alert-custom').remove();
        
        // Client-side validation
        let isValid = true;
        const email = $('#email').val().trim();
        const password = $('#password').val().trim();
        
        if (!email) {
            $('#email').addClass('is-invalid');
            isValid = false;
        }
        if (!password) {
            $('#password').addClass('is-invalid');
            isValid = false;
        }
        
        // Email format validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email)) {
            $('#email').addClass('is-invalid');
            $(this).prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Please enter a valid email address.</div>');
            $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
            return;
        }
        
        if (!isValid) {
            $(this).prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Please fill in all fields.</div>');
            $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
            return;
        }
        
        $.ajax({
            url: 'admin/ajax.php?action=login2',
            method: 'POST',
            data: $(this).serialize(),
            error: function(err) {
                console.error(err);
                $('#login-frm').prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Connection error. Please try again.</div>');
                $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
            },
            success: function(resp) {
                if (resp == 1) {
                    // Success animation before redirect
                    $btn.html('<i class="fas fa-check-circle"></i> Success! Redirecting...');
                    setTimeout(function() {
                        location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home'; ?>';
                    }, 500);
                } else {
                    $('#login-frm').prepend('<div class="alert-custom"><i class="fas fa-times-circle"></i> Invalid email or password. Please try again.</div>');
                    $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
                    $('#password').val('').addClass('is-invalid');
                    $('#password').focus();
                }
            }
        });
    });
</script>