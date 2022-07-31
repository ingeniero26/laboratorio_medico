<?php 

require_once 'modelo_conexion.php';
class Modelo_Examen extends conexionBD {
	
		function listar_examen() {
			$c = conexionBD::conexionPDO();
			$sql ="SELECT     `examen`.`examen_id`
    , `examen`.`examen_nombre`    , `examen`.`examen_fregistro`
    , `examen`.`analisis_id`    , `analisis`.`analisis_nombre`
    , `examen`.`examen_estatus`FROM
    `examen`
    INNER JOIN `analisis` 
        ON (`examen`.`analisis_id` = `analisis`.`analisis_id`); ";
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

		function listar_combo_examen() {
			$c = conexionBD::conexionPDO();

			$sql =" SELECT analisis_id,analisis_nombre FROM analisis
        WHERE analisis.`analisis_estatus` ='ACTIVO'";
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

		function Registrar_Examen($examen,$analisis) {
			$c = conexionBD::conexionPDO();

			$sql ="CALL SP_REGISTRAR_EXAMEN(?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$examen);
			$query->bindParam(2,$analisis);
			
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
}


