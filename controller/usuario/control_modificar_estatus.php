<?php 

 include '../../model/modelo_usuario.php';

 $Mu = new Modelo_Usuario();
  $usu_id = htmlspecialchars($_POST['usu_id'],ENT_QUOTES,'UTF-8');
 
 $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');

 $consulta =$Mu->modificar_estatus_usuario($usu_id,$estatus);
 echo $consulta;




 ?>