<?php

namespace App\InterestRates;

use DateTime;

class LoanInterestRate implements IInterestMechanism
{
    private const STANDARD_INTEREST_RATE = 0.02;

    protected float $currentRate = 0;

    public function calculateInterest(\Product $product): float
    {
        if(new DateTime() > $product->getOpeningDateTime()) {
            $this->currentRate += self::STANDARD_INTEREST_RATE;
        }

        return $this->currentRate;
    }

}