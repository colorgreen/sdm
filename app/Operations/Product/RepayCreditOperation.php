<?php


class RepayCreditOperation extends ProductOperation
{
    protected Loan $loanAccount;
    protected Balance $payment;

    public function __construct(Account $consumerAccount, Loan $loanAccount, Balance $payment)
    {
        parent::__construct($consumerAccount, 'Repay credit');

        $this->loanAccount = $loanAccount;
        $this->payment = $payment;
    }

    public function execute(): void
    {
        parent::execute();

        $this->product->decreaseBalance($this->payment);
        $this->loanAccount->increaseBalance($this->payment);
        $this->loanAccount->updateNextRepaymentDateTime();
    }
}