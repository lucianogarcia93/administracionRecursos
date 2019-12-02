<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Numero de DNI</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Especializacion</th>
        <th>Proveedor</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tecnicos as $tec)
        <tr>
            <td>{{ $tec->nombre }}</td>
            <td>{{ $tec->num_documento }}</td>
            <td>{{ $tec->telefono}}</td>
            <td>{{ $tec->email}}</td>
            <td>{{ $tec->especializacion}}</td>
            <td>{{ $tec->idpersona}}</td>
        </tr>
    @endforeach
    </tbody>
</table>