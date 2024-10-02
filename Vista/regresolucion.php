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

?>
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="SIBEX">

<title>SIBEX - Resolución </title>
<!-- logo-->
<link rel="shortcut icon" type="image/png" href="../SIBEX.png">
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">

<script src="assets/plugins/sweetalert/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/plugins/sweetalert/sweetalert2.min.css">   
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
                    <h2>Resolución</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio.php"><i class="zmdi zmdi-home"></i> SIBEX</a></li>
                        <li class="breadcrumb-item">Registro Nuevo</li>
                        <li class="breadcrumb-item active">Resolución</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                
            </div>
        </div>
                        
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
                            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        
                        <div class="body">
                        <?php
                        if (isset($_GET['edit'])==1&&isset($_GET['res'])) {
                            $v=$_GET['res'];
                        include '../Modelo/Documento.php';
                        $con = new Documento();
                        $ab=$con->obtenerPorId($v);
                        $lista1 = $ab;
                            if (count($lista1)) {
                                foreach ($lista1 as $dato){
                            ?>
                            <legend> PANEL EDITOR DE RESOLUCIÓN NÚMERO <?php echo ': '.$dato->ndoc?></legend>
                            <form id="form_validation" method="POST" action="./php/rres.php" onsubmit="return checkSubmit();" name="edit" enctype="multipart/form-data">
                                <input  name="idres" value="<?php echo $dato->iddocumento?>" >
                                <div class="form-group form-float">
                                    NÚMERO DE RESOLUCIÓN (10)
                                    <input type="text" class="form-control" placeholder="Número" name="num1" maxlength="10" size="20" required value="<?php echo $dato->iddocumento?>">
                                </div>
                                <div class="form-group form-float">
                                    SOLICITANTE (100)
                                    <input type="text" class="form-control" placeholder="Nombre" name="nom1" maxlength="100" required value="<?php echo $dato->nombres?>">
                                </div>
                                <div class="form-group form-float">
                                    SE RESUELVE (200)
                                    <textarea name="asu1" cols="30" rows="3" placeholder="Escribir" maxlength="200"class="form-control no-resize" ><?php echo $dato->asure?></textarea>
                                </div>
                                <div class="form-group form-float">
                                    AÑO (4)
                                    <input type="text" class="form-control" placeholder="Año" name="ani1" maxlength="4" size="5" required value="<?php echo $dato->anio?>">
                                </div>
                                <div class="form-group form-float">
                                    NÚMERO DE FOLIOS (5)
                                    <input type="text" class="form-control" placeholder="Número" name="nfo1" maxlength="10" required value="<?php echo $dato->nfolio?>">
                                </div>
                                <div class="form-group form-float">
                                    NOTAS O DESCRIPCIÓN (200)
                                    <textarea name="not1" cols="30" rows="3" placeholder="Escribir Notas" maxlength="200"class="form-control no-resize" ><?php echo $dato->asure?></textarea>
                                </div>
                                <div class="form-group form-float">
                                    SUBIR ARCHIVO
                                    <input type="file" name="txtLink1" class="form-control"  placeholder="Seleccionar Archivo"><?php echo $dato->linkarchivo?>
                                </div>
                                <button class="btn btn-raised btn-primary waves-effect" type="submit" onclick="AlertaParaConfirmar()" id="btsubmit">EDITAR RESOLUCIÓN</button>
                            </form>
                            <?php
                                }
                            }else{
                                  echo "La búsqueda no existe o está buscando algo incorrectamente.";
                                }                                     
                            }else{
                            ?>
                            <div class="header">
                            <h2><strong>Resolución</strong>  NUEVA</h2>                            
                            </div>
                            <form id="form_validation" method="POST" action="./php/rres.php" onsubmit="return checkSubmit();" name="insert" enctype="multipart/form-data">
                                
                                <div class="form-group form-float">
                                    NÚMERO DE RESOLUCIÓN (10)
                                    <input type="text" class="form-control" placeholder="Número" name="num" maxlength="10" size="20" required>
                                </div>
                                <div class="form-group form-float">
                                    SOLICITANTE (100)
                                    <input type="text" class="form-control" placeholder="Nombre" name="nom" maxlength="100" required>
                                </div>
                                <div class="form-group form-float">
                                    SE RESUELVE (200)
                                    <textarea name="asu" cols="30" rows="3" placeholder="Escribir" maxlength="200"class="form-control no-resize" ></textarea>
                                </div>
                                <div class="form-group form-float">
                                    AÑO (4)
                                    <input type="text" class="form-control" placeholder="Año" name="ani" maxlength="4" size="5" required>
                                </div>
                                <div class="form-group form-float">
                                    NÚMERO DE FOLIOS (5)
                                    <input type="text" class="form-control" placeholder="Número" name="nfo" maxlength="10" required>
                                </div>
                                <div class="form-group form-float">
                                    NOTAS O DESCRIPCIÓN (200)
                                    <textarea name="not" cols="30" rows="3" placeholder="Escribir Notas" maxlength="200"class="form-control no-resize" ></textarea>
                                </div>
                                <div class="form-group form-float">
                                    SUBIR ARCHIVO
                                    <input type="file" name="txtLink1" class="form-control"  placeholder="Seleccionar Archivo" required>
                                </div>
                                <button class="btn btn-raised btn-primary waves-effect" type="submit" onclick="AlertaParaConfirmar()" id="btsubmit">REGISTRAR NUEVA RESOLUCIÓN</button>
                            </form>
                            <?php
                            }
                            ?>
                            
                        </div>
                    </div>
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



<script>
    function AlertaParaConfirmar() {
    Swal.fire({
        type: 'success',
        title: 'SIBEX!',
        text: 'El sistema está verificando los datos, para guardar la operación.',
        timer: 3500
    });
    }           
    function checkSubmit() {
        document.getElementById("btsubmit").value = "Registrando...";
        document.getElementById("btsubmit").disabled = true;
        return true;
    }
</script>

</body>


</html>