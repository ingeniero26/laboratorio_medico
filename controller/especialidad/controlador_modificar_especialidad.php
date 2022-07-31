<?php 
require '../../model/modelo_especialidad.php';

$MR = new Modelo_Especialidad();
$id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
$especialidad_actual = htmlspecialchars($_POST['especialidad_actual'],ENT_QUOTES,'UTF-8');
$especialidad_nuevo = htmlspecialchars($_POST['especialidad_nuevo'],ENT_QUOTES,'UTF-8');
$estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
$consulta =$MR->Modificar_Especialidad($id,$especialidad_actual,$especialidad_nuevo, $estatus);
echo $consulta;





 ?>