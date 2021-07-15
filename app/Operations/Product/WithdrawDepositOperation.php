<?php


class WithdrawDepositOperation extends ProductOperation
{
    protected Deposit $deposit;
    protected Balance $payment;

    public function __construct(Account $receiverAccount, Deposit $deposit, Balance $payment)
    {
        parent::__construct($receiverAccount, 'Withdraw from deposit');

        $this->deposit = $deposit;
        $this->payment = $payment;
    }

    public function execute(): void
    {
        parent::execute();

        $this->product->increaseBalance($this->payment);
        $this->deposit->decreaseBalance($this->payment);
    }
}