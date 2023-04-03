<?php

namespace App\Http\Controllers;

use App\Models\PlanningCollect;
use App\Models\Produit;
use Illuminate\Http\Request;

class PlanningCollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $produit = Produit::all();
        return view('planningcollect.add', [
            'produit' => $produit
        ]);
    }
    public function action_add(Request $request)
    {
        try {
            $planningcollect = new PlanningCollect();
            $planningcollect->produitid = request('produit');
            $planningcollect->tonnage = request('tonnage');
            $planningcollect->datedelai = request('datedelai');
            $planningcollect->budget = request('budget');
            $planningcollect->save();
        } catch (\Exception $th) {
            throw $th;
        }
        // return
        return redirect('planningcollect/list');
    }
    public function list()
    {
        $all = PlanningCollect::all();
        return view('planningcollect.list', [
            'list' => $all
        ]);
    }
    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanningCollect  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function show(PlanningCollect $planningCollect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanningCollect  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanningCollect $planningCollect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanningCollect  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanningCollect $planningCollect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanningCollect  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanningCollect $planningCollect)
    {
        //
    }
}
