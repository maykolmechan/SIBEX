<?php
session_start();
//error_reporting(0);
if (!isset($_SESSION['usuarioo']) || $_SESSION['usuarioo'] === '') {//si ndie inició sessión
    //  header('location:./logueo.php');
       
}else{
    include '../Modelo/Period1.php';  
    $bd1=new Period1();
$ab1=$bd1->BUSCARIDXNICK($_SESSION['usuarioo']);
$listaa = $ab1;
   if (count($listaa)) {
        foreach ($listaa as $consa1) {
           //echo $consa1->idusuario;
           $idu=$consa1->idusuario;
        }
   }else{
    header('location:../pabellones.php');
   }

}

?>
<?php
if (!isset($_GET['error'])) {
    $avizo = '';
} else {
    $avizo = $_GET['error'];
    if ($avizo === '1') {
        $avizo = '* USUARIO O CONTRASEÑA NO VÁLIDO.';
    }
    if ($avizo === '2') {
        $avizo = '* CERRÓ SESIÓN CORRECTAMENTE.';
    }
    
    
}
?>

<!doctype html>
<html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="SISTEMA SIBEX by Maykol Caicedo Mechan">

        <title>SIBEX - Iniciar Sesión</title>
        <!-- logo-->
        <link rel="shortcut icon" type="image/png" href="../SIBEX.png">
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
        <!-- Custom Css -->
        <link rel="stylesheet" href="assets/css/style.min.css">
    </head>

<body class="theme-blush">

<!-- superposicionde los menus -->
<div class="overlay"></div>



<?php include 'menuizq.php'; ?>


<section class="content">
    <div class="body_scroll">
       
<div class="body">
    <?php 
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] === '') {
                echo '<center><h2>BIENVENIDO A SIBEX </h2></center>';           
         ?>
    <div class="alert alert-danger" role="alert">
    <div class="container">
        <div class="alert-icon">
            <i class="zmdi zmdi-block"></i>
        </div>
        <strong>INICIE SESIÓN </strong> <?php echo "<p >" . $avizo . "</p>"; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">
                <i class="zmdi zmdi-close"></i>
            </span>
        </button>
    </div>
    </div>
    <br>
    <form method="post" action="../Controlador/loguear.php">
        
            <label for="email_address">INGRESE USUARIO</label>
            <div class="form-group">                                
                <input type="text" name="user" class="form-control" placeholder="Ingrese usuario">
            </div>
            <label for="password">INGRESE CONTRASEÑA</label>
            <div class="form-group">                                
                <input type="password" name="pass" class="form-control" placeholder="Ingrese Contraseña">
            </div>
            <div class="checkbox">
                <input id="remember_me" type="checkbox">
                <label for="remember_me">
                        Recordarme
                </label>
            </div>
            <input class="btn btn-raised btn-primary btn-round waves-effect" type="submit" tabindex="5" value="ACCEDER"> 
        
    </form>
    <?php  
        }else{
             
        }
    ?> 
</div>
      
  </div>
</section>


<!-- Jquery Core Js --> 
<!--<script src="assets/bundles/libscripts.bundle.js"></script>  Lib Scripts Plugin Js  
<script src="assets/bundles/vendorscripts.bundle.js"></script>  Lib Scripts Plugin Js  

<script src="assets/bundles/mainscripts.bundle.js"></script>-->
</body>


</html>