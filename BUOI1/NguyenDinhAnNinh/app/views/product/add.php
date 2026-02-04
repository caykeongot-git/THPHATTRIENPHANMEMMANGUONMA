<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Thêm Sản Phẩm Mới</h3>
                    </div>
                    <div class="card-body">
                        
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $err) echo "<li>$err</li>"; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?= WEB_ROOT ?>/Product/add">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tên sản phẩm:</label>
                                <input type="text" name="name" class="form-control" required placeholder="Nhập tên...">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Mô tả:</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Mô tả..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Giá bán:</label>
                                <input type="number" name="price" class="form-control" required placeholder="Nhập giá...">
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= WEB_ROOT ?>/Product/list" class="btn btn-secondary">Quay lại</a>
                                <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>