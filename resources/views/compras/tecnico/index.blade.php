@extends('layouts.admin')
@section('contenido')
<div class="row">

    <div class="colg-lg-8 col-md-8 col-xs-12">

        <h3>Listado de Tecnicos Aprobados <a href="tecnico/create" ><button class="btn btn-success">Nuevo</button></h3></a>
            @include('compras.tecnico.search')
   </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="table responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>

                                <th>nombre</th>
                                <th>Tipo Doc.</th>
                                <th>Numero de Doc.</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>especializacion</th>
                                <th>Proveedor</th>

                            </thead>
                            @foreach($tecnicos as $per) <!--la variable que recibo del controlador la guardo en cat y la muestro-->
                                <tr>

                                    <td>{{$per->nombre}}</td>
                                    <td>{{$per->tipo_documento}}</td>
                                    <td>{{$per->num_documento}}</td>
                                    <td>{{$per->telefono}}</td>
                                    <td>{{$per->email}}</td>
                                    <td>{{$per->especializacion}}</td>
                                @foreach($personas as $pe)
                                 @if($pe->idpersona == $per->idpersona)
                                    <td>{{$pe->nombre}}</td>
                                    @endif
                                @endforeach

                                    <td>

                                        <a href="{{URL::action('VerdtecnicoController@edit',$per->idpersona)}}"><button type="button" class="btn btn-info">Editar</button></a>
                                        <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal">
                                        <button type="button" class="btn btn-danger">Eliminar</button>
                                        </a>


                                    </td>

                                </tr>

                            @endforeach
                        </table>
                    </div>
                    {{$tecnicos->render()}}

                </div>

            </div>

</div>

@endsection
