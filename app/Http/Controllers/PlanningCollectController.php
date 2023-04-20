<?php

namespace App\Http\Controllers;

use App\Models\PlanningCollect;
use App\Models\PointCollect;
use App\Models\Produit;
use Illuminate\Http\Request;

class PlanningCollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()

    {
        $produit = PointCollect::all();
        return view('planningcollect.add', [
            'produit' => $produit
        ]);
    }
    public function action_add(Request $request)
    {
        try {
            // date(f)
            $planningcollect = new PlanningCollect();
            $planningcollect->pointcollectid = request('produit');
            // $planningcollect->tonnage = request('tonnage');
            $planningcollect->datedelai = request('datedelai');
            $planningcollect->budget = request('budget');
            // echo request('datedelai');
            $planningcollect->save();
        } catch (\Exception $th) {
            throw $th;
        }
        // return
        return redirect('admin/dash');
    }
    public function list()
    {
        $all = PlanningCollect::all();
        return view('planningcollect.list', [
            'list' => $all
        ]);
    }
    public function detail()
    {
        $produit = PointCollect::all();
        $all = PlanningCollect::fromQuery("select *From planningcollecte where date(datedelai)=date('" . request('date') . "')");
        return view('planningcollect.detail', [
            'list' => $all, 
            'produit' => $produit,
            'dates' =>PlanningCollect::add_zero(request('date'))
        ]);
    }
    public function test()
    {
        $all = PlanningCollect::all();
        $ro = new PlanningCollect();
        $ro->id = -1;
        $ro->budget = 0;
        $date = request('date');
        $o = explode("-", $date);
        $mois = 0;
        $jour = 0;
        echo $o[0];
        if ($o[1] <= 9) {
            $mois = "0" . $o[1];
        }
        if ($o[2] <= 9) {
            $jour = "0" . $o[2];
        }
        // echo $jour;
        $last = $o[0] . "-" . $mois . '-' . $jour;
        //  print_r($o);
        foreach ($all as $row) {
            // echo $row->datedelai ;
            if ($row->datedelai == $last) {
                $ro = $row;
            }
        }
        $array = array();
        $array[0] = $ro;
        return view('api', [
            'all' => [$ro]
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
     * @param  \App\Models\PlanningCollect  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function show(PlanningCollect $planningCollect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanningCollect  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanningCollect $planningCollect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanningCollect  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanningCollect $planningCollect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanningCollect  $planningCollect
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlanningCollect $planningCollect)
    {
        //
    }
}
