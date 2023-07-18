<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Repair;

class RepairRepository
{
    protected Repair $modelRepair;

    public function __construct(Repair $modelRepair)
    {
        $this->modelRepair = $modelRepair;    
    }

    public function index()
    {
        return $this->modelRepair->orderBy('created_at', 'desc')->get();
    }   
    
    
}
