<?php

use App\Bank;
use App\InterestRates\DepositInterestRate;
use App\InterestRates\LoanInterestRate;

class OperationTest extends BaseTestCase
{
    private Bank $senderBank;
    private Bank $receiverBank;
    private TransferObject $transferObj;
    private InterBankPaymentOperation $interBank;
    private OpenAccountOperation $openAcc;
    private Bank $mockBank;

    private Person $owner;
    private Account $account;
    private Deposit $deposit;
    private Loan $loan;
    private Operation $genericOperation;

    public function setUp(): void
    {
        $this->senderBank = new Bank();
        $this->receiverBank = new Bank();
        $this->mockBank = new Bank();
        $this->transferObj = new TransferObject($this->senderBank, $this->receiverBank, new Balance(10.0));
        $this->interBank = InterBankPaymentOperationBuilder::build($this->transferObj);
        $this->openAcc = new OpenAccountOperation($this->mockBank, new Person('name', 'surname'));
        $this->genericOperation = new Operation('test');

        $this->owner = new Person('owner', 'second');
        $this->account = new Account($this->owner);
        $this->deposit = new Deposit($this->owner, new DepositInterestRate());
        $this->loan = new Loan($this->account, new LoanInterestRate());
    }

    public function testBankOperations()
    {
        $this->interBank->execute();

        $this->assertEquals(
            -10.0,
            $this->senderBank->getBalance()->getValue()
        );

        $this->assertEquals(
            10.0,
            $this->senderBank->getBalance()->getValue()
        );

        $accCount = count($this->mockBank->getAccounts());
        $this->openAcc->execute();

        $this->assertCount(
            $accCount + 1,
            $this->mockBank->getAccounts()
        );
    }

    public function testGenericOperation(): void
    {
        $this->assertEquals(
            'test',
            $this->genericOperation->getDescription()
        );

        $this->genericOperation->execute();

        $this->assertEquals(
            new DateTime(),
            $this->genericOperation->getExecutionDateTime()
        );
    }

    public function testProductOperations(): void
    {
        $depositOperation = new MakeDepositOperation($this->account, $this->deposit, new Balance(10.0));
        $depositOperation->execute();

        $this->assertEquals(
            -10.0,
            $this->account->getBalance()->getValue()
        );

        $this->assertEquals(
            10.0,
            $this->deposit->getBalance()->getValue()
        );

        $creditOperation = new OpenCreditOperation($this->account, $this->loan, new Balance(10.0));
        $creditOperation->execute();

        $this->assertEquals(
            -10.0,
            $this->loan->getBalance()->getValue()
        );

        $this->assertEquals(
            0.0,
            $this->account->getBalance()->getValue()
        );

        $repayOperation = new RepayCreditOperation($this->account, $this->loan, new Balance(10.0));
        $repayOperation->execute();

        $this->assertEquals(
            0.0,
            $this->loan->getBalance()->getValue()
        );

        $this->assertEquals(
            -10.0,
            $this->account->getBalance()->getValue()
        );

        $withdrawOperation = new WithdrawDepositOperation($this->account, $this->deposit, new Balance(10.0));
        $withdrawOperation->execute();

        $this->assertEquals(
            0.0,
            $this->deposit->getBalance()->getValue()
        );

        $this->assertEquals(
            0.0,
            $this->account->getBalance()->getValue()
        );
    }
}