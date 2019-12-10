<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\IngresoFormRequest;
use App\Ingreso;
use App\DetalleIngreso;
use DB;
use Carbon\Carbon; //con este use me permite usar fecha y hora de mi zona horaria
use Response;
use Illuminate\Support\Collection;
use Illuminate\Auth\Middleware\Authenticate;
use Barryvdh\DomPDF\Facade as PDF;



class IngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request)
        {
            $query=trim($request -> get('searchText'));// con trim borro los espacios tanto al principio como al final
            $tecnicos = DB::table('tecnico')->get();
            $ingresos=DB::table('ingreso as i')
            ->join('persona as p', 'i.idproveedor','=','p.idpersona')// persona une con proveedor
            ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')// realiza la union de ingreso llave primaria con la foranea de detalle de ingreso
            ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad * precio_compra) as total')) //obtiene de la tabla ingreso fecha hora de la persona el nombre etc.
            // en la funcion raw me dice que sum es igual a la cantidad por el precio y eso me lo manda a total  y lo muestra
            ->where('i.num_comprobante','LIKE','%'.$query.'%') //con like busca tanto al inicio como al final de la cadena
            ->orderBy('i.idingreso','desc')// ordeno los ingresos mas recientes primero
            ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
            ->paginate(7) ;
            return view('compras.ingreso.index',["ingresos"=>$ingresos,"tecnicos"=>$tecnicos,'searchText'=>$query]);


        }
    }

  


}
