<?php
  require_once '_db.php';
  function create_session($user,$type){
    session_start();
    $_SESSION['US']= $user;
    $_SESSION['USR_ID']= $type[0]["adm_id"];
    $cookie_name = "lau";
    $cookie_value = $type[0]["adm_id"];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    return;
  }
  if(isset($_POST["accion"])){
    switch ($_POST["accion"]) {
      //Login
      case "login":
        login();
      break;
      //SESION
      case "cerrar_sesion":
        cerrar_sesion();
      break;
      //Recuperar
      case "verificar_mail":
        verificar_mail();
      break;
      //USUARIOS
      case "insertar_user":
        insertar_user();
      break;
      case "consultar_user":
        consultar_user();
      break;
      case "eliminar_user":
        eliminar_user();
      break;
      case "editar_user":
        editar_user();
      break;
      //TRANSACCIONES
      case "insertar_trans":
        insertar_trans();
      break;
      case "consultar_trans":
        consultar_trans();
      break;
      case "eliminar_trans":
        eliminar_trans();
      break;
      case "editar_trans":
        editar_trans();
      break;
      //CATEGORIAS
      case "insertar_cat":
        insertar_cat();
      break;
      case "consultar_cat":
        consultar_cat();
      break;
      case "eliminar_cat":
        eliminar_cat();
      break;
      case "editar_cat":
        editar_cat();
      break;
  }
}
  //LOGIN
  function login(){

    global $db;
    extract($_POST);
    $conpassword=$db->select("administradores","*",["adm_pass"=>$pass]);#consulta para la contraseña
    $conuser=$db->select("administradores","*",["adm_email"=>$user]);#consulta para usuario

    if($conpassword && $conuser){
      echo 1;
    }elseif(!$conuser){
      echo 0;
    }elseif(!$conpassword){
      echo 2;
    }

    $type=$db->select("administradores","*",["AND"=>["adm_email"=>$user,"adm_pass"=>$pass]]);
    create_session($user,$type);

  }


  //FUNCIONES DE SESION
  function cerrar_sesion(){
    $_COOKIE['lau']=0;
    setcookie("lau", 0, time()-1,"/");
    session_start();
    $cerrar=session_destroy();

    if($cerrar){
      echo 1;
    }
  }

function verificar_mail(){
  global $db;
  extract($_POST);

  $consultar=$db -> get("administradores","*",["AND" => ["adm_email" => $email]]);

  if($consultar){
    echo 1;
  }else{
    echo 2;
  }
}
//TRANSACCIONES
function insertar_trans(){
  global $db;
  extract($_POST);

  $insertar=$db -> insert("transacciones",["tra_nom" => $nom,
                                           "tra_tip" => $lista,
                                           "tra_cat" => $listaa,
                                           "tra_cant" => $cant,
                                           "tra_fa" => date("Y").date("m").date("d")]);

  if($insertar){
    echo 1;
  }else{
    echo 2;
  }
}

function consultar_trans(){
  global $db;
  extract($_POST);

  $consultar = $db -> get("transacciones","*",["AND" => ["tra_id"=>$id]]);
  echo json_encode($consultar);

}

function editar_trans(){
  global $db;
  extract($_POST);

  $editar = $db -> update("transacciones",["tra_nom" => $nom,
                                           "tra_cant" => $cant,
                                           "tra_tip" => $lista,
                                           "tra_cat" => $listaa,],
                                          ["tra_id" => $id]);
  if($editar){
    echo 1;
  }else{
    echo 2;
  }

}

function eliminar_trans(){
  global $db;
  extract($_POST);

  $eliminar = $db->delete("transacciones",["tra_id" => $id]);

  if($eliminar){
    echo 1;
  }else{
    echo 2;
  }

}
//Categorias
function insertar_cat(){
  global $db;
  extract($_POST);

  $insertar = $db->insert("categorias",["cat_nom" => $nom,
                                        "cat_tip" => $lista,
                                        "cat_fa" => date("Y").date("m").date("d")]);

  if($insertar){
    echo 1;
  }else{
    echo 2;
  }

}
function editar_cat(){
  global $db;
  extract($_POST);

  $editar = $db ->update("categorias",["cat_nom" => $nom,
                                       "cat_tip" => $lista,],
                                      ["cat_id" => $id]);

  if($editar){
    echo 1;
  }else{
    echo 2;
  }
}
function consultar_cat(){
  global $db;
  extract($_POST);

  $consultar = $db ->get("categorias","*",["AND" => ["cat_id"=>$id]]);
  echo json_encode($consultar);

}
function eliminar_cat(){
  global $db;
  extract($_POST);

  $eliminar = $db->delete("categorias",["cat_id" => $id]);

  if($eliminar){
    echo 1;
  }else{
    echo 2;
  }

}

//FUNCIONES DE ADMINISTRADORES
  function insertar_user(){
    global $db;
    extract($_POST);

    $insertar =$db ->insert("administradores", ["adm_nom" => $nom,
                                                "adm_email"=>$email,
                                                "adm_pass"=>$pass,
                                                "adm_fa"=> date("Y").date("m").date("d")]);

   if($insertar){
      echo 1;
    }else{
      echo 2;
    }
  }

  function editar_user(){
    global $db;
    extract($_POST);


      $editar=$db ->update("administradores",["adm_nom" => $nom,
                                              "adm_email" => $email,
                                              "adm_pass" => $pass,],
                                              ["adm_id"=>$id]);
  }

  function consultar_user(){
    global $db;
    extract($_POST);

    $consultar = $db -> get("administradores","*",["AND" => ["adm_id"=>$id]]);
    echo json_encode($consultar);

  }

  function eliminar_user(){
        global $db;
        extract($_POST);
        $eliminar = $db->delete("administradores",["adm_id" => $id]);
        if($eliminar){
            echo "Registro eliminado";
        }else{
            echo "registro eliminado";
        }
    }

?>
