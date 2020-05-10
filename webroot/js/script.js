$(function () {
    $('#basicEnviar').on('click',autenticacionBasica);
    $('#apiKeyEnviar').on('click',entrarConToken);
    
    $('#keyCrear').on('click',crearUsuario);
    $('#keyConsultar').on('click',consultarToken);
    $('#tmpCrear').on('click',crearTokenTmp);
    
    function autenticacionBasica(){
        $.post("basicAutentication.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val()}, function(respuesta){
                $("#resultado").text(respuesta); 
                camposVacios();
       });
    }
    function entrarConToken(){
        $.post("entrarPorToken.php",{token:$('#apiKey').val()}, function(respuesta){
                $("#resultadoTOKEN").text(respuesta); 
                camposVacios();
       });
    }
    
    
    function crearUsuario(){
        $.post("crearUsuario.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val()}, function(respuesta){
                $("#resultado").text(respuesta); 
                camposVacios();
       });
    }
    function consultarToken(){
        $.post("consultarToken.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val()}, function(respuesta){
                $("#resultado").text(respuesta); 
                camposVacios();
       });
    }
    function crearTokenTmp(){
        $.post("crearTokenTmp.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val()}, function(respuesta){
                $("#resultado").text(respuesta); 
                camposVacios();
       });
    }
    
    function camposVacios(){
        if($('#basicNombre').val() == "" || $('#basicPassword').val() == ""){
            $("#resultado").text(""); 
        }
    }
});
