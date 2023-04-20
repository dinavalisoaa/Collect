<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use App\Models\V_transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Transport extends Controller
{
    public function allTransport()
    {
        try {
            $transports = V_transport::where('etat', 0)->get();
             $companies = Cache::remember('companies', now()->addHour(), function () {
                return Societe::all();
            });
            return view('transport', ['transports' => $transports,'companies' =>$companies]);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    // public function saveTransport(Request $req)
    // {
    //     try {

    //     } catch (\Exception $ex) {
    //         $trace = $ex->getTraceAsString();
    //         echo $ex->getMessage();
    //         dump($trace);
    //     }
    // }
    public function readContract()
    {
        try {
            $filePath = 'contrat.txt';
            if (file_exists($filePath)) {
                $content = file_get_contents($filePath);
                if (!empty($content)) {
                    $contentWithBr = nl2br($content);
                    $html = '<div>' . $contentWithBr . '</div>';

                    return view('contract', ['html' => $html]);
                } else {
                    throw new \Exception('Le contenu du fichier est vide.');
                }
            } else {
                throw new \Exception('Le fichier n\'existe pas.');
            }
        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}