<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1 align="center">  Listado de Ingresos</h1>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="table responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
<tr>


                        <th>Fecha</th>&nbsp;
                        <th>Proveedor</th>&nbsp;&nbsp;
                        <th>Comprobante</th>&nbsp;
                        <th>Impuesto</th>&nbsp;
                        <th>Total</th>&nbsp;
                        <th>Fecha Venc.</th>&nbsp;

</tr>
                    </thead>
                    @foreach($ingresos as $ing) <!--la variable que recibo del controlador la guardo en ing y la muestro-->
                        <tr>


                            <td>{{$ing ->fecha_hora}}</td>&nbsp;
                            <td>{{$ing->nombre}}</td>&nbsp;
                            <td>{{$ing->tipo_comprobante.':'.$ing->num_comprobante.'-'.$ing->serie_comprobante}}</td>&nbsp;
                            <td>{{$ing->impuesto}}</td>&nbsp;
                            <td>{{$ing->total}}</td>&nbsp;
                            <td>{{$ing->fecha_hora}}</td>&nbsp;





                        </tr>

                    @endforeach
                </table>
            </div>


        </div>

    </div>
  </body>
</html>
