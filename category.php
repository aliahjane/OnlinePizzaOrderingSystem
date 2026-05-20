<?php 
$cid= $_GET['id'] ?? "";
if(empty($cid)){
    throw new ErrorException("Error: This page requires a category ID.");
}
$category_qry = $conn->query("SELECT * FROM `category_list` where `id` = '{$cid}'");
if($category_qry->num_rows > 0){
    $data = $category_qry->fetch_assoc();
}else{
    throw new ErrorException("Error: This page requires a category ID.");
}
?>

<!-- Enhanced Masthead -->
<header class="masthead category-header">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-center mb-4 page-title">
                <div class="category-badge">
                    <i class="fas fa-tag"></i> Category
                </div>
                <h1 class="text-white"><?= htmlspecialchars($data['name'] ?? "") ?></h1>
                <div class="divider-wrapper">
                    <span class="divider-line"></span>
                    <i class="fas fa-utensils divider-icon"></i>
                    <span class="divider-line"></span>
                </div>
                <p class="text-white-50 mt-3">Explore our delicious <?= htmlspecialchars($data['name'] ?? "") ?> collection</p>
            </div>
        </div>
    </div>
    <div class="header-wave">
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
                <span class="title-cursive"><?= htmlspecialchars($data['name'] ?? "") ?>'s</span>
                <span class="title-bold">Menu</span>
            </h2>
            <div class="title-divider">
                <span class="divider-dot"></span>
                <span class="divider-line"></span>
                <i class="fas fa-pizza-slice divider-icon"></i>
                <span class="divider-line"></span>
                <span class="divider-dot"></span>
            </div>
            <p class="section-subtitle">Handcrafted with love, made fresh daily</p>
        </div>
        
        <div class="row g-4">
            <?php 
            include 'admin/db_connect.php';
            $limit = 8;
            $page = (isset($_GET['_page']) && $_GET['_page'] > 0) ? $_GET['_page'] - 1 : 0 ;
            $offset = $page > 0 ? $page * $limit : 0;
            $all_menu = $conn->query("SELECT id FROM product_list where `category_id` = '{$cid}'")->num_rows;
            $page_btn_count = ceil($all_menu / $limit);
            $qry = $conn->query("SELECT * FROM product_list where `category_id` = '{$cid}' order by `name` asc Limit $limit OFFSET $offset ");
            
            if($qry->num_rows > 0):
                while($row = $qry->fetch_assoc()):
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
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
                                <button class="btn-add-cart view_prod" data-id="<?php echo $row['id'] ?>">
                                    <i class="fas fa-shopping-cart"></i> Order Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                endwhile;
            else:
            ?>
            <div class="col-12">
                <div class="empty-menu text-center py-5">
                    <i class="fas fa-utensils fa-4x text-muted mb-3 d-block"></i>
                    <h4>No items found</h4>
                    <p class="text-muted">This category has no menu items yet. Check back soon!</p>
                    <a href="./" class="btn btn-primary mt-2">Browse All Categories</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Enhanced Pagination -->
        <?php if($page_btn_count > 1): ?>
        <div class="pagination-wrapper mt-5">
            <div class="pagination-container">
                <ul class="pagination">
                    <!-- Previous Button -->
                    <li class="page-item <?php echo ($page == 0) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="./?_page=<?php echo ($page) ?>&id=<?php echo $cid ?>">
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
                            if($i == 1 || $i == $page_btn_count || ($i >= $page - 2 && $i <= $page + 4)) {
                                $showPage = true;
                            }
                        }
                        ?>
                        <?php if($showPage): ?>
                            <li class="page-item <?php echo ($i == ($page + 1)) ? 'active' : ''; ?>">
                                <a class="page-link" href="./?_page=<?php echo $i ?>&id=<?php echo $cid ?>"><?php echo $i; ?></a>
                            </li>
                        <?php elseif($i == 2 || $i == $page_btn_count - 1): ?>
                            <li class="page-item disabled">
                                <span class="page-link dots">...</span>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    
                    <!-- Next Button -->
                    <li class="page-item <?php echo (($page+1) == $page_btn_count) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="./?_page=<?php echo ($page+2) ?>&id=<?php echo $cid ?>">
                            Next <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<style>
    /* ========== PREMIUM CATEGORY PAGE DESIGN ========== */
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
        --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.15);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Header Styling */
    .category-header {
        position: relative;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, var(--primary) 100%);
        background-size: 200% 200%;
        animation: gradientShift 15s ease infinite;
        height: 45vh !important;
        min-height: 350px;
        overflow: hidden;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .category-badge {
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
    }

    .category-header h1 {
        font-size: 3.5rem;
        font-weight: 800;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

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

    .header-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        line-height: 0;
        z-index: 2;
    }

    /* Section Styling */
    .menu-section {
        padding: 4rem 0;
        background: #f8f9fc;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 2.5rem;
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

    /* Menu Card */
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

    .btn-add-cart {
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

    .btn-add-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px var(--primary-glow);
    }

    /* Pagination Styling */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
    }

    .pagination {
        gap: 8px;
        flex-wrap: wrap;
    }

    .page-item {
        list-style: none;
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

    /* Responsive */
    @media (max-width: 768px) {
        .category-header h1 { font-size: 2rem; }
        .category-header { min-height: 280px; }
        .section-title { font-size: 1.8rem; }
        .menu-price { font-size: 1.1rem; }
        .page-link { padding: 6px 12px; font-size: 0.85rem; }
    }

    @media (max-width: 576px) {
        .category-header h1 { font-size: 1.6rem; }
        .section-title { font-size: 1.5rem; }
        .menu-title { font-size: 1rem; }
        .pagination { gap: 4px; }
        .page-link { padding: 4px 10px; font-size: 0.75rem; }
    }

    /* Animation */
    @keyframes fadeSlideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .menu-card {
        animation: fadeSlideUp 0.4s ease-out;
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