<?php 

require_once 'modelo_conexion.php';

class Modelo_Paciente extends conexionBD {
		function Registrar_Paciente($nombres,$apepat,$apemat,$dni,$celular,$edad,$tipo,$sexo) {
			$c = conexionBD::conexionPDO();

			$sql ="CALL SP_REGISTRAR_PACIENTE(?,?,?,?,?,?,?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$nombres);
			$query->bindParam(2,$apepat);
			$query->bindParam(3,$apemat);
			$query->bindParam(4,$dni);
			$query->bindParam(5,$celular);
			$query->bindParam(6,$edad);
			$query->bindParam(7,$tipo);
			$query->bindParam(8,$sexo);
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