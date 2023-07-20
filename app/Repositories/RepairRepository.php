<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\StoreRepairRequest;
use App\Models\Repair;
use App\Services\GeneratorService;

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
    
    public function store(StoreRepairRequest $request)
    {

        $repairCreate = $this->modelRepair->create([
            'code' => $request->code,
            'description' => $request->description,
            'details' => $request->details,
            'price' => $request->price,
            'category' => $request->category,
            'client' => $request->client,
            'status' => 'Pendiente'
        ]);


        $generator = new GeneratorService();
        $code = $generator->codeGenerator($request->category, $repairCreate->id);

        Repair::where('id', $repairCreate->id)->update([
            'code' => $code
        ]);
    }
    
}
