<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TipoResiduo;
use Illuminate\Http\Request;

class TipoResiduoController extends Controller
{
    public function index()
    {
        return TipoResiduo::all();
    }
}
