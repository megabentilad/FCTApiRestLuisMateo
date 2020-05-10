<?php
include_once 'constantes.php';
if (isset($_REQUEST["token"])) {
    $token = $_REQUEST["token"];
    $consulta = "SELECT Usuarios.name, Usuarios.token token_permanente, tmp_tokens.token token_temporal from Usuarios INNER JOIN tmp_tokens ON Usuarios.name = tmp_tokens.name WHERE Usuarios.token = ? or tmp_tokens.token = ?;";
    $parametros = array($token, $token);
    try {
        $miDB = new PDO(CONEXION, USUARIO, PASSWORD);
        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $resultado = $miDB->prepare($consulta);
        $resultado->execute($parametros);

        if ($resultado->rowCount() == 1) {
            $usuario = $resultado->fetchObject();
            $consulta2 = "UPDATE Usuarios SET num_uses=num_uses+1 WHERE name = '" . $usuario->name . "';";
            $resultado = $miDB->prepare($consulta2);
            $resultado->execute($parametros);
            echo json_encode("El usuario se logea con su token y recibe la información de la api. Ademas se suma uno al su contador de usos de la misma.");
        } else {
            echo json_encode("El token no pertenece a ningun usuario de la base de datos por lo que la aplicación muestra este mensaje de error.");
        }
    } catch (Exception $ex) {
        $resultado = null;
        echo json_encode("Ha ocurrido un error imprevisto y el servidor manda este aviso a la aplicacion.");
    }
}
