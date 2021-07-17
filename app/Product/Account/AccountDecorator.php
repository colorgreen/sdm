<?php

use App\InterestRates\AccountInterestRate;

class AccountDecorator extends Product implements IProduct
{
    protected Product $product;

    private AccountInterestRate|null $interestRate;

    public function __construct(Product $product, AccountInterestRate $accountInterestRate = null)
    {
        parent::__construct($product->getOwner());

        $this->product = $product;
        $this->interestRate = $accountInterestRate;
    }

    public function decreaseBalance(Balance $payment): void
    {
        $this->product->decreaseBalance($payment);
    }

    public function increaseBalance(Balance $payment): void
    {
        $this->product->increaseBalance($payment);
    }

    public function getBalance(): Balance
    {
        return $this->product->getBalance();
    }

    public function getOpeningDateTime(): DateTime
    {
        return $this->product->getOpeningDateTime();
    }

    public function accept(\App\Reports\IReportable $visitor): string
    {
        return $this->product->accept($visitor);
    }
}