$(document).ready(function(){
//CERRAR SESION
$("#logout").click(function(){
    let obj={
        "accion":"cerrar_sesion"
    }

    $.ajax({
        url:"backend/includes/_funciones.php",
        datatype:"json",
        type:"post",
        data:obj,
        success:function(data){
            if(data==1){
              alert("sesion cerrada");
              location.href="login.php";
            }else{
              alert("Ocurrio un error vuelva a intentarlo");
            }
        }
    })
});

//Login
$("#login").click(function(){
  let user=$("#login-username").val();
  let pass=$("#login-password").val();

  let obj={
    "accion":"login",
    "user":user,
    "pass":pass
  }
  $.ajax({
    url:"backend/includes/_funciones.php",
    datatype:"json",
    type:"post",
    data:obj,
    success:function(data){
      if(data==0){
        alert("El usuario es incorrecto");
      }else if(data==1){
        alert("Exito");
        setTimeout(function(){ location.href='index.php'; }, 2000);
      }else{
        alert("contraseña incorreta");
      }
    }
  })
});

$("#recuperar").click(function(){
  //alert("Todos envueltos por el aroma del hashis");
  email=$("#email").val();
  obj={
    accion: "verificar_mail",
    email: email
  }

  if(email==""){
    alert("Ingresa un email");
  }else{
    $.ajax({
      url: "backend/includes/_funciones.php",
      type: "post",
      datatype: "json",
      data: obj,
      success: function(data){
        if(data==1){
          alert("Se ha enviado el correo");
          location.href="login.php";
        }else{
        alert("No existe el correo en nuestra BD");
      }
      }
    })

  }
});
//BOTON ACTIVAR FORMULARIO
$("#nuevo").click(function(){
  //alert("puto");
  $("#modal").modal("show");
  $("#formulario").trigger("reset");
});

//Usuarios
$("#guardarUsr").click(function(){
  //alert("puto 45");
  nom=$("#nom").val();
  email=$("#email").val();
  pass=$("#pass").val();
  obj={
    accion: "insertar_user",
    nom: nom,
    email: email,
    pass:pass
  }

  if($(this).data("edicion")==1){
  obj["accion"]="editar_user";
     obj["id"]=$(this).data("id");
   $(this).removeData("edicion").removeData("id");
  }

  if(nom=="" || email=="" || pass==""){
    alert("No dejes campos vacios");
    return;
  }else{
    $.ajax({
      url: "backend/includes/_funciones.php",
      type: "post",
      datatype: "json",
      data: obj,
      success: function(data){
        if(data==1){alert("insercion");}
      }
    })
    location.reload();
  }
});

$(document).on("click", ".editar_user", function(){
  id=$(this).data("id");
  obj={
    "accion" : "consultar_user",
    "id" : $(this).data("id")
  }
  $.post("backend/includes/_funciones.php", obj, function(data){
    $("#nom").val(data.adm_nom);
    $("#email").val(data.adm_email);
    $("#pass").val(data.adm_pass);
  }, "JSON");

  $("#guardarUsr").text("Actualizar").data("edicion", 1).data("id", id);
  $(".modal-title").text("Editar Usuario");
  $("#modal").modal("show");

});

$(document).on("click", ".eliminar_user", function(){
  id=$(this).data("id");
  let obj = {
        "accion" : "eliminar_user",
        "id" : id
    }

  $.ajax({
      url: "backend/includes/_funciones.php",
      type: "POST",
      dataType: "json",
      data: obj,
      success: function(data){
          if(data==1){alert("logrado");}else{alert("no logrado");}
      }
  })
  location.reload();
});

//TRANSACCIONES

$("#guardarTra").click(function(){
  nom=$("#nom").val();
  cant=$("#cant").val();
  lista=$("#lista").val();
  listaa=$("#listaa").val();
  obj = {
    accion: "insertar_trans",
    nom: nom,
    cant: cant,
    lista:lista,
    listaa:listaa
  }

  if($(this).data("edicion")==1){

  obj["accion"]="editar_trans";
  alert("neptuno");
   obj["id"]=$(this).data("id");
   $(this).removeData("edicion").removeData("id");
  }

  if(nom=="" || cant=="" || lista==0 || listaa==0){
    alert("No dejes campos vacios");
    return;
  }else{
    $.ajax({
      url: "backend/includes/_funciones.php",
      type: "post",
      datatype: "json",
      data: obj,
      success: function(data){
        if(data==1){alert("subete y ya veras");}
      }
    })
    location.reload();
  }
});


$(document).on("click", ".editar_trans", function(){
  id=$(this).data("id");
  obj={
    "accion" : "consultar_trans",
    "id" : $(this).data("id")
  }
  console.log(id);
  $.post("backend/includes/_funciones.php", obj, function(data){
    $("#nom").val(data.tra_nom);
    $("#cant").val(data.tra_cant);
    $("#lista").val(data.tra_cat);
    $("#listaa").val(data.tra_tip);
  }, "JSON");

  $("#guardarTra").text("Actualizar").data("edicion", 1).data("id", id);
  $(".modal-title").text("Editar Transaccion");
  $("#modal").modal("show");

});


$(document).on("click", ".eliminar_trans", function(){
  id=$(this).data("id");
  let obj = {
        "accion" : "eliminar_trans",
        "id" : id
    }

  $.ajax({
      url: "backend/includes/_funciones.php",
      type: "POST",
      dataType: "json",
      data: obj,
      success: function(data){
          if(data==1){alert("logrado");}else{alert("no logrado");}
      }
  })
  location.reload();
});

//categorias
$("#guardarCat").click(function(){
  nom=$("#nom").val();
  lista=$("#lista").val();
  obj = {
    accion: "insertar_cat",
    nom: nom,
    lista:lista
  }

  if($(this).data("edicion")==1){

  obj["accion"]="editar_cat";
  alert("neptuno");
   obj["id"]=$(this).data("id");
   $(this).removeData("edicion").removeData("id");
  }

  if(nom=="" || lista==0 ){
    alert("No dejes campos vacios");
    return;
  }else{
    $.ajax({
      url: "backend/includes/_funciones.php",
      type: "post",
      datatype: "json",
      data: obj,
      success: function(data){
        if(data==1){alert("categoria ");}
      }
    })
    location.reload();
  }
});

$(document).on("click", ".editar_cat", function(){
  id=$(this).data("id");
  obj={
    "accion" : "consultar_cat",
    "id" : $(this).data("id")
  }
  console.log(id);
  $.post("backend/includes/_funciones.php", obj, function(data){
    $("#nom").val(data.cat_nom);
    $("#lista").val(data.cat_tip);
  }, "JSON");

  $("#guardarCat").text("Actualizar").data("edicion", 1).data("id", id);
  $(".modal-title").text("Editar Categoria");
  $("#modal").modal("show");

});


$(document).on("click", ".eliminar_cat", function(){
  id=$(this).data("id");
  let obj = {
        "accion" : "eliminar_cat",
        "id" : id
    }

  $.ajax({
      url: "backend/includes/_funciones.php",
      type: "POST",
      dataType: "json",
      data: obj,
      success: function(data){
          if(data==1){alert("logrado");}else{alert("no logrado");}
      }
  })
  location.reload();
});


//FIN DOCUMENT READY
});
