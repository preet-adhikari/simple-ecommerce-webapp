<?php

namespace App\Models;


class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;


    public function __construct($oldCart){
        if ($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item,$id){
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item
        ];
        if ($this->items){
            if (array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $storedItem['item']->stock--;
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    public function reduce($item,$id){
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item
        ];
        if ($this->items){
            if (array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        if ($storedItem['qty']  > 1){
            $storedItem['qty']--;
            $storedItem['price'] = $item->price * $storedItem['qty'];
            $storedItem['item']->stock++;
            $this->items[$id] = $storedItem;
            $this->totalQty--;
            $this->totalPrice -= $item->price;
        }
        else{
            unset($this->items[$id]);
            $this->totalQty -= $storedItem['qty'];
            $this->totalPrice -= $item->price;
        }
    }

    public function remove($item,$id){
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item
        ];
        if ($this->items){
            if (array_key_exists($id, $this->items)){
                $storedItem = $this->items[$id];
            }
        }
        unset($this->items[$id]);
        $this->totalQty -= $storedItem['qty'];
        $this->totalPrice -= $item->price;

    }
}

