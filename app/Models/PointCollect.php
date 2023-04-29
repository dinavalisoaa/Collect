<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointCollect extends Model
{
    use HasFactory;
    protected $table = 'pointcollect';
    public $timestamps = false;
    public function getRegion()
    {
        return Region::find($this->regionid);
    }
    public function getEngard()
    {   
        $id=$this->id;
            $pro=EngardPointCollecte::where('pointcollectid',$id)->get()[0];
        return Engard::find($pro->engardid);
        // return Engard::find(1);
    }
}

