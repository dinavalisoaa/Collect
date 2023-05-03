<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Detail;
use App\Models\DetailLivraison;
use App\Models\Paiement;
use App\Models\Util;
use App\Models\Livraison;
use App\Models\Mouvement;
use App\Models\Produit;
use App\Models\DetailCommande;
use Exception;
use Illuminate\Http\Request;
class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voir_detail()
    {
        $detail = DetailCommande::fromQuery('select *from detailcommande where commandeid=' . request('id'));
        echo $detail[0]->getProduit();
        return view('commande.detail', [
            'detail' => $detail,
            'id' => request('id'),
        ]);
    }
    public function add_livraison()
    {
        // id |    date    | commandeid | delaipaiement
       
        
        $message = '';
        $list = DetailCommande::fromQuery('select *from detailcommande where commandeid=' . request('id'));
        try {
            foreach ($list as $key) {
       
                $idprod = $key->produitid;
                $prod = Produit::find($idprod);
// echo $prod->epuise($key->quantite);
                $mouv = new Mouvement();
                $mouv->quantite = $key->quantite;
                $mouv->produitid = $idprod;
                $mouv->date = Util::now();;
                $mouv->engardid = 1;
                // echo $prod->epuise($key->quantite)['message'];
                $prod->addSortie($mouv,request('id'));
            // break;
            }
            $message = '200';

        } catch (Exception $ec) {
            // throw $ec;
            $message = $ec->getMessage();
        }
        if($message=='200'){
        \DB::update('update commande set etat=1 where id='.request('id'));
        }
    
    }
    public function payer(){
        $li=Livraison::find(request('id'));
        try {
    $livra=new Paiement();

            $livra->date=Util::now();
            $livra->livraisonid=request('id');
            // {{$row->getLivraison()->getResteApayer()}}
            $livra->montant=request('montant');
            $livra->save();
        } catch (\Throwable $th) {
            return json_encode(
                ['message'=>'404','montant'=>0]
            );
        }
        $mon=$li->getResteApayer();
        $mon=Util::format($mon);

    return json_encode(
        ['message'=>'200','montant'=>$mon]
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
        return view('commande.add_detail', [
            'commande' => $last['id'],
            'detail' => $detail,
            'produit' => $produit,
        ]);
    }

    public function new_detail(Request $req)
    {
        $commandeid = request('commandeid');
        $detail = Commande::details($commandeid);
        $produit = Produit::all();
        return view('commande.add_detail', [
            'commande' => $commandeid,
            'detail' => $detail,
            'produit' => $produit,
        ]);
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
    public function liste($messages = [])
    {
        $commande = Commande::list();
        return view('commande.liste', [
            'messages' => $messages,
            'commande' => $commande,
        ]);
    }

    public function list_detail()
    {
        $commandeid = request('commandeid');
        $detail = DetailCommande::details($commandeid);
        return view('commande.details', [
            'detail' => $detail,
            'id' => $commandeid,
        ]);
    }
}
