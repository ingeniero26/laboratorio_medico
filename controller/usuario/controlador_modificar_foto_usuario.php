<?php 

 include '../../model/modelo_usuario.php';

 $Mu = new Modelo_Usuario();
  
  $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');

 $nombrefoto = htmlspecialchars($_POST['nombrefoto'],ENT_QUOTES,'UTF-8');
 $ruta_actual = htmlspecialchars($_POST['ruta_actual'],ENT_QUOTES,'UTF-8');
 $ruta = 'controller/usuario/img/'.$nombrefoto;
 
 $consulta =$Mu->modificar_foto_usuario($id,$ruta);
 echo $consulta;
 if($consulta ==1) {
 	if (!empty($nombrefoto)) {
 		if(move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$nombrefoto));
            if($ruta_actual !="controller/usuario/img/default.png") {
            unlink('../../'.$ruta_actual);
        }
 		
 	}
 } 



 ?>