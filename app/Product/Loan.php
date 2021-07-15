<?php

use App\InterestRates\LoanInterestRate;

class Loan extends Product
{
    protected Account $consumerAccount;

    protected LoanInterestRate $interestRate;
    protected DateTime $closingDateTime;
    protected DateTime $nextRepaymentDateTime;

    public function __construct(Account $consumerAccount, LoanInterestRate $interestRate = null)
    {
        parent::__construct($consumerAccount->getOwner());

        $this->consumerAccount = $consumerAccount;
        $this->interestRate = $interestRate ?? new LoanInterestRate();
    }

    public function openCredit(Balance $credit): void
    {
       $operation = new OpenCreditOperation($this->consumerAccount, $this, $credit);
       $operation->execute();

       $this->addOperation($operation);
    }

    public function repayCredit(Balance $payment): void
    {
        $operation = new RepayCreditOperation($this->consumerAccount, $this, $payment);
        $operation->execute();

        $this->addOperation($operation);
    }

    public function decreaseBalance(Balance $payment): void
    {
        $this->getBalance()->debit($payment);
    }

    public function increaseBalance(Balance $payment): void
    {
        $this->getBalance()->credit($payment);
    }

    public function getClosingDateTime(): DateTime
    {
        return $this->closingDateTime;
    }

    public function getNextRepaymentDateTime(): DateTime
    {
        return $this->nextRepaymentDateTime;
    }

    public function updateNextRepaymentDateTime(): void
    {
        $this->nextRepaymentDateTime = $this->nextRepaymentDateTime->add(new DateInterval('P365D'));
    }

    public function updateOpeningTime(): void
    {
        parent::updateOpeningTime();

        $this->closingDateTime = $this->openingDateTime->add(new DateInterval('P365D'));
        $this->nextRepaymentDateTime = $this->closingDateTime->add(new DateInterval('P365D'));
    }

    public function accept(\App\Reports\IReportable $visitor): string
    {
        return $visitor->visitProduct($this);
    }
}