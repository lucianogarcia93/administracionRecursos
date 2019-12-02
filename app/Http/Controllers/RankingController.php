<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Persona;
use App\Tecnico;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use DB;
use Illuminate\Auth\Middleware\Authenticate;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProveedorExport;

class RankingController extends Controller
{
  public function index(Request $request)
  {
      if($request)
      {

          $personas=DB::table('persona')
          ->orderBy('puntuacion','desc')
          ->paginate(7) ;
          return view('compras.ranking.index',["personas"=>$personas]);
      }
}
}
