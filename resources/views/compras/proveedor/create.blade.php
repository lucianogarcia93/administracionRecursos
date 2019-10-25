@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Nuevo Proveedor</h3>

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

                {!!Form::open(array('url'=>'compras/proveedor','method'=>'POST','autocomplete'=>'off')) !!}
                {{Form::token()}}

                <div class="row">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input type="text" name="nombre" required value="{{old ('nombre')}}" class="form-control "placeholder="Nombre...">
                        </div>
                    </div>

                   

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="direccion" class="">Direccion</label>
                            <input type="text" name="direccion" value="{{old ('direccion')}}" class="form-control "placeholder="Direccion...">
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label >Documento</label>
                            <select name="tipo_documento" class= "form-control" ><!-- realizo un opcion de categorias y llamo al objeto categorias y lo nombro como cat-->
                
                                    <option value="DNI">DNI</option>
                                    <option value="DU">DU</option>
                                    <option value="PAS">PASAPORTE</option>

                            </select>
                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="num_documento" class="">Numero de Documento</label>
                            <input type="text" name="num_documento" value="{{old ('num_documento')}}" class="form-control "placeholder="Numero de documento..." >
                        </div>    

                    </div>


                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="telefono" class="">Telefono</label>
                                <input type="text" name="telefono"  value="{{old ('telefono')}}" class="form-control "placeholder="Numero de telefono..." >
                        </div>
                    </div>

                    

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="email" class="">Email</label>
                                <input type="text" name="email" value="{{old ('email')}}" class="form-control "placeholder="Email..." >
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label >Puntuacion</label>
                            
                            <select name="puntuacion" class= "form-control" ><!-- realizo un opcion de categorias y llamo al objeto categorias y lo nombro como cat-->
                                @for ($puntuacion = 1; $puntuacion <= 10; $puntuacion++)
                                    <option value="{{old ('puntuacion')}}" >{{$puntuacion}}</option>
                                @endfor

                            </select>
                        </div>
                    </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group" >
                        
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                        
                        
                    </div>
               </div>
               
        </div>


                {!!Form::close()!!}

@endsection