<?php

namespace App\Dtos\Cart;

class CartItemDto{
    private $productId;
    private $name;
    private $price;
    private $quantity;
    private $img_path;
    


    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of img_path
     */ 
    public function getImg_path()
    {
        return $this->img_path;
    }

    /**
     * Set the value of img_path
     *
     * @return  self
     */ 
    public function setImg_path($img_path)
    {
        $this->img_path = $img_path;

        return $this;
    } 

    public function increment_quantity(){

        $this->quantity += 1;

    }
}