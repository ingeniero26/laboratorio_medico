<?php 

require '../../model/modelo_usuario.php';

$MU = new Modelo_Usuario(); 
$usu = htmlspecialchars($_POST['usu'],ENT_QUOTES,'UTF-8');
$pass = htmlspecialchars($_POST['pass'],ENT_QUOTES,'UTF-8');

$consulta =$MU->VerificarUsuario($usu,$pass);


if(count($consulta)>0) {
	echo json_encode($consulta);
} else {
	echo 0;
}


 ?>