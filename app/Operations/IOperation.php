<?php

namespace App\Operations;

use App\Accounts\IAccount;

interface IOperation //Command
{
    public function perform(IAccount $account): void;
}