SELECT 
rol_id,rol_nombre,rol_fregistro,rol_estatus 
FROM  rol





UPDATE usuario SET
usu_foto ='controller/usuario/img/avatar.png'
WHERE usu_foto =""


CREATE PROCEDURE SP_MODIFICAR_USUARIO(IN ID INT, IN IDROL INT,
IN CORREO VARCHAR(255))

UPDATE usuario SET
`rol_id` =IDROL,
usu_email =CORREO
WHERE usu_id =ID



CREATE PROCEDURE SP_MODIFICAR_ESTATUS(IN ID INT, IN ESTATUS VARCHAR(20))
UPDATE usuario SET
usu_status =ESTATUS
WHERE usu_id =ID


CREATE PROCEDURE SP_MODIFICAR_FOTO_USUARIO(IN ID INT, IN RUTA VARCHAR(255))
UPDATE usuario SET
`usu_foto` =RUTA
WHERE usu_id =ID














