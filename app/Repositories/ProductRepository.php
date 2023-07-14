<?php

declare(strict_types=1);

namespace App\Repositories;


use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateAmountProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Report;
use App\Services\GeneratorService;
use App\Repositories\ReportRepository;

class ProductRepository
{
    protected Product $modelProduct;
    protected ReportRepository $reportRepository;

    public function __construct(Product $modelProduct, ReportRepository $reportRepository)
    {
        $this->modelProduct = $modelProduct;  
        $this->reportRepository = $reportRepository;  
    }
    
    public function store(StoreProductRequest $request)
    {

        $store = $this->modelProduct->create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'amount' => $request->amount
        ]);


        $categoryName = Category::where('id', $request->category_id)->pluck('name')->first();

        $generatorCode = new GeneratorService();
        $code = $generatorCode->codeGenerator($categoryName, $store->id);

        $store->update([
            'code' => $code
        ]);
        $this->reportRepository->createReport('Se creo el producto: ' . $request->name, $request->amount);
    }

    public function all()
    {
        return $this->modelProduct->orderBy('created_at', 'desc')->get();

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

            $this->reportRepository->createReport('Se quito/vendio stock a ' . $product->name, $request->amount);
    
            return true;
        }else{
            return false;
        }

    }

   
}
