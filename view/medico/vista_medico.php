 
<script src="../js/medico.js?rev=<?php echo time();?>"></script>
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Medicos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Mantenimiento Medicos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><b>Listado de Medicos</b></h5>
                <button class="btn btn-primary btn-sm float-right" onclick="AbrirModalRegistro()">Nuevo Registro</button>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 table-responsive ">
                   <table id="tabla_medico" class="display table-bordered">
                      <thead>
                          <tr>
                            <th>#</th>
                              <th>Medico</th>
                              <th>Documento</th>
                              <th>Telefono</th>
                              <th>Direcciòn</th>
                            
                              <th>Fec Nac</t>
                              <th>Especialidad</th>
                              <th>Registro</th>
                              <th>Estado</th>
                              <th>Opciones</th>
                          </tr>
                      </thead>
                      <tbody>
                      
                      </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>

          
          </div>
 



<!-- Modal registro-->
<div class="modal fade" id="modal_registro"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Medicos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-4">
               <label for="">Documento</label>
               <input type="text" id="txt_NroDocumento" class="form-control" onkeypress="return soloNumeros(event)" maxlength="10">
          </div>
           <div class="col-8">
               <label for="">Nombre</label>
               <input type="text" id="txt_nombre" class="form-control" onkeypress="return soloLetras(event)">
          </div>

           <div class="col-6">
               <label for="">Apellido 1</label>
               <input type="text" id="txt_apepat" class="form-control" onkeypress="return soloLetras(event)">
          </div>
           <div class="col-6">
               <label for="">Apellido 2</label>
               <input type="text" id="txt_apemat" class="form-control" onkeypress="return soloLetras(event)">
          </div>
          
             <div class="col-6">
               <label for="">Dirección</label>
               <input type="text" id="txt_direcion" class="form-control">
          </div>
           <div class="col-6">
               <label for="">Celular</label>
               <input type="text" id="txt_movil" class="form-control" onkeypress="return soloNumeros(event)" maxlength="12">
          </div>
          <div class="col-6">
               <label for="">Fecha Nac</label>
               <input type="date" id="txt_fecha" class="form-control"><br>
          </div> <br>
           <div class="col-6">
               <label for="">Especialidad</label>
                <select class="js-example-basic-single" name="state" style="width: 100%;" id="cmb_especialidad"> 
           
             </select> <br>
          </div>
          <div class="col-12"><br>
            <h3 class="text-center">DATOS DE USUARIO</h3>
          </div>
          <div class="col-6">
               <label for="">Usuario</label>
               <input type="text" id="txt_usuario" class="form-control">
          </div>
           <div class="col-6">
               <label for="">Contraseña</label>
               <input type="password" id="txt_contrasena" class="form-control">
          </div>
           <div class="col-6">
               <label for="">Rol</label>
                <select class="js-example-basic-single" name="state" style="width: 100%;" id="cmb_rol"> 
           
             </select> <br>
          </div>
          <div class="col-6">
               <label for="">Correo</label>
               <input type="text" id="txt_correo" class="form-control"><br>
          </div> <br>
          <div class="col-12">
           <label for="">Subir Imagen</label>
           <input type="file" id="txt_foto" accept="imagen/*" onchange="previewFile(this);">
           <img src="" alt="" id="previewImg" class="img-fluid">
       </div>
           <div class="col-12" id="div_mensaje_error">
 
            </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Medico()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_editar"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Medicos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
           <input type="text" id="txt_idmedico" hidden>
          <div class="col-4">
           
               <label for="">Documento</label>
               <input type="text" id="txt_NroDocumento_actual" hidden onkeypress="return soloNumeros(event)" maxlength="10">
                <input type="text" id="txt_NroDocumento_editar" class="form-control" onkeypress="return soloNumeros(event)" maxlength="10">
             </div>
              
           <div class="col-8">
               <label for="">Nombre</label>
               <input type="text" id="txt_nombre_editar" class="form-control" onkeypress="return soloLetras(event)">
          </div>

           <div class="col-6">
               <label for="">Apellido 1</label>
               <input type="text" id="txt_apepat_editar" class="form-control" onkeypress="return soloLetras(event)">
          </div>
           <div class="col-6">
               <label for="">Apellido 2</label>
               <input type="text" id="txt_apemat_editar" class="form-control" onkeypress="return soloLetras(event)">
          </div>
          
             <div class="col-6">
               <label for="">Dirección</label>
               <input type="text" id="txt_direcion_editar" class="form-control">
          </div>
           <div class="col-6">
               <label for="">Celular</label>
               <input type="text" id="txt_movil_editar" class="form-control" onkeypress="return soloNumeros(event)" maxlength="12">
          </div>
          <div class="col-6">
               <label for="">Fecha Nac</label>
               <input type="date" id="txt_fecha_editar" class="form-control"><br>
          </div> <br>
           <div class="col-6">
               <label for="">Especialidad</label>
                <select class="js-example-basic-single" name="state" style="width: 100%;" id="cmb_especialidad_editar"> 
           
             </select> <br>
          </div>
          <div class="col-12"><br>
            <h3 class="text-center">DATOS DE USUARIO</h3>
          </div>
          <div class="col-6">
               <label for="">Usuario</label>
               <input type="text" id="txt_usuario_editar" class="form-control" disabled>
          </div>
         
           <div class="col-6">
               <label for="">Rol</label>
                <select class="js-example-basic-single" name="state" style="width: 100%;" id="cmb_rol_editar" disabled> 
           
             </select> <br>
          </div>
          <div class="col-6">
               <label for="">Correo</label>
               <input type="text" id="txt_correo_editar" class="form-control"><br>
          </div> <br>
            <div class="col-6">
             <label for="estatus"><b>Estatus:</b></label>
             <select class="js-example-basic-single" name="state" style="width: 100%;" id="cmb_estatus_editar">
             <option value="ACTIVO">ACTIVO</option>
              <option value="INACTIVO">INACTIVO</option>
             </select> <br> <br>
           </div>
       
           <div class="col-12" id="div_mensaje_error">
 
            </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="Modificar_Medico()">Modificar</button>
      </div>
    </div>
  </div>
</div>









 <script type="text/javascript">
  
   listar_medico();
  listar_select_especialidad();
   listar_select_rol();
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  
});

  document.getElementById("txt_foto").addEventListener("change", () => {
     var fileName = document.getElementById("txt_foto").value; 
     var idxDot = fileName.lastIndexOf(".") + 1; 
     var extFile = fileName.substr(idxDot, fileName.length).toLowerCase(); 
     if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){ 
      //TO DO 
     }else{ 
      Swal.fire("MENSAJE DE ADVERTENCIA","DEBE SELECCIONAR SOLO IMAGENES","warning");
       document.getElementById("txt_foto").value="";
     } 
    });

    document.getElementById("txt_foto2").addEventListener("change", () => {
     var fileName = document.getElementById("txt_foto2").value; 
     var idxDot = fileName.lastIndexOf(".") + 1; 
     var extFile = fileName.substr(idxDot, fileName.length).toLowerCase(); 
     if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){ 
      //TO DO 
     }else{ 
      Swal.fire("MENSAJE DE ADVERTENCIA","DEBE SELECCIONAR SOLO IMAGENES","warning");
       document.getElementById("txt_foto2").value="";
     } 
    });




    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
                $("#previewImg2").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
    




   
  
 </script>