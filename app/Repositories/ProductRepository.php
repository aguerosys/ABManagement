<?php

declare(strict_types=1);

namespace App\Repositories;


use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateAmountProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductRepository
{
    protected Product $modelProduct;

    public function __construct(Product $modelProduct)
    {
        $this->modelProduct = $modelProduct;    
    }
    
    public function store(StoreProductRequest $request)
    {
        return $this->modelProduct->create([
            'user_id' => auth()->user()->id,
            'code' => $request->code,
            'name' => $request->name,
            'category' => $request->category,
            'amount' => $request->amount
        ]);

    }

    public function all()
    {
        return $this->modelProduct->all();

    }

    public function destroy(Product $product)
    {
       return $product->delete();
    }

    public function update(UpdateProductRequest $request)
    {
        return $this->modelProduct->update([
            'code' => $request->code,
            'name' => $request->name
        ]);
    }

    public function addAmount(UpdateAmountProductRequest $request){

        return $this->modelProduct->update([
            'amount' => ($this->modelProduct->amount + $request->amount)
        ]);

    }

   
}
