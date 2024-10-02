<?php
/**
 *
 * @author Maykol Caicedo Mechan
 */

session_start();
//error_reporting(0);﻿

//if (!isset($_SESSION['usuarioo']) && $_SESSION['usuarioo'] === '') {//si nadie inició sessión
//           header('location:./inicio.php');
//    }

$page='ini';

?>
﻿<!doctype html>
<html class="no-js " lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="SIBEX by Maykol Caicedo Mechan / maykol1127@gmail.com">

<title> Bienvenido a SIBEX</title>
<!-- logo-->
<link rel="shortcut icon" type="image/png" href="../SIBEX.png">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
</head>
<body class="theme-blush">

<div class="overlay"></div>


<?php include 'menuizq.php'; ?>
<?php include 'iconosder.php'; ?>
<?php include 'menuder.php'; ?>

<!-- Right Sidebar -->


<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-9 col-md-6 col-sm-12">
                    <h2>SISTEMA DE BÚSQUEDA DE OFICIOS, EXPEDIENTES Y RESOLUCIONES DE LA MDSR.</h2>
                    <br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php"><i class="zmdi zmdi-home"></i> SIBEX</a></li>                        
                        <li class="breadcrumb-item active">Inicio</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>                    
                </div>
            </div>
        </div>
        
        <center>
            <img src="MUNISANTAROSAPNG.png" alt="" class="img-fluid">
        </center>
        <br>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card state_w1">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h5>
                                <?php	  	
                                require '../Modelo/Documento.php';
                                $bdd= new Documento();
                                $abb=$bdd->consultarOF();
                                $regs = $abb;            
                                echo count($regs);
                                ?>
                                </h5>
                                <span>Oficios</span>
                            </div>
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#FFC107">5,2,3,7,6,4,8,1</div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card state_w1">
                        <div class="body d-flex justify-content-between">
                            <div>
                                <h5>
                                <?php	  	
                                $bdd= new Documento();
                                $abb=$bdd->consultarEX();
                                $regs = $abb;            
                                echo count($regs);
                                ?>
                                </h5>
                                <span>Expedientes</span>
                            </div>
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#ee2558">4,4,3,5,2,4,5,7</div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card state_w1">
                        <div class="body d-flex justify-content-between">
                            <div>                                
                                <h5>
                                <?php	  	
                                
                               $bdd= new Documento();
                                $abb=$bdd->consultarRE();
                                $regs = $abb;            
                                echo count($regs);
                                ?>
                                </h5>
                                <span>Resoluciones</span>
                            </div>
                            <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#46b6fe">8,2,6,5,1,4,4,3</div>
                        </div>
                    </div>
                </div>
                
            </div>
            
                    </div>
        
        
        
                </div>
            
   
</section>

<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/bundles/sparkline.bundle.js"></script>
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/js/pages/charts/sparkline.js"></script>
</body>


</html>