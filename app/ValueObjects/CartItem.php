<?php

namespace App\ValueObjects;

use App\Models\Product;

class CartItem{
    private $productId;
    private $name;
    private $price;
    private $quantity = 0;
    private $img_path;
    

    /**
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(Product $product, int $quantity = 1){
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->img_path = $product->img_path;
        $this->quantity = $quantity;

    }

    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

     /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the value of img_path
     */ 
    public function getImg_path()
    {
        return $this->img_path;
    }

    public function addQuantity(Product $product): CartItem 
    {
        return new CartItem($product, ++$this->quantity);
    }

    public function getSum()
    {
        return $this->price * $this->quantity;
    }

}