<?php

namespace App\Reports;

class Report implements IReportable
{
    public function personReport(array $products, string $name): string
    {
        $personReport = [];

        foreach ($products as $product) {
            if (
                $product->getOwner()->getFirstName() == $name
                || $product->getOwner()->getFirstName() == $name
            ) {
                $product->accept($this);
                $personReport[] = $product;
            }
        }

        return http_build_query($personReport,'',', ');
    }

    public function visitDeposit(\Deposit $deposit): string
    {
        return sprintf(
            "%s, closes: %s",
            $this->visitProduct($deposit),
            $deposit->getClosingDateTime()
        );
    }

    public function visitLoan(\Loan $loan): string
    {
        return sprintf(
            "%s, closes: %s, next repayment: %s",
            $this->visitProduct($loan),
            $loan->getClosingDateTime(),
            $loan->getNextRepaymentDateTime()
        );
    }

    public function visitProduct(\Product $product): string
    {
        return sprintf(
            "%s %s: %s",
            $product->getOwner()->getFirstName(),
            $product->getOwner()->getLastName(),
            $product->getBalance()->getValue()
        );
    }
}