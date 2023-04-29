<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model{
    use HasFactory;
    protected $table='livraison';
    protected $fillable=[
        'id',
        'nom'
    ];
    public $timestamps=false;
    public static function getLast(){
        $tab = Livraison::fromQuery("select * from livraison order by id desc limit 1");
        return $tab[0]->id;
    }
}
