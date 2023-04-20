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
        $all=array();
        if(request('tous')!=null){
            $all = Collect::fromQuery("select *from collect where 1=1 ");
        }else{
            $all = Collect::fromQuery("select *from collect where 1=1 and id=".request('planning'));
        }
        return view('collecte.list', [
            'list' => $all
        ]);
    }
}
