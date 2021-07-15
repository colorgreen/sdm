<?php


use JetBrains\PhpStorm\Pure;

class MakeDepositOperation extends ProductOperation
{
    protected Deposit $deposit;
    protected Balance $payment;

    #[Pure] public function __construct(Account $senderAccount, Deposit $deposit, Balance $payment)
    {
        parent::__construct($senderAccount, 'Make deposit');
        $this->deposit = $deposit;
        $this->payment = $payment;
    }

    public function execute(): void
    {
        parent::execute();
        $this->product->decreaseBalance($this->payment);
        $this->deposit->increaseBalance($this->payment);
    }
}