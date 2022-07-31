<?php 
require '../../model/modelo_paciente.php';
$MP = new Modelo_Paciente();
$contador = 0;
$error ="";

   
    $nombres = strtoupper(htmlspecialchars($_POST['nombres'],ENT_QUOTES,'UTF-8'));
    $apepat = strtoupper(htmlspecialchars($_POST['apepat'],ENT_QUOTES,'UTF-8'));
    $apemat = strtoupper(htmlspecialchars($_POST['apemat'],ENT_QUOTES,'UTF-8'));
     $dni = strtoupper(htmlspecialchars($_POST['dni'],ENT_QUOTES,'UTF-8'));
    $celular = strtoupper(htmlspecialchars($_POST['celular'],ENT_QUOTES,'UTF-8'));
    $edad = strtoupper(htmlspecialchars($_POST['edad'],ENT_QUOTES,'UTF-8'));
    $tipo = strtoupper(htmlspecialchars($_POST['tipo'],ENT_QUOTES,'UTF-8'));
    $sexo = strtoupper(htmlspecialchars($_POST['sexo'],ENT_QUOTES,'UTF-8'));

       //Para solo letras
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nombres)){ 
        $contador++;
        $error.="El nombre del paciente debe contener solo letras.<br>";
    }
     if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$apepat)){ 
        $contador++;
        $error.="El apellido paterno del paciente debe contener solo letras.<br>";  
    }
 
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$apemat)){ 
        $contador++;
        $error.="El apellido materno del paciente debe contener solo letras.<br>";
    }
 
    //Para solo números
    if (!preg_match("/^[[:digit:]\s]*$/",$celular)){ 
        $contador++;
        $error.="El celular del paciente debe contener solo números.<br>";  
    }


  if (!preg_match("/^[[:digit:]\s]*$/",$edad)){ 
        $contador++;
        $error.="La edad del paciente debe contener solo números.<br>";  
    }
    if($contador>0){
        echo $error;
    }else{
        $consulta = $MP->Registrar_Paciente($nombres,$apepat,$apemat,$dni,$celular,$edad,$tipo,$sexo); 
        echo $consulta;
    }

