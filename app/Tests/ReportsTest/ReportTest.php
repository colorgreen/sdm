<?php

use App\Reports\Report;

class ReportTest extends BaseTestCase
{
    private Report $report;

    public function setUp(): void
    {
        $this->report = new Report();
    }

    public function testPersonReport(): void
    {
        $array[] = new Product(new Person('name', 'surname'));

        $this->assertEquals(
            'name=name, surname=surname',
            $this->report->personReport($array, 'name')
        );

    }
}