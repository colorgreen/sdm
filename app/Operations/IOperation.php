<?php

namespace App\Operations;

use App\Accounts\IAccount;

interface IOperation
{
    public function perform(IAccount $account): void;
}