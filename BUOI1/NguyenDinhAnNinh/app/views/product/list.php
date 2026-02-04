<?php include 'app/views/share/header.php'; ?>

<div class="card shadow-sm mb-4 border-0">
    <div class="card-body p-3">
        <div class="row align-items-center">
            <div class="col-md-3">
                <h4 class="mb-0 text-primary fw-bold"><i class="fa-solid fa-layer-group"></i> SẢN PHẨM</h4>
            </div>

            <div class="col-md-5">
                <form action="<?= WEB_ROOT ?>/Product/list" method="GET">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Tìm tên sản phẩm..." 
                               value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>

            <div class="col-md-4 d-flex justify-content-end gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-arrow-down-short-wide"></i> Sắp xếp
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= WEB_ROOT ?>/Product/list?sort=price-asc">Giá: Thấp -> Cao</a></li>
                        <li><a class="dropdown-item" href="<?= WEB_ROOT ?>/Product/list?sort=price-desc">Giá: Cao -> Thấp</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= WEB_ROOT ?>/Product/list?sort=name-asc">Tên: A -> Z</a></li>
                    </ul>
                </div>
                <a href="<?= WEB_ROOT ?>/Product/add" class="btn btn-success fw-bold shadow-sm">
                    <i class="fa-solid fa-plus"></i> Thêm Mới
                </a>
            </div>
        </div>
    </div>
</div>

<?php if (empty($products)): ?>
    <div class="text-center py-5">
        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="120" alt="Empty">
        <h4 class="mt-3 text-muted">Không tìm thấy sản phẩm nào!</h4>
        <a href="<?= WEB_ROOT ?>/Product/list" class="btn btn-outline-primary mt-2">Xóa bộ lọc</a>
    </div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0 product-card">
                <span class="position-absolute top-0 end-0 badge bg-danger m-2 shadow-sm z-3">
                    HOT
                </span>

                    <div class="position-relative overflow-hidden group-hover-img">
                        <img src="<?= $product->getImage() ?>" class="card-img-top p-3" alt="..." 
                             style="height: 220px; object-fit: contain; transition: transform 0.3s;"
                             onerror="this.src='https://placehold.co/600x400?text=No+Image'">
                        
                        <div class="overlay-btns d-flex justify-content-center align-items-center gap-2">
                            <button class="btn btn-light rounded-circle shadow-sm" 
                                    onclick='showQuickView(<?= json_encode([
                                        "name" => $product->getName(),
                                        "price" => number_format($product->getPrice(), 0, ',', '.'),
                                        "desc" => $product->getDescription(),
                                        "image" => $product->getImage()
                                    ]) ?>)' 
                                    title="Xem nhanh">
                                <i class="fa-regular fa-eye text-dark"></i>
                            </button>
                            <a href="<?= WEB_ROOT ?>/Product/edit/<?= $product->getId() ?>" class="btn btn-light rounded-circle shadow-sm" title="Sửa">
                                <i class="fa-solid fa-pen text-warning"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold text-dark text-truncate mb-1"><?= $product->getName() ?></h6>
                        <div class="text-warning small mb-2">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <h5 class="text-primary fw-bold mb-0">
                            <?= number_format($product->getPrice(), 0, ',', '.') ?> ₫
                        </h5>
                    </div>
                    
                    <div class="card-footer bg-white border-top-0 pb-3">
                        <button class="btn btn-outline-danger w-100 rounded-pill" 
                                onclick="deleteProduct(<?= $product->getId() ?>)">
                            <i class="fa-solid fa-trash"></i> Xóa sản phẩm
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-body p-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal"></button>
                <div class="row g-0">
                    <div class="col-md-6 bg-light d-flex align-items-center justify-content-center p-4">
                        <img id="modal-img" src="" class="img-fluid" style="max-height: 350px;">
                    </div>
                    <div class="col-md-6 p-5">
                        <h3 id="modal-title" class="fw-bold text-primary mb-3"></h3>
                        <h2 id="modal-price" class="text-danger fw-bold mb-4"></h2>
                        <p class="text-muted mb-4">Mô tả sản phẩm:</p>
                        <p id="modal-desc" class="fs-6 text-dark border-start border-4 border-warning ps-3"></p>
                        <div class="d-grid mt-5">
                            <button class="btn btn-dark btn-lg" data-bs-dismiss="modal">Đóng cửa sổ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .product-card { transition: all 0.3s ease; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
    .group-hover-img:hover img { transform: scale(1.1); }
    
    /* Ẩn hiện nút bấm khi hover */
    .overlay-btns {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.1);
        opacity: 0; transition: opacity 0.3s;
    }
    .group-hover-img:hover .overlay-btns { opacity: 1; }
</style>

<script>
    // 1. Hàm Xóa (Giữ nguyên logic cũ của cậu)
    function deleteProduct(id) {
        Swal.fire({
            title: 'Xóa thật hả?',
            text: "Không khôi phục được đâu nhé!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Xóa luôn!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= WEB_ROOT ?>/Product/delete/' + id;
            }
        })
    }

    // 2. Hàm Hiện Quick View
    function showQuickView(data) {
        document.getElementById('modal-title').innerText = data.name;
        document.getElementById('modal-price').innerText = data.price + ' ₫';
        document.getElementById('modal-desc').innerText = data.desc ? data.desc : 'Chưa có mô tả chi tiết.';
        document.getElementById('modal-img').src = data.image;
        
        var myModal = new bootstrap.Modal(document.getElementById('quickViewModal'));
        myModal.show();
    }

    // 3. Hàm Hiện Toast Thông Báo (Gọi từ Session PHP)
    <?php if (isset($_SESSION['toast_msg'])): ?>
        const Toast = Swal.mixin({
            toast: true, position: 'top-end', showConfirmButton: false, timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: '<?= $_SESSION['toast_msg']['type'] ?>',
            title: '<?= $_SESSION['toast_msg']['message'] ?>'
        })
        <?php unset($_SESSION['toast_msg']); ?>
    <?php endif; ?>
</script>

<?php include 'app/views/share/footer.php'; ?>