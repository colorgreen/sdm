<?php

namespace App\InterestRates;

use Product;

interface IInterestMechanism
{
    public function calculateInterest(Product $product): float;
}