<?php

class DebitAccountDecorator extends AccountDecorator
{
    protected const DEBIT_LIMIT = 10000;

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function decreaseBalance(Balance $payment): void
    {
        $this->getBalance()->debit($payment);
    }
}