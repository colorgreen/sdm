<?php

use App\OperationsHistory;

class Mediator extends OperationsHistory implements ITransfer
{
    public function transferMoney(TransferObject $transferObject): void
    {
        $operation = InterBankPaymentOperationBuilder::build($transferObject);

        $operation->execute();

        $this->addOperation($operation);
    }
}