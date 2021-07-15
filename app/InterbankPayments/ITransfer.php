<?php

interface ITransfer
{
    public function transferMoney(TransferObject $transferObject);
}