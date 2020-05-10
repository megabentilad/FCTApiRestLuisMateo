<?php
include_once 'constantes.php';
if (isset($_REQUEST["usuario"])) {
    if (isset($_REQUEST["password"])) {
        if ($_REQUEST["usuario"] != "" && $_REQUEST["password"] != "") {
            $usuario = $_REQUEST['usuario'];
            $password = hash('sha256', $_POST['usuario'] . $_POST['password']);
            $token = hash('sha256', $password);
            $consulta = "INSERT INTO Usuarios(name, password, token) VALUES (?,?,?);";
            $parametros = array($usuario, $password, $token);

            $select = "select * from Usuarios where name=?";
            $parametros_select = array($usuario);
            
            $consulta2 = "INSERT INTO tmp_tokens(name) VALUES (?);";
            $parametros2 = array($usuario);

            try {
                $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $resultado = $miDB->prepare($select);
                $resultado->execute($parametros_select);

                if ($resultado->rowCount() != 1) {
                    $resultado = $miDB->prepare($consulta);
                    $resultado->execute($parametros);
                    echo "Usuario creado satisfactoriamente, su token es: ";
                    print($token);
                } else {
                    echo "El usuario ya existe";
                }
                
                $resultado = $miDB->prepare($consulta2);
                $resultado->execute($parametros2);
            } catch (Exception $ex) {
                $resultado = null;
            }
        }
    }
}