<?php

namespace App;

class Cart
{
    public $items = [];
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct()
    {
        $this->items = session('cart') ?? [];
        $this->totalQuantity = $this->getTotalQuantity();
        $this->totalPrice = $this->getTotalPrice();
    }

    public function add($product, $quantity = 1)
    {
        $images = json_decode($product->images);
        $image = array_shift($images);

        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'images' => $image,
            'price' => $product->sale_price ?? $product->price,
            'quantity' => $quantity,
        ];

        if (isset($this->items[$product->id])) {
            $this->items[$product->id]['quantity'] += $quantity;
        } else {
            $this->items[$product->id] = $item;
        }

        session(['cart' => $this->items]);
    }

    public function update($id, $quantity)
    {
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] = $quantity;
        }
        session(['cart' => $this->items]);
    }

    public function remove($id)
    {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        }
        session(['cart' => $this->items]);
    }

    public function clear()
    {
        session(['cart' => []]);
    }

    public function getTotalPrice()
    {
        $result = 0;
        foreach ($this->items as $item) {
            $result += $item['price'] * $item['quantity'];
        }
        return $result;
    }

    public function getTotalQuantity()
    {
        $result = 0;
        foreach ($this->items as $item) {
            $result += $item['quantity'];
        }
        return $result;
    }
}
