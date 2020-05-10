<?php
include_once 'constantes.php';
    if(isset($_REQUEST["usuario"])){
        if(isset($_REQUEST["password"])){
            $consulta = "select * from Usuarios where name=? and password=?;";
            $consulta2 = "UPDATE Usuarios SET num_uses=num_uses+1 WHERE name=? and password=?;";
            $parametros = array($_REQUEST["usuario"], $_REQUEST["password"]);
            try{
                $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $resultado = $miDB->prepare($consulta);
                $resultado->execute($parametros);
                
                $actualiza = $miDB->prepare($consulta2);
                $actualiza->execute($parametros);
            } catch (Exception $ex) {
                $resultado = null;
            }
            if($resultado != null){
                if($resultado->rowCount() == 1){
                    echo json_encode("La aplicacion recibe la informacion del servicio web, en este caso, este texto.");
                }else{
                    echo json_encode("La autenticacion fracasa y la aplicación recibe este mensaje de error.");
                }
            }else{
                echo json_encode("Ocurre un error inesperado en el servidor y la alicacion recibe este aviso.");
            }
            
        }
    }