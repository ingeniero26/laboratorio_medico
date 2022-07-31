<?php 
require_once 'modelo_conexion.php';
class Modelo_Medico extends conexionBD {
	function listar_medico() {
			$c = conexionBD::conexionPDO();
			$sql ="SELECT    	 `medico`.`medico_id`
    , `medico`.`medico_nombre`    , `medico`.`medico_apepat`
    , `medico`.`medico_apemat`    , `medico`.`medico_direccion`
    , `medico`.`medico_movil`    , `medico`.`medico_fenac`
    , `medico`.`medico_nrodocumento`    , `medico`.`especialidad_id`
    ,medico.fregistro,medico.estatus
    , `especialidad`.`especialidad_nombre`,medico.`usuario_id`,
    usuario.`usu_nombre`, usuario.`usu_email`, usuario.`usu_foto`,usuario.`usu_status`,
    usuario.`rol_id`, rol.`rol_nombre`,
    CONCAT_WS(' ',  `medico`.`medico_nombre`    , `medico`.`medico_apepat`    , `medico`.`medico_apemat` ) AS medico
	FROM     `medico`
    INNER JOIN `especialidad`   ON (`medico`.`especialidad_id` = `especialidad`.`especialidad_id`)
    INNER JOIN usuario ON medico.`usuario_id` = usuario.`usu_id`
    INNER JOIN rol ON usuario.`rol_id` = rol.`rol_id` ";
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

	function Registrar_Medico($nombre,$apepat,$apemat,$direccion,$celular,$fecha_nac,$documento,$idespecialidad,$usuario,$clave,$rol,$correo,$ruta) {
		$c = conexionBD::conexionPDO();

			$sql ="CALL SP_REGISTRAR_MEDICO(?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$query = $c->prepare($sql);
			$query->bindParam(1,$nombre);
			$query->bindParam(2,$apepat);
			$query->bindParam(3,$apemat);
			$query->bindParam(4,$direccion);
			$query->bindParam(5,$celular);
			$query->bindParam(6,$fecha_nac);
			$query->bindParam(7,$documento);
			$query->bindParam(8,$idespecialidad);
			$query->bindParam(9,$usuario);
			$query->bindParam(10,$clave);
			$query->bindParam(11,$rol);
			$query->bindParam(12,$correo);
			$query->bindParam(13,$ruta);
			
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



 ?>