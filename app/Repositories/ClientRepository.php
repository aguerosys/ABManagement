<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;


class ClientRepository
{
    protected Client $modelClient;

    public function __construct(Client $modelClient)
    {
        $this->modelClient = $modelClient;  
    }
    
    public function index()
    {
        return $this->modelClient->orderBy('created_at', 'desc')->get();
    }

    public function store(StoreClientRequest $request)
    {
        return $this->modelClient->create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
    }
    
   
}
