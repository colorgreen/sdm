<?php

use App\Bank;
use JetBrains\PhpStorm\Pure;

class OpenAccountOperation extends BaseBankOperation
{
    protected Account $account;

    #[Pure] public function __construct(Bank $bank, Person $owner)
    {
        parent::__construct($bank, 'Open Account');
        $this->account = new Account($owner);
    }

    public function execute(): void
    {
        parent::execute();
        $this->account->updateOpeningTime();
        $this->bank->addAccount($this->account);
    }
}