$("#gestion").change(function(event)
{
  $.get("turno/"+event.target.value +"",function(response,gestion){
    // /console.log(response);
    $("#turno").empty();
    for(i=0;i<response.length;i++)
    {
      $("#turno").append("<option value='"+response[i].idturno +"'> "+response[i].descripcion+"</option>");
    }
  });
});
$("#iddetallegestionturno").change(function(event)
{
  $.get("/apertura/gestionarProgramacionMateria/iddetallegestionturno/"+event.target.value +"",function(response,gestion){
    // /console.log(response);
    $("#grado").empty();
    //$("#grado").append("<option value='50'>Hola</option>");
    for(i=0;i<response.length;i++)
    {
      $("#grado").append("<option value='"+response[i].idgrado +"'> "+response[i].descripcion+"</option>");
    }
  });

});
/*$("#iddetallegestionturno").change(function(event)
{
  $.get("/obtenerPeriodo/"+event.target.value,function(response,periodo){
  $("#periodo").empty();
  console.log(response);
  for(i=0;i<response.length;i++)
  {
    $("#periodo").append("<option value='"+response[i].idperiodo +"'> "+response[i].descripcion+"</option>");
  }
  });
});*/
$("#grado").change(function(event)
{
  var idgestionturno = document.getElementById("iddetallegestionturno").value;
  //alert(idgestionturno);
  $.get("/apertura/gestionarProgramacionMateria/bloque/"+event.target.value+"/gestionturno/"+idgestionturno,function(response,grado){
    console.log(response);
    $("#bloque").empty();
    for(i=0;i<response.length;i++)
    {
      $("#bloque").append("<option value='"+response[i].idbloque +"'> "+response[i].descripcion+"</option>");
    }
  });
});
window.onload = function(){
    document.getElementById("botondetallegradobloque").onclick=function(){

      var iddetallegradobloque = document.getElementById("iddetallegradobloque").value;
      location.href="/admUsuario/gestionarReporte/grado/"+iddetallegradobloque;
      //$.get("/admUsuario/gestionarReporte/grado/"+iddetallegradobloque,function(response,cupo){

        //alert(response.cuporestante);
      //});
      //alert(iddetallegradobloque);
}
}
document.getElementById("botoncuporestante").onclick = function(){
  //alert("has clickeado");
  var idgrado = document.getElementById("grado").value;
  var idbloque = document.getElementById("bloque").value;
  var idturno = document.getElementById("iddetallegestionturno").value;
  var mensaje = "idgrado:" + idgrado+" idbloque: "+idbloque+" idturno :"+idturno;
  if(idgrado!="placeholder" || idbloque!="placeholder")
  { //alert(idgrado+" "+idturno+" "+idbloque)
 // alert(mensaje);

  $.get("/apertura/gestionarGradoBloque/"+idturno+"/"+idgrado+"/"+idbloque+"",function(response,cupo){
    console.log(response);
    document.getElementById('cuporestante').value=response.cuporestante;
    //alert(response.cuporestante);
  });
  }
};
/*document.getElementById("botondetallegradobloque").onclick = function(){
  //alert("has clickeado");
  alert("hola");

  var iddetallegradobloque = document.getElementById("iddetallegradobloque").value;
  $.get("/apertura/gestionarGradoBloque/"+idturno+"/"+idgrado+"/"+idbloque+"",function(response,cupo){
    console.log(response);
    document.getElementById('cuporestante').value=response.cuporestante;
    //alert(response.cuporestante);
  });
};

window.onload = function(){
    document.getElementById("botondetallegradobloque").onclick=function(){
      alert("Hello WOrld");
}
};*/
