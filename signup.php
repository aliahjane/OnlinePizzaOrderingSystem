<?php session_start() ?>
<div class="container-fluid p-3">
    <form action="" id="signup-frm">
        <div class="text-center mb-4">
            <div class="signup-icon-wrapper">
                <i class="fas fa-user-plus"></i>
            </div>
            <h4 class="signup-title">Create Account</h4>
            <p class="signup-subtitle">Join us for a delicious experience</p>
        </div>
        
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i> First Name
                    </label>
                    <input type="text" name="first_name" required class="form-control" placeholder="Enter first name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user-friends"></i> Last Name
                    </label>
                    <input type="text" name="last_name" required class="form-control" placeholder="Enter last name">
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-phone-alt"></i> Contact Number
            </label>
            <input type="tel" name="mobile" required class="form-control" placeholder="+63 912 345 6789">
        </div>
        
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-map-marker-alt"></i> Delivery Address
            </label>
            <textarea cols="30" rows="3" name="address" required class="form-control" placeholder="Enter your complete delivery address"></textarea>
        </div>
        
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-envelope"></i> Email Address
            </label>
            <input type="email" name="email" required class="form-control" placeholder="name@example.com">
        </div>
        
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-lock"></i> Password
            </label>
            <div class="password-wrapper">
                <input type="password" name="password" id="signup-password" required class="form-control" placeholder="Create a password">
                <button type="button" class="toggle-password" tabindex="-1">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <small class="password-hint">Password must be at least 6 characters</small>
        </div>
        
        <div class="form-group">
            <label class="form-label">
                <i class="fas fa-check-circle"></i> Confirm Password
            </label>
            <div class="password-wrapper">
                <input type="password" name="confirm_password" id="confirm-password" required class="form-control" placeholder="Confirm your password">
                <button type="button" class="toggle-password-confirm" tabindex="-1">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
        
        <div class="terms-checkbox">
            <label class="checkbox-label">
                <input type="checkbox" id="terms" required>
                <span class="checkmark"></span>
                I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
            </label>
        </div>
        
        <button type="submit" class="btn-signup">
            <i class="fas fa-user-plus"></i> Create Account
        </button>
        
        <div class="login-link text-center mt-3">
            <small>Already have an account? <a href="javascript:void(0)" class="text-primary" id="switch-to-login">Sign In</a></small>
        </div>
    </form>
</div>

<style>
    /* ========== PREMIUM SIGNUP MODAL DESIGN ========== */
    :root {
        --primary: #ff6b35;
        --primary-dark: #e85d2c;
        --primary-light: #ff8a5c;
        --primary-glow: rgba(255, 107, 53, 0.25);
        --success: #00b894;
        --danger: #ff7675;
        --dark: #1a1a2e;
        --gray: #6c757d;
        --gray-light: #e2e8f0;
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
        max-height: 85vh;
        overflow-y: auto;
    }
    
    /* Custom scrollbar for modal */
    #uni_modal .modal-content::-webkit-scrollbar {
        width: 4px;
    }
    
    #uni_modal .modal-content::-webkit-scrollbar-track {
        background: var(--gray-light);
    }
    
    #uni_modal .modal-content::-webkit-scrollbar-thumb {
        background: var(--primary);
        border-radius: 4px;
    }
    
    .signup-icon-wrapper {
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
    
    .signup-icon-wrapper i {
        font-size: 2.5rem;
        color: white;
    }
    
    .signup-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }
    
    .signup-subtitle {
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
    
    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }
    
    .password-wrapper {
        position: relative;
    }
    
    .password-wrapper .form-control {
        padding-right: 45px;
    }
    
    .toggle-password,
    .toggle-password-confirm {
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
    
    .toggle-password:hover,
    .toggle-password-confirm:hover {
        color: var(--primary);
    }
    
    .password-hint {
        font-size: 0.7rem;
        color: var(--gray);
        margin-top: 0.25rem;
        display: block;
    }
    
    .terms-checkbox {
        margin: 1rem 0;
    }
    
    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        font-size: 0.85rem;
        color: var(--dark);
        position: relative;
        padding-left: 5px;
    }
    
    .checkbox-label input {
        display: none;
    }
    
    .checkmark {
        width: 18px;
        height: 18px;
        border: 2px solid var(--gray-light);
        border-radius: 4px;
        display: inline-block;
        position: relative;
        transition: var(--transition);
    }
    
    .checkbox-label input:checked + .checkmark {
        background: var(--primary);
        border-color: var(--primary);
    }
    
    .checkbox-label input:checked + .checkmark::after {
        content: '\f00c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 10px;
    }
    
    .btn-signup {
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
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    
    .btn-signup:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px var(--primary-glow);
    }
    
    .btn-signup:active {
        transform: translateY(0);
    }
    
    .btn-signup:disabled {
        opacity: 0.7;
        transform: none;
        cursor: not-allowed;
    }
    
    .login-link a {
        text-decoration: none;
        transition: var(--transition);
    }
    
    .login-link a:hover {
        text-decoration: underline;
    }
    
    .text-primary {
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
    
    /* Valid input styling */
    .form-control.is-valid {
        border-color: var(--success) !important;
    }
    
    /* Responsive */
    @media (max-width: 576px) {
        #uni_modal .modal-body {
            padding: 1.5rem !important;
        }
        
        .signup-title {
            font-size: 1.3rem;
        }
        
        .signup-icon-wrapper {
            width: 55px;
            height: 55px;
        }
        
        .signup-icon-wrapper i {
            font-size: 1.8rem;
        }
        
        .row.g-3 {
            --bs-gutter-y: 0;
        }
    }
    
    /* Loading state */
    .btn-signup.loading {
        pointer-events: none;
    }
    
    .btn-signup.loading i {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<script>
    $(document).ready(function() {
        // Toggle password visibility
        $('.toggle-password').click(function() {
            const passwordInput = $('#signup-password');
            const icon = $(this).find('i');
            
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
        
        $('.toggle-password-confirm').click(function() {
            const confirmInput = $('#confirm-password');
            const icon = $(this).find('i');
            
            if (confirmInput.attr('type') === 'password') {
                confirmInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                confirmInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
        
        // Auto-focus on first field
        $('input[name="first_name"]').focus();
        
        // Remove invalid class on input
        $('.form-control').on('input', function() {
            $(this).removeClass('is-invalid');
        });
        
        // Switch to login modal
        $('#switch-to-login').click(function() {
            const redirect = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home'; ?>';
            $('#uni_modal').modal('hide');
            setTimeout(() => {
                uni_modal("Login", 'login.php?redirect=' + encodeURIComponent(redirect));
            }, 300);
        });
        
        // Real-time password validation
        $('#signup-password, #confirm-password').on('input', function() {
            const password = $('#signup-password').val();
            const confirm = $('#confirm-password').val();
            
            if (password.length >= 6 && password === confirm) {
                $('#confirm-password').removeClass('is-invalid').addClass('is-valid');
            } else if (confirm.length > 0) {
                $('#confirm-password').removeClass('is-valid').addClass('is-invalid');
            } else {
                $('#confirm-password').removeClass('is-invalid is-valid');
            }
        });
    });
    
    $('#signup-frm').submit(function(e) {
        e.preventDefault();
        
        const $btn = $('#signup-frm button[type="submit"]');
        const originalHtml = $btn.html();
        $btn.html('<i class="fas fa-spinner fa-pulse"></i> Creating account...').prop('disabled', true).addClass('loading');
        
        // Remove any existing alerts
        $(this).find('.alert-custom').remove();
        
        // Client-side validation
        let isValid = true;
        const firstName = $('input[name="first_name"]').val().trim();
        const lastName = $('input[name="last_name"]').val().trim();
        const mobile = $('input[name="mobile"]').val().trim();
        const address = $('textarea[name="address"]').val().trim();
        const email = $('input[name="email"]').val().trim();
        const password = $('#signup-password').val();
        const confirmPassword = $('#confirm-password').val();
        const termsAccepted = $('#terms').is(':checked');
        
        // Required fields validation
        if (!firstName) { $('input[name="first_name"]').addClass('is-invalid'); isValid = false; }
        if (!lastName) { $('input[name="last_name"]').addClass('is-invalid'); isValid = false; }
        if (!mobile) { $('input[name="mobile"]').addClass('is-invalid'); isValid = false; }
        if (!address) { $('textarea[name="address"]').addClass('is-invalid'); isValid = false; }
        if (!email) { $('input[name="email"]').addClass('is-invalid'); isValid = false; }
        
        // Email format validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email)) {
            $('input[name="email"]').addClass('is-invalid');
            $('#signup-frm').prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Please enter a valid email address.</div>');
            $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
            return;
        }
        
        // Phone validation (basic)
        const phoneRegex = /^[\d\s\-+()]{8,15}$/;
        if (mobile && !phoneRegex.test(mobile)) {
            $('input[name="mobile"]').addClass('is-invalid');
            $('#signup-frm').prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Please enter a valid contact number.</div>');
            $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
            return;
        }
        
        // Password validation
        if (password.length < 6) {
            $('#signup-password').addClass('is-invalid');
            $('#signup-frm').prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Password must be at least 6 characters.</div>');
            $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
            return;
        }
        
        if (password !== confirmPassword) {
            $('#confirm-password').addClass('is-invalid');
            $('#signup-frm').prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Passwords do not match.</div>');
            $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
            return;
        }
        
        if (!termsAccepted) {
            $('#signup-frm').prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Please agree to the Terms of Service.</div>');
            $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
            return;
        }
        
        if (!isValid) {
            $('#signup-frm').prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Please fill in all required fields.</div>');
            $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
            return;
        }
        
        $.ajax({
            url: 'admin/ajax.php?action=signup',
            method: 'POST',
            data: $(this).serialize(),
            error: function(err) {
                console.error(err);
                $('#signup-frm').prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Connection error. Please try again.</div>');
                $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
            },
            success: function(resp) {
                if (resp == 1) {
                    $btn.html('<i class="fas fa-check-circle"></i> Account created! Redirecting...');
                    setTimeout(function() {
                        location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home'; ?>';
                    }, 1000);
                } else if (resp == 2) {
                    $('#signup-frm').prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Email address already exists. Please use a different email.</div>');
                    $('input[name="email"]').addClass('is-invalid');
                    $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
                } else {
                    $('#signup-frm').prepend('<div class="alert-custom"><i class="fas fa-exclamation-triangle"></i> Registration failed. Please try again.</div>');
                    $btn.html(originalHtml).prop('disabled', false).removeClass('loading');
                }
            }
        });
    });
</script>