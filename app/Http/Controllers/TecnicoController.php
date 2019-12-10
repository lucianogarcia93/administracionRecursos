<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Persona;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use DB;
use Illuminate\Auth\Middleware\Authenticate;

class TecnicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request -> get('searchText'));
            $personas=DB::table('persona')
            ->where('tipo_persona','=','Tecnico')
            ->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('idpersona','desc')
            ->paginate(7) ;
            return view('compras.tecnico.index',["personas"=>$personas,'searchText'=>$query]);
        }
    }
    public function create()
    {
        return view('compras.tecnico.create');
    }

    public function store(PersonaFormRequest $request)
    {
        $persona=new Persona;
        $persona->tipo_persona ='Tecnico';
        $persona->nombre =$request->get('nombre');
        $persona->tipo_documento =$request->get('tipo_documento');
        $persona->num_documento =$request->get('num_documento');
        $persona->telefono =$request->get('telefono');
        $persona->email =$request->get('email');

        $persona->save();
        return Redirect::to('compras/tecnico');

    }

    public function show($id)
    {
        return view ("compras.tecnico.show",["persona"=>Persona::findOrFail($id)]);

  
}
