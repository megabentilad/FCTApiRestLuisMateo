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
            } catch (Exception $ex) {
                echo $ex->getMessage();
                $resultado = null;
            }
           
            if($resultado->rowCount() != 1){
                echo json_encode("El usuario y la contraseña no se encuentran en la base de datos");
            }else{
                //Actualizar num_accesos
                try{
                    $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $actualiza = $miDB->prepare($consulta2);
                    $actualiza->execute($parametros);
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    $actualiza = null;
                }
                echo json_encode($resultado->rowCount());
            }
        }
    }