<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Mois;
use App\Models\Statistique;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autres()
    {
        $produit = Produit::all();
        $mois = Mois::all();
        $current_month = Statistique::current_month();
        $client_fidele = Statistique::client_fidele();
        $collecte = Statistique::quantite_collecte();
        $vendu = Statistique::quantite_vendu();
        $recette = Statistique::montant_recette();
        $depense = Statistique::montant_depense();
        $benefice = Statistique::montant_benefice();
        $somme_recette = Statistique::somme_recette();
        $somme_depense = Statistique::somme_depense();
        $somme_benefice = Statistique::somme_benefice();
        return view('statistique.autres', [
            'produit' => $produit,
            'mois' => $mois,
            'current_month' => $current_month,
            'collecte' => $collecte,
            'vendu' => $vendu,
            'recette' => $recette,
            'depense' => $depense,
            'benefice' => $benefice,
            'somme_recette' => $somme_recette,
            'somme_depense' => $somme_depense,
            'somme_benefice' => $somme_benefice,
            'client_fidele' => $client_fidele
        ]);
    }

    public function recette_depense()
    {
        $mois = Mois::all();
        $recette = Statistique::montant_recette();
        $depense = Statistique::montant_depense();
        $benefice = Statistique::montant_benefice();
        $somme_recette = Statistique::somme_recette();
        $somme_depense = Statistique::somme_depense();
        $somme_benefice = Statistique::somme_benefice();
        return view('statistique.recette_depense', [
            'mois' => $mois,
            'recette' => $recette,
            'depense' => $depense,
            'benefice' => $benefice,
            'somme_recette' => $somme_recette,
            'somme_depense' => $somme_depense,
            'somme_benefice' => $somme_benefice
        ]);
    }

    // public function collecte_vente()
    // {
    //     $collecte = Statistique::quantite_collecte();
    //     return view('statistique.produit', [
    //         'collecte' => $produit,
    //         'mois' => $mois,
    //         'current_month' => $current_month
    //     ]);
    // }
    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }



    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Collecteur  $collecteur
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Collecteur $collecteur)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Collecteur  $collecteur
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Collecteur $collecteur)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Collecteur  $collecteur
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Collecteur $collecteur)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Collecteur  $collecteur
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Collecteur $collecteur)
    // {
    //     //
    // }
}
