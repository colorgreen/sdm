<?php

namespace App\InterestRates;

use App\Accounts\IAccount;

class StandardInterestRate implements IInterestRate
{

    public function calculate(IAccount $account): float
    {
        // TODO: Implement calculate() method.
    }
}