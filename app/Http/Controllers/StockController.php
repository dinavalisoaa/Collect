<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Engard;
use App\Models\Mouvement;
use App\Models\EtatStock;
use App\Models\Stock;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
class StockController extends Controller{
    const PERPAGE = 10;

    public function newMouvement($messages=[]){
        $prods = Produit::all();
        $engs = Engard::all();
        return view('mouvement.new' , [
            'messages' => $messages,
            'produits' => $prods,
            'engards' => $engs,
        ]);
    }

    public function insertEntree(){
        try {
            $idprod = request('produit');
            $prod = Produit::find($idprod);
            $mouv = new Mouvement();
            $mouv->prixunitaire = request('pu');
            $mouv->quantite = request('quantite');
            $mouv->date = request('date');
            $mouv->produitid = $idprod;
            $mouv->engardid = request('engard');
            $prod->addEntree($mouv);
            return $this->newMouvement(['success0'=>'Enregistrer avec succes!']);
        } catch (\Exception $e) {
            return $this->newMouvement(['error0'=>$e->getMessage()]);
        }
    }

    public function insertSortie(){
        try {
            $idprod = request('produit');
            $prod = Produit::find($idprod);
            $mouv = new Mouvement();
            $mouv->quantite = request('quantite');
            $mouv->date = request('date');
            $mouv->produitid = $idprod;
            $mouv->engardid = request('engard');
            $prod->addSortie($mouv);
            return $this->newMouvement(['success1'=>'Enregistrer avec succes!']);
        } catch (\Exception $e) {
            return $this->newMouvement(['error1'=>$e->getMessage()]);
        }
    }

    public function listMouvement($messages=[]){
        $tab = Mouvement::with('produit')->orderBy('id', 'desc')->paginate(self::PERPAGE);
        $prods = Produit::all();
        $engs = Engard::all();
        return view('mouvement.list',[
            'mouvements' => $tab,
            'produits' => $prods,
            'engards' => $engs,
        ]);
    }

    public function modifMouvement($id, $messages=[]){
        $mouv = Mouvement::find($id);
        $prods = Produit::all();
        $engs = Engard::all();
        return view('mouvement.modif' , [
            'messages' => $messages,
            'produits' => $prods,
            'engards' => $engs,
            'mouvement' => $mouv,
        ]);
    }

    public function updateMouvement(){
        $id = request('id');
        try {
            $mouv = Mouvement::find($id);
            $mouv->prixunitaire = request('pu');
            $mouv->quantite = request('quantite');
            $mouv->date = request('date');
            $mouv->produitid = request('produit');
            $mouv->engardid = request('engard');
            $mouv->save();
            return $this->modifMouvement($id, ['success'=>'Modifier avec succes!']);
        } catch (\Exception $e) {
            return $this->modifMouvement($id, ['error'=>$e->getMessage()]);
        }
    }

    public function deleteMouvement($id){
        $mouv = Mouvement::find($id);
        $mouv->delete();
        return redirect('/listMouvement');
    }

    public function filterMouvement(){
        $produit = request('produit');
        $engard = request('engard');
        echo $produit;
        $query = Mouvement::query();
        if($produit){
            $query->where('produitid', $produit);
        }
        if($engard){
            $query->where('engardid', $engard);
        }
        $tab = $query->with('produit')->orderBy('id', 'desc')->paginate(self::PERPAGE);
        $tab->appends(request()->query());
        $prods = Produit::all();
        $engs = Engard::all();
        return view('mouvement.list',[
            'mouvements' => $tab,
            'produits' => $prods,
            'engards' => $engs,
        ]);
    }

    public function listProduit(){
        $prods = Produit::paginate(self::PERPAGE);
        return view('mouvement.choice', ['produits'=>$prods]);
    }

    public function etatStock($id){
        $prod = Produit::with('stocks')->with('typestock')->with('mouvements')->find($id);
        $etat = EtatStock::find($id);
        if(!isset($etat)){
            $etat = new EtatStock();
            $etat->valeurstock = 0;
            $etat->quantitestock = 0;
        }
        return view('mouvement.etat',[
            'produit' => $prod,
            'etat' => $etat,
        ]);
    }
}
