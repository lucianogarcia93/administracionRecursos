@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Nuevo Articulo</h3>

                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)

                        <li>{{$error}}</li>

                        @endforeach
                    </ul>

                </div>
                @endif
        </div>
  </div>

                {!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true')) !!}
                {{Form::token()}}

                <div class="row">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input type="text" name="nombre" required value="{{old ('nombre')}}" class="form-control " >
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre" class="">Categoria</label>
                            <select name="idcategoria" class= "form-control" ><!-- realizo un opcion de categorias y llamo al objeto categorias y lo nombro como cat-->
                                @foreach($categorias as $cat)

                                    <option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="codigo" class="">Codigo</label>
                            <input type="text" name="codigo" required value="{{old ('codigo')}}" class="form-control "placeholder="codigo..." >
                        </div>

                    </div>


                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="stock" class="">Stock</label>
                                <input type="text" name="stock" required value="{{old ('stock')}}" class="form-control "placeholder="Stock del articulo..." >
                        </div>
                    </div>



                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="descripcion" class="">Descripcion</label>
                                <input type="text" name="descripcion" value="{{old ('descripcion')}}" class="form-control "placeholder="Descripcion del articulo..." >
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="descripcion" class="">Fecha de Vencimiento de garantia</label>
                                <input type="date" name="fecha_venc" value="{{old ('descripcion')}}" class="form-control "placeholder="Descripcion del articulo..." >
                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="descripcion" class="">Imagen</label>
                                <input type="file" name="imagen" class="form-control " >
                        </div>
                    </div>


                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">Guardar</button>

                        <button type="reset" class="btn btn-danger">Cancelar</button>


                    </div>
               </div>


                {!!Form::close()!!}

@endsection
