<?php 
 include '../../model/modelo_especialidad.php';

 $Mu = new Modelo_Especialidad();
 
 $consulta =$Mu->listar_especialidad();
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