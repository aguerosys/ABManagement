<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        //
        $categories = Category::all();
        return view('categories/index', compact('categories'));
    }

    public function create()
    {
        //
        return view('categories/create');
    }

   
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('categories/index');
    }

 
    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }


    public function update(Request $request, Category $category)
    {
        //
    }


    public function destroy(Category $category)
    {
        //
    }
}
