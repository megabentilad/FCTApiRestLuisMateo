<?php
include_once 'constantes.php';
    if(isset($_REQUEST["usuario"])){
        if(isset($_REQUEST["password"])){
            $consulta = "select * from T01_Usuario where T01_CodUsuario=? and T01_Password=?;";
            $parametros = array($_REQUEST["usuario"], $_REQUEST["password"]);
            try{
                $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $resultado = $miDB->prepare($consulta);
                $resultado->execute($parametros);
            } catch (Exception $ex) {
                echo $ex->getMessage();
                $resultado = null;
            }
            if($resultado == null){
                echo json_encode("El usuario y la contraseña no se encuentran en la base de datos");
            }else{
                #echo json_encode("El usuario accede correctamente");
                echo json_encode($resultado->rowCount());
            }
        }
    }