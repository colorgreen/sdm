<?php

namespace App\Reports;

use Deposit;
use Loan;
use Product;

interface IReportable
{
    public function visitDeposit(Deposit $deposit): string;

    public function visitLoan(Loan $loan): string;

    public function visitProduct(Product $product): string;
}