<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use App\Models\DetailCommande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voir_detail()
    {
        $detail=DetailCommande::fromQuery("select *from detailcommande where commandeid=".request('id'));
        echo $detail[0]->getProduit();
        return view('commande.detail',[
            'detail'=>$detail,'id'=>request('id')
        ]);
    }
    public function add_form()
    {
        $client = Client::all();
        return view(
            'commande.add_form',
            [
                'client' => $client
            ]
        );
    }

    public function new_commande(Request $req)
    {
        $commande = new Commande();
        $commande->date = request('date');
        $commande->clientid = request('client');
        $commande->save();
        $last = Commande::last();
        $detail = Commande::details($last['id']);
        $produit = Produit::all();
        return view(
            'commande.add_detail',
            [
                'commande' => $last['id'],
                'detail' => $detail,
                'produit' => $produit
            ]
        );
    }

    public function new_detail(Request $req)
    {
        $commandeid = request('commandeid');
        $detail = Commande::details($commandeid);
        $produit = Produit::all();
        return view(
            'commande.add_detail',
            [
                'commande' => $commandeid,
                'detail' => $detail,
                'produit' => $produit
            ]
        );
    }

    public function add_detail(Request $req)
    {
        $detail = new DetailCommande();
        $detail->commandeid = request('commandeid');
        $detail->produitid = request('produit');
        $detail->quantite = request('quantite');
        $detail->prixunitaire = request('prix');
        $detail->save();
        return redirect('commande/new_detail?commandeid=' . $detail->commandeid);
    }
  
    public function liste()
    {   
        $messages="";
        if(request('message')!=null){
            $messages=request('message');
        }
        $commande = Commande::list();
        return view(
            'commande.liste',
            [
            'messages' => $messages,
            'commande' => $commande
            ]
        );
    }

    public function list_detail()
    {
        $commandeid = request('commandeid');
        $detail = DetailCommande::details($commandeid);
        return view(
            'commande.details',
            [
                'detail' => $detail,'id'=>$commandeid
            ]
        );
    }
}
