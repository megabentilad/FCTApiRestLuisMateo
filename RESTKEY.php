<?php
        include_once 'constantes.php';
        if(isset($_REQUEST["usuario"])){
            if(isset($_REQUEST["password"])){
                $usuario = $_REQUEST['usuario'];
                $password = hash('sha256', $_POST['usuario'] . $_POST['password']);
                $url = APIPROPIA;
                $consulta = "INSERT INTO Usuarios(name, password, token) VALUES (?,?,?);";
                $token = hash('sha256',$password);
                $parametros = array($usuario,$password,$token);
                
                $select = "select * from Usuarios where name=?";
                $parametros_select = array($usuario);
                
                try{
                    $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $resultado = $miDB->prepare($select);
                    $resultado->execute($parametros_select);
                    
                    if($resultado->rowCount() != 1){
                        $resultado = $miDB->prepare($consulta);
                        $resultado->execute($parametros);
                        echo "Su token es: ";
                        print($token);
                    }else{
                        echo "El usuario ya existe";
                    }
                    
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    $resultado = null;
                }

            }
            
        }else{ //entrar por token
            if(isset($_REQUEST["token"])){
                $token = $_REQUEST["token"];
                $url = APIPROPIA;
                $consulta = "select * from Usuarios where token=?;";
                $consulta2 = "UPDATE Usuarios SET num_uses=num_uses+1 WHERE token=?;";
                $parametros = array($token);
                
                try{
                    $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $resultado = $miDB->prepare($consulta);
                    $resultado->execute($parametros);
                    
                    if($resultado->rowCount() == 1){
                        $resultado = $miDB->prepare($consulta2);
                        $resultado->execute($parametros);
                        echo "El usuario se logea con su token y recibe la información de la api. Ademas se suma uno al su contador de usos de la misma.";
                    }else{
                        echo "El token no pertenece a ningún usuario de la base de datos";
                    }
                    
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    $resultado = null;
                }
            }
        }