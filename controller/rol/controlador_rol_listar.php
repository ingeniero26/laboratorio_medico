<?php 
 include '../../model/modelo_rol.php';

 $Mu = new Modelo_Rol();
 
 $consulta =$Mu->listar_rol();
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