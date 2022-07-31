
function Iniciar_Sesion() {
	recuerdame();
	let usu = document.getElementById('txt_usuario').value;
	let pass = document.getElementById('txt_clave').value;

	if(usu.length ==0 || pass.length == 0) {
		return Swal.fire(
			  'Error',
			  'Debe digitar un usuario y contraseña',
			  'warning'
			);
	}
	$.ajax({
		url:'controller/usuario/ctrlValidarLogin.php',
		type:'POST',
		data:{
			usu:usu,
			pass:pass
		}

	}).done(function(resp){
		let data = JSON.parse(resp);
		if(data.length > 0 ) {
			if(data[0][4]=='INACTIVO') {
				return  Swal.fire(
					  'Error',
					  'Usuario '+usu+' inactivo, comuniquese con el administrador del sistema',
					  'warning'
					);
			}
			$.ajax({
					url: 'controller/usuario/ctrlCrearSesion.php',
					type:'POST',
					data:{
						idusuario:data[0][0],
						usuario:data[0][1],
						rol:data[0][3]
					}
			}).done(function(r){
				let timerInterval
				Swal.fire({
				  title: 'Bienvenido  al sistema',
				  html: 'Será direccionado al panel principal',
				  timer: 2000,
				  heigtAuto:false,
				  timerProgressBar: true,
				  allowOutsideClick:false,
				  didOpen: () => {
				    Swal.showLoading()
				    const b = Swal.getHtmlContainer().querySelector('b')
				    timerInterval = setInterval(() => {
				      b.textContent = Swal.getTimerLeft()
				    }, 100)
				  },
				  willClose: () => {
				    clearInterval(timerInterval)
				  }
				}).then((result) => {
				  /* Read more about handling dismissals below */
				  if (result.dismiss === Swal.DismissReason.timer) {
				   location.reload();
				  }
				})
			})
			return Swal.fire(
			  'Confirmación',
			  'Logueo exito',
			  'success'
			);
		} else {
			return Swal.fire(
			  'Error',
			  'Usuario o contraseña, no validos',
			  'warning'
			);
		}
	})
}


function recuerdame() {
	if(rmcheck.checked && usuarioinput.value !=="" && passinput.value !== "") {
		localStorage.usuario = usuarioinput.value;
		localStorage.pass = passinput.value;
		localStorage.checkbox = rmcheck.value;
	} else {
		localStorage.usuario = 	"";
		localStorage.pass = 	"";
		localStorage.checkbox = "";
	}
}


var t_usuario;
function listar_usuario(){

     t_usuario = $("#tabla_usuario").DataTable({
	    "ordering":false,   
        "pageLength":10,
        "destroy":true,
        "async": false ,
        "responsive": true,
      	"autoWidth": false,
      "ajax":{
        "method":"POST",
		    "url":"../controller/usuario/controlador_usuario_listar.php",
		    
      },
      
      "order":[[1,'asc']],
        "columns":[
            {"defaultContent":""},
            {"data":"usu_nombre"},
            {"data":"rol_nombre"},
            {"data":"usu_email"},
           
            
            {"data":"usu_foto",
            render: function (data, type, row ) {
            	 return '<img src="../'+data+'" class="img-circle" style="width:28px">';
            	}
        	}, 
            {
                "data": "usu_status",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='label label-success'>" + data + "</span>";
                    } else {
                        return "<span class='label label-danger'>" + data + "</span>";
                    }
                }
            },
            {
                "data": "usu_status",
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp <button style='font-size:13px;' type='button' class='desactivar btn btn-danger' ><i class='fa fa-trash' disabled ></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success' disabled><i class='fa fa-check'></i></button> <button style='font-size:13px;' type='button' class='imprimir btn btn-primary'><i class='fa fa-print'></i></button>&nbsp;&nbsp;";
                    } else {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp <button style='font-size:13px;' type='button' class='desactivar btn btn-danger' disabled ><i class='fa fa-trash'  ></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success' ><i class='fa fa-check'></i></button>";
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
	t_usuario.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_usuario').DataTable().page.info();
        t_usuario.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}


var t_usuario;
function listar_usuario_serverside(){

     t_usuario = $("#tabla_usuario").DataTable({  
        "pageLength":10,
        "destroy":true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
      	"sAjaxSource":"../controller/usuario/serverside/serversideUsuario.php",
      
      "order":[[1,'asc']],
        "columns":[
            {"defaultContent":""},
            {"data":1},
            {"data":4},
            {"data":6},
           
            
            {"data":7,
            render: function (data, type, row ) {
            	 return '<img src="../'+data+'" class="img-responsive" style="width:28px">';
            	}
        	}, 
            {
                "data": 5,
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<span class='label label-success'>" + data + "</span>";
                    } else {
                        return "<span class='label label-danger'>" + data + "</span>";
                    }
                }
            },
            {
                "data": 5,
                render: function(data, type, row) {
                    if (data == 'ACTIVO') {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp <button style='font-size:13px;' type='button' class='desactivar btn btn-danger' ><i class='fa fa-trash' disabled ></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success' disabled><i class='fa fa-check'></i></button> <button style='font-size:13px;' type='button' class='foto btn btn-default'><i class='fa fa-image'></i></button>&nbsp;&nbsp;<button style='font-size:13px;' type='button' class='contra btn btn-secundary><i class='fa fa-key'></i></button>&nbsp;&nbsp;";
                    } else {
                        return "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp <button style='font-size:13px;' type='button' class='desactivar btn btn-danger' disabled ><i class='fa fa-trash'  ></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success' ><i class='fa fa-check'></i></button> <button style='font-size:13px;' type='button' class='foto btn btn-default'><i class='fa fa-image'></i></button>&nbsp;&nbsp; <button style='font-size:13px;' type='button' class='contra btn btn-secundary><i class='fa fa-key'></i></button>&nbsp;&nbsp;";
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
	t_usuario.on( 'draw.dt', function () {
        var PageInfo = $('#tabla_usuario').DataTable().page.info();
        t_usuario.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );
  
}
 // modificar datos del procedimiento
    $('#tabla_usuario').on('click','.editar',function(){
        var data = t_usuario.row($(this).parents('tr')).data();

         if(t_usuario.row(this).child.isShown()){
                var data = t_usuario.row(this).data();
            }
         $('.form-control').removeClass("is-invalid").removeClass("is-valid");
        $("#modal_editar").modal({backdrop:'static',keyboard:false})
        $("#modal_editar").modal('show');
        $("#txt_idusuario").val(data[0]);
        $("#txt_usuario_actual_editar").val(data[1]);
        $("#txt_correo_editar").val(data[6]);
        $("#cmb_rol_editar").val(data[3]).trigger("change");
       
       

    });


  function AbrirModalRegistro() {
        $('.form-control').removeClass("is-invalid").removeClass("is-valid");
        $("#modal_registro").modal({backdrop:'static',keyboard:false})
        $('#modal_registro').modal('show');

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
				cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
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



function Registrar_Usuario() {
	let usuario = document.getElementById('txt_usuario').value;
	let clave = document.getElementById('txt_contrasena').value;
	let rol = document.getElementById('cmb_rol').value;
	let correo = document.getElementById('txt_correo').value;
	let foto = document.getElementById('txt_foto').value;

	if(usuario.length==0 || clave.length ==0 || rol.length ==0 || correo.length ==0 
	) {
		ValidarInput("txt_usuario","txt_contrasena","txt_correo");
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
	formData.append('usuario',usuario);
	formData.append('clave',clave);
	formData.append('rol',rol);
	formData.append('correo',correo);
	formData.append('nombrefoto',nombrefoto);
	formData.append('foto',foto_img);
	$.ajax({
		url:'../controller/usuario/controlador_registro_usuario.php',
		type:'POST',
		data:formData,
		contentType:false,
		processData:false,
		success:function(resp) {
			if(resp > 0) {
				if(resp ==1) {
					ValidarInput("txt_usuario","txt_contrasena","txt_correo");
					$('#modal_registro').modal('hide');
                Swal.fire("Mensaje  de confirmaciòn","Usuario registrado exitosamente",
                    "success")
                .then((value)=>{
                    listar_usuario_serverside();
                  LimpiarCampos();
                    t_usuario.ajax.reload();
                
                });
				} else {
					return Swal.fire('Error', 'El usuario ya existe en el sistema, por favor ingrese otro',
			 	 'warning'	);
				}
			} else {
				return Swal.fire( 'Error', 'No se ha ingresado el usuario', 'warning'
			);
			}
		}
	});
	return false;
	
}

function ValidarInput(usuario,clave,correo) {
	Boolean(document.getElementById(usuario).value.length >0) ? $("#"+usuario).
	removeClass("is-invalid").addClass
	("is-valid"): $("#"+usuario).removeClass("is-valid").addClass("is-invalid");


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



function modificar_usuario() {
	let id = document.getElementById('txt_idusuario').value;
	
	let rol = document.getElementById('cmb_rol_editar').value;
	let correo = document.getElementById('txt_correo_editar').value;
	

	if( rol.length ==0 || correo.length ==0 
	) {
		ValidarInput("","","txt_correo_editar");
		return Swal.fire( 'Error', 'Debe digitar los datos del usuario', 'warning');
	}

	$.ajax({
		url:'../controller/usuario/controlador_modificar_usuario.php',
		type:'POST',
		data:{
			id:id,
			rol:rol,
			correo:correo
		}

	}).done(function(resp) {
		if(resp > 0) {
			$('#modal_editar').modal('hide');
                Swal.fire("Mensaje  de confirmaciòn","Usuario modificado exitosamente",
                    "success")
                .then((value)=>{
                    listar_usuario_serverside();
                  LimpiarCampos();
                    t_usuario.ajax.reload();
                
                });
				
			} else {
				return Swal.fire( 'Error', 'No se pudo actualizar el usuario', 'warning');
			}
		
	})
}



// desactivar usuario
    $('#tabla_usuario').on('click', '.activar', function() {
        var data = t_usuario.row($(this).parents('tr')).data();
        if (t_usuario.row(this).child.isShown()) {
            var data = t_usuario.row(this).data();
        }
        Swal.fire({
            title: 'Está seguro de activar el usuario?',
            text: "Una vez desactivado el usuario  podrá ingresar al sistema",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.isConfirmed) {
                Modificar_Estatus(data[0], 'ACTIVO');
            }
        })
    })
 // function activar usuario
    $('#tabla_usuario').on('click', '.desactivar', function() {
        var data = t_usuario.row($(this).parents('tr')).data();
        if (t_usuario.row(this).child.isShown()) {
            var data = t_usuario.row(this).data();
        }
        Swal.fire({
            title: 'Está seguro de desactivar el usuario?',
            text: "Una vez desactivado el usuario no podrá ingresar al sistema",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
        }).then((result) => {
            if (result.isConfirmed) {
                Modificar_Estatus(data[0], 'INACTIVO');
            }
        })
    })

	function Modificar_Estatus(usu_id, estatus) {
        var mensaje = "";
        if (estatus == 'INACTIVO') {
            mensaje = "desactivado";
        } else {
            mensaje = "activo";
        }
        $.ajax({
            url: "../controller/usuario/control_modificar_estatus.php",
            type: 'POST',
            data: {
                usu_id: usu_id,
                estatus: estatus,
            }
        }).done(function(resp) {
          // alert(resp);
            if (resp > 0) {
                Swal.fire("Mensaje  de confirmaciòn", "Usuario " + mensaje + " exitosamente",
                        "success")
                    .then((value) => {
                        //LimpiarRegistro();
                        t_usuario.ajax.reload();

                    });
            }

        })
    }



 $('#tabla_usuario').on('click', '.foto', function() {
        var data = t_usuario.row($(this).parents('tr')).data();
        if (t_usuario.row(this).child.isShown()) {
            var data = t_usuario.row(this).data();
        }
        $('.form-control').removeClass("is-invalid").removeClass("is-valid");
        $("#modal_editar_foto").modal({backdrop:'static',keyboard:false})
        $("#modal_editar_foto").modal('show');
         $("#id_usuariofoto").val(data[0]);
       document.getElementById('lbl_usuario').innerHTML=data[1];
       document.getElementById('foto_actual').value=data[7];

       
        
    })

 $('#tabla_usuario').on('click', '.contra', function() {
        var data = t_usuario.row($(this).parents('tr')).data();
        if (t_usuario.row(this).child.isShown()) {
            var data = t_usuario.row(this).data();
        }
        $('.form-control').removeClass("is-invalid").removeClass("is-valid");
        $("#modal_editar_contra").modal({backdrop:'static',keyboard:false})
        $("#modal_editar_contra").modal('show');
         $("#id_usuariocontra").val(data[0]);
        document.getElementById('lbl_usuario_contra').innerHTML=data[1];
       
        
    })

 function modificar_foto_usuario() {
 	let id = document.getElementById('id_usuariofoto').value;
	let foto = document.getElementById('txt_foto2').value;
	let ruta_actual = document.getElementById('foto_actual').value;

	if(id.length==0 || foto.length ==0) {
		
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
	var foto_img = $("#txt_foto2")[0].files[0];
	formData.append('id',id);
	formData.append('ruta_actual',ruta_actual);
	formData.append('nombrefoto',nombrefoto);
	formData.append('foto',foto_img);
	$.ajax({
		url:'../controller/usuario/controlador_modificar_foto_usuario.php',
		type:'POST',
		data:formData,
		contentType:false,
		processData:false,
		success:function(resp) {
			if(resp > 0) {
				
					
					$('#modal_editar_foto').modal('hide');
					document.getElementById('txt_foto2').value ="";
                Swal.fire("Mensaje  de confirmaciòn","Foto modificada exitosamente",
                    "success")
                .then((value)=>{
                    listar_usuario_serverside();
                 // LimpiarCampos();
                    t_usuario.ajax.reload();
                
                });
				
			} else {
				return Swal.fire( 'Error', 'No se ha modificado la foto usuario', 'warning'
			);
			}
		}
	});
	return false;
	
 }