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
    <h1>Mascotas</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewMascota"> Crear Nueva Mascota</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Mascota</th>
                <th>Nombre Mascota</th>
                <th>Tipo Mascota</th>
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
                <form id="mascotaForm" name="mascotaForm" class="form-horizontal">
                   <input type="hidden" name="mascota_id" id="mascota_id">
                    <div class="form-group">
                        <label for="idMascota" class="col-sm-2 control-label">ID Mascota</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="idMascota" name="idMascota" placeholder="ID Mascota" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombreMascota" class="col-sm-2 control-label">Nombre Mascota</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nombreMascota" name="nombreMascota" placeholder="Ingrese Nombre de la Mascota" value="" maxlength="100" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tipoMascota" class="col-sm-2 control-label">Tipo Mascota</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="tipoMascota" name="tipoMascota" placeholder="Ingrese el tipo de la Mascota" value="" maxlength="100" required="">
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
        ajax: "{{ route('mascota.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'idMascota', name: 'idMascota'},
            {data: 'nombreMascota', name: 'nombreMascota'},
            {data: 'tipoMascota', name: 'tipoMascota'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewMascota').click(function () {
        $('#saveBtn').val("create-mascota");
        $('#mascota_id').val('');
        $('#mascotaForm').trigger("reset");
        $('#modelHeading').html("Create Nueva Mascota");
        $('#ajaxModel').modal('show');
    });
      
    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editMascota', function () {
      var mascota_id = $(this).data('id');
      $.get("{{ route('mascota.index') }}" +'/' + mascota_id +'/edit', function (data) {
          $('#modelHeading').html("Editar Mascota");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#mascota_id').val(data.id);
          $('#idMascota').val(data.idMascota);
          $('#nombreMascota').val(data.nombreMascota);
          $('#tipoMascota').val(data.tipoMascota);
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
          data: $('#mascotaForm').serialize(),
          url: "{{ route('mascota.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
       
              $('#mascotaForm').trigger("reset");
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
    $('body').on('click', '.deleteMascota', function () {
     
        var mascota_id = $(this).data("id");
        confirm("Are You sure want to delete !");
        
        $.ajax({
            type: "DELETE",
            url: "{{ route('mascota.store') }}"+'/'+mascota_id,
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