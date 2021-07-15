<?php

use App\Bank;
use JetBrains\PhpStorm\Pure;

class BaseBankOperation extends Operation
{
    protected Bank $bank;

    #[Pure] public function __construct(Bank $bank, string $description)
    {
        parent::__construct($description);
        $this->bank = $bank;
    }
}