<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Saison;
use App\Models\TypeProduit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        // $produit = Produit::all();
        $typeproduit = TypeProduit::all();
        $saison = Saison::all();
        return view('produit.add',[
            'saison'=> $saison,
            'typeproduit'=> $typeproduit
        ]);
    }
    public function action_add(Request $request)
    {
        try {
            $produit = new Produit();
            $produit->modeconservation = request('mode');
            $produit->saisonid = request('saison');
            $produit->typeproduitid = request('type');
            $produit->nom = request('nom');
            $produit->dureeperemption = request('duree');
            $produit->save();
        } catch (\Exception $th) {
            throw $th;
        }
        // return
        return redirect('produit/list');
    }
    public function list()
    {
        $all = Produit::all();
        return view('produit.list', [
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
     * @param  \App\Models\Produit  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $planningCollect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $planningCollect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $planningCollect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $planningCollect)
    {
        //
    }
}
