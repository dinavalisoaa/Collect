<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Collect;
use App\Models\Collecteur;
use App\Models\PointCollect;
use App\Models\Produit;
use App\Models\TypeCharge;
use Exception;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function login_collecteur()
    {
        $action = Collecteur::login(request('login'), request('mdp'));
        if ($action == -1) {
            return json_encode([
                'data' => [
                    'message' => 'logine error', 'code' => 404
                ]
            ]);
        }
        return json_encode([
            'data' => [
                'message' => 'success', 'code' => 200
            ]
        ]);
    }

    public function liste_typecharge()
    {
        $all = array([]);
        try {
            $all = TypeCharge::all();
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'list' => $all
            ]
        ]);
    }
    // Ajouter collect profil collecteur
    public function add()
    {
        try {
            $new = new Collect();
            $new->quantite = request('quantite');
            $new->date = request('date');
            $new->prixunitaire = request('prixunitaire');
            $new->pointcollectid = request('pointcollectid');
            $new->collecteurid = request('collecteurid');
            $new->produitid = request('produitid');
            $new->save();
            # code...
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'login error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'message' => 'successful', 'code' => 200
            ]
        ]);
    }
    // Liste des produits a collecteur
    public function liste_produit()

    {
        $all = array([]);
        try {
            $all = Produit::all();
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'list' => $all
            ]
        ]);
    }
    // 
    public function liste_produit_one($id)
    {
        $all = array([]);
        try {
            $all = Produit::find($id);
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'list' => $all
            ]
        ]);
    }
    // Liste des charges
    public function liste_charge()
    {
        $all = array([]);
        try {
            $all = Charge::all();
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'list' => $all
            ]
        ]);
    }
    // SUpprimer charge
    public function delete_charge($id)
    {
        $all = array([]);
        try {
            \DB::update('delete from charge where id=?', [$id]);
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'list' => $all
            ]
        ]);
    }
    // Liste des charges
    public function liste_charge_one($id)
    {
        $all = array([]);
        try {
            $all = Charge::find($id);
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'list' => $all
            ]
        ]);
    }
    //Liste des Points Collects
    public function liste_point()
    {
        $all = array([]);
        try {
            $all = PointCollect::all();
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'list' => $all
            ]
        ]);
    } //Liste des  Collects
    public function liste_collect()

    {
        $all = array([]);
        try {
            $all = Collect::all();
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'list' => $all
            ]
        ]);
    }
    //Find one
    public function liste_collect_one($id)

    {
        $all = array([]);
        try {
            $all = Collect::find($id);
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'list' => $all
            ]
        ]);
    }
    //Ajout de charge
    public function add_charge()

    {
        try {
            if ((request('montant') != null &&  request('montant') != "") &&
                (request('typechargeid') != null &&  request('typechargeid') != "") &&
                (request('collectid') != null &&  request('collectid') != "")
            ) {
                $new = new Charge();
                $new->montant = request('montant');
                $new->date = request('date');
                $new->typechargeid = request('typechargeid');
                $new->collectid = request('collectid');
                $new->save();
            } else {
                throw new Exception("");
            }
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'ajout error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'message' => 'successful', 'code' => 200
            ]
        ]);
    }
    public function add_typecharge()

    {
        try {
            if (request('nom') != null && request('nom') != "") {
                $new = new TypeCharge();
                $new->nom = request('nom');
                $new->save();
            } else {
                return  json_encode([
                    'data' => [
                        'message' => 'ajout error', 'code' => 404
                    ]
                ]);
            }
        } catch (Exception $r) {
            return  json_encode([
                'data' => [
                    'message' => 'ajout error', 'code' => 404
                ]
            ]);
        }
        return  json_encode([
            'data' => [
                'message' => 'successful', 'code' => 200
            ]
        ]);
    }
}
