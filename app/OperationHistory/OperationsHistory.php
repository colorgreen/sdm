<?php

namespace App;

use Operation;

class OperationsHistory extends Operation
{
    protected array $operations = [];
    
    public function addOperation(Operation $operation): void
    {
        $operation[] = $operation;
    }

    public function getOperationHistory(): array
    {
        return $this->operations;
    }
}