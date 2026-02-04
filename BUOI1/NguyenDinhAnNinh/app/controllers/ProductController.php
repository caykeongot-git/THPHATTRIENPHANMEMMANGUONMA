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
        $products = $this->products; // Mặc định lấy hết

        // Nếu có từ khóa tìm kiếm trên URL (Ví dụ: index.php?keyword=Iphone)
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $filteredProducts = [];
            
            // Lọc mảng
            foreach ($products as $p) {
                // Kiểm tra tên sản phẩm có chứa từ khóa không (stripos là tìm không phân biệt hoa thường)
                if (stripos($p->getName(), $keyword) !== false) {
                    $filteredProducts[] = $p;
                }
            }
            $products = $filteredProducts; // Gán lại danh sách đã lọc
        }

        include 'app/views/product/list.php';
    }

    public function add() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];
            
            // XỬ LÝ ẢNH: Lấy từ form, nếu để trống thì lấy ảnh mặc định
            $image = !empty($_POST['image']) ? $_POST['image'] : 'https://placehold.co/600x400?text=No+Image';
            
            if (empty($name)) { $errors[] = "Tên không được để trống"; }
            if ($price <= 0) { $errors[] = "Giá phải lớn hơn 0"; }

            if (empty($errors)) {
                $id = count($this->products) + 1;
                
                // Đã thêm biến $image vào hàm tạo
                $newProduct = new ProductModel($id, $name, $desc, $price, $image);
                
                $this->products[] = $newProduct;
                $_SESSION['products'] = $this->products;

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
        header('Location: ' . WEB_ROOT . '/Product/list');
    }
    
    public function edit($id) {
        $product = null;
        foreach ($this->products as $p) {
            if ($p->getId() == $id) {
                $product = $p;
                break;
            }
        }

        if ($product === null) {
            die("Sản phẩm không tồn tại!");
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];
            $image = $_POST['image']; // Lấy link ảnh từ form sửa

            if (empty($name)) { $errors[] = "Tên không được để trống"; }
            if ($price <= 0) { $errors[] = "Giá phải lớn hơn 0"; }

            if (empty($errors)) {
                foreach ($this->products as $key => $p) {
                    if ($p->getId() == $id) {
                        $this->products[$key]->setName($name);
                        $this->products[$key]->setDescription($desc);
                        $this->products[$key]->setPrice($price);
                        $this->products[$key]->setImage($image); // Cập nhật ảnh mới
                        break;
                    }
                }
                
                $_SESSION['products'] = $this->products;
                header('Location: ' . WEB_ROOT . '/Product/list');
                exit();
            }
        }
        include 'app/views/product/edit.php';
    }
}
?>