<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lineas Productos {{now()}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
  font-family: "Roboto", helvetica, arial, sans-serif;
  font-size: 11px;
  font-weight: 400;
  text-rendering: optimizeLegibility;
}

    </style>
</head>

<body>
  <div class="container">

    <div class="d-flex justify-content-between">
      <h2 class="text-center">Teneria Rubio C.A  </h2>
      <p class="text-right"> Fecha: <b>{{ date('d-m-Y') }}</b></p>
    </div>
      
      <img class="invoice-logo" src="C:\laragon\www\teneria-laravel\public\images\logo.png" alt="" />

  </div>
    <h3 class="text-center py-2">Lineas Productos</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" >Registrado</th>
                <th scope="col">Producto</th>
                <th scope="col">Proveedor</th>
                <th scope="col">Linea</th>
                <th scope="col">Departamento</th>
                <th scope="col">Stock</th>
                <th scope="col">Estatus</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lineProduct as $data)
            <tr>
                <td scope="row">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                <td>{{ $data->product_name }}</td>
                <td>{{ $data->provider_name }}</td>
                <td>{{ $data->line_name }}</td>
                <td>{{ $data->department_name }}</td>
                <td>{{ $data->stock }}</td>
                @if($data->delete)         
                <td>Eliminado</td> 
                @else
                    <td>Activo</td>        
                @endif   
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>