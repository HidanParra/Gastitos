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
              swal("sesion cerrada");
              location.href="login.php";
            }else{
              swal("Ocurrio un error vuelva a intentarlo");
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
        swal("El usuario es incorrecto");
      }else if(data==1){
        swal("Exito");
        setTimeout(function(){ location.href='index.php'; }, 2000);
      }else if(data==2){
        swal("contraseña incorreta");
      }else if(data==3){
        swal("Tu usuario debe ser activado por un Administrador");
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
    swal("Ingresa un email");
  }else{
    $.ajax({
      url: "backend/includes/_funciones.php",
      type: "post",
      datatype: "json",
      data: obj,
      success: function(data){
        if(data==1){
          swal("Se ha enviado el correo");
          location.href="login.php";
        }else{
        swal("No existe el correo en nuestra BD");
      }
      }
    })

  }
});

//registrar desde el login
$("#registrar").click(function(){
  //alert("si funciona");
  nom=$("#nom").val();
  email=$("#email").val();
  pass=$("#pass").val();
  console.log(email);
  obj={
    accion: "registrar",
    nom: nom,
    email: email,
    pass: pass
  }

  $.ajax({
    url: "backend/includes/_funciones.php",
    type: "post",
    datatype: "json",
    data: obj,
    success: function(data){
      if(data==1){
        swal("Ya existe una cuenta con este email, ingresa otro");
      }
      if(data==2){
        swal("Registro exitoso, espera la activacion de tu usuario");
        //location.href="login.php";
        }
      }
    })
});

//Cambiar contraseña
$("#cambiarP").click(function(){
  console.log("chinga tu madre");
  pass1=$("#pass1").val();
  pass2=$("#pass2").val();

  if(pass1=="" || pass2==""){
    swal("No dejes campos vacios");
  }
  if(pass1 == pass2){
    pass = pass2;
    obj = {
      accion: "cambiarP",
      pass: pass
    }
    $.ajax({
      url: "backend/includes/_funciones.php",
      type: "post",
      datatype: "json",
      data: obj,
      success: function(data){
        if(data==1){
          swal("Contraseña cambiada");
          location.href="login.php";
        }else{
        swal("Contraseña cambniada :(");
			location.href="login.php";
        }
      }
    })
    //alert("Contraseñas iguales");
  }else{
    swal("Verifique su contraseña");
  }
});

//BOTON ACTIVAR FORMULARIO
$("#nuevo").click(function(){
  //alert("puto");
  $("#modal").modal("show");
  $("#formulario").trigger("reset");
});

$(".activar").change(function(){
  if(this.checked){
  val=1;
  id=$(this).data("id");
  obj={
    accion: "activar",
    val: val,
    id: $(this).data("id")
  }
  alert("Habilitado" + id);
  $.ajax({
    url: "backend/includes/_funciones.php",
    type: "post",
    datatype: "json",
    data: obj,
    success: function(data){
      if(data==1){swal("usuario activado");}
    }
  })
  location.reload();
  }else{
  val=2;
  id=$(this).data("id");
  obj={
    accion: "activar",
    val: val,
    id: $(this).data("id")
  }
  swal("No habilitado" +id);
  $.ajax({
    url: "backend/includes/_funciones.php",
    type: "post",
    datatype: "json",
    data: obj,
    success: function(data){
      if(data==1){swal("usuario desactivado");}
    }
  })
  location.reload();
  }
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
    swal("No dejes campos vacios");
    return;
  }else{
    $.ajax({
      url: "backend/includes/_funciones.php",
      type: "post",
      datatype: "json",
      data: obj,
      success: function(data){
        if(data==1){swal("insercion");}
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
          if(data==1){swal("logrado");}else{swal("no logrado");}
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
  swal("neptuno");
   obj["id"]=$(this).data("id");
   $(this).removeData("edicion").removeData("id");
  }

  if(nom=="" || cant=="" || lista==0 || listaa==0){
    swal("No dejes campos vacios");
    return;
  }else{
    $.ajax({
      url: "backend/includes/_funciones.php",
      type: "post",
      datatype: "json",
      data: obj,
      success: function(data){
        if(data==1){swal("subete y ya veras");}
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
          if(data==1){swal("logrado");}else{swal("no logrado");}
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
  swal("neptuno");
   obj["id"]=$(this).data("id");
   $(this).removeData("edicion").removeData("id");
  }

  if(nom=="" || lista==0 ){
    swal("No dejes campos vacios");
    return;
  }else{
    $.ajax({
      url: "backend/includes/_funciones.php",
      type: "post",
      datatype: "json",
      data: obj,
      success: function(data){
        if(data==1){swal("categoria ");}
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
          if(data==1){swal("logrado");}else{swal("no logrado");}
      }
  })
  location.reload();
});

//CONTACTO
$("#contact").click(function(e){
  e.preventDefault();
  nom=$("#nom").val();
  email=$("#email").val();
  titulo=$("#titulo").val();
  mensaje=$("#mensaje").val();
  obj={
    accion: "contactar",
    nom:nom,
    email:email,
    titulo:titulo,
    mensaje:mensaje
  }

  if(nom=="" || email=="" || titulo=="" || mensaje==""){
	swal("No dejes campos vacios ");
    //alert("No dejes campos vacios");
    return;
  }else{
    $.ajax({
      url: "back/backend/includes/_funciones.php",
      type: "POST",
      dataType: "json",
      data: obj,
      success: function(data){
          if(data==1){
			swal("Se ha enviado tu solicitud");  
            //alert("Se ha enviado tu solicitud");
			location.reload();
          }
          if(data==2){
            swal("Ooops! Algo salio mal :( ");
            //console.log(obj);
          }
      }
    })
   
  }

});

//FIN DOCUMENT READY
});
