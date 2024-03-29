<?php
  require_once 'backend/includes/_db.php';
  require_once 'backend/includes/_funciones.php';
  session_start();
  global $db;

  if(!isset($_COOKIE['lau']) || $_COOKIE['lau']==0){
    echo "Sesion no iniciada";
    header('Location: login.php');
    return false;
    exit();
  }else{
  $u_id=$_COOKIE['lau'];
  $id=$_SESSION['USR_ID'];
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gastitos | Clientes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
	  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <body>
      <header class="header">
        <nav class="navbar navbar-expand-lg">
          <div class="search-panel">
            <div class="search-inner d-flex align-items-center justify-content-center">
              <div class="close-btn">Cerrar <i class="fa fa-close"></i></div>
              <form id="searchForm" action="#">
                <div class="form-group">
                  <input type="search" name="search" placeholder="¿Que estas buscando?...">
                  <button type="submit" class="submit">Buscar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
              <!-- Navbar Header-->
                <a href="index.html" class="navbar-brand">
                <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Dark</strong><strong>Admin</strong></div>
                <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
              <!-- Sidebar Toggle Btn-->
              <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
            </div>
            <div class="right-menu list-inline no-margin-bottom">
              <div class="list-inline-item"><a href="#" class="search-open nav-link"><i class="icon-magnifying-glass-browser"></i></a></div>
              <!-- Log out               -->
              <div class="list-inline-item logout">
                <a id="logout" class="nav-link"> <span class="d-none d-sm-inline">Cerrar Sesión </span><i class="icon-logout"></i></a></div>
            </div>
          </div>
        </nav>
      </header>
      <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="<?php
              $admin = $db->select("administradores","*",["adm_id"=>$id]);
               foreach($admin as $key => $adm){
                 echo $adm["adm_foto"];
               }
              ?>" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h5"><?php global $db; $nom=$db->get("administradores","adm_nom",["adm_id"=>$id]); echo $nom;?></h1>

            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Modulos</span>
          <ul class="list-unstyled">
            <li><a href="index.php"> <i class="icon-home"></i>Inicio </a></li>
            <li><a href="transacciones.php"> <i class="icon-computer"></i>Transacciones </a></li>
            <li><a href="usuarios.php"> <i class="icon-user-1"></i>Usuarios </a></li>
            <li><a href="categorias.php"> <i class="icon-presentation"></i>Categorias </a></li>
            <li><a href="proyectos.php"> <i class="icon-layers"></i>Proyectos </a></li>
            <li class="active"><a href="clientes.php"> <i class="icon-user"></i>Clientes </a></li>
            <li><a href="tareas.php"> <i class="icon-contract"></i>Tareas </a></li>
        </nav>
        <!-- Sidebar Navigation end-->
        <div class="page-content">
          <!-- Page Header-->
          <div class="page-header no-margin-bottom">
            <div class="container-fluid">
              <h2 class="h5 no-margin-bottom">Clientes</h2>
            </div>
          </div>
          <!-- Breadcrumb-->
          <div class="container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes        </li>
            </ul>
          </div>
          <section class="no-padding-top">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
                  <div class="block">
                    <div class="title">
                      <strong>Clientes &nbsp; &nbsp;</strong>
                      <button id="nuevo" type="button" class="btn btn-primary">Nuevo</button>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Sitio Web</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Fecha de Alta</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $i=1;
                            $clis = $db->select("clientes",["clientes.cli_id",
                                                            "clientes.cli_nom",
                                                            "clientes.cli_sw",
                                                            "clientes.cli_tel",
                                                            "clientes.cli_pa",
                                                            "clientes.cli_reg",
                                                            "clientes.cli_fa"]);

                              foreach($clis as $key => $cli){
                          ?>
                          <tr>
                            <th scope="row"><?php echo $i++;?></th>
                            <td><?php echo $cli["cli_nom"];?></td>
                            <td><?php echo $cli["cli_sw"];?></td>
                            <td><?php echo $cli["cli_tel"];?></td>
                            <td><?php echo $cli["cli_reg"], ', ',$cli["cli_pa"];?></td>
                            <td><?php echo $cli["cli_fa"];?></td>
                            <td>
                              <a href="#" class="editar_cli" data-id="<?php echo $cli["cli_id"];?>">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </a>
                            </td>
                            <td>
                              <a href="#" class="eliminar_cli" data-id="<?php echo $cli["cli_id"];?>">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                              </a>
                            </td>
                          </tr>
                        <?php
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <footer class="footer">
            <div class="footer__block block no-margin-bottom">
              <div class="container-fluid text-center">
                <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                <p class="no-margin-bottom">2019 &copy; Your company. Design by <a href="https://bootstrapious.com/p/bootstrap-4-dark-admin">Bootstrapious</a>.</p>
              </div>
            </div>
          </footer>
        </div>
      </div>
      <!-- JavaScript files-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/popper.js/umd/popper.min.js"> </script>
      <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
      <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
      <script src="vendor/chart.js/Chart.min.js"></script>
      <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
      <script src="js/front.js"></script>
      <script src="js/main.js"></script>
	    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </body>
</html>
<!-- Modal-->
<div id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Agregar Cliente</strong>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <p></p>
        <form id="formulario">
          <div class="form-group">
            <label>Nombre del Cliente</label>
            <input type="text" id="nom" placeholder="Nombre" autocomplete="off" class="form-control">
          </div>
          <div class="form-group">
            <label>Sitio Web</label>
            <input type="text" id="sw" placeholder="Sitio Web" autocomplete="off" class="form-control">
          </div>
          <div class="form-group">
            <label>Telefono</label>
            <input type="text" id="tel" placeholder="Telefono" autocomplete="off" class="form-control">
          </div>
          <div class="form-group">
            <label>Pais</label>
            <input type="text" id="pais" placeholder="Pais" autocomplete="off" class="form-control">
          </div>
          <div class="form-group">
            <label>Estado</label>
            <input type="text" id="edo" placeholder="Estado" autocomplete="off" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
        <button type="button" id="guardarCli" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
