$(function () {
    $('#basicEnviar').on('click',llamarAPI);
    $('#keyCrear').on('click',llamarAPIKEY);
    $('#keyConsultar').on('click',consultarAPIKEY);
    $('#apiKeyEnviar').on('click',mirarKEY);
    $('#tmpCrear').on('click',crearTokenTmp);
    
    function llamarAPI(){
        $.post("REST.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val()}, function(respuesta){
                $("#resultado").text(respuesta); 
                camposVacios();
       });
    }
    
    function llamarAPIKEY(){
        $.post("RESTKEY.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val(),objetivo:"crear"}, function(respuesta){
                $("#resultado").text(respuesta); 
                camposVacios();
       });
    }
    function consultarAPIKEY(){
        $.post("RESTKEY.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val(),objetivo:"obtener"}, function(respuesta){
                $("#resultado").text(respuesta); 
                camposVacios();
       });
    }
    
    function mirarKEY(){
        $.post("RESTKEY.php",{token:$('#apiKey').val()}, function(respuesta){
                $("#resultadoTOKEN").text(respuesta); 
                camposVacios();
       });
    }
    
    function crearTokenTmp(){
        $.post("RESTKEY.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val(),objetivo:"creartmp"}, function(respuesta){
                $("#resultado").text(respuesta); 
                camposVacios();
       });
    }
    
    function camposVacios(){
        if($('#basicNombre').val() == "" || $('#basicPassword').val() == ""){
            $("#resultadoTOKEN").text(""); 
        }
    }
});
