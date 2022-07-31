<?php 
require_once 'modelo_conexion.php';

 class Modelo_Analisis  extends conexionBD{
 		function listar_analisis() {
			$c = conexionBD::conexionPDO();
			$sql ="SELECT analisis_id, analisis_nombre, analisis_fregistro,analisis_estatus
				FROM analisis ";
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

		function Registrar_Analisis($analisis) {
			$c = conexionBD::conexionPDO();

			$sql ="CALL SP_REGISTRAR_ANALISIS(?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$analisis);
			
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

		function Modificar_Analisis($id,$analisis_actual,$analisis_nuevo, $estatus) {
			$c = conexionBD::conexionPDO();

			$sql ="CALL SP_MODIFICAR_ANALISIS(?,?,?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$id);
			$query->bindParam(2,$analisis_actual);
			$query->bindParam(3,$analisis_nuevo);
			$query->bindParam(4,$estatus);
			
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