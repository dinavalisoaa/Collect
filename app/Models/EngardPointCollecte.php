<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngardPointCollecte extends Model
{
    use HasFactory;
    protected $table = 'engardpointcollecte';
    public $timestamps = false;
    public function getPointCollecte()
    {
        return PointCollect::find($this->pointcollectid);
    }
}
