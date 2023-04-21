<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Societe;
use App\Models\V_Contrat;
use App\Models\V_transport;
use App\Models\Transport;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

/**
 * Summary of Transport
 */
class C_Transport extends Controller
{

    public function allTransport()
    {
        try {
            $transports = V_transport::where('etat', 0)->get();
            $companies = Cache::remember('companies', now()->addHour(), function () {
                return Transport::get(['id', 'immatriculation']);
            });
            return view('transport', ['transports' => $transports, 'companies' => $companies]);

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

    public function readContract(){
        try {
            // $id = request('idTransport');
            $idTransport=1;
            $contrat=V_Contrat::find($idTransport);
            $filePath = 'contrat.txt';
            if (file_exists($filePath)) {
                $content = file_get_contents($filePath);
                $content=str_replace('{{$contrat->societe}}', $contrat->societe, $content);
                $content=str_replace('{{$contrat->transport}}', $contrat->transport, $content);
                $content=str_replace('{{$contrat->montant}}', $contrat->montant, $content);
                $content=str_replace('{{$contrat->marque}}', $contrat->marque, $content);
                $content=str_replace('{{$contrat->immatriculation}}', $contrat->immatriculation, $content);
                $content=str_replace('{{$contrat->duree}}', $contrat->duree, $content);
                $content=str_replace('{{$contrat->datedebut}}', $contrat->datedebut, $content);
                $content=str_replace('{{$contrat->datefin}}', $contrat->datefin, $content);
                if (!empty($content)) {
                    $contentWithBr = nl2br($content);
                    $html = '<div>' . $contentWithBr . '</div>';
                    $pdf = new Dompdf();
                    $pdf->loadHtml($html);
                    $pdf->render();
                    $output = $pdf->output();
                    return response($output, 200)->header('Content-Type', 'application/pdf');
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
    public function showPDF(){
        $pdf = new Dompdf();
        $pdf->loadHtml('<h1>Hello, World!</h1>');
        $pdf->render();
        $output = $pdf->output();
        return response($output, 200)->header('Content-Type', 'application/pdf');
    }

}
