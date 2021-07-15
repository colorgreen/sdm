<?php

namespace App\InterestRates;

use Product;

class AccountInterestRate implements IInterestMechanism
{
    protected const MINIMAL_CASH = 10000;
    protected const WORSE_INTEREST_RATE = 0.005;
    protected const BETTER_INTEREST_RATE = 0.02;

    public function calculateInterest(Product $product): float
    {
        $compareBalance = new \Balance(self::MINIMAL_CASH);

        return $compareBalance->compareTo($product->getBalance()) > 0
            ? self::BETTER_INTEREST_RATE : self::WORSE_INTEREST_RATE;
    }
}