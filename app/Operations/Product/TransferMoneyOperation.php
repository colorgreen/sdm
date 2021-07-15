<?php

class TransferMoneyOperation extends ProductOperation
{
    protected Balance $payment;

    protected Product $receiverAccount;

    public function __construct(Product $senderAccount, Product $receiverAccount, Balance $payment)
    {
        parent::__construct($senderAccount, 'Transfer payment');

        $this->receiverAccount = $receiverAccount;
        $this->payment = $payment;
    }

    public function execute(): void
    {
        parent::execute();

        $this->product->decreaseBalance($this->payment);
        $this->receiverAccount->increaseBalance($this->payment);
    }
}