<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo';

   protected $primaryKey ='idarticulo';

   public $timestamps = false ; // agrega dos columas de actualizacion y creacion

   protected $fillable = [

    'idcategoria',
    'codigo',
    'nombre',
    'stock',
    'descripcion',
    'imagen',
    'estado'
   ];

   protected $guarded =[

   ];
}
