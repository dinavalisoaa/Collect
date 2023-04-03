<?php

namespace App\Http\Controllers;

use App\Models\PointCollect;
use App\Models\Region;
use Illuminate\Http\Request;

class PointCollectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function add()
    {
        $produit = Region::all();
        return view('pointcollect.add', [
            'region' => $produit
        ]);
    }
    public function action_add(Request $request)
    {
        try {
            $pointcollect = new PointCollect();
            $pointcollect->nom = request('nom');
            $pointcollect->longitude = request('longitude');
            $pointcollect->latitude = request('latitude');
            $pointcollect->regionid = request('region');
            $pointcollect->save();
        } catch (\Exception $th) {
            throw $th;
        }
        // return
        return redirect('pointcollect/list');
    }
    public function list()
    {
        $all = PointCollect::all();
        return view('pointcollect.list', [
            'list' => $all
        ]);
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
     * @param  \App\Models\PointCollect  $pointCollect
     * @return \Illuminate\Http\Response
     */
    public function show(PointCollect $pointCollect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PointCollect  $pointCollect
     * @return \Illuminate\Http\Response
     */
    public function edit(PointCollect $pointCollect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PointCollect  $pointCollect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PointCollect $pointCollect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PointCollect  $pointCollect
     * @return \Illuminate\Http\Response
     */
    public function destroy(PointCollect $pointCollect)
    {
        //
    }
}
