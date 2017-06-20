<?php

/**
 * Created by PhpStorm.
 * User: mattcorrente
 * Date: 6/19/17
 * Time: 12:44 PM
 */
class Product
{
    private $name;
    private $desc;
    private $imagePath;
    private $price;
    private $productId;

    public function getDesc(){
        return $this->desc;
    }

    public function getImagePath(){
        return $this->imagePath;
    }

    public function getName(){
        return $this->name;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setDesc($desc){
        $this->desc = $desc;
    }

    public function setImagePath($imagePath){
        $this->imagePath = $imagePath;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function setProductId($id)
    {
        $this->productId = $id;
    }

}