<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engard extends Model
{
    use HasFactory;
    protected $table = 'engard';
    public $timestamps = false;
    public function getRegion()
    {
        return Region::find($this->regionid);
    }
    public function getPointCollectes(){
        return EngardPointCollecte::where('engardid',$this->id)->get();
    }
    public function getPointCollectNonLier(){
        return PointCollect::fromQuery(" select p.* from (select pointcollectid,engardid from engardpointcollecte where engardid=".$this->id.") as tab full join pointcollect p on p.id=tab.pointcollectid where  pointcollectid is null;");
    }
}
