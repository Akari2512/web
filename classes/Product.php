<?php

class Product
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    // Add other properties as needed

    public function __construct($id, $name, $description, $price, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
    }
}

?>