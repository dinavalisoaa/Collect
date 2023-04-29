<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Util extends Model
{

    use HasFactory;
   public static function crypt(string $str){

    $tab=DB::select("select md5('".$str."') as test");
        return $tab[0]->test;
   }
   public static function format($num){
    return number_format($num, 2, '.', ' ');
   }
   public static function now(){
    return date('Y-m-j', strtotime('today'));;
   } public static function getEtat($id){
    $tab = Commande::fromQuery("select *from commande where id=".$id);
        return $tab[0]->etat;
}
   public static function date($date){
    return date('j F Y', strtotime($date));
   }
    public static function login($email,$mdp){
        $tab=Users::fromQuery("select *From users where Email='".$email."' and mdp='".$mdp."' limit 1");
        $id=0;
        if(count($tab)==0){
            return -1;
        }
        return $tab[0]['id'];

    }
}
