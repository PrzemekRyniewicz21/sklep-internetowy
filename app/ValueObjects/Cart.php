<?php

namespace App\ValueObjects;

use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use App\Models\Product;

class Cart{

    private Collection $items;

    public function __construct(Collection $items = null){
        $this->items = $items ?? Collection::empty();
    }

    /**
     * Get the value of items
     */ 
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function hasItems(): bool
    {
        return !($this->items->isEmpty());
    }

    public function getSum()
    {
        return $this->items->sum(function ($item){
            return $item->getSum();
        });
    }
    public function getQuantity()
    {
        return $this->items->sum(function ($item){
            return $item->getQuantity();
        });
    }

    public function addItem(Product $product): Cart
    {
        $items = $this->items;
        $item = $items->first($this->areProductsSame($product));

        if(!is_null($item)){
            $items = $items->reject($this->areProductsSame($product));
            $newItem = $item->addQuantity($product);
        } else {
            $newItem = new CartItem($product);
        }

        $items->add($newItem);

        return new Cart($items);
       
    } 

    public function removeItem(Product $product): Cart
    {
        $items = $this->items->reject($this->areProductsSame($product));
        return new Cart($items);
    }

    private function areProductsSame(Product $product){
        return function ($item) use ($product){
            return $product->id == $item->getProductId();
        };
    }

}