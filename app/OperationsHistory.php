<?php


namespace App;


use App\Operations\IOperation;
use App\Reports\IReportable;

class OperationsHistory implements IReportable
{
    public function addOperation(IOperation $operation): void
    {
    }

    public function getOperations(): array
    {
    }

    public function report()
    {
        // TODO: Implement report() method.
    }
}