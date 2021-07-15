<?php

use App\Bank;
use JetBrains\PhpStorm\Pure;

class InterBankPaymentOperation extends BaseBankOperation
{
    protected Bank $receiverBank;

    protected Balance $payment;

    #[Pure] public function __construct(Bank $senderBank, Bank $receiverBank, Balance $payment)
    {
        parent::__construct($senderBank, 'Inter bank payment');

        $this->receiverBank = $receiverBank;
        $this->payment = $payment;
    }

    public function execute(): void
    {
        parent::execute();

        $this->bank->decreaseBalance($this->payment);
        $this->receiverBank->increaseBalance($this->payment);
    }
}