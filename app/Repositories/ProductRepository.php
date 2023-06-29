<?php

declare(strict_types=1);

namespace App\Repositories;


use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateAmountProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Report;
use App\Services\GeneratorService;

class ProductRepository
{
    protected Product $modelProduct;

    public function __construct(Product $modelProduct)
    {
        $this->modelProduct = $modelProduct;    
    }
    
    public function store(StoreProductRequest $request)
    {

        $store = $this->modelProduct->create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'category' => $request->category,
            'amount' => $request->amount
        ]);

        $generatorCode = new GeneratorService();
        $code = $generatorCode->codeGenerator($request->category, $store->id);

        $store->update([
            'code' => $code
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

    public function addAmount(UpdateAmountProductRequest $request, Product $product){

        return $product->update([
            'amount' => ($product->amount + $request->amount)
        ]);

    }

    public function amountUpdate(UpdateAmountProductRequest $request, Product $product, Report $report)
    {

        $resta = (int)$product->amount - (int)$request->amount;
        if(!($resta < 0)){

            $product->update([
                'amount' => $resta
            ]);

            Report::create([
                'name' => 'Se quito/vendio stock a '. $product->name,
                'amountSold' => $request->amount
            ]);
    
            return true;
        }else{
            return false;
        }

    }

   
}
