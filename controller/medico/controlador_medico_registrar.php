<?php 

 include '../../model/modelo_medico.php';

 $MD = new Modelo_Medico();
  
 $usuario = htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
 $clave =  password_hash($_POST['clave'], PASSWORD_DEFAULT,['cost'=>10]);
 $rol = htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');
 $correo = htmlspecialchars($_POST['correo'],ENT_QUOTES,'UTF-8');
 $nombrefoto = htmlspecialchars($_POST['nombrefoto'],ENT_QUOTES,'UTF-8');


$contador = 0;
$error ="";

   
    $nombre = strtoupper(htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8'));
    $apepat = strtoupper(htmlspecialchars($_POST['apepat'],ENT_QUOTES,'UTF-8'));
    $apemat = strtoupper(htmlspecialchars($_POST['apemat'],ENT_QUOTES,'UTF-8'));
    $direccion = strtoupper(htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8'));
    $celular = strtoupper(htmlspecialchars($_POST['celular'],ENT_QUOTES,'UTF-8'));
    $fecha_nac = strtoupper(htmlspecialchars($_POST['fecha_nac'],ENT_QUOTES,'UTF-8'));
    $documento = strtoupper(htmlspecialchars($_POST['documento'],ENT_QUOTES,'UTF-8'));
    $idespecialidad = strtoupper(htmlspecialchars($_POST['idespecialidad'],ENT_QUOTES,'UTF-8'));
   
    
		 if(empty($nombrefoto)) {
		 	$ruta = 'controller/usuario/img/avatar.png';
		 } else {
		 	$ruta = 'controller/usuario/img/'.$nombrefoto;
		 }

       //Para solo letras
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nombre)){ 
        $contador++;
        $error.="El nombre del medico debe contener solo letras.<br>";
    }
     if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$apepat)){ 
        $contador++;
        $error.="El apellido paterno del medico debe contener solo letras.<br>";  
    }
 
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$apemat)){ 
        $contador++;
        $error.="El apellido materno del medico debe contener solo letras.<br>";
    }

    //Para solo números
    if (!preg_match("/^[[:digit:]\s]*$/",$celular)){ 
        $contador++;
        $error.="El celular del medico debe contener solo números.<br>";  
    }

    if (!preg_match("/^[[:digit:]\s]*$/",$documento)){ 
        $contador++;
        $error.="El documento del medico debe contener solo números.<br>";  
    }



    if($contador>0){
        echo $error;
    }else{
        $consulta = $MD->Registrar_Medico($nombre,$apepat,$apemat,$direccion,$celular,$fecha_nac,$documento,$idespecialidad,$usuario,$clave,$rol,$correo,$ruta); 
        echo $consulta;
         if($consulta ==1) {
 			if (!empty($nombrefoto)) {
 				if(move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$nombrefoto));
 		
 	    }
    }


 } 


 ?>