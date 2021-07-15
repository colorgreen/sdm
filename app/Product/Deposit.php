<?php


use App\InterestRates\DepositInterestRate;

class Deposit extends Product
{
    const DEPOSIT_DURATION = '365';
    protected Person $supplierAccount;

    protected DepositInterestRate $interestRate;
    protected DateTime $closingDateTime;

    public function __construct(Person $owner, DepositInterestRate $interestRate)
    {
        parent::__construct($owner);
        $this->supplierAccount = $owner;
        $this->interestRate = $interestRate;
    }

    public function supplyWithMoney(Balance $money): void
    {
        $operation = new MakeDepositOperation(new Account($this->supplierAccount), $this, $money);
        $this->addOperation($operation);
    }

    public function withdrawMoney(Balance $money): void
    {
        $operation = new WithdrawDepositOperation(new Account($this->supplierAccount), $this, $money);
        $this->addOperation($operation);
    }

    public function getClosingDateTime(): DateTime
    {
        return $this->closingDateTime;
    }

    public function updateOpeningTime(): void
    {
        parent::updateOpeningTime();

        $this->closingDateTime = $this->openingDateTime;
    }
}