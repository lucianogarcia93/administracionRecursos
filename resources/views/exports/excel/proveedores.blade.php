<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Num. de CUIT</th>
        <th>Telefono</th>
        <th>Direccion</th>
        <th>Email</th>
        <th>Puntuacion</th>
    </tr>
    </thead>
    <tbody>
    @foreach($personas as $per)
        <tr>
            <td>{{ $per->nombre }}</td>
            <td>{{ $per->num_documento }}</td>
            <td>{{ $per->telefono}}</td>
            <td>{{ $per->direccion}}</td>
            <td>{{ $per->email}}</td>
            <td>{{ $per->puntuacion}}</td>
        </tr>
    @endforeach
    </tbody>
</table>