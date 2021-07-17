<?php

namespace App;

use Account;
use Balance;
use JetBrains\PhpStorm\Pure;
use OpenAccountOperation;
use Person;

class Bank extends OperationsHistory
{
    protected array $accounts = [];

    protected Balance $balance;

    #[Pure] public function __construct()
    {
        parent::__construct('Open Bank');
        $this->balance = new Balance();
    }

    public function openAccountForPerson(Person $owner)
    {
        $operation = new OpenAccountOperation($this, $owner);
        $operation->execute();
        $this->addOperation($operation);
    }

    public function addAccount(Account $account): void
    {
        $this->accounts[] = $account;
    }

    public function increaseBalance(Balance $payment): void
    {
        $this->balance->credit($payment);
    }

    public function decreaseBalance(Balance $payment): void
    {
        $this->balance->debit($payment);
    }

    public function getAccounts(): array
    {
        return $this->accounts;
    }

    public function getBalance(): Balance
    {
        return $this->balance;
    }
}