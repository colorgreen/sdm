<?php


use App\OperationsHistory;

class Product extends OperationsHistory implements IProduct
{
    protected string $id;

    protected Person $owner;

    protected Balance $balance;

    protected DateTime $openingDateTime;

    public function __construct(\Person $owner)
    {
        parent::__construct('Product Instance');

        $this->id = uniqid();
        $this->owner = $owner;
        $this->balance = new Balance();
        $this->openingDateTime = new DateTime();
    }

    public function decreaseBalance(Balance $payment): void
    {
        if ($payment->getValue() > $this->balance->getValue()) {
            echo 'payment greater than balance';
        }

        $this->balance->credit($payment);
    }

    public function increaseBalance(Balance $payment): void
    {
        $this->balance->credit($payment);
    }

    public function getBalance(): Balance
    {
        return $this->balance;
    }

    public function getOwner(): Person
    {
        return $this->owner;
    }

    public function getOpeningDateTime(): DateTime
    {
        return $this->openingDateTime;
    }

    public function updateOpeningTime(): void
    {
        if (!is_null($this->openingDateTime)) {
            echo 'cannot update previously updateted opening time';
        }

        $this->openingDateTime = new DateTime();
    }

    public function accept(\App\Reports\IReportable $visitor): string
    {
        return $visitor->visitProduct($this);
    }

    public function transferMoney(Product $otherAccount, Balance $payment): void
    {
        $operation = new TransferMoneyOperation($this, $otherAccount, $payment);
        $operation->execute();

        $this->addOperation($operation);
    }
}