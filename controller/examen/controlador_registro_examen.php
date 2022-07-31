<?php 
require '../../model/modelo_examen.php';

$MR = new Modelo_Examen();
$examen = htmlspecialchars($_POST['examen'],ENT_QUOTES,'UTF-8');
$analisis = htmlspecialchars($_POST['analisis'],ENT_QUOTES,'UTF-8');

$consulta =$MR->Registrar_Examen($examen,$analisis);
echo $consulta;





 ?>