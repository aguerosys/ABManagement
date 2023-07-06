<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use App\Repositories\ClientRepository;

class ClientController extends Controller
{
    protected ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;  
    }

    public function index()
    {
        $clients = $this->clientRepository->index();
        return view('clients/index', compact('clients'));
    }

    public function store(StoreClientRequest $request)
    {
        $this->clientRepository->store($request);
        return back();
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return back();
    }
}
