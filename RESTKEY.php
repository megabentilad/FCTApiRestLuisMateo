<?php
        include_once 'constantes.php';
        if(isset($_REQUEST["usuario"])){
            if(isset($_REQUEST["password"])){
                if($_REQUEST["usuario"] != "" && $_REQUEST["password"] != ""){
                    switch($_REQUEST["objetivo"]){
                        case "crear":
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
                                    echo "Usuario creado satisfactoriamente, su token es: ";
                                    print($token);
                                }else{
                                    echo "El usuario ya existe";
                                }

                            } catch (Exception $ex) {
                                echo $ex->getMessage();
                                $resultado = null;
                            }
                            
                            $consulta = "INSERT INTO tmp_tokens(name) VALUES (?);";
                            $parametros = array($usuario);
                            try{
                                $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $resultado = $miDB->prepare($consulta);
                                $resultado->execute($parametros);

                            } catch (Exception $ex) {
                                echo $ex->getMessage();
                                $resultado = null;
                            }
                            break;

                        case "obtener":
                            $usuario = $_REQUEST['usuario'];
                            $password = hash('sha256', $_POST['usuario'] . $_POST['password']);
                            $url = APIPROPIA;
                            $consulta = "select token from Usuarios where name=? and password=?;";
                            $parametros = array($usuario,$password);

                            try{
                                $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $resultado = $miDB->prepare($consulta);
                                $resultado->execute($parametros);

                                if($resultado->rowCount() != 0){
                                    $token = $resultado->fetchObject();
                                    echo "Su token es: ";
                                    print($token->token);
                                }else{
                                    echo "No se ha encontrado al usuario.";
                                }

                            } catch (Exception $ex) {
                                echo $ex->getMessage();
                                $resultado = null;
                            }
                            break;
                            
                            
                        case "creartmp":
                            $usuario = $_REQUEST['usuario'];
                            $password = hash('sha256', $_POST['usuario'] . $_POST['password']);
                            $url = APIPROPIA;
                            $consulta = "UPDATE tmp_tokens SET token = ?, date = ? WHERE name = '" . $usuario . "';";
                            $date = new DateTime();
                            $token = hash('sha256',$date->format("Y-m-d H:i:s") . $usuario);
                            $parametros = array(hash('sha256',$token), $date->format("Y-m-d H:i:s"));

                            $select = "select * from tmp_tokens where name=?";
                            $parametros_select = array($usuario);

                            try{
                                $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $resultado = $miDB->prepare($select);
                                $resultado->execute($parametros_select);

                                if($resultado->rowCount() == 1){
                                    $tmpToken = $resultado->fetchObject();
                                    if($tmpToken->token == null){
                                        $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                                        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            $resultado = $miDB->prepare($consulta);
                                            $resultado->execute($parametros);
                                            print($token);
                                    }else{
                                        print($tmpToken->token);
                                    }
                                }else{
                                    echo "No se encuentra el usuario.";
                                }
                           
                            } catch (Exception $ex) {
                                echo $ex->getMessage();
                                $resultado = null;
                            }
                            break;
                        
                        default:
                            
                    }
                }
            }





        }else{ //entrar por token
            if(isset($_REQUEST["token"])){
                $token = $_REQUEST["token"];
                $url = APIPROPIA;
                $consulta = "SELECT Usuarios.name, Usuarios.token token_permanente, tmp_tokens.token token_temporal from Usuarios INNER JOIN tmp_tokens ON Usuarios.name = tmp_tokens.name WHERE Usuarios.token = ? or tmp_tokens.token = ?;";
                $parametros = array($token, $token);
                
                try{
                    $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $resultado = $miDB->prepare($consulta);
                    $resultado->execute($parametros);
                    
                    if($resultado->rowCount() == 1){
                        $usuario = $resultado->fetchObject();
                        $consulta2 = "UPDATE Usuarios SET num_uses=num_uses+1 WHERE name = '" . $usuario->name .  "';";
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