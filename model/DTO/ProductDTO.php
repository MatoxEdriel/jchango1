<?php
class ProductDTO {
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $image;

    public function __construct($id, $name, $description, $price, $stock, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->image = $image;
    }
}
?>