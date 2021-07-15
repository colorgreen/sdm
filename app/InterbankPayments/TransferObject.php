<?php

use App\Bank;

class TransferObject
{
    protected Bank $originBank;

    protected Bank $destinationBank;

    protected Balance $payment;

    public function __construct(Bank $originBank, Bank $destinationBank, Balance $payment)
    {
        $this->originBank = $originBank;
        $this->destinationBank = $destinationBank;
        $this->payment = $payment;
    }

    public function getOriginBank(): Bank
    {
        return $this->originBank;
    }

    public function getDestinationBank(): Bank
    {
        return $this->destinationBank;
    }

    public function getPayment(): Balance
    {
        return $this->payment;
    }
}