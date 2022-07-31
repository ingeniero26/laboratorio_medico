<?php 
require '../../model/modelo_analisis.php';

$MR = new Modelo_Analisis();
$analisis = htmlspecialchars($_POST['analisis'],ENT_QUOTES,'UTF-8');

$consulta =$MR->Registrar_Analisis($analisis);
echo $consulta;





 ?>