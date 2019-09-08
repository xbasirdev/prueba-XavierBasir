<!DOCTYPE html>
<html>
 <head>
  <title>Importar datos de excel en Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  
  <div class="container-fluid">
        <h2 align="center">Importar datos de excel en Laravel</h2>
        <h3 align="center" >Prueba hecha por <a href="http://xbasir.github.io/cv-portafolio/" target="_blank">Xavier Basir</a> </h3>
        <br />
   @if(count($errors) > 0)
    <div class="alert alert-danger">
     UPS! Hubo un error :(<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif

   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
   <form method="post" enctype="multipart/form-data" action="{{ url('/import') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table" >
      <tr>
       <td width="40%" align="right"><label class="mt-2">Seleccionar Archivo <span class="text-muted">formatos .xls, xslx)</span></td>
       <td width="30">
        <input type="file" name="select_file" />
       </td>
       <td width="30%" align="left">
        <input type="submit" name="Subir" class="btn btn-success" value="Importar" style="margin-top: -4px !important;">
       </td>
      </tr>
      <tr>
       <td width="40%" align="right"></td>
       <td width="30"></td>
       <td width="30%" align="left"></td>
      </tr>
     </table>
    </div>
   </form>
   
   <br />
   <h2>Empleados importados del último excel</h2>
   <table id="empleados" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido 1</th>
                <th>Apellido 2</th>
                <th>IFE</th>
                <th>Clave elector</th>
                <th>RFC</th>
                <th>Tel</th>
                <th>CURP</th>
                <th>IMSS</th>
                <th>Fecha contrato</th>
                <th>Fecha Nacimiento</th>
                <th>ID Empresa</th>
                <th>ID Sexo</th>
                <th>ID Estado Civil</th>
                <th>Entidad </th>
                <th>Municipio</th>
                <th>Colonia</th>
                <th>Nacionalidad</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
        <tr>
                <td>{{ $row->nombres }}</td>
                <td>{{ $row->apellido_paterno_ }}</td>
                <td>{{ $row->apellido_materno }}</td>
                <td>{{ $row->clave_del_ife }}</td>
                <td>{{ $row->clave_de_elector }}</td>
                <td>{{ $row->rfc}}</td>
                <td>{{ $row->telefono}}</td>
                <td>{{ $row->curp}}</td>
                <td>{{ $row->afiliacion_a_imss}}</td>
                <td>{{ $row->fecha_de_contrato}}</td>
                <td>{{ $row->fecha_de_nacimiento}}</td>
                <td class="bg-warning">{{ $row->empresa }}</td>
                <td class="bg-warning">{{ $row->sexo }}</td>
                <td class="bg-warning">{{ $row->estado_civil }}</td>
                <td>{{ $row->entidad_de_nacimiento }}</td>
                <td>{{ $row->municipio_de_nacimiento }}</td>
                <td>{{ $row->colonia_de_nacimiento_ }}</td>
                <td>{{ $row->modo_de_nacionalidad }}</td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nombre</th>
                <th>Apellido 1</th>
                <th>Apellido 2</th>
                <th>IFE</th>
                <th>Clave elector</th>
                <th>RFC</th>
                <th>Tel</th>
                <th>CURP</th>
                <th>IMSS</th>
                <th>Fecha contrato</th>
                <th>Fecha Nacimiento</th>
                <th>ID Empresa</th>
                <th>ID Sexo</th>
                <th>ID Estado Civil</th>
                <th>Entidad </th>
                <th>Municipio</th>
                <th>Colonia</th>
                <th>Nacionalidad</th>
            </tr>
        </tfoot>
    </table>
    <br><br>
    <h2>Filas rechazadas del último excel</h2>
    <table id="rechazados" class="table table-striped table-bordered" style="width:80%; margin: auto;">
        <thead>
            <tr>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rejected_data as $row)
        <tr>
                <td>{{ $row->nombre}}</td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Descripcion</th>
            </tr>
        </tfoot>
    </table>

  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script>
        $(document).ready(function() {
                $('#empleados').DataTable( {
                        "scrollX": true,
                        "language": {
                        "info": "_TOTAL_ registros",
                        "search": "Buscar",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior",
                        },
                        "lengthMenu": 'Mostrar <select >'+
                                    '<option value="10">10</option>'+
                                    '<option value="30">30</option>'+
                                    '<option value="-1">Todos</option>'+
                                    '</select> registros',
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "emptyTable": "No hay datos",
                        "zeroRecords": "No hay coincidencias", 
                        "infoEmpty": "",
                        "infoFiltered": ""
                         }
                } );
                $('#rechazados').DataTable( {
                        "scrollX": true,
                        "language": {
                        "info": "_TOTAL_ registros",
                        "search": "Buscar",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior",
                        },
                        "lengthMenu": 'Mostrar <select >'+
                                    '<option value="10">10</option>'+
                                    '<option value="30">30</option>'+
                                    '<option value="-1">Todos</option>'+
                                    '</select> registros',
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "emptyTable": "No hay datos",
                        "zeroRecords": "No hay coincidencias", 
                        "infoEmpty": "",
                        "infoFiltered": ""
                         }
                } );
        } );
  </script>
 </body>
</html>