@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                                        
                    Estas Logeado, para proceder a la Pagina Principal Presiona el Boton.
                    <a href="http://127.0.0.1:8000/compras/ingreso"> <button type="button" name="button"> Pagina Principal</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
