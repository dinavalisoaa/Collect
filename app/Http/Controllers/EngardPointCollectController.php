<?php

namespace App\Http\Controllers;

use App\Models\Engard;
use App\Models\EngardPointCollecte;
use App\Models\PointCollect;
use App\Models\Region;
use Illuminate\Http\Request;

class EngardPointCollectController extends Controller
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
        return view('engardpointcollect.add', [
            'region' => $produit
        ]);
    }
    public function action_add(Request $request)
    {
        try {
          echo request('id');
            // $engardpointcollect = new PointCollect();
            // $engardpointcollect->nom = request('nom');
            // $engardpointcollect->longitude = request('longitude');
            // $engardpointcollect->latitude = request('latitude');
            // $engardpointcollect->regionid = request('region');
            // $engardpointcollect->save();
        } catch (\Exception $th) {
            throw $th;
        }
        // return redirect('e-pointcollect/list');
    }
    public function list()
    {
        $all = Engard::all();
        // $pt=PointCollect::fromQuery("select *from pointcollect where id=");
        return view('engardpointcollect.list', [
            'list' => $all
        ]);
    } public function detail()
    {
            $id=request('pt');
        $all = Engard::find($id)->getPointCollectes();
        return view('engardpointcollect.detail', [
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
