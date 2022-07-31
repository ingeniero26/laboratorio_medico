<?php 
 include '../../model/modelo_analisis.php';

 $Mu = new Modelo_Analisis();
 
 $consulta =$Mu->listar_analisis();
if($consulta) {
	echo json_encode($consulta);
} else {
	echo '{
		"sEcho":1,
		"iTotalRecords":"0",
		"iTotalDisplayRecords":"0",
		"aaData":[]
	}';
}


 ?>