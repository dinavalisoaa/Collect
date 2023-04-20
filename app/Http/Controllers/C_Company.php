<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use Illuminate\Http\Request;

class C_Company extends Controller
{
    public function allCompany() {
       return Societe::all();
    }
    
}
