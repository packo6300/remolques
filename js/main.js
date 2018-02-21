  /*   var s = $("#login").serialize();
      console.log(s);
     $.ajax({
           type:"post",
           contentType: "application/x-www-form-urlencoded;charset=UTF-8",
           url:"acciones/session/login.php",
           data:s,
           beforeSend: function(xhr) {

           }
      });
 


$("#login").on("submit",function( event ){
  event.preventDefault();
  alert("hola");
});*/
function menu(id){
    $("#pant").html("<center><br><br><br><br><label>Cargando por favor espere...</label><br><img style='width: 100px;' src='img/loading.gif'></center>");
    $( "#pant" ).load( id, function( response, status, xhr ) {
        if ( status == "error" ) {
            var msg = "Tiempo de solicitud agotada favor de intentarlo de nuevo, de lo contratio reportarlo a soporte ";
        $( "#pant" ).html( msg + xhr.status + " " + xhr.statusText );
        }
    });
}
function ser(){
   try{
        var s=$(".panel").serialize();
        $.ajax({type: 'POST',url: "",data:srt
        }).done(function (datos){
            $(".repo").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }
}
function init (){
    var canvas =document.getElementById('reloj');
    var ctx= canvas.getContext('2d');
    ctx.beginPath();    
    ctx.arc(50,50,10,rad(0),rad(360),true);
    ctx.moveTo(80,50);
    ctx.lineTo(20,50);
    //ctx.moveTo(50,80);
    ctx.arc(50,50,30,rad(0),rad(360),true);
    ctx.moveTo(160,50);
    ctx.arc(150,50,10,rad(0),rad(360),true);
    ctx.moveTo(150,80);
    ctx.arc(150,50,30,rad(90),rad(360),false);
    ctx.stroke();
    ctx.beginPath();
    ctx.arc(90,110,30,rad(0),rad(180),false);
    ctx.stroke();
}
function rad(grados){
    return (grados * Math.PI)/180;
}