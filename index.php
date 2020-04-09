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
        <form onsubmit="return false">
            <div>
                <input type="text" placeholder="nombre" id="basicNombre">
                <br/>
                <input type="password" placeholder="contraseña" id="basicPassword">
                <br/>
                <button id="basicEnviar">Enviar</button>
            </div>
        </form>
        <div id="resultado"></div>
        <footer>
            <p>
                <a href="http://daw215.sauces.local/index.html" id="Fnombre">
                    <span>© Luis Mateo Rivera Uriarte 2019-2020</span>
                </a>
                <a href="https://github.com/megabentilad/LoginLogoutMulticapaPDO" target="_blank" id="Fgithub">
                    <img src="webroot/img/gitHub.png" class="iconoFooter"  title="GitHub">
                </a>
                <a href="doc/CV-LuisMateoRiveraUriarte.pdf" target="_blank" id="FCV">
                    <img src="webroot/img/CV.png" class="iconoFooter4"  title="CV">
                </a>
            </p>
        </footer>
    </body>
</html>