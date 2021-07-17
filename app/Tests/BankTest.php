<?php

use App\Bank;

class BankTest extends BaseTestCase
{
    private Person $person;

    private Bank $bank;

    private Account $account;

    public function setUp(): void
    {
        $this->person = new Person('name', 'surname');
        $this->bank = new Bank();
        $this->account = new Account($this->person);
    }

    public function testOpenAccountForPerson(): void
    {
        $arrayLength = count($this->bank->getAccounts());
        $this->bank->openAccountForPerson($this->person);

        $this->assertCount($arrayLength + 1, $this->bank->getAccounts());
    }

    public function testAddAccount(): void
    {
        $this->bank->addAccount($this->account);

        $this->assertEquals($this->account, $this->bank->getAccounts()[0]);
    }

    public function testBalance(): void
    {
        $this->assertTrue($this->bank->getBalance()->getValue() == 0.00);
    }
}