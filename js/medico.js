


var t_medico;
function listar_medico(){

     t_medico = $("#tabla_medico").DataTable({
	    "ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
      	"autoWidth": false,
      "ajax":{
        "method":"POST",
		    "url":"../controller/medico/controlador_medico_listar.php",
		    
      },
      
      "order":[[1,'asc']],
        "columns":[
            {"defaultContent":""},
          
            {"data":"medico"},
            {"data":"medico_nrodocumento"},
            {"data":"medico_movil"},
            {"data":"medico_direccion"},
            {"data":"medico_fenac"},
            {"data":"especialidad_nombre"},
            {"data":"fregistro"},
                  
            {
                "data": "estatus",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='label label-success'>" + data + "</span>";
                    } else {
                        return "<span class='label label-danger'>" + data + "</span>";
                    }
                }
            },
            {
                "data": "estatus",
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
	t_medico.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_medico').DataTable().page.info();
        t_medico.column(0, { page: 'current' }).nodes().each( function (cell, i) {
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
    $('#tabla_medico').on('click','.editar',function(){
        var data = t_medico.row($(this).parents('tr')).data();

         if(t_medico.row(this).child.isShown()){
                var data = t_medico.row(this).data();
            }
         $('.form-control').removeClass("is-invalid").removeClass("is-valid");
        $("#modal_editar").modal({backdrop:'static',keyboard:false})
        $("#modal_editar").modal('show');
         $("#txt_idmedico").val(data.medico_id);
        $("#txt_NroDocumento_actual").val(data.medico_nrodocumento).trigger("change");
        $("#txt_NroDocumento_editar").val(data.medico_nrodocumento);
        $("#txt_nombre_editar").val(data.medico_nombre);
        $("#txt_apepat_editar").val(data.medico_apepat);
        $("#txt_apemat_editar").val(data.medico_apemat);
        $("#txt_direcion_editar").val(data.medico_direccion);
        $("#txt_movil_editar").val(data.medico_movil);
        $("#txt_fecha_editar").val(data.medico_fenac);
        $("#cmb_especialidad_editar").val(data.especialidad_id).trigger("change");
        $("#txt_usuario_editar").val(data.usu_nombre);
        $("#cmb_rol_editar").val(data.rol_id).trigger("change");
        $("#txt_correo_editar").val(data.usu_email);
       $("#cmb_estatus_editar").val(data.estatus).trigger("change");
       
       

    });


 function listar_select_especialidad() {
    $.ajax({
        url:"../controller/especialidad/controlador_combo_especialidad_listar.php",
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
            $('#cmb_especialidad').html(cadena);
           $('#cmb_especialidad_editar').html(cadena);
        } else {
            cadena+="<option value=''> No Hay datos</option>";
            $('#cmb_especialidad').html(cadena);
            $('#cmb_especialidad_editar').html(cadena);
        }
    })
}
    function listar_select_rol() {
    $.ajax({
        url:"../controller/usuario/controlador_combo_rol_listar.php",
         type:'POST'
    }).done(function(resp){
        //alert(resp);
        var data = JSON.parse(resp);
        //console.log(resp);
        var cadena ="<option value=''>Seleccione...</option>";
        if(data.length>0) {
            for (var i = 0; i < data.length; i++) {
                if(data[i][0]!= "4") {
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
  
                }
            }
            $('#cmb_rol').html(cadena);
            $('#cmb_rol_editar').html(cadena);
        } else {
            cadena+="<option value=''> No Hay datos</option>";
            $('#cmb_rol').html(cadena);
         $('#cmb_rol_editar').html(cadena);
        }
    })
}


function Registrar_Medico() {
    let nombre = document.getElementById('txt_nombre').value;
    let apepat = document.getElementById('txt_apepat').value;
    let apemat = document.getElementById('txt_apemat').value;
    let direccion = document.getElementById('txt_direcion').value;
    let celular = document.getElementById('txt_movil').value;
    let fecha_nac = document.getElementById('txt_fecha').value;
    let documento = document.getElementById('txt_NroDocumento').value;
    let idespecialidad = document.getElementById('cmb_especialidad').value;
    let usuario = document.getElementById('txt_usuario').value;
    let clave = document.getElementById('txt_contrasena').value;
    let rol = document.getElementById('cmb_rol').value;
    let correo = document.getElementById('txt_correo').value;
    let foto = document.getElementById('txt_foto').value;

    if(idespecialidad.length == 0) {
        return Swal.fire( 'Error', 'Debe seleccionar una especialidad', 'warning');
    }
      if(rol.length == 0) {
        return Swal.fire( 'Error', 'Debe  seleccionar un rol', 'warning');
    }

    if( nombre.length ==0 || apepat.length ==0 || documento.length ==0
    || usuario.length==0 || clave.length ==0 ||  correo.length ==0 
    ) {
        ValidarInput("txt_nombre","txt_apepat","txt_apemat","txt_NroDocumento","txt_usuario","txt_contrasena","txt_correo");
        return Swal.fire( 'Error', 'Debe digitar los datos del usuario', 'warning');
    }
    /*if(validar_email(correo)) {

    } else {
        return Swal.fire(
              'Error',
              'Debe ingresar un correo válido',
              'warning'
            );
    }*/


    let nombrefoto ="";


    let f = new Date();
    var extension = foto.split('.').pop();
    if(foto.length > 0) {
         nombrefoto = "IMG"+f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+
    f.getHours()+""+f.getMinutes()+""+f.getSeconds()+"."+extension;
    }
    
 
    let formData = new FormData();
    var foto_img = $("#txt_foto")[0].files[0];
    formData.append('nombre',nombre);
    formData.append('apepat',apepat);
    formData.append('apemat',apemat);
    formData.append('direccion',direccion);
    formData.append('celular',celular);
    formData.append('fecha_nac',fecha_nac);
    formData.append('documento',documento);
    formData.append('idespecialidad',idespecialidad);
    formData.append('usuario',usuario);
    formData.append('clave',clave);
    formData.append('rol',rol);
    formData.append('correo',correo);
    formData.append('nombrefoto',nombrefoto);
    formData.append('foto',foto_img);
    $.ajax({
        url:'../controller/medico/controlador_medico_registrar.php',
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        success:function(resp) {
             if(isNaN(resp)){
        document.getElementById('div_mensaje_error').innerHTML='<br>'+
        '<div class="alert alert-danger alert-dismissible">'+
              '<h5><i class="icon fas fa-ban"></i> Revise los siguientes campos!</h5>'+resp+'</div>';
      } else 
          if(isNaN(resp)){
        document.getElementById('div_mensaje_error').innerHTML='<br>'+
        '<div class="alert alert-danger alert-dismissible">'+
              '<h5><i class="icon fas fa-ban"></i> Revise los siguientes campos!</h5>'+resp+'</div>';
      } else {
            if(resp > 0) {
              
                if(resp ==1) {
                  
                    $('#modal_registro').modal('hide');
                Swal.fire("Mensaje  de confirmaciòn","Medico registrado exitosamente",
                    "success")
                .then((value)=>{
                    listar_medico();
                
                    t_medico.ajax.reload();
                
                });
                } else if(resp==2)  {
                    return Swal.fire('Error', 'El documento ya existe en el sistema, por favor ingrese otro',
                 'warning'  );
                } else {
                     return Swal.fire('Error', 'El usuario ya existe en el sistema, por favor ingrese otro',
                 'warning'  );
                }
            } else {
                return Swal.fire( 'Error', 'No se ha ingresado el medico', 'warning'
            );
            }
            
        }
    }
    });
    return false;
    
}

function ValidarInput(nombre,apepat, apemat,documento, usuario,clave,correo) {
    Boolean(document.getElementById(usuario).value.length >0) ? $("#"+usuario).
    removeClass("is-invalid").addClass
    ("is-valid"): $("#"+usuario).removeClass("is-valid").addClass("is-invalid");

     Boolean(document.getElementById(nombre).value.length >0) ? $("#"+nombre).
    removeClass("is-invalid").addClass
    ("is-valid"): $("#"+nombre).removeClass("is-valid").addClass("is-invalid");

     Boolean(document.getElementById(apepat).value.length >0) ? $("#"+apepat).
    removeClass("is-invalid").addClass
    ("is-valid"): $("#"+apepat).removeClass("is-valid").addClass("is-invalid");

     Boolean(document.getElementById(apemat).value.length >0) ? $("#"+apemat).
    removeClass("is-invalid").addClass
    ("is-valid"): $("#"+apemat).removeClass("is-valid").addClass("is-invalid");

     Boolean(document.getElementById(documento).value.length >0) ? $("#"+documento).
    removeClass("is-invalid").addClass
    ("is-valid"): $("#"+documento).removeClass("is-valid").addClass("is-invalid");






if(clave != "") {
    Boolean(document.getElementById(clave).value.length >0) ? $("#"+clave).
    removeClass("is-invalid").addClass
    ("is-valid"): $("#"+clave).removeClass("is-valid").addClass("is-invalid");
}
    

    Boolean(document.getElementById(correo).value.length >0) ? $("#"+correo).
    removeClass("is-invalid").addClass
    ("is-valid"): $("#"+correo).removeClass("is-valid").addClass("is-invalid");
}

function validar_email(correo) {
    var regex =/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
    return regex.test(correo) ? true : false;
}

function LimpiarCampos() {
    $("#txt_usuario").val("");
    $("#txt_clave").val("");
    $("#txt_correo").val("");
}