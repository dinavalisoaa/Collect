<?php

namespace App\Http\Controllers;

use App\Models\Engard;
use App\Models\Region;
use Illuminate\Http\Request;

class EngardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $produit = Region::all();
        return view('engard.add', [
            'region' => $produit
        ]);
    }
    public function action_add(Request $request)
    {
        try {
            $engard = new Engard();
            $engard->nom = request('nom');
            $engard->longitude = request('longitude');
            $engard->latitude = request('latitude');
            $engard->regionid = request('region');
            $engard->save();
        } catch (\Exception $th) {
            throw $th;
        }
        // return
        return redirect('engard/list');
    }
    public function list()
    {
        $all = Engard::all();
        return view('engard.list', [
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
     * @param  \App\Models\Engard  $engard
     * @return \Illuminate\Http\Response
     */
    public function show(Engard $engard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Engard  $engard
     * @return \Illuminate\Http\Response
     */
    public function edit(Engard $engard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Engard  $engard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Engard $engard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Engard  $engard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Engard $engard)
    {
        //
    }
}
