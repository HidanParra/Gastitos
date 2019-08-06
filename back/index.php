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
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistemita | Dashboard </title>
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
              <a id="logout"  class="nav-link"> <span class="d-none d-sm-inline">Cerrar Sesión </span><i class="icon-logout"></i></a></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Mark Stephen</h1>
            <p>Web Designer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Modulos</span>
        <ul class="list-unstyled">
          <li class="active"><a href="index.php"> <i class="icon-home"></i>Dashboard </a></li>
          <li><a href="transacciones.php"> <i class="icon-computer"></i>Transacciones </a></li>
          <li><a href="usuarios.php"> <i class="icon-user-1"></i>Usuarios</a></li>
          <li><a href="categorias.php"> <i class="icon-presentation"></i>Categorias </a></li>
          <li><a href="login.php"> <i class="icon-logout"></i>Cerrar Sesión </a></li>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-4">
                <div class="block margin-bottom-sm">
                  <div class="title"><strong>Ingresos</strong></div>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Salarios</th>
                            <th>Suma</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $dash = $db->select("transacciones",["transacciones.tra_nom",
                                                               "transacciones.tra_cant"],
                                                              ["transacciones.tra_cat" => 1]);
                          foreach($dash as $key => $da){
                          ?>
                          <tr>
                            <td scope="row"><?php echo $da["tra_nom"];?></td>
                            <td><?php echo $da["tra_cant"];?></td>
                          </tr>
                          <?php
                            }
                           ?>
                        </tbody>
                      </table>
                      <br>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Freelance</th>
                            <th>suma</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $dash = $db->select("transacciones",["transacciones.tra_nom",
                                                               "transacciones.tra_cant"],
                                                              ["transacciones.tra_cat" => 2]);
                          foreach($dash as $key => $da){
                          ?>
                          <tr>
                            <td scope="row"><?php echo $da["tra_nom"];?></td>
                            <td><?php echo $da["tra_cant"];?></td>
                          </tr>
                          <?php
                            }
                           ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="block margin-bottom-sm">
                    <div class="title"><strong>Gastos</strong></div>
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Comidas</th>
                              <th>Suma</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $dash = $db->select("transacciones",["transacciones.tra_nom",
                                                                 "transacciones.tra_cant"],
                                                                ["transacciones.tra_cat" => 3]);
                            foreach($dash as $key => $da){
                            ?>
                            <tr>
                              <td scope="row"><?php echo $da["tra_nom"];?></td>
                              <td><?php echo $da["tra_cant"];?></td>
                            </tr>
                            <?php
                              }
                             ?>
                          </tbody>
                        </table>
                        <br>
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Fijos</th>
                              <th>suma</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $dash = $db->select("transacciones",["transacciones.tra_nom",
                                                                 "transacciones.tra_cant"],
                                                                ["transacciones.tra_cat" => 4]);
                            foreach($dash as $key => $da){
                            ?>
                            <tr>
                              <td scope="row"><?php echo $da["tra_nom"];?></td>
                              <td><?php echo $da["tra_cant"];?></td>
                            </tr>
                            <?php
                              }
                             ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="block margin-bottom-sm">
                      <div class="title"><strong>Balance</strong></div>
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Salarios</th>
                                <th>Suma</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td scope="row">1</td>
                                <td>Mark</td>
                              </tr>
                            </tbody>
                          </table>
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Ingresos</th>
                                <th>suma</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td scope="row">1</td>
                                <td>Mark</td>
                              </tr>
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
              <p class="no-margin-bottom">2019 &copy; Sistemita. Design by <a href="https://bootstrapious.com/p/bootstrap-4-dark-admin">Bootstrapious</a>.</p>
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
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
    <script src="js/main.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>
