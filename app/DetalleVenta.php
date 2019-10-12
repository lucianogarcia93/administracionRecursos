<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_de_venta';

    protected $primaryKey ='iddetalle_de_venta';
 
    public $timestamps = false ; // agrega dos columas de actualizacion y creacion
 
    protected $fillable = [
 
     'idventa',
     'idarticulo',
     'cantidad',
     'precio_venta',
     'descuento'
     
    ];
 
    protected $guarded =[
 
    ];
}
