<?php 

	require_once 'modelo_conexion.php';

	class Modelo_Usuario extends conexionBD {

		public function VerificarUsuario($usu,$pass) {

			$c = conexionBD::conexionPDO();

			$sql ="CALL SP_VERIFICAR_USUARIO(?)";
			$arreglo = array();
			$query = $c->prepare($sql);
			$query->bindParam(1,$usu);
			$query->execute();
			$resultado = $query->fetchAll();

			foreach($resultado as $resp) {
				if(password_verify($pass, $resp['usu_contrasena'])){
					$arreglo[] = $resp;
				}
				
			}
			return $arreglo;
			conexionBD::cerrar_conexion();

		}


		function listar_usuario() {
			$c = conexionBD::conexionPDO();

			$sql ="SELECT    `usuario`.`usu_id`	    , `usuario`.`usu_nombre`
					    , `usuario`.`usu_contrasena`, `usuario`.`rol_id`
					    , `usuario`.`usu_status`    , `usuario`.`usu_email`
					    , `usuario`.`usu_foto` 	    , `rol`.`rol_nombre`
					   FROM 					    `usuario`
					    INNER JOIN `rol` 
					        ON (`usuario`.`rol_id` = `rol`.`rol_id`)";
			$arreglo = array();
			$query = $c->prepare($sql);
			
			$query->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);

			foreach($resultado as $resp) {
				
					$arreglo["data"][] = $resp;
				
				
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		}

		function listar_combo_rol() {
			$c = conexionBD::conexionPDO();

			$sql ="SELECT rol_id, `rol_nombre` FROM rol
					WHERE rol.`rol_estatus`='ACTIVO'";
			$arreglo = array();
			$query = $c->prepare($sql);
			$query->execute();
			$resultado = $query->fetchAll();

			foreach($resultado as $resp) {
					$arreglo[] = $resp;
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		}

		function registrar_usuario($usuario,$clave,$rol,$correo,$ruta) {
			$c = conexionBD::conexionPDO();

			$sql ="CALL SP_REGISTRAR_USUARIO(?,?,?,?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$usuario);
			$query->bindParam(2,$clave);
			$query->bindParam(3,$rol);
			$query->bindParam(4,$correo);
			$query->bindParam(5,$ruta);
			$resultado = $query->execute();
			/*if($resultado ) {
				return 1;
			}	 else {
				return 0;
			}	*/

			if($row = $query->fetchColumn()) {
				return $row;
			}	
		
			conexionBD::cerrar_conexion();
		}

			function modificar_usuario($id,$rol,$correo) {
			$c = conexionBD::conexionPDO();

			$sql ="CALL SP_MODIFICAR_USUARIO(?,?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$id);
			$query->bindParam(2,$rol);
			$query->bindParam(3,$correo);
			
			$resultado = $query->execute();
			
		   if($resultado ) {
				return 1;
			}	 else {
				return 0;
			}		
		
			conexionBD::cerrar_conexion();
		}

	 function	modificar_estatus_usuario($usu_id,$estatus) {
	 	$c = conexionBD::conexionPDO();

			$sql ="CALL SP_MODIFICAR_ESTATUS(?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$usu_id);
			$query->bindParam(2,$estatus);
			
			
			$resultado = $query->execute();
			
		   if($resultado ) {
				return 1;
			}	 else {
				return 0;
			}		
		
			conexionBD::cerrar_conexion();
	 }
	 function modificar_foto_usuario($id,$ruta) {
	 	$c = conexionBD::conexionPDO();

			$sql ="CALL SP_MODIFICAR_FOTO_USUARIO(?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$id);
			$query->bindParam(2,$ruta);
			
			
			$resultado = $query->execute();
			
		   if($resultado ) {
				return 1;
			}	 else {
				return 0;
			}		
		
			conexionBD::cerrar_conexion();
	 }

	}
 ?>