<?php


class CloseAccountDecorator extends AccountDecorator
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function closeAccount()
    {
        $this->product->decreaseBalance($this->product->getBalance());
    }
}