<?php
include_once 'constantes.php';
if (isset($_REQUEST["usuario"])) {
    if (isset($_REQUEST["password"])) {
        if ($_REQUEST["usuario"] != "" && $_REQUEST["password"] != "") {

            $usuario = $_REQUEST['usuario'];
            $password = hash('sha256', $_POST['usuario'] . $_POST['password']);
            $consulta = "UPDATE tmp_tokens SET token = ?, date = ? WHERE name = '" . $usuario . "';";
            $date = new DateTime();
            $token = hash('sha256', $date->format("Y-m-d H:i:s") . $usuario);
            $parametros = array(hash('sha256', $token), $date->format("Y-m-d H:i:s"));

            $select = "select * from tmp_tokens where name=?";
            $parametros_select = array($usuario);

            try {
                $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $resultado = $miDB->prepare($select);
                $resultado->execute($parametros_select);

                if ($resultado->rowCount() == 1) {
                    $tmpToken = $resultado->fetchObject();
                    if ($tmpToken->token == null) {
                        $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $resultado = $miDB->prepare($consulta);
                        $resultado->execute($parametros);
                        print("Se ha creado un nuevo token temporal: " . $token);
                    } else {
                        print("Su token temporal sigue activo y es: " . $tmpToken->token);
                    }
                } else {
                    echo "No se encuentra el usuario.";
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
                $resultado = null;
            }
        }
    }
}