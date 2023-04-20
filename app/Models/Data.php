<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model{
    protected $table = 'data';
    protected $fillable = [
        'id',
        'margebenef',
    ];
    public $timestamps = false;
    use HasFactory;

    public function setMargebenefAttribute($value){
        if(!is_numeric($value)) throw new \Exception('La marge doit etre numeric!');
        $this->attributes['margebenef'] = $value;
    }
}
