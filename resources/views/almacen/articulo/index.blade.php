@extends('layouts.admin')
@section('contenido')
<div class="row">

    <div class="colg-lg-8 col-md-8 col-xs-12">

        <h3>Listado de Articulos <a href="articulo/create" ><button class="btn btn-success">Nuevo</button></h3></a>
            @include('almacen.articulo.search')
    </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="table responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Codigo</th>
                                <th>Categoria</th>
                                <th>Stock</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Opciones</th>
        
                            </thead>
                            @foreach($articulos as $art) <!--la variable que recibo del controlador la guardo en cat y la muestro-->
                                <tr>
                                    <td>{{$art->idarticulo}}</td>
                                    <td>{{$art->nombre}}</td>
                                    <td>{{$art->codigo}}</td>
                                    <td>{{$art->categoria}}</td>
                                    <td>{{$art->stock}}</td>
                                    <td>
                                        
                                        <img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="100px" width="100px" class="img-thumbnail">
                                    </td>
                                    <td>{{$art->estado}}</td>

                                    <td>
                                        
                                        <a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button type="button" class="btn btn-info">Editar</button></a>
                                        <a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal">
                                        <button type="button" class="btn btn-danger">Eliminar</button>
                                        </a>
                                        

                                    </td>
                                
                                </tr>
                                @include('almacen.articulo.modal')
                            @endforeach


                        </table>


                    </div>
                    {{$articulos->render()}}
                
                </div>
            
            </div>
    
</div>

@endsection