<!DOCTYPE html>
<html lang="vi">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopMoshi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa; /* Màu nền xám nhẹ cho sang */
        }
        .hover-effect {
            transition: transform 0.2s;
        }
        .hover-effect:hover {
            transform: translateY(-5px); /* Hiệu ứng bay lên khi di chuột */
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-warning" href="<?= WEB_ROOT ?>/Product/list">
                <i class="fa-solid fa-store"></i> AN NINH STORE
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= WEB_ROOT ?>/Product/list">
                            <i class="fa-solid fa-list"></i> Danh sách
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-circle-info"></i> Giới thiệu
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-warning text-dark fw-bold btn-sm" href="<?= WEB_ROOT ?>/Product/add">
                            <i class="fa-solid fa-plus"></i> Thêm hàng
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4" style="min-height: 600px;"> 

