@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Editar Cliente:{{$persona -> nombre}}</h3>

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
                {!!Form::model($persona,['method'=>'PATCH','route'=>['cliente.update',$persona->idpersona]])!!}
                {{Form::token()}}

                <div class="row">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control "placeholder="Nombre...">
                        </div>
                    </div>



                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="direccion" class="">Direccion</label>
                            <input type="text" name="direccion" value="{{$persona->direccion}}" class="form-control "placeholder="Direccion...">
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label >Documento</label>
                            <select name="tipo_documento" class= "form-control" ><!-- realizo un opcion de categorias y llamo al objeto categorias y lo nombro como cat-->

                                @if($persona->tipo_documento=='DNI')
                                    <option value="DNI"selected>DNI</option>
                                    <option value="DU">DU</option>
                                    <option value="PAS">PASAPORTE</option>
                                @elseif($persona->tipo_documento=='DU')
                                    <option value="DU" selected>DU</option>
                                    <option value="DNI">DNI</option>
                                    <option value="PAS">PASAPORTE</option>
                                @else
                                    <option value="PAS" selected>PASAPORTE</option>
                                    <option value="DNI">DNI</option>
                                    <option value="DU">DU</option>  
                                @endif           
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="num_documento" class="">Numero de Documento</label>
                            <input type="text" name="num_documento" value="{{$persona->num_documento}}" class="form-control "placeholder="Numero de documento..." >
                        </div>    

                    </div>


                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="telefono" class="">Telefono</label>
                                <input type="text" name="telefono"  value="{{$persona->telefono}}" class="form-control "placeholder="Numero de telefono..." >
                        </div>
                    </div>



                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="email" class="">Email</label>
                                <input type="text" name="email" value="{{$persona->email}}" class="form-control "placeholder="Email..." >
                        </div>
                    </div>

                                    


                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                        
                        
                    </div>
                    </div>

                    </div>




                {!!Form::close()!!}



@endsection