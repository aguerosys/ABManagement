<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Report;
use Barryvdh\DomPDF\PDF;

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
    
    public function exportPDF(Report $report){

        $reports = $report->all();

        $pdf = PDF::loadView('pdf.reports', compact('reports'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('reports-list.pdf');
    }
    
}
