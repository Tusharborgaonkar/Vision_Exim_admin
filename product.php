<?php
require_once __DIR__ . '/includes/product-functions.php';

$slug = trim($_GET['slug'] ?? '');
$product = ve_get_product_by_slug($slug);

if (!$product) {
    http_response_code(404);
    $page_title = 'Product Not Found | Vision Exim';
    include 'includes/header.php';
    include 'includes/navbar.php';
    ?>
    <section class="inner_banner banner-products">
        <div class="container text-center py-5">
            <h2>Product Not Found</h2>
            <p class="mt-3">This product may be unpublished or the link is incorrect.</p>
            <a href="/vision_exim/our-products.php" class="hero-btn mt-4 d-inline-block">Browse Products</a>
        </div>
    </section>
    <?php
    include 'includes/footer.php';
    exit;
}

$page_title = !empty($product['seo_title'])
    ? $product['seo_title']
    : htmlspecialchars($product['name']) . ' | Vision Exim';

$product_name = $product['name'];
$product_image = ve_product_image_url($product['image'] ?? null);
$product_url = 'http' . ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 's' : '') . '://'
    . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ve_product_url($product['slug']);
$description = !empty($product['full_description'])
    ? $product['full_description']
    : ($product['short_description'] ?? '');
$wa_text = rawurlencode("Hello,\nI want to know about the product {$product_name}.\n\n{$product_url}");

include 'includes/header.php';
include 'includes/navbar.php';
?>

<section class="inner_banner banner-products">
    <div class="container">
        <div class="title text-center">
            <h2><?php include __DIR__ . '/includes/product-butterfly-svg.php'; ?> <?= htmlspecialchars($product_name) ?></h2>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="/vision_exim/index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="/vision_exim/our-products.php">Our Products</a></li>
                <?php if (!empty($product['category_name'])): ?>
                <li class="breadcrumb-item"><?= htmlspecialchars($product['category_name']) ?></li>
                <?php endif; ?>
                <li class="breadcrumb-item"><?= htmlspecialchars($product_name) ?></li>
            </ol>
        </nav>
    </div>
</section>

<img src="https://morisoverseas.com/images/top-shape.png" alt="" class="d-block min-vw-100">

<section class="product-details-section bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12" data-aos="fade-right">
                <div class="product-detail-img">
                    <div class="product-detail-img-inner">
                        <img src="<?= htmlspecialchars($product_image) ?>" alt="<?= htmlspecialchars($product_name) ?>">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12" data-aos="fade-left">
                <div class="title">
                    <h2><?php include __DIR__ . '/includes/product-butterfly-svg.php'; ?> <?= htmlspecialchars($product_name) ?></h2>
                </div>
                <div class="product-detail-btn">
                    <a class="btn mail-btn" href="#InqueryModal" data-bs-toggle="modal">Inquire Via Mail</a>
                    <a class="btn whatsApp-btn" href="https://wa.me/+919737075734?text=<?= $wa_text ?>">Inquiry Via WhatsApp</a>
                </div>
                <div class="product-detail-content">
                    <?php if (!empty($product['short_description'])): ?>
                    <p class="fw-semibold"><?= nl2br(htmlspecialchars($product['short_description'])) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($description)): ?>
                    <p><?= nl2br(htmlspecialchars($description)) ?></p>
                    <?php endif; ?>
                    <ul class="list-unstyled mt-4 mb-0">
                        <?php if (!empty($product['hs_code'])): ?>
                        <li class="mb-2"><strong>HS Code:</strong> <?= htmlspecialchars($product['hs_code']) ?></li>
                        <?php endif; ?>
                        <?php if (!empty($product['moq'])): ?>
                        <li class="mb-2"><strong>MOQ:</strong> <?= htmlspecialchars($product['moq']) ?></li>
                        <?php endif; ?>
                        <?php if (!empty($product['packaging'])): ?>
                        <li class="mb-2"><strong>Packaging:</strong> <?= htmlspecialchars($product['packaging']) ?></li>
                        <?php endif; ?>
                        <?php if (!empty($product['quality_standard'])): ?>
                        <li class="mb-2"><strong>Quality:</strong> <?= htmlspecialchars($product['quality_standard']) ?></li>
                        <?php endif; ?>
                        <?php if (!empty($product['origin_state'])): ?>
                        <li class="mb-2"><strong>Origin:</strong> <?= htmlspecialchars($product['origin_state']) ?><?= !empty($product['origin_country']) ? ', ' . htmlspecialchars($product['origin_country']) : '' ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade inquery-modal" id="InqueryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="needs-validation" id="productenq_form" novalidate method="post">
                <input type="hidden" name="sendEmail" value="ok" />
                <input type="hidden" name="productname" value="<?= htmlspecialchars($product_name) ?>">
                <div class="inquiry_heading">
                    <h2>Inquiry Now</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="emailMsg"></div>
                <div class="form-feild"><input type="text" name="name" class="form-control" placeholder="Full Name*" required /></div>
                <div class="form-feild"><input type="email" name="email" class="form-control" placeholder="Email Address*" required /></div>
                <div class="form-feild"><input type="text" name="phone" class="form-control" placeholder="Phone Number" required /></div>
                <div class="form-feild"><textarea class="form-control" name="message" placeholder="Message"></textarea></div>
                <div class="form-submit">
                    <button type="submit" class="btn" id="btn_submit"><span>Submit</span></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="logo_shapewrp">
    <img src="https://morisoverseas.com/images/bottom-shape.png" alt="" class="d-block min-vw-100">
</div>

<?php include 'includes/footer.php'; ?>
