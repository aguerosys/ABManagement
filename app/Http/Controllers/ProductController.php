<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateAmountProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Report;
use App\Models\Stock;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ProductController extends Controller
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->all();

        return view('products/index', compact('products'));
    }

    public function store(StoreProductRequest $request, Report $report)
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

        $this->productRepository->addAmount($request);

        Report::create([
            'name' => 'Se agrego mas stock a '. $product->name,
            'amountAdd' => $request->amount
        ]);
        
        return redirect('/producto')->with('status', 'Se actualizo el stock correctamente con exito');
    }

    
    public function amountUpdate(Request $request, Product $product, Report $report)
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
    
            return redirect('/producto')->with('status', 'Se desconto correctamente el stock del producto');
        }else{
            return redirect('/producto')->with('status', 'El producto no tiene la cantidad que se le esta quitando');

        }

    }

    public function destroy(Product $product)
    {
        $this->productRepository->destroy($product);
        return back();
    }

    public function exportPDF(Report $report){

        $reports = $report->all();

        $pdf = PDF::loadView('pdf.reports', compact('reports'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('reports-list.pdf');
    }
}
