<?php include 'app/views/share/header.php'; ?>

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h1 class="display-6 fw-bold text-primary">DANH SÁCH SẢN PHẨM</h1>
        <div class="row mb-4">
    <div class="col-md-6 mx-auto">
        <form action="<?= WEB_ROOT ?>/Product/list" method="GET" class="d-flex shadow-sm">
            <input type="text" name="keyword" class="form-control form-control-lg border-0 rounded-start" 
                   placeholder="Tìm kiếm sản phẩm..." 
                   value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
            <button class="btn btn-primary px-4 rounded-end" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <?php if(isset($_GET['keyword'])): ?>
                <a href="<?= WEB_ROOT ?>/Product/list" class="btn btn-outline-secondary ms-2 rounded">
                    X
                </a>
            <?php endif; ?>
        </form>
    </div>
</div>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?= WEB_ROOT ?>/Product/add" class="btn btn-success btn-lg shadow">
            <i class="fa-solid fa-circle-plus"></i> + Thêm mới
        </a>
    </div>
</div>

<?php if (empty($products)): ?>
    <div class="alert alert-warning text-center py-5">
        <h4><i class="fa-solid fa-box-open"></i> Kho hàng đang trống!</h4>
        <p>Hãy bấm nút thêm mới để bắt đầu bán hàng.</p>
    </div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0 hover-effect">
                    <div style="height: 250px; overflow: hidden;" class="bg-light d-flex align-items-center justify-content-center">
                        <img src="<?= $product->getImage() ?>" class="card-img-top" alt="Ảnh sản phẩm" 
                             style="width: 100%; height: 100%; object-fit: contain; mix-blend-mode: multiply;"
                             onerror="this.src='https://placehold.co/600x400?text=Lỗi+Ảnh'">
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold text-truncate"><?= $product->getName() ?></h5>
                        <p class="card-text text-muted small text-truncate"><?= $product->getDescription() ?></p>
                        <h4 class="text-danger fw-bold mt-3">
                            <?= number_format($product->getPrice(), 0, ',', '.') ?> ₫
                        </h4>
                    </div>
                    <div class="card-footer bg-white border-top-0 d-flex justify-content-between py-3">
                        <a href="<?= WEB_ROOT ?>/Product/edit/<?= $product->getId() ?>" class="btn btn-outline-warning w-45">
                            Sửa
                        </a>
                        <a href="<?= WEB_ROOT ?>/Product/delete/<?= $product->getId() ?>" 
                           class="btn btn-outline-danger w-45"
                           onclick="deleteProduct(<?= $product->getId() ?>); return false;">
                            Xóa
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<script>
    function deleteProduct(id) {
        Swal.fire({
            title: 'Chắc chắn chưa bro?',
            text: "Xóa là mất luôn đấy, không lấy lại được đâu!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok, xóa đi!',
            cancelButtonText: 'Thôi, giữ lại'
        }).then((result) => {
            if (result.isConfirmed) {
                // Nếu bấm Ok thì chuyển hướng đến hàm delete
                window.location.href = '<?= WEB_ROOT ?>/Product/delete/' + id;
            }
        })
    }
</script>

<?php include 'app/views/share/footer.php'; ?>
