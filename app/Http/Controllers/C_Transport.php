<?php

namespace App\Http\Controllers;

use App\Mail\ContratMail;
use App\Models\Contrat;
use App\Models\Societe;
use App\Models\V_Contrat;
use App\Models\V_transport;
use App\Models\Transport;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * Summary of Transport
 */
class C_Transport extends Controller
{

    public function allTransport()
    {
        try {
            $transports = V_transport::where('etat', 0)->get();
            $societes = Cache::remember('societes', now()->addHour(), function () {
                return Societe::all();
            });
            $societe = new Societe();
            $companies = $societe->allCompany();
            return view('transport', ['transports' => $transports, 'companies' => $companies, 'societes' => $societes]);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function c_allCompany(){
        $company = new Societe();
        $companies = $company->allCompany();
        return view('marchandise',['transports'=>$companies]);
    }
    public function saveTransport(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'contact' => 'required|max:10|min:10',
            ]);
            if ($validator->fails()) {
                return redirect('http://127.0.0.1:8000/')
                    ->withErrors($validator)
                    ->withInput();
            }
            $trans = new Transport();
            $trans->nom = request('nom');
            $trans->contact = request('contact');
            $trans->idsociete = request('societe');
            $trans->marque = request('marque');
            $trans->type = request('type');
            $trans->capacite = request('capacite');
            $trans->immatriculation = request('immatriculation');
            $trans->etat = 0;
            $trans->save();
            return redirect()->action([C_Transport::class, 'allTransport']);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function saveContrat(Request $req)
    {
        try {
            $trans = new Contrat();
            $trans->transportid = request('idTransport');
            $trans->duree = request('duree');
            $trans->montant = request('montant');
            $trans->datedebut = request('datedebut');
            $trans->etatpaiement = 0;
            $trans->save();
            return redirect()->action([C_Transport::class, 'allTransport']);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
    public function readContract()
    {
        try {
            $idTransport = request('idTransport');
            $contrat = V_Contrat::find($idTransport);
            $filePath = 'contrat.txt';
            if (file_exists($filePath)) {
                $content = file_get_contents($filePath);
                $content = str_replace('{{$contrat->societe}}', $contrat->societe, $content);
                $content = str_replace('{{$contrat->transport}}', $contrat->transport, $content);
                $content = str_replace('{{$contrat->montant}}', $contrat->montant, $content);
                $content = str_replace('{{$contrat->marque}}', $contrat->marque, $content);
                $content = str_replace('{{$contrat->immatriculation}}', $contrat->immatriculation, $content);
                $content = str_replace('{{$contrat->duree}}', $contrat->duree, $content);
                $content = str_replace('{{$contrat->datedebut}}', $contrat->datedebut, $content);
                $content = str_replace('{{$contrat->datefin}}', $contrat->datefin, $content);
                if (!empty($content)) {
                    $contentWithBr = nl2br($content);
                    $html = '<div>' . $contentWithBr . '</div>';
                    $html .= '<a href="' . url('/') . '">Retour</a>';
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
    public function sendEmail()
    {
        try {
            Mail::to('minolalaina2802@gmail.com')->send(new ContratMail());
        } catch (\Throwable $e) {
            return '<div>FAILED ' . $e . '</div>';
        }
    }



}