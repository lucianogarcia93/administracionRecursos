<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
  protected $table = 'tecnico';

  protected $primaryKey ='idtecnico';

  public $timestamps = false ; // agrega dos columas de actualizacion y creacion

  protected $fillable = [
   'idpersona',
   'nombre',
   'tipo_documento',
   'num_documento',
   'telefono',
   'email',
   'especializacion'

  ];
  public function personas()
{
  return $this->belongsTo(Persona::class);
}
  protected $guarded =[

  ];
}
