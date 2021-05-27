<?php


namespace App\Accounts;


use App\InterestRates\IInterestMechanism;

class Overdraft implements IAccount, IInterestMechanism
{
    /**
     * @var float
     */
    private $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }

    public function getOverdraftBalance(): float
    {
       //return overdraft balance
    }

    public function getBalance(): float
    {
        // TODO: Implement getBalance() method.
    }

    public function storeMoney(float $money): void
    {
        // TODO: Implement storeMoney() method.
    }

    public function calculateInterest(): float
    {
        // TODO: Implement calculateInterest() method.
    }
}