<!DOCTYPE html>
<html>
<head>
    <title>Tienda de Mascotas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
      
<div class="container">
    <h1>Clientes Mascotas</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewCliente"> Crear Nuevo Cliente</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Documento ID</th>
                <th>Nombres y Apellidos</th>
                <th>Celular</th>
                <th>email</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
     
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="clienteForm" name="clienteForm" class="form-horizontal">
                   <input type="hidden" name="cliente_id" id="cliente_id">
                    <div class="form-group">
                        <label for="documento" class="col-sm-2 control-label">Documento</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="documento" name="documento" placeholder="Documento de Identidad" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombresApellidos" class="col-sm-2 control-label">Nombres y Apellidos</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nombresApellidos" name="nombresApellidos" placeholder="Ingrese Nombres y Apellidos" value="" maxlength="100" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="celular" class="col-sm-2 control-label">Celular</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="celular" name="celular" placeholder="Ingrese su numero de telefono celular" value="" maxlength="100" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese su email" value="" maxlength="100" required="">
                        </div>
                    </div>
        
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">save
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
      
</body>
      
<script type="text/javascript">
  $(function () {
      
    /*------------------------------------------
     --------------------------------------------
     Pass Header Token
     --------------------------------------------
     --------------------------------------------*/ 
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
      
    /*------------------------------------------
    --------------------------------------------
    Render DataTable
    --------------------------------------------
    --------------------------------------------*/
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('clienteMascota.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'documento', name: 'documento'},
            {data: 'nombresApellidos', name: 'nombresApellidos'},
            {data: 'celular', name: 'celular'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewCliente').click(function () {
        $('#saveBtn').val("create-cliente");
        $('#cliente_id').val('');
        $('#clienteForm').trigger("reset");
        $('#modelHeading').html("Create Nuevo Cliente");
        $('#ajaxModel').modal('show');
    });
      
    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editCliente', function () {
      var cliente_id = $(this).data('id');
      $.get("{{ route('clienteMascota.index') }}" +'/' + cliente_id +'/edit', function (data) {
          $('#modelHeading').html("Editar Cliente");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#cliente_id').val(data.id);
          $('#documento').val(data.documento);
          $('#nombresApellidos').val(data.nombresApellidos);
          $('#celular').val(data.celular);
          $('#email').val(data.email);
      })
    });
      
    /*------------------------------------------
    --------------------------------------------
    Create Product Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
      
        $.ajax({
          data: $('#clienteForm').serialize(),
          url: "{{ route('clienteMascota.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
       
              $('#clienteForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
           
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
      
    /*------------------------------------------
    --------------------------------------------
    Delete Product Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteCliente', function () {
     
        var cliente_id = $(this).data("id");
        confirm("Are You sure want to delete !");
        
        $.ajax({
            type: "DELETE",
            url: "{{ route('clienteMascota.store') }}"+'/'+cliente_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
       
  });
</script>
</html>