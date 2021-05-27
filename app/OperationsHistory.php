<?php


namespace App;


use App\Operations\IOperation;
use App\Reports\IReportable;

class OperationsHistory implements IReportable
{
    /** @var array */
    private $operations;
    
    public function addOperation(IOperation $operation): void
    {
        $operation[] = $operation;
    }

    public function getOperations(): array
    {
        return $this->operations;
    }

    public function report(array $data): IReportable
    {
        // TODO: Implement report() method.
    }
}