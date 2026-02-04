<?php
require_once 'app/models/ProductModel.php';

class ProductController {
    private $products = [];

    public function __construct() {
        session_start();
        if (isset($_SESSION['products'])) {
            $this->products = $_SESSION['products'];
        }
    }

    public function index() {
        $this->list();
    }

    public function list() {
        $products = $this->products;

        // 1. TÌM KIẾM
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $filteredProducts = [];
            foreach ($products as $p) {
                if (stripos($p->getName(), $keyword) !== false) {
                    $filteredProducts[] = $p;
                }
            }
            $products = $filteredProducts;
        }

        // 2. SẮP XẾP (FEATURE MỚI)
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            usort($products, function($a, $b) use ($sort) {
                switch ($sort) {
                    case 'price-asc': return $a->getPrice() <=> $b->getPrice(); // Giá thấp -> cao
                    case 'price-desc': return $b->getPrice() <=> $a->getPrice(); // Giá cao -> thấp
                    case 'name-asc': return strcmp($a->getName(), $b->getName()); // Tên A-Z
                    case 'name-desc': return strcmp($b->getName(), $a->getName()); // Tên Z-A
                    default: return 0;
                }
            });
        }

        include 'app/views/product/list.php';
    }

    public function add() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];
            $image = !empty($_POST['image']) ? $_POST['image'] : 'https://placehold.co/600x400?text=No+Image';
            
            if (empty($name)) { $errors[] = "Tên không được để trống"; }
            if ($price <= 0) { $errors[] = "Giá phải lớn hơn 0"; }

            if (empty($errors)) {
                $id = count($this->products) + 1;
                $newProduct = new ProductModel($id, $name, $desc, $price, $image);
                
                $this->products[] = $newProduct;
                $_SESSION['products'] = $this->products;
                
                // Set thông báo Toast
                $_SESSION['toast_msg'] = ['type' => 'success', 'message' => 'Thêm sản phẩm thành công!'];

                header('Location: ' . WEB_ROOT . '/Product/list');
                exit();
            }
        }
        include 'app/views/product/add.php';
    }

    public function delete($id) {
        foreach ($this->products as $key => $product) {
            if ($product->getId() == $id) {
                unset($this->products[$key]);
                break;
            }
        }
        $_SESSION['products'] = array_values($this->products);
        
        // Set thông báo Toast
        $_SESSION['toast_msg'] = ['type' => 'success', 'message' => 'Đã xóa sản phẩm!'];
        
        header('Location: ' . WEB_ROOT . '/Product/list');
    }
    
    public function edit($id) {
        // ... (Logic tìm sản phẩm giữ nguyên như cũ)
        $product = null;
        foreach ($this->products as $p) {
            if ($p->getId() == $id) {
                $product = $p;
                break;
            }
        }
        if ($product === null) { die("Sản phẩm không tồn tại!"); }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];
            $image = $_POST['image'];

            if (empty($name)) { $errors[] = "Tên không được để trống"; }
            if ($price <= 0) { $errors[] = "Giá phải lớn hơn 0"; }

            if (empty($errors)) {
                foreach ($this->products as $key => $p) {
                    if ($p->getId() == $id) {
                        $this->products[$key]->setName($name);
                        $this->products[$key]->setDescription($desc);
                        $this->products[$key]->setPrice($price);
                        $this->products[$key]->setImage($image);
                        break;
                    }
                }
                
                $_SESSION['products'] = $this->products;
                
                // Set thông báo Toast
                $_SESSION['toast_msg'] = ['type' => 'info', 'message' => 'Cập nhật thành công!'];

                header('Location: ' . WEB_ROOT . '/Product/list');
                exit();
            }
        }
        include 'app/views/product/edit.php';
    }
}
?>