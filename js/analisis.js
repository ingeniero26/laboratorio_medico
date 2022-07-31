


var t_analisis;
function listar_analisis(){

     t_analisis = $("#tabla_analisis").DataTable({
	    "ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
      	"autoWidth": false,
      "ajax":{
        "method":"POST",
		    "url":"../controller/analisis/controlador_analisis_listar.php",
		    
      },
      
      "order":[[1,'asc']],
        "columns":[
            {"defaultContent":""},
          
            {"data":"analisis_nombre"},
            {"data":"analisis_fregistro"},
                  
            {
                "data": "analisis_estatus",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='label label-success'>" + data + "</span>";
                    } else {
                        return "<span class='label label-danger'>" + data + "</span>";
                    }
                }
            },
            {
                "data": "analisis_estatus",
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
	t_analisis.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_analisis').DataTable().page.info();
        t_analisis.column(0, { page: 'current' }).nodes().each( function (cell, i) {
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
    $('#tabla_analisis').on('click','.editar',function(){
        var data = t_analisis.row($(this).parents('tr')).data();

         if(t_analisis.row(this).child.isShown()){
                var data = t_analisis.row(this).data();
            }
         $('.form-control').removeClass("is-invalid").removeClass("is-valid");
        $("#modal_editar").modal({backdrop:'static',keyboard:false})
        $("#modal_editar").modal('show');
         $("#txt_idanalisis").val(data.analisis_id);
        $("#txt_analisis_actual_editar").val(data.analisis_nombre).trigger("change");
        $("#txt_analisis_nuevo_editar").val(data.analisis_nombre);
       $("#cmb_estatus_editar").val(data.analisis_estatus).trigger("change");
       
       

    });



  function Registrar_Analisis() {
      var analisis = $('#txt_analisis').val();
      
      if(analisis.length==0) {
        return   Swal.fire( 'Mensaje de error',  'Digite los campos estan vacios', 'warning'
        );
      }
      $.ajax({
        url:'../controller/analisis/controlador_registro_analisis.php',
        type:'POST',
        data:{
          analisis:analisis
         
        }
      }).done(function(resp){
        if(resp > 0) {
            if(resp==1) {
                $('#modal_registro').modal('hide');
                Swal.fire("Mensaje  de confirmaciòn","Analisis registrado exitosamente",
                    "success")
                .then((value)=>{
                    listar_analisis();
               // LimpiarCampos();
                    t_analisis.ajax.reload();
                
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


function Modificar_Analisis() {
      var id = $('#txt_idanalisis').val();
      var analisis_actual = $('#txt_analisis_actual_editar').val();
      var analisis_nuevo = $('#txt_analisis_nuevo_editar').val();
      var estatus =$("#cmb_estatus_editar").val();

      if(analisis_nuevo.length == 0 ) {
        Swal.fire('Mensaje de error','Debe digitar los campos vacios','warning');
      }
      $.ajax({
        url:'../controller/analisis/controlador_modificar_analisis.php',
        type:'POST',
        data:{
          id:id,
          analisis_actual:analisis_actual,
          analisis_nuevo:analisis_nuevo,
          estatus:estatus
        }
      }).done(function(resp){
         if(resp > 0) {
            if(resp==1) {
                $('#modal_editar').modal('hide');
                Swal.fire("Mensaje  de confirmaciòn","Analisis editado exitosamente",
                    "success")
                .then((value)=>{
                    listar_analisis();
               LimpiarCampos();
                    t_rol.ajax.reload();
                
                });
            } else {
              //  LimpiarCampos();
                return Swal.fire('Mensaje de error', 'Analisis ya existe en el sistema, utilice otro', 'warning'
                  );
            }
        }else {
            return Swal.fire('Mensaje de error','Analisis no editado','warning');
        }
      })
}