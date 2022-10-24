<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Report;
use App\Models\Stock;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();

        return view('products/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Report $report)
    {
        //
        
        $request->validate([
            'name' => 'required', 
            'code' => 'required',
            'amount' => 'required'
        ]);

        Product::create([
            'user_id' => auth()->user()->id,
            'code' => $request->code,
            'name' => $request->name,
            'category' => $request->category,
            'amount' => $request->amount
        ]);

        Report::create([
            'name' => 'Se creo el producto: ' . $request->name,
            'amount' => $request->amount
        ]);


        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return view('products.edit', compact('product'));
    }

    public function viewAmount(Product $product){
        return view('products.addAmount', compact('product'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //

        $product->update([
            'code' => $request->code,
            'name' => $request->name
        ]);
        return redirect('/producto')->with('status', 'Se actualizaron los datos correctamente');
    }

    public function addAmount(Request $request, Product $product, Report $report){
        $product->update([
            'amount' => ($product->amount + $request->amount)
        ]);

        $reports = Report::create([
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //

        $product->delete();
        return back();
    }

    //export

    public function exportPDF(Report $report){

        $reports = $report->all();

        $pdf = PDF::loadView('pdf.reports', compact('reports'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('reports-list.pdf');
    }
}
