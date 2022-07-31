<?php 
 include '../../model/modelo_medico.php';

 $Mu = new Modelo_Medico();
 
 $consulta =$Mu->listar_medico();
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