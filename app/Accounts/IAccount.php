<?php


namespace App\Accounts;


interface IAccount
{
    public function getBalance(): float;
    public function storeMoney(float $money): void;
}