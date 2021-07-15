<?php

use JetBrains\PhpStorm\Pure;

class InterBankPaymentOperationBuilder
{
    #[Pure] public static function build(TransferObject $transfer): InterBankPaymentOperation
    {
        return new InterBankPaymentOperation(
            $transfer->getOriginBank(),
            $transfer->getDestinationBank(),
            $transfer->getPayment()
        );
    }
}