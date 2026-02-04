<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AN NINH STORE - Modern UI</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4e54c8; /* Màu chủ đạo Indigo */
            --secondary-color: #8f94fb;
            --accent-color: #ff6b6b; /* Màu nhấn (HOT, nút xóa) */
            --bg-light: #f4f7f9; /* Màu nền sáng hiện đại */
            --text-dark: #2c3e50;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }
        /* Navbar xịn sò */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px); /* Hiệu ứng kính mờ */
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 700;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent; /* Chữ màu gradient */
        }
        .nav-link { font-weight: 500; color: var(--text-dark) !important; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary-color) !important; }

        /* Card sản phẩm hiện đại */
        .modern-card {
            border: none;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .modern-card:hover {
            transform: translateY(-10px); /* Bay lên khi hover */
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .img-container {
            height: 220px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            position: relative;
        }
        .img-container img {
            max-height: 90%; max-width: 90%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }
        .modern-card:hover .img-container img { transform: scale(1.1); } /* Zoom ảnh */

        /* Nút bấm overlay */
        .overlay-actions {
            position: absolute;
            bottom: -50px; left: 0; right: 0;
            display: flex; justify-content: center; gap: 10px;
            transition: all 0.4s ease;
            opacity: 0;
        }
        .modern-card:hover .overlay-actions { bottom: 20px; opacity: 1; }
        .btn-action {
            width: 40px; height: 40px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: 0.3s; border: none; color: var(--text-dark);
        }
        .btn-action:hover { background: var(--primary-color); color: #fff; }

        /* Các nút bấm và form */
        .btn-primary-modern {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none; color: #fff; font-weight: 600;
            padding: 10px 25px; border-radius: 30px;
            box-shadow: 0 5px 15px rgba(78, 84, 200, 0.3); transition: 0.3s;
        }
        .btn-primary-modern:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(78, 84, 200, 0.4); }
        .form-control, .form-select {
            border-radius: 10px; border: 2px solid #eee; padding: 12px;
            transition: 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 4px rgba(143, 148, 251, 0.1);
        }
        .price-tag { color: var(--primary-color); font-weight: 700; font-size: 1.2rem; }
        .badge-modern { border-radius: 20px; padding: 5px 12px; font-weight: 500; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3">
        <div class="container">
            <a class="navbar-brand" href="<?= WEB_ROOT ?>/Product/list">
                <i class="fa-brands fa-slack"></i> AN NINH STORE
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars-staggered text-primary fs-3"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item me-3">
                        <a class="nav-link active" href="<?= WEB_ROOT ?>/Product/list"><i class="fa-solid fa-house me-1"></i> Trang chủ</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><i class="fa-solid fa-tags me-1"></i> Khuyến mãi</a>
                    </li>
                    <li class="nav-item mt-2 mt-lg-0">
                        <a class="btn btn-primary-modern" href="<?= WEB_ROOT ?>/Product/add">
                            <i class="fa-solid fa-plus-circle me-1"></i> Đăng bán
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="padding-top: 100px; min-height: 80vh;">