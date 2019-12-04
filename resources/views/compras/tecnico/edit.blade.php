@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <h3>Editar Tecnico:{{$tecnico -> nombre}}</h3>

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
                {!!Form::model($tecnico,['method'=>'PATCH','route'=>['tecnico.update',$tecnico->idtecnico]])!!}
                {{Form::token()}}

                <div class="row">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre" class="">Nombre</label>
                            <input type="text" name="nombre" required value="{{$tecnico->nombre}}" class="form-control "placeholder="Nombre...">
                        </div>
                    </div>


                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="telefono" class="">Telefono</label>
                                <input type="text" name="telefono"  value="{{$tecnico->telefono}}" class="form-control "placeholder="Numero de telefono..." >
                        </div>
                    </div>



                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="email" class="">Email</label>
                                <input type="text" name="email" value="{{$tecnico->email}}" class="form-control "placeholder="Email..." >
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
