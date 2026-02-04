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
        include 'app/views/product/list.php';
    }

    public function add() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];

            if (empty($name)) { $errors[] = "Tên không được để trống"; }
            if ($price <= 0) { $errors[] = "Giá phải lớn hơn 0"; }

            if (empty($errors)) {
                $id = count($this->products) + 1;
                $newProduct = new ProductModel($id, $name, $desc, $price);
                
                $this->products[] = $newProduct;
                $_SESSION['products'] = $this->products;

                // SỬA LẠI ĐOẠN NÀY: Phải nối chuỗi bằng dấu chấm (.)
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

            if (empty($name)) { $errors[] = "Tên không được để trống"; }
            if ($price <= 0) { $errors[] = "Giá phải lớn hơn 0"; }

            if (empty($errors)) {
                foreach ($this->products as $key => $p) {
                    if ($p->getId() == $id) {
                        $this->products[$key]->setName($name);
                        $this->products[$key]->setDescription($desc);
                        $this->products[$key]->setPrice($price);
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