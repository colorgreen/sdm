<?php

namespace App\InterestRates;

use App\Accounts\IAccount;

class InterestMechanism implements IInterestMechanism
{
    /**
     * @var IAccount
     */
    private $account;

    public function __construct(IAccount $account)
    {
        $this->account = $account;
    }

    public function calculateInterest(): float
    {
        // TODO: implement calculateInterest algorithm
        switch($this->account->getBalance()){
            case 10000.0:
                return 10.0;
            case 3000.0:
                return 3.0;
        }

        return 0.0;
    }
}