<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
   protected $table = 'categoria';

   protected $primaryKey ='idcategoria';

   public $timestamps = false ; // agrega dos columas de actualizacion y creacion

   protected $fillable = [

    'nombre',
    'descripcion',
    'condicion'
   ];

   protected $guarded =[

   ];
}
