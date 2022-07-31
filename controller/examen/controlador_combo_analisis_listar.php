<?php 

 require '../../model/modelo_examen.php';
 $MU = new Modelo_Examen();
 $consulta = $MU->listar_combo_examen();
 echo json_encode($consulta);



 ?>