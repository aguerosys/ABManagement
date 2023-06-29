<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Report;


class ReportRepository
{
    protected Report $modelReport;

    public function __construct(Report $modelReport)
    {
        $this->modelReport = $modelReport;    
    }

    public function index()
    {
        return $this->modelReport->all();
    }   
    
    
}
