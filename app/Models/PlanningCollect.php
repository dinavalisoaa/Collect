<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningCollect extends Model
{
    use HasFactory;
    protected $table = 'planningcollecte';
    public $timestamps = false;
    public function getProduit()
    {
        return Produit::find($this->produitid);
    }
    public function counts()
    {
        $o=Collect::fromQuery('select *From collect where planningcollecteid='.$this->id);
        return count($o);
    } public function getPointCollecte()
    {
        return PointCollect::find($this->pointcollectid);
    }
    public function getEtatBudget(){
        $re=PointCollect::fromQuery("select *From v_etatbudget where planningcollecteid=".$this->id);
        return $re[0]->montant;
    }
    public static function add_zero($date){
        $o = explode("-", $date);
        $mois = $o[1];
        $jour = $o[2];
        if ($o[1] <= 9) {
            $mois = "0" . $o[1];
        }
        if ($o[2] <= 9) {
            $jour = "0" . $o[2];
        }
        $last = $o[0] . "-" . $mois . '-' . $jour;
    return $last;
    }
    public static function check($date)
    {
        $all = PlanningCollect::all();
        $ro = new PlanningCollect();
        $ro->id = -1;
        $ro->budget = 0;
        $o = explode("-", $date);
        $mois = $o[1];
        $jour = $o[2];
        if ($o[1] <= 9) {
            $mois = "0" . $o[1];
        }
        if ($o[2] <= 9) {
            $jour = "0" . $o[2];
        }
        // echo $o[2];


        // echo $jour;
        $last = $o[0] . "-" . $mois . '-' . $jour;
        //  print_r($o);
        // echo $last;
        $array=array();
        foreach ($all as $row) {
            // echo '->'.$row->datedelai.'<>'.$last;
            if ($row->datedelai == $last) {
                $ro = $row;
                $array[]=$row;
                // echo $row;
            }
        }
        return $array;
    }
}
