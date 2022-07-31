 
<script src="../js/especialidad.js?rev=<?php echo time();?>"></script>
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Mantenimiento Especialidades medicas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><b>Listado de Especialidades</b></h5>
                <button class="btn btn-primary btn-sm float-right" onclick="AbrirModalRegistro()">Nuevo Registro</button>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 table-responsive ">
                   <table id="tabla_especialidad" class="display table-bordered">
                      <thead>
                          <tr>
                            <th>#</th>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Especialidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
               <label for="">Especialidad</label>
               <input type="text" id="txt_especialidad" class="form-control">
          </div>
          
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Especialidad()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_editar"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Especialiades</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <input type="text" id="txt_idespecialidad" hidden>
               <label for="">Descripción</label>
               <input type="text" id="txt_especialidad_actual_editar" hidden class="form-control">
               <input type="text" id="txt_especialidad_nuevo_editar" class="form-control">
          </div>

             <div class="col-lg-12">
             <label for="estatus"><b>Estatus:</b></label>
             <select class="js-example-basic-single" name="state" style="width: 100%;" id="cmb_estatus_editar">
             <option value="ACTIVO">ACTIVO</option>
              <option value="INACTIVO">INACTIVO</option>
             </select> <br> <br>
           </div>
          
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="Modificar_Especialidad()">Modificar</button>
      </div>
    </div>
  </div>
</div>




 <script type="text/javascript">
  listar_especialidad();
  listar_select_rol();
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
/*
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





    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }*/
  
 </script>