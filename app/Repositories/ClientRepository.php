<?php

declare(strict_types=1);

namespace App\Repositories;


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
   
}
