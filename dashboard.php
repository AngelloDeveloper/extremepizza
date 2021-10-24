
<?php 
    session_start();
    require('class/conexion.class.php');
    require('class/menu_dashboard.class.php');

    if(!$_SESSION) {
        header('Location: index.php');
    }

    //objetos
    $objMenuDashboard = new menu_dashboard();
    $arrMenu = $objMenuDashboard->getMenu();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles_dashboard.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/app.css" rel="stylesheet" />
        <script src="js/jquery.js"></script>
        <script src="js/custom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/app.css" />
    </head>
    <body class="sb-nav-fixed">

        
        <nav class="sb-topnav navbar navbar-expand bgColor_">
            <!-- Navbar Brand-->
            <p class="navbar-brand ps-3" href="index.html">ExtremePizza</p>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i style="color: white;" class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item mt-2"><?= $_SESSION['user']?></li>
                <li class="nav-item dropdown">
                    <a style="color: white;" class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul style="color:white;" class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!--<li><a class="dropdown-item" href="#!">configuracion</a></li>
                        <li><a class="dropdown-item" href="#!">acitivad y logs</a></li>
                        <li><hr class="dropdown-divider" /></li>-->
                        <li><a class="dropdown-item" href="async/async_user.php?type=log_out">cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion bgColor_Menu" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Inicio</div>
                            <?php foreach($arrMenu as $item) { ?>
                                <?php if(in_array($_SESSION['userType'],json_decode($item['user_view']))) { ?>
                                    <a class="nav-link address" 
                                        data-address="<?= $item['address'] ?>"
                                        data-description="<?= $item['descripcion'] ?>" 
                                        href="#"
                                    >
                                        <div class="sb-nav-link-icon"><i style="color:white;" class="<?= $item['icon'] ?>"></i></div>
                                        <span style="color:white;"><?= $item['descripcion'] ?></span>
                                    </a>
                               <?php } ?>
                            <?php } ?>
                            
                            <!--<div class="sb-sidenav-menu-heading">Modulos</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i style="color:white;" class="fas fa-columns"></i></div>
                                    <span style="color:white;">tablas maestras</span>
                                <div class="sb-sidenav-collapse-arrow"><i style="color:white;" class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a style="color:white;" class="nav-link" href="layout-static.html">tipos de usuarios</a>
                                    <a style="color:white;" class="nav-link" href="layout-sidenav-light.html">parametros</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i style="color:white;" class="fas fa-book-open"></i></div>
                                <span style="color:white;">administración</span>
                                <div class="sb-sidenav-collapse-arrow"><i style="color:white;" class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        <span style="color:white;">Pedidios</span>
                                        <div class="sb-sidenav-collapse-arrow"><i style="color:white;" class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a style="color:white;" class="nav-link" href="login.html">Domicilios</a>
                                            <a style="color:white;" class="nav-link" href="register.html">Local</a>
                                            <a style="color:white;" class="nav-link" href="password.html">Facturas</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>-->
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 mt-4">
                        
                        <!--<div class="row">
                            <div class="col-12" >
                                <div id="item_menu" class="alert alert-warning" role="alert">
                                    Inicio/
                                    
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <div class="container-fluid px-4" id="render_modules">
                        <h1 class="mt-4 text-center">ExtremePizza</h1>
                        <h4 class="text-center">Bienvenido</h4>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; ExtremePizza 2021</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/dashboard.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>-->
        <!--<script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>-->
        <!--<script src="js/datatables-simple-demo.js"></script>-->
        <script src="js/app.js"></script>
    </body>
</html>
