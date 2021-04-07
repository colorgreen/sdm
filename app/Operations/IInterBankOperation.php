<?php


namespace App\Operations;


use App\Bank;

interface IInterBankOperation
{
    public function perform(Bank $sender, Bank $receiver): void;
}