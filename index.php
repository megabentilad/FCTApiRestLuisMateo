<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Luis Mateo Rivera Uriarte</title>
        <meta charset="UTF-8">
        <meta name="author" content="Luis Mateo Rivera Uriarte">
        <link rel="stylesheet" type="text/css" href="webroot/css/styles.css" media="screen">
        <link rel="icon" type="image/png" href="webroot/img/mifavicon.png">
        <script src="webroot/js/jquery.js"></script>
        <script src="webroot/js/script.js"></script>
    </head>
    <body>
        <header>
            <div>
                <h1>
                    Autenticación en servicios apiREST
                </h1>
                <h2>
                    Luis Mateo Rivera Uriarte
                </h2>
            </div>
        </header>
        <main>
            <div id="credenciales">
                <form onsubmit="return false">
                    <div>
                        <input type="text" placeholder="nombre" id="basicNombre">
                        <input type="password" placeholder="contraseña" id="basicPassword">
                        <br/>
                        <button id="basicEnviar">Enviar</button>
                        <button id="keyCrear">Crear usuario</button>
                        |
                        <button id="keyConsultar">Obtener token</button>
                        <button id="tmpCrear">Crear token temporal</button>
                    </div>
                </form>
                <div id="resultado"></div>
            </div>
            <div id="tokens">
                <form onsubmit="return false">
                    <input type="text" placeholder="apiKEY" id="apiKey">
                    <br/>
                    <button id="apiKeyEnviar">Enviar</button>
                </form>
                <div id="resultadoTOKEN"></div>
            </div>
        </main> 
        <footer>
            <p>
                <a href="https://luismlossauces.000webhostapp.com/" target="_blank">
                    <img src="webroot/img/web.png" class="iconoFooter"  title="Web del creador">
                </a>
                <a href="https://github.com/megabentilad/FCTApiRestLuisMateo" target="_blank">
                    <img src="webroot/img/gitHub.png" class="iconoFooter2"  title="GitHub">
                </a>
                <a href="webroot/20200511_I074P_LuisMateoRiveraUriarte.pdf" target="_blank" id="FCV">
                    <img src="webroot/img/pdf.png" class="iconoFooter3"  title="Documento">
                </a>
            </p>
        </footer> 
    </body>
</html>