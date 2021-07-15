<?php


class Account extends Product
{
    public function __construct(Person $owner)
    {
        parent::__construct($owner);
    }
}