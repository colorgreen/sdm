<?php

namespace App\InterestRates;

interface IInterestMechanism
{
    public function calculateInterest(): float;
}