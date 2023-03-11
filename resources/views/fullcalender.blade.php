<!DOCTYPE html>
<html>
<head>
    <title>Full Callendar Pet Shop</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <h1 align="center">Pet Shop Calendario de Citas</h1>
    <br>
    <p>Este ejercicio corresponde a Crud solicitado por la empresa Excel Total</p>

    <p>Se muestra el crud de Laravel + Jquery + Framework FullCallendar + Base de Datos MySql </p>

    <p>
        Se Usó el Framework Full Callendar para mostrar los eventos de Citas de una Tienda de Macotas, siendo los campos principales los siguientes:
        <ul> - Fecha de la Cita </ul>
        <ul> - Hora de la Cita </ul>
        <ul> - Mascota </ul>
        Adicional a esto, se agregaron otros campos que son propios del Framwork Full Callendar y estos son:

        <ul> - title: Corresponde al titulo del evento que se inserta en el calendario.</ul>
        <ul> - start: corresponde la fecha de Inicio del evento.</ul>
        <ul> - end: Corresponde el día que finaliza el evento.</ul>

        Se usaron tres propiedades de Full Callendar a considerar:

        <ul>-dayClick : Con esta función al hacer click en un día del calendario, podemos hacer el registro del evento en ese día.</ul>
        <ul>-eventClick : Con esta función podemos editar o borrar el evento al hacer click sobre el evento en el calendario.</ul>
        <ul>-eventRender: Con esta función me actualiza y muestra los eventos en el calendario. toma los datos del atributo events que se encuentra al inicio del código.</ul>

        <p>El concepto y funcionamiento de laravel + Jquery + Boopstrat + MySql es el siguiente:</p>

        <p>Con Laravel se crea la arquitectura MVC (Modelo - Vista - Controlador) para que realize la conexión con la base de datos realizado para este ejercicio con MySql. El modelo lo tenemos en el archivo Event.php y el controlador lo tenemos en el archivo FullCalender Controller.php., La vista fué realizada con el archivo fullcalender.blade.php. Allí insertamos boopstrat para realizar el modal, el framework fullCallendar e insertamos el código de Ajax - Asincrono para realziar las conexíones entre el modal y el controlador.</p>
        <br>
    <p><B>Uso del Calendario:</B></p>

        El uso del Calendario es el siguiente:

        <ol>
        <li>Para registrar un evento solo hacer click en el día donde va a registrar el evento, seguido le muestra un modal donde aparecen los campos Fecha de la Cita, Hora de la Cita y Mascota. al hacer click en agregar evento, se cierra el modal y luego se visualiza en el calendario.</li>

        <li>Para editar o borrar el evento, solo hacer click en el evento, el cual le aparece el modal y dentro del modal va a aparecer los botones para editar y borrar.</li>

        <li>El modal hace el proceso del GET para rellenar los campos, por el tema de editar la información. </li>

        </ol>
    </p>

    <div id='calendar'></div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    <div class="form-group">
                        <label for="fechaCita" class="col-sm-2 control-label">Fecha de la Cita</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="fechaCita" name="fechaCita" value="" maxlength="100" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="horaCita" class="col-sm-2 control-label">Hora de la Cita</label>
                        <div class="col-sm-12">
                            <input type="time" class="form-control" id="horaCita" name="horaCita" value="" maxlength="100" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mascota" class="col-sm-2 control-label">Ingrese la Mascota</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="mascota" name="mascota" value="" maxlength="100" required="">
                        </div>
                    </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" id="saveBtnCita">Crear Cita</button>
        <button type="button" class="btn btn-primary-2" id="editBtnCita" style="background-color: orange">Editar</button>
        <button type="button" class="btn btn-primary-3" id="borrarBtnCita" style="background-color: red">Borrar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        

        
      </div>
    </div>
  </div>
</div>




</div>




  
<script type="text/javascript">
/*

                ***************************************************************
                *                                                             *
                *       EJERCICIO REALIZADO PARA LA EMPRESA EXCEL TOTAL       *
                *           CRUD DE CITAS AGENDAMIENTO MASCOTAS               *
                *                                                             *  
                ***************************************************************

    EL Presente ejercicio Consta de realizar en Laravel PHP con Jquery Ajax y Html Boopstrat y con el Framework
    FULL CALLENDAR un crud en el cual se pueda realizar el agendamiento de citas para una tienda para mascotas.

    Se usó Laravel y base de datos MySql para la gestión del Crud, bajo el modelo MVC (Modelo - Vista - Controlador)
    El modelo y el controlador fueron realizados instalando laravel, configurando las tablas con Php Artisan Migrate.
    y creando el contrololador y el modelo en las carpetas del proyecto.

     - Modelo: Event.php
     - Controlador: FullCalenderController.php

     La vista que observan fué solo llamar al Calendario, y abrir un modal donde contiene los campos solicitados:
        -Fecha Cita
        -Hora de la Cita
        -Mascota
                
*/


    //Inicializo estas variables como Globales, para trabajar con los Ajax
    var fechaCita = 0;
    var horaCita = 0;
    var mascota = 0;
    var start = "";
    var end = "";
    var registro = 0;


  
$(document).ready(function () {
      
    /*------------------------------------------
    --------------------------------------------
    Get Site URL
    --------------------------------------------
    --------------------------------------------*/
    var SITEURL = "{{ url('/') }}";
    
    /*------------------------------------------
    --------------------------------------------
    CSRF Token Setup
    --------------------------------------------
    --------------------------------------------*/
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      
    /*------------------------------------------
    --------------------------------------------
    FullCalender JS Code
    --------------------------------------------
    --------------------------------------------*/
    

    var calendar = $('#calendar').fullCalendar({
                    editable: true,
                    events: SITEURL + "/fullcalender",
                    displayEventTime: true,

                    eventRender: function (event, element, view) {
                        event.allDay = true;
                        if (event.allDay === 'true') {
                                event.allDay = true;
                                element.title = true;
                        } else {
                                event.allDay = false;
                        }
                    
                    },
  
                    selectable: true,
                    selectHelper: true,

                    
                    //**************************************************************
                    //* FUNCION DAY CLICK PARA GESTIONAR ACCIONES EN EL CALENDARIO *
                    //**************************************************************
                    
                    //Se usó la funcion de dayclick propia del framework de Full Callendar para realizar
                    //los procesos de CRUD

                    dayClick: function(date, jsEvent, view, allDay){ 

                             $("#exampleModal").modal('show'); //Al hacer click abro el modal
                            

                            /*------------------------------------------
                            --------------------------------------------
                                        REGISTRO DE CITA
                            --------------------------------------------
                            --------------------------------------------*/

                            document.getElementById("saveBtnCita").onclick =
                                function (){
                                    fechaCita = $('#fechaCita').val();
                                    horaCita = $('#horaCita').val();
                                    mascota = $('#mascota').val();
                                    start = date.format();
                                    end = date.format();
                                
                                    if (registro = 1){

                                        $.ajax({
                                            url: SITEURL + "/fullcalenderAjax",
                                            data: {
                                                fechaCita: fechaCita,
                                                horaCita: horaCita,
                                                mascota: mascota,
                                                start: start,
                                                end: end,
                                                type: 'add'
                                            },
                                            type: "POST",
                                            success: function (data) {
                                                displayMessage("Event Creado Correctamente");
                                            
                                            calendar.fullCalendar('renderEvent',
                                                {
                                                    id: data.id,
                                                    title: mascota,
                                                    fechaCita: fechaCita,
                                                    horaCita: horaCita,
                                                    mascota: mascota,
                                                    start: start,
                                                    end: end,
                                                    allDay: allDay
                                                },true);
                                            calendar.fullCalendar('unselect');    
                                            
                                            }
                                        });
                                        
                                            $('#exampleModal').modal('hide');
                                            
                                            $('#exampleModal').on('show.bs.modal', function (event) {
                                                $("#exampleModal input").val("");
                                            });


                                            document.getElementById("saveBtnCita").removeEventListener('click', true
                                                );

                                    };

                                };

                            //-----------------------------------Fin Registro Cita ---------------------
                            
                    }, //fin funcion Day Click.


                    //**************************************************************
                    //*                   FUNCION EVENT CLICK                      *
                    //**************************************************************

                    //La función EvenClick realiza acciones al presionar una cita en el calendario
                    //Se pueden realizar muchas cosas como abrir un formulario para editar la cita o
                    //eliminar la cita


                    eventClick: function (event,calEvent, jsEvent, view) {

                            /*------------------------------------------
                            --------------------------------------------
                                        EDITAR DE CITA
                            --------------------------------------------
                            --------------------------------------------*/

                        // 1 . Al hacer click abro el modal
                        $   ("#exampleModal").modal('show'); 

                                
                        /*
                           2. Relleno el modal con los valores de la cita con el metodo event.
                           Dentro de la función eventClick, el atributo event hace la función del metodo GET
                           por ejemplo event.id me trae el id como esta guardado en la base de datos
                        */
                    
                        document.getElementById("fechaCita").value = event.fechaCita;
                        document.getElementById("horaCita").value = event.horaCita;
                        document.getElementById("mascota").value = event.mascota;
    

                        /* 3. al dar click al boton editar guardo los registros. */

                            document.getElementById("editBtnCita").onclick =
                                function (){
                                    fechaCita = $('#fechaCita').val();
                                    horaCita = $('#horaCita').val();
                                    mascota = $('#mascota').val();
                                    

                                        $.ajax({
                                            type:"POST",
                                            url: SITEURL + "/fullcalenderAjax",
                                            data: {
                                                id:event.id,
                                                fechaCita: fechaCita,
                                                horaCita: horaCita,
                                                mascota: mascota,
                                                //start: start,
                                                //end: end,
                                                type:'update'
                                            },
                                       
                                            success: function (response) {
                                                displayMessage("Evento Editado Correctamente");

                                                calendar.fullCalendar('renderEvent',
                                                {
                                                    title: mascota,
                                                    start: start,
                                                    end: end,
                                                    allDay: event.allDay
                                                },true);
                                            
                                            calendar.fullCalendar('unselect');    
                                            
                                            }
                                        });
                                        
                                            $('#exampleModal').modal('hide');
                                            
                                            $('#exampleModal').on('show.bs.modal', function (event) {
                                                $("#exampleModal input").val("");
                                            });

                                    

                                };

                            //-----------------------------------Fin Registro EDICION ---------------------

                     document.getElementById("borrarBtnCita").onclick =
                        function (){
                       /// -- para borrar

                    
                        var deleteMsg = confirm("Relmente deseas borrar el evento?");
                        if (deleteMsg) {
                            $.ajax({
                                type: "POST",
                                url: SITEURL + '/fullcalenderAjax',
                                data: {
                                        id: event.id,
                                        type: 'delete'
                                },
                                success: function (response) {
                                    calendar.fullCalendar('removeEvents', event.id);
                                    displayMessage("Evento Borrado Correctamente");
                                     $('#exampleModal').modal('hide');

                                     $('#exampleModal').on('show.bs.modal', function (event) {
                                                $("#exampleModal input").val("");
                                            });
                                }
                            });
                        }
                    
                        };
                    }
 
                });
 
    });
      
    /*------------------------------------------
    --------------------------------------------
    Toastr Success Code
    --------------------------------------------
    --------------------------------------------*/
    function displayMessage(message) {
        toastr.success(message, 'Event');
    } 
    
</script>
  
</body>
</html>