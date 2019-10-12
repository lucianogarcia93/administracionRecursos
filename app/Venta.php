<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'venta';

   protected $primaryKey ='idventa';

   public $timestamps = false ; // agrega dos columas de actualizacion y creacion

   protected $fillable = [

    'idcliente',
    'tipo_comprobante',
    'serie_comprobante',
    'num_comprobante',
    'fecha_hora',
    'impuesto',
    'total_venta',
    'estado'
   ];

   protected $guarded =[

   ];
}
