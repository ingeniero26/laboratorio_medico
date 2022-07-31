<?php 

 include '../../model/modelo_usuario.php';

 $Mu = new Modelo_Usuario();
  $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
 
 $rol = htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');
 $correo = htmlspecialchars($_POST['correo'],ENT_QUOTES,'UTF-8');
 
 $consulta =$Mu->modificar_usuario($id,$rol,$correo);
 echo $consulta;




 ?>