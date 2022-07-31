<?php 
require_once 'modelo_conexion.php';
class Modelo_Especialidad extends conexionBD {
	function listar_especialidad() {
			$c = conexionBD::conexionPDO();
			$sql ="SELECT
		    `especialidad_id`
		    , `especialidad_nombre`
		    , `especialidad_fregistro`
		    , `especialidad_estatus`
		FROM
		    `especialidad`; ";
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
	function Registrar_Especialidad($especialidad) {
			$c = conexionBD::conexionPDO();

			$sql ="CALL SP_REGISTRAR_ESPECIALIDAD(?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$especialidad);
			
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

	function Modificar_Especialidad($id,$especialidad_actual,$especialidad_nuevo, $estatus){
		$c = conexionBD::conexionPDO();

			$sql ="CALL SP_MODIFICAR_ESPECIALIDAD(?,?,?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$id);
			$query->bindParam(2,$especialidad_actual);
			$query->bindParam(3,$especialidad_nuevo);
			$query->bindParam(4,$estatus);
			
			$resultado = $query->execute();
			
		   if($resultado ) {
				return 1;
			}	 else {
				return 0;
			}		
		
			conexionBD::cerrar_conexion();
	}

	function listar_combo_especialidad() {
		$c = conexionBD::conexionPDO();

			$sql ="SELECT especialidad_id, especialidad_nombre
 					FROM especialidad
 					WHERE especialidad_estatus ='ACTIVO'";
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
}



 ?>