<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Societe extends Model{
    use HasFactory;
    protected $table='societe';
    protected $fillable=[
        'id',
        'nom'
    ];
    public $timestamps=false;
    public function allCompany(){
        $companies = Cache::remember('company', now()->addHour(), function () {
            return Societe::all();
        });
        return $companies;
    }
    
}
