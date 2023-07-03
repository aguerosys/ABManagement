<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportRepository
{
    protected Report $modelReport;

    public function __construct(Report $modelReport)
    {
        $this->modelReport = $modelReport;    
    }

    public function index()
    {
        return $this->modelReport->orderBy('created_at', 'desc')->get();
    }   
    
    public function exportPDF(){

        $reports = $this->modelReport->all();

        $pdf = PDF::loadView('pdf.reports', compact('reports'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('reports-list.pdf');
    }

    public function createReport($name, $amount)
    {
        return $this->modelReport->create([
            'name' => $name,
            'amount' => $amount
        ]);
    }
    
}
