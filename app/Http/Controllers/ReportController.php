<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Repositories\ReportRepository;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    protected ReportRepository $reportRepository;
    
    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function index()
    {
        $reports = $this->reportRepository->index();
        return view('reports.index', compact('reports'));

    }

}
