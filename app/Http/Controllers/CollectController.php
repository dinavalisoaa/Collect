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
        $all = Collect::fromQuery("select *from collect where id=".request('planning'));
        return view('collecte.list', [
            'list' => $all
        ]);
    }
}
