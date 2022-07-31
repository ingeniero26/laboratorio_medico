 
<script src="../js/examen.js?rev=<?php echo time();?>"></script>
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">EXAMEN MEDICO</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Mantenimiento Examenes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><b>Listado de examenes del sistema</b></h5>
                <button class="btn btn-primary btn-sm float-right" onclick="AbrirModalRegistro()">Nuevo Registro</button>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 table-responsive">
                   <table id="tabla_examenes" class="display">
                      <thead>
                          <tr>
                            <th>#</th>
                              <th>Examen</th>
                              <th>Analisis</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Registro Examen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
               <label for="">Descripción</label>
               <input type="text" id="txt_examen" class="form-control">
          </div>
            <div class="col-12">
               <label for="">Analisis</label>
                <select class="js-example-basic-single" name="state" style="width: 100%;" id="cmb_analisis"> 
           
             </select> <br>
          </div>
          
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Examen()">Guardar</button>
      </div>
    </div>
  </div>
</div>




 <script type="text/javascript">
  listar_examen();
 listar_select_analisis();
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

  





  
  
 </script>