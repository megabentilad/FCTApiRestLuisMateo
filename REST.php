<?php
        include_once 'constantes.php';
        if(isset($_REQUEST["usuario"])){
            if(isset($_REQUEST["password"])){
                $curl = curl_init(); //Iniciamos el curl
                $usuario = $_REQUEST['usuario'];
                $password = hash('sha256', $_POST['usuario'] . $_POST['password']);
                $url = APIPROPIA;


                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS,"usuario=" . $usuario . "&password=" . $password);


                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //le decimos que lo guarde en "curl_exec" en vez de mostrarlo

                $result = curl_exec($curl); //cogemos el resultado de curl_exec para devolverlo
                if($result == "0"){
                    print("El usuario no se autentifico correctamente");
                }else{
                    print("El usuario obtuvo la información de la api");
                }
                
            }
            
        }