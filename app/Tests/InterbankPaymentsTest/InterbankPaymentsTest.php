<?php

use App\Bank;

class InterbankPaymentsTest extends BaseTestCase
{
    private Bank $bankFrom;
    private Bank $bankTo;
    private Balance $balance;
    private TransferObject $transferObject;
    private Mediator $mediator;

    public function setUp(): void
    {
        $this->bankFrom = new Bank();
        $this->bankTo = new Bank();
        $this->balance = new Balance();
        $this->transferObject = new TransferObject($this->bankFrom, $this->bankTo, $this->balance);
        $this->mediator = new Mediator($this->transferObject);
    }

    public function testGetOriginBank(): void
    {
        $this->assertEquals($this->bankFrom, $this->transferObject->getOriginBank());
    }

    public function testGetDestinationBank(): void
    {
        $this->assertEquals($this->bankTo, $this->transferObject->getDestinationBank());
    }

    public function testGetBalance(): void
    {
        $this->assertEquals($this->balance, $this->transferObject->getPayment());
    }

    public function testTransferMoney(): void
    {
        $count = count($this->mediator->getOperationHistory());

        $this->mediator->transferMoney($this->transferObject);

        $this->assertTrue($count + 1, count($this->mediator->getOperationHistory()));
    }
}