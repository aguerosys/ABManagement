<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Report;

class ProductController extends Controller
{
    public function index()
    {
        //
        $products = Product::all();

        return response()->json($products, 200);
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
        
        
        $products = Product::create([
            'user_id' => $request->user_id,
            'code' => $request->code,
            'name' => $request->name,
            'category' => $request->category,
            'amount' => $request->amount
        ]);

        Report::create([
            'name' => 'Se creo el producto: ' . $request->name,
            'amount' => $request->amount
        ]);


        return response()->json($products, 201);


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

        $products=$product->update([
            'code' => $request->code,
            'name' => $request->name
        ]);
   
        return response()->json($products,200);

    }

    public function addAmount(Request $request, Product $product, Report $report){
        $products = $product->update([
            'amount' => ($product->amount + $request->amount)
        ]);

        $reports = Report::create([
            'name' => 'Se agrego mas stock a '. $product->name,
            'amountAdd' => $request->amount
        ]);
        
        return response()->json($products, 200);
    }

    
    public function amountUpdate(Request $request, Product $product, Report $report)
    {
        $resta = $product->amount - $request->amount;
        
        if(!($resta < 0)){

            $products = $product->update([
                'amount' => $resta
            ]);

            Report::create([
                'name' => 'Se quito/vendio stock a '. $product->name,
                'amountSold' => $request->amount
            ]);
            return response()->json($products, 200);
        }else{
                return response()->json('Error', 400);

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

        $products = $product->delete();
        return response()->json($products, 200);
    }
}
