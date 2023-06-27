<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientRepair;
use App\Models\Repair;
use App\Services\GeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::all();
        $repairs = Repair::orderBy('id','ASC')->get();

        
        return view('repairs/index', compact('repairs', 'clients'));
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
    public function store(Request $request)
    {
        //
        $request->validate([
            'description' => 'required',
            'category' => 'required'
        ]);


        $repairCreate = Repair::create([
            'code' => $request->code,
            'description' => $request->description,
            'details' => $request->details,
            'price' => $request->price,
            'category' => $request->category,
            'client' => $request->client,
            'status' => 'Pendiente'
        ]);


        $generator = new GeneratorService();
        $code = $generator->codeGenerator($request->category, $repairCreate->id);

        Repair::where('id', $repairCreate->id)->update([
            'code' => $code
        ]);
        

       //$code = $request->code;
       //$repair = Repair::where('code', $code)->first()->clients()->attach($request->client);
       

        
        

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function show(Repair $repair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function edit(Repair $repair)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repair $repair)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repair $repair)
    {
        //

        $repair->delete();

        return back();
    }
    public function doneState(Repair $repair)
    {
        //

        $repair->update([
            'status' => 'Terminado'
        ]);
        
        return back();
    }

    public function processState(Repair $repair)
    {
        //

        $repair->update([
            'status' => 'En proceso'
        ]);

        return back();
    }

    public function pendingState(Repair $repair)
    {
        //

        $repair->update([
            'status' => 'Pendiente'
        ]);

        return back();
    }

}
