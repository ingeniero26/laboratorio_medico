 
<script src="../js/usuario.js?rev=<?php echo time();?>"></script>
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Mantenimiento usuarios</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><b>Listado de usuario del sistema</b></h5>
                <button class="btn btn-primary btn-sm float-right" onclick="AbrirModalRegistro()">Nuevo Registro</button>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 table-responsive">
                   <table id="tabla_usuario" class="display">
                      <thead>
                          <tr>
                            <th>#</th>
                              <th>Usuario</th>
                              <th>Rol</th>
                              <th>Correo</th>
                              <th>Foto</th>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
               <label for="">Usuario</label>
               <input type="text" id="txt_usuario" class="form-control">
          </div>
           <div class="col-12">
               <label for="">Contraseña</label>
               <input type="password" id="txt_contrasena" class="form-control">
          </div>
           <div class="col-12">
               <label for="">Rol</label>
                <select class="js-example-basic-single" name="state" style="width: 100%;" id="cmb_rol"> 
           
             </select> <br>
          </div>
          <div class="col-12">
               <label for="">Correo</label>
               <input type="text" id="txt_correo" class="form-control"><br>
          </div> <br>
          <div class="col-12">
           <label for="">Subir Imagen</label>
           <input type="file" id="txt_foto" accept="imagen/*" onchange="previewFile(this);">
           <img src="" alt="" id="previewImg" class="img-fluid">
       </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Usuario()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_editar"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edición Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <input type="text" id="txt_idusuario" hidden>
               <label for="">Usuario</label>
               <input type="text" id="txt_usuario_actual_editar" class="form-control" disabled>
              
          </div>
        
           <div class="col-12">
               <label for="">Rol</label>
                <select class="js-example-basic-single" name="state" style="width: 100%;" id="cmb_rol_editar"> 
           
             </select> <br>
          </div>
          <div class="col-12">
               <label for="">Correo</label>
               <input type="text" id="txt_correo_editar" class="form-control"><br>
          </div> <br>
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="modificar_usuario()">Modificar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_editar_foto"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar foto usuario <label for="" id="lbl_usuario"></label></h5>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
           <input type="text" id="id_usuariofoto" hidden>
           <input type="text" id="foto_actual" hidden>
        
          <div class="col-12">
           <label for="">Subir Imagen</label>
           <input type="file" id="txt_foto2" accept="imagen/*" onchange="previewFile(this);">
           <img src="" alt="" id="previewImg2" class="img-fluid">
       </div>
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="modificar_foto_usuario()">Modificar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_editar_contra"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar contraseña usuario <label for="" id="lbl_usuario_contra"></label></h5>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
           <input type="text" id="id_usuariocontra" >
          
        
          <div class="col-12">
               <label for="">Contraseña Nueva</label>
               <input type="password" id="txt_contra1" class="form-control">
          </div>

          <div class="col-12">
               <label for="">Repetir Clave</label>
               <input type="password" id="txt_contra" class="form-control">
          </div>
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="modificar_contra_usuario()">Modificar</button>
      </div>
    </div>
  </div>
</div>
</div>

 <script type="text/javascript">
  listar_usuario_serverside();
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