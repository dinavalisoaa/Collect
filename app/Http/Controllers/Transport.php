<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use App\Models\V_transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Transport extends Controller
{
    public function allTransport()
    {
        try {
            $transports = Cache::remember('transports', now()->addHour(), function () {
                return V_transport::all();
            });
            // $companies = Cache::remember('companies', now()->addHour(), function () {
            //     return Societe::all();
            // });
            // return view('transport', ['transports' => $transports,'companies' =>$companies]);
            return view('transport', ['transports' => $transports]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function saveTransport(Request $req)
    {
        try {

        } catch (\Exception $ex) {
            $trace = $ex->getTraceAsString();
            echo $ex->getMessage();
            dump($trace);
        }
    }
}
