<?php


namespace App\Operations;


use App\Bank;

interface IInterbankPaymentAgency //Mediator
{
    public function perform(Bank $sender, Bank $receiver): void;
}