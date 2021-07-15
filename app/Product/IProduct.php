<?php

use App\Reports\IReportable;

interface IProduct
{
    public function decreaseBalance(Balance $payment): void;

    public function increaseBalance(Balance $payment): void;

    public function getBalance(): Balance;

    public function getOwner(): Person;

    public function getOpeningDateTime(): DateTime;

    public function updateOpeningTime(): void;

    public function accept(IReportable $visitor): string;

    public function transferMoney(Product $otherAccount, Balance $payment): void;
}