<?php 
require '../../model/modelo_rol.php';

$MR = new Modelo_Rol();
$rol = htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');

$consulta =$MR->Registrar_Rol($rol);
echo $consulta;





 ?>