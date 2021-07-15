<?php

use JetBrains\PhpStorm\Pure;

class ProductOperation extends Operation
{
    protected Product $product;

    #[Pure] public function __construct(Product $product, string $description)
    {
        parent::__construct($description);
        $this->product = $product;
    }
}