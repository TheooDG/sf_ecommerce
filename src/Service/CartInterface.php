<?php

namespace App\Service;

use App\Entity\Product;

interface CartInterface {

    public function add(Product $product, int $qty=1): static
    {
        dd($product);
        return $this;
    }

    public function update(int $id, int $qty=1): static
    {
        return $this;
    }

    public function delete(int $id): static
    {
        return $this;
    }
    public function empty();
}