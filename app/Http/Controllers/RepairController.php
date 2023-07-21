<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRepairRequest;
use App\Models\Repair;
use App\Repositories\ClientRepository;
use App\Repositories\RepairRepository;

class RepairController extends Controller
{
    protected RepairRepository $repairRepository;
    protected ClientRepository $clientRepository;

    public function __construct(RepairRepository $repairRepository, ClientRepository $clientRepository)
    {
        $this->repairRepository = $repairRepository;
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        $clients = $this->clientRepository->index();
        $repairs = $this->repairRepository->index();
        return view('repairs/index', compact('repairs', 'clients'));
    }

    public function store(StoreRepairRequest $request)
    {
        $this->repairRepository->store($request);
        
        return back();
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();

        return back();
    }
    public function doneState(Repair $repair)
    {
        $this->repairRepository->doneState($repair);
        
        return back();
    }

    public function processState(Repair $repair)
    {
        $this->repairRepository->processState($repair);

        return back();
    }

    public function pendingState(Repair $repair)
    {

        $this->repairRepository->pendingState($repair);

        return back();
    }

}
