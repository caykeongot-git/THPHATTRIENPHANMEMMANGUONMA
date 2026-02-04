<?php include 'app/views/share/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Cập Nhật Sản Phẩm</h4>
            </div>
            <div class="card-body p-4">
                
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            <?php foreach ($errors as $err) echo "<li>$err</li>"; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= WEB_ROOT ?>/Product/edit/<?= $product->getId() ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" value="<?= $product->getName() ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Giá bán</label>
                            <input type="number" name="price" class="form-control" value="<?= $product->getPrice() ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Link Ảnh sản phẩm (URL)</label>
                        <input type="text" name="image" class="form-control" value="<?= $product->getImage() ?>">
                        <div class="mt-2">
                            <img src="<?= $product->getImage() ?>" alt="Ảnh hiện tại" style="height: 50px; border-radius: 4px; border: 1px solid #ddd;">
                            <span class="text-muted ms-2 small">Ảnh hiện tại</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="3"><?= $product->getDescription() ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-3">
                        <a href="<?= WEB_ROOT ?>/Product/list" class="btn btn-secondary px-4">Hủy bỏ</a>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Lắng nghe sự kiện khi người dùng gõ hoặc dán link vào ô input tên là "image"
    const imageInput = document.querySelector('input[name="image"]');
    
    if (imageInput) {
        // Tạo một thẻ img giả để preview nếu chưa có
        // (Hoặc tận dụng thẻ img demo có sẵn ở trang edit)
        imageInput.addEventListener('input', function() {
            const imageUrl = this.value;
            let previewArea = document.querySelector('#image-preview-area');
            
            // Nếu chưa có khu vực hiển thị thì tạo mới
            if (!previewArea) {
                previewArea = document.createElement('div');
                previewArea.id = 'image-preview-area';
                previewArea.className = 'mt-3 text-center';
                this.parentNode.appendChild(previewArea);
            }

            if (imageUrl) {
                previewArea.innerHTML = `
                    <p class="text-muted small">Xem trước:</p>
                    <img src="${imageUrl}" class="img-thumbnail shadow" style="max-height: 200px;" 
                         onerror="this.src='https://placehold.co/600x400?text=Lỗi+Link+Ảnh'">
                `;
            } else {
                previewArea.innerHTML = '';
            }
        });
    }
</script>

<?php include 'app/views/share/footer.php'; ?>