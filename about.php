<!-- Masthead - Enhanced About Header -->
<header class="masthead about-header">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-center mb-4 page-title">
                <div class="about-badge">
                    <i class="fas fa-heart"></i> Our Story
                </div>
                <h1 class="text-white">About Us</h1>
                <div class="divider-wrapper">
                    <span class="divider-line"></span>
                    <i class="fas fa-utensils divider-icon"></i>
                    <span class="divider-line"></span>
                </div>
                <p class="text-white-50 mt-3">Discover the passion behind our delicious food</p>
            </div>
        </div>
    </div>
    <div class="header-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
            <path fill="#ffffff" fill-opacity="1" d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,42.7C672,32,768,32,864,48C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</header>

<!-- About Content Section - Enhanced -->
<section class="page-section about-section">
    <div class="container">
        <div class="about-content-wrapper">
            <div class="about-card">
                <div class="about-card-inner">
                    <?php echo html_entity_decode($_SESSION['setting_about_content']); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* ========== PREMIUM ABOUT US DESIGN ========== */
    :root {
        --primary: #ff6b35;
        --primary-dark: #e85d2c;
        --primary-light: #ff8a5c;
        --secondary: #667eea;
        --secondary-dark: #5a67d8;
        --dark: #1a1a2e;
        --light: #f8f9fa;
        --gray: #6c757d;
        --shadow-sm: 0 5px 20px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.15);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Header Styling */
    .about-header {
        position: relative;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #ff6b35 100%);
        background-size: 200% 200%;
        animation: gradientShift 15s ease infinite;
        height: 60vh !important;
        min-height: 450px;
        overflow: hidden;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .about-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 2000"><circle cx="500" cy="300" r="200" fill="rgba(255,255,255,0.05)"/><circle cx="1500" cy="500" r="300" fill="rgba(255,255,255,0.03)"/><circle cx="1000" cy="800" r="150" fill="rgba(255,255,255,0.04)"/></svg>');
        background-repeat: no-repeat;
        background-size: cover;
        pointer-events: none;
    }

    .about-header .page-title {
        position: relative;
        z-index: 2;
        animation: fadeInUp 0.8s ease-out;
    }

    .about-badge {
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
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .about-badge i {
        animation: heartbeat 1.5s ease infinite;
    }

    @keyframes heartbeat {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.15); }
    }

    .about-header h1 {
        font-size: 4rem;
        font-weight: 800;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    /* Custom Divider */
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

    /* Header Wave */
    .header-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        line-height: 0;
        z-index: 2;
    }

    .header-wave svg {
        width: 100%;
        height: auto;
    }

    /* About Section Styling */
    .about-section {
        padding: 5rem 0;
        background: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .about-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 0% 0%, rgba(102, 126, 234, 0.03) 0%, transparent 50%);
        pointer-events: none;
    }

    .about-content-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }

    .about-card {
        background: white;
        border-radius: 32px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        transition: var(--transition);
        position: relative;
    }

    .about-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 55px -15px rgba(0, 0, 0, 0.2);
    }

    .about-card-inner {
        padding: 3rem;
        animation: fadeSlideUp 0.6s ease-out;
    }

    @keyframes fadeSlideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Content Styling for dynamic content */
    .about-card-inner h1,
    .about-card-inner h2,
    .about-card-inner h3 {
        color: var(--dark);
        font-weight: 700;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .about-card-inner h1:first-child,
    .about-card-inner h2:first-child,
    .about-card-inner h3:first-child {
        margin-top: 0;
    }

    .about-card-inner p {
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 1.2rem;
        font-size: 1.05rem;
    }

    .about-card-inner img {
        max-width: 100%;
        border-radius: 20px;
        margin: 1.5rem 0;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }

    .about-card-inner img:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-lg);
    }

    .about-card-inner ul,
    .about-card-inner ol {
        margin: 1rem 0;
        padding-left: 1.5rem;
    }

    .about-card-inner li {
        color: #4a5568;
        line-height: 1.7;
        margin: 0.5rem 0;
    }

    .about-card-inner blockquote {
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        border-left: 4px solid var(--primary);
        padding: 1.5rem;
        border-radius: 16px;
        margin: 1.5rem 0;
        font-style: italic;
        color: var(--dark);
        box-shadow: var(--shadow-sm);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .about-header h1 {
            font-size: 3rem;
        }
        
        .about-card-inner {
            padding: 2rem;
        }
        
        .about-card-inner p {
            font-size: 1rem;
        }
    }

    @media (max-width: 768px) {
        .about-header {
            height: 50vh !important;
            min-height: 400px;
        }
        
        .about-header h1 {
            font-size: 2.2rem;
        }
        
        .about-badge {
            font-size: 0.75rem;
            padding: 6px 16px;
        }
        
        .divider-line {
            width: 40px;
        }
        
        .about-card-inner {
            padding: 1.5rem;
        }
        
        .about-section {
            padding: 3rem 0;
        }
    }

    @media (max-width: 576px) {
        .about-header h1 {
            font-size: 1.8rem;
        }
        
        .about-card-inner {
            padding: 1.2rem;
        }
        
        .about-card-inner p {
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .divider-wrapper {
            gap: 10px;
        }
        
        .divider-line {
            width: 30px;
        }
    }

    /* Decorative Elements */
    .about-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary), var(--primary));
        background-size: 200% 100%;
        animation: shimmer 3s ease infinite;
    }

    @keyframes shimmer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }
</style>

<script>
    $(document).ready(function() {
        // Add smooth reveal animation for content
        const aboutCard = $('.about-card');
        aboutCard.css('opacity', '0');
        
        setTimeout(() => {
            aboutCard.css('opacity', '1');
        }, 200);
        
        // Add parallax effect to header (optional)
        $(window).scroll(function() {
            const scrollPos = $(this).scrollTop();
            if (scrollPos < 600) {
                $('.about-header .page-title').css({
                    'transform': 'translateY(' + scrollPos * 0.15 + 'px)'
                });
            }
        });
        
        // Enhance images in dynamic content
        $('.about-card-inner img').each(function() {
            $(this).addClass('img-fluid').wrap('<div class="img-wrapper"></div>');
        });
        
        // Add copy to code blocks if any
        $('.about-card-inner pre').addClass('bg-light p-3 rounded-3 overflow-auto');
    });
</script>