<?php

namespace App\Reports;

interface IReportable //visitor
{
    public function report(array $data): IReportable;
}