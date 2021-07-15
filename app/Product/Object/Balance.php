<?php


use JetBrains\PhpStorm\Pure;

class Balance
{
    protected float $value;

    public function __construct(float $value = null)
    {
        $this->value = $value ?? 0.00;
    }

    #[Pure] public function compareTo(Balance $otherBalance): float
    {
        return $otherBalance->getValue() - $this->value;
    }

    public function credit(Balance $payment)
    {
        $this->value += $payment->getValue();
    }

    public function debit(Balance $payment)
    {
        $this->value -= $payment->getValue();
    }

    public function getValue(): float
    {
        return $this->value;
    }
}