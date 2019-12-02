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

    public function create()
    {

        $tecnicos = DB::table('tecnico')->get();
        $personas=DB::table('persona')
        ->where('tipo_persona','=','Proveedor')->get();
        $articulos=DB::table('articulo')->get();

        return view('compras.ingreso.create',["personas"=>$personas,"tecnicos"=>$tecnicos,"articulos"=>$articulos]);

    }

    public function store(IngresoFormRequest $request)//aqui valido el almacenamiento con el try catch
    {                                                  //inciamos una transaccion para guardar todo el ingreso y el detalle de ingreso pero a la misma vez por algun problema en la red
        try {
            DB::beginTransaction();
            $ingreso = new Ingreso;

            $ingreso->idproveedor=$request->get('idproveedor');
            $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
            $ingreso->serie_comprobante=$request->get('serie_comprobante');
            $ingreso->num_comprobante=$request->get('num_comprobante');
            $mytime = Carbon::now('America/Bogota');
            $ingreso->fecha_hora=$mytime->toDateTimeString();
            $ingreso->impuesto = '21';
            $ingreso->estado = 'A';
            $ingreso->tem=$request->get('tem');
            $ingreso->save();


            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while ($cont<count($idarticulo)) {
                $detalle=new DetalleIngreso();
                $detalle->idingreso=$ingreso->idingreso;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_compra=$precio_compra[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

            DB::commit();
        } catch (Exception $e)
        {
            DB::rollback();
        }

        return Redirect::to('compras/ingreso');
    }

    public function exportPdf()
 {

     $tecnicos = DB::table('tecnico')->get();
     $ingresos=DB::table('ingreso as i')
     ->join('persona as p', 'i.idproveedor','=','p.idpersona')// persona une con proveedor
     ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')// realiza la union de ingreso llave primaria con la foranea de detalle de ingreso
     ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad * precio_compra) as total')) //obtiene de la tabla ingreso fecha hora de la persona el nombre etc.
     // en la funcion raw me dice que sum es igual a la cantidad por el precio y eso me lo manda a total  y lo muestra
     ->orderBy('i.idingreso','desc')// ordeno los ingresos mas recientes primero
     ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
     ->paginate(7) ;

     $pdf= PDF::loadView('pdf.ingresos', ["ingresos"=>$ingresos,"tecnicos"=>$tecnicos]);
     return $pdf->download('ingresos-list-pdf');

 }

    public function show($id)
    {
        $ingreso=DB::table('ingreso as i')
            ->join('persona as p','i.idproveedor','=','p.idpersona')
            ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
            ->where('i.idingreso','=',$id)
            ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante', 'i.num_comprobante','i.impuesto','i.estado')
            ->first(); // Arriba ya se utilizo group by, acá utilizar first para traer únicamente el primero.

        $detalles=DB::table('detalle_ingreso as d')
            ->join('articulo as a','d.idarticulo','=','a.idarticulo')
            ->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta')
            ->where('d.idingreso','=',$id)
            ->get();
        return view("compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }

 public function destroy($id)
  {
    $ingreso = Ingreso::findOrFail($id);
    $ingreso->delete();
      return Redirect::to('compras/ingreso');
  }




}
