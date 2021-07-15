<?php

namespace App\InterestRates;

use Product;

class DepositInterestRate implements IInterestMechanism
{
    protected const INTEREST_RATE = 0.02;
    protected const MINIMAL_DAY_COUNT = 365;

    public function calculateInterest(Product $product): float
    {
        $now = new \DateTime();

        $diff = $now->diff($product->getOpeningDateTime());

        if ($diff->days && $diff->days > self::MINIMAL_DAY_COUNT) {
            return floor(($diff->days - self::MINIMAL_DAY_COUNT) / 10) * self::INTEREST_RATE;
        }

        return 0.00;
    }
}