<?php
class ProductModel {
    private $id;
    private $name;
    private $description;
    private $price;

    public function __construct($id, $name, $description, $price, $image = null) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image ?? 'https://placehold.co/600x400?text=No+Image';
    }

    // Mấy hàm này để lấy và gán dữ liệu (Getter/Setter)
    public function getImage() { return $this->image; }
    public function setImage($image) { $this->image = $image; }
    
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }

    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; }

    public function getPrice() { return $this->price; }
    public function setPrice($price) { $this->price = $price; }
}
?>