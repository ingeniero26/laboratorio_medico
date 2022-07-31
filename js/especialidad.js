


var t_especialidad;
function listar_especialidad(){

     t_especialidad = $("#tabla_especialidad").DataTable({
	    "ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
      	"autoWidth": false,
      "ajax":{
        "method":"POST",
		    "url":"../controller/especialidad/controlador_especialidad_listar.php",
		    
      },
      
      "order":[[1,'asc']],
        "columns":[
            {"defaultContent":""},
          
            {"data":"especialidad_nombre"},
            {"data":"especialidad_fregistro"},
                  
            {
                "data": "especialidad_estatus",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='label label-success'>" + data + "</span>";
                    } else {
                        return "<span class='label label-danger'>" + data + "</span>";
                    }
                }
            },
            {
                "data": "especialidad_estatus",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp";
                    } else {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp ";
                    }
                }
            },
        
      ],
      
        "language":idioma_espanol,
        select: true
	});
	t_especialidad.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_especialidad').DataTable().page.info();
        t_especialidad.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}

  function AbrirModalRegistro() {
        $('.form-control').removeClass("is-invalid").removeClass("is-valid");
        $("#modal_registro").modal({backdrop:'static',keyboard:false})
        $('#modal_registro').modal('show');

    }

     // modificar datos del procedimiento
    $('#tabla_especialidad').on('click','.editar',function(){
        var data = t_especialidad.row($(this).parents('tr')).data();

         if(t_especialidad.row(this).child.isShown()){
                var data = t_especialidad.row(this).data();
            }
         $('.form-control').removeClass("is-invalid").removeClass("is-valid");
        $("#modal_editar").modal({backdrop:'static',keyboard:false})
        $("#modal_editar").modal('show');
         $("#txt_idespecialidad").val(data.especialidad_id);
        $("#txt_especialidad_actual_editar").val(data.especialidad_nombre).trigger("change");
        $("#txt_especialidad_nuevo_editar").val(data.especialidad_nombre);
       $("#cmb_estatus_editar").val(data.especialidad_estatus).trigger("change");
       
       

    });



  function Registrar_Especialidad() {
      var especialidad = $('#txt_especialidad').val();
      
      if(especialidad.length==0) {
        return   Swal.fire( 'Mensaje de error',  'Digite los campos estan vacios', 'warning'
        );
      }
      $.ajax({
        url:'../controller/especialidad/controlador_registro_especialidad.php',
        type:'POST',
        data:{
          especialidad:especialidad
         
        }
      }).done(function(resp){
        if(resp > 0) {
            if(resp==1) {
                $('#modal_registro').modal('hide');
                Swal.fire("Mensaje  de confirmaciòn","Analisis registrado exitosamente",
                    "success")
                .then((value)=>{
                    listar_especialidad();
               // LimpiarCampos();
                    t_especialidad.ajax.reload();
                
                });
            } else {
               // LimpiarCampos();
                return Swal.fire('Mensaje de error', 'Analisis ya existe en el sistema, utilice otro', 'warning'
                  );
            }
        }else {
            return Swal.fire('Mensaje de error','Analisis no insertado','warning');
        }
      })
    }



function ValidarInput(rol) {
    Boolean(document.getElementById(rol).value.length >0) ? $("#"+rol).
    removeClass("is-invalid").addClass
    ("is-valid"): $("#"+rol).removeClass("is-valid").addClass("is-invalid");

    
}


function Modificar_Especialidad() {
      var id = $('#txt_idespecialidad').val();
      var especialidad_actual = $('#txt_especialidad_actual_editar').val();
      var especialidad_nuevo = $('#txt_especialidad_nuevo_editar').val();
      var estatus =$("#cmb_estatus_editar").val();

      if(especialidad_nuevo.length == 0 ) {
        Swal.fire('Mensaje de error','Debe digitar los campos vacios','warning');
      }
      $.ajax({
        url:'../controller/especialidad/controlador_modificar_especialidad.php',
        type:'POST',
        data:{
          id:id,
          especialidad_actual:especialidad_actual,
          especialidad_nuevo:especialidad_nuevo,
          estatus:estatus
        }
      }).done(function(resp){
         if(resp > 0) {
            if(resp==1) {
                $('#modal_editar').modal('hide');
                Swal.fire("Mensaje  de confirmaciòn","Especialidad editado exitosamente",
                    "success")
                .then((value)=>{
                    listar_especialidad();
               LimpiarCampos();
                    t_rol.ajax.reload();
                
                });
            } else {
              //  LimpiarCampos();
                return Swal.fire('Mensaje de error', 'Especialidad ya existe en el sistema, utilice otro', 'warning'
                  );
            }
        }else {
            return Swal.fire('Mensaje de error','Especialidad no editado','warning');
        }
      })
}