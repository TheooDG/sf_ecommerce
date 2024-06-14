<?php

class CartSession implements CartInterface {

    private

    public function __construct(private RequestStack $request, private string $sessionName){}
    public function add(Product $product, int $qty = 1): static
    {
        $this->request->getSession($this->sessionName)->add($product, $qty);
        return $this;
    }

    public function update(int $id, int $qty): static
    {
        return $this;
    }

    public function delete(int $id): static
    {
        return $this;
    }

    public function empty(): static;

}