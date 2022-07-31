<?php 
require '../../model/modelo_analisis.php';

$MR = new Modelo_Analisis();
$id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
$analisis_actual = htmlspecialchars($_POST['analisis_actual'],ENT_QUOTES,'UTF-8');
$analisis_nuevo = htmlspecialchars($_POST['analisis_nuevo'],ENT_QUOTES,'UTF-8');
$estatus = htmlspecialchars($_POST['estatus'],ENT_QUOTES,'UTF-8');
$consulta =$MR->Modificar_Analisis($id,$analisis_actual,$analisis_nuevo, $estatus);
echo $consulta;





 ?>