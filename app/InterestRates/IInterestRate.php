<?php

namespace App\InterestRates;

use App\Accounts\IAccount;

interface IInterestRate
{
    public function calculate(IAccount $account): float;
}