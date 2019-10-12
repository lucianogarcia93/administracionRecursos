<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\VentaFormRequest;
use App\Venta;
use App\DetalleVenta;
use DB;
use Carbon\Carbon; //con este use me permite usar fecha y hora de mi zona horaria
use Response;
use Illuminate\Support\Collection;
use Illuminate\Auth\Middleware\Authenticate;

class VentaController extends Controller
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
            $ventas=DB::table('venta as v')
            ->join('persona as p', 'v.idcliente','=','p.idpersona')// persona une con proveedor  
            ->join('detalle_de_venta as dv','v.idventa','=','dv.idventa')// realiza la union de ingreso llave primaria con la foranea de detalle de ingreso
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta') //obtiene de la tabla ingreso fecha hora de la persona el nombre etc.
            ->where('v.num_comprobante','LIKE','%'.$query.'%') //con like busca tanto al inicio como al final de la cadena 
            ->orderBy('v.idventa','desc')// ordeno los ingresos mas recientes primero
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->paginate(7) ;
            return view('ventas.venta.index',["ventas"=>$ventas,'searchText'=>$query]);

            
        }
    }

    public function create()
    {
        
        $personas=DB::table('persona')
        ->where('tipo_persona','=','Cliente')->get();
        $articulos=DB::table('articulo as art')
            ->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
            //aqui con avg nos permite esta funcion calcular el precio promedio de todos los precios de ventas ingresados en el ingreso
            //tambien podemos tomar otro tipo de consulta para tomar el ultimo precio ingresado 
            ->select(DB::raw('CONCAT(art.codigo,": ",art.nombre)AS articulo'),'art.idarticulo','art.stock',DB::raw('avg(di.precio_venta) as precio_promedio '))
            ->where('art.estado','=','Activo')
            ->where('art.stock','>','0')
            ->groupBy('articulo','art.idarticulo','art.stock')
            ->get();
        return view('ventas.venta.create',["personas"=>$personas,"articulos"=>$articulos]);

    }

    public function store(VentaFormRequest $request)//aqui valido el almacenamiento con el try catch
    {                                                  //inciamos una transaccion para guardar todo el ingreso y el detalle de ingreso pero a la misma vez por algun problema en la red
        try {
            DB::beginTransaction();
            $venta = new Venta;
            $venta->idcliente=$request->get('idcliente');
            $venta->tipo_comprobante=$request->get('tipo_comprobante');
            $venta->serie_comprobante=$request->get('serie_comprobante');
            $venta->num_comprobante=$request->get('num_comprobante');
            $venta->total_venta=$request->get('total_venta');

            $mytime = Carbon::now('America/Bogota');
            $venta->fecha_hora=$mytime->toDateTimeString();
            $venta->impuesto = '21';
            $venta->estado = 'A';
            $venta->save();

           
            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $descuento = $request->get('descuento');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while ($cont<count($idarticulo)) {
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->descuento=$descuento[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();
        } catch (Exception $e) 
        {
            DB::rollback();
        }

        return Redirect::to('ventas/venta');
    }

    public function show($id)
    {
        $venta=DB::table('venta as v')
            ->join('persona as p','v.idcliente','=','p.idpersona')
            ->join('detalle_de_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->where('v.idventa','=',$id)
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante', 'v.num_comprobante','v.impuesto','v.estado','v.total_venta')
            ->first(); // Arriba ya se utilizo group by, acá utilizar first para traer únicamente el primero.

        $detalles=DB::table('detalle_de_venta as d')
            ->join('articulo as a','d.idarticulo','=','a.idarticulo')
            ->select('a.nombre as articulo','d.cantidad','d.descuento','d.precio_venta')
            ->where('d.idventa','=',$id)
            ->get();
        return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles]);
    }

    public function destroy($id)
    {
        $venta=Venta::findOrfail($id);
        $venta->Estado='C';
        $venta->update();
        return Redirect::to('ventas/venta');
    }
}
