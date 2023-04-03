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
}
