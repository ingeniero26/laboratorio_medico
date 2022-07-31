<?php 
 include '../../model/modelo_examen.php';

 $Mu = new Modelo_Examen();
 
 $consulta =$Mu->listar_examen();
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