<?php

use App\InterestRates\AccountInterestRate;
use App\InterestRates\DepositInterestRate;
use App\InterestRates\LoanInterestRate;

class InterestRatesTest extends BaseTestCase
{
    private Product $product;
    private AccountInterestRate $account;
    private DepositInterestRate $deposit;
    private LoanInterestRate $loan;

    public function setUp(): void
    {
        $this->product = new Product(new Person('name', 'surname'));
        $this->account = new AccountInterestRate();
        $this->deposit = new DepositInterestRate();
        $this->loan = new LoanInterestRate();
    }

    public function testCalculateInterest(): void
    {
        $this->assertEquals(
            0.005,
            $this->account->calculateInterest($this->product)
        );

        $this->assertEquals(
            0.04,
            $this->deposit->calculateInterest($this->product)
        );

        $this->assertEquals(
            0.02,
            $this->loan->calculateInterest($this->product)
        );
    }
}