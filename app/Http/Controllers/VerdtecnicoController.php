<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tecnico;
use App\Persona;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TecnicoFormRequest;
use DB;
use Illuminate\Auth\Middleware\Authenticate;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TecnicosExport;

class VerdtecnicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request)
        {
            $personas = DB::table('persona')->get();
            $query=trim($request -> get('searchText'));
            $tecnicos=DB::table('tecnico')
            ->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('idpersona','desc')
            ->paginate(7) ;
            return view('compras.tecnico.index',["tecnicos"=>$tecnicos,"personas"=>$personas,'searchText'=>$query]);
        }

        
    }
    public function create()
    {
      $personas = DB::table('persona')->get();

        return view('compras.tecnico.create',["personas"=>$personas]);
    }

    public function store(TecnicoFormRequest $request)
    {
        $tecnico=new Tecnico;
        $tecnico->nombre =$request->get('nombre');
        $tecnico->tipo_documento =$request->get('tipo_documento');
        $tecnico->num_documento =$request->get('num_documento');
        $tecnico->telefono =$request->get('telefono');
        $tecnico->email =$request->get('email');
        $tecnico->especializacion =$request->get('especializacion');
        $tecnico->idpersona=$request->get('idpersona');

        $tecnico->save();
        return Redirect::to('compras/tecnico');

    }

    public function show($id)
    {

        return view ("compras.tecnico.show",["tecnico"=>Tecnico::findOrFail($id)]);

    }

    public function edit($id)
    {
     return view ("compras.tecnico.edit",["tecnico"=>Tecnico::findOrFail($id)]);


    }
    public function destroy($id)
    {
      $tecnico = Tecnico::findOrFail($id);
      $tecnico->delete();
      return Redirect::to('compras/tecnico');
    }
    public function exportExcel()
    {
        return Excel::download(new TecnicosExport,'tecnicos-list.xlsx');
    }

}
