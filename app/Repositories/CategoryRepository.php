<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreClientRequest;
use App\Models\Category;


class CategoryRepository
{
    protected Category $modelCategory;

    public function __construct(Category $modelCategory)
    {
        $this->modelCategory = $modelCategory;  
    }
    
    public function index()
    {
        return $this->modelCategory->orderBy('created_at', 'desc')->get();
    }

    public function store(StoreCategoryRequest $request)
    {
        return $this->modelCategory->create([
            'name' => $request->name,
            'description' => $request->description
        ]);
    }
    
   
}
