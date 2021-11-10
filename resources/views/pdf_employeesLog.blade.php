<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entradas/Salidas empleados {{now()}}</title>
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
    <h3 class="text-center py-2">Reporte Entradas/Salidas Empleados</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" >Registrado</th>
                <th scope="col">Empleado</th>
                <th scope="col">Fecha</th>
                <th scope="col">Descripción</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>

            </tr>
        </thead>
        <tbody>
            @foreach($employeesLogs as $data)
            <tr>
                <td scope="row">{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                <td>{{ $data->employee->name }}</td>
                <td>{{ date('d-m-Y', strtotime($data->date)) }}</td>
                <td>{{ $data->description }}</td>
                @if($data->employee_scene_id ==1)         
                <td>Entrando</td> 
                @else
                    <td>Saliendo</td>        
                @endif 
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