<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubtipoResiduo;

class SubTipoResiduoController extends Controller
{
    public function index($id)
    {
        return SubtipoResiduo::where('Tip_Res_Id', $id)->get();
    }
}
