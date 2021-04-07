<?php


namespace App\Accounts;


class Account implements IAccount
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
}