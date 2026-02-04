<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">QUẢN LÝ SẢN PHẨM</h1>
            <a href="<?= WEB_ROOT ?>/Product/add" class="btn btn-success">
                + Thêm mới sản phẩm
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Giá (VND)</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td class="text-center fw-bold"><?= $product->getId() ?></td>
                                    <td class="text-primary fw-bold"><?= $product->getName() ?></td>
                                    <td><?= $product->getDescription() ?></td>
                                    <td class="text-danger">
                                        <?= number_format($product->getPrice(), 0, ',', '.') ?> đ
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= WEB_ROOT ?>/Product/edit/<?= $product->getId() ?>" class="btn btn-warning btn-sm">
                                            Sửa
                                        </a>
                                        <a href="<?= WEB_ROOT ?>/Product/delete/<?= $product->getId() ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Chưa có sản phẩm nào.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>