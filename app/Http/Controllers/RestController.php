<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use Illuminate\Support\Facades\Cache;
use App\Models\Transport;
use Illuminate\Database\Eloquent\Model;

class RestController extends Controller
{
    public function saveCompany($name)
    {
        try {
            $company = new Societe();
            $company->nom = $name;
            $company->save();
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json(['error' => 'Une erreur est survenue lors de l\'enregistrement de la société.']);
        }
        return response()->json(['success' => 'La société a été enregistrée avec succès.']);
    }
    public function allCompany()
    {
        try {
            $companies = Cache::remember('places', now()->addHour(), function () {
                return $companies = Societe::all();
            });
            return response()->json($companies);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json(['error' => 'Une erreur est survenue']);
        }

    }
    public function modifyTransport($id, $contact)
    {
        try {
            Transport::where('id', $id)->update(['contact' => $contact]);
            return response()->json(['success' => 'Modification enregistrée']);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json(['error' => $e]);
        }
    }
    public function disableTransport($id)
    {
        try {
            Transport::where('id', $id)->update(['etat' => 5]);
            return response()->json(['success' => 'Modification enregistrée']);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json(['error' => $e]);
        }
    }
}
