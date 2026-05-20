<!-- Enhanced Masthead / Hero Section -->
<header class="masthead hero-section">
    <div class="hero-overlay"></div>
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-center mb-4 page-title">
                <div class="hero-badge">
                    <i class="fas fa-store"></i> Since 2020
                </div>
                <h1 class="hero-title">Welcome to <span class="text-gradient"><?php echo htmlspecialchars($_SESSION['setting_name']); ?></span></h1>
                <div class="hero-divider">
                    <span class="divider-line"></span>
                    <i class="fas fa-utensils divider-icon"></i>
                    <span class="divider-line"></span>
                </div>
                <p class="hero-subtitle">Experience the finest flavors crafted with passion and served with love</p>
                <a class="btn-order-now js-scroll-trigger" href="#menu">
                    <span>Order Now</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="hero-wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120">
            <path fill="#ffffff" fill-opacity="1" d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,42.7C672,32,768,32,864,48C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</header>

<!-- Enhanced Menu Section -->
<section class="page-section menu-section" id="menu">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">
                <span class="title-cursive">Our</span>
                <span class="title-bold">Signature Menu</span>
            </h2>
            <div class="title-divider">
                <span class="divider-dot"></span>
                <span class="divider-line"></span>
                <i class="fas fa-pizza-slice divider-icon"></i>
                <span class="divider-line"></span>
                <span class="divider-dot"></span>
            </div>
            <p class="section-subtitle">Handcrafted with love, made fresh daily using premium ingredients</p>
        </div>
        
        <div class="menu-grid">
            <?php 
                include 'admin/db_connect.php';
                $limit = 8;
                $page = (isset($_GET['_page']) && $_GET['_page'] > 0) ? $_GET['_page'] - 1 : 0 ;
                $offset = $page > 0 ? $page * $limit : 0;
                $all_menu = $conn->query("SELECT id FROM product_list")->num_rows;
                $page_btn_count = ceil($all_menu / $limit);
                $qry = $conn->query("SELECT * FROM product_list ORDER BY `name` ASC LIMIT $limit OFFSET $offset");
                
                if($qry->num_rows > 0):
                    while($row = $qry->fetch_assoc()):
            ?>
            <div class="menu-card">
                <div class="menu-card-inner">
                    <div class="menu-image-wrapper">
                        <img src="assets/img/<?php echo htmlspecialchars($row['img_path']) ?>" alt="<?php echo htmlspecialchars($row['name']) ?>" class="menu-image">
                        <div class="menu-overlay">
                            <button class="btn-view view_prod" data-id="<?php echo $row['id'] ?>">
                                <i class="fas fa-eye"></i> Quick View
                            </button>
                        </div>
                    </div>
                    <div class="menu-content">
                        <div class="menu-price">₱ <?php echo number_format($row['price'], 2) ?></div>
                        <h5 class="menu-title"><?php echo htmlspecialchars($row['name']) ?></h5>
                        <p class="menu-description"><?php echo htmlspecialchars(substr($row['description'], 0, 60)) . (strlen($row['description']) > 60 ? '...' : '') ?></p>
                        <div class="menu-actions">
                            <button class="btn-order view_prod" data-id="<?php echo $row['id'] ?>">
                                <i class="fas fa-shopping-cart"></i> Order Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                    endwhile;
                else:
            ?>
            <div class="col-12 text-center py-5">
                <div class="empty-menu">
                    <i class="fas fa-utensils fa-4x text-muted mb-3 d-block"></i>
                    <h4>No menu items found</h4>
                    <p class="text-muted">Please check back later for our delicious offerings.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Enhanced Pagination -->
        <?php if($page_btn_count > 1): ?>
        <div class="pagination-wrapper">
            <ul class="pagination">
                <!-- Previous Button -->
                <li class="page-item <?php echo ($page == 0) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="./?_page=<?php echo ($page) ?>">
                        <i class="fas fa-chevron-left"></i> Prev
                    </a>
                </li>
                
                <!-- Page Numbers -->
                <?php for($i = 1; $i <= $page_btn_count; $i++): ?>
                    <?php 
                    $showPage = false;
                    if($page_btn_count <= 7) {
                        $showPage = true;
                    } else {
                        if($i == 1 || $i == $page_btn_count || ($i >= $page && $i <= $page + 4)) {
                            $showPage = true;
                        }
                    }
                    ?>
                    <?php if($showPage): ?>
                        <li class="page-item <?php echo ($i == ($page + 1)) ? 'active' : ''; ?>">
                            <a class="page-link" href="./?_page=<?php echo $i ?>"><?php echo $i; ?></a>
                        </li>
                    <?php elseif($i == 2 || $i == $page_btn_count - 1): ?>
                        <li class="page-item disabled">
                            <span class="page-link dots">...</span>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
                
                <!-- Next Button -->
                <li class="page-item <?php echo (($page+1) == $page_btn_count) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="./?_page=<?php echo ($page+2) ?>">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</section>

<style>
    /* ========== PREMIUM HOMEPAGE DESIGN ========== */
    :root {
        --primary: #ff6b35;
        --primary-dark: #e85d2c;
        --primary-light: #ff8a5c;
        --primary-glow: rgba(255, 107, 53, 0.3);
        --secondary: #667eea;
        --dark: #1a1a2e;
        --light: #f8f9fa;
        --gray: #6c757d;
        --shadow-sm: 0 5px 20px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.12);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        height: 90vh !important;
        min-height: 600px;
        overflow: hidden;
        display: flex;
        align-items: center;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2000 2000"><circle cx="500" cy="300" r="200" fill="rgba(255,255,255,0.03)"/><circle cx="1500" cy="500" r="300" fill="rgba(255,255,255,0.02)"/><circle cx="1000" cy="800" r="150" fill="rgba(255,255,255,0.04)"/></svg>');
        background-repeat: no-repeat;
        background-size: cover;
    }
    
    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        color: white;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: fadeInUp 0.6s ease-out;
    }
    
    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1rem;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.6s ease-out 0.1s both;
    }
    
    .text-gradient {
        background: linear-gradient(135deg, #ff6b35, #ff8a5c, #ffb347);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    
    .hero-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin: 1.5rem 0;
        animation: fadeInUp 0.6s ease-out 0.2s both;
    }
    
    .hero-divider .divider-line {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #ff6b35, transparent);
        border-radius: 3px;
    }
    
    .hero-divider .divider-icon {
        font-size: 1.5rem;
        color: #ff6b35;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.85);
        max-width: 600px;
        margin: 0 auto 2rem;
        animation: fadeInUp 0.6s ease-out 0.3s both;
    }
    
    .btn-order-now {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #ff6b35, #e85d2c);
        color: white;
        padding: 14px 35px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
        animation: fadeInUp 0.6s ease-out 0.4s both;
    }
    
    .btn-order-now:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(255, 107, 53, 0.5);
        color: white;
    }
    
    .btn-order-now i {
        transition: transform 0.3s;
    }
    
    .btn-order-now:hover i {
        transform: translateX(5px);
    }
    
    .hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        line-height: 0;
        z-index: 2;
    }
    
    /* Menu Section */
    .menu-section {
        padding: 5rem 0;
        background: #ffffff;
    }
    
    .section-header {
        margin-bottom: 3rem;
    }
    
    .section-title {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .title-cursive {
        font-family: 'Dancing Script', cursive;
        color: var(--primary);
        font-weight: 600;
    }
    
    .title-bold {
        color: var(--dark);
    }
    
    .title-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin: 1rem 0;
    }
    
    .title-divider .divider-line {
        width: 50px;
        height: 2px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
    }
    
    .title-divider .divider-dot {
        width: 8px;
        height: 8px;
        background: var(--primary);
        border-radius: 50%;
    }
    
    .title-divider .divider-icon {
        color: var(--primary);
        font-size: 1.2rem;
    }
    
    .section-subtitle {
        color: var(--gray);
        font-size: 1rem;
    }
    
    /* Menu Grid */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.8rem;
        margin-bottom: 3rem;
    }
    
    .menu-card {
        height: 100%;
        transition: var(--transition);
    }
    
    .menu-card-inner {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .menu-card:hover .menu-card-inner {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }
    
    .menu-image-wrapper {
        position: relative;
        overflow: hidden;
        padding-top: 100%;
        background: #f1f3f9;
    }
    
    .menu-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }
    
    .menu-card:hover .menu-image {
        transform: scale(1.08);
    }
    
    .menu-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition);
    }
    
    .menu-card:hover .menu-overlay {
        opacity: 1;
    }
    
    .btn-view {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 40px;
        font-weight: 600;
        transition: var(--transition);
        cursor: pointer;
    }
    
    .btn-view:hover {
        background: var(--primary-dark);
        transform: scale(1.05);
    }
    
    .menu-content {
        padding: 1.2rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .menu-price {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }
    
    .menu-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }
    
    .menu-description {
        font-size: 0.85rem;
        color: var(--gray);
        margin-bottom: 1rem;
        line-height: 1.4;
        flex-grow: 1;
    }
    
    .menu-actions {
        margin-top: auto;
    }
    
    .btn-order {
        width: 100%;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        padding: 10px;
        border-radius: 40px;
        font-weight: 600;
        transition: var(--transition);
        cursor: pointer;
    }
    
    .btn-order:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px var(--primary-glow);
    }
    
    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }
    
    .pagination {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        list-style: none;
        padding: 0;
    }
    
    .page-link {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 8px 16px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 40px;
        color: var(--dark);
        text-decoration: none;
        transition: var(--transition);
    }
    
    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-color: transparent;
        color: white;
    }
    
    .page-item:not(.disabled) .page-link:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        transform: translateY(-2px);
    }
    
    .page-item.disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .dots {
        cursor: default;
    }
    
    .dots:hover {
        background: white;
        color: var(--dark);
        transform: none;
    }
    
    /* Empty State */
    .empty-menu {
        padding: 4rem;
        background: white;
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
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
    
    .menu-card {
        animation: fadeInUp 0.4s ease-out;
        animation-fill-mode: both;
    }
    
    .menu-card:nth-child(1) { animation-delay: 0.05s; }
    .menu-card:nth-child(2) { animation-delay: 0.1s; }
    .menu-card:nth-child(3) { animation-delay: 0.15s; }
    .menu-card:nth-child(4) { animation-delay: 0.2s; }
    .menu-card:nth-child(5) { animation-delay: 0.25s; }
    .menu-card:nth-child(6) { animation-delay: 0.3s; }
    .menu-card:nth-child(7) { animation-delay: 0.35s; }
    .menu-card:nth-child(8) { animation-delay: 0.4s; }
    
    /* Responsive */
    @media (max-width: 992px) {
        .hero-title { font-size: 3rem; }
        .section-title { font-size: 2.2rem; }
        .menu-grid { grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); }
    }
    
    @media (max-width: 768px) {
        .hero-section { min-height: 500px; }
        .hero-title { font-size: 2rem; }
        .hero-subtitle { font-size: 0.95rem; }
        .btn-order-now { padding: 10px 25px; font-size: 0.95rem; }
        .section-title { font-size: 1.8rem; }
        .menu-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem; }
        .page-link { padding: 6px 12px; font-size: 0.85rem; }
    }
    
    @media (max-width: 576px) {
        .hero-title { font-size: 1.6rem; }
        .hero-badge { font-size: 0.7rem; }
        .menu-grid { grid-template-columns: 1fr; }
        .pagination { gap: 4px; }
        .page-link { padding: 4px 10px; font-size: 0.75rem; }
    }
</style>

<script>
    $('.view_prod').click(function(){
        uni_modal_right('Product Details', 'view_prod.php?id=' + $(this).attr('data-id'))
    })
</script>

<?php if(isset($_GET['_page'])): ?>
<script>
    $(function(){
        $('html, body').animate({
            scrollTop: $('#menu').offset().top - 80
        }, 500);
    })
</script>
<?php endif; ?>