<?php 
 include '../../model/modelo_usuario.php';

 $Mu = new Modelo_Usuario();
 
 $consulta =$Mu->listar_usuario();
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