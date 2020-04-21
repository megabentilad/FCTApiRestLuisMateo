$(function () {
    $('#basicEnviar').on('click',llamarAPI);
    $('#keyCrear').on('click',llamarAPIKEY);
    $('#apiKeyEnviar').on('click',mirarKEY);
    
    function llamarAPI(){
        $.post("REST.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val()}, function(respuesta){
                $("#resultado").text(respuesta); 

       });
    }
    
    function llamarAPIKEY(){
        $.post("RESTKEY.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val()}, function(respuesta){
                $("#resultado").text(respuesta); 

       });
    }
    
    function mirarKEY(){
        $.post("RESTKEY.php",{token:$('#apiKey').val()}, function(respuesta){
                $("#resultadoTOKEN").text(respuesta); 

       });
    }
});
