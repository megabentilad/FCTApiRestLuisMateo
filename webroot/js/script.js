$(function () {
    $('#basicEnviar').on('click',llamarAPI);
    
    function llamarAPI(){
        console.log($('#basicNombre').val());
        $.post("REST.php",{usuario:$('#basicNombre').val(),password:$('#basicPassword').val()}, function(respuesta){
                $("#resultado").text(respuesta); 

       });
    }
});
