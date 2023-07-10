<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;  
    }
    
    public function index()
    {
        $categories = $this->categoryRepository->index();
        return view('categories/index', compact('categories'));
    }

    public function create()
    {
        return view('categories/create');
    }

   
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepository->store($request);
        return redirect()->route('categories/index');
    }

}
