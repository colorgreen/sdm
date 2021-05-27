<?php


namespace App\Reports;


class Report //visitor
{
    public function prepareReport(IReportable $reportable, array $data): IReportable
    {
        return $reportable->report($data);
    }
}