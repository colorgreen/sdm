<?php


namespace App\Accounts;


use App\InterestRates\IInterestMechanism;
use App\InterestRates\InterestMechanism;

class Account implements IAccount, IInterestMechanism
{

    public function getBalance(): float
    {
        // TODO: Implement getBalance() method.
    }

    public function storeMoney(float $money): void
    {
        // TODO: Implement storeMoney() method.
    }

    public function openDeposit(): Deposit
    {
    }

    public function openLoan(): Loan
    {
    }

    public function calculateInterest(): float
    {
        return (new InterestMechanism($this))->calculateInterest(); //State
    }

    public function getOverdraft(): float
    {
        $overdraft = new Overdraft($this->getBalance()); //Decorator
        return $overdraft->getOverdraftBalance();
    }
}