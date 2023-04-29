<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Collecteur;
use App\Models\Mois;
use App\Models\Statistique;
use App\Models\Util;
use Collator;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class AdminController extends Controller
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

    public function home()
    {
        $mois = Mois::all();
        
        $recette = (Statistique::montant_recette());
        $depense =( Statistique::montant_depense());
        $benefice =(Statistique::montant_benefice());
        $somme_recette =Util::format( Statistique::somme_recette());
        $somme_depense =Util::format( Statistique::somme_depense());
        $somme_benefice = Util::format(Statistique::somme_benefice());
        return view('admin.home', [
            'mois' => $mois,
            'recette' => $recette,
            'depense' => $depense,
            'benefice' => $benefice,
            'somme_recette' => $somme_recette,
            'somme_depense' => $somme_depense,
            'somme_benefice' => $somme_benefice
        ]);
        // return view('admin/home');
    }

    public function action_login(Request $req)
    {
        $id = Admin::login(request('login'), request('mdp'));
        if ($id == -1) {
            return redirect('/');
        }
        // $req->put->session('sessionid', $id);
        return redirect('admin/home');
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
    public function dash(Request $request)
    {
        // $mois=
        if(request('mois')!=null&&request('annee')!=null){
        return view('admin.dash',[
            'mois'=>request('mois'),
            'annee'=>request('annee')
        ]);

        }
        return view('admin.dash');
    }
    public function detail(Request $request)
    {
      
        return redirect('planningcollect/detail?date='.request('date'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
