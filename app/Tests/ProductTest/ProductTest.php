<?php

use App\InterestRates\AccountInterestRate;
use App\InterestRates\DepositInterestRate;
use App\InterestRates\LoanInterestRate;

class ProductTest extends BaseTestCase
{
    private Person $owner;
    private Product $product;
    private AccountDecorator $accountDecorator;
    private AccountInterestRate $accountInterestRate;
    private CloseAccountDecorator $closeAccountDecorator;
    private DebitAccountDecorator $debitAccountDecorator;
    private Balance $balance;
    private Deposit $deposit;
    private Account $account;
    private Loan $loan;

    public function setUp(): void
    {
        $this->owner = new Person('name', 'surname');
        $this->product = new Product($this->owner);
        $this->accountInterestRate = new AccountInterestRate();
        $this->accountDecorator = new AccountDecorator($this->product, $this->accountInterestRate);
        $this->closeAccountDecorator = new CloseAccountDecorator($this->product);
        $this->debitAccountDecorator = new DebitAccountDecorator($this->product);
        $this->balance = new Balance(15.0);
        $this->deposit = new Deposit($this->owner, new DepositInterestRate());
        $this->account = new Account($this->owner);
        $this->loan = new Loan($this->account, new LoanInterestRate());
    }

    public function testBalanceDecorators(): void
    {
        $this->accountDecorator->increaseBalance(new Balance(10.0));
        $this->assertEquals(
            10.0,
            $this->accountDecorator->getBalance()->getValue()
        );

        $this->accountDecorator->decreaseBalance(new Balance(3.0));
        $this->assertEquals(
            7.0,
            $this->accountDecorator->getBalance()->getValue()
        );

        $this->debitAccountDecorator->decreaseBalance(new Balance(3.0));
        $this->assertEquals(
            4.0,
            $this->accountDecorator->getBalance()->getValue()
        );

        $this->closeAccountDecorator->closeAccount();
        $this->assertEquals(
            0.0,
            $this->accountDecorator->getBalance()->getValue()
        );
    }

    public function testObjects(): void
    {
        $this->assertEquals(
            5.0,
            $this->balance->compareTo(new Balance(20.0))
        );

        $this->balance->credit(new Balance(20.0));
        $this->assertEquals(
            35.0,
            $this->balance->getValue()
        );

        $this->balance->debit(new Balance(5.0));
        $this->assertEquals(
            30.0,
            $this->balance->getValue()
        );

        $this->assertEquals(
            'name',
            $this->owner->getFirstName()
        );

        $this->assertEquals(
            'surname',
            $this->owner->getLastName()
        );

        $this->assertEquals(
            'name surname',
            $this->owner->getFullName()
        );
    }

    public function testDeposit()
    {
        $count = count($this->deposit->getOperationHistory());
        $this->deposit->supplyWithMoney(new Balance(10.0));
        $this->assertCount(
            $count + 1,
            $this->deposit->getOperationHistory()
        );

        $count = count($this->deposit->getOperationHistory());
        $this->deposit->withdrawMoney(new Balance(10.0));
        $this->assertCount(
            $count + 1,
            $this->deposit->getOperationHistory()
        );

        $this->deposit->updateOpeningTime();
        $time = new DateTime();

        $this->assertEquals(
            $time,
            $this->deposit->getClosingDateTime()
        );
    }

    public function testLoan()
    {
        $count = count($this->loan->getOperationHistory());
        $this->loan->openCredit(new Balance(10.0));
        $this->assertCount(
            $count + 1,
            $this->loan->getOperationHistory()
        );

        $count = count($this->loan->getOperationHistory());
        $this->loan->repayCredit(new Balance(10.0));
        $this->assertCount(
            $count + 1,
            $this->loan->getOperationHistory()
        );

        $this->loan->increaseBalance(new Balance(10.0));
        $this->assertEquals(
            10.0,
            $this->loan->getBalance()->getValue()
        );

        $this->loan->decreaseBalance(new Balance(3.0));
        $this->assertEquals(
            7.0,
            $this->loan->getBalance()->getValue()
        );
    }
}