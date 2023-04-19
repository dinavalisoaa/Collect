<?php

namespace App\Http\Controllers;
use App\Models\Data;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DataController extends Controller{
    public function modifMarge($messages=[]){
        $data = Data::find(1);
        dump($messages);
        return view('action.marge',[
            'messages' => $messages,
            'marge' => $data->margebenef,
        ]);
    }

    public function updateMarge(){
        $marge = request('marge');
        try {
            $data = Data::find(1);
            $data->margebenef = $marge;
            $data->save();
            return $this->modifMarge(['success'=>'Marge mise a jour avec succes!']);
        } catch (\Exception $e) {
            return $this->modifMarge(['error'=>$e->getMessage()]);
        }
    }
}
