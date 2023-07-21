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
        return $this->modelRepair->join('clients', 'clients.id', '=', 'repairs.client_id')
            ->orderBy('created_at', 'desc')
            ->select('repairs.*', 'clients.firstname', 'clients.lastname')
            ->get()
        ;
    }   
    
    public function store(StoreRepairRequest $request)
    {

        $repairCreate = $this->modelRepair->create([
            'description' => $request->description,
            'details' => $request->details,
            'price' => $request->price,
            'category' => $request->category,
            'client_id' => $request->client_id,
            'status' => 'Pendiente'
        ]);


        $generator = new GeneratorService();
        $code = $generator->codeGenerator($request->category, $repairCreate->id);

        Repair::where('id', $repairCreate->id)->update([
            'code' => $code
        ]);

        return $repairCreate;
    }

    public function doneState(Repair $repair)
    {
        return $repair->update([
            'status' => 'Terminado'
        ]);

    }
    public function processState(Repair $repair)
    {
        return $repair->update([
            'status' => 'En proceso'
        ]);


    }

    public function pendingState(Repair $repair)
    {

        return $repair->update([
            'status' => 'Pendiente'
        ]);

    }
}
