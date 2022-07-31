<?php 

 include '../../model/modelo_usuario.php';

 $Mu = new Modelo_Usuario();
  
  $usuario = htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
 $clave =  password_hash($_POST['clave'], PASSWORD_DEFAULT,['cost'=>10]);
 $rol = htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');
 $correo = htmlspecialchars($_POST['correo'],ENT_QUOTES,'UTF-8');
 $nombrefoto = htmlspecialchars($_POST['nombrefoto'],ENT_QUOTES,'UTF-8');
 if(empty($nombrefoto)) {
 	$ruta = 'controller/usuario/img/avatar.png';
 } else {
 	$ruta = 'controller/usuario/img/'.$nombrefoto;
 }
 $consulta =$Mu->registrar_usuario($usuario,$clave,$rol,$correo,$ruta);
 echo $consulta;
 if($consulta ==1) {
 	if (!empty($nombrefoto)) {
 		if(move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$nombrefoto));
 		
 	}
 } 



 ?>