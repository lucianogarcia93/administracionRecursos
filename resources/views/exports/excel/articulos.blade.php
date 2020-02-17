<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Codigo</th>
        <th>Categoria</th>
        <th>Stock</th>
        <th>Fecha de Vencimiento</th>
    </tr>
    </thead>
    <tbody>
    @foreach($articulos as $art)
        <tr>
            <td>{{ $art->nombre }}</td>
            <td>{{ $art->codigo }}</td>
            <td>{{ $art->categoria_idcategoria}}</td>
            <td>{{ $art->stock}}</td>
            <td>{{ $art->fecha_venc}}</td>
        </tr>
    @endforeach
    </tbody>
</table>