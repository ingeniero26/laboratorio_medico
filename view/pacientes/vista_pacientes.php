 
<script src="../js/paciente.js?rev=<?php echo time();?>"></script>
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Mantenimiento Pacientes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><b>Listado de Pacientes</b></h5>
                <button class="btn btn-primary btn-sm float-right" onclick="AbrirModalRegistroPaciente()">Nuevo Registro</button>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 table-responsive ">
                   <table id="tabla_paciente" class="display table-bordered">
                      <thead>
                          <tr>
                            <th>#</th>
                              <th>Paciente</th>
                              <th>Cedula</th>
                              <th>Telefono</th>
                              <th>Edad</th>
                              
                              <th>Sexo</th>
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
<div class="modal fade" id="modal_registro_paciente"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-3">
              <label for="">DOCUMENTO</label>
              <input type="text" id="txt_dni" placeholder="DNI" class="form-control" onkeypress="return soloNumeros(event)" maxlength="10">          
            </div>
            <div class="col-9">
              <label for="">Nombres</label>
              <input type="text" id="txt_nombres" placeholder="Nombres del paciente" class="form-control" onkeypress="return soloLetras(event)">
            </div>
            <div class="col-6">
              <label for="">Apellido Paterno</label>
              <input type="text" id="txt_apepat" placeholder="Apellido Paterno del paciente" class="form-control" onkeypress="return soloLetras(event)">
            </div>
            <div class="col-6">
              <label for="">Apellido Materno</label>
              <input type="text" id="txt_apemat" placeholder="Apellido Materno del paciente" class="form-control" onkeypress="return soloLetras(event)">
            </div>
            <div class="col-6">
              <label for="">Celular</label>
              <input type="text" id="txt_celular" placeholder="Celular Paciente" class="form-control" onkeypress="return soloNumeros(event)">
            </div>
            <div class="col-6">
              <label for="">Edad</label>
              <input type="text" id="txt_edad" placeholder="Edad Paciente" class="form-control" onkeypress="return soloNumeros(event)">
            </div>
            <div class="col-6">
              <label for="">Tipo edad</label>
              <select class="js-example-basic-single" id="select_tipo" name="state" style="width:100%">
                    <option value="">SELECCIONAR TIPO EDAD</option>
                    <option value="AÑOS">AÑOS</option>
                    <option value="MESES">MESES</option>
              </select>
            </div>
            <div class="col-6">
              <label for="">SEXO</label>
              <select class="js-example-basic-single" id="select_sexo" name="state" style="width:100%">
                    <option value="">SELECCIONAR SEXO DEL PACIENTE</option>
                    <option value="MASCULINO">MASCULINO</option>
                    <option value="FEMENINO">FEMENINO</option>
              </select>
            </div>
            <div class="col-12" id="div_mensaje_error">
 
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Paciente()">Registrar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_editar_paciente"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edicion de Paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="text" id="txt_idpaciente" hidden>
            <div class="col-3">
              <label for="">DNI</label>
              <input type="text" id="txt_dni_actual_editar" placeholder="DNI" class="form-control" onkeypress="return soloNumeros(event)" maxlength="10" hidden>    
               <input type="text" id="txt_dni_nuevo_editar" placeholder="DNI" class="form-control" onkeypress="return soloNumeros(event)" maxlength="10">        
            </div>
            <div class="col-9">
              <label for="">Nombres</label>
              <input type="text" id="txt_nombres_editar" placeholder="Nombres del paciente" class="form-control" onkeypress="return soloLetras(event)">
            </div>
            <div class="col-6">
              <label for="">Apellido Paterno</label>
              <input type="text" id="txt_apepat_editar" placeholder="Apellido Paterno del paciente" class="form-control" onkeypress="return soloLetras(event)">
            </div>
            <div class="col-6">
              <label for="">Apellido Materno</label>
              <input type="text" id="txt_apemat_editar" placeholder="Apellido Materno del paciente" class="form-control" onkeypress="return soloLetras(event)">
            </div>
            <div class="col-6">
              <label for="">Celular</label>
              <input type="text" id="txt_celular_editar" placeholder="Celular Paciente" class="form-control" onkeypress="return soloNumeros(event)">
            </div>
            <div class="col-6">
              <label for="">Edad</label>
              <input type="text" id="txt_edad_editar" placeholder="Edad Paciente" class="form-control" onkeypress="return soloNumeros(event)">
            </div>
            <div class="col-6">
              <label for="">Tipo edad</label>
              <select class="js-example-basic-single" id="select_tipo_editar" style="width:100%">
                    <option value="">SELECCIONAR TIPO EDAD</option>
                    <option value="AÑOS">AÑOS</option>
                    <option value="MESES">MESES</option>
              </select>
            </div>
            <div class="col-6">
              <label for="">SEXO</label>
              <select class="js-example-basic-single" id="select_sexo_editar" style="width:100%">
                    <option value="">SELECCIONAR SEXO DEL PACIENTE</option>
                    <option value="MASCULINO">MASCULINO</option>
                    <option value="FEMENINO">FEMENINO</option>
              </select>
            </div>
            <div class="col-12" id="div_mensaje_error">
 
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Paciente()">Registrar</button>
      </div>
    </div>
  </div>
</div>








 <script type="text/javascript">
  listar_paciente_serverside();
 
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

    




   
  
 </script>