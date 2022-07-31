<?php 

 include '../../model/modelo_rol.php';

 $Mu = new Modelo_Rol();
  $rol_id = htmlspecialchars($_POST['rol_id'],ENT_QUOTES,'UTF-8');
 
 $estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');

 $consulta =$Mu->modificar_estatus_rol($rol_id,$estatus);
 echo $consulta;




 ?>