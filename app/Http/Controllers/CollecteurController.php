<?php

namespace App\Http\Controllers;

use App\Models\Collecteur;
use Illuminate\Http\Request;

class CollecteurController extends Controller
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
        return view('collecteur.add');
    }
    public function action_add(Request $request)
    {
        try {

            $file = $request->file('photo');
            $photo = $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file->getClientOriginalName());

            $collecteur = new Collecteur();
            $collecteur->nom = request('nom');
            $collecteur->photo = $destinationPath . "/" . $photo;

            $collecteur->contact = request('contact');
            $collecteur->mdp = request('nom');
            $collecteur->login = request('login');
            $collecteur->save();
        } catch (\Exception $th) {
            throw $th;
        }
        // return
        return redirect('collecteur/list');
    }
    public function list()
    {
        $all = Collecteur::all();
        return view('collecteur.list', [
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
     * @param  \App\Models\Collecteur  $collecteur
     * @return \Illuminate\Http\Response
     */
    public function show(Collecteur $collecteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collecteur  $collecteur
     * @return \Illuminate\Http\Response
     */
    public function edit(Collecteur $collecteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collecteur  $collecteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collecteur $collecteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collecteur  $collecteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collecteur $collecteur)
    {
        //
    }
}
