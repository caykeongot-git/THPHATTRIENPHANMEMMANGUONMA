<?php include 'app/views/share/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <div class="card-custom p-5 animate__animated animate__zoomIn">
            <div class="text-center mb-4">
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-2 fw-bold">CREATE NEW</span>
                <h3 class="fw-bold text-dark">Thêm Sản Phẩm Mới</h3>
                <p class="text-muted small">Điền thông tin chi tiết để đăng bán sản phẩm</p>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger border-0 rounded-4 bg-danger bg-opacity-10 text-danger fw-bold mb-4">
                    <ul class="mb-0 ps-3"><?php foreach ($errors as $err) echo "<li>$err</li>"; ?></ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= WEB_ROOT ?>/Product/add">
                <div class="row g-4">
                    <div class="col-md-7">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control" id="nameInput" required placeholder="Tên sản phẩm">
                            <label for="nameInput">Tên sản phẩm (*)</label>
                        </div>
                    </div>
                    
                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="number" name="price" class="form-control" id="priceInput" required placeholder="Giá bán">
                            <label for="priceInput">Giá bán (VNĐ) (*)</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" name="image" class="form-control" id="imgInput" placeholder="Link ảnh">
                            <label for="imgInput">Đường dẫn ảnh (URL)</label>
                        </div>
                        <div id="image-preview-area" class="text-center p-3 border-2 border-dashed rounded-4 bg-light" style="border-style: dashed; border-color: #ddd;">
                            <span class="text-muted small"><i class="fa-regular fa-image me-1"></i>Ảnh minh họa sẽ hiện ở đây</span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <textarea name="description" class="form-control" id="descInput" style="height: 120px" placeholder="Mô tả"></textarea>
                            <label for="descInput">Mô tả chi tiết sản phẩm</label>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-center gap-3 mt-4">
                        <a href="<?= WEB_ROOT ?>/Product/list" class="btn btn-light rounded-pill px-5 py-2 fw-bold text-muted">Hủy bỏ</a>
                        <button type="submit" class="btn btn-gradient px-5 py-2">Lưu Sản Phẩm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Script Preview Ảnh Xịn
    const imageInput = document.querySelector('#imgInput');
    const previewArea = document.querySelector('#image-preview-area');

    if (imageInput) {
        imageInput.addEventListener('input', function() {
            const url = this.value;
            if (url) {
                previewArea.innerHTML = `
                    <img src="${url}" class="img-fluid rounded-3 shadow-sm animate__animated animate__fadeIn" 
                         style="max-height: 200px; object-fit: contain;" 
                         onerror="this.src='https://placehold.co/600x400?text=Lỗi+Ảnh'">
                    <div class="mt-2 text-success small fw-bold"><i class="fa-solid fa-check-circle me-1"></i>Đã nhận ảnh</div>
                `;
                previewArea.classList.remove('bg-light');
                previewArea.classList.add('bg-white');
            } else {
                previewArea.innerHTML = '<span class="text-muted small"><i class="fa-regular fa-image me-1"></i>Ảnh minh họa sẽ hiện ở đây</span>';
                previewArea.classList.add('bg-light');
            }
        });
    }
</script>

<?php include 'app/views/share/footer.php'; ?>