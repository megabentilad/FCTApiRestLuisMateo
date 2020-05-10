<?php
include_once 'constantes.php';
if (isset($_REQUEST["usuario"])) {
    if (isset($_REQUEST["password"])) {
        if ($_REQUEST["usuario"] != "" && $_REQUEST["password"] != "") {
            $usuario = $_REQUEST['usuario'];
            $password = hash('sha256', $_POST['usuario'] . $_POST['password']);
            $consulta = "select token from Usuarios where name=? and password=?;";
            $parametros = array($usuario, $password);

            try {
                $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $resultado = $miDB->prepare($consulta);
                $resultado->execute($parametros);

                if ($resultado->rowCount() != 0) {
                    $token = $resultado->fetchObject();
                    echo "Su token es: ";
                    print($token->token);
                } else {
                    echo "No se ha encontrado al usuario.";
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
                $resultado = null;
            }
        }
    }
}