<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Collect;
use App\Models\Engard;
use App\Models\PlanningCollect;
use App\Models\Region;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $produit = Region::all();
        return view('charge.add', [
            'region' => $produit
        ]);
    }
    public function action_add(Request $request)
    {
        try {
            $charge = new Engard();
            $charge->nom = request('nom');
            $charge->longitude = request('longitude');
            $charge->latitude = request('latitude');
            $charge->regionid = request('region');
            $charge->save();
        } catch (\Exception $th) {
            throw $th;
        }
        // return
        return redirect('charge/list');
    }
    public function list()
    {
        $coll=PlanningCollect::find(request('id'));
        $all = Charge::fromQuery("select sum(montant) as montant,typechargeid from charge where planningcollecteid=".request('id').' group by planningcollecteid,typechargeid ');
        return view('charge.list', [
            'list' => $all,'collecte'=>$coll
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
     * @param  \App\Models\Engard  $charge
     * @return \Illuminate\Http\Response
     */
    public function show(Engard $charge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Engard  $charge
     * @return \Illuminate\Http\Response
     */
    public function edit(Engard $charge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Engard  $charge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Engard $charge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Engard  $charge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Engard $charge)
    {
        //
    }
}
