<?php 
require_once 'modelo_conexion.php';

class Modelo_Rol extends conexionBD {
		function listar_rol() {
			$c = conexionBD::conexionPDO();

			$sql ="SELECT rol_id,rol_nombre,rol_fregistro,rol_estatus 
					FROM  rol ";
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


	function	Registrar_Rol($rol) {
			$c = conexionBD::conexionPDO();

			$sql ="CALL SP_REGISTRAR_ROL(?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$rol);
			
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
   function	Modificar_Rol($id,$rol_actual,$rol_nuevo, $estatus) {
   		$c = conexionBD::conexionPDO();

			$sql ="CALL SP_MODIFICAR_ROL(?,?,?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$id);
			$query->bindParam(2,$rol_actual);
			$query->bindParam(3,$rol_nuevo);
			$query->bindParam(4,$estatus);
			
			$resultado = $query->execute();
			
		   if($resultado ) {
				return 1;
			}	 else {
				return 0;
			}		
		
			conexionBD::cerrar_conexion();
   }
   function modificar_estatus_rol($rol_id,$estatus) {
   		$c = conexionBD::conexionPDO();

			$sql ="CALL SP_MODIFICAR_ESTATUS_ROL(?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$rol_id);
			$query->bindParam(2,$estatus);
			
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