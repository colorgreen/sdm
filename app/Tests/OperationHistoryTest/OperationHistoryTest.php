<?php

use App\OperationsHistory;

class OperationHistoryTest extends BaseTestCase
{
    private Operation $operation;

    private OperationsHistory $history;

    public function setUp(): void
    {
        $this->operation = new Operation('operacja');
        $this->history = new OperationsHistory('test');
    }

    public function testOperationHistory(): void
    {
        $count = count($this->history->getOperationHistory());
        $this->history->addOperation($this->operation);

        $this->assertCount($count + 1, $this->history->getOperationHistory());
    }
}