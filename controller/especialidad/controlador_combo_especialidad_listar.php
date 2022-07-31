<?php 

 require '../../model/modelo_especialidad.php';
 $MU = new Modelo_Especialidad();
 $consulta = $MU->listar_combo_especialidad();
 echo json_encode($consulta);



 ?>