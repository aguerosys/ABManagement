<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateAmountProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Report;
use App\Models\Stock;
use App\Repositories\ProductRepository;
use App\Repositories\ReportRepository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ProductController extends Controller
{
    protected ProductRepository $productRepository;
    protected ReportRepository $reportRepository;

    public function __construct(ProductRepository $productRepository, ReportRepository $reportRepository)
    {
        $this->productRepository = $productRepository;
        $this->reportRepository = $reportRepository;
    }

    public function index()
    {
        $products = $this->productRepository->all();

        return view('products/index', compact('products'));
    }

    public function store(StoreProductRequest $request)
    {
        
        $this->productRepository->store($request);

        Report::create([
            'name' => 'Se creo el producto: ' . $request->name,
            'amount' => $request->amount
        ]);

        return back();
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function viewAmount(Product $product){
        return view('products.addAmount', compact('product'));
    }

    public function update(UpdateProductRequest $request)
    {
        $this->productRepository->update($request);
        return redirect('/producto')->with('status', 'Se actualizaron los datos correctamente');
    }

    public function addAmount(UpdateAmountProductRequest $request, Product $product){

        $this->productRepository->addAmount($request, $product);

        Report::create([
            'name' => 'Se agrego mas stock a '. $product->name,
            'amountAdd' => $request->amount
        ]);
        
        return redirect('/producto')->with('status', 'Se actualizo el stock correctamente con exito');
    }

    
    public function amountUpdate(UpdateAmountProductRequest $request, Product $product, Report $report)
    {
        
        $update = $this->productRepository->amountUpdate($request, $product, $report);

        if($update == true){
            return redirect('/producto')->with('status', 'Se actualizo el stock correctamente con exito');
        }else{
            return redirect('/producto')->with('status', 'No se puede actualizar el stock, ya que la cantidad a vender es mayor a la cantidad en stock');
        }

    }

    public function destroy(Product $product)
    {
        $this->productRepository->destroy($product);
        return back();
    }

    public function exportPDF(){

        return $this->reportRepository->exportPDF();
    }
}
