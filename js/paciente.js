
var t_paciente;
function listar_paciente_serverside(){

     t_paciente = $("#tabla_paciente").DataTable({  
        "pageLength":10,
        "destroy":true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
      	"sAjaxSource":"../controller/paciente/serverside/serversidePaciente.php",
      
      "order":[[1,'asc']],
        "columns":[
            {"defaultContent":""},
            {"data":11},
            {"data":4},
            {"data":5},
            {"data":12},
           
             {"data":8},
              {"data":10},
         
            {
                "data": 9,
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='label label-success'>" + data + "</span>";
                    } else {
                        return "<span class='label label-danger'>" + data + "</span>";
                    }
                }
            },
            {
                "data": 9,
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp <button style='font-size:13px;' type='button' class='desactivar btn btn-danger' ><i class='fa fa-trash' disabled ></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success' disabled><i class='fa fa-check'></i></button> <button style='font-size:13px;' ";
                    } else {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp <button style='font-size:13px;' type='button' class='desactivar btn btn-danger' disabled ><i class='fa fa-trash'  ></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success' ><i class='fa fa-check'></i></button> <button style='font-size:13px;'";
                    }
                }
            },
             
        
      ],
      "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        	$($(nRow).find("td")[1]).css('text-align', 'center' );
            $($(nRow).find("td")[4]).css('text-align', 'center' );
        },
        "language":idioma_espanol,
        select: true
	});
	t_paciente.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_paciente').DataTable().page.info();
        t_paciente.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}


 // modificar datos del procedimiento
    $('#tabla_paciente').on('click','.editar',function(){
        var data = t_paciente.row($(this).parents('tr')).data();

         if(t_paciente.row(this).child.isShown()){
                var data = t_paciente.row(this).data();
            }
         $('.form-control').removeClass("is-invalid").removeClass("is-valid");
        $("#modal_editar_paciente").modal({backdrop:'static',keyboard:false})
        $("#modal_editar_paciente").modal('show');
        $("#txt_idpaciente").val(data[0]);
        $("#txt_dni_actual_editar").val(data[4]);
        $("#txt_dni_nuevo_editar").val(data[4]);
        $("#txt_nombres_editar").val(data[1]);
        $("#txt_apepat_editar").val(data[2]);
        $("#txt_apemat_editar").val(data[3]);
        $("#txt_celular_editar").val(data[5]);
        $("#txt_edad_editar").val(data[6]);
        $("#select_tipo_editar").val(data[7]).trigger("change");
        $("#select_sexo_editar").val(data[8]).trigger("change");
       
       

    });





function AbrirModalRegistroPaciente(){
  $("#modal_registro_paciente").modal({backdrop:'static',keyboard:false})
  $("#modal_registro_paciente").modal('show');
  document.getElementById('div_mensaje_error').innerHTML='';
}


function Registrar_Paciente(){
  let dni      = document.getElementById('txt_dni').value;
  let nombres  = document.getElementById('txt_nombres').value;
  let apepat   = document.getElementById('txt_apepat').value;
  let apemat   = document.getElementById('txt_apemat').value;
  let celular  = document.getElementById('txt_celular').value;
  let edad     = document.getElementById('txt_edad').value;
  let tipo     = document.getElementById('select_tipo').value;
  let sexo     = document.getElementById('select_sexo').value;
  if(tipo.length==0 || sexo.length==0 ){
    return Swal.fire("Mensaje de Advertencia","Debe seleccionar un tipo o sexo","warning");  
  }
  if(dni.length==0 || nombres.length==0 || apepat.length==0 || apemat.length==0 || celular.length==0 || edad.length==0 ){
    ValidarInputPaciente("txt_dni","txt_nombres","txt_apepat","txt_apemat","txt_celular","txt_edad");
    return Swal.fire("Mensaje de Advertencia","Tiene algunos campos vacios","warning");
  }
 
  $.ajax({
    url:'../controller/paciente/controlador_registrar_paciente.php',
    type:'post',
    data:{
      
      nombres:nombres,
      apepat:apepat,
      apemat:apemat,
      dni:dni,
      celular:celular,
      edad:edad,
      tipo:tipo,
      sexo:sexo    
    }
  }).done(function(resp){
      if(isNaN(resp)){
        document.getElementById('div_mensaje_error').innerHTML='<br>'+
        '<div class="alert alert-danger alert-dismissible">'+
              '<h5><i class="icon fas fa-ban"></i> Revise los siguientes campos!</h5>'+resp+'</div>';
      }else{
          if(resp>0){
            if(resp==1){
              Swal.fire("Mensaje de Confirmacion","Nuevo Paciente Registrado","success").then((value)=>{
                  LimpiarCamposPaciente();
                  $("#modal_registro_paciente").modal('hide');
                  t_paciente.ajax.reload();
                });
            }else{
              Swal.fire("Mensaje de Advertencia","El DNI ingresado ya se encuentra en la base de datos","warning");
            }
          }else{
            return Swal.fire("Mensaje de Error","No se pudo completar registro","error");
          }
      }
  })
 
}

function ValidarInputPaciente(dni,nombre,apepat,apemat,celular,edad){
  //usuario = txt_usuario
  //$("#id").value
  Boolean(document.getElementById(dni).value.length>0) ? $("#"+dni).removeClass("is-invalid").addClass("is-valid") : $("#"+dni).removeClass("is-valid").addClass("is-invalid");
 
  Boolean(document.getElementById(nombre).value.length>0) ? $("#"+nombre).removeClass("is-invalid").addClass("is-valid") : $("#"+nombre).removeClass("is-valid").addClass("is-invalid");
 
  Boolean(document.getElementById(apepat).value.length>0) ? $("#"+apepat).removeClass("is-invalid").addClass("is-valid") : $("#"+apepat).removeClass("is-valid").addClass("is-invalid");
 
  Boolean(document.getElementById(apemat).value.length>0) ? $("#"+apemat).removeClass("is-invalid").addClass("is-valid") : $("#"+apemat).removeClass("is-valid").addClass("is-invalid");
 
  Boolean(document.getElementById(celular).value.length>0) ? $("#"+celular).removeClass("is-invalid").addClass("is-valid") : $("#"+celular).removeClass("is-valid").addClass("is-invalid");
 
  Boolean(document.getElementById(edad).value.length>0) ? $("#"+edad).removeClass("is-invalid").addClass("is-valid") : $("#"+edad).removeClass("is-valid").addClass("is-invalid");
 
}


function LimpiarCamposPaciente(){
  document.getElementById('txt_dni').value="";
  document.getElementById('txt_nombres').value="";
  document.getElementById('txt_apepat').value="";
  document.getElementById('txt_apemat').value="";
  document.getElementById('txt_celular').value="";
  document.getElementById('txt_edad').value="";
  $("#select_tipo").select2().val("").trigger('change.select2');
  $("#select_sexo").select2().val("").trigger('change.select2');
}
