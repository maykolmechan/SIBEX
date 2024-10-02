<?php
/**
 *
 * @author Maykol Caicedo Mechan
 */

session_start();
//error_reporting(0);﻿
    
    if (!isset($_SESSION['usuarioo']) || $_SESSION['usuarioo'] === '') {//si nadie inició sessión
           header('location:./inicio.php');
    }
    if (!isset($_GET['av'])) {
        $avizo = '';
    }else{
        $avizo = $_GET['av'];
        if ($avizo === '0') {
            $avizo ='<div class="alert alert-danger" role="alert">
                        <div class="container">
                            <div class="alert-icon"><i class="zmdi zmdi-block"></i></div>
                            <strong>Ocurrió un error al ejecutar la operación.</strong>                            
                        </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
                            </button>
                     </div>';
        }elseif ($avizo === '1') {            
            $avizo ='<div class="alert alert-success" role="alert">
                        <div class="container">
                            <div class="alert-icon"><i class="zmdi zmdi-check-circle-u"></i></div>
                            <strong>OFICIO ACTUALIZADO CORRECTAMENTE.</strong>                            
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
                        </button>
                     </div> ';
        }elseif ($avizo === '2') {            
            $avizo ='<div class="alert alert-success" role="alert">
                        <div class="container">
                            <div class="alert-icon"><i class="zmdi zmdi-check-circle"></i></div>
                            <strong>OFICIO NUEVO REGISTRADO CORRECTAMENTE.</strong>                            
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
                        </button>
                     </div>';
        }elseif ($avizo === '3') {            
            $avizo ='<div class="alert alert-success" role="alert">
                        <div class="container">
                            <div class="alert-icon"><i class="zmdi zmdi-minus-circle"></i></div>
                            <strong>OFICIO ELIMINADO CORRECTAMENTE.</strong>                            
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
                        </button>
                     </div>';
        }else{
            $avizo = '';
        }
    }
?>
﻿<!doctype html>
<html class="no-js" lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="SIBEX">

<title> Oficios </title>
<!-- logo-->
<link rel="shortcut icon" type="image/png" href="../SIBEX.png">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="shortcut icon" type="image/png" href="../SIBEX.png">
</head>

<body class="theme-blush">

<!-- superposicionde los menus -->
<div class="overlay"></div>

<?php include 'menuizq.php'; ?>
<?php include 'iconosder.php'; ?>
<?php include 'menuder.php'; ?>

<!-- Main Content -->
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Oficios</h2>
                    <br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php"><i class="zmdi zmdi-home"></i> SIBEX</a></li>
                        <li class="breadcrumb-item">Listado</li>
                        <li class="breadcrumb-item active">Oficios</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <?php echo $avizo; ?>
                <div class="col-lg-5 col-md-6 col-sm-12">       
                    <a href="regoficio.php" ><button class="btn btn-success btn-success float-right" type="button">NUEVO OFICIO</button></a>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="col-lg-12">
                    <div class="card">
                        <div class="header">                            
                            <ul class="header-dropdown">                            
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>                                        
                                        <tr>                                            
                                            <th>NÚMERO</th>
                                            <th>A QUIEN SE ENVÍA</th>
                                            <th>ASUNTO</th>
                                            <th>N° DE FOLIOS</th>
                                            <th>NOTAS</th>
                                            <th>ARCHIVO/FECHA REG</th>                                           
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>                                           
                                            <th>NÚMERO</th>
                                            <th>A QUIEN SE ENVÍA</th>
                                            <th>ASUNTO</th>
                                            <th>N° DE FOLIOS</th>
                                            <th>NOTAS</th>
                                            <th>ARCHIVO/FECHA REG</th>
                                            <th>Acción</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                <?php	  	
                require '../Modelo/Documento.php';            
                $bdd= new Documento();
                $abb=$bdd->consultarOF();                
                $regs = $abb;
                if (count($regs)) {
                    foreach ($regs as $cons) {
                ?>
                                <tr>                                    
                                    <td>
                                        <a class="single-user-name" ><?php echo $cons->ndoc; ?></a><br>
                                    </td>
                                    <td>
                                        <?php echo $cons->nombres; ?>                                           
                                    </td>
                                    <td>
                                        <strong><?php echo $cons->asure; ?></strong>                                      
                                    </td> 
                                    <td>
                                        <a class="single-user-name" ><?php echo $cons->nfolio; ?></a><br>
                                    </td>                                         
                                    <td>
                                        <p><small><?php echo $cons->nota; ?></small></p>
                                    </td>      
                                    <td>
                                        <center>
                                            <div class="buters-guide">                                                                  
                                                <a target="_blank" href="DOCS/OFI/<?php echo $cons->linkarchivo; ?>"><img width='60' height='60' src="pdf-documento.png" alt="CLICK PARA ABRIR ARCHIVO" /></a>
                                            </div>
                                        </center>
                                        <?php echo substr($cons->freg, 0, 19); ?>
                                    </td>
                                    <td>
                                        <a href="../Vista/regoficio.php?edit=1&ofi=<?php echo $cons->iddocumento; ?>" class="btn btn-default waves-effect waves-float btn-sm waves-green">
                                            <i class="zmdi zmdi-edit"></i></a>
                                        <a href="../Vista/php/rof.php?ido=<?php echo $cons->iddocumento; ?>" class="btn btn-default waves-effect waves-float btn-sm waves-red zonaelim">
                                            <i class="zmdi zmdi-delete"></i></a>
                                    </td>
                                </tr>
                <?php 
                    }
                } else {
                ?>
                <center><?php 
                echo "NO HAY REGISTROS INGRESADOS";
                ?></center><?php
                }
                ?>
                                    </tbody>
                                </table>
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

<!-- Jquery DataTable Plugin Js --> 
<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script>

<script src="assets/js/pages/tables/jquery-datatable.js"></script>

</body>


</html>