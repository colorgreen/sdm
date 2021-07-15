<?php


class OpenCreditOperation extends ProductOperation
{
    protected Loan $loanAccount;
    protected Balance $credit;

    public function __construct(Account $consumerAccount, Loan $loanAccount, Balance $credit)
    {
        parent::__construct($consumerAccount, 'Open credit');

        $this->loanAccount = $loanAccount;
        $this->credit = $credit;
    }

    public function execute(): void
    {
        parent::execute();

        $this->loanAccount->decreaseBalance($this->credit);
        $this->product->increaseBalance($this->credit);
    }
}