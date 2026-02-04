<?php include 'app/views/share/header.php'; ?>

<div class="card-custom p-4 mb-5 animate__animated animate__fadeInDown">
    <div class="row align-items-center g-3">
        <div class="col-md-3">
            <h4 class="mb-0 fw-bold text-dark"><i class="fa-solid fa-cubes-stacked text-primary me-2"></i>Kho Hàng</h4>
        </div>
        
        <div class="col-md-5">
            <form action="<?= WEB_ROOT ?>/Product/list" method="GET" class="position-relative">
                <input type="text" name="keyword" class="form-control ps-5" placeholder="Bạn muốn tìm gì hôm nay..." 
                       value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                <button class="btn border-0 position-absolute top-50 start-0 translate-middle-y ms-2 text-muted" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <div class="col-md-4 d-flex justify-content-end gap-2">
            <div class="dropdown">
                <button class="btn btn-light text-primary fw-bold dropdown-toggle px-4 py-2 rounded-pill shadow-sm" type="button" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-arrow-down-short-wide me-1"></i> Sắp xếp
                </button>
                <ul class="dropdown-menu border-0 shadow rounded-4 p-2">
                    <li><a class="dropdown-item rounded-3 mb-1" href="<?= WEB_ROOT ?>/Product/list?sort=price-asc"><i class="fa-solid fa-arrow-up-1-9 me-2 text-success"></i>Giá tăng dần</a></li>
                    <li><a class="dropdown-item rounded-3 mb-1" href="<?= WEB_ROOT ?>/Product/list?sort=price-desc"><i class="fa-solid fa-arrow-down-9-1 me-2 text-danger"></i>Giá giảm dần</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item rounded-3" href="<?= WEB_ROOT ?>/Product/list?sort=name-asc"><i class="fa-solid fa-font me-2 text-info"></i>Tên A-Z</a></li>
                </ul>
            </div>
            <a href="<?= WEB_ROOT ?>/Product/add" class="btn btn-dark rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;" title="Thêm mới">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>
</div>

<?php if (empty($products)): ?>
    <div class="text-center py-5 animate__animated animate__fadeIn">
        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" width="150" alt="Empty" class="mb-3 opacity-75">
        <h5 class="text-muted fw-bold">Chưa tìm thấy sản phẩm nào!</h5>
        <a href="<?= WEB_ROOT ?>/Product/list" class="btn btn-outline-primary rounded-pill px-4 mt-2">Làm mới bộ lọc</a>
    </div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($products as $index => $product): ?>
            <div class="col animate__animated animate__fadeInUp" style="animation-delay: <?= $index * 0.1 ?>s">
                <div class="card-custom h-100 position-relative group-product">
                    <span class="position-absolute top-0 end-0 m-3 badge-hot text-white small fw-bold z-2">HOT</span>

                    <div class="overflow-hidden p-4 d-flex align-items-center justify-content-center bg-white" style="height: 240px; border-radius: 20px 20px 0 0;">
                        <img src="<?= $product->getImage() ?>" class="img-fluid product-img transition-img" 
                             alt="<?= $product->getName() ?>" 
                             onerror="this.src='https://placehold.co/600x400?text=No+Image'">
                        
                        <div class="overlay-actions d-flex gap-2">
                            <button class="btn btn-light rounded-circle shadow text-primary" 
                                    onclick='showQuickView(<?= json_encode([
                                        "name" => $product->getName(),
                                        "price" => number_format($product->getPrice(), 0, ',', '.'),
                                        "desc" => $product->getDescription(),
                                        "image" => $product->getImage()
                                    ]) ?>)' title="Xem nhanh">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                            <a href="<?= WEB_ROOT ?>/Product/edit/<?= $product->getId() ?>" class="btn btn-light rounded-circle shadow text-warning" title="Sửa">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold text-dark text-truncate mb-1 px-2"><?= $product->getName() ?></h6>
                        <div class="small text-warning mb-2">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <h5 class="text-primary fw-bold"><?= number_format($product->getPrice(), 0, ',', '.') ?> <small>₫</small></h5>
                    </div>

                    <div class="card-footer bg-white border-0 pb-4 pt-0">
                        <button class="btn btn-outline-danger w-100 rounded-pill fw-bold btn-sm py-2" 
                                onclick="deleteProduct(<?= $product->getId() ?>)">
                            <i class="fa-regular fa-trash-can me-1"></i> Xóa
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
            <div class="modal-body p-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3 bg-white p-2 rounded-circle shadow-sm" data-bs-dismiss="modal"></button>
                <div class="row g-0">
                    <div class="col-md-6 bg-light d-flex align-items-center justify-content-center p-5">
                        <img id="modal-img" src="" class="img-fluid" style="max-height: 300px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
                    </div>
                    <div class="col-md-6 p-5">
                        <span class="badge bg-primary bg-opacity-10 text-primary mb-2 px-3 py-2 rounded-pill">Sản phẩm nổi bật</span>
                        <h3 id="modal-title" class="fw-bold text-dark mb-2"></h3>
                        <h2 id="modal-price" class="text-primary fw-bold mb-4"></h2>
                        <h6 class="fw-bold text-muted text-uppercase small">Mô tả sản phẩm</h6>
                        <p id="modal-desc" class="text-muted small" style="line-height: 1.6;"></p>
                        <button class="btn btn-dark w-100 rounded-pill mt-4 py-2 fw-bold" data-bs-dismiss="modal">Đóng cửa sổ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS Riêng cho trang List */
    .transition-img { transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .group-product:hover .transition-img { transform: scale(1.1) translateY(-10px); }
    
    .overlay-actions {
        position: absolute; bottom: 50%; left: 0; right: 0;
        transform: translateY(50%);
        justify-content: center;
        opacity: 0; transition: all 0.3s ease;
    }
    .group-product:hover .overlay-actions { opacity: 1; }
    .overlay-actions .btn { transform: translateY(20px); transition: 0.3s; }
    .group-product:hover .overlay-actions .btn { transform: translateY(0); }
</style>

<script>
    // Logic JS giữ nguyên
    function deleteProduct(id) {
        Swal.fire({
            title: 'Xóa sản phẩm này?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Xóa ngay',
            cancelButtonText: 'Giữ lại',
            background: '#fff',
            borderRadius: '20px'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= WEB_ROOT ?>/Product/delete/' + id;
            }
        })
    }

    function showQuickView(data) {
        document.getElementById('modal-title').innerText = data.name;
        document.getElementById('modal-price').innerText = data.price + ' ₫';
        document.getElementById('modal-desc').innerText = data.desc ? data.desc : 'Chưa có mô tả chi tiết.';
        document.getElementById('modal-img').src = data.image;
        var myModal = new bootstrap.Modal(document.getElementById('quickViewModal'));
        myModal.show();
    }
    
    <?php if (isset($_SESSION['toast_msg'])): ?>
        Swal.fire({
            toast: true, position: 'top-end', showConfirmButton: false, timer: 3000,
            icon: '<?= $_SESSION['toast_msg']['type'] ?>',
            title: '<?= $_SESSION['toast_msg']['message'] ?>',
            timerProgressBar: true
        });
        <?php unset($_SESSION['toast_msg']); ?>
    <?php endif; ?>
</script>

<?php include 'app/views/share/footer.php'; ?>