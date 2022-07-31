
var t_examen;
function listar_examen(){

     t_examen = $("#tabla_examenes").DataTable({
	    "ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
      	"autoWidth": false,
      "ajax":{
        "method":"POST",
		    "url":"../controller/examen/controlador_examen_listar.php",
		    
      },
      
      "order":[[1,'asc']],
        "columns":[
            {"defaultContent":""},
          
            {"data":"examen_nombre"},
            {"data":"analisis_nombre"},
                  
            {
                "data": "examen_estatus",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='label label-success'>" + data + "</span>";
                    } else {
                        return "<span class='label label-danger'>" + data + "</span>";
                    }
                }
            },
            {
                "data": "examen_estatus",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp <button style='font-size:13px;' type='button' class='desactivar btn btn-danger' ><i class='fa fa-trash' disabled ></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success' disabled><i class='fa fa-check'></i></button> <button style='font-size:13px;' type='button' class='imprimir btn btn-primary'><i class='fa fa-print'></i></button>&nbsp;&nbsp;";
                    } else {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp <button style='font-size:13px;' type='button' class='desactivar btn btn-danger' disabled ><i class='fa fa-trash'  ></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success' ><i class='fa fa-check'></i></button>";
                    }
                }
            },
        
      ],
      
        "language":idioma_espanol,
        select: true
	});
	t_examen.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_examenes').DataTable().page.info();
        t_examen.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}

 function AbrirModalRegistro() {
        $('.form-control').removeClass("is-invalid").removeClass("is-valid");
        $("#modal_registro").modal({backdrop:'static',keyboard:false})
        $('#modal_registro').modal('show');

    }


       function listar_select_analisis() {
    $.ajax({
        url:"../controller/examen/controlador_combo_analisis_listar.php",
         type:'POST'
    }).done(function(resp){
        //alert(resp);
        var data = JSON.parse(resp);
        //console.log(resp);
        var cadena ="<option value=''>Seleccione...</option>";
        if(data.length>0) {
            for (var i = 0; i < data.length; i++) {
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $('#cmb_analisis').html(cadena);
            $('#cmb_rol_editar').html(cadena);
        } else {
            cadena+="<option value=''> No Hay datos</option>";
            $('#cmb_analisis').html(cadena);
            $('#cmb_rol_editar').html(cadena);
        }
    })
}

function ValidarInput(examen) {
    Boolean(document.getElementById(examen).value.length >0) ? $("#"+examen).
    removeClass("is-invalid").addClass
    ("is-valid"): $("#"+examen).removeClass("is-valid").addClass("is-invalid");

    
}

function Registrar_Examen() {
      var examen = $('#txt_examen').val();
      var analisis = $('#cmb_analisis').val();
      
      if(examen.length==0 || analisis.length == 0) {
        return   Swal.fire( 'Mensaje de error',  'Digite los campos estan vacios', 'warning'
        );
      }
      $.ajax({
        url:'../controller/examen/controlador_registro_examen.php',
        type:'POST',
        data:{
          examen:examen,
          analisis:analisis
         
        }
      }).done(function(resp){
        if(resp > 0) {
            if(resp==1) {
                $('#modal_registro').modal('hide');
                Swal.fire("Mensaje  de confirmaciòn","Examen registrado exitosamente",
                    "success")
                .then((value)=>{
                    listar_examen();
               // LimpiarCampos();
                    t_examen.ajax.reload();
                
                });
            } else {
               // LimpiarCampos();
                return Swal.fire('Mensaje de error', 'Examen ya existe en el sistema, utilice otro', 'warning'
                  );
            }
        }else {
            return Swal.fire('Mensaje de error','Examen no insertado','warning');
        }
      })
}
