<?php

namespace App\Http\Controllers;

use App\Models\Collect;
use App\Models\Collecteur;
use Exception;
use Illuminate\Http\Request;

class CollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function list()
    {
        $all = array();
        if (request('tous') != null) {
            $all = Collect::fromQuery("select *from collect where 1=1 ");
        } else {
            if (request('etat') != null) {
                $all = Collect::fromQuery("select *from collect where 1=1 and planningcollecteid=" . request('planning').' and etat='.request('etat'));
            } else {
                $all = Collect::fromQuery("select *from collect where 1=1 and planningcollecteid=" . request('planning'));
            }
        }
        return view('collecte.list', [
            'list' => $all, 'plan' => request('planning')
        ]);
    }
}
